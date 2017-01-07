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
        <li class="active">Guru</li>
      </ol>
    </section>
    <?php if($this->initial_template == '' || $this->initial_template == 'guru'): ?>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Master Guru</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <!-- OUTPUT MESSAGE -->
            <?= $this->messagecontroll->showMessage() ?>
              <a href="<?= base_url($this->app_name) ?>/guru_add" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah baru</a>
              <br /><br />

              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>NIP</th>
                  <th>ID Fingerprint</th>
                  <th>Nama</th>
                  <th>Foto</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                  <?php 
                    if( count($datadb) > 0 ){
                        foreach($datadb as $row){   ?>            
                                <tr>
                                    <td><span><?php echo $row['nip'] ?></span></td>
                                    <td>
                                        <a href="<?php echo base_url($this->app_name).'/guru_edit/'.$row['id_finger']; ?>"><?php echo $row['id_finger']?></a>
                                    </td>
                                    <td><?php echo $row['nama'] ?></td>
                                   <td><?php if($row['foto'] != '') { ?>
                                        <img src="<?php echo $row['foto'];?>" width="30" height="30"></img>
                                        <?php }else {?>
                                        <img src="http://placehold.it/30x30" width="30" height="30"></img>
                                        <?php }?>
                                        </td> 
                                    <td><a href="<?php echo base_url($this->app_name).'/guru_edit/'.$row['id_finger']; ?>" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Edit</a> <a href="<?php echo base_url($this->app_name).'/guru_remove/'.$row['id_finger']; ?>"  class="btn btn-danger   btn-xs"><i class="fa fa-delete"></i> Delete</a></td>        
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
                  <th>NIP</th>
                  <th>ID Fingerprint</th>
                  <th>Nama</th>
                  <th>Foto</th>
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
    <?php elseif( $this->initial_template == 'guru_add'): ?>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Tambah Guru</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <!-- OUTPUT MESSAGE -->
            <?= $this->messagecontroll->showMessage() ?>
            <!-- form start -->
            <form action="<?= base_url('app_master/guru_add') ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">NIP</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="nip" name="nip" placeholder="Input NIP">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">ID Finger</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="id_finger" name="id_finger" placeholder="Input ID Finger">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Nama</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Input Nama">
                  </div>
                </div>  
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Password</label>

                  <div class="col-sm-10">
                    <input type="password" class="form-control" id="pasword" name="pasword" placeholder="Password">
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
    <?php elseif( $this->initial_template == 'guru_edit'): ?>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Edit Guru</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <!-- OUTPUT MESSAGE -->
            <?= $this->messagecontroll->showMessage() ?>
            <!-- form start -->
            <form action="<?= base_url( $this->app_name ).'/guru_edit/'.$this->initial_id ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">NIP</label>

                  <div class="col-sm-10">
                    <input readonly type="text" class="form-control" id="nip" name="nip" value="<?= rebackPost('nip', $datadb['nip']) ?>" placeholder="Input NIP">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">ID Finger</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="id_finger" name="id_finger" value="<?= rebackPost('id_finger', $datadb['id_finger']) ?>" placeholder="Input ID Finger">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Nama</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="nama" name="nama" value="<?= rebackPost('nama', $datadb['nama']) ?>" placeholder="Input Nama">
                  </div>
                </div>  
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Password</label>

                  <div class="col-sm-10">
                    <input type="password" class="form-control" id="pasword" name="pasword" value="<?= rebackPost('pasword', $datadb['pasword']) ?>" placeholder="Password">
                  </div>
                </div>  
                <div class="form-group">
                  <label for="exampleInputFile" class="col-sm-2 control-label">Unggah foto</label>

                  <div class="col-sm-10">
                      <img class="img-circle img-bordered-sm img-responsive" width="100" height="100" src="<?= base_url(). rebackPost('foto', $datadb['foto']) ?>" alt="user image">
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