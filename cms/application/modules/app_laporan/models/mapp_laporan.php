<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @author JempolAsik
 * @date 30/10/2016
 */ 
class Mapp_laporan extends CI_Model{
    
    public function lapAllClass()
    {
        $this->db->select('*')
                 ->from('ja_kelas')
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

    public function searchTgl($search)
    {
        $tgl = date('Y-m-d');
        $this->db->select('ja_siswa.*, ja_kelas.*, ja_data_absen.*')         
                 ->select('date(jam_masuk) as jm')
                 ->select('date(jam_pulang) as jp')
                 ->from('ja_data_absen')
                 ->where('date(jam_masuk)', $search)
                 ->join('ja_siswa', 'ja_data_absen.pin=ja_siswa.pin','LEFT')
                 ->join('ja_kelas', 'ja_data_absen.id_kelas=ja_kelas.id_kelas','LEFT');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else 
            return null;
    }

    public function searchKls($kelas)
    {
        $this->db->select('ja_siswa.*, ja_kelas.*, ja_data_absen.*')         
                 ->select('date(jam_masuk) as jm')
                 ->select('date(jam_pulang) as jp')
                 ->from('ja_data_absen')
                 ->where('ja_kelas.id_kelas', $kelas)
                 ->join('ja_siswa', 'ja_data_absen.pin=ja_siswa.pin','LEFT')
                 ->join('ja_kelas', 'ja_data_absen.id_kelas=ja_kelas.id_kelas','LEFT')
                 ->group_by('jam_masuk');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else 
            return null;
    }

    public function cari($kelas,$tanggal)
    {
        error_reporting(0);
        $cek = mysql_query("select * from ja_data_absen where month(jam_masuk)=".$tanggal."");
        $count = mysql_num_rows($cek);
        //var_dump($count);die();
        if ($count == 0) {
            $this->db->select('*')
                     ->from('ja_siswa')
                     ->where('id_kelas',$kelas);
            $query = $this->db->get();
                if($query->num_rows() > 0){
                        return $query->result_array();
                }else return null;
        }
        $tgl    = date('Y');
        return $this->db->query("
             SELECT  ja_siswa.pin, ja_siswa.nama_panggilan, ja_siswa.nama_siswa, ja_siswa.id_kelas, ja_siswa.absen, ja_siswa.nis,
                ja_data_absen.jam_masuk, ja_data_absen.jam_pulang, ja_data_absen.pin, ja_data_absen.id_kelas, ja_kelas.id_kelas,
                COUNT(ja_data_absen.pin) AS jh
                    FROM ja_siswa
                    
                LEFT JOIN ja_data_absen
                    ON ja_siswa.pin=ja_data_absen.pin
                    
                JOIN ja_kelas
                    ON ja_siswa.id_kelas=ja_kelas.id_kelas
                    
                WHERE ja_kelas.id_kelas=$kelas AND (month(ja_data_absen.jam_masuk)=$tanggal OR month(ja_data_absen.jam_masuk) is null )AND year(ja_data_absen.jam_masuk) = $tgl
                GROUP BY nama_panggilan  
                ORDER BY ja_siswa.pin ASC
             ")->result_array();
    }

    public function getAbsensiswa($kelas,$tanggal, $pin){

    $query = $this->db->query("
            SELECT ja_kategori_izin.keterangan, ja_siswa.*, ja_data_absen.* FROM ja_data_absen
            INNER JOIN ja_siswa ON ja_data_absen.pin=ja_siswa.pin
            INNER JOIN ja_kategori_izin ON ja_data_absen.kehadiran=ja_kategori_izin.id

             WHERE ja_data_absen.id_kelas = '$kelas' AND (month(ja_data_absen.jam_masuk) = '$tanggal') AND ja_data_absen.pin = '$pin'");

        if($query->num_rows() > 0){
            return $query->result();
        }else return null;

    }

    public function detailAbsen($kelas,$tanggal)
    {
        error_reporting(0);
        $cek = mysql_query("select * from ja_data_absen where month(jam_masuk)=".$tanggal."");
        $count = mysql_num_rows($cek);
        //var_dump($count);die();
        if ($count == 0) {
            $this->db->select('*')
                     ->from('ja_siswa')
                     ->where('id_kelas',$kelas);
            $query = $this->db->get();
                if($query->num_rows() > 0){
                        return $query->result_array();
                }else return null;
        }
        $tgl    = date('Y-m-d');
        return $this->db->query("
             SELECT  *
                    FROM ja_siswa
                GROUP BY nama_panggilan  
                ORDER BY ja_siswa.pin ASC
             ")->result_array();
    }
    
    /** SQL DUMP 
    
        SELECT  ja_siswa.pin, ja_siswa.nama_panggilan, ja_siswa.id_kelas, ja_siswa.absen, 
        ja_data_absen.jam_masuk, ja_data_absen.jam_pulang, ja_data_absen.pin, ja_data_absen.id_kelas, ja_kelas.id_kelas,
        COUNT(ja_data_absen.pin) AS jh
            FROM ja_siswa
            
        LEFT JOIN ja_data_absen
            ON ja_siswa.pin=ja_data_absen.pin
            
        JOIN ja_kelas
            ON ja_siswa.id_kelas=ja_kelas.id_kelas
            
        WHERE ja_kelas.id_kelas=".$kelas." AND (month(ja_data_absen.jam_masuk)=".$tanggal." OR month(ja_data_absen.jam_masuk) is null)
        GROUP BY nama_panggilan  
        ORDER BY ja_siswa.pin ASC

        !-------------------------------------------------------------------------------!

        SELECT  ja_siswa.pin, ja_siswa.nama_panggilan, ja_siswa.id_kelas, ja_siswa.absen, 
        ja_data_absen.jam_masuk, ja_data_absen.jam_pulang, ja_data_absen.pin, ja_data_absen.id_kelas, ja_kelas.id_kelas,
        COUNT(ja_data_absen.pin) AS jh
            FROM ja_siswa
            
        LEFT JOIN ja_data_absen
            ON ja_siswa.pin=ja_data_absen.pin
            
        JOIN ja_kelas
            ON ja_siswa.id_kelas=ja_kelas.id_kelas
            
        WHERE ja_kelas.id_kelas=1 AND (month(ja_data_absen.jam_masuk)=01 OR month(ja_data_absen.jam_masuk) is null)
        GROUP BY nama_panggilan  
        ORDER BY ja_siswa.pin ASC

        !-----Try----!
        (
            (ja_kelas.id_kelas='3')
            AND
                (
                    (month(ja_data_absen.jam_masuk)='01')
                    OR
                    (month(ja_data_absen.jam_masuk) is null)
                )
        )



    */
}