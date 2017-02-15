<div class="md-card">
    <div class="md-card-content">
        <div class="uk-overflow-container uk-margin-bottom">
            <!-- OUTPUT MESSAGE -->
            <?= $this->messagecontroll->showMessage() ?>
                <!-- OUTPUT MESSAGE -->
                <?php if( $this->initial_template == '' ): ?>
                <a href="<?= base_url($this->app_name) ?>/add" class="md-btn md-btn-success md-btn-wave-light waves-effect waves-button waves-light"> Add new photo or video</a>
                <a href="<?= base_url($this->app_name) ?>/addAlbums" class="md-btn md-btn-success md-btn-wave-light waves-effect waves-button waves-light"> Add new albums</a>
                <table class="uk-table uk-table-align-vertical uk-table-nowrap tablesorter tablesorter-altair" id="ts_issues">
                        <thead>
                            <tr>
                                <th class="uk-text-center">ID</th>
                                <th>Album Title</th>
                                <th>Album Description</th>
                                <th>Album image</th>
                                <th>Album Date</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th class="uk-text-center">ID</th>
                                <th>Album Title</th>
                                <th>Album Description</th>
                                <th>Album image</th>
                                <th>Album Date</th>
                            </tr>
                        </tfoot>
                    <tbody>
                            <?php 

                        if( count($datadb) > 0 ){
                            foreach($datadb as $row){  
                              $firstImage = getLastProductImage($row['gallery_album_id']);

                              # check image or video
                                  
                                  if( file_exists($row['file'] ) ){
                                      $primaryIcon = '<img width="50%" height="50%" src="'.base_url().$row['file'].'"/>';

                                                                                
                                  }                      
                                  else{
                                      $primaryIcon = '<img src="http://placehold.it/350x150">';
                                  }                          


                                echo '                    
                                    <tr>
                                        <td class="uk-text-center"><span class="uk-text-small uk-text-muted uk-text-nowrap">'.$row['gallery_album_id'].'</span></td>
                                        <td>
                                            <a href="'.base_url($this->app_name).'/detail/'.$row['gallery_album_id'].'">'.$row['album_name'].'</a>
                                        </td>
                                        <td>'.character_limiter($row['album_description'], 20).'</td>

                                        <td>'.$primaryIcon.'</td>
                                        <td>'.date ("d/M/Y",strtotime($row['date'])).'</td>
                                    </tr>';
                            }}else{
                                echo '
                                    <tr>
                                        <td class="uk-text-center"><span class="uk-text-small uk-text-muted uk-text-nowrap"></span></td>
                                        <td>
                                           
                                        </td>
                                        <td><span class="uk-text-danger">Tidak ada Album</span></td>
                                        <td></td>                                        
                                    </tr>';
                            }
                            ?>
                    </tbody>
                </table>
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
      
        <?php elseif( $this->initial_template == 'add' ): ?>
          <form action="<?= base_url($this->app_name).'/add' ?>" method="post" enctype="multipart/form-data">
            <div class="md-card">
                 <div class="md-card-content">
                    <div class="uk-grid">
                       <select name="type" class="uk-form-width-medium" onchange="galleryChooseType(this.value)" data-md-selectize-inline>
                       <option value="">-- CHOOSE TYPE --</option>
                       <?php
                           $fileType = array('video', 'image');
                           if(count($fileType) > 0){
                              foreach($fileType as $row){
                                  
                                  if( $row == set_value('type'))$sel  = 'selected';
                                  else $sel  = '';
                                  
                                  echo '<option value="'.$row.'" '.$sel.'>'.strtoupper($row).'</option>';
                              }
                           }
                       ?>
                   </select>
                 </div>
                        <div class="uk-grid">
                          <div class="uk-width-medium-1-2 uk-row-first">
                              <h5 class="heading_e">
                                You have 5 image collection<br />
                                File image must be in extention <b>(JPG, JPEG)</b>
                              </h5>
                                    <?php
                                    for($i=0; $i<5; $i++){
                                         
                                        $removeLink = '';
                                        $fieldPid   = '';       
                                        echo '
                                        <li>
                                            <div class="no-image"><span class="glyphicon glyphicon-picture"></span></div><br />
                                            <div class="uk-form-file md-btn md-btn-primary"><input type="file" id="form-file" name="file_'.$i.'"/>Select</div>
                                        </li>';
                                         
                                    }
                                    ?>
                          </div>
                          <div class="uk-width-medium-1-2">
                              <h5 class="heading_e">
                                When you choose type video, you must input this<br />
                                The unique youtube video id. <b>ex : <i>oz6kKB8wlj8</i></b>
                              </h5>
                              <div class="uk-margin-medium-bottom">
                                  <label for="album_place">Youtube Video ID</label>
                                  <input type="text" class="md-input" id="url_link" name="url_link" />
                              </div>
                          </div>                          
                        </div>
                </div> 
            </div>
            <div id="album-name">
              <label class="control-label">Album Name</label>
              <div class="controls">
                 <select class="uk-form-width-medium" name="gallery_album_id" data-md-selectize-inline>
                     <option value="">-- CHOOSE ALBUMS --</option>
                     <?php
                     if(count($dataAlbums) > 0){
                        foreach($dataAlbums as $row){
                            
                            if( $row == set_value('gallery_album_id'))$sel  = 'selected';
                            else $sel  = '';
                            
                            echo '<option value="'.$row['gallery_album_id'].'" '.$sel.'>'.ucfirst($row['album_name']).'</option>';
                        }
                     }
                 ?>
                 </select>
              </div>
            </div>
            <div class="uk-width-large-1-4 uk-width-medium-2-2 uk-grid-margin uk-row-first">
                <div class="uk-input-group">
                    <button class="md-btn md-btn-primary md-btn-wave-light waves-effect waves-button waves-light">Save</button>
                    <a href="javascript:window.history.go(-1);" class="md-btn md-btn-success md-btn-wave-light waves-effect waves-button waves-light">Cancel</a>
                </div>
            </div>
          </form>
        <?php elseif( $this->initial_template == 'addAlbums' ): ?>
            <form action="<?= base_url($this->app_name).'/addAlbums' ?>" method="post" enctype="multipart/form-data">
                <div class="uk-margin-medium-bottom">
                    <label for="album_place">Album Name</label>
                    <input type="text" class="md-input" id="album_name" name="album_name" />
                </div>
                <div class="uk-margin-medium-bottom">
                    <label for="album_place">Place</label>
                    <input type="text" class="md-input" id="album_title" name="album_title" />
                </div>
            <div id="video-desc">
              <label class="control-label">Album Description</label>
              <div class="controls" > 
                  <textarea id="text-editor-product2" id="album_description" name="album_description"><?= set_value('album_description') ?></textarea>
              </div>
            </div>
            <br />
            <div class="uk-grid" data-uk-grid-margin>
                <div class="uk-width-medium-1-1">
                    <label for="album_date">Select date</label>
                    <input class="md-input" type="text" id="date" value="" name="date" data-uk-datepicker="{format:'YYYY-MM-DD'}">                    
                </div>
            </div>
            <div class="md-card-content">
                        <div class="uk-grid">
                          <div class="uk-width-medium-1-2 uk-row-first">
                              <h5 class="heading_e">
                                You have image album collection<br />
                                File image must be in extention <b>(JPG, JPEG)</b>
                              </h5>
                                    <?php
                                    for($i=0; $i<=0; $i++){
                                         
                                        $removeLink = '';
                                        $fieldPid   = '';       
                                        echo '
                                        <li>
                                            <div class="no-image"><span class="glyphicon glyphicon-picture"></span></div><br />
                                            <div class="uk-form-file md-btn md-btn-primary"><input type="file" id="form-file" name="file_'.$i.'"/>Select</div>
                                        </li>';
                                         
                                    }
                                    ?>
                          </div>
                        </div>
                </div>            
                <div class="uk-width-large-1-4 uk-width-medium-2-2 uk-grid-margin uk-row-first">
                    <div class="uk-input-group">
                        <a href="javascript:window.history.go(-1);" class="md-btn md-btn-danger md-btn-wave-light waves-effect waves-button waves-light">Cancel</a>
                        <button class="md-btn md-btn-primary md-btn-wave-light waves-effect waves-button waves-light">Save</button>
                    </div>
                </div>
          </form>          
        <!-- Edit photo ambil dari shop -->

       <!-- Edit Album ambil dari shop -->

      <?php elseif( $this->initial_template == 'detail' ): ?>
          <?php if( isset($datadb[0]['file'] ) || isset($datadb[0]['url_link'] )): ?>
          <form action="<?= base_url($this->app_name).'/removeAll' ?>" method="post" id="form1">
          <?php 
          if( count($datadb) > 0 ){
              foreach($datadb as $row){
                  
                  $initTable = $row['gallery_album_id'];
                  $infoImg   = '';

                  # check image or video
                  if( $row['type'] == 'image' ){
                      
                      if( file_exists($row['file'] ) ){
                          $primaryIcon = '
                       
                                <div>
                                    <div class="md-card md-card-hover">
                                        <div class="gallery_grid_item md-card-content">   
                                       <a href="'.base_url().getThumbnailsImage($row['file'], $row['extention']).'" data-uk-lightbox="{group:"gallery"}">
                                              <img src="'.base_url().getThumbnailsImage($row['file'], $row['extention']).'"/>
                                          </a>
                                        </div>
                                    </div>
                                </div>';

                                                                    
                      }                      
                      else{
                          $primaryIcon = '<a href="'.base_url().getThumbnailsImage($row['file'], $row['extention']).'" data-uk-lightbox="{group:"gallery"}">
                                              <img src="http://placehold.it/350x150">
                                          </a>';
                      }
                      
                  }else{  
                       $primaryIcon = '<div>
                                    <div class="md-card md-card-hover">
                                        <div class="gallery_grid_item md-card-content">                      
                       <iframe src="https://www.youtube.com/embed/'.$row['url_link'].'" frameborder="0" allowfullscreen></iframe>
                                        </div>
                                    </div>
                                </div>                       
                       ';
                  }
                  
                  echo '

          <br />
          <div class="gallery_grid uk-grid-width-medium-1-4 data-uk-grid="{gutter: 16}">
                     '.$primaryIcon.'
          </div>';
              }
          }
          ?>
          <br /> 
          <button class="md-btn md-btn-primary md-btn-wave-light waves-effect waves-button waves-light">Save</button>
          <a href="javascript:;"  class="md-btn md-btn-danger md-btn-wave-light waves-effect waves-button waves-light act-remove-table" 
              data-url="<?php echo base_url($this->app_name).'/removeCat/'.$initTable; ?>" title="Remove">Delete</a>              
          <a href="javascript:window.history.go(-1);" class="md-btn md-btn-success md-btn-wave-light waves-effect waves-button waves-light">Cancel</a>
          </form>          
          <?php else: ?>
          <p>
           This album is hasn't content, please upload before.  
          </p><br />
          <a href="javascript:window.history.go(-1);" class="md-btn md-btn-danger md-btn-wave-light waves-effect waves-button waves-light">Back</a>
          <?php endif; ?>
      
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
        function resettingElementSelect(initial, newVal) {

            $(initial).hide();
            $(initial).html('');
            $(initial).html(newVal);
            $(initial).fadeIn();
        }

        /**
         * @desc Event onclick remove selected row on Master Data Table
         * used on every master data table
         */
        $('.act-remove-table').click(function() {
            if (confirm('Are you sure want to remove this data ?')) {
                window.location = $(this).attr('data-url');
            }
        });
        </script>
