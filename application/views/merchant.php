<section class="merchant">
    <div class="centrize">
        <div class="v-center">
            <div class="container">
                <div class="col-md-12">
                    <div class="title center">
                        <h1 class="upper">MORE BENEFITS FOR MEMBERS</h1>
                        <h4><?php echo $desc[0]['page_desc'] ?></h4>

                        <div class="title-red">
                            <h4 class="bordered">MERCHANTS</h4>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end of container-->
        </div>
    </div>
</section>
<section class="merchant">
    <div class="container ">
            <?php
             if( count($merchant) > 0 ){
                foreach($merchant as $row){

                    # check image or video
                    //$getFile = getAlbumFile($row['gallery_album_id'], 1);
                    if( $row['file'] != '' ){
                        $primaryIcon = '<img alt="'.$row['merchant_name'].'" src="'.base_url().'cms/'.$row['file'].'"/>';
                    }else{
                        $primaryIcon = '<img src="http://placehold.it/607x604"/>';
                    }

                    # character limit
                    if( strlen($row['merchant_desc']) >= 100 ){
                        $desc  = substr($row['merchant_desc'], 0, 100).' ....';
                    }else{
                        $desc  = $row['merchant_desc'];
                    }

                    echo '
                    <div class="col-md-6">
                        <div class="col-md-6">
                            '.$primaryIcon.'
                        </div>
                        <div class="col-md-6">
                            <a href="'.$row['merchant_place'].'">'.$row['merchant_place'].'</a>
                            <p>'.$desc.'</p>
                        </div>
                    </div>';
                }
            }
            ?>           
    </div>
</section>