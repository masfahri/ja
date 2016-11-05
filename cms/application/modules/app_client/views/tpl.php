
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
                              <button type="button" class="btn btn-success exlink" data-url="<?= base_url($this->app_name).'/add' ?>"><span class="glyphicon glyphicon-plus"></span> New Entry</button>
                          <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div  id="page-content">          
                    <?php if( $this->initial_template == 'data' ): ?>
                        <form action="<?= base_url($this->app_name).'/removeAll' ?>" method="post">
                            <h4 class="text-info">Master Data</h4>
                          <hr/>
                           <!-- OUTPUT MESSAGE -->
                           <?= $this->messagecontroll->showMessage() ?>
                           <!-- OUTPUT MESSAGE -->
                           <table class="table table-condensed table-striped table-bordered table-hover no-margin">
                                <thead>
                                  <tr>
                                    <th width="1%" valign="center"><span class="glyphicon glyphicon-ok" onclick="globalChecked()"></span></th>
                                    <th style="width:5%">Image <a href="javascript:;"><span class="glyphicon glyphicon-sort"></span></a></th>
                                    <th style="width:15%">Client Name <a href="javascript:;"><span class="glyphicon glyphicon-sort"></span></a></th>
                                    <th style="width:15%">Create Date <a href="javascript:;"><span class="glyphicon glyphicon-sort"></span></a></th>
                                    <th style="width:15%">Author <a href="javascript:;"><span class="glyphicon glyphicon-sort"></span></a></th>
                                    <th style="width:5%">Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                <?php 
                                if( count($datadb) > 0 ){

                                    $dataLock = array();
                                    foreach($datadb as $row){
            
                                        $initTable = $row['client_id'];
                                        $checkAuthor = getAuthorName($row['author']);
                                        if( $checkAuthor != null ){
                                             $showAuthor = $checkAuthor;
                                        }else{ $showAuthor = '<span class="red-text">Author Unregistered</span>'; }
                                        
                                        
                                        $tools = '
                                        <div class="tools-table">
                                            <a href="'.base_url($this->app_name).'/edit/'.$initTable.'" title="Edit"><span class="glyphicon glyphicon-edit"></span></a>
                                            &nbsp;&nbsp;
                                            <a href="javascript:;" class="act-remove-table" data-url="'.base_url($this->app_name).'/remove/'.$initTable.'" title="Remove"><span class="glyphicon glyphicon-trash"></span></a>
                                        </div>';   
                                        
                                        echo '
                                        <tr>
                                            <td valign="middle">
                                                <div class="checkbox check-default">
                                                    <input name="id_table[]" type="checkbox" name="tableid[]" value="'.$initTable.'" id="checkbox'.$initTable.'">
                                                </div>
                                            </td>
                                            <td><div class="img-table"><img src="'.base_url().getThumbnailsImage($row['file'], $row['extention']).'"/></div></td>
                                            <td>'.$row['client_name'].'</td>
                                            <td>'.$row['date'].'</td>
                                            <td>'.$showAuthor.'</td>
                                            <td>'.$tools.'</td>
                                         </tr>';
                                    }
                                }else{
                                    echo '<tr><td colspan="6"><span class="gray-text">Data Not Found</span></td></tr>';
                                }
                                ?>
                                </tbody>
                              </table>
                        </form>
                        <div class="col-md-6">Result  <?= count($datadb) ?> - <?= $result_all?></div>
                        <div class="col-md-6"><div class="cs-pagination"><?=  $this->pagination->create_links() ?></div></div>
                    <?php elseif( $this->initial_template == 'add' ): ?>
                         <form action="<?= base_url($this->app_name).'/add' ?>" method="post" enctype="multipart/form-data">
                            <h4 class="text-info">Form Input</h4>
                            <hr/>
                            <!-- OUTPUT MESSAGE -->
                            <?= $this->messagecontroll->showMessage() ?>
                            <!-- OUTPUT MESSAGE -->
                            <div class="control-group">
                              <label class="control-label">Client Image</label>
                              <div class="controls">
                                  <input type="file" name="fileupl" style="width:100%;" />
                              </div>
                            </div>
                            <div class="control-group">
                              <label class="control-label">Client Name</label>
                              <div class="controls">
                                  <input type="text" name="client_name" style="width:100%;" value="<?= set_value('client_name') ?>" placeholder="Empty"/>
                              </div>
                            </div>                        
                            <div class="form-actions no-margin">
                              <button type="reset" class="btn">Cancel</button>
                              <button type="submit" class="btn btn-info">Save</button>
                            </div>
                          </form>     
                    <?php elseif( $this->initial_template == 'edit' ): ?>
                          <form action="<?= base_url($this->app_name).'/edit/'.$this->initial_id ?>" method="post" enctype="multipart/form-data">
                            <h4 class="text-info">Form Input</h4>
                            <hr/>
                            <!-- OUTPUT MESSAGE -->
                            <?= $this->messagecontroll->showMessage() ?>
                            <!-- OUTPUT MESSAGE -->
                            <div class="control-group">
                              <label class="control-label">Client Image</label>
                              <div class="controls">
                                <div id="result-upload">
                                    <ul>
                                        <li>
                                          <?php
                                            if( file_exists( getThumbnailsImage($datadb['file'], $datadb['extention']) ) ){
                                                echo '<img src="'.base_url().getThumbnailsImage($datadb['file'], $datadb['extention']).'"/>';
                                            }else{
                                                echo '<div class="no-image"><span class="glyphicon glyphicon-picture"></span></div>';
                                            }
                                           ?>
                                           </li>
                                    </ul>
                                </div> 
                                <input type="file" name="fileupl"  placeholder="Empty"/>
                              </div>
                            </div>
                            <div class="control-group">
                              <label class="control-label">Client Name</label>
                              <div class="controls">
                                  <input type="text" name="client_name" style="width:100%;" value="<?= rebackPost('client_name', $datadb['client_name']) ?>" placeholder="Empty"/>
                              </div>
                            </div>
                            <div class="form-actions no-margin">
                              <button type="reset" class="btn">Cancel</button>
                              <button type="submit" class="btn btn-info">Save</button>
                            </div>
                          </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>

    <!-- End Container -->
