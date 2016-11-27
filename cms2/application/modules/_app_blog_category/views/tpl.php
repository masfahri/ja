
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
                                 
                                        $tools = '
                                        <div class="tools-table">
                                            <a href="'.base_url($this->app_name).'/edit/'.$initTable.'" title="Edit"><span class="glyphicon glyphicon-edit"></span></a>
                                            &nbsp;&nbsp;
                                            <a href="javascript:;" class="act-remove-table" data-url="'.base_url($this->app_name).'/remove/'.$initTable.'" title="Remove"><span class="glyphicon glyphicon-trash"></span></a>
                                        </div>';  
                                        
                                       
                                        # count total child
                                        $totalChild = countTotalChild($row['blog_category_id']);
                                        if( $totalChild > 0 ){
                                            $totalChild = ' <span class="gray-text">( '.$totalChild.' Child )</span> ';
                                        }else{
                                            $totalChild = '';    
                                        }
                                       
                                        
                                        echo '
                                        <tr>
                                            <td valign="middle">
                                               '.$initCheckbox.'
                                            </td>
                                            <td>'.$row['page_name'].'</td>
                                            <td>'.$row['blog_category_name'].$totalChild.'</td>
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
                                    $dataPage = array(
                                    1 => 'Company',
                                    2 => 'Product',
                                    3 => 'Brands',
                                    4 => 'Career',
                                    5 => 'Pathner & Client',
                                    );
                                    
                                    foreach($dataPage as $index => $value){
                                        
                                        if( set_value('page_id') == $index ){
                                            $sel = 'selected';
                                        }else{
                                            $sel  = '';
                                        }
                                        
                                        echo '<option value="'.$index.'" '.$sel.'>'.$value.'</option>';
                                    }
                                      
                                    ?>
                                    
                                 </select>
                              </div>
                            </div>
                            <div class="control-group">
                              <label class="control-label">Blog Category Name</label>
                              <div class="controls">
                                  <input type="text" name="blog_category_name" style="width:100%;" value="<?= set_value('blog_category_name') ?>" placeholder="Empty"/>
                                   <div class="tools">
                                    <a href="javascript:;" id="link-add" onclick="addSubcategoryChild(this)"><span class="glyphicon glyphicon-plus"></span> Sub Child Category</a>
                                   </div>
                              </div>
                              <div class="sub-category" id="moreAttribute">
                                    <ul>
                                    <?php
                                    if( isset($_POST['p_category_name-last']) ){
                                        
                                        $dataLast =  $_POST['p_category_name-last'];
                                        if(count($dataLast) > 0){
                                                
                                            foreach($dataLast as $row){   
                                                echo '
                                                <li class="padd-1">
                                                   <div class="controls">
                                                      <input type="text" name="p_category_name-last[]" value="'.$row.'" placeholder="........"/> <span class="glyphicon glyphicon-remove" onclick="rmvAttr(this)"></span>
                                                  </div>
                                                </li>';
                                            }
                                        }   
                                    }
                                    ?>
                                    </ul>
                              </div>
                            </div>
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
                                    $dataPage = array(
                                    1 => 'Company',
                                    2 => 'Product',
                                    3 => 'Brands',
                                    4 => 'Career',
                                    5 => 'Pathner & Client',
                                    );
                                    
                                    foreach($dataPage as $index => $value){
                                        
                                        if( rebackPost( set_value('page_id'), $datadb['page_id'] ) == $index ){
                                            $sel = 'selected';
                                        }else{
                                            $sel  = '';
                                        }
                                        
                                        echo '<option value="'.$index.'" '.$sel.'>'.$value.'</option>';
                                    }
                                      
                                    ?>
                                    
                                 </select>
                              </div>
                            </div>
                            <div class="control-group">
                                  <label class="control-label">Blog Category Name</label>
                                  <div class="controls">
                                      <input type="text" name="blog_category_name" value="<?= rebackPost('blog_category_name', $datadb['blog_category_name']) ?>" placeholder="Empty" style="width: 100%;"/>
                                     <div class="tools">
                                        <a href="javascript:;" id="link-add" onclick="addSubcategoryChild(this)"><span class="glyphicon glyphicon-plus"></span> Sub Child Category</a>
                                      </div>
                                  </div>
                                  
                                   <div>
                                
                                        <div class="sub-category" id="moreAttribute">
                                            <ul>
                                                <?php
                                                if(count($dataLast) > 0){
                                                    foreach($dataLast as $row){
                                                                         
                                                        echo '
                                                        <li class="padd-1">
                                                           <div class="controls">
                                                              <input type="text" name="p_category_name-last['.$row['blog_category_child_id'].']" value="'.$row['child_name'].'" placeholder="........"/> <a href="'.base_url('app_blog_category/removeChild').'?id_child='.$row['blog_category_child_id'].'"><span class="glyphicon glyphicon-remove"></span></a>
                                                          </div>
                                                        </li>';
                                                    }
                                                }
                                                ?>
                                            </ul>
                                        </div>
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
