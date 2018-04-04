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

 function posicionarMenu() {
    
    var altura_del_header = 100;
    var altura_del_menu = $('.menu').outerHeight(true);

    if ($(window).scrollTop() >= altura_del_header){
        $('#contenido_bloque_filtros').addClass('seccion_filtros_catalogo_fijo');
        //$('.wrapper').css('margin-top', (altura_del_menu) + 'px');
    } else {
        $('#contenido_bloque_filtros').removeClass('seccion_filtros_catalogo_fijo');
        $('#contenido_bloque_filtros').addClass('seccion_filtros_catalogo');
        //$('.wrapper').css('margin-top', '0');
    }
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