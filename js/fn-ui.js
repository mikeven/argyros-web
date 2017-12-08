/*
 * Argyros - Función de interfaces de usuario
 *
 */
/* ----------------------------------------------------------------------------------- */
function scroll_To(){
	$('html, body').animate({scrollTop: '0px'}, 300);
}
/* ----------------------------------------------------------------------------------- */
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
/* ----------------------------------------------------------------------------------- */
/* Mensajes de alerta */
function mensajeAlerta( ventana, mensaje ){
    $("#body_msg").html( mensaje );
    $(ventana).show("slow");
}
/* ----------------------------------------------------------------------------------- */
function activarBoton( boton, val ){
	$(boton).prop( "disabled", val );
}
/* ----------------------------------------------------------------------------------- */
function ocultarElemento( elemento, t, e ){
	$(elemento).fadeOut({ duration: t, easing: e });
}
/* ----------------------------------------------------------------------------------- */
function mostrarContenidoElemento( elemento, contenido, t, e ){
	$(elemento).html( contenido, function(){
        $(elemento).show({ duration: t, easing: e }); 
    });	
}
/* ----------------------------------------------------------------------------------- */
function clickElement( id, delay ){
	setTimeout(function() {
        $(id).click();
    }, delay );
}
/* ----------------------------------------------------------------------------------- */
$( document ).ready(function() {
	$( ".close_alert" ).on( "click", function(){
		var trg = $(this).attr( "data-trgclose" );
		$( "#" + trg ).fadeOut( "slow" );	
    });
});

/* Mensajes de alerta */
// =================================================================================== //