  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Master</a></li>
        <li class="active">Karyawan</li>
      </ol>
    </section>
    <?php if($this->initial_template == '' || $this->initial_template == 'karyawan'): ?>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Master Karyawan</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <!-- OUTPUT MESSAGE -->
            <?= $this->messagecontroll->showMessage() ?>
              <a href="<?= base_url($this->app_name) ?>/karyawan_add" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah baru</a>
              <br /><br />

              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>NUP</th>
                  <th>ID Finger</th>
                  <th>Nama Karyawan</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                  <?php 
                    if( count($datadb) > 0 ){
                        foreach($datadb as $row){   ?>            
                                <tr>
                                    <td><span><?php echo $row['id_karyawan'] ?></span></td>
                                    <td>
                                        <a href="<?php echo base_url($this->app_name).'/karyawan_edit/'.$row['id_karyawan']; ?>"><?php echo $row['nup']?></a>
                                    </td>
                                    <td>
                                        <?php echo $row['id_finger']; ?>
                                    </td>                                       
                                    <td>
                                        <?php echo $row['nama']; ?>
                                    </td>                                    
                                    <td><a href="<?php echo base_url($this->app_name).'/karyawan_edit/'.$row['id_karyawan']; ?>" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Edit</a> <a href="<?php echo base_url($this->app_name).'/karyawan_remove/'.$row['id_karyawan']; ?>"  class="btn btn-danger   btn-xs"><i class="fa fa-delete"></i> Delete</a></td>        
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
                  <th>NUP</th>
                  <th>ID Finger</th>
                  <th>Nama Karyawan</th>
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
    <?php elseif( $this->initial_template == 'karyawan_add'): ?>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Tambah Karyawan</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <!-- OUTPUT MESSAGE -->
            <?= $this->messagecontroll->showMessage() ?>
            <!-- form start -->
            <form action="<?= base_url('app_master/karyawan_add') ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">NUP</label>

                  <div class="col-sm-10">
                   <input type="text" class="form-control" id="nup" name="nup" placeholder="Input NUP">
                  </div>
                </div>              
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Finger ID</label>

                  <div class="col-sm-10">
                   <input type="text" class="form-control" id="id_finger" name="id_finger" placeholder="Input ID Finger">
                  </div>
                </div>  
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Nama Karyawan</label>

                  <div class="col-sm-10">
                   <input type="text" class="form-control" id="nama" name="nama" placeholder="Input Nama Karyawan">
                  </div>
                </div>                                                          
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Jenis Kelamin</label>

                  <div class="col-sm-10">
                    <select class="form-control" name="kelamin">
                    <option value=''>== Pilih Jenis Kelamin ==</option>
                    <option value='L'>LAKI - LAKI</option>
                    <option value='P'>PEREMPUAN</option>
                    </select>                   
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Tempat Lahir</label>

                  <div class="col-sm-10">
                   <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" placeholder="Input Tempat Lahir">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Tanggal Lahir</label>

                  <div class="col-sm-10">
                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" class="form-control pull-right" id="datepicker" name="tgl_lahir">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Agama</label>

                  <div class="col-sm-10">
                   <input type="text" class="form-control" id="agama" name="agama">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Alamat</label>

                  <div class="col-sm-10">
                   <textarea class="form-control" id="alamat" name="alamat"></textarea>
                  </div>
                </div>                                               
                <div class="form-group">
                  <label for="exampleInputFile" class="col-sm-2 control-label">Unggah foto</label>

                  <div class="col-sm-10">
                    <input id="form-file" type="file" id="file" name="file">
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
    <?php elseif( $this->initial_template == 'karyawan_edit'): ?>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Edit Karyawan</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <!-- OUTPUT MESSAGE -->
            <?= $this->messagecontroll->showMessage() ?>
            <!-- form start -->
            <form action="<?= base_url( $this->app_name ).'/karyawan_edit/'.$this->initial_id ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">NUP</label>

                  <div class="col-sm-10">
                   <input type="text" class="form-control" id="nup" value="<?= rebackPost('nup', $datadb['nup']) ?>" name="nup" placeholder="Input NUP">
                  </div>
                </div>              
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Finger ID</label>

                  <div class="col-sm-10">
                   <input type="text" class="form-control" id="id_finger" value="<?= rebackPost('id_finger', $datadb['id_finger']) ?>" name="id_finger" placeholder="Input ID Finger">
                  </div>
                </div>  
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Nama Karyawan</label>

                  <div class="col-sm-10">
                   <input type="text" class="form-control" id="nama" name="nama" value="<?= rebackPost('nama', $datadb['nama']) ?>" placeholder="Input Nama Karyawan">
                  </div>
                </div>                                                          
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Jenis Kelamin</label>

                  <div class="col-sm-10">
                    <select class="form-control" name="kelamin">
                    <option <?php if($datadb['kelamin'] == "") echo "selected"; ?> value=''>== Pilih Jenis Kelamin ==</option>
                      <option <?php if($datadb['kelamin'] == "L") echo "selected"; ?>>Laki-Laki</option>
                      <option <?php if($datadb['kelamin'] == "P") echo "selected"; ?>>Perempuan</option>
                    </select>                   
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Tempat Lahir</label>

                  <div class="col-sm-10">
                   <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="<?= rebackPost('tempat_lahir', $datadb['tempat_lahir']) ?>" placeholder="Input Tempat Lahir">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Tanggal Lahir</label>

                  <div class="col-sm-10">
                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" class="form-control pull-right" id="datepicker" value="<?= rebackPost('tgl_lahir', $datadb['tgl_lahir']) ?>" name="tgl_lahir">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Agama</label>

                  <div class="col-sm-10">
                   <input type="text" class="form-control" id="agama" value="<?= rebackPost('agama', $datadb['agama']) ?>" name="agama">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Alamat</label>

                  <div class="col-sm-10">
                   <textarea class="form-control" id="alamat" name="alamat"><?= rebackPost('alamat', $datadb['alamat']) ?></textarea>
                  </div>
                </div>                                               
                <div class="form-group">
                  <label for="exampleInputFile" class="col-sm-2 control-label">Unggah foto</label>

                  <div class="col-sm-10">
                    <input id="form-file" type="file" id="file" name="file">
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
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
</script>