<?php

        
    function get_pCategoryParent(){
        
        $CI =& get_instance();   
        $CI->db->select('*');
        $CI->db->from('p_category_parent');
        $query = $CI->db->get();
        if($query->num_rows()>0){
            return $query->result_array();
        }else return null;
    }
    
    function get_pCategoryChild(){
        
        $CI =& get_instance();   
        $CI->db->select('*');
        $CI->db->from('p_category_child');
        $query = $CI->db->get();
        if($query->num_rows()>0){
            return $query->result_array();
        }else return null;
    }
    
    function get_pBrands(){
        
        $CI =& get_instance();   
        $CI->db->select('*');
        $CI->db->from('p_brands');
        $query = $CI->db->get();
        if($query->num_rows()>0){
            return $query->result_array();
        }else return null;
    }

?>