<?php

/**
 * @desc 
 * @params array
 * @return string - json encode
 */ 
function jsonEncodePage($dataPost){
    
    if( count($dataPost) > 0 ){
         
        foreach( $_POST['page_id'] as $index => $value){
            $dataAttr[] = $index;
        }
        return json_encode($dataAttr);             
    }
}

/** 
 * @desc Page
 * @return array
 */   
function getPage(){
    
    $CI =& get_instance();
    $CI->db->select('*');
    $CI->db->from('page');
    $query = $CI->db->get();
    if($query->num_rows() > 0) return $query->result_array();
    else return null;
}



?>