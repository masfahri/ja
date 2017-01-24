
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
                                    <th style="width:2%;"><span class="glyphicon glyphicon-ok" onclick="globalChecked()"></span></th>
                                    <th style="width:20%">Album Name<span class="glyphicon glyphicon-sort"></span></th>
                                    <th style="width:20%">Album Title<span class="glyphicon glyphicon-sort"></span></th>
                                    <th style="width:25%">Author <span class="glyphicon glyphicon-sort"></span></th>
                                    <th style="width:5%">Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                <?php 
                                if( count($datadb) > 0 ){
                                    foreach($datadb as $row){
            
                                        $initTable = $row['gallery_album_id'];
                                        $checkAuthor = getAuthorName($row['author']);
                                        if( $checkAuthor != null ){
                                             $showAuthor = $checkAuthor;
                                        }else{ $showAuthor = '<span class="red-text">Author Unregistered</span>'; }
                                        
                                        $lock_id = array(14);
                                        if( in_array($row['gallery_album_id'], $lock_id) ){
                                            $tabTools = '
                                            <div class="tools-table">
                                                <div class="tools-table">
                                                    <a href="'.base_url($this->app_name).'/edit/'.$initTable.'" title="Edit"><span class="glyphicon glyphicon-edit"></span></a>
                                                    &nbsp;&nbsp;
                                                    <a href="javascript:;" ><span class="glyphicon glyphicon-lock"></span></a>
                                                </div>
                                            </div>';
                                        }else{
                                            $tabTools = '
                                            <div class="tools-table">
                                                <div class="tools-table">
                                                    <a href="'.base_url($this->app_name).'/edit/'.$initTable.'" title="Edit"><span class="glyphicon glyphicon-edit"></span></a>
                                                    &nbsp;&nbsp;
                                                    <a href="javascript:;" class="act-remove-table" data-url="'.base_url($this->app_name).'/remove/'.$initTable.'" title="Remove"><span class="glyphicon glyphicon-trash"></span></a>
                                                </div>
                                            </div>';
                                        }
                                        
                                        echo '
                                        <tr>
                                            <td valign="middle">
                                                 <div class="checkbox check-default">
                                                    <input name="id_table[]" type="checkbox" name="tableid[]" value="'.$initTable.'" id="checkbox'.$initTable.'">
                                                </div>
                                            </td>
                                            <td>'.$row['album_name'].'</td>
                                            <td>'.$row['album_title'].'</td>
                                             <td>'.$showAuthor.'</td>
                                            <td>'.$tabTools.'</td>
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
                                  <label class="control-label">Album Name</label>
                                  <div class="controls">
                                      <div class="notif-info">
                                        <p>Last entry image will take as cover album, Please entry new name for the albums</p>
                                      </div>  
                                      <input type="text" name="album_name" value="<?= set_value('album_name') ?>" placeholder="Empty"/>
                                  </div>
                                </div>
                                <div class="control-group">
                                  <label class="control-label">Album Title</label>
                                  <div class="controls" > 
                                      <input type="text" style="width: 100%;" name="album_title" value="<?= set_value('album_title') ?>" placeholder="Empty"/>
                                  </div>
                                </div>
                                <div class="control-group">
                                  <label class="control-label">Event Description</label>
                                  <div class="controls" > 
                                      <textarea id="text-editor-product2" name="album_description"><?= set_value('album_description') ?></textarea>
                                  </div>
                                </div>
								<div class="form-actions no-margin">
								  <button type="button" class="btn">Cancel</button>
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
                                  <label class="control-label">Album Name</label>
                                  <div class="controls">
                                      <div class="notif-info">
                                        <p>Last entry image will take as cover album, Please entry new name for the albums</p>
                                      </div>  
                                      <input type="text" name="album_name" value="<?= rebackPost('album_name', $datadb['album_name']) ?>" placeholder="Empty"/>
                                  </div>
                                </div>
                                <div class="control-group">
                                  <label class="control-label">Album Title</label>
                                  <div class="controls"> 
                                      <input type="text" name="album_title"  style="width: 100%;" value="<?= rebackPost('album_title', $datadb['album_title']) ?>" placeholder="Empty"/>
                                  </div>
                                </div>
                                <div class="control-group">
                                  <label class="control-label">Event Description</label>
                                  <div class="controls" > 
                                      <textarea id="text-editor-product2" name="album_description"><?= rebackPost('album_description', $datadb['album_description']) ?></textarea>
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
