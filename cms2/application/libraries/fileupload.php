<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @author Raka Anggala W.S
 * @date 02/09/2015
 * @desc Class Upload File
 *       MVC Platform Framework CodeIgniter
 */ 
 
class Fileupload{
    
    
    # all property
    private $varIns;
    public $path_directory = '';
    public $msgError       = '';
    public $fileExt        = '';
    public $percentResize =  50; //use as default 50%
    public $resultFile     = array();
    private $dataConfig    = array();
    private $saveDir       = array(
    'image'     => 'uploads/image/',
    'worksheet' => 'uploads/worksheet/',
    'audio'     => 'uploads/audio/',
    'video'     => 'uploads/video/',
    'pdf'       => 'uploads/pdf/',
    );
    
  
    # all method preferences
    public function __construct(){
        
        // set variable ci instance
         $this->varIns =& get_instance(); 
    }
    
    
    public function init($file){
      
        if( $file['size'] > 0 ){
          
       	    $this->fileExt =  pathinfo($file['name'], PATHINFO_EXTENSION);   
           
            $this->dataConfig = array(
            'fileTmp'    => $file['tmp_name'],
            'fileName'   => $file['name'], 
            'fileSize'   => $file['size'], 
            'fileType'   => $file['type'], 
            );
            $this->run();          
             
        }else{
           $this->msgError = 'File upload cannot be empty!'; 
           return FALSE;
        }
    } 
    
    public function run(){

        # processing file image
        if (($this->dataConfig['fileType'] == "image/gif")
        || ($this->dataConfig['fileType'] == "image/jpeg")
        || ($this->dataConfig['fileType'] == "image/jpg")
        || ($this->dataConfig['fileType'] == "image/pjpeg")
        || ($this->dataConfig['fileType'] == "image/png")
        || ($this->dataConfig['fileType'] == "image/x-png")
        || ($this->dataConfig['fileType'] == "image/x-icon")
        || ($this->dataConfig['fileType'] == "image/ico"))
        {   
            $this->uploadImage($this->fileExt);    
        }
        
        # processing file pdf 
        if( $this->dataConfig['fileType'] == 'application/pdf' ){
            $this->uploadPdf($this->fileExt); 
        }
        
        # processing file video 
        // code here    
        
        # processing file audio 
        // code here  
    }
    
     
    # all method
    public function uploadImage($extension){
         
        $max_file_size_in_bytes = 2147483647;  // Validate the file size ( Warning the largest files supported by this code is 2GB )
       
        if( $this->dataConfig['fileSize'] > $max_file_size_in_bytes ){ 
            
            $this->msgError = 'File upload maximum in size 2GB!'; 
            return FALSE;
      
        }else{
            
            $allowedExts  =  array('png', 'jpg', 'jpeg', 'gif', 'ico', 'PNG', 'JPG', 'JPEG', 'GIF', 'ICO'); 
            if(in_array($extension, $allowedExts))
            {   
                # rename file
                $expl           = explode('.', $this->dataConfig['fileName']);
                $new_name       = $expl[0].'_'.date('ymdhis').'.'.$extension;
                if( $this->path_directory !== "" ){
                    $dir = $this->path_directory.'/'.$new_name;
                }else{
                    $dir =  $this->saveDir['image'].$new_name;
                }
                
                $this->path_directory =  $dir;
                if(move_uploaded_file($this->dataConfig['fileTmp'], $dir))
                {
                    // auto resize image and create new image thumbnails
                    list($width, $height, $type, $attr) = getimagesize($dir);
                    $percent_resizing = $this->percentResize;
                    $new_width  = round((($percent_resizing/100)*$width));
                    $new_height = round((($percent_resizing/100)*$height));
                    $config['image_library']  = 'gd2';
                    $config['source_image']   = $dir;
                    $config['create_thumb']   = TRUE;
                    $config['maintain_ratio'] = TRUE;
                    $config['width']          = $new_width;
                    $config['height']         = $new_height;
                  
                    $this->varIns->load->library('image_lib');
                    $this->varIns->image_lib->initialize($config);
                    if ( ! $this->varIns->image_lib->resize() ){  $this->msgError = 'File filed resize!'; return FALSE; }
                    else{ return TRUE; }
                     
                }else{
                    $this->msgError = 'File filed to move!';
                    return FALSE;
                }
                 
            }else{
                $this->msgError = 'File Extention not supported!';
                return FALSE;
            }   
        }     
    }
    
    public function uploadPdf($extension){
        
        $allowedExts  =  array('pdf'); 
        if(in_array($extension, $allowedExts))
        {   
            # rename file
            $expl           = explode('.', $this->dataConfig['fileName']);
            $new_name       = $expl[0].'_'.date('ymdhis').'.'.$extension;
            if( $this->path_directory !== "" ){
                $dir = $this->path_directory.'/'.$new_name;
            }else{
                $dir =  $this->saveDir['pdf'].$new_name;
            }
          
            $this->path_directory =  $dir;
            if(move_uploaded_file($this->dataConfig['fileTmp'], $dir)){
                return TRUE; 
            }else{
                $this->msgError = 'File filed to move!';
                return FALSE;
            }
             
        }else{
            $this->msgError = 'File Extention not supported!';
            return FALSE;
        } 
    }
}