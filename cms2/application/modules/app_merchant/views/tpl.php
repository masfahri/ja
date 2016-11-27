<span>&nbsp;</span>
<span>&nbsp;</span>
<span>&nbsp;</span>
<span>&nbsp;</span>


<div class="md-card">
    <div class="md-card-content">
        <div class="uk-overflow-container uk-margin-bottom">
            <!-- OUTPUT MESSAGE -->
            <?= $this->messagecontroll->showMessage() ?>
                <!-- OUTPUT MESSAGE -->
                <?php if( $this->initial_template == '' ): ?>
                    <table class="uk-table uk-table-align-vertical uk-table-nowrap tablesorter tablesorter-altair" id="ts_issues">
                        <thead>
                            <tr>
                                <th class="uk-text-center">ID</th>
                                <th>Merchant Name</th>
                                <th>Merchant Place</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th class="uk-text-center">ID</th>
                                <th>Merchant Name</th>
                                <th>Merchant Place</th>
                                <th>Description</th>
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
	                                            <a href="'.base_url($this->app_name).'/edit/'.$row['id'].'">'.$row['merchant_name'].'</a>
	                                        </td>
	                                        <td>'.$row['merchant_place'].'</td>
	                                        <td>'.character_limiter($row['merchant_desc'], 20).'</a></td>
	                                    </tr>';
	                            }}else{
	                                echo '
	                                    <tr>
	                                        <td class="uk-text-center"><span class="uk-text-small uk-text-muted uk-text-nowrap"></span></td>
	                                        <td>
	                                           
	                                        </td>
	                                        <td><span class="uk-text-danger">Tidak ada data</span></td>
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
        <form action="<?= base_url( $this->app_name ) ?>" method="post" class="uk-form-stacked" enctype="multipart/form-data">        
        <div class="uk-margin-medium-bottom">
            <label for="description">Page description</label>
            <hr>
            <textarea class="md-input" id="page_desc" name="page_desc"><?= $page_desc['page_desc'] ?></textarea>
        </div>
        <div class="uk-width-large-1-4 uk-width-medium-2-2 uk-grid-margin uk-row-first">
            <div class="uk-input-group">
                <button class="md-btn md-btn-primary md-btn-wave-light waves-effect waves-button waves-light">Save</button>
            </div>
        </div>
        </form>                 
        <?php elseif( $this->initial_template == 'add' ): ?>
            <form action="<?= base_url('app_merchant/add' ) ?>" method="post" enctype="multipart/form-data">
                <div class="uk-margin-medium-bottom">
                    <label for="event_name">Merchant name</label>
                    <input type="text" class="md-input" id="merchant_name" name="merchant_name" />
                </div>
                <div class="uk-margin-medium-bottom">
                    <label for="event_name">Merchant place</label>
                    <input type="text" class="md-input" id="merchant_place" name="merchant_place" />
                </div>
                <div class="uk-margin-medium-bottom">
                    <label for="description">Merchant description</label>
                    <hr>
                    <textarea class="md-input" id="merchant_desc" name="merchant_desc"></textarea>
                </div>                                                             
                <div class="md-card-content">
                    <div class="uk-grid">
                        <div class="uk-width-medium-1-2 uk-row-first">

                            <h5 class="heading_e">
                        Merchant Image<br />
                        Actual. Size (240 x 203 px)
                    </h5>
                            <div align="center">
                                <?php
                            if( file_exists( getThumbnailsImage($datadb['file'], $datadb['extention']) ) ){
                                echo '<img src="'.base_url().getThumbnailsImage($datadb['file'], $datadb['extention']).'"/>';
                            }else{
                                echo '<img src="http://placehold.it/240x203"/>';
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
                    <label for="event_name">Merchant name</label>
                    <input type="text" class="md-input" id="merchant_name" value="<?= rebackPost('merchant_name', $datadb['merchant_name']) ?>" name="merchant_name" />
                </div>
                <div class="uk-margin-medium-bottom">
                    <label for="event_name">Merchant place</label>
                    <input type="text" class="md-input" id="merchant_place" value="<?= rebackPost('merchant_place', $datadb['merchant_place']) ?>" name="merchant_place" />
                </div>
                <div class="uk-margin-medium-bottom">
                    <label for="description">Merchant description</label>
                    <hr>
                    <textarea class="md-input" id="merchant_desc" value="<?= rebackPost('merchant_desc', $datadb['merchant_desc']) ?>" name="merchant_desc"><?= rebackPost('merchant_desc', $datadb['merchant_desc']) ?></textarea>
                </div>                                                             
                <div class="md-card-content">
                    <div class="uk-grid">
                        <div class="uk-width-medium-1-2 uk-row-first">

                            <h5 class="heading_e">
                        Merchant Image<br />
                        Actual. Size (240 x 203 px)
                    </h5>
                            <div align="center">
                                <?php
                            if( file_exists( getThumbnailsImage($datadb['file'], $datadb['extention']) ) ){
                                echo '<img width="240" height="203" src="'.base_url().getThumbnailsImage($datadb['file'], $datadb['extention']).'"/>';
                            }else{
                                echo '<img src="http://placehold.it/240x203"/>';
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
                <div class="uk-width-large-1-4 uk-width-medium-2-2 uk-grid-margin uk-row-first">
                    <div class="uk-input-group">
                        <button class="md-btn md-btn-primary md-btn-wave-light waves-effect waves-button waves-light">Save</button>
                         <a href="javascript:;"  class="md-btn md-btn-danger md-btn-wave-light waves-effect waves-button waves-light act-remove-table" data-url="<?php $initTable = $datadb['id']; echo  base_url($this->app_name).'/remove/'.$initTable; ?>" title="Remove">Delete</a>
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