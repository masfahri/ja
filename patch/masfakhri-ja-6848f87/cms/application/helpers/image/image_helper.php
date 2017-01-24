<?php
/**
 * @desc Get Thumbanails Image from string directory path
 * @params string
 * @params string
 * @return string
 */
function getThumbnailsImage($path, $extention){
   
	$explPath = explode( '.'.$extention, $path);
	return $explPath[0].'_thumb'.'.'.$extention;
}

function getTotalImageOnAlbums($album_id){
    
    $CI =& get_instance();   
    $CI->db->select('*');
    $CI->db->from('gallery');
    $CI->db->where('gallery_album_id', $album_id);
    $query = $CI->db->get();
    return $query->num_rows();
}

function getAlbumCover($album_id){
    
    $CI =& get_instance();   
    $CI->db->select('file, type');
    $CI->db->from('gallery');
    $CI->db->where('gallery_album_id', $album_id);
    $CI->db->order_by('gallery_id', 'DESC');
    $CI->db->limit(1);
    $query = $CI->db->get();
    if( $query->num_rows() > 0 ){
        
        $datadb = $query->result_array();
        if( $datadb[0]['type'] == 'image' ){
           
            if( file_exists($datadb[0]['file']) ){
                $primaryIcon = '<img style="width:70%" src="'.base_url().$datadb[0]['file'].'"/>';
            }else{
                $primaryIcon = '<img class="img-responsive" src="'.config_item('assets_img').'no_image.png"/>';
            }
            
        }else{
            $primaryIcon = '<img class="img-responsive" src="http://i1.ytimg.com/vi/'.$datadb[0]['file'].'/hqdefault.jpg"/>';
        }
        
        return $primaryIcon;
    }
}

function getDataImageSize($image){
    
    list($width, $height, $type, $attr) = getimagesize($image);
    return 'Original ( '.$width.'x'.$height.' ) px';
}


?>