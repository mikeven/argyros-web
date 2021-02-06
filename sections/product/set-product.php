<section class="rel-container clearfix">  
	<h6 class="general-title text-left">Productos con los que hace juego</h6>
	<div id="prod-related-wrapper">
		<div class="prod-related clearfix">
			<?php
				foreach ( $productos_juegos as $prod ) {
					if( $prod["id"] != $pid ){
						$lnkp = "product.php?id=".$prod["id"];
						$img = obtenerImagenProducto( $dbh, $prod["id"] );
			?>
			<div class="element no_full_width not-animated" data-animate="bounceIn" data-delay="0">
				<ul class="row-container list-unstyled clearfix">
					<li class="row-left">
					<a href="<?php echo $lnkp; ?>" class="container_item">
					<img src="<?php echo $purl.$img[0]["image"] ?>" class="img-responsive" alt="Curabitur cursus dignis">
					<span class="sale_banner hidden">
					<span class="sale_text">Sale</span>
					</span>
					</a>
					<div class="hbw">
						<span class="hoverBorderWrapper"></span>
					</div>
					</li>
					<li class="row-right parent-fly animMix">
					<div class="product-content-left">
						<a class="title-5" href="<?php echo $lnkp; ?>"><?php echo $prod["name"]; ?></a>
						<span class="spr-badge" id="" data-rating="0.0">
						<span class="spr-starrating spr-badge-starrating hidden">
							<i class="spr-icon spr-icon-star-empty" style=""></i>
							<i class="spr-icon spr-icon-star-empty" style=""></i>
							<i class="spr-icon spr-icon-star-empty" style=""></i>
							<i class="spr-icon spr-icon-star-empty" style=""></i>
							<i class="spr-icon spr-icon-star-empty" style=""></i>
						</span>
						<span class="spr-badge-caption">
						No reviews </span>
						</span>
					</div>
					<div class="product-content-right">
						<div class="product-price hidden">
							<span class="price_sale">$259.00</span>
							<del class="price_compare"> $300.00</del>
						</div>
					</div>
					<div class="list-mode-description">
						<?php echo $prod["description"]; ?>
					</div>
					<div class="hover-appear hidden">
						<form action="#" method="post">
							<div class="effect-ajax-cart">
								<input name="quantity" value="1" type="hidden">
								<button class="select-option" type="button" onclick="window.location.href='product.html'"><i class="fa fa-th-list" title="Select Options"></i><span class="list-mode">Select Option</span></button>
							</div>
						</form>
						<div class="product-ajax-qs hidden-xs hidden-sm">
							<div data-handle="curabitur-cursus-dignis" data-target="#quick-shop-modal" class="quick_shop" data-toggle="modal">
								<i class="fa fa-eye" title="Quick view"></i><span class="list-mode">Quick View</span>																	
							</div>
						</div>
						<a class="wish-list" href="account.html" title="wish list"><i class="fa fa-heart"></i><span class="list-mode">Add to Wishlist</span></a>
					</div>
					</li>
				</ul>
			</div>
			<?php
				} }
			?>
		</div>	
	</div>										
</section>