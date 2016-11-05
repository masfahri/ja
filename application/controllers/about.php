<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class About extends CI_Controller {

    # property
    protected  $base_template   = array(
    'container' => 'container',
    'template'  => 'about' 
    );
    
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
        $this->load->model('mabout');
        $params['about'] = $this->mabout->bindDataAbout();
        $params['officers'] = $this->mabout->getOfficers();
				$params['sponsors'] = $this->mabout->getSponsors();
        $this->load->model('mads');
        $params['ads'] = $this->mads->getAds();        
				$this->load->model('msocial');
				$params['social'] = $this->msocial->getSocial();			
        $this->getContent($params);
	}
}