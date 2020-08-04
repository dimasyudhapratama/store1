<?=  $this->extend('backend/master_template'); ?>

<?= $this->section('content'); ?>


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h5>Tambah Produk</h5>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
              <li class="breadcrumb-item"><a href="<?= base_url('backend/products'); ?>">Produk</a></li>
              <li class="breadcrumb-item active">Tambah Produk</li>
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
                <?php echo form_open_multipart('backend/products/save') ?>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <small class="font-weight-bold">Nama Produk</small>
                            <input type="text" name="product_name" id="product_name" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group col-md-4">
                            <small class="font-weight-bold">Kategori</small>
                            <select name="product_categories_id" id="product_categories_id" class="form-control form-control-sm" required>
                                <option value="">--Pilih Kategori Produk--</option>
                                <?php foreach($product_categories as $record){ ?>
                                <option value="<?= $record['id']; ?>"><?= $record['category_name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <small class="font-weight-bold">Berat (g)</small>
                            <input type="text" name="weight" id="weight" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group col-md-4">
                            <small class="font-weight-bold">Stok</small>
                            <input type="number" name="stock" id="stock" class="form-control form-control-sm" min="0" required>
                        </div>
                        <div class="form-group col-md-4">
                            <small class="font-weight-bold">Harga</small>
                            <input type="number" name="price" id="price" class="form-control form-control-sm" min="0" required>
                        </div>
                        <div class="form-group col-md-4">
                            <small class="font-weight-bold">Gambar</small>
                            <input type="file" name="images" id="images" class="form-control form-control-sm" min="0">
                            <small class="form-text text-muted">Resolusi Gambar Terbaik (Lebar 240 pixel) X (Tinggi 455 pixel)</small>
                        </div>
                        <div class="form-group col-md-12">
                            <small class="font-weight-bold">Deskripsi</small>
                            <textarea name="description" id="description" class="form-control form-control-sm" style="height:150px;"></textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                <? echo form_close() ?>
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