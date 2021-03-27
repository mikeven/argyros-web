<?php 
	/* Argyros - Funciones producto */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	function registroDetalleProducto( $detalle, $iddet ){
		//Devuelve el registro de detalle actual(cargado en la ficha) de un producto dado id de detalle
		$reg_detalle = NULL;

		foreach ( $detalle as $reg ) {
			if( $reg["id"] == $iddet ){
				$reg_detalle = $reg; break;
			}
		}
		return $reg_detalle;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerPrimerIdDetalleDisponible( $detalle ){
		// Devuelve el primer registro de detalle disponible del producto
		$registro = $detalle[0]["id"];

		foreach ( $detalle as $rdet ) {
			if( $rdet["available"] ){
				$registro = $rdet; break;
			}
		}
		
		return $registro["id"];
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerModelosProductos( $detalle ){
		// Devuelve los modelos de un producto ( registro de detalles ) ordenados por disponibilidad
		$disponibles = array();
		$agotados = array();
		foreach ( $detalle as $rdet ) {
			if( $rdet["available"] )
				$disponibles[] 	= $rdet;
			else 
				$agotados[]		= $rdet;
		}
		return array_merge( $disponibles, $agotados );
	}
	/* ----------------------------------------------------------------------------------- */
	function imgProductoPpal( $images ){
		//Devuelve la primera imagen del detalle del producto
		$path = NULL;

		if( isset( $detalle[0]["images"][0] ) ){
			$img = $detalle[0]["images"][0];
			$path = $img["path"];
		}
		return $path;
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
		// Devuelve el precio de la primera talla del detalle de producto
		$talla_inicial 	= $detalle["sizes"][0];
		
		return $talla_inicial["precio"];
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
	function productosRelacionados( $dbh, $producto ){
		//Obtiene los productos pertenecientes a las subcategorías del producto visto
		$relacionados 				= array();
		$idc 						= $producto["idc"];
		$idsc 						= $producto["idsc"];
		$idprov1 					= $producto["idpvd1"];
		$lprods 					= obtenerProductosC_SRand( $dbh, $idc, $idsc, $idprov1 );
		$idp_ant 					= "";
		
		foreach ( $lprods as $prod ){
			if( tieneTallasVisiblesProductoDetalle( $dbh, $prod["iddet"] ) ) 
				$relacionados[] 	= $prod;
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
	function obtenerProductosJuego( $dbh, $iddet ){
		//Obtiene los detalles de productos pertenecientes al juego al que pertenece el producto actual

		$productos_juego = array();		

		$productos = obtenerProductosJuegosProducto( $dbh, $iddet );
		
		return $productos;
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
	function obtenerReferenciaPorDesuso( $dbh, $idref ){
		// Devuelve el producto referencia de un producto en desuso
		$prod_referencia			= obtenerRegistroDetalleProductoPorId( $dbh, $idref );
		$imagen 					= obtenerImagenesDetalleProducto( $dbh, $idref, 1 );
		$prod_referencia["imagen"] 	= $imagen[0]["path"];
		
		return $prod_referencia;
	}
	/* ----------------------------------------------------------------------------------- */
	if( isset( $_GET["id"] ) && isset( $_SESSION["login"] ) ){

		$pid = $_GET["id"];
		$is_p = false; $is_pd = true; $det_dsp = true;
		$data_producto 						= obtenerProductoPorId( $dbh, $pid );
		

		if( $data_producto["data"] ){
			$is_p = true;
			$producto 						= $data_producto["data"];
			$proveedor1						= obtenerProveedorPorId( $dbh, $producto["idpvd1"] );
			$ls_subc_prod 					= obtenerListaSubCategoriasCategoria( $dbh, $producto["idc"] );
				
				$detalle 					= $data_producto["detalle"];
				$producto["lineas"] 		= obtenerLineasDeProductoPorId( $dbh, $pid );
				$producto["trabajos"] 		= obtenerTrabajosDeProductoPorId( $dbh, $pid );
				
				if( $detalle ){
					$prod_ref 				= NULL;
					$modelos_productos		= obtenerModelosProductos( $detalle );
					
					if( isset( $_GET["iddet"] ) ){

						$detalle_producto	= registroDetalleProducto( $detalle, $_GET["iddet"] );

						$imgs_detalle 		= $detalle_producto["images"];
						$img_pp 			= $imgs_detalle[0]["path"];
						$pre_pp 			= precioProductoPpal( $detalle_producto );
						
						if( !$detalle_producto["available"] ) 
							$det_dsp 		= false;			// Indicador de producto sin tallas disponibles

						if( $detalle_producto["desuso"] && $detalle_producto["ref_id"] != "" ){
							// Producto de referencia por producto en desuso 
							$prod_ref 		= obtenerReferenciaPorDesuso( $dbh, $detalle_producto["ref_id"] );
							
							/*if( !$detalle_producto["sustituto"] ){ 
								// Producto duplicado, se redirecciona a su referencia
								$lnk = "product.php?id=$prod_ref[pid]&iddet=$prod_ref[id]";
								echo "<script> window.location = '$lnk'</script>";
							}*/
						}
					
					}else{
						$iddet 				= obtenerPrimerIdDetalleDisponible( $detalle );
						echo "<script> window.location = 'product.php?id=$pid&iddet=$iddet'</script>";
					}

					$productos_juegos 		= obtenerProductosJuego( $dbh, $_GET["iddet"] );
				}
				else
					$is_pd = false;

			$productos_relacionados 		= productosRelacionados( $dbh, $producto );
		}	
		
	}

	//$purl = "../../argyros/trunk/admin_/"; //Localhost
	$purl = "admin/"; // Server
	
	/* ----------------------------------------------------------------------------------- */
?>