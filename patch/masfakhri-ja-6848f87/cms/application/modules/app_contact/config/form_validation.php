<?php

/***********************************************************
@author Raka Anggala W.S
@date 21/06/2014
@desc Configuration form validation field
      This config will use for every form submit
***********************************************************/
$config = array(
           'app_contact' => array(
            array(
                    'field' => 'contact_office',
                    'label' => 'Contact Office',
                    'rules' => 'required|trim|xss_clean'
                 ),
            array(
                    'field' => 'contact_email',
                    'label' => 'Contact Email',
                    'rules' => 'trim|xss_clean'
                 ),
            ),
          )
?>