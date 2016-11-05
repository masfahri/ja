<?php

/** 
* @desc Get Category News
* @return array
*/    
function getCategoryNews($page_name = ""){
    
    $CI =& get_instance();
    $CI->db->select('blog_category.*, page.page_name');
    $CI->db->from('blog_category');
    $CI->db->join('page', 'page.page_id = blog_category.page_id', 'LEFT');
    if( $page_name !== "" ){
        $CI->db->where('page.page_name', $page_name);
    }
    $CI->db->order_by('blog_category_id', 'ASC');
    $query = $CI->db->get();
    if($query->num_rows() > 0){
       return $query->result_array();         
    }else{return null;} 
}

/** 
* @desc Get Category Child News
* @return array
*/ 
function getCategoryChildNews($category_id){
    
    $CI =& get_instance();
    $CI->db->select('*');
    $CI->db->from('blog_child_category');
    $CI->db->where('child_category_id', $category_id);
    $CI->db->order_by('child_category_id', 'ASC');
    $query = $CI->db->get();
    if($query->num_rows() > 0){
       return $query->result_array();         
    }else{return null;} 
}


/** 
* @desc Get Data Blog
* @return array
*/ 
function getDataBlog($max = ""){
    
    $CI =& get_instance();
    $CI->db->select('blog.*, page.page_name, page_content.title, page_content.content');
    $CI->db->from('blog');
    $CI->db->join('page', 'page.page_id= blog.page_id', 'LEFT');
    $CI->db->join('page_content', 'page_content.content_id= blog.blog_id', 'LEFT');
    $CI->db->where('page_content.id_countries', 64);
    $CI->db->where('page_content.page_category', 'blog');
    $CI->db->where('blog.status', 'publish');
    
    if($max !== ""){
        $CI->db->limit($max);
    }
    $CI->db->order_by('blog_id', 'DESC');
    $query = $CI->db->get();
    if($query->num_rows() > 0){
       return $query->result_array();         
    }else{return null;} 
}
?>