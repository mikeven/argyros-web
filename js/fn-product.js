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
 function asignarPrecioFichaProducto( orig, sel ){
 	//Muestra el precio del producto según el elemento seleccionado: talla o detalle
 	//alert( sel.attr("data-precio-v") );
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
 	$("#vprice_cart").val( sel.attr("data-precio-v") );
 }
 /* ----------------------------------------------------------------------------------- */
 function tallaInicial( selector ){
 	//Selecciona la primera talla de un detalle de un producto
 	var tinicial = $(selector).attr("data-talla-i");
 	$( "." + tinicial ).click();
 	$( "#" + tinicial ).click();
 }
 /* ----------------------------------------------------------------------------------- */
 function mostrarDetalleSeleccionado( trg ){
 	//Muestra los bloques correspondientes a la información de un detalle de producto seleccionado

	$("#" + trg).show();			//mostrar detalle
	$("." + trg).show();			//mostrar elementos pertenecientes al detalle
 }
 /* ----------------------------------------------------------------------------------- */
 function colapsarMenu( idclic ){
 	//Oculta las opciones internas del menú de navegacíón de catálogo
 	$(".subcategs_navcatalog").each(function() {
	    if( $(this).attr("id") != idclic )
	    	$(this).fadeOut(150);
	});
 }

 function marcarBordeDetalle( img ){
 	//Marca con un borde la imagen del detalle seleccionado
 	$(".img-det-prod").removeClass( "selimgdet" );
 	$( img ).addClass( "selimgdet" );
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

	var getidet = getUrlParameter('iddet');
	
	//Mouseover: Muestra las subcategorías de una categoría principal al ubicar el cursor sobre el texto
	$(".hnc_selector").on( "mouseover", function(){
		$( ".subcategs_navcatalog" ).hide();
		var trg = $(this).attr("data-trg");
		$( "#" + trg ).show();
	});

	//Click: Muestra las subcategorías de una categoría principal al ubicar el cursor sobre el texto
	$(".hnc_selector-mob").on( "click", function(){
		var trg = $(this).attr("data-trg");
		colapsarMenu( trg );		
		$( "#" + trg ).fadeToggle();
	});

	//Clic: selección de detalle de producto
	$(".select_pdetail").on( "click", function(){

		var id_prod_url = $("#idprod").val();
		var id_dp_url = $(this).attr("data-select-iddet");
		var img_dsel = "#" + $(this).attr("data-iddimg");
		var new_url = "product.php?id=" + id_prod_url + "&iddet=" + id_dp_url;
		changeurl( new_url );

		inicializarValoresSelDetalle();
		marcarBordeDetalle( img_dsel );
		var trg = $(this).attr("data-regdet");		//asignación de un detalle objetivo
		mostrarDetalleSeleccionado( trg );
		asignarPrecioFichaProducto( "detalle", $(this) );
		$("#iddetalle").val( id_dp_url );
		$("#imgproducto").val( $("#feat_img_producto").attr("src") );
		$("#idref-detalle").text( $(this).attr("data-select-iddet") );
		tallaInicial( $(this) ); 	//selecciona la primera talla de detalle de producto

    });

	//Clic: selección de tallas de un detalle de producto
    $(".seltdp").on( "click", function(){
    	//Muestra el peso (data-peso) en el espacio de la ficha de producto ( 'rtallp' + data-trg )
		var trg = $(this).attr("data-trg");
		$("#" + trg).html( $(this).attr("data-peso") );
		$("#stalla").val( $(this).attr("data-value") );
		$("#vidseltalla").val( $(this).attr("data-idt") );
		if( $(this).attr("data-und") != "" )
			$("#undtalla").html( "(" + $(this).attr("data-und") + ")" );	//Mostrar unidad de medición
		asignarPrecioFichaProducto( "talla", $(this) );
    });
	
	if( getidet != null ){
		$( "#DP-" + getidet ).click();
	}
	else
		$( ".select_pdetail" ).first().click();	//Selección de primer bloque de detalle

	//$( ".select_pdetail" ).first().click();
    //$( ".sizeselector" ).first().click();		//Selección de primer bloque tallas de detalle

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