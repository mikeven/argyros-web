<?php 
	/* Argyros - Funciones paginación de catálogo */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */

	function asignarDatosElemento( $item, $nmr, $etq, $img, $urlp, $titulo, $precio, $peso ){
		// Sustituye los datos de un elemento de catálogo por los valores de un registro  
		$catalogo_base = "catalogue/item-catalogue.html";
		$elemento = file_get_contents( $catalogo_base );

		$elemento = str_replace( "{url_p}", 		$urlp, 					$elemento );
		$elemento = str_replace( "{img_p}", 		$img, 					$elemento );
		$elemento = str_replace( "{enumerador}", 	$nmr, 					$elemento );
		$elemento = str_replace( "{etiqueta}", 		$etq, 					$elemento );
		$elemento = str_replace( "{titulo_p}", 		$titulo, 				$elemento );
		$elemento = str_replace( "{p_id}", 			$item["idp"], 			$elemento );
		$elemento = str_replace( "{p_iddet}", 		$item["iddet"], 		$elemento );
		$elemento = str_replace( "{nombre}", 		$item["name"], 			$elemento );
		$elemento = str_replace( "{descripcion}", 	$item["description"], 	$elemento );
		$elemento = str_replace( "{peso_short}", 	$peso["short"], 		$elemento );
		$elemento = str_replace( "{peso_full}", 	$peso["full"], 			$elemento );
		$elemento = str_replace( "{precio}", 		$precio, 				$elemento );
		$elemento = str_replace( "{material}", 		$item["material"], 		$elemento );
		$elemento = str_replace( "{bano}", 			$item["bano"], 			$elemento );
		$elemento = str_replace( "{pais}", 			$item["pais"], 			$elemento );
		$elemento = str_replace( "{color}", 		$item["color"], 		$elemento );
		//$elemento = str_replace( "{tallas_disponibles}", 		$tallas, 	$elemento );

		return $elemento;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerBloqueTallasAsignadas( $datos_p, $iddet, $tallas ){
		// Devuelve el bloque de tallas disponibles en formato lista con pesos y precios
		$bloque_tallas 	= "";
		
		foreach ( $tallas as $t ) {

			if( $t["visible"] == 1 ){

				$fila 			= file_get_contents( "catalogue/lista-tallas-compra.html" );
				
				$fila = str_replace( "{p_id}", 			$datos_p["idp"], 			$fila );
				$fila = str_replace( "{iddet}", 		$iddet, 					$fila );
				$fila = str_replace( "{nombre}", 		$datos_p["nombre"], 		$fila );
				$fila = str_replace( "{descripcion}", 	$datos_p["descripcion"], 	$fila );
				$fila = str_replace( "{img}", 			$datos_p["imagen"], 		$fila );
				$fila = str_replace( "{idtalla}", 		$t["idtalla"], 				$fila );
				$fila = str_replace( "{talla}", 		$t["talla"], 				$fila );
				$fila = str_replace( "{und}", 			$t["unidad"], 				$fila );
				$fila = str_replace( "{peso_talla}", 	$t["peso"]." gr", 			$fila );
				$fila = str_replace( "{precio_talla}", 	$t["precio"],	 			$fila );

				$bloque_tallas .= $fila;
			}
		}

		return $bloque_tallas;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerBotonCargarMas( $fin ){
		// Devuelve el botón con los valores de producto inicial y final de paginación
		$boton = "";

		$e_ini = $fin; $e_fin = $fin + NPAGINACION;
		$boton = "<div class='division_bloque' align='center'>
					<button class='btn btn_vermas' type='button' data-ini='$e_ini' data-fin='$e_fin'>Ver más</button>
				  </div>";

		return $boton;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerElementoCatalogo( $purl, $item, $numerador ){
		// Organiza los datos a mostrarse en los elementos de catálogo
		$p_id 		= $item["idp"];
		$iddet 		= $item["iddet"];
		$etiqueta 	= "";
		
		$img 		= $purl.$item["images"][0]["path"];
		$urlp 		= obtenerUrlProductoCatalogo( $p_id, $iddet );
		$titulo 	= "(#".$p_id.")" . " " . $item["name"];
		
		if( $item["d_antiguedad"] < NDIAS_NUEVO )
			$etiqueta = "<span class='sale_text'> Nuevo </span>";
		
		$precio 	= obtenerPrecioCatalogo( $item );
		$peso		= obtenerPesoCatalogo( $item );
		//$tallas		= obtenerTallasCatalogo( $item ); // Tallas separadas por coma
		//$tallas		= obtenerBloqueTallasAsignadas( $iddet, $item["sizes"] ); // Tallas en formato lista con peso y precios


		$elemento_catalogo	= asignarDatosElemento( $item, $numerador, $etiqueta, $img, $urlp, $titulo, $precio, $peso );
		
		return $elemento_catalogo;

	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerBloqueProductosCatalogo( $purl, $lista_productos, $inicio, $fin ){
		
		$numerador_catalogo = $inicio;
		$pagina_catalogo = "";

		for ( $i = $inicio;  $i < $fin;  $i++ ) { 
			
			if( isset( $lista_productos[ $i ] ) ){
			
				$item				= $lista_productos[ $i ];
				$pagina_catalogo 	.= obtenerElementoCatalogo( $purl, $item, $numerador_catalogo+1 );
				$numerador_catalogo++;
																								
			} else break;
		}

		$boton = obtenerBotonCargarMas( $fin );
		if( isset( $lista_productos[ $fin + 1] ) )
			$pagina_catalogo			.= $boton;

		return $pagina_catalogo;
	}
	/* ----------------------------------------------------------------------------------- */
	ini_set( 'display_errors', 1 );

	//$purl = "../../argyros/trunk/admin_/"; //Localhost
	$purl = "admin/"; //Server

	/* ----------------------------------------------------------------------------------- */
	// :fn-catalogue.js
	if( isset( $_POST["listar_catalogo_url"] ) ){
		session_start();

		include( "../database/bd.php" );
		include( "../database/data-user.php" );
		include( "../database/data-products.php" );
		include( "../database/data-categories.php" );

		include( "fn-data-catalogue.php" );
		include( "fn-data-filters.php" );
		
		$catalogue_url 	= $_POST["listar_catalogo_url"];
		
		$urlparsed = parse_url( $catalogue_url );
		if( isset( $urlparsed["query"] ) )
			parse_str( $urlparsed["query"], $url_params );

		if( isset( $_SESSION["login"] ) ) {
			$productos 				= obtenerProductosListaCatalogo( $dbh, $catalogue_url, $url_params );
			//$catalogo["filtros"] 	= obtenerBloqueFiltrosCatalogo( $dbh, $productos, $catalogue_url, $url_params );
			$pagina 	= obtenerBloqueProductosCatalogo( $purl, $productos, $_POST["pos_i"], $_POST["pos_f"] );
			
			echo $pagina;
		}
	}
	/* ----------------------------------------------------------------------------------- */
	// :fn-catalogue.js
	if( isset( $_POST["tallas_det"] ) ){
		// 
		session_start();

		include( "../database/bd.php" );
		include( "../database/data-user.php" );
		include( "../database/data-products.php" );

		$iddet 		= $_POST["tallas_det"];
		$detalle 	= obtenerDetalleProductoPorIdDetalle( $dbh, $iddet );
		
		$detalle 	= preciosDetalle( $dbh, $detalle );
		$detalle 	= tallasDetalle( $dbh, $detalle );
		
		$bloquet 	= obtenerBloqueTallasAsignadas( $_POST["data_p"], $iddet, $detalle["sizes"] );
		
		echo $bloquet;
	}
	/* ----------------------------------------------------------------------------------- */
?>