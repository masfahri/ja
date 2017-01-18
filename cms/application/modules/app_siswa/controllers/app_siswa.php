<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class App_siswa extends MX_Controller {
    
    # property
    public $root;
    public $app_name            = ''; 
    public $initial_template    = ''; 
    protected  $base_template   = array(
    'container' => '../../layout/container',
    'template_siswa'           => 'tpl_siswa',
    'template_siswakelas'      => 'tpl_siswakelas'
    );


    # method
    public function __construct(){
       $this->accesscontroll->authenticate();
       $this->load->model('m'.strtolower( __CLASS__ ), 'coredb'); 
       parent::__construct();
       $this->init();  
       // initial helper
       $this->load->helper( array(  
        'image/image'
       ));    
	}
    
    protected function init(){
    
        isset($_SERVER['HTTP_REFERER']) ? $this->root = $_SERVER['HTTP_REFERER'] : '';
        $this->reg_validation = strtolower( __CLASS__ );  
        $this->registerValidation();
    }

    public function registerValidation(){
        
         define("REG_VALIDATION", strtolower( __CLASS__ ));
         define("REG_VALIDATION_IZIN", 'izin');
    }

    private function getContent($args = array()){
         
        try{
            if($this->uri->segment(2)=="siswa"){
                $body_data['contents'] = $this->load->view($this->base_template['template_siswa'], $args, TRUE);
            }
            elseif($this->uri->segment(2)=="kelas"){
                $body_data['contents'] = $this->load->view($this->base_template['template_siswakelas'], $args, TRUE);
            }                  
            else {
                $body_data['contents'] = $this->load->view($this->base_template['template_siswa'], $args, TRUE);
            }                                     
            $this->load->view($this->base_template['container'], $body_data);
        }catch(Exception $e) {
            echo 'Caught exception, params function getContent is wrong : ',  $e->getMessage(), "\n";
        }      
    }
  
    public function index() {
        $params['datadb']             =  $this->coredb->getKelas();
        $params['datadbsiswa']        =  $this->coredb->countHadir();
        $params['datadbjumlahsiswa']  =  $this->coredb->JumlahSiswa();
        $params['datadbhadirhariini'] =  $this->coredb->GetHadirToday();
        $params['hadirSemuaKelas']    =  $this->coredb->hadirSemuaKelas();
        $params['datadbhadirizinini'] =  $this->coredb->GetIzinToday();
        $params['datadbblmhadir']     =  $this->coredb->blmHadir();
        $params['siswaKelas']         =  $this->coredb->allSiswaInKelas();
        $params['datadbizin']         =  $this->coredb->siswaIzin();
        $params['absen']              =  $this->coredb->getabsen();
        //$params['datadbgetsiswa']     =  $this->coredb->GetSiswa();
        $this->load->model('app_siswa/mapp_siswa');
        $params['dataabsen']          =  $this->mapp_siswa->get_data_absen();
        $tgl      = date('Y-m-d');
        $this->getContent($params);

    }

    public function kelas($kelas='') {
        $params['datadbsiswa']        =  $this->coredb->hadirPerKelas($this->uri->segment(3));
        $params['datadbjumlahsiswa']  =  $this->coredb->JumlahSiswa($this->uri->segment(3));
        $params['datadbizin']         =  $this->coredb->siswaIzin($this->uri->segment(3));
        $params['siswaKelas']         =  $this->coredb->allSiswaInKelas($kelas);
        $this->load->model('app_websetup/Mapp_websetup');        
        $jam_pulang = $this->Mapp_websetup->grapInOut();
        $params['datadb'] =  $this->coredb->getKelas();
        $validate = 'true';           
        // if( $_POST ){
        //     $izin = $this->input->post('nis');
        //     $pin = $this->input->post('pin');

        //     $kelas2 = $this->input->post('id_kelas');
        //     $jam = date('Y-m-d');
        //     $input2 = $this->input->post('kehadiran');

        //     foreach($input2 as $kehadiran) {
        //         foreach ($pin as $pin2) {
        //             $db = $this->coredb->getSiswa($kelas2, $pin2);
        //         }

        //         if($kehadiran == '1' ) { // alpha      
        //         }elseif($kehadiran == '4') { //hadir
        //         }elseif($kehadiran == '3') { //sakit         
        //             foreach ($pin as $pin2) {
        //                 $posting = array(
        //                     'pin'           => $pin2,
        //                     'id_kelas'      => $kelas2,
        //                     'jam_masuk'     => $jam,
        //                     'jam_pulang'    => $jam,
        //                     'tanggal'       => $jam,
        //                     'ver'           => '0',
        //                     'kehadiran'     => '3',
        //                     'sms_status'    => '0',

        //                 );
        //                 if( $db != NULL ){

        //                        $this->load->library('uidcontroll');
        //                        $db_config['where'] = array('pin', $pin2);
        //                        $db_config['table'] = 'ja_data_absen';
        //                        $db_config['data']  =  array('kehadiran' => $kehadiran);
        //                        if( $this->uidcontroll->updateData( $db_config ) != FALSE ){

        //                             $this->session->set_flashdata('msg_success', 'Success Update Data');
        //                             redirect( base_url($this->app_name).'app_siswa/kelas/'.$kelas );
                                    
        //                         }
        //                 }else{
        //                     $this->load->library('uidcontroll');
        //                     $this->uidcontroll->insertData('ja_data_absen', bindProcessing($posting));
        //                 }

        //             }

        //             redirect( base_url($this->app_name).'app_siswa/kelas/'.$kelas );
        //         }elseif($kehadiran == '2') { //izin
        //             foreach ($pin as $pin2) {
                        
        //                 $posting = array(
        //                     'pin'           => $pin2,
        //                     'id_kelas'      => $kelas2,
        //                     'jam_masuk'     => $jam,
        //                     'jam_pulang'    => $jam,
        //                     'tanggal'       => $jam,
        //                     'ver'           => '0',
        //                     'kehadiran'     => '2',
        //                     'sms_status'    => '0',

        //                 );


        //                 if( $db != NULL ){

        //                        $this->load->library('uidcontroll');
        //                        $db_config['where'] = array('pin', $pin2);
        //                        $db_config['table'] = 'ja_data_absen';
        //                        $db_config['data']  =  array('kehadiran' => $kehadiran);
        //                        if( $this->uidcontroll->updateData( $db_config ) != FALSE ){

        //                             $this->session->set_flashdata('msg_success', 'Success Update Data');
        //                             redirect( base_url($this->app_name).'app_siswa/kelas/'.$kelas );
                                    
        //                         }
        //                 }else{
        //                     $this->load->library('uidcontroll');
        //                     $this->uidcontroll->insertData('ja_data_absen', bindProcessing($posting));
        //                 }

        //             }
        //             redirect( base_url($this->app_name).'app_siswa/kelas/'.$kelas );
        //         }else{
        //         }
        //     }
        // }


             # -------------------------------------------------------------------------------------
             


        $this->getContent($params);

    }

    public function excel()
    {
        $ambildata = $this->mread->export_kontak();
        $params['siswaKelas']         =  $this->coredb->allSiswaInKelas($kelas);
         
        if(count($ambildata)>0){
            $objPHPExcel = new PHPExcel();
            // Set properties
            $objPHPExcel->getProperties()
                  ->setCreator("SAMSUL ARIFIN") //creator
                    ->setTitle("Programmer - Regional Planning and Monitoring, XL AXIATA");  //file title
 
            $objset = $objPHPExcel->setActiveSheetIndex(0); //inisiasi set object
            $objget = $objPHPExcel->getActiveSheet();  //inisiasi get object
 
            $objget->setTitle('Sample Sheet'); //sheet title
            //Warna header tabel
            $objget->getStyle("A1:C1")->applyFromArray(
                array(
                    'fill' => array(
                        'type' => PHPExcel_Style_Fill::FILL_SOLID,
                        'color' => array('rgb' => '92d050')
                    ),
                    'font' => array(
                        'color' => array('rgb' => '000000')
                    )
                )
            );
 
            //table header
            $cols = array("A","B","C");
             
            $val = array("Nama ","Alamat","Kontak");
             
            for ($a=0;$a<3; $a++) 
            {
                $objset->setCellValue($cols[$a].'1', $val[$a]);
                 
                //Setting lebar cell
                $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(25); // NAMA
                $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(25); // ALAMAT
                $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25); // Kontak
             
                $style = array(
                    'alignment' => array(
                        'horizontal' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                    )
                );
                $objPHPExcel->getActiveSheet()->getStyle($cols[$a].'1')->applyFromArray($style);
            }
             
            $baris  = 2;
            foreach ($ambildata as $frow){
                 
               //pemanggilan sesuaikan dengan nama kolom tabel
                $objset->setCellValue("A".$baris, $frow->nama); //membaca data nama
                $objset->setCellValue("B".$baris, $frow->alamat); //membaca data alamat
                $objset->setCellValue("C".$baris, $frow->kontak); //membaca data alamat
                 
                //Set number value
                $objPHPExcel->getActiveSheet()->getStyle('C1:C'.$baris)->getNumberFormat()->setFormatCode('0');
                 
                $baris++;
            }
             
            $objPHPExcel->getActiveSheet()->setTitle('Data Export');
 
            $objPHPExcel->setActiveSheetIndex(0);  
            $filename = urlencode("Data".date("Y-m-d H:i:s").".xls");
               
              header('Content-Type: application/vnd.ms-excel'); //mime type
              header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
              header('Cache-Control: max-age=0'); //no cache
 
            $objWriter = IOFactory::createWriter($objPHPExcel, 'Excel5');                
            $objWriter->save('php://output');
        }else{
            redirect('Excel');
        }
    }

    public function UpdateKehadiran()
    {
        if($_POST){
            $kehadiran = $this->input->post('kehadiran');
            $pin = $this->input->post('pin');
            $jam = date('Y-m-d');
            $kelas2 = $this->input->post('id_kelas');
            // check absen
            $db = $this->coredb->getSiswa2($pin);
            if( $db != NULL ){
                   // kondisi update
                   $this->load->library('uidcontroll');
                   $db_config['where'] = array('pin', $pin);
                   $db_config['table'] = 'ja_data_absen';
                   $db_config['data']  =  array('kehadiran' => $kehadiran, 'tanggal' => $jam);
                   if( $this->uidcontroll->updateData( $db_config ) != FALSE ){
                        echo 'Success Update Data';
                    }else{
                       echo 'Invalid Data to insert !';
                    }
            }else{  
                if($kehadiran == '3') { //sakit        
                    $posting = array(
                        'pin'           => $pin,
                        'id_kelas'      => $kelas2,
                        'jam_masuk'     => $jam,
                        'jam_pulang'    => $jam,
                        'tanggal'       => $jam,
                        'ver'           => '0',
                        'kehadiran'     => '3',
                        'sms_status'    => '0',

                    );

                // kondisi add new
                $this->load->library('uidcontroll');
                $this->uidcontroll->insertData('ja_data_absen', bindProcessing($posting));
                 echo 'Success Insert Data';

                }elseif($kehadiran == '2') { //izin
                    $posting = array(
                        'pin'           => $pin,
                        'id_kelas'      => $kelas2,
                        'jam_masuk'     => $jam,
                        'jam_pulang'    => $jam,
                        'tanggal'       => $jam,
                        'ver'           => '0',
                        'kehadiran'     => '2',
                        'sms_status'    => '0',

                    ); 
                    // kondisi add new
                    $this->load->library('uidcontroll');
                    $this->uidcontroll->insertData('ja_data_absen', bindProcessing($posting));
                     echo 'Success Insert Data';

                }
                else{
                    
                }
            }
        }
    }

}
