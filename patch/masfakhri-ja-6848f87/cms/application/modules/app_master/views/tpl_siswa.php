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
                                    <td><span><?php echo $row['pin'] ?></span></td>
                                    <td><span><?php echo $row['absen'] ?></span></td>
                                    <td>
                                        <a href="<?php echo base_url($this->app_name).'/siswa_edit/'.$row['id']; ?>"><?php echo $row['nama_panggilan']?></a>
                                    </td>
                                    <td>
                                        <?php echo $row['Nama_Kelas']?>
                                    </td>                                                                   
                                    <td><a href="<?php echo base_url($this->app_name).'/siswa_edit/'.$row['id']; ?>" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Edit</a> <a href="<?php echo base_url($this->app_name).'/siswa_remove/'.$row['pin']; ?>"  class="btn btn-danger   btn-xs"><i class="fa fa-delete"></i> Delete</a></td>        
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
    <?php elseif( $this->initial_template == 'siswa_add'): ?>
    <style>
      .panel-heading span {
        margin-top: -20px;
        font-size: 15px;
      }
      #layer_data{
        position: relative;
      }
      #layer_ortu{
        position: relative;
      }      
      #layer_data.loading i.fa-spin {
        display:block;
      }
      #layer_ortu.loading i.fa-spin {
        display:block;
      }      
      #layer_data i.fa-spin {
        position: absolute;
        z-index: 3;
        font-size: 20px;
        top:0;
        bottom: 0;
        left: 0;
        right: 0;
        margin: auto;
        width: 20px;
        height: 20px;
        display:none;
      }
      #layer_ortu i.fa-spin {
        position: absolute;
        z-index: 3;
        font-size: 20px;
        top:0;
        bottom: 0;
        left: 0;
        right: 0;
        margin: auto;
        width: 20px;
        height: 20px;
        display:none;
      }      
      #layer_data:after {
        content: "";
        display: none;
        z-index: 2;
        background: rgba(0,0,0,0.1);
        position: absolute;
        height: 100%;
        width: 100%;
        margin: auto;
        top:0;
      }
      #layer_ortu:after {
        content: "";
        display: none;
        z-index: 2;
        background: rgba(0,0,0,0.1);
        position: absolute;
        height: 100%;
        width: 100%;
        margin: auto;
        top:0;
      }      
      #layer_data.loading:after{
        display: block;
      }
      #layer_ortu.loading:after{
        display: block;
      }      
    </style>
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
                <div class="row">
                  <div class="form-group col-md-12">
                    <label for="inputEmail3" class="col-sm-2 control-label">Kelas</label>

                    <div class="col-sm-10">
                      <select class="form-control" id="kelas" name="id_kelas" onChange="ChangeKelas()">
                        <option value=''>=== PILIH KELAS ===</option>
                        <?php
                          foreach ($kelas as $key => $value) {
                              echo '<option value='.$value['id_kelas'].'>'.$value['Nama_Kelas'].'</option>';
                          }
                          ?>
                      </select>
                    </div>
                  </div>              
                </div>

                <div class="panel panel-primary" id="layer_data" style="display: none;">
                  <div class="panel-heading">
                    <h3 class="panel-title">Informasi Siswa</h3>
                    <span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
                  </div>
                  <div class="panel-body">
                    <div class="row">
                      <div class="col-md-4">
                         <label for="inputEmail3" class="control-label">NIS</label>
                         <input type="text" class="form-control" id="nis" name="nis" placeholder="Input NIS"> 
                      </div>
                      <div class="col-md-4">
                         <label for="inputEmail3" class="control-label">ID Finger</label>
                         <input type="text" class="form-control" id="pin" name="pin" value="<?php echo $lastPin ?>" readonly>
                      </div>
                      <div class="col-md-4">
                         <label for="inputEmail3" class="control-label">No. Absen</label>
                         <input type="text" class="form-control" id="absen" name="absen" placeholder="Input No. Absen" readonly>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <label for="inputEmail3" class="control-label">Nama</label>
                        <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" placeholder="Input Nama Siswa"> 
                      </div>
                      <div class="col-md-6">
                        <label for="inputEmail3" class="control-label">Nama Panggilan</label>
                        <input type="text" class="form-control" id="nama_panggilan" name="nama_panggilan" placeholder="Input Nama Panggilan">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4">
                        <label for="inputEmail3" class="control-label">Jenis Kelamin</label>
                          <select class="form-control" name="kelamin">
                            <option value=''>== Pilih Jenis Kelamin ==</option>
                            <option value='L'>LAKI - LAKI</option>
                            <option value='P'>PEREMPUAN</option>
                          </select>
                      </div>
                      <div class="col-md-4">
                        <label for="inputEmail3" class="control-label">Tempat Lahir</label>
                        <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" placeholder="Input Tempat Lahir">
                      </div>
                      <div class="col-md-4">
                        <label for="inputEmail3" class="control-label">Tanggal Lahir</label>
                          <div class="input-group date">
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control pull-right" id="datepicker" name="tgl_lahir">
                          </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-3">
                        <label for="inputEmail3" class="control-label">Agama</label>
                        <select class="form-control" name="agama">
                            <option value=''>== Pilih Agama ==</option>
                            <option value='I'>ISLAM</option>
                            <option value='K'>KHATOLIK</option>
                            <option value='P'>PROTESTAN</option>
                            <option value='H'>HINDU</option>
                            <option value='B'>BUDHA</option>
                            <option value='L'>LAIN NYA</option>
                          </select>
                      </div>
                      <div class="col-md-4">
                        <label for="inputEmail3" class="control-label">Tahun Ajaran</label>
                          <div class="input-group date">
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control pull-right" name="tahun_ajaran">
                          </div>
                      </div>                      
                    </div>
                    <label for="inputEmail3" class="control-label">Alamat</label>
                    <textarea class="form-control" id="alamat" name="alamat"></textarea>                  
                    <label for="exampleInputFile" class="control-label">Unggah foto</label>
                    <input id="form-file" type="file" id="file" name="file">
                  </div>
                  <i class="fa-li fa fa-spinner fa-spin"></i>
                </div> 

                <div class="panel panel-primary" id="layer_ortu" style="display: none;">
                  <div class="panel-heading">
                    <h3 class="panel-title">Informasi Orang Tua / Wali murid</h3>
                    <span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
                  </div>
                  <div class="panel-body">
                    <div class="row">
                      <div class="col-md-4">
                         <label for="inputEmail3" class="control-label">Nama Ortu / Wali murid</label>
                         <input type="text" class="form-control" id="nama_ortu" name="nama_ortu" placeholder="Input Nama"> 
                      </div>
                      <div class="col-md-4">
                         <label for="inputEmail3" class="control-label">No. HP</label>
                         <input type="text" class="form-control" id="no_hp" name="no_hp">
                      </div>
                      <div class="col-md-4">
                         <label for="inputEmail3" class="control-label">Hubungan Keluarga</label>
                          <select class="form-control" name="keterangan">
                            <option value='Ayah'>Ayah</option>
                            <option value='Ibu'>Ibu</option>
                            <option value='Paman'>Paman</option>
                            <option value='Bibi'>Bibi</option>                              
                            <option value='Kakak'>Kakak</option>
                            <option value='Adik'>Adik</option>                                                          
                          </select>
                      </div>
                    </div>
                    <label for="inputEmail3" class="control-label">Alamat</label>
                    <textarea class="form-control" id="alamat" name="alamat_ortu"></textarea>
                  </div>
                  <i class="fa-li fa fa-spinner fa-spin"></i>
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
      
      const ChangeKelas = function() {
        var kelas = document.getElementById("kelas").value;
        var layer = $("#layer_data");
        var layer_ortu = $("#layer_ortu");        
        if(kelas != ''){
          layer.addClass("loading");
          layer_ortu.addClass("loading");          
          $.ajax({
                type:'POST',
                url:'<?php echo base_url("app_master/getAbsen"); ?>',
                data:{'kelas':kelas},
                success:function(data){
                    $('#absen').val(data);
                    layer.removeClass("loading");
                    layer_ortu.removeClass("loading");
                }
            });          
          layer.css("display","block");
          layer_ortu.css("display","block");
        }else{
          layer.css("display","none");
          layer_ortu.css("display","none");
        }
      }
      $(document).ready(function(){
        $("#kelas").val("");
      })

    </script>
    <?php elseif( $this->initial_template == 'siswa_edit'): ?>

    <style>
      .panel-heading span {
        margin-top: -20px;
        font-size: 15px;
      }
      #layer_data{
        position: relative;
      }
      #layer_ortu{
        position: relative;
      }      
      #layer_data.loading i.fa-spin {
        display:block;
      }
      #layer_ortu.loading i.fa-spin {
        display:block;
      }      
      #layer_data i.fa-spin {
        position: absolute;
        z-index: 3;
        font-size: 20px;
        top:0;
        bottom: 0;
        left: 0;
        right: 0;
        margin: auto;
        width: 20px;
        height: 20px;
        display:none;
      }
      #layer_ortu i.fa-spin {
        position: absolute;
        z-index: 3;
        font-size: 20px;
        top:0;
        bottom: 0;
        left: 0;
        right: 0;
        margin: auto;
        width: 20px;
        height: 20px;
        display:none;
      }      
      #layer_data:after {
        content: "";
        display: none;
        z-index: 2;
        background: rgba(0,0,0,0.1);
        position: absolute;
        height: 100%;
        width: 100%;
        margin: auto;
        top:0;
      }
      #layer_ortu:after {
        content: "";
        display: none;
        z-index: 2;
        background: rgba(0,0,0,0.1);
        position: absolute;
        height: 100%;
        width: 100%;
        margin: auto;
        top:0;
      }      
      #layer_data.loading:after{
        display: : block;
      }
      #layer_ortu.loading:after{
        display: : block;
      }      
    </style>      
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
                <div class="row">
                  <div class="form-group col-md-12">
                    <label for="inputEmail3" class="col-sm-2 control-label">Kelas</label>

                    <div class="col-sm-10">
                      <select class="form-control" id="kelas" name="id_kelas" onChange="ChangeKelas()" disabled>
                        <?php
                          foreach ($kelas as $key => $value) {
                              
                              if( $value['id_kelas'] == $datadb['id_kelas']) {
                                $sel  = 'selected';
                                echo '<option value="'.$value['id_kelas'].'" '.$sel.'>'.$value['Nama_Kelas'].'</option>';
                              }else{
                                $sel  = '';
                              }
                          }
                          ?>
                      </select>
                    </div>
                  </div>              
                </div>

                <div class="panel panel-primary" id="layer_data" style="display: none;">
                  <div class="panel-heading">
                    <h3 class="panel-title">Informasi Siswa</h3>
                    <span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
                  </div>
                  <div class="panel-body">
                    <div class="row">
                      <div class="col-md-4">
                         <label for="inputEmail3" class="control-label">NIS</label>
                         <input type="text" class="form-control" id="nis" name="nis"  value="<?= rebackPost('nis', $datadb['nis']) ?>" placeholder="Input NIS"> 
                      </div>
                      <div class="col-md-4">
                         <label for="inputEmail3" class="control-label">ID Finger</label>
                         <input type="text" class="form-control" id="pin" name="pin"  value="<?= rebackPost('pin', $datadb['pin']) ?>"  disabled>
                      </div>
                      <div class="col-md-4">
                         <label for="inputEmail3" class="control-label">No. Absen</label>
                         <input type="text" class="form-control" id="absen" name="absen" value="<?= rebackPost('absen', $datadb['absen']) ?>" placeholder="Input No. Absen" disabled>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <label for="inputEmail3" class="control-label">Nama</label>
                        <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" value="<?= rebackPost('nama_siswa', $datadb['nama_siswa']) ?>" placeholder="Input Nama Siswa"> 
                      </div>
                      <div class="col-md-6">
                        <label for="inputEmail3" class="control-label">Nama Panggilan</label>
                        <input type="text" class="form-control" id="nama_panggilan" name="nama_panggilan" value="<?= rebackPost('nama_panggilan', $datadb['nama_panggilan']) ?>" placeholder="Input Nama Panggilan">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4">
                        <label for="inputEmail3" class="control-label">Jenis Kelamin</label>
                          <select class="form-control" name="kelamin">
                            <option value=''>== Pilih Jenis Kelamin ==</option>
                            <option <?php if($kelamin['kelamin'] == "L") echo "selected"; ?>>Laki-Laki</option>
                            <option <?php if($kelamin['kelamin'] == "P") echo "selected"; ?>>Perempuan</option>
                          </select>
                      </div>
                      <div class="col-md-4">
                        <label for="inputEmail3" class="control-label">Tempat Lahir</label>
                        <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="<?= rebackPost('tempat_lahir', $datadb['tempat_lahir']) ?>" placeholder="Input Tempat Lahir">
                      </div>
                      <div class="col-md-4">
                        <label for="inputEmail3" class="control-label">Tanggal Lahir</label>
                          <div class="input-group date">
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control pull-right" value="<?= rebackPost('tgl_lahir', $datadb['tgl_lahir']) ?>" id="datepicker" name="tgl_lahir">
                          </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-3">
                        <label for="inputEmail3" class="control-label">Agama</label>
                        <select class="form-control" name="agama">
                            <option value=''>== Pilih Agama ==</option>
                            <option <?php if($datadb['kelamin'] == "I") echo "selected"; ?> value='I'>ISLAM</option>
                            <option <?php if($datadb['kelamin'] == "K") echo "selected"; ?> value='K'>KHATOLIK</option>
                            <option <?php if($datadb['kelamin'] == "P") echo "selected"; ?>  value='P'>PROTESTAN</option>
                            <option <?php if($datadb['kelamin'] == "H") echo "selected"; ?> value='H'>HINDU</option>
                            <option <?php if($datadb['kelamin'] == "B") echo "selected"; ?> value='B'>BUDHA</option>
                            <option <?php if($datadb['kelamin'] == "L") echo "selected"; ?> value='L'>LAIN NYA</option>
                          </select>
                      </div>
                    </div>
                    <label for="inputEmail3" class="control-label">Alamat</label>
                    <textarea class="form-control" id="alamat" name="alamat"><?= rebackPost('alamat', $datadb['alamat']) ?></textarea>                  
                    <label for="exampleInputFile" class="control-label">Unggah foto</label>
                    <input id="form-file" type="file" id="file" name="file">
                  </div>
                  <i class="fa-li fa fa-spinner fa-spin"></i>
                </div> 

                <div class="panel panel-primary" id="layer_ortu" style="display: none;">
                  <div class="panel-heading">
                    <h3 class="panel-title">Informasi Orang Tua / Wali murid</h3>
                    <span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
                  </div>
                  <div class="panel-body">
                    <div class="row">
                      <div class="col-md-4">
                         <label for="inputEmail3" class="control-label">Nama Ortu / Wali murid</label>
                         <input type="text" class="form-control" id="nama_ortu" value="<?= rebackPost('nama_ortu', $datadb['nama_ortu']) ?>" name="nama_ortu" placeholder="Input Nama"> 
                      </div>
                      <div class="col-md-4">
                         <label for="inputEmail3" class="control-label">No. HP</label>
                         <input type="text" class="form-control" id="no_hp" value="<?= rebackPost('no_hp', $datadb['no_hp']) ?>" name="no_hp">
                      </div>
                      <div class="col-md-4">
                         <label for="inputEmail3" class="control-label">Hubungan Keluarga</label>
                          <select class="form-control" name="keterangan">
                            <option value='Ayah'>Ayah</option>
                            <option value='Ibu'>Ibu</option>
                            <option value='Paman'>Paman</option>
                            <option value='Bibi'>Bibi</option>                              
                            <option value='Kakak'>Kakak</option>
                            <option value='Adik'>Adik</option>                                                          
                          </select>
                      </div>
                    </div>
                    <label for="inputEmail3" class="control-label">Alamat</label>
                    <textarea class="form-control" id="alamat" name="alamat_ortu"><?= rebackPost('alamat', $datadb['alamat']) ?></textarea>
                  </div>
                  <i class="fa-li fa fa-spinner fa-spin"></i>
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
      
      const ChangeKelas = function() {
        var kelas = document.getElementById("kelas").value;
        var layer = $("#layer_data");
        var layer_ortu = $("#layer_ortu");        
        if(kelas != ''){
          layer.addClass("loading");
          layer_ortu.addClass("loading");
          $.ajax({
                type:'POST',
                url:'<?php echo base_url("app_master/getAbsen"); ?>',
                data:{'kelas':kelas},
                success:function(data){
                  
                    layer.removeClass("loading");
                    layer_ortu.removeClass("loading");
                }
            });          
          layer.css("display","block");
          layer_ortu.css("display","block");
        }else{
          layer.css("display","none");
          layer_ortu.css("display","none");
        }
      }
      $(document).ready(function(){
        if($("#kelas").val() !== ''){
            ChangeKelas();
        }
      })

    </script>     
    <?php endif; ?>
  </div>
  <!-- /.content-wrapper -->

  <!-- page script -->
<script>
    $(document).on('click', '.panel-heading span.clickable', function(e){
        var $this = $(this);
      if(!$this.hasClass('panel-collapsed')) {
        $this.parents('.panel').find('.panel-body').slideUp();
        $this.addClass('panel-collapsed');
        $this.find('i').removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');
      } else {
        $this.parents('.panel').find('.panel-body').slideDown();
        $this.removeClass('panel-collapsed');
        $this.find('i').removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');
      }
    })

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
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
</script>