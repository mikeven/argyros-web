<li id="bl<?php echo $p_id?>" class="element first no_full_width cargable eca<?php echo $bloque; ?>" 
	data-alpha="Nombre del producto">
	<ul class="row-container list-unstyled clearfix">
		<li class="row-left img-catal-contenedor">
		<a id="<?php echo $p_id?>" 
			href="<?php echo $urlp; ?>" class="container_item" target="_blank">
		
		<img src="<?php echo $purl.$img ?>" 
		class="img-responsive imgcatal" alt="<?php echo $data_rprod[name] ?>">
		<span class="sale_banner">
			<?php if( $data_rprod["d_antiguedad"] < NDIAS_NUEVO ) { ?>
				<span class="sale_text"> Nuevo </span>
			<?php } ?>
		</span>
		<span class="catalogue_numerator"><?php echo $numerador_catalogo; ?></span>
		</a>
		<div class="hbw">
			<span class="hoverBorderWrapper hidden"></span>
		</div>
		</li>
		<li class="row-right parent-fly animMix">
		<div class="product-content-left">
			<a class="title-5" href="<?php echo $urlp; ?>" target="_blank" style="font-size: 13.5px;">
				<?php echo $titulo_p; ?>
			</a>
		
			<div style="float: right;" class="data-product-catalogue hidden">
				<span class="price_sale"><?php echo $precio_catalogo; ?></span>
			</div>

			<div style="text-align: left;" class="data-product-catalogue">
				<div class="full_wgt togwgt">
					<span class="weight_catalogue">Peso: <?php echo $peso_catalogo["full"]; ?></span>
				</div>
				<div class="short_wgt togwgt hidden">
					<span class="weight_catalogue">Peso: <?php echo $peso_catalogo["short"]; ?></span>
				</div>
				<span class="sizes_catalogue hidden">Tallas: <?php echo $tallas_catalogo; ?></span>
			</div>
		</div>
		
		<div class="list-mode-description">
			 <?php echo $data_rprod["description"] ?>
		</div>
		
		<div class="hover-appear hidden_" style="bottom: -75px;">
			<table class="table-data-catalogue">
				<tbody>
					<th width="33%">
						<div class="data-product-catalogue">
							<span class="weight_catalogue"><?php echo $peso_catalogo["short"]; ?></span>
						</div>
					</th>
					<th width="34%">
						<div class="quick-shop-window product-ajax-qs hidden-xs hidden-sm">
							<div data-target="#quick-shop-modal" class="quick_shop quick-shop-icono" 
							data-toggle="modal" data-img="<?php echo $purl.$img ?>" 
							data-link="<?php echo $urlp ?>"
							data-nombre="<?php echo $titulo_p." ".$data_rprod[name] ?>" 
							data-material="<?php echo $data_rprod[material] ?>" 
							data-pais="<?php echo $data_rprod[pais] ?>" 
							data-color="<?php echo $data_rprod[color] ?>" 
							data-bano="<?php echo $data_rprod[bano] ?>" 
							data-desc="<?php echo $data_rprod[description] ?>" 
							data-idbloque-talla="pdt<?php echo $p_id ?>" 
							data-precio="<?php echo $precio_catalogo; ?>">

								<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 1000 1000" enable-background="new 0 0 1000 1000" xml:space="preserve">
									<metadata> Svg Vector Icons : http://www.onlinewebfonts.com/icon </metadata>
									<g><g><path d="M464.5,642.5c-28.1-40.9-43.2-89.2-43.2-139.9c0-66.2,23.5-130.8,72.6-175.3c47.5-43.2,119.6-68.8,154.9-71.7c-64.6-43.9-143.3-79.3-229.4-79.3c-221.9,0-394.8,234.9-402,244.9c-9.7,13.4-9.7,31.5,0,44.8c7.2,10,180.1,244.9,402,244.9c33.1,0,65.2-5.3,95.6-14.2c-7.3-5.9-14.4-12.1-21.1-18.8C482.8,666.9,473.1,655.1,464.5,642.5z M400.2,363c-6.7,0.8-29.8,9.6-44.7,30.6c-13.8,19.4-17,44.9-9.6,75.6c4.9,20.4-7.6,41-28,46c-3,0.7-6,1.1-9,1.1c-17.2,0-32.8-11.7-37-29.2c-17-69.9,4.7-116.8,25.9-143.8c29.1-36.9,74.1-56.7,101.8-56.7h0.1c21.1,0,38.1,17.2,38.1,38.2C437.8,345.7,421,362.8,400.2,363z M96.9,443.6c34.1-40.4,113.5-125.1,211.7-166.8c-56.8,35.6-94.6,98.7-94.6,170.6c0,59.7,26,113.2,67.3,150.1C195.8,553.1,127.7,480.3,96.9,443.6z"/><path d="M657.1,586.8c-54.5-9.9-68.2-62.5-68.7-65c-2.7-11.2-13.9-18.1-25.2-15.5c-11.3,2.6-18.3,13.9-15.7,25.2c0.8,3.3,20,81.7,102.2,96.6c1.3,0.2,2.5,0.3,3.8,0.3c9.9,0,18.8-7.1,20.6-17.3C676.2,599.8,668.6,588.9,657.1,586.8z"/><path d="M980.2,724.6L900,644.4c-12.3-12.3-32.2-12.3-44.5,0v0.1l-21.8-21.8c58.2-79.6,51.3-192.2-20.6-264.1c-38.4-38.5-89.6-59.7-144-59.7c-54.4,0-105.5,21.2-144,59.7c-38.5,38.5-59.6,89.6-59.6,144c-0.1,54.4,21.2,105.6,59.6,144c38.5,38.5,89.6,59.7,144,59.7c43.7,0,85.4-13.7,120-39.2l21.7,21.8h0c-12.3,12.3-12.2,32.2,0,44.5l80.2,80.2c13.2,13.1,34.4,13.1,47.5,0l41.6-41.6C993.3,759,993.3,737.8,980.2,724.6z M768.6,602.2c-26.6,26.6-61.9,41.2-99.4,41.2s-72.9-14.7-99.5-41.2c-26.6-26.5-41.2-61.9-41.2-99.5c0-23.8,5.9-46.7,16.9-67c6.4-11.8,14.5-22.7,24.2-32.4c1.4-1.4,2.9-2.8,4.3-4.2c26-23.9,59.6-37,95.1-37c37.6,0,72.9,14.6,99.4,41.2c5.3,5.3,10.2,11,14.5,17C822.9,475.2,818.1,552.7,768.6,602.2z"/><circle cx="572.4" cy="463.8" r="20.6"/></g></g>
								</svg> 

							</div>
						</div>
					</th>
					<th width="33%">
						<div class="data-product-catalogue">
							<span class="price_sale"><?php echo $precio_catalogo; ?></span>
						</div>	
					</th>
				</tbody>
				
			</table>
		</div>

		<div id="pdt<?php echo $p_id ?>" class="hidden">
			<?php foreach ( $data_rprod["sizes"] as $t ) { ?>
				<div class="row">
					<div class="col-md-6">
						<div class="wrapper"> <?php echo $t["talla"]." ".$t["unidad"]; ?> </div>
					</div>
					<div class="col-md-6">
						<div class="wrapper"> <?php echo $t["peso"]." gr"; ?> </div>
					</div>
					<div class="col-md-6" style="text-align: center;">
						<div class="wrapper"> <?php echo $t["precio"]." $"; ?> </div>
					</div>
				</div>
			<?php } ?>
		</div>

		</li>
	</ul>
</li>