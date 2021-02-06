<!-- Bloque información de producto -->
<div id="bloque-info-producto">	
	<div>
		<span><?php echo $producto["description"]; ?></span>
	</div>
	<div id="referencia-producto">
		<span>
			ID: <?php echo $producto["id"]; ?>-<span id="idref-detalle"><?php echo $_GET["iddet"]; ?></span>
		</span>
	</div>
	<div id="referencia-producto-pvd">
		<span>
			REF: <?php echo $proveedor1["number"]; ?>-<span><?php echo $producto["codigof1"]; ?></span>
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
		<?php 
			$peso_inicial = $detalle_producto["sizes"][0]["peso"];
			if( $detalle_producto["available"] ) $peso_inicial = "";
		?>
		<span class="gs_circ"><?php echo "Color: ".$detalle_producto["color"]; ?></span> |  
		<span class="gs_circ"><?php echo $detalle_producto["bano"]; ?></span> <br>
		<span class="gs_circ">Peso: 
			<span id="rtallp<?php echo $detalle_producto["id"]; ?>"><?php echo $peso_inicial ?> gr</span> 
		</span>
		<?php 
			if ( $detalle_producto["tipo_precio"] != "p" ){

				if( $detalle_producto["tipo_precio"] == "g" ) 
		  		$precio_x_peso = $detalle_producto["precio_peso"];
		  		
		  	if( $detalle_producto["tipo_precio"] == "mo" ) 
		  			$precio_x_peso = $detalle_producto["precio_mo"];
		?>
		| <span class="gs_circ">Precio:  
		  	<span id="rpreciop_g">
		  		<?php echo $precio_x_peso; ?> $/g 
		  	</span> 
		</span>
		<?php } ?>
	  
	</div>
</div>
<!-- /.Bloque información de producto -->