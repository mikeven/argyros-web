<!-- Bloque selección tallas -->
<div id="seleccion-talla">
	<div> Seleccione una talla y cantidad </div>
	<div class="swatch clearfix" data-option-index="1">
		<div class="header"> Tallas <span id="undtalla"></span></div>
		<?php 
			$cn = 0; 
			foreach ( $detalle as $pdet ) { 
			$tallas = $pdet["sizes"]; $ct = 0;	
			//data-product.php: cargarTallasDetalle()
		?>

		<div id="rdt-t<?php echo $pdet["id"]; ?>" class="rdet_view_t rdet<?php echo $pdet["id"] ?>">
			
			<?php if( count( $tallas ) > 0 ) { ?>

			<?php  
				$s_t = 0;
				foreach ( $tallas as $ptalla ) {
					if( !isset( $ptalla["precio"] ) ) $ptalla["precio"] = "";
					if( $ptalla["talla"] == 'N/A' ) {
						$ptalla["talla"] = "única";
						if( $ptalla["ajustable"] == 1 )
							$ptalla["talla"] = "ajustable";
					}
					if( $s_t == 0 ) $t_ini = "ti-".$pdet["id"]; else $t_ini = "";
			?>
				<div id="<?php echo $t_ini; ?>" data-value="<?php echo $ptalla["talla"]; ?>" 
				class="swatch-element medium available seltdp" 
				data-trg="rtallp<?php echo $pdet["id"]; ?>" data-peso="<?php echo $ptalla["peso"]; ?> gr" 
				data-tprecio="<?php echo $pdet["tipo_precio"]; ?>"
				data-precio="<?php echo number_format( $ptalla["precio"], 2, ".", "," ); ?>"
				data-precio-v="<?php echo $ptalla["precio"]; ?>"
				data-idt="<?php echo $ptalla["idtalla"]; ?>"
				data-und="<?php echo $ptalla["unidad"]; ?>">
					<input id="<?php echo $cn."-".$ptalla["idtalla"]; ?>" name="opt<?php echo $pdet["id"] ?>" 
					value="<?php echo $ptalla["talla"]; ?>" type="radio" 
					class="sizeselector <?php echo $t_ini; ?>">
					
					<label for="<?php echo $cn."-".$ptalla["idtalla"]; ?>">
						<?php echo $ptalla["talla"]; ?> 
						<img class="crossed-out" src="assets/images/soldout.png" alt="">
					</label>
				</div>
			<?php 
				$ct++; $cn++; $s_t++;
				} 
			?>

			<?php } ?>

		</div>

		<?php } //.foreach ?>
	</div>
</div>
<!-- /.Bloque selección tallas -->
