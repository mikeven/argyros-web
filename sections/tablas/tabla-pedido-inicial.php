<table class="tabla-pedido">
	<thead>
	<tr>
		<th>N°</th>
		<th> </th>
		<th>Producto</th>
		<th>Cantidad Solicitada</th>
		<th>Precio unit</th>
		<th>Total</th>
		<th>Peso</th>
	</tr>
	</thead>
	
	<tbody>
		<?php 
		  
		  $item_nro 		= 0;	
		  $total_n_items 	= 0;
	      
	      foreach ( $odetalle as $r ) {
	        
	        $item_nro++;
	        $total_item 	= obtenerTotalItemOrden( $r, $orden["estado"] );
	        $tot_peso_item 	= obtenerTotalPesoItemOrden( $r, $orden["estado"] );
	        
	        if( $orden["estado"] == "revisado" )
	        	$total_n_items += $r["cant_rev"];
	        if( $orden["estado"] == "pendiente" || $orden["estado"] == "cancelado" ){
	        	$total_n_items += $r["quantity"];
	        }

	        $lnk_p = "product.php?id=$r[product_id]&iddet=$r[product_detail_id]";
	        $cod_dp = "#" . $r["product_id"] . " - " . $r["product_detail_id"];
	    ?>

	    <tr id="ir<?php echo $r["id"]; ?>">
	      <td align="center"><?php echo $item_nro ?></td>
	      <td><img src="<?php echo $purl.$r["imagen"]; ?>" width="70"></td>
	      <td class="txa-l">
	      	<input type="hidden" id="iditem<?php echo $r["id"]; ?>" name="ielims[]" value="0">
	      	<a href="<?php echo $lnk_p; ?>" target="_blank">
	      		<?php echo $r["producto"]." | "."Talla: ".$r["talla"]; ?>
	      	</a>
	      	<div align="left"><span class="detlist-id-det"><?php echo $cod_dp; ?></span></div>
	      </td>
	      <td align="center"><?php echo $r["quantity"]; ?></td>
	      
	      <td>$<?php echo $r["price"]; ?></td>
	      <td style="text-align: right;">
	      	$<?php echo number_format( $total_item, 2, ".", " " ); ?>
	      	<input type="hidden" id="monto<?php echo $r["id"]; ?>" value="<?php echo $total_item; ?>">
	      	<input class="sumatmp" type="hidden" id="montotmp<?php echo $r["id"]; ?>" value="<?php echo $total_item; ?>">
	      </td>
	      
	      <td><?php echo number_format( $tot_peso_item, 2, ".", " " ) ?> gr</td>
	      
	    </tr>

	    <?php } ?>
	    <tr id="monto_orden_tabla">
	    	<td colspan="3">Total </td>
	    	<td> <span class="total_order_table"> <?php echo $total_n_items; ?> </span></td>
	    	<td> <span class="total_order_table"></span> </td>
	    	<td style="text-align:right;" class="coltotales">
	    		$ <span class="monto_total_orden total_order_table"> 
	    		<?php echo $orden["total"]; ?>
	    		</span>
	    	</td>
	    	<td></td>
	    </tr>
	</tbody>
</table>

<?php if( $orden["estado"] == "revisado" ) { ?>

<div class="separador"><hr></div>

<div id="panel_confirmacion">
	<ul id="orden_observaciones_form" class="list-unstyled">
		<li class="clearfix"></li>
		<li id="li_orden_obs">
			<label class="control-label" for="orden_obs">Observaciones</label>
			<input type="email" value="" name="observaciones" id="orden_obs" class="form-control">
		</li>
	</ul>

	<div id="b_confirmacion_pedido">
		<a href="#!" data-toggle="modal" data-target="#confirmar-accion" 
		class="btn btn-1" id="btn_conf_ped" style="float:left">Confirmar cambios en pedido</a>
	</div>

</div>

<div id="i_rmped" style="float:left"></div>

<?php } ?>