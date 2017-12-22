<?php 
	/* Argyros - Funciones órdenes */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	
	function obtenerIconoEstado( $estado ){
		//Devuelve el ícono asociado al estado de un pedido
		$iconos = array( 
			"pendiente" 	=> "<i class='fa fa-clock-o'></i>",
			"cancelado" 	=> "<i class='fa fa-ban'></i>",
			"revisado" 		=> "<i class='fa fa-eye'></i>",
			"confirmado" 	=> "<i class='fa fa-bell'></i>",
			"entregado" 	=> "<i class='fa fa-arrow-right'></i>"
		);

		return $iconos[$estado];
	}
	/* ----------------------------------------------------------------------------------- */
	if( isset( $_GET["orderid"] ) && isset( $_SESSION["user"] ) ){
		$data_orden = obtenerOrdenPorId( $dbh, $_GET["orderid"] );
		$orden = $data_orden["orden"];
		$odetalle = $data_orden["detalle"];
		$orden["icono_e"] = obtenerIconoEstado( $orden["estado"] );
	}
	
	if( isset( $_SESSION["user"] ) ){
		$ordenes = obtenerOrdenesUsuario( $dbh, $_SESSION["user"]["id"] );
	}
	
	$purl = "../../argyros/trunk/admin_/"; //Localhost
	//$purl = "admin/"; // Server
	/* ----------------------------------------------------------------------------------- */
?>