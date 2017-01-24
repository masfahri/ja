<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mrep_blog extends CI_Model{
          
    public function getAllBlog($id_blog = "", $blog_category_id = "", $offset="", $limit=""){
        
        $this->db->select('blog.*, page_content.title, page_content.content, blog_category.blog_category_name, page.page_name');
        $this->db->from('blog');
        $this->db->join('blog_category', 'blog_category.blog_category_id = blog.blog_category_id', 'LEFT');
        $this->db->join('page', 'page.page_id= blog_category.page_id', 'LEFT');
        $this->db->join('page_content', 'page_content.content_id = blog.blog_id', 'LEFT');
        $this->db->where('page.page_name', 'blog');
        $this->db->where('page_content.page_category', 'blog');
        $this->db->where('status', 'publish');
        if( $id_blog !== "" ){
            $this->db->where('blog_id', $id_blog);
        }
        if($offset !== "" || $limit !== ""){
            $this->db->limit($offset, $limit);
        }
        $this->db->order_by('blog_id', 'DESC');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            if( $id_blog !== "" ){
                return $query->row_array();
            }else{
                return $query->result_array();
            }
        }else return null;
    }
    
    public function getTotalBlog(){
       
        $this->db->select('blog.*, page_content.title, page_content.content, blog_category.blog_category_name, page.page_name');
        $this->db->from('blog');
        $this->db->join('blog_category', 'blog_category.blog_category_id = blog.blog_category_id', 'LEFT');
        $this->db->join('page', 'page.page_id= blog_category.page_id', 'LEFT');
        $this->db->join('page_content', 'page_content.content_id = blog.blog_id', 'LEFT');
        $this->db->where('page.page_name', 'blog');
         $this->db->where('page_content.page_category', 'blog');
        $this->db->where('status', 'publish');
        $query = $this->db->get();
        return $query->num_rows();
    }
    
    public function getCategoryPageId($id_category){
        
        $this->db->select('page_id');
        $this->db->from('blog_category');
        $this->db->where('blog_category_id', $id_category);
        $query = $this->db->get();
        if($query->num_rows()){
            return $query->row('page_id');
        }else{ return 0; }
    }
       
    public function getTagByCategory($id_category){
        
        $this->db->select('*');
        $this->db->from('blog_tag');
        $this->db->where('blog_category_id', $id_category);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{ return null; }
    }
    
    public function grapBlogImage($id_blog){
        
        $this->db->select('file, extention');
        $this->db->from('blog');
        $this->db->where('blog_id', $id_blog);
        $query = $this->db->get();
        if($query->num_rows() > 0){
           return $query->row_array();
        }else return null;
    }
    
     public function grapBlogImageIn($id_blog){
        
        $this->db->select('file, extention');
        $this->db->from('blog');
        $this->db->where_in('blog_id', $id_blog);
        $query = $this->db->get();
        if($query->num_rows() > 0){
           return $query->row_array();
        }else return null;
    }
}