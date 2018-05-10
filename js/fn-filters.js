/*
 * Argyros - Función de productos
 *
 */

 /* ----------------------------------------------------------------------------------- */

 function inicializarValoresSelDetalle(){
	
	$("#stalla").val("");						//anula valor de talla seleccionado
 	$(".rdet_view").hide();						//oculta carruseles de imágenes de un mismo detalle de producto
	$(".rdet_view_t").hide();					//oculta opciones de talla de un mismo detalle de producto
	$(".rdet_prop").hide();						//oculta propiedades de un mismo detalle de producto
	$(".sizeselector").prop('checked', false);	//desmarca todas las selecciones de talla
 }

 /* ----------------------------------------------------------------------------------- */

 function posicionarMenu() {
    
    var altura_del_header = 100;
    var altura_del_menu = $('.menu').outerHeight(true);

    if ($(window).scrollTop() >= altura_del_header){
        $('#contenido_bloque_filtros').addClass('seccion_filtros_catalogo_fijo');
        $('.top-logo').addClass('seccion_logo_movil_fijo');
        //$('.wrapper').css('margin-top', (altura_del_menu) + 'px');
    } else {
        $('#contenido_bloque_filtros').removeClass('seccion_filtros_catalogo_fijo');
        $('#contenido_bloque_filtros').addClass('seccion_filtros_catalogo');
        $('.top-logo').removeClass('seccion_logo_movil_fijo');
        $('.top-logo').removeClass('seccion_logo_movil');
        //$('.wrapper').css('margin-top', '0');
    }
}

/* ----------------------------------------------------------------------------------- */

function generarURLFiltroPrecio( tipo, pmin, pmax ){
	//Invoca la generación de la url para filtrar productos por precio
	var ucatalogo = $("#urlcatalogoactual").val();
    $.ajax({
        type:"POST",
        url:"fn/fn-filters.php",
        data:{ urltipo_precio:tipo, p_min:pmin, p_max:pmax, url_c:ucatalogo },
        success: function( response ){
            console.log( response );
            window.location.href = response;
        }
    });
}

/* ----------------------------------------------------------------------------------- */

function generarURLFiltroPeso( pmin, pmax ){
	//Invoca la generación de la url para filtrar productos por peso
	var ucatalogo = $("#urlcatalogoactual").val();
    $.ajax({
        type:"POST",
        url:"fn/fn-filters.php",
        data:{ urltipo_precio:"peso_producto", peso_min:pmin, peso_max:pmax, url_c:ucatalogo },
        success: function( response ){
            console.log( response );
            window.location.href = response;
        }
    });
}

function setFilterBreadCrumb(){
	//Copia el contenido del breadcrum principal en la sección de selección de filtros
	$("#flt-breadcrumb").html( $("#argy-breadcrumb").html() );
}

/* ----------------------------------------------------------------------------------- */

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

	$("#btn_flt_precio_pieza").on( "click", function(){
		var pmin = $("#flt_pre_pro_min").val();
		var pmax = $("#flt_pre_pro_max").val();
		generarURLFiltroPrecio( "pieza", pmin, pmax );
	});

	$("#btn_flt_precio_peso").on( "click", function(){
		var pmin = $("#flt_pre_pes_min").val();
		var pmax = $("#flt_pre_pes_max").val();
		
		generarURLFiltroPrecio( "peso", pmin, pmax );
	});
	
	$("#btn_flt_peso").on( "click", function(){
		var pmin = $("#flt_peso_min").val();
		var pmax = $("#flt_peso_max").val();
		
		generarURLFiltroPeso( pmin, pmax );
	});


});

/*
 *
 *
 */