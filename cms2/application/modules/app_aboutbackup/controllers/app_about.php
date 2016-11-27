<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class App_about extends MX_Controller {
    
    # property
    public $root;
    public $app_name            = ''; 
    public $pageTitle           = ''; 
    public $initialPage         = 'About';
    
    # initial file image
    public $imgDir              = 'uploads/image/about';
  
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
       // initial helper
       $this->load->helper( array(  
        'image/image'
       ));    
    }
    
    protected function init(){
        
        isset($_SERVER['HTTP_REFERER']) ? $this->root = $_SERVER['HTTP_REFERER'] : '';  
        $this->app_name         = strtolower( __CLASS__ ); 
        $this->initial_id       = $this->uri->segment(3);
        $this->initial_template = $this->uri->segment(2); 
        $this->registerValidation();
        
        // initial helper
        $this->load->helper( array(
        'file/file'));
    }
    
    public function registerValidation(){
        
         define("REG_VALIDATION", strtolower( __CLASS__ ));
         define("REG_VALIDATION2", strtolower( __CLASS__ ).'2');
         define("REG_VALIDATION3", strtolower( __CLASS__ ).'3');
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
        $params['datadb'] =  $this->coredb->getOfficers();
        $params['datadb2'] =  $this->coredb->bindDataPage(3);
        $msg = '';
        if( $_POST ){
            
            
             if( $this->form_validation->run(REG_VALIDATION) !== FALSE ){
               
                # record database    
                $this->load->library('uidcontroll');
                if( $this->uidcontroll->insertData('page_about', bindProcessing($_POST) ) !== FALSE){
                    
                    $this->session->set_flashdata('msg_success', 'Success Save Data');  
                    redirect( base_url($this->app_name) );
                
                }else{$this->session->set_flashdata('msg_success', 'Invalid Data to Save !');}
                

            }else{ $this->messagecontroll->delivered('msg_warning', validation_errors()); } 
        }
        $this->getContent($params);  
    }

    public function officersAdd(){  
        $params['datadb'] =  $this->coredb->getOfficersbyId($this->session->userdata('id')); 
        if( $_POST ){
             
            
             if( $this->form_validation->run(REG_VALIDATION2) !== FALSE ){

            
               # processing file upload
               if( $_FILES['file']['name'] !== "" )
               {
                   $this->load->library('fileupload');
                   $this->fileupload->path_directory = $this->imgDir;
                   if( $this->fileupload->init($_FILES['file']) !== FALSE ){
                        $_POST['file']     = $this->fileupload->path_directory;
                        $_POST['extention'] = $this->fileupload->fileExt;
                   }
               }
             # -------------------------------------------------------------------------------------

                # record database    
                $this->load->library('uidcontroll');
                if( $this->uidcontroll->insertData('officer', bindProcessing($_POST) ) !== FALSE){
                    
                    $this->session->set_flashdata('msg_success', 'Success Save Data');  
                    redirect( base_url($this->app_name) );
                
                }else{$this->session->set_flashdata('msg_success', 'Invalid Data to Save !');}
                

            }else{ $this->messagecontroll->delivered('msg_warning', validation_errors()); } 
        }
        $this->getContent($params);  
    }

    public function officersEdit(){
        $params['datadb'] =  $this->coredb->getOfficersbyId($this->session->userdata('id'));        
        if( $_POST ){
            
            if( $this->form_validation->run( REG_VALIDATION ) !== FALSE ){
               
               # processing file upload
               if( $_FILES['file']['name'] !== "" )
               {
                   $this->load->library('fileupload');
                   $this->fileupload->path_directory = $this->imgDir;
                   if( $this->fileupload->init($_FILES['file']) !== FALSE ){
                        $_POST['file']     = $this->fileupload->path_directory;
                        $_POST['extention'] = $this->fileupload->fileExt;
                   }
               }
             # -------------------------------------------------------------------------------------
             
                
               # update data
               $this->load->library('uidcontroll');
               $db_config['where'] = array('id', $this->initial_id);
               $db_config['table'] = 'officer';
               $db_config['data']  =  bindProcessing($_POST);
               if( $this->uidcontroll->updateData( $db_config ) !== FALSE ){

                    $this->session->set_flashdata('msg_success', 'Success Update Data');
                    redirect( base_url($this->app_name) );
                    
               }else{$this->messagecontroll->delivered('msg_error', 'Invalid Data to Update !');}    
                
            }else{ $this->messagecontroll->delivered('msg_warning', validation_errors()); }   
        }

        $this->getContent($params);
    }    

    public function sponsors(){
        $params['datadb'] =  $this->coredb->bindDataSetup(1);
        $params['datadb2'] = $this->coredb->bindDataPage();
        $msg = '';
        if( $_POST ){
            
             # ( * checking file image LOGO must be upload )
             $_POST['file_img'] = 'true';
             if( isset($_FILES['fileupl']) ){
                if( $_FILES['fileupl']['name'] !== "" ){
                          
                   # check minimum width and height
                    list($width, $height, $type, $attr) = getimagesize($_FILES['fileupl']['tmp_name']);      
                    if( $width <  config_item('web_logo')['width'] || $height <  config_item('web_logo')['height'] ){ 
                        $msg .= 'Minimum file images must be in size '.config_item('web_logo')['width'].' x '.config_item('web_logo')['height'];     
                    }
                    
                }
             }
             # -------------------------------------------------------------------------------------
             
             
             # ( * checking file image FAVICON must be upload )
             if( isset($_FILES['fileico']) ){
                
                if( $_FILES['fileico']['name'] !== "" ){
                          
                   # check minimum width and height
                    list($width, $height, $type, $attr) = getimagesize($_FILES['fileico']['tmp_name']);      
                    if( $width <  config_item('web_favicon')['width'] || $height <  config_item('web_favicon')['height'] ){ 
                        $msg .= 'Minimum file images must be in size '.config_item('web_favicon')['width'].' x '.config_item('web_favicon')['height'];     
                    }
                    
                }
             }
             # -------------------------------------------------------------------------------------
            
             if( $this->form_validation->run(REG_VALIDATION3) !== FALSE ){
               
                # processing file upload LOGO if file not empty
                if( $_FILES['fileupl']['name'] !== "" ){
                  
                    # remove old file image
                    $dataImage   = $this->coredb->grapImage();
                    $dirPath     = $dataImage['file'];
                    $thumbPath   = getThumbnailsImage($dataImage['file'], $dataImage['extention']);
                    // remove original image
                    if(file_exists($dirPath)){unlink($dirPath);}
                    // remove thumbnails image
                    if(file_exists($thumbPath)){unlink($thumbPath);} 
                    
                    # processing file upload
                    $parsingImage = array(
                    'resize'    => true,
                    'size'      => '', 
                    'files'     => $_FILES['fileupl'],
                    'directory' => $this->imgDir
                    );
                    uploadFile($parsingImage);      
               }
               # -------------------------------------------------------------------------------------
               
               # processing file upload FAVICON if file not empty
                if( $_FILES['fileico']['name'] !== "" ){
                 
                   # remove old file image
                    $dataImage   = $this->coredb->grapImage();
                    $dirPath     = $dataImage['favicon'];
                    // remove original image
                    if(file_exists($dirPath)){unlink($dirPath);}
                   
                    # processing file upload
                    $parsingImage = array(
                    'resize'    => true,
                    'post'      => 'favicon',
                    'size'      => '', 
                    'files'     => $_FILES['fileico'],
                    'directory' => $this->imgDir
                    );
                    uploadFile($parsingImage);    
               }
               # -------------------------------------------------------------------------------------
              
               unset($_POST['file_img']);
               # record database    
               $this->load->library('uidcontroll');
               $db_update['where'] = array('web_setup_id',1);
               $db_update['table'] = 'web_setup';
               $db_update['data']  =  bindProcessing($_POST);
               
               if( $this->uidcontroll->updateData($db_update) !== FALSE){
                
                    $this->session->set_flashdata('msg_success', 'Success Update Data');
                    redirect($this->root, 'refresh');
               }else{$this->messagecontroll->delivered('msg_error', 'Invalid Data to Update !');}
                
            }else{$this->messagecontroll->delivered('msg_warning', validation_errors()); } 
        }
        
        $params['datadb_lang']  =  $this->coredb->getDataLang();
        $this->getContent($params);
    }
        
}
?>