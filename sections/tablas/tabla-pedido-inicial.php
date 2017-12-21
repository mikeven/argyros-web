<table class="tabla-pedido">
	<thead>
	<tr>
		<th> </th>
		<th>Producto</th>
		<th>Cantidad</th>
		<th>Precio unit</th>
		<th>Total</th>
		<?php if( $orden["estado"] == "revisado" ) { ?>
		<th class="colrev">Cant Disp</th>
		<th class="colrev"> </th>
		<?php } ?>
	</tr>
	</thead>
	<tbody>
		<?php 
	      foreach ( $odetalle as $r ) {
	        $total_item = $r["quantity"] * $r["price"];
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
	      <td>$<?php echo $r["price"]; ?></td>
	      <td>
	      	$<?php echo number_format( $total_item, 2, ".", " " ); ?>
	      	<input type="hidden" id="monto<?php echo $r["id"]; ?>" value="<?php echo $total_item; ?>">
	      	<input class="sumatmp" type="hidden" id="montotmp<?php echo $r["id"]; ?>" value="<?php echo $total_item; ?>">
	      </td>
	      <?php if( $orden["estado"] == "revisado" ) { ?>
		      <td align="center"><span id="qd<?php echo $r["id"]; ?>"><?php echo $r["cant_rev"]; ?></span></td>
		      <td>
		      	<i class="fa fa-times icancelp" data-t="<?php echo $r["id"]; ?>">
		      	</i>
		      </td>
	      <?php } ?>
	    </tr>
	    <?php } ?>
	</tbody>
</table>
<?php if( $orden["estado"] == "revisado" ) { ?>
<div class="separador"><hr></div>
<div id="panel_confirmacion">
	<a href="#!" data-toggle="modal" data-target="#confirmar-accion" 
	class="btn btn-1" id="btn_conf_ped" style="float:left">Confirmar cambios en pedido</a>
</div>
<div id="i_rmped" style="float:left"></div>
<?php } ?>