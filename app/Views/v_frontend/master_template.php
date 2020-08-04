<!DOCTYPE html>
<html lang="zxx">
<head>
	<title>Kemlor Market</title>
	<meta charset="UTF-8">
	<meta name="description" content=" Kemlor Market">
	<meta name="keywords" content="Kemlor Market">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Favicon -->
	<link href="img/favicon.ico" rel="shortcut icon"/>

	<!-- Google Font -->
	<link href='https://fonts.googleapis.com/css?family=Oswald' rel='stylesheet'>
	
	<!-- <link href="https://fonts.googleapis.com/css?family=Josefin+Sans:300,300i,400,400i,700,700i" rel="stylesheet"> -->


	<!-- Stylesheets -->
	<link rel="stylesheet" href="<?= base_url(); ?>/frontend_assets/css/bootstrap.min.css"/>
	<link rel="stylesheet" href="<?= base_url(); ?>/frontend_assets/css/font-awesome.min.css"/>
	<link rel="stylesheet" href="<?= base_url(); ?>/frontend_assets/css/flaticon.css"/>
	<link rel="stylesheet" href="<?= base_url(); ?>/frontend_assets/css/slicknav.min.css"/>
	<link rel="stylesheet" href="<?= base_url(); ?>/frontend_assets/css/jquery-ui.min.css"/>
	<link rel="stylesheet" href="<?= base_url(); ?>/frontend_assets/css/owl.carousel.min.css"/>
	<link rel="stylesheet" href="<?= base_url(); ?>/frontend_assets/css/animate.css"/>
	<link rel="stylesheet" href="<?= base_url(); ?>/backend_assets/plugins/toastr/toastr.css"/>

	<link rel="stylesheet" href="<?= base_url(); ?>/frontend_assets/css/style.css"/>

	<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>
<body>
	<!-- Page Preloder -->
	<div id="preloder">
		<div class="loader"></div>
	</div>
	<header class="header-section">
		<div class="header-top">
			<div class="container">
				<div class="row">
					<div class="col-lg-2 text-center text-lg-left">
						<!-- logo -->
						<a href="<?= base_url(); ?>" class="site-logo">
							<img src="<?= base_url(); ?>/frontend_assets/img/oie_pY9byI0p2O2g.png" alt="">
						</a>
					</div>
					<div class="col-xl-6 col-lg-5">
					</div>
					<div class="col-xl-4 col-lg-5">
						<div class="user-panel">
							<div class="up-item">
								<i class="flaticon-profile"></i>
								<a href="<?= base_url('login') ?>">Sign In</a> 
							</div>
							<div class="up-item">
								<div class="shopping-card">
									<i class="flaticon-bag"></i>
									<span id="total-items-cart">0</span>
								</div>
								<a href="<?= base_url().'/shoppingcart' ?>">Shopping Cart</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<nav class="main-navbar">
			<div class="container">
				<!-- menu -->
				<ul class="main-menu">
					<li><a href="<?= base_url(); ?>">Home</a></li>
					<li><a href="#">Kategori Produk</a>
						<ul class="sub-menu">
							<?php foreach($product_categories as $record){ ?>
								<li><a href="<?= base_url().'/categoryfilter/'.$record['id']; ?>"><?= $record['category_name']; ?></a></li>
							<?php } ?>
						</ul>
					</li>
					<li><a href="<?= base_url().'/paymentconfirmation' ?>">Konfirmasi Pembayaran</a></li>
				</ul>
			</div>
		</nav>
	</header>
	<!-- Header section end -->

	<?= $this->renderSection('content'); ?>

	<!-- Footer section -->
	<section class="footer-section" style="padding-top:20px;padding-bottom:20px;">
    <div class="container">
      <div class="text-center">
        <a href="home.html"><h4 class="text-white"><b>Kemlor</b> Market</h4></a>
        <div class="social-links mt-3">
          <!-- <a href="" class="instagram"><i class="fa fa-instagram"></i><span>instagram</span></a>
          <a href="" class="facebook"><i class="fa fa-facebook"></i><span>facebook</span></a> -->
        </div>
		<p class="text-white text-center mt-3">&copy;2020 E-Commerce By <a href="https://erait.id">EraIT</a> | Template by <a href="https://colorlib.com" target="_blank">Colorlib</a> | All Right Reserved</p>
      </div>
    </div>		
	</section>
	<!-- Footer section end -->

	



	<!--====== Javascripts & Jquery ======-->
	<script src="<?= base_url(); ?>/frontend_assetsX/js/jquery-3.3.1.min.js"></script>
	<script src="<?= base_url(); ?>/frontend_assets/js/bootstrap.min.js"></script>
	<script src="<?= base_url(); ?>/frontend_assets/js/jquery.slicknav.min.js"></script>
	<script src="<?= base_url(); ?>/frontend_assets/js/owl.carousel.min.js"></script>
	<script src="<?= base_url(); ?>/frontend_assets/js/jquery.nicescroll.min.js"></script>
	<script src="<?= base_url(); ?>/frontend_assets/js/jquery.zoom.min.js"></script>
	<script src="<?= base_url(); ?>/frontend_assets/js/jquery-ui.min.js"></script>
	<script src="<?= base_url(); ?>/frontend_assets/js/main.js"></script>
	<script src="<?= base_url(); ?>/backend_assets/plugins/toastr/toastr.min.js"></script>
	
	<!-- JS Untuk Navbar -->
	<script>	
		//Loaded First
		$(function () {
			getTotalItem();
		});
		
		function getTotalItem(){
            $.ajax({
                url : "<?= base_url().'/shoppingcart/getTotalItem'; ?>",
                method : "GET",
                success : function(ajaxData){
                    //Set Total Item on Cart
					var total_item = JSON.parse(ajaxData)
					$("#total-items-cart").text(total_item);
                    
                }
            });
		}
	</script>
	<?= $this->renderSection('content_js'); ?>

	</body>
</html>
