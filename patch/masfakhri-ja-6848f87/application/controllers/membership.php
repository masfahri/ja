<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Membership extends CI_Controller {

    # property
    protected  $base_template   = array(
    'container' => 'container',
    'template'  => 'membership'
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
             
              

 
        if($_POST){
               $this->load->library('uidcontroll'); 

                $member['first_name'] = $_POST['first_name'];
                $member['last_name'] = $_POST['last_name'];
                $member['no_member'] = $_POST['no_member'];
                $member['address'] = $_POST['address']; 
                $member['province'] = $_POST['province'];
                $member['zipcode'] = $_POST['zipcode'];
                $member['ktp'] = $_POST['ktp'];
                $member['sim'] = $_POST['sim'];
                $member['phone'] = $_POST['phone'];
                $member['home_phone'] = $_POST['home_phone'];
                $member['office'] = $_POST['office'];
                $member['email'] = $_POST['email'];
                $member['blood_type'] = $_POST['blood_type'];
                $member['tsize'] = $_POST['tsize'];
                $member['reg_date'] = Date();
                $member['status'] = 'pending';
                $this->uidcontroll->insertData('membership', $member);
                 $count = $this->uidcontroll->last_id;                
                
                //$id_membership = $count;
                      $maxField = 3;

                for($i = 0; $i < $maxField; $i++){
                $membercar['id_membership'] = $count;
                $membercar['seri_mc'] = $_POST['seri_mc'.$i];
                $membercar['year'] = $_POST['year'.$i];
                $membercar['license_plate'] = $_POST['license_plate'.$i];
                $membercar['chasis_no'] = $_POST['chasis_no'.$i];
                $membercar['engine_no'] = $_POST['engine_no'.$i];
                $this->uidcontroll->insertData('membership_car', $membercar);
               }                          
                  $this->session->set_flashdata('msg_success', 'Terimakasih telah bergabung dengan kami, kami akan menghubungi anda selanjutnya.'); 
                  redirect($_SERVER['HTTP_REFERER']);

            }


        $this->load->model('mcontact');
        $params['contact'] = $this->mcontact->bindDataContact();

        $this->load->model('mads');
        $params['ads'] = $this->mads->getAds();      
				$this->load->model('msocial');
				$params['social'] = $this->msocial->getSocial();
        $this->load->model('mmember');
        $params['datadb'] = $this->mmember->bindDataSetupp();    
        $params['datadb2'] = $this->mmember->bindDataSetup(1);
        $params['datadb3'] = $this->mmember->bindDataSetuppp(1);        
        $this->getContent($params);
	}


}
