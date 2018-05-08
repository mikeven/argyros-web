<div class="container">
	<div class="top-navigation">
		<ul class="list-inline">
			<li class="top-logo seccion_filtros_catalogo_movil">
				<a id="site-title" href="index.php" title="Argyros, Inc.">          
				<img class="img-responsive" src="assets/images/alogo.png" alt="Argyros, Inc.">        
				</a>
			</li>
			<li class="navigation">			
				<nav class="navbar">
					<div class="clearfix">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" 
							data-target=".navbar-collapse">
							<span class="sr-only">Cambiar navegación</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							</button>
						</div>
						<div class="is-mobile visible-xs">
							<ul class="list-inline">
								<li class="is-mobile-menu">
								<div class="btn-navbar" data-toggle="collapse" data-target=".navbar-collapse">
									<span class="icon-bar-group">
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									</span>
								</div>
								</li>
								<li class="is-mobile-login">
								<div class="btn-group">
									<div class="dropdown-toggle" data-toggle="dropdown">
										<i class="fa fa-user"></i>
									</div>
									<ul class="customer dropdown-menu">
										<li class="logout">
										<a href="login.php">Login</a>
										</li>
										<li class="account last">
										<a href="register.php">Crear cuenta</a>
										</li>
									</ul>
								</div>
								</li>
								<!--<li class="is-mobile-wl">
								<a href="#"><i class="fa fa-heart"></i></a>
								</li>-->
								<li class="is-mobile-cart">
								<a href="cart.php"><i class="fa fa-shopping-cart"></i></a>
								</li>
							</ul>
						</div>
						<div class="collapse navbar-collapse">
							<ul class="nav navbar-nav hoverMenuWrapper">
								<li class="nav-item active">
									<a href="index.php">
										<span>Inicio</span>
									</a>
								</li>

								<li class="dropdown mega-menu">
									<a href="about-us.php">
										<span>Nosotros</span>
										<!-- <i class="fa fa-caret-down"></i> -->
										<i class="sub-dropdown1 visible-sm visible-md visible-lg"></i>
										<i class="sub-dropdown visible-sm visible-md visible-lg"></i>
									</a>
								
								</li>
								<li id="drop-catalog" class="dropdown mega-menu">
									<a href="catalog.php" class="dropdown-toggle dropdown-link" data-toggle="dropdown">
										<span>Catálogo</span>
										<!-- <i class="fa fa-caret-down"></i> -->
										<i class="sub-dropdown1 visible-sm visible-md visible-lg"></i>
										<i class="sub-dropdown visible-sm visible-md visible-lg"></i>
									</a>
									<?php include("nav-catalog.php");?>
								</li>
								
								<li class="nav-item">
									<a href="contact.php">
										<span>Contacto</span>
									</a>
								</li>
							</ul>
						</div>
					</div>
				</nav>
			</li>		  
			<li class="top-search hidden-xs">
				<div class="header-search">
					<a href="#!">
						<span data-toggle="dropdown">
						<i class="fa fa-search"></i>
						<i class="sub-dropdown1"></i>
						<i class="sub-dropdown"></i>
						</span>
					</a>
					<form id="header-search" class="search-form dropdown-menu" action="acatalog.php" method="get">
						<!-- <input type="hidden" name="type" value="product"> -->
						<input type="text" name="busqueda" value="" accesskey="4" autocomplete="off" placeholder="Buscar...">
						<button type="submit" class="btn">Buscar</button>
					</form>
				</div>
			</li>					
			<li id="cart-drop-icon" class="umbrella hidden-xs">
				<?php include( "drop-cart.php" ); ?>
				<!-- Carrito de compras -->
			</li>		  		 
			<li class="mobile-search visible-xs">
				<form id="mobile-search" class="search-form" action="http://demo.designshopify.com/html_jewelry/search.html" method="get">
					<input type="hidden" name="type" value="product">
					<input type="text" class="" name="q" value="" accesskey="4" autocomplete="off" placeholder="Buscar...">
					<button type="submit" class="search-submit" title="search"><i class="fa fa-search"></i></button>
				</form>
			</li>		  
		</ul>
	</div>
	<!--End Navigation-->
	<script>
	  function addaffix(scr){
		if($(window).innerWidth() >= 1024){
		  if(scr > $('#top').innerHeight()){
			if(!$('#top').hasClass('affix')){
			  $('#top').addClass('affix').addClass('animated');
			}
		  }
		  else{
			if($('#top').hasClass('affix')){
			  $('#top').prev().remove();
			  $('#top').removeClass('affix').removeClass('animated');
			}
		  }
		}
		else $('#top').removeClass('affix');
	  }
	  $(window).scroll(function() {
		var scrollTop = $(this).scrollTop();
		addaffix(scrollTop);
	  });
	  $( window ).resize(function() {
		var scrollTop = $(this).scrollTop();
		addaffix(scrollTop);
	  });
	</script>
</div>