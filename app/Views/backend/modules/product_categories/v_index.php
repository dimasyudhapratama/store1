<?=  $this->extend('backend/master_template'); ?>

<?= $this->section('content'); ?>


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Kategori Produk</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
              <li class="breadcrumb-item active">Kategori Produk</li>
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
                <a href="<?= base_url('backend/productcategories/add') ?>" class="btn btn-sm btn-primary mb-1"><i class="fa fa-plus"></i> Tambah Kategori Produk Baru</a>
                <table id="example1" class="table table-sm table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Kategori</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no= 1; 
                        foreach($product_categories as $record){ 
                        ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $record['category_name']; ?></td>
                            <td class="text-center">
                                <button class="btn btn-success btn-sm dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Aksi
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                    <a class="dropdown-item" href="<?= base_url('backend/productcategories/edit').'/'.$record['id'] ?>">Edit</a>
                                    <a class="dropdown-item" href="<?= base_url('backend/productcategories/delete').'/'.$record['id'] ?>" onclick="return confirm('Apakah Anda Yakin Untuk Menghapus Data Kategori Produk?')">Delete</a>
                                </div>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
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