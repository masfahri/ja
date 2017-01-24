<section>
      <div class="container">
        <div class="row">
          <div class="col-md-8">
          <?php
              # check if exist
              if( $datadb[0]['event_id'] != '' ){
                  echo '<img alt="'.$datadb[0]['event_name'].'" src="'.base_url().'cms/'.$row['file2'].'"/>';
              }else{
                  echo '
                  <iframe width="100%" height="500"
                      src="http://www.youtube.com/embed/'.$datadb[0]['file'].'?autoplay=1">
                  </iframe>';
              } 
              ?>          
            <article class="post-single">
              <div class="post-info">
                <h2 class="head-underlined">Event</h2>
                <h6 class="upper"><span class="dot"></span><span><?= $datadb[0]['date'] ?></span><span class="dot"></span><a href="#" class="post-tag"><?= $datadb[0]['place'] ?></a></h6>
              </div>
              <div class="post-media">
                <?php echo $primaryIcon ?>
              </div><br>
                <?= $datadb[0]['album_description'] ?>
            </article>
            <!-- end of article-->
          </div>
          <div class="col-md-3 col-md-offset-1">
            <div class="sidebar hidden-sm hidden-xs">
              <div class="widget">
                <h6 class="upper">Search Event</h6>
                <form>
                  <input type="text" placeholder="Search.." class="form-control">
                </form>
              </div>
              <!-- end of widget        -->
              <div class="widget">
                <h6 class="upper">Latest Posts</h6>
                <ul class="nav">
                  <li><a href="#">Checklists for Events<i class="ti-arrow-right"></i><span>30 Sep, 2015</span></a>
                  </li>
                  <li><a href="#">Proin elementum ante quis mauris<i class="ti-arrow-right"></i><span>29 Sep, 2015</span></a>
                  </li>
                  <li><a href="#">Integer non placerat diam, id ornare est. Curabitur sit amet lectus vitae urna.<i class="ti-arrow-right"></i><span>24 Sep, 2015</span></a>
                  </li>
                  <li><a href="#">Uber launches in Las Vegas<i class="ti-arrow-right"></i><span>20 Sep, 2015</span></a>
                  </li>
                  <li><a href="#">Vestibulum ante ipsum primis in faucibus<i class="ti-arrow-right"></i><span>16 Sep, 2015</span></a>
                  </li>
                </ul>
              </div>
              <!-- end of widget          -->
            </div>
            <!-- end of sidebar-->
          </div>
        </div>
        <!-- end of row-->

      </div>
    </section>