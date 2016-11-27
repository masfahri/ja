<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
    <meta http-equiv="x-ua-compatible" content="IE=edge">
    <title>PDI Perjuangan</title>
    <link rel="shortcut icon" type="image/x-icon" href="<?= config_item('assets_img') ?>favicon.ico" />
    <link rel="stylesheet" href="<?= $weburl_css ?>style.css" />
    <link rel="me" href="https://dev.twitter.com/">
  </head>

  <body>
    <div class="wrapper">
      
      <!-- CONTENTS HERE -->
      	<div class="main grey">
    		<div class="row">
    			<div class="columns large-12 medium-7" style="margin-top: -80px;">
    				<div class="content" itemscope itemtype="https://schema.org/BlogPosting">
    					<article class="event article-single-event">
    						<div class="event-box">
    							<div class="event-image">
    								<div class="event-slider">
    									<div class="slider-clip">
                                            <?php if( $datadb['file'] !== "true" ): ?>
                                            <img src="<?= base_url().$datadb['file'] ?>" alt="" />
                                            <?php else: ?>
                                           
                                            <div id="pvideo">
                                                <iframe width="100%" height="450" src="https://www.youtube.com/embed/<?= $datadb['video'] ?>" frameborder="0" allowfullscreen></iframe>
                                            </div>
                                            <?php endif; ?>
    										
    									</div><!-- /.slider-clip -->
    								</div><!-- /.event-slider -->
    							</div><!-- /.event-image -->
    							
    							<div class="event-meta">
    								<ul class="list-event-meta">
                                        <li>
											<a href="#" itemprop="url">
												<i class="fa fa-user"></i>
												<?= $datadb['nickname'] ?>
											</a>
										</li>
										
										<li>
											<a href="#" itemprop="url">
												<i class="fa fa-map-marker"></i>
												<?= $datadb['blog_category_name'] ?>, <?= $datadb['provinsi_name'] ?>
											</a>
										</li>
										
										<li>
											<a href="#" itemprop="url">
												<i class="fa fa-share-alt"></i>
												share
											</a>
										</li>
										
										<li>
											<a href="#" class="link" itemprop="url">
												<i class="fa fa-plus"></i>
												SELENGKAPNYA
											</a>
										</li>
    									
    								</ul>
    							</div><!-- /.event-meta -->
    
    							<div class="event-body" itemprop="articleBody">
                                     <h2><?= $datadb['blog_title'] ?></h2>
                                     <?= $datadb['blog_description'] ?>
    							</div><!-- /.event-body -->
    						</div><!-- /.event-box -->
                                <div class="detail-share">
                                    <li class="ds-heart"><a href="javascript:;"><span class="fa fa-heart"></span><span class="h-text">Like</span><span class="h-count">0</span></a></li>
                                    <li class="ds-facebook"><a href="javascript:;"><span class="fa fa-facebook"></span>Share</a></li>
                                    <li class="ds-twitter"><a href="javascript:;"><span class="fa fa-twitter"></span>Tweet</a></li>
                                </div>
    					</article><!-- /.event article-single-event -->
    				</div><!-- /.content -->
    			</div><!-- /.columns large-8 -->
    		</div><!-- /.row -->
          </div>
          <!-- /.main -->

      <!-- ============= -->
      

    </div>
    <!-- /.wrapper -->
    <script src="<?= $weburl_js ?>vendor.js"></script>
    <script src="<?= $weburl_js ?>jquery.stellar.min.js"></script>
    <script src="<?= $weburl_js ?>app.js"></script>
    <script src="<?= $weburl_js ?>jquery-1.11.3.min.js"></script>
		<script src="<?= $weburl_js ?>easyResponsiveTabs.js"></script>
		<script src="<?= $weburl_js ?>jquery.datetimepicker.js"></script>
		<script>
		$(document).ready(function() {
			if ( $('#form-tab').length ) {
				$('#form-tab').easyResponsiveTabs({
				    type: 'default', //Types: default, vertical, accordion
				    width: 'auto', //auto or any width like 600px
				    fit: true, // 100% fit in a container
				    tabidentify: 'hor_1', // The tab groups identifier
				    
				});
				function readURL(input, testingPrev) {
				    if (input.files && input.files[0]) {
				        var reader = new FileReader();
				        var $testing = testingPrev;
				        reader.onload = function (e) {
				            $($testing).attr('src', e.target.result);
				        }
				        reader.readAsDataURL(input.files[0]);
				    }
				}
				$('#scan-ktp').change(function(){
				    readURL(this, '#scan-ktp-prev');
				});
				$('#scan-foto').change(function(){
				    readURL(this, '#scan-foto-prev');
				});
				$('#datetimepicker').datetimepicker({
					timepicker: false,
					format:'d-m-Y',
					maxDate: 0,
					todayButton: false,
					timepickerScrollbar: false,
					yearEnd: 2015,
					scrollInput: false,
					startDate:'1970/01/01'
				});
			}
			
		});
				
		</script>
    

  </body>

</html>

      
      