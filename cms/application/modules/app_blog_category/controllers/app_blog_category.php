<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class App_blog_category extends MX_Controller {
    
    # property
    public $root;
    public $app_name            = ''; 
    public $pageTitle           = ''; 
    public $initialPage         = 'Blog Category';
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
        'page/page'
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
        $config['total_rows']   = $this->coredb->getTotalBlogCategory();
        $config['per_page']     = 10; 
        $config['uri_segment']  = 3 ;
        $this->pagination->initialize($config);
        // result of page
        $params['result_all'] =  $config['total_rows'];
        $params['datadb']     =  $this->coredb->getBlogCategory($x="", $config["per_page"], $this->uri->segment(3));
        
        //echo '<pre>'.print_r($params['datadb'], true).'</pre>'; exit;
        $this->getContent($params);
    }
    
    public function generateChildCategory(){
        
        $id_category = $_GET['id_category'];
        $datadb = $this->coredb->getSubChildCategory($id_category);
        if( count($datadb) > 0  )echo json_encode($datadb);
        else echo 0;
    }
    
    public function generateImageSize(){
        
        $id_category = $_GET['id_category'];
        $datadb = $this->coredb->getImageSize($id_category);
        //echo $this->db->last_query(); exit;
        if( count($datadb) > 0  )echo json_encode($datadb);
        else echo 0;
    }
         
    public function add(){
        
        $this->breadcrumb = array('Master Data' => base_url($this->app_name).'/data','Add' => 'javascript:;');
        if($_POST){
            
            if( isset($_POST['category_name']) ){
                $saveSubCategory = $_POST['category_name'];
                unset($_POST['category_name']);
            }
            
            if( $this->form_validation->run( REG_VALIDATION ) !== FALSE ){ 
                
                # record database    
                $this->load->library('uidcontroll');
                
                $_POST['author'] = $this->session->userdata('sys_administrator_id');
                if( $this->uidcontroll->insertData('blog_category', bindProcessing($_POST) ) !== FALSE){
                    
                    # save record last category
                    $saveLastId = $this->uidcontroll->last_id;
                    # insert blog image size
                    $width  = 847;
                    $height = 470;
                    $dataSize = array(
                    'category_id'  => $saveLastId,
                    'size'         => $width.'x'.$height,
                    'size_name'    => '('.$width.'x'.$height.') px - Top'
                    );
                    $this->uidcontroll->insertData( 'blog_image_size',$dataSize );
                    
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
            
            if( isset($_POST['category_name']) ){

                $saveSubCategory = $_POST['category_name'];
                unset($_POST['category_name']);
            }
            
            if( $this->form_validation->run( REG_VALIDATION ) !== FALSE ){
             
               # update data
               $this->load->library('uidcontroll');
               $_POST['author'] = $this->session->userdata('sys_administrator_id');
             
    		   $db_config['where'] = array('blog_category_id', $this->initial_id);
    		   $db_config['table'] = 'blog_category';
    		   $db_config['data']  =  bindProcessing($_POST);
               if( $this->uidcontroll->updateData( $db_config ) !== FALSE ){
    		     	
                    // remove old blog sub category
                    $dataRemove = array('category_id', $this->initial_id); 
                    $this->uidcontroll->removeData('blog_child_category', $dataRemove);
                    
                    # insert new blog sub child category
                    if( isset($saveSubCategory) ){
                        
                        if( count($saveSubCategory) > 0 ){ 
                          
                            foreach($saveSubCategory as $index => $value){
                                
                                if( $value !== "" ){
                                    $dataArray = array(
                                    'category_id'     => $this->initial_id,
                                    'category_name'   => $value,
                                    );
                                    $this->uidcontroll->insertData( 'blog_child_category',$dataArray );
                                }
                            }
                        }
                    }
                     
                    $this->session->set_flashdata('msg_success', 'Success Update Data');
    				redirect( $this->root );
                    
    		   }else{$this->messagecontroll->delivered('msg_error', 'Invalid Data to Update !');}    
                
            }else{ $this->messagecontroll->delivered('msg_warning', validation_errors()); }   
        }
        
        $params['datadb'] =  $this->coredb->getBlogCategory($this->initial_id);
        $this->getContent($params);  
    }
    
    public function removeChild(){
    
        // remove blog sub category
        $this->load->library('uidcontroll');
        $dataRemove = array('category_id', $_GET['id_category']); 
        if( $this->uidcontroll->removeData('blog_child_category', $dataRemove) == TRUE ){
            $this->session->set_flashdata('msg_success', '(1) Sub Category Child has been removed');
            redirect($this->root);
        }
        
        redirect(base_url($this->app_name).'data');
    }
    
    public function remove(){
        
        $this->load->library('uidcontroll');  
        $dataRemove = array('blog_category_id', $this->initial_id); 
        if( $this->uidcontroll->removeData('blog_category', $dataRemove) == TRUE ){
            
            // remove blog sub category
            $dataRemoveChild = array('category_id', $this->initial_id); 
            $this->uidcontroll->removeData('blog_child_category', $dataRemoveChild);
            
            // remove blog image size
            $dataRemoveSize = array('category_id', $this->initial_id); 
            $this->uidcontroll->removeData('blog_image_size', $dataRemoveSize);
            
            $this->session->set_flashdata('total_data', $this->uidcontroll->totalRecord);
            $this->session->set_flashdata('msg_success', 'Success Remove Data Banner');
       }
       redirect(base_url($this->app_name).'/data');
    }
    
    public function removeAll(){
       
       $this->load->library('uidcontroll');
       $dataRemove = array('blog_category_id', $_POST['id_table']); 
       if( $this->uidcontroll->removeDataIn('blog_category', $dataRemove) == TRUE ){
            
            // remove blog sub category
            $dataRemoveChild = array('category_id',  $_POST['id_table']); 
            $this->uidcontroll->removeDataIn('blog_child_category', $dataRemoveChild);
            
             // remove blog image size
            $dataRemoveSize = array('category_id', $_POST['id_table']); 
            $this->uidcontroll->removeDataIn('blog_image_size', $dataRemoveSize);
        
            $this->session->set_flashdata('msg_success', 'Success Remove Data');
       }
      redirect(base_url($this->app_name).'/data');
    }
}
?>