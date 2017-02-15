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
      
    public function getOfficers($id = "", $offset="", $limit=""){
        
        $this->db->select('*');
        $this->db->from('officer');
        if( $id !== "" ){
            $this->db->where('id', $id);
        }
        if($offset !== "" || $limit !== ""){
            $this->db->limit($offset, $limit);
        }
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            if( $id !== "" ){
                return $query->row_array(); 
            }else{
                return $query->result_array(); 
            }
        }else return null;
    }    
    
    public function getSponsors($id_sponsors = "", $offset="", $limit=""){
        
        $this->db->select('*');
        $this->db->from('sponsors');
        if( $id_sponsors !== "" ){
            $this->db->where('id_sponsors', $id_sponsors);
        }
        if($offset !== "" || $limit !== ""){
            $this->db->limit($offset, $limit);
        }
        $this->db->order_by('id_sponsors', 'DESC');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            if( $id_sponsors !== "" ){
                return $query->row_array(); 
            }else{
                return $query->result_array(); 
            }
        }else return null;
    }    
        
    
    public function sponsors($id_sponsors = "", $offset="", $limit=""){
        
        $this->db->select('*');
        $this->db->from('sponsors');
        if( $id_sponsors !== "" ){
            $this->db->where('id_sponsors', $id_sponsors);
        }
        if($offset !== "" || $limit !== ""){
            $this->db->limit($offset, $limit);
        }
        $this->db->order_by('id_sponsors', 'DESC');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            if( $id_sponsors !== "" ){
                return $query->row_array(); 
            }else{
                return $query->result_array(); 
            }
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

    public function grapImageSponsors()
    {
        
        $this->db->select('file, ext');
        $this->db->from('sponsors');
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

      public function bindDataPageSponsor(){
        
        $this->db->select('*');
        $this->db->from('sponsors');
        $query = $this->db->get();
        if( $query->num_rows() > 0 ){
            return $query->result_array();
        }else return null;
      }

      public function getSponsorsbyId($initial_id)
      {
        
            $this->db->select('*');
            $this->db->from('sponsors');
            $this->db->where('id_sponsors', $initial_id);
            $this->db->order_by('id_sponsors', 'ASC');
            $query = $this->db->get();
            if( $query->num_rows() > 0 ){
                return $query->row_array();  
            }else return null;
      }
      
}