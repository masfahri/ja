<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Page extends CI_Controller {

    # property
    public $initial_template    = '';
    protected  $base_template   = array(
    'container' => 'container',
    'template'  => 'page' 
    );
    
    
    public function __construct(){
        parent::__construct();
        $this->load->library('messagecontroll');
    }
    
    # method
    private function getContent($args = array()){
         
        try{
            $body_data['contents'] = $this->load->view($this->base_template['template'], $args, TRUE);
            $this->load->view($this->base_template['container'], $body_data);
        }catch(Exception $e) {
            echo 'Caught exception, params function getContent is wrong : ',  $e->getMessage(), "\n";
        }      
    }
  
    public function detail(){
        
        $this->load->model('mblog', 'coredb');
        $blog_id = $this->uri->segment(3);  
        $params['datadb'] =  $this->coredb->getAllBlogStatic($blog_id, 'others');
        $this->getContent($params);
    }
}