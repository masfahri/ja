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
        <li class="active">Pengaturan In/Out</li>
      </ol>
    </section>
    <?php if($this->initial_template == '' || $this->initial_template == 'in_out'): ?>


    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Pengaturan In/Out</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <!-- OUTPUT MESSAGE -->
            <?= $this->messagecontroll->showMessage() ?>
              <a href="<?= base_url($this->app_name) ?>/in_out_add" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah baru</a>
              <br /><br />

              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Hari</th>
                  <th>Kelas</th>
                  <th>Jam Masuk</th>
                  <th>Jam Pulang</th>
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
                                        <a href="<?php echo base_url($this->app_name).'/in_out_edit/'.$row['id']; ?>"><?php echo $row['hari']?></a>
                                    </td>
                                    <td><span><?php echo $row['id_kelas'] ?></span></td>
                                    <td><span><?php echo $row['jam_masuk'] ?></span></td>
                                    <td><span><?php echo $row['jam_keluar'] ?></span></td>
                                    <td><span><?php echo $row['status'] ?></span></td>                                                                  
                                    <td><a href="<?php echo base_url($this->app_name).'/in_out_edit/'.$row['id']; ?>" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Edit</a> <a href="<?php echo base_url($this->app_name).'/in_out_remove/'.$row['id']; ?>"  class="btn btn-danger   btn-xs"><i class="fa fa-delete"></i> Delete</a></td>        
                                </tr>
                      <?php  }}else{ ?>
                                <tr>
                                    <td class="uk-text-center"><span class="uk-text-small uk-text-muted uk-text-nowrap">Tidak ada data</span></td>
                                    <td>
                                    </td>
                                    <td><span class="uk-text-danger"></span></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>                                        
                                </tr>
                      <?php  }
                      ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>ID</th>
                  <th>Hari</th>
                  <th>Kelas</th>
                  <th>Jam Masuk</th>
                  <th>Jam Pulang</th>
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
    <?php elseif( $this->initial_template == 'in_out_add'): ?>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Tambah Waktu In/Out</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <!-- OUTPUT MESSAGE -->
            <?= $this->messagecontroll->showMessage() ?>
            <!-- form start -->
            <form action="<?= base_url('app_websetup/in_out_add') ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
              <div class="box-body">

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Hari</label>

                  <div class="col-sm-10">
                    <select class="form-control" name="hari">
                    <option value=''>== Pilih Hari ==</option>
                    <option value='Mon'>Senin</option>
                    <option value='Tue'>Selasa</option>
                    <option value='Wed'>Rabu</option>
                    <option value='Thu'>Kamis</option>
                    <option value='Fri'>Jum'at</option>
                    <option value='Sat'>Sabtu</option>
                    <option value='Sun'>Minggu</option>                                                                           
                    </select>                   
                  </div>
                </div>               
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Kelas</label>
                  <div class="col-sm-10">
                    <select class="form-control" name="id_kelas">
                      <option value=''>=== PILIH KELAS ===</option>
                      <?php
                        foreach ($kelas as $key => $value) {
                            echo '<option value='.$value['id_kelas'].'>'.$value['Nama_Kelas'].'</option>';
                        }
                        ?>
                    </select>
                  </div>
                </div>  
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Jam masuk</label>

                  <div class="col-sm-10">
                  <div class="input-group">
                    <input type="text" class="form-control timepicker" name="jam_masuk">

                    <div class="input-group-addon">
                      <i class="fa fa-clock-o"></i>
                    </div>
                  </div>

                  </div>
                </div>  
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Jam pulang</label>

                  <div class="col-sm-10">
                  <div class="input-group">
                    <input type="text" class="form-control timepicker" name="jam_keluar">

                    <div class="input-group-addon">
                      <i class="fa fa-clock-o"></i>
                    </div>
                  </div>

                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Keterangan</label>

                  <div class="col-sm-10">
                   <textarea class="form-control" id="keterangan" name="keterangan"></textarea>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Status</label>

                  <div class="col-sm-10">
                    <select class="form-control" name="status">
                    <option value=''>== Pilih Status ==</option>
                    <option value='active'>Active</option>
                    <option value='disabled'>Disabled</option>
                    </select>                   
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
    <?php elseif( $this->initial_template == 'in_out_edit'): ?>
    <!-- Main content -->
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Tambah Waktu In/Out</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <!-- OUTPUT MESSAGE -->
            <?= $this->messagecontroll->showMessage() ?>
            <!-- form start -->
            <form action="<?= base_url( $this->app_name ).'/fp_edit/'.$this->initial_id ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
              <div class="box-body">

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Hari</label>

                  <div class="col-sm-10">
                    <select class="form-control" name="hari">
                    <option <?php if($datadb['hari'] == "") echo "selected"; ?> value=''>== Pilih Hari ==</option>
                    <option <?php if($datadb['hari'] == "Senin") echo "selected"; ?> value='Senin'>Senin</option>
                    <option <?php if($datadb['hari'] == "Selasa") echo "selected"; ?> value='Selasa'>Selasa</option>
                    <option <?php if($datadb['hari'] == "Rabu") echo "selected"; ?> value='Rabu'>Rabu</option>
                    <option <?php if($datadb['hari'] == "Kamis") echo "selected"; ?> value='Kamis'>Kamis</option>
                    <option <?php if($datadb['hari'] == "Jumat") echo "selected"; ?> value='Jumat'>Jum'at</option>
                    <option <?php if($datadb['hari'] == "Sabtu") echo "selected"; ?> value='Sabtu'>Sabtu</option>
                    <option <?php if($datadb['kelamin'] == "Minggu") echo "selected"; ?> value='Minggu'>Minggu</option>                                                                           
                    </select>                   
                  </div>
                </div>               
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Kelas</label>
                  <div class="col-sm-10">
                    <select class="form-control" name="id_kelas">
                      <option value=''>=== PILIH KELAS ===</option>
                      <?php
                        foreach ($kelas as $key => $value) {
                            echo '<option value='.$value['id_kelas'].'>'.$value['Nama_Kelas'].'</option>';
                        }
                        ?>
                    </select>
                  </div>
                </div>  
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Jam masuk</label>

                  <div class="col-sm-10">
                  <div class="input-group">
                    <input type="text" class="form-control timepicker" name="jam_masuk">

                    <div class="input-group-addon">
                      <i class="fa fa-clock-o"></i>
                    </div>
                  </div>

                  </div>
                </div>  
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Jam pulang</label>

                  <div class="col-sm-10">
                  <div class="input-group">
                    <input type="text" class="form-control timepicker" name="jam_keluar">

                    <div class="input-group-addon">
                      <i class="fa fa-clock-o"></i>
                    </div>
                  </div>

                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Keterangan</label>

                  <div class="col-sm-10">
                   <textarea class="form-control" id="keterangan" name="keterangan"></textarea>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Status</label>

                  <div class="col-sm-10">
                    <select class="form-control" name="status">
                    <option value=''>== Pilih Status ==</option>
                    <option value='active'>Active</option>
                    <option value='disabled'>Disabled</option>
                    </select>                   
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