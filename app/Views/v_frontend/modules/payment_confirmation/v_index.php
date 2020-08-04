
<?=  $this->extend('v_frontend/master_template'); ?>

<?= $this->section('content'); ?>

	<section class="checkout-section spad">
		<div class="container">
            <div class="section-title mb-4">
				<h4>Konfirmasi Pembayaran </h4>
			</div>
			<form method="post" name="upload_form" id="upload_form" enctype="multipart/form-data">
				<div class="row">
					<div class="col-lg-8 offset-lg-2">
						<div id="alert_" class="alert alert-info alert-dismissible fade show" role="alert">
                            <b id="alert_messages_">&nbsp;</b>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
						<div class="row">
							<div class="form-group col-md-6">
								<small>Tanggal Pemesanan/Pembelian</small>
								<input type="date" name="tanggal_pemesanan" id="tanggal_pemesanan" class="form-control form-control-sm">
							</div>
							<div class="form-group col-md-6">
								<small>Bank</small>
								<select name="bank" id="bank" class="form-control form-control-sm required">
									<option value="">--Pilih--</option>
									<?php foreach($bank_accounts as $record){ ?>
									<option value="<?= $record['id']; ?>"><?= $record['bank_name'].' ( '.$record['bank_account_name'].'-'.$record['bank_account_number'].' )'; ?></option>
									<?php } ?>
								</select>
							</div>
							<div class="form-group col-md-6">
								<small>Tanggal Transfer</small>
								<input type="date" name="tanggal_transfer" id="tanggal_transfer" class="form-control form-control-sm">
							</div>
							<div class="form-group col-md-6">
								<small>Jumlah Transfer</small>
								<input type="number" name="jumlah_transfer" id="jumlah_transfer" class="form-control form-control-sm">
							</div>
							<div class="form-group col-md-6">
								<small>Bukti Transfer</small>
								<input type="file" name="bukti_transfer" id="bukti_transfer" class="form-control form-control-sm" accept="image/*">
							</div>
						</div>
						<button type="submit" class="btn btn-primary"><i></i> Kirim Bukti</button>
					</div>
				</div>
			</form>
		</div>
	</section>

<?= $this->endSection(); ?>

<?= $this->section('content_js'); ?>
	<script>
		$(function () {
			$("#alert_").hide()
		})
		$(document).ready(function() {
			$('#upload_form').on('submit', function(event) {
				event.preventDefault();
				$.ajax({
					url: "<?= base_url().'/paymentconfirmation/save' ?>",
					method: 'POST',
					data: new FormData(this),
					dataType: 'JSON',
					contentType: false,
					cache: false,
					processData: false,
					success: function(data) {
						//Empty Form
						emptyForm();

						//Alert
						$("#alert_messages_").text(data['messages']);
						$("#alert_").show();

						
					}
				});
			});
		});

		function emptyForm(){
			$("#upload_form").trigger('reset');
		}
	</script>
<?= $this->endSection(); ?>
