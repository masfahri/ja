<?php

/***********************************************************
@author Raka Anggala W.S
@date 21/06/2014
@desc Configuration form validation field
      This config will use for every form submit
***********************************************************/
$config = array(
           'app_banner' => array(
            array(
                    'field' => 'file_img',
                    'label' => 'File Image',
                    'rules' => 'required|xss_clean'
                 ),       
            array(
                    'field' => 'banner_page_id',
                    'label' => 'Banner on Page',
                    'rules' => 'required|xss_clean'
                 ),
            array(
                    'field' => 'banner_category_id',
                    'label' => 'Banner Category',
                    'rules' => 'required|xss_clean'
                 ),
            array(
                    'field' => 'banner_size_id',
                    'label' => 'Banner Size',
                    'rules' => 'required|xss_clean'
                 ),
            array(
                    'field' => 'banner_name',
                    'label' => 'Banner Name',
                    'rules' => 'max_length[50]|xss_clean'
                 ),
            array(
                    'field' => 'caption',
                    'label' => 'Advertisement Caption',
                    'rules' => 'max_length[200]|xss_clean'
                 ),
            array(
                    'field' => 'banner_url',
                    'label' => 'Banner URL Link',
                    'rules' => 'max_length[255]|xss_clean'
                 )
            )
        )
?>