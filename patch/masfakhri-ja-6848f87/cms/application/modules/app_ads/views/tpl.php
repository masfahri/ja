<span>&nbsp;</span>
<span>&nbsp;</span>
<span>&nbsp;</span>
<span>&nbsp;</span>


<div class="md-card">
    <div class="md-card-content">
        <div class="uk-overflow-container uk-margin-bottom">
            <h3 class="heading_e">Ads</h3>
            <!-- OUTPUT MESSAGE -->
            <?= $this->messagecontroll->showMessage() ?>
                <!-- OUTPUT MESSAGE -->
                <?php if( $this->initial_template == '' ): ?>
                    <table class="uk-table uk-table-align-vertical uk-table-nowrap tablesorter tablesorter-altair" id="ts_issues">
                        <thead>
                            <tr>
                                <th class="uk-text-center">ID</th>
                                <th>Ads Title</th>
                                <th>Ads Place</th>
                                <th>URL</th>
                                <th>Expired</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th class="uk-text-center">ID</th>
                                <th>Ads Title</th>
                                <th>Ads Place</th>
                                <th>URL</th>
                                <th>Expired</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php 
                        if( count($datadb) > 0 ){
                            foreach($datadb as $row){                         
                                echo '                    
                                    <tr>
                                        <td class="uk-text-center"><span class="uk-text-small uk-text-muted uk-text-nowrap">'.$row['ads_id'].'</span></td>
                                        <td>
                                            <a href="'.base_url($this->app_name).'/edit/'.$row['ads_id'].'">'.$row['title'].'</a>
                                        </td>
                                        <td>'.$row['place_name'].'</td>
                                        <td><a href="'.$row['url'].'">'.$row['url'].'</a></td>
                                        <td>'.date ("d/M/Y",strtotime($row['expired'])).'</td>
                                    </tr>';
                            }}else{
                                echo '
                                    <tr>
                                        <td class="uk-text-center"><span class="uk-text-small uk-text-muted uk-text-nowrap"></span></td>
                                        <td>
                                           
                                        </td>
                                        <td><span class="uk-text-danger">Tidak ada Ads</span></td>
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
            <form action="<?= base_url('app_ads/add' ) ?>" method="post" enctype="multipart/form-data">
                <div class="uk-margin-medium-bottom">
                    <label for="event_name">Ads Title</label>
                    <input type="text" class="md-input" id="title" name="title" />
                </div>
                <div class="uk-margin-medium-bottom">
                    <label for="event_place">Ads Place</label>
                    <select class="uk-form-width-medium" name="ads_place_id" id="ads_place_id" data-md-selectize-inline>
                        <option value="0">Select</option>                        
                        <option value="1">Top Home</option>
                        <option value="2">Bottom Home</option>
                        <option value="3">Bottom Gallery</option>
                        <option value="4">Bottom Event</option>
                        <option value="5">Footer Page</option>                        
                        <option value="6">Home Popup</option>                        
                    </select>                  
                </div>                
                <div class="uk-margin-medium-bottom">
                    <label for="event_place">URL</label>
                    <input type="text" class="md-input" id="url" name="url" />
                </div>                
                <div class="md-card-content">
                    <div class="uk-grid">
                        <div class="uk-width-medium-1-2 uk-row-first">

                            <h5 class="heading_e">
                        Ads Image<br />
                        Min. Size (607 x 190 px)
                    </h5>
                            <div align="center">
                                <?php
                            if( file_exists( getThumbnailsImage($datadb['file'], $datadb['extension']) ) ){
                                echo '<img src="'.base_url().getThumbnailsImage($datadb['file'], $datadb['extension']).'"/>';
                            }else{
                                echo '<img src="http://placehold.it/607x190"/>';
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
                <hr>
                <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-medium-1-1">
                        <label for="event_date">Select date</label>
                        <input class="md-input" type="text" id="expired" value="" name="expired" data-uk-datepicker="{format:'YYYY-MM-DD'}">                    
                    </div>
                </div>
                <div class="uk-margin-medium-bottom">
                    <label for="event_place">Status</label>
                     <select class="uk-form-width-medium" name="status" id="status" data-md-selectize-inline>
                        <option value="">-- Select Status --</option>
                        <option value="publish">Actived</option>
                        <option value="unpublish">Disabled</option>
                    </select>
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
                    <label for="event_name">Ads Title</label>
                    <input type="text" class="md-input" value="<?= rebackPost('title', $datadb['title']) ?>"  id="title" name="title" />
                </div>
                <div class="uk-margin-medium-bottom">
                    <label for="event_place">Ads Place</label>
                    <select class="uk-form-width-medium" name="ads_place_id" id="ads_place_id" data-md-selectize-inline>
                        <option value="0">Select</option>
                        <option value="1">Top Home</option>
                        <option value="2">Bottom Home</option>
                        <option value="3">Bottom Gallery</option>
                        <option value="4">Bottom Event</option>
                        <option value="5">Footer Page</option>                         
                    </select>                  
                </div>                
                <div class="uk-margin-medium-bottom">
                    <label for="event_place">URL</label>
                    <input type="text" class="md-input" value="<?= rebackPost('url', $datadb['url']) ?>"  id="url" name="url" />
                </div>                
                <div class="md-card-content">
                    <div class="uk-grid">
                        <div class="uk-width-medium-1-2 uk-row-first">

                            <h5 class="heading_e">
                        Ads Image<br />
                        Min. Size (607 x 190 px)
                    </h5>
                            <div align="center">
                                <?php
                            if( file_exists( getThumbnailsImage($datadb['file'], $datadb['extension']) ) ){
                                echo '<img src="'.base_url().getThumbnailsImage($datadb['file'], $datadb['extension']).'"/>';
                            }else{
                                echo '<img src="http://placehold.it/607x190"/>';
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
                <hr>
                <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-medium-1-1">
                        <label for="event_date">Select date</label>
                        <input class="md-input" value="<?= rebackPost('expired', $datadb['expired']) ?>"  type="text" id="expired" value="" name="expired" data-uk-datepicker="{format:'YYYY-MM-DD'}">                    
                    </div>
                </div>
                <div class="uk-margin-medium-bottom">
                    <label for="event_place">Status</label>
                     <select class="uk-form-width-medium" name="status" id="status" data-md-selectize-inline>
                        <option value="">-- Select Status --</option>
                        <option value="publish">Actived</option>
                        <option value="unpublish">Disabled</option>
                    </select>
                </div>   

                <div class="uk-width-large-1-4 uk-width-medium-2-2 uk-grid-margin uk-row-first">
                    <div class="uk-input-group">
                        <button class="md-btn md-btn-primary md-btn-wave-light waves-effect waves-button waves-light">Save</button>
                        <a href="javascript:;"  class="md-btn md-btn-danger md-btn-wave-light waves-effect waves-button waves-light act-remove-table" data-url="<?php $initTable = $datadb['ads_id']; echo  base_url($this->app_name).'/remove/'.$initTable; ?>" title="Remove">Delete</a>
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

function resettingElementSelect(initial, newVal){
    
    $(initial).hide();
    $(initial).html('');
    $(initial).html(newVal);
    $(initial).fadeIn();
}

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