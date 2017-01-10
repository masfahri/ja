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
        //var_dump($tgl);

        //var_dump($params['datadbhadirizinini']);
        // var_dump($params['datadbsiswa']);
        // $tgl = date('yyyy-mm-dd');
        // var_dump($tgl);
        $this->getContent($params);

    }

    public function kelas($kelas='') {
        $params['datadbsiswa']        =  $this->coredb->hadirPerKelas($this->uri->segment(3));
        $params['datadbjumlahsiswa']  =  $this->coredb->JumlahSiswa($this->uri->segment(3));
        $params['datadbblmhadir']     =  $this->coredb->blmHadir($this->uri->segment(3));
        $params['datadbizin']         =  $this->coredb->siswaIzin($this->uri->segment(3));
        $params['datadbgetsiswa']     =  $this->coredb->getSiswa($this->uri->segment(3));
        $params['hadirSemuaKelas']    =  $this->coredb->hadirSemuaKelas($this->uri->segment(3));
        $params['datadbhadirizinini'] =  $this->coredb->GetIzinToday($this->uri->segment(3));
        $params['siswaKelas']         =  $this->coredb->allSiswaInKelas($kelas);

        $this->load->model('app_websetup/Mapp_websetup');        
        $jam_pulang = $this->Mapp_websetup->grapInOut();
            //var_dump($jam_pulang[0]['jam_masuk']);die();
        $params['datadb'] =  $this->coredb->getKelas();
        $validate = 'true';           
        if( $_POST ){
            
            $izin = $this->input->post('nis');
            $pin = $this->input->post('pin');
            $kelas2 = $this->input->post('id_kelas');
            $jam = date('Y-m-d');
            $input2 = $this->input->post('kehadiran_'.$izin);
            if($input2 == '1' ) { // alpha  
                redirect( base_url($this->app_name).'app_siswa/kelas/'.$kelas );          
            }elseif($input2 == '4') { //hadir
                redirect( base_url($this->app_name).'app_siswa/kelas/'.$kelas );
            }else{
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
            }
            # -----------------------------------------------------------------------------------
            # check siswa sudah absen atau belum

            $db = $this->coredb->getSiswa($kelas2, $pin);
            if( $db != NULL ){
                
               $this->load->library('uidcontroll');
               $db_config['where'] = array('pin', $pin);
               $db_config['table'] = 'ja_data_absen';
               $db_config['data']  =  array('kehadiran' => $posting['kehadiran']);
               if( $this->uidcontroll->updateData( $db_config ) !== FALSE ){

                    $this->session->set_flashdata('msg_success', 'Success Update Data');
                    redirect( base_url($this->app_name).'app_siswa/kelas/'.$kelas );
                    
               }
            }else{
                $this->load->library('uidcontroll');
                $this->uidcontroll->insertData('ja_data_absen', bindProcessing($posting));
            }
        }


             # -------------------------------------------------------------------------------------
             


        $this->getContent($params);

    }
}
