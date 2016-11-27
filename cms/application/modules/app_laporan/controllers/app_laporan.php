<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class App_laporan extends MX_Controller {
    
    # property
    public $root;

    public $initial_template    = ''; 
    protected  $base_template   = array(
    'container' => '../../layout/container',
    'template_siswa'           => 'tpl_laporan',
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
    }

    private function getContent($args = array()){
         
        try{
            if($this->uri->segment(2)=="laporan"){
                $body_data['contents'] = $this->load->view($this->base_template['template_laporan'], $args, TRUE);
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
        $params['dblap']    = $this->coredb->lapAllClass();
        $params['absen']    =  $this->coredb->getabsen();
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
        $params['datadb'] =  $this->coredb->getKelas();
        $this->getContent($params);
         

    }
}
?>