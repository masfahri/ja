
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
                              <button type="button" class="btn btn-success exlink" data-url="<?= base_url('app_blog').'/add' ?>"><span class="glyphicon glyphicon-plus"></span> New Entry</button>
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
                        <form action="<?= base_url('app_blog').'/removeAll' ?>" method="post" id="form1">
                           <!-- OUTPUT MESSAGE -->
                           <?= $this->messagecontroll->showMessage() ?>
                           <!-- OUTPUT MESSAGE -->
                          <table  id="data-table" class="table table-condensed table-striped table-bordered table-hover no-margin">
                            <thead>
                              <tr>
                                <th style="width:3%;"><span class="glyphicon glyphicon-ok" onclick="globalChecked()"></span></th>
                                <th style="width:5%">File Upload <a href="javascript:;"><span class="glyphicon glyphicon-sort"></span></a></th>
                                 <th style="width:5%">Page<a href="javascript:;"><span class="glyphicon glyphicon-sort"></span></a></th>
                                <th style="width:5%"> Category <a href="javascript:;"><span class="glyphicon glyphicon-sort"></span></a></th>
                                <th style="width:20%">Title Default <a href="javascript:;"><span class="glyphicon glyphicon-sort"></span></a></th>
                                <th style="width:5%">Status <a href="javascript:;"><span class="glyphicon glyphicon-sort"></span></a></th>
                                <th style="width:10%">Create Date <a href="javascript:;"><span class="glyphicon glyphicon-sort"></span></a></th>
                                <th style="width:10%">Author</th>
                                <th style="width:7%">Action</th>
                              </tr>
                            </thead>
                            <tbody>
                            <?php 
                            if( count($datadb) > 0 ){
                                foreach($datadb as $row){
        
                                    $initTable = $row['blog_id'];
                                    
                                    # check author
                                    $checkAuthor = getAuthorName($row['author']);
                                    if( $checkAuthor != null ){$showAuthor = $checkAuthor;
                                    }else{ $showAuthor = '<span class="red-text">Author Unregistered</span>'; }
                                                          
                                    # check status
                                    if($row['status'] == 'draft')$statusClass = 'red-text';
                                    else $statusClass = 'green-text';
                                    
                                    # file upload
                                    // image
                                    if($row['filetype']  == 'image'){
                                        if( file_exists($row['file']) ){
                                            $primaryIcon = '<img class="img-responsive" src="'.base_url().getThumbnailsImage($row['file'], $row['extention']).'"/>';
                                        }else{
                                            $primaryIcon = '<img class="img-responsive" src="'.config_item('assets_img').'no_image.png"/>';
                                        }
                                    }
                                    // video
                                    if($row['filetype']  == 'youtube'){
                                          $primaryIcon = '<img class="img-responsive" src="http://i1.ytimg.com/vi/'.$row['youtube_id'].'/hqdefault.jpg" />';
                                      
                                    }
                                    // pdf
                                    if($row['filetype']  == 'pdf'){
                                        $primaryIcon = '<span class="text-empty">PDF FILE</span>';
                                    }
                                    

                                    echo '
                                    <tr>
                                        <td valign="middle">
                                            <div class="checkbox check-default">
                                                <input name="id_table[]" type="checkbox" name="tableid[]" value="'.$initTable.'" id="checkbox'.$initTable.'">
                                            </div>
                                        </td>
                                        <td><div class="img-table">'.$primaryIcon.'</div></td>
                                        <td>'.$row['page_name'].'</td>
                                        <td>'.get_blogCategoryByCat($row['blog_category_id'], 'blog_category_name').'</td>
                                        <td>'.getContent('title', $initTable, getActiveLang()).'</td>
                                        <td><span class="'.$statusClass.'">'.$row['status'].'</span></td>
                                        <td>'.humanDate($row['create_date']).'</td>
                                        <td>'.$showAuthor.'</td>
                                        <td>
                                            <div class="tools-table">
                                                <a title="Preview"><i class="icon-eye"></i></a> 
                                                &nbsp;&nbsp;&nbsp;
                                                <a href="'.base_url($this->app_name).'/edit/'.$initTable.'" title="Edit"><span class="glyphicon glyphicon-edit"></span></a>
                                                &nbsp;&nbsp;
                                                <a href="javascript:;" class="act-remove-table" data-url="'.base_url($this->app_name).'/remove/'.$initTable.'" title="Remove"><span class="glyphicon glyphicon-trash"></span></a>
                                            </div>
                                        </td>
                                     </tr>';
                                }
                            }else{
                                echo '<tr><td colspan="8"><span class="gray-text">Data Empty</span></td></tr>';
                            }
                            ?>
                            </tbody>
                          </table>
                        </form>
                        <div class="col-md-6">Result  <?= count($datadb) ?> - <?= $result_all?></div>
                        <div class="col-md-6"><div class="cs-pagination"><?=  $this->pagination->create_links() ?></div></div>
                    <?php elseif( $this->initial_template == 'add' ): ?>
                         <form action="<?= base_url('app_blog').'/add' ?>" method="post" enctype="multipart/form-data">
                            <h4 class="text-info">Form Input</h4>
                            <hr/>
                            <!-- OUTPUT MESSAGE -->
                            <?= $this->messagecontroll->showMessage() ?>
                            <!-- OUTPUT MESSAGE -->
                            <div class="control-group">
                              <label class="control-label">Set Article</label>
                              <div class="controls">
                                 <div class="notif-info">You can setting article as publish or draft</div>
                                 <select name="status">
                                    <?php
                                    $dataStatus = array('draft', 'publish');
                                    foreach($dataStatus as $row){
                                        
                                        if( set_value('status') == $row)$sel = 'selected';
                                        else $sel  = '';
                                        
                                        echo ' <option value="'.$row.'" '.$sel.'>'.strtoupper($row).'</option>';
                                    }
                                    ?>
                                 </select>
                              </div>
                            </div>
                            <div class="control-group">
                               <label class="control-label">Page</label>
                               <div class="controls">
                                <div class="notif-info"><p>Please select page first</p></div>
                                <div id="multiselect">
                                    <select name="page_id" onchange="getBlogPageCategory(this.value)">
                                        <option value="">-- Select Page --</option>
                                        <?php
                                        $dataPage = getPageBlog(); // use only for blog
                                        if(count($dataPage)>0){
                                            
                                            $opt = '';
                                            foreach($dataPage as $row){ 
                                               
                                               if( $row['page_id'] == set_value('page_id') )$sel  = 'selected';
                                               else $sel  = '';
                                               
                                               $opt .=  '<option value="'.$row['page_id'].'" '.$sel.'>'.$row['page_name'].'</option>';
                                            }
                                            
                                             echo $opt;
                                        }
                                        ?>
                                     </select>
                                </div>
                              </div>
                            </div>
                            <div class="control-group">
                               <label class="control-label">Article Category</label>
                               <div class="controls">
                                <div id="multiselect">
                                    <select id="blog_category_id" name="blog_category_id">
                                        <option value="">-- Select Blog Category --</option>
                                        <?php if( isset($_POST['page_id']) ): ?>
                                            <?php
                                            $dataCategory = get_blogCategory($_POST['page_id']); // use only for blog
                                            if(count($dataCategory)>0){
                                                
                                                $opt = '';
                                                foreach($dataCategory as $row){ 
                                                  
                                                   if( $row['page_id'] == $_POST['page_id'] )$sel = 'selected';
                                                   else $sel = ''; 
                                                  
                                                   $opt .=  '<option value="'.$row['blog_category_id'].'" '.$sel.'>'.$row['blog_category_name'].'</option>';
                                                }
                                                
                                              echo $opt;
                                            }
                                            ?>
                                        
                                        <?php endif; ?>
                                     </select>
                                </div>
                              </div>
                            </div>
                            <div class="control-group">
                              <label class="control-label"><br/>File Type</label>
                              <div class="controls">
                                 <select name="filetype" onchange="generateFileType(this.value)">
                                 <option value="">-- FILE TYPE --</option>
                                 <?php
                                 $dataType = array('image', 'pdf', 'youtube');
                                 foreach($dataType as $row){
                                    
                                    if( set_value('filetype') == $row )$sel  = 'selected';
                                    else $sel  = '';
                                    
                                    echo '<option value="'.$row.'" '.$sel.'>'.strtoupper($row).'</option>';
                                 }
                                 ?>
                                 </select>
                              </div>
                            </div>
                            <div class="control-group hidden-el" id="fileupl">
                              <label class="control-label"><br/>File Upload</label>
                              <div class="controls" id="getfileupl"></div>
                            </div>
                            <?php
                            $lang = getSettingLang();
                            if( count($lang) > 0 ){
                                foreach($lang as $row){
                                    
                                    # reback value of title
                                    if( isset($_POST['title'][$row['countries_id']]) ){
                                        $valTitle = $_POST['title'][$row['countries_id']];
                                    }else{ $valTitle = ''; }
                                    
                                    # reback value of longdesc
                                    if( isset($_POST['longdesc'][$row['countries_id']]) ){
                                        $valDesc = $_POST['longdesc'][$row['countries_id']];
                                    }else{ $valDesc = ''; }
                                    
                                    echo '
                                    <div class="control-group">
                                      <label class="control-label ">Title <br/><span class="gray-text">'.$row['countries_name_flag'].'</span></label>
                                      <div class="controls">
                                         <input type="text" name="title['.$row['countries_id'].']" value="'.$valTitle.'" placeholder="Title Here.."/ style="width:100%;">
                                      </div>
                                    </div>';
                                      
                                    echo '
                                    <div class="control-group" id="blogdesc">
                                      <label class="control-label ">Description  <br/><span class="gray-text">'.$row['countries_name_flag'].'</span></label>
                                      <div class="controls">
                                          <textarea class="ckeditor" name="longdesc['.$row['countries_id'].']">'.$valDesc.'</textarea>
                                      </div>
                                    </div>';
                                }
                            } 
                            ?>
                            <div></div>
                            <div class="form-actions no-margin">
                              <button type="reset" class="btn">Cancel</button>
                              <button type="submit" class="btn btn-info">Save</button>
                            </div>
                          </form>     
                    <?php elseif( $this->initial_template == 'edit' ): ?>
                          <form action="<?= base_url('app_blog').'/edit/'.$this->initial_id ?>" method="post"  enctype="multipart/form-data">
                            <h5 class="text-info">Article Category</h5>
                            <hr/>
                            <!-- OUTPUT MESSAGE -->
                            <?= $this->messagecontroll->showMessage() ?>
                            <!-- OUTPUT MESSAGE -->
                            <div class="control-group">
                              <label class="control-label">Set Article</label>
                              <div class="controls">
                                <div class="notif-info">You can setting article as publish or draft</div>
                                 <select name="status">
                                    <?php
                                    $dataStatus = array('draft', 'publish');
                                    foreach($dataStatus as $row){
                                        
                                        if( $datadb['status'] == $row)$sel = 'selected';
                                        else $sel  = '';
                                        
                                        echo ' <option value="'.$row.'" '.$sel.'>'.strtoupper($row).'</option>';
                                        
                                    }
                                    ?>
                                 </select>
                              </div>
                            </div>
                            <div class="control-group">
                               <label class="control-label">Page</label>
                               <div class="controls">
                                <div class="notif-info"><p>Please select page first</p></div>
                                <div id="multiselect">
                                    <select name="page_id" onchange="getBlogPageCategory(this.value)">
                                        <option value="">-- Select Page --</option>
                                        <?php
                                        $dataPage = getPageBlog(); // use only for blog
                                        if(count($dataPage)>0){
                                            
                                            $opt = '';
                                            foreach($dataPage as $row){ 
                                               
                                               if( isset($_POST['page_id'])){
                                                    $compare_value = $_POST['page_id'];
                                               }else{
                                                    $compare_value = $datadb['page_id'];
                                               }
                                               
                                               if( $row['page_id'] == $compare_value )$sel  = 'selected';
                                               else $sel  = '';
                                               
                                               $opt .=  '<option value="'.$row['page_id'].'" '.$sel.'>'.$row['page_name'].'</option>';
                                            }
                                            
                                             echo $opt;
                                        }
                                        ?>
                                     </select>
                                </div>
                              </div>
                            </div>
                            <div class="control-group">
                              <label class="control-label">Article Category</label>
                              <div class="controls">
                                <div class="notif-info">Please select blog category first</div>
                                <div class="floatbox-left">
                                    <select id="blog_category_id" name="blog_category_id">
                                        <option value="">-- Select Blog Category --</option>
                                        <?php
                                        
                                        if( isset($_POST['page_id'])){
                                            $targetVal = $_POST['page_id'];
                                        }else{
                                            $targetVal = $datadb['page_id'];
                                        }
                                        
                                        $dataCategory = get_blogCategory($targetVal); // use only for blog
                                        if(count($dataCategory)>0){
                                            
                                            $opt = '';
                                            foreach($dataCategory as $row){ 
                                               
                                               if( isset($_POST['blog_category_id'])){
                                                    $compare_value = $_POST['blog_category_id'];
                                               }else{
                                                    $compare_value = $datadb['blog_category_id'];
                                               }
                                                
                                               if( $row['blog_category_id'] == $compare_value )$sel = 'selected';
                                               else $sel = ''; 
                                              
                                               $opt .=  '<option value="'.$row['blog_category_id'].'" '.$sel.'>'.$row['blog_category_name'].'</option>';
                                            }
                                            
                                          echo $opt;
                                        }
                                        ?>
                                     </select>
                                     <input type="hidden" name="saveLastCategoryId" value="<?= $datadb['blog_category_id'] ?>"/>
                                </div>
                              </div>
                            </div>
                            <div class="control-group">
                              <label class="control-label"><br/>File Type</label>
                              <div class="controls">
                                  <!-- save filetype -->
                                 <input type="hidden" name="slt" value="<?= $datadb['filetype'] ?>"/>
                                 <select name="filetype" onchange="generateFileType(this.value)">
                                 <option value="">-- FILE TYPE --</option>
                                 <?php
                                 $dataType = array('image', 'pdf', 'youtube');
                                 foreach($dataType as $row){
                                    
                                    if( rebackPost('filetype', $datadb['filetype']) == $row )$sel  = 'selected';
                                    else $sel  = '';
                                    
                                    echo '<option value="'.$row.'" '.$sel.'>'.strtoupper($row).'</option>';
                                 }
                                 ?>
                                 </select>
                              </div>
                            </div>
                            <div class="control-group" id="fileupl">
                                <label class="control-label"><br/>File Upload</label>   
                                <div class="controls" id="getfileupl">
                                 
                                   <?php if( $datadb['filetype'] == 'youtube'): ?>
                                   <!-- INITIAL ID FOR JS -->
                                   <input type="hidden" id="active-type" value="youtube"/>
                                   <!-- ================= -->
                                   <input type="text" name="youtube_id" value="<?= $datadb['youtube_id'] ?>" placeholder="Empty"/>
                                   <div class="notif-info" id="info-fileupl"><p>Paste Youtube ID here, example <b>( XHDJ67XX )</b></p>
                                   <p>Maximum default image thumbnails resolution will take it from youtube</p></div>
                                   <?php else: ?>
                                        <?php if( $datadb['filetype'] == 'pdf' ): ?>
                                        
                                        <!-- INITIAL ID FOR JS -->
                                           <input type="hidden" id="active-type" value="pdf"/>
                                        <!-- ================= -->
                                        <div id="result-upload"  style="margin-bottom: 10px;"> 
                                            <?= $datadb['file'] ?>
                                        </div>
                                        <input type="file" name="fileupl" placeholder="Empty"/>
                                        <div class="notif-info" id="info-fileupl"><p>File upload must be extention format <b>(PDF)</b></p></div>
                                        
                                        <?php else: ?>
                                        <!-- INITIAL ID FOR JS -->
                                           <input type="hidden" id="active-type" value="image"/>
                                        <!-- ================= -->
                                        <div id="result-upload"  style="margin-bottom: 10px;"> 
                                            <ul>
                                                <li><img src="<?=  base_url().getThumbnailsImage($datadb['file'], $datadb['extention']) ?>"/></li>
                                            </ul>
                                        </div>
                                        <input type="file" name="fileupl" placeholder="Empty"/>
                                        <div class="notif-info" id="info-fileupl"><p>File upload must be extentnion format <b>(JPG, JPEG)</b></p></div>
                                       
                                        <?php endif; ?>
                                   <?php endif; ?> 
                                           
                                </div>
                            </div>
                            <?php
                            $lang = getSettingLang();
                            if( count($lang) > 0 ){
                                foreach($lang as $row){
                                    
                                    # reback value of title
                                    if( isset($_POST['title'][$row['countries_id']]) ){
                                        $valTitle = $_POST['title'][$row['countries_id']];
                                    }else{ $valTitle = getContent('title', $datadb['blog_id'], $row['countries_id']);  }
                                    //echo $this->db->last_query(); exit;
                                    # reback value of longdesc
                                    if( isset($_POST['longdesc'][$row['countries_id']]) ){
                                        $valDesc = $_POST['longdesc'][$row['countries_id']];
                                    }else{ $valDesc  = getContent('content', $datadb['blog_id'], $row['countries_id']);}
                                    
                                    echo '
                                    <div class="control-group">
                                      <label class="control-label ">Title <br/><span class="gray-text">'.$row['countries_name_flag'].'</span></label>
                                      <div class="controls">
                                          <!-- hidden value as page_content_id  -->
                                          <input type="hidden" name="page_content_id['.$row['countries_id'].']" value="'.getContent('page_content_id', $datadb['blog_id'], $row['countries_id']).'"/> 
                                          <input type="text" name="title['.$row['countries_id'].']" value="'.$valTitle.'" placeholder="Title Here.." style="width:100%;"/><br/><br/>
                                      </div>
                                    </div>';
                                    if($datadb['filetype'] !== 'pdf' ){
                                       echo '
                                        <div class="control-group"  id="blogdesc">
                                          <label class="control-label ">Description <br/><span class="gray-text">'.$row['countries_name_flag'].'</span></label>
                                          <div class="controls">
                                              <!-- hidden value as page_content_id  -->
                                              <input type="hidden" name="page_content_id['.$row['countries_id'].']" value="'.getContent('page_content_id', $datadb['blog_id'], $row['countries_id']).'"/> 
                                              <textarea class="ckeditor" name="longdesc['.$row['countries_id'].']">'.$valDesc.'</textarea>
                                          </div>
                                        </div>'; 
                                    }
                                    
                                }
                            } 
                            ?>
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
