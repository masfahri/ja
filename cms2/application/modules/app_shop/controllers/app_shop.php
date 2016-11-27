<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class App_shop extends MX_Controller {
    
    # property
    public $root;
    public $app_name            = ''; 
    public $pageTitle           = ''; 
    public $initialPage         = 'Product Items';
    # initial file image
    public $imgDir              = 'uploads/image/product';
   
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
        define("REG_VALIDATION2", strtolower( __CLASS__ ).'Cat');
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
        
        $params['datadb']     =  $this->coredb->getAllProduct();
        $params['page_desc'] = $this->coredb->getDesc(1);
        if( $_POST ){     

               # update data
               $this->load->library('uidcontroll');
               $db_config['where'] = array('id', '1');
               $db_config['table'] = 'get_shop';
               $db_config['data']  =  bindProcessing($_POST);
               if( $this->uidcontroll->updateData( $db_config ) !== FALSE ){

                    $this->session->set_flashdata('msg_success', 'Success Update Data');
                    redirect( base_url($this->app_name) );
                    
               }else{$this->messagecontroll->delivered('msg_error', 'Invalid Data to Update !');}    
                
            }else{ $this->messagecontroll->delivered('msg_warning', validation_errors()); }   
        
        //echo '<pre>'.print_r($params['datadb'], true).'</pre>'; exit;
        $this->getContent($params);
    }

    public function indexCat(){
        $params['datadb']     =  $this->coredb->getProductCategory();
        
        $this->getContent($params);
    }
   
    public function add(){
        
        $this->breadcrumb = array('Master Data' => base_url($this->app_name).'/data','Add' => 'javascript:;');
        $msg = '';
        if($_POST){
           
            $maxField = 5;
            $hitFile  = 0;
            for($i = 0; $i < $maxField; $i++){
                
                if( isset( $_FILES['file_'.$i]) ){
                   
                    if( $_FILES['file_'.$i]['tmp_name'] !== "" ){
                     
                        # check minimum width and height
                        list($width, $height, $type, $attr) = getimagesize($_FILES['file_'.$i]['tmp_name']);      
                        if( $width <  config_item('img_product')['width'] || $height <  config_item('img_product')['height'] ){ 
                            $msg .= 'Minimum file images must be in size '.config_item('img_product')['width'].' x '.config_item('img_product')['height'];     
                        }
                        $hitFile++;
                    }
                }
            }
            if($hitFile == 0){
               $msg = 'Products Image must be upload'; 
            }           

            if( $this->form_validation->run( REG_VALIDATION ) !== FALSE && $msg  == '' ){    
                
                $this->load->library('uidcontroll');
                
                # processing data image
                $_POST['author'] = $this->session->userdata('sys_administrator_id');
                $this->uidcontroll->insertData('product', bindProcessing($_POST));
                $product_id = $this->uidcontroll->last_id;
                
                # processing file upload
                $this->load->library('fileupload'); 
                for($i = 0; $i < $maxField; $i++){
                    
                    if( isset( $_FILES['file_'.$i]) ){
                       
                        if( $_FILES['file_'.$i]['tmp_name'] !== "" ){
                           
                            $this->fileupload->path_directory = $this->imgDir;
                            if( $this->fileupload->init($_FILES['file_'.$i]) !== FALSE ){
                                
                                $dataInputImage['product_id'] = $product_id;
                                $dataInputImage['file']       = $this->fileupload->path_directory;
                                $dataInputImage['extention']  = $this->fileupload->fileExt;
                                $this->uidcontroll->insertData('product_image', $dataInputImage);
                            } 
                        }
                    }
                }    
                # -------------------------------------------------------------------------------------
                $this->session->set_flashdata('msg_success', 'Success Save Data');  
                redirect( base_url($this->app_name));
                
            }else{ $this->messagecontroll->delivered('msg_warning', $msg.validation_errors()); }
        }
        
        $this->getContent();
    }

    public function addCat(){
        
        if($_POST){
       
            if( $this->form_validation->run( REG_VALIDATION2 ) !== FALSE ){ 
                
                # record database    
                $this->load->library('uidcontroll');
                $_POST['author'] = $this->session->userdata('sys_administrator_id');
                if( $this->uidcontroll->insertData('product_category', bindProcessing($_POST) ) !== FALSE){
                    
                    $this->session->set_flashdata('msg_success', 'Success Save Data');  
                }else{$this->session->set_flashdata('msg_success', 'Invalid Data to Save !');}
                
                redirect( base_url($this->app_name).'/indexCat');
                 
            }else{ $this->messagecontroll->delivered('msg_warning', validation_errors()); } 
        }
        $this->getContent();
    }      
    
    public function edit(){
        
        $msg  = '';  
        if( $_POST ){
               
            $maxField = 5;
            $hitFile  = 0;
            for($i = 0; $i < $maxField; $i++){
                
                if( isset( $_FILES['file_'.$i]) ){
                   
                    if( $_FILES['file_'.$i]['tmp_name'] !== "" ){
                     
                        # check minimum width and height
                        list($width, $height, $type, $attr) = getimagesize($_FILES['file_'.$i]['tmp_name']);      
                        if( $width <  config_item('img_product')['width'] || $height <  config_item('img_product')['height'] ){ 
                            $msg .= 'Minimum file images must be in size '.config_item('img_product')['width'].' x '.config_item('img_product')['height'];     
                        }
                        $hitFile++;
                    }
                }
            }
         
            
            if( $this->form_validation->run( REG_VALIDATION ) !== FALSE && $msg == ""){
             
               $this->load->library('uidcontroll');
               // update to image
               $this->load->library('fileupload');
               for($i=0; $i<$maxField; $i++){
                    
                    if( isset($_FILES['file_'.$i]) ){
                        
                        $this->fileupload->path_directory = $this->imgDir;  
                        if( $_POST['pid_'.$i] !== "" ){
                            
                            if( $_FILES['file_'.$i]['name'] !== "" ){
                                
                               # remove old file image
                               $image     = $this->coredb->grapOnlyImage($_POST['pid_'.$i]);
                               $dirPath   = $image['file'];
                               $thumbPath = getThumbnailsImage($image['file'], $image['extention']);
                               // remove original image
                               if(file_exists($dirPath)){unlink($dirPath);}
                               // remove thumbnails image
                               if(file_exists($thumbPath)){unlink($thumbPath);} 
                              
                              
                               if( $this->fileupload->init($_FILES['file_'.$i]) !== FALSE ){
        
                                    $dataImagePost = array(
                                    'product_id'    => $this->initial_id,
                                    'file'          => $this->fileupload->path_directory,
                                    'extention'     => $this->fileupload->fileExt
                                    );
                                   
                                    $db_config['where'] = array('product_image_id', $_POST['pid_'.$i]);
                                    $db_config['table'] = 'product_image';
                                    $db_config['data']  =  $dataImagePost;
                                    $this->uidcontroll->updateData( $db_config ); 
                               } 
                            }
                            
                        }else{
                            
                            if( $this->fileupload->init($_FILES['file_'.$i]) !== FALSE ){
                               
                                $productImage = array(
                                'product_id'    => $this->initial_id,
                                'file'          => $this->fileupload->path_directory,
                                'extention'     => $this->fileupload->fileExt
                                ); 
                                $this->uidcontroll->insertData('product_image', $productImage ); 
                            } 
                        }
                    }
                    
                    // unsetting post pid
                    unset($_POST['pid_'.$i]);
               } 
     
               # update data
               $_POST['author'] = $this->session->userdata('sys_administrator_id');
    		   $db_config['where'] = array('product_id', $this->initial_id);
    		   $db_config['table'] = 'product';
    		   $db_config['data']  =  bindProcessing($_POST);
               if( $this->uidcontroll->updateData( $db_config ) !== FALSE ){
 
                    $this->session->set_flashdata('msg_success', 'Success Update Data');
    				redirect( base_url($this->app_name));
                    
    		   }else{$this->messagecontroll->delivered('msg_error', 'Invalid Data to Update !');}    
                
            }else{ $this->messagecontroll->delivered('msg_warning', $msg.validation_errors()); }   
        }
        
        $params['datadb'] =  $this->coredb->getProduct($this->initial_id);
        $this->getContent($params);  
    }

    public function editCat(){
        
        if( $_POST ){
            
               # update data
               $this->load->library('uidcontroll');
               $db_config['where'] = array('product_category_id', $_POST['product_category_id']);
               $db_config['table'] = 'product_category';
               $db_config['data']  =  bindProcessing($_POST);
               if( $this->uidcontroll->updateData( $db_config ) !== FALSE ){

                    $this->session->set_flashdata('msg_success', 'Success Update Data');
                    redirect( base_url($this->app_name).'/indexCat' );
                    
               }else{$this->messagecontroll->delivered('msg_error', 'Invalid Data to Update !');}     
                
        }
        $params['datadb'] =  $this->coredb->getProductCategoryById($this->uri->segment(3));
        //var_dump($this->uri->segment(3));
        $this->getContent($params);  
    }
    
    
    public function removeCat(){
        
        $this->load->library('uidcontroll');  
        $dataRemove = array('product_category_id', $this->initial_id); 
        if( $this->uidcontroll->removeData('product_category', $dataRemove) == TRUE ){
            
            $this->session->set_flashdata('total_data', $this->uidcontroll->totalRecord);
            $this->session->set_flashdata('msg_success', 'Success Remove Data Banner');
       }
       redirect(base_url($this->app_name));
    }


    
    public function removeProductImage(){
    
        # remove old file image
        $image     = $this->coredb->grapOnlyImage($_GET['id_image']);     
        $dirPath   = $image['file'];
        $thumbPath = getThumbnailsImage($image['file'], $image['extention']);
        // remove original image
        if(file_exists($dirPath)){unlink($dirPath);}
        // remove thumbnails image
        if(file_exists($thumbPath)){unlink($thumbPath);} 
            
        $this->load->library('uidcontroll');
        $dataI = array('product_image_id', $_GET['id_image']);
        if($this->uidcontroll->removeData('product_image', $dataI) !== FALSE){
            $this->session->set_flashdata('msg_success', '( 1 ) image product has been removed');
            redirect($this->root);
        }
    }
    public function remove(){
        
        $this->load->library('uidcontroll');  
        
        # remove old file image
        $image  = $this->coredb->grapImage($this->initial_id);
        if(count($image) > 0){
            
            foreach($image as $row){
                
                $dirPath   = $row['file'];
                $thumbPath = getThumbnailsImage($row['file'], $row['extention']);

                // remove original image
                if(file_exists($dirPath)){unlink($dirPath);}
                // remove thumbnails image
                if(file_exists($thumbPath)){unlink($thumbPath);} 
            }
        }
      
        # remove image
        $dataRemove = array('product_id', $this->initial_id); 
        $this->uidcontroll->removeData('product_image', $dataRemove);
        
        $dataRemove = array('product_id', $this->initial_id); 
        if( $this->uidcontroll->removeData('product', $dataRemove) == TRUE ){
            $this->session->set_flashdata('msg_success', 'Success Remove Data Banner');
        }
        redirect(base_url($this->app_name));
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
       
       $dataRemove = array('product_id', $_POST['id_table']); 
       $this->uidcontroll->removeDataIn('product_image', $dataRemove);
       
       $dataRemove = array('product_id', $_POST['id_table']); 
       if( $this->uidcontroll->removeDataIn('product', $dataRemove) == TRUE ){
            $this->session->set_flashdata('msg_success', 'Success Remove Data');
       }
      redirect(base_url($this->app_name).'/data');
    }
}
?>