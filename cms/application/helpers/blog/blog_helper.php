<?php
    
    function getPageBlog(){
        
        $CI =& get_instance();   
        $CI->db->select('*');
        $CI->db->from('page');
        $CI->db->where('blog', 'yes');
        $query = $CI->db->get();
        if($query->num_rows()>0){
            return $query->result_array();
        }else return null;
    }
    
    function countTotalChild($category_id){
        
        $CI =& get_instance();   
        $CI->db->select('*');
        $CI->db->from('blog_category_child');
        $CI->db->where('blog_category_id', $category_id);
        $query = $CI->db->get();
        return $query->num_rows();
    }
    
    function checkDbId($cat_id){
        
        $CI =& get_instance();   
        $CI->db->select('blog_category_child_id');
        $CI->db->from('blog_category_child');
        $CI->db->where('blog_category_child_id', $cat_id);
        $query = $CI->db->get();
        if($query->num_rows()>0){
            return TRUE;
        }else return FALSE;
    }
	
    function get_blogCategory($page_id = ""){
        
        $CI =& get_instance();   
        $CI->db->select('*');
        $CI->db->from('blog_category');
        if( $page_id !== "" ){
             $CI->db->where('page_id', $page_id);
        }
       
        $query = $CI->db->get();
        if($query->num_rows()>0){
            return $query->result_array();
        }else return null;
    }
    
    function get_blogStaticCategory($page_id){
       
        $CI =& get_instance();   
        $CI->db->select('*');
        $CI->db->from('blog_static_category');
        $CI->db->where('page_id', $page_id);
        $query = $CI->db->get();
        if($query->num_rows()>0){
            return $query->result_array();
        }else return null;
    }
    
    function getTaglineByCategory($category_id){
        
        $CI =& get_instance();   
        $CI->db->select('*');
        $CI->db->from('blog_tag');
        $CI->db->where('blog_category_id', $category_id);
        $query = $CI->db->get();
        if($query->num_rows()>0){
            return $query->result_array();
        }else return null;
    }
    
    function getTotalSubCategoryBlog($category_id){
        
        $CI =& get_instance();   
        $CI->db->select('child_category_id');
        $CI->db->from('blog_child_category' );
        $CI->db->where('category_id', $category_id);
        $query = $CI->db->get();
        if($query->num_rows()>0){
            return '<span>('.$query->num_rows().') child</span>';
        }else return '<span class="gray-text">empty</span>';
    }
    
    function getBlogSubCategory($category_id){
        
        $CI =& get_instance();   
        $CI->db->select('*');
        $CI->db->from('blog_child_category');
        $CI->db->where('category_id', $category_id);
        $query = $CI->db->get();
        if($query->num_rows()>0){
            return $query->result_array();
        }else return null;
    }
    
    
    /** 
     @desc View
    **/
    function getTotalViewBlog($blog_id){
            
        $CI =& get_instance();
        $CI->db->select('view');
        $CI->db->from('log_article_view');
        $CI->db->where('blog_id', $blog_id);
        $query = $CI->db->get();
        if( $query->num_rows() > 0 ){
            return $query->row('view');
        }else{
            return 0;
        }
    }
  
    function get_blogCategoryByCat($blogCat, $targetField){
        
        $CI =& get_instance();   
        $CI->db->select('*');
        $CI->db->from('blog_category');
        $CI->db->where('blog_category_id', $blogCat);
        $query = $CI->db->get();
        if($query->num_rows()>0){
            return $query->row($targetField);
        }else return '<span class="gray-text">no category</span>';
    }
    
?>