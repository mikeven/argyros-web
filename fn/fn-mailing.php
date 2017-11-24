<?php
	/* ----------------------------------------------------------------------------------- */
	/* Argyros - Funciones mensajes emails */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	function obtenerCabecerasMensaje(){
		//Devuelve las cabecera 
		$email = "info@argyros.com";
		$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
		$cabeceras .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
        $cabeceras .= 'From: Argyros <'.$email.">"."\r\n";

        return $cabeceras;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerPlantillaMensaje( $accion ){
		//Devuelve la plantilla html de acuerdo al mensaje a ser enviado
		$archivos = array(
			"usuario_nuevo" => "register.html"
		);

		$archivo = $archivos[$accion];
		return file_get_contents( "../fn/mailing/".$archivo );
	}
	/* ----------------------------------------------------------------------------------- */
	function mensajeNuevoUsuario( $plantilla, $datos ){
		//Llenado de mensaje para plantilla de nuevo usuario
		$server = "http://mgideas.net";
		$url_activacion = $server."/argyros/verified_account.php?token_account=".$datos["token"];
		$plantilla = str_replace( "{url_activation}", $url_activacion, $plantilla );
		$plantilla = str_replace( "{user}", $datos["name"], $plantilla );
		
		return $plantilla;
	}
	/* ----------------------------------------------------------------------------------- */
	function escribirMensaje( $tmensaje, $plantilla, $datos ){
		//Sustitución de elementos de la plantilla con los datos del mensaje
		
		if( $tmensaje == "usuario_nuevo" ){
			$sobre["asunto"] = "Activación cuenta";
			$sobre["mensaje"] = mensajeNuevoUsuario( $plantilla, $datos );
		}

		return $sobre; 
	}
	/* ----------------------------------------------------------------------------------- */
	function enviarMensajeEmail( $tipo_mensaje, $datos, $email ){
		//Construcción del mensaje para enviar por email
		$plantilla = obtenerPlantillaMensaje( $tipo_mensaje );
		$sobre = escribirMensaje( $tipo_mensaje, $plantilla, $datos );
		$sobre["cabeceras"] = obtenerCabecerasMensaje();
		
		return mail( $email, $sobre["asunto"], $sobre["mensaje"], $sobre["cabeceras"] );
	}
	/* ----------------------------------------------------------------------------------- */
?>