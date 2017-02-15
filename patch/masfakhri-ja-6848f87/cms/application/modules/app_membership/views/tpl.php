<!-- Page Content -->
<div class="md-card" data-uk-grid-margin>
    <div class="md-card-content">
        <h3 class="heading_a">Membership</h3>
        <hr/>
        <ul class="uk-tab" data-uk-tab="{connect:'#tabs_anim1', animation:'scale'}">
            <li class="<?=($this->uri->segment(2)==='')?'uk-active':''?>"><a href="#">Benefit</a></li>
            <li class="<?=($this->uri->segment(2)==='terms')?'uk-active':''?>"><a href="<?= base_url($this->app_name).'/terms' ?>">Terms and Condition</a></li>
            <!--             <li class="<?=($this->uri->segment(2)==='data' && $this->uri->segment(2)=== 'addcar')?'uk-active':''?>"><a href="#">Registered Members</a></li>
 -->
            <li class="<?=($this->uri->segment(2)==='' || $this->uri->segment(2)==='datacar' || $this->uri->segment(2)==='addmember' || $this->uri->segment(2)==='memberedit')?'uk-active':''?>"><a href="#">Members Data</a></li>
        </ul>
        <ul id="tabs_anim1" class="uk-switcher uk-margin">
            <li>
                <!-- OUTPUT MESSAGE -->
                <?= $this->messagecontroll->showMessage() ?>
                    <!-- OUTPUT MESSAGE -->
                    <?php if( $this->initial_template == '' ): ?>
                    <form action="<?= base_url($this->app_name) ?>" method="post" enctype="multipart/form-data">
                        <div class="uk-grid">
                            <div class="uk-width-medium-1-1">
                                <div class="uk-form-row">
                                    <!--  -->
                                    <div class="md-card-content">
                                        <div class="uk-grid uk-grid-width-medium-1-3 uk-sortable sortable-handler" data-uk-grid="{gutter:24}" data-uk-sortable>
                                            <div>
                                                <div class="md-card">
                                                    <div class="md-card-toolbar">
                                                        <div class="md-card-toolbar-actions">
                                                            <i class="md-icon material-icons md-card-fullscreen-activate">&#xE5D0;</i>
                                                            <i class="md-icon material-icons md-card-toggle">&#xE316;</i>
                                                        </div>
                                                        <h3 class="md-card-toolbar-heading-text">
                                                            <?php 
                                                                if( $datadb > 0 ){
                                                                    foreach($datadb as $row){  
                                                            echo '<div class="md-card-content">'.$row['titone'].' </div>';
                                                                  }
                                                              }

                                                            ?>
                                                        </h3>
                                                    </div>
                                                    <div class="md-card-content">
                                                        <div class="uk-form-row">
                                                            <div class="md-input-wrapper">
                                                                <input name="titone" value="<?= rebackPost('titone', $row['titone']) ?>" class="md-input"><span class="md-input-bar"></span>
                                                            </div>
                                                            <br/>
                                                            <div class="md-input-wrapper">
                                                                <textarea name="descone" value="<?= rebackPost('descone', $row['descone']) ?>" cols="5" rows="2" class="md-input"><?= rebackPost('descone', $row['descone']) ?><span class="md-input-bar"></span></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="md-card">
                                                    <div class="md-card-toolbar">
                                                        <div class="md-card-toolbar-actions">
                                                            <i class="md-icon material-icons md-card-fullscreen-activate">&#xE5D0;</i>
                                                            <i class="md-icon material-icons md-card-toggle">&#xE316;</i>
                                                        </div>
                                                        <h3 class="md-card-toolbar-heading-text">
                                                            <?php 
                                                                if( $datadb > 0 ){
                                                                    foreach($datadb as $row){  
                                                            echo '<div class="md-card-content">'.$row['tittwo'].' </div>';
                                                                  }
                                                              }

                                                            ?>
                                                        </h3>
                                                    </div>
                                                    <div class="md-card-content">
                                                        <div class="uk-form-row">
                                                            <div class="md-input-wrapper">
                                                                <input name="tittwo" value="<?= rebackPost('tittwo', $row['tittwo']) ?>" class="md-input"><span class="md-input-bar"></span>
                                                            </div>
                                                            <br/>
                                                            <div class="md-input-wrapper">
                                                                <textarea name="desctwo" value="<?= rebackPost('desctwo', $row['desctwo']) ?>" cols="5" rows="2" class="md-input"><?= rebackPost('desctwo', $row['desctwo']) ?><span class="md-input-bar"></span></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="md-card">
                                                    <div class="md-card-toolbar">
                                                        <div class="md-card-toolbar-actions">
                                                            <i class="md-icon material-icons md-card-fullscreen-activate">&#xE5D0;</i>
                                                            <i class="md-icon material-icons md-card-toggle">&#xE316;</i>
                                                        </div>
                                                        <h3 class="md-card-toolbar-heading-text">
                                                            <?php 
                                                                if( $datadb > 0 ){
                                                                    foreach($datadb as $row){  
                                                            echo '<div class="md-card-content">'.$row['tittri'].' </div>';
                                                                  }
                                                              }

                                                            ?>
                                                        </h3>
                                                    </div>
                                                    <div class="md-card-content">
                                                        <div class="uk-form-row">
                                                            <div class="md-input-wrapper">
                                                                <input name="tittri" value="<?= rebackPost('tittri', $row['tittri']) ?>" class="md-input"><span class="md-input-bar"></span>
                                                            </div>
                                                            <br/>
                                                            <div class="md-input-wrapper">
                                                                <textarea name="desctri" value="<?= rebackPost('desctri', $row['desctri']) ?>" cols="5" rows="2" class="md-input"><?= rebackPost('desctri', $row['desctri']) ?><span class="md-input-bar"></span></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br />
                                        <br />
                                        <div class='uk-grid'>
                                                <label for="description"></label>
                                                <textarea class="md-input" id="desc" name="desc"><?= $desc['desc'] ?></textarea>
                                        </div>                                        
                                        <div class="uk-width-large-1-4 uk-width-medium-2-2 uk-grid-margin uk-row-first">
                                            <div class="uk-input-group">
                                                <button class="md-btn md-btn-primary md-btn-wave-light waves-effect waves-button waves-light">Save</button>
                                                <a href="javascript:window.history.go(-1);" class="md-btn md-btn-danger md-btn-wave-light waves-effect waves-button waves-light">Cancel</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <?php endif; ?>
            </li>
            <li>
                <!-- OUTPUT MESSAGE -->
                <!-- OUTPUT MESSAGE -->
                <?php if( $this->initial_template == '' || $this->initial_template == 'terms' ): ?>
                <form action="<?= base_url('app_membership/terms') ?>" method="post" enctype="multipart/form-data">
                    <div class="uk-grid">
                        <div class="uk-width-medium-1-1">
                            <span>&nbsp;</span>
                            <textarea cols="30" rows="5" class="md-input" name="desc">
                                <?= $datadb2['desc'] ?>
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
                <?php if( $this->initial_template == '' ): ?>
                <table class="uk-table uk-table-align-vertical uk-table-nowrap tablesorter tablesorter-altair" id="ts_issues">
                    <thead>
                        <tr>
                            <th class="uk-text-center">No Member</th>
                            <th>Full Name</th>
                            <th>Phone</th>
                            <th>Province</th>
                            <th>Address</th>
                            <th>Zipcode</th>
                            <th>Payment</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th class="uk-text-center">No Member</th>
                            <th>Full Name</th>
                            <th>Phone</th>
                            <th>Province</th>
                            <th>Address</th>
                            <th>Zipcode</th>
                            <th>Payment</th>
                        </tr>
                    </tfoot>
                    <tbody>
                            <?php 
                        if( count($datadb3) > 0 ){
                            foreach($datadb3 as $row){                         
                                echo '                    
                                    <tr>
                                        <td class="uk-text-center">
                                                '.$row['no_member'].'
                                        </td>
                                        <td>
                                             <a href="'.base_url($this->app_name).'/memberedit/'.$row['id_membership'].'">'.$row['first_name'].' '.$row['last_name'].'</a>
                                        </td>
                                        <td>'.$row['phone'].'</td>
                                        <td class="uk-text-center">'.$row['province'].'</td>
                                        <td>'.$row['address'].'</td>
                                        <td>'.$row['zipcode'].'</td>
                                        <td>'.$row['status'].'</td>
                                    </tr>';
                            }}else{
                                echo '
                                    <tr>
                                        <td class="uk-text-center"><span class="uk-text-small uk-text-muted uk-text-nowrap"></span></td>
                                        <td></td>
                                        <td>
                                           <span class="uk-text-danger">Tidak ada data</span>
                                        </td>
                                        <td></td>
                                        <td></td>                                       
                                    </tr>';
                            }
                            ?>
                    </tbody>
                </table>
                <ul class="uk-pagination ts_pager">
                    <li data-uk-tooltip title="Select Page">
                        <select class="ts_gotoPage ts_selectize"></select>
                    </li>
                    <li class="first"><a href="javascript:void(0)"><i class="uk-icon-angle-double-left"></i></a></li>
                    <li class="prev"><a href="javascript:void(0)"><i class="uk-icon-angle-left"></i></a></li>
                    <li><span class="pagedisplay"></span></li>
                    <li class="next"><a href="javascript:void(0)"><i class="uk-icon-angle-right"></i></a></li>
                    <li class="last"><a href="javascript:void(0)"><i class="uk-icon-angle-double-right"></i></a></li>
                    <li data-uk-tooltip title="Page Size">
                        <select class="pagesize ts_selectize">
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                        </select>
                    </li>
                </ul>  
                <form action="<?= base_url('app_membership').'/url' ?>" method="post" enctype="multipart/form-data">
                            <div class="uk-grid">
                                <div class="uk-width-1-3">
                                    <label>Offline form url (direct links download)</label>
                                    <input value="<?= $desc['form_url'] ?>" type="text" class="md-input" name="form_url" />
                                    <button class="md-btn md-btn-primary md-btn-wave-light waves-effect waves-button waves-light">Save</button>
                                </div>
                            </div>
                </form>                                   
                <div class="md-fab-wrapper">
                    <a class="md-fab md-fab-accent" href="<?= base_url($this->app_name) ?>/addmember">
                        <i class="material-icons"></i>
                    </a>
                </div>
            </li>
            <li>
                <?php elseif( $this->initial_template == '' || $this->initial_template == 'datacar' ): ?>
                <table class="uk-table uk-table-align-vertical uk-table-nowrap tablesorter tablesorter-altair" id="ts_issues">
                    <thead>
                        <tr>
                            <th class="uk-text-center">ID</th>
                            <th>Full Name</th>
                            <th>Model</th>
                            <th>Year</th>
                            <th>License Plate</th>
                            <th>Casis No</th>
                            <th>Engine No</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th class="uk-text-center">ID</th>
                            <th>Full Name</th>
                            <th>Model</th>
                            <th>Year</th>
                            <th>License Plate</th>
                            <th>Casis No</th>
                            <th>Engine No</th>
                        </tr>
                    </tfoot>
                    <tbody>
                    <?php 
                        if( count($datadb4) > 0 ){
                            foreach($datadb4 as $row){                         
                                echo '                    
                                    <tr>
                                        <td class="uk-text-center"><span class="uk-text-small uk-text-muted uk-text-nowrap">'.$row['id_membership'].'</span></td>
                                        <td>'.$row['first_name'].' '.$row['last_name'].'</td>
                                        <td>'.$row['model'].'</td>
                                        <td>'.$row['year'].'</td>
                                        <td>'.$row['license_plate'].'</td>
                                        <td>'.$row['chasis_no'].'</td>
                                        <td>'.$row['engine_no'].'</td>
                                    </tr>';
                            }}else{
                                echo '
                                    <tr>
                                        <td class="uk-text-center"><span class="uk-text-small uk-text-muted uk-text-nowrap"></span></td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                           <span class="uk-text-danger">Tidak ada data</span>
                                        </td>
                                        <td></td>
                                        <td></td>                                       
                                    </tr>';
                            }
                            ?>
                    </tbody>
                </table>
                <ul class="uk-pagination ts_pager">
                    <li data-uk-tooltip title="Select Page">
                        <select class="ts_gotoPage ts_selectize"></select>
                    </li>
                    <li class="first"><a href="javascript:void(0)"><i class="uk-icon-angle-double-left"></i></a></li>
                    <li class="prev"><a href="javascript:void(0)"><i class="uk-icon-angle-left"></i></a></li>
                    <li><span class="pagedisplay"></span></li>
                    <li class="next"><a href="javascript:void(0)"><i class="uk-icon-angle-right"></i></a></li>
                    <li class="last"><a href="javascript:void(0)"><i class="uk-icon-angle-double-right"></i></a></li>
                    <li data-uk-tooltip title="Page Size">
                        <select class="pagesize ts_selectize">
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                        </select>
                    </li>
                </ul>                       
            </li>
            <li>
                <?php elseif($this->initial_template == '' || $this->initial_template == 'addmember'): ?>
                <form action="<?= base_url('app_membership/addmember') ?>" method="post" enctype="multipart/form-data">
                    <div class="md-card-content">
                        <h3 class="heading_a">About You</h3>
                        <div class="uk-grid" data-uk-grid-margin>
                            <div class="uk-width-1-1">
                                <div class="uk-form-row">
                                    <div class="uk-grid">
                                        <div class="uk-width-1-3">
                                            <label>First Name</label>
                                            <input type="text" class="md-input" name="first_name" />
                                        </div>
                                        <div class="uk-width-1-3">
                                            <label>Last Name</label>
                                            <input type="text" class="md-input" name="last_name" />
                                        </div>
                                        <div class="uk-width-1-3">
                                            <label>Members No.</label>
                                            <input type="text" class="md-input" name="no_member" />
                                        </div>
                                        <div class="uk-width-1-3">
                                            <label>Address</label>
                                            <input type="text" class="md-input" name="address" />
                                        </div>
                                        <div class="uk-width-1-3">
                                            <label>City / Provice</label>
                                            <input type="text" class="md-input" name="province" />
                                        </div>
                                        <div class="uk-width-1-3">
                                            <label>Post Code</label>
                                            <input type="text" class="md-input" name="zipcode" />
                                        </div>
                                        <div class="uk-width-1-3">
                                            <label>National ID</label>
                                            <input type="text" class="md-input" name="ktp" />
                                        </div>
                                        <div class="uk-width-1-3">
                                            <label>Driver License</label>
                                            <input type="text" class="md-input" name="sim" />
                                        </div>                                                                                                                                                                 
                                        <div class="uk-width-1-3">
                                            <label>Mobile Number</label>
                                            <input type="text" class="md-input" name="phone" />
                                        </div>
                                        <div class="uk-width-1-3">
                                            <label>Home Number</label>
                                            <input type="text" class="md-input" name="home_phone" />
                                        </div>
                                        <div class="uk-width-1-3">
                                            <label>Office Number</label>
                                            <input type="text" class="md-input" name="office" />
                                        </div>
                                        <div class="uk-width-1-3">
                                            <label>Email</label>
                                            <input type="text" class="md-input" name="email" />
                                        </div>
                                        <div class="uk-width-1-3">
                                            <label>Blood Type</label>
                                            <input type="text" class="md-input" name="blood_type" />
                                        </div>
                                        <div class="uk-width-1-3">
                                            <label>T-shirt size</label>
                                            <input type="text" class="md-input" name="tsize" />
                                        </div>
                                        <div class="uk-width-1-3">
                                            <select class="uk-form-width-medium" name="status" id="status" data-md-selectize-inline>
                                                <option value="pending">Pending</option>
                                                <option value="status">Success</option>
                                            </select>
                                        </div>                                                                                                                                 
                                    </div>
                                </div><br>

                                <h3 class="heading_a">Members Data</h3>
                                <hr/>
                                <div class="uk-grid" id="formMore1">

                                        <div class="uk-width-1-4">
                                            <label>Seri MC & Tahun</label>
                                            <input type="text" class="md-input" name="model2" />
                                        </div>
                                        <div class="uk-width-1-4">
                                            <label>Chapter</label>
                                            <input type="text" class="md-input" name="chapter" />
                                        </div>
                                        <div class="uk-width-1-4">
                                            <label>Register Date</label>
                                            <input type="text" class="md-input" name="reg_date" />
                                        </div>
                                        <div class="uk-width-1-4">
                                            <label>No. Member</label>
                                            <input type="text" class="md-input" name="mem2" />
                                        </div>
                                   
                                </div>

                                <br/>                            
                                <h3 class="heading_a">Membership</h3>
                                <hr/>
                                <div class="uk-grid" id="formMore1">

                                    <?php
                                                for($i=0; $i<3; $i++){
                                                     
                                                    $removeLink = '';
                                                    $fieldPid   = '';     
                                                    echo '<div class="uk-width-1-5">
                                        <label>Seri MC</label>
                                        <input type="text" name="seri_mc'.$i.'" class="md-input"  />
                                    </div>
                                    <div class="uk-width-1-5">
                                        <label>Year</label>
                                        <input type="text" name="year'.$i.'" class="md-input" />
                                    </div>
                                    <div class="uk-width-1-5">
                                        <label>Plate No.</label>
                                        <input type="text" name="license_plate'.$i.'" class="md-input" />
                                    </div>
                                    <div class="uk-width-1-5">
                                        <label>Chassis No</label>
                                        <input type="text" name="chasis_no'.$i.'" class="md-input" />
                                    </div>
                                    <div class="uk-width-1-5">
                                        <label>Engine No</label>
                                        <input type="text" name="engine_no'.$i.'" class="md-input" />
                                    </div>';   
                                                }
                                                ?>
                                   
                                   
                                </div>
                                <br />
                                    <button class="md-btn md-btn-primary md-btn-wave-light waves-effect waves-button waves-light">Save</button>
                                    <a href="javascript:window.history.go(-1);" class="md-btn md-btn-danger md-btn-wave-light waves-effect waves-button waves-light">Cancel</a>
                            </div>
                        </div>
                    </div>
                </form>
            <?php elseif($this->initial_template == '' || $this->initial_template == 'memberedit'): ?>
                <form action="<?= base_url( $this->app_name ).'/memberedit/'.$this->initial_id ?>" method="post" enctype="multipart/form-data">
                    <div class="md-card-content">
                        <h3 class="heading_a">About You</h3>
                        <div class="uk-grid" data-uk-grid-margin>
                            <div class="uk-width-1-1">
                                <div class="uk-form-row">
                                    <div class="uk-grid">
                                        <div class="uk-width-1-3">
                                            <label>First Name</label>
                                            <input type="text" class="md-input" value="<?php echo $datadb[0]['first_name']; ?>" name="first_name" />
                                        </div>
                                        <div class="uk-width-1-3">
                                            <label>Last Name</label>
                                            <input type="text" class="md-input" value="<?php echo $datadb[0]['last_name']; ?>" name="last_name" />
                                        </div>
                                        <div class="uk-width-1-3">
                                            <label>Members No.</label>
                                            <input type="text" class="md-input" value="<?php echo $datadb[0]['no_member']; ?>" name="no_member" />
                                        </div>
                                        <div class="uk-width-1-3">
                                            <label>Address</label>
                                            <input type="text" class="md-input" value="<?php echo $datadb[0]['address']; ?>" name="address" />
                                        </div>
                                        <div class="uk-width-1-3">
                                            <label>City / Provice</label>
                                            <input type="text" class="md-input" value="<?php echo $datadb[0]['province']; ?>" name="province" />
                                        </div>
                                        <div class="uk-width-1-3">
                                            <label>Post Code</label>
                                            <input type="text" class="md-input" value="<?php echo $datadb[0]['zipcode']; ?>" name="zipcode" />
                                        </div>
                                        <div class="uk-width-1-3">
                                            <label>National ID</label>
                                            <input type="text" class="md-input" value="<?php echo $datadb[0]['ktp']; ?>" name="ktp" />
                                        </div>
                                        <div class="uk-width-1-3">
                                            <label>Driver License</label>
                                            <input type="text" class="md-input" value="<?php echo $datadb[0]['sim']; ?>" name="sim" />
                                        </div>                                                                                                                                                                 
                                        <div class="uk-width-1-3">
                                            <label>Mobile Number</label>
                                            <input type="text" class="md-input" value="<?php echo $datadb[0]['phone']; ?>" name="phone" />
                                        </div>
                                        <div class="uk-width-1-3">
                                            <label>Home Number</label>
                                            <input type="text" class="md-input" value="<?php echo $datadb[0]['home_phone']; ?>" name="home_phone" />
                                        </div>
                                        <div class="uk-width-1-3">
                                            <label>Office Number</label>
                                            <input type="text" class="md-input" value="<?php echo $datadb[0]['office']; ?>" name="office" />
                                        </div>
                                        <div class="uk-width-1-3">
                                            <label>Email</label>
                                            <input type="text" class="md-input" value="<?php echo $datadb[0]['email']; ?>" name="email" />
                                        </div>
                                        <div class="uk-width-1-3">
                                            <label>Blood Type</label>
                                            <input type="text" class="md-input" value="<?php echo $datadb[0]['blood_type']; ?>" name="blood_type" />
                                        </div>
                                        <div class="uk-width-1-3">
                                            <label>T-shirt size</label>
                                            <input type="text" class="md-input" value="<?php echo $datadb[0]['tsize']; ?>" name="tsize" />
                                        </div> 
                                        <div class="uk-width-1-3">
                                            <select class="uk-form-width-medium" name="status" id="status" data-md-selectize-inline>
                                                <option value="">Payment Status</option>
                                                <option class="<?=($datadb[0]['status']==='pending')?'active':''?>" value="pending">Pending</option>
                                                <option class="<?=($datadb[0]['status']==='success')?'active':''?>" value="success">Success</option>
                                            </select>
                                        </div>                                                                               
                                    </div>
                                </div><br>
                            
                                <h3 class="heading_a">Members Data</h3>
                                <hr/>
                                <div class="uk-grid" id="formMore1">

                                        <div class="uk-width-1-4">
                                            <label>Seri MC & Tahun</label>
                                            <input type="text" class="md-input" value="<?php echo $datadb[0]['model2']; ?>" name="model2" />
                                        </div>
                                        <div class="uk-width-1-4">
                                            <label>Chapter</label>
                                            <input type="text" class="md-input" value="<?php echo $datadb[0]['chapter']; ?>" name="chapter" />
                                        </div>
                                        <div class="uk-width-1-4">
                                            <label>Register Date</label>
                                            <input type="text" class="md-input" value="<?php echo $datadb[0]['reg_date']; ?>" name="reg_date" />
                                        </div>
                                        <div class="uk-width-1-4">
                                            <label>No. Member</label>
                                            <input type="text" class="md-input" value="<?php echo $datadb[0]['mem2']; ?>" name="mem2" />
                                        </div>
                                   
                                </div>

                                <br/> 

                                <h3 class="heading_a">Membership</h3>
                                <hr/>
                                <div class="uk-grid" id="formMore1">


                                   <?php
                                                
                                                for($i = 0; $i<3; $i++){


                                                    $removeLink = '';
                                                    $fieldPid   = '';
                                                        
                                                    echo '<div class="uk-width-1-5">
                                        <label>Seri MC</label>
                                        <input type="text"  value="'.$tests["$i"]["seri_mc"].'" name="seri_mc'.$i.'" class="md-input"  />
                                    </div>
                                    <div class="uk-width-1-5">
                                        <label>Year</label>
                                        <input type="text" value="'.$tests["$i"]["year"].'" name="year'.$i.'" class="md-input" />
                                    </div>
                                    <div class="uk-width-1-5">
                                        <label>Plate No.</label>
                                        <input type="text" value="'.$tests["$i"]["license_plate"].'" name="license_plate'.$i.'" class="md-input" />
                                    </div>
                                    <div class="uk-width-1-5">
                                        <label>Chassis No</label>
                                        <input type="text" value="'.$tests["$i"]["chasis_no"].'" name="chasis_no'.$i.'" class="md-input" />
                                    </div>
                                    <div class="uk-width-1-5">
                                        <label>Engine No</label>
                                        <input type="text" value="'.$tests["$i"]["engine_no"].'" name="engine_no'.$i.'" class="md-input" />
                                    </div>';
                                    }
                                    ?>
                                        
                                   
                                   
                                </div>
                                <br />
                                    <button class="md-btn md-btn-primary md-btn-wave-light waves-effect waves-button waves-light">Save</button>
                                    <a href="javascript:window.history.go(-1);" class="md-btn md-btn-danger md-btn-wave-light waves-effect waves-button waves-light">Cancel</a>
                            </div>
                        </div>
                    </div>
                </form>
                <?php endif; ?>
            </li>
        </ul>
        <!-- End Container -->


<!-- tablesorter -->
<script src="<?= config_item('assets') ?>bower_components/tablesorter/dist/js/jquery.tablesorter.min.js"></script>
<script src="<?= config_item('assets') ?>bower_components/tablesorter/dist/js/jquery.tablesorter.widgets.min.js"></script>
<script src="<?= config_item('assets') ?>bower_components/tablesorter/dist/js/widgets/widget-alignChar.min.js"></script>
<script src="<?= config_item('assets') ?>bower_components/tablesorter/dist/js/extras/jquery.tablesorter.pager.min.js"></script>

<!--  table functions -->
<script src="<?= config_item('assets_js') ?>pages/pages_issues.min.js"></script>

<!-- kendo UI -->
<script src="<?= config_item('assets_js') ?>kendoui_custom.min.js"></script>

<!--  kendoui functions -->
<script src="<?= config_item('assets_js') ?>pages/kendoui.min.js"></script>

<script type="text/javascript">
/**
 * @desc Event onclick remove selected row on Master Data Table
 * used on every master data table
 */
$('.act-remove-table').click(function(){
    if( confirm('Are you sure want to remove this data ?') ){
        window.location = $(this).attr('data-url');
    }
});
</script>        
