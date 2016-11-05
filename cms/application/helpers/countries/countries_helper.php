<?php
    
    /** 
     * @desc Get all data countries
     * @return array
     * 
     */
    function getAllCountries($countries_id = "", $target = ""){
        
        $CI =& get_instance();
        if($target !== ""){
           $CI->db->select($target);
        }else{
           $CI->db->select('*'); 
        }
        if( $countries_id !== "" ){
            $CI->db->where('countries_id', $countries_id);
        }
        
        $CI->db->from('countries');
        $query = $CI->db->get();
        if($query->num_rows() > 0){
            if( $target !== "" ){
                return $query->row($target);
            }else{
               return $query->result_array();  
            }
           
        }else{
            return null;
        } 
    }
?>