<section id="productos-juego" class="rel-container clearfix epjuego">  

	<h6 class="general-title text-left">Productos del juego</h6>

	<div id="prod-related-wrapper">

		<div id="productos-juego" class="prod-related clearfix">

			<?php

				foreach ( $productos_juegos as $prod ) {

					if( $prod["idp"] != $pid ){

						$lnkp = "product.php?id=".$prod["idp"]."&iddet=".$prod["idd"];

						$img = obtenerImagenProductoDetalle( $dbh, $prod["idd"] );

			?>

			<div class="element no_full_width not-animated rdet_juego_rel" data-animate="bounceIn" data-delay="0">

				<ul class="row-container list-unstyled clearfix">

					<li class="row-left">

					<a href="<?php echo $lnkp; ?>" class="container_item">

					<img src="<?php echo $purl.$img[0]["image"] ?>" class="img-responsive" alt="Curabitur cursus dignis">

					<span class="sale_banner">

						<?php if( $prod["d_antiguedad"] < NDIAS_NUEVO ) { ?>

							<span class="sale_text">

								Nuevo

							</span>

						<?php } ?>

					</span>

					</a>

					</li>

					<li class="row-right parent-fly animMix">

					<div class="product-content-left">

						<a class="title-5" href="<?php echo $lnkp; ?>"><?php echo $prod["nombre"]; ?></a>

					</div>

					

					<div class="list-mode-description">

						<?php echo $prod["description"]; ?>

					</div>

					

					</li>

				</ul>

			</div>

		<?php

			} }

		?>

		</div>	

	</div>										

</section>