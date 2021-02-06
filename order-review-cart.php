<?php
    /*
     * Argyros - Página de registro
     * 
     */
    include( "database/init.php" );
    include( "database/bd.php" );
	include( "database/data-user.php" );
	include( "database/data-system.php" );
    include( "database/data-products.php" );
    include( "database/data-countries.php" );
    include( "database/data-categories.php" );
    include( "fn/fn-product.php");
    include( "fn/fn-catalogue.php" );
    include( "fn/fn-cart.php" );

	checkSession( '' );
    checkUsuarioBloqueado( $dbh );
    $carrito = $_SESSION["cart"];
    //$carrito = quitarCantidadesCero( $_SESSION["cart"] );
    $total = obtenerMontoTotalCarritoCompra();
    
?>
<!doctype html>
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->

<!-- Mirrored from demo.designshopify.com/html_jewelry/account.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 12 Jul 2017 16:53:16 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
  <meta charset="UTF-8">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />
  <link rel="canonical" href="http://demo.designshopify.com/" />
  <meta name="description" content=""/>
  <title>Revisión de orden::Argyros</title>
  
    <link href="assets/stylesheets/font.css" rel='stylesheet' type='text/css'>
	<link href="assets/stylesheets/font-awesome.min.css" rel="stylesheet" type="text/css" media="all"> 	
	<link href="assets/stylesheets/bootstrap.min.3x.css" rel="stylesheet" type="text/css" media="all">
	<link href="assets/stylesheets/cs.bootstrap.3x.css" rel="stylesheet" type="text/css" media="all">
	<link href="assets/stylesheets/cs.animate.css" rel="stylesheet" type="text/css" media="all">
	<link href="assets/stylesheets/cs.global.css" rel="stylesheet" type="text/css" media="all">
	<link href="assets/stylesheets/cs.style.css" rel="stylesheet" type="text/css" media="all">
	<link href="assets/stylesheets/cs.media.3x.css" rel="stylesheet" type="text/css" media="all">
	<link href="assets/bootstrap-select-1.12.4/dist/css/bootstrap-select.min.css" rel="stylesheet" type="text/css" media="all">
	<link href="assets/bootstrapvalidator/dist/css/bootstrapValidator.min.css" rel="stylesheet" type="text/css" media="all">
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
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

	<!-- Select -->
	<script src="assets/bootstrap-select-1.12.4/dist/js/bootstrap-select.min.js" type="text/javascript"></script>

	<script src="js/fn-ui.js" type="text/javascript"></script>
	<script src="js/fn-product.js" type="text/javascript"></script>
	<script src="js/fn-user.js" type="text/javascript"></script>
	<script src="js/fn-order.js" type="text/javascript"></script>
	<?php include( "fn/ga.php" ); ?>

	<style type="text/css">
		#col-main{ margin-right: 70px; }
		#col-sec{ margin: 0 auto; }
		#cart-drop-icon{ visibility: hidden; }
		.oreview:hover{ color: #969d58 !important; }
		#regresar_carrito{ padding: 10px 0; }

		@media (max-width: 1024px){
			#col-main {
			    margin-right: 0px;
			}
			thead tr {
    			position: relative !important;
			}
			#customer_orders td {
			    padding-left: 8% !important;
			}
		}

		#nota_tyc{
			text-align: center;
			padding: 8px;
			border: 1px solid #969d58;
		}

	</style>
</head>

<body itemscope="" itemtype="http://schema.org/WebPage" class="templateCustomersRegister notouch">
  
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
								<span class="page-title">Mi cuenta</span>
							</div>
						</div>
					</div>
				</div>              
				<section class="content">
					<div class="container">
						<div class="row">
							<div id="page-header" class="col-md-24">
								<h1 id="page-title">Revisión de orden</h1> 
							</div>
							
							<div id="col-main" class="account-page col-sm-16 col-md-16 clearfix">
								<?php if( isset( $_SESSION["login"] ) ) { ?>
								<div id="customer_orders">
									<h4 class="sb-title">Contenido del pedido</h4>
									<span class="mini-line"></span>
									<div class="row wrap-table">
										<table class="table-hover">
											<thead>
												<tr>
													<th class="order_number"> </th>
													<th class="order_number" style="text-align: left;">
														Item
													</th>
													<th class="date">
														Cant
													</th>
													<th class="payment_status">
														Precio
													</th>
													<th class="fulfillment_status">
														Subtotal
													</th>
												</tr>
											</thead>
										
											<tbody>
											<?php 
												foreach ( $carrito as $item ) { 
													$lnkp = "product.php?id=$item[idproducto]&iddet=$item[iddetalle]";
											?>
												<tr class="odd ">
													<td>
														<img src="<?php echo $item["img_producto"]?>" 
														alt="<?php echo $item["nombre_producto"]?>" width="50">
													</td>
													<td style="text-align: left;">
														<a href="<?php echo $lnkp; ?>" 
														title="" target="_blank"><?php echo $item["nombre_producto"]?></a>
														<div>
														<span class="note">
														<?php //echo $item["descripcion_producto"]?></span>
														(Talla: <?php echo $item["seltalla"]?>)
														</div>
													</td>
													<td>
														<span class="note"><?php echo $item["quantity"]?></span>
													</td>
													<td>
														<span class="note">$<?php echo $item["unit_price"]?></span>
													</td>
													<td align="right">
														<span class="note">$<?php echo $item["subtotal"]?></span>
													</td>
												</tr>
											<?php } ?>
											</tbody>
										
										</table>
									</div>
									<div id="nota_tyc">
										Al procesar este pedido usted acepta los <a href="https://argyros.com.pa/terms-and-conditions.php"> Términos y Condiciones </a> de Argyros Inc.
									</div>
								</div>
								<?php } ?>
							</div>

							<div id="col-sec" class="col-sm-6 col-md-6 sidebar">
								<?php if( isset( $_SESSION["login"] ) ) { ?>
								<div class="group_sidebar">
									<div class="row sb-wrapper unpadding-top">
										<h4 class="sb-title">Confirmación de orden</h4>
										<span class="mini-line"></span>
										<ul id="customer_detail" class="list-unstyled sb-content">
											<li>
											<address class="clearfix">
											<div class="info">
												<i class="fa fa-archive"></i>
												<span class="author">
													<?php echo count( $carrito )?> ítems
												</span>
											</div>
											<div class="address">
												<span class="author">
													Total orden: $<?php echo $total ?>
												</span>
											</div>
											</address>
											</li>
											<li>
											<?php if ( count( $_SESSION["cart"] ) > 0 ) { ?>
												<a href="#!" id="btn_order" class="btn btn-1">Hacer pedido</a>
												<div id="loading-icon"></div>
												<div id="regresar_carrito">
													<a href="cart.php" id="btn_cart" class="oreview" 
													id="btn_cart">Regresar al carrito</a>
												</div>
											<?php } else { ?>
												<a href="account.php" id="btn_account" class="btn btn-1">Ver mis órdenes</a>
											<?php } ?>
												
											</li>
										</ul>
									</div>
								</div>
								<?php } else { ?>
								<p>Ingresa a tu cuenta para acceder a tus datos</p>
								<a href="login.php" class="btn">Iniciar sesión</a>
								<?php } ?>
							</div>

						</div>
					</div>
				</section>        
			</div>
		</div>
	</div>

	<!-- Validator -->
	<script src="assets/bootstrapvalidator/dist/js/bootstrapValidator.min.js" type="text/javascript"></script>
	
	<!-- Footer -->
	<?php include("sections/footer.php"); ?>

</body>