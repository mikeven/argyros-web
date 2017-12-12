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

$( document ).ready(function() {	
    // ============================================================================ //
	
    //Clic: agregar elemento de catálogo a carrito de compra
    $("#btn_order").on( "click", function(){
        registrarOrden();
    });

});

/*
 *
 *
 */