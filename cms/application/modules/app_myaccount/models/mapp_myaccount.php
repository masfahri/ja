<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mapp_myaccount extends CI_Model{
    
    public function getUserAdministrator($id_user){
        
        $this->db->select('*');
        $this->db->from('sys_administrator');
        $this->db->where('id_administrator', $id_user);
        $query = $this->db->get();
        if($query->num_rows() > 0)return $query->row_array();
        else return null;
    }
    
    public function checkAvailableUser($username, $initial_id = ''){
        
        $CI =& get_instance(); 
        $CI->db->select('username');
        $CI->db->from('sys_administrator');
        if( $initial_id !== "" ){
            $CI->db->where_not_in('id_administrator', $initial_id);
        }
        $CI->db->where('nickname', $username);
        $query = $CI->db->get();
        
        if( $query->num_rows() > 0 )
        return TRUE; else FALSE;
    } 

    public function grapUserImage($array_id){
        
        $this->db->select('image, extention');
        $this->db->from('sys_administrator');
        $this->db->where_in('id_administrator', $array_id);
        $query = $this->db->get();
       
        if( $query->num_rows() > 0 )return $query->result_array();
        else null;
    }
}