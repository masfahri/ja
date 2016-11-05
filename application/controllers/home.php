<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

    # property
    protected  $base_template   = array(
    'container' => 'container',
    'template'  => 'home'
    );

    public function __construct(){
        parent::__construct();
        $this->load->library('messagecontroll');
        $this->load->helper('global');
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
        $this->load->model('mevent');
        $params['event'] = $this->mevent->getEvent();
        $params['slide'] = $this->mevent->getSlide();
        $this->load->model('mcontact');
        $params['contact'] = $this->mcontact->bindDataContact();  
        $this->load->model('mads');
        $params['ads'] = $this->mads->getAds();
				$this->load->model('mabout');
				$params['sponsors'] = $this->mabout->getSponsors();			
        $this->load->model('mgallery');
        $params['gallery'] = $this->mgallery->getAllGroupGallery();
				$this->load->model('msocial');
				$params['social'] = $this->msocial->getSocial();
        //echo '<pre>'.print_r($params['ads'], true).'</pre>';      
        $this->getContent($params);
	}
}
