<?php
    /*
     * Argyros - Página de restablecimiento de contraseña
     * 
     */
    session_start();
    ini_set( 'display_errors', 1 );
    include( "database/bd.php" );
	include( "database/data-user.php" );
	include( "database/data-system.php" );
    include( "database/data-products.php" );
    include( "database/data-categories.php" );
    include( "fn/fn-product.php");
    include( "fn/fn-catalog.php" );
    include( "fn/fn-cart.php" );
    
    checkSession( 'recuperar' );
    if( isset( $_GET["token_reset"] ) ){
    	$token = $_GET["token_reset"];
    	$usuario = obtenerUsuarioTokenNuevoPassword( $dbh, $token );
	}
?>
<!doctype html>
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->

<!-- Mirrored from demo.designshopify.com/html_jewelry/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 12 Jul 2017 16:53:17 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
  <meta charset="UTF-8">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />
  <link rel="canonical" href="http://demo.designshopify.com/" />
  <meta name="description" content="" />
  <title>Restablecer contraseña::Argyros</title>
  
	<link href="assets/stylesheets/font.css" rel='stylesheet' type='text/css'>
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
	<!-- Tooltips -->
	<script src="assets/tooltips/js/tooltipster.bundle.min.js" type="text/javascript"></script>

	<!-- Select -->
	<script src="assets/bootstrap-select-1.12.4/dist/js/bootstrap-select.min.js" type="text/javascript"></script>

	<script src="js/fn-product.js" type="text/javascript"></script>
	<script src="js/fn-account.js" type="text/javascript"></script>
	<script src="js/fn-user.js" type="text/javascript"></script>
	<script src="js/fn-cart.js" type="text/javascript"></script>
	<script src="js/fn-ui.js" type="text/javascript"></script>

	<style> #alert-msgs{ display: none; } </style>
</head>

<body itemscope="" itemtype="http://schema.org/WebPage" class="templateCustomersRegister notouch">
  
	<!-- Header -->
	<?php include( "sections/header.php" ); ?>
  
	<div id="content-wrapper-parent">
		<div id="content-wrapper">  
			<!-- Content -->
			<div id="content" class="clearfix">        
				<!--<div id="breadcrumb" class="breadcrumb">
					<div itemprop="breadcrumb" class="container">
						<div class="row">
							<div class="col-md-24">
								<a href="index.php" class="homepage-link" title="Back to the frontpage">Inicio</a>
								<span>/</span>
								<span class="page-title">Recuperar contraseña</span>
							</div>
						</div>
					</div>
				</div>-->              
				<section class="content">
					<div class="container">
						<div class="row">
							<div id="page-header" class="col-md-24">
								<h1 id="page-title">Restablecer contraseña</h1> 
							</div>
							<div id="col-main" class="col-md-24 register-page clearfix">
								<div class="row checkout-form">
									<div class="col-md-16 row-left">
										<!-- Password Recovery -->
										<?php include( "sections/alert-msg.html" ); ?>
										
										<div id="customer-login">
											<?php if( isset( $usuario ) ) { ?>
											<div class="checkout-title">
												<span class="general-title">Ingresa tu nueva contraseña y confírmala</span>
											</div>
											<form method="post" id="frm_newpassword" accept-charset="UTF-8" data-toggle="validator">
												<input id="id_usuario_email" name="idusuario" type="hidden" value="<?php echo $usuario["id"]; ?>">
										  		<input id="token_recovery" name="token" type="hidden" value="<?php echo $token; ?>">
												<ul id="passw-recovery" class="list-unstyled">
													<li class="clearfix"></li>
													<li id="new_passw_recov" class="col-md-21">
													<label class="control-label" for="new_password">Contraseña<span class="req">*</span></label>
													<input type="password" value="" name="password1" id="newpass1" class="form-control">
													</li>
													<li class="clearfix"></li>
													<li id="new_passw_recov" class="col-md-21">
													<label class="control-label" for="new_password">Confirmar nueva contraseña<span class="req">*</span></label>
													<input type="password" value="" name="password2" id="newpass2" class="form-control">
													</li>
													
													<li class="col-md-21 unpadding-top">
													<ul class="login-wrapper list-unstyled">
														<li>
															<button id="btn_envnpass" class="btn" type="submit">Guardar</button>
														</li>
													</ul>
													</li>
													<div id="rrss"></div>
												</ul>
											</form>
											<?php } else {?>
												<div class="checkout-title">
													<span class="general-title">Esta solicitud de restablecimiento de contraseña no es válida.<br> 
													Verifique el enlace o solicite restablecer su contraseña nuevamente</span>
												</div>
												<ul class="login-wrapper list-unstyled">
													<li>
														<a href="password_recovery.php">
															<button class="btn" type="submit">Solicitar restablecer contraseña</button>
														</a>
													</li>
												</ul>
											<?php } ?>
										</div>

										<!-- /.Password Recovery -->
									</div>
								</div>
							</div>   
						</div>
					</div>
				</section>        
			</div>
		</div>
	</div>
	<!-- Validator -->
	<script src="assets/bootstrapvalidator/dist/js/bootstrapValidator.min.js" type="text/javascript"></script>
	
	<?php //include("sections/footer.php"); ?>
</body>