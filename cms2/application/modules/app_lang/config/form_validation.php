<?php

/***********************************************************
@author Raka Anggala W.S
@date 21/06/2014
@desc Configuration form validation field
      This config will use for every form submit
***********************************************************/
$config = array(
           'app_lang' => array(
           array(
                    'field' => 'active',
                    'label' => 'Active Language',
                    'rules' => 'xss_clean'
                 ),
            array(
                    'field' => 'countries_name',
                    'label' => 'Countries Name',
                    'rules' => 'required|xss_clean|max_length[100]'
                 ),
            array(
                    'field' => 'countries_idx',
                    'label' => 'Countries IDX',
                    'rules' => 'required|max_length[20]|xss_clean'
                 )
            )
        )
?>