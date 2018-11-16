<?php 
	/* Argyros - Funciones catálogo */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */

	/*Filtros: */
	define( "SEPFLT", "_" );
	define( "SEPVALFLT", "-" );
	define( "P_FLT_LINEA", "lin" );
	define( "P_FLT_TRABAJO", "tra" );
	define( "P_FLT_COLOR", "col" );
	define( "P_FLT_BANO", "ba" );
	define( "P_FLT_TALLA", "talla" );
	define( "P_FLT_PIEZA", "precio-pieza" );
	define( "P_FLT_PESO", "precio-peso" );
	define( "P_FLT_PESO_PROD", "peso" );
	define( "P_TEXTO_BUSQUEDA", "busqueda" );

	/**/
	define( "NPAGINACION", 32 );
	define( "NDIAS_NUEVO", 15 );

	/*.............................................................*/
	$catalogue_url = $_SERVER["REQUEST_URI"];
	$urlparsed = parse_url( $catalogue_url );
	if( isset( $urlparsed["query"] ) )
		parse_str( $urlparsed["query"], $url_params );
	/*.............................................................*/
	function oic( $dbh, $uname, $t ){
		//Obtiene el id de las categorías dado su uname
		if( $t == 'c' ) $tabla = "categories";
		if( $t == 's' ) $tabla = "subcategories";

		$data = obtenerIdCategoriaPorUname( $dbh, $uname, $tabla );
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
	function obtenerProductosDestacados( $dbh, $cdestacadas ){
		//Devuelve los productos mostrados en la página de inicio

		$pdetacados[0] = obtenerUltimoProductoCategoria( $dbh, $cdestacadas[0]["id"] ); //Zarcillos
		$pdetacados[1] = obtenerUltimoProductoCategoria( $dbh, $cdestacadas[1]["id"] );	//Gargantillas
		$pdetacados[2] = obtenerUltimoProductoCategoria( $dbh, $cdestacadas[2]["id"] );	//Anillos
		$pdetacados[3] = obtenerUltimoProductoCategoria( $dbh, $cdestacadas[3]["id"] );	//Pulseras

		return $pdetacados;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerCategoriasDestacadas( $dbh ){
		//Devuelve las categorías destacadas
		$cdestacadas[0] = obtenerCategoriasDestacadaPorOrden( $dbh, 1 );
    	$cdestacadas[1] = obtenerCategoriasDestacadaPorOrden( $dbh, 2 );
    	$cdestacadas[2] = obtenerCategoriasDestacadaPorOrden( $dbh, 3 );
    	$cdestacadas[3] = obtenerCategoriasDestacadaPorOrden( $dbh, 4 );

    	return $cdestacadas;
	}
	/* ----------------------------------------------------------------------------------- */
	function matchFiltroAtributo( $dbh, /*$idp, */$valores_atributo, $valores_filtro ){
		//Devuelve verdadero si un producto posee atributos coincidentes a los filtros
		$nulineas = array();
		$match = false;
		
		foreach ( $valores_atributo as $atributo ) {
			if( in_array( $atributo, $valores_filtro ) )
				$match = true;
		}

		return $match;
	}
	/* ----------------------------------------------------------------------------------- */
	function matchFiltroAtributoDetalle( $dbh, $detalle, $atributo, $valores_filtro ){
		//Devuelve verdadero si un detalle de producto posee atributos coincidentes a los filtros
		$match = false;

		foreach ( $detalle as $reg ) {
			if( in_array( $reg[$atributo], $valores_filtro ) )
				$match = true;
		}
		
		return $match;
	}
	/* ----------------------------------------------------------------------------------- */
	function matchFiltroPrecio( $dbh, $reg, $atributo, $valores_filtro ){
		//Devuelve verdadero si un detalle de producto está en el rango de valores del filtro
		$match = false;

		if( ( $reg[$atributo] >= $valores_filtro[0] ) && ( $reg[$atributo] <= $valores_filtro[1] ) )
			$match = true;

		if( $atributo == "precio_pieza" ){
			$match = false;
			foreach ( $reg["sizes"] as $rt ) {
				if( ( $rt["precio"] >= $valores_filtro[0] ) && ( $rt["precio"] <= $valores_filtro[1] ) )
					$match = true;
				break;
			}
		}

		return $match;
	}
	/* ----------------------------------------------------------------------------------- */
	function matchFiltroPeso( $dbh, $detalle, $atributo, $valores_filtros ){
		//Devuelve verdadero si un atributo peso en detalle de producto está en el rango de valores del filtro
		$match = false;
		
		foreach ( $detalle["sizes"] as $reg ) {
			if( ( $reg[$atributo] >= $valores_filtros[0] ) && ( $reg[$atributo] <= $valores_filtros[1] ) )
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

		if( $atributo == P_FLT_TALLA ){
			$data_atributo = obtenerTallasDetalleProducto( $dbh, $id );
			$clave = "talla";
		}
		
		foreach ( $data_atributo as $r ) { 
			$comparadores[] = $r[$clave]; 
		}

		return $comparadores;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerUrlProductoCatalogo( $idp, $iddp ){
		//Devuelve el enlace de los productos del catálogo
		$p_idet = "";
		
		if( $iddp != "" ) $p_idet = "&iddet=$iddp";
		$enlace = "product.php?id=$idp".$p_idet;

		return $enlace;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerComparadorConFiltroPorAtributo( $atributo ){
		//Devuelve la lista de atributos a comparar con los filtros de url
		$comparadores = array( 
			P_FLT_BANO => "ubano",
			P_FLT_COLOR => "ucolor",
			P_FLT_TALLA => "ucolor",
			P_FLT_PIEZA => "precio_pieza",
			P_FLT_PESO => "precio_peso",
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
			$vatributos = obtenerComparadoresConFiltroPorAtributo( $dbh, $p["data"]["id"], $atributo );
			if( matchFiltroAtributo( $dbh, /*$p["id"],*/ $vatributos, $valores ) ){
				$filtrados[] = $p;
			}
		}

		return $filtrados;
	}
	/* ----------------------------------------------------------------------------------- */
	function filtrarProductosPorAtributoDetalleProducto( $dbh, $productos, $parametro, $valores_filtro ){
		//Devuelve la lista de productos que coinciden en atributo detalle de producto con los valores del filtro
		$filtrados = array();

		foreach ( $productos as $p ){
			$detalle = obtenerDetalleProductoPorId( $dbh, $p["data"]["id"] );
			$atributo = obtenerComparadorConFiltroPorAtributo( $parametro );

			if( matchFiltroAtributoDetalle( $dbh, $detalle, $atributo, $valores_filtro ) ){
				$filtrados[] = $p;
			}
		}

		return $filtrados;
	}
	/* ----------------------------------------------------------------------------------- */
	function filtrarProductosPorRegistroAtributoDetalleProducto( $dbh, $productos, $atributo, $valores_filtros ){
		//Devuelve la lista de productos que coinciden en varios valores de un atributo de 
		//detalle de producto con los valores del filtro ( Tallas )
		$filtrados = array();

		foreach ( $productos as $prod ){
			$detalle = $prod["detalle"];
			foreach ( $detalle as $reg ){
				$vatributos = obtenerComparadoresConFiltroPorAtributo( $dbh, $reg["id"], $atributo );
				if( matchFiltroAtributo( $dbh, $vatributos, $valores_filtros ) ){
					$filtrados[] = $prod;
					break;
				}
			}
		}

		return $filtrados;
	}
	/* ----------------------------------------------------------------------------------- */
	function filtrarProductosPorPrecio( $dbh, $productos, $atributo, $valores_filtros ){
		//Devuelve la lista de productos si alguno de sus registros en detalle 
		//está en rango de precio filtrado 
		$filtrados = array();

		foreach ( $productos as $prod ){

			foreach ( $prod["detalle"] as $reg ){
				$cmp = obtenerComparadorConFiltroPorAtributo( $atributo );
				if( matchFiltroPrecio( $dbh, $reg, $cmp, $valores_filtros ) ){
					$filtrados[] = $prod;
					break;
				}
			}
		}

		return $filtrados;
	}
	/* ----------------------------------------------------------------------------------- */
	function filtrarProductosPorPeso( $dbh, $productos, $atributo, $valores_filtros ){
		//Devuelve la lista de productos si alguno de sus registros en detalle está en rango de precio filtrado 
		$filtrados = array();

		foreach ( $productos as $prod ){
			foreach ( $prod["detalle"] as $reg ){
				$cmp = obtenerComparadorConFiltroPorAtributo( $atributo );
				if( matchFiltroPeso( $dbh, $reg, $cmp, $valores_filtros ) ){
					$filtrados[] = $prod;
					break;
				}
			}
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
	function obtenerProductosPorBusqueda( $dbh, $busqueda ){
		//Devuelve una lista de productos que incluyan el texto de búsqueda en algunos de sus parámetros
		$vproductos = array();
		$busqueda_detalle = "";

		//Búsqueda en los atributos: nombre, descripción, código, categoría, subcategoría, material
		$vproductos = array_merge( $vproductos, 
			obtenerProductosParametroDirectoProducto( $dbh, $busqueda ) );

		//Búsqueda en los atributos: baño
		$vproductos = array_merge( $vproductos, 
			obtenerProductosParametroDetalleProducto( $dbh, $busqueda, "bano" ) );

		//Búsqueda en los atributos: color
		$vproductos = array_merge( $vproductos, 
			obtenerProductosParametroDetalleProducto( $dbh, $busqueda, "color" ) );

		//Búsqueda en los atributos: trabajo
		$vproductos = array_merge( $vproductos, 
			obtenerProductosParametroDetalleProducto( $dbh, $busqueda, "trabajo" ) );

		//Búsqueda en los atributos: línea
		$vproductos = array_merge( $vproductos, 
			obtenerProductosParametroDetalleProducto( $dbh, $busqueda, "linea" ) );
		
		//Búsqueda en la unión: idproducto - id_detalle_producto
		$prods_por_ids = obtenerProductosParametroDetalleProducto( $dbh, $busqueda, "codigo" );
		if( count( $prods_por_ids ) > 0 ){
			$vproductos = array_merge( $vproductos, $prods_por_ids );
			$busqueda_detalle = $busqueda;
		}

		$productos_por_busqueda["busqueda_detalle"] = $busqueda_detalle;
		$productos_por_busqueda["productos"] = $vproductos; 

		return $productos_por_busqueda;
	}
	/* ----------------------------------------------------------------------------------- */
	
	if( isset( $_SESSION["login"] ) ) {

	if( isset( $_GET["c"], $_GET["s"] ) ){
		//Búsqueda de productos por categoría y subcategoría
		$cat = $_GET["c"];
		$sub = $_GET["s"];

		$productos_catalogo = obtenerProductosC_S( $dbh, oic( $dbh, $cat, 'c' ), oic( $dbh, $sub, 's' ) );
		$productos = obtenerProductosDataDetalle( $dbh, $productos_catalogo );

		$h_ncat = obtenerCategoriaPorUname( $dbh, $cat );
		$h_nscat = obtenerSubCategoriaPorUname( $dbh, $sub );
	}
	/*..........................................................................*/
	if( isset( $_GET["c"] ) && !isset( $_GET["s"] ) ){
		//Búsqueda de productos solo por categoría
		$cat = $_GET["c"];

		$productos_catalogo = obtenerProductosC_( $dbh, oic( $dbh, $cat, 'c' ) );
		$productos = obtenerProductosDataDetalle( $dbh, $productos_catalogo );
		
		$h_ncat = obtenerCategoriaPorUname( $dbh, $cat );
	}
	/*..........................................................................*/
	function obtenerIdDetalleCodigoBusqueda( $busqueda ){
		//Devuelve el id del detalle de producto dado el par idproducto-iddetalleproducto
		$iddet = "";
		$ids = explode( "-", $busqueda );
		if( isset( $ids[1] ) )
			$iddet = $ids[1];
		
		return $iddet;
	}
	/*..........................................................................*/
	if( isset( $_GET[P_TEXTO_BUSQUEDA] ) ){
		//Búsqueda de productos por texto ingresado por el buscador
		$busqueda = $_GET[P_TEXTO_BUSQUEDA];
		$productos_busqueda = obtenerProductosPorBusqueda( $dbh, $busqueda );
		
		$param_busqueda = $productos_busqueda["busqueda_detalle"];
		if( $param_busqueda )
			$iddetbusqueda = obtenerIdDetalleCodigoBusqueda( $param_busqueda );

		$productos = obtenerProductosDataDetalle( $dbh, $productos_busqueda["productos"] );

		$h_ncat = "Búsqueda: ".$busqueda;
	}
	/*..........................................................................*/
	
	}
	//$purl = "../../argyros/trunk/admin_/"; //Localhost
	$purl = "admin/"; //Server
	/*..........................................................................*/
	/* ----------------------------------------------------------------------------------- */
?>