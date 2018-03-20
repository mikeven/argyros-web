<?php
	/* ----------------------------------------------------------------------------------- */
	/* Argyros - Funciones de trabajos */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	
	function obtenerListaTrabajos( $dbh ){
		//Devuelve la lista de trabajos
		$q = "Select id, name from makings order by name ASC";
		
		$data = mysqli_query( $dbh, $q );
		$lista_c = obtenerListaRegistros( $data );
		return $lista_c;	
	}

	/* ----------------------------------------------------------------------------------- */
	/* Solicitudes asíncronas al servidor para procesar información de Trabajos */
	/* ----------------------------------------------------------------------------------- */
	

	/* ----------------------------------------------------------------------------------- */

?>