        <section id="content" class="tour">
            <!-- Your Page Content Here -->
            <div class="page-title-container">
            <div class="container">
                <div class="page-title pull-left">
                    <h2 class="entry-title">Destinations</h2>
                </div>
                <ul class="breadcrumbs pull-right">
                    <li><a href="<?= base_url() ?>">HOME</a></li>
                    <li class="active">Destinations</li>
                </ul>
            </div>
        </div>

        <section id="content" class="gray-area">
                    <div class="container">
                        <div class="row">
                            <?php
                             if( count($datadb) > 0 ){
                                foreach($datadb as $row){
                                    
                                    # check image or video
                                    $getFile = getAlbumFile($row['gallery_album_id'], 1);
                                    if( $getFile['type'] == 'image' ){
                                        $primaryIcon = '<img class="img-responsive" alt="'.$row['album_title'].'" src="'.base_url().'cms/'.getThumbnailsImage($getFile['file'], $getFile['extention']).'" width="272" height="192"/>';
                                    }else{
                                        $primaryIcon = '<div class=""><img class="img-responsive" alt="'.$row['album_title'].'" src="http://i1.ytimg.com/vi/'.$getFile['file'].'/hqdefault.jpg"/></div>';
                                    } 
                                    
                                    # character limit
                                    if( strlen($row['album_title']) >= 35 ){
                                        $title  = substr($row['album_title'], 0, 35).' ....';
                                    }else{
                                        $title  = $row['album_title'];
                                    }
                                    
                                    echo '
                                    <div id="main" class="col-sm-12 col-md-6">
                                        <div class="booking-section">
                                            <div class="person-information">
                                               <div class="block">
                                                    <h1>'.$title.'</h1>
                                                    <div class="row image-box style2">
                                                        <div class="col-md-6">
                                                            <article class="box">
                                                                <figure>
                                                                    <a href="'.base_url( 'destination/detail' ).'/'.$row['gallery_album_id'].'/'.parseUrl($row['album_title']).'" title="'.parseUrl($row['album_title']).'">'.$primaryIcon.'</a>
                                                                </figure>
                                                            </article>
                                                        </div>
                                                        <div class="col-md-6">
                                                           <article class="box">
                                                                <div class="details">
                                                                   '.word_limiter($row['album_description'], 40).'
                                                                   <br/><a href="'.base_url( 'destination/detail' ).'/'.$row['gallery_album_id'].'/'.parseUrl($row['album_title']).'" title="'.parseUrl($row['album_title']).'" class="button">READ MORE</a>
                                                                </div>
                                                           </article>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>';
                                }
                            }
                            ?>
                        </div>
                        <div class="row">
                            <div class="col-sm-10 col-md-12">
                                <!-- PAGINATION -->
                                <?=  $this->pagination->create_links() ?>
                                <!-- ========= -->
                            </div>
                        </div>
                    </div>
                </section>
        </section>