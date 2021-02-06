<!-- Bloque selección tallas -->
<div id="seleccion-talla">

	<div> Seleccione una talla y cantidad </div>
	
	<div class="swatch clearfix" data-option-index="1">
		<div class="header"> Tallas <span id="undtalla"></span></div>
		<div id="rdt-t<?php echo $detalle_producto[id]; ?>">
			<?php 
				$cn = 0; 
				$tallas = $detalle_producto["sizes"]; $ct = 0;
				//$detalle_producto["sizes"] <= data-product.php: cargarTallasDetalle()
			?>

			<?php  
				$s_t = 0;
				foreach ( $tallas as $ptalla ) {
					if( !isset( $ptalla["precio"] ) ) $ptalla["precio"] = "";
					
					if( $ptalla["talla"] == 'unica' ) 	$ptalla["talla"] = "Única";
					if( $ptalla["talla"] == "ajust" )	$ptalla["talla"] = "Ajustable";

					if( $s_t == 0 ) $t_ini = "ti-".$detalle_producto["id"]; else $t_ini = "";
					if( $ptalla["visible"] ){
			?>
				<div id="<?php echo $t_ini; ?>" data-value="<?php echo $ptalla[talla]; ?>" 
				class="swatch-element medium available seltdp" 
				data-trg="rtallp<?php echo $detalle_producto[id]; ?>" data-peso="<?php echo $ptalla["peso"]; ?> gr" 
				data-tprecio="<?php echo $detalle_producto[tipo_precio]; ?>"
				data-precio="<?php echo number_format( $ptalla[precio], 2, ".", "," ); ?>"
				data-precio-v="<?php echo $ptalla[precio]; ?>"
				data-idt="<?php echo $ptalla[idtalla]; ?>"
				data-und="<?php echo $ptalla[unidad]; ?>">
					<input id="<?php echo $cn."-".$ptalla[idtalla]; ?>" name="opt<?php echo $detalle_producto[id] ?>" 
					value="<?php echo $ptalla[talla]; ?>" type="radio" 
					class="sizeselector <?php echo $t_ini; ?>">
					
					<label for="<?php echo $cn."-".$ptalla[idtalla]; ?>">
						<?php echo $ptalla["talla"]; ?> 
						<img class="crossed-out" src="assets/images/soldout.png" alt="">
					</label>
				</div>
				<input type="hidden" id="detdsp-<?php echo $detalle_producto[id]; ?>" value="1">
			<?php 
				$ct++; $cn++; $s_t++;
					} //end if
				} //end foreach
			?>

		</div>
	</div>
</div>
<!-- /.Bloque selección tallas -->
