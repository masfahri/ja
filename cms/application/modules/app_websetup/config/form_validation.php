<?php

/***********************************************************
@author Raka Anggala W.S
@date 21/06/2014
@desc Configuration form validation field
      This config will use for every form submit
***********************************************************/
$config = array(
           'app_websetup' => array(
           array(
                    'field' => 'file_img',
                    'label' => 'Site Logo',
                    'rules' => 'required|trim|xss_clean'
                 ),
            array(
                    'field' => 'google_analytics',
                    'label' => 'Google Analyrics',
                    'rules' => 'trim|xss_clean'
                 ),             
            )
          )
?>