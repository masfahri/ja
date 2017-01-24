    <div class="row-fluid">
        <div class="span12">
          <ul class="breadcrumb-beauty">
              <?= showBreadCrumb($this->breadcrumb, $this->initialPage) ?>  
          </ul>
        </div>
    </div>
    <br/>
    <?php if( $this->initial_template == 'data' ): ?>
    <div class="row-fluid">
        <div class="span12">
        <!-- OUTPUT MESSAGE -->
        <?= $this->messagecontroll->showMessage() ?>
        <!-- OUTPUT MESSAGE -->
          <div class="widget">
            <div class="widget-header">
              <div class="title">
                <a href="<?= base_url('app_blog_tag').'/add' ?>"><span class="fs1" aria-hidden="true" data-icon="&#xe102;"></span> New Entry</a>
              </div>
            </div>
            <div class="widget-body">
              <form action="<?= base_url('app_blog_tag').'/removeAll' ?>" method="post" id="form1">
                  <table class="table table-condensed table-striped table-bordered table-hover no-margin">
                    <thead>
                      <tr>
                        <th width="1%" valign="center"><i class="icon-ok" onclick="globalChecked()"></i></th>
                        <th style="width:10%">Blog Category</th>
                        <th style="width:10%">Blog Tag Name</th>
                        <th style="width:15%">Create Date</th>
                        <th style="width:15%">Author</th>
                        <th style="width:5%">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php 
                    if( count($datadb) > 0 ){
                        foreach($datadb as $row){

                            $initTable = $row['blog_tag_id'];
                            $checkAuthor = getAuthorName($row['author']);
                            if( $checkAuthor != null ){
                                 $showAuthor = $checkAuthor;
                            }else{ $showAuthor = '<span class="red-text">Author Unregistered</span>'; }
                            
                            echo '
                            <tr>
                                <td valign="middle">
                                    <div class="checkbox check-default">
                                        <input name="id_table[]" type="checkbox" name="tableid[]" value="'.$initTable.'" id="checkbox'.$initTable.'">
                                    </div>
                                </td>
                                <td>'.$row['blog_category_name'].'</td>
                                <td>'.$row['blog_tag_name'].'</td>
                                <td>'.$row['create_date'].'</td>
                                <td>'.$showAuthor.'</td>
                                <td>
                                    <div class="tools-table">
                                        <a href="'.base_url($this->app_name).'/edit/'.$initTable.'" title="Edit"><i class="icon-edit"></i></a>
                                        &nbsp;&nbsp;
                                        <a href="javascript:;" class="act-remove-table" data-url="'.base_url($this->app_name).'/remove/'.$initTable.'" title="Remove"><i class="icon-trash"></i></a>
                                    </div>
                                </td>
                             </tr>';
                        }
                    }
                    ?>
                    </tbody>
                  </table>
                </form>
            </div>
          </div>
        </div>
    </div>
    <?php elseif( $this->initial_template == 'add' ): ?>

    <div class="row-fluid">
        <!-- OUTPUT MESSAGE -->
        <?= $this->messagecontroll->showMessage() ?>
        <!-- OUTPUT MESSAGE -->
        <div class="span6">
          <div class="widget">
            <div class="widget-header">
              <div class="title">
                <span class="fs1" aria-hidden="true" data-icon="&#xe022;"></span> Editable Inputs
              </div>
            </div>
            <div class="widget-body">
              <form action="<?= base_url('app_blog_tag').'/add' ?>" method="post" class="form-horizontal no-margin well" enctype="multipart/form-data">
                <h5 class="text-info">Blog Tagline</h5>
                <hr/>
                <div class="control-group">
                    <label class="control-label">Blog Category</label>
                    <div class="controls">
                        <select name="blog_category_id" >
                            <option value="">-- Select Blog Category --</option>
                            <?php
                            $dataCategory = get_blogCategory();
                            if(count($dataCategory)>0){
                                
                                foreach($dataCategory as $row){
                                    
                                    if($row['blog_category_id'] == set_value('blog_category_id'))$sel = 'selected';
                                    else $sel = '';
                                    
                                    echo '<option value="'.$row['blog_category_id'].'" '.$sel.'>'.$row['blog_category_name'].'</option>';
                                }
                            }
                            ?>
                         </select>
                     </div>
                </div>
                <div class="control-group">
                  <label class="control-label">Blog Tag Name</label>
                  <div class="controls">
                      <input type="text" name="blog_tag_name" value="<?= set_value('blog_tag_name') ?>" placeholder="Empty"/>
                  </div>
                </div>
                <div class="form-actions no-margin">
                  <button type="button" class="btn">Cancel</button>
                  <button type="submit" class="btn btn-info">Save</button>
                </div>
              </form>
            </div>
          </div>
        </div>
    </div>
    <?php elseif( $this->initial_template == 'edit' ): ?>
    <div class="row-fluid">
        <!-- OUTPUT MESSAGE -->
        <?= $this->messagecontroll->showMessage() ?>
        <!-- OUTPUT MESSAGE -->
        <div class="span6">
          <div class="widget">
            <div class="widget-header">
              <div class="title">
                <span class="fs1" aria-hidden="true" data-icon="&#xe022;"></span> Editable Inputs
              </div>
            </div>
            <div class="widget-body">
              <form action="<?= base_url('app_blog_tag').'/edit/'.$this->initial_id ?>" method="post" class="form-horizontal no-margin well" enctype="multipart/form-data">
                <h5 class="text-info">Article Category</h5>
                <hr/>
                <div class="control-group">
                    <label class="control-label">Parent Category</label>
                    <div class="controls">
                        <select name="blog_category_id">
                            <option value="">-- Select Parent Category --</option>
                            <?php
                            $dataCategory = get_blogCategory();
                            if(count($dataCategory)>0){
                                
                                foreach($dataCategory as $row){
                                    
                                    if($row['blog_category_id'] == $datadb['blog_category_id'])$sel = 'selected';
                                    else $sel = '';
                                    
                                    echo '<option value="'.$row['blog_category_id'].'" '.$sel.'>'.$row['blog_category_name'].'</option>';
                                }
                            }
                            ?>
                         </select>
                     </div>
                </div>
                <div class="control-group">
                  <label class="control-label">Category Name</label>
                  <div class="controls">
                      <input type="text" name="blog_tag_name" value="<?= $datadb['blog_tag_name'] ?>" placeholder="Empty"/>
                  </div>
                </div>
                <div class="form-actions no-margin">
                  <button type="button" class="btn">Cancel</button>
                  <button type="submit" class="btn btn-info">Save</button>
                </div>
              </form>
            </div>
          </div>
        </div>
    </div>
    <?php endif; ?>

   