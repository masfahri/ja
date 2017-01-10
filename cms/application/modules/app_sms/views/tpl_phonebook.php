  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">SMS</a></li>
        <li class="active">Phonebook</li>
      </ol>
    </section>
    <?php if($this->initial_template == '' || $this->initial_template == 'phonebook'): ?>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Kontak Ortu</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <!-- OUTPUT MESSAGE -->
            <?= $this->messagecontroll->showMessage() ?>
              <a href="<?= base_url($this->app_name) ?>/phonebook_add" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah baru</a>
              <br /><br />

              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Nama Kontak</th>
                  <th>Nomor HP</th>
                  <th>Ortu Dari</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                  <?php 
                    if( count($datadb) > 0 ){
                        foreach($datadb as $row){   ?>            
                                <tr>
                                    <td><span><?php echo $row['id2'] ?></span></td>
                                    <td>
                                        <a href="<?php echo base_url($this->app_name).'/phonebook_edit/'.$row['id2']; ?>"><?php echo $row['nama_ortu']?></a>
                                    </td>
                                    <td>
                                        <?php echo $row['no_hp']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['nama_siswa']; ?>
                                    </td>                                                                       
                                    <td><a href="<?php echo base_url($this->app_name).'/phonebook_edit/'.$row['id2']; ?>" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Edit</a> <a href="<?php echo base_url($this->app_name).'/phonebook_remove/'.$row['id2']; ?>"  class="btn btn-danger   btn-xs"><i class="fa fa-delete"></i> Delete</a></td>        
                                </tr>
                      <?php  }}else{ ?>
                                <tr>
                                    <td class="uk-text-center"><span class="uk-text-small uk-text-muted uk-text-nowrap">Tidak ada data</span></td>
                                    <td>
                                    </td>
                                    <td><span class="uk-text-danger"></span></td>
                                    <td></td>
                                    <td>

                                    </td> 
                                    <td></td>                                        
                                </tr>
                      <?php  }
                      ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>ID</th>
                  <th>Nama Kontak</th>
                  <th>Nomor HP</th>
                  <th>Ortu Dari</th>                  
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
    <?php elseif( $this->initial_template == 'phonebook_add'): ?>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Tambah Phonebook</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <!-- OUTPUT MESSAGE -->
            <?= $this->messagecontroll->showMessage() ?>
            <!-- form start -->
            <form action="<?= base_url('app_sms/phonebook_add') ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Nama Siswa</label>


                  <div class="col-sm-10">
                    <select id="nis_siswa"  name="nis_siswa" class="form-control select2" style="width: 100%;">
                        <option>Pilih siswa</option>
                      <?php if ( count($siswaKelas) > 0 ) {     
                          foreach ($siswaKelas as $row) { ?>
                          <option value="<?php echo $row['nis'] ?>"><?php echo $row['nama_siswa'] ?></option>
                      <?php }
                         } ?>    
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Nama Ortu</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="nama_ortu" name="nama_ortu" placeholder="Input Nama ortu">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">No. HP Ortu</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="no_hp" name="no_hp" placeholder="Input No. HP Ortu">
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
    <?php elseif( $this->initial_template == 'phonebook_edit'): ?>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Edit Phonebook</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <!-- OUTPUT MESSAGE -->
            <?= $this->messagecontroll->showMessage() ?>
            <!-- form start -->
            <form action="<?= base_url( $this->app_name ).'/phonebook_edit/'.$this->initial_id ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Nama Siswa</label>


                  <div class="col-sm-10">
                    <select id="nis_siswa" class="form-control select2" style="width: 100%;">
                        <option>Pilih siswa</option>
                      <?php if ( count($siswaKelas) > 0 ) {     
                          foreach ($siswaKelas as $row) { ?>
                          <option <?php if($datadb['nis_siswa'] == $row['nis']) echo "selected"; ?>  value="<?php echo $row['nis'] ?>"><?php echo $row['nama_siswa'] ?></option>
                      <?php }
                         } ?>    
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Nama Ortu</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="nama_ortu" name="nama_ortu" value="<?php echo $datadb['nama_ortu'] ?>" placeholder="Input Nama ortu">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">No. HP Ortu</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="no_hp" name="no_hp" value="<?php echo $datadb['no_hp'] ?>" placeholder="Input No. HP Ortu">
                  </div>
                </div>  
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Keterangan</label>

                  <div class="col-sm-10">
                    <textarea class="form-control" id="keterangan" name="keterangan"><?php echo $datadb['keterangan'] ?></textarea>
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
    <?php elseif( $this->initial_template == 'phonebook_group'): ?>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Phonebook Groups</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <!-- OUTPUT MESSAGE -->
            <?= $this->messagecontroll->showMessage() ?>
              <a href="<?= base_url($this->app_name) ?>/phonebook_group_add" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah baru</a>
              <br /><br />

              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Nama Ortu</th>                  
                  <th>Nama Group</th>
                  <th>Aksi</th>                
                </tr>
                </thead>
                <tbody>
                  <?php 
                    if( count($datadb) > 0 ){
                          foreach($datadb as $row){   

                          ?>         
                                <tr>  
                                    <td><span><?php echo $row['id2'] ?></span></td>
                                    <td>
                                        <?php echo $row['nama_ortu']; ?>
                                    </td>                                         
                                    <td>
                                        <a href="<?php echo base_url($this->app_name).'/phonebook_group_view/'.$row['id_kelas']; ?>"><?php echo $row['Nama_Kelas']?></a>
                                    </td>                                                             
                                    <td><a href="<?php echo base_url($this->app_name).'/phonebook_group_view/'.$row['id_kelas']; ?>" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> View</a></td>        
                                </tr>
                      <?php  }}else{ ?>
                                <tr>
                                    <td class="uk-text-center"><span class="uk-text-small uk-text-muted uk-text-nowrap">Tidak ada data</span></td>
                                    <td>
                                    </td>
                                    <td><span class="uk-text-danger"></span></td>
                                    <td></td>
                                    <td>

                                    </td> 
                                    <td></td>                                        
                                </tr>
                      <?php  }
                      ?>
                </tbody>


                <tfoot>
                <tr>
                  <th>ID</th>
                  <th>Nama Ortu</th>                  
                  <th>Nama Group</th>
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
    <?php elseif( $this->initial_template == 'phonebook_group_add'): ?>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Tambah Group</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <!-- OUTPUT MESSAGE -->
            <?= $this->messagecontroll->showMessage() ?>
            <!-- form start -->
            <form action="<?= base_url('app_sms/phonebook_group_add') ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Nama Group (Kelas)</label>


                  <div class="col-sm-10">
                    <select id="group_id" class="form-control select2" style="width: 100%;">
                        <option>Pilih Group</option>
                      <?php if ( count($datadbkelas) > 0 ) {     
                          foreach ($datadbkelas as $row) { ?>
                          <option value="<?php echo $row['id_kelas'] ?>"><?php echo $row['Nama_Kelas'] ?></option>
                      <?php }
                         } ?>  
                    </select>  
                 
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Nama Ortu</label>


                  <div class="col-sm-10">
                    <select id="nama_ortu" name="nama_ortu" class="form-control select2" style="width: 100%;" tabindex="-1" aria-hidden="true">
                        <option>Pilih Group</option>                    
                      <?php if ( count($ortuKelas) > 0 ) {     
                          foreach ($ortuKelas as $row) { ?>
                          <option value="<?php echo $row['nama_ortu'] ?>"><?php echo $row['nama_ortu'] ?></option>
                      <?php }
                         } ?>    
                    </select>
                  </div>
                </div>

                <div name='ortu' id='ortu'></div>

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
                <button id="send" class="btn btn-info pull-right">Simpan</button>
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
    <?php endif; ?>
  </div>
  <!-- /.content-wrapper -->

  <!-- page script -->
<script>

  $(function () {

    $(".select2").select2();

      $( "#nama_ortu" ).change(function() {
      
      var id = $('#nama_ortu').val();
         $.ajax({
                type:'POST',
                url:'<?php echo base_url("app_sms/getNoOrtu"); ?>',
                data:{'nama_ortu':id},
                success:function(data){
                    $('#ortu').html(data);
                }
            });
    });

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