<div class="breadcrum">
	<a href="index.php" class="homepage-link" title="Regresar a página de inicio">Inicio</a>
	<span>/</span>
	<a href="categories.php">
		<span class="page-title"><?php echo "Catálogo"; ?></span>
	</a>
	<span>/</span>
	<?php if( isset( $_GET["c"] ) ) { 
		$idctg = oic( $dbh, 'c', $_GET["c"], "" ) 
	?>
		<a href="subcategories.php?category=<?php echo $_GET[c] ?>&cat=<?php echo $idctg ?>">
			<span class="page-title"><?php echo $h_ncat["name"]; ?></span>
		</a>
	<?php } ?>
	<?php if( isset( $_GET["s"] ) ) {?>
		<span>/</span>
		<span class="page-title"><?php echo $h_nscat["name"]; ?></span>
	<?php } ?>
	<?php if( isset( $_GET["busqueda"] ) ) {?>
		<span class="page-title"><?php echo $h_ncat; ?></span>
	<?php } ?>
</div>