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
                        <span class="info-box-number"><?php $blmhadir = $datadbjumlahsiswa['$js'] - $datadbsiswa['hadir'] - $datadbhadirizinini['$js'];
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
                        <span class="info-box-text">Siswa Izin Hari ini</span></strong>
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
                        <form method="post" action="">
                            <div class="table-responsive">
                                <table class="table no-margin">
                                    <thead>
                                        <tr>
                                            <th>No Absen</th>
                                            <th>Nis</th>
                                            <th>Nama Siswa</th>
                                            <th>Hadir</th>
                                            <th>Alfa</th>
                                            <th>Izin</th>
                                            <th>Sakit</th>
                                            <th>Telat</th>
                                            <th>Waktu Telat</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $i   = 0;
                                        $menit = 0;
                                        $tgl = date('Y-m-d');
                                        
                                        if ( count($siswaKelas) > 0 ) {     
                                            foreach ($siswaKelas as $row) {
                                                $telat = date('H:i:s', strtotime($row['jam']));
                                                $this->load->model('app_websetup/Mapp_websetup');        
                                                $jam_pulang = $this->Mapp_websetup->grapInOut();

                                                echo "<script type='text/javascript'>";
                                                // CEK BOK
                                                echo "function myFunction_".$row['nis']."() {
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
                                                }";     
                                                echo "</script>";
                                            /*Table*/
                                                echo '<tr>';
                                                echo "<td><a href='pages/examples/invoice.html'>".$row['absen']."</a></td>";
                                                echo "<td>".$row['nis']."
                                                        <input type='hidden' name='nis' value=".$row['nis']." />
                                                          <input type='hidden' name='pin' value=".$row['pin2']." >
                                                          <input type='hidden' name='id_kelas' value=".$row['id_kelas']." >
                                                      </td>";
                                                      
                                                echo "<td>".$row['nama_siswa']."</td>";

                                                echo "<td>
                                                        <input type='radio' id='radioHadir_".$row['nis']."' onclick='myRadio_".$row['nis']."()' ".($row['jm'] == $tgl ? 'checked' : '' )."  name='kehadiran_".$row['nis']."' value='4'>
                                                      </td>";//hadir

                                                echo "<td>
                                                        <input type='radio' id='radioAlpha_".$row['nis']."' onclick='myRadio_".$row['nis']."()' ".($row['jm'] != $tgl ? 'checked' : '' )."  name='kehadiran_".$row['nis']."' value='1' >
                                                      </td>";//alpha | default

                                                echo "<td>
                                                        <input type='radio' id='radio_".$row['nis']."' onclick='myRadio_".$row['nis']."()' ".($row['kehadiran'] == 2 ? 'checked' : '' )." name='kehadiran_".$row['nis']."' value='2'>
                                                      </td>";//Izin

                                                echo "<td> $telat > ".$jam_pulang[0]['jam_masuk']." </td>";

                                                echo "<td>
                                                        <input type='checkbox' id='myCheck_".$row['nis']."' onclick='myFunction_".$row['nis']."()' ".($telat > $jam_pulang[0]['jam_masuk'] ? 'checked' : '' )." >
                                                      </td>";
                                                // echo "<td><input onclick='check()'><td>";
                                                echo "<td>";
                                                echo "Jam :&nbsp;";
                                                echo "<select id='jam_".$row['nis']."' disabled>";
                                                    for ($x = 0; $x <= 10; $x++) {
                                                      echo "<option value='$x'>$x</option>";
                                                    }
                                                echo "</select>";
                                                echo "&nbsp;Menit&nbsp;:&nbsp;<select id='menit_".$row['nis']."' disabled>";
                                                    for ($x = 0; $x <= 59; $x++) {
                                                      echo "<option value='$x'>$x</option>";
                                                    }
                                                echo "</select>";
                                                echo "</td>";
                                                // echo "<td><span class='label label-danger'>Delivered</span></td>";
                                                // echo "</td>"; 
                                                // echo "</tr>";
                                            }
                                        }
                                        $i++
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                            
                            <button class="btn btn-success pull-right" type="submit"><i class="fa fa-save"></i> Simpan</button>
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
