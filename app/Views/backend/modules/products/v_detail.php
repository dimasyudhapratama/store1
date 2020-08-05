<?=  $this->extend('backend/master_template'); ?>

<?= $this->section('content'); ?>


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h5>Detail Produk</h5>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
              <li class="breadcrumb-item"><a href="<?= base_url('backend/products'); ?>">Produk</a></li>
              <li class="breadcrumb-item active">Detail Produk</li>
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
                    <div class="form-group col-md-4">
                        <small class="font-weight-bold">Nama Produk</small>
                        <p><?= $record['product_name']; ?></p>
                    </div>
                    <div class="form-group col-md-4">
                        <small class="font-weight-bold">Kategori</small>
                        <p><?= $record['product_name']; ?></p>
                        <!-- <input type="text" name="product_category" id="product_category" class="form-control form-control-sm" value="<?= $record['product_name']; ?>" disabled> -->
                    </div>
                    <div class="form-group col-md-4">
                        <small class="font-weight-bold">Berat</small><p><?= $record['weight']; ?></p>
                    </div>
                    <div class="form-group col-md-4">
                        <small class="font-weight-bold">Stok</small>
                        <p><?= $record['stock']; ?></p>
                    </div>
                    <div class="form-group col-md-4">
                        <small class="font-weight-bold">Harga</small>
                        <p><?= $record['price']; ?></p>
                    </div>
                    <div class="form-group col-md-12">
                        <small class="font-weight-bold">Deskripsi</small>
                        <p><?= $record['description']; ?></p>
                    </div>
                    <?php if($record['images'] != NULL){ ?>
                    <div class="form-group col-md-12 text-center">
                        <small class="font-weight-bold">Preview Gambar Produk</small>
                        <br>
                        <img src="<?php echo base_url().'/uploaded_images/'.$record['images']; ?>" style="width: 240px; height: 455px;" alt="">
                    
                    </div>
                    <?php } ?>
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