<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mapp_subscriber extends CI_Model{
    
     public function tableSearch(){
        
        $dataField = array(
        'u_subscribe_email',
        'register_date',
        'name'
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
    
    public function getAllEmail($offset="", $limit=""){
        
        $this->db->select('*');
        $this->db->from('u_subscribe');   
        #-- SEARCH KEYWORD -->
        $this->tableSearch();
        #--- ============ --->
        $this->db->order_by('u_subscribe_id', 'DESC');
        if($offset !== "" || $limit !== ""){
            $this->db->limit($offset, $limit);
        }
        $query = $this->db->get();
        if($query->num_rows() > 0){
           return $query->result_array(); 
        }else return null;
    }
    
    public function getTotalEmail(){
        
        $this->db->select('*');
        $this->db->from('u_subscribe');   
        #-- SEARCH KEYWORD -->
        $this->tableSearch();
        #--- ============ --->
        $this->db->order_by('u_subscribe_id', 'DESC');
        $query = $this->db->get();
        return $query->num_rows();
    }

}