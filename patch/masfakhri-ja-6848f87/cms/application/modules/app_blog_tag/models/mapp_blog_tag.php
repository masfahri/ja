<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mapp_blog_tag extends CI_Model{
    
    public function getAllTag($id_tag = ""){
        
        $this->db->select('blog_tag.*, blog_category.blog_category_name');
        $this->db->from('blog_tag');
        $this->db->join('blog_category', 'blog_category.blog_category_id = blog_tag.blog_category_id', 'LEFT');
        if( $id_tag !== "" ){
            $this->db->where('blog_tag.blog_tag_id', $id_tag);
        }
        
        $this->db->order_by('blog_tag.blog_tag_id', 'DESC');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            if( $id_tag !== "" ){
                return $query->row_array();
            }else{
                return $query->result_array();
            }
        }else return null;
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
}