<!-- Page Content -->
<div class="md-card" data-uk-grid-margin>
    <div class="md-card-content">
        <h3 class="heading_a">About Page</h3>
        <hr/>
        <ul class="uk-tab" data-uk-tab="{connect:'#tabs_anim1', animation:'scale'}">
            <li class="<?=($this->uri->segment(2)==='')?'uk-active':''?>"><a href="#">About</a></li>
            <li class="<?=($this->uri->segment(2)==='' || $this->uri->segment(2)==='officers' || $this->uri->segment(2)==='officersAdd' || $this->uri->segment(2)==='officersEdit')?'uk-active':''?>"><a href="#">Officers</a></li>
            <li class="<?=($this->uri->segment(2)==='' || $this->uri->segment(2)==='sponsors' || $this->uri->segment(2)==='sponsorsAdd' || $this->uri->segment(2)==='sponsorsEdit')?'uk-active':''?>"><a href="#">Sponsors</a></li>
        </ul>
        <ul id="tabs_anim1" class="uk-switcher uk-margin">
            <li>
                <!-- OUTPUT MESSAGE -->
                <?= $this->messagecontroll->showMessage() ?>
                    <!-- OUTPUT MESSAGE -->
                    <?php if( $this->initial_template == '' ): ?>
                    <form action="<?= base_url('app_about') ?>" method="post" enctype="multipart/form-data">
                        <div class="uk-grid">
                            <div class="uk-width-medium-1-1">
                                <div class="uk-form-row">
                                    <textarea cols="30" rows="4" class="md-input" name="desc">
                                        <?= $datadb2['desc'] ?>
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
                    <?php if( $this->initial_template == '' || $this->initial_template == 'officers' ): ?>
                    <table class="uk-table uk-table-align-vertical uk-table-nowrap tablesorter tablesorter-altair" id="ts_issues">
                        <thead>
                            <tr>
                                <th class="uk-text-center">ID</th>
                                <th>Name</th>
                                <th>Jobs</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th class="uk-text-center">ID</th>
                                <th>Name</th>
                                <th>Jobs</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php 
                        if( count($datadb) > 0 ){
                            foreach($datadb as $row){                         
                                echo '                    
                                    <tr>
                                        <td class="uk-text-center"><span class="uk-text-small uk-text-muted uk-text-nowrap">'.$row['id'].'</span></td>
                                        <td>
                                            <a href="'.base_url($this->app_name).'/officersEdit/'.$row['id'].'">'.$row['name'].'</a>
                                        </td>
                                        <td>'.$row['jobs'].'</td>
                                    </tr>';
                            }}else{
                                echo '
                                    <tr>
                                        <td class="uk-text-center"><span class="uk-text-small uk-text-muted uk-text-nowrap"></span></td>
                                        <td>
                                           <span class="uk-text-danger">Tidak ada data</span>
                                        </td>
                                        <td></td>                                       
                                    </tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                    <div class="md-fab-wrapper">
                        <a class="md-fab md-fab-accent" href="<?= base_url($this->app_name) ?>/officersAdd">
                            <i class="material-icons">&#xE145;</i>
                        </a>
                    </div>
                    <?php elseif( $this->initial_template == '' || $this->initial_template == 'officersAdd' ): ?>
                    <form action="<?= base_url('app_about/officersAdd') ?>" method="post" enctype="multipart/form-data">
                        <div class="uk-grid">
                            <div class="uk-width-medium-1-1 uk-row-first">
                                <div class="user_heading_avatar">
                                    <div class="thumbnail">
                                        <?php
                                            if( file_exists( getThumbnailsImage($datadb['file'], $datadb['extention']) ) ){
                                                echo '<img src="'.base_url().getThumbnailsImage($datadb['file'], $datadb['extention']).'"/>';
                                            }else{
                                                echo '<img src="http://placehold.it/110x94"/>';
                                            }
                                            ?>
                                    </div>
                                </div>
                                <span>&nbsp;</span>
                                <div class="uk-grid">
                                    <div class="uk-width-1-1">
                                        <div class="uk-form-file md-btn md-btn-primary">
                                            Select photo
                                            <input id="form-file" type="file" name="file" />
                                        </div>
                                        <p>File image must be in extention <b>(JPG, JPEG, PNG)</b> </p>
                                        <p>File image must be in size <b>( 110 x  94 )</b> </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="uk-margin-medium-bottom">
                            <label for="event_name">Name</label>
                            <input type="text" class="md-input" id="name" name="name" />
                        </div>
                        <div class="uk-grid">
                            <div class="uk-width-medium-1-1">
                                <div class="uk-form-row">
                                    <textarea cols="30" rows="4" class="md-input" name="jobs">
                                        <?= $datadb['jobs'] ?>
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
                    <?php elseif( $this->initial_template == 'officersEdit' ): ?>
                    <form action="<?= base_url('app_about/officersEdit') ?>" method="post" enctype="multipart/form-data">
                        <div class="uk-grid">
                            <div class="uk-width-medium-1-1 uk-row-first">
                                <div class="user_heading_avatar">
                                    <div class="thumbnail">
                                        <?php
                                            if( file_exists( getThumbnailsImage($datadb['file'], $datadb['extention']) ) ){
                                                echo '<img src="'.base_url().getThumbnailsImage($datadb['file'], $datadb['extention']).'"/>';
                                            }else{
                                                echo '<img src="http://placehold.it/110x94"/>';
                                            }
                                            ?>
                                    </div>
                                </div>
                                <span>&nbsp;</span>
                                <div class="uk-grid">
                                    <div class="uk-width-1-1">
                                        <div class="uk-form-file md-btn md-btn-primary">
                                            Select photo
                                            <input id="form-file" type="file" name="file" />
                                        </div>
                                        <p>File image must be in extention <b>(JPG, JPEG, PNG)</b> </p>
                                        <p>File image must be in size <b>( 110 x  94 )</b> </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="uk-margin-medium-bottom">
                            <label for="event_name">Name</label>
                            <input type="text" class="md-input" id="name" name="name" value="<?= rebackPost('name', $datadb['name']) ?>" />
                        </div>
                        <div class="uk-grid">
                            <div class="uk-width-medium-1-1">
                                <div class="uk-form-row">
                                    <textarea cols="30" rows="4" class="md-input" name="jobs">
                                        <?= $datadb['jobs'] ?>
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
            </li>
        </ul>
    </div>
</div>
<!-- End Container -->
