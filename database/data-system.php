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
?>