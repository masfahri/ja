<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Rep_message extends MX_Controller {
    
    # property
    public $root;
    public $app_name            = ''; 
    public $pageTitle           = ''; 
    public $initialPage         = 'Contact Message';
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
    
    public function index(){
        
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
        $config['base_url']     = base_url(strtolower($this->app_name));
        $config['total_rows']   = $this->coredb->getTotalMessage();
        $config['per_page']     = 10; 
        $config['uri_segment']  = 3 ;
        $this->pagination->initialize($config);
        // result of page
        $params['result_all'] =  $config['total_rows'];
        $params['datadb'] =  $this->coredb->getAllMessage($x="", $config["per_page"], $this->uri->segment(3));
        $this->getContent($params);
    }
    
    public function preview(){
        
        $params['datadb'] =  $this->coredb->getAllMessage($this->initial_id);
        //var_dump($params['datadb']);
        $this->getContent($params); 
    }
    
    public function download(){
        
        # query db configuration
        $params['datadb'] =  $this->coredb->getAllMessage();
        $this->load->view('download', $params);
    }    
}
?>