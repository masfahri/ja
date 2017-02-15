<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class App_membership extends MX_Controller {
    
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
    'template'  => 'tpl' 
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
         define("REG_VALIDATION2", strtolower( __CLASS__ ).'T');
         define("REG_VALIDATION3", strtolower( __CLASS__ ).'P');
         define("REG_VALIDATION4", strtolower( __CLASS__ ).'C');
         define("REG_VALIDATION5", strtolower( __CLASS__ ).'D');         
    }
        
    private function getContent($args = array()){
         
        try{
            $body_data['contents'] = $this->load->view($this->base_template['template'], $args, TRUE);
            $this->load->view($this->base_template['container'], $body_data);
        }catch(Exception $e) {
            echo 'Caught exception, params function getContent is wrong : ',  $e->getMessage(), "\n";
        }      
    }
    

    public function terms(){
        
        $params['datadb'] =  $this->coredb->bindDataSetup(1);
        $params['datadb2'] = $this->coredb->bindDataSetup(1);
        if( $_POST ){
            
             if( $this->form_validation->run(REG_VALIDATION2) !== FALSE ){
               
               # record database    
               $this->load->library('uidcontroll');
               $db_update['where'] = array('id_membership',1);
               $db_update['table'] = 'page_membership';
               $db_update['data']  =  bindProcessing($_POST);
               
               if( $this->uidcontroll->updateData($db_update) !== FALSE){
                
                    $this->session->set_flashdata('msg_success', 'Success Update Data');
                    redirect($this->root);
               }else{$this->messagecontroll->delivered('msg_error', 'Invalid Data to Update !');}
                
            }else{$this->messagecontroll->delivered('msg_warning', validation_errors()); } 
        }
        
        $this->getContent($params);
    }

    public function index()
      {

        $params['datadb'] =  $this->coredb->bindDataSetupp(1); 
        $params['datadb2'] = $this->coredb->bindDataSetup(1);
        $params['datadb3'] = $this->coredb->bindDataMember(); 
        $params['desc'] = $this->coredb->getDesc(1);        

        if( $_POST ){            

             if( $this->form_validation->run(REG_VALIDATION) !== FALSE ){
               # record database    
               $this->load->library('uidcontroll');
               $db_update['where'] = array('get_id',1);
               $db_update['table'] = 'membership_get';
               $db_update['data']  =  bindProcessing($_POST);
               
               if( $this->uidcontroll->updateData($db_update) !== FALSE){
                
                    $this->session->set_flashdata('msg_success', 'Success Update Data');
                    redirect($this->root);
               }else{$this->messagecontroll->delivered('msg_error', 'Invalid Data to Update !');}
                
            }else{$this->messagecontroll->delivered('msg_warning', validation_errors()); }
          }

        $this->getContent($params);           

      }

      public function url()
      {
        $params['desc'] = $this->coredb->getDesc(1);        

        if( $_POST ){            

               # record database    
               $this->load->library('uidcontroll');
               $db_update['where'] = array('get_id',1);
               $db_update['table'] = 'membership_get';
               $db_update['data']  =  bindProcessing($_POST);
               
               if( $this->uidcontroll->updateData($db_update) !== FALSE){
                
                    $this->session->set_flashdata('msg_success', 'Success Update Data');
                    redirect(base_url('app_membership'));
               }else{$this->messagecontroll->delivered('msg_error', 'Invalid Data to Update !');}
                
          }

        $this->getContent($params);   

      }

    public function dataCar()
      {
        $params['datad2b'] =  $this->coredb->bindDataSetup(1);
        $params['datadb4'] =  $this->coredb->bindDataCar($this->uri->segment(3));        
        // var_dump($params['datadb4']);
        $this->getContent($params);
      }

public function addmember(){
        
         $params['datadb'] =  $this->coredb->bindDataSetuppp(1);
        if( $_POST ){

             if( $this->form_validation->run(REG_VALIDATION3) !== FALSE ){
               
                $this->load->library('uidcontroll');
                $member['first_name'] = $_POST['first_name'];
                $member['last_name'] = $_POST['last_name'];
                $member['no_member'] = $_POST['no_member'];
                $member['address'] = $_POST['address']; 
                $member['province'] = $_POST['province'];
                $member['zipcode'] = $_POST['zipcode'];
                $member['ktp'] = $_POST['ktp'];
                $member['sim'] = $_POST['sim'];
                $member['phone'] = $_POST['phone'];
                $member['home_phone'] = $_POST['home_phone'];
                $member['office'] = $_POST['office'];
                $member['email'] = $_POST['email'];
                $member['blood_type'] = $_POST['blood_type'];
                $member['tsize'] = $_POST['tsize'];
                $member['reg_date'] = $_POST['reg_date'];
                $member['status'] = $_POST['status'];
                $member['model2'] = $_POST['model2'];
                $member['chapter'] = $_POST['chapter'];
                $member['mem2'] = $_POST['mem2'];

                $this->uidcontroll->insertData('membership', $member);
                      $maxField = 3;

              $id_membership = $this->uidcontroll->last_id;
            for($i = 0; $i < $maxField; $i++){
                $membercar['id_membership'] = $id_membership;
                $membercar['seri_mc'] = $_POST['seri_mc'.$i];
                $membercar['year'] = $_POST['year'.$i];
                $membercar['license_plate'] = $_POST['license_plate'.$i];
                $membercar['chasis_no'] = $_POST['chasis_no'.$i];
                $membercar['engine_no'] = $_POST['engine_no'.$i];

                          
                $this->uidcontroll->insertData('membership_car', $membercar);
}

                    $this->session->set_flashdata('msg_success', 'Success Save Data'); 
                    redirect(base_url('app_membership'));
                  }else{$this->messagecontroll->delivered('msg_warning', validation_errors()); } 
        }
        $this->getContent($params);
    }

    public function memberedit()
    {  
      $params['tests'] = $this->coredb->getCar($this->uri->segment(3));
       if( $_POST ){       
                      $this->load->library('uidcontroll');      
                      $maxField = 3;
              $id_membership = $this->uidcontroll->last_id;
            for($i = 0; $i < $maxField; $i++){
                $membercar['seri_mc'] = $_POST['seri_mc'.$i];
                $membercar['year'] = $_POST['year'.$i];
                $membercar['license_plate'] = $_POST['license_plate'.$i];
                $membercar['chasis_no'] = $_POST['chasis_no'.$i];
                $membercar['engine_no'] = $_POST['engine_no'.$i];
             }                                        

               $db_update['where'] = array('id_membership', $this->uri->segment(3));
               $db_update['table'] = 'membership_car';
               $db_update['data']  =  bindProcessing($membercar);

               # record database    
                $member['first_name'] = $_POST['first_name'];
                $member['last_name'] = $_POST['last_name'];
                $member['no_member'] = $_POST['no_member'];
                $member['address'] = $_POST['address']; 
                $member['province'] = $_POST['province'];
                $member['zipcode'] = $_POST['zipcode'];
                $member['ktp'] = $_POST['ktp'];
                $member['sim'] = $_POST['sim'];
                $member['phone'] = $_POST['phone'];
                $member['home_phone'] = $_POST['home_phone'];
                $member['office'] = $_POST['office'];
                $member['email'] = $_POST['email'];
                $member['blood_type'] = $_POST['blood_type'];
                $member['tsize'] = $_POST['tsize'];
                $member['reg_date'] = $_POST['reg_date'];
                $member['status'] = $_POST['status'];
                $member['model2'] = $_POST['model2'];
                $member['chapter'] = $_POST['chapter'];
                $member['mem2'] = $_POST['mem2'];

               $db_update2['where'] = array('id_membership', $this->uri->segment(3));
               $db_update2['table'] = 'membership';
               $db_update2['data']  =  bindProcessing($member);
               
               if( $this->uidcontroll->updateData($db_update2) && $this->uidcontroll->updateData($db_update)  !== FALSE){
                
                    $this->session->set_flashdata('msg_success', 'Success Update Data');
                    redirect(base_url('app_membership'));
               }else{$this->messagecontroll->delivered('msg_error', 'Invalid Data to Update !');}
        }
        $params['datadb'] =  $this->coredb->getProductCategoryById($this->uri->segment(3));
        $params['datadb2'] =  $this->coredb->getProductCategoryyById($this->uri->segment(3));
        //var_dump($params['datadb2']);
        $this->getContent($params);  
    }
        
          

}
?>