<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class App_myaccount extends MX_Controller {
    
    # property
    public $root;
    public $app_name            = ''; 
    public $breadcrumb          = ''; 
    public $initialPage         = 'My Account';
    public $initial_template    = ''; 
    protected  $base_template   = array(
    'container' => '../../layout/container',
    'template'  => 'tpl' 
    );

    # method
    public function __construct(){
       $this->accesscontroll->authenticate();
       $this->load->model('m'.strtolower( __CLASS__ ), 'coredb'); 
       parent::__construct();
       $this->init();  
	}
    
    protected function init(){
        
        isset($_SERVER['HTTP_REFERER']) ? $this->root = $_SERVER['HTTP_REFERER'] : '';  
        $this->app_name         = strtolower( __CLASS__ ); 
        $this->initial_template = $this->uri->segment(2); 
        $this->registerValidation();
        $this->load->helper( array(
        'image/image'
        ));
    }
    
    public function registerValidation(){
        
         define("REG_VALIDATION", strtolower( __CLASS__ ));
    }
        
    private function getContent($args = array()){
         
        try{
            $body_data['contents'] = $this->load->view($this->base_template['template'], $args, TRUE);
            $this->load->view($this->base_template['container'], $body_data);
        }catch(Exception $e) {
            echo 'Caught exception, params function getContent is wrong : ',  $e->getMessage(), "\n";
        }      
    }
    
    
    public function editProfile(){
        
        $this->breadcrumb = array('Edit' => 'javascript:;');
        $params['datadb'] = $this->coredb->getUserAdministrator($this->session->userdata('sys_administrator_id'));
        $validate = TRUE;
        if( $_POST ){
            
            # check username available
            if( $this->coredb->checkAvailableUser($_POST['username'], $this->session->userdata('sys_administrator_id')) == TRUE ){
                $validate = FALSE;
                $this->messagecontroll->delivered('msg_error', 'Username already taken, please use another username');
                $this->form_validation->run();
            }
           
            if( $validate == TRUE ){   
           	    
                # use this if user only updated email
    			if( $_POST['password'] == "" && $_POST['repassword'] == ""){
    				$emptyPass = 'defaultXXX';
    				$_POST['password'] = $emptyPass;
    				$_POST['repassword']  = $emptyPass;
    			}
                
    			if( $this->form_validation->run( REG_VALIDATION.'_profile' ) !== FALSE ){
    	
                   # processing file upload
                   if( $_FILES['fileupl']['name'] !== "" ){
                       
                       # remove old file image
                       $userImage = $this->coredb->grapUserImage($this->session->userdata('sys_administrator_id'));
                       $dirPath   = $userImage[0]['image'];
                       $thumbPath = getThumbnailsImage($userImage[0]['image'], $userImage[0]['extention']);
                      
                       // remove original image
                       if(file_exists($dirPath)){unlink($dirPath);}
                       // remove thumbnails image
                       if(file_exists($thumbPath)){unlink($thumbPath);} 
                       
                       # processing file upload
                       $this->load->library('fileupload');
                       if( $this->fileupload->init($_FILES['fileupl']) !== FALSE ){
                            $_POST['image']     = $this->fileupload->path_directory;
                            $_POST['extention'] = $this->fileupload->fileExt;
                       }
                       // register session image
                       $this->session->set_userdata('sys_administrator_image', $_POST['image']);
                   }
                   
    			   # processing password
    			   if( $_POST['password'] ){
    			     
    				  if( isset($emptyPass) ){ unset($_POST['password']);   
    				  }else{
    					 $_POST['salt']     = date('ymdhis').session_id();
    					 $_POST['password'] = $this->hash_password( $_POST['password'], $_POST['salt'] );
    				  }
    				  unset($_POST['repassword']);
    			   }
    			   
                   # update data
                   $this->load->library('uidcontroll');
    			   $db_config['where'] = array('id_administrator', $this->session->userdata('sys_administrator_id'));
    			   $db_config['table'] = 'sys_administrator';
    			   $db_config['data']  =  bindProcessing($_POST);
    			   if( $this->uidcontroll->updateData($db_config) !== FALSE ){
    			        // register session username
                        $this->session->set_userdata('sys_administrator_fullname', $_POST['nickname']);
    			     	$this->session->set_flashdata('msg_success', 'Success update profile');
    					redirect( $this->root );
    			   }else{$this->messagecontroll->delivered('msg_error', 'Invalid Data to Update !');}
    			   
    			}else{ $this->messagecontroll->delivered('msg_warning', validation_errors()); }
            }
        } 
        $this->getContent($params);
    }
    
    public function editStore(){
        
        $this->breadcrumb = array('Edit' => 'javascript:;');
        $params['datadb']   = $this->coredb->getUserStore($this->session->userdata('sys_register_id'));
        if( $_POST ){
           
            if( $this->form_validation->run( REG_VALIDATION.'_store' ) !== FALSE ){
                
                # update data
                $this->load->library('uidcontroll');
                $_POST['author']    = $this->session->userdata('sys_register_id');
                $db_config['where'] = array('author', $this->session->userdata('sys_register_id'));
                $db_config['table'] = 'u_store';
                $db_config['data']  =  bindProcessing($_POST);
                if( $this->uidcontroll->updateData($db_config) !== FALSE ){
                 	$this->session->set_flashdata('msg_success', 'Success Update Login Access Data');
                	redirect( $this->root );
                }else{$this->messagecontroll->delivered('msg_error', 'Invalid Data to Update !');}
                
            }else{ $this->messagecontroll->delivered('msg_warning', validation_errors()); }
        }
        
        $this->getContent($params);
    }
    
    /**                  
    * @desc Encryption String for Password Secure
    * @params string
    * @params string
    * @return string encrypt
    */    
   	protected function hash_password($password = '', $salt = '') {
		
        $hash = sha1(md5($password).$salt);
		return $hash;
	}
}
?>