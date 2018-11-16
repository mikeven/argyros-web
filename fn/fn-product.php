<?php 
	/* Argyros - Funciones producto */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	function imgProductoPpal( $detalle ){
		$path = NULL;
		if( isset( $detalle[0]["images"][0] ) ){
			$img = $detalle[0]["images"][0];
			$path = $img["path"];
		}
		return ;
	}
	/* ----------------------------------------------------------------------------------- */
	function imgProductoDetalle( $detalle, $iddet ){
		//Devuelve la primera imagen del detalle de un producto dado id de detalle
		$path = NULL;

		foreach ( $detalle as $rd ) {
			if( $rd["id"] == $iddet ){
				if( isset( $rd["images"][0] ) ){
					$img = $rd["images"][0];
					$path = $img["path"];
				}
			}
		}
		return $path;
	}
	/* ----------------------------------------------------------------------------------- */
	function precioProductoPpal( $detalle ){
		$d = $detalle[0];
		$pre = "";
		if( $d["tipo_precio"] != "g" ) $pre = $d["precio"];

		return $pre;
	}
	/* ----------------------------------------------------------------------------------- */
	function imgsDetFichaProducto( $detalle ){
		$imgs = array();
		foreach ( $detalle as $d ) {
			$imgs[] = $d["images"][0];	//Primera imagen de cada registro de detalle		
		}

		return $imgs;
	}
	/* ----------------------------------------------------------------------------------- */
	function productosRelacionados( $dbh, $idc ){
		//Obtiene los productos pertenecientes a las subcategorías del producto visto
		$relacionados = array();

		$lprods = obtenerProductosC_( $dbh, $idc );
		foreach ( $lprods as $prod ){
			//Recorrido por los productos obtenidos
			$detalle = obtenerDetalleProductoPorId( $dbh, $prod["id"] );
			if( count( $detalle ) > 0 )	//Posee al menos un registro de detalle
				foreach ( $detalle as $reg_d ) {
					//Recorrido por cada registro de detalle de producto
					$imagenes = obtenerImagenesDetalleProducto( $dbh, $reg_d["id"], "" );
					if( count( $imagenes ) > 0 ){
						//Posee al menos una imagen, producto válido
						$relacionados[] = $prod;
						break; //Interrupción del recorrido de los detalles
					}
				}
		}

		return $relacionados;
	}
	/* ----------------------------------------------------------------------------------- */
	function productosJuego( $dbh, $pid, $detalle_p ){
		//Obtiene los productos pertenecientes al juego al que pertenece el producto actual, 
		//agrupado por detalle

		$productos_juego = array();		

		foreach ( $detalle_p as $rdet ) {
			
			$relacionados_j = array();
			$detalles_juego_p = obtenerProductosJuegosProducto( $dbh, $rdet["id"] );
			$rdet_j["id_dp"] = $rdet["id"];
			
			foreach ( $detalles_juego_p as $reg_d ) {
				//Recorrido por cada registro de detalle de producto del juego
				$imagenes = obtenerImagenesDetalleProducto( $dbh, $reg_d["idd"], "" );
				if( count( $imagenes ) > 0 ){
					//Posee al menos una imagen, producto válido
					$relacionados_j[] = $reg_d;
				}
			}
			$rdet_j["juego_detalle"] = $relacionados_j;
			$productos_juego[] = $rdet_j;
		}

		return $productos_juego;
	}
	/* ----------------------------------------------------------------------------------- */
	function mostrarDataProducto( $datos ){
		//
		$bloque = "";
		$numItems = count( $datos );
		$i = 0;
		foreach ( $datos as $d ) {
			$sep = ",";
			if( ++$i === $numItems ) $sep = "";
			$bloque .= "<div class='item-info-p'>".$d["nombre"]. $sep ."</div>";
		}

		return $bloque;
	}
	/* ----------------------------------------------------------------------------------- */
	if( isset( $_GET["id"] ) && isset( $_SESSION["login"] ) ){

		$pid = $_GET["id"];
		$is_p = false; $is_pd = true; $det_dsp = true;
		$data_producto = obtenerProductoPorId( $dbh, $pid );
		
		if( $data_producto["data"] ){
			$is_p = true;
			$producto = $data_producto["data"];
			$ls_subc_prod = obtenerListaSubCategoriasCategoria( $dbh, $producto["idc"] );
				
				$detalle = $data_producto["detalle"];
				$producto["lineas"] = obtenerLineasDeProductoPorId( $dbh, $pid );
				$producto["trabajos"] = obtenerTrabajosDeProductoPorId( $dbh, $pid );
				
				if( $detalle ){
					//Primera imagen del primer registro de detalle
					$img_pp = imgProductoPpal( $detalle ); 
					//Precio del primero registro de detalle
					$pre_pp = precioProductoPpal( $detalle );
					if( isset( $_GET["iddet"] ) ){
						$img_pp = imgProductoDetalle( $detalle, $_GET["iddet"] );
						if( !tieneTallasDisponiblesDetalleProducto( $dbh, $_GET["iddet"] ) ) 
							$det_dsp = false;
					}
					$productos_juegos = productosJuego( $dbh, $pid, $detalle );
				}
				else
					$is_pd = false;

			$productos_relacionados = productosRelacionados( $dbh, $producto["idc"] );
			
		}
		
	}

	//$purl = "../../argyros/trunk/admin_/"; //Localhost
	$purl = "admin/"; // Server
	
	/* ----------------------------------------------------------------------------------- */
?>