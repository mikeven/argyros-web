<?php 
	/* Argyros - Funciones producto */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	function imgProductoPpal( $detalle ){
		$img = $detalle[0]["images"][0];
		return $img["path"];
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
		$is_p = false; $is_pd = true;
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