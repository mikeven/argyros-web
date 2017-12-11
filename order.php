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
	<link href="assets/stylesheets/bootstrap.min.3x.css" rel="stylesheet" type="text/css" media="all">
	<link href="assets/stylesheets/cs.bootstrap.3x.css" rel="stylesheet" type="text/css" media="all">
	<link href="assets/stylesheets/cs.animate.css" rel="stylesheet" type="text/css" media="all">
	<link href="assets/stylesheets/cs.global.css" rel="stylesheet" type="text/css" media="all">
	<link href="assets/stylesheets/cs.style.css" rel="stylesheet" type="text/css" media="all">
	<link href="assets/stylesheets/cs.media.3x.css" rel="stylesheet" type="text/css" media="all">
	
	<script src="assets/javascripts/jquery-1.9.1.min.js" type="text/javascript"></script>
	<script src="assets/javascripts/bootstrap.min.3x.js" type="text/javascript"></script>
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
								<h1 id="page-title">Orden <?php echo "#".$orden["id"]?></h1> 
							</div>
							<div id="col-main" class="address-page manage-address clearfix">								
								<div class="clearfix">
								  <div id="address_tables">
									
									<div class="clearfix">
									  <div class="col-md-12 first">
										<div id="parent_address_226447297" class="address_table">
										  
										  <div id="view_address_226447297" class="customer_address view_address clearfix">
											<div class="address_info col-md-14">
												<div class="info">
													<i class="fa fa-file-text-o"></i>
													<span class="address-group">
													<span class="author">Fecha: <?php echo $orden["fecha"]?></span>
													</span>
													<div style="margin-left:60px">
													<div>Total: $<?php echo $orden["total"]?></div>
													<div><?php echo $orden["nitems"]?> ítems</div>
													</div>
												</div>
													
											</div>
												<div id="tool_address_1940927491" class="address_actions col-md-10">
													
													<span class="action_delete">
													<a href="#" onclick="HTML.CustomerAddress.destroy(226447297);return false" title="remove"><i class="fa fa-times"></i><span>Cancelar</span></a>
													</span>
												</div>
										  </div>
										</div>
									  </div>

									  <div class="col-md-12 first">
										<div id="parent_address_226447297" class="address_table">
										  
										<table class="table-hover">
											<thead>
											<tr>
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
											      <td><a href="#!"><?php echo $r["producto"]." (".$r["description"].")"." | "."Talla: ".$r["talla"]; ?></a></td>
											      <td align="center"><?php echo $r["quantity"]; ?></td>
											      <td>$<?php echo $r["price"]; ?></td>
											      <td>$<?php echo $total_item; ?></td>
											    </tr>
											    <?php } ?>
											</tbody>
										</table>		
									
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