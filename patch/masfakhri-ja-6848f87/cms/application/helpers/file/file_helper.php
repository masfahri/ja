<?php

/**
 * @desc 
 * @params array
 * @params string
 * @return array - data post
 */
function uploadFile($dataParsing = array()){
    
    $CI =& get_instance();
    $CI->load->library('fileupload');
    if( isset( $dataParsing['directory'] ) && $dataParsing['directory'] !== "" ){
         $CI->fileupload->path_directory = $dataParsing['directory'];
    }
    
    list($width, $height, $type, $attr) = getimagesize($dataParsing['files']['tmp_name']);
    if( $CI->fileupload->init($dataParsing['files']) !== FALSE ){
        
        if($dataParsing['resize'] == true){
            
            /** 
            *  auto resize image
            *  use this if size image more than limit var
            */
            if( $dataParsing['size'] !== "" ){
                if( $width > $dataParsing['size']['width'] && $height > $dataParsing['size']['height'] ){
                    $CI->load->library('resizeimage', $CI->fileupload->path_directory);
                    $CI->resizeimage->resizeTo($dataParsing['size']['width'], $dataParsing['size']['height'], 'exact');
                    $CI->resizeimage->saveImage($CI->fileupload->path_directory);
                }   
            }
        }
        
        if( isset($dataParsing['post']) ){
            $_POST[$dataParsing['post']] = $CI->fileupload->path_directory;
        }else{
            $_POST['file']      = $CI->fileupload->path_directory;
            $_POST['extention'] = $CI->fileupload->fileExt;
        }
       
    }
}


function uploadFilePdf($dataParsing){
    
    $CI =& get_instance();
    $CI->load->library('fileupload');
    if( isset( $dataParsing['directory'] ) && $dataParsing['directory'] !== "" ){
         $CI->fileupload->path_directory = $dataParsing['directory'];
    }
    
    if( $CI->fileupload->init($dataParsing['files']) !== FALSE ){

        $_POST['file']      = $CI->fileupload->path_directory;
        $_POST['extention'] = $CI->fileupload->fileExt;
    }
}
  
?>