<div class="footer-content footer-content-top clearfix">
	<div class="container">
		
		<div class="footer-link-list col-lg-6 col-md-6 col-xs-24">
		  <div class="group">
			<h5 class="general-title">Nosotros</h5>						
			<ul class="list-unstyled list-styled">						  
			  <li class="list-unstyled">
				<a href="about-us.php">Acerca de Argyros</a>
			  </li>						  
			  <li class="list-unstyled">
				<a href="about-us.php#nuestros-clientes">Nuestros Clientes</a>
			  </li>						  
			  <li class="list-unstyled">
				<a href="about-us.php#nuestros-productos">Nuestros productos</a>
			  </li>						  
			</ul>
		  </div>
		</div>   
		
		<div class="footer-link-list col-lg-6 col-md-6 col-xs-24">
		  <div class="group">
			<h5 class="general-title">Información</h5>						
			<ul class="list-unstyled list-styled">						  
			  <li class="list-unstyled">
				<a href="how-to-buy.php">Como comprar</a>
			  </li>						  
			  <li class="list-unstyled">
				<a href="terms-and-conditions.php">Términos y Condiciones</a>
			  </li>	
			  <li class="list-unstyled">
				<a href="contact.php">Contáctanos</a>
			  </li>					  
			</ul>
		  </div>
		</div>
		
		<div class="footer-link-list col-lg-6 col-md-6 col-xs-24">
		  <div class="group">
			<h5 class="general-title">Cuenta</h5>						
			<ul class="list-unstyled list-styled">
				
				<?php if( isset( $_SESSION["login"] ) ) { ?>

					<li class="list-unstyled">
						<a href="account.php">Mis pedidos</a>
					</li>
					<li class="list-unstyled">
						<a href="categories.php">Catálogo</a>
					</li>

				<?php } else { ?>

					<li class="list-unstyled">
						<a href="login.php">Ingresar</a>
					</li>						  
					<li class="list-unstyled">
						<a href="register.php">Crear cuenta</a>
					</li>
					
				<?php } ?>

			</ul>
		  </div>
		</div>
		
		<div class="footer-link-list col-lg-6 col-md-6 col-xs-24">
		  <div class="group_">
			<h5 class="general-title">Contacto</h5>						
			<ul class="list-unstyled list-styled">						  						  
				<li class="list-unstyled">
					Final calle 15, Edif. Silver Crown, local 2, Zona Libre de Colón. Panamá.
				</li>						  
				<li class="list-unstyled"><i class="fa fa-phone" style="margin-right: 8px;"></i> (+507) 447 3175 / 447 2774 </li>
				<li class="list-unstyled"><img src="assets/images/whatsapp.png" width="15" style="margin-right: 8px;">(+507) 6678-9111 / 6278-5100</li>						  
				<li class="email"><i class="fa fa-envelope" style="margin-right: 8px;"></i>info@argyros.com.pa</li>
				<li class="email">
					<ul id="social-footer" class="list-inline animated">
						<li class="btooltip tada" data-toggle="tooltip" data-placement="top" title="Facebook" 
						data-original-title="Facebook"><a href="https://www.facebook.com/ArgyrosInc" class="fa fa-facebook" style="color:#000;" target="_blank"></a></li>
						<li class="btooltip tada" data-toggle="tooltip" data-placement="top" title="Twitter" 
						data-original-title="Twitter"><a href="https://twitter.com/argyrosinc" class="fa fa-twitter" style="color:#000;" target="_blank"></a></li>
						<li class="btooltip tada" data-toggle="tooltip" data-placement="top" title="Instagram" 
						data-original-title="Instagram"><a href="https://www.instagram.com/argyrosinc/" class="fa fa-instagram" style="color:#000;" target="_blank"></a></li>
						<li class="btooltip tada" data-toggle="tooltip" data-placement="top" title="YouTube" 
						data-original-title="YouTube"><a href="https://www.youtube.com/channel/UCBEG8W6oNxHoxJAIWl43DFg" class="fa fa-youtube" style="color:#000;" target="_blank"></a></li>
					</ul>
				</li>
			</ul>
		  </div>
		</div>

	</div>
</div>