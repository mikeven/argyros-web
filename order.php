<?php
    /*
    * Argyros - Página de orden
    * 
    */
    include( "database/init.php" );
    include( "database/bd.php" );
	include( "database/data-user.php" );
	include( "database/data-order.php" );
    include( "database/data-products.php" );
    include( "database/data-categories.php" );
    include( "fn/fn-product.php" );
    include( "fn/fn-catalogue.php" );
    include( "fn/fn-order.php" );
    include( "fn/fn-cart.php" );
    
    if( !isset( $_SESSION["user"] ) ){
		header("Location: account.php");
	}
    $carrito = $_SESSION["cart"];
    checkSession( '' );
?>
<!doctype html>
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->

<!-- Mirrored from demo.designshopify.com/html_jewelry/address.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 12 Jul 2017 16:54:10 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
  <meta charset="UTF-8">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />
  <link rel="canonical" href="http://demo.designshopify.com/" />
  <meta name="description" content=""/>
  <link rel="icon" type="image/png" href="https://www.argyros.com.pa/assets/images/afavicon.png">
  <title>Orden :: Argyros</title>
  
    <link href="assets/stylesheets/font.css" rel='stylesheet' type='text/css'>
  
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
	<link href="assets/stylesheets/spr.css" rel="stylesheet" type="text/css" media="all">
	<link href="assets/stylesheets/addthis.css" rel="stylesheet" type="text/css" media="all">
	<link href="assets/font-awesome-4.7.0/css/font-awesome.css" rel="stylesheet" type="text/css" media="all">
	<!--<link href="assets/tooltips/css/tooltipster.bundle.min.css" rel="stylesheet" type="text/css" media="all">
	<link href="assets/tooltips/css/plugins/tooltipster/sideTip/themes/tooltipster-sideTip-shadow.min.css" rel="stylesheet" type="text/css" media="all">
	<link href="assets/tooltips/css/plugins/tooltipster/sideTip/themes/tooltipster-sideTip-noir.min.css" rel="stylesheet" type="text/css" media="all">-->


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
	<!-- Tooltips -->
	<script src="assets/tooltips/js/tooltipster.bundle.min.js" type="text/javascript"></script>
	
	<script src="js/fn-ui.js" type="text/javascript"></script>
	<script src="js/fn-user.js" type="text/javascript"></script>
	<script src="js/fn-product.js" type="text/javascript"></script>
	<script src="js/fn-cart.js" type="text/javascript"></script>
	<script src="js/fn-order.js" type="text/javascript"></script>

	<?php include( "fn/ga.php" ); ?>

	<style>
		.action_confirm, .panel_desplegable{ display: none; }
		.tit_pedido{ 
			background: #e7e7e7;
    		padding: 5px 10px;
    		margin: 5px 0px;
    	}
    	.separador{ padding: 10px 0; }
    	.tp_active{ background: #a7b239; }
		.tit_pedido h2{ margin: 0; }
		.tit_pedido:hover{ cursor: pointer; background: #a7b239; }
		
		.tabla-pedido tbody td, table tfoot td {
		    padding: 5px 20px;
		}
		.tabla-pedido thead th, table thead td {
		    padding: 0px 20px;
		}

		.monto_total_orden{

		}

		.icancelp:hover{ cursor: pointer; }

		.colrev{ background: #a7b239; }
		.modal-dialog {
			max-width: 400px;
		    width: 100%;
		}

		.tabla-pedido tbody tr{
			transition: background-color 0.5s ease;
		}
		#i_rmped{
			margin-left: 15px;
		}
		#b_confirmacion_pedido{
			padding: 10px 0; 
		}

		.txa-l{ text-align: left; }

		.coltotales{
			padding: 5px 8px !important;
		}

		.detlist-id-det{
			font-size: 11px; font-weight: bold; color: #696f24; 
		}

		.data_total_orden {
		    font-weight: 900;
		    color: #696f24;
		}

		.tx_sta_pedido{
			color: #696f24;
			text-transform: capitalize;
		}

		@media (max-width: 1024px){
			thead tr {
			    position: relative !important;
			}

			td {
			    padding-left: 5% !important;
			}

			.bloque_pedido{
				max-width: 600px;
				overflow-x: scroll; 	
			}
		}

		#items_retirados{ padding-top: 16px; }
		.iretirados{ background-color: #f3dada; }

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
								<a href="index.php" class="homepage-link" title="Back to the frontpage">Home</a>
								<span>/</span>
								<a href="account.php" class="homepage-link" title="Back to the frontpage">Cuenta</a>
								<span>/</span>
								<span class="page-title">Orden</span>
							</div>
						</div>
					</div>
				</div>              
				<section class="content">
					
					<div class="container">
						<div class="row">
							<div id="page-header" class="col-md-24">
								<?php if( isset( $orden ) ) { ?>
								<h1 id="page-title">Orden <?php echo "#".$orden["id"]?></h1>
								<?php } else { ?>
									<h1>Registro no encontrado</h1>
								<?php } ?>	
							</div>
							<div id="col-main" class="address-page manage-address clearfix">								
								<div class="clearfix">
								  <div id="address_tables">
									
									<div class="clearfix">
									  <div class="col-md-6 first">
										<?php include( "sections/order-info.php" ); ?>
									  </div>

									  <div class="col-md-18 first">
										
										<?php if( ( $orden["estado"] == "pendiente" ) || 
										          ( $orden["estado"] == "cancelado" ) ) { ?>
										<div id="pedido_inicial" class="bloque_pedido">
											<?php 
												if( isset( $orden ) ) { 
													include( "sections/tablas/tabla-pedido-inicial.php" );
												}
											?>
										</div>
										<?php } ?>

										<?php if( $orden["estado"] == "revisado" ) { ?>
											<form id="frm_mpedido" name="form_pedido_modificado">
												<div id="pedido_revisado" class="bloque_pedido">
													<?php include( "sections/tablas/tabla-pedido-revision.php" ); ?>
												</div>
											</form>
											<?php include( "sections/modal-confirmation.html" ); ?>
										<?php } ?>

										<?php if( $orden["estado"] == "confirmado" || 
										          $orden["estado"] == "entregado" ) { ?>
											<div id="pedido_confirmado" class="bloque_pedido">
												<?php include( "sections/tablas/tabla-pedido-confirmado.php" ); ?>
											</div>
										<?php } ?>

									  </div>

									</div>
									
								  </div>
								</div>
								<!--<div class="clearfix col-md-24">
								  <button id="new-address" class="btn" onclick="HTML.CustomerAddress.toggleNewForm();return false">Add New Address</button>
								</div>-->
								<script type="text/javascript">
								  /*var HTML = new Object();
								  HTML.CustomerAddress = {
									toggleForm: function(id) {
									  var editEl = document.getElementById('edit_address_'+id);
									  var toolEl = document.getElementById('tool_address_'+id);      
									  editEl.style.display = editEl.style.display == 'none' ? '' : 'none';
									  toolEl.style.visibility = toolEl.style.visibility == 'hidden' ? '' : 'hidden';
									  return false;    
									},
									
									toggleNewForm: function() {
									  var el = document.getElementById('add_address');
									  el.style.display = el.style.display == 'none' ? '' : 'none';
									  return false;
									},
									
									destroy: function(id, confirm_msg) {
									  if (confirm(confirm_msg || "Are you sure you wish to delete this address?")) {
									  }      
									}
								  }*/
								</script>
							  </div>						
						</div>
					</div>

				</section>        
			</div>
		</div>
	</div>

	<?php include("sections/footer.php");?>
</body>