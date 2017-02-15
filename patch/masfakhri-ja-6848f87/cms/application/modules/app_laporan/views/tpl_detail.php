<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Laporan
        <small></small>
      </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Laporan</li>
        </ol>
    </section><br>
    <?php if($this->initial_template == '' || $this->initial_template == 'siswa'): ?>
    <!-- Main content -->
    <section class="content">
        <!-- /.row -->
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title"></h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="box box-success">
                            <div class="box-body">
                            </div>
                            <!-- /.box-body -->
                          </div>
                        <div class="col-xs-12 table-responsive">
                        <div class="pull-right">
                        <form method="get" action="<?= base_url('app_laporan/search') ?>">
                          <div class="col-md-6">
                            <div class="input-group">
                              <select name="kelas" id="" class="form-control" required>
                              <option value="">== PILIH KELAS ==</option>
                                <?php
                                if (count($absenKelas) > 0) {
                                  foreach ($absenKelas as $row) {
                                    echo "<option value=".$row['id_kelas'].">".$row['Nama_Kelas']."</option>";  
                                  }
                                }
                                ?>
                              </select>
                              <span class="input-group-btn">
                                <button class="btn btn-default" type="button"><i>&nbsp;</i></button>
                              </span>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="input-group">
                              <select name="tanggal" id="" class="form-control" required>
                              <option value="">== PILIH BULAN ==</option>
                                <?php
                                  $bln = array(1=>"Januari","Februari",
                                                  "Maret","April","Mei",
                                                  "Juni","July","Agustus",
                                                  "September","Oktober","November","Desember"
                                              );
                                  for($bulan=1; $bulan<=12; $bulan++){
                                    if($bulan<=9) { echo "<option value='0$bulan'>$bln[$bulan]</option>"; }
                                      else { echo "<option value='$bulan'>$bln[$bulan]</option>"; }
                                    }
                                ?>
                              </select>
                              <span class="input-group-btn">
                                <button class="btn btn-default" type="button"><i>&nbsp;</i></button>
                              </span>
                            </div>
                          </div>
                          <div class="col-md-2">
                            <span class="input-group-btn">
                                <button class="btn btn-success" type="submit"><i class="fa fa-search"></i> Cari</button>
                              </span>
                          </div>
                        </form>
                        </div><br>
                        <h3>Laporan Kehadiran: </h3>
                        <h4> </h4>
                        <table class="table table-striped">
                          <thead>
                              <tr>
                                  <th>NO. Absen</th>
                                  <th>NIS</th>
                                  <th>Nama Siswa</th>
                                  <th>Hadir</th>
                                  <th>Telat</th>
                                  <th>Alfa</th>
                                  <th>Sakit</th>
                                  <th>Izin</th>
                              </tr>
                          </thead>
                          <tbody>
                          <?php 
                            $i      = 1;
                            if ( count($cari) > 0 ) {   
                                foreach ($cari as $row) {
                                    echo '<tr>';
                                    echo "<td>".$row['absen']."</a></td>";
                                    echo "<td>".$row['nis']."</td>";
                                    echo "<td>".$row['nama_panggilan']."</td>";
                                    echo "<td><a href=app_laporan/detail/".$row['nis'].">".$row['jh']."</a></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "</tr>";
                                }
                            }
                            else{
                                  echo '<tr>';
                                  echo "<td></td>";
                                  echo "<td></td>";
                                  echo "<td></td>";
                                  echo "<td>Pilih Tanggal</td>";
                                  echo "<td></td>";
                                  echo "<td></td>";
                                  echo "</tr>";
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
