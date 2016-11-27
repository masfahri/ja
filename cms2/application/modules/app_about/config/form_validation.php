<?php

/***********************************************************
@author Raka Anggala W.S
@date 21/06/2014
@desc Configuration form validation field
      This config will use for every form submit
***********************************************************/
$config = array(
          'app_about' => array(
           array(
                    'field' => 'desc',
                    'label' => 'About Description',
                    'rules' => 'required|xss_clean'
                 )  
            ),
          'app_about2' => array(
           array(
                    'field' => 'name',
                    'label' => 'Officers Name',
                    'rules' => 'required|max_length[50]|xss_clean'
                 ),          
           array(
                    'field' => 'jobs',
                    'label' => 'Jobs name',
                    'rules' => 'required|max_length[50]|xss_clean'
                 )        
            ),
          'app_about3' => array(
           array(
                    'field' => 'title',
                    'label' => 'Ads Title',
                    'rules' => 'required|max_length[50]|xss_clean'
                 ),          
           array(
                    'field' => 'url',
                    'label' => 'Ads URL',
                    'rules' => 'required|max_length[50]|xss_clean'
                 )        
            )                      
        )
?>