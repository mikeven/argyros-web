<?php 
	/* Argyros - Funciones de catálogo */
	// -------------------------------------------------------------------------------------- 
	// -------------------------------------------------------------------------------------- 
	// -------------------------------------------------------------------------------------- 
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

	define( "URLBASECAT", "catalogue_products.php" );	// url base de catálogo
	define( "NPAGINACION", 32 );

	/*.............................................................*/
	$catalogue_url = $_SERVER["REQUEST_URI"];
	$urlparsed = parse_url( $catalogue_url );
	if( isset( $urlparsed["query"] ) )
		parse_str( $urlparsed["query"], $url_params );
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
	// -------------------------------------------------------------------------------------- 
	function obtenerProductosDestacados( $dbh, $cdestacadas ){
		//Devuelve los productos mostrados en la página de inicio

		$pdestacados[0] = obtenerUltimoProductoCategoria( $dbh, $cdestacadas[0]["id"] ); 	//Zarcillos
		$pdestacados[1] = obtenerUltimoProductoCategoria( $dbh, $cdestacadas[1]["id"] );	//Gargantillas
		$pdestacados[2] = obtenerUltimoProductoCategoria( $dbh, $cdestacadas[2]["id"] );	//Anillos
		$pdestacados[3] = obtenerUltimoProductoCategoria( $dbh, $cdestacadas[3]["id"] );	//Pulseras

		return $pdestacados;
	}
	// -------------------------------------------------------------------------------------- 
	function obtenerCategoriasDestacadas( $dbh ){
		//Devuelve las categorías destacadas
		$cdestacadas[0] = obtenerCategoriasDestacadaPorOrden( $dbh, 1 );
    	$cdestacadas[1] = obtenerCategoriasDestacadaPorOrden( $dbh, 2 );
    	$cdestacadas[2] = obtenerCategoriasDestacadaPorOrden( $dbh, 3 );
    	$cdestacadas[3] = obtenerCategoriasDestacadaPorOrden( $dbh, 4 );

    	return $cdestacadas;
	}
	// -------------------------------------------------------------------------------------- 
	if( isset( $_GET["c"] ) ){
		//Categoría
		$h_ncat 				= obtenerCategoriaPorUname( $dbh, $_GET["c"] );	
	}
	if( isset( $_GET["s"] ) ){
		//Subcategoría
		$h_nscat 				= obtenerSubCategoriaPorUname( $dbh, $_GET["s"] );
	}
	
	//$purl = "../../argyros/trunk/admin_/"; //Localhost
	$purl = "admin/"; //Server
	// -------------------------------------------------------------------------------------- 
?>