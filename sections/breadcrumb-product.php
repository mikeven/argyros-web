<div id="breadcrumb" class="breadcrumb">
	<div itemprop="breadcrumb" class="container">
		<div class="row">
			<div class="col-md-24">

				<?php if( isset( $_SESSION["login"] ) ) { ?>

					<?php if( $is_p ) { ?>
					<a href="index.php" class="homepage-link" 
					title="Página de inicio">Inicio</a>
					<span>/</span>

					<a href="categories.php" title="Catálogo">Catálogo</a>
					<span>/</span>

					<a href="<?php echo URLBASECAT?>?c=<?php echo $producto["uname_c"]; ?>" 
					title="<?php echo $producto["category"]; ?>">
					<?php echo $producto["category"]; ?>
					</a>
					<span>/</span>

					<a href="<?php echo URLBASECAT?>?c=<?php echo $producto["uname_c"]; ?>&s=<?php echo $producto["uname_s"]; ?>" 
					title="<?php echo $producto["category"]; ?>">
					<?php echo $producto["subcategory"]; ?></a>
					<span>/</span>

					<span class="page-title"><?php echo $producto["name"]; ?></span>
					<?php } else { ?>
						<a href="index.php" class="homepage-link" title="Página de inicio">Inicio</a>
					<?php } ?>

				<?php } ?>
				| 
				<a id="backbutton" href="javascript:history.back()"> 
					<span class="page-title"><i class="fa fa-arrow-left"></i> Volver</span>
				</a>
			</div>
		</div>
	</div>
</div>