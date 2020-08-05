<?=  $this->extend('v_frontend/master_template'); ?>

<?= $this->section('content'); ?>

	<!-- Page info -->
	<div class="page-top-info">
		<div class="container">
			<h4><?= $product_category_name; ?></h4>
			<div class="site-pagination">
				<a href="<?= base_url(); ?>">Home</a> /
				<a href="#">Kategori Produk</a> /
				<a href="#"><?= $product_category_name; ?></a>
			</div>
		</div>
	</div>
	<!-- Page info end -->

    <!-- Category section -->
	<section class="category-section mt-5 mb-4">
		<div class="container">
            <div class="section-title mb-3">
				<h4>Menampilkan Produk Untuk <?= $product_category_name; ?></h4>
                <p>(<?= $product_total; ?>) Produk Ditemukan</p>
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
        // alert(window.location.href)
	});


	function loadProducts(){
		$.ajax({
			url : "<?= base_url().'/ProductByCategory/loadproducts'; ?>",
			headers : {'X-Requested-With': 'XMLHttpRequest'},
            method : "POST",
            data : {
                url_data : window.location.href,
                offset : offset
            },
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
									"<img src='"+product_image_data+"' style='width:350px;height:350px;' alt=''>"+
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