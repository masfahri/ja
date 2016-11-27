<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @author JempolAsik
 * @date 30/10/2016
 */ 
class Mapp_laporan extends CI_Model{
    
    public function lapAllClass()
    {
        $this->db->select('*')
                 ->from('ja_data_absen')
                 ->order_by('id_kelas', 'ASC');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }else
            return null;
    }
     public function getabsen($jam='')
    {      
        $tgl      = date('Y-m-d');
        $this->db->select('ja_data_absen.*, ja_siswa.id_kelas, ja_kelas.Nama_Kelas')
                 ->select('ja_siswa.nama_siswa as nama')
                 ->select('time(jam_masuk) as jm')
                 ->select('time(jam_pulang) as jp')
                 ->where('date(jam_masuk) =', $tgl)
                 ->from('ja_data_absen')
                 ->join('ja_siswa','ja_data_absen.pin = ja_siswa.pin','LEFT')                     
                 ->join('ja_kelas','ja_siswa.id_kelas = ja_kelas.id_kelas','LEFT')
                 ->order_by('ja_data_absen.pin', 'ASC')
                 ->group_by('ja_data_absen.pin');                               
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else 
            return null;
    }
    
}