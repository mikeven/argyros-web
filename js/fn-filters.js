/*
 * Argyros - Función de productos
 *
 */

 function inicializarValoresSelDetalle(){
	
	$("#stalla").val("");						//anula valor de talla seleccionado
 	$(".rdet_view").hide();						//oculta carruseles de imágenes de un mismo detalle de producto
	$(".rdet_view_t").hide();					//oculta opciones de talla de un mismo detalle de producto
	$(".rdet_prop").hide();						//oculta propiedades de un mismo detalle de producto
	$(".sizeselector").prop('checked', false);	//desmarca todas las selecciones de talla
 }

$( document ).ready(function() {	
    // ============================================================================ //

	//Clic: Muestra el bloque correspondiente al contenido del filtro de productos seleccionado
	$(".flt_selector").on( "click", function(){
		$( ".tab_filtro_contenido" ).hide();
		$(".flt_selector").removeClass("flt_selected");
		$(this).addClass("flt_selected");
		
		var trg = $(this).attr( "data-flt-cnt" );
		$( "#" + trg ).show( "slow" );
	});

});

/*
 *
 *
 */