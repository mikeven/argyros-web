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
	function imgsDetFichaProducto( $detalle ){
		$imgs = array();
		foreach ( $detalle as $d ) {
			$imgs[] = $d["images"][0];	//Primera imagen de cada registro de detalle		
		}

		return $imgs;
	}
	/* ----------------------------------------------------------------------------------- */
	if( isset( $_GET["id"] ) ){
		$pid = $_GET["id"];
		$is_p = false; $is_pd = true;
		$data_producto = obtenerProductoPorId( $dbh, $pid );
		if( $data_producto["data"] ){
			$is_p = true;
			$producto = $data_producto["data"];
			$detalle = $data_producto["detalle"];
			$ls_subc_prod = obtenerListaSubCategoriasCategoria( $dbh, $producto["idc"] );
			if( $detalle ) 
				$img_pp = imgProductoPpal( $detalle ); //Primera imagen del primer registro de detalle
			else
				$is_pd = false;
		}
		
	} else{

	}

	//$purl = "../argyros/trunk/admin_/"; //Localhost
	$purl = "admin/"; // Server
	
	/* ----------------------------------------------------------------------------------- */
?>