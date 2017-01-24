<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mapp_login extends CI_Model{
    
    
    public function checkUserRegister($username){
      
        $this->db->select('*');
        $this->db->from('sys_administrator');
        $this->db->where('username', $username);
        $query = $this->db->get();
        if($query->num_rows() > 0) return $query->row_array();
        else return null;
    }
    
    /**
    * @desc Check available username on table
    * @params string
    * @params int
    * @return array 
    */ 
    function checkAvailableUser($username, $initial_id = ''){
        
        $this->db->select('id_administrator');
        $this->db->from('sys_administrator');
        if( $initial_id !== "" ){
            $this->db->where_not_in('id_administrator', $initial_id);
        }
        $this->db->where('username', $username);
        $query = $this->db->get();
        if( $query->num_rows() > 0 )return TRUE;
        else FALSE;
    }    
    
    
}