<span>&nbsp;</span>
<span>&nbsp;</span>
<span>&nbsp;</span>
<span>&nbsp;</span>


<div class="md-card">
    <div class="md-card-content">
        <div class="uk-overflow-container uk-margin-bottom">
            <h3 class="heading_e">Event</h3>
            <!-- OUTPUT MESSAGE -->
            <?= $this->messagecontroll->showMessage() ?>
                <!-- OUTPUT MESSAGE -->
                <?php if( $this->initial_template == '' ): ?>
                    <table class="uk-table uk-table-align-vertical uk-table-nowrap tablesorter tablesorter-altair" id="ts_issues">
                        <thead>
                            <tr>
                                <th class="uk-text-center">ID</th>
                                <th>Event Name</th>
                                <th>Event Date</th>
                                <th>Place</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th class="uk-text-center">ID</th>
                                <th>Event Name</th>
                                <th>Event Date</th>
                                <th>Place</th>
                                <th>Status</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php 
                        if( count($datadb) > 0 ){
                            foreach($datadb as $row){                         
                                echo '                    
                                    <tr>
                                        <td class="uk-text-center"><span class="uk-text-small uk-text-muted uk-text-nowrap">'.$row['event_id'].'</span></td>
                                        <td>
                                            <a href="'.base_url($this->app_name).'/edit/'.$row['event_id'].'">'.$row['event_name'].'</a>
                                        </td>
                                        <td>'.date ("d/M/Y",strtotime($row['date'])).'</td>
                                        <td>'.$row['place'].'</td>';
                                        if($row['status'] == 'Soon') {
                                         echo '<td><span class="uk-badge uk-badge-info">'.$row['status'].'</span></td>';                                           
                                        }else{
                                        echo '<td><span class="uk-badge uk-badge-success">'.$row['status'].'</span></td>';
                                        }
                                    echo '</tr>';
                            }}else{
                                echo '
                                    <tr>
                                        <td class="uk-text-center"><span class="uk-text-small uk-text-muted uk-text-nowrap"></span></td>
                                        <td>
                                           
                                        </td>
                                        <td><span class="uk-text-danger">Tidak ada event</span></td>
                                        <td></td>                                        
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
        <?php elseif( $this->initial_template == 'add' ): ?>
            <form action="<?= base_url('app_event/add') ?>" method="post" enctype="multipart/form-data">
                <div class="uk-margin-medium-bottom">
                    <label for="event_name">Event Name</label>
                    <input type="text" class="md-input" id="event_name" name="event_name" />
                </div>
                <div class="uk-margin-medium-bottom">
                    <label for="event_place">Event Place</label>
                    <input type="text" class="md-input" id="place" name="place" />
                </div>
                <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-medium-1-1">
                        <label for="event_date">Select date</label>
                        <input class="md-input" type="text" id="event_date" value="" name="date" data-uk-datepicker="{format:'YYYY-MM-DD'}">                    
                    </div>
                </div>
<div class="uk-grid">
                <div class="uk-margin-medium-bottom">
                    <label for="description">Description</label>
                    <textarea class="md-input" id="desc" name="desc"></textarea>
                </div>
</div>                
                <div class="md-card-content">
                    <div class="uk-grid">
                        <div class="uk-width-medium-1-2 uk-row-first">

                            <h5 class="heading_e">
                        Cover Photo (Home)<br />
                        Min. Size (607 x 604 px)
                    </h5>
                            <div align="center">
                                <?php
                            if( file_exists( getThumbnailsImage($datadb2['file'], $datadb2['extention']) ) ){
                                echo '<img src="'.base_url().getThumbnailsImage($datadb2['file'], $datadb2['extention']).'"/>';
                            }else{
                                echo '<img src="http://placehold.it/607x604"/>';
                            }
                            ?>
                                    <br />
                                    <div class="uk-form-file md-btn md-btn-primary">
                                        Select
                                        <input id="form-file" type="file" id="file" name="file">
                                    </div>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-2">

                            <h5 class="heading_e">
                        Cover Photo (Event)<br />
                        Min. Size (607 x 501 px)
                    </h5>
                            <div align="center">
                                <?php
                            if( file_exists( getThumbnailsImage($datadb2['file2'], $datadb2['extension']) ) ){
                                echo '<img src="'.base_url().getThumbnailsImage($datadb2['file2'], $datadb2['extension2']).'"/>';
                            }else{
                                echo '<img src="http://placehold.it/607x501"/>';
                            }
                            ?>
                                    <br />
                                    <div class="uk-form-file md-btn md-btn-primary">
                                        Select
                                        <input id="form-file" type="file" id="file2" name="file2">
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="uk-margin-medium-bottom">
                    <label for="task_assignee" class="uk-form-label">Event Status</label>
                    <select class="uk-form-width-medium" name="status" id="status" data-md-selectize-inline>
                        <option value="">-- Select Status --</option>
                        <option value="soon">Comming Soon</option>
                        <option value="past">Past Event</option>
                    </select>
                </div>
                <div class="uk-margin-medium-bottom">
                    <label for="is_slide" class="uk-form-label">Featured Slide</label>
                      <select name="is_slide" class="uk-form-width-medium" data-md-selectize-inline>
                        <?php
                        $slide = array('no', 'yes');
                        foreach($slide as $row){
                              
                              if( $row == set_value('is_slide') )$sel = 'selected';
                              else $sel = '';
                              
                              echo '<option value="'.$row.'" '.$sel.'>'.strtoupper($row).'</option>';
                        }
                        ?>
                      </select>  
                </div>
                        <div class="uk-grid">
                            <div class="uk-width-medium-1-1 uk-row-first">

                                <h5 class="heading_e">
                        Slider Photo (Home)<br />
                        Actual Size (1219 x 426 px)
                    </h5>
                                <div align="center">
                                    <?php
                            if( file_exists( getThumbnailsImage($datadb2['file3'], $datadb2['extension3']) ) ){
                                echo '<img src="'.base_url().getThumbnailsImage($datadb2['file3'], $datadb2['extension3']).'"/>';
                            }else{
                                echo '<img width="50%" height="50%" src="http://placehold.it/1219x426"/>';
                            }
                            ?>
                                        <br />
                                        <div class="uk-form-file md-btn md-btn-primary">
                                            Select
                                            <input id="form-file" type="file" id="file3" name="file3">
                                        </div>
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
        <?php else: ?>
            <form action="<?= base_url( $this->app_name ).'/edit/'.$this->initial_id ?>" method="post" class="uk-form-stacked" enctype="multipart/form-data">
                    <div class="uk-margin-medium-bottom">
                        <label for="task_title">Event Name</label>
                        <input type="text" class="md-input" id="event_name" value="<?= rebackPost('event_name', $datadb['event_name']) ?>" name="event_name" />
                    </div>
                    <div class="uk-margin-medium-bottom">
                        <label for="task_title">Event Place</label>
                        <input type="text" class="md-input" id="place" value="<?= rebackPost('place', $datadb['place']) ?>" name="place" />
                    </div>
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-1">
                            <label for="event_date">Select date</label>
                            <input class="md-input" type="text" id="event_date" value="<?= rebackPost('date', $datadb['date']) ?>" name="date" data-uk-datepicker="{format:'YYYY-MM-DD'}">                    
                        </div>
                    </div>

                    <div class="uk-margin-medium-bottom">
                        <label for="task_description">Description</label>
                        <textarea class="md-input" id="desc" name="desc"><?= rebackPost('desc', $datadb['desc']) ?></textarea>
                    </div>
                    
                    <div class="md-card-content">
                        <div class="uk-grid">
                            <div class="uk-width-medium-1-2 uk-row-first">

                                <h5 class="heading_e">
                        Cover Photo (Home)<br />
                        Min. Size (607 x 604 px)
                    </h5>
                                <div align="center">
                                    <?php
                            if( file_exists( getThumbnailsImage($datadb['file'], $datadb['extention']) ) ){
                                echo '<img src="'.base_url().getThumbnailsImage($datadb['file'], $datadb['extention']).'"/>';
                            }else{
                                echo '<img src="http://placehold.it/607x604"/>';
                            }
                            ?>
                                        <br />
                                        <div class="uk-form-file md-btn md-btn-primary">
                                            Select
                                            <input id="form-file" type="file" id="file" name="file">
                                        </div>
                                </div>
                            </div>
                            <div class="uk-width-medium-1-2">

                                <h5 class="heading_e">
                        Cover Photo (Event)<br />
                        Min. Size (607 x 501 px)
                    </h5>
                                <div align="center">
                                    <?php
                            if( file_exists( getThumbnailsImage($datadb['file2'], $datadb['extension2']) ) ){
                                echo '<img src="'.base_url().getThumbnailsImage($datadb['file2'], $datadb['extension2']).'"/>';
                            }else{
                                echo '<img src="http://placehold.it/607x501"/>';
                            }
                            ?>
                                        <br />
                                        <div class="uk-form-file md-btn md-btn-primary">
                                            Select
                                            <input id="form-file" type="file" id="file2" name="file2">
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="uk-margin-medium-bottom">
                        <label for="task_assignee" class="uk-form-label">Event Status</label>
                        <select class="uk-form-width-medium" name="status" placeholder="<?= rebackPost('status', $datadb['status']) ?>" id="status" data-md-selectize-inline>
                            <option value="">-- Select Status --</option>
                            <option value="soon">Comming Soon</option>
                            <option value="past">Past Event</option>
                        </select>
                    </div>
                    <div class="uk-margin-medium-bottom">
                        <label for="is_slide" class="uk-form-label">Featured Slide</label>
                        <select class="uk-form-width-medium" name="is_slide" placeholder="<?= rebackPost('is_slide', $datadb['is_slide']) ?>" id="status" data-md-selectize-inline>
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
                    </div>
                        <div class="uk-grid">
                            <div class="uk-width-medium-1-1 uk-row-first">

                                <h5 class="heading_e">
                        Slider Photo (Home)<br />
                        Actual Size (1219 x 426 px)
                    </h5>
                                <div align="center">
                                    <?php
                            if( file_exists( getThumbnailsImage($datadb['file3'], $datadb['extension3']) ) ){
                                echo '<img src="'.base_url().getThumbnailsImage($datadb['file3'], $datadb['extension3']).'"/>';
                            }else{
                                echo '<img width="50%" height="50%" src="http://placehold.it/1219x426"/>';
                            }
                            ?>
                                        <br />
                                        <div class="uk-form-file md-btn md-btn-primary">
                                            Select
                                            <input id="form-file" type="file" id="file3" name="file3">
                                        </div>
                                </div>
                            </div>
                        </div>                    
                    <div class="uk-width-large-1-4 uk-width-medium-2-2 uk-grid-margin uk-row-first">
                        <div class="uk-input-group">
                            <button class="md-btn md-btn-primary md-btn-wave-light waves-effect waves-button waves-light">Save</button>
                            <a href="javascript:;"  class="md-btn md-btn-danger md-btn-wave-light waves-effect waves-button waves-light act-remove-table" data-url="<?php $initTable = $datadb['event_id']; echo  base_url($this->app_name).'/remove/'.$initTable; ?>" title="Remove">Delete</a>
                            <a href="javascript:window.history.go(-1);" class="md-btn md-btn-success md-btn-wave-light waves-effect waves-button waves-light">Cancel</a>
                        </div>
                    </div>
                </form>
        <?php endif; ?>
    </div>
</div>



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