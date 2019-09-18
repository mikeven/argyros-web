<!-- Bloque información de producto -->
<div id="bloque-info-producto">	
	<div>
		<span><?php echo $producto["description"]; ?></span>
	</div>
	<div id="referencia-producto">
		
		<span>
			#:<?php echo $producto["id"]; ?>-
			<span id="idref-detalle"><?php /*echo $_GET["iddet"];*/ ?></span>
		</span>

	</div>
	<div class="row description sb-wrapper left-sample-block">
		<div class="col-sm-12">
			<ul class="list-unstyled sb-content list-styled">
			  <li> </li>
			  <li> <i class="fa fa-circle"></i>País: <?php echo $producto["pais"]; ?></li>
			  <li> <i class="fa fa-circle"></i>Líneas: </li>
			  <div id="infoproducto-lineas" class="infoproducto-lista">
			  	<?php echo mostrarDataProducto( $producto["lineas"] ); ?>
			  </div>
			  <div style="clear: both;">
			  <li> </li>
			</ul>
		</div>
		<div id="" class="col-sm-12">
			<ul class="list-unstyled sb-content list-styled">
			  
			  <li> <i class="fa fa-circle"></i>Material: <?php echo $producto["material"]; ?></li>
			  <li> <i class="fa fa-circle"></i>Trabajos:<?php //echo $producto["material"]; ?></li>
			  <div id="infoproducto-trabajos" class="infoproducto-lista">
			  	<?php echo mostrarDataProducto( $producto["trabajos"] ); ?>
			  </div>
			  
			</ul>	
		</div>
	</div>

	<div id="description-2" class="col-sm-24 group-variants">
		<?php foreach ( $detalle as $pdet ) { ?>
		  <div id="rdt-p<?php echo $pdet["id"]; ?>" class="rdet_prop rdet<?php echo $pdet["id"] ?>">
			  <span class="gs_circ"><?php echo "Color: ".$pdet["color"]; ?></span> |  
			  <span class="gs_circ"><?php echo $pdet["bano"]; ?></span> <br>
			  <span class="gs_circ">Peso: <span id="rtallp<?php echo $pdet["id"]; ?>"></span> </span>
			  <?php if ( $pdet["tipo_precio"] != "p" ){

			  		if( $pdet["tipo_precio"] == "g" ) 
				  		$precio_x_peso = $pdet["precio_peso"];
				  		
				  	if( $pdet["tipo_precio"] == "mo" ) 
				  			$precio_x_peso = $pdet["precio_mo"];
			  ?>
			  | <span class="gs_circ">Precio por g: 
				  	<span id="rpreciop_g">$ 
				  		<?php echo $precio_x_peso; ?> 
				  	</span> 
				</span>
				<?php } ?>
		  </div>
	  	<?php } ?>	
	</div>
</div>
<!-- /.Bloque información de producto -->