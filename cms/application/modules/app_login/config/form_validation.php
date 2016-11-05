<?php

/***********************************************************
@author Raka Anggala W.S
@date 21/06/2014
@desc Configuration form validation field
      This config will use for every form submit
***********************************************************/
$config = array(

           'app_login' => array(
            array(
                    'field' => 'username',
                    'label' => 'Username',
                    'rules' => 'max_length[50]|trim|required|xss_clean'
                 ),
            array(
                    'field' => 'password',
                    'label' => 'Password',
                    'rules' => 'min_length[6]|max_length[12]|trim|required|xss_clean'
                 )
            )
          )
?>