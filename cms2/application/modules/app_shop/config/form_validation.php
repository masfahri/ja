<?php

/***********************************************************
@author Raka Anggala W.S
@date 21/06/2014
@desc Configuration form validation field
      This config will use for every form submit
***********************************************************/
$config = array(
          'app_shop' => array(
           array(
                    'field' => 'product_name',
                    'label' => 'Charter Name',
                    'rules' => 'required|max_length[50]|xss_clean'
                 ),
           array(
                    'field' => 'deals',
                    'label' => 'On sale',
                    'rules' => 'required|xss_clean'
                 ),
           array(
                    'field' => 'product_category',
                    'label' => 'Product Categories',
                    'rules' => 'required|max_length[50]|xss_clean'
                 ),
            array(
                    'field' => 'product_desc',
                    'label' => 'Charter Descsription',
                    'rules' => 'required|xss_clean'
                 ),
            array(
                    'field' => 'url_link',
                    'label' => 'Blog Category Name',
                    'rules' => 'max_length[255]|xss_clean'
                 )
            ),
          'app_shopCat' => array(
            array(
                    'field' => 'category_name',
                    'label' => 'Product Category Name',
                    'rules' => 'required|max_length[50]|xss_clean'
                 )
            )
        )
?>