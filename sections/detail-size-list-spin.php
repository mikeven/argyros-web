<div class="product-detail-size-list">
	<?php foreach ( $data_rprod["sizes"] as $t ) { ?>
		
		<form id="itemcart<?php echo $iddet.$t[idtalla] ?>" method="post" class="variants frm-scart">
			<div class="quantity-wrapper clearfix row">
				<div class="col-md-4">
					<div class="wrapper"> <?php echo $t["talla"]." ".$t["unidad"]; ?> </div>
				</div>
				<div class="col-md-6">
					<div class="wrapper"> <?php echo $t["peso"]." gr"; ?> </div>
				</div>
				<div class="col-md-5">
					<div class="wrapper"> <?php echo $t["precio"]." $"; ?> </div>
				</div>
				<div class="col-md-5">
					<div class="wrapper">
						<div class="wrapper">
							<input id="q<?php echo $iddet.$t[idtalla] ?>" name="quantity" value="1" maxlength="3" size="3" 
							class="item-quantity" type="text">
							<span class="qty-group">
								<span class="qty-wrapper">
									<span data-original-title="Aumentar" class="qty-up btooltip" data-toggle="tooltip" data-placement="top" title="" data-src="#q<?php echo $iddet.$t[idtalla] ?>">
										<i class="fa fa-caret-right"></i>
									</span>
									<span data-original-title="Restar" class="qty-down btooltip" data-toggle="tooltip" data-placement="top" title="" data-src="#q<?php echo $iddet.$t[idtalla] ?>">
										<i class="fa fa-caret-left"></i>
									</span>
								</span>
							</span>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="wrapper modal-addtocart"> 
						<a class="action btn btn-1 add-to-cart" data-frmtrg="itemcart<?php echo $iddet.$t[idtalla] ?>" 
							data-msg-notice="#alert-msgs<?php echo $iddet?>">
							<i class="fa fa-shopping-cart"></i> 
						</a> 
					</div>
				</div>
			</div>
			<div class="data_cart_modal hidden">
		    	<input type="hidden" name="idicart" 				value="<?php echo $iddet."-".$t[idtalla] ?>">
		    	<input type="hidden" name="idproducto" 				value="<?php echo $p_id; ?>">
		    	<input type="hidden" name="iddetalle" 				value="<?php echo $iddet; ?>">
		    	<input type="hidden" name="nombre_producto" 		value="<?php echo $data_rprod[name] ?>">
		    	<input type="hidden" name="descripcion_producto" 	value="<?php echo $data_rprod[description]; ?>">
		    	<input type="hidden" name="img_producto" 	    	value="<?php echo $purl.$img ?>">
		    	<input type="hidden" name="seltalla" 				value="<?php echo $t[talla] ?>">
		    	<input type="hidden" name="idseltalla" 				value="<?php echo $t[idtalla] ?>">
		    	<input type="hidden" name="unit_price" 				value="<?php echo $t[precio] ?>">
		    </div>
		</form>
	<?php } ?>
</div>