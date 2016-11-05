<?php

/***********************************************************
@author Raka Anggala W.S
@date 21/06/2014
@desc Configuration form validation field
      This config will use for every form submit
***********************************************************/
$config = array(
          'app_client' => array(
           array(
                    'field' => 'client_name',
                    'label' => 'Client Name',
                    'rules' => 'required|max_length[50]|xss_clean'
                 )
            )
        )
?>