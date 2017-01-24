<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mapp_blog_static extends CI_Model{
    
     public function getAllBlog($id_blog = "", $page_name){
        
        $this->db->select('blog_static.*, blog_static_category.blog_category_name, page.page_name, page_content.title, page_content.content');
        $this->db->from('blog_static');
        $this->db->join('blog_static_category', 'blog_static_category.blog_category_id = blog_static.blog_category_id', 'LEFT');
        $this->db->join('page_content', 'page_content.content_id = blog_static.blog_id');
        $this->db->join('page', 'page.page_id = blog_static_category.page_id','LEFT');
        $this->db->where('blog_static.blog_id', $id_blog);
        $this->db->where('page_content.page_category', $page_name);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            if( $id_blog !== "" ){
                return $query->row_array();
            }else{
                return $query->result_array();
            }
        }else return null;
    }
    
    public function getDataPage($page_id = ""){
       
        $this->db->select('*'); 
        $this->db->from('page');
        if( $page_id !== "" ){
            $this->db->where('page_id', $page_id);
        }
        
        $query = $this->db->get();
        if($query->num_rows()>0){
            if( $page_id !== "" ){
               return $query->row_array(); 
            }else{
               return $query->result_array();   
            }
        }else return null;
    }
    
     public function grapBlogImage($id_blog){
        
        $this->db->select('file, extention');
        $this->db->from('blog_static');
        $this->db->where('blog_id', $id_blog);
        $query = $this->db->get();
        if($query->num_rows() > 0){
           return $query->row_array();
        }else return null;
    }
    
     public function grapBlogImageIn($id_blog){
        
        $this->db->select('file, extention');
        $this->db->from('blog_static');
        $this->db->where_in('blog_id', $id_blog);
        $query = $this->db->get();
        if($query->num_rows() > 0){
           return $query->row_array();
        }else return null;
    }
}