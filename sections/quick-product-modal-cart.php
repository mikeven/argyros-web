<div id="product-w<?php echo $iddet?>" class="modal in" role="dialog" aria-hidden="false" tabindex="-1" data-width="800">
	<div class="modal-backdrop in" style="height: 100vh;">
	</div>
	<div class="modal-dialog rotateInDownLeft animated">
		<div class="modal-content">
			<div class="modal-header">
				<i class="close fa fa-times btooltip" data-toggle="tooltip" data-placement="top" title="" data-dismiss="modal" aria-hidden="true" data-original-title="Cerrar"></i>
			</div>
			<div class="modal-body">
				
				<div class="quick-shop-modal-bg" style="display: none;">
				</div>
				<div class="row">
					<div class="col-md-10 product-image">
						<div id="quick-shop-image" class="product-image-wrapper">
							<a class="main-image">
								<img id="modal_img_prod" class="img-zoom img-responsive image-fly" 
								src="<?php echo $purl.$img ?>" data-zoom-image="<?php echo $purl.$img ?>" alt=""/>
							</a>
							
							<div id="gallery_main_qs" class="product-image-thumb hidden">
								<a class="image-thumb active" href="assets/1images/.html" data-image="./assets/images/1_grande.jpg" data-zoom-image="assets/images/1.html"><img src="assets/images/1_compact.jpg" alt=""/></a>
								<a class="image-thumb" href="assets/images/2.html" data-image="./assets/images/2_grande.jpg" data-zoom-image="assets/images/2.html"><img src="assets/images/2_compact.jpg" alt=""/></a>
								<a class="image-thumb" href="assets/images/3.html" data-image="./assets/images/3_grande.jpg" data-zoom-image="assets/images/3.html"><img src="assets/images/3_compact.jpg" alt=""/></a>
								<a class="image-thumb" href="assets/images/4.html" data-image="./assets/images/4_grande.jpg" data-zoom-image="assets/images/4.html"><img src="assets/images/4_compact.jpg" alt=""/></a>
								<a class="image-thumb" href="assets/images/5.html" data-image="./assets/images/5_grande.jpg" data-zoom-image="assets/images/5.html"><img src="assets/images/5_compact.jpg" alt=""/></a>
								<a class="image-thumb" href="assets/images/6.html" data-image="./assets/images/6_grande.jpg" data-zoom-image="assets/images/6.html"><img src="assets/images/6_compact.jpg" alt=""/></a>
							</div>

							<div align="center">
								<a href="<?php echo $urlp?>" class="action btn btn-1" target="_blank">
									<i class="fa fa-eye"></i>
								</a>
							</div>

						</div>
					</div>
					<div class="col-md-14 product-information">
						<h1 id="quick-shop-title"><span>
							<a href="#!"><?php echo $titulo_p ?></a></span>
						</h1>

						<div id="quick-shop-infomation" class="description">
							<div id="quick-shop-description" class="text-left">
								<p> <?php echo $data_rprod[description] ?> </p>
							</div>
						</div>
						<div id="quick-shop-container">
							<div id="quick-shop-data-products" class="relative text-left row">
								<div class="col-md-12">
									<span class="control-label">País: </span>
									<span id="qs-pais"><?php echo $data_rprod[pais] ?></span>
								</div>
								<div class="col-md-12">
									<span class="control-label">Material: </span>
									<span id="qs-material"><?php echo $data_rprod[material] ?></span>
								</div>
							</div>
							<div id="quick-shop-data-products" class="relative text-left row">
								<div class="col-md-12">
									<span class="control-label">Color: </span>
									<span id="qs-color"><?php echo $data_rprod[color] ?></span>
								</div>
								<div class="col-md-12">
									<span class="control-label">Baño: </span>
									<span id="qs-bano"><?php echo $data_rprod[bano] ?></span>
								</div>
							</div>
							
							<div id="quick-shop-price-container" class="detail-price">
								<span class="control-label">Precio: </span>
								<span id="modal_price_prod" class="price_sale"><?php echo $precio_catalogo; ?></span>
							</div>

							<div class="quantity-wrapper clearfix row">
								<div class="col-md-5">
									<label class="wrapper-title">Talla</label>
								</div>
								<div class="col-md-5">
									<label class="wrapper-title">Peso</label>
								</div>
								<div class="col-md-5" style="text-align: center;">
									<label class="wrapper-title">Precio Pz</label>
								</div>
								<div class="col-md-5" style="text-align: center;">
									<label class="wrapper-title">Cantidad</label>
								</div>
								<div class="col-md-4">
									<label class="wrapper-title">Agregar</label>
								</div>
							</div>
							<!-- Selección de cantidades y agregar a carrito -->
							<div id="qs-data-tallas">
								<?php include( "detail-size-list.php" ); ?>
							</div>

							<div id="alert-msgs<?php echo $iddet?>" class="col-md-24 cart-alert">
								<div class="alert alert-danger">
									<button type="button" class="close btooltip close_alert" data-toggle="tooltip" 
									data-placement="top" title="Cerrar" data-trgclose="alert-msgs<?php echo $iddet?>" 
									data-original-title="Cerrar">×</button>
									<div class="errors">
										<ul> <div id="body_msg_cart"></div> </ul>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>