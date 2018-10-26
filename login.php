<?php
    /*
     * Argyros - Página de inicio de sesión
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
    
    checkSession( 'login' );
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
  <title>Inicio de sesión::Argyros</title>
  
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
				<div id="breadcrumb" class="breadcrumb">
					<div itemprop="breadcrumb" class="container">
						<div class="row">
							<div class="col-md-24">
								<a href="index.php" class="homepage-link" title="Back to the frontpage">Inicio</a>
								<span>/</span>
								<span class="page-title">Inicio de sesión</span>
							</div>
						</div>
					</div>
				</div>              
				<section class="content">
					<div class="container">
						<div class="row">
							<div id="page-header" class="col-md-24">
								<h1 id="page-title">Inicio de sesión</h1> 
							</div>
							<div id="col-main" class="col-md-24 register-page clearfix">
								<div class="row checkout-form">
									<div class="col-md-12 row-left">
										<!-- Customer Account Login -->
										<div id="customer-login">
											<div class="checkout-title">
												<span class="general-title">Ingreso de clientes</span>
											</div>
											<form method="post" id="frm_login" accept-charset="UTF-8" data-toggle="validator">
												
												<input type="hidden" value="customer_login" name="form_type"><input type="hidden" name="utf8" value="✓">
												
												<?php include( "sections/alert-msg.html" ); ?>

												<ul id="login-form" class="list-unstyled">
													<li class="clearfix"></li>
													<li id="login_email" class="col-md-21">
													<label class="control-label" for="email_login">Email<span class="req">*</span></label>
													<input type="email" value="" name="email" id="email_login" class="form-control">
													</li>
													<li class="clearfix"></li>
													<li id="login_password" class="col-md-21">
													<label class="control-label" for="cpassword_login">Password <span class="req">*</span></label>
													<input type="password" value="" name="password" id="password_login" class="form-control password">
													</li>
													<li class="col-md-21 unpadding-top">
													<ul class="login-wrapper list-unstyled">
														<li>
															<button id="btn_login" class="btn" type="submit">Ingresar</button>
														</li>
														<li>
															<a id="recpassword" href="#!">¿ Recuperar contraseña ?</a>
														</li>
														<li>
															<a href="register.php">Registrarse</a>
														</li>
													</ul>
													</li>
													<div id="rrss"></div>
												</ul>
											</form>
										</div>
										<!-- Password Recovery -->
										<div id="recover-password" style="display:none;" 
										class="col-md-24 row-left">
											<div class="checkout-title">
												<span class="general-title">Recuperar contraseña</span>
												<span class="line"></span>
											</div>
											<p class="note">
												Ingresa el email asociado a tu cuenta. <br>
												Recibirás las instrucciones para recuperar tu contraseña en tu buzón de correo
											</p>
											<form method="post" id="frm_passwrecovery" accept-charset="UTF-8" data-toggle="validator">
												<input type="hidden" value="recover_customer_password" name="form_type"><input type="hidden" name="utf8" value="✓">
												<ul id="recover-form" class="list-unstyled clearfix">
													<li class="clearfix"></li>
													<li id="recover_email" class="col-md-21">
													<label class="control-label">Email<span class="req">*</span></label>
													<input type="email" value="" name="email" id="email_login" class="form-control">
													</li>
													<li class="col-md-21 unpadding-top">
														<ul class="login-wrapper list-unstyled">
															<li>
																<button id="btn_envrecov" class="btn btn-1" 
																type="submit">Enviar</button>
															</li>
															<li>
																<a class="return" href="index.php">
																	Regresar a la tienda
																</a>
															</li>
														</ul>
													</li>
												</ul>
											</form>
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
	<!-- Validator -->
	<script src="assets/bootstrapvalidator/dist/js/bootstrapValidator.min.js" type="text/javascript"></script>
	<?php include("sections/footer.php"); ?>
	
	<?php if( isset( $_GET["err"] ) ){ ?>
		<script>
			mensajeAlerta( "#alert-msgs", "USUARIO O CONTRASEÑA INCORRECTA, CHEQUEE SUS CREDENCIALES" );
		</script>
	<?php } ?>
</body>