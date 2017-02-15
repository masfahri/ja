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
                  <label for="inputEmail3" class="col-sm-2 control-label">Nama Kelas</label>
                  <div class="col-sm-10">
                    <select id="id_kelas"  name="id_kelas" class="form-control select2" style="width: 100%;">
                        <option>Pilih Kelas</option>
                      <?php if ( count($kelas) > 0 ) {     
                          foreach ($kelas as $row) { ?>
                          <option value="<?php echo $row['id_kelas'] ?>"><?php echo $row['Nama_Kelas'] ?></option>
                      <?php }
                         } ?>    
                    </select>
                  </div>
                </div>

                <div id="siswa"> </div>
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
                  <label for="inputEmail3" class="col-sm-2 control-label">Nama Kelas</label>
                  <div class="col-sm-10">
                    <select id="id_kelas"  name="id_kelas" class="form-control select2" style="width: 100%;" disabled>
                        <option>Pilih Kelas</option>
                      <?php if ( count($kelas) > 0 ) {     
                          foreach ($kelas as $row) { ?>
                          <option <?php if($datadb['group_id'] == $row['id_kelas']) echo "selected"; ?>  value="<?php echo $row['id_kelas'] ?>"><?php echo $row['Nama_Kelas'] ?></option> 
                      <?php }
                         } ?>    
                    </select>
                  </div>
                </div>
                <div id="siswa"></div>
                <input type="hidden" id="action" value="edit" />
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
  <script type="text/javascript">
    
      var id = $('#id_kelas').val();
      var action = $('#action').val();    
      var nis = '<?php echo $datadb['nis_siswa']; ?>';  
       $.ajax({
              type:'POST',
              url:'<?php echo base_url("app_sms/getSiswaInKelas"); ?>',
              data:{'kelas':id, 'action': action, 'nis':nis},
              success:function(data){
                  $('#siswa').html(data);
              }
          });

  </script>

    <?php elseif( $this->initial_template == 'phonebook_group'): ?>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Phonebook Group</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <!-- OUTPUT MESSAGE -->
            <?= $this->messagecontroll->showMessage() ?>
              <!--a href="<?= base_url($this->app_name) ?>/phonebook_group_add" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah baru</a -->

              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>              
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
                                    <td><span><?php echo $row['id_kelas'] ?></span></td>                                       
                                    <td>
                                        <span><?php echo $row['Nama_Kelas']?></span>
                                    </td>                                                             
                                    <td><button type="button" class="btn btn-primary btn-xs" onclick="showPhonebook(<?php echo $row['id_kelas'] ?>)">
                                      View
                                    </button></td>        
                                </tr>
                      <?php  }}else{ ?>
                                <tr>
                                    <td class="uk-text-center"><span class="uk-text-small uk-text-muted uk-text-nowrap">Tidak ada data</span></td>
                                    <td>
                                    </td>
                                    <td><span class="uk-text-danger"></span></td>
                                    <td></td>
                                </tr>
                      <?php  }
                      ?>
                </tbody>


                <tfoot>
                <tr>
                  <th>ID</th>                
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
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Phonebook Detail</h4>
          </div>
          <div class="modal-body">
            <div id="nis2"></div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    <script type="text/javascript">
      
    function showPhonebook(id_kelas) {
      var kelas = id_kelas;
       $.ajax({
              type:'POST',
              url:'<?php echo base_url("app_sms/getOrtuPerKelas"); ?>',
              data:{'kelas':kelas},
              success:function(data){
                  $('#myModal').modal('show');
                  //$('#ortu2').html(data);
                  $('#nis2').html(data);
              }
          });

    }



    </script>
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
                    <select id="group_id" name="group_id" class="form-control select2" style="width: 100%;">
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
                          <option value="<?php echo $row['id2'] ?>"><?php echo $row['nama_ortu'] ?></option>
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

    $( "#id_kelas" ).change(function() {
    
    var id = $('#id_kelas').val();
       $.ajax({
              type:'POST',
              url:'<?php echo base_url("app_sms/getSiswaInKelas"); ?>',
              data:{'kelas':id},
              success:function(data){
                  $('#siswa').html(data);
              }
          });
    });


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