<?php if( $this->initial_template == '' ): ?>
<section>

    <div class="container">

        <div class="shop-menu ml-0 mr-0">

            <div class="row">

                <div class="col-sm-8">

                    <h6 class="upper">Displaying <?= $total ?> products</h6>

                </div>
<br/>
                <div class="col-sm-4">


                    <div class="form-select" id="idfilters">

                        <select class="form-control dropdown">

                            <option value="*" class="active">All </option>
                            <?php
                            
                            $i = 0;
                            $max = $totalcat;
                            if($category > 0) {
                              for($i; $i< $max; $i++) { ?>
                                   <option value=".<?php echo $category[$i]['category_name']; ?>"><?php echo $category[$i]['category_name']; ?></option>                             
                                
                             <?php }
                              
                            } ?>
                              

                        </select>

                    </div>

                </div>

            </div>

            <!-- end of row-->

        </div>

        <div class="row mini-shop" id="works">

            <?php
             if( count($product) > 0 ){
                foreach($product as $row){
                    
                    # check image or video
                    //$getFile = getAlbumFile($row['event_id'], 1);
                    if( $row['product_category'] != '' ){
                        $primaryIcon = '<img alt="'.$row['product_name'].'" src="'.base_url().'cms/'.$row['file'].'"/>';
                    }else{
                        $primaryIcon = '<img src="http://placehold.it/263x261"/>';
                    } 
                    
                    echo '
                    
           <div class="col-md-3 col-sm-6 work-item '.$row['category_name'].'">

                <div class="shop-product">

                    <div class="product-thumb">

                        <a href="'.base_url('shop/detail').'/'.$row['product_id'].'">

                          '.$primaryIcon.'

                        </a>

                        <div class="product-overlay">

                            <a href="'.base_url('shop/detail').'/'.$row['product_id'].'">'.$primaryIcon.'</a>

                        </div>

                    </div>

                    <div class="product-info">

                        <h4>'.$row['product_name'].'</h4><span>IDR '.$row['product_price'].'</span>

                    </div>

                </div>

            </div>';
                }
            }
            ?>                

        </div>

                            <div class="col-md-12">
                                <div class="icon-box-small outlined mb-25">
                                    <?= $desc['page_desc'] ?>
                                </div>
                            </div>        

        <!-- end of row-->
    </div>

</section>
<?php else: ?>
<section>
    <div class="container">
        <div class="row">
                       
                                        <?php
                                               if(count($productsing) > 0){
                
                                                        
                                                            if($productsing[0]['file'] != ''){
                                                            $primaryIcon = '<div class="item"><img alt="'.$productsing[0]['album_title'].'" src="'.base_url().'cms/'.$productsing[0]['file'].'"/></div>';
                                                            }else{ $primaryIcon = '';}
                                                            if($productsing[1]['file'] != ''){
                                                            $primaryIcon2 = '<div class="item"><img alt="'.$productsing[1]['album_title'].'" src="'.base_url().'cms/'.$productsing[1]['file'].'"/></div>';
                                                            }else{ $primaryIcon2 = '';}
                                                            if($productsing[2]['file'] != ''){
                                                            $primaryIcon3 = '<div class="item"><img alt="'.$productsing[2]['album_title'].'" src="'.base_url().'cms/'.$productsing[2]['file'].'"/></div>';
                                                            }else{ $primaryIcon3 = '';}
                                                            if($productsing[3]['file'] != ''){
                                                            $primaryIcon4 = '<div class="item"><img alt="'.$productsing[3]['album_title'].'" src="'.base_url().'cms/'.$productsing[3]['file'].'"/></div>';
                                                            }else{ $primaryIcon4 = '';}
                                                            if($productsing[4]['file'] != ''){
                                                            $primaryIcon5 = '<div class="item"><img alt="'.$productsing[4]['album_title'].'" src="'.base_url().'cms/'.$productsing[4]['file'].'"/></div>';
                                                            }else{ $primaryIcon5 = '';}
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
                                                            <h3 class="sub-title"><?php echo $productsing[0]['product_name']; ?></h3>
                                                            <?php echo $productsing[0]['product_desc']; ?>
                                                            

                                                            <br>

                                                            <h3 class="sub-title">IDR <?php echo $productsing[0]['product_price']; ?></h3>
<!--                                                             <ul class="list-details">
                                                                <li><b>Product Name : <?php echo $productsing[0]['product_name']; ?></li> 
                                                                <li><b>Categories</b> : <?php echo $productsing[0]['category_name']; ?></li>
                                                                <li><b>Price</b> : IDR <?php echo $productsing[0]['product_price']; ?></li>
                                                                <li><b>Order contact</b> : <?php echo $contact['contact_phone']; ?></li>
                                                            </ul> -->
                                                            <br>

                                                        </div>          
        </div>
    </div>
</section>
<?php endif; ?>
