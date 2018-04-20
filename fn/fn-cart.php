<?php 
	/* Argyros - Funciones carrito de compra */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	function imprimirCarrito(){
		$c = $_SESSION["cart"];
		foreach ( $c as $e ) {
			echo print_r($e)."<br>";
		}
	}
	/* ----------------------------------------------------------------------------------- */
	function vaciarCarrito(){
		//Reinicia el vector de sesión del carrito de compra
		$_SESSION["cart"] = array();
	}
	/* ----------------------------------------------------------------------------------- */
	function eliminarItemCarrito( $pos ){
		//Elimina un item de la sesión de carrito de compra
		unset( $_SESSION["cart"][$pos] );
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerPosicionItem( $id_item ){
		//Devuelve la posición del item de carrito dado su id
		$carrito = $_SESSION["cart"];
		$pos = -1;
		foreach ( $carrito as $key => $item ) {
			if( $item["idicart"] == $id_item ){
				$pos = $key; break;	
			}
		}
		return $pos;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerTotalItem( $item ){
		//Devuelve el monto de un ítem de carrito de compra
		return $item["quantity"] * $item["unit_price"];
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerMontoTotalCarritoCompra(){
		//Devuelve el monto total del carrito de compra

		$carrito = $_SESSION["cart"];
		$total_cart = 0.00;

		foreach ( $carrito as $item )	
			$total_cart += obtenerTotalItem( $item ); 
		return $total_cart;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerCantidadTotalCarritoCompra(){
		//Devuelve total de cantidades del carrito de compra

		$carrito = $_SESSION["cart"];
		$total_cant = 0;

		foreach ( $carrito as $item )	
			$total_cant += $item["quantity"]; 
		return $total_cant;
	}
	/* ----------------------------------------------------------------------------------- */
	function escribirItem( $n, $base_i, $item ){
		//Asigna valores de un item a la plantilla del carrito 
		
		$base_i = str_replace( "{n_i}", $n, $base_i );							//id elemento contenedor
		$base_i = str_replace( "{idi}", $item["idicart"], $base_i );			//id item carrito
		$base_i = str_replace( "{idproducto}", $item["idproducto"], $base_i );
		$base_i = str_replace( "{nombre}", $item["nombre_producto"], $base_i );
		$base_i = str_replace( "{descripcion}", $item["descripcion_producto"], $base_i );
		$base_i = str_replace( "{img}", $item["img_producto"], $base_i );
		$base_i = str_replace( "{cantidad}", $item["quantity"], $base_i );
		$base_i = str_replace( "{talla}", $item["seltalla"], $base_i );
		$base_i = str_replace( "{precio}", $item["unit_price"], $base_i );
		$base_i = str_replace( "{stotal}", $item["subtotal"], $base_i );
		
		return $base_i;
	}
	/* ----------------------------------------------------------------------------------- */
	function mostrarCarrito( $carrito ){
		//Envía el contenido del carrito de compra para imprimirse
		echo json_encode( $carrito );	
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerCarritoCompra(){
		//Obtiene los ítems de la sesión de compra y los organiza en las vistas del contenido del carrito

		$plantilla_item_dsp = file_get_contents( "../fn/cart-item.html" );		//Plantilla display desplegable
		$plantilla_item_pag = file_get_contents( "../fn/cart-item-page.html" );	//Plantilla página carrito

		$carrito = $_SESSION["cart"];
		$cart = ""; $lpag = ""; 
		$ni = 0; $total_cart = 0.00; $total_cant = 0;
		
		foreach ( $carrito as $item ) {
			
			$content_item_dsp = escribirItem( $ni, $plantilla_item_dsp, $item );
			$content_item_pag = escribirItem( $ni, $plantilla_item_pag, $item );
			$cart .= $content_item_dsp;
			$lpag .= $content_item_pag; 
			$total_cart += obtenerTotalItem( $item );
			$total_cant += $item["quantity"];  
			$ni++; 
		}
		$res["cart"] = $cart;
		$res["lpag"] = $lpag;
		$res["total_price"] = number_format( $total_cart, 2, '.', ',' );
		$res["total_cant"] = $total_cant;
		$res["nitems"] = count( $carrito );

		mostrarCarrito( $res );	
	}
	/* ----------------------------------------------------------------------------------- */
	function actualizarItemDuplicadoCarrito( $item, $index ){
		//Actualiza el ítem de carrito: suma cantidad previa con la actual
		$_SESSION["cart"][$index]["quantity"] += $item["quantity"];
	}
	/* ----------------------------------------------------------------------------------- */
	function actualizarCantidadItemCarrito( $index, $cant ){
		//Actualiza el ítem de carrito: sustituye el valor de cantidad
		$precio = $_SESSION["cart"][$index]["unit_price"];
		$_SESSION["cart"][$index]["quantity"] = $cant;
		$_SESSION["cart"][$index]["subtotal"] = $cant * $precio;
	}
	/* ----------------------------------------------------------------------------------- */
	function agregarItemCarrito( $item ){
		//Agregar el item de producto al carrito de compra

		$carrito = $_SESSION["cart"];
		$carrito[] = $item;
		$_SESSION["cart"] = $carrito;
		obtenerCarritoCompra();
	}
	/* ----------------------------------------------------------------------------------- */
	//Async: recepción de ítem de compra para agregar a carrito
	if( isset( $_POST["item_cart"] ) ){
		session_start();

		parse_str( $_POST["item_cart"], $item );
		$index = obtenerPosicionItem( $item["idicart"] );
		$item["subtotal"] = obtenerTotalItem( $item );
		
		if( $index == -1 )	//Elemento ya encontrado en el carrito de compra
			agregarItemCarrito( $item );
		else
			actualizarItemDuplicadoCarrito( $item, $index );

	}
	/* ----------------------------------------------------------------------------------- */
	//Async: solicitud para la eliminación de un ítem de carrito
	if( isset( $_POST["delitem_c"] ) ){
		session_start();

		$nitem = $_POST["delitem_c"];
		$posicion = obtenerPosicionItem( $nitem );
		eliminarItemCarrito( $posicion );
		echo $posicion;
	}
	/* ----------------------------------------------------------------------------------- */
	//Async: solicitud para obtener el contenido del carrito de compra
	if( isset( $_POST["get_cart"] ) ){
		session_start();
		obtenerCarritoCompra();
	}
	/* ----------------------------------------------------------------------------------- */
	//Async: solicitud para modificar cantidad en ítem de carrito de compra
	if( isset( $_POST["mitem_c"] ) ){
		session_start();
		$posicion = obtenerPosicionItem( $_POST["mitem_c"] );
		actualizarCantidadItemCarrito( $posicion, $_POST["q"]);
	}
	/* ----------------------------------------------------------------------------------- */
	//Inicialización del carrito de compras
	if( !isset( $_SESSION["cart"] ) ){
		$_SESSION["cart"] = array();				
	}else{
		//$_SESSION["cart"] = array();
	}
	/* ----------------------------------------------------------------------------------- */
?>