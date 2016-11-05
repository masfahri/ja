
    <!-- Page Content -->
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6 text-left">
                   <h4><?= $this->initialPage ?></h4>
                </div>
                <div class="col-md-6 text-right">
                   <div class="btn-group" role="group" aria-label="...">
                      <?php if( $this->uri->segment(2) == 'data' ): ?>
                          <div class="btn-group" role="group">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Download
                              <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                              <li><a href="<?= base_url('app_subscriber/download') ?>">Excel</a></li>
                            </ul>
                          </div>
                      <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div  id="page-content">          
                   <!-- SEARCH TOOLS -->
                       <?= $this->load->view('../../layout/search_tools') ?>
                   <!-- ============ -->
                   <!-- OUTPUT MESSAGE -->
                   <?= $this->messagecontroll->showMessage() ?>
                   <!-- OUTPUT MESSAGE -->
                  <table class="table table-condensed table-striped table-bordered table-hover no-margin">
                    <thead>
                      <tr>
                        <th style="width:50%">Email<a href="javascript:;"><span class="glyphicon glyphicon-sort"></span></a></th>
                        <th style="width:30%">Register Date<a href="javascript:;"><span class="glyphicon glyphicon-sort"></span></a></th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php 
                    if( count($datadb) > 0 ){
                        foreach($datadb as $row){

                            $initTable = $row['u_subscribe_id'];
                       
                            echo '
                            <tr>
                                <td>'.$row['u_subscribe_email'].'</td>
                                <td>'.$row['register_date'].'</td>
                             </tr>';
                        }
                    }
                    ?>
                    </tbody>
                  </table>
                
                <div class="col-md-6">Result  <?= count($datadb) ?> - <?= $result_all?></div>
                <div class="col-md-6"><div class="cs-pagination"><?=  $this->pagination->create_links() ?></div></div>
            </div>
        </div>
    </div>
    <!-- End Container -->
