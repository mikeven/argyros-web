<!-- Bloque detalles de producto -->
<div id="carr-modelos-disponibles">
	<div id="gallery_main" class="product-image-thumb mobile_full_width product_detail">
		<div id="titulo-detalles-disponibles">
			<span class="wrapper-title">Modelos</span>
		</div>
		<ul style="opacity: 0; display: block;" class="slide-product-image owl-carousel owl-theme">
		
		<?php foreach ( $modelos_productos as $pdet ) { 
			$lnk_producto 		= "product.php?id=$pid&iddet=$pdet[id]";
			$selimg 			= ""; 
			$label_product 		= "";
			$label_ids 			= "detlist-id-det";
			
			if( $pdet["id"] == $_GET["iddet"] ) $selimg = "selimgdet"; 	// Resaltado de detalle actual en la vista
			
			if( !$pdet["available"] ) {
				$label_ids 		= "tx_not_available";						// Resaltado de detalle no disponible
				$label_product 	= "AGOTADO";
			}
			
			if( isset( $pdet["images"][0] ) /*&& tieneTallasDisponiblesDetalleProducto( $dbh, $pdet["id"] )*/ ){
				$i = $pdet["images"][0]; ?>
				
				<li class="image opt-pdetalle">
					<div class="img_pdet_container">
						<a href="<?php echo $lnk_producto ?>" class="lnk_producto">
							<img src="<?php echo $purl.$i[path] ?>" 
							alt="<?php echo $producto[name]; ?>" class="img-det-prod <?php echo $selimg ?>">
						</a>
						<div class="etq_agotado"><?php echo $label_product ?></div>
					</div>
					
					<div align="center">
						<span class="<?php echo $label_ids ?>">
							#<?php echo $producto["id"]; ?>-<?php echo $pdet["id"]?>
						</span>
					</div>
				</li>
				
			<?php } ?>
		<?php } ?>
		
		</ul>
	</div>
</div>
<!-- /.Bloque detalles de producto -->