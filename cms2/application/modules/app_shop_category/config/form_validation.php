<?php

/***********************************************************
@author Raka Anggala W.S
@date 21/06/2014
@desc Configuration form validation field
      This config will use for every form submit
***********************************************************/
$config = array(
           'app_product_category' => array(
            array(
                    'field' => 'category_name',
                    'label' => 'Product Category Name',
                    'rules' => 'required|max_length[50]|xss_clean'
                 )
            )
        )
?>