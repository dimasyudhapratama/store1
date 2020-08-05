<?=  $this->extend('backend/master_template'); ?>

<?= $this->section('content'); ?>


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Bukti Pembayaran</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
              <li class="breadcrumb-item active">Bukti Pembayaran</li>
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
                            <th class="text-center font-weight-bold">No.</th>
                            <th class="text-center font-weight-bold">Tanggal Penjualan</th>
                            <th class="text-center font-weight-bold">Bank</th>
                            <th class="text-center font-weight-bold">Tanggal Transfer</th>
                            <th class="text-center font-weight-bold">Jumlah Transfer</th>
                            <th class="text-center font-weight-bold">Gambar</th>
                            <th class="text-center font-weight-bold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no= 1; 
                        foreach($proof_of_payments as $record){ 
                        ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $record['sales_date']; ?></td>
                            <td><?= $record['bank_account_name'].' - '.$record['bank_account_number'].' '.'('.$record['bank_name'].')'; ?></td>
                            <td><?= $record['transfer_date']; ?></td>
                            <td class="text-right"><?= "Rp.".number_format($record['transfer_amount'],0,',','.'); ?></td>
                            <td class="text-center">
                              <a href="#" onclick="viewImage('<?= $record['proof_of_payment_image']; ?>')">Lihat Gambar</a>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-success btn-sm dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Aksi
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                    <a class="dropdown-item" href="<?= base_url('backend/proofofpayment/delete').'/'.$record['id'] ?>" onclick="return confirm('Apakah Anda Yakin Untuk Menghapus Data Bukti Pembayaran?')">Delete</a>
                                </div>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <!-- Modal -->
                <div class="modal fade" id="modalShowImage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Bukti Pembayaran</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                          <div class="form-group col md-12 text-center">
                            <img id="image_proofofpayment" style="max-width:350px;max-height:350px;">
                          </div>
                        </div>
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
<?= $this->section('content_js'); ?>
<script>
    function viewImage(image_url){
        $("#image_proofofpayment").attr('src','<?= base_url().'/uploaded_images/bukti_transfer/'; ?>'+image_url)
        $("#modalShowImage").modal('show');
    }   
</script>

<?= $this->endSection(); ?>