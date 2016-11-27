<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Dashboard
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
                        <span class="info-box-number"><?php echo $datadbsiswa['$hadir'];?></span>
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
                        <span class="info-box-number"><?php echo $datadbblmhadir['$blmHadir'];?></span>
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
                                        if ( count($datadbgetsiswa) > 0 ) {     
                                            foreach ($datadbgetsiswa as $row) {
                                                echo '<tr>';
                                                echo "<td><a href='pages/examples/invoice.html'>".$row['absen']."</a></td>";
                                                echo "<td>".$row['nis']."</td>";
                                                echo "<td>".$row['nama_siswa']."</td>";
                                                echo "<td><input type='radio' name='kehadiran_".$row['absen']."' value='Hadir' /></td>";
                                                echo "<td><input type='radio' name='kehadiran_".$row['absen']."' value='Alfa' /></td>";
                                                echo "<td><input type='radio' name='kehadiran_".$row['absen']."' value='Izin' /></td>";
                                                echo "<td><input type='radio' name='kehadiran_".$row['absen']."' value='Sakit' /></td>";
                                                echo "<td><input type='checkbox' name='blmHadir_".$row['absen']."' value='Belum Hadir' /></td>";
                                                echo "<td>";
                                                echo "Jam :";
                                                echo "<select>";
                                                    for ($x = 0; $x <= 10; $x++) {
                                                      echo "<option value='$x'>$x</option>";
                                                    }
                                                echo "</select>";
                                                echo "&nbsp;Menit&nbsp;:&nbsp;<select>";
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
                            <input align="right" type="button" class="btn btn-success" value="Simpan Absen" >
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
