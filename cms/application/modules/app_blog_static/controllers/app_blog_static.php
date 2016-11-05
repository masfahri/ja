<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class App_blog_static extends MX_Controller {
    
    # property
    public $root;
    public $app_name            = ''; 
    public $pageTitle           = ''; 
    public $initialPage         = '';
    # initial file image
    public $imgWidth            = 1000;
    public $imgHeight           = 300;
    public $imgDir              = '';
    
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
        'countries/countries',
        'file/file',
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
    
    public function edit(){
        
        $msg    = '';
        if( $_POST ){
            
            # check file image size
            if( isset($_FILES['fileupl']) ){
                
                if( $_FILES['fileupl']['name'] !== "" ){
                    
                    # check minimum width and height
                    list($width, $height, $type, $attr) = getimagesize($_FILES['fileupl']['tmp_name']);      
                    if( $width !=  config_item('img_blog')['width'] || $height !=  config_item('img_blog')['height'] ){ 
                        $msg .= 'Minimum file images must be in size '.config_item('img_blog')['width'].' x '.config_item('img_blog')['height'];     
                    }
                }
            } 
            
           # image
           if( $_POST['filetype'] == 'image'){
              
                $this->imgDir = 'uploads/image/blog';
                # checking file type must be same with fileupload type
                if( $_FILES['fileupl']['name'] !== "" ){
                     
                    if( $_FILES['fileupl']['type'] !== 'image/jpeg' 
                    && $_FILES['fileupl']['type'] !== 'image/jpg'
                    && $_FILES['fileupl']['type'] !== 'image/pjpeg') {
                       $msg = 'System change file rejected, You change to <b>( Image )</b>, The file type must be same with Image file';
                    }
                }else{
                    
                      if( $_POST['last-type'] !== 'image' ){
                            $msg = 'Image file upload cannot be empty';
                      }  
                }
           }
        
           # pdf
           if( $_POST['filetype'] == 'pdf'){
               
               $this->imgDir = 'uploads/pdf/blog';
               # checking file type must be same with fileupload type
               if(  $_FILES['fileupl']['name'] !== "" ){
                   if( $_FILES['fileupl']['type'] !== 'application/pdf' ){
                       $msg = 'System change file rejected,  You change to <b>( Pdf )</b>, The File type must be same with PDF file';
                   }
               }else{
                    
                    if( $_POST['last-type'] !== 'pdf' ){
                          $msg = 'Pdf file upload cannot be empty';
                    }  
               }
           }
           
           # youtube
           if( $_POST['filetype'] == 'youtube'){
               
               # checking file type must be same with fileupload type
               if( isset($_POST['youtube_id']) ){
                    if( $_POST['youtube_id'] == '' ){
                        $msg = 'Youtube Id cannot be empty';
                    }
               }
           }
           
           # reback value filetype
           if($msg !== ''){$_POST['filetype'] = $_POST['slt'];}
           
           if( $this->form_validation->run( REG_VALIDATION ) !== FALSE && $msg == ''){ 
              
                $blogImage = $this->coredb->grapBlogImage($this->initial_id);
                $_POST['file'] = $blogImage['file'];
                $_POST['extention'] = $blogImage['extention'];
                
                # image
                if( $_POST['filetype'] == 'image' ){
                    
                    if(  $_FILES['fileupl']['name'] !== "" ){
                        
                        # remove old file image
                        $dirPath        = $blogImage['file'];
                        $thumbPath      = getThumbnailsImage($blogImage['file'], $blogImage['extention']);
                        // remove original image
                        if(file_exists($dirPath)){unlink($dirPath);}
                        // remove thumbnails image
                        if(file_exists($thumbPath)){unlink($thumbPath);} 
                        
                        $parsingFile = array(
                        'resize'    => false,
                        'size'      => '', 
                        'files'     => $_FILES['fileupl'],
                        'directory' => $this->imgDir
                        );
                        uploadFile($parsingFile); 
                        $_POST['youtube_id'] = '';
                    }
                }
                
                # pdf
                if( $_POST['filetype'] == 'pdf' ){
                   
                    if(  $_FILES['fileupl']['name'] !== "" ){
                        
                        # remove old file image
                        $dirPath        = $blogImage['file'];
                        $thumbPath      = getThumbnailsImage($blogImage['file'], $blogImage['extention']);
                        // remove original image
                        if(file_exists($dirPath)){unlink($dirPath);}
                        // remove thumbnails image
                        if(file_exists($thumbPath)){unlink($thumbPath);}  
                        
                        $parsingFile = array(
                        'files'     => $_FILES['fileupl'],
                        'directory' => $this->imgDir
                        );
                        uploadFilePdf($parsingFile);
                        $_POST['youtube_id'] = '';
                    }
                }  
                
                # youtube
                $youtube = "";
                if( $_POST['filetype'] == 'youtube' ){
                    
                     $youtube            = $_POST['youtube_id'];
                     $_POST['file']      = '';
                     $_POST['extention'] = '';
                     
                     # remove old file image
                     $dirPath        = $blogImage['file'];
                     $thumbPath      = getThumbnailsImage($blogImage['file'], $blogImage['extention']);
                     // remove original image
                     if(file_exists($dirPath)){unlink($dirPath);}
                     // remove thumbnails image
                     if(file_exists($thumbPath)){unlink($thumbPath);} 
               }
                
            
               # update data
               $this->load->library('uidcontroll');
               $dataBlog = array(
               'status'            => $_POST['status'],
               'filetype'          => $_POST['filetype'],  
               'blog_category_id'  => $_POST['blog_category_id'],
               'file'              => $_POST['file'],
               'extention'         => $_POST['extention'],
               'youtube_id'        => $youtube,
               'author'            => $this->session->userdata('sys_administrator_id')
               );
              
    		   $db_config['where'] = array('blog_id', $this->initial_id);
    		   $db_config['table'] = 'blog_static';
    		   $db_config['data']  =  $dataBlog;
          
               if( $this->uidcontroll->updateData( $db_config ) !== FALSE ){
                
                    if( isset($_POST['longdesc']) ){
                        
                        
                        // do delete 
                        $dataRemove = array('content_id',  $this->initial_id);
                        $this->uidcontroll->removeData('page_content',  $dataRemove);
                        
                        // do insert
                        foreach( $_POST['longdesc'] as $index => $value ){  
                            
                            
                            $dataContent = array(
                            'page_category'         => $_POST['page_name'],
                            'content_id'            => $this->initial_id,
                            'id_countries'          => $index,
                            'title'                 => $_POST['title'][$index],
                            'content'               => $value
                            );
                            $this->uidcontroll->insertData('page_content', $dataContent );
                        }
                    }

    		     	$this->session->set_flashdata('msg_success', 'Success Update Data');        
                    redirect( $this->root );
                    
    		   }else{$this->messagecontroll->delivered('msg_error', 'Invalid Data to Update !');}
                
           }else{ $this->messagecontroll->delivered('msg_warning', $msg.validation_errors()); }    
        }
        
        $page_id  = $this->uri->segment(4);
        
        $params['dataPage'] = $this->coredb->getDataPage($page_id);
        $params['datadb'] = $this->coredb->getAllBlog($this->initial_id, $params['dataPage']['page_name']);
        //echo '<pre>'.print_r($params['datadb'], true).'</pre>'; 
        //echo  $this->db->last_query();  exit;
        $this->initialPage = 'Article &rsaquo; '.ucfirst($params['dataPage']['page_name']);
        $this->getContent($params);  
    }
    
    public function removeImage(){
        
        $this->load->library('uidcontroll'); 
        
        # remove all image
        $blogImage      = $this->coredb->grapBlogImage($this->initial_id);
        $dirPath        = $blogImage['file'];
        $thumbPath      = getThumbnailsImage($blogImage['file'], $blogImage['extention']);
        // remove original image
        if(file_exists($dirPath)){unlink($dirPath);}
        // remove thumbnails image
        if(file_exists($thumbPath)){unlink($thumbPath);} 
         
        $dataContent = array(
        'file'                 => '',
        'extention'            => ''
        );
        
        $db_config_page['where'] = array('blog_id', $this->initial_id);
        $db_config_page['table'] = 'blog_static';
        $db_config_page['data']  =  $dataContent;
        $this->uidcontroll->updateData( $db_config_page );
      
        redirect($this->root);
    }
}
?>