/*
 * Argyros - Función de interfaces de usuario
 *
 */
/* ----------------------------------------------------------------------------------- */
var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'), sParameterName, i;

    for ( i = 0; i < sURLVariables.length; i++ ) {
        sParameterName = sURLVariables[i].split('=');

        if ( sParameterName[0] === sParam ) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
};
/* ----------------------------------------------------------------------------------- */
function changeurl( url ){
	var new_url = url;
	window.history.replaceState( "data", "Title", new_url );
	document.title = url;
}
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
function isNumberKey(evt){
	var charCode = (evt.which) ? evt.which : evt.keyCode;
	if ( charCode != 46 && charCode > 31 && ( charCode < 48 || charCode > 57 ))
		return false;
	return true;
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
function mensajeAlertaCarrito( ventana, mensaje ){
    $("#body_msg_cart").html( mensaje );
    $(ventana).show("slow");
}
/* ----------------------------------------------------------------------------------- */
function mensajeAlertaCarritoModal( ventana, mensaje ){
    $( ventana + " #body_msg_cart" ).html( mensaje );
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
	
	timer = setTimeout(function() {
        $(id).click();
    }, delay );

    return timer;
}
/* ----------------------------------------------------------------------------------- */
$( document ).ready(function() {
	$( ".close_alert" ).on( "click", function(){
		var trg = $(this).attr( "data-trgclose" );
		$( "#" + trg ).fadeOut( "slow" );	
    });
});
/* /.Mensajes de alerta */

/* ----------------------------------------------------------------------------------- */
/* Ventana modal */
function iniciarVentanaModal( val_id, idcanc, enc, texto, tx_btnok ){
	$(".btn-ok").attr( "id", val_id );
	$(".btn-ok").html( tx_btnok );
	$(".btn-canc").attr( "id", idcanc );
    $("#confirmar-accion .modal-header h6").html( enc );
    $("#confirmar-accion #texto_pregunta").html( texto );
}
/* /.Ventana modal */
// =================================================================================== //