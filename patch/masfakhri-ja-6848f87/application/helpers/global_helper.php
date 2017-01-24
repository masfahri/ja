<?php

 /**
* @desc get breadcrumb active page
* @params string 
* @params int
* @return string
*/
function getBreadcrumb($pageName, $noUri){
    
    $CI =& get_instance(); 
    $pageName = str_replace('&', '--', $pageName);
    $pageName = str_replace(' ', '', $pageName);
 
    if( is_array($pageName) ){
        foreach($pageName as $row){
            if( $row ==  strtolower($CI->uri->segment($noUri)) )return 'active';
        }
    }else{
      
        if( strtolower($pageName) == strtolower($CI->uri->segment($noUri)) ) return 'active';
        else return '';
    }
}

/**
* @desc replace string
* @return string
*/
function parseUrl($str){
    $cleanStr = preg_replace('/[^\p{L}\p{N}\s]/u', '', $str);
    return str_replace(' ', '-', $cleanStr);
}

/**
* @desc replace string
* @return string
*/
function cleanDash($str){
    $cleanStr = str_replace('--', ' / ', $str);
    $cleanStr = str_replace('-', ' ',$cleanStr);
    return $cleanStr;
}

/**
* @desc replace string
* @params string
* @params string
* @return string
*/
function getThumbnailsImage($path, $extention){

	$explPath = explode( '.'.$extention, $path);
	return $explPath[0].'_thumb'.'.'.$extention;
}
 
/**
 * @desc get webiste configuration
 * @return array session
 */
function webDefaultConfig($update = ""){
   
    $CI =& get_instance();   
    if(! $CI->session->userdata('webconf_run')){
       
        $CI->db->select('*');
        $CI->db->from('web_setup');
        $CI->db->where('web_setup_id', 1);
        $query = $CI->db->get();
        
        if($query->num_rows() > 0){
            
            $newdata = array(
               'webconf_run'        => 'true',
               'webconf_lang'       => $query->row('active_lang'),
               'webconf_logo'       => $query->row('web_log_img'),
               'webconf_idx'        => getCountriesIdx( $query->row('active_lang'))
            );
            
            $CI->session->set_userdata($newdata);
            // unsetting default session 
            $CI->session->unset_userdata('active_to');
            
        }else{return null;}   
    }
}

/**
 * @desc get webiste configuration
 * @params int
 * @return int
 */
function getCountriesIdx($id_countries){
    
    $CI =& get_instance();
    $CI->db->select('countries_idx');
    $CI->db->from('countries');
    $CI->db->where('countries.countries_id', $id_countries);
 
    $query = $CI->db->get(); 
    if($query->num_rows() > 0){
        return $query->row('countries_idx');
    }else{ return null; }
}

/** 
 * @desc get data setting web setup
 * Favicon, Logo
 * @return array
 */   
function cfg_websetup(){
    
    $CI =& get_instance();
    $CI->db->select('*');
    $CI->db->from('web_setup');
    $CI->db->where('web_setup_id', 1);
    $query = $CI->db->get();
    if($query->num_rows() > 0) return $query->row_array();
    else return null;
}

/** 
 * @desc get data banner
 * @params int
 * @params string
 * @return array
 */   
function getBannerPage( $page_name, $category_name ){
    
    $CI =& get_instance();      
    $CI->db->select('banner.*, banner_category.category_name, page.page_name');  
    $CI->db->from('banner');
    $CI->db->join('banner_category', 'banner_category.banner_category_id = banner.banner_category_id', 'LEFT'); 
    $CI->db->join('page', 'page.page_id = banner_category.page_id', 'LEFT');          
    $CI->db->where('page.page_name', $page_name);
    $CI->db->where('banner_category.category_name', $category_name);
    $query = $CI->db->get();
    if($query->num_rows() > 0){
        return $query->result_array(); 
    }else return null; 
}

/** 
 * @desc Get data contact
 * @return array
 */ 
function getDataContact(){

    $CI =& get_instance(); 
    $CI->db->select('*');
    $CI->db->from('page_contact');
    $CI->db->where('contact_id', 1);
    $query = $CI->db->get();
    if( $query->num_rows()  > 0){
        return $query->row_array();
    }else return FALSE; 
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


/** 
 * @desc Category
 * @params string
 * @return array
 */
function getDataProduct($product_id = ""){
    
    $CI =& get_instance();   
    $CI->db->select('product.*, product_image.file, product_image.extention');
    $CI->db->from('product');
    $CI->db->join('product_image', 'product_image.product_id = product.product_id', 'LEFT');
    if($product_id !== ""){
       $CI->db->where('product.product_id', $product_id); 
    }
    $CI->db->limit(1);
    $CI->db->order_by('product.product_id', 'DESC');
    $query = $CI->db->get();
    if($query->num_rows()>0){
        return $query->row_array();
    }else return null;
    
}

/** 
 * @desc Category
 * @params string
 * @return array
 */
function getProductCategory($category_name = ""){
    
    $CI =& get_instance();
    $CI->db->select('*');
    $CI->db->from('product');
    if($category_name !== ""){
       $CI->db->where('product_category', $category_name); 
    }
    $CI->db->group_by('product_category');
    $query = $CI->db->get();
    if($query->num_rows() > 0) return $query->result_array();
    else return null;
}

/** 
 * @desc Get Data Album File
 * @params int
 * @params int
 * @return array
 */
function getAlbumFile($albumId = "", $lim = ""){
    
    $CI =& get_instance();
    $CI->db->select('*');
    $CI->db->from('gallery');
    if( $albumId  !== "" ){
       $CI->db->where('gallery_album_id', $albumId); 
    }
    $CI->db->order_by('gallery_id', 'DESC');
    if( $lim !== "" ){
        $CI->db->limit(1); 
    }
    $query = $CI->db->get();
    if($query->num_rows() > 0){
        if( $lim  !== "" ){
            return $query->row_array();
        }else{
            return $query->result_array();
        }
    }else return null;
}

/** 
 * @desc Get Data Album File
 * @params int
 * @return array
 */
function getDataProductImage($product_id = "", $lim = ""){
           
    $CI =& get_instance();   
    $CI->db->select('*'); 
    $CI->db->from('product_image');
    if($product_id !== ""){
       $CI->db->where('product_id', $product_id);
    }
    if( $lim !== "" ){
        $CI->db->limit($lim);
    }
    
    $query = $CI->db->get();
    if($query->num_rows()>0){
        if( $lim !== "" ){
             return $query->row_array();
        }else{
            return $query->result_array();
        }
       
    }else return null;
}

/** 
 * @desc Get Product Other
 * @return array
 */
function getOtherProduct($except_id, $max){
       
    $CI =& get_instance();   
    $CI->db->select('*'); 
    $CI->db->from('product');
    $CI->db->where_not_in('product_id', $except_id);
    $CI->db->limit($max);
    $CI->db->order_by('product_id', 'RANDOM');
    $query = $CI->db->get();
    if($query->num_rows()>0){
        return $query->result_array();
    }else return null;
}

/**
 * @desc get social media link
 * @return array
 */
function getSocmedLink(){
    
    $CI =& get_instance();
    $CI->db->select('*');
    $CI->db->from('socmed');
    $CI->db->order_by('socmed_arrangement', 'ASC');
    $query = $CI->db->get();
    if($query->num_rows() > 0) return $query->result_array();
    else return null;
}

/**
* @desc Check user subscribe
* @return array
*/    
function checkUserSubscribe($email){
    
    $CI =& get_instance();
    $CI->db->select('u_subscribe_email');
    $CI->db->from('u_subscribe');
    $CI->db->where('u_subscribe_email', $email);
    $query = $CI->db->get();
    if($query->num_rows() > 0){
       return true;      
    }else{return false;} 
}

/**
* @desc Get Testimonial Charter
* @return array
*/ 
function getTestiCharter($max = ""){
    
    $CI =& get_instance();
    $CI->db->select('*');
    $CI->db->from('testimonial_charter');
    if($max !== ""){
        $CI->db->limit(3);
    }
    $CI->db->order_by('tc_id', 'DESC');
    $query = $CI->db->get();
    if($query->num_rows() > 0){
       return $query->result_array();      
    }else{return null;} 
}