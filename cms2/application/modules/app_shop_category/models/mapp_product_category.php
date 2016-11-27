<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mapp_product_category extends CI_Model{
    
    public function getProductCategory($id_category = "", $offset="", $limit=""){
        
        $this->db->select('*');
        $this->db->from('product_category');
        if( $id_category !== "" ){
            $this->db->where('product_category_id', $id_category);
        }
        if($offset !== "" || $limit !== ""){
            $this->db->limit($offset, $limit);
        }
        $this->db->order_by('product_category_id', 'DESC');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            if( $id_category !== "" ){
                return $query->row_array();
            }else{
                return $query->result_array();
            }
        }else return null;
    }
    
       
    public function getTotalProductCategory(){
        
        $this->db->select('*');
        $this->db->from('product_category');
        $query = $this->db->get();
        return $query->num_rows();
    }
}