<?php
    /*
     * Argyros - Página catálogo sin sesión
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

    if( !isset( $_GET["cat"] ) ){
    	echo "<script> window.location = 'categories.php'</script>";
    }
    $categoria 		= obtenerCategoriaPorId( $dbh, $_GET["cat"] );
    $subcategorias 	= obtenerListaSubCategoriasCategoria( $dbh, $_GET["cat"] );
    $ctguname 		= $_GET["category"];

?>
<!doctype html>
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> 
<html lang="es" class="no-js"> <!--<![endif]-->

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
	<?php include( "fn/ga.php" ); ?>

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
	
	.categ_catalog{
		max-width: 100% !important;
	}
	#blocked-sesion-catalog{
		font-size: 32px;
	}

	.newline-row{ margin: 30px 0; }
	@media( max-width: 768px ){
		.tit_subctg h6{ margin-top: 20px; }
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
								<a href="index.php" class="homepage-link" title="Regresar al inicio">
									Inicio
								</a>
								<span>/</span>
								<a href="categories.php"> <?php echo "Catálogo"; ?> </a>
								<span>/</span>
								<span class="page-title"><?php echo $categoria["name"]; ?></span>
							</div>
							<div id="title-categories">
								<h1 id="page-title" class="text-right"><?php //echo $categoria["name"]; ?></h1>
							</div>
						</div>
					</div>
				</div>
                
				<section class="content">
					<div class="container">
						<div class="row"> 
							<div id="collection-content">
								<div id="page-header"></div>
								
								<div class="collection-main-content" style="min-height: 295px">									
								   <div id="col-main" class="collection collection-page col-xs-24 col-sm-24">
										
										<?php if( isset( $_SESSION["login"] ) ) { ?>
											<div id="sandBox-wrapper" class="group-product-item row collection-full">
												
												<div class="group_home_collections row">
													<div class="col-md-24">
														<div class="home_collections">
															<h4><?php echo $categoria["name"]; ?></h4>
															<h6 class="general-title">SUBCATEGORÍAS</h6>

															<?php 
																$cont_i = -1;
																foreach ( $subcategorias as $sc ) {
																$cont_i++; 
																$imagen = obtenerImagenSubcategoria( $dbh, $sc["id"] );
																$imagen = $imagen["imagen"];
																$lnk = URLBASECAT."?c=$ctguname&s=$sc[uname]";
																if( $imagen != "" ){
															?>
																
																<?php if( $cont_i == 0 ) { ?>
																	<div class="group_home_collections newline-row row">
																<?php } ?>

																<div class="home_collections_item col-md-6 col-sm-6 col-xs-24 fadeInUp animated <?php echo $cont_i ?>">
																	<div class="home_collections_item_inner">
																		<div class="hover-overlay tit_subctg" align="center">
																			<span class="col-name">
																				<a href="<?php echo $lnk ?>"><h6> 
																					<?php echo $sc["name"]; ?></h6>
																				</a> 
																			</span>
																		</div>
																		<div class="collection-details">
																			<a href="<?php echo $lnk ?>" 
																				title="<?php echo $sc["name"];?>">
																				<img src="admin/<?php echo $imagen;?>" 
																				alt="$sc[name]" class="categ_catalog">
																			</a>
																		</div>
																		
																	</div>
																</div>

																<?php if( $cont_i == 3 ) { $cont_i = -1; ?>
																	</div>
																<?php } ?>

															<?php } } ?>


															
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
										<?php } else { ?>

											<h6 id="blocked-sesion-catalog" 
											class="sb-title"><i class="fa fa-home"></i>
											INICIA SESIÓN PARA VER EL CATÁLOGO
											</h6>
											<a href="login.php">
												<button type="submit" class="btn">Iniciar sesión</button>
											</a>
										<?php } ?>
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
	
</body>