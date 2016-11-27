<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mapp_about extends CI_Model{
    
    
      public function bindDataSetup($initial_id=""){
        
            $this->db->select('*');
            $this->db->from('page_about');
            if( $initial_id !== "" ){
                $this->db->where('about_id', $initial_id);
            }
            $this->db->order_by('about_id', 'DESC');
            $query = $this->db->get();
            if( $query->num_rows() > 0 ){
                if( $initial_id !== "" ){
                   return $query->row_array();
                }else{
                   return $query->result_array();  
                }
                
            }else return null;
      }
      
      public function getOfficers(){
        
            $this->db->select('*');
            $this->db->from('officer');
            $this->db->order_by('id', 'ASC');
            $query = $this->db->get();
            if( $query->num_rows() > 0 ){
                return $query->result_array();  
            }else return null;
      }

      public function getOfficersbyId($initial_id){
        
            $this->db->select('*');
            $this->db->from('officer');
            $this->db->where('id', $initial_id);
            $this->db->order_by('id', 'ASC');
            $query = $this->db->get();
            if( $query->num_rows() > 0 ){
                return $query->result_array();  
            }else return null;
      }
            

      public function getDataCur(){
        
            $this->db->select('*');
            $this->db->from('currency');
            $this->db->order_by('currency_name', 'ASC');
            $query = $this->db->get();
            if( $query->num_rows() > 0 ){
                return $query->result_array();  
            }else return null;
      }
      
      public function grapImage(){
        
        $this->db->select('file, extention, favicon');
        $this->db->from('web_setup');
        $this->db->where('web_setup_id', 1);
        $query = $this->db->get();
        if($query->num_rows() > 0)return $query->row_array();
        else return null;
    }
    
      public function bindDataPage($initial_id=""){
        
        $this->db->select('*');
        $this->db->from('page_about');
        $this->db->where('about_id', $initial_id);
        $query = $this->db->get();
        if( $query->num_rows() > 0 ){
            return $query->row_array();
        }else return null;
      }    
      
}