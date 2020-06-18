<!-- Bloque detalles de producto -->
<div id="carr-modelos-disponibles">
	<div id="gallery_main" class="product-image-thumb thumbs mobile_full_width product_detail">
		<div id="titulo-detalles-disponibles">
			<span class="wrapper-title">Modelos disponibles</span>
		</div>
		<ul style="opacity: 0; display: block;" class="slide-product-image owl-carousel owl-theme">
		
		<?php foreach ( $detalle as $pdet ) { 

			if( isset( $pdet["images"][0] ) /*&& tieneTallasDisponiblesDetalleProducto( $dbh, $pdet["id"] )*/ ){
				$i = $pdet["images"][0]; ?>

				<li class="image opt-pdetalle">
					<a id="DP-<?php echo $pdet["id"] ?>" href="<?php echo $purl.$i["path"] ?>" 
					class="cloud-zoom-gallery active select_pdetail" 
					data-iddimg="iddi<?php echo $pdet["id"] ?>" 
					data-regdet="rdet<?php echo $pdet["id"] ?>" data-select-iddet="<?php echo $pdet["id"] ?>" 
					data-tprecio="<?php echo $pdet["tipo_precio"] ?>" 
					data-precio="<?php echo number_format( $pdet["precio"], 2, ".", "," ) ?>" 
					data-precio-v="<?php echo $pdet["precio"]; ?>"
					data-talla-i="ti-<?php echo $pdet["id"] ?>">
						<img id="iddi<?php echo $pdet["id"] ?>" src="<?php echo $purl.$i["path"] ?>" 
						alt="<?php echo $producto["name"]; ?>" class="img-det-prod">
					</a>
					<div align="center"><span class="detlist-id-det">
						#<?php echo $producto["id"]; ?>-<?php echo $pdet["id"]?></span>
					</div>
				</li>

			<?php } ?>
		<?php } ?>
		
		</ul>
	</div>
</div>
<!-- /.Bloque detalles de producto -->