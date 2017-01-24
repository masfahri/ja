    <?php if( $this->initial_template == 'category' ): ?>
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
                                    if( $row['filetype'] == 'image' ){
                                        $primaryIcon = '<img class="img-responsive" alt="'.$row['title'].'" src="'.base_url().'cms/'.getThumbnailsImage($row['file'], $row['extention']).'" width="272" height="192"/>';
                                    }else{
                                        $primaryIcon = '<div class=""><img class="img-responsive" alt="'.$row['title'].'" src="http://i1.ytimg.com/vi/'.$row['youtube_id'].'/hqdefault.jpg"/></div>';
                                    } 
                                    
                                    # character limit
                                    if( strlen($row['title']) >= 80 ){
                                        $title  = substr($row['title'], 0, 80).' ....';
                                    }else{
                                        $title  = $row['title'];
                                    }
                                    
                                    echo '
                                    <div id="main" class="col-sm-12 col-md-12" style="margin-bottom:-25px;">
                                        <div class="booking-section">
                                            <div class="person-information">
                                               <div class="block">
                                                    <h1>'.$title.' </h1>
                                                    <div class="row image-box style2">
                                                        <div class="col-md-3">
                                                            <article class="box">
                                                                <figure>
                                                                    <a href="'.base_url( 'article/detail' ).'/'.$row['blog_id'].'/'.parseUrl($row['title']).'" title="'.parseUrl($row['title']).'">'.$primaryIcon.'</a>
                                                                </figure>
                                                            </article>
                                                        </div>
                                                        <div class="col-md-9">
                                                           <article class="box">
                                                                <div class="details">
                                                                   '.word_limiter($row['content'], 120).'
                                                                   <br/><br/><a href="'.base_url( 'article/detail' ).'/'.$row['blog_id'].'/'.parseUrl($row['title']).'" title="'.parseUrl($row['title']).'" class="button">READ MORE</a>
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
                            <div class="col-sm-12 col-md-12">
                                <!-- PAGINATION -->
                                <center>
                                    <?=  $this->pagination->create_links() ?>
                                </center>
                                <!-- ========= -->
                            </div>
                        </div>
                    </div>
                </section>
        </section>
    
    <?php else : ?>
    
       <!-- Main content -->
       <section id="content" class="tour">
            <!-- Your Page Content Here -->
            
            <section id="content" class="gray-area">
                <div class="container">
                    <div class="row">
                        <div id="main" class="col-sm-12 col-md-12">
                            <div class="post">
                                <figure class="image-container">
                                    <?php
                                    # check image or video
                                    if( $datadb[0]['filetype'] == 'image' ){
                                        echo '<img class="img-responsive" alt="'.$datadb[0]['title'].'" src="'.base_url().'cms/'.getThumbnailsImage($datadb[0]['file'], $datadb[0]['extention']).'"/>';
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
                                        <div class="tab-content">
                                                <div id="recent-posts" class="tab-pane fade in active">
                                                    <h1 class="entry-title"><?= $datadb[0]['title'] ?></h1>
                                                    <?= $datadb[0]['content'] ?>
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
    <?php endif; ?>