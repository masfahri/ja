<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class App_gallery extends MX_Controller {
    
    # property
    public $root;
    public $app_name            = ''; 
    public $pageTitle           = ''; 
    public $initialPage         = 'Gallery';
    # initial file image
    public $imgDir              = 'uploads/gallery';
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
        $this->load->helper( array(
				'file/file'
        ));
    }
    
        
    public function registerValidation(){
        
        define("REG_VALIDATION", strtolower( __CLASS__ ));
        define("REG_VALIDATION2", strtolower( __CLASS__ ).'Album');
        define("REG_VALIDATION3", strtolower( __CLASS__ ).'Banner');        
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
        
        $params['datadb']     =  $this->coredb->getAllAlbum();
        
        //echo '<pre>'.print_r($params['datadb'], true).'</pre>'; exit;
        $this->getContent($params);
    }
	
    public function detail(){
        $params['datadb'] =  $this->coredb->getAlbum($this->initial_id);
        //var_dump($params['datadb']);
        $this->getContent($params);
    }

    public function banners() {
        
        $params['datadb2'] =  $this->coredb->getBanner2($this->initial_id);
        if( $_POST ){
            
               # processing file upload
               if( $_FILES['file']['name'] !== "" )
               {
                   $this->load->library('fileupload');
                   $this->fileupload->path_directory = $this->imgDir;
                   if( $this->fileupload->init($_FILES['file']) !== FALSE ){
                        $_POST['file']     = $this->fileupload->path_directory;
                        $_POST['ext'] = $this->fileupload->fileExt;
                   }
               }
             # -------------------------------------------------------------------------------------
             
                
               # update data
               $this->load->library('uidcontroll');
               $db_config['where'] = array('id_banner', $this->uri->segment(3));
               $db_config['table'] = 'gallery_get';
               $db_config['data']  =  bindProcessing($_POST);
               if( $this->uidcontroll->updateData( $db_config ) !== FALSE ){

                    $this->session->set_flashdata('msg_success', 'Success Update Data');
                    redirect( base_url($this->app_name).'/sponsors' );
                    
               }else{$this->messagecontroll->delivered('msg_error', 'Invalid Data to Update !');}    
                
        }


        $this->getContent($params);  
    } 

    public function add(){
        $params['dataAlbums'] = $this->coredb->getAllAlbum();        
        $msg = '';
        if($_POST){
            $maxField = 5;
            $hitFile  = 0;
            if( $this->form_validation->run( REG_VALIDATION ) !== FALSE && $msg  == '' ){    
                
                $this->load->library('uidcontroll');
                
                // # processing data image
                // $_POST['author'] = $this->session->userdata('sys_administrator_id'); 
                // $this->uidcontroll->insertData('gallery', bindProcessing($_POST));
                // $product_id = $this->uidcontroll->last_id;

                # processing file upload
                $this->load->library('fileupload'); 
                for($i = 0; $i < $maxField; $i++){

                    if( isset( $_FILES['file_'.$i]) ){
                       
                        if( $_FILES['file_'.$i]['tmp_name'] !== "" ){
                           
                            $this->fileupload->path_directory = $this->imgDir;
                            if( $this->fileupload->init($_FILES['file_'.$i]) !== FALSE ){
                                
                                $dataInputImage['gallery_album_id'] = $_POST['gallery_album_id'];
                                $dataInputImage['url_link'] = $_POST['url_link'];
                                $dataInputImage['type']       = $_POST['type'];
                                $dataInputImage['file']       = $this->fileupload->path_directory;
                                $dataInputImage['extention']  = $this->fileupload->fileExt;
                                $this->uidcontroll->insertData('gallery', $dataInputImage);
                            } 
                        }
                    }
                } 

                # youtube id
                $youtube = null;
                if(isset($_POST['url_link'])){
                    if( $_POST['url_link'] !== '' ){

                            $dataBlog = array(
                                'gallery_album_id'  => $_POST['gallery_album_id'],
                                'type'          => $_POST['type'],    
                                'url_link'        => $_POST['url_link'],
                                'author'            => $this->session->userdata('sys_administrator_id')
                            );
                            $this->uidcontroll->insertData('gallery', $dataBlog);
                    }
                }

                # -------------------------------------------------------------------------------------
                $this->session->set_flashdata('msg_success', 'Success Save Data');  
                redirect( base_url($this->app_name));
                
            }else{ $this->messagecontroll->delivered('msg_warning', $msg.validation_errors()); }
        }
        
        $this->getContent($params);
    }

    public function addAlbums(){     
        $msg = '';
        if($_POST){
           
            $maxField = 0;
            $hitFile  = 0;
            for($i = 0; $i <= $maxField; $i++){
                
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
               $msg = 'Albums Image must be upload'; 
            }           

            if( $this->form_validation->run( REG_VALIDATION2 ) !== FALSE && $msg  == '' ){    
                
                $this->load->library('uidcontroll');
                
                # processing file upload
                $this->load->library('fileupload'); 
                for($i = 0; $i <= $maxField; $i++){
                    
                    if( isset( $_FILES['file_'.$i]) ){
                       
                        if( $_FILES['file_'.$i]['tmp_name'] !== "" ){
                           
                            $this->fileupload->path_directory = $this->imgDir;
                            if( $this->fileupload->init($_FILES['file_'.$i]) !== FALSE ){
                                
                                $dataInputImage['album_name'] = $_POST['album_name'];
                                $dataInputImage['album_title'] = $_POST['album_title'];
                                $dataInputImage['album_description'] = $_POST['album_description'];
                                $dataInputImage['date'] = $_POST['date'];
                                $dataInputImage['file']       = $this->fileupload->path_directory;
                                $dataInputImage['extention']  = $this->fileupload->fileExt;
                                $this->uidcontroll->insertData('gallery_album', $dataInputImage);
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
        
        # remove old file image
        $image     = $this->coredb->grapOnlyImage($this->initial_id);     
        $dirPath   = $image['file'];
        $thumbPath = getThumbnailsImage($image['file'], $image['extention']);
        // remove original image
        if(file_exists($dirPath)){unlink($dirPath);}
        // remove thumbnails image
        if(file_exists($thumbPath)){unlink($thumbPath);} 

        $this->load->library('uidcontroll');  
        $dataRemove = array('gallery_album_id', $this->initial_id); 
        $dataI = array('gallery_album_id', $this->initial_id);        
        if( $this->uidcontroll->removeData('gallery_album', $dataRemove) == TRUE  && $this->uidcontroll->removeData('gallery', $dataI) == TRUE) {
            
            $this->session->set_flashdata('total_data', $this->uidcontroll->totalRecord);
            $this->session->set_flashdata('msg_success', 'Success Remove Albums and photo');
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
       $dataRemove = array('gallery_album_id', $_POST['gallery_album_id']); 
       if( $this->uidcontroll->removeDataIn('gallery_album', $dataRemove) == TRUE ){
            $this->session->set_flashdata('msg_success', 'Success Remove Data');
       }
       redirect( base_url($this->app_name));
    }
}
?>