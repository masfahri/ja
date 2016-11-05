<?php

/***********************************************************
@author Raka Anggala W.S
@date 21/06/2014
@desc Configuration form validation field
      This config will use for every form submit
***********************************************************/
$config = array(

           'app_myaccount_profile' => array(
            array(
                    'field' => 'nickname',
                    'label' => 'Nickname',
                    'rules' => 'max_length[15]|trim|required|xss_clean'
                 ),
            array(
                    'field' => 'username',
                    'label' => 'Email Address',
                    'rules' => 'max_length[50]|trim|valid_emails|required|xss_clean'
                 ),
            array(
                    'field' => 'password',
                    'label' => 'Password',
                    'rules' => 'min_length[6]|max_length[20]|matches[repassword]|trim|required|xss_clean'
                 ),
            array(
                    'field' => 'repassword',
                    'label' => 'Confirm Password',
                    'rules' => 'min_length[6]|max_length[20]|trim|matches[password]|xss_clean'
                 )
            ),
          
          'app_myaccount_store' => array(
            array(
                    'field' => 'u_store_name',
                    'label' => 'Store Name',
                    'rules' => 'max_length[200]|trim|required|xss_clean'
                 ),
            array(
                    'field' => 'u_store_country',
                    'label' => 'Country',
                    'rules' => 'trim|required|xss_clean'
                 ),
            array(
                    'field' => 'u_store_city',
                    'label' => 'City',
                    'rules' => 'max_length[100]|trim|required|xss_clean'
                 ),
            array(
                    'field' => 'u_store_address',
                    'label' => 'Store Address',
                    'rules' => 'trim|required|xss_clean'
                 ),
            array(
                    'field' => 'u_store_phone',
                    'label' => 'Store Phone',
                    'rules' => 'trim|required|numeric|xss_clean'
                 ),
            array(
                    'field' => 'facebook_url',
                    'label' => 'Facebook Url',
                    'rules' => 'trim|max_length[255]|required|xss_clean'
                 ),
            array(
                    'field' => 'instagram_url',
                    'label' => 'Instagram Url',
                    'rules' => 'trim|max_length[255]|xss_clean'
                 ),
            array(
                    'field' => 'Store Description',
                    'label' => 'u_store_description',
                    'rules' => 'trim|xss_clean'
                 ),
            )
          )
?>