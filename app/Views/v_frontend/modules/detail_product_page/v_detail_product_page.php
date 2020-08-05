
<?=  $this->extend('v_frontend/master_template'); ?>

<?= $this->section('content'); ?>

    <!-- product section -->
    <section class="product-section">
		<div class="container">
			<div class="back-link">
				<a href="./category.html"> &lt;&lt; Kembali Ke Halaman Utama</a>
			</div>
			<div class="row">
				<div class="col-lg-6">
					<div class="product-pic-zoom">
						<img class="product-big-img" style="width:350px;height:450px;" src="<?= $product['images'] != "" ? base_url().'/uploaded_images/'.$product['images'] : base_url().'/uploaded_images/Default-No-Photo-Available.jpg';  ?>" alt="">
					</div>
				</div>
				<div class="col-lg-6 product-details">
					<h2 class="p-title"><?= $product['product_name']; ?></h2>
					<h3 class="p-price"><?= "Rp. ".$product['price']; ?></h3>
					<h3 class="p-stock"><?= $product['stock'] > 0 ? "Produk Tersedia ( ".$product['stock']." Item)" : "Sold Out"?></span></h3>
					<div class="quantity">
						<p>Quantity</p>
                        <div class="pro-qty"><input type="text" id="quantity" value="1"></div>
                    </div>
					<button class="site-btn" onclick="buy(<?= $product['id'] ?>)">SHOP NOW</button>
					<div id="accordion" class="accordion-area">
						<div class="panel">
							<div class="panel-header" id="headingOne">
								<button class="panel-link" data-toggle="collapse" data-target="#collapse1" aria-expanded="true" aria-controls="collapse1">Deskripsi Produk</button>
							</div>
							<div id="collapse1" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
								<div class="panel-body">
									<p><?= $product['description']; ?></p>
								</div>
							</div>
						</div>
						<div class="panel">
							<div class="panel-header" id="headingThree">
								<button class="panel-link" data-toggle="collapse" data-target="#collapse3" aria-expanded="false" aria-controls="collapse3">Kebijakan Pengiriman & Pengembalian</button>
							</div>
							<div id="collapse3" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
								<div class="panel-body">
									<p>Barang dapat ditukar/dikembalikan, kecuali jika ada perjanjian sebelumnya<br>
									Untuk informasi lebih lanjut, silahkan WA 0823SXXXXXX</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- product section end -->


	<!-- RELATED PRODUCTS section -->
	<section class="related-product-section mt-3">
		<div class="container">
			<div class="section-title">
				<h2>PRODUK TERKAIT</h2>
			</div>
			<div class="product-slider owl-carousel appended-latest-product-target">
                <?php foreach($related_products as $record){ ?>
                <div class="product-item">
						<div class="pi-pic">
							<a href="<?= base_url().'/product/'.$record['id'] ?>">
								<?php
								$product_image_data = $record['images'] != "" ? base_url().'/uploaded_images/'.$record['images'] : base_url().'/uploaded_images/Default-No-Photo-Available.jpg';
								?>
								<img src="<?= $product_image_data; ?>" style="width:300px;height:400px;" alt="">
							</a>
							<div class="pi-links">
								<a href="#" class="add-card" onclick=""><i class="flaticon-bag"></i><span>ADD TO CART</span></a>
							</div>
						</div>
						<div class="pi-text">
							<h6>Rp. <?= $record['price'] ?></h6>
							<p><a href="#"><?= $record['product_name']; ?></a></p>
						</div>
				</div>
                <?php } ?>
			</div>
		</div>
	</section>
	<!-- RELATED PRODUCTS section end -->

<?= $this->endSection(); ?>

<?= $this->section('content_js'); ?>
<script>
	function buy(id){
		var quantity = $("#quantity").val()

		$.ajax({
            url : "<?= base_url().'/shoppingcart/buy'; ?>",
            headers : {'X-Requested-With': 'XMLHttpRequest'},
            method : "POST",
            data : {
                id : id,
                quantity : quantity,
				increment : true
            },
            success : function(ajaxData){
				//Refresh Total Item on Navbar
				getTotalItem()

				//Toastr
				toastr.info('Produk berhasil ditambahkan ke keranjang belanja')
            }
        });
	}
</script>
<?= $this->endSection(); ?>