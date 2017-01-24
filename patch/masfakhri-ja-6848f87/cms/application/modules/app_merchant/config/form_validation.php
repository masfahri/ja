<?php

/***********************************************************
@author Raka Anggala W.S
@date 21/06/2014
@desc Configuration form validation field
      This config will use for every form submit
***********************************************************/
$config = array(
          'app_merchant' => array(
           array(
                    'field' => 'merchant_name',
                    'label' => 'Merchant name',
                    'rules' => 'required|max_length[50]|xss_clean'
                 ),          
           array(
                    'field' => 'merchant_place',
                    'label' => 'Merchant place',
                    'rules' => 'required|max_length[50]|xss_clean'
                 ),
           array(
                    'field' => 'file',
                    'label' => 'Merchant Image',
                    'rules' => 'xss_clean'
                 )  

            )
        )
?>