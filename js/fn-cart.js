/*
 * Argyros - Función de carrito de compra
 *
 */
/* ----------------------------------------------------------------------------------- */
 function validarSeleccionCarrito(){
 	//
 	var valido = true;
 	if( $("#stalla").val() == "" ){
 		valido = false;	
 	}
 	return valido;
 }
/* ----------------------------------------------------------------------------------- */
 function agregarItemCarrito(){
 	//
 	var cart = $('#frm_scart').serialize();

	$.ajax({
        type:"POST",
        url:"fn/fn-cart.php",
        data:{ item_cart: cart },
        success: function( response ){
        	console.log( response );
        	$("#item_content_cart").html(response);			
        }
    });
 }

 /* ----------------------------------------------------------------------------------- */

$( document ).ready(function() {	
    // ============================================================================ //

	//Clic: agregar elemento de catálogo a carrito de compra
    $("#add-to-cart").on( "click", function(){
    	if ( validarSeleccionCarrito() == true ){
    		agregarItemCarrito();	
    	}
    	else{
    		mensajeAlerta( "#alert-msgs", "Debe seleccionar un valor de talla primero" );
    		eliminarMensaje( ".close_alert", 5000 );
    	}
    });

});

/*
 *
 *
 */