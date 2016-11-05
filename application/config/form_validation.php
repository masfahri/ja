<?php

/***********************************************************
@author Raka Anggala W.S
@date 21/06/2014
@desc Configuration form validation field
      This config will use for every form submit
***********************************************************/
$config = array(
          'login' => array(
            array(
                    'field' => 'email',
                    'label' => 'Email',
                    'rules' => 'trim|required|valid_emails|xss_clean'
                 ),
            array(
                    'field' => 'password',
                    'label' => 'Password',
                    'rules' => 'trim|max_length[20]|required|xss_clean'
                 )
            ),
            'register' => array(
            array(
                    'field' => 'nickname',
                    'label' => 'Nickname',
                    'rules' => 'trim|required|max_length[50]|xss_clean'
                 ),
            array(
                    'field' => 'email',
                    'label' => 'Email',
                    'rules' => 'trim|required|valid_emails|xss_clean'
                 ),
            array(
                    'field' => 'password',
                    'label' => 'Password',
                    'rules' => 'trim|max_length[20]|required|xss_clean'
                 ),
            array(
                    'field' => 'repassword',
                    'label' => 'Retype Password',
                    'rules' => 'trim|max_length[20]|matches[password]|required|xss_clean'
                 ),
            ),
           'contact' => array(
            array(
                    'field' => 'name',
                    'label' => 'Name',
                    'rules' => 'trim|required|xss_clean'
                 ),
            array(
                    'field' => 'email',
                    'label' => 'Email',
                    'rules' => 'trim|required|valid_emails|xss_clean'
                 ),
            array(
                    'field' => 'subject',
                    'label' => 'Phone',
                    'rules' => 'trim|required|xss_clean'
                 ),
            array(
                    'field' => 'message',
                    'label' => 'Message',
                    'rules' => 'trim|required|xss_clean'
                 ),
            ),
            'subscribe' => array(
            array(
                    'field' => 'u_subscribe_email',
                    'label' => 'Email Address',
                    'rules' => 'trim|valid_emails|required|xss_clean'
                 )
            ),
          )
?>