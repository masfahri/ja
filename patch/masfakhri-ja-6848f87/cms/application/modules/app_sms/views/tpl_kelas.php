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
        <li class="active">Kelas</li>
      </ol>
    </section>
    <?php if($this->initial_template == '' || $this->initial_template == 'kelas'): ?>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Master Kelas</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <!-- OUTPUT MESSAGE -->
            <?= $this->messagecontroll->showMessage() ?>
              <a href="<?= base_url($this->app_name) ?>/kelas_add" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah baru</a>
              <br /><br />

              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Nama Kelas</th>
                  <th>Nama Jurusan</th>
                  <th>Wali Kelas</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                  <?php 
                    if( count($datadb) > 0 ){
                        foreach($datadb as $row){   ?>            
                                <tr>
                                    <td><span><?php echo $row['id_kelas'] ?></span></td>
                                    <td>
                                        <a href="<?php echo base_url($this->app_name).'/kelas_edit/'.$row['id_kelas']; ?>"><?php echo $row['Nama_Kelas']?></a>
                                    </td>
                                    <td>
                                        <?php echo $row['keterangan']; ?>
                                    </td>                                       
                                    <td>
                                        <?php echo $row['nama']; ?>
                                    </td>                                    
                                    <td><a href="<?php echo base_url($this->app_name).'/kelas_edit/'.$row['id_kelas']; ?>" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Edit</a> <a href="<?php echo base_url($this->app_name).'/kelas_remove/'.$row['id_kelas']; ?>"  class="btn btn-danger   btn-xs"><i class="fa fa-delete"></i> Delete</a></td>        
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
                  <th>Nama Kelas</th>
                  <th>Nama Jurusan</th>
                  <th>Wali Kelas</th>
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
    <?php elseif( $this->initial_template == 'kelas_add'): ?>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Tambah Kelas</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <!-- OUTPUT MESSAGE -->
            <?= $this->messagecontroll->showMessage() ?>
            <!-- form start -->
            <form action="<?= base_url('app_master/kelas_add') ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Jurusan</label>

                  <div class="col-sm-10">
                    <select class="form-control" name="id_jurusan">
                      <?php
                        foreach ($jurusan as $key => $value) {
                            echo '<option value='.$value['id_jurusan'].'>'.$value['keterangan'].'</option>';
                        }
                        ?>
                    </select>                   
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Kelas</label>

                  <div class="col-sm-10">
                   <input type="text" class="form-control" id="kelas" name="Nama_Kelas" placeholder="Input Nama Kelas">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Wali Kelas</label>

                  <div class="col-sm-10">
                    <select class="form-control" name="id_guru">
                      <option value=''>=== PILIH WALI KELAS ===</option>
                      <?php
                        foreach ($guru as $key => $value) {
                            echo '<option value='.$value['id_guru'].'>'.$value['nama'].'</option>';
                        }
                        ?>
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
    <?php elseif( $this->initial_template == 'kelas_edit'): ?>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Edit Kelas</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <!-- OUTPUT MESSAGE -->
            <?= $this->messagecontroll->showMessage() ?>
            <!-- form start -->
            <form action="<?= base_url( $this->app_name ).'/kelas_edit/'.$this->initial_id ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Kelas</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="Nama_Kelas" name="Nama_Kelas" value="<?= rebackPost('Nama_Kelas', $datadb['Nama_Kelas']) ?>" placeholder="Input Nama Jurusan">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Wali Kelas</label>

                  <div class="col-sm-10">
                    <select class="form-control" name="id_guru">
                     <option value="">=== PILIH WALI KELAS ===</option>
                        <?php
                        foreach($guru as $row){
                              
                              if( $row['No'] == $datadb['id_guru'] )$sel = 'selected';
                              else $sel = '';
                              
                              echo '<option value="'.$row['No'].'" '.$sel.'>'.ucfirst($row['nama']).'</option>';
                        }
                        ?>
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