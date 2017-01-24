<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mproduct extends CI_Model{
    
    public function getProduct($product_id = "", $productCat = "", $offset="", $limit=""){
            
        $this->db->select('*');
        $this->db->from('product');
        if( $product_id !== "" ){
            $this->db->where('product_id', $product_id);
        }
        // product category
        if( $productCat !== "all" &&  $productCat !== "deals" ){
            $productCat = str_replace('--', ' / ', $productCat);
            $productCat = str_replace('-', ' ', $productCat);
            $this->db->where('product_category', $productCat);
        }
        // Exclusive Deals
        if( $productCat == 'deals' ){
             $this->db->where('deals', 'yes');
        }
        if($offset !== "" || $limit !== ""){
            $this->db->limit($offset, $limit);
        }
        $this->db->order_by('product_id', 'DESC');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            if( $product_id !== "" ){
                return $query->row_array(); 
            }else{
                return $query->result_array(); 
            }
        }else return null;
    }
    
    public function getTotalProduct($productCat = ""){
        
        $this->db->select('*');
        $this->db->from('product');
         // product category
        if( $productCat !== "all" && $productCat !== "deals"){
            $productCat = parseUrl($productCat);
            $this->db->where('product_category', $productCat);
        }
        // Exclusive Deals
        if( $productCat == 'deals' ){
             $this->db->where('deals', 'yes');
        }
        $this->db->order_by('product_id', 'DESC');
        $query = $this->db->get();
        return $query->num_rows();
    }
}