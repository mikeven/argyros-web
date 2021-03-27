<?php
    /*
    * Argyros - Página de inicio
    * 
    */
     
    include( "database/init.php" );
    include( "database/bd.php" );
	include( "database/data-user.php" );
    include( "database/data-products.php" );
    include( "database/data-categories.php" );
    include( "fn/fn-product.php" );
    include( "fn/fn-catalogue.php" );
    include( "fn/fn-cart.php" );
  
    //checkSession( '' );
    $cdestacadas = obtenerCategoriasDestacadas( $dbh );
    $pdestacados = obtenerProductosDestacados( $dbh, $cdestacadas );

?>
<!doctype html>
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
<head>
  <meta charset="UTF-8">

  <meta name="servername" content="SolucionesXYZ">
  <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
  <meta name="google-site-verification" content="uMXohbTO1Kgmqq8PSaGTjxNPfuUZxLmcIbZ2cSFhDWI" />
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />
  <link rel="canonical" href="https://www.argyros.com.pa/" />
  <meta name="description" content="Distribuidor de platería"/>
  <meta property="og:image" content="https://www.argyros.com.pa/assets/images/a-image.png">
  <meta name="keywords" content="Argyros, Distribuidor, Platería"/>
  <link rel="icon" type="image/png" href="https://www.argyros.com.pa/assets/images/afavicon.png">
  <title>Argyros, Inc.</title>
  
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
	
	<script src="assets/javascripts/jquery-1.9.1.min.js" type="text/javascript"></script>
	<script src="assets/javascripts/jquery.imagesloaded.min.js" type="text/javascript"></script>
	<script src="assets/javascripts/bootstrap.min.3x.js" type="text/javascript"></script>
	<script src="assets/javascripts/jquery.easing.1.3.js" type="text/javascript"></script>
	<script src="assets/javascripts/jquery.camera.min.js" type="text/javascript"></script>	
	<script src="assets/javascripts/cookies.js" type="text/javascript"></script>
	<script src="assets/javascripts/modernizr.js" type="text/javascript"></script>  
	<script src="assets/javascripts/application.js" type="text/javascript"></script>
	<script src="assets/javascripts/jquery.owl.carousel.min.js" type="text/javascript"></script>
	<script src="assets/javascripts/jquery.bxslider.js" type="text/javascript"></script>
	<script src="assets/javascripts/skrollr.min.js" type="text/javascript"></script>
	<script src="assets/javascripts/jquery.fancybox-buttons.js" type="text/javascript"></script>
	<script src="assets/javascripts/jquery.zoom.js" type="text/javascript"></script>	
	<script src="assets/javascripts/cs.script.js" type="text/javascript"></script>
	
	<script src="js/fn-ui.js" type="text/javascript"></script>
	<script src="js/fn-user.js" type="text/javascript"></script>
	<script src="js/fn-product.js" type="text/javascript"></script>
	<script src="js/fn-cart.js" type="text/javascript"></script>

	<?php include( "fn/ga.php" ); ?>

	<style>
      .collection-details img{
        max-width: 100% !important;
      }
      .newsletter-popup{
      	padding: 30px;
      }

      #content-wrapper-parent{ margin-top: 0px; }
    </style>
</head>

<body class="templateIndex notouch">
  
	<!-- Header -->
	<?php include( "sections/header.php" );?>
  
    <div id="content-wrapper-parent">
        <div id="content-wrapper">  
			<!-- Main Slideshow -->
			<div class="home-slider-wrapper clearfix">
				<div class="camera_wrap" id="home-slider">
					<div data-src="assets/images/IMG_2042.jpg">
						<div class="camera_caption camera_title_1 fadeIn" style="left:-240px;">
						  <a href="categories.php" style="color:#010101;" class="hidden-xs">Distribuidor de Platería</a>
						</div>
						<div class="camera_caption camera_caption_1 fadeIn" style="color: rgb(1, 1, 1); left:-240px;">
							Consulta nuestros productos
						</div>
						<div class="camera_cta_1">
							<a href="categories.php" class="btn">VER CATÁLOGO</a>
						</div>
					</div>
					<div data-src="assets/images/IMG_2022.jpg"> </div>
					<div data-src="assets/images/IMG_0927.jpg"> </div>
				</div>
			</div> 
			<!-- Content -->
			<div id="content" class="clearfix">                       
				<section class="content">  
					<div id="col-main" class="clearfix">
						<div class="home-popular-collections">
							<div class="container">
								<div class="group_home_collections row">
									<div class="col-md-24">
										<div class="home_collections">
											<h6 class="general-title">CATEGORÍAS DESTACADAS</h6>
											<div class="home_collections_wrapper">												
												<div id="home_collections">
													<div class="home_collections_item">
														<div class="home_collections_item_inner">
															<div class="collection-details">
																<a href="<?php echo URLBASECAT?>?c=<?php echo $cdestacadas[0]["uname"]?>" title="<?php echo $cdestacadas[0]["name"]?>">
																<?php if ( $cdestacadas[0]["image"] != "" ) { ?>
																	<img src="assets/images/<?php echo $cdestacadas[0]["image"]?>" alt="<?php echo $cdestacadas[0]["name"]?>">
																<?php } else { ?>
																	<img src="assets/images/4_large.png" alt="<?php echo $cdestacadas[0]["name"]?>">
																<?php } ?>
																</a>
															</div>
															<div class="hover-overlay">
																<span class="col-name"><a href="<?php echo URLBASECAT?>?c=<?php echo $cdestacadas[0]["uname"]?>">
																	<?php echo $cdestacadas[0]["name"]?></a>
																</span>
																<div class="collection-action hidden">
																	<a href="<?php echo URLBASECAT?>?c=<?php echo $cdestacadas[0]["uname"]?>">VER CATÁLOGO</a>
																</div>
															</div>
														</div>
													</div>
													<div class="home_collections_item">
														<div class="home_collections_item_inner">
															<div class="collection-details">
																<a href="<?php echo URLBASECAT?>?c=<?php echo $cdestacadas[1]["name"]?>" title="<?php echo $cdestacadas[1]["name"]?>">
																<?php if ( $cdestacadas[1]["image"] != "" ) { ?>
																	<img src="assets/images/<?php echo $cdestacadas[1]["image"]?>" alt="<?php echo $cdestacadas[0]["name"]?>">
																<?php } else { ?>
																	<img src="assets/images/4_large.png" alt="<?php echo $cdestacadas[1]["name"]?>">
																<?php } ?>
																</a>
															</div>
															<div class="hover-overlay">
																<span class="col-name"><a href="<?php echo URLBASECAT?>?c=<?php echo $cdestacadas[1]["uname"]?>"><?php echo $cdestacadas[1]["name"]?></a></span>
																<div class="collection-action hidden">
																	<a href="<?php echo URLBASECAT?>?c=<?php echo $cdestacadas[1]["uname"]?>">VER CATÁLOGO</a>
																</div>
															</div>
														</div>
													</div>
													<div class="home_collections_item">
														<div class="home_collections_item_inner">
															<div class="collection-details">
																<a href="<?php echo URLBASECAT?>?c=<?php echo $cdestacadas[2]["uname"]?>" title="<?php echo $cdestacadas[2]["name"]?>">
																<?php if ( $cdestacadas[2]["image"] != "" ) { ?>
																	<img src="assets/images/<?php echo $cdestacadas[2]["image"]?>" alt="<?php echo $cdestacadas[0]["name"]?>">
																<?php } else { ?>
																	<img src="assets/images/4_large.png" alt="<?php echo $cdestacadas[2]["name"]?>">
																<?php } ?>
																</a>
															</div>
															<div class="hover-overlay">
																<span class="col-name"><a href="<?php echo URLBASECAT?>?c=<?php echo $cdestacadas[2]["uname"]?>"><?php echo $cdestacadas[2]["name"]?></a></span>
																<div class="collection-action hidden">
																	<a href="<?php echo URLBASECAT?>?c=<?php echo $cdestacadas[2]["uname"]?>">VER CATÁLOGO</a>
																</div>
															</div>
														</div>
													</div>
													<div class="home_collections_item">
														<div class="home_collections_item_inner">
															<div class="collection-details">
																<a href="<?php echo URLBASECAT?>?c=<?php echo $cdestacadas[3]["uname"]?>" title="<?php echo $cdestacadas[3]["name"]?>">
																<?php if ( $cdestacadas[3]["image"] != "" ) { ?>
																	<img src="assets/images/<?php echo $cdestacadas[3]["image"]?>" alt="<?php echo $cdestacadas[0]["name"]?>">
																<?php } else { ?>
																	<img src="assets/images/4_large.png" alt="<?php echo $cdestacadas[3]["name"]?>">
																<?php } ?>
																</a>
															</div>
															<div class="hover-overlay">
																<span class="col-name"><a href="<?php echo URLBASECAT?>?c=<?php echo $cdestacadas[3]["uname"]?>"><?php echo $cdestacadas[3]["name"]?></a></span>
																<div class="collection-action hidden">
																	<a href="<?php echo URLBASECAT?>?c=<?php echo $cdestacadas[3]["uname"]?>">VER CATÁLOGO</a>
																</div>
															</div>
														</div>
													</div>
													</div>													
												</div>
											</div>
										</div>
										<script>
										  $(document).ready(function() {
											$('.collection-details').hover(
											  function() {
												$(this).parent().addClass("collection-hovered");
											  },
											  function() {
											  $(this).parent().removeClass("collection-hovered");
											  });
										  });
										</script>
									</div>
								</div>
						</div>
						<div class="home-newproduct">
							<div class="container">
								<div class="group_home_products row">
									<div class="col-md-24">
										<div class="home_products_argyros">
											<h6 class="general-title">PRODUCTOS NUEVOS</h6>
											<div class="home_products_wrapper">
												<div id="home_products">
													<?php $img1 = obtenerImagenProducto( $dbh, $pdestacados[0]["id"] ); ?>
													<div class="element no_full_width col-md-6 col-sm-6 not-animated" 
														data-animate="fadeInUp" data-delay="0">
														<ul class="row-container list-unstyled clearfix">
															<li class="row-left">
															<a href="product.php?id=<?php echo $pdestacados[0]["id"]?>" class="container_item">
																<img src="<?php echo $purl.$img1[0]["image"] ?>" class="img-responsive" alt="<?php echo $pdestacados[0]["name"]?>">
																<span class="sale_banner">
																	
																</span>
															</a>
															<!-- hbw -->
															</li>
															<li class="row-right parent-fly animMix">
															<div class="product-content-left">
																<a class="title-5" href="product.php?id=<?php echo $pdestacados[0]["id"]?>">
																	<?php echo $pdestacados[0]["name"]?>
																</a>
																<span class="spr-badge" id="spr_badge_12932382113" data-rating="0.0">
																<span class="spr-starrating spr-badge-starrating">
																	<i class="spr-icon spr-icon-star-empty" style=""></i>
																	<i class="spr-icon spr-icon-star-empty" style=""></i>
																	<i class="spr-icon spr-icon-star-empty" style=""></i>
																	<i class="spr-icon spr-icon-star-empty" style=""></i>
																	<i class="spr-icon spr-icon-star-empty" style=""></i>
																</span>
																<span class="spr-badge-caption">
																No reviews </span>
																</span>
															</div>
															<!--
															<div class="product-content-right">
																<div class="product-price hidden">
																	<span class="price_sale">$25.00</span>
																	<del class="price_compare"> $30.00</del>
																</div>
															</div>
															-->
															<div class="list-mode-description">
																 <?php echo $pdestacados[0]["description"]?>
															</div>
															<!-- hover-appear -->
															
															</li>
														</ul>
													</div>
													<?php $img2 = obtenerImagenProducto( $dbh, $pdestacados[1]["id"] ); ?>                
													<div class="element no_full_width col-md-6 col-sm-8 not-animated" data-animate="fadeInUp" data-delay="1">
														<ul class="row-container list-unstyled clearfix">
															<li class="row-left">
															<a href="product.php?id=<?php echo $pdestacados[1]["id"]; ?>" class="container_item">
																<img src="<?php echo $purl.$img2[0]["image"] ?>" class="img-responsive" 
																alt="<?php echo $pdestacados[1]["name"]; ?>">
															</a>
															<!-- hbw -->
															</li>
															<li class="row-right parent-fly animMix">
															<div class="product-content-left">
																<a class="title-5" href="product.php?id=<?php echo $pdestacados[1]["id"]?>">
																	<?php echo $pdestacados[1]["name"]?>
																</a>
																<span class="spr-badge" id="spr_badge_12932396193" data-rating="0.0">
																	<span class="spr-starrating spr-badge-starrating">
																		<i class="spr-icon spr-icon-star-empty" style=""></i>
																		<i class="spr-icon spr-icon-star-empty" style=""></i>
																		<i class="spr-icon spr-icon-star-empty" style=""></i>
																		<i class="spr-icon spr-icon-star-empty" style=""></i>
																		<i class="spr-icon spr-icon-star-empty" style=""></i>
																	</span>
																<span class="spr-badge-caption">
																No reviews </span>
																</span>
															</div>
															<div class="product-content-right">
																<div class="product-price hidden">
																	<span class="price">
																	$20.00 </span>
																</div>
															</div>
															<div class="list-mode-description">
																<?php echo $pdestacados[1]["description"]?>
															</div>
															<!-- hover-appear -->
															</li>
														</ul>
													</div>
													<?php $img3 = obtenerImagenProducto( $dbh, $pdestacados[2]["id"] ); ?>
													<div class="element no_full_width col-md-6 col-sm-6 not-animated" data-animate="fadeInUp" data-delay="2">
														<ul class="row-container list-unstyled clearfix">
															<li class="row-left">
															<a href="product.php?id=<?php echo $pdestacados[2]["id"]?>" class="container_item">
																<img src="<?php echo $purl.$img3[0]["image"] ?>" class="img-responsive" alt="<?php $pdestacados[2]["name"]?>">
																<span class="sale_banner"> </span>
															</a>
															<!-- hbw -->
															</li>
															<li class="row-right parent-fly animMix">
															<div class="product-content-left">
																<a class="title-5" href="product.php?id=<?php echo $pdestacados[2]["id"]?>">
																	<?php echo $pdestacados[2]["name"]?>
																</a>
																<span class="spr-badge" id="spr_badge_12932369312" data-rating="4.0">
																	<span class="spr-starrating spr-badge-starrating">
																		<i class="spr-icon spr-icon-star" style=""></i>
																		<i class="spr-icon spr-icon-star" style=""></i>
																		<i class="spr-icon spr-icon-star" style=""></i>
																		<i class="spr-icon spr-icon-star" style=""></i>
																		<i class="spr-icon spr-icon-star-empty" style=""></i>
																	</span>
																	<span class="spr-badge-caption"> 1 review </span>
																</span>
															</div>
															<div class="product-content-right">
																<div class="product-price hidden">
																	<span class="price_sale">$25.00</span>
																	<del class="price_compare"> $30.00</del>
																</div>
															</div>
															<div class="list-mode-description">
																<?php echo $pdestacados[2]["description"]?>
															</div>
															<!-- hover-appear -->
															</li>
														</ul>
													</div>
													<?php $img4 = obtenerImagenProducto( $dbh, $pdestacados[3]["id"] ); ?>
													<div class="element no_full_width col-md-6 col-sm-6 not-animated" data-animate="fadeInUp" data-delay="2">
														<ul class="row-container list-unstyled clearfix">
															<li class="row-left">
															<a href="product.php?id=<?php echo $pdestacados[3]["id"]?>" class="container_item">
															<img src="<?php echo $purl.$img4[0]["image"] ?>" class="img-responsive" alt="Donec aliquam ante non">
															<span class="sale_banner">
															
															</span>
															</a>
															<!-- hbw -->
															</li>
															<li class="row-right parent-fly animMix">
															<div class="product-content-left">
																<a class="title-5" href="product.php?id=<?php echo $pdestacados[3]["id"]?>">
																	<?php echo $pdestacados[3]["name"]; ?>
																</a>
																<span class="spr-badge" id="spr_badge_12932369312" data-rating="4.0">
																<span class="spr-starrating spr-badge-starrating">
																	<i class="spr-icon spr-icon-star" style=""></i>
																	<i class="spr-icon spr-icon-star" style=""></i>
																	<i class="spr-icon spr-icon-star" style=""></i>
																	<i class="spr-icon spr-icon-star" style=""></i>
																	<i class="spr-icon spr-icon-star-empty" style=""></i>
																</span>
																<span class="spr-badge-caption">
																1 review </span>
																</span>
															</div>
															<div class="product-content-right">
																<div class="product-price hidden">
																	<span class="price_sale">$25.00</span>
																	<del class="price_compare"> $30.00</del>
																</div>
															</div>
															<div class="list-mode-description">
																<?php echo $pdestacados[3]["description"]; ?>
															</div>
															<!-- hover-appear -->
															</li>
														</ul>
													</div>          
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						

						<div class="home-banner-wrapper">
							<div class="container">
								<div id="home-banner" class="text-center clearfix">
									<img class="pulse img-banner-caption" src="assets/images/logo-white.png" alt="">
									<div class="home-banner-caption">
										<p>
											¡La nueva forma de comprar accesorios de plata!
										</p>
									</div>
									<div class="home-banner-action">
										<a href="categories.php">Consulta nuestros productos</a>
									</div>
								</div>
							</div>
						</div>
						
						<!-- home-blog -->
						
						<!-- home-feature -->

						<!-- home-partners -->
						
					</div>
				</section>        
			</div>
		</div>
	</div>
	
	<?php include("sections/footer.php");?>
	
	<div class="newsletter-popup" style="display: none;" align="center">
		<!--<form action="http://codespot.us5.list-manage.com/subscribe/post?u=ed73bc2d2f8ae97778246702e&amp;id=c63b4d644d" method="post" name="mc-embedded-subscribe-form" target="_blank">
			<h4>-50% Deal</h4>
			<p class="tagline">
				subscribe for newsletter and get the item for 50% off
			</p>
			<div class="group_input">
				<input class="form-control" type="email" name="EMAIL" placeholder="YOUR EMAIL">
				<button class="btn" type="submit"><i class="fa fa-paper-plane"></i></button>
			</div>
		</form>
		<div id="popup-hide">
			<input type="checkbox" id="mc-popup-hide" value="1" checked="checked"><label for="mc-popup-hide">Never show this message again</label>
		</div>-->
		
		<video id="vpopargyros" width="99%" height="auto" autoplay controls>
		  <source src="assets/videos/argyros.mp4" type="video/mp4">
			Your browser does not support the video tag.
		</video>
		
	</div>
	
	<script src="assets/javascripts/cs.global.js" type="text/javascript"></script>
 	<!--
	<div id="quick-shop-modal" class="modal in" role="dialog" aria-hidden="false" tabindex="-1" data-width="800">
		<div class="modal-backdrop in" style="height: 742px;">
		</div>
		<div class="modal-dialog rotateInDownLeft animated">
			<div class="modal-content">
				<div class="modal-header">
					<i class="close fa fa-times btooltip" data-toggle="tooltip" data-placement="top" title="" data-dismiss="modal" aria-hidden="true" data-original-title="Close"></i>
				</div>
				<div class="modal-body">
					<div class="quick-shop-modal-bg" style="display: none;">
					</div>
					<div class="row">
						<div class="col-md-12 product-image">
							<div id="quick-shop-image" class="product-image-wrapper">
								<a class="main-image"><img class="img-zoom img-responsive image-fly" src="assets/images/1_grande.jpg" data-zoom-image="./assets/images/1.jpg" alt=""/></a>
								<div id="gallery_main_qs" class="product-image-thumb">
									<a class="image-thumb active" href="assets/1images/.html" data-image="./assets/images/1_grande.jpg" data-zoom-image="assets/images/1.html"><img src="assets/images/1_compact.jpg" alt=""/></a>
									<a class="image-thumb" href="assets/images/2.html" data-image="./assets/images/2_grande.jpg" data-zoom-image="assets/images/2.html"><img src="assets/images/2_compact.jpg" alt=""/></a>
									<a class="image-thumb" href="assets/images/3.html" data-image="./assets/images/3_grande.jpg" data-zoom-image="assets/images/3.html"><img src="assets/images/3_compact.jpg" alt=""/></a>
									<a class="image-thumb" href="assets/images/4.html" data-image="./assets/images/4_grande.jpg" data-zoom-image="assets/images/4.html"><img src="assets/images/4_compact.jpg" alt=""/></a>
									<a class="image-thumb" href="assets/images/5.html" data-image="./assets/images/5_grande.jpg" data-zoom-image="assets/images/5.html"><img src="assets/images/5_compact.jpg" alt=""/></a>
									<a class="image-thumb" href="assets/images/6.html" data-image="./assets/images/6_grande.jpg" data-zoom-image="assets/images/6.html"><img src="assets/images/6_compact.jpg" alt=""/></a>
								</div>	
							</div>
						</div>
						<div class="col-md-12 product-information">
							<h1 id="quick-shop-title"><span> <a href="http://demo.designshopify.com/products/curabitur-cursus-dignis">Curabitur cursus dignis</a></span></h1>
							<div id="quick-shop-infomation" class="description">
								<div id="quick-shop-description" class="text-left">
									<p>
										Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis amet voluptas assumenda est, omnis dolor repellendus quis nostrum.
									</p>
									<p>
										Temporibus autem quibusdam et aut officiis debitis aut rerum dolorem necessitatibus saepe eveniet ut et neque porro quisquam est, qui dolorem ipsum quia dolor s...
									</p>
								</div>
							</div>
							<div id="quick-shop-container">
								<div id="quick-shop-relative" class="relative text-left">
									<ul class="list-unstyled">
										<li class="control-group vendor">
										<span class="control-label">Vendor :</span><a href="http://demo.designshopify.com/collections/vendors?q=Vendor+1"> Vendor 1</a>
										</li>
										<li class="control-group type">
										<span class="control-label">Type :</span><a href="http://demo.designshopify.com/collections/types?q=Sweaters+Wear"> Sweaters Wear</a>
										</li>
									</ul>
								</div>
								<form action="#" method="post" class="variants" id="quick-shop-product-actions" enctype="multipart/form-data">
									<div id="quick-shop-price-container" class="detail-price">
										<span class="price_sale">$259.00</span><span class="dash">/</span><del class="price_compare">$300.00</del>
									</div>
									<div class="quantity-wrapper clearfix">
										<label class="wrapper-title">Quantity</label>
										<div class="wrapper">
											<input type="text" id="qs-quantity" size="5" class="item-quantity" name="quantity" value="1">
											<span class="qty-group">
											<span class="qty-wrapper">
											<span class="qty-up" title="Increase" data-src="#qs-quantity">
											<i class="fa fa-plus"></i>
											</span>
											<span class="qty-down" title="Decrease" data-src="#qs-quantity">
											<i class="fa fa-minus"></i>
											</span>
											</span>
											</span>
										</div>
									</div>
									<div id="quick-shop-variants-container" class="variants-wrapper">
										<div class="selector-wrapper">
											<label for="#quick-shop-variants-1293238211-option-0">Color</label>
											<div class="wrapper">
												<select class="single-option-selector" data-option="option1" id="#quick-shop-variants-1293238211-option-0" style="z-index: 1000; position: absolute; opacity: 0; font-size: 15px;">
													<option value="black">black</option>
													<option value="red">red</option>
													<option value="blue">blue</option>
													<option value="purple">purple</option>
													<option value="green">green</option>
													<option value="white">white</option>
												</select>
												<button type="button" class="custom-style-select-box" style="display: block; overflow: hidden;"><span class="custom-style-select-box-inner" style="width: 264px; display: inline-block;">black</span></button><i class="fa fa-caret-down"></i>
											</div>
										</div>
										<div class="selector-wrapper">
											<label for="#quick-shop-variants-1293238211-option-1">Size</label>
											<div class="wrapper">
												<select class="single-option-selector" data-option="option2" id="#quick-shop-variants-1293238211-option-1" style="z-index: 1000; position: absolute; opacity: 0; font-size: 15px;">
													<option value="small">small</option>
													<option value="medium">medium</option>
													<option value="large">large</option>
												</select>
												<button type="button" class="custom-style-select-box" style="display: block; overflow: hidden;"><span class="custom-style-select-box-inner" style="width: 264px; display: inline-block;">small</span></button><i class="fa fa-caret-down"></i>
											</div>
										</div>
									</div>
									<div class="others-bottom">
										<input id="quick-shop-add" class="btn small add-to-cart" type="submit" name="add" value="Add to Cart" style="opacity: 1;">
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	-->
	<!--Androll-->
	
	<!-- Validator -->
	<script src="assets/bootstrapvalidator/dist/js/bootstrapValidator.min.js" type="text/javascript"></script>

	<script type="text/javascript">
		adroll_adv_id = "HTF7KIWJRBHHXL46WLUDBC";
		adroll_pix_id = "IE5CHDRTR5ABXH2P6QXAVM";
		(function () {
		var oldonload = window.onload;
		window.onload = function(){
		   __adroll_loaded=true;
		   var scr = document.createElement("script");
		   var host = (("https:" == document.location.protocol) ? "https://s.adroll.com" : "http://a.adroll.com");
		   scr.setAttribute('async', 'true');
		   scr.type = "text/javascript";
		   scr.src = host + "/j/roundtrip.js";
		   ((document.getElementsByTagName('head') || [null])[0] ||
			document.getElementsByTagName('script')[0].parentNode).appendChild(scr);
		   if(oldonload){oldonload()}};
		}());

		$("#vpopargyros").bind("ended", function() {
		   $(".fancybox-close").click();
		});
	</script>

	<!-- Google Code -->
	<script>

	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){

	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),

	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)

	  })(window,document,'script','../../www.google-analytics.com/analytics.js','ga');



	  ga('create', 'UA-55571446-8', 'auto');

	  ga('require', 'displayfeatures');
	  
	  ga('set', 'dimension1', 'html_jewelry');
		 
	  ga('set', 'dimension2', 'html_jewelry');

	  ga('send', 'pageview');

	</script>
</body>