<?php


/**
 * @desc Get banner page
 * @return array
 */
function pageOnBanner(){
   
    $CI =& get_instance();
    $CI->db->select('*');
    $CI->db->from('page');
    $CI->db->where('banner', 'yes');    
    
    $query = $CI->db->get();
    if($query->num_rows() > 0)return $query->result_array();
    else return null;
}

?>