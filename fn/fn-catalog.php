<?php 
	/* Argyros - Funciones catálogo */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	function oic( $dbh, $uname, $t ){
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


	//$purl = "../../argyros/trunk/admin_/"; //Localhost
	$purl = "admin/"; //Server
	/* ----------------------------------------------------------------------------------- */
?>