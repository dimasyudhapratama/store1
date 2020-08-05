<?=  $this->extend('v_frontend/master_template'); ?>

<?= $this->section('content'); ?>
	<!-- letest product section -->
    <section class="top-letest-product-section">
		<div class="container">
			<div class="section-title">
				<h2>PRODUK TERBARU</h2>
			</div>
			<div class="product-slider owl-carousel appended-latest-product-target">
                <?php foreach($latest_products as $record){ ?>
                <div class="product-item">
						<div class="pi-pic">
							<a href="<?= base_url().'/product/'.$record['id'] ?>">
								<?php
								$product_image_data = $record['images'] != "" ? base_url().'/uploaded_images/'.$record['images'] : base_url().'/uploaded_images/Default-No-Photo-Available.jpg';
								?>
								<img src="<?= $product_image_data; ?>" style="width:300px;height:400px;" alt="">
							</a>
							<div class="pi-links">
								<a href="#" class="add-card" onclick="addToCart(<?= $record['id'] ?>)"><i class="flaticon-bag"></i><span>ADD TO CART</span></a>
							</div>
						</div>
						<div class="pi-text">
							<h6>Rp. <?= $record['price'] ?></h6>
							<p><a href="<?= base_url().'/product/'.$record['id'] ?>"><?= $record['product_name']; ?></a></p>
						</div>
				</div>
                <?php } ?>
			</div>
		</div>
	</section>
	<!-- letest product section end -->

  <!-- Features section -->
	<section class="features-section">
		<div class="container">
			<div class="row">
				<div class="col-md-4 p-0 feature" style="background-color:#b9e0f7">
					<div class="feature-inner">
						<div class="feature-icon">
							<img src="<?= base_url(); ?>/frontend_assets/img/icons/1.png" alt="#">
						</div>
						<h2>Terpercaya</h2>
					</div>
				</div>
				<div class="col-md-4 p-0 feature" style="background-color:#009FFF">
					<div class="feature-inner">
						<div class="feature-icon">
							<img src="<?= base_url(); ?>/frontend_assets/img/icons/2.png" alt="#">
						</div>
						<h2>Produk Berkualitas</h2>
					</div>
				</div>
				<div class="col-md-4 p-0 feature" style="background-color:#b9e0f7">
					<div class="feature-inner">
						<div class="feature-icon">
							<img src="<?= base_url(); ?>/frontend_assets/img/icons/3.png" alt="#">
						</div>
						<h2>Packing Aman</h2>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Features section end -->

	<!-- Category section -->
	<section class="category-section spad">
		<div class="container">
			<div class="section-title mb-5">
				<h2>SEMUA PRODUK</h2>
			</div>
			<div class="row">
				<div class="col-lg-12  order-1 order-lg-2 mb-5 mb-lg-0">
					<div class="row appended-target">
						
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Category section end -->

<?= $this->endSection(); ?>

<?= $this->section('content_js'); ?>

<script>
	//Offset - Digunakan Untuk Paging
	var offset = 0;

	//Loaded First
	$(function () {
		//Load Products
		loadProducts();
	});


	function loadProducts(){
		$.ajax({
			url : "<?= base_url().'/landingpage/loadproducts/'; ?>"+offset,
			headers : {'X-Requested-With': 'XMLHttpRequest'},
			method : "POST",
			success : function(ajaxData){
				//Delete First Load More Button Block if exist
				if($('.load-more-button-block').length){
					$('.load-more-button-block').remove()
				}

				//JSON Parse 
				var data = JSON.parse(ajaxData)
				
				var product_image_data = ""
				var product_url_data = ""

				var product_data = ""

				for(var index in data){
					product_image_data = data[index]['images'] ? "<?= base_url().'/uploaded_images/' ?>"+data[index]['images'] : "<?= base_url().'/uploaded_images/Default-No-Photo-Available.jpg' ?>";
					product_url_data = "<?= base_url().'/product/' ?>"+data[index]['id']

					product_data = "<div class='col-lg-3 col-sm-6'>"+
						"<div class='product-item'>"+
							"<div class='pi-pic'>"+
								"<a href='"+product_url_data+"'>"+
									"<img src='"+product_image_data+"' style='width:300px;height:400px;' alt=''>"+
								"</a>"+
								"<div class='pi-links'>"+
									"<a href='#' class='add-card' onclick='addToCart("+data[index]['id']+")'><i class='flaticon-bag'></i><span>ADD TO CART</span></a>"+
								"</div>"+
							"</div>"+
							"<div class='pi-text'>"+
								"<h6>Rp. "+data[index]['price']+"</h6>"+
								"<p><a href='"+product_url_data+"'>"+data[index]['product_name']+"</a></p>"+
							"</div>"+
						"</div>";

					$(".appended-target").append(product_data);
				}

				offset+=10;

				//Laod More Products Button
				var load_more_button = 	'<div class="text-center w-100 pt-3 load-more-button-block">'+
											'<button class="site-btn sb-line sb-dark" onclick="loadProducts();">LOAD MORE</button>'+
										'</div>';

				$(".appended-target").append(load_more_button);
				
			}
		});
	}

	function addToCart(id){
		$.ajax({
            url : "<?= base_url().'/shoppingcart/buy'; ?>",
            headers : {'X-Requested-With': 'XMLHttpRequest'},
            method : "POST",
            data : {
                id : id,
                quantity : 1,
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