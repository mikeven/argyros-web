<?php
	/* ----------------------------------------------------------------------------------- */
	/* Argyros - Funciones de usuarios */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	function ultimaActualizacion( $dbh, $idu ){
		//Retorna la fecha donde se realizó la última actualización de documentos de usuario
		$q = "select date_format(ultima_act_doc,'%Y-%m-%d') as fecha from usuario 
			where idUsuario = $idu";
		$data = mysql_fetch_array( mysql_query ( $q, $dbh ) );
		
		return $data["fecha"];
	}
	/* ----------------------------------------------------------------------------------- */
	function chequearActualizacion( $dbh, $hoy, $idu ){
		//Chequea el estado de actualización de documentos e invoca a su revisión
		include( "bd/data-documento.php" );
		$fult_act_docs = ultimaActualizacion( $dbh, $idu );
		
		if( $fult_act_docs < $hoy ){
			revisarEstadoDocumentos( $dbh, $idu, $hoy );
		}		
	}
	/* ----------------------------------------------------------------------------------- */
	function checkSession( $page ){
		/*if( isset( $_SESSION["login"] ) ){
			if( $page == "index" ) 
				echo "<script> window.location = 'home.php'</script>";
		}else{
			if( $page == "" )
				echo "<script> window.location = 'index.php'</script>";		
		}*/
	}
	/* ----------------------------------------------------------------------------------- */
	function usuarioValido( $usuario, $dbh ){
		$valido = true;

		$q = "select usuario from usuario where usuario = '$usuario'";
		$data_user = mysql_fetch_array( mysql_query ( $q, $dbh ) );
		if( $usuario == $data_user["usuario"] ) $valido = false;

		return $valido;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerValoresGrupoUsuarioDefecto( $dbh ){
		//Devuelve los multiplicadores asociados a los precios del perfil de usuario por defecto
		$q = "select id, name, description, variable_a, variable_b, variable_c, variable_d, material 
		from user_group where name = 'Defecto'";
		
		$data_user = mysqli_fetch_array( mysqli_query( $dbh, $q ) );
		return $data_user;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerValoresGrupoUsuario( $dbh, $grupo ){
		//Devuelve los multiplicadores asociados a los precios de acuerdo al perfil de usuario
		$q = "select id, name, description, variable_a, variable_b, variable_c, variable_d, material 
		from user_group where id = $grupo";
		
		$data_user = mysqli_fetch_array( mysqli_query( $dbh, $q ) );
		return $data_user;
	}
	/* ----------------------------------------------------------------------------------- */
	function variablesGrupoUsuario( $dbh ){
		//Devuelve los valores de las variables según el perfil de la cuenta en sesión o sin sesión
		if( isset( $_SESSION["user"]["user_group_id"] ) ){
			$grupo_u = $_SESSION["user"]["user_group_id"];
			$var_gr_usuario = obtenerValoresGrupoUsuario( $dbh, $grupo_u );
		}
		else
			$var_gr_usuario = obtenerValoresGrupoUsuarioDefecto( $dbh );

		return $var_gr_usuario;
	}
	
	/* ----------------------------------------------------------------------------------- */
	function obtenerListaUsuarios( $dbh ){
		//Devuelve la lista de usuarios
		$q = "Select u.id, u.first_name as nombre, u.last_name as apellido, u.email, u.phone, r.id as idrol,   
		r.name as rol, r.display_name as nombre_rol, r.description as descripcion_rol, 
		date_format(u.created_at,'%d/%m/%Y') as fcreacion from users u, role_user ru, roles r 
		where ru.user_id = u.id and ru.role_id and ru.role_id = r.id and ru.role_id <> 4 order by nombre ASC";
		
		$data = mysqli_query( $dbh, $q );
		$lista = obtenerListaRegistros( $data );
		return $lista;	
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerListaRoles( $dbh ){
		//Devuelve la lista de roles
		$q = "Select id, name as nombre, description, display_name as nombre_rol from roles order by nombre ASC";
		
		$data = mysqli_query( $dbh, $q );
		$lista = obtenerListaRegistros( $data );
		return $lista;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerUsuarioPorId( $idu, $dbh ){
		$sql = "select * from usuario where idUsuario = $idu";
		$data_user = mysql_fetch_array( mysql_query ( $sql, $dbh ) );
		return $data_user;					
	}
	/* ----------------------------------------------------------------------------------- */
	function registrarInicioSesion( $usuario, $dbh ){
		$adj_time = 96; // Tiempo para ajustar diferencia con hora de servidor ( minutos )
		$adjsql = "NOW() + INTERVAL $adj_time MINUTE";
		$query = "insert into ingreso values ('', $usuario[idUsuario], $adjsql )";
		$Rs = mysql_query ( $query, $dbh );
		return mysql_insert_id();	
	}
	/* ----------------------------------------------------------------------------------- */
	function registrarUsuario( $dbh, $usuario ){
		//Registro de nuevo usuario (cliente)
		//user_group_id (1) : Defecto -> Tipo de usuario por defecto
		$q = "insert into users ( first_name, last_name, email, password, country_code, company_type, token, user_group_id ) 
		values ( '$usuario[name]', '', '$usuario[email]', '$usuario[passw1]', '$usuario[pais]', '$usuario[tcliente]', '$usuario[token]', 1 )";
		//echo $q;
		$Rs = mysqli_query( $dbh, $q );
		return mysqli_insert_id( $dbh );	
	}
	/* ----------------------------------------------------------------------------------- */
	function registrarRolUsuario( $dbh, $idu, $idr, $nombre_rol ){
		//Asociación rol a un usuario
		$q = "insert into role_user ( user_id, role_id ) values ( $idu, $idr )";
		
		$Rs = mysqli_query( $dbh, $q );
		return mysqli_insert_id( $dbh );
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerUsuarioLogin( $lnk, $email, $pass ){
		//Obtiene los datos de un usuario por email y contraseña
		$sql = "select * from users where email = '$email' and password='$pass'";
		
		$data = mysqli_query ( $lnk, $sql );		
		$data_user = mysqli_fetch_array( $data );
		//print_r($data);
		return $data_user;
	}
	/* ----------------------------------------------------------------------------------- */
	function usuarioYaRegistrado( $dbh, $email ){
		//Determina si ya existe un usuario registrado dado su email
		$existe = false;
		$q = "select * from users where email = '$email'";
		$nrows = mysqli_num_rows( mysqli_query ( $dbh, $q ) );
		
		if( $nrows > 0 ) $existe = true;
		
		return $existe;
	}
	/* ----------------------------------------------------------------------------------- */
	function login( $data_user ){
		session_start();
	
		$_SESSION["login"] = 1;
		$_SESSION["user"] = $data_user;
		$_SESSION["cart"] = array();
		//registrarInicioSesion( $data_user, $dbh );
		$login = true; 

		return $login;
	}
	/* ----------------------------------------------------------------------------------- */
	function modificarDatosUsuario( $usuario, $dbh ){
		//Actualiza los datos de cuenta de usuario
		$actualizado = 1;
		$q = "update usuario set usuario = '$usuario[usuario]', nombre = '$usuario[nombre]' 
		where idUsuario = $usuario[id]";
		//echo $q;
		
		mysql_query( $q, $dbh );
		if( mysql_affected_rows() == -1 ) $actualizado = 0;
		
		return $actualizado;
	}
	/* ----------------------------------------------------------------------------------- */
	function modificarPassword( $usuario, $dbh ){
		//Actualiza el valor de contraseña de usuario
		$actualizado = 1;
		$q = "update usuario set password = '$usuario[password]' where idUsuario = $usuario[id]";
		//echo $q;
		
		$data = mysql_query( $q, $dbh );
		
		if( mysql_affected_rows() != 1 )
			$actualizado = 0;
		
		return $actualizado;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerTokenUsuarioNuevo( $usuario ){
		//Genera un código provisional enviado por email para confirmar y verificar cuenta
		$fecha = date_create();
		$date = date_timestamp_get( $fecha );
		return sha1( md5( $date.$usuario["passw1"] ) );
	}
	/* ----------------------------------------------------------------------------------- */
	function verificarCuenta( $dbh, $id_usuario ){
		//Verifica cuenta de usuario después de su registro validado
		$actualizado = 1;
		$q = "update users set verified = 1 where id = $id_usuario";
		$r = mysqli_query( $dbh, $q );
		if( mysqli_affected_rows( $dbh ) == -1 ) $actualizado = 0;
		
		return $actualizado;	
	}
	/* ----------------------------------------------------------------------------------- */
	function chequearTokenCuenta( $dbh, $ta ){
		//Chequea si existe un token de usuario registrado para verificar cuenta
		$verificada = false;
		$q = "select id, token, verified from users where token = '$ta'";
		$data = mysqli_query ( $dbh, $q );
		$data_user = mysqli_fetch_array( $data );
		$nrows = mysqli_num_rows( $data );
		
		if( $nrows > 0 ){
			verificarCuenta( $dbh, $data_user["id"] );
			$verificada = true;
		}
		return $verificada;
	}

	function cuentaActivada( $id ){

	}
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	/* Solicitudes asíncronas al servidor para procesar información de usuarios */
	/* ----------------------------------------------------------------------------------- */
	//Detección de sesión
	if( isset( $_SESSION["login"] ) ){
		$idu = $_SESSION["user"]["id"];
	}else $idu = NULL;
	
	/* ----------------------------------------------------------------------------------- */
	//Inicio de sesión (asinc)
	if( isset( $_POST["usr_login"] ) ){
		include( "bd.php" );
		parse_str( $_POST["usr_login"], $usuario );

		$data_user = obtenerUsuarioLogin( $dbh, $usuario["email"], $usuario["password"] );
		
		if( $data_user ){
			if( $data_user["verified"] == 1 ){
				login( $data_user, $dbh );
				$res["exito"] = 1;
				$res["mje"] = "Inicio de sesión exitoso";
			}
			else{
				$res["exito"] = -1;
				$res["mje"] = "<p>Su cuenta no ha sido activada aún. Chequee su buzón de correo y siga las instrucciones para activar su cuenta.".
				"<br>Si no ha recibido el mensaje, haga clic en el siguiente enlace</p>".
				"<p><button id='btn_login' class='btn'>Reenviar mensaje de activación</button></p>";			
			}
		}else{
			$res["exito"] = 0;
			$res["mje"] = "Usuario o contraseña incorrecta, chequee sus credenciales";
		}
		
		echo json_encode( $res );
	}
	/* ----------------------------------------------------------------------------------- */
	//Cierre de sesión
	if( isset( $_GET["logout"] ) ){
		//include( "bd.php" );
		unset( $_SESSION["login"] );
		unset( $_SESSION["user"] );
		unset( $_SESSION["cart"] );
		echo "<script> window.location = 'index.php'</script>";		
	}	
	/* ----------------------------------------------------------------------------------- */
	//Registro de nueva cuenta de usuario (cliente)
	if( isset( $_POST["form_nu"] ) ){
		include( "bd.php" );
		include( "../fn/fn-mailing.php" );

		parse_str( $_POST["form_nu"], $usuario );

		if( usuarioYaRegistrado( $dbh, $usuario["email"] ) ){
			$res["exito"] = -1;
			$res["mje"] = "Dirección de email ya registrada, intente usar una dirección de correo diferente";
		}else{
			$usuario["token"] = obtenerTokenUsuarioNuevo( $usuario );
			$idu = registrarUsuario( $dbh, $usuario );
			$idr = registrarRolUsuario( $dbh, $idu, 4, "cliente" );
			$remail = enviarMensajeEmail( "usuario_nuevo", $usuario, $usuario["email"] );

			$res["exito"] = 1;
			$res["mje"] = "<p>Registro de usuario con éxito. Se ha enviado un mensaje con las instrucciones para activar su cuenta.".
				"<br>Si no ha recibido el mensaje, haga clic en el siguiente enlace</p>".
				"<p><button id='btn_login' class='btn'>Reenviar mensaje de activación</button></p>";;
		}

		echo json_encode( $res );

	}
	/* ----------------------------------------------------------------------------------- */
	//Modificar datos de usuario. Bloque: datos personales
	if( isset( $_POST["mod_usuario"] ) ){
		include( "bd.php" );
		$usuario["id"] 			= $_POST["idUsuario"];
		$usuario["usuario"] 	= $_POST["usuario"];
		$usuario["nombre"] 		= $_POST["nombre"];
		
		$res["exito"] = modificarDatosUsuario( $usuario, $dbh );
		
		if( $res["exito"] == 1 )
			$res["mje"] = "Datos de usuario modificados con éxito";
		else
			$res["mje"] = "Error al modificar datos de usuario";
		
		echo json_encode( $res );
	}
	/* ----------------------------------------------------------------------------------- */
	//Modificar datos de usuario. Bloque: contraseña (asinc)
	if( isset( $_POST["mod_passw"] ) ){
		
		include("bd.php");
		$usuario["id"] 		= $_POST["idUsuario"];
		$usuario["password"] 	= $_POST["password1"];
		
		$res["exito"] = modificarPassword( $usuario, $dbh );
		
		if( $res["exito"] == 1 )
			$res["mje"] = "Contraseña actualizada con éxito";
		else
			$res["mje"] = "Error al actualizar contraseña";
		
		echo json_encode( $res );	
	}
	/* ----------------------------------------------------------------------------------- */
?>