
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
                              <button type="button" class="btn btn-success exlink" data-url="<?= base_url('app_blog_category').'/add' ?>"><span class="glyphicon glyphicon-plus"></span> New Entry</button>
                          <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div  id="page-content">          
                    <?php if( $this->initial_template == 'data' ): ?>
                        <form action="<?= base_url('app_blog_category').'/removeAll' ?>" method="post">
                            <h4 class="text-info">Master Data</h4>
                          <hr/>
                           <!-- OUTPUT MESSAGE -->
                           <?= $this->messagecontroll->showMessage() ?>
                           <!-- OUTPUT MESSAGE -->
                           <table class="table table-condensed table-striped table-bordered table-hover no-margin">
                                <thead>
                                  <tr>
                                    <th width="1%" valign="center"><span class="glyphicon glyphicon-ok" onclick="globalChecked()"></span></th>
                                    <th style="width:7%">Page <a href="javascript:;"><span class="glyphicon glyphicon-sort"></span></a></th>
                                    <th style="width:15%">Blog Category Name <a href="javascript:;"><span class="glyphicon glyphicon-sort"></span></a></th>
                                    <th style="width:15%">Create Date <a href="javascript:;"><span class="glyphicon glyphicon-sort"></span></a></th>
                                    <th style="width:15%">Author <a href="javascript:;"><span class="glyphicon glyphicon-sort"></span></a></th>
                                    <th style="width:5%">Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                <?php 
                                if( count($datadb) > 0 ){
                                    
                                    // 41 as Tahukah Kamu
                                    $dataLock = array(41);
                                    foreach($datadb as $row){
            
                                        $initTable = $row['blog_category_id'];
                                        $checkAuthor = getAuthorName($row['author']);
                                        if( $checkAuthor != null ){
                                             $showAuthor = $checkAuthor;
                                        }else{ $showAuthor = '<span class="red-text">Author Unregistered</span>'; }
                                        
                                        # lock category
                                       $initCheckbox = '
                                        <div class="checkbox check-default">
                                            <input name="id_table[]" type="checkbox" name="tableid[]" value="'.$initTable.'" id="checkbox'.$initTable.'">
                                        </div>';
                                        
                                        if( in_array($initTable, $dataLock) ){
                                           $tools = '
                                            <div class="tools-table">
                                              <span class="glyphicon glyphicon-lock"></span>  <span class="gray-text">Locked </span>
                                            </div>';  
                                        }else{
                                            $tools = '
                                            <div class="tools-table">
                                                <a href="'.base_url($this->app_name).'/edit/'.$initTable.'" title="Edit"><span class="glyphicon glyphicon-edit"></span></a>
                                                &nbsp;&nbsp;
                                                <a href="javascript:;" class="act-remove-table" data-url="'.base_url($this->app_name).'/remove/'.$initTable.'" title="Remove"><span class="glyphicon glyphicon-trash"></span></a>
                                            </div>';  
                                        }
                                        
                                       
                                        
                                        echo '
                                        <tr>
                                            <td valign="middle">
                                               '.$initCheckbox.'
                                            </td>
                                            <td>'.$row['page_name'].'</td>
                                            <td>'.$row['blog_category_name'].'</td>
                                            <td>'.$row['create_date'].'</td>
                                            <td>'.$showAuthor.'</td>
                                            <td>'.$tools.'</td>
                                         </tr>';
                                    }
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
                              <label class="control-label">Page</label>
                              <div class="controls">
                                 <select name="page_id">
                                    <?php
                                    $dataPage = getPageBlog();
                                    foreach($dataPage as $row){
                                        
                                        if( set_value('page_id') == $row ){
                                            $sel = 'selected';
                                        }else{
                                            $sel  = '';
                                        }
                                        
                                        echo '<option value="'.$row['page_id'].'" '.$sel.'>'.$row['page_name'].'</option>';
                                    }
                                    ?>
                                    
                                 </select>
                              </div>
                            </div>
                            <div class="control-group">
                              <label class="control-label">Blog Category Name</label>
                              <div class="controls">
                                  <input type="text" name="blog_category_name" style="width:100%;" value="<?= set_value('blog_category_name') ?>" placeholder="Empty"/>
                              </div>
                            </div>
                            <!--
                            <div class="control-group">
                               <label class="control-label">Blog Description</label>
                               <div class="controls">
                                 <textarea class="ckeditor" name="blog_category_desc"><?=  set_value('blog_category_desc') ?></textarea>
                                </div>
                            </div>
                            -->
                            <div class="form-actions no-margin">
                              <button type="reset" class="btn">Cancel</button>
                              <button type="submit" class="btn btn-info">Save</button>
                            </div>
                          </form>     
                    <?php elseif( $this->initial_template == 'edit' ): ?>
                          <form action="<?= base_url( $this->app_name ).'/edit/'.$this->initial_id ?>" method="post"  enctype="multipart/form-data">
                            <h5 class="text-info">Form Edit</h5>
                            <hr/>
                            <!-- OUTPUT MESSAGE -->
                            <?= $this->messagecontroll->showMessage() ?>
                            <!-- OUTPUT MESSAGE -->
                           <div class="control-group">
                              <label class="control-label">Page</label>
                              <div class="controls">
                                 <select name="page_id">
                                    <?php
                                    $dataPage = getPageBlog();
                                    foreach($dataPage as $row){
                                        
                                        if( rebackPost( set_value('page_id'), $datadb['page_id'] ) == $row['page_id'] ){
                                            $sel = 'selected';
                                        }else{
                                            $sel  = '';
                                        }
                                        echo '<option value="'.$row['page_id'].'" '.$sel.'>'.$row['page_name'].'</option>';
                                    }
                                    ?>
                                    
                                 </select>
                              </div>
                            </div>
                            <div class="control-group">
                              <label class="control-label">Blog Category Name</label>
                              <div class="controls">
                                  <input type="text" name="blog_category_name" value="<?= rebackPost('blog_category_name', $datadb['blog_category_name']) ?>" placeholder="Empty" style="width: 100%;"/>
                              </div>
                            </div>
                            <!--
                            <div class="control-group">
                                <label class="control-label">Blog Description</label>
                                <div class="controls">
                                 <textarea class="ckeditor" name="blog_category_desc"><?=  rebackPost('blog_category_desc', $datadb['blog_category_desc']) ?></textarea>
                                </div>
                            </div>-->
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
