<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Article extends CI_Controller {

    # property
    public $initial_template    = '';
    protected  $base_template   = array(
    'container' => 'container',
    'template'  => 'article' 
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
    
    public function ajaxRecordView(){
        
        $initial_id = $_GET['blog_id'];
        $this->load->model('mblog', 'coredb');
        if($this->coredb->recordView($initial_id)){ 
            echo 1;
        }else{ echo 0; }
    } 
    
    public function ajaxRecordLoved(){
        
        $initial_id = $_GET['blog_id'];
        $this->load->model('mblog', 'coredb');
        if($this->coredb->recordLoved($initial_id)){ echo 1;
        }else{ echo 0; }
    } 
    
     public function index(){

        $this->initial_template = 'category';
        $this->load->model('mblog', 'coredb');
        $this->load->library('pagination');
        $config['base_url']     = base_url('article').'/index/';
        $config['total_rows']   = $this->coredb->getPagingTotalBlog();
        $config['per_page']     = 10; 
        $config['uri_segment']  = 3;
        // configuration pagination layout
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        
        $config['anchor_class'] = '';
        
        $config['next_link'] = '<i class="fa fa-long-arrow-right"></i>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        
        $config['prev_link'] = '<i class="fa fa-long-arrow-left"></i>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
       
        $config['first_link'] = false;
        $config['last_link']  = false;
        
        $config['cur_tag_open'] = '<li class="active"><a>';
        $config['cur_tag_close'] = '</a></li>';
        
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        
        $this->pagination->initialize($config);
        // result of page
        $params['result_all'] =  $config['total_rows'];
        $params['datadb'] =  $this->coredb->getPagingBlog($blog_id = "", $config["per_page"], $this->uri->segment(3));

        $this->getContent($params);
    }
    
    
    public function detail(){
        
        $this->load->model('mblog', 'coredb');
        $blog_id     = $this->uri->segment(3);
        $initDefault = $this->uri->segment(5);
      
        // clean disalowed char
        $cleanStr    = preg_replace('/[^\p{L}\p{N}\s]/u', '', $initDefault);
        $initDefault = $cleanStr;

        $params['datadb'] = $this->coredb->getPagingBlog($blog_id);
       
        $this->initial_template = 'detail';
        $this->getContent($params);
    }
  
}