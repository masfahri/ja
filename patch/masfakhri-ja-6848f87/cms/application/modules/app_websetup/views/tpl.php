  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Setup</a></li>
        <li class="active">Check for update</li>
      </ol>
    </section>
    <?php if($this->initial_template == '' || $this->initial_template == 'check_for_update'): ?>


    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Check for update</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <!-- OUTPUT MESSAGE -->
            <?= $this->messagecontroll->showMessage() ?>
            <form action="<?= base_url('app_websetup/check_for_update') ?>" method="post" class="form-horizontal">
                <input type="hidden" name="update" value="1"/ >
                <button class="btn btn-info">Update</button>
            </form>

              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>IP Address</th>
                  <th>Key</th>
                  <th>Keterangan</th>
                  <th>Status</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                  <?php 
                    if( count($datadb) > 0 ){
                        foreach($datadb as $row){   ?>            
                                <tr>
                                    <td><span><?php echo $row['id'] ?></span></td>
                                    <td>
                                        <a href="<?php echo base_url($this->app_name).'/fp_edit/'.$row['id']; ?>"><?php echo $row['ip']?></a>
                                    </td>
                                    <td><span><?php echo $row['key'] ?></span></td>
                                    <td><span><?php echo $row['keterangan'] ?></span></td>
                                    <td><?php 
                                          if($row['ip'] != '' && $row['key'] != '') {
                                                $IP=$row['ip'];
                                                $Key=$row['key'];
                      
                                            $Connect = @fsockopen($IP, "80", $errno, $errstr, 1);

                                            if($Connect){
                                              $soap_request="<GetAttLog><ArgComKey xsi:type=\"xsd:integer\">".$Key."</ArgComKey><Arg><PIN xsi:type=\"xsd:integer\">All</PIN></Arg></GetAttLog>";
                                              $newLine="\r\n";
                                              fputs($Connect, "POST /iWsService HTTP/1.0".$newLine);
                                                fputs($Connect, "Content-Type: text/xml".$newLine);
                                                fputs($Connect, "Content-Length: ".strlen($soap_request).$newLine.$newLine);
                                                fputs($Connect, $soap_request.$newLine);
                                              $buffer="";
                                              while($Response=fgets($Connect, 1024)){
                                                $buffer=$buffer.$Response;
                                                
                                              }
                                              echo "<small class='label bg-green'>Koneksi Ke Mesin Absen (".$row['keterangan'].") Sukses</small>";
                                            }else {
                                               echo "<small class='label bg-red'>Koneksi Ke Mesin Absen (".$row['keterangan'].") Gagal</small>";
                                            
                                            }
                                            }
                                            else{
                                                  echo "<small class='label bg-red'>Data Fingerprint belum lengkap</small>";
                                             }

                                    ?></td>                                                                  
                                    <td><a href="<?php echo base_url($this->app_name).'/fp_edit/'.$row['id']; ?>" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Edit</a> <a href="<?php echo base_url($this->app_name).'/fp_remove/'.$row['id']; ?>"  class="btn btn-danger   btn-xs"><i class="fa fa-delete"></i> Delete</a></td>        
                                </tr>
                      <?php  }}else{ ?>
                                <tr>
                                    <td class="uk-text-center"><span class="uk-text-small uk-text-muted uk-text-nowrap">Tidak ada data</span></td>
                                    <td>
                                    </td>
                                    <td><span class="uk-text-danger"></span></td>
                                    <td></td>
                                    <td></td>                                        
                                </tr>
                      <?php  }
                      ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>ID</th>
                  <th>IP Address</th>
                  <th>Key</th>
                  <th>Keterangan</th>
                  <th>Status</th>
                  <th>Aksi</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
    <?php elseif( $this->initial_template == 'fp_add'): ?>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Tambah Mesin Fingerprint</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <!-- OUTPUT MESSAGE -->
            <?= $this->messagecontroll->showMessage() ?>
            <!-- form start -->
            <form action="<?= base_url('app_websetup/fp_add') ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">IP Mesin</label>

                  <div class="col-sm-10">
                   <input type="text" class="form-control" id="ip" name="ip" placeholder="Input IP Mesin">
                  </div>
                </div>              
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Key</label>

                  <div class="col-sm-10">
                   <input type="text" class="form-control" id="key" name="key" placeholder="Input Key">
                  </div>
                </div>  
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Keterangan</label>

                  <div class="col-sm-10">
                   <textarea class="form-control" id="keterangan" name="keterangan"></textarea>
                  </div>
                </div>                                                                                                                      
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <a class="btn btn-default" href="javascript:window.history.go(-1);">Batal</a>
                <button class="btn btn-info pull-right">Simpan</button>
              </div>
              <!-- /.box-footer -->
            </form>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
    <?php elseif( $this->initial_template == 'fp_edit'): ?>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Edit Mesin Fingerprint</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <!-- OUTPUT MESSAGE -->
            <?= $this->messagecontroll->showMessage() ?>
            <!-- form start -->
            <form action="<?= base_url( $this->app_name ).'/fp_edit/'.$this->initial_id ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">IP Mesin</label>

                  <div class="col-sm-10">
                   <input type="text" class="form-control" id="ip" name="ip" value="<?= rebackPost('ip', $datadb['ip']) ?>" placeholder="Input IP Mesin">
                  </div>
                </div>              
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Key</label>

                  <div class="col-sm-10">
                   <input type="text" class="form-control" id="key" name="key" value="<?= rebackPost('key', $datadb['key']) ?>" placeholder="Input Key">
                  </div>
                </div>  
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Keterangan</label>

                  <div class="col-sm-10">
                   <textarea class="form-control" id="keterangan" name="keterangan"><?= rebackPost('keterangan', $datadb['keterangan']) ?></textarea>
                  </div>
                </div>                                                                                                                      
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <a class="btn btn-default" href="javascript:window.history.go(-1);">Batal</a>
                <button class="btn btn-info pull-right">Simpan</button>
              </div>
              <!-- /.box-footer -->
            </form>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->    
    <?php endif; ?>
  </div>
  <!-- /.content-wrapper -->

  <!-- page script -->
<script>
    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    });
</script>