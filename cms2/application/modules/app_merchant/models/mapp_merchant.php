<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @author Raka Anggala W.S
 * @date 10/09/2015
 */ 
class Mapp_merchant extends CI_Model{
    
    public function getMerchant(){
        
        $this->db->select('*');
        $this->db->from('page_merchant');
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();
        if($query->num_rows() > 0){
                return $query->result_array();
        }else return null;
    }
    
    public function grapMerchant($initial_id){
        
        $this->db->select('*');
        $this->db->from('page_merchant');
        $this->db->where('id', $initial_id);
        $query = $this->db->get();
        if($query->num_rows() > 0)return $query->row_array();
        else return null;
    }
    public function grapImage($initial_id){
        
        $this->db->select('file, extention');
        $this->db->from('page_merchant');
        $this->db->where_in('id', $initial_id);
        $query = $this->db->get();
        if($query->num_rows() > 0)return $query->result_array();
        else return null;
    }

    
    public function grapImageIn($initial_id){
        
        $this->db->select('file, extention');
        $this->db->from('banner');
        $this->db->where_in('banner_id', $initial_id);
        $query = $this->db->get();
        if($query->num_rows() > 0)return $query->result_array();
        else return null;
    }
}