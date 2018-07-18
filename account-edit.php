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
    include( "fn/common-functions.php" );
    
    checkSession( '' );
    $dusuario = obtenerUsuarioSesion( $dbh );
    $paises = obtenerListaPaises( $dbh );
    
?>
<!doctype html>
<!--[if IE 8 ]><html lang="en" class="no-js ie8"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="es" class="no-js"> <!--<![endif]-->

<!-- Mirrored from demo.designshopify.com/html_jewelry/account.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 12 Jul 2017 16:53:16 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
  <meta charset="UTF-8">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />
  <link rel="canonical" href="http://demo.designshopify.com/" />
  <meta name="description" content="" />
  <title>Datos de cuenta :: Argyros</title>
  
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
	<script src="js/fn-account.js" type="text/javascript"></script>
	<script src="js/fn-user.js" type="text/javascript"></script>
	<script src="js/fn-ui.js" type="text/javascript"></script>
	
	<style>

		#panel_edicion_cuenta .list-styled a:hover { color: #a7b239; }
		#panel_edicion_cuenta .list-styled a:focus { color: #a7b239; }
		.data_panel_tab, #frm_nombre_empresa{ display: none; }
		.frm_container{ margin-left: 5%; width: 80%; padding:0 0 50px 0; }
		#cta_es_empresa:hover{ cursor: pointer; }
		#alert-msgs{ display: none; }

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
								<a href="account.php" class="homepage-link" title="Back to the frontpage">Mi cuenta</a>
								<span>/</span>
								<span class="page-title">Editar datos de cuenta</span>
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
									<div class="group_sidebar">											
										<div id="panel_edicion_cuenta" class="sb-wrapper left-sample-block">
											<h4 class="sb-title">Datos de mi cuenta</h4>
											<ul class="list-unstyled sb-content list-styled">
												<li>
													<i class="fa fa-circle"></i>
													<a href="account.php">Volver a pedidos</a>
												</li>
												<li>
													<i class="fa fa-circle"></i>
													<a class="lnk_tabaccount" href="#!" data-target="customer_personal_data">Datos personales</a>
												</li>
												<li>
													<i class="fa fa-circle"></i>
													<a class="lnk_tabaccount" href="#!" data-target="customer_account_data">Datos cuenta</a>
												</li>
											</ul>
										</div>
									</div><!--end group_sidebar-->
								</div>
								<?php } else { ?>
								<p>Ingresa a tu cuenta para acceder a tus datos</p>
								<a href="login.php" class="btn">Iniciar sesión</a>
								<?php } ?>
							</div>
							
							<div id="col-main" class="account-page col-sm-18 col-md-18 clearfix">
								
								<?php include( "sections/alert-msg.html" ); ?>

								<?php if( isset( $_SESSION["login"] ) ) { ?>
								<div id="customer_personal_data" class="data_panel_tab">
									<h2 class="sb-title">Datos personales</h2>
									<span class="mini-line"></span>
									<div class="row frm_container">
										<form id="frm_musuario" method="post" action="" accept-charset="UTF-8">
										  <input id="id_usuario" name="idusuario" type="hidden" 
										  value="<?php echo $_SESSION["user"]["id"]; ?>">
										  <ul class="row list-unstyled customer_address_table">
											<li class="col-md-24">
											  <label class="control-label" for="address_first_name_new">Nombre</label>
											  <input type="text" id="cta_nombre" class="form-control" 
											  name="name" value="<?php echo $dusuario["first_name"]; ?>">
											</li>
											<li class="clearfix"></li>
											<li class="col-md-24">
											  <label class="control-label" for="address_last_name_new">Apellido</label>
											  <input type="text" id="cta_apellido" class="form-control" 
											  name="lastname" value="<?php echo $dusuario["last_name"]; ?>">
											</li>
											<li class="clearfix"></li>
											<li class="col-md-24">
											  <label class="control-label" for="address_company_new">Teléfono</label>
											  <input type="text" id="cta_telf" class="form-control" 
											  name="phone" value="<?php echo $dusuario["phone"]; ?>">
											</li>
											<li class="clearfix"></li>
											<li id="cta_es_empresa" class="col-md-12 set_default">
											  <input type="checkbox" name="cuenta[es_empresa]" value="1"> Compañía
											</li>
											<li class="clearfix"></li>
											<li id="frm_nombre_empresa" class="col-md-12">
											  <label class="control-label" for="cta_nombre_empresa">Nombre de empresa</label>
											  <input type="text" id="cta_nombre_empresa" class="form-control" name="nempresa" 
											  value="<?php echo $dusuario["company_name"]; ?>">
											</li>
											<li class="clearfix"></li>
											<li class="col-md-12">
											  <label class="control-label" for="address_country_new">País</label>
											  <select name="pais" class="form-control selectpicker">
			                                    <option disabled>Seleccione</option>
			                                    <?php foreach ( $paises as $p ) { ?>
			                                      <option value="<?php echo $p["id"] ?>" 
			                                      	<?php echo sop( $p["id"], $dusuario["country_id"] ); ?>>
			                                      	<?php echo $p["name"] ?>
			                                      </option>
			                                    <?php } ?>
			                                  </select>
											</li>
											<li class="clearfix"></li>
											<li class="col-md-24">
											  <label class="control-label" for="address_address1_new">Ciudad</label>
											  <input type="checkbos" id="cta_ciudad" class="form-control" name="ciudad" 
											  value="<?php echo $dusuario["city"]; ?>">
											</li>
											<li class="clearfix"></li>
											
										  </ul>
										  <div class="last clearfix">
											<button id="btn_musuario" class="btn btn-2 mright-7" type="submit">Guardar</button>
										  </div>
										</form>
									</div>
								</div>

								<div id="customer_account_data" class="data_panel_tab">
									<h2 class="sb-title">Email de la cuenta</h2>
									<span class="mini-line"></span>
									<div class="row frm_container">
										<form id="frm_email_cuenta" method="post" action="" accept-charset="UTF-8">
										  <input id="id_usuario_email" name="idusuario" type="hidden" 
										  value="<?php echo $_SESSION["user"]["id"]; ?>">
										  <ul class="row list-unstyled customer_address_table">
											<li class="col-md-24">
											  <label class="control-label" for="cuenta_email">Email</label>
											  <input type="text" id="cta_email" class="form-control" 
											  name="email" value="<?php echo $dusuario["email"]; ?>">
											</li>
											<li class="clearfix"></li>
										  </ul>
										  <div class="last clearfix">
											<button id="btn_memail" class="btn btn-2 btn-actdu" type="submit">Guardar</button>
										  </div>
										</form>	
									</div>
									<hr>
									<h2 class="sb-title">Cambiar contraseña</h2>
									<div class="row frm_container">
										<form id="frm_mcontrasena" method="post" action="" accept-charset="UTF-8">
										  <input id="id_usuario_pass" name="idusuario" type="hidden" 
										  value="<?php echo $_SESSION["user"]["id"]; ?>">
										  <ul class="row list-unstyled customer_address_table">
											<li class="col-md-24 hidden">
											  <label class="control-label" for="cuenta_contrasena_actual">Contraseña actual</label>
											  <input type="password" id="cta_passact" class="form-control" name="apassword" value="">
											</li>
											<li class="clearfix"></li>
											<li class="col-md-24">
											  <label class="control-label" for="cuenta_nva_password1">Nueva contraseña</label>
											  <input type="password" id="cta_nvapass1" class="form-control" name="password1" value="">
											</li>
											<li class="clearfix"></li>
											<li class="col-md-24">
											  <label class="control-label" for="cuenta_nva_password2">Confirmar contraseña</label>
											  <input type="password" id="cta_nvapass2" class="form-control" name="password2" value="">
											</li>
											<li class="clearfix"></li>
										  </ul>
										  <div class="last clearfix">
											<button id="btn_mpassw" class="btn btn-2 mright-7" type="submit">Guardar</button>
										  </div>
										</form>	
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