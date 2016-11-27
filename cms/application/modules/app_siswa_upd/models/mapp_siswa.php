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

                /**        SEMUA SISWA          **/
    public function getFinger($initial_id='')
    {

            $this->db->select('*')
                     ->from('ja_siswa');
            $query = $this->db->get();

                if($query->num_rows() > 0){
                        return $query->result_array();
                }else return null;
    }

    public function allSiswaInKelas($initial_id='')
    {
        if ($initial_id != '') {
            $this->db->where('ja_data_absen.id_kelas', $initial_id);
        }
            $tgl = date('Y-m-d');
            $this->db->select('ja_kelas.*,ja_absensi_siswa.*,ja_siswa.*, ja_data_absen.*')
                     ->join('ja_absensi_siswa','ja_absensi_siswa.kd_kelas=ja_siswa.id_kelas','LEFT')                     
                     ->join('ja_data_absen','ja_data_absen.pin=ja_siswa.pin','LEFT')
                     ->join('ja_kelas','ja_siswa.id_kelas=ja_kelas.id_kelas','INNER')
                     ->select('date(jam_masuk) as jm')
                     ->select('date(jam_pulang) as jp')
                     ->from('ja_siswa')
                     ->order_by('ja_siswa.id_kelas', 'ASC');
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
        $this->db->select('count(pin) as $js')
                 ->from('ja_data_absen')
                 ->where(array('sms_status =' => '1' , 'jam_masuk =' => $tgl));
        $query = $this->db->get();

        if($query->num_rows() > 0){
            return $query->row_array();
        }else return null;
    }

    public function GetIzinToday ($initial_id = '')
    {
        if ($initial_id != '') {
            $this->db->where('kd_kelas', $initial_id);
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
            $tgl   = date('Y-m-d');
            $hadir = 'hadir';
            $this->db->select('count(distinct nis) as $hadir')
                     ->from('ja_absensi_siswa');
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

    public function getabsen($jam='')
    {         
        $this->db->select('ja_data_absen.*, ja_siswa.id_kelas, ja_kelas.Nama_Kelas')
                 ->select('ja_siswa.nama_siswa as nama')
                 ->select('time(jam_masuk) as jm')
                 ->select('time(jam_pulang) as jp')
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

    public function hadirSemuaKelas()
    {
        $tgl      = date('Y-m-d');
        $this->db->select('count(pin) as hadir')
                 ->from('ja_data_absen')
                 ->where('date(jam_masuk) =', $tgl);
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
                 ->where('date(jam_masuk) =', $tgl);
        $query = $this->db->get();
        if($query->num_rows() > 0){
                return $query->row_array();
        }else
         return null;
    }

    public function get_data_absen() {
        error_reporting(0);
        $this->load->model('app_master/mapp_master');
        // FUNGSI DIBAWAH INI HARUS GRAB DARI WAKTU MASUK YG DISET DARI WAKTU MASUK GLOBAL
        $data       = $this->getabsen();
        $data2      = $this->mapp_master->getSiswa();
        $dataSiswa  = $this->getFinger();
        // END FUNGSI
        //var_dump($data);
        $IP       = '192.168.0.110';
        $Key      = '1';
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
                    $PIN = $this->Parse_Data($buffer[$a],"<PIN>","</PIN>");
                    $DateTime = $this->Parse_Data($buffer[$a],"<DateTime>","</DateTime>");
                    $Verified = $this->Parse_Data($buffer[$a],"<Verified>","</Verified>");
                    $Status = $this->Parse_Data($buffer[$a],"<Status>","</Status>");

                    if (!$this->if_exist_check($PIN, $DateTime) && $PIN && $DateTime) {         
                        $Status2 = $Status;
                        $PIN2 = $PIN;
                        $DateTime2 = $DateTime;
                        $Verified2 = $Verified;
                            //var_dump($this->Parse_Data($buffer[$a],"<DateTime>","</DateTime>"));
                            $dapet = $a;
                    }
                }    
                $datapulang  = $this->getabsen();
                for ($dapet=0;$dapet<1;$dapet++) {
                    $datapulang3 = $datapulang[$dapet]['jam_masuk'];
                    $tgl      = date('H:i', strtotime($datapulang3));
                    $waktu    = date('H:i', strtotime($datapulang3.'+10 minutes'));

                        // var_dump($dataSiswa[$dapet]->pin);
                        //     if ($PIN2 == $dataSiswa[$dapet]->pin) {
                        //         $this->load->library('uidcontroll');  
                        //         $dataRemove = array("pin !=", $PIN2); 
                        //         if( $this->uidcontroll->removeData('ja_siswa', $dataRemove) == TRUE ) {
                        //             echo "sukses";
                        //         }
                        //     }else{


                        //     }
                    $dapet++;
                    // var_dump($datapulang3);  
                    // var_dump($waktu); var_dump('>=');
                    // var_dump($tgl);
                    // var_dump($dapet);
                    // var_dump($data2['nama_panggilan']);
                }     

                        switch ($Status2) {
                            case '0':
                            $cek   = mysql_query("SELECT * FROM ja_data_absen WHERE pin=".$PIN2."");
                            $count = mysql_num_rows($cek);
                            if ($count != 0) {
                            
                            }else{
                                $ins = array(
                                        'pin'        => $PIN2,
                                        'id_kelas'   => '',
                                        'jam_masuk'  => $DateTime2,
                                        'ver'        => $Verified2,
                                        'status'     => $Status2,
                                        'sms_status' => '1',
                                         );
                                $this->db->insert('ja_data_absen', $ins);

                                // //extract data from the post
                                // //set POST variables
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

                                //var_dump($data2['nama_panggilan']);

                                if ($result) {
                                    $upd = array('sms_status' => '1', );
                                    $this->db->where('ja_data_absen.pin', $PIN2);
                                    $this->db->update('ja_data_absen', $upd);
                                }
                            }
                                break;

                            case '1':


                            if ($waktu >= $tgl) {
                            $cek   = mysql_query("SELECT * FROM ja_data_absen WHERE pin=".$PIN2." "AND" jam_pulang!='0000-00-00 00:00:00'");
                            $count = mysql_num_rows($cek);
                            if ($count != 0) {
                                echo "ADA DATA";
                            }else{
                                $ins = array(
                                        'pin'        => $PIN2,
                                        'jam_pulang' => $DateTime2,
                                        'ver'        => $Verified2,
                                        'status'     => $Status2,
                                        'sms_status' => '2',
                                         );
                                $this->db->where('ja_data_absen.pin', $PIN2);
                                $this->db->update('ja_data_absen', $ins);
                            }
                                if ($data[$dapet]['sms_status'] == 1) {
                                    # code...
                                } else {

                                    //extract data from the post
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
                                            $this->db->where('ja_data_absen.pin', $PIN2);
                                            $this->db->update('ja_data_absen', $upd);
                                        }
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

    public function updateData($value='')
    {
        $dataSiswa  = $this->getFinger();
        $IP="192.168.0.110";
        $Key="1";
        $Connect = @fsockopen($IP, "80", $errno, $errstr, 1);

        if($Connect){
            $soap_request="<GetUserInfo>
                                <ArgComKey xsi:type=\"xsd:integer\">".$Key."</ArgComKey>
                                <Arg>
                                    <PIN xsi:type=\"xsd:integer\">All</PIN>
                                    <Name xsi:type=\"xsd:string\">Name</Name>
                                </Arg>
                            </GetUserInfo>";
            $newLine="\r\n";
            fputs($Connect, "POST /iWsService HTTP/1.0".$newLine);
            fputs($Connect, "Content-Type: text/xml".$newLine);
            fputs($Connect, "Content-Length: ".strlen($soap_request).$newLine.$newLine);
            fputs($Connect, $soap_request.$newLine);
            $buffer="";
            while($Response=fgets($Connect, 1024)){
                $buffer=$buffer.$Response;
            }
            $buffer = $this->Parse_Data($buffer,"<GetUserInfoResponse>","</GetUserInfoResponse>");
                $buffer = explode("\r\n",$buffer);
                for($a=0;$a<count($buffer);$a++){
                    $data = $this->Parse_Data($buffer,"<Row>","</Row>");
                    $PIN = $this->Parse_Data($buffer[$a],"<PIN>","</PIN>");
                    $Name = $this->Parse_Data($buffer[$a],"<Name>","</Name>");

                        $upd = array(
                                'pin' => $PIN,
                                'nama_panggilan' => $Name,
                                 );

                        

                    if (!$this->cekData($PIN, $Name) && $PIN && $Name) {
                        $this->db->insert('ja_siswa', $upd);
                    }
                   var_dump ($PIN. "=" .$Name);
            }
        }
    }

    public function deleteData()
    {
        $dataSiswa  = $this->getFinger();
        $IP="192.168.0.110";
        $Key="1";
        $Connect = @fsockopen($IP, "80", $errno, $errstr, 1);

        if($Connect){
            $soap_request="<DeleteUser>
                                <ArgComKey xsi:type=\"xsd:integer\">".$Key."</ArgComKey>
                                <Arg>
                                    <PIN xsi:type=\"xsd:integer\">All</PIN>
                                    <Name xsi:type=\"xsd:string\">Name</Name>
                                </Arg>
                            </DeleteUser>";
            $newLine="\r\n";
            fputs($Connect, "POST /iWsService HTTP/1.0".$newLine);
            fputs($Connect, "Content-Type: text/xml".$newLine);
            fputs($Connect, "Content-Length: ".strlen($soap_request).$newLine.$newLine);
            fputs($Connect, $soap_request.$newLine);
            $buffer="";
            while($Response=fgets($Connect, 1024)){
                $buffer=$buffer.$Response;
            }
            $buffer = $this->Parse_Data($buffer,"<DeleteUserResponse>","</DeleteUserResponse>");
                $buffer = explode("\r\n",$buffer);
                for($a=0;$a<count($buffer);$a++){
                    $data = $this->Parse_Data($buffer,"<Row>","</Row>");
                    $PIN = $this->Parse_Data($buffer[$a],"<PIN>","</PIN>");
                    $Name = $this->Parse_Data($buffer[$a],"<Name>","</Name>");

                        $upd = array(
                                'pin' => $PIN,
                                'nama_panggilan' => $Name,
                                 );

                    if ($this->cekData($PIN, $Name) && $PIN && $Name > 0) {
                        echo "fail";
                    }else{
                        $this->db->where('pin =', $PIN);
                        $this->db->delete('ja_siswa', $upd);
                    }
                   var_dump ($buffer);
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

    public function cekData($PIN, $Name){
        $this->db->select('*');
        $this->db->from('ja_siswa');
        $this->db->where(array('pin' => $PIN, 'nama_panggilan' => $Name));
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