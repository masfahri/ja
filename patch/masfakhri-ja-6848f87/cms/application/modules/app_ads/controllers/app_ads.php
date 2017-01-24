<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @author Raka Anggala W.S
 * @date 10/09/2015
 */ 
class App_ads extends MX_Controller {
    
    # property
    public $root;
    public $app_name            = ''; 
    public $initialPage         = 'Ads Page';
    # initial file image
    public $imgDir              = 'uploads/image/ads';
    
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
        'file/file'
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
    
    public function generateBannerCategory(){
        
        if($_GET['page_id']){
            
            $dataBannerCategory = $this->coredb->bannerCategory($_GET['page_id']);
            if( count($dataBannerCategory ) > 0 )echo  json_encode($dataBannerCategory); else echo 0;
        }else echo 0;
    }
    
    public function generatePlace(){
        
        if($_GET['ads_place_id']){
            
            $dataBannerSize = $this->coredb->Place($_GET['ads_place_id']);
            if( $dataBannerSize  !== null )echo  json_encode($dataBannerSize); else echo 0;
            
        }else echo 0;
    }
    
    public function index(){
        
        $params['datadb'] =  $this->coredb->getAds();
        
        $this->getContent($params);
    }
            
    public function add(){
        $params['datadb'] = $this->coredb->getAds($this->session->userdata('ads_id'));       
        if( $_POST ){
             
            
             if( $this->form_validation->run(REG_VALIDATION) !== FALSE ){

            
               # processing file upload
               if( $_FILES['file']['name'] !== "" )
               {
                   $this->load->library('fileupload');
                   $this->fileupload->path_directory = $this->imgDir;
                   if( $this->fileupload->init($_FILES['file']) !== FALSE ){
                        $_POST['file']     = $this->fileupload->path_directory;
                        $_POST['extension'] = $this->fileupload->fileExt;
                   }
               }
             # -------------------------------------------------------------------------------------

                # record database    
                $this->load->library('uidcontroll');
                if( $this->uidcontroll->insertData('ads', bindProcessing($_POST) ) !== FALSE){
                    
                    $this->session->set_flashdata('msg_success', 'Success Save Data');  
                    redirect( base_url($this->app_name) );
                
                }else{$this->session->set_flashdata('msg_success', 'Invalid Data to Save !');}
                

            }else{ $this->messagecontroll->delivered('msg_warning', validation_errors()); } 
        }
        $this->getContent($params);  
    } 
    
    public function edit(){
         
        if( $_POST ){
            
            if( $this->form_validation->run( REG_VALIDATION ) !== FALSE ){
               
               # processing file upload
               if( $_FILES['file']['name'] !== "" )
               {
                   $this->load->library('fileupload');
                   $this->fileupload->path_directory = $this->imgDir;
                   if( $this->fileupload->init($_FILES['file']) !== FALSE ){
                        $_POST['file']     = $this->fileupload->path_directory;
                        $_POST['extension'] = $this->fileupload->fileExt;
                   }
               }
             # -------------------------------------------------------------------------------------
             
                
               # update data
               $this->load->library('uidcontroll');
               $db_config['where'] = array('ads_id', $this->initial_id);
               $db_config['table'] = 'ads';
               $db_config['data']  =  bindProcessing($_POST);
               if( $this->uidcontroll->updateData( $db_config ) !== FALSE ){

                    $this->session->set_flashdata('msg_success', 'Success Update Data');
                    redirect( base_url($this->app_name) );
                    
               }else{$this->messagecontroll->delivered('msg_error', 'Invalid Data to Update !');}    
                
            }else{ $this->messagecontroll->delivered('msg_warning', validation_errors()); }   
        }
        
        $params['datadb'] =  $this->coredb->getAds($this->initial_id);

        $this->getContent($params);  
    }    

    
    public function remove(){


        $this->load->library('uidcontroll');  
        # remove all image
        $getFile          = $this->coredb->grapImage($this->initial_id);
        if( $getFile['file'] == $getFile['file'] ){
            
            $dirPath        = $getFile['file'];
            $thumbPath      = getThumbnailsImage($getFile['file'], $getFile['extension']);
          
            // remove original image
            if(file_exists($dirPath)){unlink($dirPath);}
            // remove thumbnails image
            if(file_exists($thumbPath)){unlink($thumbPath);} 
        }

        $dataRemove = array('ads_id', $this->initial_id); 
        if( $this->uidcontroll->removeData('ads', $dataRemove) == TRUE ){

            $this->session->set_flashdata('total_data', $this->uidcontroll->totalRecord);
            $this->session->set_flashdata('msg_success', 'Success Remove Data');
       }
        redirect(base_url($this->app_name));

    } 
}
?>