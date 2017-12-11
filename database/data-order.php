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
		o.order_status as estado, date_format( o.created_at,'%d/%m/%Y') as fecha, u.id as cid, 
		u.first_name nombre, u.last_name as apellido, g.name as grupo_cliente 
		from orders o, users u, user_group g where o.user_id = u.id and u.user_group_id = g.id 
		and o.id = $ido and o.user_id = $idu";

		$data = mysqli_query( $dbh, $q );
		return mysqli_fetch_array( $data );
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerDetalleOrden( $dbh, $ido ){
		//Devuelve los registros correspondientes a un detalle de pedido dado su id
		$q = "select od.id, od.order_id, od.product_id, od.product_detail_id, 
		od.quantity, od.price, p.name as producto, p.description, s.name as talla, s.unit from orders o, 
		order_details od, products p, sizes s, size_product_detail sd, product_details pd 
		where od.order_id = o.id and od.product_id = p.id and od.product_detail_id = pd.id and 
		od.size_id = s.id and sd.product_detail_id = pd.id and sd.size_id = s.id and o.id = $ido";

		$data = mysqli_query( $dbh, $q );
		$lista = obtenerListaRegistros( $data );
		return $lista;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerOrdenPorId( $dbh, $ido ){
		//Devuelve el contenido de una orden, su detalle dado su id
		$idu = $_SESSION["user"]["id"];
		$orden["orden"] = obtenerRegistroOrdenPorId( $dbh, $ido, $idu );
		$orden["detalle"] = obtenerDetalleOrden( $dbh, $ido );
		
		return $orden;
	}
	/* ----------------------------------------------------------------------------------- */
	function guardarRegistroDetalleOrden( $dbh, $orden, $reg ){
		//Guarda un registro de detalle de orden
		$q = "insert into order_details ( order_id, product_id, product_detail_id, 
		size_id, quantity, price, created_at ) values ( $orden[id], $reg[idproducto], $reg[iddetalle], 
		$reg[idseltalla], $reg[quantity], $reg[unit_price], NOW() )";
		
		//echo $q;
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
		$q = "insert into orders ( user_id, total_price, total_count, created_at, order_status ) 
		values ( $orden[id_user], $orden[total_pedido], $orden[total_items], NOW(), 'pendiente' )";
		
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
		date_format( created_at,'%d-%m-%Y') as fecha from orders where user_id = $idu";
		//echo $q;
		$data = mysqli_query( $dbh, $q );
		$lista = obtenerListaRegistros( $data );
		return $lista;
	}
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	/* Solicitudes asíncronas al servidor para procesar información de órdenes */
	/* ----------------------------------------------------------------------------------- */
	//Petición para crear un nuevo registro de orden ( pedido )
	if( isset( $_POST["neworder"] ) ){
		session_start();
		$carrito = $_SESSION["cart"];
		include( "../database/bd.php" );
		include( "../fn/fn-cart.php" );
		if ( count( $carrito ) > 0 ) {
			$orden = obtenerDatosCreacionOrden( $carrito );
			$orden["id"] = registrarOrden( $dbh, $orden );
			$n = registrarDetalleOrden( $dbh, $orden, $carrito );
			if( $n > 0 ){
				vaciarCarrito();
				echo mensajeRespuestaOrden();
			}
		}
	}
	/* ----------------------------------------------------------------------------------- */
	
	/* ----------------------------------------------------------------------------------- */
?>