<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class App_event extends MX_Controller {
    
    # property
    public $root;
    public $app_name            = ''; 
    public $pageTitle           = ''; 
    public $initialPage         = 'Events';
    # initial file image
    public $imgDir              = 'uploads/event';
    public $initial_id;
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
      
        $params['datadb']     =  $this->coredb->bindDataPage(1);        
        $this->getContent($params);
	}

    public function add(){
        $params['datadb2'] = $this->coredb->getEvent($this->session->userdata('event_id'));
        
        if( $_POST ){
            
             
                        
            
             if( $this->form_validation->run(REG_VALIDATION) !== FALSE ){

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
             
             
               # processing file upload
               if( $_FILES['file2']['name'] !== "" )
               {
                   $this->load->library('fileupload');
                   $this->fileupload->path_directory = $this->imgDir;
                   if( $this->fileupload->init($_FILES['file2']) !== FALSE ){
                        $_POST['file2']     = $this->fileupload->path_directory;
                        $_POST['extension2'] = $this->fileupload->fileExt;
                   }
               }
             # ------------------------------------------------------------------------------------- 
             # 
               # processing file upload
               if( $_FILES['file3']['name'] !== "" )
               {
                   $this->load->library('fileupload');
                   $this->fileupload->path_directory = $this->imgDir;
                   if( $this->fileupload->init($_FILES['file3']) !== FALSE ){
                        $_POST['file3']     = $this->fileupload->path_directory;
                        $_POST['extension3'] = $this->fileupload->fileExt;
                   }
               }
             # -------------------------------------------------------------------------------------               
            
                # record database    
                $this->load->library('uidcontroll');
                if( $this->uidcontroll->insertData('page_event', bindProcessing($_POST) ) !== FALSE){
                    
                    $this->session->set_flashdata('msg_success', 'Success Save Data');  
                    redirect( base_url($this->app_name) );
                
                }else{$this->session->set_flashdata('msg_success', 'Invalid Data to Save !');}
                

            }else{ $this->messagecontroll->delivered('msg_warning', validation_errors()); } 
        }
        $this->getContent($params);       
        
    }

    public function edit(){
         
        if( $_POST ){

             # ( * checking file image Event for home must be upload )
             $_POST['file'] = 'true';       
            
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
             
             
               # processing file upload
               if( $_FILES['file2']['name'] !== "" )
               {
                   $this->load->library('fileupload');
                   $this->fileupload->path_directory = $this->imgDir;
                   if( $this->fileupload->init($_FILES['file2']) !== FALSE ){
                        $_POST['file2']     = $this->fileupload->path_directory;
                        $_POST['extension2'] = $this->fileupload->fileExt;
                   }
               }
             # -------------------------------------------------------------------------------------
             # 
               # processing file upload
               if( $_FILES['file3']['name'] !== "" )
               {
                   $this->load->library('fileupload');
                   $this->fileupload->path_directory = $this->imgDir;
                   if( $this->fileupload->init($_FILES['file3']) !== FALSE ){
                        $_POST['file3']     = $this->fileupload->path_directory;
                        $_POST['extension3'] = $this->fileupload->fileExt;
                   }
               }
             # ------------------------------------------------------------------------------------- 
                
               # update data
               $this->load->library('uidcontroll');
               $db_config['where'] = array('event_id', $this->initial_id);
               $db_config['table'] = 'page_event';
               $db_config['data']  =  bindProcessing($_POST);
               if( $this->uidcontroll->updateData( $db_config ) !== FALSE ){

                    $this->session->set_flashdata('msg_success', 'Success Update Data');
                    redirect( base_url($this->app_name) );
                    
               }else{$this->messagecontroll->delivered('msg_error', 'Invalid Data to Update !');}    
                
            }else{ $this->messagecontroll->delivered('msg_warning', validation_errors()); }   
        }
        
        $params['datadb'] =  $this->coredb->getEvent($this->initial_id);

        $this->getContent($params);  
    }
    
    
    public function remove(){

        $this->load->library('uidcontroll');  
        # remove all image
        $getFile          = $this->coredb->grapImage($this->initial_id);
        if( $getFile[0]['file'] == 'image' ){
            
            $dirPath        = $getFile[0]['file'];
            $thumbPath      = getThumbnailsImage($getFile[0]['file'], $getFile[0]['extention']);
          
            // remove original image
            if(file_exists($dirPath)){unlink($dirPath);}
            // remove thumbnails image
            if(file_exists($thumbPath)){unlink($thumbPath);} 
        }

        $dataRemove = array('event_id', $this->initial_id); 
        if( $this->uidcontroll->removeData('page_event', $dataRemove) == TRUE ){

            $this->session->set_flashdata('total_data', $this->uidcontroll->totalRecord);
            $this->session->set_flashdata('msg_success', 'Success Remove Data Gallery');
       }
        redirect(base_url($this->app_name));
        

    } 
}
?>