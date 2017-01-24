<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contact extends CI_Controller {

    # property
    protected  $base_template   = array(
    'container' => 'container',
    'template'  => 'contact' 
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
	    
        if($_POST){
               $this->load->library('uidcontroll'); 

                $member['name'] = $_POST['name'];
                $member['email'] = $_POST['email'];
                $member['subject'] = $_POST['subject'];
                $member['message'] = $_POST['message']; 
                $this->uidcontroll->insertData('contact_message', $member);                        
                $this->session->set_flashdata('msg_success', 'Terimakasih telah menghubungi kami, kami akan menghubungi anda selanjutnya.'); 
                  redirect($_SERVER['HTTP_REFERER']);

            }
        
        $this->load->model('mcontact');
        $params['contact'] = $this->mcontact->bindDataContact();

        $this->load->model('mads');
        $params['ads'] = $this->mads->getAds();
        $params['datadb'] = $this->mcontact->bindDataContact();
				$this->load->model('msocial');
				$params['social'] = $this->msocial->getSocial();

        $this->getContent($params);
	}
}