<table class="tabla-pedido">
	<thead>
	<tr>
		<th> </th>
		<th>Producto</th>
		<th>Cantidad</th>
		<?php if( $orden["estado"] == "revisado" ) { ?>
			<th class="colrev">Cant Disp</th>
		<?php } ?>
		<th>Precio unit</th>
		<th>Total</th>
		<th class="colrev_"> </th>
	</tr>
	</thead>
	<tbody>
		<?php 
		  $total_n_items = 0;
	      foreach ( $odetalle as $r ) {
	        $total_item = obtenerTotalItemOrden( $r, $orden["estado"] );
	        $total_n_items += $r["cant_rev"]; 
	    ?>
	    <tr id="ir<?php echo $r["id"]; ?>">
	      <td><img src="<?php echo $purl.$r["imagen"]; ?>" width="70"></td>
	      <td>
	      	<input type="hidden" id="iditem<?php echo $r["id"]; ?>" name="ielims[]" value="0">
	      	<a href="#!">
	      		<?php echo $r["producto"]." (".$r["description"].")"." | "."Talla: ".$r["talla"]; ?>
	      	</a>
	      </td>
	      <td align="center"><?php echo $r["quantity"]; ?></td>
	      <?php if( $orden["estado"] == "revisado" ) { ?>
		      <td align="center">
		      	<span class="qdisponibles" id="qd<?php echo $r["id"]; ?>" 
		      	data-xt="x<?php echo $r["id"]; ?>"><?php echo $r["cant_rev"]; ?></span>
		      </td>
	      <?php } ?>
	      <td>$<?php echo $r["price"]; ?></td>
	      <td>
	      	$<?php echo number_format( $total_item, 2, ".", " " ); ?>
	      	<input type="hidden" id="monto<?php echo $r["id"]; ?>" value="<?php echo $total_item; ?>">
	      	<input class="sumatmp" type="hidden" id="montotmp<?php echo $r["id"]; ?>" value="<?php echo $total_item; ?>">
	      </td>
	      <?php if( $orden["estado"] == "revisado" ) { ?>
		      <td>
		      	<i id="x<?php echo $r["id"]; ?>" class="fa fa-check-circle icancelp" data-t="<?php echo $r["id"]; ?>">
		      	</i>
		      </td>
	      <?php } ?>
	    </tr>
	    <?php } ?>
	    <tr id="monto_orden_tabla">
	    	<td colspan="2"></td>
	    	<td> <span class="total_order_table">Total </span></td>
	    	<td> <span class="total_order_table"><?php echo $total_n_items; ?></span> </td>
	    	<td colspan="2" style="text-align:right;">
	    		$ <span class="monto_total_orden total_order_table"> 
	    		<?php 
	    			if( $orden["estado"] == "pendiente" ) 	echo $orden["total"]; 
					if( $orden["estado"] == "revisado" ) 	echo $orden["total_ajuste"]; 
	    		?>
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