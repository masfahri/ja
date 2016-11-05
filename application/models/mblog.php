<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mblog extends CI_Model{
    
    
    public function getPagingBlog($blog_id = "", $offset="", $limit=""){
        
        $this->db->select('blog.*, page.page_name, page_content.title, page_content.content');
        $this->db->from('blog');
        $this->db->join('page', 'page.page_id= blog.page_id', 'LEFT');
        $this->db->join('page_content', 'page_content.content_id= blog.blog_id', 'LEFT');
        $this->db->where('page_content.id_countries', 64);
        $this->db->where('page_content.page_category', 'blog');
        if($blog_id !== ""){
            $this->db->where('blog_id', $blog_id);
        }
        $this->db->where('blog.status', 'publish');
        if($offset !== "" || $limit !== ""){
            $this->db->limit($offset, $limit);
        }
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else return null;
    }
    
    public function getPagingTotalBlog(){
        
        $this->db->select('blog.*, page.page_name, page_content.title, page_content.content');
        $this->db->from('blog');
        $this->db->join('page', 'page.page_id= blog.page_id', 'LEFT');
        $this->db->join('page_content', 'page_content.content_id= blog.blog_id', 'LEFT');
        $this->db->where('page_content.id_countries', 64);
        $this->db->where('page_content.page_category', 'blog');
        $this->db->where('blog.status', 'publish');
        $query = $this->db->get();
        return $query->num_rows();
        
    }
}