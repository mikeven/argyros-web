<?php
	/* ----------------------------------------------------------------------------------- */
	/* Argyros - Funciones de categorías */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	function obtenerIdCategoriaPorUname( $dbh, $uname ){
		//Devuelve el id de una categoría dado su uname
		$q = "Select id from categories where uname = '$uname'";		

		$data = mysqli_query( $dbh, $q );
		return mysqli_fetch_array( $data );
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerIdSubCategoriaPorUname( $dbh, $uname, $idc ){
		//Devuelve el id de una subcategoría dado su uname
		$q = "Select id from subcategories where uname = '$uname' and category_id = $idc";		
		
		$data = mysqli_query( $dbh, $q );
		return mysqli_fetch_array( $data );
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerListaCategorias( $dbh ){
		//Devuelve la lista de categorías principales de productos
		$q = "Select id, name, uname, image from categories order by name ASC";
		
		$data = mysqli_query( $dbh, $q );
		$lista_c = obtenerListaRegistros( $data );
		$lista_c = filtrarNone( $lista_c, "id" );
		return $lista_c;	
	}
	/* ----------------------------------------------------------------------------------- */
	function filtrarNone( $lista, $nid ){
		//Filtrar la categoría neutra del listado obtenido de BD
		$nlista = array();
		foreach ( $lista as $reg ) {
			if( $reg[$nid] != 1 ) $nlista[] = $reg;
		}

		return $nlista;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerCategoriaPorId( $dbh, $id ){
		//Devuelve el registro de categoría por su id
		$q = "Select id, name from categories where id = $id";
		$data = mysqli_query( $dbh, $q );
		return mysqli_fetch_array( $data );	
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerCategoriasDestacadaPorOrden( $dbh, $orden ){
		//Devuelve el registro de categoría por su orden destacado
		$q = "select id, name, uname, image from categories where home_order = $orden";

		$data = mysqli_query( $dbh, $q );
		return mysqli_fetch_array( $data );
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerCategoriaPorUname( $dbh, $uname ){
		//Devuelve el registro de categoría por su uname
		$q = "Select id, name from categories where uname = '$uname'";
		$data = mysqli_query( $dbh, $q );
		return mysqli_fetch_array( $data );	
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerSubCategoriaPorId( $dbh, $id ){
		//Devuelve el registro de categoría por su id
		$q = "Select id, name, category_id as idcategoria from subcategories where id = $id";
		$data = mysqli_query( $dbh, $q );
		return mysqli_fetch_array( $data );	
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerSubCategoriaPorUname( $dbh, $uname ){
		//Devuelve el registro de categoría por su uname
		$q = "Select id, name, category_id as idcategoria from subcategories where uname = '$uname'";
		
		$data = mysqli_query( $dbh, $q );
		return mysqli_fetch_array( $data );	
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerListaSubCategorias( $dbh ){
		//Devuelve la lista de categorías principales de productos
		$q = "Select s.id, s.name as name, c.name as cname from subcategories s, categories c 
		where s.category_id = c.id order by name ASC";
		
		$data = mysqli_query( $dbh, $q );
		$lista_c = obtenerListaRegistros( $data );
		return $lista_c;	
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerListaSubCategoriasCategoria( $dbh, $idcateg ){
		//Devuelve la lista de subcategorías de una categoría padre
		$q = "select id, name, uname from subcategories where category_id = $idcateg order by name ASC";
		
		$data = mysqli_query( $dbh, $q );
		$lista_c = obtenerListaRegistros( $data );
		return $lista_c;	
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerSubcategoriasCategoriaUname( $dbh, $uname ){
		//Devuelve la lista de subcategorías de una categoría padre
		$q = "select s.id, s.name, s.uname from subcategories s, categories c where s.category_id = c.id and 
		c.uname = '$uname' order by s.name ASC";
		
		$data = mysqli_query( $dbh, $q );
		$lista_c = obtenerListaRegistros( $data );
		return $lista_c;	
	}
	/* ----------------------------------------------------------------------------------- */
	function modificarSubCategoria( $dbh, $idsubcategoria, $nombre, $idcategoria ){
		//Edita los datos de subcategoría
		$q = "update subcategories set name = '$nombre', category_id = $idcategoria, 
				updated_at = NOW() where id = $idsubcategoria";
		//echo $q;
		$data = mysqli_query( $dbh, $q );
		return $data;
	}
	/* ----------------------------------------------------------------------------------- */
	function agregarCategoria( $dbh, $nombre ){
		//Agrega un registro de categoría principal de producto
		$q = "insert into categories ( name, created_at ) values ( '$nombre', NOW() )";
		$data = mysqli_query( $dbh, $q );
		return mysqli_insert_id( $dbh );	
	}
	/* ----------------------------------------------------------------------------------- */
	function agregarSubcategoria( $dbh, $nombre, $idcategoria ){
		//Agrega un registro de subcategoría de producto
		$q = "insert into subcategories ( name, category_id, created_at ) 
				values ( '$nombre', $idcategoria, NOW() )";
		
		$data = mysqli_query( $dbh, $q );
		return mysqli_insert_id( $dbh );
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerImagenSubcategoria( $dbh, $idsc ){
		// Devuelve la imagen del primer producto con detalle disponible de una subcategoría de producto
		
		$q = "select p.id as pid, dp.id as iddet 
				from products p, product_details dp, categories ca, subcategories sc
				where dp.product_id = p.id and p.category_id = ca.id and p.subcategory_id = sc.id and 
				sc.id = $idsc and dp.id in 
					(select product_detail_id from size_product_detail where visible = 1 and product_detail_id = dp.id ) 
				order by dp.repositioned_at desc, dp.created_at desc limit 1";

		$data = mysqli_fetch_array( mysqli_query( $dbh, $q ) );

		if( $data ){
			$qi = "select path as imagen from images 
				where product_detail_id = $data[iddet] order by id asc limit 1";

			return mysqli_fetch_array( mysqli_query( $dbh, $qi ) );	
			
		}else 
			return null;
	}

	/* ----------------------------------------------------------------------------------- */
	/* Solicitudes asíncronas al servidor para procesar información de Categorías */
	/* ----------------------------------------------------------------------------------- */

	/* ----------------------------------------------------------------------------------- */
?>