<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Event extends CI_Controller {

    # property
    protected  $base_template   = array(
    'container' => 'container',
    'template'  => 'event'
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
		
        $this->load->model('mevent');
        $params['datadb'] = $this->mevent->getEvent();
        $this->load->model('mcontact');
        $params['contact'] = $this->mcontact->bindDataContact();
        $this->load->model('mads');
        $params['ads'] = $this->mads->getAds();
				$this->load->model('msocial');
				$params['social'] = $this->msocial->getSocial();		
			
				if($_POST) {
					
	      // Retrieve the posted search term.
        $month = $_POST['month'];
				$year = $_POST['year'];
				$this->load->model('mevent');
        // Use a model to retrieve the results.
        $params['results'] = $this->mevent->Search($month, $year);
				var_dump($params['results']);
					
				}
			
        $this->getContent($params);	
	}
	
    public function detail(){
                
        $this->load->model('mcontact');
        $params['contact'] = $this->mcontact->bindDataContact();
				$this->load->model('msocial');
				$params['social'] = $this->msocial->getSocial();
        $this->load->model('mads');
        $params['ads'] = $this->mads->getAds();  
        $event_id = $this->uri->segment(3);
        $this->load->model('mevent');
        $params['datadb']  =  $this->mevent->getEvent($this->uri->segment(3));
        //var_dump($params['datadb']);
        //echo '<pre>'.print_r($params['datadb'], true).'</pre>';
        //$params['totcat'] = $this->mevent->getTotalProduct($place);
        //echo '<pre>'.print_r($params['totcat'], true).'</pre>';        
        $this->initial_template = 'detail';
        $this->getContent($params);
    }

}
