<div class="home-collection-wrapper sb-wrapper clearfix">
	<h6 class="sb-title">Categorías relacionadas</h6>
	<ul class="list-unstyled sb-content list-styled">
		<?php foreach ( $ls_subc_prod as $rg_sc ) { ?>
		<li>
			<a href="<?php echo URLBASECAT?>?c=<?php echo $producto["uname_c"] ?>&s=<?php echo $rg_sc["uname"] ?>" 
				class="categ-rel-prod" >
				<span><i class="fa fa-circle"></i> <?php echo $rg_sc["name"]; ?></span>
				<span class="collection-count"> </span>
			</a>
		</li>
		<?php } ?>
	</ul>
</div>
<hr>
<a href="#!" onclick="window.close()"><i class="fa fa-times"></i> Cerrar ventana</a>