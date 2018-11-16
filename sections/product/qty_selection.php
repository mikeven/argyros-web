<!-- Bloque selección cantidad y botón agregar compra -->
<div id="seleccion-cant">
	<table style="border:0">
	  <tr>
	    <th>
	    	<!-- Bloque selección cantidad -->
			<div class="quantity-wrapper clearfix">
				<label class="wrapper-title">Cantidad</label>
				<div class="wrapper">
					<input id="quantity" name="quantity" value="1" maxlength="5" size="5" class="item-quantity" type="text">
					<span class="qty-group">
						<span class="qty-wrapper">
							<span data-original-title="Aumentar" class="qty-up btooltip" data-toggle="tooltip" data-placement="top" title="" data-src="#quantity">
								<i class="fa fa-caret-right"></i>
							</span>
							<span data-original-title="Restar" class="qty-down btooltip" data-toggle="tooltip" data-placement="top" title="" data-src="#quantity">
								<i class="fa fa-caret-left"></i>
							</span>
						</span>
					</span>
				</div>
			</div>
			<!-- /.Bloque selección cantidad -->
	    </th>
	    <div id="data_cart" class="hidden">
	    	<input type="hidden" id="idi_cart" name="idicart" value="<?php echo $pre_pp; ?>">
	    	<input type="hidden" id="idprod" name="idproducto" value="<?php echo $pid; ?>">
	    	<input type="hidden" id="iddetalle" name="iddetalle" value="<?php echo $detalle[0]["id"]; ?>">
	    	<input type="hidden" id="nproducto" name="nombre_producto" value="<?php echo $producto["name"]; ?>">
	    	<input type="hidden" id="dproducto" name="descripcion_producto" value="<?php echo $producto["description"]; ?>">
	    	<input type="hidden" id="imgproducto" name="img_producto" value="<?php echo $img_pp; ?>">
	    	<input type="hidden" id="stalla" name="seltalla" value="">
	    	<input type="hidden" id="vidseltalla" name="idseltalla" value="">
	    	<input type="hidden" id="vprice_cart" name="unit_price" value="<?php echo $pre_pp; ?>">
	    </div>
	    <th valign="bottom">
	    	<!-- Botón agregar al carrito -->
			<?php if( isset( $_SESSION["login"] ) ) { ?>
			<div class="others-bottom clearfix">
				<!-- <button id="add-to-cart" class="btn btn-1 add-to-cart" data-parent=".product-information" type="submit" name="add">Agregar a carrito</button>-->
				<span id="add-to-cart" class="action btn btn-1">Agregar a compra</span>
			</div>
			<?php } else { ?>
			<div class="others-bottom clearfix">
				<!-- <button id="add-to-cart" class="btn btn-1 add-to-cart" data-parent=".product-information" type="submit" name="add">Agregar a carrito</button>-->
				<a href="login.php">Inicie sesión para comprar</a>
			</div>
			<?php } ?>
			<!-- /.Botón agregar al carrito -->
	    </th> 
	  </tr>
	  <tr>
	  	<div id="alert-msgs-notif" class="col-md-24 cart-alert">
			<div class="alert alert-danger">
				<button type="button" class="close btooltip close_alert" data-toggle="tooltip" 
				data-placement="top" title="Cerrar" data-trgclose="alert-msgs-notif" 
				data-original-title="Cerrar">×</button>
				<div class="errors">
					<ul> <div id="body_msg_cart"></div> </ul>
				</div>
			</div>
		</div>
	  </tr>
	</table>
</div>
<!-- /.Bloque selección cantidad y botón agregar compra -->
