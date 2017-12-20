<?php
    /*
     * Argyros - Página de registro
     * 
     */
    session_start();
    ini_set( 'display_errors', 1 );
    include( "database/bd.php" );
	include( "database/data-user.php" );
	include( "database/data-order.php" );
	include( "database/data-system.php" );
    include( "database/data-products.php" );
    include( "database/data-countries.php" );
    include( "database/data-categories.php" );
    include( "fn/fn-order.php");
    include( "fn/fn-product.php");
    include( "fn/fn-catalog.php" );
    
    checkSession( '' );
	$carrito = $_SESSION["cart"];    
    
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
  <meta name="description" content="" />
  <title>Mi cuenta::Argyros</title>
  
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

	<script src="js/fn-product.js" type="text/javascript"></script>
	<script src="js/fn-cart.js" type="text/javascript"></script>
	<script src="js/fn-user.js" type="text/javascript"></script>
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
								<h1 id="page-title">Mi cuenta</h1> 
							</div>
							<div class="col-sm-6 col-md-6 sidebar">
								<?php if( isset( $_SESSION["login"] ) ) { ?>
								<div class="group_sidebar">
									<div class="row sb-wrapper unpadding-top">
										<h4 class="sb-title">Datos de la cuenta</h4>
										<span class="mini-line"></span>
										<ul id="customer_detail" class="list-unstyled sb-content">
											<li>
											<address class="clearfix">
											<div class="info">
												<i class="fa fa-user"></i>
												<span class="address-group">
													<span class="author">
														<?php echo $_SESSION["user"]["first_name"]?>
													</span>
													<span class="email">
														<?php echo $_SESSION["user"]["email"]?>
													</span>
												</span>
											</div>
											<div class="address">
												<span class="address-group">
												<span class="address1">Ung Van Khiem, Ho Chi Minh city, Vietnam<span class="phone-number"></span></span>
												</span>
											</div>
											</address>
											</li>
											<li>
												<a href="account-edit.php" class="btn btn-1" id="btn_edit_profile">Editar datos</a>
											</li>
										</ul>
									</div>
								</div>
								<?php } else { ?>
								<p>Ingresa a tu cuenta para acceder a tus datos</p>
								<a href="login.php" class="btn">Iniciar sesión</a>
								<?php } ?>
							</div>
							
							<div id="col-main" class="account-page col-sm-18 col-md-18 clearfix">
								<?php if( isset( $_SESSION["login"] ) ) { ?>
								<div id="customer_orders">
									<h4 class="sb-title">Historial de órdenes</h4>
									<span class="mini-line"></span>
									<div class="row wrap-table">
										<table class="table-hover">
										<thead>
										<tr>
											<th class="order_number">
												Orden
											</th>
											<th class="date">
												Fecha
											</th>
											<th class="payment_status">
												Status
											</th>
											<th class="total">
												Total
											</th>
										</tr>
										</thead>
										<tbody>
										<?php foreach ( $ordenes as $orden ) { ?>
										<tr class="odd">
											<td>
												<a href="order.php?id=<?php echo $orden["id"] ?>">#Pedido <?php echo $orden["id"] ?></a>
											</td>
											<td>
												<span class="note"><?php echo $orden["fecha"] ?></span>
											</td>
											<td>
												<span class="note"><?php echo $orden["estado"] ?></span>
											</td>
											<td>
												<span class="note">$<?php echo $orden["total"] ?></span>
											</td>
										</tr>
										<?php } ?>
										</tbody>
										</table>
									</div>
								</div>
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