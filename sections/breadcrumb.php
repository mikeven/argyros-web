<div class="breadcrum">
	<a href="index.php" class="homepage-link" title="Regresar a página de inicio">Inicio</a>
	<span>/</span>
	<?php if( isset( $_GET["c"] ) ) {?>
		<a href="acatalog.php?c=<?php echo $cat; ?>">
			<span class="page-title"><?php echo $h_ncat["name"]; ?></span>
		</a>
	<?php } ?>
	<?php if( isset( $_GET["s"] ) ) {?>
		<span>/</span>
		<a href="acatalog.php?c=<?php echo $cat; ?>&s=<?php echo $sub; ?>">
			<span class="page-title"><?php echo $h_nscat["name"]; ?></span>
		</a>
	<?php } ?>
	<?php if( isset( $_GET["busqueda"] ) ) {?>
		<a href="#!">
			<span class="page-title"><?php echo $h_ncat; ?></span>
		</a>
	<?php } ?>
</div>