<?php

function getProductCategory(){
       
    $CI =& get_instance();   
    $CI->db->select('*');
    $CI->db->from('product_category');
    $query = $CI->db->get();
    if($query->num_rows()>0){
        return $query->result_array();
    }else return null;
}


function getLastProductImage2($product_id = "", $limit = ""){
    
    $CI =& get_instance();   
    $CI->db->select('*');
    $CI->db->from('product_image');
    if($product_id !== ""){
        $CI->db->where('product_id',  $product_id);
    }
    if($limit !== ""){
       $CI->db->limit($limit);
    }
    $CI->db->order_by('product_image_id');        
    $query = $CI->db->get();
    if($query->num_rows()>0){
        if($limit == 1){
            return $query->row_array();
        }else{
            return $query->result_array();
        }
    }else return null;
}


function getDataProductPerCategory($product_cat){
    
    $CI =& get_instance();   
    $CI->db->select('*');
    $CI->db->from('product');
    $CI->db->where('product_category', $product_cat);
    $query = $CI->db->get();
    if($query->num_rows()>0){
        return $query->result_array();
    }else return null;
}


function getGroupProduct(){
    
    $CI =& get_instance();   
    $CI->db->select('*');
    $CI->db->from('product');
    $CI->db->group_by('product_category');
    $query = $CI->db->get();
    if($query->num_rows()>0){
        return $query->result_array();
    }else return null;
}

function getDataCharter($charter_id){
    
    $CI =& get_instance();   
    $CI->db->select('*');
    $CI->db->from('product');
    $CI->db->where('product_id', $charter_id);
    $query = $CI->db->get();
    if($query->num_rows()>0){
        return $query->row_array();
    }else return null;
}
?>