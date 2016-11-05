<?php

/***********************************************************
@author Raka Anggala W.S
@date 21/06/2014
@desc Configuration form validation field
      This config will use for every form submit
***********************************************************/
$config = array(
           'app_membership' => array(
           array(
                    'field' => 'titone',
                    'label' => 'Feature 1 Title',
                    'rules' => 'required|max_length[50]|xss_clean'
                 ),  
           array(
                    'field' => 'tittwo',
                    'label' => 'Feature 2 Title',
                    'rules' => 'required|max_length[50]|xss_clean'
                 ),
           array(
                    'field' => 'tittri',
                    'label' => 'Feature 3 Title',
                    'rules' => 'required|max_length[50]|xss_clean'
                 )

            ),
           'app_membershipT' => array(
           array(
                    'field' => 'desc',
                    'label' => 'Terms and condition',
                    'rules' => 'required|xss_clean'
                 )
           	),
           'app_membershipD' => array(
           array(
                    'field' => 'desc',
                    'label' => 'Benefit Description',
                    'rules' => 'required|xss_clean'
                 )
            ),           
           'app_membershipP' => array(
           array(
                    'field' => 'first_name',
                    'label' => 'First Name',
                    'rules' => 'required|xss_clean'
                 ),
           array(
                    'field' => 'last_name',
                    'label' => 'Last Name',
                    'rules' => 'required|xss_clean'
                 ),
           array(
                    'field' => 'phone',
                    'label' => 'Phone Number',
                    'rules' => 'required|xss_clean'
                 ),
           array(
                    'field' => 'province',
                    'label' => 'Province',
                    'rules' => 'required|xss_clean'
                 ),
           array(
                    'field' => 'address',
                    'label' => 'Address',
                    'rules' => 'required|xss_clean'
                 ),
           array(
                    'field' => 'zipcode',
                    'label' => 'Zipcode',
                    'rules' => 'required|xss_clean'
                 )
            ),
           'app_membershipC' => array(
           array(
                    'field' => 'first_name',
                    'label' => 'First Name',
                    'rules' => 'required|xss_clean'
                 ),
           array(
                    'field' => 'last_name',
                    'label' => 'Last Name',
                    'rules' => 'required|xss_clean'
                 ),
           array(
                    'field' => 'phone',
                    'label' => 'Phone Number',
                    'rules' => 'required|xss_clean'
                 ),
           array(
                    'field' => 'province',
                    'label' => 'Province',
                    'rules' => 'required|xss_clean'
                 ),
           array(
                    'field' => 'address',
                    'label' => 'Address',
                    'rules' => 'required|xss_clean'
                 ),
           array(
                    'field' => 'zipcode',
                    'label' => 'Zipcode',
                    'rules' => 'required|xss_clean'
                 )
            )
          )
?>