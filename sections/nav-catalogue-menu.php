<style type="text/css">
	.subcategs_navcatalog, .lnk-hnc-regresar{
		display: none;
	}
	.hnc_selector-menu:hover, .lnk-hnc-regresar:hover{
		cursor: pointer;
	}
</style>
<div class="megamenu-container megamenu-container-1 dropdown-menu banner-bottom mega-col-4" id="listcatalog">
	<ul id="catalogo-navegacion-menu" class="sub-mega-menu">
		<li id="menu-lista-categs">
			<ul>
				<?php foreach ( $lh_cat_ppal as $h_reg_categ ) { //header.php ?>	
					<?php if( $h_reg_categ["id"] != 0 ) { ?>
					<li class="list-title licatppal">
						<a class="hnc_selcp hnc_selector-menu" 
						data-trg="hnc_sc<?php echo $h_reg_categ["id"] ?>"
						data-indicador="cont-sc<?php echo $h_reg_categ["id"] ?>">
							<?php echo reempEspacio( $h_reg_categ["name"] ); ?>
						</a>
					</li>
					<?php } ?>
				<?php } ?>
			</ul>
		</li>
		<?php foreach ( $lh_cat_ppal as $h_reg_categ ) { // 
			$l_sc_p = obtenerListaSubCategoriasCategoria( $dbh, $h_reg_categ["id"] );	
		?>
			<ul class="subcategs_navcatalog" id="hnc_sc<?php echo $h_reg_categ["id"] ?>">
				<div class="cont-lnk-hnc-regresar">
					<a class="lnk-hnc-regresar" data-trgr="hnc_sc<?php echo $h_reg_categ["id"] ?>">
						< Regresar
					</a>
				</div>
				<div style="margin-bottom: 10px;">
					<span class="hnc_selcp tnavcategppal">
						<?php echo reempEspacio( $h_reg_categ["name"] ) ?>
					</span>
				</div>
				<?php foreach ( $l_sc_p as $h_reg_scateg ) { // ?>
				<li class="list-unstyled li-sub-mega">
					<a href="<?php echo URLBASECAT?>?c=<?php echo $h_reg_categ["uname"];?>
							&s=<?php echo $h_reg_scateg["uname"];?>" >
						<?php echo $h_reg_scateg["name"] ?>
					</a>
				</li>
				<?php } ?>
				<a href="<?php echo URLBASECAT?>?c=<?php echo $h_reg_categ["uname"];?>">
					<span class="tnavcategppal"> TODOS </span>
				</a>
			</ul>
		<?php } ?>
	</ul>

	
	


</div>

<script>
	$(".hnc_selector-menu").on( "click", function(){
		$("#menu-lista-categs").hide(200);
		var trg = $(this).attr("data-trg");
		$("#" + trg).show();
	});

	$(".lnk-hnc-regresar").on( "click", function(){
		var trgr = $(this).attr("data-trgr");
		$( "#" + trgr ).hide(200);
		$("#menu-lista-categs").show();
	});
</script>