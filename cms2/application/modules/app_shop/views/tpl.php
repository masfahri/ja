<div class="md-card">
    <div class="md-card-content">
        <div class="uk-overflow-container uk-margin-bottom">
            <!-- OUTPUT MESSAGE -->
            <?= $this->messagecontroll->showMessage() ?>
                <!-- OUTPUT MESSAGE -->
                <?php if( $this->initial_template == '' ): ?>
                <a href="<?= base_url($this->app_name) ?>/add" class="md-btn md-btn-success md-btn-wave-light waves-effect waves-button waves-light"> Add new Products</a>
                <a href="<?= base_url($this->app_name) ?>/indexCat" class="md-btn md-btn-success md-btn-wave-light waves-effect waves-button waves-light"> Product categories</a>
                <table class="uk-table uk-table-align-vertical uk-table-nowrap tablesorter tablesorter-altair" id="ts_issues">
                    <thead>
                        <tr>
                            <th class="uk-text-center">ID</th>
                            <th>Image</th>
                            <th>Product Name</th>
                            <th>Product Categories</th>
                            <th>Create Date</th>
                            <th>On Sale</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th class="uk-text-center">ID</th>
                            <th>Image</th>
                            <th>Product Name</th>
                            <th>Product Categories</th>
                            <th>Create Date</th>
                            <th>On Sale</th>
                        </tr>
                    </tfoot>
                    <tbody>
                                <?php 
                                if( count($datadb) > 0 ){

                                    $dataLock = array();
                                    foreach($datadb as $row){
            
                                        $initTable = $row['product_id'];
                                        
                                        # On Sale
                                        if( $row['deals'] == 'yes' )$exDeals = '<span class="uk-text-success">Yes</span>';
                                        else $exDeals = '<span class="uk-text-danger">No</span>';
                                        
                                        # first image product
                                        $firstImage = getLastProductImage2($row['product_id'], 1);
                                     
                                        echo '
                                        <tr>
                                            <td class="uk-text-center"><span class="uk-text-small uk-text-muted uk-text-nowrap">'.$initTable.'</span></td>
                                            <td><img width="100%" height="100%" src="'.base_url().getThumbnailsImage( $firstImage['file'], $firstImage['extention'] ).'"/></td>
                                            <td>
                                                <a href="'.base_url($this->app_name).'/edit/'.$initTable.'">'.$row['product_name'].'</a>
                                            </td>
                                            <td>'.$row['product_category'].'</td>
                                            <td>'.$row['create_date'].'</td>
                                            <td>'.$exDeals.'</td>
                                        </tr>';
                                    }
                                }else{
                                    echo '<tr><td colspan="5"><span class="gray-text">Data Not Found</span></td></tr>';
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
        <form action="<?= base_url( $this->app_name ) ?>" method="post" class="uk-form-stacked" enctype="multipart/form-data">        
        <div class="uk-margin-medium-bottom">
            <label for="description">Shop Instruction</label>
            <hr>
            <textarea class="md-input" id="page_desc" name="page_desc"><?= $page_desc['page_desc'] ?></textarea>
        </div>
        <div class="uk-width-large-1-4 uk-width-medium-2-2 uk-grid-margin uk-row-first">
            <div class="uk-input-group">
                <button class="md-btn md-btn-primary md-btn-wave-light waves-effect waves-button waves-light">Save</button>
            </div>
        </div>
        </form> 

                <?php elseif( $this->initial_template == 'indexCat' ): ?>
                  
                <a href="<?= base_url($this->app_name) ?>/add" class="md-btn md-btn-success md-btn-wave-light waves-effect waves-button waves-light"> Add new Products</a>
                <a href="<?= base_url($this->app_name) ?>/addCat" class="md-btn md-btn-success md-btn-wave-light waves-effect waves-button waves-light"> Add new product categories</a>
                <table class="uk-table uk-table-align-vertical uk-table-nowrap tablesorter tablesorter-altair" id="ts_issues">
                    <thead>
                        <tr>
                            <th class="uk-text-center">ID</th>
                            <th>Product Categories</th>
                            <th>Create Date</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th class="uk-text-center">ID</th>
                            <th>Product Categories</th>
                            <th>Create Date</th>
                        </tr>
                    </tfoot>
                    <tbody>
                                <?php 
                                if( count($datadb) > 0 ){
                                    
                                    // 41 as Tahukah Kamu
                                    $dataLock = array(41);
                                    foreach($datadb as $row){
            
                                        $initTable = $row['product_category_id'];
                                        
                                        echo '
                                        <tr>
                                            <td class="uk-text-center"><span class="uk-text-small uk-text-muted uk-text-nowrap">'.$initTable.'</span></td>
                                            <td><a href="'.base_url($this->app_name).'/editCat/'.$initTable.'">'.$row['category_name'].'</a></td>
                                            <td>'.$row['date'].'</td>
                                         </tr>';
                                    }
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
                        <h3 class="heading_a">Add product</h3>
                        <div class="uk-grid" data-uk-grid-margin>
                            <div class="uk-width-medium-1-1">
                                <div class="uk-form-row">
                                    <div class="uk-grid">
                                        <div class="uk-width-medium-1-3">
                                          <label>On Sale</label>
                                          <select name="deals" class="uk-form-width-medium" data-md-selectize-inline>
                                            <?php
                                            $dataDeals = array('no', 'yes');
                                            foreach($dataDeals as $row){
                                                  
                                                  if( $row == set_value('deals') )$sel = 'selected';
                                                  else $sel = '';
                                                  
                                                  echo '<option value="'.$row.'" '.$sel.'>'.strtoupper($row).'</option>';
                                            }
                                            ?>
                                          </select>  
                                        </div>
                                        <div class="uk-width-medium-1-3">
                                          <label>Product Name</label>
                                          <input name="product_name" type="text" class="md-input" />
                                        </div>
                                        <div class="uk-width-medium-1-3">
                                          <label>Product price</label>
                                          <input name="product_price" type="text" class="md-input" />
                                        </div>                                                                                                                
                                    </div>
                                    <div class="uk-grid">
                                        <div class="uk-width-medium-1-1">
                                          <label>Product price (for sale price)</label>
                                          <input name="product_price_disc" type="text" class="md-input" />
                                        </div> 
                                    </div>
                                    <div class="uk-grid">
                                        <div class="uk-width-medium-1-1">
                                            <label>Product Description</label>
                                            <br >
                                            <textarea name="product_desc" cols="30" rows="4" class="md-input"></textarea>
                                        </div>
                                    </div>
                                    <div class="uk-grid">
                                        <div class="uk-width-medium-1-1">
                                          <select id="product_category" class="uk-form-width-medium" data-md-selectize-inline name="product_category">
                                            <option value="">Product Categories</option>
                                            <?php
                                            $dataCategory = getProductCategory(); // use only for blog
                                            if(count($dataCategory)>0){

                                                foreach($dataCategory as $row){ 

                                                   if( $row['category_name'] == set_value('product_category') )$sel = 'selected';
                                                   else $sel = ''; 
                                                  
                                                   echo '<option value="'.$row['category_name'].'" '.$sel.'>'.$row['category_name'].'</option>';
                                                }
                                            }
                                            ?>
                                          </select>
                                        </div>
                                    </div>
                                    <div class="uk-grid">
                                      <div class="uk-width-medium-1-2 uk-row-first">
                                          <h5 class="heading_e">
                                            You have 5 image product collection<br />
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
                                    </div>
                                    <div class="uk-width-large-1-4 uk-width-medium-2-2 uk-grid-margin uk-row-first">
                                        <div class="uk-input-group">
                                            <button class="md-btn md-btn-success md-btn-wave-light waves-effect waves-button waves-light">Save</button>
                                            <a href="javascript:window.history.go(-1);" class="md-btn md-btn-danger md-btn-wave-light waves-effect waves-button waves-light">Cancel</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        <?php elseif( $this->initial_template == 'addCat' ): ?>
             <form action="<?= base_url($this->app_name).'/addCat' ?>" method="post" enctype="multipart/form-data">
                <h4 class="text-info">Add product categories</h4>
                        <div class="uk-grid" data-uk-grid-margin>
                            <div class="uk-width-medium-1-1">
                                <div class="uk-form-row">
                                    <div class="uk-grid">
                                        <div class="uk-width-medium-1-1">
                                          <label>Product categories Name</label>
                                          <input name="category_name" type="text" class="md-input" />
                                        </div>                                                                                                              
                                    </div>
                                    <div class="uk-width-large-1-4 uk-width-medium-2-2 uk-grid-margin uk-row-first">
                                        <div class="uk-input-group">
                                            <button class="md-btn md-btn-success md-btn-wave-light waves-effect waves-button waves-light">Save</button>
                                            <a href="javascript:window.history.go(-1);" class="md-btn md-btn-danger md-btn-wave-light waves-effect waves-button waves-light">Cancel</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
              </form>             
        <?php elseif( $this->initial_template == 'edit' ): ?>
              <form action="<?= base_url($this->app_name).'/edit/'.$this->initial_id ?>" method="post" enctype="multipart/form-data">
                <div class="md-card">
                  <div class="md-card-content">                
                    <h4 class="heading_a">Edit product</h4>
                     <div class="uk-grid" data-uk-grid-margin>
                            <div class="uk-width-medium-1-1">
                                <div class="uk-form-row">
                                    <div class="uk-grid">
                                        <div class="uk-width-medium-1-3">
                                          <label>On Sale</label>
                                          <select name="deals" class="uk-form-width-medium" data-md-selectize-inline>
                                            <?php
                                            $dataDeals = array('no', 'yes');
                                            foreach($dataDeals as $row){
                                                  
                                                  if( $row == set_value('deals') )$sel = 'selected';
                                                  else $sel = '';
                                                  
                                                  echo '<option value="'.$row.'" '.$sel.'>'.strtoupper($row).'</option>';
                                            }
                                            ?>
                                          </select>  
                                        </div>
                                        <div class="uk-width-medium-1-3">
                                          <input name="product_name" value="<?= rebackPost('product_name', $datadb['product_name']) ?>" type="text" class="md-input" />
                                        </div>
                                        <div class="uk-width-medium-1-3">
                                          <input name="product_price" value="<?= rebackPost('product_price', $datadb['product_price']) ?>" type="text" class="md-input" />
                                        </div>                                                                                                                
                                    </div>
                                    <div class="uk-grid">
                                        <div class="uk-width-medium-1-1">
                                          <input name="product_price_disc" value="<?= rebackPost('product_price_disc', $datadb['product_price_disc']) ?>" type="text" class="md-input" />
                                        </div> 
                                    </div>
                                    <div class="uk-grid">
                                        <div class="uk-width-medium-1-1">
                                            <br >
                                            <textarea name="product_desc" cols="30" rows="4" class="md-input"><?= $datadb['product_desc'] ?></textarea>
                                        </div>
                                    </div>
                                    <div class="uk-grid">
                                        <div class="uk-width-medium-1-1">
                                          <select id="product_category" name="product_category" class="uk-form-width-medium" data-md-selectize-inline>
                                            <option value="">Select Product Categories </option>
                                            <?php
                                            $dataCategory = getProductCategory(); // use only for blog
                                            if(count($dataCategory)>0){

                                                foreach($dataCategory as $row){ 

                                                   if( $row['category_name'] == rebackPost('product_category', $datadb['product_category']) )$sel = 'selected';
                                                   else $sel = ''; 
                                                  
                                                   echo  '<option value="'.$row['category_name'].'" '.$sel.'>'.$row['category_name'].'</option>';
                                                }
                                            }
                                            ?>
                                         </select>
                                        </div>
                                    </div>
                                    <div class="uk-grid">
                                      <div class="uk-width-medium-1-2 uk-row-first">
                                          <h5 class="heading_e">
                                            You have 5 image product collection<br />
                                            File image must be in extention <b>(JPG, JPEG)</b>
                                          </h5>

                                                <!-- Generate result image upload -->
                                                        <?php
                                                        $imageUpload = getLastProductImage2($datadb['product_id']);
                                                        if( count($imageUpload) > 0 ){
                                                          
                                                            for($i=0; $i<5; $i++){
                                                                 
                                                                 $removeLink = '';
                                                                 $fieldPid   = '';
                                                                 if( isset($imageUpload[$i]['file']) ){
                                                                    
                                                                    if($i != 0){
                                                                        $removeLink = '<a href="'.base_url('app_shop').'/removeProductImage?id_image='.$imageUpload[$i]['product_image_id'].'"><span class="glyphicon glyphicon-remove"/><span></a>';
                                                                    }
                                                                 
                                                                    echo '
                    
                                                                        <div class="img"><img src="'.base_url().$imageUpload[$i]['file'].'"/></div><a href="'.base_url('app_product').'/removeProductImage?id_image='.$imageUpload[$i]['product_image_id'].'"><span class="glyphicon glyphicon-remove"/><span></a>
                                                                        <div class="uk-form-file md-btn md-btn-primary"><input type="file" id="form-file" name="file_'.$i.'"/>Select</div>
                                                                        <input type="hidden" name="pid_'.$i.'" value="'.$imageUpload[$i]['product_image_id'].'"/>
                                                                        '.$removeLink.''; 
                                                                    
                                                                 }else{
                                                                    
                                                                    echo '
                                                                    
                                                                        <div class="no-image"><span class="glyphicon glyphicon-picture"></span></div>
                                                                        <div class="uk-form-file md-btn md-btn-primary"><input type="file" id="form-file" name="file_'.$i.'"/>Select</div>
                                                                        <input type="hidden" name="pid_'.$i.'" value=""/>
                                                                    ';
                                                                 }
                                                            }
                                                        }
                                                        ?>
                                                <!-- ========================= -->                                          
                                      </div>
                                    </div>
                                    <div class="uk-width-large-1-4 uk-width-medium-2-2 uk-grid-margin uk-row-first">
                                        <div class="uk-input-group">
                                            <button class="md-btn md-btn-success md-btn-wave-light waves-effect waves-button waves-light">Save</button>
                                            <a href="javascript:;"  class="md-btn md-btn-danger md-btn-wave-light waves-effect waves-button waves-light act-remove-table" data-url="<?php $initTable = $datadb['product_id']; echo  base_url($this->app_name).'/remove/'.$initTable; ?>" title="Remove">Delete</a>
                                            <a href="javascript:window.history.go(-1);" class="md-btn md-btn-danger md-btn-wave-light waves-effect waves-button waves-light">Cancel</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>                    
                  </div>
                </div>
              </form>
        <?php elseif( $this->initial_template == 'editCat' ): ?>
             <form action="<?= base_url($this->app_name).'/editCat/' ?>" method="post" enctype="multipart/form-data">
                <h4 class="text-info">Add product categories</h4>
                        <div class="uk-grid" data-uk-grid-margin>
                            <div class="uk-width-medium-1-1">
                                <div class="uk-form-row">
                                    <div class="uk-grid">
                                        <div class="uk-width-medium-1-1">
                                          <label>Product categories Name</label>
                                          <input name="category_name" value="<?= rebackPost('category_name', $datadb['category_name']) ?>" type="text" class="md-input" />
                                          <input type="hidden" name="product_category_id" value="<?= rebackPost('product_category_id', $datadb['product_category_id']) ?>">
                                        </div>                                                                                                              
                                    </div>
                                    <div class="uk-width-large-1-4 uk-width-medium-2-2 uk-grid-margin uk-row-first">
                                        <div class="uk-input-group">
                                            <button class="md-btn md-btn-success md-btn-wave-light waves-effect waves-button waves-light">Save</button>
                                            <a href="javascript:window.history.go(-1);" class="md-btn md-btn-danger md-btn-wave-light waves-effect waves-button waves-light">Cancel</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
              </form>  

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
