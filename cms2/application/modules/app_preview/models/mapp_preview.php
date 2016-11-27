<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mapp_preview extends CI_Model{
    
     public function getAllBlog($id_blog = "", $offset="", $limit=""){
        
        $this->db->select('blog.*, page.*, blog_category.blog_category_name, sys_administrator.nickname, province.*');
        $this->db->from('blog');
        $this->db->join('page', 'page.page_id = blog.blog_page_id', 'LEFT');
        $this->db->join('blog_category', 'blog_category.blog_category_id = blog.blog_category_id', 'LEFT');
        $this->db->join('sys_administrator', 'sys_administrator.id_administrator = blog.author', 'LEFT');
        $this->db->join('province', 'province.id_provinsi = blog.province_id', 'LEFT');
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
}