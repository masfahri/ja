<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @author Raka Anggala W.S
 * @date 10/09/2015
 */ 
class App_banner extends MX_Controller {
    
    # property
    public $root;
    public $app_name            = ''; 
    public $initialPage         = 'Banner Page';
    # initial file image
    public $imgDir              = 'uploads/image/banners';
    
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
        'file/file',
        'banner/banner',
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
    
    public function generateBannerCategory(){
        
        if($_GET['page_id']){
            
            $dataBannerCategory = $this->coredb->bannerCategory($_GET['page_id']);
            if( count($dataBannerCategory ) > 0 )echo  json_encode($dataBannerCategory); else echo 0;
        }else echo 0;
    }
    
    public function generateBannerSize(){
        
        if($_GET['category_id']){
            
            $dataBannerSize = $this->coredb->bannerSize($_GET['category_id']);
            if( $dataBannerSize  !== null )echo  json_encode($dataBannerSize); else echo 0;
            
        }else echo 0;
    }
    
    public function data(){
        
        $this->load->library('pagination');
        $this->breadcrumb = array('Master Data' => 'javascript:;');  
        
        $config['base_url']     = base_url(strtolower($this->app_name)).'/data';
        $config['total_rows']   = $this->coredb->getTotalBanner();
        $config['per_page']     = 10; 
        $config['uri_segment']  = 3 ;
        $this->pagination->initialize($config);
        // result of page
        $params['result_all'] =  $config['total_rows'];
        $params['datadb'] =  $this->coredb->getBanner($x="", $config["per_page"], $this->uri->segment(3));
        
        $this->getContent($params);
    }
            
    public function add(){
        
        $this->breadcrumb = array('Master Data' => base_url($this->app_name).'/data','Add' => 'javascript:;');
        if($_POST){
            
            # ( * checking file image must be upload )
            $_POST['file_img'] = '';
            if( isset($_FILES['fileupl']) ){
                if( $_FILES['fileupl']['name'] !== "" ){
                    
                    $expl_size = explode('|', $_POST['banner_size_id']);
                    if( count($expl_size) > 0 && $_POST['banner_size_id'] !== ""){
                        $_POST['banner_size_id'] = $expl_size[1];
                        $expl_int = explode('x', $expl_size[0]);   
                    }
                    
                    list($width, $height, $type, $attr) = getimagesize($_FILES['fileupl']['tmp_name']);      
                    if( $width !=  strVal($expl_int[0]) || $height !=  strVal($expl_int[1]) ){ 
                        $this->messagecontroll->addMsg = 'Minimum file image upload must be in size ( '.$expl_size[0].' ) px';    
                    }else{ $_POST['file_img'] = 'true'; }
                }
               
            }
            # -------------------------------------------------------------------------------------
            
            if( $this->form_validation->run( REG_VALIDATION ) !== FALSE ){ 
                
                # precessing page id
                isset($_POST['page_id']) ?  $_POST['page_id'] = jsonEncodePage($_POST['page_id']) : ''; 
                # -------------------------------------------------------------------------------------
                     
                # processing file upload
                $parsingImage = array(
                'resize'    => false,
                'size'      => '', 
                'files'     => $_FILES['fileupl'],
                'directory' => $this->imgDir
                );
                isset($_FILES['fileupl']) ? uploadFile($parsingImage) : '';                 
                # -------------------------------------------------------------------------------------
                
                # record database    
                $this->load->library('uidcontroll');
                
                unset($_POST['file_img']);
                $_POST['author']    = $this->session->userdata("sys_administrator_id");
                
                if( $this->uidcontroll->insertData('banner', bindProcessing($_POST) ) !== FALSE){
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
            
            # processing banner size
            if( isset($_POST['banner_size_id']) ){
                if( $_POST['banner_size_id'] !== "" ){
                    
                    $expl_size = explode('|', $_POST['banner_size_id']);
                    if( count($expl_size) > 0 ){
                        $_POST['banner_size_id'] = $expl_size[1];
                        $expl_int = explode('x', $expl_size[0]);   
                    }
                   
                    $imgConfig = array('width' => strVal($expl_int[0]),'height' => strVal($expl_int[1]));
                      
                }
            }
            # -----------------------------------------------------------------------------------
            
            # ( * checking file image must be upload )
            $_POST['file_img'] = 'true';
            if( isset($_FILES['fileupl']) ){
                
                if( $_FILES['fileupl']['name'] !== "" ){
                   list($width, $height, $type, $attr) = getimagesize($_FILES['fileupl']['tmp_name']);      
                    if( $width !=  strVal($expl_int[0]) || $height !=  strVal($expl_int[1]) ){ 
                        $this->messagecontroll->addMsg = 'Minimum file image upload must be in size ( '.$expl_size[0].' ) px';    
                    }else{ $_POST['file_img'] = 'true'; }
                }
            }
            # -------------------------------------------------------------------------------------
            
            if( $this->form_validation->run( REG_VALIDATION ) !== FALSE ){ 
                
                # precessing page id
                isset($_POST['page_id']) ?  $_POST['page_id'] = jsonEncodePage($_POST['page_id']) : ''; 
                # -------------------------------------------------------------------------------------
                  
                # processing file upload if file not empty
                if( $_FILES['fileupl']['name'] !== "" ){
                  
                    # remove old file image
                    $dataImage   = $this->coredb->grapImage($this->initial_id);
                    $dirPath     = $dataImage['file'];
                    $thumbPath   = getThumbnailsImage($dataImage['file'], $dataImage['extention']);
                    // remove original image
                    if(file_exists($dirPath)){unlink($dirPath);}
                    // remove thumbnails image
                    if(file_exists($thumbPath)){unlink($thumbPath);} 
                    
                    # processing file upload
                    $parsingImage = array(
                    'resize'    => false,
                    'size'      => $imgConfig, 
                    'files'     => $_FILES['fileupl'],
                    'directory' => $this->imgDir
                    );
                    uploadFile($parsingImage);      
               }
               # -------------------------------------------------------------------------------------
               
               # update data
               $this->load->library('uidcontroll');  
               unset($_POST['file_img']);
               $_POST['author'] = $this->session->userdata("sys_administrator_id");
                       
    		   $db_config['where'] = array('banner_id', $this->initial_id);
    		   $db_config['table'] = 'banner';
    		   $db_config['data']  =  bindProcessing($_POST);
               if( $this->uidcontroll->updateData( $db_config ) !== FALSE ){
    		     
                    $this->session->set_flashdata('msg_success', 'Success Update Data');
    				redirect( $this->root, 'refresh' );
    		   }
                
            }else{ $this->messagecontroll->delivered('msg_warning', validation_errors()); } 
        }
        $params['datadb'] =  $this->coredb->getBanner($this->initial_id);
       
        $this->getContent($params);  
    }
    
    public function remove(){
        
        $this->load->library('uidcontroll');  
       # remove image
        $dataImage = $this->coredb->grapImage($this->initial_id);
        $dirPath   = $dataImage['file'];
        $thumbPath = getThumbnailsImage($dataImage['file'], $dataImage['extention']);
      
        // remove original image
        if(file_exists($dirPath)){unlink($dirPath);}
        
        // remove thumbnails image
        if(file_exists($thumbPath)){unlink($thumbPath);}    
        
        $dataRemove = array('banner_id', $this->initial_id); 
        if( $this->uidcontroll->removeData('banner', $dataRemove) == TRUE ){
            $this->session->set_flashdata('msg_success', 'Success Remove Data Banner');
       }
       
       redirect($this->root);
    }
    
    public function removeAll(){
       
       $this->load->library('uidcontroll');
       
       # remove image
       $dataImage = $this->coredb->grapImageIn($_POST['id_table']);
       if( count($dataImage) > 0 ){
            foreach($dataImage as $row){
                
                $dirPath   = $row['file'];
                $thumbPath = getThumbnailsImage($row['file'], $row['extention']);
                
                // remove original image
                if(file_exists($dirPath)){unlink($dirPath);}
                
                // remove thumbnails image
                if(file_exists($thumbPath)){unlink($thumbPath);}          
            }
       }
       
       $dataRemove = array('banner_id', $_POST['id_table']); 
       if( $this->uidcontroll->removeDataIn('banner', $dataRemove) == TRUE ){
            $this->session->set_flashdata('msg_success', 'Success Remove Data');
       }
       redirect($this->root);
    }
}
?>