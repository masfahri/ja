<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mapp_album extends CI_Model{
    
    public function getAlbums($gallery_album_id = "", $offset="", $limit=""){
        
        $this->db->select('*');
        $this->db->from('gallery_album');
        if( $gallery_album_id !== "" ){
            $this->db->where('gallery_album_id', $gallery_album_id);
        }
        if($offset !== "" || $limit !== ""){
            $this->db->limit($offset, $limit);
        }
        $this->db->order_by('gallery_album_id', 'DESC');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            if( $gallery_album_id !== "" ){
                return $query->row_array();
            }else{
                return $query->result_array();
            }
        }else return null;
    }
    
    public function getTotalAlbum(){
        
        $this->db->select('*');
        $this->db->from('gallery_album');
        $query = $this->db->get();
        return $query->num_rows();
    }

}