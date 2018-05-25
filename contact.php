<?php
    /*
     * Argyros - Página Nosotros
     * 
     */
    session_start();
    ini_set( 'display_errors', 1 );
    include( "database/bd.php" );
	include( "database/data-user.php" );
    include( "database/data-products.php" );
    include( "database/data-categories.php" );
    include( "fn/fn-product.php");
    include( "fn/fn-catalog.php" );
    include( "fn/fn-cart.php" );
    
    checkSession( '' );
?>
<!doctype html>
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->

<!-- Mirrored from demo.designshopify.com/html_jewelry/contact.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 12 Jul 2017 16:53:58 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
  <meta charset="UTF-8">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />
  <link rel="canonical" href="http://demo.designshopify.com/" />
  <meta name="description" content="" />
  <title>Contacto::Argyros</title>
  
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
	
	<script src="http://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script>
	<script src="assets/javascripts/jquery.gmap.min.js" type="text/javascript"></script>
	<script src="js/fn-product.js" type="text/javascript"></script>
	<script src="js/fn-cart.js" type="text/javascript"></script>

	<style>
		#contact-form{
			margin: 0 5px;
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
								<span class="page-title">Contacto</span>
							</div>
						</div>
					</div>
				</div>               
				<section class="content">    
					<div class="container">
						<div class="row">
							<div id="page-header">
								<h1 id="page-title">Contacto</h1>
							</div>
						</div>
					</div>
					<div id="col-main" class="contact-page clearfix">
						<div class="group-contact clearfix">
							<div class="container">
								<div class="row">
									<div class="left-block col-md-12">
										<form method="post" action="http://demo.designshopify.com/contact" class="contact-form" accept-charset="UTF-8">
											<input type="hidden" value="contact" name="form_type"><input type="hidden" name="utf8" value="✓">
											<ul id="contact-form" class="row list-unstyled">
												<li class="">
												<h3>Déjanos tus datos</h3>
												</li>
												<li class="">
												<label class="control-label" for="name">Nombre </label>
												<input type="text" id="name" value="" class="form-control" name="contact[name]">
												</li>
												<li class="clearfix"></li>
												<li class="">
												<label class="control-label" for="email">Email <span class="req">*</span></label>
												<input type="email" id="email" value="" class="form-control email" name="contact[email]">
												</li>
												<li class="clearfix"></li>
												<li class="">
												<label class="control-label" for="message">Mensaje <span class="req">*</span></label>
												<textarea id="message" rows="4" class="form-control" name="contact[body]" style="resize:none; overflow:hidden;"></textarea>
												</li>
												<li class="clearfix"></li>
												<li class="unpadding-top">
												<button type="submit" class="btn">Enviar</button>
												</li>
											</ul>
										</form>
									</div>
									<div class="right-block contact-content col-md-12">
										<h6 class="sb-title"><i class="fa fa-home"></i>Información de contacto</h6>
										<ul class="right-content">
											<!-- <li class="title"> <h6>Dirección</h6> </li> -->
											<li class="address">
											<p>
												Final calle 15, Edificio Silver Crown, local 2, Zona Libre de Colón. República de Panamá.
											</p>
											</li>

											<div>
												<li class="phone"><i class="fa fa-phone"></i> (+507) 447 3175 / (+507) 447 2774 </li>
											</div>
											<div>
												<li class="phone">
													<img src="assets/images/whatsapp.png" width="15" style="margin-right: 10px;">(+507) 6678-9111 / (+507) 6278-5100
												</li>
											</div>

											<li class="email"><i class="fa fa-envelope"></i> info@argyros.com.pa</li>
										</ul>
										<ul class="right-content">
											<li class="title">
											<h6>Síguenos</h6>
											</li>
											<li class="facebook"><a href="https://www.facebook.com/ArgyrosInc"><span class="fa-stack fa-lg btooltip" title="" data-original-title="Facebook"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-facebook fa-inverse fa-stack-1x"></i></span></a></li>
											<li class="twitter"><a href="https://twitter.com/argyrosinc"><span class="fa-stack fa-lg btooltip" title="Twitter" data-original-title="Twitter"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-twitter fa-inverse fa-stack-1x"></i></span></a></li>
											<li class="pinterest"><a href="https://www.instagram.com/argyrosinc/"><span class="fa-stack fa-lg btooltip" title="Instagram" data-original-title="Instagram"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-instagram fa-inverse fa-stack-1x"></i></span></a></li>
											<li class="google-plus"><a href="https://www.youtube.com/channel/UCBEG8W6oNxHoxJAIWl43DFg"><span class="fa-stack fa-lg btooltip" title="You Tube" data-original-title="You Tube"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-youtube fa-inverse fa-stack-1x"></i></span></a></li>
										</ul>
									</div>
								</div>
							</div>
							<div id="contact_map_wrapper">
								<div id="contact_map" class="map"></div>
								<script>
								jQuery(document).ready(function($) {
									if(jQuery().gMap){
										if($('#contact_map').length){
										  $('#contact_map').gMap({
											zoom: 17,
											scrollwheel: false,
											maptype: 'ROADMAP',
											markers:[{
												latitude: 9.354224,
												longitude: -79.891181,
												html: "Edificio Silver Crown, local 2, Zona Libre de Colón, Panamá"

											}]
										  });
										}
									}
								});
								</script>
							</div>
						</div>
					</div> 
				</section>        
			</div>
		</div>
	</div>
	
	<!-- Footer -->
	<?php include("sections/footer.php"); ?>

</body>