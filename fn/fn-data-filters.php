<?php 
	/* Argyros - Funciones filtros */
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
	
	function obtenerVectorValoresFiltro( $url_params, $param ){
		//Devuelve un vector con los valores contenidos en un parámetro de la URL
		
		$string_vector = $url_params[$param];	//tra = _tra1_tra2..._traN
		$vector = explode( SEPFLT, $string_vector );
		unset( $vector[0] ); 					// Se elimina el inicio de la url
		
		return $vector;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerVectorValoresFiltroPrecio( $url_params, $param ){
		//Devuelve un vector con los valores mínimo y máximo de un valor de precio en filtro

		$string_vector = $url_params[$param];	//precio=pmin-pmax
		$vector = explode( SEPVALFLT, $string_vector );
		return $vector;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerTextoEtiquetaFiltro( $param, $texto ){
		//Devuelve el texto contenido en la etiqueta de panel de filtros seleccionados
		if( $param == P_FLT_PIEZA || $param == P_FLT_PESO || $param == P_FLT_PESO_PROD ){
			$vector = explode( SEPVALFLT, $texto );
			$tprecio = ucfirst( str_replace( "-", " ", $param ) );
			$texto = $tprecio.": $".$vector[0]." - "."$".$vector[1];
			if ( $param == P_FLT_PESO_PROD ){
				$texto = $tprecio.": ".$vector[0]."gr - ".$vector[1]." gr";	
			}
		}
		/*else{
			$texto = ucfirst( str_replace( "-", " ", $texto ) );
			if( $texto == "N/A" )  $texto = "Ajustable/Única";	// Tallas únicas - ajustables
		}*/

		return $texto;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerValoresFiltros( $catalogue_url, $url_params ){
		//Devuelve los valores contenidos en los parámetros de filtros separados por comas
		$string = "";
		$data_filtro = array();
		
		foreach ( $url_params as $param=>$valor ){
			
			if( ( $param == "c" ) || ( $param == "s" ) || ( $param == P_TEXTO_BUSQUEDA ) || 
				( $param == P_SCROLL_PROD ) ){
				
			}else{
				$valores = explode( SEPFLT, $valor );
				foreach ( $valores as $texto ) {
					if( $texto != "" ){
						$item_filtro["url_filtro"] = urlFiltro( $catalogue_url, $url_params, 
																$param, trim( $texto ) );
						$item_filtro["texto"] = obtenerTextoEtiquetaFiltro( $param, $texto );
						$data_filtro[] = $item_filtro;
					}
				}
			}
		}
		return $data_filtro;
	}
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
	function obtenerIdsTallasCategoria( $tallas ){
		// Devuelve un vector con los ids de las tallas de categoría
		$idtallas = array();
		foreach ( $tallas as $t ) {
			$idtallas[] = $t["id"];
		}
		return $idtallas;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerTallasProductos( $dbh, $productos, $tallas_ctg ){
		//Devuelve las tallas incluídas en los productos asociadas a la categoría
		$filtros_tallas_productos 				= array();
		$idtallas_ctg 							= obtenerIdsTallasCategoria( $tallas_ctg );
		
		foreach ( $tallas_ctg as $tc ) {

			foreach ( $productos as $producto ) {

				$tallas_producto 					= $producto["sizes"];

				foreach ( $tallas_producto as $tprod ) {

					if( $tc["idtalla"] == $tprod["idtalla"] ){
						
						if( yaAgregadoVectores( $tc, $filtros_tallas_productos, "idtalla" ) == false ){
							$talla["idtalla"] 			= $tc["idtalla"];
							$talla["talla"] 			= $tc["talla"];
							$talla["utalla"] 			= $producto["talla"];
							$filtros_tallas_productos[] = $tc;
						}

					}

				}

			}
			
		}

		return $filtros_tallas_productos;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerCategoriasProductos( $dbh, $productos ){
		//Devuelve las categorías incluídas en los productos
		$filtros_ctgs_productos = array();
		
		foreach ( $productos as $producto ) {
			
			if( $producto["available"] ){

				if( yaAgregadoVectores( $producto, $filtros_ctgs_productos, "idc" ) == false ){
					$catg["idc"] 				= $producto["idc"];
					$catg["categoria"] 			= $producto["categoria"];
					$catg["ucat"] 				= $producto["ucat"];
					$filtros_ctgs_productos[] 	= $catg;
				}
			}
		}
		
		return $filtros_ctgs_productos;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerTrabajosProductos( $dbh, $productos ){
		//Devuelve los trabajos incluídos en los productos
		$filtros_trab_productos = array();
		
		foreach ( $productos as $p ) {
			
			if( $p["available"] ){
				$trabajos_p 	= obtenerTrabajosDeProductoPorId( $dbh, $p["idp"] );
				foreach ( $trabajos_p as $trabajo ) {
					if( yaAgregadoVectores( $trabajo, $filtros_trab_productos, "idtrabajo" ) == false )
						$filtros_trab_productos[] = $trabajo;
				}
			}
		}
		
		return $filtros_trab_productos;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerLineasProductos( $dbh, $productos ){
		//Devuelve las líneas incluídas en los productos
		$filtros_linea_productos = array();
		
		foreach ( $productos as $p ) {
			if( $p["available"] ){
				$lineas_p = obtenerLineasDeProductoPorId( $dbh, $p["idp"] );
				foreach ( $lineas_p as $linea ) {
					if( yaAgregadoVectores( $linea, $filtros_linea_productos, "idlinea" ) == false )
						$filtros_linea_productos[] = $linea;
				}
			}
		}
		return $filtros_linea_productos;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerBanosProductos( $dbh, $productos ){
		//Devuelve los baños incluídos en los productos
		$filtros_bano_productos = array();
		
		foreach ( $productos as $producto ) {
			if( $producto["available"] ){
				if( yaAgregadoVectores( $producto, $filtros_bano_productos, "id_bano" ) == false ){
					$bano["id_bano"] 			= $producto["id_bano"];
					$bano["bano"] 				= $producto["bano"];
					$bano["ubano"] 				= $producto["ubano"];
					$filtros_bano_productos[] 	= $bano;
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
			if( $producto["available"] ){
				if( yaAgregadoVectores( $producto, $filtros_color_productos, "id_color" ) == false ){
					$color["id_color"] 			= $producto["id_color"];
					$color["color"] 			= $producto["color"];
					$color["ucolor"] 			= $producto["ucolor"];
					$filtros_color_productos[] 	= $color;
				}
			}
		}

		return $filtros_color_productos;
	}

	/* ----------------------------------------------------------------------------------- */
	function ajustarParametrosEnUrl( $url_nueva, $url_params, $param ){
		//Elimina el parámetro de la URL si no posee valores (tra=)
		
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

	function actualizarValorParametroURL( $url_base, $valor_anterior, $valor_nuevo ){
		//Devuelve la url sin el valor de un parámetro
		$url_nueva = str_replace( $valor_anterior, $valor_nuevo, $url_base );

		return $url_nueva;
	}
	/* ----------------------------------------------------------------------------------- */
	
	function urlFiltro( $url_base, $url_params, $param, $val ){
		//Devuelve el url parametrizado con los valores para el filtro, excepto precios
		$url_nueva = $url_base;
		
		if ( paramEnUrl( $param, $url_params ) ){
			
			//Si el parámetro está incluído en la URL se agrega el valor nuevo 
			//(siempre que no sea parámetro de precio)
			if( $param == P_FLT_PIEZA || $param == P_FLT_PESO || $param == P_FLT_PESO_PROD ){
				//Eliminación de parámetro relacionados a precios( pieza, peso )
				$url_nueva 			= eliminarValorParametroURL( $url_base, $val );
				$url_nueva 			= ajustarParametrosEnUrl( $url_nueva, $url_params, $param );
			}else{

				if( valorEnParamUrl( $val, $url_params[$param] ) == false ){
					//Valor de parámetro no está en la URL, se agrega
					$nuevo_param 	= agregarValorParametroURL( $url_params, $param, $val );
					$url_nueva 		= str_replace( $url_params[$param], $nuevo_param, $url_base );
				}else{
					//Valor de parámetro ya está en la URL, se elimina
					$url_nueva 		= eliminarValorParametroURL( $url_base, SEPFLT.$val );
					$url_nueva 		= ajustarParametrosEnUrl( $url_nueva, $url_params, $param );
				}
			}

		}else{
			//Si el parámetro no está incluído en la URL se agrega el parámetro nuevo con su valor
			$nuevo_param 			= agregarParametroConValorURL( $url_params, $param, $val );
			$url_nueva 				.= $nuevo_param;
		}

		$url_filtro = $url_nueva;
		return $url_filtro;
	}
	/* ----------------------------------------------------------------------------------- */
	function urlFiltroPrecio( $url_base, $url_params, $param, $pmin, $pmax ){
		//Devuelve el url parametrizado con los valores de filtro para precios
		$url_nueva = $url_base;
		$valor_param = "&".$param."=".$pmin.SEPVALFLT.$pmax;

		
		if ( paramEnUrl( $param, $url_params ) ){
			//Si el parámetro está incluído en la URL se actualiza con el valor nuevo
			$url_filtro = actualizarValorParametroURL( $url_nueva,  $url_params[$param], 
							$pmin.SEPVALFLT.$pmax );
		}else{
			//Si el parámetro no está incluído en la URL se agrega el parámetro nuevo con su valor
			$url_filtro = $url_nueva.$valor_param;
		}

		return $url_filtro;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerTextoPanelFiltros( $dbh, $productos, $d_tallas, $catalogue_url, $url_params ){
		
		//data-products.php:
		$data_filtros["tallas"] 	= $d_tallas;//obtenerTallasProductos( $dbh, $productos, $d_tallas );
		$data_filtros["categorias"] = obtenerCategoriasProductos( $dbh, $productos );
		$data_filtros["trabajos"] 	= obtenerTrabajosProductos( $dbh, $productos );
		$data_filtros["lineas"] 	= obtenerLineasProductos( $dbh, $productos );
		$data_filtros["banos"] 		= obtenerBanosProductos( $dbh, $productos );
		$data_filtros["colores"] 	= obtenerColoresProductos( $dbh, $productos );

		//$catalogue_url, $url_params: fn-catalogue.php
		$data_filtros["url"]		= obtenerValoresFiltros( $catalogue_url, $url_params );

		return $data_filtros;
	}
	/* ----------------------------------------------------------------------------------- */
	function filtrarProductosDisponibles( $productos ){
		// Devuelve la lista de registros de detalles de productos con al menos una talla disponible
		$disponibles = array();
		
		if( $productos ){
			foreach ( $productos as $p )
				if( $p["available"] )
					$disponibles[] = $p;
		}

		return $disponibles;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerProductosFiltrados( $dbh, $productos, $catalogue_url, $url_params, $ver_ocultos ){
		
		$ft = array();

		//Filtro de productos comparando con el atributo 'Línea' de del producto
		if( isset( $url_params[P_FLT_LINEA] ) ){
			
			$vals_filtros 		= obtenerVectorValoresFiltro( $url_params, P_FLT_LINEA );
			$productos 			= filtrarProductosPorAtributoProducto( $dbh, $productos, P_FLT_LINEA, $vals_filtros );
			//fn-data-catalogue.php			
		}

		//Filtro de productos comparando con el atributo 'Trabajo' de del producto
		if( isset( $url_params[P_FLT_TRABAJO] ) ){
			$vals_filtros 		= obtenerVectorValoresFiltro( $url_params, P_FLT_TRABAJO );
			$productos 			= filtrarProductosPorAtributoProducto( $dbh, $productos, P_FLT_TRABAJO, $vals_filtros );
			//fn-data-catalogue.php		
		}

		//Filtro de productos comparando con el atributo 'Categoría' de del producto
		if( isset( $url_params[P_FLT_CATEGORIA] ) ){
			
			$vals_filtros 		= obtenerVectorValoresFiltro( $url_params, P_FLT_CATEGORIA );
			$productos 			= filtrarProductosPorAtributoDetalleProducto( $productos, P_FLT_CATEGORIA, $vals_filtros );
			//fn-data-catalogue.php		
		}

		//Filtro de productos comparando con el atributo 'Baño' de detalle de producto
		if( isset( $url_params[P_FLT_BANO] ) ){
			$vals_filtros 		= obtenerVectorValoresFiltro( $url_params, P_FLT_BANO );
			$productos 			= filtrarProductosPorAtributoDetalleProducto( $productos, P_FLT_BANO, $vals_filtros );
			//fn-data-catalogue.php			
		}

		//Filtro de productos comparando con el atributo 'Color' de detalle de producto
		if( isset( $url_params[P_FLT_COLOR] ) ){
			$vals_filtros 		= obtenerVectorValoresFiltro( $url_params, P_FLT_COLOR );
			$productos 			= filtrarProductosPorAtributoDetalleProducto( $productos, P_FLT_COLOR, $vals_filtros );
			//fn-data-catalogue.php		
		}

		//Filtro de productos comparando con el atributo 'Talla' de detalle de producto
		if( isset( $url_params[P_FLT_TALLA] ) ){

			$vals_filtros 		= obtenerVectorValoresFiltro( $url_params, P_FLT_TALLA );
			$productos 			= filtrarProductosPorTallasProducto( $dbh, $productos, $vals_filtros );
			$ft 				= $vals_filtros;
			//fn-data-catalogue.php	
		}

		//Filtro de productos comparando con el atributo 'Precio pieza' de detalle de producto
		if( isset( $url_params[P_FLT_PIEZA] ) ){
			$vals_filtros 		= obtenerVectorValoresFiltroPrecio( $url_params, P_FLT_PIEZA );
			$productos 			= filtrarProductosPorPrecio( $dbh, $productos, P_FLT_PIEZA, 
																   $vals_filtros, $ft, $ver_ocultos );
			//fn-data-catalogue.php	
		}

		//Filtro de productos comparando con el atributo 'Precio peso' de detalle de producto
		if( isset( $url_params[P_FLT_PESO] ) ){
			$vals_filtros 		= obtenerVectorValoresFiltroPrecio( $url_params, P_FLT_PESO );
			$productos 			= filtrarProductosPorPrecio( $dbh, $productos, P_FLT_PESO, 
																   $vals_filtros, $ft, $ver_ocultos );
			//fn-data-catalogue.php			
		}

		//Filtro de productos comparando con el atributo 'Peso' de detalle de producto
		if( isset( $url_params[P_FLT_PESO_PROD] ) ){
			$vals_filtros 		= obtenerVectorValoresFiltroPrecio( $url_params, P_FLT_PESO_PROD );
			$productos 			= filtrarProductosPorPeso( $dbh, $productos, P_FLT_PESO_PROD, $vals_filtros, $ft );
			//fn-data-catalogue.php			
		}

		if( $ver_ocultos == false )	
			$productos = filtrarProductosDisponibles( $productos );

		return $productos;
	}

	/* ----------------------------------------------------------------------------------- */
	function obtenerOpcionesFiltros( $d_filtros, $productos, $catalogue_url, $url_params ){
		// Devuelve las opciones de filtro por cada atributo de los productos filtrados
		$opciones = array(); 
		
		$o_categorias = "";
		foreach ( $d_filtros["categorias"] as $c ){
			$url_f 		= urlFiltro( $catalogue_url, $url_params, P_FLT_CATEGORIA, trim( $c["ucat"] ) );
            $o_categorias .= "<li><a title='$c[categoria]' href='$url_f'>
								<span class='fe-checkbox'></span> $c[categoria]</a>
							  </li>";
		}

		$o_filtros = "";
		foreach ( $d_filtros["url"] as $flt_vo ) {
			$o_filtros 	.= "<a href='$flt_vo[url_filtro]' class='tfilt'>
								$flt_vo[texto] <i class='fa fa-times'></i>
						   </a>";
		}

		$o_tallas = "";
		foreach ( $d_filtros["tallas"] as $t ){
			$url_f 		= urlFiltro( $catalogue_url, $url_params, P_FLT_TALLA, trim( $t["talla"] ) );
			$n_talla 	= $t["talla"];  
			
			if ( $t["talla"] == "ajust" )  $n_talla  = "Ajustable";
            if ( $t["talla"] == "unica" )  $n_talla  = "Única";
            $o_tallas 	.= "<li><a title='Talla $n_talla' href='$url_f'>
							<span class='fe-checkbox'></span> $n_talla</a>
						  </li>";
		}

		$o_banos = "";
		foreach ( $d_filtros["banos"] as $b ){
			$url_f = urlFiltro( $catalogue_url, $url_params, P_FLT_BANO, trim( $b["ubano"] ) );
            $o_banos 	.= "<li><a title='$b[bano]' href='$url_f'>
							<span class='fe-checkbox'></span> $b[bano]</a>
						 </li>";
		}

		$o_trabajos = "";
		foreach ( $d_filtros["trabajos"] as $t ){
			$url_f = urlFiltro( $catalogue_url, $url_params, P_FLT_TRABAJO, trim( $t["utrabajo"] ) );
            $o_trabajos .= "<li><a title='$t[nombre]' href='$url_f'>
								<span class='fe-checkbox'></span> $t[nombre]</a>
							</li>";
		}

		$o_lineas = "";
		foreach ( $d_filtros["lineas"] as $l ){
			$url_f 		= urlFiltro( $catalogue_url, $url_params, P_FLT_LINEA, trim( $l["ulinea"] ) );
            $o_lineas 	.= "<li><a title='$l[nombre]' href='$url_f'>
								<span class='fe-checkbox'></span> $l[nombre]</a>
						    </li>";
		}

		$o_colores = "";
		foreach ( $d_filtros["colores"] as $c ){
			$url_f 		= urlFiltro( $catalogue_url, $url_params, P_FLT_COLOR, trim( $c["ucolor"] ) );
            $o_colores 	.= "<li><a title='$c[color]' href='$url_f'>
								<span class='fe-checkbox'></span> $c[color]</a>
						    </li>";
		}
		
		$opciones["enlaces_filtros"] 	= $o_filtros;
		$opciones["tallas"] 			= $o_tallas;
		$opciones["categorias"] 		= $o_categorias;
		$opciones["banos"] 				= $o_banos;
		$opciones["trabajos"] 			= $o_trabajos;
		$opciones["lineas"] 			= $o_lineas;
		$opciones["colores"] 			= $o_colores;

		return $opciones;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerBloqueFiltrosCatalogo( $dbh, $productos, $catalogue_url, $url_params ){
		// 
		$cat 			= $url_params["c"];

		$tallas_ctg 	= obtenerTallasPorCategoria( $dbh, oic( $dbh, 'c', $cat, "" ) );
		$d_filtros 		= obtenerTextoPanelFiltros( $dbh, $productos, $tallas_ctg, $catalogue_url, $url_params );
		$lista_filtros	= obtenerOpcionesFiltros( $d_filtros, $productos, $catalogue_url, $url_params );

		return $lista_filtros;
	}
	/* ----------------------------------------------------------------------------------- */

	if( isset( $_POST["urltipo_precio"] ) ){
		//Llamada asíncrona para generar URL para filtrar por precio (pieza, gramo, peso producto )
		
		include( "fn-catalogue.php" );
		
		$catalogue_url = $_POST["url_c"];
		$urlparsed = parse_url( $catalogue_url );
		
		parse_str( $urlparsed["query"], $url_params );

		if( $_POST["urltipo_precio"] == "pieza" ){
			$url = urlFiltroPrecio( $catalogue_url, $url_params, P_FLT_PIEZA, 
									$_POST["p_min"], $_POST["p_max"] );
			echo $url;
		}
		if( $_POST["urltipo_precio"] == "peso" ){
			$url = urlFiltroPrecio( $catalogue_url, $url_params, P_FLT_PESO, 
									$_POST["p_min"], $_POST["p_max"] );
			echo $url;
		}
		if( $_POST["urltipo_precio"] == "peso_producto" ){
			$url = urlFiltroPrecio( $catalogue_url, $url_params, P_FLT_PESO_PROD, 
									$_POST["peso_min"], $_POST["peso_max"] );
			echo $url;
		}
	}
	/*else{
		if( isset( $_SESSION["login"] ) ) {
			//	Flujo natural, sin la llamada asíncrona
			//	$productos : fn-data-catalogue.php
			$tallas_ctg 			= NULL;
			if( isset( $_GET["c"] ) ){
				$idc 				= obtenerIdCategoriaPorUname( $dbh, $_GET["c"] );
				$tallas_ctg 		= obtenerTallasPorCategoria( $dbh, $idc["id"] );
			}

			$productos = obtenerProductosFiltrados( $dbh, $productos, $catalogue_url, $url_params );
			//$d_filtros = obtenerTextoPanelFiltros( $dbh, $productos, $tallas_ctg, $catalogue_url, $url_params );
		}	
	}*/
	/* ----------------------------------------------------------------------------------- */
?>