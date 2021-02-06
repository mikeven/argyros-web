<?php
	/* ----------------------------------------------------------------------------------- */
	/* Argyros - Funciones de productos */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	
	/* ----------------------------------------------------------------------------------- */
	function obtenerDatosProductoPorId( $dbh, $pid ){
		//Obtiene los datos de un producto dado su id
		$q = "select p.id, p.code, p.name, p.description, p.visible as visible, co.name as pais, 
		ca.id as idc, ca.name as category, sc.id as idsc, sc.name as subcategory, 
		ca.uname as uname_c, sc.uname as uname_s, m.name as material, p.provider_id1 as idpvd1, 
		p.manfact_code1 as codigof1, p.manfact_code2 as codigof2, p.manfact_code3 as codigof3,   
		timestampdiff(day, p.created_at, curdate()) as d_antiguedad  
		FROM products p, categories ca, subcategories sc, countries co, materials m 
		where p.category_id = ca.id and p.subcategory_id = sc.id and p.material_id = m.id 
		and p.country_id = co.id and p.id = $pid";

		$data = mysqli_query( $dbh, $q );
		if( $data )
			return mysqli_fetch_array( $data );	
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerUltimoProductoCategoria( $dbh, $idc ){
		//Obtiene los datos de un producto dado su id
		$q = "select p.id, p.code, p.name, p.description, p.visible as visible 
		from products p, product_details dp, categories ca, subcategories sc, countries co, materials m 
		where dp.product_id = p.id and p.category_id = ca.id and p.subcategory_id = sc.id and p.material_id = m.id 
		and p.country_id = co.id and ca.id = $idc and p.visible = 1 
		and p.id in (select product_id from product_details) 
		order by dp.repositioned_at desc, dp.created_at desc limit 1";

		$data = mysqli_query( $dbh, $q );
		if( $data )
			return mysqli_fetch_array( $data );
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerImagenesDetalleProducto( $dbh, $idd, $limite ){
		//Devuelve los registros de imágenes de detalle de producto, cantidad de registros limitado
		//por parámetro.
		$l = "";
		if( $limite != NULL ) $l = "LIMIT $limite";
		
		$q = "select id, path from images where product_detail_id = $idd $l";

		$data = mysqli_query( $dbh, $q );
		$lista = obtenerListaRegistros( $data );
		return $lista;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerDetalleProductoDisponible( $detalle ){
		//Devuelve el registro de detalle con al menos una talla disponible
		$reg_det = NULL;
		foreach ( $detalle as $regd ) {

			/*$disp = true; $t_exist = false;
			$tallas = $regd["sizes"];
			foreach ( $tallas as $regt ) {
				$t_exist = true;
				if( $regt["visible"] != 1 ) $disp = false;
			}
			if( $t_exist && $disp ) return $regd;*/
			if( $regd["available"] ){ 
				$reg_det = $regd; break;
			}
		}
		return $reg_det;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerDetalleProducto( $dbh, $pid ){
		//Devuelve los registros detalles asociados a un producto dado su id
		/*$q = "select dp.id as id, c.name as color, t.name as bano, dp.price_type as tipo_precio, 
		dp.weight as peso, dp.piece_price_value as precio_pieza, dp.manufacture_value as precio_mo, 
		dp.weight_price_value as precio_peso FROM product_details dp, treatments t, colors c 
		where dp.color_id = c.id and dp.treatment_id = t.id and dp.product_id = $pid";*/

		$q = "select dp.id as id, c.name as color, t.name as bano, dp.price_type as tipo_precio, 
		dp.piece_price_value as precio_pieza, dp.manufacture_value as precio_mo, 
		dp.weight_price_value as precio_peso FROM product_details dp
		LEFT JOIN treatments t ON t.id = dp.treatment_id LEFT JOIN colors c ON dp.color_id = c.id 
		WHERE dp.product_id = $pid";

		$data = mysqli_query( $dbh, $q );
		$lista = obtenerListaRegistros( $data );
		return $lista;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerDetalleProductoPorIdDetalle( $dbh, $iddet ){
		//Devuelve el registro de detalle dado su id
		
		$q = "select dp.id as iddet, dp.price_type as tipo_precio, dp.piece_price_value as precio_pieza, 
		dp.manufacture_value as precio_mo, dp.weight_price_value as precio_peso 
		FROM product_details dp WHERE dp.id = $iddet";
		
		$data = mysqli_query( $dbh, $q );
		if( $data )
			return mysqli_fetch_array( $data );
	}
	/* ----------------------------------------------------------------------------------- */
	function productoTieneDetalle( $dbh, $idp ){
		//Devuelve verdadero si un producto posee registros de detalle
		$tiene_detalle = false; 
		$detalle = obtenerDetalleProducto( $dbh, $idp );
		if( count( $detalle ) > 0 ) $tiene_detalle = true;

		return $tiene_detalle;
	}
	/* ----------------------------------------------------------------------------------- */
	function productoTieneDetalleVisible( $dbh, $idp ){
		//Devuelve verdadero si un producto posee registros de detalle visibles
		$tiene_detalle_visible = false;

		$detalle = obtenerDetalleProducto( $dbh, $idp );
		foreach ( $detalle as $det ) {
			$tallas = obtenerTallasDetalleProducto( $dbh, $det["id"] );
			foreach ( $tallas as $t ) {
				if( $t["visible"] == 1 ) 
					$tiene_detalle_visible = true;
			}
		}

		return $tiene_detalle_visible;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerPrecioPorPeso( $peso, $precio_gramo ){
		//Devuelve el precio del producto por peso
		$precio = $peso * $precio_gramo;
		return number_format( $precio, 2, ".", "" );
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerPrecioPorGramo( $var, $precio_gramo ){
		//Devuelve el valor del precio del gramo de acuerdo al perfil de cliente
		$precio = $precio_gramo * $var["variable_b"];
		
		return number_format( $precio, 2, ".", "" );	
	}

	function obtenerPrecioPorPieza( $var, $precio_pieza ){
		//Devuelve el precio del producto por pieza
		$precio = $precio_pieza * ( $var["variable_a"] );

		return number_format( $precio, 2, ".", "" );
	}

	function obtenerPrecioPorManoObra( $var, $peso, $precio_mo ){
		//Devuelve el precio del producto por mano de obra
		$precio = ( $precio_mo * ( $var["variable_c"] ) + $var["material"] ) 
					* $peso * ( $var["variable_d"] );
		
		return number_format( $precio, 2, ".", "" );
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerPreciosPorPesoTalla( $dbh, $rdetalle ){
		//Devuelve el valor del precio asociado de acuerdo al perfil del cliente y tipo de precio 
		$ntallas = array();
		$tallas = $rdetalle["sizes"];
		
		foreach ( $tallas as $t ) {

			if( $rdetalle["tipo_precio"] == "g" || $rdetalle["tipo_precio"] == "mo" )
				$t["precio"] = obtenerPrecioPorPeso( $t["peso"], $rdetalle["precio"] );
			
			if( $rdetalle["tipo_precio"] == "p" ) $t["precio"] = $rdetalle["precio"];
			
			$ntallas[] = $t;			
		}

		return $ntallas;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerPesoProductoTalla( $dbh, $idd ){
		//Devuelve el peso del producto asociado a su talla
		$q = "select weight as peso from size_product_detail where product_detail_id = $idd";
		$rs = mysqli_query( $dbh, $q );
		$data = mysqli_fetch_array( $rs );
		
		return $data["peso"];
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerPesoProducto( $dbh, $reg_detalle ){
		//Devuelve el peso del producto por su valor directo o asociado a la talla
		$peso = $reg_detalle["peso"];
		$peso_talla = obtenerPesoProductoTalla( $dbh, $reg_detalle["id"] );
		if( $peso_talla )
			$peso = $peso_talla;
		
		return $peso;
	}
	/* ----------------------------------------------------------------------------------- */
	function cargarPreciosDetalle( $dbh, $detalle ){
		//Devuelve los precios por pieza o peso de cada registro de detalle de producto,  
		//asociado al perfil de usuario y tipos de precio.
		$ndetalle = array();
		$var_gr_u = variablesGrupoUsuario( $dbh );

		foreach ( $detalle as $det ) {

			if( $det["tipo_precio"] == "p" )
				$det["precio"] = obtenerPrecioPorPieza( $var_gr_u, $det["precio_pieza"] );
			
			if( $det["tipo_precio"] == "g" ){
				$det["precio_peso"] = obtenerPrecioPorGramo( $var_gr_u, $det["precio_peso"] );
				$det["precio"] = $det["precio_peso"];
			}

			if( $det["tipo_precio"] == "mo" ){
				$det["precio_mo"] = obtenerPrecioPorManoObra( $var_gr_u, 1, $det["precio_mo"] );
				$det["precio"] = $det["precio_mo"];
			}
			
			$ndetalle[] = $det;
		}
		
		return $ndetalle;
	}
	/* ----------------------------------------------------------------------------------- */
	function preciosDetalle( $dbh, $detalle ){
		//Devuelve los precios por pieza o peso de un registro de detalle de producto,  
		//asociado al perfil de usuario y tipos de precio.
		$var_gr_u = variablesGrupoUsuario( $dbh );

		if( $detalle["tipo_precio"] == "p" )
			$detalle["precio"] 		= obtenerPrecioPorPieza( $var_gr_u, $detalle["precio_pieza"] );
		
		if( $detalle["tipo_precio"] == "g" ){
			$detalle["precio_peso"] = obtenerPrecioPorGramo( $var_gr_u, $detalle["precio_peso"] );
			$detalle["precio"] 		= $detalle["precio_peso"];
		}

		if( $detalle["tipo_precio"] == "mo" ){
			$detalle["precio_mo"] 	= obtenerPrecioPorManoObra( $var_gr_u, 1, $detalle["precio_mo"] );
			$detalle["precio"] 		= $detalle["precio_mo"];
		}
		
		return $detalle;
	}
	/* ----------------------------------------------------------------------------------- */
	function cargarImagenesDetalle( $dbh, $detalle ){
		//Devuelve las imagenes de cada registro de detalle de producto
		$ndetalle = array();
		foreach ( $detalle as $det ) {
			$det["images"] = obtenerImagenesDetalleProducto( $dbh, $det["id"], NULL );
			$ndetalle[] = $det;
		}
		return $ndetalle;
	}
	/* ----------------------------------------------------------------------------------- */
	function imagenesDetalle( $dbh, $detalle ){
		//Devuelve las imagenes de un registro de detalle de producto
		
		$detalle["images"] = obtenerImagenesDetalleProducto( $dbh, $detalle["iddet"], NULL );
		
		return $detalle;
	}
	/* ----------------------------------------------------------------------------------- */
	function cargarTallasDetalle( $dbh, $detalle ){
		//Devuelve las tallas de cada registro de detalle de producto
		$ndetalle = array();
		$var_gr_usuario = variablesGrupoUsuario( $dbh );

		foreach ( $detalle as $det ){
			$det["sizes"] 		= obtenerTodasTallasDetalleProducto( $dbh, $det["id"] );
			$det["sizes"] 		= obtenerPreciosPorPesoTalla( $dbh, $det );
			$det["available"]	= tieneTallasDisponiblesDetalleProducto( $dbh, $det["id"] );
			$ndetalle[] 		= $det;
		}
		
		return $ndetalle;
	}
	/* ----------------------------------------------------------------------------------- */
	function tallasDetalle( $dbh, $detalle ){
		//Devuelve las tallas de un registro de detalle de producto
		$var_gr_usuario 		= variablesGrupoUsuario( $dbh );

		$detalle["sizes"] 		= obtenerTodasTallasDetalleProducto( $dbh, $detalle["iddet"] );
		$detalle["sizes"] 		= obtenerPreciosPorPesoTalla( $dbh, $detalle );
		$detalle["available"]	= tieneTallasDisponiblesDetalleProducto( $dbh, $detalle["iddet"] );
		
		return $detalle;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerProductoPorId( $dbh, $pid ){
		//Devuelve los datos de producto, registros de detalle e imágenes registradas 
		$producto["data"] = obtenerDatosProductoPorId( $dbh, $pid );

		if( $producto["data"] ){
			$producto["detalle"] = obtenerDetalleProductoPorId( $dbh, $pid );
			$producto["detalle"] = cargarPreciosDetalle( $dbh, $producto["detalle"] );
			$producto["detalle"] = cargarImagenesDetalle( $dbh, $producto["detalle"] );
			$producto["detalle"] = cargarTallasDetalle( $dbh, $producto["detalle"] );
		}

		return $producto;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerItemCatalogo( $dbh, $producto ){
		//Devuelve los datos de producto, registros de detalle e imágenes registradas 
		
		$producto 			= preciosDetalle( $dbh, $producto );
		$producto 			= imagenesDetalle( $dbh, $producto );
		$producto 			= tallasDetalle( $dbh, $producto );

		return $producto;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerProductosC_S( $dbh, $idc, $idsc ){
		//Devuelve la lista de productos pertenecientes a una categoría y subcategoría
		$q = "select p.id, p.code, p.name, p.description, p.visible as visible, co.name as pais, 
		ca.name as category, sc.name as subcategory, m.name as material 
		FROM products p, categories ca, subcategories sc, countries co, materials m 
		where p.visible = 1 and p.category_id = ca.id and p.subcategory_id = sc.id and 
		p.material_id = m.id and p.country_id = co.id and p.category_id = $idc 
		and p.subcategory_id = $idsc order by p.id DESC";
		
		$data = mysqli_query( $dbh, $q );
		$lista = obtenerListaRegistros( $data );
		return $lista;	
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerProductosC_SRand( $dbh, $idc, $idsc ){
		//Devuelve la lista aleatoria de productos pertenecientes a una categoría y subcategoría
		/*$q = "select p.id, p.code, p.name, p.description, p.visible as visible, co.name as pais, 
		ca.name as category, sc.name as subcategory, m.name as material 
		FROM products p, categories ca, subcategories sc, countries co, materials m 
		where p.visible = 1 and p.category_id = ca.id and p.subcategory_id = sc.id and 
		p.material_id = m.id and p.country_id = co.id and p.category_id = $idc 
		and p.subcategory_id = $idsc order by rand() LIMIT 10";*/

		$q = "select p.id as idp, p.name, p.description, ca.id as idc, ca.name as categoria, dp.id as iddet, 
		timestampdiff(day, dp.created_at, curdate()) as d_antiguedad, 
		timestampdiff(day, dp.repositioned_at, curdate()) as d_reposicion 
		FROM products p, categories ca, subcategories sc, product_details dp 
		WHERE dp.product_id = p.id and p.category_id = ca.id and p.subcategory_id = sc.id 
		and sc.category_id = ca.id and sc.id = $idsc and ca.id = $idc 
		order by dp.repositioned_at DESC, rand() DESC, dp.created_at DESC LIMIT 15";
		
		$data = mysqli_query( $dbh, $q );
		$lista = obtenerListaRegistros( $data );
		return $lista;	
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerProductosC_( $dbh, $idc ){
		//Devuelve la lista de productos pertenecientes a una categoría
		$q = "select p.id, p.code, p.name, p.description, p.visible as visible, co.name as pais, 
		ca.name as category, m.name as material 
		FROM products p, categories ca, countries co, materials m 
		where p.visible = 1 and p.category_id = ca.id and p.material_id = m.id 
		and p.country_id = co.id and p.category_id = $idc order by p.id DESC";
		
		$data = mysqli_query( $dbh, $q );
		$lista = obtenerListaRegistros( $data );
		return $lista;	
	}
	/* ----------------------------------------------------------------------------------- */
	function productosIdsProducto( $dbh, $idp, $iddet, $flt_dsu ){
		// Catálogo: Devuelve la lista de productos a nivel de detalle dado el id del producto y detalle (si es indicado)
		if( $iddet != NULL )
			$cond = "and dp.id = $iddet"; else $cond = "";
		if( $flt_dsu == true ) 
			$cond_dsu = "and dp.disused is null"; else $cond_dsu = "";

		$q = "select p.id as idp, p.code, p.name, p.description, co.name as pais, ca.id as idc,  
		ca.name as categoria, m.name as material, dp.id as iddet, dp.color_id as id_color, c.name as color, 
		c.uname as ucolor, dp.treatment_id as id_bano, t.name as bano, t.uname as ubano, dp.price_type as tipo_precio, 
		dp.piece_price_value as precio_pieza, dp.manufacture_value as precio_mo, dp.weight_price_value as precio_peso, 
		timestampdiff(day, dp.created_at, curdate()) as d_antiguedad, 
		timestampdiff(day, dp.repositioned_at, curdate()) as d_reposicion 
		FROM products p, categories ca, countries co, materials m, product_details dp 
		LEFT JOIN treatments t ON t.id = dp.treatment_id LEFT JOIN colors c ON dp.color_id = c.id 
		WHERE p.country_id = co.id and p.material_id = m.id and dp.product_id = p.id and p.category_id = ca.id 
		$cond_dsu and p.id = $idp $cond order by dp.id DESC";
		
		$data = mysqli_query( $dbh, $q );
		$lista = obtenerListaRegistros( $data );
		return $lista;	
	}
	/* ----------------------------------------------------------------------------------- */
	function productosCategoriaSubcategoria( $dbh, $idc, $idsc ){
		// Catálogo: Devuelve la lista de productos a nivel de detalle pertenecientes a una categoría y subcategoría

		$q = "select p.id as idp, p.code, p.name, p.description, co.name as pais, ca.id as idc,  
		ca.name as categoria, m.name as material, dp.id as iddet, dp.color_id as id_color, c.name as color, 
		c.uname as ucolor, dp.treatment_id as id_bano, t.name as bano, t.uname as ubano, dp.price_type as tipo_precio, 
		dp.piece_price_value as precio_pieza, dp.manufacture_value as precio_mo, dp.weight_price_value as precio_peso, 
		timestampdiff(day, dp.created_at, curdate()) as d_antiguedad, 
		timestampdiff(day, dp.repositioned_at, curdate()) as d_reposicion 
		FROM products p, categories ca, subcategories sc, countries co, materials m, product_details dp 
		LEFT JOIN treatments t ON t.id = dp.treatment_id LEFT JOIN colors c ON dp.color_id = c.id 
		WHERE p.country_id = co.id and p.material_id = m.id and dp.product_id = p.id and p.category_id = ca.id 
		and p.subcategory_id = sc.id and sc.category_id = ca.id and sc.id = $idsc and ca.id = $idc 
		and dp.disused is null order by dp.repositioned_at DESC, dp.created_at DESC";
		
		$data = mysqli_query( $dbh, $q );
		$lista = obtenerListaRegistros( $data );
		return $lista;	
	}
	/* ----------------------------------------------------------------------------------- */
	function productosCategoria( $dbh, $idc ){
		// Catálogo: Devuelve la lista de productos pertenecientes a una categoría
		
		$q = "select p.id as idp, p.code, p.name, p.description, co.name as pais, ca.id as idc,  
		ca.name as categoria, m.name as material, dp.id as iddet, dp.color_id as id_color, c.name as color, 
		c.uname as ucolor, dp.treatment_id as id_bano, t.name as bano, t.uname as ubano, 
		dp.price_type as tipo_precio, dp.piece_price_value as precio_pieza, dp.manufacture_value as precio_mo, 
		dp.weight_price_value as precio_peso, timestampdiff(day, dp.created_at, curdate()) as d_antiguedad, 
		timestampdiff(day, dp.repositioned_at, curdate()) as d_reposicion 
		FROM products p, categories ca, countries co, materials m, 
		product_details dp LEFT JOIN treatments t ON t.id = dp.treatment_id 
		LEFT JOIN colors c ON dp.color_id = c.id WHERE p.country_id = co.id and p.material_id = m.id 
		and dp.product_id = p.id and p.category_id = ca.id and p.category_id = $idc and dp.disused is null 
		order by dp.repositioned_at DESC, dp.created_at DESC";
		
		$data = mysqli_query( $dbh, $q );
		$lista = obtenerListaRegistros( $data );
		return $lista;	
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerImagenProducto( $dbh, $id ){
		//Devuelve las imágenes de un producto dado su id
		$q = "select i.path as image FROM images i, product_details d 
		where i.product_detail_id = d.id and d.product_id = $id";

		$data = mysqli_query( $dbh, $q );
		$lista = obtenerListaRegistros( $data );
		return $lista;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerImagenProductoDetalle( $dbh, $idd ){
		//Devuelve las imágenes de un producto dado su id
		$q = "select i.path as image FROM images i, product_details d 
		where i.product_detail_id = $idd";

		$data = mysqli_query( $dbh, $q );
		$lista = obtenerListaRegistros( $data );
		return $lista;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerImagenProductoCatalogoDetalle( $dbh, $idp, $iddp ){
		//Devuelve las imágenes de un producto dado su id e id de detalle 
		$q = "select i.path as image FROM images i, product_details d 
		where i.product_detail_id = d.id and d.product_id = $idp and d.id = $iddp";
		
		$data = mysqli_query( $dbh, $q );
		$lista = obtenerListaRegistros( $data );
		return $lista;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerImagenDetalleProductoDisponible( $dbh, $producto ){
		//Devuelve las imágenes de un producto cuyo detalle esté disponible
		$detalle_dsp = obtenerDetalleProductoDisponible( $producto["detalle"] );
		$reg_p = $producto["data"];
		
		$imgs = obtenerImagenProductoCatalogoDetalle( $dbh, $reg_p["id"], $detalle_dsp["id"] );

		return $imgs;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerImagenProductoCatalogo( $dbh, $idp, $iddp, $producto ){
		//Devuelve la primera imagen de un producto

		if( $iddp != "" ) 
			return obtenerImagenProductoCatalogoDetalle( $dbh, $idp, $iddp );
		else
			return obtenerImagenDetalleProductoDisponible( $dbh, $producto );
	}
	/* ----------------------------------------------------------------------------------- */
	function codigoDisponible( $dbh, $codigo ){
		//Devuelve si un código de producto ya está registrado
		$disp = 1;
		$q = "select * from products where code = '$codigo'";

		$datap = mysqli_query ( $dbh, $q );
		$nrows = mysqli_num_rows( $datap );
		
		if( $nrows > 0 ){
			$disp = 0;
		}
		return $disp;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerLineasDeProductoPorId( $dbh, $idp ){
		//Devuelve los datos de las líneas a las que pertenece un producto
		$q = "select l.id as idlinea, l.name as nombre, l.uname as ulinea, l.description as descripcion 
		from plines l, line_product lp where lp.line_id = l.id and lp.product_id = $idp order by nombre ASC";
		
		$data = mysqli_query( $dbh, $q );
		$lista = obtenerListaRegistros( $data );
		return $lista;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerTrabajosDeProductoPorId( $dbh, $idp ){
		//Devuelve los datos de las líneas a las que pertenece un producto
		$q = "select t.id as idtrabajo, t.name as nombre, t.uname as utrabajo 
		from makings t, making_product tp where tp.making_id = t.id and tp.product_id = $idp 
		order by t.name ASC";
		
		$data = mysqli_query( $dbh, $q );
		$lista = obtenerListaRegistros( $data );
		return $lista;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerDetalleProductoPorId( $dbh, $idp ){
		//Devuelve los registros detalles asociados a un producto dado su id
		
		$q = "select dp.id as id, dp.color_id as id_color, c.name as color, c.uname as ucolor, 
		dp.treatment_id as id_bano, t.name as bano, t.uname as ubano, product_id as pid,  
		dp.price_type as tipo_precio, dp.piece_price_value as precio_pieza, dp.disused as desuso, 
		dp.reference_id as ref_id, manufacture_value as precio_mo, dp.weight_price_value as precio_peso 
		FROM product_details dp LEFT JOIN treatments t ON t.id = dp.treatment_id 
		LEFT JOIN colors c ON dp.color_id = c.id WHERE dp.product_id = $idp order by dp.id ASC";

		/*$q = "select dp.id as id, dp.color_id as id_color, c.name as color, c.uname as ucolor, 
		dp.treatment_id as id_bano, t.name as bano, t.uname as ubano, 
		dp.price_type as tipo_precio, dp.weight as peso, dp.piece_price_value as precio_pieza, 
		manufacture_value as precio_mo, dp.weight_price_value as precio_peso 
		FROM product_details dp, treatments t, colors c where dp.color_id = c.id and 
		dp.treatment_id = t.id and dp.product_id = $idp order by dp.id ASC";*/

		
		$data = mysqli_query( $dbh, $q );
		$lista = obtenerListaRegistros( $data );
		return $lista;		
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerRegistroDetalleProductoPorId( $dbh, $idd ){
		//Devuelve un registro de detalle de producto dado su id
		$q = "select dp.id as id, c.id as color, t.id as bano, dp.price_type as tipo_precio, 
		dp.piece_price_value as precio_pieza, dp.manufacture_value as precio_mo, 
		dp.product_id as pid, dp.weight_price_value as precio_peso 
		FROM product_details dp LEFT JOIN treatments t ON t.id = dp.treatment_id 
		LEFT JOIN colors c ON dp.color_id = c.id WHERE dp.id = $idd";

		/*select dp.id as id, c.id as color, t.id as bano, dp.price_type as tipo_precio, 
		dp.weight as peso, dp.piece_price_value as precio_pieza, dp.manufacture_value as precio_mo, 
		dp.product_id as pid, dp.weight_price_value as precio_peso 
		FROM product_details dp, treatments t, colors c 
		where dp.color_id = c.id and dp.treatment_id = t.id and dp.id = $idd*/
		
		$data = mysqli_query( $dbh, $q );
		return mysqli_fetch_array( $data );		
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerImagenDetalleProductoPorId( $dbh, $id_img ){
		//Devuelve el registro de imagen de detalle de producto
		$q = "select id, path from images where id = $id_img";

		$data = mysqli_query( $dbh, $q );
		return mysqli_fetch_array( $data );
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerTodasTallasDetalleProducto( $dbh, $idd ){
		//Devuelve los registros de tallas de detalle de producto, DISPONIBLES Y NO DISPONIBLES
		$q = "select spd.size_id as idtalla, s.name as talla, spd.visible as visible, 
		spd.adjustable as ajustable, convert(s.name, decimal(4,2)) as vsize, s.unit as unidad, 
		spd.weight as peso from size_product_detail spd, sizes s 
		where spd.size_id = s.id and spd.product_detail_id = $idd order by vsize ASC, talla ASC";
		
		$data = mysqli_query( $dbh, $q );
		$lista = obtenerListaRegistros( $data );
		return $lista;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerTallasDetalleProducto( $dbh, $idd ){
		//Devuelve los registros de tallas DISPONIBLES de detalle de producto
		$q = "select spd.size_id as idtalla, s.name as talla, spd.visible as visible, 
		spd.adjustable as ajustable, convert(s.name, decimal(4,2)) as vsize, s.unit as unidad, 
		spd.weight as peso from size_product_detail spd, sizes s 
		where spd.size_id = s.id and spd.product_detail_id = $idd and spd.visible = 1 
		order by vsize ASC, talla ASC";
		
		$data = mysqli_query( $dbh, $q );
		$lista = obtenerListaRegistros( $data );
		return $lista;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerDatosDetalleProductoPorId( $dbh, $idd ){
		//
		$detalle["datos"]		= obtenerRegistroDetalleProductoPorId( $dbh, $idd );
		$detalle["tallas"] 		= obtenerTallasDetalleProducto( $dbh, $idd );
		$detalle["imagenes"] 	= obtenerImagenesDetalleProducto( $dbh, $idd );

		return $detalle;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerTallasPorCategoria( $dbh, $idc ){
		//Devuelve las tallas asociadas a una categoría de producto
		$q = "select id as idtalla, name as talla, unit as unidad, convert(name, decimal(4,2)) as vsize 
		from sizes where category_id = $idc order by vsize ASC";
		
		$data = mysqli_query( $dbh, $q );
		$lista = obtenerListaRegistros( $data );
		return $lista;	
	}
	/* ----------------------------------------------------------------------------------- */
	function existeRegistroTallaDetalle( $dbh, $iddet, $id_talla ){
		//Chequea si existe un registro con valores de talla-detalle
		$existe = false;
		$q = "select * from size_product_detail where size_id = $id_talla and product_detail_id = $iddet";
		$data = mysqli_query( $dbh, $q );
		$nregs = mysqli_num_rows( $data );
		
		if( $nregs > 0 )
			$existe = true;
		
		return $existe;
	}
	/* ----------------------------------------------------------------------------------- */
	function tieneTallasDisponiblesProducto( $dbh, $idp ){
		//Devuelve verdadero si hay registros de tallas disponibles en todos los detalles de un producto
		$disponible = false;

		$detalle = obtenerDetalleProductoPorId( $dbh, $idp );
		foreach ( $detalle as $reg_det ) {
			$tallas_det = obtenerTodasTallasDetalleProducto( $dbh, $reg_det["id"] );
			foreach ( $tallas_det as $t ) {
				if( $t["visible"] == 1 ) $disponible = true;
			}
		}
		return $disponible;
	}
	/* ----------------------------------------------------------------------------------- */
	function tieneTallasDisponiblesDetalleProducto( $dbh, $iddp ){
		//Devuelve verdadero si hay registros de tallas disponibles en un detalles de un producto
		$disponible = false;

		$tallas_det = obtenerTodasTallasDetalleProducto( $dbh, $iddp );
		foreach ( $tallas_det as $t ) {
			if( $t["visible"] == 1 ) $disponible = true;
		}
		return $disponible;
	}
	/* ----------------------------------------------------------------------------------- */
	function actualizarDisponibilidadProductoPorAjuste( $dbh, $idp ){
		//Chequea si todas las tallas de un producto están disponibles, marca como no diponible
		//si no hay alguna talla disponible.
		
		if( tieneTallasDisponiblesProducto( $dbh, $idp ) == false ){
			echo "FALSE";
			actualizarVisibilidadProducto( $dbh, $idp, 0 );
		}else{
			echo "TRUE";
			actualizarVisibilidadProducto( $dbh, $idp, 1 );
		}
	}
	/* ----------------------------------------------------------------------------------- */
	function actualizarVisibilidadProducto( $dbh, $id, $act ){
		//Actualiza la visibilidad de un producto
		$q = "update products set visible = $act where id = $id";
		return mysqli_query( $dbh, $q );
	}
	/* ----------------------------------------------------------------------------------- */
	function actualizarDisponibilidadTallaProducto( $dbh, $iddetprod, $idtalla, $estado ){
		//Actualiza el valor talla-peso de un detalle de producto
		$q = "update size_product_detail set visible = $estado where size_id = $idtalla and 
		product_detail_id = $iddetprod";
		
		$data = mysqli_query( $dbh, $q );
		return $data;
	}
	/* ----------------------------------------------------------------------------------- */
	function actualizarFechaNoDisponibilidad( $dbh, $iddetprod ){
		// Actualiza la fecha de un producto al NO estar disponible
		$q = "update product_details set unavailable_at = NOW() where id = $iddetprod";
		
		$data = mysqli_query( $dbh, $q );
		return $data;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerIdsProductosParametroDirectoProducto( $dbh, $busqueda ){
		//Devuelve los registros de producto que coinciden con la búsqueda en algunos de sus parámetros:

		$q = "select p.id from products p, categories ca, subcategories sc, countries co, materials m 
		where (p.visible = 1 and p.category_id = ca.id and p.subcategory_id = sc.id and 
		p.material_id = m.id and p.country_id = co.id ) and ( lower(p.name) like lower('%$busqueda%') 
		or lower(p.description) like lower('%$busqueda%') or lower(p.code) like lower('%$busqueda%') 
		or lower(m.name) like lower('%$busqueda%') or lower(ca.name) like lower('%$busqueda%') 
		or lower(sc.name) like lower('%$busqueda%') ) order by id DESC";

		$data = mysqli_query( $dbh, $q );
		$lista = obtenerListaRegistros( $data );

		return $lista;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerProductosParametroDetalleProducto( $dbh, $busqueda, $param ){
		//Devuelve los registros de producto que coinciden con la búsqueda en 
		//algunos de sus parámetros en su detalle

		if( $param == "bano" ){
			$q = "select p.id, dp1.id as iddet from products p, product_details dp1 
					where dp1.product_id = p.id and p.id in ( select dp2.product_id from product_details dp2, treatments t 
					where dp2.treatment_id = t.id and lower(t.name) like lower('%$busqueda%') and dp2.id = dp1.id )";
		}
		if( $param == "color" ){
			$q = "select p.id, dp1.id as iddet from products p, product_details dp1 
					where dp1.product_id = p.id and p.id in ( select dp2.product_id from product_details dp2, colors c 
					where dp2.color_id = c.id and lower(c.name) like lower('%$busqueda%') and dp2.id = dp1.id )";
		}
		if( $param == "trabajo" ){
			$q = "select p.id, dp.id as iddet from products p, product_details dp, making_product mp, makings m 
					where dp.product_id = p.id and p.id = mp.product_id and mp.making_id = m.id 
					and lower(m.name) like lower('%$busqueda%')";
		}
		if( $param == "linea" ){

			$q = "select p.id, dp.id as iddet from products p, product_details dp, line_product lp, plines l  
					where dp.product_id = p.id and p.id = lp.product_id and lp.line_id = l.id 
					and lower(l.name) like lower('%$busqueda%') LIMIT 1000";
		}

		if( $param == "codigo" ){
			$q = "select p.id, dp.id as iddet from products p, product_details dp 
					where dp.product_id = p.id and concat( dp.product_id,'-',dp.id ) = '$busqueda'";
		}

		if( $param == "id_producto" ){
			$q = "select p.id, dp.id as iddet from products p, product_details dp 
					where dp.product_id = p.id and concat( '#i', dp.product_id ) = '$busqueda'";
		}

		if( $param == "id_detalle" ){
			$q = "select p.id, dp.id as iddet from products p, product_details dp 
					where dp.product_id = p.id and concat( '#d', dp.id ) = '$busqueda'";
		}

		$data = mysqli_query( $dbh, $q );
		$lista = obtenerListaRegistros( $data );
	
		return $lista;
	} 
	/* ----------------------------------------------------------------------------------- */
	function obtenerProveedorPorId( $dbh, $id ){
		//Devuelve el registro de proveedor dado su id
		$q = "select id, name, number from providers where id = $id";
		return mysqli_fetch_array( mysqli_query( $dbh, $q ) );
	}
	/* ----------------------------------------------------------------------------------- */
	/* Solicitudes asíncronas al servidor para procesar información de Productos */
	/* ----------------------------------------------------------------------------------- */
	

	/* ----------------------------------------------------------------------------------- */

?>