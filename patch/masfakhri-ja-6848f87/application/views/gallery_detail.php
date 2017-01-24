<!-- Main content -->
<section id="content" class="tour">
    <!-- Your Page Content Here -->
    <div class="page-title-container">
        <div class="container">
            <?php
                $leftTitle = cleanDash($this->uri->segment(4));
                ?>
                <div class="page-title pull-left">
                    <h2 class="entry-title"><?= $leftTitle ?></h2>
                </div>
                <ul class="breadcrumbs pull-right">
                    <li><a href="#">Destination</a></li>
                    <li class="active">
                        <?= $leftTitle ?>
                    </li>
                </ul>
        </div>
    </div>
    <section id="content" class="gray-area">
        <div class="container">
            <div class="row">

                <div id="main" class="col-sm-12 col-md-12">

                    <div class="post">
                        <figure class="image-container">
                            <?php
                                # check image or video
                                if( $datadb[0]['type'] == 'image' ){
                                    echo '<img class="img-responsive" alt="'.$datadb[0]['album_title'].'" src="'.base_url().'cms/'.getThumbnailsImage($datadb[0]['file'], $datadb[0]['extention']).'"/>';
                                }else{
                                    echo '
                                    <iframe width="100%" height="500"
                                        src="http://www.youtube.com/embed/'.$datadb[0]['file'].'?autoplay=1">
                                    </iframe>';
                                } 
                                ?>
                        </figure>
                        <div class="details">
                            <div class="tab-container box">
                                <ul class="tabs full-width">
                                    <li class="active"><a data-toggle="tab" href="#recent-posts">Description</a></li>
                                    <li><a data-toggle="tab" href="#new-posts">Photos</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div id="recent-posts" class="tab-pane fade in active">
                                        <h1 class="entry-title"><?= $datadb[0]['album_title'] ?></h1>
                                        <?= $datadb[0]['album_description'] ?>
                                    </div>
                                    <div id="new-posts" class="tab-pane fade">
                                        <?php
                                               $getCollection = getAlbumFile($datadb[0]['gallery_album_id']);
                                               if(count($getCollection) > 0){
                                                    foreach($getCollection as $row){
                                                        
                                                        if( $row['type'] == 'image' ){
                                                            $primaryIcon = '<img class="img-responsive" alt="'.$datadb[0]['album_title'].'" src="'.base_url().'cms/'.getThumbnailsImage($row['file'], $row['extention']).'" width="272" height="192"/>';
                                                        }else{
                                                            $primaryIcon = '<div class="yt-image"><img class="img-responsive" alt="'.$datadb[0]['album_title'].'" src="http://i1.ytimg.com/vi/'.$row['file'].'/hqdefault.jpg"/></div>';
                                                        } 
                                                        echo '
                                                        <div class="col-sm-6 col-md-4">
                			                                <article class="box">
                			                                    <figure class="animated" data-animation-type="fadeInDown" data-animation-delay="0">
                			                                        <a href="" class="hover-effect">'.$primaryIcon.'</a>
                			                                    </figure>
                                                            </article>
                                                        </div>';
                                                    }
                                               }
                                               ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>
<!-- /.content -->