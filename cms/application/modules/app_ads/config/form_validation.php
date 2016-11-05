<?php

/***********************************************************
@author Raka Anggala W.S
@date 21/06/2014
@desc Configuration form validation field
      This config will use for every form submit
***********************************************************/
$config = array(
          'app_ads' => array(
           array(
                    'field' => 'title',
                    'label' => 'Ads Title',
                    'rules' => 'required|max_length[50]|xss_clean'
                 ),          
           array(
                    'field' => 'url',
                    'label' => 'Ads URL',
                    'rules' => 'required|max_length[50]|xss_clean'
                 ),
           array(
                    'field' => 'file',
                    'label' => 'Ads Image',
                    'rules' => 'xss_clean'
                 )  

            )
        )
?>