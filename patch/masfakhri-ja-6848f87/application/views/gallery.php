<?php if( $this->initial_template == '' ): ?>
 <section class="parallax">
    <div data-parallax="scroll" data-image-src="<?= config_item('assets_img') ?>banner/header.jpg" class="parallax-bg"></div>
    <div class="parallax-overlay">
        <div class="centrize">
            <div class="v-center">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <div class="title center" style="margin:100px">
                               <h1>&nbsp;</h1><br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="container">
        <h2 class="head-underlined">Photo Gallery</h2>
        <div class="row gallery margintop-40" id="work" >
            <?php
             if( count($photo) > 0 ){
                foreach($photo as $row){

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

                    <div class="col-md-4 col-sm-6 work-item">
                        <div class="work-detail">
                            <a href="'.base_url( 'gallery/detail' ).'/'.parseUrl($row['gallery_album_id']).'">
                                '.$primaryIcon.'
                                <div class="work-info">
                                    <div class="centrize">
                                        <div class="v-center">
                                            <div class="plus-icon">
                                                <span class="ring"></span>
                                            </div>
                                            <h3>'.$title.'</h3>
                                            <p>'.date ("d-M-Y",strtotime($row['date'])).'</p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>';
                }
            }
            ?>      
        </div> 
    </div>
    <br>

    <div class="container">
        <h2 class="head-underlined">Video Gallery</h2>
        <div class="row gallery-video margintop-40" id="works">
            <?php
             if( count($video) > 0 ){
                foreach($video as $row){

                    # check image or video
                    //$getFile = getAlbumFile($row['gallery_album_id'], 1);
                    if( $row['type'] == 'video' ){
                        $primaryIcon = '<iframe width="100%" height="280"
                                  src="http://www.youtube.com/embed/'.$row['url_link'].'?autoplay=0">
                              </iframe>';
                    }else{
                        $primaryIcon = '<img src="http://placehold.it/607x604"/>';
                    }

                    # character limit
                    if( strlen($row['album_description']) >= 35 ){
                        $title  = substr($row['album_description'], 0, 35).' ....';
                    }else{
                        $title  = $row['album_description'];
                    }

                    echo '
                    <div class="col-md-4 col-sm-6 work-item">
                        <div class="work-detail">
                            <a target="_blank" href="https://www.youtube.com/watch?v='.$row['url_link'].'">
                                '.$primaryIcon.'
                                <div class="work-info">
                                    <div class="centrize">
                                        <div class="v-center">
                                            <i class="fa fa-youtube-play fa-3x"></i>
                                            <h3>'.$row['album_name'].'</h3>
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
        </div>
    </div>
    <br>

    <div class="container"> 
        <div class="col-md-6 col-sm-6 col-md-offset-3 text-center">
            <a type="submit" href="<?= $social['youtube'] ?>" class="btn btn-color center-btn">Explore our channel</a>
        </div>
    </div>
    <br>
    <br>        
    <br>
    <div class="container">
        <div class="row">
            <?php
             if( count($ads) > 0 ){
                foreach($ads as $row){
                    
                    $initial_id = $row['ads_place_id'];

                    if( $initial_id == '3') {
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
<?php elseif( $this->initial_template == 'detail' ): ?>
<section>
    <div class="container">
        <div class="row">
                       
                                        <?php
                                               if(count($gallery) > 0){
                
                                                        
                                                        if( $gallery[0]['type'] == 'image' ){
                                                            if($gallery[0]['file'] != ''){
                                                            $primaryIcon = '<div class="item"><img alt="'.$gallery[0]['album_title'].'" src="'.base_url().'cms/'.$gallery[0]['file'].'"/></div>';
                                                            }else{ $primaryIcon = '';}
                                                            if($gallery[1]['file'] != ''){
                                                            $primaryIcon2 = '<div class="item"><img alt="'.$gallery[1]['album_title'].'" src="'.base_url().'cms/'.$gallery[1]['file'].'"/></div>';
                                                            }else{ $primaryIcon2 = '';}
                                                            if($gallery[2]['file'] != ''){
                                                            $primaryIcon3 = '<div class="item"><img alt="'.$gallery[2]['album_title'].'" src="'.base_url().'cms/'.$gallery[2]['file'].'"/></div>';
                                                            }else{ $primaryIcon3 = '';}
                                                            if($gallery[3]['file'] != ''){
                                                            $primaryIcon4 = '<div class="item"><img alt="'.$gallery[3]['album_title'].'" src="'.base_url().'cms/'.$gallery[3]['file'].'"/></div>';
                                                            }else{ $primaryIcon4 = '';}
                                                            if($gallery[4]['file'] != ''){
                                                            $primaryIcon5 = '<div class="item"><img alt="'.$gallery[4]['album_title'].'" src="'.base_url().'cms/'.$gallery[4]['file'].'"/></div>';
                                                            }else{ $primaryIcon5 = '';}
                                                        }else{
                                                            $primaryIcon = '';
                                                        } ?>
                                                   <?php
                                               }
                                               ?>  
                                                        <div class="col-md-8">
                                                          <div class="big-images">

                                                            <?php echo $primaryIcon; ?>                                                         
                                                            <?php echo $primaryIcon2; ?>                                                    
                                                            <?php echo $primaryIcon3; ?>                                                    
                                                            <?php echo $primaryIcon4; ?>
                                                            <?php echo $primaryIcon5; ?>                                                           
                                                          </div>
                                                          <br/>
                                                          <div class="thumbs">
                                                            <?php echo $primaryIcon; ?>                                                         
                                                            <?php echo $primaryIcon2; ?>                                                    
                                                            <?php echo $primaryIcon3; ?>                                                    
                                                            <?php echo $primaryIcon4; ?>
                                                            <?php echo $primaryIcon5; ?>                                                            
                                                          </div>	
                                                        </div>
                                                        <div class="col-md-4">
                                                            <h3 class="sub-title"><?php echo $gallery[0]['album_name']; ?></h3>
                                                            <?php echo $gallery[0]['date']; ?> <span class="red-dot"></span> <?php echo $gallery[0]['album_title']; ?>
                                                            <p>
                                                              <?php echo $gallery[0]['album_description']; ?>
                                                            </p>

                                                            <br>
                                                            <br>

                                                        </div>          
        </div>
    </div>
</section>
<?php endif; ?>