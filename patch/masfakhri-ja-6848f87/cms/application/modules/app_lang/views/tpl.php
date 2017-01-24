
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
                              <button type="button" class="btn btn-success exlink" data-url="<?= base_url('app_lang').'/add' ?>"><span class="glyphicon glyphicon-plus"></span> New Entry</button>
                          <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div  id="page-content">          
                    <?php if( $this->initial_template == 'data' ): ?>
                      
                           <!-- SEARCH TOOLS -->
                           <?= $this->load->view('../../layout/search_tools') ?>
                           <!-- ============ -->
                           <form action="<?= base_url('app_lang').'/removeAll' ?>" method="post" id="form1">
                               <!-- OUTPUT MESSAGE -->
                               <?= $this->messagecontroll->showMessage() ?>
                               <!-- OUTPUT MESSAGE -->
                              <table class="table table-condensed table-striped table-bordered table-hover no-margin">
                                <thead>
                                  <tr>
                                    <th style="width:2%;"><span class="glyphicon glyphicon-ok" onclick="globalChecked()"></span></th>
                                    <th style="width:3%">Flag <a href="javascript:;"><span class="glyphicon glyphicon-sort"></span></a></th>
                                    <th style="width:10%">Countries IDX <a href="javascript:;"><span class="glyphicon glyphicon-sort"></span></a></th>
                                    <th style="width:40%">Countries Name <a href="javascript:;"><span class="glyphicon glyphicon-sort"></span></a></th>
                                    <th style="width:5%">Active <a href="javascript:;"><span class="glyphicon glyphicon-sort"></span></a></th>
                                    <th style="width:5%">Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                <?php 
                                if( count($datadb) > 0 ){
                                    foreach($datadb as $row){
            
                                        $initTable = $row['countries_id'];
                                        if( checkAsDefaultLang($row['countries_id']) == TRUE ){
                                            $actionTools = '<span class="green-text">DEFAULT LANGUAGE</span>';
                                            $checkbox    = '';
                                        }else{
                                            $actionTools = '
                                               <div class="tools-table">
                                                    <a href="'.base_url($this->app_name).'/edit/'.$initTable.'" title="Edit"><span class="glyphicon glyphicon-edit"></span></a>
                                                    &nbsp;&nbsp;
                                                    <a href="javascript:;" class="act-remove-table" data-url="'.base_url($this->app_name).'/remove/'.$initTable.'" title="Remove"><span class="glyphicon glyphicon-trash"></span></a>
                                                </div>
                                            ';
                                            
                                            $checkbox = '
                                            <div class="checkbox check-default">
                                                <input name="id_table[]" type="checkbox" name="tableid[]" value="'.$initTable.'" id="checkbox'.$initTable.'">
                                            </div>';
                                        }
                                        
                                        # set active
                                        if( $row['active'] == 'no' )$spanClass  = 'red-text';
                                        else $spanClass = 'green-text';
                                        
                                        # file image
                                        $file_image = '<span class="gray-text">no image</span>';
                                        if( $row['file'] !== "" ){
                                            if( file_exists( base_url().$row['file'] ) ){
                                                $file_image = '<img src="'.base_url().$row['file'].'"/>';
                                            }
                                        }
                                        
                                        echo '
                                        <tr>
                                            <td valign="middle">
                                               '.$checkbox.'
                                            </td>
                                            <td>'.$file_image.'</td>
                                            <td>'.$row['countries_idx'].'</td>
                                            <td>'.$row['countries_name'].'</td>
                                            <td><span class="'.$spanClass.'">'.strtoupper($row['active']).'</span></td>
                                            <td>
                                                '.$actionTools.'
                                            </td>
                                         </tr>';
                                    }
                                }else{
                                    echo  '<tr><td colspan="6"><pan class="red-text">Data not found !</span></td></tr>';
                                }
                                ?>
                                </tbody>
                              </table>
                        </form>
                        <div class="col-md-6">Result  <?= count($datadb) ?> - <?= $result_all?></div>
                        <div class="col-md-6"><div class="cs-pagination"><?=  $this->pagination->create_links() ?></div></div>
                    <?php elseif( $this->initial_template == 'add' ): ?>
                         <form action="<?= base_url('app_lang').'/add' ?>" method="post" enctype="multipart/form-data">
                            <h4 class="text-info">Form Input</h4>
                            <hr/>
                            <!-- OUTPUT MESSAGE -->
                            <?= $this->messagecontroll->showMessage() ?>
                            <!-- OUTPUT MESSAGE -->
                            <div class="control-group">
                              <label class="control-label">Set Active</label>
                              <div class="controls">
                                    <select name="active">
                                    <?php
                                    $dataLang = array('no', 'yes');
                                    foreach($dataLang as $row){
                                        
                                        if( set_value('active') == $row )$sel  = 'selected';
                                        else $sel  = '';
                                        
                                        echo '<option value="'.$row.'" '.$sel.'>'.strtoupper($row).'</option>';
                                    }
                                    ?>
                                    </select>
                              </div>
                            </div>
                            <div class="control-group">
                              <label class="control-label">Image Icon</label>
                              <div class="controls">
                                  <input type="file" name="fileupl"/>
                                  <div class="notif-info">
                                    <p>File image must be in extention <b>(JPG, JPEG, PNG)</b> </p>
                                    <p>File image must be in size <b>( 18 x 12 )</b> </p>
                                  </div>
                              </div>
                            </div>
                            <div class="control-group">
                              <label class="control-label">Countries Name</label>
                              <div class="controls">
                                  <input type="text" name="countries_name" value="<?= set_value('countries_name') ?>" placeholder="Empty"/>
                              </div>
                            </div>
                            <div class="control-group">
                              <label class="control-label">Countries IDX</label>
                              <div class="controls">
                                  <input type="text" name="countries_idx" value="<?= set_value('countries_idx') ?>" placeholder="Empty" style="width: 30%;"/>
                              </div>
                            </div>
                            <div class="form-actions no-margin">
                              <button type="reset" class="btn">Cancel</button>
                              <button type="submit" class="btn btn-info">Save</button>
                            </div>
                          </form>     
                    <?php elseif( $this->initial_template == 'edit' ): ?>
                          <form action="<?= base_url('app_lang').'/edit/'.$this->initial_id ?>" method="post"  enctype="multipart/form-data">
                            <h5 class="text-info">Article Category</h5>
                            <hr/>
                            <!-- OUTPUT MESSAGE -->
                            <?= $this->messagecontroll->showMessage() ?>
                            <!-- OUTPUT MESSAGE -->
                            <div class="control-group">
                              <label class="control-label">Set Active</label>
                              <div class="controls">
                                  <select name="active">
                                    <?php
                                    $dataLang = array('no', 'yes');
                                    foreach($dataLang as $row){
                                        
                                        if( rebackPost('active', $datadb['active']) == $row )$sel  = 'selected';
                                        else $sel  = '';
                                        
                                        echo '<option value="'.$row.'" '.$sel.'>'.strtoupper($row).'</option>';
                                    }
                                    ?>
                                    </select>
                              </div>
                            </div>
                            <div class="control-group">
                              <label class="control-label">Image Icon</label>
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
                               &nbsp; <input type="file" name="fileupl"/>
                               <div class="notif-info">
                                    <p>File image must be in extention <b>(JPG, JPEG, PNG)</b> </p>
                                    <p>File image must be in size <b>( 18 x 12 )</b> </p>
                                  </div>
                              </div>
                            </div>
                            <div class="control-group">
                              <label class="control-label">Countries Name</label>
                              <div class="controls">
                                  <input type="text" name="countries_name" value="<?= rebackPost('countries_name', $datadb['countries_name']) ?>" placeholder="Empty"/>
                              </div>
                            </div>
                            <div class="control-group">
                              <label class="control-label">Countries IDX</label>
                              <div class="controls">
                                  <input type="text" name="countries_idx" value="<?= rebackPost('countries_idx', $datadb['countries_idx']) ?>" placeholder="Empty" style="width: 30%;"/>
                              </div>
                            </div>
                            <div class="form-actions no-margin">
                              <button type="reset" class="btn">Cancel</button>
                              <button type="submit" class="btn btn-info">Update</button>
                            </div>
                          </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <!-- End Container -->
