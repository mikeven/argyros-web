<?php 
	/* Argyros - Funciones filtros */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	
	function yaAgregadoVectores( $elem, $vector, $ke, $kv ){
		//Retorna verdadero o falso si un registro está contenido en un vector de registros comparando con una clave del registro

		$contenido = false;
		foreach ( $vector as $reg ) {
			if( $reg[$kv] == $elem[$ke] )
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
				if( yaAgregadoVectores( $trabajo, $filtros_trab_productos, "idtrabajo", "idtrabajo" ) == false )
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
				if( yaAgregadoVectores( $linea, $filtros_linea_productos, "idlinea", "idlinea" ) == false )
					$filtros_linea_productos[] = $linea;
			}
		}
		return $filtros_linea_productos;
	}

	/* ----------------------------------------------------------------------------------- */

	if( isset( $_GET["c"] ) && isset( $_GET["s"] ) ){
		
	}
	
	if( isset( $_GET["c"] ) ){
		$idc = obtenerIdCategoriaPorUname( $dbh, $_GET["c"], "categories" );
		$filtro_tallas = obtenerTallasPorCategoria( $dbh, $idc["id"] );
	}
	
	//$filtro_trabajos = obtenerTrabajosProductos( $dbh, $productos );
	$filtro_lineas = obtenerLineasProductos( $dbh, $productos );


	$purl = "../../argyros/trunk/admin_/"; //Localhost
	//$purl = "admin/"; // Server
	/* ----------------------------------------------------------------------------------- */
?>