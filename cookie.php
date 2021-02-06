<?php
    /*
    * Argyros - Página de carrito de compra
    * 
    */
    session_start();
    ini_set( 'display_errors', 1 );
    include( "database/bd.php" );
	include( "database/data-user.php" );
    include( "database/data-products.php" );
    include( "database/data-categories.php" );
    include( "fn/fn-product.php" );
    include( "fn/fn-catalogue.php" );
    include( "fn/fn-cart.php" );
    
    

    //setcookie( "carrito", "cookie_value", time()+30 );  /* expira en 1 hora */
    //imprimirCarrito();
    //checkSession( '' );
    //print_r($detalle);
?>
<!doctype html>
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->

<!-- Mirrored from demo.designshopify.com/html_jewelry/cart.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 12 Jul 2017 16:54:10 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
  <meta charset="UTF-8">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />
  <link rel="canonical" href="http://demo.designshopify.com/" />
  <meta name="description" content="" />
  <title>Carrito</title>
  
    <link href="assets/stylesheets/font.css" rel='stylesheet' type='text/css'>
  
	<link href="assets/stylesheets/font-awesome.min.css" rel="stylesheet" type="text/css" media="all"> 
	<link href="assets/stylesheets/jquery.camera.css" rel="stylesheet" type="text/css" media="all">
	<link href="assets/stylesheets/jquery.fancybox-buttons.css" rel="stylesheet" type="text/css" media="all">
	<link href="assets/stylesheets/cs.animate.css" rel="stylesheet" type="text/css" media="all">
	<link href="assets/stylesheets/application.css" rel="stylesheet" type="text/css" media="all">
	<link href="assets/stylesheets/swatch.css" rel="stylesheet" type="text/css" media="all">
	<link href="assets/stylesheets/jquery.owl.carousel.css" rel="stylesheet" type="text/css" media="all">
	<link href="assets/stylesheets/jquery.bxslider.css" rel="stylesheet" type="text/css" media="all">
	<link href="assets/stylesheets/bootstrap.min.3x.css" rel="stylesheet" type="text/css" media="all">
	<link href="assets/stylesheets/cs.bootstrap.3x.css" rel="stylesheet" type="text/css" media="all">
	<link href="assets/stylesheets/cs.global.css" rel="stylesheet" type="text/css" media="all">
	<link href="assets/stylesheets/cs.style.css" rel="stylesheet" type="text/css" media="all">
	<link href="assets/stylesheets/cs.media.3x.css" rel="stylesheet" type="text/css" media="all">
	<link href="assets/stylesheets/spr.css" rel="stylesheet" type="text/css" media="all">
	<link href="assets/stylesheets/addthis.css" rel="stylesheet" type="text/css" media="all">
	<link href="assets/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" media="all">
	<!--<link href="assets/tooltips/css/tooltipster.bundle.min.css" rel="stylesheet" type="text/css" media="all">
	<link href="assets/tooltips/css/plugins/tooltipster/sideTip/themes/tooltipster-sideTip-shadow.min.css" rel="stylesheet" type="text/css" media="all">
	<link href="assets/tooltips/css/plugins/tooltipster/sideTip/themes/tooltipster-sideTip-noir.min.css" rel="stylesheet" type="text/css" media="all">-->


	<script src="assets/javascripts/jquery-1.9.1.min.js" type="text/javascript"></script>
	<script src="assets/javascripts/jquery.imagesloaded.min.js" type="text/javascript"></script>
	<script src="assets/javascripts/bootstrap.min.3x.js" type="text/javascript"></script>
	<script src="assets/javascripts/jquery.easing.1.3.js" type="text/javascript"></script>
	<script src="assets/javascripts/jquery.camera.min.js" type="text/javascript"></script>
	<script src="assets/javascripts/jquery.mobile.customized.min.js" type="text/javascript"></script>
	<script src="assets/javascripts/cookies.js" type="text/javascript"></script>
	<script src="assets/javascripts/modernizr.js" type="text/javascript"></script>  
	<script src="assets/javascripts/application.js" type="text/javascript"></script>
	<script src="assets/javascripts/jquery.owl.carousel.min.js" type="text/javascript"></script>
	<script src="assets/javascripts/jquery.bxslider.js" type="text/javascript"></script>
	<script src="assets/javascripts/skrollr.min.js" type="text/javascript"></script>
	<script src="assets/javascripts/jquery.fancybox-buttons.js" type="text/javascript"></script>
	<script src="assets/javascripts/jquery.zoom.js" type="text/javascript"></script>	
	<script src="assets/javascripts/cs.script.js" type="text/javascript"></script>
	<!-- Tooltips -->
	<script src="assets/tooltips/js/tooltipster.bundle.min.js" type="text/javascript"></script>
	
	<script src="js/fn-ui.js" type="text/javascript"></script>
	<script src="js/fn-user.js" type="text/javascript"></script>
	<script src="js/fn-product.js" type="text/javascript"></script>
	<script src="js/fn-cart.js" type="text/javascript"></script>
	<style>
		.cart-qty-group{ border: 0; }
		#label-msgs, .toggle_elim_item_cart{ display: none; }
		.icon-msg{ float: left; margin-right: 10px; }
		.confirm_itemcart{ color: red; }
		
		@media (max-width: 1024px){
			#tabla_carrito_compra tr, #tabla_carrito_compra td{
				display:block;
			}
		}

		.cart-qty-group tr {
		    border-bottom: 0 !important;
		}
	</style>
</head>

<body itemscope="" itemtype="http://schema.org/WebPage" class="templateCart notouch">
  
	<!-- Header -->
	<?php include( "sections/header.php" ); ?>
  
	<div id="content-wrapper-parent">
		<div id="content-wrapper">  
			<!-- Content -->
			<div id="content" class="clearfix">                
				<div id="breadcrumb" class="breadcrumb">
					<div itemprop="breadcrumb" class="container">
						<div class="row">
							<div class="col-md-24">
								<a href="index.php" class="homepage-link" title="Back to the frontpage">Inicio</a>
								<span>/</span>
								<span class="page-title">Carrito</span>
							</div>
						</div>
					</div>
				</div>        
                
				<section class="content">
					<div class="container">
						<div class="row">
							
							<div id="page-header" class="col-md-12">
								<h1 id="page-title">Carrito de compra</h1>
							</div>
							<div id="page-header" class="col-md-12">
								<?php include( "sections/label-msg.html" ); ?>
							</div>
							<div id="col-main" class="col-md-24 cart-page content">
								<?php if( isset( $_COOKIE["user"] ) )
							    	echo "COOKIE USER";
							    else {echo "NO COOKIES"; } ?>
							</div>
						</div>
					</div>
				</section>        
			</div>
		</div>
	</div>
	<?php include("sections/footer.php");?>
  </body>