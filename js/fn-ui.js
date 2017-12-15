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
/* Ventanas modales */
	function ventanaModal( ventana, w, h ){
		$.fancybox(
	      $( ventana ),
	      {
	        'autoDimensions'    : false,
	        'width'             : w,
	        'height'            : h,
	        'autoSize' 			: false,
	        'transitionIn'      : 'none',
	        'transitionOut'     : 'none',
	        afterLoad: function(){
	        	setTimeout( function() {$.fancybox.close(); }, 500000 );
	        }
	      }
	    );
	}
/* Ventanas modales */
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
	$(elemento).fadeOut({ duration: t });
}
/* ----------------------------------------------------------------------------------- */
function ocultarElementoDelay( elemento, t, delay ){
	setTimeout(function() {
        ocultarElemento( elemento, t );
    }, delay );
}
/* ----------------------------------------------------------------------------------- */
function mostrarContenidoElemento( elemento, contenido, t, e ){
	$(elemento).html( contenido, function(){
        $(elemento).show({ duration: t, easing: e }); 
    });	
}
/* ----------------------------------------------------------------------------------- */
function clickElemento( id, delay ){
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