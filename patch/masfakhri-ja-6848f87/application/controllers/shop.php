<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Shop extends CI_Controller {


		public $product_id;
    # property

    protected  $base_template   = array(

    'container' => 'container',

    'template'  => 'shop'

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
			
				$this->load->model('mshop');
			
				$params['total'] = $this->mshop->getTotalProducts();
			
				$params['product'] = $this->mshop->getAllProduct();

				$params['category'] = $this->mshop->getAllCategory();
				$params['totalcat'] = $this->mshop->getNumAllCategory();
				//var_dump($params['productsing']);
        $params['desc'] = $this->mshop->getInstruct(1);
        $this->getContent($params);

	}
	
    public function detail(){	
			$this->initial_template = 'detail';
			$this->load->model('mcontact');

			$params['contact'] = $this->mcontact->bindDataContact();

			$this->load->model('msocial');
			$params['social'] = $this->msocial->getSocial();

			$this->load->model('mads');

			$params['ads'] = $this->mads->getAds(); 			
			$this->load->model('mshop');
			$params['productsing'] = $this->mshop->getAllGallery2($this->uri->segment(3));	
			//var_dump($params['productsing']);
     	$this->getContent($params);			
		}
}

