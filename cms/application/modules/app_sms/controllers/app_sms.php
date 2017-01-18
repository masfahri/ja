<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class App_sms extends MX_Controller {
    
    # property
    public $root;
    protected  $base_template   = array(
    'container' => '../../layout/container',
    'template_inbox'  => 'tpl_inbox',
    'template_outbox'  => 'tpl_outbox',
    'template_sms_setting'  => 'tpl_sms_setting',
    'template_sms_add'  => 'tpl_sms_add',    
    'template_jurusan'  => 'tpl_jurusan',
    'template_kelas' => 'tpl_kelas',
    'template_hr_libur' => 'tpl_hr_libur',
    'template_kategori_izin' => 'tpl_izin',
    'template_phonebook' => 'tpl_phonebook',          
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
         define("REG_VALIDATION_PHONEBOOK", 'phonebook');
         define("REG_VALIDATION_SMS", 'sms');                                              
    }    

    private function getContent($args = array()){
         
        try{
            if($this->uri->segment(2)=="inbox"){
                $body_data['contents'] = $this->load->view($this->base_template['template_inbox'], $args, TRUE);
            }   
            elseif($this->uri->segment(2)=="outbox"){
                $body_data['contents'] = $this->load->view($this->base_template['template_outbox'], $args, TRUE);
            } 
            elseif($this->uri->segment(2)=="sms_ortu"){
                $body_data['contents'] = $this->load->view($this->base_template['template_sms_add'], $args, TRUE);
            }
            elseif($this->uri->segment(2)=="phonebook" || $this->uri->segment(2)=="phonebook_add" || $this->uri->segment(2)=="phonebook_edit" || $this->uri->segment(2)=="phonebook_group" || $this->uri->segment(2)=="phonebook_group_add"){
                $body_data['contents'] = $this->load->view($this->base_template['template_phonebook'], $args, TRUE);
            }
            elseif($this->uri->segment(2)=="jurusan" || $this->uri->segment(2)=="jurusan_add" || $this->uri->segment(2)=="jurusan_edit"){
                $body_data['contents'] = $this->load->view($this->base_template['template_jurusan'], $args, TRUE);
            }
            elseif($this->uri->segment(2)=="kelas" || $this->uri->segment(2)=="kelas_add" || $this->uri->segment(2)=="kelas_edit"){
                $body_data['contents'] = $this->load->view($this->base_template['template_kelas'], $args, TRUE);
            }  
            elseif($this->uri->segment(2)=="setting"){
                $body_data['contents'] = $this->load->view($this->base_template['template_sms_setting'], $args, TRUE);
            }
            elseif($this->uri->segment(2)=="kategori_izin" || $this->uri->segment(2)=="kategori_izin_add" || $this->uri->segment(2)=="kategori_izin_edit"){
                $body_data['contents'] = $this->load->view($this->base_template['template_kategori_izin'], $args, TRUE);
            }                                                       
            else {
                $body_data['contents'] = $this->load->view($this->base_template['template_inbox'], $args, TRUE);
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

    public function inbox(){
       $params['datadb'] =  $this->coredb->getGuru();
       $params['datadbkelas'] =  $this->Mapp_siswa->getKelas();   
       $this->getContent($params);
    }

    public function outbox(){
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

    public function phonebook(){
       $params['datadbkelas'] =  $this->Mapp_siswa->getKelas();   
       $params['datadb'] =  $this->coredb->getPhonebook(); 
       $this->getContent($params);
    }    


    /* End Kategori izin function */

    /*  Hari libur Function */
    public function hari_libur(){
       $params['datadbkelas'] =  $this->Mapp_siswa->getKelas();   
       $params['datadb'] =  $this->coredb->getHariLibur(); 
       $this->getContent($params);
    }    

    /* get Ortu dari siswa */
    public function getOrtu() {
      $nis = $this->input->post('nis');

      $ortu =  $this->coredb->grapOrtu($nis);


      if($ortu != ''){
        echo '
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Nama Ortu</label>

              <div class="col-sm-10">
                <input type="text" class="form-control" name="nama_ortu" id="nama_ortu" readonly value="'.$ortu['nama_ortu'].'"></input>
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">No HP Ortu</label>

              <div class="col-sm-10">
                <input type="text" class="form-control" name="no_hp" id="no_hp" readonly value="'.$ortu['no_hp'].'"></input>
              </div>
            </div>
        ';
      }
    }

    /* get Ortu dari siswa */
    public function getNoOrtu() {
      $nis = $this->input->post('nama_ortu');
      
      if($nis != '') {
      $ortu =  $this->coredb->grapOrtu2($nis);     
          echo '<div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">No HP Ortu</label>';
                    if(count($ortu) > 0){
                      foreach ($ortu as $key => $value) {
                        $no_hp = $value['no_hp'];
                        echo '
         <input type="hidden" class="form-control" name="kelas" id="kelas" readonly value="'.$value['id_kelas'].'"></input>
                        <div class="col-sm-2" style="padding-right:1px;">
                                <input type="text" class="form-control" name="no_hp" id="no_hp" readonly value="'.$no_hp.'"></input>
                              </div>';
                      }
          echo '</div>';
          }
        }
    }


    /* get Ortu dari siswa */
    public function getSiswa() {
      $nis = $this->input->post('nis');
      
      if($nis != '') {
      $ortu =  $this->coredb->grapSiswaKelas($nis);  
      if($ortu != ''){
          echo '<div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">No HP Ortu</label>';
                    if(count($ortu) > 0){
                      foreach ($ortu as $key => $value) {

                        $nis2 = $value->nis;
                        $ortu2 =  $this->coredb->grapOrtu($nis2); 
                        $nama_siswa = $value->nama_siswa; 
                        $nama_ortu = $ortu2['nama_ortu'];
                        $no_hp = $ortu2['no_hp'];
                        echo '
         <input type="hidden" class="form-control" name="kelas" id="kelas" readonly value="'.$value->id_kelas.'"></input>
                  <input type="hidden" class="form-control" name="nama_ortu" id="nama_ortu" readonly value="'.$nama_ortu.'"></input>
                        <div class="col-sm-2" style="padding-right:1px;">
                                <input type="text" class="form-control" name="no_hp[]" id="no_hp" readonly value="'.$no_hp.'"></input>
                              </div>';
                      }
          echo '</div>

                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Message</label>

                    <div class="col-sm-10">
                      <textarea class="form-control" id="message_group" name="message"></textarea>
                    </div>
                  </div> 

          ';
          }
        }
      }
    }

    /* ajax update */
    public function updateOrtu() {
      $nis = $this->input->post('nama_ortu2');
      $id_kelas = $this->input->post('kelas');
      if($nis != '') {
            # update data
             $this->load->library('uidcontroll');
             $db_config['where'] = array('nama_ortu' => $nis);
             $db_config['table'] = 'ja_ortu';
             $db_config['data']  =  array('group_id' => $id_kelas);
             if( $this->uidcontroll->updateData( $db_config ) !== FALSE ){

                  $this->session->set_flashdata('msg_success', 'Success Update Data');
                  redirect( base_url($this->app_name).'/phonebook_group' );

            }else{$this->messagecontroll->delivered('msg_error', 'Invalid Data to insert !');}
      }
    }


    public function setting(){
        $params['datadbkelas'] =  $this->Mapp_siswa->getKelas();   
        $params['kelas'] =  $this->coredb->getKelas();
        $params['email'] = $this->coredb->grapSettings('email');
        $params['password'] = $this->coredb->grapSettings('password');        
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

    public function sms_ortu(){
        $params['siswaKelas']         =  $this->Mapp_siswa->allSiswaInKelas();
        $params['datadbkelas'] =  $this->Mapp_siswa->getKelas();   
        $params['kelas'] =  $this->coredb->getKelas();
        $params['email'] = $this->coredb->grapSettings('email');
        $params['password'] = $this->coredb->grapSettings('password');        
        $id_kelas = $this->input->post('id_kelas');
        $tipe = $this->input->post('tipe');
        $message = $this->input->post('message');        
        $validate = 'true';       
        if( $_POST ){

             if( $this->form_validation->run(REG_VALIDATION_SMS) !== FALSE ){

                if( $validate == 'true' ){

            if( $validate !== 'false' ){
              if($_POST['tipe'] == 2) {
                  error_reporting(0);

                    $this->load->model('mapp_sms');
                    $email = $this->mapp_sms->grapSettings('email');
                    $password = $this->mapp_sms->grapSettings('password');
                    $device = $this->mapp_sms->grapSettings('device');
                    //extract data from the post
                    //set POST variables
                    $url    = 'http://smsgateway.me/api/v3/messages/send';
                    $fields = array(
                        'email'     => $email[0]->value,
                        'password'  => $password[0]->value,
                        'device'    => $device[0]->value,
                        'number'    => $_POST['no_hp'],
                        'message'   => $_POST['message'],
                        'send_at'   => date()
                    );

                    $fields_string = '';
                    //url-ify the data for the POST
                    foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
                    rtrim($fields_string, '&');

                    //open connection
                    $ch = curl_init();

                    //set the url, number of POST vars, POST data
                    curl_setopt($ch,CURLOPT_URL, $url);
                    curl_setopt($ch,CURLOPT_POST, count($fields));
                    curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    //execute post
                    $result = curl_exec($ch); 
                    $json = json_decode($result);                    
                    //close connection
                    curl_close($ch);

                    //var_dump($_POST);
                    $this->session->set_flashdata('msg_success', 'Sukses mengirimkan sms');
                }else{
                  // disini send by group
                    $arr = $this->input->post('no_hp');
                    foreach ($arr as $num) {
                        error_reporting(0);
                        $this->load->model('mapp_sms');
                        $email = $this->mapp_sms->grapSettings('email');
                        $password = $this->mapp_sms->grapSettings('password');
                        $device = $this->mapp_sms->grapSettings('device');
                        //extract data from the post
                        //set POST variables
                        $url    = 'http://smsgateway.me/api/v3/messages/send';
                        $fields = array(
                            'email'     => $email[0]->value,
                            'password'  => $password[0]->value,
                            'device'    => $device[0]->value,
                            'number'    => $num,
                            'message'   => $_POST['message'],
                            'send_at'   => date()
                        );
                         $fields_string = '';
                        //url-ify the data for the POST
                        foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
                        rtrim($fields_string, '&');

                        //open connection
                        $ch = curl_init();

                        //set the url, number of POST vars, POST data
                        curl_setopt($ch,CURLOPT_URL, $url);
                        curl_setopt($ch,CURLOPT_POST, count($fields));
                        curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        //execute post
                        $result = curl_exec($ch); 
                        $json = json_decode($result);                    
                        //close connection
                        curl_close($ch);

                        //var_dump($_POST);
                        $this->session->set_flashdata('msg_success', 'Sukses mengirimkan sms');                
                    }

               
                }
              }
            }

            }else{ $this->messagecontroll->delivered('msg_warning', validation_errors()); } 
        }
        $this->getContent($params);  
    }

    public function phonebook_group(){
        $params['datadb'] =  $this->coredb->getPhonebookKelas(); 
        $params['siswaKelas']         =  $this->Mapp_siswa->allSiswaInKelas();
        $params['datadbkelas'] =  $this->Mapp_siswa->getKelas();   
        $params['kelas'] =  $this->coredb->getKelas();
        $params['email'] = $this->coredb->grapSettings('email');
        $params['password'] = $this->coredb->grapSettings('password');        
        $id_kelas = $this->input->post('id_kelas');
        $tipe = $this->input->post('tipe');
        $validate = 'true';       
        if( $_POST ){

             if( $this->form_validation->run(REG_VALIDATION_PHONEBOOK) !== FALSE ){

                if( $validate == 'true' ){

            if( $validate !== 'false' ){

              error_reporting(1);

                $this->load->model('mapp_sms');
                $email = $this->mapp_sms->grapSettings('email');
                $password = $this->mapp_sms->grapSettings('password');
                $device = $this->mapp_sms->grapSettings('device');
                //extract data from the post
                //set POST variables
                $url    = 'http://smsgateway.me/api/v3/contacts/create';
                $fields = array(
                    'email'     => $email[0]->value,
                    'password'  => $password[0]->value,
                    'number'    => $_POST['no_hp'],
                    'name'   => $_POST['nama_ortu']
                );

                $fields_string = '';
                //url-ify the data for the POST
                foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
                rtrim($fields_string, '&');

                //open connection
                $ch = curl_init();

                //set the url, number of POST vars, POST data
                curl_setopt($ch,CURLOPT_URL, $url);
                curl_setopt($ch,CURLOPT_POST, count($fields));
                curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                //execute post
                $result = curl_exec($ch); 
                $json = json_decode($result);                    

                //close connection
                curl_close($ch);
              foreach ($json->result as $item) {  

                if($item->created_at != '0') {                              
                    $_POST['nama_ortu'] = $item->name;
                    $_POST['no_hp'] = $item->number;
                    $_POST['nis_siswa'] = $_POST['nis_siswa'];
                    $_POST['keterangan'] = $_POST['keterangan'];
                } 
              }

                $this->load->library('uidcontroll');
                if( $this->uidcontroll->insertData('ja_ortu', bindProcessing($_POST) ) !== FALSE){

                //var_dump($_POST);
                $this->session->set_flashdata('msg_success', 'Sukses menambahkan kontak');

              }else{$this->messagecontroll->delivered('msg_error', 'Invalid Data to insert !');}

              }
            }

            }else{ $this->messagecontroll->delivered('msg_warning', validation_errors()); } 
        }
        $this->getContent($params);  
    }

    public function phonebook_group_add(){
        $params['siswaKelas']         =  $this->Mapp_siswa->allSiswaInKelas();
        $params['ortuKelas']         =  $this->coredb->getPhonebook();        
        $params['datadbkelas'] =  $this->Mapp_siswa->getKelas();   
        $params['kelas'] =  $this->coredb->getKelas();
        $params['email'] = $this->coredb->grapSettings('email');
        $params['password'] = $this->coredb->grapSettings('password');        
        $id_kelas = $this->input->post('group_id');

        $nama_ortu = $this->input->post('nama_ortu');

        $validate = 'true';       
        if( $_POST ){

             if( $this->form_validation->run(REG_VALIDATION_PHONEBOOK) !== FALSE ){

                if( $validate == 'true' ){

            if( $validate !== 'false' ){
               $id_kelas = $this->input->post('group_id');
            $nis = $this->input->post('nama_ortu2');
                  # update data
                   $this->load->library('uidcontroll');
                     $db_config['where'] = array('id', $nama_ortu);
                     $db_config['table'] = 'ja_ortu';
                     $db_config['data']  = array('group_id' => $id_kelas);
    
                     if( $this->uidcontroll->updateData( $db_config ) !== FALSE ){

                          $this->session->set_flashdata('msg_success', 'Success Update Data');
                          redirect( base_url($this->app_name).'/phonebook_group' );

                  }else{$this->messagecontroll->delivered('msg_error', 'Invalid Data to insert !');}
              }
            }

            }else{ $this->messagecontroll->delivered('msg_warning', validation_errors()); } 
        }
        $this->getContent($params);  
    }

    public function phonebook_add(){
        $params['siswaKelas']         =  $this->Mapp_siswa->allSiswaInKelas();
        $params['datadbkelas'] =  $this->Mapp_siswa->getKelas();   
        $params['kelas'] =  $this->coredb->getKelas();
        $params['email'] = $this->coredb->grapSettings('email');
        $params['password'] = $this->coredb->grapSettings('password');        
        $id_kelas = $this->input->post('id_kelas');
        $tipe = $this->input->post('tipe');
        $validate = 'true';       
        if( $_POST ){

             if( $this->form_validation->run(REG_VALIDATION_PHONEBOOK) !== FALSE ){

                if( $validate == 'true' ){

            if( $validate !== 'false' ){

              error_reporting(1);

                $this->load->model('mapp_sms');
                $email = $this->mapp_sms->grapSettings('email');
                $password = $this->mapp_sms->grapSettings('password');
                $device = $this->mapp_sms->grapSettings('device');
                //extract data from the post
                //set POST variables
                $url    = 'http://smsgateway.me/api/v3/contacts/create';
                $fields = array(
                    'email'     => $email[0]->value,
                    'password'  => $password[0]->value,
                    'number'    => $_POST['no_hp'],
                    'name'   => $_POST['nama_ortu']
                );

                $fields_string = '';
                //url-ify the data for the POST
                foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
                rtrim($fields_string, '&');

                //open connection
                $ch = curl_init();

                //set the url, number of POST vars, POST data
                curl_setopt($ch,CURLOPT_URL, $url);
                curl_setopt($ch,CURLOPT_POST, count($fields));
                curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                //execute post
                $result = curl_exec($ch); 
                $json = json_decode($result);                    

                //close connection
                curl_close($ch);
               
                if($json->success == FALSE) {
                   $this->session->set_flashdata('msg_error', $json->errors->number[0].' Please contact the developers.');
                   redirect( base_url($this->app_name).'/phonebook' );
                }else{
                    $this->load->library('uidcontroll');
                    if( $this->uidcontroll->insertData('ja_ortu', bindProcessing($_POST) ) !== FALSE){

                    //var_dump($_POST);
                    $this->session->set_flashdata('msg_success', 'Sukses menambahkan kontak');

                  }else{$this->messagecontroll->delivered('msg_error', 'Invalid Data to insert !');}
               }


              }
            }

            }else{ $this->messagecontroll->delivered('msg_warning', validation_errors()); } 
        }
        $this->getContent($params);  
    }

    public function phonebook_edit($id_finger){
        $params['siswaKelas']         =  $this->Mapp_siswa->allSiswaInKelas();      
        $params['datadbkelas'] =  $this->Mapp_siswa->getKelas();   
        $params['datadb'] = $this->coredb->grapPhonebook($id_finger);
        $validate = 'true';           
        if( $_POST ){
            
            if( $this->form_validation->run( REG_VALIDATION_PHONEBOOK ) !== FALSE ){
               
                if( $validate == 'true' ){
             # -------------------------------------------------------------------------------------
             
            if( $validate !== 'false' ){                
               # update data
               $this->load->library('uidcontroll');
               $db_config['where'] = array('id', $this->initial_id);
               $db_config['table'] = 'ja_ortu';
               $db_config['data']  =  bindProcessing($_POST);
               if( $this->uidcontroll->updateData( $db_config ) !== FALSE ){

                    $this->session->set_flashdata('msg_success', 'Success Update Data');
                    redirect( base_url($this->app_name).'/phonebook' );
                    
               }else{$this->messagecontroll->delivered('msg_error', 'Invalid Data to Update !');}    
              }
            }                

                
            }else{ $this->messagecontroll->delivered('msg_warning', validation_errors()); }   
        }

        $this->getContent($params);  
    }    

    public function phonebook_remove($id_finger){

        $this->load->library('uidcontroll');  
        $dataRemove = array('id', $this->initial_id); 
        if( $this->uidcontroll->removeData('ja_ortu', $dataRemove) == TRUE ){

            $this->session->set_flashdata('total_data', $this->uidcontroll->totalRecord);
            $this->session->set_flashdata('msg_success', 'Success Remove Data');
       }
        redirect(base_url($this->app_name).'/phonebook');

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