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
        $params['absen']             =  $this->coredb->detailAbsen($kelas,$tanggal);
        var_dump($params['absen']);die;
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

    
}
?>