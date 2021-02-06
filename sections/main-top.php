<?php
	/*
	*/
	if( isset( $_SESSION["login"] ) )
		$notif_ordenes = obtenerOrdenesNoLeidas( $dbh, $_SESSION["user"] );

?>
<div class="container">
  <div class="top row">
	<div class="col-md-6 phone-shopping" align="center">
	  <span>Distribuidor de platería</span>
	</div>
	
	<div class="col-md-18">
	  <ul class="text-right">
		<li class="customer-links hidden-xs">
			<ul id="accounts" class="list-inline">
				<?php if( !isset( $_SESSION["login"] ) ) { ?>
					<li class="login">  
						<a href="login.php">Ingresar</a>  
						<span id="loginButton" class="dropdown-toggle hidden" data-toggle="dropdown">
							<a href="login.php">Ingresar</a>
							<i class="sub-dropdown1"></i>
							<i class="sub-dropdown"></i>
						</span>
						<!-- Customer Account Login -->
						<div id="loginBox" class="dropdown-menu text-left hidden">
						
							<form method="post" id="frm_login_bar" accept-charset="UTF-8" data-toggle="validator">
								<input type="hidden" value="customer_login" name="form_type">
								<input type="hidden" name="utf8" value="✓">
								<div id="bodyBox">
									<ul class="control-container customer-accounts list-unstyled">
										<li class="clearfix">
											<label for="customer_email_box" class="control-label">Usuario <span class="req">*</span></label>
											<input type="email" value="" name="email" id="customer_email" 
											class="form-control" autocomplete="off">
										</li>						 
										<li class="clearfix">
											<label for="customer_password_box" class="control-label">Password <span class="req">*</span></label>
											<input type="password" value="" name="password" id="customer_password" class="form-control password">
										</li>						  
										<li class="clearfix">
											<button id="btn_login_dd" class="btn" type="button">Ingresar</button>
										</li>
										<hr>
										<a href="password_recovery.php">Recuperar contraseña</a>
									</ul>
								</div>
							</form>
						
						</div>    
					</li>
					<li>/</li>   
					<li class="register">
						<a href="register.php" id="customer_register_link">Crear cuenta</a>
					</li>
				<?php } else { ?>
					<li class="my-account">
						<a href="account.php">Mi Cuenta</a>
						<?php if( $notif_ordenes != 0 ) {?>
							<span class="badge icon_notif_leidos">
								<?php echo $notif_ordenes; ?>
							</span>
						<?php } ?>
					</li>
					<li class="my-account">
						<a href="index.php?logout">Salir</a>
					</li> 
				<?php } ?>
			</ul>
		</li>      
		<li id="widget-social">
		  <ul class="list-inline hidden">            
			<li><a target="_blank" href="#" class="btooltip swing" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Facebook"><i class="fa fa-facebook"></i></a></li>
			<li><a target="_blank" href="#" class="btooltip swing" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Twitter"><i class="fa fa-twitter"></i></a></li>                        			        
		  </ul>
		</li>        
	  </ul>
	</div>

  </div>
</div>