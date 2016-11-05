<section>
    <div class="container">
        <div class="panel panel-login">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-4">
                        <a href="#" class="active" id="login-form-link">Benefit</a>
                    </div>
                    <div class="col-xs-4">
                        <a href="#" id="news-form-link">Terms &amp; Condition</a>
                    </div>
                    <div class="col-xs-4">
                        <a href="#" id="register-form-link">Register Now!</a>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">

                        <div id="login-form" class="active">
                            <br>
                            <div class="col-md-12 text-center">
                                <h2 class="head-underlined ">Benefit</h2>
                            </div>
                            <br>
                            <div class="col-sm-4">
                                <div class="icon-box-small outlined mb-25">
                                    
                                    <?php 
                                            if( $datadb > 0 ){
                                                foreach($datadb as $row){  
                                        echo '<h4>'.$row['titone'].' </h4>';
                                        echo '<hr>';                                                  
                                        echo $row['descone'];
                                              }
                                          }

                                    ?>
                                    
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="icon-box-small outlined mb-25">
                                    <?php 
                                            if( $datadb > 0 ){
                                                foreach($datadb as $row){  
                                        echo '<h4>'.$row['tittwo'].' </h4>';
                                        echo '<hr>';                                                  
                                        echo $row['desctwo'];

                                              }
                                          }

                                    ?>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="icon-box-small outlined mb-25">
                                    <?php 
                                            if( $datadb > 0 ){
                                                foreach($datadb as $row){  
                                        echo '<h4>'.$row['tittri'].' </h4>';
                                        echo '<hr>';                                                  
                                        echo $row['desctri'];
                                              }
                                          }

                                    ?>
                                </div>
                            </div>
                            <div class="section-content">
                                <div class="row">
                                    <div class="col-md-10 col-md-offset-1">
                                        <div class="row">
                                        <br/><br/>
                                        <?= $datadb3['desc'] ?>    
                                        </div>
                                    </div>
                                </div>
                                <!-- end of row-->
                            </div>
                        </div>


                        <form id="register-form" action="<?php echo base_url('membership') ?>" method="post" role="form" style="display: none;">
                            <div class="row">
                                <div class="col-md-12">
                                    <h2 class="head-underlined">Membership Application</h2>
                                                    <!-- OUTPUT MESSAGE -->
                                            <?= $this->messagecontroll->showMessage() ?>
                                                <!-- OUTPUT MESSAGE -->
                                </div>
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h4 class="form-heading">About You</h4>

                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <!--<label class="control-label">Name</label>-->
                                                <input type="text" name="first_name" placeholder="First Name" class="form-control input-sm">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <!--<label class="control-label">Name</label>-->
                                                <input type="text" name="last_name" placeholder="Last Name" class="form-control input-sm">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <!--<label class="control-label">Name</label>-->
                                                <input type="text" name="no_member" placeholder="Members No." class="form-control input-sm">
                                            </div>
                                        </div> 
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="address" placeholder="Address" class="form-control input-sm">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="province" placeholder="City / Provice" class="form-control input-sm">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="zipcode" placeholder="Post Code" class="form-control input-sm">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="ktp" placeholder="National ID" class="form-control input-sm">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="sim" placeholder="Driver License" class="form-control input-sm">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="phone" placeholder="Mobile No." class="form-control input-sm">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="home_phone" placeholder="Home No." class="form-control input-sm">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="office" placeholder="Office No." class="form-control input-sm">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="email" placeholder="E-mail" class="form-control input-sm">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="blood_type" placeholder="Blood Type" class="form-control input-sm">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="tsize" placeholder="T-shirt Size" class="form-control input-sm">
                                            </div>
                                        </div>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 


                                        <div class="col-md-12">
                                            <h4 class="form-heading mini">About Your MINIS</h4>
                                        </div>
                                        <div class="form-car">

                                    <?php
                                                for($i=0; $i<3; $i++){
                                                     
                                                    $removeLink = '';
                                                    $fieldPid   = '';     
                                                    
                                                    echo '
                                            <div class="uk-width-1-5">
                                                <div class="col-sm-2">
                                                    <div class="form-group">
                                                        <input type="text" name="seri_mc'.$i.'" placeholder="Seri MC" class="form-control input-sm"  />
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-group">
                                                        <input type="text" name="year'.$i.'" placeholder="Years" class="form-control input-sm" />
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-group">
                                                        <input type="text" name="license_plate'.$i.'" placeholder="Plate No." class="form-control input-sm" />
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <input type="text" name="chasis_no'.$i.'" placeholder="Chasis No." class="form-control input-sm" />
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <input type="text" name="engine_no'.$i.'" placeholder="Engine No." class="form-control input-sm" />
                                                    </div>
                                                </div>
                                            </div>';   
                                                }
                                                ?>

                                        </div>

                                        <div class="col-md-12 text-right">
                                            <a href="<?= $datadb3['form_url'] ?>" class="btn btn-color black"><i class="ti-download"></i> DOWNLOAD FORM</a>
                                            <button type="submit" class="btn btn-color">SUBMIT</button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </form>
                        <div id="news-form" style="display:none">
                            <div class="col-md-12 text-center">
                                <h2 class="head-underlined ">Terms &amp; Condition</h2>
                            </div>
                            <div class="col-md-8 col-md-offset-2">
                                <div class="post-body text-justify">
                                    <?= $datadb2['desc'] ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>