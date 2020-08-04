<?=  $this->extend('backend/master_template'); ?>

<?= $this->section('content'); ?>


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Penjualan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
              <li class="breadcrumb-item active">Penjualan</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
                <?php echo session()->getFlashdata('info'); ?>
                <table id="example1" class="table table-sm table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Sales ID</th>
                            <th>Datetime</th>
                            <th>Grand Total</th>
                            <th>Status Transaksi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no= 1; 
                        foreach($sales as $record){ 
                          $sales_id = $record['id'];
                        ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $record['id']; ?></td>
                            <td><?= $record['transaction_time']; ?></td>
                            <td class="text-right"><?= "Rp.".number_format($record['grand_total'],0,',','.'); ?></td>
                            <td class="text-center">
                              <?php 
                                if($record['transaction_status'] == 1){
                                  echo "<span class='badge badge-warning'>Menunggu Pembayaran</span>";
                                }else if($record['transaction_status'] == 2){
                                  echo "<span class='badge badge-info'>Pesanan Diproses</span>";
                                }else if($record['transaction_status'] == 3){
                                  echo "<span class='badge badge-success'>Barang Dikirim</span>";
                                } 
                              
                              ?>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-success btn-sm dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Aksi
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                    <a href="#" class="dropdown-item" onclick="getSalesData(<?= $record['id']; ?>)" data-toggle="modal" data-target="#modalChangeStatus">Ubah Status</a>
                                    <a class="dropdown-item" href="<?= base_url('backend/sales/detail').'/'.$record['id'] ?>">Detail</a>
                                    <a class="dropdown-item" href="<?= base_url('backend/sales/delete').'/'.$record['id'] ?>" onclick="return confirm('Apakah Anda Yakin Untuk Menghapus Data Kategori Produk?')">Delete</a>
                                </div>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <!-- Modal -->
                <div class="modal fade" id="modalChangeTransactionStatus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <?php echo form_open('backend/sales/updateStatus') ?>
                      <input type="hidden" name="sales_id" id="sales_id">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ubah Status</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                          <div class="form-group col md-12">
                              <small>Status</small>
                              <select name="status" id="status" class="form-control form-control-sm">
                                <option value="1">Menunggu Pembayaran</option>
                                <option value="2">Pesanan Diproses</option>
                                <option value="3">Barang Dikirim</option>
                              </select>
                          </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-sm">Save changes</button>
                      </div>
                      <? echo form_close() ?>
                    </div>
                  </div>
                </div>
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
<?= $this->section('content'); ?>
<script>
  function getSalesData(sales_id){
    $.ajax({
        url : "<?= base_url().'/backend/sales/getSalesData/'; ?>"+sales_id,
        headers : {'X-Requested-With': 'XMLHttpRequest'},
        method : "GET",
        success : function(ajaxData){
          var data = JSON.parse(ajaxData)

          $("#sales_id").val(data['id'])
          $("#status").val(data['transaction_status']).change()

          $("#modalChangeTransactionStatus").modal()
        }
    });
  }

  function updateSalesTransactionStatus(){
    $.ajax({
        url : "<?= base_url().'/backend/sales/update'; ?>",
        headers : {'X-Requested-With': 'XMLHttpRequest'},
        method : "POST",
        success : function(ajaxData){
          
        }
    });
  }
</script>
<?= $this->endSection(); ?>