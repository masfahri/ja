<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product extends CI_Controller {

    # property
    protected  $base_template   = array(
    'container' => 'container',
    'template'  => 'product' 
    );
    public $initial_template = '';
    
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
    
   	public function charter(){
   	    
        $this->load->model('mproduct');
        $productCat = $this->uri->segment(3);
        $this->load->library('pagination');
        $config['base_url']     = base_url('product').'/charter/'.$productCat.'/';
        $config['total_rows']   = $this->mproduct->getTotalProduct($productCat);
        $config['per_page']     = 9; 
        $config['uri_segment']  = 4;
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
        $params['db_product'] = $this->mproduct->getProduct($product_id = "", $productCat, $config["per_page"], $this->uri->segment(4));
        
        $this->initial_template = 'category';
        $this->getContent($params);
	}
    
    public function detail(){
        
        $product_id =  $this->uri->segment(3);
        $this->load->model('mproduct');
        $params['datadb'] = $this->mproduct->getProduct($product_id, $productCat = "all", $a = "", $b = "");
     
        $this->initial_template = 'detail';
        $this->getContent($params);
    }
}