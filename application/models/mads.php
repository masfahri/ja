<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mads extends CI_Model{

    public function getAds($initial_id){
        
        $this->db->select('ads.*, ads_place.ads_place_id, ads_place.place_name');
        $this->db->from('ads');
        $this->db->join('ads_place', 'ads.ads_place_id = ads_place.ads_place_id', 'LEFT');
        $this->db->where('ads.status', 'publish');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else return null;
    }

}