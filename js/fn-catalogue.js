/*
 * Argyros - Funciones del catálogo de productos
 *
 */
 /* ----------------------------------------------------------------------------------- */
 function mostrarElementosCatalogo( datos, carga_inicial ){
    // Muestra los elementos del catálogo de acuerdo a los resultados obtenidos
    var filtros = datos.filtros;

    $("#panel_tag_filters").html( filtros.enlaces_filtros );
    $("#opciones_filtro_categoria").html( filtros.categorias );
    $("#opciones_filtro_talla").html( filtros.tallas );
    $("#opciones_filtro_bano").html( filtros.banos );
    $("#opciones_filtro_trabajo").html( filtros.trabajos );
    $("#opciones_filtro_linea").html( filtros.lineas );
    $("#opciones_filtro_color").html( filtros.colores );

    $("#sandBox").append( datos.resultados );
 }
 /* ----------------------------------------------------------------------------------- */
 function cargarElementosCatalogo( ini, fin, carga_inicial ){
	// Carga elementos iniciales del catálogo
	var curl = $("#catalogue_url").val();
    var loader_gif = "<img src='assets/images/ajax-loader.gif'>";

	$.ajax({
        type:"POST",
        url:"fn/fn-paginator.php",
        data:{ listar_catalogo_url: curl, pos_i: ini, pos_f: fin, carga_i: carga_inicial },
        beforeSend: function(){
            $("#carga_catalogo").html( loader_gif );
        },
        success: function( response ){
            console.log( response );
            datos = jQuery.parseJSON( response );
            mostrarElementosCatalogo( datos, carga_inicial );
            $("#carga_catalogo").html( "" );  
        }
    });
 }
 /* ----------------------------------------------------------------------------------- */
 function obtenerBloqueTallas( datos_producto, iddet ){

    $.ajax({
        type:"POST",
        url:"fn/fn-paginator.php",
        data:{ tallas_det: iddet, data_p: datos_producto },
        beforeSend: function(){
            
        },
        success: function( response ){
            $("#qs-data-tallas").html( response );      
        }
    });
 }
 /* ----------------------------------------------------------------------------------- */
 function cargarDatosProducto( datos ){

    var elementop = new Object();

    $("#modal_img_prod").attr("src", $(datos).attr("data-img") );
    $(".url_lnkproduct").attr("href", $(datos).attr("data-link") );
    $("#quick-shop-title a").html( $(datos).attr("data-nombre") );

    $("#quick-shop-description p").html( $(datos).attr("data-descripcion") );
    $("#quick-shop-product-id p").html( $(datos).attr("data-ids") );
    $("#modal_price_prod").html( $(datos).attr("data-precio") );

    $("#qs-pais").html( $(datos).attr("data-pais") );
    $("#qs-material").html( $(datos).attr("data-material") );
    $("#qs-color").html( $(datos).attr("data-color") );
    $("#qs-bano").html( $(datos).attr("data-bano") );

    elementop.idp           = $(datos).attr("data-idp");
    elementop.nombre        = $(datos).attr("data-nombre");
    elementop.imagen        = $(datos).attr("data-img");
    elementop.descripcion   = $(datos).attr("data-desc");

    return elementop;
 }
 /* ----------------------------------------------------------------------------------- */
 $( document ).ready(function() {	
    
    $( "#sandBox" ).on( "click", ".btn_vermas", function(){
        //Muestra el próximo bloque de productos del catálogo
        var elemento_inicio = $(this).attr("data-ini");
        var elemento_fin    = $(this).attr("data-fin");
        $(this).fadeOut("slow");
        obtenerCarritoCompra('');
        cargarElementosCatalogo( elemento_inicio, elemento_fin, false );
    });
    /* .................................................................... */
    //Click modal product catalogue
    $( "#sandBox" ).on( "click", ".quick_shop", function(){

        var bloque_tallas   = $( "#" + $(this).attr( "data-idbloque-talla" ) );

        var data_producto   = cargarDatosProducto( $(this) );

        var tabla_tallas    = obtenerBloqueTallas( data_producto, $(this).attr("data-iddet") );
        
    }); 
    /* .................................................................... */
    // Clic botón agregar a carrito desde ventana emergente
    $( "#qs-data-tallas" ).on( "click", ".add-to-cart", function(){
        
        var trgfrm = $(this).attr("data-frmtrg");
        var trgmsg = $(this).attr("data-msg-notice");
        
        if( validarSeleccionCarritoModal( "#" + trgfrm ) == true ){
            $( trgmsg ).hide();
            agregarItemCarritoVentana( "#" + trgfrm );

            if ( typeof timer != "undefined" ) clearTimeout(timer);
        
            timer = setTimeout(function() {
                $(".close_alert").click();
            }, 4000 );

            mensajeAlertaCarritoModal( trgmsg, "Ítem agregado a compra" );
        }
        else{
            mensajeAlertaCarritoModal( trgmsg, "Debe ingresar al menos 1 elemento" );
        }
          
    });
    /* .................................................................... */

 });
/* ----------------------------------------------------------------------------------- */

/*
 *
 *
 */