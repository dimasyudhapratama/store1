
<?=  $this->extend('v_frontend/master_template'); ?>

<?= $this->section('content'); ?>

<section class="cart-section" style="padding-top:50px;padding-bottom:200px;">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-12">
                    <div class="text-center">
                        <img style="width:125px;height:125px;" src="<?= base_url() ?>\frontend_assets\img\hook-1727484_960_720.webp" alt="">
                        <h4 class="mt-3">Pemesanan Anda Telah Kami Terima</h4>
                        <h6>Order ID Anda : <?= $sales_data['id'] ?></h6>
                        <h6>Selesaikan Pembayaran Untuk Menyelesaikan Transaksi</h6>
                    </div>
				</div>
            </div>
            <div class="row mt-5">
                <div class="col-lg-6">
                    <div class="p-3 rounded shadow">
                        <h6>Alamat Penerima</h6>
                        <hr>
                        <table class="table table-striped table-bordered table-sm">
                            <tr>
                                <td>Order ID</td>
                                <td>:</td>
                                <td><?= $sales_data['id'] ?></td>
                            </tr>
                            <tr>
                                <td>Tgl. Transaksi</td>
                                <td>:</td>
                                <td><?= $sales_data['transaction_time'] ?></td>
                            </tr>
                            <tr>
                                <td>Total Pembelian</td>
                                <td>:</td>
                                <td><?= "Rp. ".number_format($sales_data['price_total'],0,',','.'); ?></td>
                            </tr>
                            <tr>
                                <td>Ongkos Kirim</td>
                                <td>:</td>
                                <td><?= "Rp. ".number_format($sales_data['shipping_price'],0,',','.'); ?></td>
                            </tr>
                            <tr>
                                <td>Kode Unik</td>
                                <td>:</td>
                                <td><?= "Rp. ".number_format($sales_data['unique_code'],0,',','.'); ?></td>
                            </tr>
                            <tr>
                                <td>Jumlah Transfer</td>
                                <td>:</td>
                                <td><?= "Rp. ".number_format($sales_data['grand_total'],0,',','.'); ?></td>
                            </tr>
                            <tr>
                                <td>Kurir</td>
                                <td>:</td>
                                <td><?= $sales_data['courier'] ?></td>
                            </tr>
                            <tr>
                                <td>Alamat Lengkap</td>
                                <td>:</td>
                                <td><?= $sales_data['full_address'] ?></td>
                            </tr>
                            <tr>
                                <td>Status Transaksi</td>
                                <td>:</td>
                                <td>
                                    <?php
                                        if($sales_data['transaction_status'] == "1"){
                                            echo "Menunggu Pembayaran";
                                        }else if($sales_data['transaction_status'] == "2"){
                                            echo "Pesanan Diproses";
                                        }else if($sales_data['transaction_status'] == "3"){
                                            echo "Barang Dikirim";
                                        }
                                    ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="p-3 rounded shadow">
                        <h6>Rekening Pembayaran</h6>
                        <hr>
                        <div class="m-3">
                            <ol>
                                <li>Lakukan pembayaran di no. rek di bawah ini <b>(NB. Jumlah Pembayaran Harus Sesuai)</b></li>
                                <li>Lakukan Konfirmasi Melalui Menu <a href="<?= base_url().'/paymentconfirmation' ?>">Konfirmasi Pembayaran</a></li>
                                <li>Atau Melalui Whatsapp 08XXXXXXXXXXX</li>
                            </ol>
                        </div>
                        
                        <table class="table table-striped table-bordered table-sm">
                            <thead>
                                <tr>
                                    <td>Nama Bank</td>
                                    <td>Atas Nama - No. Rekening</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($bank_accounts as $record){ ?>
                                <tr>
                                    <td><?= $record['bank_name']; ?></td>
                                    <td><?= $record['bank_account_name'].' - '.$record['bank_account_number']; ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
			</div>
		</div>
	</section>

<?= $this->endSection(); ?>