<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mrep_message extends CI_Model{
   
    public function tableSearch(){
        
        $dataField = array(
        'name',
        'email',
        'subject',
        'message'
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
    
    public function getAllMessage($contact_id="", $offset="", $limit=""){
        
        $this->db->select('*');
        $this->db->from('contact_message');   
        if( $contact_id !== "" ){
            $this->db->where('contact_id', $contact_id);
        }
        #-- SEARCH KEYWORD -->
        $this->tableSearch();
        #--- ============ --->
        $this->db->order_by('contact_id', 'DESC');
        if($offset !== "" || $limit !== ""){
            $this->db->limit($offset, $limit);
        }
        $query = $this->db->get();
        if($query->num_rows() > 0){
           return $query->result_array(); 
        }else return null;
    }
    
    public function getTotalMessage(){
        
        $this->db->select('*');
        $this->db->from('contact_message');   
        #-- SEARCH KEYWORD -->
        $this->tableSearch();
        #--- ============ --->
        $this->db->order_by('contact_id', 'DESC');
        $query = $this->db->get();
        return $query->num_rows();
    }

}