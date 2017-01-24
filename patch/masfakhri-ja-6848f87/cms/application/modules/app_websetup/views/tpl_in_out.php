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
                  <th>Tipe</th>
                  <th>Jam Masuk</th>
                  <th>Jam Pulang</th>
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
                                    <td><span><?php 
                                      if($row['id_kelas'] == '0')
                                        { 
                                            echo 'Sekolah';
                                        } else{ 

                                          $this->load->model('app_siswa/mapp_siswa');
                                          $kelas = $this->mapp_siswa->getKelas();
                                          foreach ($kelas as $key => $value) {
                                            if($value['id_kelas'] == $row['id_kelas']) {
                                                print_r($value['Nama_Kelas']);
                                            }
                                          } 
                                        } ?></span></td>
                                    <td><span><?php echo $row['jam_masuk'] ?></span></td>
                                    <td><span><?php echo $row['jam_keluar'] ?></span></td>                                                                  
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
                                </tr>
                      <?php  }
                      ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>ID</th>
                  <th>Hari</th>
                  <th>Tipe</th>
                  <th>Jam Masuk</th>
                  <th>Jam Pulang</th>
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
                  <label for="type" class="col-sm-2 control-label">Tipe</label>

                  <div class="col-sm-10">
                    <select class="form-control" name="type" onchange="showDiv(this)">
                    <option value='1'>Sekolah</option>
                    <option value='0'>Kelas</option>                                                                       
                    </select>                   
                  </div>
                </div>  
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
                <div class="form-group" id="id_kelas">
                  <label for="inputEmail3" class="col-sm-2 control-label">Kelas</label>
                  <div class="col-sm-10">
                    <select class="form-control"  name="id_kelas">
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
                      <div class="input-group clockpicker">
                          <input type="text" name="jam_masuk" class="form-control">
                          <span class="input-group-addon">
                              <span class="glyphicon glyphicon-time"></span>
                          </span>
                      </div>
                  </div>

                  </div>
                </div>  
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Jam pulang</label>

                  <div class="col-sm-10">
                  <div class="input-group">
                      <div class="input-group clockpicker">
                          <input type="text" name="jam_keluar" class="form-control">
                          <span class="input-group-addon">
                              <span class="glyphicon glyphicon-time"></span>
                          </span>
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
    <script type="text/javascript">

    document.getElementById('id_kelas').style.display = "none";
          function showDiv(select){
             if(select.value != 0) {
                document.getElementById('id_kelas').style.display = "none";
             }
            else {
                document.getElementById('id_kelas').style.display = "block";
             }

          }  
    </script>
    
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
            <form action="<?= base_url( $this->app_name ).'/in_out_edit/'.$this->initial_id ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
              <div class="box-body">
                <div class="form-group">
                  <label for="type" class="col-sm-2 control-label">Tipe</label>

                  <div class="col-sm-10">
                    <select class="form-control" id="type" name="type" onchange="showDiv(this.value)">
                    <option <?php if($datadb[0]['type'] == "") echo "selected"; ?> value=''>== Pilih Tipe ==</option>
                    <option <?php if($datadb[0]['type'] == "1") echo "selected"; ?> value='1'>Sekolah</option>
                    <option <?php if($datadb[0]['type'] == "0") echo "selected"; ?> value='0'>Kelas</option>                                                                       
                    </select>                   
                  </div>
                </div>  
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Hari</label>

                  <div class="col-sm-10">
                    <select class="form-control" name="hari">
                    <option <?php if($datadb[0]['hari'] == "") echo "selected"; ?> value=''>== Pilih Hari ==</option>
                    <option <?php if($datadb[0]['hari'] == "Mon") echo "selected"; ?> value='Mon'>Senin</option>
                    <option <?php if($datadb[0]['hari'] == "Tue") echo "selected"; ?> value='Tue'>Selasa</option>
                    <option <?php if($datadb[0]['hari'] == "Wed") echo "selected"; ?> value='Wed'>Rabu</option>
                    <option <?php if($datadb[0]['hari'] == "Thu") echo "selected"; ?> value='Thu'>Kamis</option>
                    <option <?php if($datadb[0]['hari'] == "Fri") echo "selected"; ?> value='Fri'>Jum'at</option>
                    <option <?php if($datadb[0]['hari'] == "Sat") echo "selected"; ?> value='Sat'>Sabtu</option>
                    <option <?php if($datadb[0]['hari'] == "Sun") echo "selected"; ?> value='Sun'>Minggu</option>                                                                           
                    </select>                   
                  </div>
                </div>               
                <div class="form-group" id="id_kelas">
                  <label for="inputEmail3" class="col-sm-2 control-label">Kelas</label>
                  <div class="col-sm-10">
                    <select class="form-control" name="id_kelas">
                      <option value=''>=== PILIH KELAS ===</option>
                      <?php
                        foreach ($datadbkelas as $key => $value) {
                            if($datadb[0]['id_kelas'] == $value['id_kelas']) {
                              echo '<option value='.$value['id_kelas'].' selected>'.$value['Nama_Kelas'].'</option>';
                            }
                            else{
                            echo '<option value='.$value['id_kelas'].'>'.$value['Nama_Kelas'].'</option>';
                          }
                        }
                        ?>
                    </select>
                  </div>
                </div>  
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Jam masuk</label>

                  <div class="col-sm-10">
                  <div class="input-group">
                      <div class="input-group clockpicker">
                          <input type="text" name="jam_masuk" class="form-control" value="<?php echo $datadb[0]['jam_masuk'] ?>">
                          <span class="input-group-addon">
                              <span class="glyphicon glyphicon-time"></span>
                          </span>
                      </div>
                  </div>

                  </div>
                </div>  
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Jam pulang</label>

                  <div class="col-sm-10">
                  <div class="input-group">
                      <div class="input-group clockpicker">
                          <input type="text" name="jam_keluar" class="form-control" value="<?php echo $datadb[0]['jam_keluar'] ?>">
                          <span class="input-group-addon">
                              <span class="glyphicon glyphicon-time"></span>
                          </span>
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
    <script type="text/javascript">


    $(document).ready(function(){
          function showDiv(select){
             if(select.value == 1 || select.value == '') {
                document.getElementById('id_kelas').style.display = "none";
             }
            else {
                document.getElementById('id_kelas').style.display = "block";
             }

          }  

    });
    </script>

    <?php endif; ?>
  </div>
  <!-- /.content-wrapper -->
