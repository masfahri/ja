<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class App_about extends MX_Controller {
    
    # property
    public $root;
    public $app_name            = ''; 
    public $pageTitle           = ''; 
    public $initialPage         = 'About';
    # initial file image
    public $imgDir              = 'uploads/image/about';
    public $initial_id;  
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
         define("REG_VALIDATION2", strtolower( __CLASS__ ).'2');
         define("REG_VALIDATION3", strtolower( __CLASS__ ).'3');
    }
        
    private function getContent($args = array()){
         
        try{
            $body_data['contents'] = $this->load->view($this->base_template['template'], $args, TRUE);
            $this->load->view($this->base_template['container'], $body_data);
        }catch(Exception $e) {
            echo 'Caught exception, params function getContent is wrong : ',  $e->getMessage(), "\n";
        }      
    }
    
    public function index(){
        $params['datadb'] =  $this->coredb->bindDataSetup(3);
        $params['datadb2'] =  $this->coredb->getOfficers();
        $params['datadb3'] =  $this->coredb->sponsors(); 
        $msg = '';
        if( $_POST ){
            
            
             if( $this->form_validation->run(REG_VALIDATION) !== FALSE ){
               
               # update data
               $this->load->library('uidcontroll');
               $db_config['where'] = array('about_id', 3);
               $db_config['table'] = 'page_about';
               $db_config['data']  =  bindProcessing($_POST);
               if( $this->uidcontroll->updateData( $db_config ) !== FALSE ){

                    $this->session->set_flashdata('msg_success', 'Success Update Data');
                    redirect( base_url($this->app_name) );
                    
               }else{$this->messagecontroll->delivered('msg_error', 'Invalid Data to Update !');}   
                

            }else{ $this->messagecontroll->delivered('msg_warning', validation_errors()); } 
        }
        $this->getContent($params);  
    }

    public function officersAdd(){  
        $params['datadb'] =  $this->coredb->getOfficers($this->session->userdata('id')); 
        if( $_POST ){
             
            
             if( $this->form_validation->run(REG_VALIDATION2) !== FALSE ){

               # processing file upload
               if( $_FILES['file']['name'] !== "" )
               {
                   $this->load->library('fileupload');
                   $this->fileupload->path_directory = $this->imgDir;
                   if( $this->fileupload->init($_FILES['file']) !== FALSE ){
                        $_POST['file']     = $this->fileupload->path_directory;
                        $_POST['extention'] = $this->fileupload->fileExt;
                   }
               }
             # -------------------------------------------------------------------------------------            
                # record database    
                $this->load->library('uidcontroll');
                if( $this->uidcontroll->insertData('officer', bindProcessing($_POST) ) !== FALSE){
                    
                    $this->session->set_flashdata('msg_success', 'Success Save Data');  
                    redirect( base_url($this->app_name) );
                
                }else{$this->session->set_flashdata('msg_success', 'Invalid Data to Save !');}
                

            }else{ $this->messagecontroll->delivered('msg_warning', validation_errors()); } 
        }
        $this->getContent($params);   
    }

    public function officersEdit(){
        $params['datadb'] =  $this->coredb->getOfficers($this->initial_id);        
        if( $_POST ){
            
            # ( * checking file image Event for home must be upload )
            $_POST['file'] = 'true';       

            if( $this->form_validation->run( REG_VALIDATION2 ) !== FALSE ){
               
               # processing file upload
               if( $_FILES['file']['name'] !== "" )
               {
                   $this->load->library('fileupload');
                   $this->fileupload->path_directory = $this->imgDir;
                   if( $this->fileupload->init($_FILES['file']) !== FALSE ){
                        $_POST['file']     = $this->fileupload->path_directory;
                        $_POST['extention'] = $this->fileupload->fileExt;
                   }
               }
             # -------------------------------------------------------------------------------------
             
               # update data
               $this->load->library('uidcontroll');
               $db_config['where'] = array('id', $this->initial_id);
               $db_config['table'] = 'officer';
               $db_config['data']  =  bindProcessing($_POST);
               if( $this->uidcontroll->updateData( $db_config ) !== FALSE ){

                    $this->session->set_flashdata('msg_success', 'Success Update Data');
                    redirect( base_url($this->app_name) );
                    
               }else{$this->messagecontroll->delivered('msg_error', 'Invalid Data to Update !');}    
                
            }else{ $this->messagecontroll->delivered('msg_warning', validation_errors()); }   
        }
        
        $this->getContent($params);  
    }    

    public function sponsors()
    {
        $params['datadb3'] =  $this->coredb->bindDataPageSponsor(); 
        $this->getContent($params);  
    } 

    public function sponsorsAdd()
    {
        $params['datadb3'] =  $this->coredb->getSponsors($this->session->userdata('id_sponsors')); 
        //var_dump($params['datadb3']);
        if( $_POST ){
          
            
               # processing file upload
               if( $_FILES['file']['name'] !== "" )
               {
                   $this->load->library('fileupload');
                   $this->fileupload->path_directory = $this->imgDir;
                   if( $this->fileupload->init($_FILES['file']) !== FALSE ){
                        $_POST['file']     = $this->fileupload->path_directory;
                        $_POST['ext']      = $this->fileupload->fileExt;
                   }
               }
             # -------------------------------------------------------------------------------------

                # record database    
                $this->load->library('uidcontroll');
                if( $this->uidcontroll->insertData('sponsors', bindProcessing($_POST) ) !== FALSE){
                    
                    $this->session->set_flashdata('msg_success', 'Success Save Data');  
                    redirect( base_url($this->app_name) );
                
                }else{$this->session->set_flashdata('msg_success', 'Invalid Data to Save !');}
        }
        $this->getContent($params);  
    } 


    public function sponsorsEdit(){
        $params['datadb'] =  $this->coredb->getSponsorsbyId($this->initial_id);  
        //var_dump($params['datadb']);      
        if( $_POST ){
            
               # processing file upload
               if( $_FILES['file']['name'] !== "" )
               {
                   $this->load->library('fileupload');
                   $this->fileupload->path_directory = $this->imgDir;
                   if( $this->fileupload->init($_FILES['file']) !== FALSE ){
                        $_POST['file']     = $this->fileupload->path_directory;
                        $_POST['ext'] = $this->fileupload->fileExt;
                   }
               }
             # -------------------------------------------------------------------------------------
             
                
               # update data
               $this->load->library('uidcontroll');
               $db_config['where'] = array('id_sponsors', $this->uri->segment(3));
               $db_config['table'] = 'sponsors';
               $db_config['data']  =  bindProcessing($_POST);
               if( $this->uidcontroll->updateData( $db_config ) !== FALSE ){

                    $this->session->set_flashdata('msg_success', 'Success Update Data');
                    redirect( base_url($this->app_name).'/sponsors' );
                    
               }else{$this->messagecontroll->delivered('msg_error', 'Invalid Data to Update !');}    
                
        }

        $this->getContent($params);
    }    


}
        

?>