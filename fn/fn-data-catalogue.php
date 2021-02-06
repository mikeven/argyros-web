<?php 
	/* Argyros - Funciones catálogo */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */

	/*Filtros: */
	define( "SEPFLT", "_" );
	define( "SEPVALFLT", "-" );
	define( "P_SCROLL_PROD", "refp" );
	define( "P_FLT_CATEGORIA", "cat" );
	define( "P_FLT_LINEA", "lin" );
	define( "P_FLT_TRABAJO", "tra" );
	define( "P_FLT_COLOR", "col" );
	define( "P_FLT_BANO", "ba" );
	define( "P_FLT_TALLA", "talla" );
	define( "P_FLT_PIEZA", "precio-pieza" );
	define( "P_FLT_PESO", "precio-peso" );
	define( "P_FLT_PESO_PROD", "peso" );
	define( "P_TEXTO_BUSQUEDA", "busqueda" );

	define( "NPAGINACION", 32 );
	define( "NDIAS_NUEVO", 15 );
	$busqueda_por_codigo = false;

	/*.............................................................*/
	function oic( $dbh, $t, $uname_c, $uname_s ){
		//Obtiene el id de las categorías / subcategorías dado su uname
		if( $t == 'c' ) {
			$data = obtenerIdCategoriaPorUname( $dbh, $uname_c );
		}
		if( $t == 's' ) {
			$idc = obtenerIdCategoriaPorUname( $dbh, $uname_c );
			$data = obtenerIdSubCategoriaPorUname( $dbh, $uname_s, $idc["id"] );
		}
		
		return $data["id"];
	}
	/* ----------------------------------------------------------------------------------- */
	function reempEspacio( $texto ){
		$reemplazo = str_replace( " ", "&nbsp;", $texto );
		return $reemplazo;
	}
	/* ----------------------------------------------------------------------------------- */
	function productoTieneImagen( $img ){
		//Devuelve verdadero si un producto posee imagen en su detalle
		$tiene_imagen = false;
		if( isset( $img[0] ) ) $tiene_imagen = true;

		return $tiene_imagen;
	}
	/* ----------------------------------------------------------------------------------- */
	/*function obtenerProductosDestacados( $dbh, $cdestacadas ){
		//Devuelve los productos mostrados en la página de inicio

		$pdestacados[0] = obtenerUltimoProductoCategoria( $dbh, $cdestacadas[0]["id"] ); //Zarcillos
		$pdestacados[1] = obtenerUltimoProductoCategoria( $dbh, $cdestacadas[1]["id"] );	//Gargantillas
		$pdestacados[2] = obtenerUltimoProductoCategoria( $dbh, $cdestacadas[2]["id"] );	//Anillos
		$pdestacados[3] = obtenerUltimoProductoCategoria( $dbh, $cdestacadas[3]["id"] );	//Pulseras

		return $pdestacados;
	}*/
	/* ----------------------------------------------------------------------------------- */
	/*function obtenerCategoriasDestacadas( $dbh ){
		//Devuelve las categorías destacadas
		$cdestacadas[0] = obtenerCategoriasDestacadaPorOrden( $dbh, 1 );
    	$cdestacadas[1] = obtenerCategoriasDestacadaPorOrden( $dbh, 2 );
    	$cdestacadas[2] = obtenerCategoriasDestacadaPorOrden( $dbh, 3 );
    	$cdestacadas[3] = obtenerCategoriasDestacadaPorOrden( $dbh, 4 );

    	return $cdestacadas;
	}*/
	/* ----------------------------------------------------------------------------------- */
	function matchFiltroAtributo( $dbh, $valores_atributo, $valores_filtro ){
		//Devuelve verdadero si un producto posee atributos coincidentes a los filtros
		$match = false;
		
		foreach ( $valores_atributo as $atributo ) {
			if( in_array( $atributo, $valores_filtro ) )
				$match = true;
		}

		return $match;
	}
	/* ----------------------------------------------------------------------------------- */
	function matchFiltroAtributoDetalle( $dbh, $producto, $atributo, $valores_filtro ){
		//Devuelve verdadero si un detalle de producto posee atributos coincidentes a los filtros
		
		return in_array( $producto[$atributo], $valores_filtro );
	}
	/* ----------------------------------------------------------------------------------- */
	function matchFiltroPrecio( $dbh, $reg, $atr, $vals_filtro, $ft ){
		//Devuelve verdadero si un detalle de producto está en el rango de valores del filtro
		$match = false;
		
		if( ( $atr == "precio_peso" ) && $reg["tipo_precio"] != "p" ){
			
			$atr = "precio";			// atributo precio contiene el precio por g, sea tipo precio por peso o (mo)
			
			if( ( $reg[$atr] >= $vals_filtro[0] ) && ( $reg[$atr] <= $vals_filtro[1] ) )
				$match = true;  		// Match por tipo de precio: gramo | mo	
		}
		
		/* ....................................................................... */	
		
		if( $atr == "precio_pieza" ){
			$match = false;
			foreach ( $reg["sizes"] as $rt ) {
				if( ( $rt["precio"] >= $vals_filtro[0] ) && ( $rt["precio"] <= $vals_filtro[1] ) ){
					$match = true;			//Match por tipo de precio: pieza
					break;
				}
			}
		}

		return $match;
	}
	/* ----------------------------------------------------------------------------------- */
	function condTalla( $ft, $talla ){
		//
		$cond = false;
		if( count( $ft ) == 0 ) $cond = true;
		if( count( $ft ) > 0 && in_array( $talla, $ft ) ) $cond = true;
		
		return $cond;
	} 
	/* ----------------------------------------------------------------------------------- */
	function matchFiltroPeso( $dbh, $detalle, $atr, $val_filtros, $ft ){
		//Devuelve verdadero si un atributo peso en detalle de producto está en el rango de valores del filtro
		$match = false;
		
		foreach ( $detalle["sizes"] as $reg ) {
			if( ( $reg[$atr] >= $val_filtros[0] ) && ( $reg[$atr] <= $val_filtros[1] ) 
				&& condTalla( $ft, $reg["talla"] ) )	
				$match = true;
		}
		return $match;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerComparadoresConFiltroPorAtributo( $dbh, $id, $atributo ){
		//Devuelve la lista de valores de atributos a comparar con los filtros de url
		$comparadores = array();

		if( $atributo == P_FLT_LINEA ){
			$data_atributo = obtenerLineasDeProductoPorId( $dbh, $id );
			$clave = "ulinea";
		}

		if( $atributo == P_FLT_TRABAJO ){
			$data_atributo = obtenerTrabajosDeProductoPorId( $dbh, $id );
			$clave = "utrabajo";
		}

		/*if( $atributo == P_FLT_TALLA ){
			$data_atributo = obtenerTallasDetalleProducto( $dbh, $id );
			$clave = "talla";
		}*/
		
		foreach ( $data_atributo as $r ) { 
			$comparadores[] = $r[$clave]; 
		}

		return $comparadores;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerUrlProductoCatalogo( $idp, $iddp ){
		// Devuelve el enlace de los productos del catálogo
		$p_idet = "";
		
		if( $iddp != "" ) $p_idet = "&iddet=$iddp";
		$enlace = "product.php?id=$idp".$p_idet;

		return $enlace;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerTodosPesosCatalogo( $producto ){
		// Devuelve las tallas disponibles para mostrar en la lista de catálogo
		$pesos = "";
		$data_datllas = $producto["sizes"];

		foreach ( $data_datllas as $t ) {
			if( $t["visible"] == 1 )
				$pesos .= $t["peso"]." g, ";	
		}

		return substr( $pesos, 0, -2 );
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerPrecioCatalogo( $producto ){
		// Devuelve el precio de un producto de catálogo según el tipo de precio

		if( $producto["tipo_precio"] == "g" ) 	$precio = $producto["precio_peso"]." $/g";
		if( $producto["tipo_precio"] == "mo" ) 	$precio = $producto["precio_mo"]." $/g";
		if( $producto["tipo_precio"] == "p" ) 	$precio = $producto["precio_pieza"]." $/p";
		
		return $precio;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerPesoCatalogo( $producto ){
		// Devuelve el peso de un producto de catálogo (peso de la primera talla disponible)
		$categs_todos_pesos = array( 7, 8, 9 );
		$tallas = $producto["sizes"];

		// Si el tipo de precio no es por pieza, se toma el primer valor de peso de talla visible
		if( $producto["tipo_precio"] != "p" ){
			
			foreach ( $tallas as $t ) {
				if( $t["visible"] == 1 ){
					$primer_peso 	= $t["peso"]." g";
					$todos_pesos 	= $t["peso"]." g";
					break;
				}
			}

			if( in_array( $producto["idc"], $categs_todos_pesos ) ){
				$todos_pesos = obtenerTodosPesosCatalogo( $producto );
			}

		}else{ $primer_peso = ""; $todos_pesos = ""; }	// No se muestra peso en si tipo de precio es por pieza
		
		$wpeso["short"] = $primer_peso;
		$wpeso["full"] 	= $todos_pesos;

		return $wpeso;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerTallasCatalogo( $producto ){
		// Devuelve las tallas disponibles para mostrar en la lista de catálogo
		$tallas = "";
		$data_datllas = $producto["sizes"];

		foreach ( $data_datllas as $t ) {
			if( $t["visible"] == 1 )
				$tallas .= $t["talla"]." ".$t["unidad"].", ";	
		}

		return substr( $tallas, 0, -2 );
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerComparadorConFiltroPorAtributo( $atributo ){
		//Devuelve la lista de atributos (bd) a comparar con los filtros de url
		$comparadores = array( 
			P_FLT_BANO 		=> "ubano",
			P_FLT_COLOR 	=> "ucolor",
			P_FLT_TALLA 	=> "talla",
			P_FLT_PIEZA 	=> "precio_pieza",
			P_FLT_PESO 		=> "precio_peso",
			"precio_mo" 	=> "precio_mo",
			P_FLT_PESO_PROD => "peso" 
		);

		return $comparadores[$atributo];
	}
	/* ----------------------------------------------------------------------------------- */
	function filtrarProductosPorAtributoProducto( $dbh, $productos, $atributo, $valores ){
		//Devuelve la lista de productos que coinciden en atributo de producto con los valores del filtro
		$filtrados = array();	
		foreach ( $productos as $p ){
			//$p = $producto["data"];
			$vatributos = obtenerComparadoresConFiltroPorAtributo( $dbh, $p["idp"], $atributo );
			if( matchFiltroAtributo( $dbh, $vatributos, $valores ) ){
				$filtrados[] = $p;
			}
		}

		return $filtrados;
	}
	/* ----------------------------------------------------------------------------------- */
	function filtrarProductosPorAtributoDetalleProducto( $dbh, $productos, $param, $vals_filtro ){
		//Devuelve la lista de productos que coinciden en atributo detalle de producto con los valores del filtro
		$filtrados = array();

		foreach ( $productos as $p ){
			$atributo = obtenerComparadorConFiltroPorAtributo( $param );
			if( matchFiltroAtributoDetalle( $dbh, $p, $atributo, $vals_filtro ) )
				$filtrados[] = $p;
		}

		return $filtrados;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerComparadoresTallaProducto( $tallas ){
		// Devuelve los valores a comparar de las tallas con los valores de tallas en los filtros
		$comparadores = array();
		foreach ( $tallas as $t ) {
			if( $t["visible"] == 1 )
				$comparadores[] = $t["talla"];
		}

		return $comparadores;
	}
	/* ----------------------------------------------------------------------------------- */
	function filtrarProductosPorTallasProducto( $dbh, $productos, $vals_filtros ){
		//Devuelve la lista de productos que coinciden en varios valores de un atributo de 
		//detalle de producto con los valores del filtro ( Tallas )
		$filtrados = array();
		
		foreach ( $productos as $prod ){
			$tallas = $prod["sizes"];
			$vatributos = obtenerComparadoresTallaProducto( $tallas );
			if( matchFiltroAtributo( $dbh, $vatributos, $vals_filtros ) )
				$filtrados[] = $prod;
		}

		return $filtrados;
	}
	/* ----------------------------------------------------------------------------------- */
	function filtrarProductosPorPrecio( $dbh, $productos, $atr, $vals_filtros, $ft ){
		//Devuelve la lista de productos si alguno de sus registros en detalle 
		//está en rango de precio filtrado (precio por peso: precio x gr | precio x mo) 
		$filtrados 	= array();
		
		foreach ( $productos as $prod ){
			$cmp 	= obtenerComparadorConFiltroPorAtributo( $atr );
			if( matchFiltroPrecio( $dbh, $prod, $cmp, $vals_filtros, $ft ) )
				$filtrados[] = $prod;
		}

		return $filtrados;
	}
	/* ----------------------------------------------------------------------------------- */
	function filtrarProductosPorPeso( $dbh, $productos, $atr, $val_filtros, $ft ){
		//Devuelve la lista de productos si alguno de sus registros en detalle está en rango de peso filtrado 
		$filtrados = array();

		foreach ( $productos as $prod ){
			$cmp = obtenerComparadorConFiltroPorAtributo( $atr );
			if( matchFiltroPeso( $dbh, $prod, $cmp, $val_filtros, $ft ) )
				$filtrados[] = $prod;
		}

		return $filtrados;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerProductosDataDetalle( $dbh, $productos ){
		//Devuelve una lista de productos incluyendo sus detalles internos
		$vproductos = array();
		foreach ( $productos as $p ){
			$registro = obtenerProductoPorId( $dbh, $p["id"] );
			$vproductos[] = $registro;
		}

		return $vproductos;
	}
	/* ----------------------------------------------------------------------------------- */
	function fnProductosDataDetalle( $dbh, $productos ){
		//Devuelve una lista de productos incluyendo sus atributos internos
		$vproductos = array();
		foreach ( $productos as $p ){
			$vproductos[] = obtenerItemCatalogo( $dbh, $p );
		}

		return $vproductos;
	}
	/* ----------------------------------------------------------------------------------- */
	function fnProductosBusqueda( $dbh, $registros, $param, $filtro_desuso ){
		// 
		$data_productos = array();

		foreach ( $registros as $p ) {
			if( $param == "prod" )
				$data_productos 	= array_merge( $data_productos, 
													productosIdsProducto( $dbh, $p["id"], NULL, $filtro_desuso ) );
				
			if( $param == "prod_det" )
				$data_productos 	= array_merge( $data_productos, 
													productosIdsProducto( $dbh, $p["id"], $p["iddet"], $filtro_desuso ) );
		}

		return $data_productos;
	}
	/* ----------------------------------------------------------------------------------- */
	function filtrarProductosRepetidos( $vproductos ){
		// Devuelve la lista de productos sin registros repetidos
		$prods_filtrados 	= array();
		$iddets				= array();

		foreach ( $vproductos as $p ) {
			if( !in_array( $p["iddet"], $iddets ) ){
				$iddets[] 			= $p["iddet"];
				$prods_filtrados[] 	= $p;
			}
		}

		return $prods_filtrados;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerProductosPorBusqueda( $dbh, $busqueda ){
		//Devuelve una lista de productos que incluyan el texto de búsqueda en algunos de sus parámetros
		$vproductos 		= array();
		$busqueda_detalle 	= "";
		$busqueda_por_ids   = false;

		//Búsqueda en los atributos: nombre, descripción, código, categoría, subcategoría, material
		$ids_productos 		= obtenerIdsProductosParametroDirectoProducto( $dbh, $busqueda );
		$vproductos 		= array_merge( $vproductos, fnProductosBusqueda( $dbh, $ids_productos, "prod", true ) );
		
		//Búsqueda en los atributos: baño
		$ids_productos 		= obtenerProductosParametroDetalleProducto( $dbh, $busqueda, "bano" );
		$vproductos 		= array_merge( $vproductos, fnProductosBusqueda( $dbh, $ids_productos, "prod_det", true ) );
		
		//Búsqueda en los atributos: color
		$ids_productos 		= obtenerProductosParametroDetalleProducto( $dbh, $busqueda, "color" );
		$vproductos 		= array_merge( $vproductos, fnProductosBusqueda( $dbh, $ids_productos, "prod_det", true ) );
		
		//Búsqueda en los atributos: trabajo
		$ids_productos 		= obtenerProductosParametroDetalleProducto( $dbh, $busqueda, "trabajo" );
		$vproductos 		= array_merge( $vproductos, fnProductosBusqueda( $dbh, $ids_productos, "prod_det", true ) );
		
		//Búsqueda en los atributos: línea
		$ids_productos 		= obtenerProductosParametroDetalleProducto( $dbh, $busqueda, "linea" );
		$vproductos 		= array_merge( $vproductos, fnProductosBusqueda( $dbh, $ids_productos, "prod_det", true ) );
		
		//Búsqueda en la unión: idproducto - id_detalle_producto
		$prods_por_ids 		= obtenerProductosParametroDetalleProducto( $dbh, $busqueda, "codigo" );

		//Búsqueda en la unión: #i + idproducto
		$prods_por_id_p 	= obtenerProductosParametroDetalleProducto( $dbh, $busqueda, "id_producto" );

		//Búsqueda en la unión: #d + iddetalle
		$prods_por_id_d 	= obtenerProductosParametroDetalleProducto( $dbh, $busqueda, "id_detalle" );

		/*---------------------------------------------------------------------------------------------------*/

		if( count( $prods_por_ids ) > 0 ){
			$vproductos 							= fnProductosBusqueda( $dbh, $prods_por_ids, "prod_det", false );
			$busqueda_por_ids						= true;
		}
			
		if( count( $prods_por_id_p ) > 0 ){
			$vproductos 							= fnProductosBusqueda( $dbh, $prods_por_id_p, "prod_det", false );
			$busqueda_por_ids						= true;
		}

		if( count( $prods_por_id_d ) > 0 ){
			$vproductos 							= fnProductosBusqueda( $dbh, $prods_por_id_d, "prod_det", false );
			$busqueda_por_ids						= true;
		}

		/*---------------------------------------------------------------------------------------------------*/
		
		$vproductos									= filtrarProductosRepetidos( $vproductos );
		$data_busqueda["productos"] 				= fnProductosDataDetalle( $dbh, $vproductos );
		$data_busqueda["busq_x_id"] 				= $busqueda_por_ids;

		return $data_busqueda;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerProductosListaCatalogo( $dbh, $catalogue_url, $url_params ) {

		$ver_ocultos = false;

		if( isset( $url_params["c"], $url_params["s"] ) ){
			//Búsqueda de productos por categoría y subcategoría
			
			$cat = $url_params["c"]; $sub = $url_params["s"];
																	//$dbh, $t, $uname_c, $uname_s
			$productos_catalogo 	= productosCategoriaSubcategoria( $dbh, oic( $dbh, 'c', $cat, "" ), 
																			oic( $dbh, 's', $cat, $sub ) );
			
			$productos 				= fnProductosDataDetalle( $dbh, $productos_catalogo );
			
			$h_ncat 				= obtenerCategoriaPorUname( $dbh, $cat );
			$h_nscat 				= obtenerSubCategoriaPorUname( $dbh, $sub );
		}
		/*..........................................................................*/
		if( isset( $url_params["c"] ) && !isset( $url_params["s"] ) ){
			//Búsqueda de productos sólo por categoría
			
			$cat = $url_params["c"];
			
			$productos_catalogo 	= productosCategoria( $dbh, oic( $dbh, 'c', $cat, "" ) );
			$productos 				= fnProductosDataDetalle( $dbh, $productos_catalogo );
			
			$h_ncat 				= obtenerCategoriaPorUname( $dbh, $cat );
		}
		/*..........................................................................*/
		if( isset( $url_params[P_TEXTO_BUSQUEDA] ) ){
			//Búsqueda de productos por texto ingresado por el buscador
			$busqueda 				= mysqli_real_escape_string( $dbh, $url_params[P_TEXTO_BUSQUEDA] );
			$data_busqueda 			= obtenerProductosPorBusqueda( $dbh, $busqueda );
			
			$ver_ocultos			= $data_busqueda["busq_x_id"];
			$productos 				= $data_busqueda["productos"];

			$h_ncat 				= "Búsqueda: ".$busqueda;
		}
		/*..........................................................................*/
		
		$productos = obtenerProductosFiltrados( $dbh, $productos, $catalogue_url, $url_params, $ver_ocultos );

		return $productos;
	} 

	/* ----------------------------------------------------------------------------------- */
?>