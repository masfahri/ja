<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class App_preview extends MX_Controller {
    
    # property
    public $root;
    protected  $base_template   = array(
    'container' => '../../layout/container',
    'template'  => 'tpl' 
    );


    # method
    public function __construct(){
        
       $this->accesscontroll->authenticate();
       $this->load->model('m'.strtolower( __CLASS__ ), 'coredb'); 
       parent::__construct();
 
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
        
        $article_id       = $this->uri->segment(3); 
        $params['datadb'] = $this->coredb->getAllBlog($article_id);
        # set manual config for website preview
        $params['weburl_base']      = 'http://localhost/2015/KOZINIOMI3/';
        $params['weburl_css']       = $params['weburl_base'].'assets/css/';
        $params['weburl_js']        = $params['weburl_base'].'assets/js/';
        $params['weburl_plugins']   = $params['weburl_base'].'assets/plugins/';
            
        $this->load->view('tpl_preview', $params);
	}
}
?>