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
       $this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
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
        echo '<input type="hidden" id="kelas2" value="'.$hasil[0]["Nama_Kelas"].'" />';
    }

    public function getSiswa()
    {
        $kelas          = $this->input->post('kelas');
        $tanggal        = $this->input->post('tanggal');
        $pin            = $this->input->post('pin');

        $hasil = $this->coredb->getAbsensiswa($kelas, $tanggal, $pin);

        if(count($hasil) > 0){
        echo '  <div class="modal-header">
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
              echo '<tr>
                      <td><span>'.$i++.'</span></td>
                      <td>'.date('Y-m-d', strtotime($value->jam_masuk)).'</td>
                      <td><span>'.date('H:i:s', strtotime($value->jam_masuk)).'</span></td>
                      <td><span></span></td>
                      <td><span>'.$value->keterangan.'</span></td>
                    </tr>';
            }
                echo '</tbody>
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
                echo " <script type='text/javascript'>
                        $(document).ready(function() {
                            $('#example1').DataTable();
                        } );
                      </script>";
        }
    }elseif(count($hasil) == 0){
            echo '<div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <div id="nis2" ></div>
                    <h4 style="font-weight:bold;" class="modal-title" id="myModalLabel"></h4>
                  </div>
                <div class="modal-body">
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
                      <tbody>
                    <tr>
                      <td><span></span></td>
                      <td></td>
                      <td><span>MAAF ABSEN BeLuM DI UPDATE</span></td>
                      <td><span></span></td>
                      <td><span></span></td>
                    </tr>
                    </tbody>
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
                    </div>';
            echo " <script type='text/javascript'>
                        $(document).ready(function() {
                            $('#example1').DataTable();
                        } );
                      </script>";
        }

    }

    public function excel()
    {
        $kelas                      =  $this->input->get('kelas');
        $tanggal                    =  $this->input->get('tanggal');    
                    
        $params =  $this->coredb->excel($kelas,$tanggal);
        if(count($params)>0){
            $objPHPExcel = new PHPExcel();
            // Set properties
            $objPHPExcel->getProperties()
                  ->setCreator("JempolAsik") //creator
                    ->setTitle("Laporan Kehadiran Siswa  perBulan");  //file title
 
            $objset = $objPHPExcel->setActiveSheetIndex(0); //inisiasi set object
            $objget = $objPHPExcel->getActiveSheet();  //inisiasi get object
 
            $objget->setTitle('Sample Sheet'); //sheet title
            //Warna header tabel
            $objget->getStyle("A1:E1")->applyFromArray(
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
            $cols = array("A","B","C","D");
             
            $val = array("No Absen","NIS","Nama","Total");
             
            for ($a=0;$a<5; $a++) 
            {
                $objset->setCellValue($cols[$a].'1', $val[$a]);
                 
                //Setting lebar cell
                $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(25); // NAMA
                $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(25); // ALAMAT
                $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25); // Kontak
                $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(25); // Kontak
             
                $style = array(
                    'alignment' => array(
                        'horizontal' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                    )
                );
                $objPHPExcel->getActiveSheet()->getStyle($cols[$a].'1')->applyFromArray($style);
            }
             
            $baris  = 2;
            $no=1;
            foreach ($params as $frow){
                 
               //pemanggilan sesuaikan dengan nama kolom tabel
                $objset->setCellValue("A".$baris, $frow['pin']); //membaca data nama
                $objset->setCellValue("B".$baris, $frow['nis']); //membaca data alamat
                $objset->setCellValue("C".$baris, $frow['Nama_Siswa']); //membaca data alamat
                $objset->setCellValue("D".$baris, $frow['jh']); //membaca data alamat
                 
                //Set number value
                $objPHPExcel->getActiveSheet()->getStyle('E1:E'.$baris)->getNumberFormat()->setFormatCode('0');
                 
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
}
?>