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

 function asignarPrecioFichaProducto( orig, sel ){
 	
 	if( orig == "detalle" ){
	 	if( sel.attr("data-tprecio") == "p" )
	 		$("#vprice_visible").html("$ " + sel.attr("data-precio") );
	 	else
	 		$("#vprice_visible").html("");
 	}
 	if( orig == "talla" ){
		if( sel.attr("data-tprecio") != "p" )
	 		$("#vprice_visible").html("$ " + sel.attr("data-precio") );
 	}
 	$("#vprice_cart").val( sel.attr("data-precio") );
 }

 function mostrarDetalleSeleccionado( trg ){
	$("#" + trg).show();			//mostrar detalle seleccionado
	$("." + trg).show();			//mostrar elementos pertenecientes al detalle seleccionado
 }

$( document ).ready(function() {	
    // ============================================================================ //

    //product.php
	/*$('.tooltip').tooltipster({
	    theme: 'tooltipster-shadow',
	    contentAsHTML: true,
	    interactive: true,
	    delay: 100,
	    side: 'right'
	});*/
	
	//Mouseover: Muestra las subcategorías de una categoría principal al ubicar el cursor sobre el texto
	$(".hnc_selector").on( "mouseover", function(){
		$( ".subcategs_navcatalog" ).hide();
		var trg = $(this).attr("data-trg");
		$( "#" + trg ).show();
	});

	//]Click: Muestra las subcategorías de una categoría principal al ubicar el cursor sobre el texto
	$(".hnc_selector-mob").on( "click", function(){
		$( ".subcategs_navcatalog" ).slideUp();
		var trg = $(this).attr("data-trg");
		$( "#" + trg ).fadeToggle();
	});

	//Clic: selección de detalle de producto
	$(".select_pdetail").on( "click", function(){
		inicializarValoresSelDetalle();
		var trg = $(this).attr("data-regdet");		//asignación de un detalle objetivo
		mostrarDetalleSeleccionado( trg );
		asignarPrecioFichaProducto( "detalle", $(this) );
		$("#iddetalle").val( $(this).attr("data-select-iddet") );
		$("#imgproducto").val( $("#feat_img_producto").attr("src") );
		$("#idref-detalle").text( $(this).attr("data-select-iddet") );
    });

	//Clic: selección de tallas de un detalle de producto
    $(".seltdp").on( "click", function(){
    	//Muestra el peso (data-peso) en el espacio de la ficha de producto ( 'rtallp' + data-trg )
		var trg = $(this).attr("data-trg");
		$("#" + trg).html( $(this).attr("data-peso") );
		$("#stalla").val( $(this).attr("data-value") );
		$("#vidseltalla").val( $(this).attr("data-idt") );
		asignarPrecioFichaProducto( "talla", $(this) );
    });
	
    $( ".select_pdetail" ).first().click();
    //$( ".seltdp" ).first().click();

    $(".bcargable").on( "click", function(){
    	//Muestra el próximo bloque de productos del catálogo
    	var bloque = $(this).attr("data-trg");
    	var pboton = $(this).attr("data-pb");
    	
    	$("." + bloque).fadeIn("slow");
		$("#" + pboton).fadeIn("slow");
		$(this).hide();
    });

    // ============================================================================ //
    /* Scroll catálogo TOP */

    var scrollTop = $(".scrollTop");

	$(window).scroll(function() {
	    // declare variable
	    var topPos = $(this).scrollTop();

	    // if user scrolls down - show scroll to top button
	    if (topPos > 200) {
	      $(scrollTop).css("opacity", "1");

	    } else {
	      $(scrollTop).css("opacity", "0");
	    }

	}); // scroll END

	//Click event to scroll to top
	$(scrollTop).click(function() {
	    $('html, body').animate({
	      scrollTop: 0
	    }, 800);
	    return false;

	}); // click() scroll top END

	/* Scroll catálogo TOP */
	// ============================================================================ //

});

/*
 *
 *
 */