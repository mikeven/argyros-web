<table class="table-hover tabla-pedido">
	<thead>
	<tr>
		<th> </th>
		<th>Producto</th>
		<th>Cantidad</th>
		<th>Precio unit</th>
		<th>Total</th>
		<th> </th>
	</tr>
	</thead>
	<tbody>
		<?php 
	      foreach ( $odetalle as $r ) {
	        $total_item = $r["cant_rev"] * $r["price"];
	    ?>
	    <tr id="ir<?php echo $r["id"]; ?>">
	      <td><img src="<?php echo $purl.$r["imagen"]; ?>" width="70"></td>
	      <td><a href="#!"><?php echo $r["producto"]." (".$r["description"].")"." | "."Talla: ".$r["talla"]; ?></a></td>
	      <td align="center"><?php echo $r["cant_rev"]; ?></td>
	      <td>$<?php echo $r["price"]; ?></td>
	      <td>$<?php echo $total_item; ?></td>
	      <td>
	      	<i class="fa fa-times icancelp" data-t="ir<?php echo $r["id"]; ?>" 
	      		data-toggle="modal" data-target="#confirmar-accion" data-idi="<?php echo $r["id"]; ?>"></i>
	      </td>
	    </tr>
	    <?php } ?>
	    <tr>
	      <td></td>
	      <td>Total:</td>
	      <td align="center"></td>
	      <td></td>
	      <td></td>
	      <td></td>
	    </tr>
	</tbody>
</table>
<div class="separador"><hr></div>
<div id="panel_confirmacion">
	<a href="#!" class="btn btn-1" id="btn_conf_ped">Confirmar pedido</a>
</div>