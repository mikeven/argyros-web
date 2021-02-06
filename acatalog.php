<?php
    /*
     * Argyros - Página de catálogo
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
    include( "fn/fn-filters.php" );
    
    checkSession( 'catalogo' );
    checkUsuarioBloqueado( $dbh );
    if( !isset( $iddetbusqueda ) ) 
    	$iddetbusqueda = "";
    
?>
<!doctype html>
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> 
<html lang="en" class="no-js"> <!--<![endif]-->

<!-- Mirrored from demo.designshopify.com/html_jewelry/collection.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 12 Jul 2017 16:53:17 GMT -->

<head>
  <meta charset="UTF-8">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />
  <link rel="canonical" href="http://demo.designshopify.com/"/>
  <meta name="description" content=""/>
  <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
  <link rel="icon" type="image/png" href="https://www.argyros.com.pa/assets/images/afavicon.png">
  <title>Catálogo::Argyros</title>
  
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
	<link href="assets/stylesheets/bootstrap-tagsinput.css" rel="stylesheet" type="text/css" media="all">
	
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
	<script src="assets/javascripts/bootstrap-tagsinput.js" type="text/javascript"></script>
	
	<script src="js/fn-user.js" type="text/javascript"></script>
	<script src="js/fn-product.js" type="text/javascript"></script>
	<script src="js/fn-ui.js" type="text/javascript"></script>
	<script src="js/fn-cart.js" type="text/javascript"></script>
	<script src="js/fn-filters.js" type="text/javascript"></script>

	<script>
		$( document ).ready(function() {

			$("#catalog-filters").hide();
			$("#tfilters").click( function(){ 
               $("#catalog-filters").fadeToggle( 100, "linear" );
            });

			$(".bootstrap-tagsinput input").prop('readonly', true);

			posicionarMenu();

			$(window).scroll(function() {    
			    posicionarMenu();
			});

            /*$("#tfilters").click( function(){ 
               $("#catalog-filters").fadeIn( 100, "linear" );
            });
            
            $(".fltout").mouseout( function(){
            	$("#catalog-filters").fadeOut( 100, "linear" );
            });*/

			/*var filters = new Bloodhound({
			  datumTokenizer: Bloodhound.tokenizers.obj.whitespace('text'),
			  queryTokenizer: Bloodhound.tokenizers.whitespace,
			  prefetch: 'assets/filters.json'
			});
			filters.initialize();*/

			$('#panel_filtro').tagsinput({
		      	allowDuplicates: false,
		        itemValue: 'id',  // this will be used to set id of tag
		        itemText: 'label' // this will be used to set text of tag
		    });

		    $(".bootstrap-tagsinput input").attr('readonly', true);

		    /*$('html, body').animate({
			   scrollTop: $('#2335').offset().top 
			}, 2000);*/

			

		 });

		/*$(window).on('load', function() {
			var bot = 0;
		    while ( !$('#2381').is(":visible") ) {
				
			  	bot++;
			  	$("#bc" + bot).click();
			  	if( $('#2381').is(":visible") ) {
				  	
				  	$('html, body').animate({
						scrollTop: $('#2381').offset().top - 300 
					}, 2000);
				
				}
			}
		});*/
		
	</script>
</head>
<style>
	
	#panel_filtro, #catalog-filters{ display: none; }
	#options {
	    margin-top: 20px;
	    margin-bottom: 30px;
	}

	#catalog-filters{
		position: absolute;
		width: 100%;
		z-index: 998;
		background: #f1f2ed !important;
		border-top:1px solid #818285;
		border-bottom:1px solid #818285;
		max-height: 500px;
    	overflow-y: scroll;
	}
	
	.tab_filtro_contenido{ display: none; }
	.flt_selected{ color: #a7b239 !important; }
	.input_flt{ height: 30px !important; }

	.bootstrap-tagsinput{
		border: 0; background-color: transparent; box-shadow: none; 
	}

	.tfilt{
		font-size: 12px; padding: 2px 6px; 
		margin-right: 2px; color: #000;
		background-color: #a7b239;
		width: auto; float: left;
	}

	#contenido_bloque_filtros{
		width: 100%;
		max-width: 1200px;
		background-color: #f7f7f7;
	}

	.seccion_filtros_catalogo{
		top: 0;
		transition: top 0.8s;
	}

	@media( max-width: 1024px ){
		.seccion_filtros_catalogo_fijo{
	    	top: 0px !important;
		}
	}

	.seccion_filtros_catalogo_fijo{
		position: fixed;
    	top: 51px;
    	z-index: 900;
	}

	.tfilt i{ color: #FFF; }

	.label-info {
	    background-color: #a7b239;
	}

	.product-information #quick-shop-container .quantity-wrapper .wrapper span.qty-up, 
	.product-information #quick-shop-container .quantity-wrapper .wrapper span.qty-down {
	    position: absolute;
	    top: 27px;    
	}

	.product-information #quick-shop-container .quantity-wrapper .wrapper span.qty-up{
	    left: 130px !important;    
	}

	.product-information #quick-shop-container .quantity-wrapper .wrapper span.qty-down {
	    left: 0px;   
	}

	.product-information #quick-shop-container .quantity-wrapper .wrapper input#qs-quantity {
	    border: 1px solid #dedede;
	    width: 120px;
	    height: 25px;
	    text-align: center;
	}

	.product-information #quick-shop-container .qty-wrapper .qty-up i.fa, 
	.product-information #quick-shop-container .qty-wrapper .qty-down i.fa {
	    padding: 6px 8px;
	}

	.price_sale{
		font-size: 25px;
	}

	#quick-shop-price-container.detail-price {
		margin-bottom: 2px;
    	margin-top: 2px;
	}

	.product-information .quantity-wrapper {
	    margin-top: 5px;
	    padding-top: 2px;
	}

	#quick-shop-description p{
		font-size: 12px;
	}

	#quick-shop-description label{
		font-size: 8px;
	}

	.bcargable, .cargable{ display: none; }
	.eca0, #bc1{ display: inline; }
	.division_bloque{ width: 100%; }

	.scrollTop {
	  position: fixed;
	  right: 6%;
	  bottom: 30px;
	  background-color: #a7b239;
	  padding: 6px 12px;
	  opacity: 0;
	  transition: all 0.4s ease-in-out 0s;
	}

	.scrollTop a {
	  font-size: 12px;
	  color: #fff;
	}

	.imgcatal{
		/*max-width: 250px;: genera espacio blanco a la derecha*/
  		height: auto;
	}

	.img-catal-contenedor{
		height:270px !important; 
	}
	@media(max-width: 768px){
		.imgcatal{
	  		height: auto;
	  		margin: 0 auto;
	  		width: 70%;
		}
	}

	#flt-breadcrumb{ margin-left: 50px; }
	#flt-breadcrumb a{ font-weight: 500; color: #818285; }
</style>

<body itemscope="" itemtype="http://schema.org/WebPage" class="templateCollection notouch">
	<!-- Header -->
	<?php include( "sections/header.php" ); ?>
  
	<div id="content-wrapper-parent">
		<div id="content-wrapper">  
			<!-- Content -->
			<div id="content" class="clearfix">                
                
				<section class="content">
					<div class="container">
						<?php if( isset( $_SESSION["login"] ) ) { ?>
						<div class="row"> 
							<div id="collection-contents" class="seccion_filtros_catalogo">
									
								<div id="contenido_bloque_filtros" class="seccion_filtros_catalogo">

									<div id=""></div>
									<div class="navbar-collapse">
										<ul class="nav">
											<li class="dropdown mega-menu">
												<hr>
												<div style="float:left;">
													<a id="tfilters" href="#!" class="dropdown-toggle dropdown-link" data-toggle="dropdown">
													<span>Filtros <i class="fa fa-caret-down"></i></span>
													<!-- <i class="fa fa-caret-down"></i> -->
													<i class="sub-dropdown1 visible-sm visible-md visible-lg"></i>
													<i class="sub-dropdown visible-sm visible-md visible-lg"></i>
													</a>
												</div>
												<div id="flt-breadcrumb" style="float:left;">
													<?php 
														if( isset( $_SESSION["login"] ) ) 
															include( "sections/breadcrumb.php" ); 
													?>
												</div>
												<div id="panel_tag_filters" style="float: right;">
													<?php  
														foreach ( $d_filtros["url"] as $flt_vo ) { ?>
														<a href="<?php echo $flt_vo["url_filtro"]; ?>" class="tfilt">
															<?php echo $flt_vo["texto"]; ?> <i class="fa fa-times"></i>
														</a> 
													<?php } ?>
												</div>
												<input id="panel_filtro" type="text" value="" readonly="true"/>
												<div style="clear:both;"></div>
												<hr>
												
												
												<?php include( "sections/filters.php" ); ?>
											</li>
										</ul>
									</div>

								</div>
								<!--<div class="collection-warper col-sm-24 clearfix"> 
									<div class="collection-panner">
										<img src="assets/images/collection_banner.jpg" class="img-responsive" alt="">
									</div>
								</div>-->
								<div class="collection-main-content">									
									<div id="col-main" class="collection collection-page col-xs-24 col-sm-24">
										<div class="container-nav clearfix">
											<div id="options" class="container-nav clearfix">
												<ul class="list-inline text-right">
													<li class="grid_list">
													<ul class="list-inline option-set hidden-xs" data-option-key="layoutMode">
														<li data-original-title="Grid" data-option-value="fitRows" id="goGrid" class="goAction btooltip active" data-toggle="tooltip" data-placement="top" title="">
														<span></span>
														</li>
														<li data-original-title="List" data-option-value="straightDown" id="goList" class="goAction btooltip" data-toggle="tooltip" data-placement="top" title="">
														<span></span>
														</li>
													</ul>
													</li>
													<li class="sortBy">
													<div id="sortButtonWarper" class="dropdown-toggle hidden" data-toggle="dropdown">
														<strong class="title-6">Ordenar por</strong>
														<button id="sortButton">
														<span class="name">Seleccione</span>
														<i class="fa fa-caret-down"></i>
														</button>
														<i class="sub-dropdown1"></i>
														<i class="sub-dropdown"></i>
													</div>
													<div id="sortBox" class="control-container dropdown-menu">
														<ul id="sortForm" class="list-unstyled option-set text-left list-styled" data-option-key="sortBy">
															
															<li class="sort" data-option-value="title-ascending" data-order="asc">A-Z</li>
															<li class="sort" data-option-value="title-descending" data-order="desc">Z-A</li>
															<li class="sort" data-option-value="price-ascending" data-order="asc">Precio: Menor a mayor</li>
															<li class="sort" data-option-value="price-descending" data-order="desc">Precio: Mayor a menor</li>
															
														</ul>
													</div>
													</li>
												</ul>
											</div>
										</div>
										<div id="sandBox-wrapper" class="group-product-item row collection-full">
											<ul id="sandBox" class="list-unstyled">
												<?php 
													$enum = 0; $bloque = 0;
													
													foreach ( $productos as $data_rprod ){	
													//$productos: fn-catalog.php

														$p = $data_rprod["data"];
														//$img = obtenerImagenProducto( $dbh, $p["id"] );
														
														if( productoTieneDetalleVisible( $dbh, $p["id"] ) || $busqueda_por_codigo ){
															
															$img = obtenerImagenProductoCatalogo( 
																	$dbh, $p["id"], $iddetbusqueda, 
																	$data_rprod );

															$urlp = obtenerUrlProductoCatalogo( 
																	$p["id"], $iddetbusqueda );
															$titulo_p = "(#".$p["id"].") ".$p["name"]

												?>
												<?php if( $enum == NPAGINACION ){ 
														$enum = 0; $bloque++; 
														if( $bloque == 1 ) 
															$visible = "visible"; 
														else $visible = "";
												?>
													<div class="division_bloque" align="center">
														<button id="bc<?php echo $bloque; ?>" class="btn bcargable <?php echo $visible; ?>" 
														type="button" data-trg="eca<?php echo $bloque; ?>" 
														data-pb="bc<?php echo $bloque + 1; ?>">Ver más</button>
													</div>
												<?php } ?>
												<li id="bl<?php echo $p['id']?>" class="element first no_full_width cargable eca<?php echo $bloque; ?>" 
													data-alpha="Nombre del producto">
													<ul class="row-container list-unstyled clearfix">
														<li class="row-left img-catal-contenedor">
														<a id="<?php echo $p['id']?>" 
															href="<?php echo $urlp; ?>" class="container_item" target="_blank">
														
														<img src="<?php echo $purl.$img[0]["image"] ?>" 
														class="img-responsive imgcatal" alt="<?php echo $p["name"] ?>">
														<span class="sale_banner">
															<?php if( $p["d_antiguedad"] < NDIAS_NUEVO ) { ?>
																<span class="sale_text">
																	Nuevo
																</span>
															<?php } ?>
														</span>
														</a>
														<div class="hbw">
															<span class="hoverBorderWrapper hidden"></span>
														</div>
														</li>
														<li class="row-right parent-fly animMix">
														<div class="product-content-left">
															<a class="title-5" href="<?php echo $urlp; ?>" target="_blank">
																<?php echo $titulo_p; ?>
															</a>
															<span class="spr-badge" id="spr_badge_129323821155" data-rating="0.0">
																<span class="spr-starrating spr-badge-starrating">
																	<i class="spr-icon spr-icon-star-empty" style=""></i>
																	<i class="spr-icon spr-icon-star-empty" style=""></i>
																	<i class="spr-icon spr-icon-star-empty" style=""></i>
																	<i class="spr-icon spr-icon-star-empty" style=""></i>
																	<i class="spr-icon spr-icon-star-empty" style=""></i>
																</span>
																<span class="spr-badge-caption"> No reviews </span>
															</span>
														</div>
														<div class="product-content-right">
															<div class="product-price hidden">
																<span class="price_sale">$25.00</span>
																<del class="price_compare"> $30.00</del>
															</div>
														</div>
														<div class="list-mode-description">
															 <?php echo $p["description"] ?>
														</div>
														<div class="hover-appear hidden-xs">
															<form action="#" method="post" class="hidden">
																<div class="effect-ajax-cart">
																	<input name="quantity" value="1" type="hidden">
																	<button class="select-option hidden" type="button" onclick="window.location.href='<?php echo $urlp; ?>'">
																	<i class="fa fa-th-list" title="Ver detalles"></i><span class="list-mode">Ver detalle</span>
																	</button>
																</div>
															</form>
															<div class="product-ajax-qs hidden-xs hidden-sm hidden">
																<div data-handle="curabitur-cursus-dignis" data-target="#quick-shop-modal" class="quick_shop" data-toggle="modal">
																	<i class="fa fa-eye" title="Vista rápida"></i><span class="list-mode">Vista rápida</span>
																	
																</div>
															</div>
															
														</div>
														</li>
													</ul>
												</li>
												
												<?php 
														$enum++; 
														} // if productoTieneDetalle
													} // foreach
												?>
												
											</ul>
										</div>
									</div>  									
								</div>
							</div>
						</div>
						<?php } else { ?>
				    		<div style="margin:20px 0 100px 0;">
								<h6 id="blocked-sesion-catalog" 
								class="sb-title"><i class="fa fa-home"></i>
								INICIA SESIÓN PARA VER EL CATÁLOGO
								</h6>
							
								<a href="login.php">
									<button type="submit" class="btn">Iniciar sesión</button>
								</a>
							</div>
						<?php } ?>
					</div>
				</section>        
      	</div>
    </div>
  </div>

    <?php include("sections/footer.php");?>

    <div id="stop" class="scrollTop">
	    <span><a href=""><i class="fa fa-arrow-up"></i></a></span>
	</div>	
	
	<div id="quick-shop-modal" class="modal in" role="dialog" aria-hidden="false" tabindex="-1" data-width="800">
		<div class="modal-backdrop in" style="height: 742px;">
		</div>
		<div class="modal-dialog rotateInDownLeft animated">
			<div class="modal-content">
				<div class="modal-header">
					<i class="close fa fa-times btooltip" data-toggle="tooltip" data-placement="top" title="" data-dismiss="modal" aria-hidden="true" data-original-title="Cerrar"></i>
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
							<h1 id="quick-shop-title"><span><a href="http://demo.designshopify.com/products/curabitur-cursus-dignis">Nombre del producto</a></span></h1>
							<div id="quick-shop-infomation" class="description">
								<div id="quick-shop-description" class="text-left">
									<p> Descripción del producto </p>
									<p> Texto descriptivo </p>
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
								<form action="#!" method="post" class="variants" id="quick-shop-product-actions" enctype="multipart/form-data">
									<div id="quick-shop-price-container" class="detail-price">
										<span class="price_sale">$25.99</span><span class="dash">/</span><del class="price_compare">$300.00</del>
									</div>
									
									
									<div class="quantity-wrapper clearfix">
										<div class="col-md-6">
											<label for="#quick-shop-variants-1293238211-option-1">Talla</label>
											<div>2</div>	
										</div>
										<div class="col-md-6">
											<label class="wrapper-title">Cantidad</label>
											<div class="wrapper">
												<input type="text" id="qs-quantity" size="5" class="item-quantity" name="quantity" value="1">
												<span class="qty-group">
												<span class="qty-wrapper">
												<span class="qty-up" title="Aumentar" data-src="#qs-quantity">
												<i class="fa fa-plus"></i>
												</span>
												<span class="qty-down" title="Restar" data-src="#qs-quantity">
												<i class="fa fa-minus"></i>
												</span>
												</span>
												</span>
											</div>	
										</div>
									</div>
									<div class="quantity-wrapper clearfix">
										<div class="col-md-6">
											<label for="#quick-shop-variants-1293238211-option-1">Talla</label>
											<div>2</div>	
										</div>
										<div class="col-md-6">
											<label class="wrapper-title">Cantidad</label>
											<div class="wrapper">
												<input type="text" id="qs-quantity" size="5" class="item-quantity" name="quantity" value="1">
												<span class="qty-group">
												<span class="qty-wrapper">
												<span class="qty-up" title="Aumentar" data-src="#qs-quantity">
												<i class="fa fa-plus"></i>
												</span>
												<span class="qty-down" title="Restar" data-src="#qs-quantity">
												<i class="fa fa-minus"></i>
												</span>
												</span>
												</span>
											</div>	
										</div>
									</div>

									
									<div id="quick-shop-variants-container" class="variants-wrapper">
										<!--<div class="selector-wrapper">
											<label for="#quick-shop-variants-1293238211-option-0">Color</label>
											<div class="wrapper">
												<select class="single-option-selector" data-option="option1" id="#quick-shop-variants-1293238211-option-0" style="z-index: 1000; position: absolute; opacity: 0; font-size: 15px;">
													<option value="negro">negro</option>
													<option value="rojo">rojo</option>
													<option value="azul">azul</option>
													<option value="dorado">dorado</option>
													<option value="plateado">plateado</option>
													<option value="blanco">blanco</option>
												</select>
												<button type="button" class="custom-style-select-box" style="display: block; overflow: hidden;"><span class="custom-style-select-box-inner" style="width: 264px; display: inline-block;">Seleccione</span></button><i class="fa fa-caret-down"></i>
											</div>
										</div>
										<div class="selector-wrapper">
											<label for="#quick-shop-variants-1293238211-option-1">Talla</label>
											<div class="wrapper">
												<select class="single-option-selector" data-option="option2" id="#quick-shop-variants-1293238211-option-1" style="z-index: 1000; position: absolute; opacity: 0; font-size: 15px;">
													<option value="5">5</option>
													<option value="6">6</option>
													<option value="7">7</option>
												</select>
												<button type="button" class="custom-style-select-box" style="display: block; overflow: hidden;"><span class="custom-style-select-box-inner" style="width: 264px; display: inline-block;">Seleccione</span></button><i class="fa fa-caret-down"></i>
											</div>
										</div>-->
									</div>
									<div class="others-bottom">
										<input id="quick-shop-add" class="btn small add-to-cart" type="button" name="add" value="Agregar a carrito" style="opacity: 1;">
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
<script> setFilterBreadCrumb(); </script>