<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mcontact extends CI_Model{
    
    public function bindDataContact(){
        
        $this->db->select('*');
        $this->db->from('page_contact');
        $this->db->where('contact_id', 1);
        $query =  $this->db->get();
        if($query->num_rows()>0){
            return $query->row_array();
        }else{ return null; }
    }
    
    public function sendMessage(){
        
       if($_POST){
        
            // php mailer
            
       }
    }
}