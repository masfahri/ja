<?php

/***********************************************************
@author Raka Anggala W.S
@date 21/06/2014
@desc Configuration form validation field
      This config will use for every form submit
***********************************************************/
$config = array(
           'app_blog' => array(
            array(
                    'field' => 'blog_category_id',
                    'label' => 'Blog Category',
                    'rules' => 'required|xss_clean'
                 ),
            array(
                    'field' => 'filetype',
                    'label' => 'File Type',
                    'rules' => 'required|xss_clean'
                 ),
                 
            )
        )
?>