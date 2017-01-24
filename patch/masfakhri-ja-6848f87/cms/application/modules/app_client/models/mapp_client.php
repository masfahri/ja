<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mapp_client  extends CI_Model{
    
    public function getClient($client_id = "", $offset="", $limit=""){
        
        $this->db->select('*');
        $this->db->from('client');
        if( $client_id !== "" ){
            $this->db->where('client_id', $client_id);
        }
        if($offset !== "" || $limit !== ""){
            $this->db->limit($offset, $limit);
        }
        $this->db->order_by('client_id', 'DESC');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            if( $client_id !== "" ){
                return $query->row_array(); 
            }else{
                return $query->result_array(); 
            }
        }else return null;
    }
       
    public function getTotalClient(){
        
        $this->db->select('*');
        $this->db->from('client');
        $this->db->order_by('client_id', 'DESC');
        $query = $this->db->get();
        return $query->num_rows();
    }
    
    public function grapImage($client_id){
        
        $this->db->select('file, extention');
        $this->db->from('client');
        $this->db->where('client_id', $client_id);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else return null;
    }
    
     public function grapImageIn($client_id){
        
        $this->db->select('file, extention');
        $this->db->from('client');
        $this->db->where_in('client_id', $client_id);
        $query = $this->db->get();
        if($query->num_rows() > 0){
           return $query->row_array();
        }else return null;
    }
}