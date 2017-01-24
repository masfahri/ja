<?php

/***********************************************************
@author Raka Anggala W.S
@date 21/06/2014
@desc Configuration form validation field
      This config will use for every form submit
***********************************************************/
$config = array(
          'app_gallery' => array(
           array(
                    'field' => 'type',
                    'label' => 'Gallery type',
                    'rules' => 'required|xss_clean'
                 ),
           array(
                    'field' => 'gallery_album_id',
                    'label' => 'Albums',
                    'rules' => 'required|xss_clean'
                 )
            ),
          'app_galleryAlbum' => array(
            array(
                    'field' => 'album_name',
                    'label' => 'Albums Name',
                    'rules' => 'required|max_length[50]|xss_clean'
                 ),
            array(
                    'field' => 'album_title',
                    'label' => 'Albums Place',
                    'rules' => 'required|xss_clean'
                 ),
            array(
                    'field' => 'album_description',
                    'label' => 'Albums Description',
                    'rules' => 'required|xss_clean'
                 ),
            array(
                    'field' => 'date',
                    'label' => 'Albums Date',
                    'rules' => 'required|xss_clean'
                 ),            
            ),
          'app_galleryBanner' => array(
                    'field' => 'file',
                    'label' => 'page banners',
                    'rules' => 'trim|xss_clean'
            )          
        )
?>