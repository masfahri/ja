<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class App_blog_tag extends MX_Controller {
    
    # property
    public $root;
    public $app_name            = ''; 
    public $pageTitle           = ''; 
    public $initialPage         = 'Page Child Category';
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
        $params['datadb'] =  $this->coredb->getAllTag();
        $this->getContent($params);
    }
    
    public function ajaxGenerateTag(){
         
        $id_categoryBlog = $_GET['id_category'];
        $result = $this->coredb->getTagByCategory($id_categoryBlog);
        echo json_encode($result);
    }
            
    public function add(){
        
        $this->load->helper('blog');
        $this->breadcrumb = array('Master Data' => base_url($this->app_name).'/data','Add' => 'javascript:;');
        if($_POST){

            if( $this->form_validation->run( REG_VALIDATION ) !== FALSE ){ 
                
                # record database    
                $this->load->library('uidcontroll');
                $_POST['author'] = $this->session->userdata('sys_register_id');
                if( $this->uidcontroll->insertData('blog_tag', bindProcessing($_POST) ) !== FALSE){
                    $this->session->set_flashdata('msg_success', 'Success Save Data');  
                }else{$this->session->set_flashdata('msg_success', 'Invalid Data to Save !');}
                redirect($this->root, 'refresh');
                 
            }else{ $this->messagecontroll->delivered('msg_warning', validation_errors()); } 
        }
        $this->getContent();
    } 
    
    public function edit(){
        
        $this->load->helper('blog');
        $this->breadcrumb = array('Master Data' => base_url($this->app_name).'/data','Edit' => 'javascript:;');  
        
        if( $_POST ){
           
           # update data
           $this->load->library('uidcontroll');
           $_POST['author'] = $this->session->userdata('sys_register_id');
         
		   $db_config['where'] = array('blog_tag_id', $this->initial_id);
		   $db_config['table'] = 'blog_tag';
		   $db_config['data']  =  bindProcessing($_POST);
           if( $this->uidcontroll->updateData( $db_config ) !== FALSE ){
		     	$this->session->set_flashdata('msg_success', 'Success Update Login Access Data');
				redirect( $this->root );
                
		   }else{$this->messagecontroll->delivered('msg_error', 'Invalid Data to Update !');} 
        }
        $params['datadb'] =  $this->coredb->getAllTag($this->initial_id);
       
        $this->getContent($params);  
    }
    
    public function remove(){
        
        $this->load->library('uidcontroll');  
        $dataRemove = array('blog_tag_id', $this->initial_id); 
        if( $this->uidcontroll->removeData('blog_tag', $dataRemove) == TRUE ){

            $this->session->set_flashdata('total_data', $this->uidcontroll->totalRecord);
            $this->session->set_flashdata('msg_success', 'Success Remove Data Banner');
       }
       redirect($this->root);
    }
    
    public function removeAll(){
       
       $this->load->library('uidcontroll');
       $dataRemove = array('blog_tag_id', $_POST['id_table']); 
       if( $this->uidcontroll->removeDataIn('blog_tag', $dataRemove) == TRUE ){
            $this->session->set_flashdata('msg_success', 'Success Remove Data');
       }
       redirect($this->root);
    }
}
?>