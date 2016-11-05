<?php

/***********************************************************
@author Raka Anggala W.S
@date 21/06/2014
@desc Configuration form validation field
      This config will use for every form submit
***********************************************************/
$config = array(
           'app_album' => array(
           array(
                    'field' => 'album_name',
                    'label' => 'Album Name',
                    'rules' => 'required|max_length[100]|xss_clean'
                 ),
           array(
                    'field' => 'album_title',
                    'label' => 'Album Title',
                    'rules' => 'required|max_length[100]|xss_clean'
                 ),
           array(
                    'field' => 'album_description',
                    'label' => 'Event Description',
                    'rules' => 'xss_clean'
                 )
            )
        )
?>