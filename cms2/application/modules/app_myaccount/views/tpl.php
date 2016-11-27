<!-- Page Content -->
<div class="md-card">
    <div class="md-card-content">
        <div class="md-card-content">
            <h3 class="heading_a">Edit Profile</h3>
            <hr/>
            <!-- OUTPUT MESSAGE -->
            <?= $this->messagecontroll->showMessage() ?>
                <!-- OUTPUT MESSAGE -->
                <form action="<?= base_url( $this->app_name ).'/editProfile/' ?>" method="post" enctype="multipart/form-data">
                <div class="uk-grid">
                    <div class="uk-width-medium-1-1 uk-row-first">
                        <div class="user_heading_avatar">
                                <div class="thumbnail">
                                        <?php
                                        if( file_exists( getThumbnailsImage($datadb['image'], $datadb['extention']) ) ){
                                            echo '<img src="'.base_url().getThumbnailsImage($datadb['image'], $datadb['extention']).'"/>';
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
                                    Select
                                    <input id="form-file" type="file" name="fileupl" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    <div class="uk-grid" data-uk-grid-margin="">
                        <div class="uk-width-medium-1-1 uk-row-first">
                            <div class="uk-form-row">
                                <div class="md-input-wrapper">
                                    <input type="text" name="nickname" value="<?= rebackPost('nickname', $datadb['nickname']) ?>" placeholder="Full Name" class="md-input" /><span class="md-input-bar"></span></div>

                            </div>
                            <div class="uk-form-row">
                                <div class="md-input-wrapper">
                                    <input type="text" name="username" value="<?= rebackPost('username', $datadb['username']) ?>" placeholder="Username / Email ID" class="md-input" /><span class="md-input-bar"></span></div>

                            </div>
                            <div class="uk-form-row">
                                <div class="md-input-wrapper">
                                    <input type="password" name="password" value="" placeholder="Enter password" class="md-input"><span class="md-input-bar"></span></div>

                            </div>
                            <div class="uk-form-row">
                                <div class="md-input-wrapper">
                                    <input type="password" name="repassword" value="" placeholder="Enter confirm password" class="md-input"><span class="md-input-bar"></span></div>

                            </div>
                            <div class="uk-width-large-1-4 uk-width-medium-2-2 uk-grid-margin uk-row-first">
                                <div class="uk-input-group">
                                    <button class="md-btn md-btn-primary md-btn-wave-light waves-effect waves-button waves-light">Edit</button>
                                    <a href="javascript:window.history.go(-1);" class="md-btn md-btn-danger md-btn-wave-light waves-effect waves-button waves-light">Cancel</a>
                                </div>
                            </div>
                        </div>
                </form>
                </div>
        </div>
    </div>
</div>

<!-- End Container -->