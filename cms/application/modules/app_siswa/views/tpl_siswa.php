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
    </section><br>
    <?php if($this->initial_template == '' || $this->initial_template == 'siswa'): ?>
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
                        <span class="info-box-number">
                            <?php echo $datadbhadirhariini['$js']; ?>
                          </span>
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
                        <span class="info-box-number">
                            <?php $blmhadir = $datadbjumlahsiswa['$js'] - $datadbhadirhariini['$js'] - $datadbhadirizinini['$js'];
                                echo $blmhadir;
                            ?>
                        </span>
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
                        <span class="info-box-number"><?php echo $datadbhadirizinini['$js'];?></span>
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
                                    <strong>Top 5 Siswa</strong>
                                </p>
                                <div class="table-responsive">
                                    <table class="table no-margin">
                                        <thead>
                                            <tr>
                                                <th>Order ID</th>
                                                <th>Item</th>
                                                <th>Status</th>
                                                <th>Popularity</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><a href="pages/examples/invoice.html">OR7429</a></td>
                                                <td>iPhone 6 Plus</td>
                                                <td><span class="label label-danger">Delivered</span></td>
                                                <td>
                                                    <div class="sparkbar" data-color="#f56954" data-height="20">90,-80,90,70,-61,83,63</div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><a href="pages/examples/invoice.html">OR9842</a></td>
                                                <td>Call of Duty IV</td>
                                                <td><span class="label label-success">Shipped</span></td>
                                                <td>
                                                    <div class="sparkbar" data-color="#00a65a" data-height="20">90,80,90,-70,61,-83,63</div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.table-responsive -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <strong><h1>SEMUA SISWA</h1></strong>
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
                                        <th>Kelas</th>
                                        <!-- <th>Telat</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $i   = 0;
                                    $menit = 0;
                                    if ( count($siswaKelas) > 0 ) {     
                                        foreach ($siswaKelas as $row) {
                                            echo '<tr>';
                                            echo "<td><a href='pages/examples/invoice.html'>".$row['absen']."</a></td>";
                                            echo "<td>".$row['nis']."</td>";
                                            echo "<td>".$row['nama_siswa']."</td>";
                                            echo "<td><input type='radio' ".($row['keterangan'] == '0' ? 'checked' : '' )."  name='kehadiran_".$row['absen']."' value='".$row['keterangan']."' />
                                                </td>";

                                            echo "<td><input type='radio' ".($row['keterangan'] == '1' ? 'checked' : '' )." name='kehadiran_".$row['absen']."' value='Alfa'  /></td>";
                                            echo "<td><input type='radio' ".($row['keterangan'] == 'Izin' ? 'checked' : '' )." name='kehadiran_".$row['absen']."' value='Izin'  /></td>";
                                            echo "<td><input type='radio' ".($row['keterangan'] == 'Sakit' ? 'checked' : '' )." name='kehadiran_".$row['absen']."' value='Sakit'  /></td>";
                                            echo "<td>".$row['Nama_Kelas']."</td>";
                                            // echo "<td><button onclick='check()'>Check Checkbox</button><td>";
                                        }
                                    }
                                    $i++
                                ?>
                                </tbody>
                            </table>
                        </div>
                        <strong><h1>SISWA HADIR HARI INI</h1></strong>
                        <div class="table-responsive">
                            <table class="table no-margin">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Id Finger</th>
                                        <th>Nama Siswa</th>
                                        <th>SMS</th>
                                        <th>Kelas</th>
                                        <th>Jam Datang</th>
                                        <th>Jam Pulang</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $i     = 1;
                                    if ( count($absen) > 0 ) {   
                                        foreach ($absen as $row) {
                                            echo '<tr>';
                                            echo "<td>".$i++."</a></td>";
                                            echo "<td>".$row['pin']."</td>";
                                            echo "<td>".$row['nama_siswa']."</td>";
                                            echo "<td>".$row['status']."</td>";
                                            // echo "<td><input type='radio' ".($row['keterangan'] == 'Izin' ? 'checked' : '' )." name='kehadiran_".$row['absen']."' value='Izin'  /></td>";
                                            // echo "<td><input type='radio' ".($row['keterangan'] == 'Sakit' ? 'checked' : '' )." name='kehadiran_".$row['absen']."' value='Sakit'  /></td>";
                                            // echo "<td>".$row['Nama_Kelas']."</td>";
                                            echo "<td>".$row['Nama_Kelas']."</td>";
                                            echo "<td>".$row['jam_masuk']."</td>";
                                            echo "<td>".$row['jam_pulang']."</td>";
                                            echo "</tr>";
                                        }
                                    }
                                ?>
                                </tbody>
                            </table>
                        </div>
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
