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
			"confirmado" 	=> "fa-bell",
			"finalizado" 	=> "fa-arrow-right",
		);

		return $iconos[$estado];
	}
	/* ----------------------------------------------------------------------------------- */
	if( isset( $_GET["id"] ) && isset( $_SESSION["user"] ) ){
		$data_orden = obtenerOrdenPorId( $dbh, $_GET["id"] );
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