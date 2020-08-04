<?=  $this->extend('backend/master_template'); ?>

<?= $this->section('content'); ?>


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Dashboard</h1>
          </div>
          <!-- <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
              <li class="breadcrumb-item active">Produk</li>
            </ol>
          </div> -->
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <h6>Pendapatan Bulanan</h6>
              <canvas id="dailyChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
</div>

<?= $this->endSection(); ?>
<?= $this->section('content_js'); ?>
<script src="<?= base_url(); ?>/backend_assets/plugins/chart.js/Chart.min.js"></script>
<script>
  //Load at first
  $(function () {
    previewDailyChart();
  })

  //Ajax untuk Menampilkan Line Chart Secara Bulanan
  function previewDailyChart(){
    $.ajax({
        url: "<?= base_url().'/backend/dashboard/dailyChart' ?>",
        type: "GET",
        success: function(dataset) {
          var data = JSON.parse(dataset)
          
          var tanggal_int = 1;
          var tanggal_array = [];
          var pendapatan_penjualan = [];
          var pendapatan_kode_unik = [];

          for(var i=0;i<data.length;i++){
              tanggal_array.push(tanggal_int);
              pendapatan_penjualan.push(data[i]['daily_price_total']);
              pendapatan_kode_unik.push(data[i]['daily_unique_code']);

              tanggal_int++;
          }

          var ctx = document.getElementById("dailyChart").getContext('2d');
          var myChart = new Chart(ctx, {
              type: 'line',
              data: {
                  labels: tanggal_array,
                  datasets: [{
                      label: 'Pendapatan Penjualan',
                      data: pendapatan_penjualan,
                      // data: [1,2,3,4,5,6,7,8,9,10,11,12],
                      fill: false,
                      borderColor: '#2196f3',
                      backgroundColor: '#2196f3',
                      borderWidth: 1
                  },
                  {
                      label: 'Pendapatan Dari Kode Unik',
                      data: pendapatan_kode_unik,
                      fill: false,
                      borderColor: '#4CAF50',
                      backgroundColor: '#4CAF50',
                      borderWidth: 1
                  }]
              },         
              options: {
                responsive: true, 
                maintainAspectRatio: false, 
              }
          });
        }
    });
  }
</script>
<?= $this->endSection(); ?>