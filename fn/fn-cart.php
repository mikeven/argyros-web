<?php 
	/* Argyros - Funciones carrito de compra */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	function actualizarCarrito(){
		$struc = file_get_contents( "../fn/cart-item.html" );
		$carrito = $_SESSION["cart"];
		$cart = "";
		foreach ( $carrito as $item ) {
			$cart .= $struc; 
		}
		echo $cart;	
	}

	function agregarItemCarrito( $item ){
		//Agregar el item
		session_start();

		$carrito = $_SESSION["cart"];
		$carrito[] = $item;
		$_SESSION["cart"] = $carrito;
		actualizarCarrito();
	}

	/* ----------------------------------------------------------------------------------- */
	if( isset( $_POST["item_cart"] ) ){
		
		parse_str( $_POST["item_cart"], $item );
		agregarItemCarrito( $item );
		
	} else {

	}
	
	/* ----------------------------------------------------------------------------------- */
	//Inicialización del carrito de compras
	if( !isset( $_SESSION["cart"] ) ){
		$_SESSION["cart"] = array();				
	}else{
		//$_SESSION["cart"] = array();
		//print_r( $_SESSION["cart"] );
		//actualizarCarrito();
	}
	
		
?>