<?php
	/* ----------------------------------------------------------------------------------- */
	/* Argyros - Funciones varias de sistema */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	
	function reemplazarCaracteres( $text ){
		$nuevo = str_replace( "á", "a", $text );
		$nuevo = str_replace( "é", "e", $nuevo );
		$nuevo = str_replace( "í", "i", $nuevo );
		$nuevo = str_replace( "ó", "o", $nuevo );
		$nuevo = str_replace( "ú", "u", $nuevo );

		return $nuevo;
	}
	/* ----------------------------------------------------------------------------------- */
	function ajustarAcentos( $lista ){
		$nlista = array();
		foreach ( $lista as $reg ) {
			$reg["name"] = reemplazarCaracteres( $reg["name"] );
			$nlista[] = $reg;
		}
		return $nlista;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerEmailNotificacionContacto( $dbh ){
		//Devuelve el correo electrónico de notificaciones de recepción de datos del formulario de contacto
		$q = "select contact_email from admin_configs where id = 1";
		$data = mysqli_query( $dbh, $q );
		return mysqli_fetch_array( $data );
	}
	/* ----------------------------------------------------------------------------------- */
?>