<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mapp_blog_category extends CI_Model{
    
    public function getBlogCategory($id_category = "", $offset="", $limit=""){
        
        $this->db->select('blog_category.*, page.page_name');
        $this->db->from('blog_category');
        $this->db->join('page', 'page.page_id = blog_category.page_id', 'LEFT');
        if( $id_category !== "" ){
            $this->db->where('blog_category_id', $id_category);
        }
        if($offset !== "" || $limit !== ""){
            $this->db->limit($offset, $limit);
        }
        $this->db->order_by('blog_category.order_no', 'DESC');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            if( $id_category !== "" ){
                return $query->row_array();
            }else{
                return $query->result_array();
            }
        }else return null;
    }
    
    public function getTotalBlogCategory(){
        
        $this->db->select('blog_category.*, page.page_name');
        $this->db->from('blog_category');
        $this->db->join('page', 'page.page_id = blog_category.page_id', 'LEFT');
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function getSubChildCategory($category_id){
        
        $this->db->select('*');
        $this->db->from('blog_category_child');
        $this->db->where('blog_category_child_id', $category_id);
        $this->db->order_by('blog_category_id', 'DESC');
        $query = $this->db->get();
        if( $query->num_rows() > 0)return $query->result_array();
        else return null;
    }
}