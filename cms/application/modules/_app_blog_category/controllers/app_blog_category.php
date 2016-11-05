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
                $dataCategory = array(
                'page_id'               => $_POST['page_id'],
                'blog_category_name'    => $_POST['blog_category_name'],
                'author'                => $this->session->userdata('sys_administrator_id'),
                );
            
                if( $this->uidcontroll->insertData('blog_category', $dataCategory ) !== FALSE){
                    
                    # save record last category
                    $saveLastId = $this->uidcontroll->last_id;
                    if( isset($_POST['p_category_name-last']) ){
                        
                        if( count($_POST['p_category_name-last']) > 0 ){ 
                         
                            foreach($_POST['p_category_name-last'] as $row){
                                
                                if( $row !== "" ){
                                    $dataChild = array(
                                    'blog_category_id'  => $saveLastId,
                                    'child_name'        => $row
                                    );
                                    $this->uidcontroll->insertData( 'blog_category_child',$dataChild );
                                }
                            }
                        }
                    }
                    
                    
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
           // echo '<pre>'.print_r($_POST, true).'</pre>'; exit;
            if( $this->form_validation->run( REG_VALIDATION ) !== FALSE ){
             
               # update data
               $this->load->library('uidcontroll');
               $dataParent = array(
               'author'             => $this->session->userdata('sys_administrator_id'),
               'blog_category_name' => $_POST['blog_category_name']
               );
    		   $db_config['where'] = array('blog_category_id', $this->initial_id);
    		   $db_config['table'] = 'blog_category';
    		   $db_config['data']  =  $dataParent;
               if( $this->uidcontroll->updateData( $db_config ) !== FALSE ){
    		     	
                    # save record last category
                    $saveLastId = $this->initial_id;
                    if( isset($_POST['p_category_name-last']) ){
                        
                        if( count($_POST['p_category_name-last']) > 0 ){ 
                           
                            $no = 0;
                            $dataUpdate = array();
                            $dataInsert = array();
                            foreach($_POST['p_category_name-last'] as $index => $value){

                                if( $index !== "" ){
                                   
                                    if( checkDbId($index) != FALSE ){
                                        // save data update
                                        $dataUpdate[$index] = $value;
                                    }else{
                                        // save data insert
                                        $dataInsert[$index] = $value;
                                    }
                                }
                              
                                $no++;
                            }
                       
                            // do update
                            if( count($dataUpdate) > 0 ){
                                
                                foreach($dataUpdate as $idxUp => $valUp){
                                     
                                   $dataGo = array(
                                   'blog_category_id'   => $saveLastId,
                                   'child_name'         => $valUp
                                   );
                        		   $db_configUp['where'] = array('blog_category_child_id', $idxUp);
                        		   $db_configUp['table'] = 'blog_category_child';
                        		   $db_configUp['data']  =  $dataGo;
                                   $this->uidcontroll->updateData( $db_configUp );
                                    
                                }
                            }
                            
                            // do insert
                            if( count($dataInsert) > 0 ){
                                
                                foreach($dataInsert as $rowIn){
                                    
                                    if( $rowIn !== "" ){
                                        $dataChild = array(
                                        'blog_category_id'  => $saveLastId,
                                        'child_name'        => $rowIn
                                        );
                                        $this->uidcontroll->insertData( 'blog_category_child',$dataChild );
                                    }  
                                }
                            }
                        }
                    }
                     
                    $this->session->set_flashdata('msg_success', 'Success Update Data');
    				redirect( $this->root );
                    
    		   }else{$this->messagecontroll->delivered('msg_error', 'Invalid Data to Update !');}    
                
            }else{ $this->messagecontroll->delivered('msg_warning', validation_errors()); }   
        }
        
        $params['datadb'] = $this->coredb->getBlogCategory($this->initial_id);
        $params['dataLast'] = $this->coredb->getSubChildCategory($this->initial_id);
       
        $this->getContent($params);  
    }
    
    public function removeChild(){
    
        // remove blog sub category
        $this->load->library('uidcontroll');
        $dataRemove = array('blog_category_child_id', $_GET['id_child']); 
        if( $this->uidcontroll->removeData('blog_category_child', $dataRemove) == TRUE ){
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
            $dataRemoveChild = array('blog_category_child_id', $this->initial_id); 
            $this->uidcontroll->removeData('blog_category_child', $dataRemoveChild);
            
            $this->session->set_flashdata('msg_success', 'Success Remove Data Banner');
       }
       redirect(base_url($this->app_name).'/data');
    }
    
    public function removeAll(){
       
       $this->load->library('uidcontroll');
       $dataRemove = array('blog_category_id', $_POST['id_table']); 
       if( $this->uidcontroll->removeDataIn('blog_category', $dataRemove) == TRUE ){
            
            // remove blog sub category
            $dataRemoveChild = array('blog_category_child',  $_POST['id_table']); 
            $this->uidcontroll->removeDataIn('blog_category_child', $dataRemoveChild);
        
            $this->session->set_flashdata('msg_success', 'Success Remove Data');
       }
      redirect(base_url($this->app_name).'/data');
    }
}
?>