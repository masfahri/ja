<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mapp_blog extends CI_Model{
    
    public function tableSearch(){
        
        $dataField = array(
        'blog_category.blog_category_name',
        'page_content.title', 
        'page_content.content',
        'blog.create_date',
        'blog.filetype',
        'blog.extention',
        'blog.youtube_id',
        'blog.status'
        ); 
        
        if( isset($_POST['key']) ){
            
            $no  = 0;
            foreach($dataField as $row){
                if($no == 0){
                    $this->db->like($row, $this->input->post('key', true));
                }
                $this->db->or_like($row, $this->input->post('key', true));
                $no++;
            }
        }
    }
    
    /**
    * @desc Grap All user by id privileges
    * @params int
    * @return array 
    */ 
    public function getAllQuotes(){
        
        $this->db->select('*');
        $this->db->from('quotes');
        $this->db->order_by('quotes_id', 'DESC');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }
        else return null;
    }
    
     public function getAllBlog($id_blog = "", $offset="", $limit=""){
        
        $this->db->select('
        blog.*,
        blog_category.blog_category_name,
        page.page_name, 
        page_content.title, 
        page_content.content');
        $this->db->from('blog');
        $this->db->join('blog_category', 'blog_category.blog_category_id = blog.blog_category_id', 'LEFT');
        $this->db->join('page', 'page.page_id = blog.page_id', 'RIGHT');
        $this->db->join('page_content', 'page_content.content_id = blog.blog_id', 'LEFT');
        #-- SEARCH KEYWORD -->
        $this->tableSearch();
        #--- ============ --->
        $this->db->where('page_content.page_category', 'blog');
        if( $id_blog !== "" ){
            $this->db->where('blog_id', $id_blog);
        }
        if($offset !== "" || $limit !== ""){
            $this->db->limit($offset, $limit);
        }

        $this->db->order_by('blog_id', 'DESC');
        $this->db->where('page_content.id_countries', 64);
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
        
        $this->db->select('
        blog.*,
        blog_category.blog_category_name,
        page.page_name, 
        page_content.title, 
        page_content.content');
        $this->db->from('blog');
        $this->db->join('blog_category', 'blog_category.blog_category_id = blog.blog_category_id', 'LEFT');
        $this->db->join('page', 'page.page_id = blog.page_id', 'RIGHT');
        $this->db->join('page_content', 'page_content.content_id = blog.blog_id', 'LEFT');
        #-- SEARCH KEYWORD -->
        $this->tableSearch();
        #--- ============ --->
        $this->db->where('page.page_name', 'blog');
        $this->db->where('page_content.page_category', 'blog');
        
        $query = $this->db->get();
        return $query->num_rows();
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