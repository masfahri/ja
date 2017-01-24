<section class="col-md-12 main-section-margins non-article-margin clearfix">
      <section class="container">

            <ul class="breadcrumb">
              <li><a href="index.php">Home</a></li>
              <li><?= $datadb['blog_category_name'] ?></li>
              <li><?= $datadb['title'] ?></li>
            </ul>
          <div class="list-article-pretext"></div>
            <article class="detail-artikel">
              <h2><?= $datadb['title'] ?></h2>
              <div class="keterangan">
                <div><span class="fa fa-calendar"></span><?= date('d/M/Y', strtotime($datadb['create_date'])) ?></div>
                <div><span class="fa fa-heart"></span>212</div>
                <div><span class="fa fa-user"></span><?= $datadb['nickname'] ?></div>
              </div>
              <?php
              if( $datadb['filetype'] == 'pdf' ){
                $contentDesc = '';
                $initId      = 'pdf'; 
              }else{
                $contentDesc =  str_replace('<b>@kutipan</b>', '', $datadb['content']);
                $initId      = 'detail-desc';
              } 
              ?>
              <div class="main-detail" id="<?= $initId ?>">
                 <?php
                 $primaryIcon = '';
                 // image
                 if($datadb['filetype']  == 'image'){
                    if( $datadb['file'] !== "" ){
                         $primaryIcon = '<img class="img-responsive" src="'.base_url().'cms/'.getThumbnailsImage($datadb['file'], $datadb['extention']).'" alt="'.getContent('title', $datadb['blog_id'], getActiveLang()).'" class="img-responsive"/>';
                    }
                 }
                // video
                 if($datadb['filetype']  == 'youtube'){
                      $primaryIcon = '<iframe width="100%" height="380" src="https://www.youtube.com/embed/'.$datadb['video'].'" frameborder="0" allowfullscreen></iframe>';
                 }
                 // pdf
                 if($datadb['filetype']  == 'pdf'){
                     $primaryIcon = '<div class="pdf-file"><span>PDF FILE</span></div>';
                 } 
                 ?>
                <?= $primaryIcon ?>
                <?= $contentDesc ?>
              </div>

              <hr/>

              <ul class="detail-share">
                <li class="ds-heart"><a href=""><span class="fa fa-heart"></span><span class="h-text">Like</span><span class="h-count">2</span></a></li>
                <li class="ds-facebook"><a href=""><span class="fa fa-facebook"></span>Share</a></li>
                <li class="ds-twitter"><a href=""><span class="fa fa-twitter"></span>Tweet</a></li>
              </ul>
            </article>

            <aside class="detail-popular">
              <div>Popular</div>
              <ul id="blog-grid">
                  <?php
                  $dataPopuper = getPopulerBlog(3, $datadb['blog_id']);
                  if( count($dataPopuper) > 0 ){
                    foreach($dataPopuper as $row){
                        
                        # file upload
                        $primaryIcon = '';
                        // image
                        if($row['filetype']  == 'image'){
                            if( $row['file'] !== "" ){
                                 $primaryIcon = '<img class="img-responsive" src="'.base_url().'cms/'.getThumbnailsImage($row['file'], $row['extention']).'" alt="'.getContent('title', $row['blog_id'], getActiveLang()).'" class="img-responsive"/>';
                            }
                        }
                        // video
                        if($row['filetype']  == 'youtube'){
                             $primaryIcon = '<img class="img-responsive" src="http://i1.ytimg.com/vi/'.$row['file'].'/hqdefault.jpg" />';
                        }
                        // pdf
                        if($row['filetype']  == 'pdf'){
                            $primaryIcon = '<div class="pdf-file"><span>PDF FILE</span></div>';
                        } 
                        
                        echo '
                         <li class="col-sm-6 col-md-4 entry bi list-index">
                            <section class="sq-sm text-block blog-post-list">
                              '.$primaryIcon.'
                              <div class="col-sm-12">
                                <span class="date">'.date('d/m/Y', strtotime($row['create_date'])).'</span>
                                <a onclick="articleRecordView(this)" blog_id="'.$row['blog_id'].'"  data-url="'.base_url('article/detail').'/'.$row['blog_id'].'/'.strtolower(parseString(getContent('title', $row['blog_id'], getActiveLang()))).'"><h3 class="transition">'.strtoupper(getContent('title', $row['blog_id'], getActiveLang())).' </h3></a>
                                <span class="meta">
                                  <i class="fa fa-eye"></i> '.getLogArticleView($row['blog_id']).'
                                  <i class="fa fa-heart-o"></i> '.getLogArticleLoved($row['blog_id']).'
                                </span>
                                <a class="visible-xs hidden-sm hidden-md hidden-lg" onclick="articleRecordView(this)" blog_id="'.$row['blog_id'].'" data-url="'.base_url('article/detail').'/'.$row['blog_id'].'/'.strtolower(parseString(getContent('title', $row['blog_id'], getActiveLang()))).'">
                                  <i class="fa fa-long-arrow-right fa-lg"></i>
                                </a>
                              </div>
                            </section>
                          </li>';
                    }
                  }
                  ?>
              </ul>
            </aside>

      </section>
      <!-- end of container -->
    </section>
    <div class="clearfix"></div>