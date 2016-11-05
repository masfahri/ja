     <?php if($this->initial_template == 'category'): ?>
      <div class="page-title-container">
            <div class="container">
                <div class="page-title pull-left">
                    <?php
                    if( cleanDash($this->uri->segment(3)) == 'all')$leftTitle = 'All Category';
                    else $leftTitle = cleanDash($this->uri->segment(3));
                    ?>
                    <h2 class="entry-title"><?= $leftTitle ?></h2>
                </div>
                <ul class="breadcrumbs pull-right">
                    <li><a href="#">CHARTER</a></li>
                    <li class="active"><?= $leftTitle ?></li>
                </ul>
            </div>
        </div>
        <section id="content">
            <div class="container">
                <div id="main">
                    <div class="row">
                          <div class="col-sm-10 col-md-12">
                             <div class="cruise-list image-box style3 cruise listing-style1">
                                <div class="row">
                                     <?php
                                     if( count($db_product) > 0 ){
                                        foreach($db_product as $row){
                                            
                                            # Product Image
                                            $productImg = getDataProductImage($row['product_id'], 1);
                                            
                                            echo '
                                            <div class="col-sm-6 col-md-4">
    			                                <article class="box">
    			                                    <figure class="animated" data-animation-type="fadeInDown" data-animation-delay="0">
    			                                        <a href="'.base_url('product').'/detail/'.$row['product_id'].'/'.parseUrl($row['product_name']).'" class="hover-effect"><img width="270" height="160" alt="" src="'.base_url('cms').'/'.$productImg['file'].'" alt="'.$row['product_name'].'"></a>
    			                                    </figure>
    			                                    <div class="details">
    			                                        <h3 class="box-title feedback">'.$row['product_name'].'</h3>
    
    			                                        <div class="row time">
    			                                            <div class="friends col-xs-6">
                                                                <i class="soap-icon-cruise-2 yellow-color"></i>
    			                                                <div class="short-title">
    			                                                    <span class="skin-color">'.$row['product_category'].'</span><br />
    			                                                </div>
    			                                            </div>
    			                                            <div class="departure col-xs-6">
    			                                                <i class="soap-icon-departure yellow-color"></i>
    			                                                <div class="short-title">
    			                                                    <span class="skin-color">'.$row['location'].'</span>
    			                                                </div>
    			                                            </div>
    			                                        </div>
    			                                       <div class="action">
    			                                            <a href="'.base_url('product').'/detail/'.$row['product_id'].'/'.parseUrl($row['product_name']).'" class="button btn-small full-width" >Detail</a>
    			                                        </div>
    			                                    </div>
    			                                </article>
    			                            </div>';
                                        }
                                     }
                                     ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-10 col-md-12">
                            <!-- PAGINATION -->
                            <?=  $this->pagination->create_links() ?>
                            <!-- ========= -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
      
     <?php else: ?>
     
          <section id="content">
            <div class="container">
                <div class="row">
                    <div id="main" class="col-md-9">
                        <div class="tab-container style1" id="cruise-main-content">
                            <ul class="tabs">
                                <li class="active"><a data-toggle="tab" href="#photos-tab">photos</a></li>
                                <li><a data-toggle="tab" href="#calendar-tab">calendar</a></li>
                            </ul>
                            <div class="tab-content">
                                <div id="photos-tab" class="tab-pane fade in active">
                                    <!-- primary image dan multi image -->
                                    <?php
                                    $dataProduct = getDataProductImage($datadb['product_id']);
                                    if(count($dataProduct) > 0){
                                        $primary = '';
                                        $multi   = '';
                                        $no = 0;
                                        foreach($dataProduct as $row){
                                            if($no == 0){
                                                $primary .= '<li><img src="'.base_url().'cms/'.$row['file'].'" alt="'.$datadb['product_name'].'" /></li>';
                                            }else{
                                                $multi   .= '<li><img src="'.base_url().'cms/'.$row['file'].'" alt="'.$datadb['product_name'].'" /></li>';
                                            }
                                            $no++;
                                        }
                                    }
                                    ?>
                                    <!-- ============================= -->
                                    <div class="photo-gallery style1" data-animation="slide" data-sync="#photos-tab .image-carousel">
                                        <ul class="slides">
                                            <?= $primary ?>
                                        </ul>
                                    </div>
                                    <div class="image-carousel style1" data-animation="slide" data-item-width="70" data-item-margin="10" data-sync="#photos-tab .photo-gallery">
                                        <ul class="slides">
                                              <?= $multi ?>
                                        </ul>
                                    </div>
                                </div>
                                <div id="calendar-tab" class="tab-pane fade">
                                    <label>SELECT MONTH</label>
                                    <div class="col-sm-6 col-md-4 no-float no-padding">
                                        <div class="selector">
                                            <select class="full-width" id="select-month">
                                                <option value="2015-6">June 2015</option>
                                                <option value="2015-7">July 2015</option>
                                                <option value="2015-8">August 2015</option>
                                                <option value="2015-9">September 2015</option>
                                                <option value="2015-10">October 2015</option>
                                                <option value="2015-11">November 2015</option>
                                                <option value="2015-12">December 2015</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <div class="calendar"></div>
                                            <div class="calendar-legend">
                                                <label class="available">available</label>
                                                <label class="unavailable">unavailable</label>
                                                <label class="past">past</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <p class="description">
                                                The calendar is updated every five minutes and is only an approximation of availability.
<br /><br />
Some hosts set custom pricing for certain days on their calendar, like weekends or holidays. The rates listed are per day and do not include any cleaning fee or rates for extra people the host may have for this listing. Please refer to the listing's Description tab for more details.
<br /><br />
We suggest that you contact the host to confirm availability and rates before submitting a reservation request.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div id="cruise-features" class="tab-container">
                            <ul class="tabs">
                                <li class="active"><a href="#yacht-description" data-toggle="tab">Description</a></li>
                                  <li><a href="#yacht-feature" data-toggle="tab">Feature</a></li>
                                <li><a href="#yacht-availability" data-toggle="tab">Availability</a></li>
                              
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="yacht-description">
                                    <div class="intro table-wrapper full-width hidden-table-sms">
                                      
                                    </div>
                                    <div class="long-description">
                                         <?= $datadb['product_desc'] ?>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="yacht-availability">
                                    <div class="border-box travelo-box clearfix">
                                        <form class="update-search-form">
                                            <div class="form-group col-xs-6 col-md-4">
                                                <label>From</label>
                                                <div class="datepicker-wrap">
                                                    <input type="text" class="input-text full-width" placeholder="dd/mm/yyyy">
                                                </div>
                                            </div>
                                            <div class="form-group col-xs-6 col-md-4">
                                                <label>TO</label>
                                                <div class="datepicker-wrap">
                                                    <input type="text" class="input-text full-width" placeholder="dd/mm/yyyy">
                                                </div>
                                            </div>
                                           
                                            <div class="form-group col-xs-4 col-md-4">
                                                <label>&nbsp;</label>
                                                <button type="submit" class="icon-check full-width">PROCEED</button>
                                            </div>
                                        </form>
                                    </div>
                                    
                                </div>
                                <div class="tab-pane fade" id="yacht-feature">
                                   <?= $datadb['product_spec'] ?>
                                    
                                </div>
                            </div>
                        
                        </div>
                    </div>
                    <div class="sidebar col-md-3">
                    
                        <!-- right bar (other_charter) -->
                        <?php $this->load->view('other_charter'); ?>
                        <!-- ======================== -->
                        
                        <div class="travelo-box contact-box">
                            <h4>Need Help?</h4>
                            <p>We would be more than happy to help you. Our team advisor are 24/7 at your service to help you.</p>
                            <address class="contact-details">
                                <?php
                                $pContact = getDataContact();
                                ?>
                                <span class="contact-phone"><i class="soap-icon-phone"></i> <?= $pContact['contact_phone'] ?>-HELLO</span>
                                <br>
                                <a class="contact-email" href="mailto:<?= $pContact['contact_email'] ?>"><?= $pContact['contact_email'] ?> </a>
                            </address>
                        </div>
                         
                    </div>
                </div>
            </div>
        </section>
        
     

     <?php endif; ?>
     
     
