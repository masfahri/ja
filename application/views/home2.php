<?php
             if( count($slide) > 0 ): ?>
<section id="home" class="page-title">
    <div id="home-slider" class="flexslider">
        <ul class="slides">
                <?
                foreach($slide as $row){

                    if( $row['file'] != '' ){
                        $primaryIcon = '<img alt="'.$row['event_name'].'" src="'.base_url().'cms/'.$row['file3'].'"/>';
                    }else{
                        $primaryIcon = '<img src="http://placehold.it/1219x426"/>';
                    }

                    # character limit
                    if( strlen($row['desc']) >= 35 ){
                        $title  = substr($row['desc'], 0, 35).' ....';
                    }else{
                        $title  = $row['desc'];
                    }

                    echo '
                    <li style="">
                        '.$primaryIcon.'
                        <div class="slide-wrap">
                            <div class="slide-content">
                                <div class="container">
                                    <h1>'.$row['event_name'].'<span class="red-dot"></span></h1>
                                    <h6>'.$title.'</h6>
                                    <p><a href="'.base_url( 'event/detail' ).'/'.parseUrl($row['event_id']).'" class="btn btn-light-out">Read More</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </li>';
                }
                ?>
        </ul>
    </div>
</section>
<?php endif;?>   
<section>
    <div class="container">
        <div class="row">
            <?php
             if( count($ads) > 0 ){
                foreach($ads as $row){

                    $initial_id = $row['ads_place_id'];

                    if( $initial_id == '1') {
                         echo '
                    <div class="col-md-6"><a href="'.$row['url'].'"><img alt="'.$row['title'].'" src="'.base_url().'cms/'.$row['file'].'"/></a></div>';
                    }
                   echo '';
                }
            }
            ?>
        </div>
    </div>
</section>

<section>
    <!--ul id="filters">
        <li data-filter="*" class="active">All</li>
        <li data-filter=".branding">Branding</li>
        <li data-filter=".graphic">Graphic</li>
        <li data-filter=".printing">Printing</li>
        <li data-filter=".video">Video</li>
    </ul-->

    <!--<div id="idfilters">
        <select>
            <option value="*" class="active">all </option>
            <option value=".branding">branding</option>
            <option value=".graphic">graphic</option>
            <option value=".printing">printing</option>
            <option value=".video">video</option>
        </select>
    </div>-->
    <!-- end of portfolio filters-->

    <div class="container">
        <div id="works" class="three-col wide">
            <?php
             if( count($gallery) > 0 ){
                foreach($gallery as $row){

                    # check image or video
                    //$getFile = getAlbumFile($row['gallery_album_id'], 1);
                    if( $row['file'] != '' ){
                        $primaryIcon = '<img alt="'.$row['album_name'].'" src="'.base_url().'cms/'.$row['file'].'"/>';
                    }else{
                        $primaryIcon = '<img src="http://placehold.it/607x604"/>';
                    }

                    # character limit
                    if( strlen($row['album_name']) >= 35 ){
                        $title  = substr($row['album_name'], 0, 35).' ....';
                    }else{
                        $title  = $row['album_name'];
                    }

                    echo '
                    <div class="work-item">
                        <div class="work-detail">
                            <a href="'.base_url( 'gallery/detail' ).'/'.parseUrl($row['gallery_album_id']).'">
                            '.$primaryIcon.'
                            <div class="cat-info">Gallery</div>
                                <div class="work-info">
                                    <div class="centrize">
                                        <div class="v-center">
                                            <div class="plus-icon"></div>
                                            <h3>'.$title.'</h3>
                                            <p>'.$row['album_title'].'</p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>';
                }
            }
            ?>        
            <?php
             if( count($event) > 0 ){
                foreach($event as $row){

                    # check image or video
                    $getFile = getAlbumFile($row['event_id'], 1);
                    if( $getFile['file'] == '' ){
                        $primaryIcon = '<img alt="'.$row['event_name'].'" src="'.base_url().'cms/'.$row['file2'].'"/>';
                    }else{
                        $primaryIcon = '<img src="http://placehold.it/607x604"/>';
                    }

                    # character limit
                    if( strlen($row['event_name']) >= 35 ){
                        $title  = substr($row['event_name'], 0, 35).' ....';
                    }else{
                        $title  = $row['event_name'];
                    }

                    echo '
                    <div class="work-item">
                        <div class="work-detail">
                            <a href="'.base_url( 'event/detail' ).'/'.parseUrl($row['event_id']).'">
                            '.$primaryIcon.'
                            <div class="cat-info">Event</div>
                                <div class="work-info">
                                    <div class="centrize">
                                        <div class="v-center">
                                            <div class="plus-icon"></div>
                                            <h3>'.$title.'</h3>
                                            <p>Status : '.$row['status'].'</p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>';
                }
            }
            ?>
            <?php
             if( count($sponsors) > 0 ){
                foreach($sponsors as $row){

                    # check image or video
                    $getFile = getAlbumFile($row['id_sponsors'], 1);
                    if( $getFile['file'] == '' ){
                        $primaryIcon = '<img alt="'.$row['brand_name'].'" src="'.base_url().'cms/'.$row['file'].'"/>';
                    }else{
                        $primaryIcon = '<img src="http://placehold.it/607x604"/>';
                    }

                    # character limit
                    if( strlen($row['desc_brand']) >= 35 ){
                        $title  = substr($row['desc_brand'], 0, 35).' ....';
                    }else{
                        $title  = $row['desc_brand'];
                    }

                    echo '
                    <div class="work-item">
                        <div class="work-detail">
                            <a href="'.base_url( 'about' ).'">
                            '.$primaryIcon.'
                            <div class="cat-info">Sponsors</div>
                                <div class="work-info">
                                    <div class="centrize">
                                        <div class="v-center">
                                            <div class="plus-icon"></div>
                                            <h3>'.$row['brand_name'].'</h3>
                                            <p>'.$title.'</p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>';
                }
            }
            ?>          
            <div class="work-item printing branding">
                <div class="work-detail">
                    <a href="<?= base_url() ?>shop/">
                    <img src="<?= config_item('assets_img') ?>portfolio/6.jpg" alt="">
                    <div class="cat-info">Shop</div>
                    <div class="work-info">
                        <div class="centrize">
                            <div class="v-center">
                                <div class="plus-icon"></div>
                                <h3>Jeff Burger</h3>
                                <p>Printing, Branding</p>
                            </div>
                        </div>
                    </div>
                </a>
                </div>
            </div>
            <div class="work-item printing graphic">
                <div class="work-detail">
                    <a href="<?= base_url() ?>membership/">
                    <img src="<?= config_item('assets_img') ?>portfolio/3.jpg" alt="">
                    <div class="cat-info">Membership</div>
                    <div class="work-info">
                        <div class="centrize">
                            <div class="v-center">
                                <div class="plus-icon"></div>
                                <h3>Delirio Tropical</h3>
                                <p>Printing, Graphic</p>
                            </div>
                        </div>
                    </div>
                </a>
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container">
        <div class="row">
            <?php
             if( count($ads) > 0 ){
                foreach($ads as $row2){

                     $initial_id = $row2['ads_place_id'];

                    if( $initial_id == '2') {
                         echo '
                    <div class="col-md-6"><a href="'.$row2['url'].'"><img alt="'.$row2['title'].'" src="'.base_url().'cms/'.$row2['file'].'"/></a></div>';
                    }
                   echo '';
                }
            }
            ?>
        </div>
    </div>
</section>

<div class="modal fade" id="pop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body" align="center">
                <a class="pull-right" data-dismiss="modal" style="cursor:pointer;"><i class="ti-close"></i></a>
                <?php
                 if( count($ads) > 0 ){
                    foreach($ads as $row){

                        $initial_id = $row['ads_place_id'];

                        if( $initial_id == '6') {
                             echo '
                        <a href="'.$row['url'].'"><img alt="'.$row['title'].'" src="'.base_url().'cms/'.$row['file'].'"/></a>';
                        }
                       echo '';
                    }
                }
                ?>              
            </div>
        </div>
    </div>
</div>
