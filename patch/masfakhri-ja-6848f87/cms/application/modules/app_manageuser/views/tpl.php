<span>&nbsp;</span>
<span>&nbsp;</span>
<span>&nbsp;</span>
<span>&nbsp;</span>


<div class="md-card">
    <div class="md-card-content">
        <div class="uk-overflow-container uk-margin-bottom">
            <h3 class="heading_e">Manage Admin</h3>
            <!-- OUTPUT MESSAGE -->
            <?= $this->messagecontroll->showMessage() ?>
                <!-- OUTPUT MESSAGE -->
                    <?php if( $this->initial_template == '' ): ?> 
                      <table class="uk-table uk-table-align-vertical uk-table-nowrap tablesorter tablesorter-altair" id="ts_issues">
                        <thead>
                            <tr>
                                <th class="uk-text-center">ID</th>
                                <th>Images</th>
                                <th>Nickname</th>
                                <th>Username</th>
                                <th>Join Date</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th class="uk-text-center">ID</th>
                                <th>Images</th>
                                <th>Nickname</th>
                                <th>Username</th>
                                <th>Join Date</th>
                            </tr>
                        </tfoot>                          
                        <tbody>
                            <?php 
                            if( count($datadb) > 0 ){
                                foreach($datadb as $row){
        
                                    $initTable = $row['id_administrator'];
                                    
                                    # default image profile
                                    if( $row['image'] == "" )$defaultImage = config_item('assets_img').'/default/avatar.png';
                                    else $defaultImage = base_url().getThumbnailsImage($row['image'], $row['extention']);
                                    
                                    echo '
                                    <tr>
                                        <td class="uk-text-center"><span class="uk-text-small uk-text-muted uk-text-nowrap">'.$initTable.'</span></td>                                    
                                        <td><img src="'.$defaultImage.'" width="32" height="32" /></td>
                                        <td>'.$row['nickname'].'</td>
                                        <td>'.$row['username'].'</td>
                                        <td>'.$row['create_date'].'</td>
                                    </tr>';
                                }
                            }else{
                                echo '
                                <tr>
                                    <td><span>&nbsp;</span></td>
                                    <td><span>&nbsp;</span></td>
                                    <td><span class="uk-text-danger">Tidak ada user</span></td>
                                    <td><span>&nbsp;</span></td>
                                    <td><span>&nbsp;</span></td>
                                </tr>';
                            }
                            ?>
                            </tbody>
                          </table> 
            <div class="md-fab-wrapper">
                <a class="md-fab md-fab-accent" href="<?= base_url($this->app_name) ?>/add">
                    <i class="material-icons">&#xE145;</i>
                </a>
            </div>                    
        </div>
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
                    <br /><br />
                    <h3 class="heading_e">Manage Subscribe users</h3>

                      <table class="uk-table uk-table-align-vertical uk-table-nowrap tablesorter tablesorter-altair" id="ts_issues">
                        <thead>
                            <tr>
                                <th class="uk-text-center">ID</th>
                                <th>E-mail</th>
                                <th>Subscribe date</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th class="uk-text-center">ID</th>
                                <th>E-mail</th>
                                <th>Subscribe date</th>
                            </tr>
                        </tfoot>                          
                        <tbody>
                            <?php 
                            if( count($datadb2) > 0 ){
                                foreach($datadb2 as $row){
        
                                    $initTable = $row['u_subscribe_id'];
                                    
                                    
                                    echo '
                                    <tr>
                                        <td class="uk-text-center"><span class="uk-text-small uk-text-muted uk-text-nowrap">'.$initTable.'</span></td>                                    
                                        <td>'.$row['u_subscribe_email'].'</td>
                                        <td>'.$row['register_date'].'</td>
                                    </tr>';
                                }
                            }else{
                                echo '
                                <tr>
                                    <td><span>&nbsp;</span></td>
                                    <td><span class="uk-text-danger">Tidak ada user</span></td>
                                    <td><span>&nbsp;</span></td>
                                </tr>';
                            }
                            ?>
                            </tbody>
                          </table> 

        <?php else: ?> 
            <form action="<?= base_url('app_manageuser/add') ?>" method="post" enctype="multipart/form-data">
                <div class="md-card-content">
                    <div class="uk-grid">
                        <div class="uk-width-medium-1-1 uk-row-first">

                            <h5 class="heading_e">
                                Profile Image<br />
                                Min. Size (550 x 550 px)
                            </h5>
                            <div align="center">
                                <?php
                            if( file_exists( getThumbnailsImage($datadb['file'], $datadb['extention']) ) ){
                                echo '<img src="'.base_url().getThumbnailsImage($datadb['file'], $datadb['extention']).'"/>';
                            }else{
                                echo '<img src="http://placehold.it/550x550"/>';
                            }
                            ?>
                                    <br />
                                    <div class="uk-form-file md-btn md-btn-primary">
                                        Select
                                        <input id="form-file" type="file" id="file" name="file">
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>                
                <div class="uk-margin-medium-bottom">
                    <label for="event_name">NickName</label>
                    <input type="text" class="md-input" id="nickname" name="nickname" />
                </div>
                <div class="uk-margin-medium-bottom">
                    <label for="event_place">Username</label>
                    <input type="text" class="md-input" id="username" name="username" />
                </div>
                <div class="uk-margin-medium-bottom">
                    <label for="event_place">password</label>
                    <input type="password" class="md-input" id="password" name="password" />
                </div>
                <div class="uk-margin-medium-bottom">
                    <label for="event_place">Confirm password</label>
                    <input type="password" class="md-input" id="repassword" name="repassword" />
                </div>
                <div class="uk-width-large-1-4 uk-width-medium-2-2 uk-grid-margin uk-row-first">
                    <div class="uk-input-group">
                        <button class="md-btn md-btn-primary md-btn-wave-light waves-effect waves-button waves-light">Save</button>
                        <a href="javascript:window.history.go(-1);" class="md-btn md-btn-danger md-btn-wave-light waves-effect waves-button waves-light">Cancel</a>
                    </div>
                </div>
            </form>        


        <?php endif; ?>
    </div>
</div>                                                                       
<!--     - Page Content
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6 text-left">
                       <h4>Manage Users</h4>
                    </div>
                    <div class="col-md-6 text-right">
                       <div class="btn-group" role="group" aria-label="...">
                          <?php if( $this->uri->segment(2) == 'data' ): ?>
                              <button type="button" class="btn btn-success exlink" data-url="<?= base_url('app_manageuser').'/add' ?>"><span class="glyphicon glyphicon-plus"></span> New Entry</button>
                          <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div  id="page-content">          
                    <?php if( $this->initial_template == 'data' ): ?>
                       <form action="<?= base_url('app_manageuser').'/removeAll' ?>" method="post" id="form1">
                          <h4 class="text-info">Master Data</h4>
                          <hr/>
                            OUTPUT MESSAGE 
                           <?= $this->messagecontroll->showMessage() ?>
                            OUTPUT MESSAGE 
                          <table class="table table-condensed table-striped table-bordered table-hover no-margin">
                            <thead>
                              <tr>
                                <th style="width:3%;"><span class="glyphicon glyphicon-ok" onclick="globalChecked()"></span></th>
                                <th style="width:7%">Images <a href="javascript:;"><span class="glyphicon glyphicon-sort"></span></a></th>
                                <th style="width:15%">Nickname <a href="javascript:;"><span class="glyphicon glyphicon-sort"></span></a></th>
                                <th>Join Date <a href="javascript:;"><span class="glyphicon glyphicon-sort"></span></a></th>
                                <th style="width:5%">Action</th>
                              </tr>
                            </thead>
                            <tbody>
                            <?php 
                            if( count($datadb) > 0 ){
                                foreach($datadb as $row){
        
                                    $initTable = $row['id_administrator'];
                                    
                                    # default image profile
                                    if( $row['image'] == "" )$defaultImage = config_item('assets_img').'/default/avatar.png';
                                    else $defaultImage = base_url().getThumbnailsImage($row['image'], $row['extention']);
                                    
                                    echo '
                                    <tr>
                                        <td valign="middle">
                                            <div class="checkbox check-default">
                                                <input name="id_table[]" type="checkbox" name="tableid[]" value="'.$initTable.'" id="checkbox'.$initTable.'">
                                            </div>
                                        </td>
                                        <td><div class="img-table-mini"><img src="'.$defaultImage.'"/></div></td>
                                        <td>'.$row['nickname'].'</td>
                                        <td>'.$row['create_date'].'</td>
                                        <td>
                                            <div class="tools-table">
                                                 <a href="javascript:;" class="act-remove-table" data-url="'.base_url($this->app_name).'/remove/'.$initTable.'" title="Remove"><span class="glyphicon glyphicon-trash"></span></a><yphicon glyphicon-edit"></span></a>
                                            </div>
                                        </td>
                                     </tr>';
                                }
                            }else{
                                echo '<tr><td colspan="5"><span class="gray-text">Data is Empty</span></td></tr>';
                            }
                            ?>
                            </tbody>
                          </table>
                        </form>
                       <div class="col-md-6">Result  <?= count($datadb) ?> - <?= $result_all?></div>
                       <div class="col-md-6"><div class="cs-pagination"><?=  $this->pagination->create_links() ?></div></div>
                    <?php elseif( $this->initial_template == 'add' ): ?>
                        <form action="<?= base_url('app_manageuser').'/add' ?>" method="post" enctype="multipart/form-data">
                             <h4 class="text-info">Form Input</h4>
                            <hr/>
                            OUTPUT MESSAGE 
                            <?= $this->messagecontroll->showMessage() ?>
                            OUTPUT MESSAGE 
                            <div class="control-group">
                              <label class="control-label">Image Profile</label>
                              <div class="controls">
                                  <input type="file" name="file"  placeholder="Empty"/>
                              </div>
                            </div>
                            <div class="control-group">
                              <label class="control-label">Nickname</label>
                              <div class="controls">
                                  <input type="text" name="nickname" value="<?= set_value('nickname') ?>" placeholder="Empty"/>
                              </div>
                            </div>
                            <div class="control-group">
                              <label class="control-label">Username</label>
                              <div class="controls">
                                <input type="text" name="username" value="<?= set_value('username') ?>" placeholder="Empty"/>
                              </div>
                            </div>
                            <div class="control-group">
                              <label class="control-label">Password</label>
                              <div class="controls">
                                <input type="password" name="password" value="" placeholder="Empty"/>
                              </div>
                            </div>
                            <div class="control-group">
                              <label class="control-label">Confirm Password</label>
                              <div class="controls">
                                <input type="password" name="repassword" value="" placeholder="Empty"/>
                              </div>
                            </div>
                            <div class="form-actions no-margin">
                              <button type="button" class="btn">Cancel</button>
                              <button type="submit" class="btn btn-info">Save</button>
                            </div>
                          </form> 
                    <?php endif; ?>
                </div>
            </div>
        </div>
    End Container -->

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
