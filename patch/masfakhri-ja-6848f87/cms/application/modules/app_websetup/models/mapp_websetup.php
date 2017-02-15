<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mapp_websetup extends CI_Model{
    
    
      public function bindDataSetup($initial_id=""){
        
            $this->db->select('*');
            $this->db->from('web_setup');
            if( $initial_id !== "" ){
                $this->db->where('web_setup_id', $initial_id);
            }
            $this->db->order_by('web_setup_id', 'DESC');
            $query = $this->db->get();
            if( $query->num_rows() > 0 ){
                if( $initial_id !== "" ){
                   return $query->row_array();
                }else{
                   return $query->result_array();  
                }
                
            }else return null;
      }

    /**
    * @desc Check available username on table
    * @params string
    * @params int
    * @return array 
    */ 
    function checkAvailableFp($username, $initial_id = ''){
        
        $this->db->select('ip');
        $this->db->from('ja_fp');
        if( $initial_id !== "" ){
            $this->db->where_not_in('ip', $initial_id);
        }
        $this->db->where('ip', $username);
        $query = $this->db->get();
        if( $query->num_rows() > 0 )return TRUE;
        else FALSE;
    }

      public function getFp($id_kelas=''){
          if($id_kelas != ''){
            $$this->db->where('keterangan', $id_kelas);
          }
          $this->db->select('*');
          $this->db->from('ja_fp');

          $this->db->order_by('id', 'ASC');
          $query = $this->db->get();
          if($query->num_rows() > 0){
                  return $query->result_array();
          }else return null;
      }      
      
    public function grapFp($initial_id){
        
        $this->db->select('*');
        $this->db->from('ja_fp');
        $this->db->where('id', $initial_id);
        $query = $this->db->get();
        if($query->num_rows() > 0)return $query->row_array();
        else return null;
    }

      public function getInOut(){
          
          $this->db->select('*');
          $this->db->from('ja_in_out');

          $this->db->order_by('id', 'ASC');
          $query = $this->db->get();
          if($query->num_rows() > 0){
                  return $query->result_array();
          }else return null;
      }      

    public function grapInOut2($initial_id=''){
        if($initial_id != '') {
          $this->db->where('id', $initial_id);              
        }
        $this->db->select('*');
        $this->db->from('ja_in_out');
        $tanggal = date('D');
        $jam = date('H');
        //var_dump($tanggal);
        $this->db->or_where('jam_masuk', date('H'));        
        $query = $this->db->get();
        if($query->num_rows() > 0)return $query->result_array();
        else return null;
    }
      
    public function grapInOut($initial_id=''){
        if($initial_id != '') {
          $this->db->where('id_kelas', $initial_id);              
        }
        $this->db->select('*');
        $this->db->from('ja_in_out');
        $tanggal = date('D');
        $jam = date('H');
        //var_dump($tanggal);
        $this->db->where('hari', $tanggal);
    
        $this->db->or_where('jam_masuk', date('H'));        
        $query = $this->db->get();
        if($query->num_rows() > 0)return $query->result_array();
        else return null;
    }

      public function getDataLang(){
        
            $this->db->select('*');
            $this->db->from('countries');
            $this->db->where('active', 'yes');
            $this->db->order_by('countries_name', 'ASC');
            $query = $this->db->get();
            if( $query->num_rows() > 0 ){
                return $query->result_array();  
            }else return null;
      }
      
      public function getDataCur(){
        
            $this->db->select('*');
            $this->db->from('currency');
            $this->db->order_by('currency_name', 'ASC');
            $query = $this->db->get();
            if( $query->num_rows() > 0 ){
                return $query->result_array();  
            }else return null;
      }
      
      public function grapImage(){
        
        $this->db->select('file, extention, favicon');
        $this->db->from('web_setup');
        $this->db->where('web_setup_id', 1);
        $query = $this->db->get();
        if($query->num_rows() > 0)return $query->row_array();
        else return null;
    }
    
      public function bindDataPage(){
        
        $this->db->select('*');
        $this->db->from('page_contact');
        $this->db->where('contact_id', 1);
        $query = $this->db->get();
        if( $query->num_rows() > 0 ){
            return $query->row_array();
        }else return null;
      }

      public function getSocial(){
        
        $this->db->select('*');
        $this->db->from('social');
        $this->db->where('id_social', 1);
        $query = $this->db->get();
        if( $query->num_rows() > 0 ){
            return $query->row_array();
        }else return null;
      }    


      
}