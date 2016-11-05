<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Merchant extends CI_Controller {

    # property
    protected  $base_template   = array(
    'container' => 'container',
    'template'  => 'merchant'
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
				$this->load->model('msocial');
				$params['social'] = $this->msocial->getSocial();
        $this->load->model('mads');
        $params['ads'] = $this->mads->getAds();
        $this->load->model('mmerchant');
        $params['merchant'] = $this->mmerchant->getMerchant();
				$params['desc'] = $this->mmerchant->getDesc();
        $this->getContent($params);
	}
}
