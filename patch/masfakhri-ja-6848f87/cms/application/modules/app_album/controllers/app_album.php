<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class App_album extends MX_Controller {
    
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
        $config['total_rows']   = $this->coredb->getTotalAlbum();
        $config['per_page']     = 10; 
        $config['uri_segment']  = 3 ;
        $this->pagination->initialize($config);
        // result of page
        $params['result_all'] =  $config['total_rows'];
        $params['datadb'] =  $this->coredb->getAlbums($x="", $config["per_page"], $this->uri->segment(3));
        $this->getContent($params);
    }
            
    public function add(){
        
        $this->breadcrumb = array('Master Data' => base_url($this->app_name).'/data','Add' => 'javascript:;');
        if($_POST){

            if( $this->form_validation->run( REG_VALIDATION ) !== FALSE ){ 
                
                # record database    
                $this->load->library('uidcontroll');
                $_POST['author'] = $this->session->userdata('sys_administrator_id');
                if( $this->uidcontroll->insertData('gallery_album', bindProcessing($_POST) ) !== FALSE){
                    $this->session->set_flashdata('msg_success', 'Success Save Data');  
                }else{$this->session->set_flashdata('msg_success', 'Invalid Data to Save !');}
                redirect($this->root, 'refresh');
                 
            }else{ $this->messagecontroll->delivered('msg_warning', validation_errors()); } 
        }
        $this->getContent();
    } 
    
    public function edit(){
        
        $this->breadcrumb = array('Master Data' => base_url($this->app_name).'/data','Edit' => 'javascript:;');  
        if($_POST){
  
           # update data
           $this->load->library('uidcontroll');
           $_POST['author'] = $this->session->userdata('sys_administrator_id');
        
		   $db_config['where'] = array('gallery_album_id', $this->initial_id);
		   $db_config['table'] = 'gallery_album';
		   $db_config['data']  =  bindProcessing($_POST);
           if( $this->uidcontroll->updateData( $db_config ) !== FALSE ){
		     	$this->session->set_flashdata('msg_success', 'Success Update Data');
				redirect( $this->root );
                
		   }else{$this->messagecontroll->delivered('msg_error', 'Invalid Data to Update !');} 
        }
        
        $params['datadb'] =  $this->coredb->getAlbums($this->initial_id);
        $this->getContent($params);  
    }
    
    public function remove(){
        
        $this->load->library('uidcontroll');  
        $dataRemove = array('gallery_album_id', $this->initial_id); 
        if( $this->uidcontroll->removeData('gallery_album', $dataRemove) == TRUE ){
            
            // remove all image or video use this album
            $dataAlbum = array('gallery_album_id', $this->initial_id); 
            $this->uidcontroll->removeData('gallery', $dataAlbum);
            
            $this->session->set_flashdata('total_data', $this->uidcontroll->totalRecord);
            $this->session->set_flashdata('msg_success', 'Success Remove Data Banner');
       }
       redirect($this->root);
    }
    
    public function removeAll(){
       
       $this->load->library('uidcontroll');
       $dataRemove = array('gallery_album_id', $_POST['id_table']); 
       if( $this->uidcontroll->removeDataIn('gallery_album', $dataRemove) == TRUE ){
         
            // remove all image or video use this album
            $dataAlbum = array('gallery_album_id',$_POST['id_table']); 
            $this->uidcontroll->removeDataIn('gallery', $dataAlbum);
        
            $this->session->set_flashdata('msg_success', 'Success Remove Data');
       }
       redirect($this->root);
    }
}
?>