    <div class="login_page_wrapper">
        <div class="md-card" id="login_card">
            <div class="md-card-content large-padding" id="login_form">
                <div class="login_heading">
                    <div class="user_avatar"></div>
                    <!-- OUTPUT MESSAGE -->
		            <?= $this->messagecontroll->showMessage() ?>
		            <!-- OUTPUT MESSAGE -->
                </div>
                <form action="<?= base_url('app_login').'/authentication' ?>" method="post">
                    <div class="uk-form-row">
                        <label for="login_username">Username</label>
                        <input class="md-input" type="text" id="login_username" name="username" value="<?= set_value('username') ?>" />
                    </div>
                    <div class="uk-form-row">
                        <label for="login_password">Password</label>
                        <input class="md-input" type="password" id="login_password" name="password"  />
                    </div>
                    <div class="uk-margin-medium-top">
                    	<button class="md-btn md-btn-primary md-btn-block md-btn-large">Sign In</button>
                    </div>
                    <div class="uk-margin-top">
                        <span class="icheck-inline">
                            <input type="checkbox" name="login_page_stay_signed" id="login_page_stay_signed" data-md-icheck />
                            <label for="login_page_stay_signed" class="inline-label">Stay signed in</label>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>

