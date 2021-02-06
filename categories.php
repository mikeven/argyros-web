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
  <title>Categorías::Argyros</title>
  
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
	<?php include( "fn/ga.php" ); ?>
	
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
	#blocked-sesion-catalog{
		font-size: 32px;
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
								<span class="page-title">Categorías</span>
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
								
								<div class="collection-main-content" style="min-height: 295px">									
								   <div id="col-main" class="collection collection-page col-xs-24 col-sm-24">
										
										<?php if( isset( $_SESSION["login"] ) ) { ?>
											<div id="sandBox-wrapper" class="group-product-item row collection-full">
												
												<div class="group_home_collections row">
													<div class="col-md-24">
														<div class="home_collections">
															<h6 class="general-title">CATEGORÍAS</h6>
															<?php foreach ( $lh_cat_ppal as $rcp ) { 
																
																$lnk = "subcategories.php?category=$rcp[uname]&cat=$rcp[id]";
																if( $rcp["id"] != 0 ){
															?>
																<div class="home_collections_item col-md-6 col-sm-6 col-xs-24 fadeInUp animated">
																	<div class="home_collections_item_inner">
																		<div class="hover-overlay" align="center">
																			<span class="col-name">
																				<a href="<?php echo $lnk ?>" 
																					alt="<?php echo $rcp["name"]; ?>"><h6> 
																				<?php echo $rcp["name"]; ?></h6></a> 
																			</span>
																			<div class="collection-action hidden">
																				<a href="<?php echo URLBASECAT?>?c=<?php echo $rcp["uname"];?>">VER CATÁLOGO</a>
																			</div>
																		</div>
																		<div class="collection-details">
																			<a href="<?php echo $lnk ?>" 
																				title="<?php echo $rcp["name"];?>">
																			<?php if($rcp["image"] != "" ) { ?>
																			<img src="assets/images/<?php echo $rcp["image"];?>" alt="Rings" class="categ_catalog">
																			<?php } else { ?>
																			<img src="assets/images/<?php echo $rcp["image"];?>" alt="Rings" class="categ_catalog">
																			<?php } ?>
																			</a>
																		</div>
																		
																	</div>
																</div>
															<?php }} ?>
															
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