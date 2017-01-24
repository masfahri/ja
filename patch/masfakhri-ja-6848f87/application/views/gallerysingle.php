<section class="content">
	<div class="container">
		<div class="row">
                       
                                        <?php
                                               $getCollection = getAlbumFile($datadb[0]['gallery_album_id']);
                                               if(count($getCollection) > 0){
                                                    foreach($getCollection as $row){
                                                        
                                                        if( $row['type'] == 'image' ){
                                                            $primaryIcon = '<img alt="'.$datadb[0]['album_title'].'" src="'.base_url().'cms/'.getThumbnailsImage($row['file'], $row['extention']).'"/>';
                                                            $primaryIcon2 = '<img alt="'.$datadb[0]['album_title'].'" src="'.base_url().'cms/'.getThumbnailsImage($row['file2'], $row['extention2']).'"/>';
                                                            $primaryIcon3 = '<img alt="'.$datadb[0]['album_title'].'" src="'.base_url().'cms/'.getThumbnailsImage($row['file3'], $row['extention3']).'"/>';
                                                            $primaryIcon4 = '<img alt="'.$datadb[0]['album_title'].'" src="'.base_url().'cms/'.getThumbnailsImage($row['file4'], $row['extention4']).'"/>';

                                                        }else{
                                                            $primaryIcon = '';
                                                        } 
                                                        echo '
															<div class="col-md-8">
																<div class="big-images">
																	<div class="item">'.$primaryIcon.'</div>
																	<div class="item">'.$primaryIcon2.'</div>
																	<div class="item">'.$primaryIcon3.'</div>
																	<div class="item">'.$primaryIcon4.'</div>
																</div>
																<br/>
																<div class="thumbs">
																	<div class="item">'.$primaryIcon.'</div>
																	<div class="item">'.$primaryIcon2.'</div>
																	<div class="item">'.$primaryIcon3.'</div>
																	<div class="item">'.$primaryIcon4.'</div>
																</div>	
															</div>
														<div class="col-md-4">
															<h3 class="sub-title">Description Photo</h3>
															<p>'.$datadb[0]['album_description'].'
															</p>

															<br>

															<h3 class="sub-title">Photo details</h3>
															<ul class="list-details">
																<li><b>Gallery Name : '.$datadb[0]['album_name'].'</li> 
																<li><b>Date</b> : '.$datadb[0]['date'].'</li>
																<li><b>Place</b> : '.$datadb[0]['album_title'].'</li>
															</ul>
															<br>

														</div>

                                                        ';
                                                    }
                                               }
                                               ?>			
		</div>
	</div>
</section>