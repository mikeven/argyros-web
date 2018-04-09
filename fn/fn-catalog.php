<?php 
	/* Argyros - Funciones catálogo */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */

	define( "SEPFLT", "_" );
	define( "SEPVALFLT", "--" );
	define( "P_FLT_LINEA", "lin" );
	define( "P_FLT_TRABAJO", "tra" );
	define( "P_FLT_COLOR", "col" );
	define( "P_FLT_BANO", "ba" );
	define( "P_FLT_TALLA", "talla" );
	define( "P_FLT_PIEZA", "precio-pieza" );
	define( "P_FLT_PESO", "precio-peso" );

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
	function matchFiltroAtributo( $dbh, /*$idp, */$valores_atributo, $valores_filtro ){
		//Devuelve verdadero si un producto posee atributos coincidentes a los filtros
		$nulineas = array();
		$match = false;
		$nmatches = count( $valores_filtro );
		$cmatches = 0;

		/*
			foreach ( $valores_atributo as $atributo ) {
				foreach ( $valores as $filtro ) {
					if( $atributo == $filtro )
						$cmatches++;
				}
			}

			if( $cmatches == $nmatches ) 
				$match = true;
		*/
		
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

	function obtenerComparadorConFiltroPorAtributo( $atributo ){
		//Devuelve la lista de atributos a comparar con los filtros de url
		$comparadores = array( 
			P_FLT_BANO => "ubano",
			P_FLT_COLOR => "ucolor",
			P_FLT_TALLA => "ucolor" 
		);

		return $comparadores[$atributo];
	}
	/* ----------------------------------------------------------------------------------- */
	function filtrarProductosPorAtributoProducto( $dbh, $productos, $atributo, $valores ){
		//Devuelve la lista de productos que coinciden en atributo de producto con los valores del filtro
		$filtrados = array();	
		
		foreach ( $productos as $p ){
			$vatributos = obtenerComparadoresConFiltroPorAtributo( $dbh, $p["id"], $atributo );
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
			$detalle = obtenerDetalleProductoPorId( $dbh, $p["id"] );
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

		foreach ( $productos as $p ){
			$detalle = obtenerDetalleProductoPorId( $dbh, $p["id"] );
			foreach ( $detalle as $reg ){
				$vatributos = obtenerComparadoresConFiltroPorAtributo( $dbh, $reg["id"], $atributo );
				if( matchFiltroAtributo( $dbh, $vatributos, $valores_filtros ) ){
					$filtrados[] = $p;
					break;
				}
			}
		}
		return $filtrados;
	}

	/* ----------------------------------------------------------------------------------- */
	
	if( isset( $_GET["c"], $_GET["s"] ) ){
		$cat = $_GET["c"];
		$sub = $_GET["s"];

		$productos = obtenerProductosC_S( $dbh, oic( $dbh, $cat, 'c' ), oic( $dbh, $sub, 's' ) );
		$h_ncat = obtenerCategoriaPorUname( $dbh, $cat );
		$h_nscat = obtenerSubCategoriaPorUname( $dbh, $sub );
	}

	if( isset( $_GET["c"] ) && !isset( $_GET["s"] ) ){
		$cat = $_GET["c"];

		$productos = obtenerProductosC_( $dbh, oic( $dbh, $cat, 'c' ) );
		$h_ncat = obtenerCategoriaPorUname( $dbh, $cat );
	}

	$purl = "../../argyros/trunk/admin_/"; //Localhost
	//$purl = "admin/"; //Server

	/* ----------------------------------------------------------------------------------- */
?>