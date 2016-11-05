<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mapp_membership extends CI_Model{


    public function getDesc($id){

        $this->db->select('*');
        $this->db->from('membership_get');
        $this->db->where('get_id', $id);
        $this->db->order_by('get_id', 'DESC');
        $query = $this->db->get();
        if($query->num_rows() > 0){
                return $query->row_array(); 
        }else return null;

    }    
    
      public function bindDataSetup($initial_id=""){
        
            $this->db->select('*');
            $this->db->from('page_membership');
            if( $initial_id !== "" ){
                $this->db->where('id_membership', $initial_id);
            }
            $this->db->order_by('id_membership', 'DESC');
            $query = $this->db->get();
            if( $query->num_rows() > 0 ){
                if( $initial_id !== "" ){
                   return $query->row_array();
                }else{
                   return $query->result_array();  
                }
                
            }else return null;
      }
      public function bindDataSetupp($initial_id=""){
        
            $this->db->select('*');
            $this->db->from('membership_get');
            if( $initial_id !== "" ){
                $this->db->where('get_id', $initial_id);
            }
            $this->db->order_by('get_id', 'DESC');
            $query = $this->db->get();
            if( $query->num_rows() > 0 ){
                   return $query->result_array();
                
            }else return null;
      }      

      public function bindDataSetuppp($initial_id=""){
        
            $this->db->select('*');
            $this->db->from('membership');
            if( $initial_id !== "" ){
                $this->db->where('id_membership', $initial_id);
            }
            $this->db->order_by('id_membership', 'DESC');
            $query = $this->db->get();
            if( $query->num_rows() > 0 ){
                   return $query->result_array();
                
            }else return null;
      }     
       public function bindDataSetupppp($initial_id=""){
        
            $this->db->select('*');
            $this->db->from('membership_car');
            if( $initial_id !== "" ){
                $this->db->where('id_car', $initial_id);
            }
            $this->db->order_by('id_car', 'DESC');
            $query = $this->db->get();
            if( $query->num_rows() > 0 ){
                   return $query->result_array();
                
            }else return null;
      }
      
      public function getDataLang(){
        
            $this->db->select('*');
            $this->db->from('countries');
            $this->db->where('active', 'yes');
            $this->db->order_by('countries_name', 'ASC');
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
    
      public function bindDataMember(){
        
        $this->db->select('*');
        $this->db->from('membership');
        $query = $this->db->get();
        if( $query->num_rows() > 0 ){
            return $query->result_array();
        }else return null;
      }      

      public function bindDataCar($first_name)
      {
        $this->db ->select("*")
                  ->from("membership_car")
                  ->join("membership", "membership.id_membership=membership_car.id_membership",'left')
                  ->where("membership.id_membership",$first_name)
                  ->where("membership_car.model !=", "")
                  ->order_by("membership.id_membership","DESC");
        $query = $this->db->get();
        if ($query->num_rows()>0) 
          {
            if("membership.")
            return $query->result_array();    
          }else return null;
        // $this->db ->select('*')
        //           ->from('membership_car')
        //           ->join('membership', 'membership_car.id_membership = membership.id_membership');

        // $query = $this->db->get();
        // if( $query->num_rows() > 0 ){
        //     return $query->result_array();
        // }else return null;
      }

      public function bindDataPage(){
        
        $this->db->select('*');
        $this->db->from('membership_car');
        $query = $this->db->get();
        if( $query->num_rows() > 0 ){
            return $query->result_array();
        }else return null;
      }

    public function getProductCategoryById($initial_id){
        
        $this->db->select('*');
        $this->db->from('membership');
        $this->db->where('id_membership', $initial_id);
        $this->db->order_by('id_membership', 'ASC');
        $query = $this->db->get();
        if($query->num_rows() > 0){
                return $query->result_array();
                //return $query;
        }else return null;
    }
    public function getProductCategoryyById($initial_id){
        
        $this->db->select('*');
        $this->db->from('membership_car');
        $this->db->where('id_membership', $initial_id);
        $this->db->order_by('id_membership', 'ASC');
        $query = $this->db->get();
        if($query->num_rows() > 0){
                return $query->result_array();
                //return $query;
        }else return null;
    }      

    public function getCar($id_membership)
    {
        $this->db->select('*');
        $this->db->from('membership_car');
        $this->db->where('id_membership',$id_membership);
        $this->db->order_by('id_membership', 'DESC');
        $query = $this->db->get();
        if($query->num_rows() > 0){
                return $query->result_array();
                //return $query;
        }else return null;  
    }
      
}