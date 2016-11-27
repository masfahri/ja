<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @author Raka Anggala W.S
 * @date 10/09/2015
 */ 
class Mapp_ads extends CI_Model{
    
    public function getAds($initial_id = "", $offset="", $limit=""){
        
        $this->db->select('ads.*, ads_place.place_name');
        $this->db->from('ads');
        $this->db->join('ads_place', 'ads.ads_place_id = ads_place.ads_place_id', 'LEFT');
        if( $initial_id !== "" ){
            $this->db->where('ads.ads_id', $initial_id);
        }
        if($offset !== "" || $limit !== ""){
            $this->db->limit($offset, $limit);
        }
        $this->db->order_by('ads.ads_id', 'DESC');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            if( $initial_id !== "" ){
                return $query->row_array();
            }else{
                return $query->result_array();
            }
        }else return null;
    }
    
    public function getTotalBanner(){
        
        $this->db->select('banner.*, page.page_name, banner_category.category_name, banner_size.size');
        $this->db->from('banner');
        $this->db->join('page', 'page.page_id = banner.banner_page_id', 'LEFT');
        $this->db->join('banner_category', 'banner_category.banner_category_id = banner.banner_category_id', 'LEFT');
        $this->db->join('banner_size', 'banner_size.banner_size_id = banner.banner_size_id', 'LEFT');
        $query = $this->db->get();
        return $query->num_rows();
    }
    
    public function bannerCategory($page_id){
       
        $this->db->select('*');
        $this->db->from('banner_category');
        $this->db->where('page_id', $page_id);    
        
        $query = $this->db->get();
        if($query->num_rows() > 0)return $query->result_array();
        else return null;
    }
    
    public function Place($ads_place_id){
       
        $this->db->select('*');
        $this->db->from('ads_place');
        $this->db->where('ads_place_id', $ads_place_id);    
        $this->db->order_by('ads_place_id', 'ASC');
        $query = $this->db->get();
        if($query->num_rows() > 0)return $query->result_array();
        else return null;
    }
    
    public function grapImage($initial_id){
        
        $this->db->select('file, extension');
        $this->db->from('ads');
        $this->db->where('ads_id', $initial_id);
        $query = $this->db->get();
        if($query->num_rows() > 0)return $query->row_array();
        else return null;
    }
    
    public function grapImageIn($initial_id){
        
        $this->db->select('file, extention');
        $this->db->from('banner');
        $this->db->where_in('banner_id', $initial_id);
        $query = $this->db->get();
        if($query->num_rows() > 0)return $query->result_array();
        else return null;
    }
}