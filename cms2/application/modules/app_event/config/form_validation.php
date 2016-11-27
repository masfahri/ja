<?php

/***********************************************************
@author Raka Anggala W.S
@date 21/06/2014
@desc Configuration form validation field
      This config will use for every form submit
***********************************************************/
$config = array(
          'app_event' => array(
           array(
                    'field' => 'event_name',
                    'label' => 'Event Name',
                    'rules' => 'required|max_length[50]|xss_clean'
                 ),
           array(
                    'field' => 'place',
                    'label' => 'Event Place',
                    'rules' => 'required|max_length[50]|xss_clean'
                 ),
           array(
                    'field' => 'date',
                    'label' => 'Event Date',
                    'rules' => 'required|max_length[50]|xss_clean'
                 ),           
           array(
                    'field' => 'status',
                    'label' => 'Event Status',
                    'rules' => 'required|max_length[50]|xss_clean'
                 )
            )
        )
?>