/*
 * Argyros - Función de interfaces de usuario
 *
 */
/* ----------------------------------------------------------------------------------- */
function scroll_To(){
	$('html, body').animate({scrollTop: '0px'}, 300);
}

function soloNumeros( evt ){ 
	evt = ( evt ) ? evt : event;  
	var charCode = ( evt.charCode ) ? evt.charCode : ( ( evt.keyCode ) ? evt.keyCode : ( ( evt.which ) ? evt.which : 0 ) );  
	var respuesta = true;  
	  
	if ( charCode > 31 && ( charCode < 48 || charCode > 57 ) )   
	{  
		respuesta = false;  
	}  
	return respuesta;  
}

/* Mensajes de alerta */
function mensajeAlerta( ventana, mensaje ){
    $("#body_msg").html( mensaje );
    $(ventana).show("slow");
}

function activarBoton( boton ){
	$(boton).prop("disabled", false);
}

function eliminarMensaje( id, delay ){
	setTimeout(function() {
        $(id).click();
    }, delay );
}

$( document ).ready(function() {
	$( ".close_alert" ).on( "click", function(){
		var trg = $(this).attr( "data-trgclose" );
		$( "#" + trg ).fadeOut( "slow" );	
    });
});

/* Mensajes de alerta */
// =================================================================================== //