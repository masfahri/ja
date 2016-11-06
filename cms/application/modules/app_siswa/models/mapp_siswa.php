<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @author JempolAsik
 * @date 30/10/2016
 */ 
class Mapp_siswa extends CI_Model{
    
    public function getKelas(){
        
        $this->db->select('*');
        $this->db->from('ja_kelas');

        $this->db->order_by('id_kelas', 'ASC');
        $query = $this->db->get();
        if($query->num_rows() > 0){
                return $query->result_array();
        }else return null;
    }
    
    public function grapKelas($initial_id){
        
        $this->db->select('*');
        $this->db->from('ja_kelas');
        $this->db->where('id_kelas', $initial_id);
        $query = $this->db->get();
        if($query->num_rows() > 0)return $query->row_array();
        else return null;
    }

                /**        SEMUA SISWA          **/
    public function getSiswa($initial_id='')
    {
        if ($initial_id != '') {
            $this->db->where('id_kelas', $initial_id);
        }
            $tgl = date('Y-m-d');
            $this->db->select('*')
                     ->from('ja_siswa')
                     ->join('ja_absensi_siswa','ja_siswa.nis=ja_absensi_siswa.nis')
                     ->where(array('keterangan =' => 'Hadir', 'tanggal =' => $tgl));
            $query = $this->db->get();

                if($query->num_rows() > 0){
                        return $query->result_array();
                }else return null;
    }

    public function allSiswaInKelas($initial_id='')
    {
        if ($initial_id != '') {
            $this->db->where('ja_siswa.id_kelas', $initial_id);
        }
            $tgl = date('Y-m-d');
            $this->db->select('ja_kelas.*,ja_absensi_siswa.*,ja_siswa.*')
                     ->join('ja_absensi_siswa','ja_absensi_siswa.kd_kelas=ja_siswa.id_kelas','LEFT')                     
                     ->join('ja_kelas','ja_siswa.id_kelas=ja_kelas.id_kelas','INNER')
                     ->from('ja_siswa')
                     ->order_by('ja_siswa.absen', 'ASC');
            $query = $this->db->get();

                if($query->num_rows() > 0){
                        return $query->result_array();
                }else return null;
    }

    public function JumlahSiswa($initial_id='')
    {
        if ($initial_id != '') {
            $this->db->where('id_kelas', $initial_id);
        }
            $js = 'JumlahSiswa';
            $this->db->select('count(nis) as $js')
                     ->from('ja_siswa');
            $query = $this->db->get();

                if($query->num_rows() > 0){
                        return $query->row_array();
                }else return null;
    }

    public function GetHadirToday ($initial_id='')
    {
        if ($initial_id != '') {
            $this->db->where('id_kelas', $initial_id);
        }
        $tgl      = date('Y-m-d');
        $js = 'JumlahSiswaHadirHariIni';
        $this->db->select('count(nis) as $js')
                 ->from('ja_absensi_siswa')
                 ->where(array('keterangan =' => 'Hadir' , 'tanggal =' => $tgl));
        $query = $this->db->get();

        if($query->num_rows() > 0){
            return $query->row_array();
        }else return null;
    }

    public function GetIzinToday ($initial_id = '')
    {
        if ($initial_id != '') {
            $this->db->where('id_kelas', $initial_id);
        }
        $tgl      = date('Y-m-d');
        $js = 'JumlahSiswaHadirHariIni';
        $this->db->select('count(nis) as $js')
            ->from('ja_absensi_siswa')
            ->where(array('keterangan =' => 'Izin' , 'tanggal =' => $tgl));
        $query = $this->db->get();

        if($query->num_rows() > 0){
            return $query->row_array();
        }else return null;
    }

    public function countHadir($initial_id='')
    {
        if ($initial_id != '') {
            $this->db->where('kd_kelas', $initial_id);
        }
            $tgl      = date('Y-m-d');
            $hadir = 'hadir';
            $this->db->select('count(distinct nis) as $hadir')
                     ->from('ja_absensi_siswa')
                     ->where(array('keterangan =' => 'Hadir', 'tanggal =' => $tgl));
            $query = $this->db->get();

                if($query->num_rows() > 0){
                        return $query->row_array();
                }else return null;
    }

    public function blmHadir($initial_id='')
    {
        if ($initial_id != '') {
            $this->db->where('kd_kelas', $initial_id);
        }
            $tgl      = date('Y-m-d');
            $blmHadir = 'blmHadir';
            $this->db->select('count(distinct nis) as $blmHadir')
                     ->from('ja_absensi_siswa')
                     ->where(array('keterangan =' => 'Alpha', 'tanggal =' => $tgl));
            $query = $this->db->get();
                if($query->num_rows() > 0){
                        return $query->row_array();
                }else return null;

    }

    public function siswaIzin($initial_id='')
    {
        if ($initial_id != '') {
            $this->db->where('kd_kelas', $initial_id);
        }
            $tgl      = date('Y-m-d');
            $izin = 'izin';
            $this->db->select('count(distinct nis) as $izin')
                     ->from('ja_absensi_siswa')
                     ->where(array('keterangan =' => 'Izin', 'tanggal =' => $tgl));
            $query = $this->db->get();

                if($query->num_rows() > 0){
                        return $query->row_array();
                }else return null;

    }

    public function grapImage($initial_id){
        
        $this->db->select('file, extention');
        $this->db->from('page_merchant');
        $this->db->where_in('id', $initial_id);
        $query = $this->db->get();
        if($query->num_rows() > 0)return $query->result_array();
        else return null;
    }
}