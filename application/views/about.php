<section>
    <div class="container">
        <div class="panel panel-login">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-4">
                        <a href="#" class="active" id="login-form-link">About</a>
                    </div>
                    <div class="col-xs-4">
                        <a href="#" id="news-form-link">Officers</a>
                    </div>
                    <div class="col-xs-4">
                        <a href="#" id="register-form-link">Club Sponsors</a>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">

                        <div id="login-form" class="active">
                            <div class="title-red" style="margin: 40px 0px ; margin-bottom:60px;">
                                <h4 class="bordered">ABOUT US</h4>
                            </div>
                            <div class="col-md-8 col-md-offset-2">
                                <div class="post-body text-justify">
                                    <?= $about['desc'] ?>
                                </div>
                            </div>
                        </div>

                        <div id="news-form" style="display:none">
                            <div class="title-red" style="margin: 40px 0px ; margin-bottom:60px;">
                                <h4 class="bordered">OFFICERS</h4>
                            </div>
                            <div class="row officers margintop-40" id="work">
                                        <?php
                                         if( count($officers) > 0 ){
                                            foreach($officers as $row){
                                                
                                                $initial_id = $row['id'];


                                                if( $row['file'] != '' ){
                                                    $primaryIcon = '<img alt="'.$row['name'].'" src="'.base_url().'cms/'.$row['file'].'"/>';
                                                }else{
                                                    $primaryIcon = '<img src="http://placehold.it/280x278"/>';
                                                }

                                                     echo '
                                                        <div class="col-md-4 col-sm-6 work-item">
                                                            <div class="work-detail">
                                                                <a href="#">
                                                                    '.$primaryIcon.'
                                                                </a>
                                                                <div class="text-center col-md-12">
                                                                    <h3>'.$row['name'].'</h3>
                                                                    <p>'.$row['jobs'].'</p>
                                                                </div>
                                                            </div>
                                                        </div>';
                                            }
                                        }
                                        ?>  
                            </div>
                        </div>

                        
                        <div id="register-form" style="display: none;">
                            <div class="row">
                                <div class="title-red" style="margin: 40px 0px ; margin-bottom:60px;">
                                    <h4 class="bordered">Club Sponsors</h4>
                                </div>
                                <div class="row event margintop-40" id="work" >
                                  
                                <?
                                if($sponsors > 0) {
                                foreach($sponsors as $row){

                                    if( $row['file'] != '' ){
                                        $primaryIcon = '<img width="360" height="306" alt="'.$row['brand_name'].'" src="'.base_url().'cms/'.$row['file'].'"/>';
                                    }else{
                                        $primaryIcon = '<img src="http://placehold.it/360x306"/>';
                                    }

                                    # character limit
                                    if( strlen($row['desc_brand']) >= 35 ){
                                        $title  = substr($row['desc_brand'], 0, 35).' ....';
                                    }else{
                                        $title  = $row['desc_brand'];
                                    }

                                    echo '
                                          <div class="col-md-4 col-sm-6 work-item">
                                              <div class="work-detail">

                                                  <a href="#">
                                                      '.$primaryIcon.'
                                                      <div class="work-info">
                                                          <div class="centrize">
                                                              <div class="v-center">
                                                                  <h3>'.$row['brand_name'].'</h3>
                                                                      '.$title.'
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>