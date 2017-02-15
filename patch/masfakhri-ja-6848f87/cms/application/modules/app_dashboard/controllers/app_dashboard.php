<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class App_dashboard extends MX_Controller {
    
    # property
    public $root;
    protected  $base_template   = array(
    'container' => '../../layout/container',
    'template_siswa'  => 'tpl_siswa',
    'template_guru'  => 'tpl_guru',
    'template_karyawan'  => 'tpl_karyawan'     
    );


    # method
    public function __construct(){
       $this->accesscontroll->authenticate();
       //$this->load->model('m'.strtolower( __CLASS__ ), 'coredb'); 
       parent::__construct();
       $this->init();  
       // initial helper
       $this->load->helper( array(  
        'image/image'
       ));    	
       $this->load->model('app_siswa/Mapp_siswa'); 
     }
    
    protected function init(){
    
        isset($_SERVER['HTTP_REFERER']) ? $this->root = $_SERVER['HTTP_REFERER'] : '';
        $this->reg_validation = strtolower( __CLASS__ );  
    }

    private function getContent($args = array()){
         
        try{
            if($this->uri->segment(2)=="siswa"){
                $body_data['contents'] = $this->load->view($this->base_template['template_siswa'], $args, TRUE);
            }   
            elseif($this->uri->segment(2)=="guru"){
                $body_data['contents'] = $this->load->view($this->base_template['template_guru'], $args, TRUE);
            } 
            elseif($this->uri->segment(2)=="karyawan"){
                $body_data['contents'] = $this->load->view($this->base_template['template_karyawan'], $args, TRUE);
            } 
            else {
                $body_data['contents'] = $this->load->view($this->base_template['template_siswa'], $args, TRUE);
            }                                     
            $this->load->view($this->base_template['container'], $body_data);
        }catch(Exception $e) {
            echo 'Caught exception, params function getContent is wrong : ',  $e->getMessage(), "\n";
        }      
    }
  
    public function index(){

       $params['datadbkelas'] =  $this->Mapp_siswa->getKelas();
       $this->getContent($params);
	}

    public function siswa(){

       $params['datadbkelas'] =  $this->Mapp_siswa->getKelas();
       $this->getContent($params);
    }    

    public function guru(){
      
       $params['datadbkelas'] =  $this->Mapp_siswa->getKelas();
       $this->getContent($params);
    }    

    public function karyawan(){
      
      $params['datadbkelas'] =  $this->Mapp_siswa->getKelas();      
       $this->getContent($params);
    }    
}
?>