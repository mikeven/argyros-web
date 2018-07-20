<?php
    /*
     * Argyros - Página de registro
     * 
     */
    session_start();
    ini_set( 'display_errors', 1 );
    include( "database/bd.php" );
	include( "database/data-user.php" );
	include( "database/data-system.php" );
    include( "database/data-products.php" );
    include( "database/data-countries.php" );
    include( "database/data-categories.php" );
    include( "fn/fn-product.php");
    include( "fn/fn-catalog.php" );
    include( "fn/fn-cart.php" );
    
    checkSession( '' );
?>
<!doctype html>
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->

<!-- Mirrored from demo.designshopify.com/html_jewelry/register.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 12 Jul 2017 16:53:17 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
  <meta charset="UTF-8">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />
  <link rel="canonical" href="http://demo.designshopify.com/" />
  <meta name="description" content=""/>
  <title>Crear cuenta::Argyros</title>
  
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
	<script src="js/fn-user.js" type="text/javascript"></script>
	<script src="js/fn-ui.js" type="text/javascript"></script>
	<script src="js/fn-cart.js" type="text/javascript"></script>

	<style>
		#alert-msgs{ display: none; }
	</style>

</head>
<?php
	$paises = obtenerListaPaises( $dbh );
?>
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
								<a href="index.php" class="homepage-link" title="Regresar a la página de inicio">Inicio</a>
								<span>/</span>
								<span class="page-title">Crear cuenta</span>
							</div>
						</div>
					</div>
				</div>              
				<section class="content">
					<div class="container">
						<div class="row">
							<div id="page-header" class="col-md-24">
								<h1 id="page-title">Registro</h1> 
							</div>
							
							<?php include( "sections/alert-msg.html" );?>
							
							<div id="col-main" class="col-md-14 register-page clearfix">
								<form id="frm_registro" accept-charset="UTF-8" method="post" data-toggle="validator">
									<input value="create_customer" name="form_type" type="hidden">
									<input name="utf8" value="✓" type="hidden">
									<ul id="register-form" class="row list-unstyled">
										<div class="form-group">
											<li id="Name">
											<label class="control-label" for="first_name">Nombre <span class="req">*</span></label>
											<input name="name" id="first_name" class="form-control" type="text" required>
											</li>	
										</div>								
										<li class="clearfix"></li>
										
										<div class="form-group">
											<li id="Email" class="">
											<label class="control-label" for="email">Email <span class="req">*</span></label>
											<input name="email" id="email" class="form-control " type="email" required>
											</li>
										</div>
										<li class="clearfix"></li>
										
										<div class="form-group">
											<li id="Password1" class="">
											<label class="control-label" for="password">Contraseña <span class="req">*</span></label>
											<input name="passw1" id="password" class="form-control password" type="password">
											</li>
										</div>
										<li class="clearfix"></li>
										
										<div class="form-group">
											<li id="Password2" class="">
											<label class="control-label" for="password">Confirmar Contraseña <span class="req">*</span></label>
											<input name="passw2" id="password2" class="form-control password" type="password">
											</li>
										</div>
										<li class="clearfix"></li>

										<div class="form-group">
											<li id="Country" class="">
											<label class="control-label" for="password">País </label>
												<select name="pais" class="form-control selectpicker" data-live-search="true">
				                                    <option disabled selected>Seleccione</option>
				                                    <?php foreach ( $paises as $p ) { ?>
				                                      <option value="<?php echo $p["id"] ?>">
				                                      	<?php echo $p["name"] ?>
				                                      </option>
				                                    <?php } ?>
				                                </select>
											</li>
										</div>
										<li class="clearfix"></li>

										<div class="form-group">
											<li id="Teléfono" class="">
											<label class="control-label" for="telefono">Teléfono </label>
											<input name="telefono" id="telefono" class="form-control " type="text">
											</li>
										</div>
										<li class="clearfix"></li>

										<div class="form-group">
											<li id="Country" class="">
											<label class="control-label" for="tcliente">Tipo cliente </label>
												<select name="tcliente" class="form-control selectpicker">
				                                    <option disabled selected>Seleccione</option>
				                                    <option value="Particular">Particular</option>
				                                    <option value="Tienda">Tienda</option>
				                                    <option value="Tienda">Joyería</option>
				                                    <option value="Distribuidor">Distribuidor</option>
				                                </select>
											</li>
										</div>
										<li class="clearfix"></li>

										<li class="unpadding-top action-last">
											<button id="btn_register" class="btn" type="submit">Enviar</button>
										</li>

									</ul>
								</form>
								<div id="rrss"></div>
							</div>
							<div id="col-main" class="col-md-10 register-page clearfix">
								<h4>Ya poseo cuenta</h4>
								<a href="login.php" class="btn">Iniciar sesión</a>
								<hr>
								<img src="assets/images/hands.jpg" width="100%">
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
</body>