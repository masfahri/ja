<?php

/***********************************************************
@author Raka Anggala W.S
@date 21/06/2014
@desc Configuration form validation field
      This config will use for every form submit
***********************************************************/
$config = array(
           'in_out' => array(
           array(
                    'field' => 'hari',
                    'label' => 'Hari',
                    'rules' => 'required|trim|xss_clean'
                 ),            
            array(
                    'field' => 'jam_masuk',
                    'label' => 'Jam Masuk',
                    'rules' => 'trim|xss_clean'
                 ),
            array(
                    'field' => 'jam_pulang',
                    'label' => 'Jam Pulang',
                    'rules' => 'trim|xss_clean'
                 ),
            array(
                    'field' => 'status',
                    'label' => 'Status',
                    'rules' => 'trim|xss_clean'
                 )                                                     
            ),
          'fp' => array(
           array(
                    'field' => 'ip',
                    'label' => 'IP Mesin',
                    'rules' => 'required|max_length[50]|xss_clean'
                 ),          
           array(
                    'field' => 'key',
                    'label' => 'Key',
                    'rules' => 'required|max_length[50]|xss_clean'
                 )  

            )           
          )
?>