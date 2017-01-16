<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class App_laporan extends MX_Controller {
    
    # property
    public $root;

    public $initial_template    = ''; 
    protected  $base_template   = array(
    'container' => '../../layout/container',
    'template_siswa'            => 'tpl_laporan',
    'template_detail'           => 'tpl_detail'
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
    }

    private function getContent($args = array()){
         
        try{
            if($this->uri->segment(2)=="laporan"){
                $body_data['contents'] = $this->load->view($this->base_template['template_laporan'], $args, TRUE);
            }
            elseif($this->uri->segment(3)=="detail"){
                $body_data['contents'] = $this->load->view($this->base_template['template_detail'], $args, TRUE);
            }                  
            else {
                $body_data['contents'] = $this->load->view($this->base_template['template_siswa'], $args, TRUE);
            }                                     
            $this->load->view($this->base_template['container'], $body_data);
        }catch(Exception $e) {
            echo 'Caught exception, params function getContent is wrong : ',  $e->getMessage(), "\n";
        }      
    }
  
    public function index($cariTgl='') {
        $params['absen']            =  $this->coredb->getabsen();
        $params['absenKelas']       =  $this->coredb->lapAllClass(); 
        $params['datadbtanggal']    =   $this->coredb->searchTgl($cariTgl);
        $kelas                      =  $this->input->get('kelas');
            $tanggal                    =  $this->input->get('tanggal');
        $params['cari']             =  $this->coredb->cari($kelas,$tanggal);

        $this->getContent($params); 

    }

    // public function searchTgl($tanggal='') {
    //     $params['absen']            =  $this->coredb->getabsen();
    //     $params['absenKelas']       =  $this->coredb->lapAllClass(); 
    //     $cariTgl                    =  $this->input->get('tanggal');
    //     $params['datadbtanggal']    =  $this->coredb->searchTgl($cariTgl);
    //      // var_dump($params['datadbtanggal']);die();
        
    //     $this->getContent($params);
    // }

    // public function searchKls($kelas='')
    // {
    //     $params['absen']            =  $this->coredb->getabsen();
    //     $params['absenKelas']       =  $this->coredb->lapAllClass(); 
    //     $cariKelas                  =  $this->input->get('kelas');
    //     $params['datadbtanggal']    =  $this->coredb->searchKls($cariKelas);
    //     // var_dump($params['datadbtanggal']);die();

    //     $this->getContent($params);
    // }

    public function search($search='')
    {
        $params['absen']            =  $this->coredb->getabsen();
        $params['absenKelas']       =  $this->coredb->lapAllClass(); 
            $kelas                      =  $this->input->get('kelas');
            $tanggal                    =  $this->input->get('tanggal');
        $params['cari']             =  $this->coredb->cari($kelas,$tanggal);
        $params['absen']            =  $this->coredb->detailAbsen($kelas,$tanggal);

        // $params['detil']            =  $this->coredb->detil($pin);
        $this->getContent($params);
    }

    public function detail($detail='')
    {
        $params['absen']            =  $this->coredb->getabsen();
        $params['absenKelas']       =  $this->coredb->lapAllClass(); 
            $kelas                      =  $this->input->get('kelas');
            $tanggal                    =  $this->input->get('tanggal');
        $params['cari']             =  $this->coredb->cari($kelas,$tanggal);
        $this->getContent($params);
    }

    public function getKelas(){
        $kelas  = $this->input->post('kelas');

        $hasil = $this->coredb->lapAllClass($kelas);

        echo 'Laporan Kehadiran Kelas: '. $hasil[0]['Nama_Kelas'];
    }

    public function getBulan()
    {
        $bulan = $this->input->post('dapetBulan');
        $months = array(01 => 'Jan.', 02 => 'Feb.', 03 => 'Mar.', 04 => 'Apr.', 05 => 'May', 06 => 'Jun.', 07 => 'Jul.', 08 => 'Aug.', 09 => 'Sep.', 010 => 'Oct.', 011 => 'Nov.', 012 => 'Dec.');

                        var_dump($months);die;
            if($months == $bulan){

                echo "HASIL RESULT BULAN" .print_r($months);

            }
        
    }

    public function getSiswa()
    {
        $kelas          = $this->input->post('kelas');
        $tanggal        = $this->input->post('tanggal');
        $pin            = $this->input->post('pin');

        $hasil = $this->coredb->getAbsensiswa($kelas, $tanggal, $pin);

        echo '
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <div id="nis2" ></div>
                  <h4 style="font-weight:bold;" class="modal-title" id="myModalLabel">'.$hasil[0]->nama_siswa.'</h4>
                  '.$hasil[0]->nis.'
                </div>
                <div class="modal-body">
                <form action="#" name="fres" id="fres">
                  <div class="uk-width-medium-1-2">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                      <tr>
                        <th>ID</th>
                        <th>Hari</th>
                        <th>Jam Masuk</th>
                        <th>Jam Pulang</th>
                        <th>Status</th>
                      </tr>
                      </thead>
                      <tbody>';

        if(count($hasil) > 0){
            $i = 1;
            foreach ($hasil as $key => $value) {

                  echo '            
                                      <tr>
                                          <td><span>'.$i++.'</span></td>
                                          <td>'.date('Y-m-d', strtotime($value->jam_masuk)).'</td>
                                          <td><span>'.date('H:i:s', strtotime($value->jam_masuk)).'</span></td>
                                          <td><span></span></td>
                                          <td><span>'.$value->keterangan.'</span></td>
                                      </tr>

                  ';


            }
        echo '                      </tbody>
                      <tfoot>
                      <tr>
                        <th>ID</th>
                        <th>Hari</th>
                        <th>Jam Masuk</th>
                        <th>Jam Pulang</th>
                        <th>Status</th>
                      </tr>
                      </tfoot>
                    </table>
                  </div>
                </form>
                </div>';
        }
    }
}
?>