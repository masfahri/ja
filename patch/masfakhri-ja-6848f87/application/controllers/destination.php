<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Destination extends CI_Controller {

    # property
    protected  $base_template   = array(
    'container' => 'container',
    'template'  => 'destination' 
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
    
    public function ajaxAlbumView(){
        
        $initial_id = $_GET['album_id'];
        $this->load->model('mgallery', 'coredb');
        if($this->coredb->recordView($initial_id)){ 
            echo 1;
        }else{ echo 0; }
    }
    
    public function ajaxAlbumLoved(){
        
        $initial_id = $_GET['album_id'];
        $this->load->model('mgallery', 'coredb');
        if($this->coredb->recordLoved($initial_id)){ 
            echo 1;
        }else{ echo 0; }
    }
    
   	public function all(){
        
        $this->load->model('mgallery', 'coredb');
        $this->load->library('pagination');
        $config['base_url']     = base_url('gallery').'/all/';
        $config['total_rows']   = $this->coredb->getTotalGroupGallery();
        $config['per_page']     = 10; 
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
        $params['datadb']     =  $this->coredb->getAllGroupGallery($config["per_page"], $this->uri->segment(3));

        $this->initial_template = 'category';
        //echo $this->db->last_query(); exit;
        $this->getContent($params);
	}
    
    public function detail(){
                
        $this->base_template = array(
        'container' => 'container',
        'template'  => 'gallery_detail' 
        );
        $album_id = $this->uri->segment(3);
        $this->load->model('mgallery', 'coredb');
        $params['datadb']  =  $this->coredb->getAllGallery($album_id);
        //echo '<pre>'.print_r($params['datadb'], true).'</pre>';
        
        $this->initial_template = 'detail';
        $this->getContent($params);
    }
    
    public function previewVideo(){
        
        $this->load->model('mgallery', 'coredb');
        $album_id = $this->uri->segment(4);
        $params['datadb'] =  $this->coredb->getVideoPreview($album_id);
        $this->load->view('video', $params);
    }
}