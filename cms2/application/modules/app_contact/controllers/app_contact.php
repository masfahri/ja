<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class App_contact extends MX_Controller {
    
    # property
    public $root;
    public $app_name            = ''; 
    public $pageTitle           = ''; 
    public $initialPage         = 'Page Contact Us';
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
        
    public function edit(){
        
        $this->breadcrumb = array('Edit' => 'javascript:;');
        if( $_POST ){
            
             if( $this->form_validation->run(REG_VALIDATION) !== FALSE ){

               $this->load->library('uidcontroll');
               $_POST['author'] = $this->session->userdata('sys_id_administrator');
               
               $db_update['where'] = array('contact_id', 1);
			   $db_update['table'] = 'page_contact';
			   $db_update['data']  =  bindProcessing($_POST);
               if( $this->uidcontroll->updateData($db_update) !== FALSE){
                    $this->session->set_flashdata('msg_success', 'Success Update Data');
                    redirect($this->root);
               }else{$this->messagecontroll->delivered('msg_error', 'Invalid Data to Update !');}
                
            }else{$this->messagecontroll->delivered('msg_warning', validation_errors()); } 
        }
       
        $params['datadb'] =  $this->coredb->bindDataPage();
        $this->pageTitle = 'Edit';
        $this->getContent($params);
    }
}
?>