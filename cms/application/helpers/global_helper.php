<?php
/**
 * @desc get website config
 * @return array
 */
function getConfig(){
    
    $CI =& get_instance();
    $CI->db->select('*');
    $CI->db->from('web_setup');
    $CI->db->where('web_setup_id', 1);
    $query = $CI->db->get();
    if($query->num_rows() > 0) return $query->row_array();
    else return null;
}

function getUserPrivilegesName($id_privileges){
    
    $CI =& get_instance();
    $CI->db->select('sys_privileges_name');
    $CI->db->from('sys_privileges');
    $CI->db->where('sys_privileges_id', $id_privileges);
    $query = $CI->db->get();
    if( $query->num_rows() > 0 ){
        return strtoupper($query->row('sys_privileges_name'));
    }else{
        return null;
    }
}

/**
* @desc Send and Processing Form Method POST or GET
* @params method var
* @return array 
*/ 
function bindProcessing($method){
    
    if($method){
        $data = array();
        foreach($method as $index => $value){$data[$index] = $value;}
        return $data;
    }
}


function getLastProductImage($product_id = "", $limit = ""){
         
        $CI =& get_instance();         
        $CI->db->select('*');
        $CI->db->from('gallery');
        if($product_id !== ""){
            $CI->db->where('gallery_id',  $product_id);
        }
        if($limit !== ""){
           $CI->db->limit($limit);
        }
        $CI->db->order_by('gallery_id');        
        $query = $CI->db->get();
        if($query->num_rows()>0){
            if($limit == 1){
                return $query->row_array();
            }else{
                return $query->result_array();
            }
        }else return null;
}    

/**
* @desc *Form Get Reback Value from Method Post or Datababind 
* @params string
* @return string
*/
function rebackPost($datapost, $datadb){
    
    if( isset($_POST[$datapost]) ){
        return $_POST[$datapost];
    }else{
        if( $datadb !== "" ){return $datadb;
        }else{ return ''; }
    }
}

/** 
@desc Author Name
**/
function getAuthorName($intial_id){
    
    $CI =& get_instance();
    $CI->db->select('nickname');
    $CI->db->from('sys_administrator');
    $CI->db->where('id_administrator', $intial_id);
    $query = $CI->db->get();
    if( $query->num_rows() > 0 ){
        return $query->row('nickname');
    }else{
        return null;
    }
}


/** 
* @desc Breadcrumb Page Initial
* @params string
* @params string
* @return string
**/
function showBreadCrumb($app_name, $uri){

    $CI =& get_instance();
    $exceptionPage = array('app_websetup', 'app_contact');
    $output = '';
    switch($uri){
        
        case "data":
            $output = '<li>Master Data</li>';
        break;
        case "add":
           $output = '
           <li><a href="'.base_url($app_name).'/data">Master Data</a></li>
           <li>Form Input</li>';
        break;
        case "edit":
            
            if( ! in_array($CI->uri->segment(1), $exceptionPage) ){
               $output = '
               <li><a href="'.base_url($app_name).'/data">Master Data</a></li>
               <li>Form Edit</li>';
            }else{ $output = '<li>Form Edit</li>';}
            
        break;
}

return $output;
}


function activeBreadcrumb($app_name, $uri){

    $CI =& get_instance();
    if( is_array($app_name) > 0     ){
       if( in_array($CI->uri->segment($uri), $app_name) )return 'id="active"';
    }else{
        if($app_name == $CI->uri->segment($uri)) return 'id="active"';
    }
}

/**
* @desc Convert string to datetime
* @params string
* @return string 
*/
function humanDate($str){

    return date('Y-m-d h:i:s', strtotime($str));
}

/**
* @desc Checking default language
* @params int
* @return boolean
*/
function checkAsDefaultLang($countries_id){
    
    $CI =& get_instance();
    $CI->db->select('active_lang');
    $CI->db->from('web_setup');
    $CI->db->where('active_lang', $countries_id);
    $query = $CI->db->get();
    if($query->num_rows() > 0)return TRUE;
    else return FALSE;
}

function getSettingLang(){
    
    $CI =& get_instance();
    $CI->db->select('*');
    $CI->db->from('countries');
    $CI->db->where('active', 'yes');
    $query = $CI->db->get();
    if($query->num_rows() > 0)return $query->result_array();
    else return null;
}


function getActiveLang(){

    $CI =& get_instance();
    $CI->db->select('active_lang');
    $CI->db->from('web_setup');
    $CI->db->where('web_setup_id', 1);
    $query = $CI->db->get();
    if($query->num_rows() > 0)return $query->row('active_lang');
    else return null;   
}

function getContentLang($content_id,  $id_countries){

    $CI =& get_instance();
    $CI->db->select('*');
    $CI->db->from('page_content');
    $CI->db->where('content_id', $content_id);
    $CI->db->where('id_countries', $id_countries);
    $query = $CI->db->get();
    if($query->num_rows() > 0)return $query->row('content');
    else return null;
}

function getPageContentId($page_category, $content_id, $id_countries){
        
    $CI =& get_instance();
    $CI->db->select('*');
    $CI->db->from('page_content');
    $CI->db->where('page_category', $page_category);
    $CI->db->where('content_id', $content_id);
    $CI->db->where('id_countries', $id_countries);
    
    $query = $CI->db->get();
    if($query->num_rows() > 0){return $query->row('page_content_id');
    }else{return null;} 
}

function getContent($target, $content_id, $id_countries){
    
    $CI =& get_instance();
    $CI->db->select($target);
    $CI->db->from('page_content');
    $CI->db->where('content_id', $content_id);
    $CI->db->where('id_countries', $id_countries);
    $query = $CI->db->get();
    if($query->num_rows() > 0){
        
        if( $target !== "*" ){
            return $query->row($target);
        }else{
            return null;
        }
           
    }else return null;

}

?>