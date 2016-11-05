<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class App_manageuser extends MX_Controller {
    
    # property
    public $root;
    public $app_name            = ''; 
    public $pageTitle           = ''; 
    public $initialPage         = 'Manage Users';
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
        $this->initial_id       = $this->uri->segment(3);
        $this->initial_template = $this->uri->segment(2); 
        $this->registerValidation();
        // initial helper
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
      
    public function index(){
        
        $this->breadcrumb = array('Master Data' => 'javascript:;');  
        $this->load->library('pagination');
        $config['base_url']     = base_url(strtolower($this->app_name)).'/data';
        $config['total_rows']   = $this->coredb->getTotalUser(2);
        $config['per_page']     = 10; 
        $config['uri_segment']  = 3 ;
        $this->pagination->initialize($config);
        // result of page
        $params['result_all'] =  $config['total_rows'];
        $params['datadb'] =  $this->coredb->getAllUser(2, $config["per_page"], $this->uri->segment(3));
        $params['datadb2'] = $this->coredb->getSubsUser();
        $this->getContent($params);
	}
    
    public function add(){
     
      $params['datadb'] = $this->coredb->getUser($this->session->userdata('event_id'));
      $validate = 'true';
      if($_POST){
        
            if( $this->form_validation->run( REG_VALIDATION ) !== FALSE ){       
               
               # check username available
                if( $this->coredb->checkAvailableUser($_POST['username']) == TRUE ){
                    
                    $validate = 'false';
                    $this->messagecontroll->delivered('msg_error', 'Username already taken, please use another username');
                    $this->form_validation->run();
                }
                
                if( $validate == 'true' ){
                     
                   # default id privileges
                   $_POST['id_privileges'] = 2;
                   
                   # processing password
                   if( $_POST['password'] ){
                      $_POST['salt'] = date('ymdhis').session_id();
                      $_POST['password'] = $this->hash_password( $_POST['password'], $_POST['salt'] );
                      unset($_POST['repassword']);
                   }
                   
                   # processing file upload
                   if( $_FILES['file']['name'] !== "" )
                   {
                       $this->load->library('fileupload');
                       if( $this->fileupload->init($_FILES['file']) !== FALSE ){
                            $_POST['image']     = $this->fileupload->path_directory;
                            $_POST['extention'] = $this->fileupload->fileExt;
                       }
                   }
      
                   if( $validate !== 'false' ){
                       $this->load->library('uidcontroll');
                       if( $this->uidcontroll->insertData('sys_administrator', bindProcessing($_POST) ) !== FALSE){
                            $this->session->set_flashdata('msg_success', 'Success Save Data');
                            redirect( base_url($this->app_name) );
                       }else{$this->messagecontroll->delivered('msg_error', 'Invalid Data to Insert !');}
                   }
                }
               
            }else{ $this->messagecontroll->delivered('msg_warning', validation_errors()); } 
      }
      
      $this->getContent($params);
    }
    
    public function remove(){
        
       $this->load->library('uidcontroll');
               
        # remove image
        $userImage = $this->coredb->grapUserImage($this->initial_id);
        $dirPath   = $userImage[0]['image'];
        $thumbPath = getThumbnailsImage($userImage[0]['image'], $userImage[0]['extention']);
      
        // remove original image
        if(file_exists($dirPath)){unlink($dirPath);}
        
        // remove thumbnails image
        if(file_exists($thumbPath)){unlink($thumbPath);}    
       
        $dataRemove = array('id_administrator', $this->initial_id); 
        if( $this->uidcontroll->removeData('sys_administrator', $dataRemove) == TRUE ){

            $this->session->set_flashdata('total_data', $this->uidcontroll->totalRecord);
            $this->session->set_flashdata('msg_success', 'Success Remove Data');
       }
       redirect($this->root);
    }
    
    public function removeAll(){
       
       $this->load->library('uidcontroll');
       # remove image
       $userImage = $this->coredb->grapUserImageIn($_POST['id_table']);
       if( count($userImage) > 0 ){
            foreach($userImage as $row){
                
                $dirPath   = $row['image'];
                $thumbPath = getThumbnailsImage($row['image'], $row['extention']);
                
                // remove original image
                if(file_exists($dirPath)){unlink($dirPath);}
                
                // remove thumbnails image
                if(file_exists($thumbPath)){unlink($thumbPath);}          
            }
       }
       
       # remove data
       $dataRemove = array('id_administrator', $_POST['id_table']); 
       if( $this->uidcontroll->removeDataIn('sys_administrator', $dataRemove) == TRUE ){
            $this->session->set_flashdata('msg_success', 'Success Remove Data');
       }
       redirect($this->root);
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