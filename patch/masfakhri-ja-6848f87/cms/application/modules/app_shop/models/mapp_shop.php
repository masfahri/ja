<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mapp_shop  extends CI_Model{
   
    public function tableSearch(){
        
        $dataField = array(
        'product_name',
        'product_category', 
        'product_desc',
        'product_spec',
        'deals',
        'location',
        'create_date',
        'author'
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

    public function getDesc($id){

        $this->db->select('*');
        $this->db->from('get_shop');
        $this->db->where('id', $id);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        if($query->num_rows() > 0){
                return $query->row_array(); 
        }else return null;

    }

    public function getProduct($product_id = "", $offset="", $limit=""){
        
        $this->db->select('*');
        $this->db->from('product');
        #-- SEARCH KEYWORD -->
        $this->tableSearch();
        #--- ============ --->
        if( $product_id !== "" ){
            $this->db->where('product_id', $product_id);
        }
        
        if($offset !== "" || $limit !== ""){
            $this->db->limit($offset, $limit);
        }
        $this->db->order_by('product_id', 'DESC');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            if( $product_id !== "" ){
                return $query->row_array(); 
            }else{
                return $query->result_array(); 
            }
        }else return null;
    }
       
    public function getAllProduct(){
        
        $this->db->select('*');
        $this->db->from('product');
        $this->db->order_by('product_id', 'DESC');
        $query = $this->db->get();
        if($query->num_rows() > 0){
                return $query->result_array(); 
        }else return null;
    }

    public function getProductCategory(){
        
        $this->db->select('*');
        $this->db->from('product_category');
        $this->db->order_by('product_category_id', 'ASC');
        $query = $this->db->get();
        if($query->num_rows() > 0){
                return $query->result_array();
        }else return null;
    }

    public function getProductCategoryById($initial_id){
        
        $this->db->select('*');
        $this->db->from('product_category');
        $this->db->where('product_category_id', $initial_id);
        $this->db->order_by('product_category_id', 'ASC');
        $query = $this->db->get();
        if($query->num_rows() > 0){
                return $query->row_array();
        }else return null;
    }    
       
    public function getTotalProductCategory(){
        
        $this->db->select('*');
        $this->db->from('product_category');
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function getTotalProduct(){
        
        $this->db->select('*');
        $this->db->from('product');
        #-- SEARCH KEYWORD -->
        $this->tableSearch();
        #--- ============ --->
        $this->db->order_by('product_id', 'DESC');
        $query = $this->db->get();
        return $query->num_rows();
    }
    
    public function grapOnlyImage($product_image_id){
        
        $this->db->select('file, extention');
        $this->db->from('product_image');
        $this->db->where('product_image_id', $product_image_id);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->row_array();
        }else return null;
    }
    
    public function grapImage($product_id){
        
        $this->db->select('file, extention');
        $this->db->from('product_image');
        $this->db->where('product_id', $product_id);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else return null;
    }
    
     public function grapImageIn($product_id){
        
        $this->db->select('file, extention');
        $this->db->from('product_image');
        $this->db->where_in('product_id', $product_id);
        $query = $this->db->get();
        if($query->num_rows() > 0){
           return $query->result_array();
        }else return null;
    }
}