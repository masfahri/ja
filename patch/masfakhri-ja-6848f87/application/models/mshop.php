<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mshop extends CI_Model{
    
    public function getAllCategory(){
        
        $this->db->select('*');
        $this->db->from('product_category');
        $this->db->order_by('category_name', 'DESC');
        $query = $this->db->get();
        if($query->num_rows() > 0){
          return $query->result_array();  
        }else return null;
    }

    public function getNumAllCategory(){
        
        $this->db->select('*');
        $this->db->from('product_category');
        $this->db->order_by('category_name', 'DESC');
        $query = $this->db->get();
        if($query->num_rows() > 0){
          return $query->num_rows();  
        }else return null;
    }

    public function getInstruct($id){
        
        $this->db->select('*');
        $this->db->from('get_shop');
        $this->db->where('id', $id);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->row_array();
        }else return null;
    }
      
  
    public function getTotalProducts(){
        
        $this->db->select('*');
        $this->db->from('product');
        $this->db->order_by('product_id', 'DESC');
        $query = $this->db->get();
        return $query->num_rows();
    }
    
    public function getAllProduct($product_id = ""){

        $this->db->select('product.*,
        product_category.product_category_id, product_category.category_name, product_image.product_image_id, product_image.product_id, product_image.file, product_image.extention');
        $this->db->from('product');
        $this->db->join('product_category', 'product_category.category_name = product.product_category', 'inner');
        $this->db->join('product_image', 'product_image.product_id = product.product_id', 'inner');
        if( $product_id !== "" ){
            $this->db->where('product_category.category_name', $product_id);
        }
        $this->db->group_by('product.product_id');
        $this->db->order_by('product.product_id', 'DESC');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            if( $product_id !== "" ){
                return $query->row_array();
            }else{
                return $query->result_array();
            }
        }else return null;
    }
           
     public function getAllGallery2($product_id = ""){

        $this->db->select('product.*,
        product_category.product_category_id, product_category.category_name, product_image.product_image_id, product_image.product_id, product_image.file, product_image.extention');
        $this->db->from('product');
        $this->db->join('product_image', 'product_image.product_id = product.product_id', 'RIGHT');
        $this->db->join('product_category', 'product_category.category_name = product.product_category', 'RIGHT');
        if( $product_id !== "" ){
            $this->db->where('product.product_id', $product_id);
        }
        $this->db->order_by('product.product_id', 'DESC');
        $query = $this->db->get();
        if($query->num_rows() > 0){
                return $query->result_array();
        }else return null;
    } 
  
    public function getTotalGallery(){

        $this->db->select('gallery.*, gallery_album.gallery_album_id, gallery_album.album_name, gallery_album.album_title as album_title');
        $this->db->from('gallery');
        $this->db->join('gallery_album', 'gallery_album.gallery_album_id = gallery.gallery_album_id', 'LEFT');
        $query = $this->db->get();
        return $query->num_rows();
    }
    
    public function getAllGalleryImage($limit){
     
        $this->db->select('gallery.*, gallery_album.album_description, gallery_album.album_name, gallery_album.album_title, gallery_album.file');
        $this->db->from('gallery_album');
        $this->db->join('gallery', 'gallery.gallery_album_id = gallery_album.gallery_album_id', 'RIGHT');
        $this->db->where('gallery.type', 'image');
        $this->db->group_by('gallery_album.gallery_album_id');
        $this->db->order_by('gallery_album_id', 'DESC');
        $query = $this->db->get();

        if($query->num_rows() > 0){
            return $query->result_array();
        }else return null;
    }

    public function getAllVideoImage($limit){
     
        $this->db->select('gallery.*, gallery_album.album_description, gallery_album.album_name, gallery_album.album_title, gallery_album.file');
        $this->db->from('gallery_album');
        $this->db->join('gallery', 'gallery.gallery_album_id = gallery_album.gallery_album_id', 'RIGHT');
        $this->db->where('gallery.type', 'video');
        $this->db->group_by('gallery_album.gallery_album_id');
        $this->db->order_by('gallery_album_id', 'DESC');
        $query = $this->db->get();

        if($query->num_rows() > 0){
            return $query->result_array();
        }else return null;
    }  
  
    public function getAllGroupGallery(){
           
        $this->db->select('gallery.*, gallery_album.album_description, gallery_album.album_name, gallery_album.album_title');
        $this->db->from('gallery_album');
        $this->db->join('gallery', 'gallery.gallery_album_id = gallery_album.gallery_album_id', 'RIGHT');
        $this->db->group_by('gallery_album.gallery_album_id');
        $this->db->order_by('gallery.gallery_id', 'DESC');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else return null;
    }
        
    public function getTotalGroupGallery(){
       
        $this->db->select('gallery.*, gallery.date as lastgallery_date,  gallery_album.album_name, gallery_album.album_description, gallery_album.album_title');
        $this->db->from('gallery');
        $this->db->join('gallery_album', 'gallery_album.gallery_album_id = gallery.gallery_album_id', 'LEFT');
        
        $query = $this->db->get();
        return $query->num_rows();
    }
    
    public function recordView($album_id){
        
        $this->db->select('*');
        $this->db->from('log_album_view');
        $this->db->where('album_id', $album_id);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            
            // do update
            $count = $query->row('view') + 1;
            $dataUpdate = array('view' => $count);
            $this->db->where('album_id', $album_id);
    		$update = $this->db->update('log_album_view', $dataUpdate);
    		if ( ! $update )
    		{
    			return 0;
    		}else{ return 1; }
            
        }else{
            
            // do insert
            $dataInsert = array(
            'album_id'   => $album_id,
            'view'      => 1
            );
            if( $this->db->insert('log_album_view', $dataInsert) ){
                return 1;  
            }else return 0;
        }
    }
    
    public function recordLoved($album_id){
        
        $this->db->select('*');
        $this->db->from('log_album_loved');
        $this->db->where('album_id', $album_id);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            
            // do update
            $count = $query->row('view') + 1;
            $dataUpdate = array('view' => $count);
            $this->db->where('album_id', $album_id);
    		$update = $this->db->update('log_album_loved', $dataUpdate);
    		if ( ! $update )
    		{
    			return 0;
    		}else{ return 1; }
            
        }else{
            
            // do insert
            $dataInsert = array(
            'album_id'   => $album_id,
            'view'      => 1
            );
            if( $this->db->insert('log_album_loved', $dataInsert) ){
                return 1;  
            }else return 0;
        }
    }
    
    public function getVideoIntro(){
        
        $this->db->select('gallery.*, gallery_album.album_name, gallery_album.album_title');
        $this->db->from('gallery');
        $this->db->join('gallery_album', 'gallery_album.gallery_album_id = gallery.gallery_album_id', 'RIGHT');
        $this->db->where('gallery.gallery_album_id', 14);
        $this->db->where('gallery.video_intro', 'yes');
        $this->db->order_by('gallery.gallery_id', 'RANDOM');
        $this->db->limit(1);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else return null;
    }
    
    public function getVideoPreview($gallery_id){
        
        $this->db->select('file');
        $this->db->from('gallery');
        $this->db->where('gallery_id', $gallery_id);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->row('file');
        }else return null;
    }

}