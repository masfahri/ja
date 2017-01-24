<?php if( $this->initial_template == '' ): ?>
<section>

	<div class="container">

        <h2 class="head-underlined">Event</h2>


					<div class="row">

            <div class="col-sm-4  col-md-offset-4">

                <div class="form-select" id="idfilters">

                    <select name="month" class="form-control dropdown">

                        <option value="*" class="active">all </option>

                        <option value=".01">January</option>

                        <option value=".02">February</option>

                        <option value=".03">March</option>
                        <option value=".04">April</option>

                        <option value=".05">May</option>
                        <option value=".06">June</option>
                        <option value=".07">July</option>
                        <option value=".08">August</option>
                        <option value=".09">September</option>
                        <option value=".10">October</option>
                        <option value=".11">November</option>
                        <option value=".12">December</option>

                    </select>

                </div>

            </div>					
					
			



        </div>
		


        <div class="row event" id="works" style="margin-top:20px; margin-bottom:40px">

            <?php
             if( count($datadb) > 0 ){
                foreach($datadb as $row){
                    
                    # check image or video
                    $getFile = getAlbumFile($row['event_id'], 1);
                    if( $getFile['file'] == '' ){
                        $primaryIcon = '<img alt="'.$row['event_name'].'" src="'.base_url().'cms/'.$row['file2'].'"/>';
                    }else{
                        $primaryIcon = '<img src="http://placehold.it/607x604"/>';
                    } 
                    
                    # character limit
                    if( strlen($row['desc']) >= 35 ){
                        $title  = substr($row['desc'], 0, 35).' ....';
                    }else{
                        $title  = $row['desc'];
                    }
                    
                    echo '
		            <div class="col-md-4 col-sm-6 work-item '.date('m', strtotime($row['date'])).'">

		                <div class="work-detail gallery-inner">

		                    <a href="'.base_url( 'event/detail' ).'/'.parseUrl($row['event_id']).'">

		                        '.$primaryIcon.'

		                        <div class="work-info">

		                            <div class="centrize ">

		                                <div class="v-center">

		                                    <h3>'.$title.'</h3>

		                                    <p>'.$row['date'].'</p>

		                                    <button class="btn">'.$row['place'].'</button>

		                                </div>

		                            </div>

		                        </div>

		                        <div class="desc">

		                            <div class="inner-desc">

		                                <h4>'.$title.'</h4>

		                                <p><small>'.$row['desc'].'</small></p>

		                            </div>

		                            <div class="date">

		                                <span>'.$row['date'].'</span>

		                            </div>

		                        </div>

		                    </a>

		               </div>

		            </div>';
                }
            }
            ?>            


       </div>

        <div class="row">
            <?php
             if( count($ads) > 0 ){
                foreach($ads as $row){
                    
                    $initial_id = $row['ads_place_id'];

                    if( $initial_id == '4') {
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
<?php else: ?>
<section>
      <div class="container">
        <div class="row">
          <div class="col-md-8">
          <?php
              # check if exist
              if( $datadb[0]['event_id'] != '' ){
                  echo '<img alt="'.$datadb[0]['event_name'].'" width="50%" height="50%" src="'.base_url().'cms/'.$datadb[0]['file2'].'"/>';
              }else{
                  echo '
                  <iframe width="100%" height="500"
                      src="http://www.youtube.com/embed/'.$datadb[0]['file'].'?autoplay=1">
                  </iframe>';
              } 
              ?>          
            <article class="post-single">
              <div class="post-info">
                <h2 class="head-underlined"><?= $datadb[0]['event_name'] ?></h2>
                <h6 class="upper">Status : <?= $datadb[0]['status'] ?><span class="dot"></span><span><?= $datadb[0]['date'] ?></span><span class="dot"></span>Place : <?= $datadb[0]['place'] ?></h6>
              </div>
              <div class="post-media">
                <?php echo $primaryIcon ?>
              </div><br>
                <?= $datadb[0]['desc'] ?>
            </article>
            <!-- end of article-->
          </div>
        </div>
        <!-- end of row-->

      </div>
    </section>	
<?php endif; ?>