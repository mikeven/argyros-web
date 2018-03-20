<?php
	/* ----------------------------------------------------------------------------------- */
	/* Argyros - Funciones de productos para filtros */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	
	/* ----------------------------------------------------------------------------------- */
	function obtenerTrabajosDeProductoPorId( $dbh, $idp ){
		//Devuelve los datos de las líneas a las que pertenece un producto
		$q = "select t.id as idtrabajo, t.name as nombre 
		from makings t, making_product tp where tp.making_id = t.id and tp.product_id = $idp order by nombre ASC";
		
		$data = mysqli_query( $dbh, $q );
		$lista = obtenerListaRegistros( $data );
		return $lista;
	}

	/* ----------------------------------------------------------------------------------- */

	function obtenerLineasDeProductoPorId( $dbh, $idp ){
		//Devuelve los datos de las líneas a las que pertenece un producto
		$q = "select l.id as idlinea, l.name as nombre, l.description as descripcion 
		from plines l, line_product lp where lp.line_id = l.id and lp.product_id = $idp order by nombre ASC";
		
		$data = mysqli_query( $dbh, $q );
		$lista = obtenerListaRegistros( $data );
		return $lista;
	}

	/* ----------------------------------------------------------------------------------- */
	/* Solicitudes asíncronas al servidor para procesar información de Productos */
	/* ----------------------------------------------------------------------------------- */
	

	/* ----------------------------------------------------------------------------------- */

?>