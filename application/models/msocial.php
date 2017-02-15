<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Msocial extends CI_Model{

    public function getSocial(){
        
        $this->db->select('*');
        $this->db->from('social');
        $this->db->where('id_social', 1);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->row_array();
        }else return null;
    }

}