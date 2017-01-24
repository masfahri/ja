<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mapp_lang extends CI_Model{
    
    public function tableSearch(){
        
        $dataField = array(
        'countries_name', 
        'countries_idx',
        'active'
        ); 
        
        if( isset($_POST['key']) ){
            
            $no  = 0;
            foreach($dataField as $row){
                if($no == 0){
                    $this->db->like($row, $this->input->post('key', true));
                }
                $this->db->or_like($row, $this->input->post('key', true));
                $no++;
            }
        }
    }
    
    
    public function getAllCountries($id_countries = "", $offset="", $limit=""){
        
        $this->db->select('*');
        $this->db->from('countries');
        if( $id_countries !== "" ){
            $this->db->where('countries_id', $id_countries);
        }
        #-- SEARCH KEYWORD -->
        $this->tableSearch();
        #--- ============ --->
        if($offset !== "" || $limit !== ""){
            $this->db->limit($offset, $limit);
        }
        $this->db->order_by('countries_name', 'ASC');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            if( $id_countries !== "" ){
                return $query->row_array();
            }else{
                return $query->result_array();
            }
        }else return null;
    }
    
    public function getTotalCountries(){
        
        $this->db->select('*');
        $this->db->from('countries');
        #-- SEARCH KEYWORD -->
        $this->tableSearch();
        #--- ============ --->
        $this->db->order_by('countries_name', 'ASC');
        $query = $this->db->get();
        return $query->num_rows();
    } 
    
    public function checkCountriesIdx($countries_idx, $init_id = ''){
        
        $this->db->select('countries_id');
        $this->db->from('countries');
        $this->db->where('countries_idx', $countries_idx);
        if( $init_id !== "" ){
            $this->db->where('countries_id !=', $init_id);
        }
        
        $query = $this->db->get();
        if($query->num_rows() > 0){
          return TRUE;
        }else return FALSE;
        
    } 
    
    public function grapImage($intial_id){
        
        $this->db->select('file, extention');
        $this->db->from('countries');
        $this->db->where('countries_id', $intial_id);
        
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->row_array();
        }else return null;
    } 
    
        
    public function grapImageIn($initial_id){
        
        $this->db->select('file, extention');
        $this->db->from('countries');
        $this->db->where_in('countries_id', $initial_id);
        $query = $this->db->get();
        if($query->num_rows() > 0)return $query->result_array();
        else return null;
    }   
}