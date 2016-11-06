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
        <li class="active">Siswa</li>
      </ol>
    </section>
    <?php if($this->initial_template == '' || $this->initial_template == 'siswa'): ?>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Master Siswa</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <!-- OUTPUT MESSAGE -->
            <?= $this->messagecontroll->showMessage() ?>
              <a href="<?= base_url($this->app_name) ?>/siswa_add" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah baru</a>
              <br /><br />

              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>ID FINGER</th>
                  <th>No. Absen</th>
                  <th>Nama Siswa</th>
                  <th>Kelas</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                  <?php 
                    if( count($datadb) > 0 ){
                        foreach($datadb as $row){   ?>            
                                <tr>
                                    <td><span><?php echo $row['id'] ?></span></td>
                                    <td><span><?php echo $row['id_finger'] ?></span></td>
                                    <td><span><?php echo $row['absen'] ?></span></td>
                                    <td>
                                        <a href="<?php echo base_url($this->app_name).'/siswa_edit/'.$row['id']; ?>"><?php echo $row['nama_panggilan']?></a>
                                    </td>
                                    <td>
                                        <?php echo $row['Nama_Kelas']?>
                                    </td>                                                                   
                                    <td><a href="<?php echo base_url($this->app_name).'/siswa_edit/'.$row['id']; ?>" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Edit</a> <a href="<?php echo base_url($this->app_name).'/siswa_remove/'.$row['id_finger']; ?>"  class="btn btn-danger   btn-xs"><i class="fa fa-delete"></i> Delete</a></td>        
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
                  <th>ID FINGER</th>
                  <th>No. Absen</th>
                  <th>Nama Siswa</th>
                  <th>Kelas</th>
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
    <?php elseif( $this->initial_template == 'siswa_add'): ?>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Tambah Siswa</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <!-- OUTPUT MESSAGE -->
            <?= $this->messagecontroll->showMessage() ?>
            <!-- form start -->
            <form action="<?= base_url('app_master/siswa_add') ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">NIS</label>

                  <div class="col-sm-10">
                   <input type="text" class="form-control" id="nis" name="nis" placeholder="Input NIS">
                  </div>
                </div>              
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Finger ID</label>

                  <div class="col-sm-10">
                   <input type="text" class="form-control" id="id_finger" name="id_finger" placeholder="Input ID Finger">
                  </div>
                </div>  
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">No. Absen</label>

                  <div class="col-sm-10">
                   <input type="text" class="form-control" id="absen" name="absen" placeholder="Input No. Absen">
                  </div>
                </div> 
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Nama Siswa</label>

                  <div class="col-sm-10">
                   <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" placeholder="Input Nama Siswa">
                  </div>
                </div>                 
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Nama Panggilan (nama yang muncul pada fingerprint)</label>

                  <div class="col-sm-10">
                   <input type="text" class="form-control" id="nama_panggilan" name="nama_panggilan" placeholder="Input Nama Panggilan">
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
    <?php elseif( $this->initial_template == 'siswa_edit'): ?>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Edit Siswa</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <!-- OUTPUT MESSAGE -->
            <?= $this->messagecontroll->showMessage() ?>
            <!-- form start -->
            <form action="<?= base_url( $this->app_name ).'/siswa_edit/'.$this->initial_id ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">NIS</label>

                  <div class="col-sm-10">
                   <input type="text" class="form-control" id="nis" name="nis" value="<?= rebackPost('nis', $datadb['nis']) ?>" placeholder="Input NIS">
                  </div>
                </div>              
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Finger ID</label>

                  <div class="col-sm-10">
                   <input type="text" class="form-control" id="id_finger" name="id_finger" value="<?= rebackPost('id_finger', $datadb['id_finger']) ?>" placeholder="Input ID Finger">
                  </div>
                </div>  
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">No. Absen</label>

                  <div class="col-sm-10">
                   <input type="text" class="form-control" id="absen" name="absen" value="<?= rebackPost('absen', $datadb['absen']) ?>" placeholder="Input No. Absen">
                  </div>
                </div> 
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Nama Siswa</label>

                  <div class="col-sm-10">
                   <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" value="<?= rebackPost('nama_siswa', $datadb['nama_siswa']) ?>" placeholder="Input Nama Siswa">
                  </div>
                </div>                 
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Nama Panggilan (nama yang muncul pada fingerprint)</label>

                  <div class="col-sm-10">
                   <input type="text" class="form-control" id="nama_panggilan" name="nama_panggilan" value="<?= rebackPost('nama_panggilan', $datadb['nama_panggilan']) ?>" placeholder="Input Nama Panggilan">
                  </div>
                </div>                                             
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Jenis Kelamin</label>

                  <div class="col-sm-10">
                    <select class="form-control" name="kelamin">
                    <option value="">-- PILIH KELAMIN --</option>
                      <option <?php if($kelamin['kelamin'] == "L") echo "selected"; ?>>Laki-Laki</option>
                      <option <?php if($kelamin['kelamin'] == "P") echo "selected"; ?>>Perempuan</option>
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
                  <label for="inputEmail3" class="col-sm-2 control-label">Kelas</label>

                  <div class="col-sm-10">
                    <select class="form-control" name="id_kelas">
                    <option value="">-- CHOOSE TYPE --</option>
                      <?php
                         if($kelas != ''){
                          foreach($kelas as $row){
                              
                              if( $row['id_kelas'] == $datadb['id_kelas'])$sel  = 'selected';
                              else $sel  = '';
                                
                                echo '<option value="'.$row['id_kelas'].'" '.$sel.'>'.ucfirst($row['Nama_Kelas']).'</option>';
                            }                                      
                         }
                     ?>
                    </select>
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
    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    });
</script>