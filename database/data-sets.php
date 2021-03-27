<?php
	/* ----------------------------------------------------------------------------------- */
	/* Argyros - Funciones de juegos de productos */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	function obtenerJuegosProductos( $dbh ){
		//Devuelve los registros de juegos de producto
		$q = "select id, date_format( created_at,'%d/%m/%Y') as fecha from sets";
		
		$data = mysqli_query( $dbh, $q );
		$lista_j = obtenerListaRegistros( $data );
		return $lista_j;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerDetallesProductoPorJuego( $dbh, $idj ){
		//Devuelve la lista de ids de detalles de productos asociados a un juego
		$q = "select dp.product_id as idp, p.name as nombre, 
		timestampdiff(day, p.created_at, curdate()) as d_antiguedad, spd.product_detail_id as idd 
		from set_product_details spd, product_details dp, products p 
		where dp.id = product_detail_id and dp.product_id = p.id and spd.set_id = $idj";

		$data = mysqli_query( $dbh, $q );
		$lista_j = obtenerListaRegistros( $data );
		return $lista_j;
	}	
	/* ----------------------------------------------------------------------------------- */
	function obtenerListaJuegosProductos( $dbh ){
		//Devuelve una lista de detalles de productos agrupados por juego
		$lista = array();
		$juegos = obtenerJuegosProductos( $dbh );
		foreach ( $juegos as $j ) {
			$j["detalles"] = obtenerDetallesProductoPorJuego( $dbh, $j["id"] );
			$lista[] = $j;
		}

		return $lista;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerJuegosProducto( $dbh, $idd ){
		//Devuelve el registro de juego al que pertenece un producto
		$q = "select set_id from set_product_details where product_detail_id = $idd";

		$data = mysqli_query( $dbh, $q );
		$lista_j = obtenerListaRegistros( $data );
		return $lista_j;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerProductosJuegosProducto( $dbh, $idd ){
		//Obtiene todos los productos que comparten el mismo juego que un producto dado su id
		$detalles_p = array();
		$juegos 	= obtenerJuegosProducto( $dbh, $idd );
		$ids_flt 	= array();
		
		foreach ( $juegos as $j ) {
			$lista = obtenerDetallesProductoPorJuego( $dbh, $j["set_id"] );
			foreach ( $lista as $r ) {
				if( !in_array( $r["idp"], $ids_flt ) ){
					$ids_flt[] 		= $r["idp"];
					$detalles_p[] 	= $r;
				}
			}
		}

		return $detalles_p;
	}
	/* ----------------------------------------------------------------------------------- */
	function productosJuegoD( $dbh, $idd ){
		//Obtiene los productos pertenecientes al juego al que pertenece el producto actual
		$relacionados_j = array();
		include( "../database/data-products.php" );

		$detalles = obtenerProductosJuegosProducto( $dbh, $idd );

		
		foreach ( $detalles as $reg_d ) {
			//Recorrido por cada registro de detalle de producto
			$imagenes = obtenerImagenesDetalleProducto( $dbh, $reg_d["idd"], "" );
			if( count( $imagenes ) > 0 ){
				//Posee al menos una imagen, producto válido
				$relacionados_j[] = $reg_d;
			}
		}
		
		return $relacionados_j;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerSeccionProductosJuegos( $dbh, $pid, $productos_j, $ndiasn, $purl ){
		//Devuelve el bloque de productos relacionados por juego de forma dinámica
		$seccion_pj = "";
		$item = file_get_contents( "../sections/product/block-prod-set.html" );
		$bloque_p = "";
		foreach ( $productos_j as $p ) {
			$seccion_pj = file_get_contents( "../sections/product/set-products-sec.html" );
			if( $p["idp"] != $pid ){
				if( $p["d_antiguedad"] < $ndiasn ) $h = ""; else $h = "hidden";
				$lnkp = "product.php?id=".$p["idp"]."&iddet=".$p["idd"];
				$img = obtenerImagenProductoDetalle( $dbh, $p["idd"] );
			
				$item = str_replace( "{url_producto}", $lnkp, $item );
				$item = str_replace( "{imagen}", $purl.$img[0]["image"], $item );
				$item = str_replace( "{nombre}", $p["nombre"], $item );
				$item = str_replace( "{oculto}", $h, $item );

				$bloque_p .= $item;
				$item = file_get_contents( "../sections/product/block-prod-set.html" );
			}
			
		}

		return str_replace( "{lista_productos}", $bloque_p, $seccion_pj );
	}
	/* ----------------------------------------------------------------------------------- */
	if( isset( $_POST["pj_idp"] ) ){
		ini_set( 'display_errors', 1 );
		include( "../database/bd.php" );
		$ndiasn = $_POST["ndiasnuevo"];
		$url_s = $_POST["url_s"];
		$pid = $_POST["pj_idp"];

		$prel_juegos = productosJuegoD( $dbh, $_POST["iddp"] );
		echo obtenerSeccionProductosJuegos( $dbh, $pid, $prel_juegos, $ndiasn, $url_s );
	}
?>