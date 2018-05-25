<?php
    /*
     * Argyros - Catálogo
     * 
     */
    session_start();
    ini_set( 'display_errors', 1 );
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
<!--[if (gt IE 9)|!(IE)]><!--> 
<html lang="en" class="no-js"> <!--<![endif]-->

<!-- Mirrored from demo.designshopify.com/html_jewelry/collection.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 12 Jul 2017 16:53:17 GMT -->

<head>
  <meta charset="UTF-8">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />
  <link rel="canonical" href="http://demo.designshopify.com/"/>
  <meta name="description" content=""/>
  <!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
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
	
	<script src="js/fn-user.js" type="text/javascript"></script>
	<script src="js/fn-product.js" type="text/javascript"></script>
	<script src="js/fn-ui.js" type="text/javascript"></script>
	<script src="js/fn-cart.js" type="text/javascript"></script>

	<script>
		$( document ).ready(function() {
			$("#catalog-filters").hide();
			$("#tfilters").hover( function(){ 
               $("#catalog-filters").fadeToggle( 100, "linear" );
            });
            /*$("#tfilters").click( function(){ 
               $("#catalog-filters").fadeIn( 100, "linear" );
            });
            
            $(".fltout").mouseout( function(){
            	$("#catalog-filters").fadeOut( 100, "linear" );
            });*/

		 });
	</script>

	
</head>
<style>
	#options {
	    margin-top: 20px;
	    margin-bottom: 30px;
	}
	#catalog-filters{
		position: absolute;
		width: 100%;
		z-index: 998;
		background: #e7e7e7 !important;
		border:1px solid #818285;
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

	.categ_catalog{
		max-width: 100% !important;
	}
</style>

<body itemscope="" itemtype="http://schema.org/WebPage" class="templateCollection notouch">
	<!-- Header -->
	<?php include( "sections/header.php" ); ?>
  
	<div id="content-wrapper-parent">
		<div id="content-wrapper">  
			<!-- Content -->
			<div id="content" class="clearfix">                
				<div id="breadcrumb" class="breadcrumb">
					<div itemprop="breadcrumb" class="container">
						<div class="row">
							<div class="col-md-12">
								<a href="index.php" class="homepage-link" title="Back to the frontpage">Inicio</a>
								<span>/</span>
								<a href="catalog.php">
									<span class="page-title"><?php echo "Catálogo"; ?></span>
								</a>
								
							</div>
							<div id="title-categories">
								<h1 id="page-title" class="text-right"><?php //echo $etiq_categs; ?></h1>
							</div>
						</div>
					</div>
				</div>
                
				<section class="content">
					<div class="container">
						<div class="row"> 
							<div id="collection-content">
								<div id="page-header"></div>
								<!--
								<div class="navbar-collapse">
									<ul class="nav">
										<li class="dropdown mega-menu">
										<a id="tfilters" href="#!" class="dropdown-toggle dropdown-link" data-toggle="dropdown">
										<span>Filtros <i class="fa fa-caret-down"></i></span>
										<i class="fa fa-caret-down"></i>
										<i class="sub-dropdown1 visible-sm visible-md visible-lg"></i>
										<i class="sub-dropdown visible-sm visible-md visible-lg"></i>
										</a>
										<hr>
										<?php //include( "sections/filters.php" );?>
										</li>
									</ul>
								</div>
								-->
								<!--<div class="collection-warper col-sm-24 clearfix"> 
									<div class="collection-panner">
										<img src="assets/images/collection_banner.jpg" class="img-responsive" alt="">
									</div>
								</div>-->
								<div class="collection-main-content">									
									<div id="col-main" class="collection collection-page col-xs-24 col-sm-24">
										<div class="container-nav clearfix">
											<!--<div id="options" class="container-nav clearfix">
												
												<ul class="list-inline text-right">
													<li class="grid_list">
													<ul class="list-inline option-set hidden-xs" 
													data-option-key="layoutMode">
														<li data-original-title="Grid" data-option-value="fitRows" id="goGrid" class="goAction btooltip active" data-toggle="tooltip" data-placement="top" title="">
														<span></span>
														</li>
														<li data-original-title="List" data-option-value="straightDown" id="goList" class="goAction btooltip" data-toggle="tooltip" data-placement="top" title="">
														<span></span>
														</li>
													</ul>
													</li>
													<li class="sortBy">
													
													<div id="sortButtonWarper" class="dropdown-toggle" data-toggle="dropdown">
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
												
											</div>-->
										</div>

										<div id="sandBox-wrapper" class="group-product-item row collection-full">
											
											<div class="group_home_collections row">
												<div class="col-md-24">
													<div class="home_collections">
														<h6 class="general-title">CATEGORÍAS</h6>
														<?php foreach ( $lh_cat_ppal as $rcp ) { 
															if( $rcp["id"] != 0 ){
														?>
															<div class="home_collections_item col-md-6 col-sm-6 col-xs-24 fadeInUp animated">
																<div class="home_collections_item_inner">
																	<div class="collection-details">
																		<a href="acatalog.php?c=<?php echo $rcp["uname"];?>" title="<?php echo $rcp["name"];?>">
																		<?php if($rcp["image"] != "" ) { ?>
																		<img src="assets/images/<?php echo $rcp["image"];?>" alt="Rings" class="categ_catalog">
																		<?php } else { ?>
																		<img src="assets/images/<?php echo $rcp["image"];?>" alt="Rings" class="categ_catalog">
																		<?php } ?>
																		</a>
																	</div>
																	<div class="hover-overlay" align="center">
																		<span class="col-name">
																			<a href="acatalog.php?c=<?php echo $rcp["uname"];?>"><h6> 
																			<?php echo $rcp["name"]; ?></h6></a> 
																		</span>
																		<div class="collection-action hidden">
																			<a href="acatalog.php?c=<?php echo $rcp["uname"];?>">VER CATÁLOGO</a>
																		</div>
																	</div>
																</div>
															</div>
														<?php }} ?>
														<!--<div class="home_collections_wrapper">												
															<div id="home_collections">
															
																
																
															</div>													
														</div>-->
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
								</div>
							</div>
						</div>
					</div>
				</section>        
      </div>
    </div>
  </div>

    <?php include("sections/footer.php");?> 	
	
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