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
                        <h3 class="box-title">Statistik</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="box box-success">
                            <div class="box-header with-border">
                              <h3 class="box-title">Bar Chart</h3>

                              <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                              </div>
                            </div>
                            <div class="box-body">
                              <div class="chart">
                              <canvas id="barChart" style="height: 230px; width: 510px;" height="230" width="510"></canvas>
                              </div>
                            </div>
                            <!-- /.box-body -->
                          </div>
                        <div class="col-xs-12 table-responsive">
                        <div class="pull-right">
                        <form method="get" action="<?= base_url('app_laporan/search') ?>">
                          <div class="col-md-6">
                            <div class="input-group">
                              <select name="kelas" id="kelas" class="form-control" id="kelas" onchange="gantikelas(this.value)" required>
                              <option value="">== PILIH KELAS ==</option>
                                <?php
                                if (count($absenKelas) > 0) {
                                  foreach ($absenKelas as $row) {
                                    echo "<option name=".$row['Nama_Kelas']." value=".$row['id_kelas']." ".($row['id_kelas'] == $this->input->get('kelas')?'selected':'').">".$row['Nama_Kelas']."</option>";
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
                              <select name="tanggal" id="tanggal" class="form-control" required>
                              <option value="">== PILIH BULAN ==</option>
                                <?php
                                  $bln = array(1=>"Januari","Februari",
                                                  "Maret","April","Mei",
                                                  "Juni","July","Agustus",
                                                  "September","Oktober","November","Desember"
                                              );
                                  for($bulan=1; $bulan<=12; $bulan++){
                                    echo "<option value='0$bulan' ".(($this->input->get('tanggal')=='0'.$bulan)?'selected':'').">$bln[$bulan]</option>"; 
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
                        <h3 id="hasil"></h3>
                        <h3 id="hasilBulan"></h3>
                        <h4>Tahun: <?php echo date('Y'); ?></h4>
                        <table class="table table-striped" id="laporan">
                          <thead>
                              <tr>
                                  <th>No. Absen</th>
                                  <th>NIS</th>
                                  <th>Nama Siswa</th>
                                  <th>Total</th>
                              </tr>
                          </thead>
                          <tbody>
                          <?php 
                            if ( count($cari) > 0 ) {   
                                  for ($i=0; $i < count($cari); $i++) { 
                                    # code...
                                  
                                    echo '<tr>';
                                    echo "<td>".$cari[$i]['absen']."</a></td>";
                                    echo "<td>".$cari[$i]['nis']."</td>";
                                    echo "<td><a href='#' class='detail' onclick='getSiswa(".$cari[$i]['pin'].")' id='detail_".$i."'>".$cari[$i]['nama_panggilan']."</a><input type='hidden' class='pin' id='pin_".$i."' value='".$cari[$i]['nis']."'></td>";

                                    echo "<td id='".$cari[$i]['jam_masuk']."'>".$cari[$i]['jh']."</td>";
                                    echo "<td></td>";
                                    echo "</tr>";
                                    echo '';
                                }
                            }
                            else{
                                  echo '<tr>';
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
                        <!-- <form action="" method="GET">
                        <input type="text" name="kelas" value="<?php echo $this->input->get('kelas') ?>">
                        <input type="text" name="tanggal" value="<?php echo $this->input->get('tanggal') ?>">
                        <a href="<?= base_url('app_laporan/excel') ?>" type="submit" class="btn btn-default" data-dismiss="modal" >PRINT</a>
                        </form> -->
                      <li><a href="#" onclick="$('#laporan').tableExport({type:'xls',fileName:'Kelas' + $('#kelas2').val() + '&nbsp;Laporan Kehadiran Bulan : ' + $('#tanggal').val()  , worksheetName: '' });">Export To Excel</a></li>

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
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div id="nis2" ></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- /.content-wrapper -->
    <?php endif; ?>
<script>

document.addEventListener('DOMContentLoaded', function() {

 var id_kelas = $('select[name=kelas').val();
         $.ajax({
                type:'POST', //HARUS
                url:'<?php echo base_url("app_laporan/getKelas"); ?>',
                data:{'kelas':id_kelas},
                success:function(data){
                    $('#hasil').html(data);
                }
            });

function gantikelas(id) {
      var kelas = id;
         $.ajax({
                type:'POST', //HARUS
                url:'<?php echo base_url("app_laporan/getKelas"); ?>',
                data:{'kelas':kelas},
                success:function(data){
                    $('#hasil').html(data);
                }
            });
}


});

function result(nis) {
  var nis   = nis;
  document.fres.nis.value = nis;
}


    // AJAX POST GET DETAIL SISWA
    // 
    function getSiswa(nis){
      var pin = nis;
      var kelas = $('#kelas').val();
      var month = $('#tanggal').val();
         $.ajax({
                type:'POST',
                url:'<?php echo base_url("app_laporan/getSiswa"); ?>',
                data:{'kelas':kelas,'tanggal':month, 'pin':pin},
                success:function(data){
                    $('#myModal').modal('show');
                    //$('#ortu2').html(data);
                    $('#nis2').html(data);
                }
            });


    }


function DoCellData(cell, row, col, data) {}
function DoBeforeAutotable(table, headers, rows, AutotableSettings) {}


  $(function () {


    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */

    //--------------
    //- AREA CHART -
    //--------------

    // Get context with jQuery - using jQuery's .get() method.
    var areaChartCanvas = $("#barChart").get(0).getContext("2d");
    // This will get the first returned node in the jQuery collection.
    var areaChart = new Chart(areaChartCanvas);

    var areaChartData = {
      labels: ["January", "February", "March", "April", "May", "June", "July"],
      datasets: [
        {
          label: "Electronics",
          fillColor: "rgba(210, 214, 222, 1)",
          strokeColor: "rgba(210, 214, 222, 1)",
          pointColor: "rgba(210, 214, 222, 1)",
          pointStrokeColor: "#c1c7d1",
          pointHighlightFill: "#fff",
          pointHighlightStroke: "rgba(220,220,220,1)",
          data: [65, 59, 80, 81, 56, 55, 40]
        },
        {
          label: "Digital Goods",
          fillColor: "rgba(60,141,188,0.9)",
          strokeColor: "rgba(60,141,188,0.8)",
          pointColor: "#3b8bba",
          pointStrokeColor: "rgba(60,141,188,1)",
          pointHighlightFill: "#fff",
          pointHighlightStroke: "rgba(60,141,188,1)",
          data: [28, 48, 40, 19, 86, 27, 90]
        }
      ]
    };

    var areaChartOptions = {
      //Boolean - If we should show the scale at all
      showScale: true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines: false,
      //String - Colour of the grid lines
      scaleGridLineColor: "rgba(0,0,0,.05)",
      //Number - Width of the grid lines
      scaleGridLineWidth: 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines: true,
      //Boolean - Whether the line is curved between points
      bezierCurve: true,
      //Number - Tension of the bezier curve between points
      bezierCurveTension: 0.3,
      //Boolean - Whether to show a dot for each point
      pointDot: false,
      //Number - Radius of each point dot in pixels
      pointDotRadius: 4,
      //Number - Pixel width of point dot stroke
      pointDotStrokeWidth: 1,
      //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
      pointHitDetectionRadius: 20,
      //Boolean - Whether to show a stroke for datasets
      datasetStroke: true,
      //Number - Pixel width of dataset stroke
      datasetStrokeWidth: 2,
      //Boolean - Whether to fill the dataset with a color
      datasetFill: true,
      //String - A legend template
      legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
      //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
      maintainAspectRatio: true,
      //Boolean - whether to make the chart responsive to window resizing
      responsive: true
    };

    //Create the line chart
    areaChart.Line(areaChartData, areaChartOptions);



    //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas = $("#barChart").get(0).getContext("2d");
    var barChart = new Chart(barChartCanvas);
    var barChartData = areaChartData;
    barChartData.datasets[1].fillColor = "#00a65a";
    barChartData.datasets[1].strokeColor = "#00a65a";
    barChartData.datasets[1].pointColor = "#00a65a";
    var barChartOptions = {
      //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
      scaleBeginAtZero: true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines: true,
      //String - Colour of the grid lines
      scaleGridLineColor: "rgba(0,0,0,.05)",
      //Number - Width of the grid lines
      scaleGridLineWidth: 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines: true,
      //Boolean - If there is a stroke on each bar
      barShowStroke: true,
      //Number - Pixel width of the bar stroke
      barStrokeWidth: 2,
      //Number - Spacing between each of the X value sets
      barValueSpacing: 5,
      //Number - Spacing between data sets within X values
      barDatasetSpacing: 1,
      //String - A legend template
      legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
      //Boolean - whether to make the chart responsive
      responsive: true,
      maintainAspectRatio: true
    };

    barChartOptions.datasetFill = false;
    barChart.Bar(barChartData, barChartOptions);
  });
</script>
