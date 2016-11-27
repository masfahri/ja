<?php

/***********************************************************
@author Raka Anggala W.S
@date 21/06/2014
@desc Configuration form validation field
      This config will use for every form submit
***********************************************************/
$config = array(
           'app_blog_tag' => array(
            array(
                    'field' => 'blog_category_id',
                    'label' => 'Blog Category',
                    'rules' => 'required|xss_clean'
                 ),
            array(
                    'field' => 'blog_tag_name',
                    'label' => 'Blog Tag Name',
                    'rules' => 'required|max_length[50]|xss_clean'
                 )
            )
        )
?>