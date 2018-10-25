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
		ca.uname as uname_c, sc.uname as uname_s, m.name as material 
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
		$q = "select p.id, p.code, p.name, p.description, p.visible as visible, co.name as pais, 
		ca.id as idc, ca.name as category, sc.id as idsc, sc.name as subcategory, 
		ca.uname as uname_c, sc.uname as uname_s, m.name as material 
		FROM products p, categories ca, subcategories sc, countries co, materials m 
		where p.category_id = ca.id and p.subcategory_id = sc.id and p.material_id = m.id 
		and p.country_id = co.id and ca.id = $idc ORDER BY p.id DESC LIMIT 1";

		$data = mysqli_query( $dbh, $q );
		if( $data )
			return mysqli_fetch_array( $data );
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerPreciosDetalleProducto( $dbh, $reg_det, $variables ){
		//Devuelve los precios de cada detalle de producto según el tipo de precio y el valor 
		//correspondiente de la variable asociada
		print_r( $reg_det );		
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
	function obtenerDetalleProducto( $dbh, $pid ){
		//Devuelve los registros detalles asociados a un producto dado su id
		/*$q = "select dp.id as id, c.name as color, t.name as bano, dp.price_type as tipo_precio, 
		dp.weight as peso, dp.piece_price_value as precio_pieza, dp.manufacture_value as precio_mo, 
		dp.weight_price_value as precio_peso FROM product_details dp, treatments t, colors c 
		where dp.color_id = c.id and dp.treatment_id = t.id and dp.product_id = $pid";*/

		$q = "select dp.id as id, c.name as color, t.name as bano, dp.price_type as tipo_precio, 
		dp.weight as peso, dp.piece_price_value as precio_pieza, dp.manufacture_value as precio_mo, 
		dp.weight_price_value as precio_peso FROM product_details dp
		LEFT JOIN treatments t ON t.id = dp.treatment_id LEFT JOIN colors c ON dp.color_id = c.id 
		WHERE dp.product_id = $pid";

		$data = mysqli_query( $dbh, $q );
		$lista = obtenerListaRegistros( $data );
		return $lista;
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
	function obtenerPrecioPorGramo( $var, $precio_gramo ){
		//Devuelve el valor del precio del gramo de acuerdo al perfil de cliemte
		$precio = $precio_gramo * $var["variable_b"];
		
		return number_format( $precio, 2, ".", "" );	
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerPrecioPorPeso( $var, $peso, $precio_gramo ){
		//Devuelve el precio del producto por peso
		$precio = $peso * $precio_gramo;
		return number_format( $precio, 2, ".", "" );
	}

	function obtenerPrecioPorPieza( $var, $precio_pieza ){
		//Devuelve el precio del producto por pieza
		$precio = $precio_pieza * ( $var["variable_a"] );

		return number_format( $precio, 2, ".", "" );
	}

	function obtenerPrecioPorManoObra( $var, $peso, $precio_mo ){
		//Devuelve el precio del producto por mano de obra
		$precio = ( $precio_mo * ( $var["variable_c"] ) + $var["material"] ) * $peso * ( $var["variable_d"] );
		
		return number_format( $precio, 2, ".", "" );
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerPreciosPorPesoTalla( $dbh, $var, $rdetalle ){
		//Devuelve el valor del precio asociado de acuerdo al perfil del cliente y tipo de precio 
		$ntallas = array();
		$tallas = $rdetalle["sizes"];

		foreach ( $tallas as $r ) {
			if( $rdetalle["tipo_precio"] == "g" )
				$r["precio"] = obtenerPrecioPorPeso( $var, $r["peso"], $rdetalle["precio_peso"] );
			
			if( $rdetalle["tipo_precio"] == "mo" )
				$r["precio"] = obtenerPrecioPorManoObra( $var, $r["peso"], $rdetalle["precio_mo"] );
			
			if( $rdetalle["tipo_precio"] == "p" )
				$r["precio"] = obtenerPrecioPorPieza( $var, $rdetalle["precio_pieza"] );
			
			$ntallas[] = $r;			
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
	function obtenerValorPrecioPorTipoPrecio( $dbh, $var, $reg_detalle ){
		//Devuelve el valor del precio del producto calculado por tipo de precio y perfil de usuario
		
		$precio = NULL;
		
		if( $reg_detalle["tipo_precio"] == "p" ){
			$precio = obtenerPrecioPorPieza( $var, $reg_detalle["precio_pieza"] );
		}
		/*if( $reg_detalle["tipo_precio"] == "g" ){
			$precio = obtenerPrecioPorManoObra( $var_gr_usuario, $peso, $reg_detalle["precio_mo"] );
		}*/

		return $precio;
	}
	/* ----------------------------------------------------------------------------------- */
	function cargarPreciosDetalle( $dbh, $detalle ){
		//Devuelve los precios por pieza o peso de cada registro de detalle de producto,  
		//asociado al perfil de usuario y tipos de precio.
		$ndetalle = array();
		$var_gr_usuario = variablesGrupoUsuario( $dbh );

		foreach ( $detalle as $det ) {
			$det["precio"] = obtenerValorPrecioPorTipoPrecio( $dbh, $var_gr_usuario, $det );
			
			if( $det["tipo_precio"] == "g" )
				$det["precio_peso"] = obtenerPrecioPorGramo( $var_gr_usuario, $det["precio_peso"] );

			if( $det["tipo_precio"] == "mo" )
				$det["precio_peso"] = obtenerPrecioPorManoObra( $var_gr_usuario, 1, $det["precio_mo"] );
			
			$ndetalle[] = $det;
		}
		
		return $ndetalle;
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
	function cargarTallasDetalle( $dbh, $detalle ){
		//Devuelve las tallas de cada registro de detalle de producto
		$ndetalle = array();
		$var_gr_usuario = variablesGrupoUsuario( $dbh );

		foreach ( $detalle as $det ){
			$det["sizes"] = obtenerTallasDetalleProducto( $dbh, $det["id"] );
			$det["sizes"] = obtenerPreciosPorPesoTalla( $dbh, $var_gr_usuario, $det );
			$ndetalle[] = $det;
		}
		
		return $ndetalle;
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
	function obtenerProductosC_S( $dbh, $idc, $idsc ){
		//Devuelve la lista de productos pertenecientes a una categoría y subcategoría
		$q = "select p.id, p.code, p.name, p.description, p.visible as visible, co.name as pais, 
		ca.name as category, sc.name as subcategory, m.name as material 
		FROM products p, categories ca, subcategories sc, countries co, materials m 
		where p.visible = 1 and p.category_id = ca.id and p.subcategory_id = sc.id and 
		p.material_id = m.id and p.country_id = co.id and p.category_id = $idc 
		and p.subcategory_id = $idsc order by p.name ASC";
	
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
		and p.country_id = co.id and p.category_id = $idc order by p.name ASC";
		
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
	function obtenerImagenProductoCatalogoDetalle( $dbh, $idp, $iddp ){
		//Devuelve las imágenes de un producto dado su id e id de detalle 
		$q = "select i.path as image FROM images i, product_details d 
		where i.product_detail_id = d.id and d.product_id = $idp and d.id = $iddp";

		$data = mysqli_query( $dbh, $q );
		$lista = obtenerListaRegistros( $data );
		return $lista;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerImagenProductoCatalogo( $dbh, $idp, $iddp ){
		//Devuelve la primera imagen de un producto
		if( $iddp != "" ) 
			return obtenerImagenProductoCatalogoDetalle( $dbh, $idp, $iddp );
		else
			return obtenerImagenProducto( $dbh, $idp );
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
		dp.treatment_id as id_bano, t.name as bano, t.uname as ubano, 
		dp.price_type as tipo_precio, dp.weight as peso, dp.piece_price_value as precio_pieza, 
		manufacture_value as precio_mo, dp.weight_price_value as precio_peso 
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
		dp.weight as peso, dp.piece_price_value as precio_pieza, dp.manufacture_value as precio_mo, 
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
		$q = "select spd.size_id as idtalla, s.name as talla, spd.weight as peso, 
		spd.adjustable as ajustable, spd.visible as visible 
		from size_product_detail spd, sizes s where spd.size_id = s.id and 
		spd.product_detail_id = $idd order by s.id ASC";
		
		$data = mysqli_query( $dbh, $q );
		$lista = obtenerListaRegistros( $data );
		return $lista;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerTallasDetalleProducto( $dbh, $idd ){
		//Devuelve los registros de tallas DISPONIBLES de detalle de producto
		$q = "select spd.size_id as idtalla, s.name as talla, s.unit as unidad, 
		spd.weight as peso, spd.adjustable as ajustable, spd.visible as visible 
		from size_product_detail spd, sizes s where spd.size_id = s.id and 
		spd.product_detail_id = $idd and spd.visible = 1 order by s.name ASC";
		
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
		$q = "select id, name, unit from sizes where category_id = $idc order by name ASC";
		
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
	function obtenerProductosParametroDirectoProducto( $dbh, $busqueda ){
		//Devuelve los registros de producto que coinciden con la búsqueda en algunos de sus parámetros:

		$q = "select p.id from products p, categories ca, subcategories sc, countries co, materials m 
		where (p.visible = 1 and p.category_id = ca.id and p.subcategory_id = sc.id and 
		p.material_id = m.id and p.country_id = co.id ) 
		and ( lower(p.name) like lower('%$busqueda%') or lower(p.description) like lower('%$busqueda%') 
		or lower(p.code) like lower('%$busqueda%') or lower(m.name) like lower('%$busqueda%') 
		or lower(ca.name) like lower('%$busqueda%') or lower(sc.name) like lower('%$busqueda%') )";

		$data = mysqli_query( $dbh, $q );
		$lista = obtenerListaRegistros( $data );

		return $lista;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerProductosParametroDetalleProducto( $dbh, $busqueda, $param ){
		//Devuelve los registros de producto que coinciden con la búsqueda en 
		//algunos de sus parámetros en su detalle

		if( $param == "bano" ){
			$q = "select id from products where visible = 1 and id in ( select dp.product_id from product_details dp, treatments t 
			where dp.treatment_id = t.id and lower(t.name) like lower('%$busqueda%') )";
		}
		if( $param == "color" ){
			$q = "select id from products where visible = 1 and id in ( select dp.product_id from product_details dp, colors c 
			where dp.color_id = c.id and lower(c.name) like lower('%$busqueda%') )";
		}
		if( $param == "trabajo" ){
			$q = "select p.id from products p, making_product mp, makings m  
			where where p.visible = 1 and p.id = mp.product_id and mp.making_id = m.id 
			and lower(m.name) like lower('%$busqueda%')";
		}
		if( $param == "linea" ){
			$q = "select p.id from products p, line_product lp, plines l  
			where p.visible = 1 and p.id = lp.product_id and lp.line_id = l.id 
			and lower(l.name) like lower('%$busqueda%')";
		}

		if( $param == "codigo" ){
			$q = "select id from products where visible = 1 and id in ( select dp.product_id 
			from product_details dp where CONCAT( dp.product_id,'-',dp.id ) = '$busqueda' )";
		}

		$data = mysqli_query( $dbh, $q );
		$lista = obtenerListaRegistros( $data );
	
		return $lista;
	} 
	/* ----------------------------------------------------------------------------------- */



	/* ----------------------------------------------------------------------------------- */
	/* Solicitudes asíncronas al servidor para procesar información de Productos */
	/* ----------------------------------------------------------------------------------- */
	

	/* ----------------------------------------------------------------------------------- */

?>