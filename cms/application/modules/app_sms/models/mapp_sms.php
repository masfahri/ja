<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @author JempolAsik
 * @date 30/10/2016
 */ 
class Mapp_sms extends CI_Model{
    
    public function getKatIzin(){
        
        $this->db->select('*');
        $this->db->from('ja_kategori_izin');
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();
        if($query->num_rows() > 0){
                return $query->result_array();
        }else return null;
    }


    public function grapKatIzin($initial_id){
        
        $this->db->select('*');
        $this->db->from('ja_kategori_izin');
        $this->db->where('id', $initial_id);
        $query = $this->db->get();
        if($query->num_rows() > 0)return $query->row_array();
        else return null;
    }

    public function getGuru(){
        
        $this->db->select('*');
        $this->db->from('ja_guru');
        $this->db->order_by('No', 'ASC');
        $query = $this->db->get();
        if($query->num_rows() > 0){
                return $query->result_array();
        }else return null;
    }

    public function grapGuru($initial_id){
        
        $this->db->select('*');
        $this->db->from('ja_guru');
        $this->db->where('nip', $initial_id);
        $query = $this->db->get();
        if($query->num_rows() > 0)return $query->row_array();
        else return null;
    }

    public function grapSettings($initial_id=''){
        
        $this->db->select('*')
                 ->from('ja_settings');
        $this->db->where('name', $initial_id);
        $query = $this->db->get();
        if($query->num_rows() > 0)return $query->result();
        else return null;
    }

    public function getSiswa(){
        
        $this->db->select('*')
                 ->from('ja_siswa')
                 ->join('ja_kelas', 'ja_siswa.id_kelas=ja_kelas.id_kelas');
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();
        if($query->num_rows() > 0){
                return $query->result_array();
        }else return null;
    }

    public function grapSiswa($initial_id){
        
        $this->db->select('*')
                 ->from('ja_siswa');
        $this->db->where('id', $initial_id);
        $query = $this->db->get();
        if($query->num_rows() > 0)return $query->row_array();
        else return null;
    }

    public function getKelamin($initial_id = ''){
        $this->db->select('kelamin')
                 ->from('ja_siswa')
                 ->where('id', $initial_id);
        $query = $this->db->get();
        if($query->num_rows() > 0)return $query->row_array();
        else return null;
    } 

    public function getHariLibur($initial_id = ''){
        $this->db->select('*');
        $this->db->from('ja_hari_libur');
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();
        if($query->num_rows() > 0){
                return $query->result_array();
        }else return null;
    }    

    public function grapHariLibur($initial_id){
        
        $this->db->select('*');
        $this->db->from('ja_hari_libur');
        $this->db->where('id', $initial_id);
        $query = $this->db->get();
        if($query->num_rows() > 0)return $query->row_array();
        else return null;
    }    

    public function getJurusan(){
        
        $this->db->select('*');
        $this->db->from('ja_jurusan');
        $this->db->order_by('id_jurusan', 'ASC');
        $query = $this->db->get();
        if($query->num_rows() > 0){
                return $query->result_array();
        }else return null;
    }

    public function grapJurusan($initial_id){
        
        $this->db->select('*');
        $this->db->from('ja_jurusan');
        $this->db->where('id_jurusan', $initial_id);
        $query = $this->db->get();
        if($query->num_rows() > 0)return $query->row_array();
        else return null;
    }    

    public function getKelas(){
        $this->db->select('*');
        $this->db->from('ja_kelas');
        $this->db->join('ja_jurusan', 'ja_kelas.id_jurusan=ja_jurusan.id_jurusan', 'LEFT');
        $this->db->join('ja_guru','ja_guru.No=ja_kelas.id_guru', 'LEFT');
        $query = $this->db->get();
        if($query->num_rows() > 0)
            return $query->result_array();
        else return null;         
    }

    public function grapKelas($initial_id){
        
        $this->db->select('*');
        $this->db->from('ja_kelas');
        $this->db->where('id_kelas', $initial_id);
        $query = $this->db->get();
        if($query->num_rows() > 0)return $query->row_array();
        else return null;
    }    

    public function getKaryawan(){
        $this->db->select('*');
        $this->db->from('ja_karyawan');
        $this->db->order_by('id_karyawan', 'ASC');
        $query = $this->db->get();
        if($query->num_rows() > 0){
                return $query->result_array();
        }else return null;       
    }

    public function grapKaryawan($initial_id){
        
        $this->db->select('*');
        $this->db->from('ja_karyawan');
        $this->db->where('id_karyawan', $initial_id);
        $query = $this->db->get();
        if($query->num_rows() > 0)return $query->row_array();
        else return null;
    }        


    /**
    * @desc Check available username on table
    * @params string
    * @params int
    * @return array 
    */ 
    function checkAvailableUser($username, $initial_id = ''){
        
        $this->db->select('nip');
        $this->db->from('ja_guru');
        if( $initial_id !== "" ){
            $this->db->where_not_in('nip', $initial_id);
        }
        $this->db->where('nip', $username);
        $query = $this->db->get();
        if( $query->num_rows() > 0 )return TRUE;
        else FALSE;
    }
    
    /**
    * @desc Check available username on table
    * @params string
    * @params int
    * @return array 
    */ 
    function checkAvailableSiswa($username, $initial_id = ''){
        
        $this->db->select('nis');
        $this->db->from('ja_siswa');
        if( $initial_id !== "" ){
            $this->db->where_not_in('nis', $initial_id);
        }
        $this->db->where('nis', $username);
        $query = $this->db->get();
        if( $query->num_rows() > 0 )return TRUE;
        else FALSE;
    }

    /**
    * @desc Check available username on table
    * @params string
    * @params int
    * @return array 
    */ 
    function checkAvailableKelas($nama, $initial_id = ''){
        
        $this->db->select('*');
        $this->db->from('ja_kelas');
        if( $initial_id !== "" ){
            $this->db->where_not_in('Nama_Kelas', $initial_id);
        }
        $this->db->where('Nama_Kelas', $nama);
        $query = $this->db->get();
        if( $query->num_rows() > 0 )return TRUE;
        else FALSE;
    }    

    public function grapImage($initial_id){
        
        $this->db->select('file, extention');
        $this->db->from('page_merchant');
        $this->db->where_in('id', $initial_id);
        $query = $this->db->get();
        if($query->num_rows() > 0)return $query->result_array();
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