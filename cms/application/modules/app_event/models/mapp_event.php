<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mapp_event extends CI_Model{
    
    public function getEvent($event_id = "", $offset="", $limit=""){
        
        $this->db->select('*');
        $this->db->from('page_event');
        if( $event_id !== "" ){
            $this->db->where('event_id', $event_id);
        }
        if($offset !== "" || $limit !== ""){
            $this->db->limit($offset, $limit);
        }
        $this->db->order_by('event_id', 'DESC');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            if( $event_id !== "" ){
                return $query->row_array(); 
            }else{
                return $query->result_array(); 
            }
        }else return null;
    }    
    
    public function grapImage($event_id){
        
        $this->db->select('file, extention');
        $this->db->from('page_event');
        $this->db->where('event_id', $event_id);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else return null;
    }

    public function getSlide($event_id){
        
        $this->db->select('is_slide');
        $this->db->from('page_event');
        $this->db->order_by('event_id', 'ASC');
        $this->db->where('event_id', $event_id);        
        $query = $this->db->get();
        if($query->num_rows() > 0){
                return $query->result_array();
        }else return null;
    }

    public function getTotalEvents(){
        
        $this->db->select('*');
        $this->db->from('page_event');
        $this->db->order_by('event_id', 'DESC');
        $query = $this->db->get();
        return $query->num_rows();
    }
    
      public function PastEvent(){
        
        $this->db->select('*');
        $this->db->from('page_event');
        $this->db->where('status', '1');
        $query = $this->db->get();
        if( $query->num_rows() > 0 ){
            return $query->result_array();
        }else return null;
      } 

      public function CommingSoon(){
        
        $this->db->select('*');
        $this->db->from('page_event');
        $this->db->where('status', '0');
        $query = $this->db->get();
        if( $query->num_rows() > 0 ){
            return $query->result_array();
        }else return null;
      }      
    
      public function bindDataPage(){
        
        $this->db->select('*');
        $this->db->from('page_event');
        $query = $this->db->get();
        if( $query->num_rows() > 0 ){
            return $query->result_array();
        }else return null;
      }
}