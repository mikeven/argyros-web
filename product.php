<?php
    /*
     * Argyros - Página de producto
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
    
    checkSession( '' );
?>

<!doctype html>
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> 
<html lang="en" class="no-js"> <!--<![endif]-->

<!-- Mirrored from demo.designshopify.com/html_jewelry/product-left.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 12 Jul 2017 16:53:51 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
  <meta charset="UTF-8">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />
  <link rel="canonical" href="http://demo.designshopify.com/" />
  <meta name="description" content="" />
  <?php if( $is_p ) { ?>
  	<title><?php echo $producto["name"]; ?></title>
  <?php } else { ?>
  	<title>Argyros</title>
  <?php }  ?>

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
	
	<script src="js/fn-product.js" type="text/javascript"></script>

	<style type="text/css">
		.rdet_view{ display: none; }
		.rdet_view_t{ display: none; }
		.rdet_prop{ display: none; }
		.product-view-img{ max-width: 50px !important; }
		li i.fa{
			font-size: 4px;
		    vertical-align: 4px;
		    padding-right: 10px;
		    color: #808080;
		}
		#not-found{
			margin-top: 25px;
		}

	</style>
</head>

<body style="height: 2671px;" itemscope="" itemtype="http://schema.org/WebPage" class="templateProduct notouch">
  
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
								<?php if( $is_p ) { ?>
								<a href="index.php" class="homepage-link" title="Página de inicio">Inicio</a>
								<span>/</span>
								<?php echo $producto["category"]; ?>
								<span>/</span>
								<a href="acatalog.php?c=<?php echo $producto["uname_c"]; ?>&s=<?php echo $producto["uname_s"]; ?>" 
								title="<?php echo $producto["category"]; ?>"><?php echo $producto["subcategory"]; ?></a>
								<span>/</span>
								<span class="page-title"><?php echo $producto["name"]; ?></span>
								<?php } else { ?>
									<a href="index.php" class="homepage-link" title="Página de inicio">Inicio</a>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>				        
				<section class="content">
					<div class="container">
						<?php if( $is_p && $is_pd ) { ?> 
						<div class="row">
							<div class="left-slidebar col-xs-24 col-sm-6 hidden-xs">
								<div class="group_sidebar">											
									<?php include("sections/product-categories.php");?>  
									
									<!-- SPECIALS -->
									
									<!-- WELCOME -->

									<!-- PRODUCT VENDORS -->

									<!-- AD -->
									<?php //include("sections/ad.php");?>
									
									<!--End sb-item-->
								</div><!--end group_sidebar-->
							</div>
							<div id="col-main" class="product-page col-xs-24 col-sm-18 no_full_width have-left-slidebar">
								<div itemscope="" itemtype="http://schema.org/Product">
									<meta itemprop="url" content="/products/donec-condime-fermentum">
									<div id="product" class="content clearfix">      										
										<div id="product-image" class="product-image row no_full_width col-sm-12">           
											
											<div class="image featured fadeInUp not-animated" data-animate="fadeInUp"> 
												<img src="<?php echo $purl.$img_pp;?>" alt="">
											</div>
											
											<div id="gallery_main" class="product-image-thumb thumbs mobile_full_width product_detail_views">
												<?php foreach ( $detalle as $pdet ) {  
													$imgs_rdet = $pdet["images"]; ?>
													<div id="rdet<?php echo $pdet["id"];?>" class="rdet_view">
														<ul style="opacity: 0; display: block;" class="slide-product-image owl-carousel owl-theme">
															<?php foreach ( $imgs_rdet as $idet ) { ?>
															<li class="image">
																<a href="<?php echo $purl.$idet["path"];?>" class="cloud-zoom-gallery active">
																	<img src="<?php echo $purl.$idet["path"];?>" 
																	alt="Donec condime fermentum" class="product-view-img">
																</a>
															</li>
															<?php } ?>
														</ul>
													</div>
												<?php } ?>
											</div>
                                            
                                            <!--<h4 id="page-title" class="text-left">
												<span itemprop="name">Más opciones</span>
											</h4>-->
                                            
											<div id="detail-right-column" class="right-coloum col-sm-6 fadeInLeft not-animated" data-animate="fadeInLeft">
												<div class="addthis_sharing_toolbox" data-url="#" data-title="Donec aliquam ante non | Jewelry - HTML Template">
													<div id="atstbx" class="at-share-tbx-element addthis_32x32_style addthis-smartlayers addthis-animated at4-show">
														<a class="at-share-btn at-svc-facebook"><span class="at4-icon aticon-facebook" title="Facebook"></span></a><a class="at-share-btn at-svc-twitter"><span class="at4-icon aticon-twitter" title="Twitter"></span></a><a class="at-share-btn at-svc-email"><span class="at4-icon aticon-email" title="Email"></span></a><a class="at-share-btn at-svc-print"><span class="at4-icon aticon-print" title="Print"></span></a><a class="at-share-btn at-svc-compact"><span class="at4-icon aticon-compact" title="More"></span></a>
													</div>
												</div>
											</div>

										</div>

										<div id="product-information" class="product-information row text-center no_full_width col-sm-12">        
											
                                            <h2 id="page-title" class="text-left">
												<span itemprop="name"><?php echo $producto["name"]; ?></span>
											</h2>
											
											<div id="product-header" class="clearfix">
												<div id="product-info-right" class="group_sidebar">
													<div class="description sb-wrapper left-sample-block">
														<span><?php echo $producto["description"]; ?></span>
														<ul class="list-unstyled sb-content list-styled">
														  <li> </li>
														  <li> <i class="fa fa-circle"></i><?php echo $producto["material"]; ?></li>
														  <li> <i class="fa fa-circle"></i><?php echo $producto["pais"]; ?></li>
														  <li> </li>
														  <?php foreach ( $detalle as $pdet ) { ?>
														  <div id="rdt-p<?php echo $pdet["id"]; ?>" class="rdet_prop rdet<?php echo $pdet["id"] ?>">
															  <span class="gs_circ"><?php echo $pdet["color"]; ?></span> | 
															  <span class="gs_circ"><?php echo $pdet["bano"]; ?></span> | 
															  <span class="gs_circ">Peso: <span id="rtallp<?php echo $pdet["id"]; ?>"> </span></span>
														  </div>
														  <?php } ?>
														</ul>
													</div>     
													<div itemprop="offers" itemscope="" itemtype="http://schema.org/Offer" class="col-sm-24 group-variants">
														<meta itemprop="priceCurrency" content="USD">              
														<link itemprop="availability" href="http://schema.org/InStock">
														<form action="cart.php" method="post" class="variants" id="product-actions">
															<div id="product-actions-1293235843" class="options clearfix">
																<style scoped>
																  label[for="product-select-option-0"] { display: none; }
																  #product-select-option-0 { display: none; }
																  #product-select-option-0 + .custom-style-select-box { display: none !important; }
																</style>																
																<!--<div class="swatch color clearfix" data-option-index="0">
																	<div class="header">
																		Color
																	</div>
																	<div data-value="black" class="swatch-element color black available">
																		<div class="tooltip">
																			black
																		</div>
																		<input id="swatch-0-black" name="option-0" value="black" checked="checked" type="radio">
																		<label for="swatch-0-black" style="background-color: black; background-image: url(assets/images/black.png)">
																		<img class="crossed-out" src="assets/images/soldout.png" alt="">
																		</label>
																	</div>
																	<div data-value="red" class="swatch-element color red available">
																		<div class="tooltip">
																			red
																		</div>
																		<input id="swatch-0-red" name="option-0" value="red" type="radio">
																		<label for="swatch-0-red" style="background-color: red; background-image: url(assets/images/red.png)">
																		<img class="crossed-out" src="assets/images/soldout.png" alt="">
																		</label>
																	</div>
																	<div data-value="white" class="swatch-element color white available">
																		<div class="tooltip">
																			white
																		</div>
																		<input id="swatch-0-white" name="option-0" value="white" type="radio">
																		<label for="swatch-0-white" style="background-color: white; background-image: url(assets/images/white.png)">
																		<img class="crossed-out" src="assets/images/soldout.png" alt="">
																		</label>
																	</div>
																	<div data-value="blue" class="swatch-element color blue available">
																		<div class="tooltip">
																			blue
																		</div>
																		<input id="swatch-0-blue" name="option-0" value="blue" type="radio">
																		<label for="swatch-0-blue" style="background-color: blue; background-image: url(assets/images/blue.png)">
																		<img class="crossed-out" src="assets/images/soldout.png" alt="">
																		</label>
																	</div>																	
																</div>-->

																<div id="purchase-1293235843">
																	<div class="detail-price" itemprop="price">
																		<span class="price">$21.99</span>
																	</div>
																</div>

																<!-- Bloque selección tallas -->
																<div class="swatch clearfix" data-option-index="1">
																	<div class="header"> Tallas </div>
																	<?php $cn = 0; foreach ( $detalle as $pdet ) {
																		$tallas = $pdet["sizes"]; $ct = 0;
																	?>
																	<div id="rdt-t<?php echo $pdet["id"]; ?>" class="rdet_view_t rdet<?php echo $pdet["id"] ?>">
																		<?php  foreach ( $tallas as $ptalla ) { ?>
																			<div data-value="<?php echo $ptalla["talla"]; ?>" 
																			class="swatch-element medium available seltdp" 
																			data-trg="rtallp<?php echo $pdet["id"]; ?>" data-peso="<?php echo $ptalla["peso"]; ?> gr">
																				<input id="<?php echo $cn."-".$ptalla["idtalla"]; ?>" name="opt<?php echo $pdet["id"] ?>" 
																				value="<?php echo $ptalla["talla"]; ?>" type="radio">
																				
																				<label for="<?php echo $cn."-".$ptalla["idtalla"]; ?>">
																					<?php echo $ptalla["talla"]; ?> 
																					<img class="crossed-out" src="assets/images/soldout.png" alt="">
																				</label>
																			</div>
																		<?php $ct++; $cn++; } ?>
																	</div>
																	<?php } ?>
																</div>
																<!-- /.Bloque selección tallas -->

																<table style="border:0">
																  <tr>
																    <th>
																    	<!-- Bloque selección cantidad -->
																		<div class="quantity-wrapper clearfix">
																			<label class="wrapper-title">Cantidad</label>
																			<div class="wrapper">
																				<input id="quantity" name="quantity" value="1" maxlength="5" size="5" class="item-quantity" type="text">
																				<span class="qty-group">
																					<span class="qty-wrapper">
																						<span data-original-title="Aumentar" class="qty-up btooltip" data-toggle="tooltip" data-placement="top" title="" data-src="#quantity">
																							<i class="fa fa-caret-right"></i>
																						</span>
																						<span data-original-title="Restar" class="qty-down btooltip" data-toggle="tooltip" data-placement="top" title="" data-src="#quantity">
																							<i class="fa fa-caret-left"></i>
																						</span>
																					</span>
																				</span>
																			</div>
																		</div>
																		<!-- /.Bloque selección cantidad -->
																    </th>
																    <div id="data_cart" class="hidden">
																    	<input type="hidden" id="idprod" name="idproducto" value="<?php echo $pid; ?>">
																    	<input type="hidden" id="iddetalle" name="iddetalle" value="<?php echo $detalle[0]["id"]; ?>">
																    	<input type="hidden" id="stalla" name="seltalla" value="">
																    </div>
																    <th valign="bottom">
																    	<!-- Botón agregar al carrito -->
																		<div class="others-bottom clearfix">
																			<!-- <button id="add-to-cart" class="btn btn-1 add-to-cart" data-parent=".product-information" type="submit" name="add">Agregar a carrito</button>-->
																			<a id="add-to-cart" class="action btn btn-1" href="#!">Agregar a compra</a>
																		</div>
																		<!-- /.Botón agregar al carrito -->
																    </th> 
																  </tr>
																</table>
																
																<!-- Bloque detalles de producto -->
																<div id="gallery_main" class="product-image-thumb thumbs mobile_full_width product_detail">
																	<ul style="opacity: 0; display: block;" class="slide-product-image owl-carousel owl-theme">
																	
																	<?php foreach ( $detalle as $pdet ) { 
																		$i = $pdet["images"][0]; ?>
																		<li class="image">
																			<a href="<?php echo $purl.$i["path"] ?>" 
																			class="cloud-zoom-gallery active select_pdetail" 
																			data-regdet="rdet<?php echo $pdet["id"] ?>" data-select-iddet="<?php echo $pdet["id"] ?>">
																				<img src="<?php echo $purl.$i["path"] ?>" alt="<?php echo $producto["name"]; ?>">
																			</a>
																		</li>
																	<?php } ?>
																	
																	</ul>
																</div>
																<!-- /.Bloque detalles de producto -->

															</div>
														</form>
														<!-- wishlist -->                                          
													</div>                        
													<!-- tabs_detail -->
													<!-- pop-one, two three -->             
													                
												</div>
												<div id="product-info-left">
													
													<div class="relative">
														<!--<ul class="list-unstyled">
															<li class="tags">
															<span>Tags :</span>
															<a href="#">
															above-200<span>,</span>
															</a>
															<a href="#">
															black<span>,</span>
															</a>
															<a href="#">
															l<span>,</span>
															</a>
															<a href="#">
															sale-off </a>
															</li>
														</ul>-->
													</div>
												</div>          
												
											</div>
										</div>
										<!-- Product reviews -->				
									</div>
								</div>         
								<!-- Related Products -->
								<?php include( "sections/related-products.php" );?>
							</div>
						</div>
						<?php } else { ?>
							<div id="not-found">
				    			<h6>PRODUCTO NO ENCONTRADO</h6>
				    			<?php if( !$is_pd && $is_p ) { ?>
				    			<h6>Sin datos</h6>
				    			<?php } ?>
				    		</div>
			    		<?php } ?>
					</div>
				</section>
					
			</div>
	    </div>
	</div>  
	
	<?php include("sections/footer.php");?>
</body>