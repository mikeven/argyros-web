<!-- Bloque producto referencia de producto en desuso -->

<?php $lnk_producto = "product.php?id=$prod_ref[pid]&iddet=$prod_ref[id]"; ?>

<!-- <span itemprop="name" style="color: #808080;"> SUSTITUIDO POR </span> -->

<div id="disused_product_reference">
	
	<div class="img_pdet_container">
		<a href="<?php echo $lnk_producto ?>" class="lnk_producto">
			<img src="<?php echo $purl.$prod_ref[imagen] ?>" 
			alt="<?php echo $prod_ref[pid]-$prod_ref[id] ?>" class="img-det-prod img_ref_disused">
		</a>
	</div>

	<div align="center">
		<span class="detlist-id-det"> <?php echo "#".$prod_ref["pid"]."-".$prod_ref["id"]; ?> </span>
	</div>
	
</div>

<!-- /.Bloque producto referencia de producto en desuso -->

