<?php 
	/* Argyros - Funciones órdenes */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	
	function obtenerIconoEstado( $estado ){
		//Devuelve el ícono asociado al estado de un pedido
		$iconos = array( 
			"pendiente" 	=> "<i class='fa fa-clock-o' title='Pendiente'></i>",
			"cancelado" 	=> "<i class='fa fa-ban' title='Cancelado'></i>",
			"revisado" 		=> "<i class='fa fa-eye' title='Revisado'></i>",
			"confirmado" 	=> "<i class='fa fa-check' title='Confirmado'></i>",
			"entregado" 	=> "<i class='fa fa-arrow-right' title='Entregado'></i>"
		);

		return $iconos[$estado];
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerTotalItemOrden( $item, $estado ){
		//Devuelve el monto total de un ítem de acuerdo a la disponibilidad del mismo y el estatus del pedido

		if( $estado == "revisado" ){
			$monto = $item["cant_rev"] * $item["price"];
		}else
			$monto = $item["quantity"] * $item["price"];
		
		return $monto;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerTotalPesoItemOrden( $item, $estado ){
		//Devuelve el peso total de un ítem de acuerdo a la disponibilidad del mismo y el estatus del pedido

		if( $estado == "pendiente" || $estado == "cancelado" ){
			$tpeso = $item["quantity"] * $item["peso"];
		}else
			$tpeso = $item["cant_rev"] * $item["peso"];
		
		return $tpeso;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerPesoTotalOrden( $orden, $detalle ){
		//Devuelve el peso total de un pedido

		$tpeso = 0;
		foreach ( $detalle as $i ) {
			$tpeso += obtenerTotalPesoItemOrden( $i, $orden["estado"] );
		}
		
		return $tpeso;
	}
	/* ----------------------------------------------------------------------------------- */
	if( isset( $_GET["orderid"] ) && isset( $_SESSION["user"] ) ){
		
		$data_orden 				= obtenerOrdenPorId( $dbh, $_GET["orderid"] );
		$orden 						= $data_orden["orden"];
		if( $orden ){
			$odetalle 				= $data_orden["detalle"];
			$orden["icono_e"] 		= obtenerIconoEstado( $orden["estado"] );
			$orden["nitems"] 		= obtenerNumeroItemsOrden( $orden, $odetalle );
			$orden["total_ajuste"] 	= calcularTotalOrdenRevisada( $odetalle );
			$orden["tpeso"] 		= obtenerPesoTotalOrden( $orden, $odetalle );

			leerOrden( $dbh, $_GET["orderid"], "leido" );
		}
	}
	/* ----------------------------------------------------------------------------------- */
	if( isset( $_SESSION["user"] ) ){
		$ordenes = obtenerOrdenesUsuario( $dbh, $_SESSION["user"]["id"] );
	}
	/* ----------------------------------------------------------------------------------- */
	//$purl = "../../argyros/trunk/admin_/"; //Localhost
	$purl = "admin/"; // Server
	/* ----------------------------------------------------------------------------------- */
?>