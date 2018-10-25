<table class="tabla-pedido">
	<thead>
	<tr>
		<th> </th>
		<th>Producto</th>
		<th>Cantidad</th>
		<th>Precio unit</th>
		<th>Total</th>
	</tr>
	</thead>
	<tbody>
		<?php 
		  $total_n_items = 0;
	      foreach ( $odetalle as $r ) {
	        $total_item = $r["cant_rev"] * $r["price"];
	        $total_n_items += $r["cant_rev"];
	        $lnk_p = "product.php?id=$r[product_id]&iddet=$r[product_detail_id]";
	        $cod_dp = "#" . $r["product_id"] . " - " . $r["product_detail_id"];
	        
	        if( $r["cant_rev"] != 0 ){
	    ?>
	    <tr id="ir<?php echo $r["id"]; ?>">
	      <td><img src="<?php echo $purl.$r["imagen"]; ?>" width="70"></td>
	      <td class="txa-l">
	      	<input type="hidden" id="iditem<?php echo $r["id"]; ?>" name="ielims[]" value="0">
	      	<a href="<?php echo $lnk_p; ?>" target="_blank">
	      		<?php echo $r["producto"]." | "."Talla: ".$r["talla"]; ?>
	      	</a>
	      	<div align="left"><span class="detlist-id-det"><?php echo $cod_dp; ?></span></div>
	      </td>
	      <td align="center"><?php echo $r["cant_rev"]; ?></td>
	      <td>$<?php echo $r["price"]; ?></td>
	      <td>$<?php echo $total_item; ?></td>
	    </tr>
	    <?php }} ?>
	    <tr id="monto_orden_tabla">
	    	<td colspan="2">Total </td>
	    	
	    	<td> <span class="total_order_table"> <?php echo $total_n_items; ?> </span></td>
	    	<td> <span class="total_order_table"></span> </td>
	    	<td style="text-align:right;" class="coltotales">
	    		$ <span class="monto_total_orden total_order_table"> 
	    		<?php 
					echo $orden["total_ajuste"]; 
	    		?>
	    		</span>
	    	</td>
	    </tr>
	</tbody>
</table>