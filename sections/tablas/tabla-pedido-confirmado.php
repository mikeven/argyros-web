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
	      foreach ( $odetalle as $r ) {
	        $total_item = $r["cant_rev"] * $r["price"];
	    ?>
	    <tr id="ir<?php echo $r["id"]; ?>">
	      <td><img src="<?php echo $purl.$r["imagen"]; ?>" width="70"></td>
	      <td>
	      	<input type="hidden" id="iditem<?php echo $r["id"]; ?>" name="ielims[]" value="0">
	      	<a href="#!">
	      		<?php echo $r["producto"]." (".$r["description"].")"." | "."Talla: ".$r["talla"]; ?>
	      	</a>
	      </td>
	      <td align="center"><?php echo $r["cant_rev"]; ?></td>
	      <td>$<?php echo $r["price"]; ?></td>
	      <td>$<?php echo $total_item; ?></td>
	    </tr>
	    <?php } ?>
	</tbody>
</table>