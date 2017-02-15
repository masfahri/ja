<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mabout extends CI_Model{
    
    public function bindDataAbout(){
        
        $this->db->select('*');
        $this->db->from('page_about');
        $this->db->where('about_id', 3);
        $query =  $this->db->get();
        if($query->num_rows()>0){
            return $query->row_array();
        }else{ return null; }
    }
    
    public function getOfficers(){
        
        $this->db->select('*');
        $this->db->from('officer');
        $query =  $this->db->get();
        if($query->num_rows()>0){
            return $query->result_array();
        }else{ return null; }
    }

      public function getSponsors(){
        
        $this->db->select('*');
        $this->db->from('sponsors');
        $query =  $this->db->get();
        if($query->num_rows()>0){
            return $query->result_array();
        }else{ return null; }
    }
  
    public function sendMessage(){
        
       if($_POST){
        
            // php mailer
            
       }
    }
}