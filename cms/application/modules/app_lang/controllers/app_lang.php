<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class App_lang extends MX_Controller {
    
    # property
    public $root;
    public $app_name            = ''; 
    public $pageTitle           = ''; 
    public $initialPage         = 'Language Preferences';
    # initial file image
    public $imgWidth            = 18;
    public $imgHeight           = 12;
    public $imgDir              = 'uploads/image/lang';
    
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
        # search keyword
        if( isset($_POST['key']) ){
            if( $_POST['key'] !== "" ){
               $this->messagecontroll->delivered('msg_success', 'Search Keywords "'.$_POST['key'].'"'); 
            }else{
              $this->messagecontroll->delivered('msg_warning', 'Search Keywords cannot be empty !');
            }
        }
        # ---------------
      
        $this->load->library('pagination');
        $config['base_url']     = base_url(strtolower($this->app_name)).'/data';
        $config['total_rows']   = $this->coredb->getTotalCountries();
        $config['per_page']     = 10; 
        $config['uri_segment']  = 3 ;
        $this->pagination->initialize($config);
        // result of page
        $params['result_all'] =  $config['total_rows'];
        $params['datadb'] =  $this->coredb->getAllCountries($x="", $config["per_page"], $this->uri->segment(3));
        
        $this->getContent($params);
    }
      
    public function add(){
        
        $this->breadcrumb = array('Master Data' => base_url($this->app_name).'/data','Add' => 'javascript:;');
        if($_POST){
            
            // check register countries_idx
            $_POST['countries_idx'] = strtoupper($_POST['countries_idx']);
            if( $_POST['countries_idx'] ){
                
                if( $this->coredb->checkCountriesIdx($_POST['countries_idx']) == TRUE){
                    $this->session->set_flashdata('msg_error', 'Countries IDX is registerd, please use another unique input');
                    redirect($this->root);   
                }
            }
            
            // check uploaded file
            $_POST['file'] = 'true'; 
            if( $_FILES['fileupl']['name'] !== "" ){

                # check minimum width and height
                list($width, $height, $type, $attr) = getimagesize($_FILES['fileupl']['tmp_name']);
                if( $width != $this->imgWidth || $height != $this->imgHeight ){
                    $this->session->set_flashdata('msg_error', 'Primary images must be in size '.$this->imgWidth.' x '.$this->imgHeight);  
                    redirect($this->root);   
                }
            
            }else{
               
                $_POST['file'] = '';
                $this->messagecontroll->delivered('msg_error', 'File image cannot be empty');
                $this->form_validation->run();                
            }
            
          
            if( $this->form_validation->run( REG_VALIDATION ) !== FALSE ){ 
                
                # processing file upload
                $this->load->library('fileupload');
                $this->fileupload->path_directory = $this->imgDir;
                if( $this->fileupload->init($_FILES['fileupl']) !== FALSE ){
                    $_POST['file'] = $this->fileupload->path_directory;
                    $_POST['extention'] = $this->fileupload->fileExt;
                } 
              
                # record database    
                $this->load->library('uidcontroll');
                if( $this->uidcontroll->insertData('countries', bindProcessing($_POST) ) !== FALSE){
                    $this->session->set_flashdata('msg_success', 'Success Save Data');  
                }else{$this->session->set_flashdata('msg_success', 'Invalid Data to Save !');}
                redirect($this->root, 'refresh');
                 
            }else{ $this->messagecontroll->delivered('msg_warning', validation_errors()); } 
        }
        $this->getContent();
    } 
    
    public function edit(){
        
        $this->breadcrumb = array('Master Data' => base_url($this->app_name).'/data','Edit' => 'javascript:;');         
        if( $_POST ){
            
            // check register countries_idx
            $_POST['countries_idx'] = strtoupper($_POST['countries_idx']);
            if( $_POST['countries_idx'] ){
                
                if( $this->coredb->checkCountriesIdx($_POST['countries_idx'], $this->initial_id) == TRUE){
                   
                    $this->session->set_flashdata('msg_error', 'Countries IDX is registerd, please use another unique input');
                    redirect($this->root);   
                }
            }
           
           // check uploaded file 
           $_POST['file'] = 'true';
           if( $_FILES['fileupl']['name'] !== "" ){

                # check minimum width and height
                list($width, $height, $type, $attr) = getimagesize($_FILES['fileupl']['tmp_name']);
                if( $width != $this->imgWidth || $height != $this->imgHeight ){
                    $this->session->set_flashdata('msg_error', 'Primary images must be in size '.$this->imgWidth.' x '.$this->imgHeight);  
                    redirect($this->root);   
                }  
           }
           
           if( $this->form_validation->run( REG_VALIDATION ) !== FALSE ){ 
              
               # processing file upload if file not empty
               $this->load->library('fileupload');
               $this->fileupload->path_directory = $this->imgDir;
               if( $_FILES['fileupl']['name'] !== "" ){
                  
                    # remove old file image
                    $masterImage    =  $this->coredb->grapImage($this->initial_id);
                    $dirPath        = $masterImage['file'];
                    $thumbPath      = getThumbnailsImage($masterImage['file'], $masterImage['extention']);
                    // remove original image
                    if(file_exists($dirPath)){unlink($dirPath);}
                    // remove thumbnails image
                    if(file_exists($thumbPath)){unlink($thumbPath);} 
                    
                    if( $this->fileupload->init($_FILES['fileupl']) !== FALSE ){
                        $_POST['file']     = $this->fileupload->path_directory;
                        $_POST['extention'] = $this->fileupload->fileExt;
                    }
                    
               }else{ unset($_POST['file']); }
               
               # update data
               $this->load->library('uidcontroll');
    		   $db_config['where'] = array('countries_id', $this->initial_id);
    		   $db_config['table'] = 'countries';
    		   $db_config['data']  =  bindProcessing($_POST);
               if( $this->uidcontroll->updateData( $db_config ) !== FALSE ){
    		     	$this->session->set_flashdata('msg_success', 'Success Update Data');
    				redirect( $this->root );
                    
    		   }else{$this->messagecontroll->delivered('msg_error', 'Invalid Data to Update !');}
                
           }else{ $this->messagecontroll->delivered('msg_warning', validation_errors()); }    
        }
        
        $params['datadb'] =  $this->coredb->getAllCountries($this->initial_id);
        $this->getContent($params);  
    }

    public function remove(){
        
        $this->load->library('uidcontroll');  
        # remove all image
        $masterImage    = $this->coredb->grapImage($this->initial_id);
        $dirPath        = $masterImage['file'];
        $thumbPath      = getThumbnailsImage($masterImage['file'], $masterImage['extention']);
        // remove original image
        if(file_exists($dirPath)){unlink($dirPath);}
        // remove thumbnails image
        if(file_exists($thumbPath)){unlink($thumbPath);} 
          
        $dataRemove = array('countries_id', $this->initial_id); 
        if( $this->uidcontroll->removeData('countries', $dataRemove) == TRUE ){

            $this->session->set_flashdata('total_data', $this->uidcontroll->totalRecord);
            $this->session->set_flashdata('msg_success', 'Success Remove Data');
       }
       redirect($this->root);
    }
    
    public function removeAll(){
       
       $this->load->library('uidcontroll');
      
       # remove all image
       $masterImage   = $this->coredb->grapImageIn($_POST['id_table']);
       if( count($masterImage) > 0 ){
            foreach($masterImage as $row){
                
               $dirPath        = $row['file'];
               $thumbPath      = getThumbnailsImage($row['file'], $row['extention']);
               // remove original image
               if(file_exists($dirPath)){unlink($dirPath);}
               // remove thumbnails image
               if(file_exists($thumbPath)){unlink($thumbPath);} 
            }
       }
       
       $dataRemove = array('countries_id', $_POST['id_table']); 
       if( $this->uidcontroll->removeDataIn('countries', $dataRemove) == TRUE ){
            $this->session->set_flashdata('msg_success', 'Success Remove Data');
       }
       redirect($this->root);
    }
}
?>