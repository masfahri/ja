<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class App_websetup extends MX_Controller {
    
    # property
    public $root;
    public $app_name            = ''; 
    public $pageTitle           = ''; 
    public $initialPage         = 'Web Config';
    
    # initial file image
    public $imgDir              = 'uploads/image/logo';
  
    public $initial_template    = ''; 
    protected  $base_template   = array(
    'container' => '../../layout/container',
    'template'  => 'tpl',
    'template_fp' => 'tpl_fp',
    'template_in_out' => 'tpl_in_out'  
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
       $this->load->model('app_siswa/Mapp_siswa');        
	}
    
    protected function init(){
        
        isset($_SERVER['HTTP_REFERER']) ? $this->root = $_SERVER['HTTP_REFERER'] : '';  
        $this->app_name         = strtolower( __CLASS__ ); 
        $this->initial_id       = $this->uri->segment(3);
        $this->initial_template = $this->uri->segment(2); 
        $this->registerValidation();
        
        // initial helper
        $this->load->helper( array(
        'file/file'));
    }
    
    public function registerValidation(){
        
         define("REG_VALIDATION", strtolower( __CLASS__ ));
         define("REG_VALIDATION_IN_OUT", 'in_out');
         define("REG_VALIDATION_FP", 'fp');         
    }
        
    private function getContent($args = array()){
         
        try{
            if($this->uri->segment(2)=="fp" || $this->uri->segment(2)=="fp_add" || $this->uri->segment(2)=="fp_edit"){
                $body_data['contents'] = $this->load->view($this->base_template['template_fp'], $args, TRUE);
            }
            elseif($this->uri->segment(2)=="in_out" || $this->uri->segment(2)=="in_out_add" || $this->uri->segment(2)=="in_out_edit"){
                $body_data['contents'] = $this->load->view($this->base_template['template_in_out'], $args, TRUE);
            }                  
            else{
            $body_data['contents'] = $this->load->view($this->base_template['template'], $args, TRUE);
          }
            $this->load->view($this->base_template['container'], $body_data);
        }catch(Exception $e) {
            echo 'Caught exception, params function getContent is wrong : ',  $e->getMessage(), "\n";
        }      
    }

    /* Start Update server Function */    
    public function check_for_update() {
      if($_POST){
        echo "checking...";
          $this->load->library('github_updater');
          echo $this->github_updater->update() ? 'SUCCESS' : 'FAILED';

      }
      $this->getContent();
    }

    /* Start In/Out Function */    
    public function in_out() {
      $params['datadbkelas'] =  $this->Mapp_siswa->getKelas(); 
      $params['datadb']             =  $this->coredb->getInOut();
      $this->getContent($params);
    }

    public function in_out_add(){
        $params['datadbkelas'] =  $this->Mapp_siswa->getKelas();   
        $params['kelas'] =  $this->Mapp_siswa->getKelas();   
        $params['datadb'] = $this->coredb->grapFp($this->session->userdata('ip'));
        $validate = 'true';       
        if( $_POST ){
             if( $this->form_validation->run(REG_VALIDATION_IN_OUT) !== FALSE ){

                if( $validate == 'true' ){           
                  if( $validate !== 'false' ){
                      # record database    
                      $this->load->library('uidcontroll');
                      if( $this->uidcontroll->insertData('ja_in_out', bindProcessing($_POST) ) !== FALSE){
                          
                          $this->session->set_flashdata('msg_success', 'Success Save Data');  
                          redirect( base_url($this->app_name).'/in_out' );
                      
                      }else{$this->session->set_flashdata('msg_success', 'Invalid Data to Save !');}
                    }
                  }
                }else{ $this->messagecontroll->delivered('msg_warning', validation_errors()); } 
        }
        $this->getContent($params);  
    }     

    public function in_out_edit($id_fp){
        $params['datadbkelas'] =  $this->Mapp_siswa->getKelas();   
        $params['datadb'] = $this->coredb->grapInOut2($id_fp);
        $validate = 'true';           
        if( $_POST ){
            
            if( $this->form_validation->run( REG_VALIDATION_IN_OUT ) !== FALSE ){
               
                if( $validate == 'true' ){
                  if( $validate !== 'false' ){                
                     # update data
                     $this->load->library('uidcontroll');
                     $db_config['where'] = array('id', $this->initial_id);
                     $db_config['table'] = 'ja_in_out';
                     $db_config['data']  =  bindProcessing($_POST);
                     if( $this->uidcontroll->updateData( $db_config ) !== FALSE ){

                          $this->session->set_flashdata('msg_success', 'Success Update Data');
                          redirect( base_url($this->app_name).'/in_out' );
                          
                     }else{$this->messagecontroll->delivered('msg_error', 'Invalid Data to Update !');}    
                    }
            }                

                
            }else{ $this->messagecontroll->delivered('msg_warning', validation_errors()); }   
        }

        $this->getContent($params);  
    }    

    public function in_out_remove($initial_id){


        $this->load->library('uidcontroll');  

        $dataRemove = array('id', $this->initial_id); 
        if( $this->uidcontroll->removeData('ja_in_out', $dataRemove) == TRUE ){

            $this->session->set_flashdata('total_data', $this->uidcontroll->totalRecord);
            $this->session->set_flashdata('msg_success', 'Success Remove Data');
       }
        redirect(base_url($this->app_name).'/in_out');

    } 
    /* End In/Out Function */    
  
    /* Start Fingerprint Function */    
    public function fp() {
      $params['datadbkelas'] =  $this->Mapp_siswa->getKelas(); 
      $params['datadb']             =  $this->coredb->getFp();
      $this->getContent($params);
    }

    public function fp_add(){
        $params['datadbkelas'] =  $this->Mapp_siswa->getKelas();   
        $params['datadb'] = $this->coredb->grapFp($this->session->userdata('ip'));
        $validate = 'true';       
        if( $_POST ){
             if( $this->form_validation->run(REG_VALIDATION_FP) !== FALSE ){

               # check nip available
                if( $this->coredb->checkAvailableFp($_POST['ip']) == TRUE ){
                    
                    $validate = 'false';
                    $this->messagecontroll->delivered('msg_error', 'IP Fingerprint sudah ada dalam database, masukkan IP Fingerprint lainnya.');
                    $this->form_validation->run();
                }

                if( $validate == 'true' ){           
                  if( $validate !== 'false' ){
                      # record database    
                      $this->load->library('uidcontroll');
                      if( $this->uidcontroll->insertData('ja_fp', bindProcessing($_POST) ) !== FALSE){
                          
                          $this->session->set_flashdata('msg_success', 'Success Save Data');  
                          redirect( base_url($this->app_name).'/fp' );
                      
                      }else{$this->session->set_flashdata('msg_success', 'Invalid Data to Save !');}
                    }
                  }
                }else{ $this->messagecontroll->delivered('msg_warning', validation_errors()); } 
        }
        $this->getContent($params);  
    }     

    public function fp_edit($id_fp){
        $params['datadbkelas'] =  $this->Mapp_siswa->getKelas();   
        $params['datadb'] = $this->coredb->grapFp($id_fp);
        $validate = 'true';           
        if( $_POST ){
            
            if( $this->form_validation->run( REG_VALIDATION_FP ) !== FALSE ){
               
                if( $validate == 'true' ){
                  if( $validate !== 'false' ){                
                     # update data
                     $this->load->library('uidcontroll');
                     $db_config['where'] = array('id', $this->initial_id);
                     $db_config['table'] = 'ja_fp';
                     $db_config['data']  =  bindProcessing($_POST);
                     if( $this->uidcontroll->updateData( $db_config ) !== FALSE ){

                          $this->session->set_flashdata('msg_success', 'Success Update Data');
                          redirect( base_url($this->app_name).'/fp' );
                          
                     }else{$this->messagecontroll->delivered('msg_error', 'Invalid Data to Update !');}    
                    }
            }                

                
            }else{ $this->messagecontroll->delivered('msg_warning', validation_errors()); }   
        }

        $this->getContent($params);  
    }    

    public function fp_remove(){


        $this->load->library('uidcontroll');  

        $dataRemove = array('id', $this->initial_id); 
        if( $this->uidcontroll->removeData('ja_fp', $dataRemove) == TRUE ){

            $this->session->set_flashdata('total_data', $this->uidcontroll->totalRecord);
            $this->session->set_flashdata('msg_success', 'Success Remove Data');
       }
        redirect(base_url($this->app_name).'/fp');

    } 
    /* End Fingerprint Function */

    public function index(){
        
        $this->breadcrumb = array('Edit' => 'javascript:;');
        $params['datadb'] =  $this->coredb->bindDataSetup(1);
        $params['datadb2'] = $this->coredb->bindDataPage();
        $params['datadb3'] = $this->coredb->getSocial(1);

        $msg = '';
        if( $_POST ){
            
             # ( * checking file image LOGO must be upload )
             $_POST['file_img'] = 'true';
             if( isset($_FILES['fileupl']) ){
                if( $_FILES['fileupl']['name'] !== "" ){
                          
                   # check minimum width and height
                    list($width, $height, $type, $attr) = getimagesize($_FILES['fileupl']['tmp_name']);      
                    if( $width <  config_item('web_logo')['width'] || $height <  config_item('web_logo')['height'] ){ 
                        $msg .= 'Minimum file images must be in size '.config_item('web_logo')['width'].' x '.config_item('web_logo')['height'];     
                    }
                    
                }
             }
             # -------------------------------------------------------------------------------------
             
             
             # ( * checking file image FAVICON must be upload )
             if( isset($_FILES['fileico']) ){
                
                if( $_FILES['fileico']['name'] !== "" ){
                          
                   # check minimum width and height
                    list($width, $height, $type, $attr) = getimagesize($_FILES['fileico']['tmp_name']);      
                    if( $width <  config_item('web_favicon')['width'] || $height <  config_item('web_favicon')['height'] ){ 
                        $msg .= 'Minimum file images must be in size '.config_item('web_favicon')['width'].' x '.config_item('web_favicon')['height'];     
                    }
                    
                }
             }
             # -------------------------------------------------------------------------------------
            
             if( $this->form_validation->run(REG_VALIDATION) !== FALSE ){
               
                # processing file upload LOGO if file not empty
                if( $_FILES['fileupl']['name'] !== "" ){
                  
                    # remove old file image
                    $dataImage   = $this->coredb->grapImage();
                    $dirPath     = $dataImage['file'];
                    $thumbPath   = getThumbnailsImage($dataImage['file'], $dataImage['extention']);
                    // remove original image
                    if(file_exists($dirPath)){unlink($dirPath);}
                    // remove thumbnails image
                    if(file_exists($thumbPath)){unlink($thumbPath);} 
                    
                    # processing file upload
                    $parsingImage = array(
                    'resize'    => true,
                    'size'      => '', 
                    'files'     => $_FILES['fileupl'],
                    'directory' => $this->imgDir
                    );
                    uploadFile($parsingImage);      
               }
               # -------------------------------------------------------------------------------------
               
               # processing file upload FAVICON if file not empty
                if( $_FILES['fileico']['name'] !== "" ){
                 
                   # remove old file image
                    $dataImage   = $this->coredb->grapImage();
                    $dirPath     = $dataImage['favicon'];
                    // remove original image
                    if(file_exists($dirPath)){unlink($dirPath);}
                   
                    # processing file upload
                    $parsingImage = array(
                    'resize'    => true,
                    'post'      => 'favicon',
                    'size'      => '', 
                    'files'     => $_FILES['fileico'],
                    'directory' => $this->imgDir
                    );
                    uploadFile($parsingImage);    
               }
               # -------------------------------------------------------------------------------------
              
               unset($_POST['file_img']);
               # record database    
               $this->load->library('uidcontroll');
               $db_update['where'] = array('web_setup_id',1);
			   $db_update['table'] = 'web_setup';
			   $db_update['data']  =  bindProcessing($_POST);
               
               if( $this->uidcontroll->updateData($db_update) !== FALSE){
                
                    $this->session->set_flashdata('msg_success', 'Success Update Data');
                    redirect($this->root);
               }else{$this->messagecontroll->delivered('msg_error', 'Invalid Data to Update !');}
                
            }else{$this->messagecontroll->delivered('msg_warning', validation_errors()); } 
        }
        
        $this->pageTitle = 'Edit';
        $params['datadb_lang']  =  $this->coredb->getDataLang();
        $this->getContent($params);
    }

    public function contact()
    {
        $params['datadb'] = $this->coredb->bindDataPage();
        //var_dump($params['datadb']);
        if( $_POST ){
                           
               # record database    
               $this->load->library('uidcontroll');
               $db_update['where'] = array('contact_id',1);
               $db_update['table'] = 'page_contact';
               $db_update['data']  =  bindProcessing($_POST);
               
               if( $this->uidcontroll->updateData($db_update) !== FALSE){
                
                    $this->session->set_flashdata('msg_success', 'Success Update Data');
                    redirect(base_url('app_websetup'));
               }else{$this->messagecontroll->delivered('msg_error', 'Invalid Data to Update !');}
        }
        $this->getContent($params);   
    }

    public function social()
    {
        $params['datadb'] = $this->coredb->getSocial();
        //var_dump($params['datadb']);
        if( $_POST ){
                           
               # record database    
               $this->load->library('uidcontroll');
               $db_update['where'] = array('id_social',1);
               $db_update['table'] = 'social';
               $db_update['data']  =  bindProcessing($_POST);
               
               if( $this->uidcontroll->updateData($db_update) !== FALSE){
                
                    $this->session->set_flashdata('msg_success', 'Success Update Data');
                    redirect(base_url('app_websetup'));
               }else{$this->messagecontroll->delivered('msg_error', 'Invalid Data to Update !');}
        }
        $this->getContent($params);   
    }
}
?>