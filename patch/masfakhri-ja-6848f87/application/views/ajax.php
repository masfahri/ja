<?php if($this->initial_template == 'quotes'):?>
    <?php
    if(count($datadb) > 0){
       echo '
       <blockquote class="blog-post-quote quote-depan">
         '.str_replace('<p>', '<p class="lead">', $datadb[0]['word']).'
        </blockquote>
       ';
    }
    ?>

<?php endif; ?>