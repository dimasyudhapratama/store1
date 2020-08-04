<?=  $this->extend('backend/master_template'); ?>

<?= $this->section('content'); ?>


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h5>Tambah Pengguna</h5>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
              <li class="breadcrumb-item"><a href="<?= base_url('backend/users'); ?>">Pengguna</a></li>
              <li class="breadcrumb-item active">Tambah Pengguna</li>
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
                <?php echo form_open('backend/users/save') ?>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <small class="font-weight-bold">Nama Terang</small>
                            <input type="text" name="nickname" id="nickname" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group col-md-3">
                            <small class="font-weight-bold">Username (Login)</small>
                            <input type="text" name="username" id="username" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group col-md-3">
                            <small class="font-weight-bold">Level</small>
                            <select name="level" id="level" class="form-control form-control-sm" required>
                              <option value="Admin">Admin</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                          <hr>
                        </div>
                        <div class="form-group col-md-3">
                            <small class="font-weight-bold">Password</small>
                            <input type="password" name="password_" id="password_" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group col-md-3">
                            <small class="font-weight-bold">Ulangi Password</small>
                            <input type="password" name="repassword_" id="repassword_" class="form-control form-control-sm" required>
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