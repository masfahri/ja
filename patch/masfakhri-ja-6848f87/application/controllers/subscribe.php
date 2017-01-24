<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Subscribe extends CI_Controller {
    
    public function saveEmail(){
      
       $this->session->set_flashdata('msg_subscribe', 'true');
       $this->session->set_flashdata('rebackPost', $_POST['u_subscribe_email']); 
       if($_POST){
        
             $lastPage = $this->uri->segment(1);
             # check register user email
             if( checkUserSubscribe($_POST['u_subscribe_email']) == true ){
                $this->session->set_flashdata('msg_error', 'Email Address telah teregister, silahkan gunakan email lain');
                redirect($_SERVER['HTTP_REFERER']);
             }
                
             if( $this->form_validation->run( 'subscribe' ) !== FALSE ){ 

                # record database    
                $this->load->library('uidcontroll');
                $dataPost = array('u_subscribe_email' => $_POST['u_subscribe_email']);
                if( $this->uidcontroll->insertData('u_subscribe', $dataPost ) !== FALSE){
                   $this->session->set_flashdata('msg_success', 'Terimakasih anda telah melakukan subscribe email, email anda telah tersimpan.');
                }
              redirect($_SERVER['HTTP_REFERER']);
                
            }else{ 
                $this->session->set_flashdata('msg_error', 'Email Address tidak valid'); 
            } 
            redirect($_SERVER['HTTP_REFERER']);
       } 
    }
}