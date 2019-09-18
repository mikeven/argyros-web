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
	
	<!-- C-OCULTOS -->

</div>
<!-- /.Bloque selección cantidad y botón agregar compra -->
