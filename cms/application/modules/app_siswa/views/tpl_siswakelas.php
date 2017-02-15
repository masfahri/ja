<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        SISWA
        <small></small>
      </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>
    <?php if($this->initial_template == ''): ?>

    <!-- Main content -->
    <section class="content">
        <!-- Info boxes -->
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-blue"><i class="ion ion-ios-people-outline"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Siswa</span>
                        <span class="info-box-number"><?php echo $datadbjumlahsiswa['$js'];?></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-red"><i class="ion ion-ios-people-outline"></i></span>
                    <div class="info-box-content">
                        <strong><span class="info-box-text" style="text-align: center;">Total</span>
                        <span class="info-box-text">Siswa Hadir Hari ini</span></strong>
                        <span class="info-box-number"><?php echo $datadbsiswa['hadir'];?></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <!-- fix for small devices only -->
            <div class="clearfix visible-sm-block"></div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="ion ion-ios-people-outline"></i></span>
                    <div class="info-box-content">
                        <strong><span class="info-box-text" style="text-align: center;">Total</span>
                        <span class="info-box-text">Siswa Belum Hadir</span></strong>
                        <span class="info-box-number"><?php $blmhadir = $datadbjumlahsiswa['$js'] - $datadbsiswa['hadir'] - $datadbizin['$izin'];
                                echo $blmhadir;
                            ?></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>
                    <div class="info-box-content">
                        <strong><span class="info-box-text" style="text-align: center;">Total</span>
                        <span class="info-box-text">Siswa Izin dan sakit Hari ini</span></strong>
                        <span class="info-box-number"><?php echo $datadbizin['$izin'];?></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Statistik</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-8">
                                <p class="text-center">
                                    <strong>Persentasi Perbandingan Telat & Tidak Minggu Ini</strong>
                                </p>
                                <div class="chart">
                                    <!-- Sales Chart Canvas -->
                                    <canvas id="salesChart" style="height: 180px;"></canvas>
                                </div>
                                <!-- /.chart-responsive -->
                            </div>
                            <!-- /.col -->
                            <div class="col-md-4">
                                <p class="text-center">
                                    <strong>Top 3 Siswa</strong>
                                </p>
                                <!-- /.table-responsive -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <center><h3>SISWA HADIR HARI INI</h3></center>
                        <form method="post" action="">
                            <div class="table-responsive">
                                <table id="tableHadir" class="table no-margin">
                                    <thead>
                                        <tr>
                                            <th>No Absen</th>
                                            <th>Nis</th>
                                            <th>Nama Siswa</th>
                                            <th>Hadir</th>
                                            <!-- <th>Alfa</th> -->
                                            <th>Izin</th>
                                            <th>Sakit</th>
                                            <th>Telat</th>
                                            <th>Jam Telat</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $i   = 0;
                                        $menit = 0;
                                        $tgl = date('Y-m-d');
                                        
                                        if ( count($siswaKelas) > 0 ) {     
                                            foreach ($siswaKelas as $row) {
                                                $jamMasuk2 = date($row['jam']);
                                                $this->load->model('app_websetup/Mapp_websetup');        
                                                $jam_masuk = $this->Mapp_websetup->grapInOut();
                                                /*Table*/
                                                echo "<script type='text/javascript'>
                                                            document.addEventListener('DOMContentLoaded', function() {

                                                                var kehadiran = $('input:radio[name=kehadiran_".$row['nis']."]:checked').val();

                                                            });
                                                           function myFunction_".$row['nis']."() {
                                                                var x = document.getElementById('myCheck_".$row['nis']."').checked;
                                                                document.getElementById('jam_".$row['nis']."').disabled= false;
                                                                document.getElementById('menit_".$row['nis']."').disabled= false;
                                                                document.getElementById('radio_".$row['nis']."').checked= false;
                                                                document.getElementById('radioAlpha_".$row['nis']."').checked= false;
                                                                document.getElementById('radioHadir_".$row['nis']."').checked= true;
                                                            }
                                                            function myRadio_".$row['nis']."() {
                                                                var x = document.getElementById('radio_".$row['nis']."').checked;
                                                                
                                                                document.getElementById('jam_".$row['nis']."').disabled= true;
                                                                document.getElementById('menit_".$row['nis']."').disabled= true;
                                                                document.getElementById('myCheck_".$row['nis']."').checked= false;

                                                                /*
                                                                 * collection for ajax
                                                                 */
                                                                var kehadiran = $('input:radio[name=kehadiran_".$row['nis']."]:checked').val();
                                                                var pin = $('input[name=pin".$row['pin2']."]').val();
                                                                var id_kelas = $('input[name=id_kelas".$row['pin2']."]').val();


                                                                /*
                                                                 * AJAX UPDATE KEHADIRAN SISWA
                                                                 * WARNING MASIH ERROR DI BASE URL
                                                                 */
                                                                var url = base_url + 'app_siswa/UpdateKehadiran';
                                                                $.ajax({
                                                                        type:'POST',
                                                                        url: url,
                                                                        data:{'pin':pin, 'kehadiran':kehadiran, 'id_kelas':id_kelas},
                                                                        success:function(data){
                                                                            if(data != ''){

                                                                        var r = confirm('Apakah anda melanjutkan proses ini?');
                                                                        if (r == true) {
                                                                            x = alert(data);
                                                                            location.reload();
                                                                        } else {
                                                                            x = alert('Proses di batalkan.');
                                                                        }
                                                                            }

                                                                        }
                                                                });

                                                            }       </script>";
                                            ?>
                                                 <tr>
                                                <td><a href='pages/examples/invoice.html'><?php echo $row['absen2']?></a></td>
                                                <td>
                                                    <?php echo $row['nis']; ?>
                                                        <input type='hidden' id='nis' name='nis[]' value='<?php echo $row["nis"]; ?>' />
                                                        <input type='hidden' id="pin"  name='pin<?php echo $row["pin2"]; ?>' value='<?php echo $row["pin2"]; ?>' >
                                                        <input type='hidden' id="id_kelas" name='id_kelas<?php echo $row["pin2"]; ?>' value='<?php echo $row["id_kelas"]; ?>' >                                                        
                                                </td>
                                                <td><?php echo $row['nama_siswa']; ?></td>
                                                <td>
                                                    <input type='radio' id='radioHadir_<?php echo $row['nis']?>' onclick='myRadio_<?php echo $row['nis']?>()' 
                                                    <?php if ($row['jm'] == $tgl) {
                                                        echo "checked";
                                                    } ?> name='kehadiran_<?php echo $row['nis'] ;?>' value='4' disabled>
                                                </td>
                                                <!-- <td>
                                                    <input type='radio' id='radioAlpha_<?php echo $row['nis'] ?>' onclick='myRadio_<?php echo $row['nis']?>()' 
                                                    <?php if ($row['jm'] != $tgl) {
                                                        echo "checked";
                                                    } ?>  name='kehadiran_<?php echo $row['nis']?>' value='1' disabled>
                                                </td> -->
                                                <td>
                                                    <input type='radio' 
                                                    <?php if ($row['kehadiran'] == 2 && date($row['jm']) == $tgl) {
                                                        echo "checked";
                                                    } ?> name='kehadiran_<?php echo $row['nis'] ?>' value='2'>
                                                </td>
                                                <td>
                                                    <input type="radio"  
                                                    <?php if ($row['kehadiran'] == 3 && date($row['jm']) == $tgl) {
                                                        echo "checked";
                                                    } ?> name='kehadiran_<?php echo $row['nis'];?>' value='3'
                                                    />
                                                </td>      
                                                <td>
                                                    <input type='checkbox' id='myCheck_<?php echo $row['nis'] ?>' onclick='myFunction_<?php echo $row['nis'] ?>()' 
                                                    <?php 
                                                    if ($row['telat']==1) {
                                                        echo "checked";
                                                    }

                                                     ?> disabled>
                                                </td>

                                                <td>
                                                    Jam :<select id='jam_<?php echo $row['nis'] ?>' disabled>
                                                    <?php 
                                                        $jamTelat = (date('H', strtotime($row['jam_masuk']))-date('H', strtotime($jam_masuk[0]['jam_masuk'])));
                                                            if ($jamMasuk2 > $jam_masuk[0]['jam_masuk'] && $row['kehadiran'] == 4) {
                                                                echo "<option value='$x'>".str_replace('-', '', $jamTelat)."</option>";
                                                            } else {
                                                                for ($x = 0; $x < 24; $x++) {
                                                                  echo "<option value='$x' >$x</option>";
                                                                }
                                                            }
                                                    ?>
                                                    </select>
                                                    Menit :
                                                    <select id='menit_<?php echo $row['nis'] ?>' disabled>
                                                        <?php 
                                                            $menitTelat = (date('i', strtotime($row['jam_masuk']))-date('i', strtotime($jam_masuk[0]['jam_masuk'])));
                                                            if ($jamMasuk2 > $jam_masuk[0]['jam_masuk'] && $row['kehadiran'] == 4) {
                                                                echo "<option value='$x'>".str_replace('-', '', $menitTelat)."</option>";
                                                            } else {
                                                                for ($x = 0; $x < 59; $x++) {
                                                                  echo "<option value='$x' >$x</option>";
                                                                }
                                                            }
                                                        ?>
                                                    </select>
                                                </td>

                                                <!-- <td>
                                                    Jam :<select id='jam_<?php echo $row['nis'] ?>' disabled>
                                                    <?php 
                                                        if ($jamMasuk2 == '07:00:00' && $jamMasuk2 > $jam_masuk[0]['jam_masuk']) {
                                                            for ($i=0; $i < 24 ; $i++) { 
                                                              echo "<option value='$i' >$i</option>";
                                                            }
                                                        } else {
                                                            echo "<option value='$i'>".(date('H', strtotime($row['jam_masuk']))-date('H', strtotime($jam_masuk[0]['jam_masuk'])))."</option>";
                                                    }?>
                                                    </select>
                                                    Menit :
                                                    <select id='menit_<?php echo $row['nis'] ?>' disabled>
                                                        <?php 
                                                            if ($jamMasuk2 == '07:00:00' && $jamMasuk2 > $jam_masuk[0]['jam_masuk']) {
                                                            for ($i=0; $i < 60 ; $i++) { 
                                                              echo "<option value='$i' >$i</option>";
                                                            }
                                                        } else {
                                                            echo "<option value='$i'>".(date('i', strtotime($row['jam_masuk']))-date('i', strtotime($jam_masuk[0]['jam_masuk'])))."</option>";
                                                        }?>
                                                    </select>
                                                </td> -->
                                            <?php 
                                            }
                                        }
                                        $i++
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </form><br><br><br>
                        <hr>
                        <center><h3>SISWA BELUM HADIR</h3></center>
                        <hr>
                        <form method="post" action="<?= base_url('app_siswa').'/update' ?>">
                            <div class="table-responsive">
                                <table id="tableBlmHadir" class="table no-margin">
                                    <thead>
                                        <tr>
                                            <th>No Absen</th>
                                            <th>Nis</th>
                                            <th>Nama Siswa</th>
                                            <!-- <th>Hadir</th> -->
                                            <th>Alfa</th>
                                            <th>Izin</th>
                                            <th>Sakit</th>
                                            <th>Telat</th>
                                            <th>Jam Telat</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $i   = 0;
                                        $menit = 0;
                                        $tgl = date('Y-m-d');
                                        
                                        if ( count($siswablmhadir) > 0 ) {     
                                            foreach ($siswablmhadir as $row) {
                                                $jamMasuk2 = date($row['jam']);
                                                $this->load->model('app_websetup/Mapp_websetup');        
                                                $jam_masuk = $this->Mapp_websetup->grapInOut();
                                                
                                            /*Table*/
                                                echo "<script type='text/javascript'>
                                                            document.addEventListener('DOMContentLoaded', function() {});
                                                            function myFunction_".$row['nis']."() {
                                                                var x = document.getElementById('myCheck_".$row['nis']."').checked;
                                                                document.getElementById('jam_".$row['nis']."').disabled= false;
                                                                document.getElementById('menit_".$row['nis']."').disabled= false;
                                                                document.getElementById('radio_".$row['nis']."').checked= false;
                                                                document.getElementById('radioAlpha_".$row['nis']."').checked= false;
                                                                document.getElementById('radioHadir_".$row['nis']."').checked= true;
                                                            }
                                                            function myRadio_".$row['nis']."() {
                                                                var x = document.getElementById('radio_".$row['nis']."').checked;
                                                                
                                                                document.getElementById('jam_".$row['nis']."').disabled= true;
                                                                document.getElementById('menit_".$row['nis']."').disabled= true;
                                                                document.getElementById('myCheck_".$row['nis']."').checked= false;

                                                                /*
                                                                 * collection for ajax
                                                                 */
                                                                var kehadiran = $('input:radio[name=kehadiran_".$row['nis']."]:checked').val();
                                                                var pin = $('input[name=pin".$row['pin2']."]').val();
                                                                var id_kelas = $('input[name=id_kelas".$row['pin2']."]').val();


                                                                /*
                                                                 * AJAX UPDATE KEHADIRAN SISWA
                                                                 * WARNING MASIH ERROR DI BASE URL
                                                                 */
                                                                var url = base_url + 'app_siswa/UpdateKehadiran';
                                                                $.ajax({
                                                                        type:'POST',
                                                                        url: url,
                                                                        data:{'pin':pin, 'kehadiran':kehadiran, 'id_kelas':id_kelas},
                                                                        success:function(data){
                                                                            if(data != ''){

                                                                        var r = confirm('Apakah anda melanjutkan proses ini?');
                                                                        if (r == true) {
                                                                            x = alert(data);
                                                                            location.reload();
                                                                        } else {
                                                                            x = alert('Proses di batalkan.');
                                                                        }
                                                                            }

                                                                        }
                                                                });

                                                            }  
                                                            function UpdateAlfa() {
                                                                var pin = $('input[name=pin".$row['pin2']."]').val();

                                                                /*
                                                                 * AJAX UPDATE KEHADIRAN SISWA
                                                                 * WARNING MASIH ERROR DI BASE URL
                                                                 */
                                                                var url = base_url + 'app_siswa/update';
                                                                $.ajax({
                                                                        type:'POST',
                                                                        url: url,
                                                                        data:{'pin':pin},
                                                                        success:function(data){
                                                                            if(data != ''){

                                                                        var r = confirm('Apakah anda melanjutkan proses ini?');
                                                                        if (r == true) {
                                                                            x = alert(data);
                                                                            location.reload();
                                                                        } else {
                                                                            x = alert('Proses di batalkan.');
                                                                        }
                                                                            }

                                                                        }
                                                                });

                                                            }
                                                           
                                                        </script>";
                                            ?>
                                                <tr>
                                                    <td><a href='pages/examples/invoice.html'><?php echo $row['absen2']?></a></td>
                                                    <td>
                                                        <?php echo $row['nis']; ?>
                                                            <input type='hidden' id='nis' name='nis[]' value='<?php echo $row["nis"]; ?>' />
                                                            <input type='hidden' id="pin"  name='pin<?php echo $row["pin2"]; ?>' value='<?php echo $row["pin2"]; ?>' >
                                                            <input type='hidden' id="id_kelas" name='id_kelas2<?php echo $row["pin2"]; ?>' value='<?php echo $row["id_kelas"]; ?>' >                                                        
                                                    </td>
                                                    <td><?php echo $row['nama_siswa']; ?></td>
                                                    <!-- <td>
                                                        <input type='radio' id='radioHadir_<?php echo $row['nis']?>' onclick='myRadio_<?php echo $row['nis']?>()' 
                                                        <?php if ($row['jm'] == $tgl) {
                                                            echo "checked";
                                                        } ?> name='kehadiran_<?php echo $row['nis'] ;?>' value='4' disabled>
                                                    </td> -->
                                                    <td>
                                                        <input type='radio' id='radioAlpha_<?php echo $row['nis'] ?>' onclick='myRadio_<?php echo $row['nis']?>()' 
                                                        <?php if ($row['jm'] != $tgl) {
                                                            echo "checked";
                                                        } ?>  name='kehadiran2_<?php echo $row['nis']?>' value='1'>
                                                    </td>
                                                    <td>
                                                        <input type='radio' id='radio_<?php echo $row['nis'] ?>' onclick='myRadio_<?php echo $row['nis'] ?>()' 
                                                        <?php if ($row['kehadiran'] == 2 && date($row['jm']) == $tgl) {
                                                            echo "checked";
                                                        } ?> name='kehadiran_<?php echo $row['nis'] ?>' value='2'>
                                                    </td>
                                                    <td>
                                                        <input type="radio" id='radio_<?php echo $row['nis'] ?>' onclick='myRadio_<?php echo $row['nis']?>()' 
                                                        <?php if ($row['kehadiran'] == 3 && date($row['jm']) == $tgl) {
                                                            echo "checked";
                                                        } ?> name='kehadiran_<?php echo $row['nis'];?>' value='3'
                                                        />
                                                    </td>      
                                                    <td>
                                                        <input type='checkbox' id='myCheck_<?php echo $row['nis'] ?>' onclick='myFunction_<?php echo $row['nis'] ?>()' 
                                                        <?php 
                                                        if ($row['telat']==1 && date($row['jm']) == $tgl) {
                                                            echo "checked";
                                                        }

                                                         ?> disabled>
                                                    </td>

                                                    <td>
                                                        Jam :<select id='jam_<?php echo $row['nis'] ?>' disabled>
                                                        <?php 
                                                            $jamTelat = (date('H', strtotime($row['jam_masuk']))-date('H', strtotime($jam_masuk[0]['jam_masuk'])));
                                                                if ($jamMasuk2 > $jam_masuk[0]['jam_masuk'] && $row['kehadiran'] == 4 && date($row['jm']) == $tgl) {
                                                                    echo "<option value='$x'>".str_replace('-', '', $jamTelat)."</option>";
                                                                } else {
                                                                    for ($x = 0; $x < 24; $x++) {
                                                                      echo "<option value='$x' >$x</option>";
                                                                    }
                                                                }
                                                        ?>
                                                        </select>
                                                        Menit :
                                                        <select id='menit_<?php echo $row['nis'] ?>' disabled>
                                                            <?php 
                                                                $menitTelat = (date('i', strtotime($row['jam_masuk']))-date('i', strtotime($jam_masuk[0]['jam_masuk'])));
                                                                if ($jamMasuk2 > $jam_masuk[0]['jam_masuk'] && $row['kehadiran'] == 4 && date($row['tglmasuk']) == $tgl) {
                                                                    echo "<option value='$x'>".str_replace('-', '', $menitTelat)."</option>";
                                                                } else {
                                                                    for ($x = 0; $x < 59; $x++) {
                                                                      echo "<option value='$x' >$x</option>";
                                                                    }
                                                                }
                                                            ?>
                                                        </select>
                                                    </td>

                                                    <!-- <td>
                                                        Jam :<select id='jam_<?php echo $row['nis'] ?>' disabled>
                                                        <?php 
                                                            if ($jamMasuk2 == '07:00:00' && $jamMasuk2 > $jam_masuk[0]['jam_masuk']) {
                                                                for ($i=0; $i < 24 ; $i++) { 
                                                                  echo "<option value='$i' >$i</option>";
                                                                }
                                                            } else {
                                                                echo "<option value='$i'>".(date('H', strtotime($row['jam_masuk']))-date('H', strtotime($jam_masuk[0]['jam_masuk'])))."</option>";
                                                        }?>
                                                        </select>
                                                        Menit :
                                                        <select id='menit_<?php echo $row['nis'] ?>' disabled>
                                                            <?php 
                                                                if ($jamMasuk2 == '07:00:00' && $jamMasuk2 > $jam_masuk[0]['jam_masuk']) {
                                                                for ($i=0; $i < 60 ; $i++) { 
                                                                  echo "<option value='$i' >$i</option>";
                                                                }
                                                            } else {
                                                                echo "<option value='$i'>".(date('i', strtotime($row['jam_masuk']))-date('i', strtotime($jam_masuk[0]['jam_masuk'])))."</option>";
                                                            }?>
                                                        </select>
                                                    </td> -->
                                                </tr>
                                            
                                            <?php 
                                            }
                                        }
                                        $i++
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                            <input type="submit" onclick="updateAlfa()" class="btn btn-success pull-right" value="SIMPAN ABSEN">
                        </form>
                            
                        <!-- /.row -->
                    </div>
                    <!-- ./box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
    <?php endif; ?>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#tableHadir').DataTable();
            } );
        </script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#tableBlmHadir').DataTable();
            } );
        </script>