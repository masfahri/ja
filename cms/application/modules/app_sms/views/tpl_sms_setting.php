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
        <li class="active">Setting</li>
      </ol>
    </section>
    <?php if($this->initial_template == 'setting'): ?>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">SMS Setting - Umum</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <!-- OUTPUT MESSAGE -->
            <?= $this->messagecontroll->showMessage() ?>
            <!-- form start -->
            <form action="<?= base_url( $this->app_name ).'/setting' ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">E-MAIL</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="e-mail" name="e-mail" placeholder="E-MAIL" readonly value="<?php echo $email[0]->value ?>">
                  </div>
                </div> 
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">PASSWORD</label>

                  <div class="col-sm-10">
                    <input type="password" class="form-control" id="password" name="password" placeholder="PASSWORD" readonly value="<?php echo $password[0]->value ?>">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">DEVICE</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="device" name="device" placeholder="MODEM WAVECOM" value="MODEM WAVECOM" readonly>                    
                  </div>
                </div>        
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">DEVICE ID</label>

                  <div class="col-sm-10">
                  <?php
                    //set POST variables
                    $url    = 'http://smsgateway.me/api/v3/devices';
                    $fields = array(
                        'email'     => $email[0]->value,
                        'password'  => $password[0]->value
                    );

                    $fields_string = '';
                    //url-ify the data for the POST
                    foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
                    rtrim($fields_string, '&');

                    //open connection
                    $ch = curl_init();

                    //set the url, number of POST vars, POST data
                    curl_setopt($ch,CURLOPT_URL, $url);
                    curl_setopt($ch,CURLOPT_POST, count($fields));
                    curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    //execute post
                    $result = curl_exec($ch); 
                    $json = json_decode($result);               
                    //close connection
                    curl_close($ch);

                   ?>
                    <input type="text" class="form-control" id="device" name="device_id" placeholder="MODEM WAVECOM" value="<?php echo $json->result->data[0]->id ?>" readonly>                    
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">PROVIDER</label>

                  <div class="col-sm-10">
                  <?php
                    //set POST variables
                    $url    = 'http://smsgateway.me/api/v3/devices';
                    $fields = array(
                        'email'     => $email[0]->value,
                        'password'  => $password[0]->value
                    );

                    $fields_string = '';
                    //url-ify the data for the POST
                    foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
                    rtrim($fields_string, '&');

                    //open connection
                    $ch = curl_init();

                    //set the url, number of POST vars, POST data
                    curl_setopt($ch,CURLOPT_URL, $url);
                    curl_setopt($ch,CURLOPT_POST, count($fields));
                    curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    //execute post
                    $result = curl_exec($ch); 
                    $json = json_decode($result);               
                    //close connection
                    curl_close($ch);

                   ?>
                    <input type="text" class="form-control" id="device" name="provider" value="<?php echo $json->result->data[0]->provider ?>" readonly>                    
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">NUMBER</label>

                  <div class="col-sm-10">
                  <?php
                    //set POST variables
                    $url    = 'http://smsgateway.me/api/v3/devices';
                    $fields = array(
                        'email'     => $email[0]->value,
                        'password'  => $password[0]->value
                    );

                    $fields_string = '';
                    //url-ify the data for the POST
                    foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
                    rtrim($fields_string, '&');

                    //open connection
                    $ch = curl_init();

                    //set the url, number of POST vars, POST data
                    curl_setopt($ch,CURLOPT_URL, $url);
                    curl_setopt($ch,CURLOPT_POST, count($fields));
                    curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    //execute post
                    $result = curl_exec($ch); 
                    $json = json_decode($result);               
                    //close connection
                    curl_close($ch);

                   ?>
                    <input type="text" class="form-control" id="device" name="last_seen" value="<?php echo date('Y-m-d H:i:s',$json->result->data[0]->last_seen) ?>" readonly>                    
                  </div>
                </div>


              </div>
       
              <!-- /.box-body -->
              <div class="box-footer">
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
    <?php elseif( $this->initial_template == 'hari_libur_add'): ?>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Tambah Hari Libur</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <!-- OUTPUT MESSAGE -->
            <?= $this->messagecontroll->showMessage() ?>
            <!-- form start -->
            <form action="<?= base_url('app_master/hari_libur_add') ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Keterangan Libur</label>

                  <div class="col-sm-10">
                    <textarea class="form-control" id="keterangan" name="keterangan"></textarea>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Tanggal mulai</label>

                  <div class="col-sm-10">
                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" class="form-control pull-right" id="datepicker" name="tanggal_mulai">
                    </div>
                  </div>
                </div> 
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Tanggal akhir</label>

                  <div class="col-sm-10">
                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" class="form-control pull-right" id="datepicker2" name="tanggal_akhir">
                    </div>
                  </div>
                </div>     
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Tipe</label>

                  <div class="col-sm-10">
                    <select class="form-control" name="tipe" onchange="admSelectCheck(this);">
                    <option value=''>== Pilih Tipe ==</option>
                    <option value='Sekolah'>Sekolah</option>
                    <option id="tipe2" value='Kelas'>Kelas</option>
                    </select>  
                    <br />
                    <div id="tipekelas" style="display:none;">
                    <input type='hidden' name='id_kelas' id='id_kelas'></input>
                    <ul id='ul1'>

                    <div class="col-sm-4">
                      <li class='li1'>Kelas <b>X</b>
                        <ul>
                        <?php
                          $q_kelas = mysql_query("select *from ja_kelas where Nama_Kelas like '%X-%' order by Nama_Kelas") or die (mysql_error());
                          while($a_kelas = mysql_fetch_array($q_kelas)){
                            $namakelas = $a_kelas['Nama_Kelas'];
                            $idkelas   = $a_kelas['id_kelas'];
                            print "<li><input type='checkbox' id_kelas='$idkelas' value='$idkelas' onclick='dell(this.id,this.value);'></input>$namakelas</li>";
                          }
                        ?>
                        </ul>
                      </li>
                      </div>
                      <div class="col-sm-4">
                      <li class='li1'>Kelas <b>XI</b>
                        <ul>
                        <?php
                          $q_kelas = mysql_query("select *from ja_kelas where Nama_Kelas like '%XI-%' order by Nama_Kelas") or die (mysql_error());
                          while($a_kelas = mysql_fetch_array($q_kelas)){
                            $namakelas = $a_kelas['Nama_Kelas'];
                            $idkelas   = $a_kelas['id_kelas'];
                            print "<li><input type='checkbox' id_kelas='$idkelas' value='$idkelas' onclick='dell(this.id,this.value);'></input>$namakelas</li>";
                          }
                        ?>
                        </ul>
                      </li>
                      </div>
                      <div class="col-sm-4">
                      <li class='li1'>Kelas <b>XII</b>
                        <ul>
                        <?php
                          $q_kelas = mysql_query("select *from ja_kelas where Nama_Kelas like '%XII-%' order by Nama_Kelas") or die (mysql_error());
                          while($a_kelas = mysql_fetch_array($q_kelas)){
                            $namakelas = $a_kelas['Nama_Kelas'];
                            $idkelas   = $a_kelas['id_kelas'];
                            print "<li><input type='checkbox' id_kelas='$idkelas' value='$idkelas' onclick='dell(this.id,this.value);'></input>$namakelas</li>";
                          }
                        ?>
                        </ul>
                      </li>
                      </div>
                    </ul>
                  
                    </div>                 
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
    <?php elseif( $this->initial_template == 'hari_libur_edit'): ?>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Edit Hari Libur</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <!-- OUTPUT MESSAGE -->
            <?= $this->messagecontroll->showMessage() ?>
            <!-- form start -->
            <form action="<?= base_url( $this->app_name ).'/hari_libur_edit/'.$this->initial_id ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Keterangan Libur</label>

                  <div class="col-sm-10">
                    <textarea class="form-control" id="keterangan" name="keterangan"><?= rebackPost('keterangan', $datadb['keterangan']) ?></textarea>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Tanggal mulai</label>

                  <div class="col-sm-10">
                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" class="form-control pull-right" value="<?= rebackPost('tanggal_mulai', $datadb['tanggal_mulai']) ?>" id="datepicker" name="tanggal_mulai">
                    </div>
                  </div>
                </div> 
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Tanggal akhir</label>

                  <div class="col-sm-10">
                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" class="form-control pull-right" value="<?= rebackPost('tanggal_akhir', $datadb['tanggal_akhir']) ?>" id="datepicker2" name="tanggal_akhir">
                    </div>
                  </div>
                </div>     
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Tipe</label>

                  <div class="col-sm-10">
                    <select class="form-control" name="tipe" onchange="admSelectCheck(this);">
                    <option value=''>== Pilih Tipe ==</option>
                    <option <?php if($datadb['tipe'] == "Sekolah") echo "selected"; ?> value='Sekolah'>Sekolah</option>
                    <option <?php if($datadb['tipe'] == "Kelas") echo "selected"; ?> id="tipe2" value='Kelas'>Kelas</option>
                    </select>  
                    <br />
                    <div id="tipekelas" style="display:none;">
                    <input type='hidden' name='id_kelas' id='id_kelas'></input>
                    <ul id='ul1'>

                    <div class="col-sm-4">
                      <li class='li1'>Kelas <b>X</b>
                        <ul>
                        <?php
                          $q_kelas = mysql_query("select *from ja_kelas where Nama_Kelas like '%X-%' order by Nama_Kelas") or die (mysql_error());
                          while($a_kelas = mysql_fetch_array($q_kelas)){
                            $namakelas = $a_kelas['Nama_Kelas'];
                            $idkelas   = $a_kelas['id_kelas'];
                            print "<li><input type='checkbox' id_kelas='$idkelas' value='$idkelas' onclick='dell(this.id,this.value);'></input>$namakelas</li>";
                          }
                        ?>
                        </ul>
                      </li>
                      </div>
                      <div class="col-sm-4">
                      <li class='li1'>Kelas <b>XI</b>
                        <ul>
                        <?php
                          $q_kelas = mysql_query("select *from ja_kelas where Nama_Kelas like '%XI-%' order by Nama_Kelas") or die (mysql_error());
                          while($a_kelas = mysql_fetch_array($q_kelas)){
                            $namakelas = $a_kelas['Nama_Kelas'];
                            $idkelas   = $a_kelas['id_kelas'];
                            print "<li><input type='checkbox' id_kelas='$idkelas' value='$idkelas' onclick='dell(this.id,this.value);'></input>$namakelas</li>";
                          }
                        ?>
                        </ul>
                      </li>
                      </div>
                      <div class="col-sm-4">
                      <li class='li1'>Kelas <b>XII</b>
                        <ul>
                        <?php
                          $q_kelas = mysql_query("select *from ja_kelas where Nama_Kelas like '%XII-%' order by Nama_Kelas") or die (mysql_error());
                          while($a_kelas = mysql_fetch_array($q_kelas)){
                            $namakelas = $a_kelas['Nama_Kelas'];
                            $idkelas   = $a_kelas['id_kelas'];
                            print "<li><input type='checkbox' id_kelas='$idkelas' value='$idkelas' onclick='dell(this.id,this.value);'></input>$namakelas</li>";
                          }
                        ?>
                        </ul>
                      </li>
                      </div>
                    </ul>
                  
                    </div>                 
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
  function admSelectCheck(nameSelect)
  {
      console.log(nameSelect);
      if(nameSelect){
          admOptionValue = document.getElementById("tipe2").value;
          if(admOptionValue == nameSelect.value){
              document.getElementById("tipekelas").style.display = "block";
          }
          else{
              document.getElementById("tipekelas").style.display = "none";
          }
      }
      else{
          document.getElementById("tipekelas").style.display = "none";
      }
  }
 function dell(cek,id) {
                     //document.getElementById('id_kelas').value = id;
                  if (document.getElementById(cek).checked == 1) {
                    idList = idList + id + ","
                    document.getElementById('id_kelas').value = idList;
                  }

                  if (document.getElementById(cek).checked == 0) {
                    var v;
                    v = "," + id + ","
                    idList = idList.replace(v, ",");
                    document.getElementById('id_kelas').value = idList;
                  }
    }

</script>