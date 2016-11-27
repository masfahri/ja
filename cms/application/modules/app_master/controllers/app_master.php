<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class App_master extends MX_Controller {
    
    # property
    public $root;
    protected  $base_template   = array(
    'container' => '../../layout/container',
    'template_siswa'  => 'tpl_siswa',
    'template_guru'  => 'tpl_guru',
    'template_karyawan'  => 'tpl_karyawan',
    'template_jurusan'  => 'tpl_jurusan',
    'template_kelas' => 'tpl_kelas',
    'template_hr_libur' => 'tpl_hr_libur',
    'template_kategori_izin' => 'tpl_izin',          
    );

    # initial file image
    public $imgDir              = 'uploads/image/user';

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
       //load model koneksi fp
       $this->load->model('app_websetup/Mapp_websetup'); 
    }
    
    protected function init(){
    
        
        isset($_SERVER['HTTP_REFERER']) ? $this->root = $_SERVER['HTTP_REFERER'] : '';  
        $this->app_name         = strtolower( __CLASS__ ); 
        $this->initial_id       = $this->uri->segment(3);
        $this->initial_template = $this->uri->segment(2); 
        $this->registerValidation();
        
        // initial helper
        $this->load->helper( array(
        'file/file'
        ));
    }

    public function registerValidation(){
        
         define("REG_VALIDATION", strtolower( __CLASS__ ));
         define("REG_VALIDATION_JURUSAN", 'jurusan');
         define("REG_VALIDATION_KELAS", 'kelas');
         define("REG_VALIDATION_SISWA", 'siswa'); 
         define("REG_VALIDATION_KARYAWAN", 'karyawan');
         define("REG_VALIDATION_LIBUR", 'libur');                                    
    }    

    private function getContent($args = array()){
         
        try{
            if($this->uri->segment(2)=="siswa" || $this->uri->segment(2)=="siswa_add" || $this->uri->segment(2)=="siswa_edit"){
                $body_data['contents'] = $this->load->view($this->base_template['template_siswa'], $args, TRUE);
            }   
            elseif($this->uri->segment(2)=="guru" || $this->uri->segment(2)=="guru_add" || $this->uri->segment(2)=="guru_edit"){
                $body_data['contents'] = $this->load->view($this->base_template['template_guru'], $args, TRUE);
            } 
            elseif($this->uri->segment(2)=="karyawan" || $this->uri->segment(2)=="karyawan_add" || $this->uri->segment(2)=="karyawan_edit"){
                $body_data['contents'] = $this->load->view($this->base_template['template_karyawan'], $args, TRUE);
            }
            elseif($this->uri->segment(2)=="jurusan" || $this->uri->segment(2)=="jurusan_add" || $this->uri->segment(2)=="jurusan_edit"){
                $body_data['contents'] = $this->load->view($this->base_template['template_jurusan'], $args, TRUE);
            }
            elseif($this->uri->segment(2)=="kelas" || $this->uri->segment(2)=="kelas_add" || $this->uri->segment(2)=="kelas_edit"){
                $body_data['contents'] = $this->load->view($this->base_template['template_kelas'], $args, TRUE);
            }  
            elseif($this->uri->segment(2)=="hari_libur" || $this->uri->segment(2)=="hari_libur_add" || $this->uri->segment(2)=="hari_libur_edit"){
                $body_data['contents'] = $this->load->view($this->base_template['template_hr_libur'], $args, TRUE);
            }
            elseif($this->uri->segment(2)=="kategori_izin" || $this->uri->segment(2)=="kategori_izin_add" || $this->uri->segment(2)=="kategori_izin_edit"){
                $body_data['contents'] = $this->load->view($this->base_template['template_kategori_izin'], $args, TRUE);
            }                                                       
            else {
                $body_data['contents'] = $this->load->view($this->base_template['template_guru'], $args, TRUE);
            }                                     
            $this->load->view($this->base_template['container'], $body_data);
        }catch(Exception $e) {
            echo 'Caught exception, params function getContent is wrong : ',  $e->getMessage(), "\n";
        }      
    }
  
    public function index(){
       $params['datadb'] =  $this->coredb->getGuru();
       $params['datadbkelas'] =  $this->Mapp_siswa->getKelas();   
       $this->getContent($params);
	}

    /*  Kategori izin Function */
    public function kategori_izin(){
       $params['datadbkelas'] =  $this->Mapp_siswa->getKelas();   
       $params['datadb'] =  $this->coredb->getKatIzin(); 
       $this->getContent($params);
    }    

    /* End Kategori izin function */

    /*  Hari libur Function */
    public function hari_libur(){
       $params['datadbkelas'] =  $this->Mapp_siswa->getKelas();   
       $params['datadb'] =  $this->coredb->getHariLibur(); 
       $this->getContent($params);
    }    

    public function hari_libur_add(){
        $params['datadbkelas'] =  $this->Mapp_siswa->getKelas();   
        $params['kelas'] =  $this->coredb->getKelas();
        $params['datadb'] = $this->coredb->grapHariLibur($this->session->userdata('id'));
        $id_kelas = $this->input->post('id_kelas');
        $tipe = $this->input->post('tipe');
        $validate = 'true';       
        if( $_POST ){
             if( $this->form_validation->run(REG_VALIDATION_LIBUR) !== FALSE ){

               # check nip available
                if( $this->coredb->checkAvailableUser($_POST['id']) == TRUE ){
                    
                    $validate = 'false';
                    $this->messagecontroll->delivered('msg_error', 'Hari Libur sudah ada dalam database, masukkan Hari Libur lainnya.');
                    $this->form_validation->run();
                }

                if( $validate == 'true' ){

            if( $validate !== 'false' ){
                $_POST['id_kelas'] = $id_kelas;
                $_POST['tipe'] = $tipe;
                # record database    
                $this->load->library('uidcontroll');
                if( $this->uidcontroll->insertData('ja_hari_libur', bindProcessing($_POST) ) !== FALSE){
                    $this->session->set_flashdata('msg_success', 'Success Save Data');  
                    redirect( base_url($this->app_name).'/hari_libur' );
                
                }else{$this->session->set_flashdata('msg_success', 'Invalid Data to Save !');}
              }
            }

            }else{ $this->messagecontroll->delivered('msg_warning', validation_errors()); } 
        }
        $this->getContent($params);  
    } 

    public function hari_libur_edit($id_finger){
        $params['datadbkelas'] =  $this->Mapp_siswa->getKelas();   
        $params['datadb'] = $this->coredb->grapHariLibur($id_finger);
        $validate = 'true';           
        if( $_POST ){
            
            if( $this->form_validation->run( REG_VALIDATION_LIBUR ) !== FALSE ){
               
                if( $validate == 'true' ){
             # -------------------------------------------------------------------------------------
             
            if( $validate !== 'false' ){                
               # update data
               $this->load->library('uidcontroll');
               $db_config['where'] = array('id', $this->initial_id);
               $db_config['table'] = 'ja_hari_libur';
               $db_config['data']  =  bindProcessing($_POST);
               if( $this->uidcontroll->updateData( $db_config ) !== FALSE ){

                    $this->session->set_flashdata('msg_success', 'Success Update Data');
                    redirect( base_url($this->app_name).'/hari_libur' );
                    
               }else{$this->messagecontroll->delivered('msg_error', 'Invalid Data to Update !');}    
              }
            }                

                
            }else{ $this->messagecontroll->delivered('msg_warning', validation_errors()); }   
        }

        $this->getContent($params);  
    }    

    public function hari_libur_remove($id_finger){

        $this->load->library('uidcontroll');  
        $dataRemove = array('id', $this->initial_id); 
        if( $this->uidcontroll->removeData('ja_hari_libur', $dataRemove) == TRUE ){

            $this->session->set_flashdata('total_data', $this->uidcontroll->totalRecord);
            $this->session->set_flashdata('msg_success', 'Success Remove Data');
       }
        redirect(base_url($this->app_name).'/hari_libur');

    } 

    /* End Hari Libur function */

    /*  Siswa Function */
    public function siswa(){
       $params['datadbkelas'] =  $this->Mapp_siswa->getKelas();   
       $params['datadb'] =  $this->coredb->getSiswa();
       $params['kelas'] =  $this->coredb->getKelas();      
       $this->getContent($params);
    }    

    public function siswa_add(){
        $params['datadbkelas'] =  $this->Mapp_siswa->getKelas();   
        $params['kelas'] =  $this->coredb->getKelas();
        $params['datadb'] = $this->coredb->grapSiswa($this->session->userdata('nis'));
        $nip = $this->input->post('nis');
        $validate = 'true';       
        if( $_POST ){
             if( $this->form_validation->run(REG_VALIDATION_SISWA) !== FALSE ){

               # check nip available
                if( $this->coredb->checkAvailableSiswa($_POST['nis']) == TRUE ){
                    
                    $validate = 'false';
                    $this->messagecontroll->delivered('msg_error', 'NIS sudah ada dalam database, masukkan NIS lainnya.');
                    $this->form_validation->run();
                }

                if( $validate == 'true' ){
                // Get All Fingerprint device
                $params['device'] = $this->Mapp_websetup->getFp();

                    if( count($params['device']) > 0 ){
                        foreach($params['device'] as $row){    

                  if($row['ip'] != '' && $row['key'] != '') {
                   # processing input to fingerprint
                        $IP=$row['ip'];
                        $Key=$row['key'];
                        $ud=$_POST['pin'];
                        $nama_panggilan = $_POST['nama_panggilan'];

                        $Connect = @fsockopen($IP, "80", $errno, $errstr, 1);
                          if($Connect){
                            
                          
                            $soap_request="<SetUserInfo><ArgComKey Xsi:type=\"xsd:integer\">".$Key."</ArgComKey><Arg><PIN>".
                            $ud."</PIN><Name>".$nama_panggilan."</Name></Arg></SetUserInfo>";
                            $newLine="\r\n";
                            fputs($Connect, "POST /iWsService HTTP/1.0".$newLine);
                              fputs($Connect, "Content-Type: text/xml".$newLine);
                              fputs($Connect, "Content-Length: ".strlen($soap_request).$newLine.$newLine);
                              fputs($Connect, $soap_request.$newLine);
                            $buffer="";
                            while($Response=fgets($Connect, 1024)){
                              $buffer=$buffer.$Response;
                            }
                          }//else echo "Koneksi Gagal";
                            
                          echo $buffer;
                          $buffer=$this->Parse_Data($buffer,"<Information>","</Information>");

                        }
                        else{
                              echo "<small class='label bg-red'>Data Siswa belum lengkap</small>";
                         }                    
                      }
                    }
                    //=================

               # processing file upload
               if( $_FILES['file']['name'] !== "" )
               {
                   $this->load->library('fileupload');
                   $this->fileupload->path_directory = $this->imgDir;
                   if( $this->fileupload->init($_FILES['file']) !== FALSE ){
                        $_POST['foto']     = $this->fileupload->path_directory;
                   }
               }

               # processing password
               if( $_POST['pasword'] ){
                  //$_POST['salt'] = date('ymdhis').session_id();
                  $_POST['pasword'] = $this->hash_password( $_POST['pasword'] );
                  //unset($_POST['repassword']);
               }               
             # -------------------------------------------------------------------------------------



            if( $validate !== 'false' ){
                # record database    
                $this->load->library('uidcontroll');
                if( $this->uidcontroll->insertData('ja_siswa', bindProcessing($_POST) ) !== FALSE){
                    $this->session->set_flashdata('msg_success', 'Success Save Data');  
                    redirect( base_url($this->app_name).'/siswa' );
                
                }else{$this->session->set_flashdata('msg_success', 'Invalid Data to Save !');}
              }
            }

            }else{ $this->messagecontroll->delivered('msg_warning', validation_errors()); } 
        }
        $this->getContent($params);  
    } 
    
    public function siswa_edit($id_finger){
        $params['datadbkelas'] =  $this->Mapp_siswa->getKelas();   
        $params['datadb'] = $this->coredb->grapSiswa($id_finger);
        $params['kelas'] =  $this->coredb->getKelas();
        $params['kelamin'] =  $this->coredb->getKelamin($id_finger);
        $validate = 'true';           
        if( $_POST ){
            
            if( $this->form_validation->run( REG_VALIDATION_SISWA ) !== FALSE ){
               
                if( $validate == 'true' ){
                // Get All Fingerprint device
                $params['device'] = $this->Mapp_websetup->getFp();

                    if( count($params['device']) > 0 ){
                        foreach($params['device'] as $row){    

                  if($row['ip'] != '' && $row['key'] != '') {
                   # processing input to fingerprint
                        $IP=$row['ip'];
                        $Key=$row['key'];
                        $ud=$_POST['pin'];
                        $nama_panggilan = $_POST['nama_panggilan'];

                        $Connect = @fsockopen($IP, "80", $errno, $errstr, 1);
                          if($Connect){
                            
                          
                            $soap_request="<SetUserInfo><ArgComKey Xsi:type=\"xsd:integer\">".$Key."</ArgComKey><Arg><PIN>".
                            $ud."</PIN><Name>".$nama_panggilan."</Name></Arg></SetUserInfo>";
                            $newLine="\r\n";
                            fputs($Connect, "POST /iWsService HTTP/1.0".$newLine);
                              fputs($Connect, "Content-Type: text/xml".$newLine);
                              fputs($Connect, "Content-Length: ".strlen($soap_request).$newLine.$newLine);
                              fputs($Connect, $soap_request.$newLine);
                            $buffer="";
                            while($Response=fgets($Connect, 1024)){
                              $buffer=$buffer.$Response;
                            }
                          }//else echo "Koneksi Gagal";
                            
                          echo $buffer;
                          $buffer=$this->Parse_Data($buffer,"<Information>","</Information>");

                        }
                        else{
                              echo "<small class='label bg-red'>Data Siswa belum lengkap</small>";
                         }                    
                      }
                    }
                    //=================


               # processing file upload
               if( $_FILES['file']['name'] !== "" )
               {
                   $this->load->library('fileupload');
                   $this->fileupload->path_directory = $this->imgDir;
                   if( $this->fileupload->init($_FILES['file']) !== FALSE ){
                        $_POST['foto']     = $this->fileupload->path_directory;
                   }
               }
             # -------------------------------------------------------------------------------------
             
            if( $validate !== 'false' ){                
               # update data
               $this->load->library('uidcontroll');
               $db_config['where'] = array('id', $this->initial_id);
               $db_config['table'] = 'ja_siswa';
               $db_config['data']  =  bindProcessing($_POST);
               if( $this->uidcontroll->updateData( $db_config ) !== FALSE ){

                    $this->session->set_flashdata('msg_success', 'Success Update Data');
                    redirect( base_url($this->app_name).'/siswa' );
                    
               }else{$this->messagecontroll->delivered('msg_error', 'Invalid Data to Update !');}    
              }
            }                

                
            }else{ $this->messagecontroll->delivered('msg_warning', validation_errors()); }   
        }

        $this->getContent($params);  
    }    

    public function siswa_remove($id_finger){

        $this->load->library('uidcontroll');  
        # remove all image
        $getFile          = $this->coredb->grapSiswa($this->initial_id);
        if( $getFile['foto'] != ''  ){
            
            $dirPath        = $getFile['foto'];
            $thumbPath      = getThumbnailsImage($getFile['foto']);
          
            // remove original image
            if(file_exists($dirPath)){unlink($dirPath);}
            // remove thumbnails image
            if(file_exists($thumbPath)){unlink($thumbPath);} 
        }


                // Get All Fingerprint device
                $params['device'] = $this->Mapp_websetup->getFp();

                    if( count($params['device']) > 0 ){
                        foreach($params['device'] as $row){    

                  if($row['ip'] != '' && $row['key'] != '') {
                   # processing input to fingerprint
                        $IP=$row['ip'];
                        $Key=$row['key'];
                        $ud=$id_finger;



                      $Connect = @fsockopen($IP, "80", $errno, $errstr, 1);
                        if($Connect){
                          
                          $soap_request="<DeleteUser><ArgComKey Xsi:type=\"xsd:integer\">".$Key."</DeleteUser>
                                      <Arg><PIN xsi:type='xsd:integer'>".$ud."</PIN><Name></Name></Arg></ClearData>";
                          $newLine="\r\n";
                          fputs($Connect, "POST /iWsService HTTP/1.0".$newLine);
                            fputs($Connect, "Content-Type: text/xml".$newLine);
                            fputs($Connect, "Content-Length: ".strlen($soap_request).$newLine.$newLine);
                            fputs($Connect, $soap_request.$newLine);
                          $buffer="";
                          while($Response=fgets($Connect, 1024)){
                            $buffer=$buffer.$Response;
                          }
                        }//else //echo "Koneksi Gagal";
                          //echo $buffer;
                          $buffer=$this->Parse_Data($buffer,"<Information>","</Information>");

                        }
                        else{
                              echo "<small class='label bg-red'>Data Siswa belum lengkap</small>";
                         }                    
                      }
                    }
                    //=================

        $dataRemove = array('pin', $this->initial_id); 
        if( $this->uidcontroll->removeData('ja_siswa', $dataRemove) == TRUE ){

            $this->session->set_flashdata('total_data', $this->uidcontroll->totalRecord);
            $this->session->set_flashdata('msg_success', 'Success Remove Data');
       }
        redirect(base_url($this->app_name).'/siswa');

    } 
    /* End Siswa Function */

    /*  Guru Function */
    public function guru(){
       $params['datadbkelas'] =  $this->Mapp_siswa->getKelas();   
       $params['datadb'] =  $this->coredb->getGuru();
        if( $_POST ){     

               # update data
               $this->load->library('uidcontroll');
               $db_config['where'] = array('No', '1');
               $db_config['table'] = 'ja_guru';
               $db_config['data']  =  bindProcessing($_POST);
               if( $this->uidcontroll->updateData( $db_config ) !== FALSE ){

                    $this->session->set_flashdata('msg_success', 'Success Update Data');
                    redirect( base_url($this->app_name) );
                    
               }else{$this->messagecontroll->delivered('msg_error', 'Invalid Data to Update !');}    
                
            }else{ $this->messagecontroll->delivered('msg_warning', validation_errors()); }          
       $this->getContent($params);
    }    

    public function guru_add(){
        $params['datadbkelas'] =  $this->Mapp_siswa->getKelas();   
        $params['datadb'] = $this->coredb->grapGuru($this->session->userdata('nip'));
        $nip = $this->input->post('nip');
        $validate = 'true';       
        if( $_POST ){
             if( $this->form_validation->run(REG_VALIDATION) !== FALSE ){

               # check nip available
                if( $this->coredb->checkAvailableUser($_POST['nip']) == TRUE ){
                    
                    $validate = 'false';
                    $this->messagecontroll->delivered('msg_error', 'NIP sudah ada dalam database, masukkan NIP lainnya.');
                    $this->form_validation->run();
                }

                if( $validate == 'true' ){

                // Get All Fingerprint device
                $params['device'] = $this->Mapp_websetup->getFp();

                    if( count($params['device']) > 0 ){
                        foreach($params['device'] as $row){    

                  if($row['ip'] != '' && $row['key'] != '') {
                   # processing input to fingerprint
                        $IP=$row['ip'];
                        $Key=$row['key'];
                        $ud=$_POST['pin'];
                        $nama_panggilan = $_POST['nama'];

                        $Connect = @fsockopen($IP, "80", $errno, $errstr, 1);
                          if($Connect){
                            
                          
                            $soap_request="<SetUserInfo><ArgComKey Xsi:type=\"xsd:integer\">".$Key."</ArgComKey><Arg><PIN>".
                            $ud."</PIN><Name>".$nama_panggilan."</Name></Arg></SetUserInfo>";
                            $newLine="\r\n";
                            fputs($Connect, "POST /iWsService HTTP/1.0".$newLine);
                              fputs($Connect, "Content-Type: text/xml".$newLine);
                              fputs($Connect, "Content-Length: ".strlen($soap_request).$newLine.$newLine);
                              fputs($Connect, $soap_request.$newLine);
                            $buffer="";
                            while($Response=fgets($Connect, 1024)){
                              $buffer=$buffer.$Response;
                            }
                          }//else echo "Koneksi Gagal";
                            
                          echo $buffer;
                          $buffer=$this->Parse_Data($buffer,"<Information>","</Information>");

                        }
                        else{
                              echo "<small class='label bg-red'>Data Siswa belum lengkap</small>";
                         }                    
                      }
                    }
                    //=================

               # processing file upload
               if( $_FILES['file']['name'] !== "" )
               {
                   $this->load->library('fileupload');
                   $this->fileupload->path_directory = $this->imgDir;
                   if( $this->fileupload->init($_FILES['file']) !== FALSE ){
                        $_POST['foto']     = $this->fileupload->path_directory;
                   }
               }

               # processing password
               if( $_POST['pasword'] ){
                  //$_POST['salt'] = date('ymdhis').session_id();
                  $_POST['pasword'] = $this->hash_password( $_POST['pasword'] );
                  //unset($_POST['repassword']);
               }               
             # -------------------------------------------------------------------------------------



            if( $validate !== 'false' ){
                # record database    
                $this->load->library('uidcontroll');
                if( $this->uidcontroll->insertData('ja_guru', bindProcessing($_POST) ) !== FALSE){
                    
                    $this->session->set_flashdata('msg_success', 'Success Save Data');  
                    redirect( base_url($this->app_name) );
                
                }else{$this->session->set_flashdata('msg_success', 'Invalid Data to Save !');}
              }
            }

            }else{ $this->messagecontroll->delivered('msg_warning', validation_errors()); } 
        }
        $this->getContent($params);  
    } 
    
    public function guru_edit($id_finger){
        $params['datadbkelas'] =  $this->Mapp_siswa->getKelas();   
        $params['datadb'] =  $this->coredb->grapGuru($this->initial_id); 
        $validate = 'true';           
        if( $_POST ){
            
            if( $this->form_validation->run( REG_VALIDATION ) !== FALSE ){
               
                if( $validate == 'true' ){

                // Get All Fingerprint device
                $params['device'] = $this->Mapp_websetup->getFp();

                    if( count($params['device']) > 0 ){
                        foreach($params['device'] as $row){    

                  if($row['ip'] != '' && $row['key'] != '') {
                   # processing input to fingerprint
                        $IP=$row['ip'];
                        $Key=$row['key'];
                        $ud=$_POST['pin'];
                        $nama_panggilan = $_POST['nama'];

                        $Connect = @fsockopen($IP, "80", $errno, $errstr, 1);
                          if($Connect){
                            
                          
                            $soap_request="<SetUserInfo><ArgComKey Xsi:type=\"xsd:integer\">".$Key."</ArgComKey><Arg><PIN>".
                            $ud."</PIN><Name>".$nama_panggilan."</Name></Arg></SetUserInfo>";
                            $newLine="\r\n";
                            fputs($Connect, "POST /iWsService HTTP/1.0".$newLine);
                              fputs($Connect, "Content-Type: text/xml".$newLine);
                              fputs($Connect, "Content-Length: ".strlen($soap_request).$newLine.$newLine);
                              fputs($Connect, $soap_request.$newLine);
                            $buffer="";
                            while($Response=fgets($Connect, 1024)){
                              $buffer=$buffer.$Response;
                            }
                          }//else echo "Koneksi Gagal";
                            
                          echo $buffer;
                          $buffer=$this->Parse_Data($buffer,"<Information>","</Information>");

                        }
                        else{
                              echo "<small class='label bg-red'>Data Siswa belum lengkap</small>";
                         }                    
                      }
                    }
                    //=================

               # processing file upload
               if( $_FILES['file']['name'] !== "" )
               {
                   $this->load->library('fileupload');
                   $this->fileupload->path_directory = $this->imgDir;
                   if( $this->fileupload->init($_FILES['file']) !== FALSE ){
                        $_POST['foto']     = $this->fileupload->path_directory;
                   }
               }
             # -------------------------------------------------------------------------------------
             
            if( $validate !== 'false' ){                
               # update data
               $this->load->library('uidcontroll');
               $db_config['where'] = array('nip', $this->initial_id);
               $db_config['table'] = 'ja_guru';
               $db_config['data']  =  bindProcessing($_POST);
               if( $this->uidcontroll->updateData( $db_config ) !== FALSE ){

                    $this->session->set_flashdata('msg_success', 'Success Update Data');
                    redirect( base_url($this->app_name) );
                    
               }else{$this->messagecontroll->delivered('msg_error', 'Invalid Data to Update !');}    
              }
            }                

                
            }else{ $this->messagecontroll->delivered('msg_warning', validation_errors()); }   
        }

        $this->getContent($params);  
    }    

    public function guru_remove($id_finger){


        $this->load->library('uidcontroll');  
        # remove all image
        $getFile          = $this->coredb->grapGuru($this->initial_id);
        if( $getFile['foto'] != ''  ){
            
            $dirPath        = $getFile['foto'];
            $thumbPath      = getThumbnailsImage($getFile['foto']);
          
            // remove original image
            if(file_exists($dirPath)){unlink($dirPath);}
            // remove thumbnails image
            if(file_exists($thumbPath)){unlink($thumbPath);} 
        }

                // Get All Fingerprint device
                $params['device'] = $this->Mapp_websetup->getFp();

                    if( count($params['device']) > 0 ){
                        foreach($params['device'] as $row){    

                  if($row['ip'] != '' && $row['key'] != '') {
                   # processing input to fingerprint
                        $IP=$row['ip'];
                        $Key=$row['key'];
                        $ud=$id_finger;



                      $Connect = @fsockopen($IP, "80", $errno, $errstr, 1);
                        if($Connect){
                          
                          $soap_request="<DeleteUser><ArgComKey Xsi:type=\"xsd:integer\">".$Key."</DeleteUser>
                                      <Arg><PIN xsi:type='xsd:integer'>".$ud."</PIN><Name></Name></Arg></ClearData>";
                          $newLine="\r\n";
                          fputs($Connect, "POST /iWsService HTTP/1.0".$newLine);
                            fputs($Connect, "Content-Type: text/xml".$newLine);
                            fputs($Connect, "Content-Length: ".strlen($soap_request).$newLine.$newLine);
                            fputs($Connect, $soap_request.$newLine);
                          $buffer="";
                          while($Response=fgets($Connect, 1024)){
                            $buffer=$buffer.$Response;
                          }
                        }//else //echo "Koneksi Gagal";
                          //echo $buffer;
                          $buffer=$this->Parse_Data($buffer,"<Information>","</Information>");

                        }
                        else{
                              echo "<small class='label bg-red'>Data Siswa belum lengkap</small>";
                         }                    
                      }
                    }
                    //=================


        $dataRemove = array('id_finger', $this->initial_id); 
        if( $this->uidcontroll->removeData('ja_guru', $dataRemove) == TRUE ){

            $this->session->set_flashdata('total_data', $this->uidcontroll->totalRecord);
            $this->session->set_flashdata('msg_success', 'Success Remove Data');
       }
        redirect(base_url($this->app_name));

    } 
    /* End Guru Function */

    /* Jurusan Function */
    public function jurusan(){
       $params['datadbkelas'] =  $this->Mapp_siswa->getKelas();   
       $params['datadb'] =  $this->coredb->getJurusan();
        if( $_POST ){     

               # update data
               $this->load->library('uidcontroll');
               $db_config['where'] = array('id', '1');
               $db_config['table'] = 'ja_jurusan';
               $db_config['data']  =  bindProcessing($_POST);
               if( $this->uidcontroll->updateData( $db_config ) !== FALSE ){

                    $this->session->set_flashdata('msg_success', 'Success Update Data');
                    redirect( base_url($this->app_name) );
                    
               }else{$this->messagecontroll->delivered('msg_error', 'Invalid Data to Update !');}    
                
            }else{ $this->messagecontroll->delivered('msg_warning', validation_errors()); }          
       $this->getContent($params);
    }    

    public function jurusan_add(){
        $params['datadb'] = $this->coredb->grapJurusan($this->session->userdata('id'));
        $nip = $this->input->post('id');
        $validate = 'true';       
        if( $_POST ){
             if( $this->form_validation->run(REG_VALIDATION_JURUSAN) !== FALSE ){

               # check jurusan available
                if( $this->coredb->checkAvailableUser($_POST['id']) == TRUE ){
                    
                    $validate = 'false';
                    $this->messagecontroll->delivered('msg_error', 'Jurusan sudah ada dalam database, masukkan Jurusan lainnya.');
                    $this->form_validation->run();
                }

             # -------------------------------------------------------------------------------------



            if( $validate == 'true' ){           
            if( $validate !== 'false' ){
                # record database    
                $this->load->library('uidcontroll');
                if( $this->uidcontroll->insertData('ja_jurusan', bindProcessing($_POST) ) !== FALSE){
                    
                    $this->session->set_flashdata('msg_success', 'Success Save Data');  
                    redirect( base_url($this->app_name).'/jurusan' );
                
                }else{$this->session->set_flashdata('msg_success', 'Invalid Data to Save !');}
              }
            }

            }else{ $this->messagecontroll->delivered('msg_warning', validation_errors()); } 
        }
        $this->getContent($params);  
    } 
    
    public function jurusan_edit($id_finger){
        $params['datadbkelas'] =  $this->Mapp_siswa->getKelas();   
        $params['datadb'] =  $this->coredb->grapJurusan($this->initial_id); 
        $validate = 'true';           
        if( $_POST ){
            
            if( $this->form_validation->run( REG_VALIDATION_JURUSAN ) !== FALSE ){
               
            if( $validate == 'true' ){             
            if( $validate !== 'false' ){                
               # update data
               $this->load->library('uidcontroll');
               $db_config['where'] = array('id', $this->initial_id);
               $db_config['table'] = 'ja_jurusan';
               $db_config['data']  =  bindProcessing($_POST);
               if( $this->uidcontroll->updateData( $db_config ) !== FALSE ){

                    $this->session->set_flashdata('msg_success', 'Success Update Data');
                    redirect( base_url($this->app_name).'/jurusan' );
                    
               }else{$this->messagecontroll->delivered('msg_error', 'Invalid Data to Update !');}    
              }
            }                

                
            }else{ $this->messagecontroll->delivered('msg_warning', validation_errors()); }   
        }

        $this->getContent($params);  
    }    
  
    public function jurusan_remove(){


        $this->load->library('uidcontroll');  

        $dataRemove = array('id', $this->initial_id); 
        if( $this->uidcontroll->removeData('ja_jurusan', $dataRemove) == TRUE ){

            $this->session->set_flashdata('total_data', $this->uidcontroll->totalRecord);
            $this->session->set_flashdata('msg_success', 'Success Remove Data');
       }
        redirect(base_url($this->app_name).'/jurusan');

    } 
    /* End Jurusan Function */

    /* Kelas Function */
    public function kelas(){
       $params['datadbkelas'] =  $this->Mapp_siswa->getKelas();   
       $params['datadb'] =  $this->coredb->getKelas();
        if( $_POST ){     

               # update data
               $this->load->library('uidcontroll');
               $db_config['where'] = array('id', '1');
               $db_config['table'] = 'ja_kelas';
               $db_config['data']  =  bindProcessing($_POST);
               if( $this->uidcontroll->updateData( $db_config ) !== FALSE ){

                    $this->session->set_flashdata('msg_success', 'Success Update Data');
                    redirect( base_url($this->app_name) );
                    
               }else{$this->messagecontroll->delivered('msg_error', 'Invalid Data to Update !');}    
                
            }else{ $this->messagecontroll->delivered('msg_warning', validation_errors()); }          
       $this->getContent($params);
    }    

    public function kelas_add(){
        $params['datadbkelas'] =  $this->Mapp_siswa->getKelas();   
        $params['kelas'] = $this->coredb->getKelas();
        $params['jurusan'] = $this->coredb->getJurusan();
        $params['guru'] = $this->coredb->getGuru();
        $params['datadb'] = $this->coredb->grapKelas($this->session->userdata('id'));
        $id_kelas = $this->input->post('kelas');
        $validate = 'true';       
        if( $_POST ){
             if( $this->form_validation->run(REG_VALIDATION_KELAS) !== FALSE ){

               # check jurusan available
                if( $this->coredb->checkAvailableKelas($_POST['Nama_Kelas']) == TRUE ){
                    
                    $validate = 'false';
                    $this->messagecontroll->delivered('msg_error', 'Kelas sudah ada dalam database, masukkan Kelas lainnya.');
                    $this->form_validation->run();
                }

             # -------------------------------------------------------------------------------------



            if( $validate == 'true' ){           
            if( $validate !== 'false' ){
                # record database    
                $this->load->library('uidcontroll');
                if( $this->uidcontroll->insertData('ja_kelas', bindProcessing($_POST) ) !== FALSE){
                    
                    $this->session->set_flashdata('msg_success', 'Success Save Data');  
                    redirect( base_url($this->app_name).'/kelas' );
                
                }else{$this->session->set_flashdata('msg_success', 'Invalid Data to Save !');}
              }
            }

            }else{ $this->messagecontroll->delivered('msg_warning', validation_errors()); } 
        }
        $this->getContent($params);  
    } 
    
    public function kelas_edit($id_finger){
        $params['datadbkelas'] =  $this->Mapp_siswa->getKelas();   
        $params['guru'] = $this->coredb->getGuru();
        $params['datadb'] =  $this->coredb->grapKelas($this->initial_id); 
        $validate = 'true';           
        if( $_POST ){
            
            if( $this->form_validation->run( REG_VALIDATION_KELAS ) !== FALSE ){
               
            if( $validate == 'true' ){             
            if( $validate !== 'false' ){                
               # update data
               $this->load->library('uidcontroll');
               $db_config['where'] = array('id_kelas', $this->initial_id);
               $db_config['table'] = 'ja_kelas';
               $db_config['data']  =  bindProcessing($_POST);
               if( $this->uidcontroll->updateData( $db_config ) !== FALSE ){

                    $this->session->set_flashdata('msg_success', 'Success Update Data');
                    redirect( base_url($this->app_name).'/kelas' );
                    
               }else{$this->messagecontroll->delivered('msg_error', 'Invalid Data to Update !');}    
              }
            }                

                
            }else{ $this->messagecontroll->delivered('msg_warning', validation_errors()); }   
        }

        $this->getContent($params);  
    }    

    public function kelas_remove(){


        $this->load->library('uidcontroll');  

        $dataRemove = array('id_kelas', $this->initial_id); 
        if( $this->uidcontroll->removeData('ja_kelas', $dataRemove) == TRUE ){

            $this->session->set_flashdata('total_data', $this->uidcontroll->totalRecord);
            $this->session->set_flashdata('msg_success', 'Success Remove Data');
       }
        redirect(base_url($this->app_name).'/kelas');

    } 
    /* End Kelas Function */

    /* Karyawan Function */
    public function karyawan(){
       $params['datadbkelas'] =  $this->Mapp_siswa->getKelas();   
       $params['datadb'] =  $this->coredb->getKaryawan();         
       $this->getContent($params);
    }    

    public function karyawan_add(){
        $params['datadbkelas'] =  $this->Mapp_siswa->getKelas();   
        $params['kelas'] = $this->coredb->getKelas();
        $params['jurusan'] = $this->coredb->getJurusan();
        $params['guru'] = $this->coredb->getGuru();
        $params['datadb'] = $this->coredb->grapKelas($this->session->userdata('id'));
        $id_kelas = $this->input->post('kelas');
        $validate = 'true';       
        if( $_POST ){
             if( $this->form_validation->run(REG_VALIDATION_KARYAWAN) !== FALSE ){

               # check jurusan available
                if( $this->coredb->checkAvailableKelas($_POST['nup']) == TRUE ){
                    
                    $validate = 'false';
                    $this->messagecontroll->delivered('msg_error', 'NUP sudah ada dalam database, masukkan NUP lainnya.');
                    $this->form_validation->run();
                }

             # -------------------------------------------------------------------------------------



            if( $validate == 'true' ){           
            if( $validate !== 'false' ){
                // Get All Fingerprint device
                $params['device'] = $this->Mapp_websetup->getFp();

                    if( count($params['device']) > 0 ){
                        foreach($params['device'] as $row){    

                  if($row['ip'] != '' && $row['key'] != '') {
                   # processing input to fingerprint
                        $IP=$row['ip'];
                        $Key=$row['key'];
                        $ud=$_POST['pin'];
                        $nama_panggilan = $_POST['nama'];

                        $Connect = @fsockopen($IP, "80", $errno, $errstr, 1);
                          if($Connect){
                            
                          
                            $soap_request="<SetUserInfo><ArgComKey Xsi:type=\"xsd:integer\">".$Key."</ArgComKey><Arg><PIN>".
                            $ud."</PIN><Name>".$nama_panggilan."</Name></Arg></SetUserInfo>";
                            $newLine="\r\n";
                            fputs($Connect, "POST /iWsService HTTP/1.0".$newLine);
                              fputs($Connect, "Content-Type: text/xml".$newLine);
                              fputs($Connect, "Content-Length: ".strlen($soap_request).$newLine.$newLine);
                              fputs($Connect, $soap_request.$newLine);
                            $buffer="";
                            while($Response=fgets($Connect, 1024)){
                              $buffer=$buffer.$Response;
                            }
                          }//else echo "Koneksi Gagal";
                            
                          echo $buffer;
                          $buffer=$this->Parse_Data($buffer,"<Information>","</Information>");

                        }
                        else{
                              echo "<small class='label bg-red'>Data Siswa belum lengkap</small>";
                         }                    
                      }
                    }
                    //=================              
                # record database    
                $this->load->library('uidcontroll');
                if( $this->uidcontroll->insertData('ja_karyawan', bindProcessing($_POST) ) !== FALSE){
                    
                    $this->session->set_flashdata('msg_success', 'Success Save Data');  
                    redirect( base_url($this->app_name).'/karyawan' );
                
                }else{$this->session->set_flashdata('msg_success', 'Invalid Data to Save !');}
              }
            }

            }else{ $this->messagecontroll->delivered('msg_warning', validation_errors()); } 
        }
        $this->getContent($params);  
    } 
    
    public function karyawan_edit($id_finger){
        $params['datadbkelas'] =  $this->Mapp_siswa->getKelas();   
        $params['guru'] = $this->coredb->getGuru();
        $params['datadb'] =  $this->coredb->grapKaryawan($this->initial_id); 
        $validate = 'true';           
        if( $_POST ){
            
            if( $this->form_validation->run( REG_VALIDATION_KARYAWAN ) !== FALSE ){
               
            if( $validate == 'true' ){             
            if( $validate !== 'false' ){     

                // Get All Fingerprint device
                $params['device'] = $this->Mapp_websetup->getFp();

                    if( count($params['device']) > 0 ){
                        foreach($params['device'] as $row){    

                  if($row['ip'] != '' && $row['key'] != '') {
                   # processing input to fingerprint
                        $IP=$row['ip'];
                        $Key=$row['key'];
                        $ud=$_POST['pin'];
                        $nama_panggilan = $_POST['nama'];

                        $Connect = @fsockopen($IP, "80", $errno, $errstr, 1);
                          if($Connect){
                            
                          
                            $soap_request="<SetUserInfo><ArgComKey Xsi:type=\"xsd:integer\">".$Key."</ArgComKey><Arg><PIN>".
                            $ud."</PIN><Name>".$nama_panggilan."</Name></Arg></SetUserInfo>";
                            $newLine="\r\n";
                            fputs($Connect, "POST /iWsService HTTP/1.0".$newLine);
                              fputs($Connect, "Content-Type: text/xml".$newLine);
                              fputs($Connect, "Content-Length: ".strlen($soap_request).$newLine.$newLine);
                              fputs($Connect, $soap_request.$newLine);
                            $buffer="";
                            while($Response=fgets($Connect, 1024)){
                              $buffer=$buffer.$Response;
                            }
                          }//else echo "Koneksi Gagal";
                            
                          echo $buffer;
                          $buffer=$this->Parse_Data($buffer,"<Information>","</Information>");

                        }
                        else{
                              echo "<small class='label bg-red'>Data Siswa belum lengkap</small>";
                         }                    
                      }
                    }
                    //=================
                       
               # update data
               $this->load->library('uidcontroll');
               $db_config['where'] = array('id_karyawan', $this->initial_id);
               $db_config['table'] = 'ja_karyawan';
               $db_config['data']  =  bindProcessing($_POST);
               if( $this->uidcontroll->updateData( $db_config ) !== FALSE ){

                    $this->session->set_flashdata('msg_success', 'Success Update Data');
                    redirect( base_url($this->app_name).'/karyawan' );
                    
               }else{$this->messagecontroll->delivered('msg_error', 'Invalid Data to Update !');}    
              }
            }                

                
            }else{ $this->messagecontroll->delivered('msg_warning', validation_errors()); }   
        }

        $this->getContent($params);  
    }    

    public function karyawan_remove($id_finger){


        $this->load->library('uidcontroll');  

                // Get All Fingerprint device
                $params['device'] = $this->Mapp_websetup->getFp();

                    if( count($params['device']) > 0 ){
                        foreach($params['device'] as $row){    

                  if($row['ip'] != '' && $row['key'] != '') {
                   # processing input to fingerprint
                        $IP=$row['ip'];
                        $Key=$row['key'];
                        $ud=$id_finger;



                      $Connect = @fsockopen($IP, "80", $errno, $errstr, 1);
                        if($Connect){
                          
                          $soap_request="<DeleteUser><ArgComKey Xsi:type=\"xsd:integer\">".$Key."</DeleteUser>
                                      <Arg><PIN xsi:type='xsd:integer'>".$ud."</PIN><Name></Name></Arg></ClearData>";
                          $newLine="\r\n";
                          fputs($Connect, "POST /iWsService HTTP/1.0".$newLine);
                            fputs($Connect, "Content-Type: text/xml".$newLine);
                            fputs($Connect, "Content-Length: ".strlen($soap_request).$newLine.$newLine);
                            fputs($Connect, $soap_request.$newLine);
                          $buffer="";
                          while($Response=fgets($Connect, 1024)){
                            $buffer=$buffer.$Response;
                          }
                        }//else //echo "Koneksi Gagal";
                          //echo $buffer;
                          $buffer=$this->Parse_Data($buffer,"<Information>","</Information>");

                        }
                        else{
                              echo "<small class='label bg-red'>Data Siswa belum lengkap</small>";
                         }                    
                      }
                    }
                    //=================


        $dataRemove = array('id_finger', $this->initial_id); 
        if( $this->uidcontroll->removeData('ja_karyawan', $dataRemove) == TRUE ){

            $this->session->set_flashdata('total_data', $this->uidcontroll->totalRecord);
            $this->session->set_flashdata('msg_success', 'Success Remove Data');
       }
        redirect(base_url($this->app_name).'/karyawan');

    } 
    /* End Karyawan Function */

    /**                  
    * @desc Encryption String for Password Secure
    * @params string
    * @params string
    * @return string encrypt
    */    
    protected function hash_password($password = '', $salt = '') {
    
        $hash = sha1(md5($password).$salt);
    return $hash;
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
?>