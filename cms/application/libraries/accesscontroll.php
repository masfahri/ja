<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @author Raka Anggala W.S
 * @date 02/09/2015
 * @desc Class Login Access Controll
 *       MVC Platform Framework CodeIgniter
 */ 
class Accesscontroll{
  
    # all property preferences
    private $varIns;
    
    
    # all method preferences 
    public function __construct( ){
        $this->varIns =& get_instance(); 
    }
    
    
    /**
    * @desc check data post with data source(database) 
    * @params array
    */ 
    public function loginCheck( $dataPost = array(), $url_reback ){

        try{
          //echo '<pre>'.print_r($dataPost, true).'</pre>'; exit;
           
          $this->varIns->load->model('mapp_login', 'dbsource');
          $sql_query = $this->varIns->dbsource->checkUserRegister(strtolower($dataPost['username']));
          if( count($sql_query) > 0 || $sql_query !== null ){
               
                if( $this->hash_password( strtolower($dataPost['password']), $sql_query['salt'] ) == $sql_query['password'] )
                {    
                    
                    # default image profile
                    if( $sql_query['image'] == "" ){
                        $defaultImage = "<?= base_url() ?>".'assets/img/default/avatars/avatar_01.png';
                    }
                        $defaultImage = $sql_query['image'];
                    
                    //echo $defaultImage; exit;
                    $paramsSession = array(
                    'sys_administrator_logged'   => 'true',
                    'sys_administrator_role_id'  => $sql_query['id_privileges'], 
                    'sys_administrator_id'       => $sql_query['id_administrator'], 
                    'sys_administrator_fullname' => ucfirst($sql_query['nickname']),
                    'sys_administrator_image'    => $defaultImage,   
                    );
                    $this->varIns->session->set_userdata($paramsSession);
                    redirect( $url_reback );
                    
                }else{ 
                    $this->varIns->session->set_flashdata('msg_warning', 'Username and Password did not match');
                    redirect( $_SERVER['HTTP_REFERER'] );
                }
                
           }else{    
                $this->varIns->session->set_flashdata('msg_warning', 'Username and Password did not match');
                redirect( $_SERVER['HTTP_REFERER'] );
           }
           
        }catch(Exception $e){ echo 'Caught exception, params function loginCheck is wrong : ',  $e->getMessage(), "\n";}
    }
    
    
    /**
    * @desc authenticate user access direct url
    * @params array
    */ 
    public function authenticate(){
     
        $this->varIns =& get_instance(); 
        if( ! $this->varIns->session->userdata('sys_administrator_logged') ) redirect('app_login');
    }
    
    
    /**
    * @desc destroy all session and reback url to destination page
    * @params string
    */ 
    static function closeApp( $direct_page ){
   
        if( session_id() !== "" ) session_destroy();
        redirect( $direct_page );
    } 
    
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
    
    /**                  
    * @desc Generate Encrypt user password
    * Use this to generate user login password and save string salt & password encrtypt to database
    * @params array
    */  
    public function generateUser($dataPost = array()){
        
        try{
           $salt = date('ymdhis').session_id();
           echo 'SALT : '.$salt.'<br/>';
           echo 'Username : '.$dataPost['username'].'<br/>';
           echo 'Password : '.$dataPost['password'].' Has been Encrypt as -> '.$this->hash_password( $dataPost['password'], $salt ) .'<br/>';
        }catch(Exception $e){ echo 'Caught exception, params function loginCheck is wrong : ',  $e->getMessage(), "\n";}
    } 
}