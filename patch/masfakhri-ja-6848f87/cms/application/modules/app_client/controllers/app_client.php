<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class App_client extends MX_Controller {
    
    # property
    public $root;
    public $app_name            = ''; 
    public $pageTitle           = ''; 
    public $initialPage         = 'Client / Pathners';
    # initial file image
    public $imgDir              = 'uploads/image/client';
   
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
        $this->load->helper( array(
        'blog/blog',
        'image/image',
        'product/product'
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
    
    public function data(){
        
        $this->breadcrumb = array('Master Data' => 'javascript:;');  
        $this->load->library('pagination');
        $config['base_url']     = base_url(strtolower($this->app_name)).'/data';
        $config['total_rows']   = $this->coredb->getTotalClient();
        $config['per_page']     = 10; 
        $config['uri_segment']  = 3 ;
        $this->pagination->initialize($config);
        // result of page
        $params['result_all'] =  $config['total_rows'];
        $params['datadb']     =  $this->coredb->getClient($product_id="", $config["per_page"], $this->uri->segment(3));
        
        //echo '<pre>'.print_r($params['datadb'], true).'</pre>'; exit;
        $this->getContent($params);
    }
   
    public function add(){
        
        $this->breadcrumb = array('Master Data' => base_url($this->app_name).'/data','Add' => 'javascript:;');
        $msg = '';
        if($_POST){
            
            if( isset($_FILES['fileupl']) ){
                
                if( $_FILES['fileupl']['name'] !== "" ){
                    
                    # check minimum width and height
                    list($width, $height, $type, $attr) = getimagesize($_FILES['fileupl']['tmp_name']);      
                    if( $width <  config_item('img_client')['width'] || $height < config_item('img_client')['height'] ){ 
                        $msg .= 'Minimum file images must be in size '.config_item('img_client')['width'].' x '.config_item('img_client')['height'];     
                    }
                    
                }else{$msg = 'Image must be upload';}
           }
            
            if( $this->form_validation->run( REG_VALIDATION ) !== FALSE && $msg  == '' ){    
                
                # processing file upload
                $this->load->library('fileupload');
                $this->fileupload->path_directory = $this->imgDir;
                if( $this->fileupload->init($_FILES['fileupl']) !== FALSE ){
                      
                    $_POST['file']      = $this->fileupload->path_directory;
                    $_POST['extention'] = $this->fileupload->fileExt;
                }              
                # -------------------------------------------------------------------------------------
                
                $_POST['author'] = $this->session->userdata('sys_administrator_id');
                $this->load->library('uidcontroll');
                if( $this->uidcontroll->insertData('client', bindProcessing($_POST) ) !== FALSE){
                    $this->session->set_flashdata('msg_success', 'Success Save Data');
                    redirect($this->root);
                }else{$this->messagecontroll->delivered('msg_error', 'Invalid Data to Insert !');}   
                
            }else{ $this->messagecontroll->delivered('msg_warning', $msg.validation_errors()); }
        }
        
        $this->getContent();
    } 
    
    public function edit(){
        
        $msg  = '';
        $this->breadcrumb = array('Master Data' => base_url($this->app_name).'/data','Edit' => 'javascript:;');  
        if( $_POST ){
            
            if( isset($_FILES['fileupl']) ){
                
                if( $_FILES['fileupl']['name'] !== "" ){
                    
                    # check minimum width and height
                    list($width, $height, $type, $attr) = getimagesize($_FILES['fileupl']['tmp_name']);      
                    if( $width <  config_item('img_client')['width'] || $height <  config_item('img_client')['height'] ){ 
                        $msg .= 'Minimum file images must be in size '.config_item('img_client')['width'].' x '.config_item('img_client')['height'];     
                    }   
                }
           }
            
            if( $this->form_validation->run( REG_VALIDATION ) !== FALSE && $msg == ""){
             
               # processing file upload
               if( $_FILES['fileupl']['name'] !== "" ){
                   
                   # remove old file image
                   $image = $this->coredb->grapImage($this->initial_id);
                   $dirPath   = $image[0]['file'];
                   $thumbPath = getThumbnailsImage($image[0]['file'], $userImage[0]['extention']);
                  
                   // remove original image
                   if(file_exists($dirPath)){unlink($dirPath);}
                   // remove thumbnails image
                   if(file_exists($thumbPath)){unlink($thumbPath);} 
                   
                   # processing file upload
                   $this->load->library('fileupload');
                   $this->fileupload->path_directory = $this->imgDir;
                   if( $this->fileupload->init($_FILES['fileupl']) !== FALSE ){
                          
                        $_POST['file']      = $this->fileupload->path_directory;
                        $_POST['extention'] = $this->fileupload->fileExt;
                   }  
               }
             
               # update data
               $this->load->library('uidcontroll');
               $_POST['author'] = $this->session->userdata('sys_administrator_id');
             
    		   $db_config['where'] = array('client_id', $this->initial_id);
    		   $db_config['table'] = 'client';
    		   $db_config['data']  =  bindProcessing($_POST);
               if( $this->uidcontroll->updateData( $db_config ) !== FALSE ){
 
                    $this->session->set_flashdata('msg_success', 'Success Update Data');
    				redirect( $this->root );
                    
    		   }else{$this->messagecontroll->delivered('msg_error', 'Invalid Data to Update !');}    
                
            }else{ $this->messagecontroll->delivered('msg_warning', $msg.validation_errors()); }   
        }
        
        $params['datadb'] =  $this->coredb->getProduct($this->initial_id);
        $this->getContent($params);  
    }
    
   
    public function remove(){
        
        $this->load->library('uidcontroll');  
        
        # remove old file image
        $image = $this->coredb->grapImage($this->initial_id);
        $dirPath   = $image[0]['file'];
        $thumbPath = getThumbnailsImage($image[0]['file'], $image[0]['extention']);
        
        // remove original image
        if(file_exists($dirPath)){unlink($dirPath);}
        // remove thumbnails image
        if(file_exists($thumbPath)){unlink($thumbPath);} 
        
        $dataRemove = array('client_id', $this->initial_id); 
        if( $this->uidcontroll->removeData('client', $dataRemove) == TRUE ){
            $this->session->set_flashdata('msg_success', 'Success Remove Data Banner');
        }
        redirect(base_url($this->app_name).'/data');
    }
    
    public function removeAll(){
       
       $this->load->library('uidcontroll');
       
       # remove all image
       $image = $this->coredb->grapImageIn($_POST['id_table']);
       if( count($image) > 0 ){
            foreach($image as $row){
                
               $dirPath        = $row['file'];
               $thumbPath      = getThumbnailsImage($row['file'], $row['extention']);
               // remove original image
               if(file_exists($dirPath)){unlink($dirPath);}
               // remove thumbnails image
               if(file_exists($thumbPath)){unlink($thumbPath);} 
            }
       }
       
       
       $dataRemove = array('client_id', $_POST['id_table']); 
       if( $this->uidcontroll->removeDataIn('client', $dataRemove) == TRUE ){
            $this->session->set_flashdata('msg_success', 'Success Remove Data');
       }
      redirect(base_url($this->app_name).'/data');
    }
}
?>