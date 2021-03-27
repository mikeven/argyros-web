<table class="tabla-pedido">
	<thead>
	<tr>
		<th>N°</th>
		<th> </th>
		<th>Producto</th>
		<th>Cantidad</th>
		<th>Precio unit</th>
		<th>Total</th>
		<th>Peso</th>
	</tr>
	</thead>

	<tbody>
		<?php 
		  
		  $item_nro 		= 0;
		  $total_n_items 	= 0;
		  $items_retirados  = array();
	      
	      foreach ( $odetalle as $r ) {

	      	$item_nro++;
	        
	        $total_item = $r["cant_rev"] * $r["price"];
	        $tot_peso_item 	= obtenerTotalPesoItemOrden( $r, $orden["estado"] );

	        $lnk_p = "product.php?id=$r[product_id]&iddet=$r[product_detail_id]";
	        $cod_dp = "#" . $r["product_id"] . " - " . $r["product_detail_id"];
	        
	        if( $r["item_status"] == "retirado" ){	
	        	// Si el ítem retirado pasa a un vector de ítems retirados con su numeración
	        	$item_r = $r; $item_r["numeracion"] = $item_nro;
	        	$items_retirados[] = $item_r;
	        }
	        
	        if( ( $r["cant_rev"] != 0 ) && ( $r["item_status"] != "retirado" ) ){
	        	$total_n_items += $r["cant_rev"];

	    ?>
	    <tr id="ir<?php echo $r["id"]; ?>">
	      <td align="center"><?php echo $item_nro ?></td>
	      <td>
	      	<a href="#pop-img" class="fancybox pop-img" data-src="<?php echo $purl.$r["imagen"]; ?>">
	      		<img src="<?php echo $purl.$r["imagen"]; ?>" width="70">
	      	</a>
	      </td>
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
	      <td><?php echo number_format( $tot_peso_item, 2, ".", " " ) ?> gr</td>

	    </tr>
	    <?php } } ?>
	    <tr id="monto_orden_tabla">
	    	<td colspan="3">Total </td>
	    	
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
<div id="pop-img" style="display: none;">
	<img id="img-pop" src="" alt="" width="100%" class="img-responsive">
</div>


<?php 
	if( count( $items_retirados ) > 0 ) 
		include( "table-retired-items.php" ); 
?>
