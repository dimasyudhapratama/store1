<?=  $this->extend('backend/master_template'); ?>

<?= $this->section('content'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h5>Detail Penjualan</h5>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
              <li class="breadcrumb-item"><a href="<?= base_url('backend/sales'); ?>">Penjualan</a></li>
              <li class="breadcrumb-item active">Detail Penjualan</li>
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
              <div class="form-row">
                  <div class="form-group col-md-3">
                      <small class="font-weight-bold">Sales ID</small>
                      <p><?= $record['id'] ?></p>
                  </div>
                  <div class="form-group col-md-3">
                      <small class="font-weight-bold">Datetime</small>
                      <p><?= $record['transaction_time'] ?></p>
                  </div>
                  <div class="form-group col-md-3">
                      <small class="font-weight-bold">Kurir</small>
                      <p><?= $record['courier'] ?></p>
                  </div>
                  <div class="form-group col-md-3">
                      <small class="font-weight-bold">Kota (Kode)</small>
                      <p><?= $city['city_name'].' ('.$record['city_code'].' )' ?></p>
                  </div>
                  <div class="form-group col-md-3">
                    <small>Alamat Lengkap</small>
                    <p><?= $record['full_address'] ?></p>
                  </div>
                  <div class="form-group col-md-3">
                    <small>Status</small>
                    <p>
                      <?php
                        if($record['transaction_status'] == 1){
                          echo "<span class='badge badge-warning'>Menunggu Pembayaran</span>";
                        }else if($record['transaction_status'] == 2){
                          echo "<span class='badge badge-info'>Pesanan Diproses</span>";
                        }else if($record['transaction_status'] == 3){
                          echo "<span class='badge badge-success'>Barang Dikirim</span>";
                        } 
                      ?>
                    </p>
                  </div>

                  
              </div>
              <div class="mt-2">
                  <table class="table table-sm table-bordered table-striped">
                    <thead>
                      <tr>
                        <td class="text-center">No.</td>
                        <td class="text-center">Item.</td>
                        <td class="text-center">Quantity</td>
                        <td class="text-center">Berat</td>
                        <td class="text-center">Subtotal</td>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                        $no = 1;
                        $weight_total = 0;
                        foreach($detail_sales_data as $detail){ 
                          $weight_total += $detail['weight_subtotal'];
                        ?>
                      <tr>
                        <td><?= $no++."."; ?></td>
                        <td><?= $detail['product_name']; ?></td>
                        <td><?= $detail['quantity']; ?></td>
                        <td class="text-right"><?= number_format($detail['weight_subtotal'],0,',','.'); ?></td>
                        <td class="text-right"><?= "Rp. ".number_format($detail['price_subtotal'],0,',','.'); ?></td>
                      </tr>
                      <?php } ?>
                      <tr>
                        <td colspan="3" class="text-right font-weight-bold font-italic">Total</td>
                        <td class="text-right font-weight-bold"><?= number_format($weight_total,0,',','.'); ?></td>
                        <td class="text-right font-weight-bold"><?= "Rp. ".number_format($record['price_total'],0,',','.'); ?></td>
                      </tr>
                      <tr>
                          <td colspan="4" class="text-right font-weight-bold font-italic">Ongkos Kirim</td>
                          <td class="text-right font-weight-bold"><?= "Rp. ".number_format($record['shipping_price'],0,',','.'); ?></td>
                      </tr>
                      <tr>
                          <td colspan="4" class="text-right font-weight-bold font-italic">Kode Unik</td>
                          <td class="text-right font-weight-bold"><?= "Rp. ".number_format($record['unique_code'],0,',','.'); ?></td>
                      </tr>
                      <tr>
                          <td colspan="4" class="text-right font-weight-bold font-italic">Grand Total</td>
                          <td class="text-right font-weight-bold"><?= "Rp. ".number_format($record['grand_total'],0,',','.'); ?></td>
                      </tr>
                    </tbody>
                  </table>
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