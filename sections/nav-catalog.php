<div class="megamenu-container megamenu-container-1 dropdown-menu banner-bottom mega-col-4" id="listcatalog">
	<ul id="catalogo-navegacion-menu" class="sub-mega-menu">
		<li>
			<ul>
				<?php foreach ( $lh_cat_ppal as $h_reg_categ ) { //header.php ?>	
					<?php if( $h_reg_categ["id"] != 0 ) { ?>
					<li class="list-title licatppal">
						<a href="acatalog.php?c=<?php echo $h_reg_categ["uname"];?>" 
						class="hnc_selcp hnc_selector" data-trg="hnc_sc<?php echo $h_reg_categ["id"] ?>">
							<?php 
								echo reempEspacio( $h_reg_categ["name"] ); 
							?>
						</a>
					</li>
					<?php } ?>
				<?php } ?>
			</ul>
		</li>
		
		<li> </li>
		
		<li>
			<?php foreach ( $lh_cat_ppal as $h_reg_categ ) { // 
				$l_sc_p = obtenerListaSubCategoriasCategoria( $dbh, $h_reg_categ["id"] );	
			?>
				<ul class="subcategs_navcatalog" id="hnc_sc<?php echo $h_reg_categ["id"] ?>">
					<span class="hnc_selcp tnavcategppal"><?php echo reempEspacio( $h_reg_categ["name"] ) ?></span>
					<?php foreach ( $l_sc_p as $h_reg_scateg ) { // ?>
					<li class="list-unstyled li-sub-mega">
						<a href="acatalog.php?c=<?php echo $h_reg_categ["uname"];?>
								&s=<?php echo $h_reg_scateg["uname"];?>" >
							<?php echo $h_reg_scateg["name"] ?>
						</a>
					</li>
					<?php } ?>
				</ul>
			<?php } ?>
		</li>

		<li class="hidden">
			<?php foreach ( $lh_cat_ppal as $h_reg_categ ) { // 
				$l_sc_p = obtenerListaSubCategoriasCategoria( $dbh, $h_reg_categ["id"] );	
			?>
				<ul class="subcategs_navcatalog" id="hnc_sc<?php echo $h_reg_categ["id"] ?>">
					<span class="hnc_selcp tnavcategppal"><?php echo reempEspacio( $h_reg_categ["name"] ) ?></span>
					<?php foreach ( $l_sc_p as $h_reg_scateg ) { // ?>
					<li class="list-unstyled li-sub-mega">
						<a href="acatalog.php?c=<?php echo $h_reg_categ["uname"];?>
								&s=<?php echo $h_reg_scateg["uname"];?>" >
							<?php echo $h_reg_scateg["name"] ?>
						</a>
					</li>
					<?php } ?>
				</ul>
			<?php } ?>
		</li>
		
	</ul>
</div>
<!--
<div class="megamenu-container megamenu-container-1 dropdown-menu banner-bottom mega-col-4" style="">
	<ul class="sub-mega-menu">
		<li>
		<ul>
			<li class="list-title">Anillos</li>
			<li class="list-unstyled li-sub-mega">
				<a href="#">Compromiso </a>
			</li>
			<li class="list-unstyled li-sub-mega">
				<a href="#">Matrimonio</a>
			</li>
			
		</ul>
		</li>
		<li>
		<ul>
			<li class="list-title">Brazaletes</li>
			<li class="list-unstyled li-sub-mega">
			<a href="#">Subcategoría 1 </a>
			</li>
			<li class="list-unstyled li-sub-mega">
			<a href="#">Subcategoría 2 </a>
			</li>
			<li class="list-unstyled li-sub-mega">
			<a href="#">Subcategoría 3 </a>
			</li>
			<li class="list-unstyled li-sub-mega">
			<a href="#">Subcategoría 4 </a>
			</li>
		</ul>
		</li>
		<li>
		<ul>
			<li class="list-title">Cadenas</li>
			<li class="list-unstyled li-sub-mega">
				<a href="#">Subcategoría 1 </a>
			</li>
			<li class="list-unstyled li-sub-mega">
				<a href="#">Subcategoría 2 </a>
			</li>
			<li class="list-unstyled li-sub-mega">
				<a href="#">Subcategoría 3 </a>
			</li>
			<li class="list-unstyled li-sub-mega">
				<a href="#">Subcategoría 4 </a>
			</li>
		</ul>
		</li>
		<li>
		<ul>
			<li class="list-title">Dijes</li>
			<li class="list-unstyled li-sub-mega">
				<a href="#">Subcategoría 1 </a>
			</li>
			<li class="list-unstyled li-sub-mega">
				<a href="#">Subcategoría 2 </a>
			</li>
			<li class="list-unstyled li-sub-mega">
				<a href="#">Subcategoría 3 </a>
			</li>
			<li class="list-unstyled li-sub-mega">
				<a href="#">Subcategoría 4 </a>
			</li>
		</ul>
		</li>
	</ul>
</div>
-->