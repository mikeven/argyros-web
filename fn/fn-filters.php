<?php 
	/* Argyros - Funciones filtros */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	
	function yaAgregadoVectores( $elem, $vector, $clave ){
		//Retorna verdadero o falso si un registro está contenido en un vector de registros comparando con una clave del registro

		$contenido = false;
		foreach ( $vector as $reg ) {
			if( $reg[$clave] == $elem[$clave] )
				$contenido = true;	
		}
		return $contenido;
	}
	
	/* ----------------------------------------------------------------------------------- */
	
	function obtenerTrabajosProductos( $dbh, $productos ){
		//Devuelve los trabajos incluídos en los productos
		$filtros_trab_productos = array();
		
		foreach ( $productos as $p ) {
			$trabajos_p = obtenerTrabajosDeProductoPorId( $dbh, $p["id"] );
			foreach ( $trabajos_p as $trabajo ) {
				if( yaAgregadoVectores( $trabajo, $filtros_trab_productos, "idtrabajo" ) == false )
					$filtros_trab_productos[] = $trabajo;
			}
		}
		return $filtros_trab_productos;
	}

	/* ----------------------------------------------------------------------------------- */

	function obtenerLineasProductos( $dbh, $productos ){
		//Devuelve las líneas incluídas en los productos
		$filtros_linea_productos = array();
		
		foreach ( $productos as $p ) {
			$lineas_p = obtenerLineasDeProductoPorId( $dbh, $p["id"] );
			foreach ( $lineas_p as $linea ) {
				if( yaAgregadoVectores( $linea, $filtros_linea_productos, "idlinea" ) == false )
					$filtros_linea_productos[] = $linea;
			}
		}
		return $filtros_linea_productos;
	}
	
	/* ----------------------------------------------------------------------------------- */
	
	function obtenerBanosProductos( $dbh, $productos ){
		//Devuelve los baños incluídos en los productos
		$filtros_bano_productos = array();
		
		foreach ( $productos as $producto ) {
			$detalle = obtenerDetalleProductoPorId( $dbh, $producto["id"] );
			foreach ( $detalle as $reg ) {
				if( yaAgregadoVectores( $reg, $filtros_bano_productos, "id_bano" ) == false ){
					$bano["id_bano"] = $reg["id_bano"];
					$bano["bano"] = $reg["bano"];
					$filtros_bano_productos[] = $bano;
				}
			}
		}

		return $filtros_bano_productos;
	}

	/* ----------------------------------------------------------------------------------- */

	function obtenerColoresProductos( $dbh, $productos ){
		//Devuelve los baños incluídos en los productos
		$filtros_color_productos = array();
		
		foreach ( $productos as $producto ){
			$detalle = obtenerDetalleProductoPorId( $dbh, $producto["id"] );
			foreach ( $detalle as $reg ){
				if( yaAgregadoVectores( $reg, $filtros_color_productos, "id_color" ) == false ){
					$color["id_color"] = $reg["id_color"];
					$color["color"] = $reg["color"];
					$filtros_color_productos[] = $color;
				}
			}
		}

		return $filtros_color_productos;
	}
	
	/* ----------------------------------------------------------------------------------- */
	
	function debug_to_console($data) {
	    if(is_array($data) || is_object($data))
		{
			echo("<script>console.log('PHP: ".json_encode($data)."');</script>");
		} else {
			echo("<script>console.log('PHP: ".$data."');</script>");
		}
	}

	/* ----------------------------------------------------------------------------------- */
	function paramEnUrl( $p, $url_params ){
		//Devuelve si un parámetro está contenido en la URL

		return in_array( $p, array_keys( $url_params ) );
	}
	
	/* ----------------------------------------------------------------------------------- */

	function valorEnParamUrl( $valor, $string_valores ){
		//Devuelve si un valor de un parámetro está contenido en la cadena del valor del parámetro
		
		return strpos( $string_valores, $valor );
	}

	/* ----------------------------------------------------------------------------------- */

	function agregarParametroConValorURL( $url_params, $parametro, $valor ){
		//Devuelve un parámetro con un valor nuevo agregado
		$vparam = "&".$parametro."=".SEPFLT.$valor;

		return $vparam;
	}

	function agregarValorParametroURL( $url_params, $parametro, $valor ){
		//Devuelve un parámetro con un valor nuevo agregado
		$vparam = $url_params[$parametro].SEPFLT.$valor;

		return $vparam;
	}

	function eliminarValorParametroURL( $url_base, $valor ){
		//Devuelve la url sin el valor de un parámetro
		$url_nueva = str_replace( $valor, "", $url_base );

		return $url_nueva;
	}
	
	/* ----------------------------------------------------------------------------------- */
	
	function urlFiltro( $url_base, $url_params, $param, $val ){
		//Devuelve el url parametrizado con el filtro
		
		$url_nueva = $url_base;
		
		if ( paramEnUrl( $param, $url_params ) ){
			//Si el parámetro está incluído en la URL se agrega el valor nuevo
			
			if( valorEnParamUrl( $val, $url_params[$param] ) == false ){
				//Valor de parámetro no está en la URL, se agrega
				$nuevo_param = agregarValorParametroURL( $url_params, $param, $val );
				$url_nueva = str_replace( $url_params[$param], $nuevo_param, $url_base );
			}else{
				//Valor de parámetro ya está en la URL, se elimina
				$url_nueva = eliminarValorParametroURL( $url_base, SEPFLT.$val );
			}

		}else{
			//Si el parámetro no está incluído en la URL se agrega el parámetro nuevo con su valor
			$nuevo_param = agregarParametroConValorURL( $url_params, $param, $val );
			$url_nueva .= $nuevo_param;
		}

		$url_filtro = $url_nueva;
		//echo $url_filtro;
		return $url_filtro;
	}

	/* ----------------------------------------------------------------------------------- */

	define( "SEPFLT", ":" );

	if( isset( $_GET["c"] ) && isset( $_GET["s"] ) ){
		
	}
	
	if( isset( $_GET["c"] ) ) {
		$idc = obtenerIdCategoriaPorUname( $dbh, $_GET["c"], "categories" );
		$filtro_tallas = obtenerTallasPorCategoria( $dbh, $idc["id"] );
	}
	
	$filtro_trabajos = obtenerTrabajosProductos( $dbh, $productos );
	$filtro_lineas = obtenerLineasProductos( $dbh, $productos );
	$filtro_banos = obtenerBanosProductos( $dbh, $productos );
	$filtro_colores = obtenerColoresProductos( $dbh, $productos );

	$catalogue_url = $_SERVER["REQUEST_URI"];
	$urlparsed = parse_url( $catalogue_url );
	parse_str( $urlparsed["query"], $url_params );
	//print_r( $pams );

	/* ----------------------------------------------------------------------------------- */
?>