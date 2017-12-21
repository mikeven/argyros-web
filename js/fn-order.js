/*
 * Argyros - Función de órdenes
 *
 */
 /* ----------------------------------------------------------------------------------- */
 function actualizarBotonOrden(){
    //Actualiza la apariencia del botón "Hacer pedido" después de haber sido clicado
    $("#btn_order").html("Ver mis órdenes");
    $("#btn_order").attr( "href", "account.php");
    $("#btn_order").attr( "id", "btn_account");
    $("#regresar_carrito").hide();
 }
/* ----------------------------------------------------------------------------------- */
 function inicializarBotonConfirmacion(){
    //
    iniciarVentanaModal( 
        "btn_modificar_pedido",
        "btn_cancelar", 
        "Confirmar acción",             
        "Confirme los cambios sobre el pedido",
        "Confirmar" 
    );
 }
 /* ----------------------------------------------------------------------------------- */
 function mostrarMontoPrevio( monto ){
    //Muestra el monto previo después de marcar/desmarcar ítems en la revisión de pedido
    $("#monto_total_orden").html( monto );
 }
 /* ----------------------------------------------------------------------------------- */
 function calcularTotalOrdenPrevio(){
    //Suma los montos de los ítems no marcados para eliminar
    monto = 0.00;
    $(".sumatmp").each( function() {
        monto = parseFloat( $( this ).val() ) + parseFloat( monto );
    });
    mostrarMontoPrevio( monto );
 }
/* ----------------------------------------------------------------------------------- */
function marcarItemPedidoRevisado( id, valor, elemento, color ){
    //Guarda/Elimina el id del item marcado para eliminar y marca/desmarca la franja del ítem a eliminar
    $( "#iditem" + id ).val( valor );
    $( elemento ).css( "background", color );
}
/* ----------------------------------------------------------------------------------- */
function asignarMontoDesmarcado( id, monto ){
    //Asigna el monto del ítem al ser desmarcdo
    var cant = $.trim( $("#qd" + id ).html() );
    if( cant == 0 ) monto = 0.00;
    
    montoItemMarcado( id, monto );   
}
/* ----------------------------------------------------------------------------------- */
function obtenerMarcadoItem( item ){
    //Obtiene los valores del marcado/desmarcado al seleccionar un ítem de pedido
    var idi = $(item).attr("data-t");
    var elemento = $( "#ir" + idi );
     
    var valor = 0; color = "#f7f7f7";
    asignarMontoDesmarcado( idi, $("#monto" + idi ).val() );
    if( $( "#iditem" + idi ).val() == 0 ){
        //marcar para eliminar
        valor = idi; color = "#eb8f8f";
        montoItemMarcado( idi, 0.00 );
    }
    marcarItemPedidoRevisado( idi, valor, elemento, color );
    calcularTotalOrdenPrevio();
}
/* ----------------------------------------------------------------------------------- */
 function mensajeRespuestaOrden( contenido ){
    //Muestra el mensaje de respuesta después de 
    actualizarBotonOrden();
    $("#customer_orders").fadeOut( 500, "easeInOutQuart", function(){
        /* container is now hidden so change the html and fade it back in */
        $(this).html( contenido ).fadeIn({ duration: 300, easing: "easeInOutQuart" });
    });
 }
 /* ----------------------------------------------------------------------------------- */
 function montoItemMarcado( id, val ){
    //Asigna el valor del monto temporal de ítem de pedido
    $("#montotmp" + id).val( val );
 }
 /* ----------------------------------------------------------------------------------- */
 function registrarOrden(){
    //Invoca el registro de un pedido nuevo
    $.ajax({
        type:"POST",
        url:"database/data-order.php",
        data:{ neworder: 1 },
        success: function( response ){
            console.log( response );
            mensajeRespuestaOrden( response );
        }
    });
 }
/* ----------------------------------------------------------------------------------- */
 function cambiarEstadoOrden(){
    //Invoca solicitud para cancelar un pedido
    var idorden = $("#idorden").val();
    var estado = $("#accion_orden").val();
    $.ajax({
        type:"POST",
        url:"database/data-order.php",
        data:{ id_orden: idorden, status_orden: estado },
        beforeSend: function () {
            $("#cn_co").html("<img src='assets/images/ajax-loader.gif' width='16' height='16'>");
        },
        success: function( response ){
            console.log( response );
            location.reload();
        }
    });
 }
/* ----------------------------------------------------------------------------------- */
function registrarCambiosPedido(){
    //Invoca el registro de los cambios realizados a un pedido
    form = $("#frm_mpedido").serialize();
    $.ajax({
        type:"POST",
        url:"database/data-order.php",
        data:{ modif_pedido: form },
        beforeSend: function (){
            $( "#btn_cancelar").click();
            $("#i_rmped").html("<img src='assets/images/ajax-loader.gif' width='16' height='16'>");
        },
        success: function( response ){
            $("#i_rmped").html("");
            console.log( response );
            location.reload();
        }
    });
}
/* ----------------------------------------------------------------------------------- */

$( document ).ready(function() {	
    // =============================================================================== //

    inicializarBotonConfirmacion();
    
    //Clic: agregar elemento de catálogo a carrito de compra
    $("#btn_order").on( "click", function(){
        registrarOrden();
    });
    
    //Clic: opciones para confirmar, muestra botón cancelar 
    $("#cancel_cancel").on( "click", function(){
        $("#cn_co").hide(150)
        $("#" + $(this).attr("data-trg") ).show(200);
    });

    //Clic: invoca confirmar cancelar un pedido 
    $("#a_cancel_conf").on( "click", function(){
        cambiarEstadoOrden();
    });
    
    //Clic: 
    $(".lnco").on( "click", function(){
        $("#accion_orden").val( $(this).attr("data-sta") );
        $("#cancel_cancel").attr( "data-trg", $(this).attr("data-cnt") );
        $("#" + $(this).attr("data-cnt") ).hide(100);
        $("#cn_co").show(100);
    });
    
    //Clic:
    $(".tit_pedido").on( "click", function(){
        $(".tit_pedido").removeClass("tp_active");
        $(this).addClass("tp_active");
        $(".panel_desplegable").hide();
        var t = $(this).attr("data-t");
        $( "#" + t ).slideToggle(200);
    });
    
    /* ----------------------------------------------------------------------------------- */
    
    //Clic: marca/desmarca un ítem para quitar del pedido 
    $(".icancelp").on( "click", function(){
        obtenerMarcadoItem( $(this) );    
    });
    /* ----------------------------------------------------------------------------------- */
    
    //Clic: Invoca el registro de cambios realizados a un pedido
    $("#btn_modificar_pedido").on( "click", function(){
        registrarCambiosPedido()
    });
    /* ----------------------------------------------------------------------------------- */
});

/*
 *
 *
 */