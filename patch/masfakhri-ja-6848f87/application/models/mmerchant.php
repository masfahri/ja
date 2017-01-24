<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mmerchant extends CI_Model{
    
    public function getMerchant(){
        
        $this->db->select('*');
        $this->db->from('page_merchant');
        $this->db->where('page_desc', '');
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();
        if($query->num_rows() > 0){
          return $query->result_array();  
        }else return null;
    }
    public function getDesc(){
        
        $this->db->select('*');
        $this->db->from('page_merchant');
        $this->db->where('id', 1);
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();
        if($query->num_rows() > 0){
          return $query->result_array();  
        }else return null;
    }
  
  
}