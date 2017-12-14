<?php
    /*
    * Argyros - Página de orden
    * 
    */
    session_start();
    ini_set( 'display_errors', 1 );
    include( "database/bd.php" );
	include( "database/data-user.php" );
	include( "database/data-order.php" );
    include( "database/data-products.php" );
    include( "database/data-categories.php" );
    include( "fn/fn-product.php" );
    include( "fn/fn-catalog.php" );
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
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
  <meta charset="UTF-8">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />
  <link rel="canonical" href="http://demo.designshopify.com/" />
  <meta name="description" content=""/>
  <title>Orden :: Argyros</title>
  
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
	<link href="assets/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" media="all">
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
	<script src="js/fn-order.js" type="text/javascript"></script>
	<script src="js/fn-cart.js" type="text/javascript"></script>

	<style>
		.action_confirm{ display: none; }
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
								<?php if( isset($orden ) ) { ?>
								<h1 id="page-title">Orden <?php echo "#".$orden["id"]?></h1>
								<?php } ?>
							</div>
							<div id="col-main" class="address-page manage-address clearfix">								
								<div class="clearfix">
								  <div id="address_tables">
									
									<div class="clearfix">
									  <div class="col-md-10 first">
										<div id="parent_address_226447297" class="address_table">
										  
										  <div id="view_address_226447297" class="customer_address view_address clearfix">
											<?php if( isset( $orden ) ) { ?>
											<div class="address_info col-md-14">
												
												<div class="info">
													<?php echo $orden["icono_e"]; ?>
													<input type="hidden" id="idorden" value="<?php echo $orden["id"]?>">
													<input type="hidden" id="accion_orden" value="">
													<span class="address-group">
													<span class="author">Fecha: <?php echo $orden["fecha"]?></span>
													</span>
													<div style="margin-left:60px">
													<div>Total: $<?php echo $orden["total"]?></div>
													<div><?php echo $orden["nitems"]?> ítems</div>
													<div>Estado: <?php echo $orden["estado"]?> </div>
													</div>
												</div>
												
											</div>
											<div id="tool_address_1940927491" class="address_actions col-md-10">
												<?php if( $orden["estado"] == "pendiente" ) { ?>
													<span id="_a_cancel_o" class="action_delete">
														<a id="a_cancel_o" href="#!" class="lnco" title="Cancelar" 
														data-cnt="_a_cancel_o" data-sta="cancelado">
															<i class="fa fa-times"></i><span>Cancelar</span>
														</a>
													</span>
												<?php } ?>
												<span id="cn_co" class="action_delete action_confirm">
													<a id="a_cancel_conf" href="#!" title="Cancelar">
														<span>Confirmar</span>
													</a> &nbsp; | &nbsp;
													<a id="cancel_cancel" href="#!" title="Cancelar" data-trg="">
														<span>Cancelar</span>
													</a>
												</span>
												<?php if( $orden["estado"] == "cancelado" ) { ?>
													<span id="_a_cancel_ro" class="action_delete">
														<a id="a_react_o" href="#!" class="lnco" title="Reactivar"  
														data-cnt="_a_cancel_ro" data-sta="pendiente">
															<i class="fa fa-history"></i><span> Reactivar</span>
														</a>
													</span>
												<?php } ?>
											</div>
											<?php } ?>
										  </div>
										</div>
									  </div>

									  <div class="col-md-14 first">
										<div id="parent_address_226447297" class="address_table">
										<?php if( isset($orden ) ) { ?>  
										<table class="table-hover">
											<thead>
											<tr>
												<th> </th>
												<th>Producto</th>
												<th>Cantidad</th>
												<th>Precio unit</th>
												<th>Total</th>
											</tr>
											</thead>
											<tbody>
												<?php 
											      foreach ( $odetalle as $r ) {
											        $total_item = $r["quantity"] * $r["price"];
											    ?>
											    <tr>
											      <td><img src="<?php echo $purl.$r["imagen"]; ?>" width="70"></td>
											      <td><a href="#!"><?php echo $r["producto"]." (".$r["description"].")"." | "."Talla: ".$r["talla"]; ?></a></td>
											      <td align="center"><?php echo $r["quantity"]; ?></td>
											      <td>$<?php echo $r["price"]; ?></td>
											      <td>$<?php echo $total_item; ?></td>
											    </tr>
											    <?php } ?>
											</tbody>
										</table>		
										<?php } ?>
										</div>
									  </div>

									</div>
									
								  </div>
								</div>
								<!--<div class="clearfix col-md-24">
								  <button id="new-address" class="btn" onclick="HTML.CustomerAddress.toggleNewForm();return false">Add New Address</button>
								</div>-->
								<script type="text/javascript">
								  var HTML = new Object();
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
								  }
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