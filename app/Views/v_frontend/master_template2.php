<!DOCTYPE html>
    <html lang="zxx" class="no-js">
    <head>
        <!-- Mobile Specific Meta -->
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Favicon-->
        <link rel="shortcut icon" href="img/fav.png">
        <!-- Author Meta -->
        <meta name="author" content="CodePixar">
        <!-- Meta Description -->
        <meta name="description" content="">
        <!-- Meta Keyword -->
        <meta name="keywords" content="">
        <!-- meta character set -->
        <meta charset="UTF-8">
        <!-- Site Title -->
        <title>Shop</title>

        <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet"> 
            <!--
            CSS
            ============================================= -->
            <link rel="stylesheet" href="<?= base_url() ?>/frontend_assets/css/linearicons.css">
            <link rel="stylesheet" href="<?= base_url() ?>/frontend_assets/css/owl.carousel.css">            
            <link rel="stylesheet" href="<?= base_url() ?>/frontend_assets/css/font-awesome.min.css">
            <link rel="stylesheet" href="<?= base_url() ?>/frontend_assets/css/nice-select.css">
			<link rel="stylesheet" href="<?= base_url() ?>/frontend_assets/css/nouislider.min.css">
            <link rel="stylesheet" href="<?= base_url() ?>/frontend_assets/css/bootstrap.css">
            <link rel="stylesheet" href="<?= base_url() ?>/frontend_assets/css/main.css">
        </head>
        <body>

            <!-- Start Header Area -->
            <header class="default-header">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <div class="container">
                          <a class="navbar-brand" href="index.html">
                            <img src="img/logo.png" alt="">
                          </a>
                          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                          </button>
                          <div class="collapse navbar-collapse justify-content-end align-items-center" id="navbarSupportedContent">
                            <ul class="navbar-nav">
                                <li><a href="#home">Home</a></li>
                                <!-- Dropdown -->
                                <li class="dropdown">
                                    <a class="dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Kategori Produk</a>
                                    <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#">Kategori 1</a>
                                    <a class="dropdown-item" href="#">Kategori 1</a>
                                    </div>
                                </li>    
                                <li><a href="#cart" alt="Keranjang Belanja"><i class="fa fa-shopping-cart"></i></a></li>
                                <li><a href="#catagory"><i class="fa fa-sign-in"></i></a></li>                                   
                            </ul>
                          </div>                        
                    </div>
                </nav>
            </header>
            <!-- End Header Area -->

            <!-- Content -->
            <?= $this->renderSection('content') ?>
            <!-- Content -->



            <!-- start footer Area -->      
            <footer class="footer-area">
                <div class="container text-center">
                    <p class="footer-text m-0" style="margin-bottom:50px;">Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a></p>

                </div>
            </footer>   
            <!-- End footer Area -->       

 

            <script src="<?= base_url() ?>/frontend_assets/js/vendor/jquery-2.2.4.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
            <script src="<?= base_url() ?>/frontend_assets/js/vendor/bootstrap.min.js"></script>
            <script src="<?= base_url() ?>/frontend_assets/js/jquery.ajaxchimp.min.js"></script>
            <script src="<?= base_url() ?>/frontend_assets/js/jquery.nice-select.min.js"></script>
            <script src="<?= base_url() ?>/frontend_assets/js/jquery.sticky.js"></script>
			<script src="<?= base_url() ?>/frontend_assets/js/nouislider.min.js"></script>
            <script src="<?= base_url() ?>/frontend_assets/js/jquery.magnific-popup.min.js"></script>
            <script src="<?= base_url() ?>/frontend_assets/js/owl.carousel.min.js"></script>            
            <script src="<?= base_url() ?>/frontend_assets/js/main.js"></script>  
        </body>
    </html>
