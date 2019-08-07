<?php
    /*
     * Argyros - Página Nosotros
     * 
     */
    include( "database/init.php" );
    include( "database/bd.php" );
	include( "database/data-user.php" );
    include( "database/data-products.php" );
    include( "database/data-categories.php" );
    include( "fn/fn-product.php" );
    include( "fn/fn-catalog.php" );
    include( "fn/fn-cart.php" );
    
    checkSession( '' );
?>
<!doctype html>
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->

<!-- Mirrored from demo.designshopify.com/html_jewelry/about-us.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 12 Jul 2017 16:53:52 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
	<meta charset="UTF-8">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />
	<link rel="canonical" href="http://demo.designshopify.com/" />
	<meta name="description" content="" />
	<title>Nosotros::Argyros</title>

	<link href="assets/stylesheets/font.css" rel='stylesheet' type='text/css'>
  
	<link href="assets/stylesheets/font-awesome.min.css" rel="stylesheet" type="text/css" media="all"> 	
	<link href="assets/stylesheets/bootstrap.min.3x.css" rel="stylesheet" type="text/css" media="all">
	<link href="assets/stylesheets/cs.bootstrap.3x.css" rel="stylesheet" type="text/css" media="all">
	<link href="assets/stylesheets/cs.animate.css" rel="stylesheet" type="text/css" media="all">
	<link href="assets/stylesheets/cs.global.css" rel="stylesheet" type="text/css" media="all">
	<link href="assets/stylesheets/cs.style.css" rel="stylesheet" type="text/css" media="all">
	<link href="assets/stylesheets/cs.media.3x.css" rel="stylesheet" type="text/css" media="all">

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

	<script src="assets/javascripts/cs.script.js" type="text/javascript"></script>
	<script src="js/fn-ui.js" type="text/javascript"></script>
	<script src="js/fn-product.js" type="text/javascript"></script>
	<script src="js/fn-user.js" type="text/javascript"></script>
	<script src="js/fn-cart.js" type="text/javascript"></script>

	<style>
		#videoargyros{
			background: #e7e7e7;
			padding:15px 5px;
		}
	</style>
	
</head>

<body itemscope="" itemtype="http://schema.org/WebPage" class="templatePage notouch">
  
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
								<span class="page-title">Nosotros</span>
							</div>
						</div>
					</div>
				</div>                
				<section class="content">        
					<div class="container">
						<div class="row">
							<div id="page-header">
								<h1 id="page-title">Nosotros</h1>
							</div>
							<div id="col-main" class="col-md-24 normal-page clearfix">
								<div class="page about-us ">
									<div id="videoargyros_" align="center">
										<video width="100%" autoplay controls>
										  <source src="assets/videos/com-Argyros-hz-1920X672-90s.mp4" type="video/mp4">
											Your browser does not support the video tag.
										</video>
									</div>
									<br>
									<p>
										ARGYROS INC nace en un ambiente enérgico con la finalidad de innovar las expectativas del mercado de prendas y material semielaborado de plata ley 925,
en el continente americano, con un servicio novedoso y un equipo de personas amigables dispuestas a mejorar las actividades de los clientes.
									</p>
									
									<p>
										Con un respaldo de más de 30 años de experiencia en este rubro en Venezuela,
los socios buscan establecer una distribuidora a mayor escala para toda centro-sur América, destacando la calidad de los productos ofrecidos y la calidad del servicio tanto en la compra como en la post-venta, buscando convertirse en aliados comerciales de nuestros clientes.
									</p>
									
								</div>
							</div>
						</div>
					</div>
				</section>        
			</div>
		</div>
	</div>
	
    <?php include("sections/footer.php"); ?>

</body>