
		<!-- Page Content -->
			<div class="row">
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-6 text-left">
						   <h4>Article Content</h4>
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div  id="page-content">          
					       
						   <!-- OUTPUT MESSAGE -->
						   <?= $this->messagecontroll->showMessage() ?>
						   <!-- OUTPUT MESSAGE -->
						 <table class="table table-condensed table-striped table-bordered table-hover no-margin tablesorter">
                            <thead>
                              <tr>
                                <th style="width:3%;"><span class="glyphicon glyphicon-ok" onclick="globalChecked()"></span></th>
                                <th style="width:2%">Image <span class="glyphicon glyphicon-sort"></span></th>
                                <th style="width:20%">Blog Category <span class="glyphicon glyphicon-sort"></span></th>
                                <th style="width:40%">Title Default ( <?= getAllCountries(getActiveLang(), 'countries_idx')  ?> ) <a href="javascript:;"><span class="glyphicon glyphicon-sort"></span></a></th>
                                <th style="width:10%">On View <span class="glyphicon glyphicon-sort"></span></th>
                                <th style="width:10%">Author <span class="glyphicon glyphicon-sort"></span></th>
                              </tr>
                            </thead>
                            <tbody>
                            <?php 
                            if( count($datadb) > 0 ){
                                foreach($datadb as $row){
        
                                    $initTable = $row['blog_id'];
                                    
                                    # check author
                                    $checkAuthor = getAuthorName($row['author']);
                                    if( $checkAuthor != null ){
                                        $showAuthor = $checkAuthor;
                                    }else{ $showAuthor = '<span class="red-text">Author Unregistered</span>'; }
                                                          
                                  
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
                                        if( file_exists( 'http://i1.ytimg.com/vi/'.$row['file'].'/hqdefault.jpg' ) ){
                                            $primaryIcon = '<img class="img-responsive" src="http://i1.ytimg.com/vi/'.$row['file'].'/hqdefault.jpg" />';
                                        }else{
                                            $primaryIcon = '<img class="img-responsive" src="'.config_item('assets_img').'no_image.png"/>';
                                        } 
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
                                          <td><div class="img-table-box">'.$primaryIcon.'</div></td>
                                        <td>'.$row['blog_category_name'].'</td>
                                         <td>'.getContent('title', $initTable, getActiveLang()).'</td>
                                        <td><span class="green-text"><span class="badge">'.getTotalViewBlog($row['blog_id']).' </span> viewer</span></td>
                                        <td>'.$showAuthor.'</td>
                                     </tr>';
                                }
                            }
                            ?>
                            </tbody>
                          </table>
					
						<div class="col-md-6">Result  <?= count($datadb) ?> - <?= $result_all?></div>
						<div class="col-md-6"><div class="cs-pagination"><?=  $this->pagination->create_links() ?></div></div>
					</div>
				</div>
			</div>
		<!-- End Container -->
