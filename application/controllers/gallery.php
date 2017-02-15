<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gallery extends CI_Controller {

    # property
    protected  $base_template   = array(
    'container' => 'container',
    'template'  => 'gallery'
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
        $this->load->model('mcontact');
        $params['contact'] = $this->mcontact->bindDataContact();

        $this->load->model('mads');
        $params['ads'] = $this->mads->getAds();
        $this->load->model('mgallery');
        $params['photo'] = $this->mgallery->getAllGalleryImage();
        $params['video'] = $this->mgallery->getAllVideoImage();
				//var_dump($params['photo']);
				$this->load->model('msocial');
				$params['social'] = $this->msocial->getSocial();			
        $this->getContent($params);
	}


    public function detail(){
				$this->initial_template = 'detail';
        $this->load->model('mcontact');
        $params['contact'] = $this->mcontact->bindDataContact();

        $this->load->model('mads');
        $params['ads'] = $this->mads->getAds();
        $this->load->model('mgallery');
        $params['gallery'] = $this->mgallery->getAllGallery2($this->uri->segment(3));
				//var_dump($params['gallery']);
				$this->load->model('msocial');
				$params['social'] = $this->msocial->getSocial();			
        $this->getContent($params);
    }

}
