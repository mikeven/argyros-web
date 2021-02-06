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
    include( "fn/fn-catalogue.php" );
    include( "fn/fn-cart.php" );
    
    checkSession( 'catalogo' );
    checkUsuarioBloqueado( $dbh );
    
?>
<!doctype html>
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> 
<html lang="en" class="no-js"> <!--<![endif]-->

<!-- Mirrored from demo.designshopify.com/html_jewelry/collection.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 12 Jul 2017 16:53:17 GMT -->

<head>
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
	
	<script src="assets/javascripts/bootstrap-tagsinput.js" type="text/javascript"></script>
	
	<script src="js/fn-user.js" type="text/javascript"></script>
	<script src="js/fn-product.js" type="text/javascript"></script>
	<script src="js/fn-ui.js" type="text/javascript"></script>
	<script src="js/fn-cart.js" type="text/javascript"></script>
	<script src="js/fn-filters.js" type="text/javascript"></script>
	<script src="js/fn-catalogue.js" type="text/javascript"></script>

	<script src="assets/javascripts/cs.script.js" type="text/javascript"></script>

	<?php include( "fn/ga.php" ); ?>

	<script>
		$( document ).ready(function() {

			$("#catalog-filters").hide();
			$("#tfilters").click( function(){ 
               $("#catalog-filters").fadeToggle( 100, "linear" );
            });

            $('body').click(function(evt){    
		       	if( evt.target.id == "contenido_bloque_filtros" )
		        	return;
		       	
		       	if($(evt.target).closest('#contenido_bloque_filtros').length)
		        	return;       

		        $("#catalog-filters").fadeOut( 100, "linear" );     
			});

			$(".bootstrap-tagsinput input").prop('readonly', true);

			posicionarMenu();

			$(window).scroll(function() {    
			    posicionarMenu();
			});

			$('#panel_filtro').tagsinput({
		      	allowDuplicates: false,
		        itemValue: 'id',  // this will be used to set id of tag
		        itemText: 'label' // this will be used to set text of tag
		    });

		    $(".bootstrap-tagsinput input").attr('readonly', true);

		 });

	</script>
</head>
<style>
	
	#panel_filtro, #catalog-filters, .cart-alert, .full_wgt{ display: none; }

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

	.catalogue_numerator{
		position: absolute;
	    left: 5px;
	    top: 5px;
	    width: 30px;
	    z-index: 899;
	    color: #6f6f6f;
	    padding: 4px 8px;
	    font-size: 12px;
	    background: #e7e7e7;
	    border-radius: 25px;
	    -webkit-transition: all 0.2s ease-out;
	    -moz-transition: all 0.2s ease-out;
	    -o-transition: all 0.2s ease-out;
	    -ms-transition: all 0.2s ease-out;
	    transition: all 0.2s ease-out;
	    display: table;
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

	/* flechas sumar/restar cantidades */
	.product-information #quick-shop-container .quantity-wrapper .wrapper span.qty-up, 
	.product-information #quick-shop-container .quantity-wrapper .wrapper span.qty-down {
	    position: absolute;
	    top: 3px;    
	}

	/* flecha sumar */
	.product-information #quick-shop-container .quantity-wrapper .wrapper span.qty-up{
	    left: 58px !important; 
	    right: unset !important;   
	}

	/* flecha restar */
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

	.table-data-catalogue th{ text-align: center; }
	@media( max-width: 992px ){
		.element.no_full_width ul li.row-right .hover-appear{
			background: #fff;
		}
	}

	.quick-shop-window{ margin:0 auto; }
	.quick-shop-icono{ text-align: center; padding: 12px 0; }

	.element ul li.row-right .hover-appear .product-ajax-qs .quick-shop-icono path {
	    fill: black;
	}

	.element ul li.row-right .hover-appear .product-ajax-qs:hover .quick-shop-icono path {
	   fill: white;
	} 

	.price_sale{
		font-size: 25px;
	}

	.data-product-catalogue{ font-size: 12.5px; line-height: 1.2em }

	#quick-shop-price-container.detail-price {
		margin-bottom: 2px;
    	margin-top: 2px;
	}

	.quick-shop-icono svg{ width: 23px; height: 23px }

	#quick-shop-data-products span{ font-size: 12px; }

	.modal-select-cant{
		width: 54px;
	    height: 30px;
	    line-height: 0;
	    padding: 6px;
	    font-size: 12px; 
	}

	.frm-scart input {
		font-size: 12px;
	    height: 24px;
	    margin-top: 3px;
	    text-align: center;
	    border: 1px solid #ccc; 
	}

	.modal-addtocart a{ 
		margin-top: 2px;
		width: 45px !important; 
		height: 25px !important;
		line-height: 24px !important; 
		font-size: 14px !important; 
	}

	.product-information .quantity-wrapper {
	    margin-top: 5px;
	    padding-top: 2px;
	}

	#alert-msgs{ margin-top: 20px; }

	#quick-shop-description p{
		font-size: 12px;
		margin-bottom: 0;
	}

	#quick-shop-product-id p{
		font-size: 11px;
	    font-weight: bold;
	    color: #696f24;
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
								
								<?php include( "sections/filters-block.php" )?>

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
													<ul id="lomode" class="list-inline option-set hidden-xs" data-option-key="layoutMode">
														
														<li data-original-title="Grid" data-option-value="fitRows" id="goGrid" class="goAction btooltip active" data-toggle="tooltip" data-placement="top" title="">
														<span></span>
														</li>
														
														<li data-original-title="List" data-option-value="straightDown" id="goList" class="goAction btooltip" data-toggle="tooltip" data-placement="top" title="">
														<span></span>
														</li>
													</ul>
													</li>
												</ul>
											</div>
										</div>
										
										<div id="sandBox-wrapper" class="group-product-item row collection-full">
											<!-- Elementos de catálogo -->
											<input id="catalogue_url" type="hidden" value="<?php echo $catalogue_url?>">
											<ul id="sandBox" class="list-unstyled">
												
												
											</ul>
											<div id="carga_catalogo" style="text-align: center;"></div>
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

    <?php include( "sections/footer.php" );?>

    <div id="stop" class="scrollTop">
	    <span><a href=""><i class="fa fa-arrow-up"></i></a></span>
	</div>	

	<?php include( "sections/quick-shop-modal-ajax.php" ) ?>
	
</body>
<script> 
	setFilterBreadCrumb(); 
	cargarElementosCatalogo( 0, <?php echo NPAGINACION ?> );
</script>