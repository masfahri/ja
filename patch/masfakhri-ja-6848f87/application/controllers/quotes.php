<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Quotes extends CI_Controller {

    # property
    public $initial_template = '';
    protected  $base_template   = array(
    'container' => 'container',
    'template'  => 'quotes' 
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
    
    public function index(){
        
        $this->load->model('mquotes', 'coredb');
        $this->load->library('pagination');
        $config['base_url']     = base_url('quotes').'/index/';
        $config['total_rows']   = $this->coredb->getTotalQuotes();
        $config['per_page']     = 5; 
        $config['uri_segment']  = 3;
        // configuration pagination layout
        $config['full_tag_open'] = '<ul class="pagination pagi">';
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
        $params['datadb']     =  $this->coredb->getQuotes($x="", $config["per_page"], $this->uri->segment(3));
        $this->getContent($params);
    }
    
    public function ajaxGenerateQuotes(){
        
        $this->initial_template = 'quotes';
        $quotes_id =  $_GET['quotes_id'];
        
        $this->load->model('mquotes', 'coredb');
        $params['datadb'] =  $this->coredb->getQuotes($quotes_id);
        $this->load->view('ajax', $params);
    }
}