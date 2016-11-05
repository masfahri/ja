<!-- Page Content -->
<div class="md-card" data-uk-grid-margin>
    <div class="md-card-content">
        <h3 class="heading_a">Settings</h3>
        <hr/>
        <ul class="uk-tab" data-uk-tab="{connect:'#tabs_anim1', animation:'scale'}">
            <li class="uk-active"><a href="#">Website Settings</a></li>
            <li><a href="#">Website Contact</a></li>
            <li><a href="#">Website Social Media</a></li>
        </ul>
        <ul id="tabs_anim1" class="uk-switcher uk-margin">
            <li>
                <!-- OUTPUT MESSAGE -->
                <?= $this->messagecontroll->showMessage() ?>
                    <!-- OUTPUT MESSAGE -->
                    <?php if( $this->initial_template == '' ): ?>
                        <form action="<?= base_url('app_websetup') ?>" method="post" enctype="multipart/form-data">
                            <div class="uk-grid">
                                <div class="uk-width-medium-1-1">
                                    <select id="select_demo_1" data-md-selectize name="status" onchange="websiteReboot(this)">
                                        <option value="">Website Status</option>
                                        <?php
                                        $dataStatus =  array('enable', 'disable');
                                        foreach($dataStatus as $row){
                                            if( $row == rebackPost('status', $datadb['status']) )$sel = 'selected';
                                            else $sel = '';

                                            echo '<option value="'.$row.'">'.$row.'</option>';
                                        }
                                    ?>
                                    </select>
                                </div>
                            </div>
                            <div class="uk-grid">
                                <div class="uk-width-medium-1-1">
                                    <select id="select_demo_2" data-md-selectize name="active_lang">
                                        <option value="">Website language</option>
                                        <?php
                                        foreach($datadb_lang as $row){
                                            
                                            if( $row['countries_id'] == $datadb['active_lang'] )$sel = 'selected';
                                            else $sel = '';
                                            
                                            echo '<option value="'.$row['countries_id'].'" '.$sel.'>'.$row['countries_name_flag'].'</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="uk-grid">
                                <div class="uk-width-medium-1-1 uk-row-first">
                                    <div class="user_heading_avatar">
                                        <div class="thumbnail">
                                            <?php
                                            if( file_exists( getThumbnailsImage($datadb['file'], $datadb['extention']) ) ){
                                                echo '<img src="'.base_url().getThumbnailsImage($datadb['file'], $datadb['extention']).'"/>';
                                            }else{
                                                echo '<img src="'.base_url().'"assets/img/avatars/avatar_11.png"/>';
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <span>&nbsp;</span>
                                    <div class="uk-grid">
                                        <div class="uk-width-1-1">
                                            <div class="uk-form-file md-btn md-btn-primary">
                                                Select Website logo
                                                <input id="form-file" type="file" name="fileupl" />
                                            </div>
                                            <p>File image must be in extention <b>(JPG, JPEG, PNG)</b> </p>
                                            <p>File image must be in size <b>( 110 x  94 )</b> </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="uk-grid">
                                <div class="uk-width-medium-1-1 uk-row-first">
                                    <div class="user_heading_avatar">
                                        <div class="thumbnail">
                                            <?php
                                            if( file_exists( $datadb['favicon'] ) ){
                                                echo '<img src="'.base_url().$datadb['favicon'].'"/>';
                                            }else{
                                                echo '<div class="no-image"><span class="glyphicon glyphicon-picture"></span></div>';
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <span>&nbsp;</span>
                                    <div class="uk-grid">
                                        <div class="uk-width-1-1">
                                            <div class="uk-form-file md-btn md-btn-primary">
                                                Select Website Favicon
                                                <input id="form-file" type="file" name="fileico" />
                                            </div>
                                            <p>File image must be in extention <b>(png)</b> </p>
                                            <p>File image must be in size <b>( 32 x  32 )</b> </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="uk-grid">
                                <div class="uk-width-medium-1-1">
                                    <h3 class="heading_a uk-margin-medium-bottom">Google Analytics</h3>
                                    <div class="uk-form-row">
                                        <textarea cols="30" rows="4" class="md-input" name="google_analytics">
                                            <?= $datadb['google_analytics'] ?>
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="uk-width-large-1-4 uk-width-medium-2-2 uk-grid-margin uk-row-first">
                                <div class="uk-input-group">
                                    <button class="md-btn md-btn-primary md-btn-wave-light waves-effect waves-button waves-light">Save</button>
                                    <a href="javascript:window.history.go(-1);" class="md-btn md-btn-danger md-btn-wave-light waves-effect waves-button waves-light">Cancel</a>
                                </div>
                            </div>
                        </form>
                        <?php endif; ?>
            </li>
            <li>
                <!-- OUTPUT MESSAGE -->
                <?= $this->messagecontroll->showMessage() ?>
                    <!-- OUTPUT MESSAGE -->
                    <?php if( $this->initial_template == '' ): ?>
                        <form action="<?= base_url('app_websetup').'/contact' ?>" method="post" enctype="multipart/form-data">
                            <div class="uk-grid">
                                <div class="uk-width-medium-1-1">
                                    <label>Use delimiter <b>( # )</b> if you have more than 1 email address,</label>
                                    <label><b>Example: email1@yahoo.com#email2@gmail.com</b></label>
                                    <span>&nbsp;</span>
                                    <input class="md-input" type="text" style="width:90%" name="contact_email" value="<?= $datadb2['contact_email'] ?>" />
                                </div>
                            </div>
                            <div class="uk-grid">
                                <div class="uk-width-medium-1-1">
                                    <label>Contact Phone</label>
                                    <span>&nbsp;</span>
                                    <input class="md-input" type="text" style="width:90%" name="contact_phone" value="<?= $datadb2['contact_phone'] ?>" />
                                </div>
                            </div>
                            <div class="uk-grid">
                                <div class="uk-width-medium-1-1">
                                    <label>Office Address</label>
                                    <span>&nbsp;</span>
                                    <textarea id="wysiwyg_tinymce" cols="30" rows="5" name="contact_office">
                                        <?= $datadb2['contact_office'] ?>
                                    </textarea>
                                </div>
                            </div>
                            <div class="uk-width-large-1-4 uk-width-medium-2-2 uk-grid-margin uk-row-first">
                                <div class="uk-input-group">
                                    <button class="md-btn md-btn-primary md-btn-wave-light waves-effect waves-button waves-light">Save</button>
                                    <a href="javascript:window.history.go(-1);" class="md-btn md-btn-danger md-btn-wave-light waves-effect waves-button waves-light">Cancel</a>
                                </div>
                            </div>
                        </form>
                        <?php endif; ?>
            </li>
            <li>
                <?= $this->messagecontroll->showMessage() ?>
                    <!-- OUTPUT MESSAGE -->
                <?php if( $this->initial_template == '' ): ?>
                    <br/>
                    <form action="<?= base_url('app_websetup/social') ?>" method="post" enctype="multipart/form-data">    
                        <div class="uk-width-medium-1-1">
                            <div class="uk-form-row">
                                <div class="uk-grid">
                                    <div class="uk-width-medium-1-3">
                                        <label class="uk-icon-hover uk-icon-facebook">&nbsp;Facebook</label>
                                        <input value="<?= rebackPost('facebook', $datadb3['facebook'])  ?>" type="text" class="md-input" name="facebook" />
                                    </div>
                                    <div class="uk-width-medium-1-3">
                                        <label class="uk-icon-hover uk-icon-twitter">&nbsp;Twitter</label>
                                        <input value="<?= rebackPost('twitter', $datadb3['twitter'])  ?>" type="text" class="md-input" name="twitter" />
                                    </div>
                                    <div class="uk-width-medium-1-3">
                                        <label class="uk-icon-hover uk-icon-google-plus">&nbsp;Google</label>
                                        <input value="<?= rebackPost('google', $datadb3['google'])  ?>" type="text" class="md-input" name="google" />
                                    </div>
                                </div>
                            </div>
                            <div class="uk-form-row">
                                <label class="uk-icon-hover uk-icon-instagram">&nbsp;Instagram</label>
                                <input value="<?= rebackPost('instagram', $datadb3['instagram'])  ?>" type="text" class="md-input" name="instagram" />
                            </div>
                            <div class="uk-form-row">
                                <label class="uk-icon-hover uk-icon-youtube">&nbsp;Youtube</label>
                                <input value="<?= rebackPost('youtube', $datadb3['youtube'])  ?>" type="text" class="md-input" name="youtube" />
                            </div>
                            <div class="uk-width-large-1-4 uk-width-medium-2-2 uk-grid-margin uk-row-first">
                                    <div class="uk-input-group">
                                        <button class="md-btn md-btn-primary md-btn-wave-light waves-effect waves-button waves-light">Save</button>
                                        <a href="javascript:window.history.go(-1);" class="md-btn md-btn-danger md-btn-wave-light waves-effect waves-button waves-light">Cancel</a>
                                    </div>
                                </div>
                        </div>
                    </form>
                <?php endif; ?>
            </li>
        </ul>
    </div>
</div>

    <!-- End Container -->