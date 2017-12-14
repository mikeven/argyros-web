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
 function actualizarBotonConfirmarAccionOrden(){
    //

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
 function registrarOrden(){
    //Invoca el registro de un pedido
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

$( document ).ready(function() {	
    // ============================================================================ //
	
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

    $(".lnco").on( "click", function(){
        $("#accion_orden").val( $(this).attr("data-sta") );
        $("#cancel_cancel").attr( "data-trg", $(this).attr("data-cnt") );
        $("#" + $(this).attr("data-cnt") ).hide(100);
        $("#cn_co").show(100);
    });

});

/*
 *
 *
 */