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
	
	function obtenerVectorValoresFiltro( $url_params, $param ){
		//Devuelve un vector con los valores contenidos en un parámetro de la URL
		
		$string_vector = $url_params[$param];	//tra=_tra1_tra2..._traN
		$vector = explode( SEPFLT, $string_vector );
		unset( $vector[0] );
		return $vector;
	}
	
	/* ----------------------------------------------------------------------------------- */
	
	function obtenerValoresFiltros( $catalogue_url, $url_params ){
		//Devuelve los valores contenidos en los parámetros de filtros separados por comas
		$string = "";
		$data_filtro = array();
		
		foreach ( $url_params as $param=>$valor ) {
			//echo $param."=".$valor.($param != "s")."<br>";
			if( ( $param == "c" ) || ( $param == "s" ) ){
				
			}else{
				$valores = explode( SEPFLT, $valor );
				foreach ( $valores as $texto ) {
					if( $texto != "" ){
						$item_filtro["url_filtro"] = urlFiltro( $catalogue_url, $url_params, $param, trim( $texto ) );
						$item_filtro["texto"] = ucfirst( str_replace( "-", " ", $texto ) );
						$data_filtro[] = $item_filtro;
					}
				}
			}
		}
		return $data_filtro;//substr( $string, 1 );
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
					$bano["ubano"] = $reg["ubano"];
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
					$color["ucolor"] = $reg["ucolor"];
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
	function ajustarParametrosEnUrl( $url_nueva, $url_params, $param ){
		//Elimina el parámetro de la URL si no posee valores
		
		$suburl_param = trim( $url_params[$param] );
		$nval_param = count( explode( SEPFLT, $suburl_param ) ) - 1;
		
		if( $nval_param < 2 )
			$url_nueva = str_replace( "&".$param."=", "", $url_nueva );

		return $url_nueva;
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
		//Devuelve el url parametrizado con los valores para el filtro, excepto precios
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
				$url_nueva = ajustarParametrosEnUrl( $url_nueva, $url_params, $param );
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

	function urlFiltroPrecio( $url_base, $url_params, $param, $pmin, $pmax ){
		//Devuelve el url parametrizado con los valores de filtro para precios
		$url_nueva = $url_base;
		$valor_param = "&".$param."=".$pmin.SEPVALFLT.$pmax;
		
		/*if ( paramEnUrl( $param, $url_params ) ){
			//Si el parámetro está incluído en la URL se actualiza el valor nuevo
			
			if( valorEnParamUrl( $val, $url_params[$param] ) == false ){
				//Valor de parámetro no está en la URL, se agrega
				$nuevo_param = agregarValorParametroURL( $url_params, $param, $val );
				$url_nueva = str_replace( $url_params[$param], $nuevo_param, $url_base );
			}else{
				//Valor de parámetro ya está en la URL, se elimina
				$url_nueva = eliminarValorParametroURL( $url_base, SEPFLT.$val );
				$url_nueva = ajustarParametrosEnUrl( $url_nueva, $url_params, $param );
			}

		}else{
			//Si el parámetro no está incluído en la URL se agrega el parámetro nuevo con su valor
			$nuevo_param = agregarParametroConValorURL( $url_params, $param, $val );
			$url_nueva .= $nuevo_param;
		}*/

		$url_filtro = $url_nueva.$valor_param;
		//echo $url_filtro;
		return $url_filtro;
	}
	
	/* ----------------------------------------------------------------------------------- */
	
	function obtenerTextoPanelFiltros( $dbh, $productos, $catalogue_url, $url_params ){
		
		//data-products.php:
		$data_filtros["trabajos"] 	= obtenerTrabajosProductos( $dbh, $productos );
		$data_filtros["lineas"] 	= obtenerLineasProductos( $dbh, $productos );
		$data_filtros["banos"] 		= obtenerBanosProductos( $dbh, $productos );
		$data_filtros["colores"] 	= obtenerColoresProductos( $dbh, $productos );

		//$catalogue_url, $url_params: fn-catalogue.php
		$data_filtros["url"]		= obtenerValoresFiltros( $catalogue_url, $url_params );

		return $data_filtros;
	}

	/* ----------------------------------------------------------------------------------- */

	function obtenerProductosFiltrados( $dbh, $productos, $catalogue_url, $url_params ){
		
		//Filtro de productos comparando con el atributo 'Línea' de del producto
			if( isset( $_GET[P_FLT_LINEA] ) ){
			$valores_filtros = obtenerVectorValoresFiltro( $url_params, P_FLT_LINEA );
			$productos = filtrarProductosPorAtributoProducto( $dbh, $productos, P_FLT_LINEA, $valores_filtros );		
		}

		//Filtro de productos comparando con el atributo 'Trabajo' de del producto
		if( isset( $_GET[P_FLT_TRABAJO] ) ){
			$valores_filtros = obtenerVectorValoresFiltro( $url_params, P_FLT_TRABAJO );
			$productos = filtrarProductosPorAtributoProducto( $dbh, $productos, P_FLT_TRABAJO, $valores_filtros );		
		}

		//Filtro de productos comparando con el atributo 'Baño' de detalle de producto
		if( isset( $_GET[P_FLT_BANO] ) ){
			$valores_filtros = obtenerVectorValoresFiltro( $url_params, P_FLT_BANO );
			$productos = filtrarProductosPorAtributoDetalleProducto( $dbh, $productos, P_FLT_BANO, $valores_filtros );		
		}

		//Filtro de productos comparando con el atributo 'Color' de detalle de producto
		if( isset( $_GET[P_FLT_COLOR] ) ){
			$valores_filtros = obtenerVectorValoresFiltro( $url_params, P_FLT_COLOR );
			$productos = filtrarProductosPorAtributoDetalleProducto( $dbh, $productos, P_FLT_COLOR, $valores_filtros );		
		}

		//Filtro de productos comparando con el atributo 'Talla' de detalle de producto
		if( isset( $_GET[P_FLT_TALLA] ) ){
			$valores_filtros = obtenerVectorValoresFiltro( $url_params, P_FLT_TALLA );
			/*foreach ( $productos as $p ) {
				$rp = obtenerProductoPorId( $dbh, $p["id"] );
				$dp = $rp["detalle"];
				print_r($dp);
				echo "<br><br>";
			}*/
			$productos = filtrarProductosPorRegistroAtributoDetalleProducto( $dbh, $productos, P_FLT_TALLA, $valores_filtros );		
		}

		return $productos;
	}

	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */

	if( isset( $_GET["c"] ) && isset( $_GET["s"] ) ){
		
	}
	
	if( isset( $_GET["c"] ) ){
		$idc = obtenerIdCategoriaPorUname( $dbh, $_GET["c"], "categories" );
		$filtro_tallas = obtenerTallasPorCategoria( $dbh, $idc["id"] );
	}

	if( isset( $_POST["urltipo_precio"] ) ){
		//Llamada asíncrona para generar URL para filtrar por precio
		include( "fn-catalog.php" );
		$catalogue_url = $_POST["url_c"];
		$urlparsed = parse_url( $catalogue_url );
		parse_str( $urlparsed["query"], $url_params );

		if( $_POST["urltipo_precio"] == "pieza" ){
			$url = urlFiltroPrecio( $catalogue_url, $url_params, P_FLT_PIEZA, $_POST["p_min"], $_POST["p_max"] );
			echo $url;
		}
	}
	else{
		//Flujo natural, sin la llamada asíncrona
		$d_filtros = obtenerTextoPanelFiltros( $dbh, $productos, $catalogue_url, $url_params );
		$productos = obtenerProductosFiltrados( $dbh, $productos, $catalogue_url, $url_params );	
	}

	/* ----------------------------------------------------------------------------------- */
?>