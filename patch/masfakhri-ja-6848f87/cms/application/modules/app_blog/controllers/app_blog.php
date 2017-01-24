<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class App_blog extends MX_Controller {
    
    # property
    public $root;
    public $app_name            = ''; 
    public $pageTitle           = ''; 
    public $initialPage         = 'Blog / Article';
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
        $config['total_rows']   = $this->coredb->getTotalBlog();
        $config['per_page']     = 10; 
        $config['uri_segment']  = 3;
        $this->pagination->initialize($config);
        // result of page
        $params['result_all'] =  $config['total_rows'];
        $params['datadb']     =  $this->coredb->getAllBlog($x="", $config["per_page"], $this->uri->segment(3));
        //echo $this->db->last_query(); exit;
        $this->getContent($params);
    }
    
    public function getBlogCategory(){
        
        if($_GET['page_id']){
            
            $dataCategory = get_blogCategory($_GET['page_id']);
            if( count($dataCategory) > 0 ){
                echo json_encode($dataCategory);
            }else{
                echo 0;
            }
        }
    }
         
    public function add(){
        
        $msg = '';
        $this->breadcrumb = array('Master Data' => base_url($this->app_name).'/data','Add' => 'javascript:;');
                
        if($_POST){
            
            $orFile = '';
            if( isset($_FILES['fileupl']) ){
               
                
                # checking file upload
                if (($_FILES['fileupl']['type'] == "image/gif")
                || ($_FILES['fileupl']['type'] == "image/jpeg")
                || ($_FILES['fileupl']['type'] == "image/jpg")
                || ($_FILES['fileupl']['type'] == "image/pjpeg")
                || ($_FILES['fileupl']['type'] == "image/png")
                || ($_FILES['fileupl']['type'] == "image/x-png")
                || ($_FILES['fileupl']['type'] == "image/x-icon")
                || ($_FILES['fileupl']['type'] == "image/ico"))
                {   
                    
                    if( $_FILES['fileupl']['name'] !== "" ){
                        
                        # check minimum width and height
                        list($width, $height, $type, $attr) = getimagesize($_FILES['fileupl']['tmp_name']);      
                        if( $width <  config_item('img_blog')['width'] || $height <  config_item('img_blog')['height'] ){ 
                            $msg .= 'Minimum file images must be in size '.config_item('img_blog')['width'].' x '.config_item('img_blog')['height'];     
                        }
                    }
                    $orFile = 'image';
                    $this->imgDir = 'uploads/image/blog';
                }
                
                # checking file pdf
                if( $_FILES['fileupl']['type'] == 'application/pdf' ){
                    
                   $orFile = 'pdf';
                   $this->imgDir = 'uploads/pdf/blog';
                }
            }else{
                $_POST['file'] = '';
                $_POST['extention'] = '';
            }
            
            # check beetwen file upload and file type
            if( isset($_FILES['fileupl']) ){
                
                if( $_POST['filetype'] !== $orFile ){
                   $_POST['filetype'] = '';
                   $msg = 'File type must be same with file upload extention';
                }
            }
          
            
            if( $this->form_validation->run( REG_VALIDATION ) !== FALSE && $msg == "" ){ 
        
                # processing file upload image
                if( isset($_FILES['fileupl']) ){
                    if( $_FILES['fileupl']['name'] !== "" ){
                        
                        # image
                        if( $orFile == 'image' ){
                            
                            $parsingFile = array(
                            'resize'    => false,
                            'size'      => array('width' => $this->imgWidth, 'height' => $this->imgHeight), 
                            'files'     => $_FILES['fileupl'],
                            'directory' => $this->imgDir
                            );
                            uploadFile($parsingFile);  
                        }
                        
                        # pdf
                        if( $orFile == 'pdf' ){
                            
                            $parsingFile = array(
                            'files'     => $_FILES['fileupl'],
                            'directory' => $this->imgDir
                            );
                            uploadFilePdf($parsingFile);  
                        }  
                        # -------------------------------------------------------------------------------------
                    }
                }else{
                    $_POST['file'] = '';
                    $_POST['extention'] = '';
                }
                

                # youtube id
                $youtube = null;
                if(isset($_POST['youtube_id'])){
                    if( $_POST['youtube_id'] !== '' ){$youtube = $_POST['youtube_id'];}
                }
                
                
                //echo '<pre>'.print_r($_POST, true).'</pre>'; exit;
                # record database    
                $this->load->library('uidcontroll');
                $dataBlog = array(
                'blog_category_id'  => $_POST['blog_category_id'],
                'page_id'           => $_POST['page_id'],
                'status'            => $_POST['status'],
                'filetype'          => $_POST['filetype'],    
                'file'              => $_POST['file'],
                'extention'         => $_POST['extention'],
                'youtube_id'        => $youtube,
                'author'            => $this->session->userdata('sys_administrator_id')
                );
                if( $this->uidcontroll->insertData('blog',$dataBlog) !== FALSE){
                    
                    // save description content
                    $saveLastId = $this->uidcontroll->last_id;
                    if( isset($_POST['longdesc']) ){
                        
                        foreach( $_POST['longdesc'] as $index => $value ){ 

                            $dataContent = array(
                            'page_category'         => 'blog',
                            'content_id'            => $saveLastId,
                            'id_countries'          => $index,
                            'title'                 => $_POST['title'][$index],
                            'content'               => $value
                            );
                            $this->uidcontroll->insertData('page_content', $dataContent );
                        }
                    }

                    $this->session->set_flashdata('msg_success', 'Success Save Data');  
                }else{$this->session->set_flashdata('msg_success', 'Invalid Data to Save !');}
                redirect($this->root, 'refresh');
                 
            }else{ $this->messagecontroll->delivered('msg_warning', $msg.validation_errors()); } 
        }
        
        $params['dataQuotes'] = $this->coredb->getAllQuotes();
        $this->getContent($params);
    } 
    
    public function edit(){
        
        $msg    = '';
        $this->breadcrumb = array('Master Data' => base_url($this->app_name).'/data','Edit' => 'javascript:;');  
        if( $_POST ){

           # image
           if( $_POST['filetype'] == 'image'){
              
                # check file image size
                if( isset($_FILES['fileupl']) ){
                    
                    if( $_FILES['fileupl']['name'] !== "" ){
                        
                        # check minimum width and height
                        list($width, $height, $type, $attr) = getimagesize($_FILES['fileupl']['tmp_name']);      
                        if( $width <  config_item('img_blog')['width'] || $height <  config_item('img_blog')['height'] ){ 
                            $msg .= 'Minimum file images must be in size '.config_item('img_blog')['width'].' x '.config_item('img_blog')['height'];     
                        }
                    }
                } 
              
                $this->imgDir = 'uploads/image/blog';
                # checking file type must be same with fileupload type
                if( $_FILES['fileupl']['name'] !== "" ){
                     
                    if( $_FILES['fileupl']['type'] !== 'image/jpeg' 
                    && $_FILES['fileupl']['type'] !== 'image/jpg'
                    && $_FILES['fileupl']['type'] !== 'image/png'
                    && $_FILES['fileupl']['type'] !== 'image/pjpeg') {
                       $msg = 'System change file rejected, You change to <b>( Image )</b>, The file type must be same with Image file';
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
                        'size'      => array('width' => $this->imgWidth, 'height' => $this->imgHeight), 
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
               'page_id'           => $_POST['page_id'],  
               'blog_category_id'  => $_POST['blog_category_id'],
               'file'              => $_POST['file'],
               'extention'         => $_POST['extention'],
               'youtube_id'        => $youtube,
               'author'            => $this->session->userdata('sys_administrator_id')
               );
    		   $db_config['where'] = array('blog_id', $this->initial_id);
    		   $db_config['table'] = 'blog';
    		   $db_config['data']  =  $dataBlog;
            
               if( $this->uidcontroll->updateData( $db_config ) !== FALSE ){
                
                    if( isset($_POST['longdesc']) ){
                        
                        foreach( $_POST['longdesc'] as $index => $value ){  
                            
                            $dataContent = array(
                            'page_category'         => 'blog',
                            'content_id'            => $this->initial_id,
                            'id_countries'          => $index,
                            'title'                 => $_POST['title'][$index],
                            'content'               => $value
                            );

                          // echo '<pre>'.print_r($dataContent, true).'</pre>'; 
                    	   $db_config_page['where'] = array('page_content_id',  $_POST['page_content_id'][$index]);
                   		   $db_config_page['table'] = 'page_content';
                   		   $db_config_page['data']  =  $dataContent;
                           $this->uidcontroll->updateData( $db_config_page );
                        }
                    }
                    
    		     	$this->session->set_flashdata('msg_success', 'Success Update Data');
    				redirect( $this->root );
                    
    		   }else{$this->messagecontroll->delivered('msg_error', 'Invalid Data to Update !');}
                
           }else{ $this->messagecontroll->delivered('msg_warning', $msg.validation_errors()); }    
        }
        
        $params['datadb'] = $this->coredb->getAllBlog($this->initial_id);
        $params['dataQuotes'] = $this->coredb->getAllQuotes();
        $this->getContent($params);  
    }
    
   
    public function remove(){
        
        $this->load->library('uidcontroll'); 
        
        # remove all image
        $blogImage     = $this->coredb->grapBlogImage($this->initial_id);
        $dirPath        = $blogImage['file'];
        $thumbPath      = getThumbnailsImage($blogImage['file'], $blogImage['extention']);
        // remove original image
        if(file_exists($dirPath)){unlink($dirPath);}
        // remove thumbnails image
        if(file_exists($thumbPath)){unlink($thumbPath);} 
         
        $dataRemove = array('blog_id', $this->initial_id); 
        if( $this->uidcontroll->removeData('blog', $dataRemove) == TRUE ){
            
            # remove article on page content
            $dataRemoveContent = array('content_id', $this->initial_id); 
            $this->uidcontroll->removeData('page_content', $dataRemoveContent);
            
            # remove record article on log view
            $dataRemoveLog = array('blog_id', $this->initial_id); 
            $this->uidcontroll->removeData('log_article_view', $dataRemoveLog);
            
            $this->session->set_flashdata('total_data', $this->uidcontroll->totalRecord);
            $this->session->set_flashdata('msg_success', 'Success Remove Data');
        }
       redirect($this->root);
    }
    
    public function removeAll(){
       
       $this->load->library('uidcontroll');
       
       # remove all image
       $blogImage   = $this->coredb->grapBlogImageIn($_POST['id_table']);
       if( count($blogImage) > 0 ){
            foreach($blogImage as $row){
                
               $dirPath        = $row['file'];
               $thumbPath      = getThumbnailsImage($row['file'], $row['extention']);
               // remove original image
               if(file_exists($dirPath)){unlink($dirPath);}
               // remove thumbnails image
               if(file_exists($thumbPath)){unlink($thumbPath);} 
            }
       }
       
       $dataRemove = array('blog_id', $_POST['id_table']); 
       if( $this->uidcontroll->removeDataIn('blog', $dataRemove) == TRUE ){
            
            # remove article on page content
            $dataRemoveContent = array('content_id', $_POST['id_table']); 
            $this->uidcontroll->removeDataIn('page_content', $dataRemoveContent);
            
            # remove record article on log view
            $dataRemoveLog = array('blog_id', $_POST['id_table']); 
            $this->uidcontroll->removeDataIn('log_article_view', $dataRemoveLog);
        
            $this->session->set_flashdata('msg_success', 'Success Remove Data');
       }
       redirect($this->root);
    }
}
?>