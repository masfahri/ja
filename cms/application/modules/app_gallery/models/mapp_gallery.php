<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mapp_gallery  extends CI_Model{
   
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

      public function getBanner2($initial_id)
      {
        
            $this->db->select('*');
            $this->db->from('gallery_get');
            $this->db->where('id_banner', $initial_id);
            $this->db->order_by('id_banner', 'ASC');
            $query = $this->db->get();
            if( $query->num_rows() > 0 ){
                return $query->row_array();  
            }else return null;
      }
       

    public function getPhoto($gallery_id = "", $offset="", $limit=""){
        
        $this->db->select('*');
        $this->db->from('gallery');
        #-- SEARCH KEYWORD -->
        $this->tableSearch();
        #--- ============ --->
        if( $gallery_id !== "" ){
            $this->db->where('gallery_album_id', $gallery_id);
        }
        
        if($offset !== "" || $limit !== ""){
            $this->db->limit($offset, $limit);
        }
        $this->db->order_by('gallery_album_id', 'DESC');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            if( $gallery_id !== "" ){
                return $query->row_array(); 
            }else{
                return $query->result_array(); 
            }
        }else return null;
    }
       
    public function getAllGallery($album_id=""){
     
        $this->db->select('gallery.*, gallery_album.album_name, gallery_album.album_title, gallery_album.album_description, gallery_album.file, gallery_album.extention');
        $this->db->from('gallery_album');
        $this->db->join('gallery', 'gallery.gallery_album_id = gallery_album.gallery_album_id', 'LEFT');
        if( $album_id !== "" ){
            $this->db->where('gallery.gallery_album_id', $album_id);
        }
        $this->db->order_by('gallery_id', 'DESC');
        $query = $this->db->get();

        if($query->num_rows() > 0){
            return $query->result_array();
        }else return null;
    }
        

    public function getAllPhoto(){
        
        $this->db->select('*');
        $this->db->from('gallery');
        $this->db->order_by('gallery_id', 'DESC');
        $query = $this->db->get();
        if($query->num_rows() > 0){
                return $query->result_array(); 
        }else return null;
    }

    public function getAllAlbum(){
        
        $this->db->select('*');
        $this->db->from('gallery_album');
        $this->db->order_by('gallery_album_id', 'DESC');
        $query = $this->db->get();
        if($query->num_rows() > 0){
                return $query->result_array(); 
        }else return null;
    }

    public function getAlbum($initial_id){
        
        $this->db ->select("*")
                  ->from("gallery_album")
                  ->join("gallery", "gallery.gallery_album_id=gallery_album.gallery_album_id",'left')
                  ->where('gallery.gallery_album_id', $initial_id)
                  ->order_by("gallery.gallery_id","DESC");
        $query = $this->db->get();
        if ($query->num_rows()>0) 
          {
            return $query->result_array();    
          }else return null;
    }

    public function getAlbumById($initial_id){
        
        $this->db->select('*');
        $this->db->from('gallery_album');
        $this->db->where('gallery_album_id', $initial_id);
        $this->db->order_by('gallery_album_id', 'ASC');
        $query = $this->db->get();
        if($query->num_rows() > 0){
                return $query->row_array();
        }else return null;
    }    

    public function getPhotoById($initial_id){
        
        $this->db->select('*');
        $this->db->from('gallery');
        $this->db->where('gallery_album_id', $initial_id);
        $this->db->order_by('gallery_album_id', 'ASC');
        $query = $this->db->get();
        if($query->num_rows() > 0){
                return $query->row_array();
        }else return null;
    }    
       
    public function getTotalAlbum(){
        
        $this->db->select('*');
        $this->db->from('gallery_album');
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function getTotalPhoto(){
        
        $this->db->select('*');
        $this->db->from('gallery');
        #-- SEARCH KEYWORD -->
        $this->tableSearch();
        #--- ============ --->
        $this->db->order_by('gallery_id', 'DESC');
        $query = $this->db->get();
        return $query->num_rows();
    }
    
    public function grapOnlyImage($gallery_id){
        
        $this->db->select('file, extention');
        $this->db->from('gallery');
        $this->db->where('gallery_album_id', $gallery_id);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->row_array();
        }else return null;
    }
    
    public function grapImage($gallery_id){
        
        $this->db->select('file, extention');
        $this->db->from('gallery');
        $this->db->where('gallery_id', $gallery_id);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else return null;
    }
    
     public function grapImageIn($gallery_id){
        
        $this->db->select('file, extention');
        $this->db->from('gallery');
        $this->db->where_in('gallery_id', $gallery_id);
        $query = $this->db->get();
        if($query->num_rows() > 0){
           return $query->result_array();
        }else return null;
    }
}