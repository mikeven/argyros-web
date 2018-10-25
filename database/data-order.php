<?php
	/* ----------------------------------------------------------------------------------- */
	/* Argyros - Funciones de órdenes */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	function mensajeRespuestaOrden(){
		//Obtiene el contenido de la respuesta al procesar órdenes
		$html = "../fn/order-response.html";
		return file_get_contents( $html );
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerRegistroOrdenPorId( $dbh, $ido, $idu ){
		//Devuelve el registro de una orden dado su id
		$q = "select o.id, o.user_id as idu, o.total_price as total, o.total_count as nitems, 
		o.client_note, o.admin_note, o.order_status as estado, 
		date_format( o.created_at,'%d/%m/%Y') as fecha, c.id as cid, c.first_name nombre, 
		c.last_name as apellido, c.email as email, g.name as grupo_cliente 
		from orders o, clients c, client_group g where o.user_id = c.id and c.client_group_id = g.id 
		and o.id = $ido and o.user_id = $idu";

		$data = mysqli_query( $dbh, $q );
		return mysqli_fetch_array( $data );
	}
	/* ----------------------------------------------------------------------------------- */
	function calcularTotalOrdenRevisada( $detalle ){
		//Devuelve el total de una orden después de haber sido revisado/confirmado
		$monto = 0;
		foreach ( $detalle as $item ) {
			$monto += $item["cant_rev"] * $item["price"];
		}

		return $monto;		
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerDetalleOrden( $dbh, $ido ){
		//Devuelve los registros correspondientes a un detalle de pedido dado su id
		$q = "select od.id, od.order_id, od.product_id, od.product_detail_id, 
		od.size_id as idtalla, od.quantity, od.price, od.available as cant_rev, 
		od.check_revision as estado_rev, od.item_status, p.name as producto, 
		p.description, s.name as talla, s.unit 
		from orders o, order_details od, products p, sizes s, 
		size_product_detail sd, product_details pd 
		where od.order_id = o.id and od.product_id = p.id and od.product_detail_id = pd.id and 
		od.size_id = s.id and sd.product_detail_id = pd.id and sd.size_id = s.id and o.id = $ido";

		$data = mysqli_query( $dbh, $q );
		$lista = obtenerListaRegistros( $data );
		return $lista;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerImagenesProductoOrden( $dbh, $detalle ){
		//Devuelve las imágenes de los productos de una orden
		//include( "data-products.php" );

		$ndetalle = array();
		foreach ( $detalle as $reg ) {
			$data = obtenerImagenesDetalleProducto( $dbh, $reg["product_detail_id"], 1 );
			$reg["imagen"] = $data[0]["path"];
			$ndetalle[] = $reg;		
		}
		return $ndetalle;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerOrdenPorId( $dbh, $ido ){
		//Devuelve el contenido de una orden, su detalle dado su id
		$idu = $_SESSION["user"]["id"];
		$orden["orden"] = obtenerRegistroOrdenPorId( $dbh, $ido, $idu );
		$orden["detalle"] = obtenerDetalleOrden( $dbh, $ido );
		$orden["detalle"] = obtenerImagenesProductoOrden( $dbh, $orden["detalle"] );
		
		return $orden;
	}
	/* ----------------------------------------------------------------------------------- */
	function guardarRegistroDetalleOrden( $dbh, $orden, $reg ){
		//Guarda un registro de detalle de orden
		$q = "insert into order_details ( order_id, product_id, product_detail_id, item_status, 
		size_id, quantity, price, created_at ) values ( $orden[id], $reg[idproducto], $reg[iddetalle], 
		'', $reg[idseltalla], $reg[quantity], $reg[unit_price], NOW() )";
		
		$data = mysqli_query( $dbh, $q );
		return mysqli_insert_id( $dbh );
	}
	/* ----------------------------------------------------------------------------------- */
	function registrarDetalleOrden( $dbh, $orden, $carrito ){
		//Guarda el detalle de una orden, recorriendo el carrito de compra
		$n = 0;
		foreach ( $carrito as $item ) {
			guardarRegistroDetalleOrden( $dbh, $orden, $item );
			$n++; 
		}
		return $n;
	}
	/* ----------------------------------------------------------------------------------- */
	function registrarOrden( $dbh, $orden ){
		//Guarda el registro de una orden
		$q = "insert into orders ( user_id, total_price, total_count, created_at, order_read, order_status ) 
		values ( $orden[id_user], $orden[total_pedido], $orden[total_items], NOW(), '', 'pendiente' )";
		
		$data = mysqli_query( $dbh, $q );
		return mysqli_insert_id( $dbh );
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerDatosCreacionOrden( $carrito ){
		//Devuelve los datos iniciales para crear un registro de orden
		
    	$total = obtenerMontoTotalCarritoCompra();

		$orden["id_user"] = $_SESSION["user"]["id"];
		$orden["total_pedido"] = $total;
		$orden["total_items"] = count( $carrito );

		return $orden;	
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerOrdenesUsuario( $dbh, $idu ){
		//Devuelve el registro de las órdenes asociadas a un usuario
		$q = "select id, user_id as idu, total_price as total, order_status as estado, 
		order_read as leido, date_format( created_at,'%d-%m-%Y') as fecha 
		from orders where user_id = $idu order by id DESC";
		
		$data = mysqli_query( $dbh, $q );
		$lista = obtenerListaRegistros( $data );
		return $lista;
	}
	/* ----------------------------------------------------------------------------------- */
	function cambiarEstadoOrden( $dbh, $ido, $estado ){
		//Cambia el estado de un pedido a cancelado
		$q = "update orders set order_status = '$estado' where id = $ido";
		return mysqli_query( $dbh, $q );
	}
	/* ----------------------------------------------------------------------------------- */
	function cambiarEstadoItemPedidoRevisado( $dbh, $ido, $iddp, $estado ){
		//Cambia el estado de un ítem de pedido revisado
		$q = "update order_details set item_status = '$estado' where id = $iddp and order_id = $ido";
		//echo $q;
		return mysqli_query( $dbh, $q );
	}
	/* ----------------------------------------------------------------------------------- */
	function ingresarObservacionesCliente( $dbh, $pedido ){
		//Guarda observaciones por parte del cliente al confirmar un pedido
		$q = "update orders set client_note = '$pedido[observaciones]' where id = $pedido[id_orden]";
		//echo $q;
		return mysqli_query( $dbh, $q );
	}
	/* ----------------------------------------------------------------------------------- */
	function retirarItemsPedido( $dbh, $pedido ){
		//Recorre los ítems del pedido y envía a actualización de estado los marcados para eliminar
		$items = $pedido["ielims"];
		$noper = 0;
		foreach ( $items as $i ){
			if( $i != 0 )
				$noper += cambiarEstadoItemPedidoRevisado( $dbh, $pedido["id_orden"], $i, "retirado" );	
		}
		return $noper;
	}
	/* ----------------------------------------------------------------------------------- */
	function actualizarDisponibilidadItemProducto( $dbh, $orden ){
		//Oculta los registros de detalle de producto que se hayan confirmado en un pedido y que
		//hayan sido revisados desde el administrador indicando menor disponibilidad a la solicitada
		include( "data-products.php" );

		$orden_actual = obtenerOrdenPorId( $dbh, $orden["id"] );
		$r_orden_actual = $orden_actual["orden"];
		$detalle_orden_actual = $orden_actual["detalle"]; 
		
		if( $r_orden_actual["estado"] == "confirmado" ){
			foreach ( $detalle_orden_actual as $det ) {
				if( ( $det["estado_rev"] == "modif" ) 
						&& ( $det["cant_rev"] <= $det["quantity"] ) 
						&& ( $det["item_status"] != "retirado" ) 
				){
					//Si ítem posee estado revisado (revisión administrador)
					//Si cantidad revisada (disponible) es menor o igual a la cantidad solicitada
					//Si ítem no fue descartado (retirado) del pedido por el cliente 
					$id_det_prod = $det["product_detail_id"];
					$idtalla = $det["idtalla"];
					actualizarDisponibilidadTallaProducto( $dbh, 
						$det["product_detail_id"], $det["idtalla"], 0 );
					actualizarDisponibilidadProductoPorAjuste( $dbh, $det["product_id"] );
				}
			}
		}

	}
	/* ----------------------------------------------------------------------------------- */
	function notificarActualizacionPedido( $dbh, $estado, $orden, $total ){
		//Prepara los datos necesarios para enviar notificación por email acerca de 
		//cambios en estados de pedido 
		ini_set( 'display_errors', 1 );
		include( "data-user.php" );
		include( "../fn/fn-mailing.php" );
		$email_admin = obtenerEmailNotificacionPedidos( $dbh );

		if( $estado == "nuevo_pedido" ){
			//Notificación de nuevo pedido registrado: Cliente y Administrador
			$data["usuario"] = obtenerUsuarioPorId( $orden["id_user"], $dbh );
			$data["orden"] = $orden;
			$data["total"] = number_format( $total, 2, '.', ',' );
			enviarMensajeEmail( "nuevo_pedido_usuario", $data, $data["usuario"]["email"] );
			enviarMensajeEmail( "nuevo_pedido_administrador", $data, $email_admin );
		}
		if( $estado == "pedido_confirmado" ){
			//Notificación de confirmación de pedido: Administrador
			enviarMensajeEmail( "pedido_confirmado_administrador", $orden, $email_admin );
		}
	}
	/* ----------------------------------------------------------------------------------- */
	function leerOrden( $dbh, $id, $leido ){
		//Marca como leído un pedido
		$q = "update orders set order_read = '$leido' where id = $id";

		$data = mysqli_query( $dbh, $q );
		return $data;
	}
	
	/* ----------------------------------------------------------------------------------- */
	/* Solicitudes asíncronas al servidor para procesar información de órdenes */
	/* ----------------------------------------------------------------------------------- */
	
	//Petición para crear un nuevo registro de orden ( pedido )
	if( isset( $_POST["neworder"] ) ){
		session_start();
		ini_set( 'display_errors', 1 );
		$carrito = $_SESSION["cart"];
		include( "../database/bd.php" );
		include( "../fn/fn-cart.php" );
	
		if ( count( $carrito ) > 0 ) {
			$orden = obtenerDatosCreacionOrden( $carrito );
			$orden["id"] = registrarOrden( $dbh, $orden );
			$n = registrarDetalleOrden( $dbh, $orden, $carrito );
			if( $n > 0 ){
				$monto_tcart = obtenerMontoTotalCarritoCompra();
				notificarActualizacionPedido( $dbh, "nuevo_pedido", $orden, $monto_tcart );
				vaciarCarrito();
				echo mensajeRespuestaOrden();
			}
		}
		else 
			echo "Error al guardar su pedido";
	}
	/* ----------------------------------------------------------------------------------- */
	//Petición para cancelar una orden ( pedido )
	if( isset( $_POST["status_orden"] ) ){
		include( "../database/bd.php" );
		
		echo cambiarEstadoOrden( $dbh, $_POST["id_orden"], $_POST["status_orden"] );
	}
	/* ----------------------------------------------------------------------------------- */
	//Petición para modificar ítems de una orden ( pedido )
	if( isset( $_POST["modif_pedido"] ) ){
		session_start();
		ini_set( 'display_errors', 1 );
		include( "../database/bd.php" );

		parse_str( $_POST["modif_pedido"], $pedido );
		$ido = $_POST["idorden"];
		$pedido["id_orden"] = $ido;
		
		$data_orden = obtenerOrdenPorId( $dbh, $ido );
		$rorden = $data_orden["orden"];
		$rorden["total_monto"] = $_POST["mconf"];
		
		$res = retirarItemsPedido( $dbh, $pedido );
		
		ingresarObservacionesCliente( $dbh, $pedido );
		cambiarEstadoOrden( $dbh, $ido, "confirmado" );
		actualizarDisponibilidadItemProducto( $dbh, $data_orden["orden"], $data_orden["detalle"] );

		notificarActualizacionPedido( $dbh, "pedido_confirmado", $rorden, $_POST["mconf"] );
	}
	/* ----------------------------------------------------------------------------------- */
?>