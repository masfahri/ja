<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @author Raka Anggala W.S
 * @date 02/09/2015
 * @desc Class Message Controll
 *       MVC Platform Framework CodeIgniter
 */ 
class Messagecontroll{
  
   private $outputMsg = '';
   private $varIns;
   public $addMsg = '';
  
   public function __construct(){
        
        $this->varIns =& get_instance();
        $this->init();
   }  
   
   public function init(){
        
        if( $this->varIns->session->flashdata('msg_warning') ){
            
            $this->delivered('msg_warning', $this->varIns->session->flashdata('msg_warning'));
        }
        if( $this->varIns->session->flashdata('msg_error') ){
          
            $this->delivered('msg_error', $this->varIns->session->flashdata('msg_error'));
        }
        if( $this->varIns->session->flashdata('msg_success') ){
      
              $this->delivered('msg_success', $this->varIns->session->flashdata('msg_success'));
        }
   }
   
   public function delivered($title, $output_message){
  
        switch($title){
            
            case 'msg_info':
                $css = 'alert-info';               
            break;
            case 'msg_error':
                $css = 'alert-danger';
            break;
            case 'msg_warning':
                $css = 'alert-warning';
            break;
            case 'msg_success':
                $css = 'alert-success';
            break;  
        }
        
        $msg = '';
        if(is_array($output_message)){
            
            foreach($output_message as $row){
                $msg .= '<p>'.$row.'</p>';
            }
        }else{ 
            $msg .= '<p>'.$output_message.'</p>'; 
            if( $this->varIns->session->flashdata('total_data') ){
                 $msg .= '<hr/><p><i> Total master data in rows  : '.$this->varIns->session->flashdata('total_data').' Data</i></p>'; 
            }
        }
        // session flashdata addtional message
        if( $this->addMsg !== "" ){
            $msg .= '<p>'.$this->addMsg.'</p>';
        }
        
        if( $output_message !== "" ){
            $output = '
              <div class="alert '.$css.' alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                '.$msg.'
              </div>';
            $this->outputMsg = $output;
        }
   }
   
   public function showMessage(){
    
        if( $this->outputMsg !== ""){
            return $this->outputMsg;
        }
   }
}