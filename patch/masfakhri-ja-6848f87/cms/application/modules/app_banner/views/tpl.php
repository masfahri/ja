
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
							<form action="<?= base_url($this->app_name).'/removeAll' ?>" method="post" id="form1">
							   <h4 class="text-info">Master Data</h4>
							  <hr/>
							   <!-- OUTPUT MESSAGE -->
							   <?= $this->messagecontroll->showMessage() ?>
							   <!-- OUTPUT MESSAGE -->
							 <table id="mytable" class="table table-condensed table-striped table-bordered table-hover no-margin tablesorter">
                                <thead>
                                  <tr>
                                    <th style="width:3%;"><span class="glyphicon glyphicon-ok" onclick="globalChecked()"></span></th>
                                    <th style="width:5%">Image<span class="glyphicon glyphicon-sort"></span></th>
                                    <th style="width:10%">Page<span class="glyphicon glyphicon-sort"></span></th>
                                    <th style="width:10%">Category<span  class="glyphicon glyphicon-sort"></span></th>
                                    <th style="width:10%">Banner Name<span  class="glyphicon glyphicon-sort"></span></th>
                                    <th style="width:7%">Size<span class="glyphicon glyphicon-sort"></span></th>
                                    <th style="width:30%">URL Link <span class="glyphicon glyphicon-sort"></span></th>
                                    <th style="width:5%">Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                <?php 
                                if( count($datadb) > 0 ){
                                    foreach($datadb as $row){
            
                                        $initTable = $row['banner_id']; 
                                        echo '
                                        <tr>
                                            <td valign="middle">
                                                <div class="checkbox check-default">
                                                    <input name="id_table[]" type="checkbox" name="tableid[]" value="'.$initTable.'" id="checkbox'.$initTable.'">
                                                </div>
                                            </td>
                                            <td><div class="img-table-banner"><img src="'.base_url().getThumbnailsImage($row['file'], $row['extention']).'"/></div></td>
                                            <td>'.$row['page_name'].'</td>
                                            <td>'.$row['category_name'].'</td>
                                            <td>'.$row['banner_name'].'</td>
                                            <td>'.$row['size'].'</td>
                                            <td>'.$row['banner_url'].'</td>
                                            <td>
                                                <div class="tools-table">
                                                    <a href="'.base_url($this->app_name).'/edit/'.$initTable.'" title="Edit"><span class="glyphicon glyphicon-edit"></span></a>
                                                    &nbsp;&nbsp;
                                                    <a href="javascript:;" class="act-remove-table" data-url="'.base_url($this->app_name).'/remove/'.$initTable.'" title="Remove"><span class="glyphicon glyphicon-trash"></span></a>
                                                </div>
                                            </td>
                                         </tr>';
                                    }
                                }else{
                                    echo '<tr><td colspan="8">Data not found !</td></tr>';
                                }
                                ?>
                                </tbody>
                              </table>
							</form>
							<div class="col-md-6">Result  <?= count($datadb) ?> - <?= $result_all?></div>
							<div class="col-md-6"><div class="cs-pagination"><?=  $this->pagination->create_links() ?></div></div>
						<?php elseif( $this->initial_template == 'add' ): ?>
						   <form action="<?= base_url($this->app_name.'/add')?>" method="post" enctype="multipart/form-data">
								<h4 class="text-info">Form Input</h4>
								<hr/>
								<!-- OUTPUT MESSAGE -->
								<?= $this->messagecontroll->showMessage() ?>
								<!-- OUTPUT MESSAGE -->
                                <div class="control-group">
                                  <label class="control-label">Select Page</label>
                                  <div class="controls">
                                    <div class="notif-result"></div>
                                     <select name="banner_page_id" onchange="generateBannerCategory(this.value)">
                                        <option>-- CHOOSE PAGE --</option>
                                        <?php
                                        $dataPage = pageOnBanner();
                                        if( count($dataPage) > 0 ){
                                            foreach($dataPage as $row){
                                                
                                                if( set_value('banner_page_id') == $row['page_id'] )$sel  = 'selected';
                                                else $sel  = '';
                                                
                                                echo '<option value="'.$row['page_id'].'" '.$sel.'>'.$row['page_name'].'</option>';   
                                            }
                                        }
                                        ?>
                                     </select>
                                  </div>
                                </div>
                                <div class="control-group">
                                  <label class="control-label">Select Banner Category</label>
                                  <div class="controls">
                                     <div class="notif-result"></div>
                                     <select name="banner_category_id" id="banner_category_id" onchange="generateBannerSize(this.value)">
                                        <option value="">-- CHOOSE BANNER CATEGORY --</option>
                                 
                                     </select>
                                     <?php if( isset($_POST['banner_page_id']) ):?>
                                        <span id="post-banner_category_id" data-parent="<?= $_POST['banner_page_id'] ?>" data-value="<?= $_POST['banner_category_id'] ?>"></span>
                                     <?php endif; ?>
                                  </div>
                                </div>
                                <div class="control-group">
                                  <label class="control-label">Select Banner Size</label>
                                  <div class="controls">
                                     <div class="notif-result"></div>
                                     <select name="banner_size_id" id="banner_size_id">
                                        <option value="">-- CHOOSE BANNER SIZE --</option>
                                     </select>
                                     <?php if( isset($_POST['banner_category_id']) ):?>
                                        <span id="post-banner_size_id" data-parent="<?= $_POST['banner_category_id'] ?>" data-value="<?= $_POST['banner_size_id'] ?>"></span>
                                     <?php endif; ?>
                                  </div>
                                </div>
                                <div class="control-group">
                                  <label class="control-label">Image </label>
                                  <div class="controls">
                                      <input type="file" name="fileupl"/>
                                      <div class="notif-info">
                                        <p>File image must be in extention <b>(JPG, JPEG)</b> </p>
                                      </div>
                                  </div>
                                </div>
                                <div class="control-group">
                                  <label class="control-label">Banner Name</label>
                                  <div class="controls" >
                                      <input type="text" style="width: 70%;" name="banner_name" value="<?= set_value('banner_name') ?>" placeholder="Empty"/>
                                  </div>
                                </div>
                                <div class="control-group">
                                  <label class="control-label">URL Link To</label>
                                  <div class="controls">
                                      <input type="text"  style="width: 70%;"  name="banner_url" value="<?= set_value('banner_url') ?>" placeholder="Empty"/>
                                  </div>
                                </div>
                                <div class="control-group">
                                  <label class="control-label">Caption</label>
                                  <div class="controls">
                                        <textarea id="banner-caption-editor" rows="5" name="banner_caption" placeholder="Type Caption Here..."><?= set_value('banner_caption') ?></textarea>
                                  </div>
                                </div> 
								<div class="form-actions no-margin">
								  <button type="reset" class="btn">Cancel</button>
								  <button type="submit" class="btn btn-info">Save</button>
								</div>
							  </form>
						<?php elseif( $this->initial_template == 'edit' ): ?>
							  <form action="<?= base_url($this->app_name).'/edit/'.$this->initial_id ?>" method="post"  enctype="multipart/form-data">
								<h4 class="text-info">Form Edit</h4>
								<hr/>
								<!-- OUTPUT MESSAGE -->
								<?= $this->messagecontroll->showMessage() ?>
								<!-- OUTPUT MESSAGE -->
                                <div class="control-group">
                                  <label class="control-label">Select Page</label>
                                  <div class="controls">
                                    <div class="notif-result"></div>
                                     <select name="banner_page_id" onchange="generateBannerCategory(this.value)">
                                        <option>-- CHOOSE PAGE --</option>
                                        <?php
                                        $dataPage = pageOnBanner();
                                        if( count($dataPage) > 0 ){
                                            foreach($dataPage as $row){
                                                
                                                if( rebackPost('banner_page_id', $datadb['banner_page_id']) == $row['page_id'] )$sel  = 'selected';
                                                else $sel  = '';
                                                
                                                echo '<option value="'.$row['page_id'].'" '.$sel.'>'.$row['page_name'].'</option>';   
                                            }
                                        }
                                        ?>
                                     </select>
                                  </div>
                                </div>
                                <div class="control-group">
                                  <label class="control-label">Select Banner Category</label>
                                  <div class="controls">
                                     <div class="notif-result"></div>
                                     <select name="banner_category_id" id="banner_category_id" onchange="generateBannerSize(this.value)">
                                        <option value="">-- CHOOSE BANNER CATEGORY --</option>
                                     </select>
                                     <span id="post-banner_category_id" data-parent="<?= rebackPost('banner_page_id', $datadb['banner_page_id']) ?>" data-value="<?= rebackPost('banner_category_id', $datadb['banner_category_id']) ?>"></span>
                                  </div>
                                </div>
                                <div class="control-group">
                                  <label class="control-label">Select Banner Size</label>
                                  <div class="controls">
                                     <div class="notif-result"></div>
                                     <select name="banner_size_id" id="banner_size_id">
                                        <option value="">-- CHOOSE BANNER SIZE --</option>
                                     </select>  
                                      <span id="post-banner_size_id" data-parent="<?= rebackPost('banner_category_id', $datadb['banner_category_id']) ?>" data-value="<?= rebackPost('banner_size_id', $datadb['banner_size_id']) ?>"></span>
                                  </div>
                                </div>
				                <div class="control-group">
                                  <label class="control-label">Image Icon</label>
                                  <div class="controls">
                                    <div id="result-upload" class="adv-img">
                                        <ul>
                                            <li>
                                                <?php
                                                if( file_exists( getThumbnailsImage($datadb['file'], $datadb['extention']) ) ){
                                                    echo '<img src="'.base_url().getThumbnailsImage($datadb['file'], $datadb['extention']).'"/>';
                                                }else{
                                                    echo '<span class="no-image">no-image</span>';
                                                }
                                                ?>
                                            </li>
                                        </ul>
                                    </div>
                                    <input type="file" name="fileupl"/>
                                    <div class="notif-info">
                                        <p>File image must be in extention <b>(JPG, JPEG)</b> </p>
                                      </div>
                                  </div>
                                </div>
                                <div class="control-group">
                                  <label class="control-label">Banner Name</label>
                                  <div class="controls">
                                      <input type="text" style="width: 70%;"  name="banner_name" value="<?= rebackPost('banner_name', $datadb['banner_name']) ?>" placeholder="Empty"/>
                                  </div>
                                </div>
                                <div class="control-group">
                                  <label class="control-label">URL Link To</label>
                                  <div class="controls">
                                      <input type="text"  style="width: 70%;" name="banner_url" value="<?= rebackPost('banner_url', $datadb['banner_url']) ?>" placeholder="Empty"/>
                                  </div>
                                </div>
                                  <div class="control-group">
                                  <label class="control-label">Caption</label>
                                  <div class="controls">
                                        <textarea rows="5" id="banner-caption-editor" name="banner_caption" placeholder="Type Caption Here..."><?= rebackPost('banner_caption', $datadb['banner_caption']) ?></textarea>
                                  </div>
                                </div>
								<div class="form-actions no-margin">
								  <button type="button" class="btn">Cancel</button>
								  <button type="submit" class="btn btn-info">Update</button>
								</div>
							  </form>
						<?php endif; ?>
					</div>
				</div>
			</div>
		<!-- End Container -->
