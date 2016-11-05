
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
                  <form action="<?= base_url($this->app_name).'/edit/'.$this->initial_id.'/'.$this->uri->segment(4) ?>" method="post"  enctype="multipart/form-data">
                    <h5 class="text-info">Article Category</h5>
                    <hr/>
                    <!-- OUTPUT MESSAGE -->
                    <?= $this->messagecontroll->showMessage() ?>
                    <!-- OUTPUT MESSAGE -->                      
                    <div class="control-group">
                      <label class="control-label">Set Article</label>
                      <div class="controls">
                        <div class="notif-info">You can setting article as publish or draft</div>
                         <!-- INITIAL -->
                         <input type="hidden" name="blog_category_id" value="<?= $datadb['blog_category_id'] ?>"/>
                         <input type="hidden" name="page_name" value="<?= $datadb['page_name'] ?>"/>
                         <!-- ====== -->
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
                        <input type="hidden" name="last-type" value="<?= $datadb['filetype'] ?>"/>    
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
                                    <?php if( $datadb['file'] !== "" ): ?>
                                    <div id="result-upload"  style="margin-bottom: 10px;"> 
                                        <ul>
                                            <li>
                                                <a href="<?= base_url($this->app_name).'/removeImage/'.$this->initial_id ?>" class="rmv-image">x</a>
                                                <img src="<?=  base_url().getThumbnailsImage($datadb['file'], $datadb['extention']) ?>"/>
                                            </li>
                                        </ul>
                                    </div>
                                    <?php endif; ?>
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
                            
                            # reback value of longdesc
                            if( isset($_POST['longdesc'][$row['countries_id']]) ){
                                $valDesc = $_POST['longdesc'][$row['countries_id']];
                            }else{ $valDesc  = getContent('content', $datadb['blog_id'], $row['countries_id']);}
                            
                            echo '
                            <div class="control-group">
                              <label class="control-label ">Title <br/><span class="gray-text"> '.$row['countries_name_flag'].' </span></label>
                              <div class="controls">
                                  <!-- hidden value as page_content_id  -->
                                  <input type="hidden" name="page_content_id['.$row['countries_id'].']" value="'.getContent('page_content_id', $datadb['blog_id'], $row['countries_id']).'"/> 
                                  <input type="text" name="title['.$row['countries_id'].']" value="'.$valTitle.'" placeholder="Title Here.." style="width:100%;"/><br/><br/>
                              </div>
                            </div>';
                            
                            echo '
                            <div class="control-group">
                              <label class="control-label ">Description<br/><span class="gray-text"> '.$row['countries_name_flag'].' </span></label>
                              <div class="controls">
                                  <!-- hidden value as page_content_id  -->
                                  <input type="hidden" name="page_content_id['.$row['countries_id'].']" value="'.getContent('page_content_id', $datadb['blog_id'], $row['countries_id']).'"/> 
                                  <textarea class="ckeditor" name="longdesc['.$row['countries_id'].']">'.$valDesc.'</textarea>
                              </div>
                            </div>';
                        }
                    } 
                    ?>
                    <div class="form-actions no-margin">
                      <button type="reset" class="btn">Cancel</button>
                      <button type="submit" class="btn btn-info">Update</button>
                    </div>
                  </form>
           
                </div>
            </div>
        </div>

    <!-- End Container -->
