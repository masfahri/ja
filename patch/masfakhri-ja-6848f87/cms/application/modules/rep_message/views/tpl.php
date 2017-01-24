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

    <?php if($this->initial_template == ''): ?>
    <!-- Page Content -->
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6 text-left">
                   <h4><?= $this->initialPage ?></h4>
                </div>
                <div class="col-md-6 text-right">
                   <div class="btn-group" role="group" aria-label="...">
                      <?php if( $this->uri->segment(2) == '' ): ?>
                        <a href="<?= base_url($this->app_name) ?>/download" class="md-btn md-btn-success md-btn-wave-light waves-effect waves-button waves-light"> Export to excel</a>
                      <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div  id="page-content">          
                   <!-- OUTPUT MESSAGE -->
                   <?= $this->messagecontroll->showMessage() ?>
                   <!-- OUTPUT MESSAGE -->
                    <table class="uk-table uk-table-align-vertical uk-table-nowrap tablesorter tablesorter-altair" id="ts_issues">
                        <thead>
                            <tr>
                                <th class="uk-text-center">ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Subject</th>
                                <th>Send Date</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th class="uk-text-center">ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Subject</th>
                                <th>Send Date</th>
                            </tr>
                        </tfoot>
                        <tbody>
                        <?php 
                          if( count($datadb) > 0 ){
                              foreach($datadb as $row){                         
                                  echo '                    
                                      <tr>
                                          <td class="uk-text-center"><span class="uk-text-small uk-text-muted uk-text-nowrap">'.$row['contact_id'].'</span></td>
                                          <td>
                                               <a href="'.base_url($this->app_name).'/preview/'.$row['contact_id'].'">'.$row['name'].'</a>
                                          </td>
                                          <td>'.$row['email'].'</td>
                                          <td>'.$row['subject'].'</a></td>
                                          <td>'.date('d/m/y h:i:s', strtotime($row['send_date'])).'</a></td>
                                      </tr>';
                              }}else{
                                  echo '
                                      <tr>
                                          <td class="uk-text-center"><span class="uk-text-small uk-text-muted uk-text-nowrap"></span></td>
                                          <td>
                                             
                                          </td>
                                          <td><span class="uk-text-danger">Tidak ada data</span></td>
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


            </div>
        </div>
    </div>
    <!-- End Container -->
      <?php elseif( $this->initial_template == 'preview' ): ?>
            <form action="<?= base_url( $this->app_name ).'/download/'.$this->initial_id ?>" method="post" class="uk-form-stacked" enctype="multipart/form-data">
                    <div class="uk-margin-medium-bottom">
                        <label for="task_title">Name</label>
                        <input type="text" class="md-input" id="name" value="<?= rebackPost('name', $datadb[0]['name']) ?>" name="name" disabled/>
                    </div>
                    <div class="uk-margin-medium-bottom">
                        <label for="task_title">E-mail</label>
                        <input type="text" class="md-input" id="place" value="<?= rebackPost('email', $datadb[0]['email']) ?>" name="email" disabled/>
                    </div>
                    <div class="uk-margin-medium-bottom">
                        <label for="task_title">Subject</label>
                        <input type="text" class="md-input" id="place" value="<?= rebackPost('subject', $datadb[0]['subject']) ?>" name="subject" disabled/>
                    </div>

                    <div class="uk-margin-medium-bottom">
                        <label for="task_description">Message</label>
                        <br />
                        <textarea class="md-input" id="message" name="message" disabled><?= rebackPost('message', $datadb[0]['message']) ?></textarea>
                    </div>
                    <hr>         
                    <div class="uk-width-large-1-4 uk-width-medium-2-2 uk-grid-margin uk-row-first">
                        <div class="uk-input-group">
                            <button class="md-btn md-btn-primary md-btn-wave-light waves-effect waves-button waves-light">Download</button>
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