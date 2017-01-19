<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @author JempolAsik
 * @date 30/10/2016
 */ 
class Mapp_siswa extends CI_Model{
    /**
     * COUNT HADIR, BELUM HADIR, IZIN DAN SAKIT
     */
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

    public function hadirSemuaKelas()
    {
        $tgl      = date('Y-m-d');
        $this->db->select('count(pin) as hadir')
                 ->from('ja_data_absen')
                 ->where(array('kehadiran =' => 4, 'date(jam_masuk)' => $tgl));
        $query = $this->db->get();
        if($query->num_rows() > 0){
                return $query->row_array();
        }else
         return null;
    }

    public function GetIzinToday ($initial_id = '')
    {
        if ($initial_id != '') {
            $this->db->where('kd_kelas', $initial_id);
        }
        $tgl      = date('Y-m-d');
        $js = 'JumlahSiswaHadirHariIni';
        $this->db->select('count(pin) as $js')
                 ->from('ja_data_absen')
                 ->where_in('kehadiran', array(2,3))
                 ->where('date(jam_masuk)', $tgl);
        $query = $this->db->get();

        if($query->num_rows() > 0){
            return $query->row_array();
        }else return null;
    }    

    /*
    END
     */

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
    public function getSiswa($initial_id='', $pin='')
    {
        if ($initial_id != '') {
            $this->db->where('ja_data_absen.id_kelas', $initial_id);
        }
            $tgl = date('Y-m-d');
            $this->db->select('*')
                     ->from('ja_siswa')
                     ->join('ja_data_absen','ja_siswa.pin=ja_data_absen.pin')
                     ->where(array('ja_data_absen.pin =' => $pin, 'ja_data_absen.jam_masuk =' => $tgl));
            $query = $this->db->get();

                if($query->num_rows() > 0){
                        return $query->row();
                }else return null;
    }

    public function getSiswa2($pin='')
    {
            $tgl = date('Y-m-d');
            $this->db->select('*')
                     ->from('ja_siswa')
                     ->join('ja_data_absen','ja_siswa.pin=ja_data_absen.pin')
                     ->where(array('ja_data_absen.pin =' => $pin, 'ja_data_absen.tanggal =' => $tgl));
            $query = $this->db->get();

                if($query->num_rows() > 0){
                        return $query->row();
                }else return null;
    }
    /*
    APP_SISWA/kelas
     */
    public function allSiswaInKelas($initial_id='')
    {

        
        if ($initial_id != '') {
            $this->db->where('ja_siswa.id_kelas', $initial_id);
        }
            $tgl = date('Y-m-d');
            $this->db->select('ja_kelas.*,ja_siswa.*, ja_data_absen.*, ja_siswa.absen, ja_siswa.absen as absen2, ja_siswa.pin as pin2, ja_siswa.id_kelas')

                     ->select('max(date(jam_masuk)) as jm')
                     ->select('date(jam_pulang) as jp')
                     ->select('ja_data_absen.jam_masuk as jam')
                     ->from('ja_siswa')
                     ->join('ja_data_absen','ja_data_absen.pin=ja_siswa.pin','LEFT')
                     ->join('ja_kelas','ja_siswa.id_kelas=ja_kelas.id_kelas','INNER')
                     ->where_in('kehadiran', array(2,3,4))
                     ->group_by('ja_siswa.nis')
                     ->order_by('ja_siswa.pin', 'ASC');
            $query = $this->db->get();
                if($query->num_rows() > 0){
                        return $query->result_array();
                }else return null;
    }

    public function siswaBelumHadir($initial_id='')
    {
        if ($initial_id != '') {
            $this->db->where('ja_siswa.id_kelas', $initial_id);
        }
        $tgl = date('Y-m-d');
        $this->db->select('ja_data_absen.*, ja_siswa.*, ja_kelas.*,ja_siswa.absen as absen2, ja_siswa.pin as pin2')
                 ->select('max(date(jam_masuk)) as jm')
                 ->select('date(jam_pulang) as jp')
                 ->select('ja_data_absen.jam_masuk as jam')
                 ->from('ja_siswa')
                 ->join('ja_data_absen', 'ja_data_absen.pin=ja_siswa.pin', 'LEFT')
                 ->join('ja_kelas','ja_siswa.id_kelas=ja_kelas.id_kelas','INNER')
                 ->where('ja_data_absen.pin IS NULL')
                 ->group_by('ja_siswa.nis')
                 ->order_by('ja_siswa.pin', 'ASC');
        $query = $this->db->get();
                if($query->num_rows() > 0){
                        return $query->result_array();
                }else return null;
    }

    /*
    APP_SISWA
     */
    public function allSiswa($initial_id='')
    {
        if ($initial_id != '') {
            $this->db->where('ja_siswa.id_kelas', $initial_id);
        }
            $tgl = date('Y-m-d');
            $this->db->select('ja_kelas.*,ja_siswa.*, ja_data_absen.*, ja_siswa.absen, ja_siswa.absen as absen2, ja_siswa.pin as pin2, ja_siswa.id_kelas, ja_kategori_izin.*')

                     ->select('max(date(jam_masuk)) as jm')
                     ->select('time(jam_masuk) as jammasuk')
                     ->select('date(jam_pulang) as jp')
                     ->select('ja_data_absen.jam_masuk as jam')
                     ->from('ja_siswa')
                     ->join('ja_data_absen','ja_data_absen.pin=ja_siswa.pin','LEFT')
                     ->join('ja_kelas','ja_siswa.id_kelas=ja_kelas.id_kelas','INNER')
                     ->join('ja_kategori_izin','ja_data_absen.kehadiran = ja_kategori_izin.id','LEFT')
                     ->group_by('ja_siswa.nis')
                     ->order_by('ja_siswa.pin', 'ASC');
            $query = $this->db->get();
                if($query->num_rows() > 0){
                        return $query->result_array();
                }else return null;
    }

    public function getabsen($jam='')
    {      
        $tgl      = date('Y-m-d');
        $this->db->select('ja_data_absen.*, ja_siswa.id_kelas, ja_kelas.Nama_Kelas, ja_kategori_izin.*')
                 ->select('ja_siswa.nama_siswa as nama')
                 ->select('time(jam_masuk) as jm')
                 ->select('time(jam_pulang) as jp')
                 ->from('ja_data_absen')
                 ->join('ja_siswa','ja_data_absen.pin = ja_siswa.pin','LEFT')                     
                 ->join('ja_kelas','ja_siswa.id_kelas = ja_kelas.id_kelas','LEFT')
                 ->join('ja_kategori_izin','ja_data_absen.kehadiran = ja_kategori_izin.id','LEFT')
                 ->where('date(jam_masuk) =', $tgl)
                 ->order_by('ja_data_absen.pin', 'ASC')
                 ->group_by('ja_data_absen.pin');                               
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else 
            return null;
    }
    /*
    END APP_SIWA
     */



    public function GetHadirToday ($initial_id='')
    {
        if ($initial_id != '') {
            $this->db->where('id_kelas', $initial_id);
        }
        $tgl      = date('Y-m-d');
        $js = 'JumlahSiswaHadirHariIni';
        $this->db->select('count(pin) as $js')
                 ->from('ja_data_absen')
                 ->where(array('sms_status =' => '1' , 'jam_masuk =' => $tgl));
        $query = $this->db->get();

        if($query->num_rows() > 0){
            return $query->row_array();
        }else return null;
    }

    public function siswaIzin($initial_id='')
    {
        if ($initial_id != '') {
            $this->db->where('id_kelas', $initial_id);
        }
        $tgl      = date('Y-m-d');
        $this->db->select('count(pin) as $izin')
                 ->from('ja_data_absen')
                 ->where_in('kehadiran', array(2,3))
                 ->where(array('date(jam_masuk)' => $tgl, 'id_kelas' => $initial_id));

        $query = $this->db->get();
        if($query->num_rows() > 0){
                return $query->row_array();
        }else
         return null;
    }



    public function hadirPerKelas($initial_id='')
    {
        if ($initial_id != '') {
            $this->db->where('id_kelas', $initial_id);
        }
        $tgl      = date('Y-m-d');
        $this->db->select('count(pin) as hadir')
                 ->from('ja_data_absen')
                 ->where(array('kehadiran =' => 4, 'date(jam_masuk)' => $tgl));
        $query = $this->db->get();
        if($query->num_rows() > 0){
                return $query->row_array();
        }else
         return null;
    }

    public function get_data_absen() {
        error_reporting(0);
        $this->load->model('app_master/mapp_master');
        $this->load->model('app_websetup/Mapp_websetup');        
        // FUNGSI DIBAWAH INI HARUS GRAB DARI WAKTU MASUK YG DISET DARI WAKTU MASUK GLOBAL
        $data  = $this->getabsen();
        $data2 = $this->mapp_master->getSiswa();
        $device = $this->Mapp_websetup->getFp();
        $jam_pulang = $this->Mapp_websetup->grapInOut();
        $datapulang3 = $jam_pulang[0]['jam_keluar'];
        $jam_keluar = $jam_pulang[0]['jam_keluar'];
        $jam_masuk = $jam_pulang[0]['jam_masuk'];
        $tgl      = date('H:i:s');
        $waktu_masuk = date('H:i:s', strtotime($jam_masuk.'+1 minutes'));
        $waktu_pulang = date('H:i:s', strtotime($jam_keluar));
        $waktu    = date('H:i:s', strtotime($datapulang3));
        $tanggal = date('Y-m-d');       


        // END FUNGSI
        //var_dump($data);
        if( count($device) > 0 ){
            foreach($device as $row){    
                $IP=$row['ip'];
                $Key=$row['key'];
                    if($IP!=""){
                        $Connect = @fsockopen($IP, "80", $errno, $errstr, 1);
                    if($Connect){
                        $soap_request="<GetAttLog><ArgComKey xsi:type=\"xsd:integer\">".$Key."</ArgComKey><Arg><PIN xsi:type=\"xsd:integer\">All</PIN></Arg></GetAttLog>";
                        $newLine="\r\n";
                        fputs($Connect, "POST /iWsService HTTP/1.0".$newLine);
                        fputs($Connect, "Content-Type: text/xml".$newLine);
                        fputs($Connect, "Content-Length: ".strlen($soap_request).$newLine.$newLine);
                        fputs($Connect, $soap_request.$newLine);
                        $buffer="";
                        while($Response=fgets($Connect, 1024)){
                            $buffer=$buffer.$Response;
                        }

                        $buffer = $this->Parse_Data($buffer,"<GetAttLogResponse>","</GetAttLogResponse>");
                        $buffer = explode("\r\n",$buffer);
                        for($a=0;$a<count($buffer);$a++){
                            $data = $this->Parse_Data($buffer[$a],"<Row>","</Row>");

                            $PIN = $this->Parse_Data($data,"<PIN>","</PIN>");
                            $DateTime = $this->Parse_Data($data,"<DateTime>","</DateTime>");
                            $Verified = $this->Parse_Data($data,"<Verified>","</Verified>");
                            $Status = $this->Parse_Data($data,"<Status>","</Status>");
                            if (!$this->if_exist_check($PIN, $DateTime) && $PIN && $DateTime) { 
                                $Status2[$a] = $Status;                            

                                $PIN2[$a] = $PIN;
                                $DateTime2[$a] = $DateTime;
                                $Verified2[$a] = $Verified;
                                $dapet = $a;   
                                $dapet2 = $a; 

                                
                            }
                         }    
                         $datapulang  = $this->getabsen();

                        // for ($dapet=0;$dapet<10;$dapet++) {
                        //     $dapet++;
                        //     // var_dump($datapulang3);  
                         // var_dump($waktu); var_dump('>=');
                         // var_dump($tgl);
                        //     // var_dump($dapet);
                        //     // var_dump($data2['nama_panggilan']);
                        // }    
                                for($ad=0;$ad<=$dapet2;$ad++){
                                switch ($Status2[$ad]) {

                                    case '0':
                                        if($tgl >= $waktu) {
                                            $status_pulang = '1';
                                        }
                                        else {
                                            $status_pulang = '0'; 
                                        }                                                                           
                                    $cek   = mysql_query("select * from ja_data_absen where jam_masuk >= cast((now()) as date) and jam_masuk < cast((now() + interval 1 day) as date) and pin=".$PIN2[$ad]."");
                                    $count = mysql_num_rows($cek);
                              
                                    if ($count != 0) {                                                       
                                    }else{                                       
                                        if($tgl <= $waktu_masuk) { 
                                            $status_pulang = '0';            
                                            $ins = array(
                                                    'pin'        => $PIN2[$ad],
                                                    'id_kelas'   => '1',
                                                    'jam_masuk'  => $DateTime2[$ad],
                                                    'ver'        => $Verified2[$ad],
                                                    'status'     => $Status2[$ad],
                                                    'kehadiran'  => '4',
                                                    'sms_status' => '1',
                                                    'telat'      => '0',
                                                     );
                                        }
                                        else{
                                            $ins = array(
                                                    'pin'        => $PIN2[$ad],
                                                    'id_kelas'   => '1',
                                                    'jam_masuk'  => $DateTime2[$ad],
                                                    'ver'        => $Verified2[$ad],
                                                    'status'     => $Status2[$ad],
                                                    'kehadiran'  => '4',
                                                    'sms_status' => '1',
                                                    'telat'      => '1',
                                                     );
                                        }

                                        $this->db->insert('ja_data_absen', $ins);
                                        $kelas = $this->db->select('*')
                                                         ->join('ja_siswa', 'ja_data_absen.pin=ja_siswa.pin','left')
                                                         ->where('ja_data_absen.pin', $PIN2[$ad])
                                                         ->from('ja_data_absen')
                                                         ->get()
                                                         ->result_array();
                                        $ins2 = array(                       
                                                'id_kelas'   => $kelas[0]['id_kelas'],
                                                 );
                                        $this->db->where('ja_data_absen.pin', $PIN2[$ad]);
                                        $this->db->update('ja_data_absen', $ins2);
                                        // // //extract data from the post
                                        // // //set POST variables
                                        // $url    = 'http://smsgateway.me/api/v3/messages/send';
                                        // $fields = array(
                                        //     'email'     => 'hsevfakhri@gmail.com',
                                        //     'password'  => 'H4rdjump',
                                        //     'device'    => '33026',
                                        //     'number'    => '087887496695',
                                        //     'message'   => 'Anak anda '.$data2['nama_panggilan'].' Sudah Masuk kelas',
                                        //     'send_at'   => date()
                                        // );

                                        // //url-ify the data for the POST
                                        // foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
                                        // rtrim($fields_string, '&');

                                        // //open connection
                                        // $ch = curl_init();

                                        // //set the url, number of POST vars, POST data
                                        // curl_setopt($ch,CURLOPT_URL, $url);
                                        // curl_setopt($ch,CURLOPT_POST, count($fields));
                                        // curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);

                                        // //execute post
                                        // $result = curl_exec($ch);

                                        // //close connection
                                        // curl_close($ch);

                                        // //var_dump($data2['nama_panggilan']);

                                        if ($result) {
                                            $upd = array('sms_status' => '1', );
                                            $this->db->where(array('ja_data_absen.pin'=> $PIN2[$ad], 'ja_data_absen.jam_masuk'=> $tanggal));
                                            $this->db->update('ja_data_absen', $upd);
                                            $status_pulang = '1'; 
                                        }
                                    }
                                       break;

                                    case '1':
                                    //var_dump($waktu); echo '>='; var_dump($tgl);
                                    if ($tgl >= $waktu ) {
                                        if($status_pulang == '1') {
                                        // $cek   = mysql_query("SELECT * FROM ja_data_absen WHERE pin=".$PIN2." AND jam_pulang='0000-00-00 00:00:00'");
                                        $cek   = mysql_query("select * from ja_data_absen where sms_status='1' and pin=".$PIN2[$ad]." AND jam_masuk='$tanggal'"); 
                                        $count = mysql_num_rows($cek);
                                        //var_dump($count);
                                        if ($count != 0) {
                                            if($Status2[$ad] == '0'){
                                            $ins = array(                                                
                                                    'pin'        => $PIN2[$ad],
                                                    'jam_pulang' => $DateTime2[$ad],
                                                    'ver'        => $Verified2[$ad],
                                                    'status'     => '1',
                                                    'sms_status' => '2',
                                                     );                                                
                                            }else{
                                            $ins = array(
                                                    'pin'        => $PIN2[$ad],
                                                    'jam_pulang' => $DateTime2[$ad],
                                                    'ver'        => $Verified2[$ad],
                                                    'status'     => $Status2[$ad],
                                                    'sms_status' => '2',
                                                     );
                                            }
                                            $this->db->where(array('ja_data_absen.pin'=>$PIN2[$ad], 'ja_data_absen.sms_status'=>'1', 'ja_data_absen.jam_masuk'=> $tanggal));
                                            $this->db->update('ja_data_absen', $ins);
                                            $upd = array('sms_status' => '2', );
                                                        $this->db->where(array('ja_data_absen.pin'=>$PIN2[$ad], 'ja_data_absen.sms_status'=>'1', 'ja_data_absen.jam_masuk'=> $tanggal));
                                                        $this->db->update('ja_data_absen', $upd);                                    
                                        }else{

                                        }
                                      }  
                                    }else{
                                        $status_pulang == '0';
                                    }
                                        if ($data[$dapet]['sms_status'] == 1) {
                                            # code...
                                        } else {

                                            // //extract data from the post
                                            //set POST variables
                                            $url    = 'http://smsgateway.me/api/v3/messages/send';
                                            $fields = array(
                                                'email'     => 'hsevfakhri@gmail.com',
                                                'password'  => 'H4rdjump',
                                                'device'    => '33026',
                                                'number'    => '087887496695',
                                                'message'   => 'Anak anda '.$data2['nama_panggilan'].' Sudah keluar dari kelas',
                                                'send_at'   => date()
                                            );

                                            //url-ify the data for the POST
                                            foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
                                            rtrim($fields_string, '&');

                                            //open connection
                                            $ch = curl_init();

                                            //set the url, number of POST vars, POST data
                                            curl_setopt($ch,CURLOPT_URL, $url);
                                            curl_setopt($ch,CURLOPT_POST, count($fields));
                                            curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);

                                            //execute post
                                            $result = curl_exec($ch);

                                            //close connection
                                            curl_close($ch);

                                                if ($result) {
                                                    $upd = array('sms_status' => '2', );
                                                    $this->db->where('ja_data_absen.pin', $PIN2[$ad]);
                                                    $this->db->update('ja_data_absen', $upd);
                                                }
                                    
                            }  
                                        break;
                                    
                                    default:
                                        # code...
                                        break;
                        }
                    }
                    }
                } 
            }
        }
    }

    public function if_exist_check($PIN, $DateTime){
        $this->db->select('*');
        $this->db->from('ja_data_absen');
        $this->db->where(array('pin' => $PIN, 'jam_pulang' => $DateTime, 'jam_masuk' => $DateTime));
        $query = $this->db->get();
        if($query->num_rows() > 0)return $query->result_array();
        else return null;
        return $data;
    }

    public function Parse_Data($data,$p1,$p2){
        $data=" ".$data;
        $hasil="";
        $awal=strpos($data,$p1);
        if($awal!=""){
            $akhir=strpos(strstr($data,$p1),$p2);
            if($akhir!=""){
                $hasil=substr($data,$awal+strlen($p1),$akhir-strlen($p1));
            }
        }
        return $hasil;  
    }
}