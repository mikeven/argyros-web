<?php 
	/* Argyros - Funciones catálogo */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */

	define( "SEPFLT", "_" );
	define( "P_FLT_LINEA", "lin" );
	define( "P_FLT_TRABAJO", "tra" );
	define( "P_FLT_COLOR", "col" );
	define( "P_FLT_BANO", "ba" );
	define( "P_FLT_TALLA", "talla" );

	/*.............................................................*/

	$catalogue_url = $_SERVER["REQUEST_URI"];
	$urlparsed = parse_url( $catalogue_url );
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

	function filtrarProductosPorAtributoProducto( $productos, $param ){
		$filtrados = array();	
		

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

	//Captura 
	if( isset( $_GET[P_FLT_LINEA] ) ){

		$valores_filtros = obtenerVectorValoresParametroFiltro( $url_params, $_GET[P_FLT_LINEA] );
		//$productos = filtrarProductosPorAtributoProducto( $productos, $_GET[P_FLT_LINEA] );		
	}

	//Captura
	if( isset( $_GET[P_FLT_TRABAJO] ) ){
			
	}

	//
	if( isset( $_GET[P_FLT_BANO] ) ){
			
	}

	$purl = "../../argyros/trunk/admin_/"; //Localhost
	//$purl = "admin/"; //Server
	/* ----------------------------------------------------------------------------------- */
?>