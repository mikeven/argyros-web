/*
 * Argyros - Función de productos
 *
 */

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
	
	$(".hnc_selector").on( "mouseover", function(){
		$( ".subcategs_navcatalog" ).hide();
		var trg = $(this).attr("data-trg");
		$( "#" + trg ).show();
	});

	$(".select_pdetail").on( "click", function(){
		$(".rdet_view").hide();
		$(".rdet_view_t").hide();
		$(".rdet_prop").hide("10");
		var trg = $(this).attr("data-regdet");
		$("#" + trg).show();
		$("." + trg).show();

		$("#iddetalle").val( $(this).attr("data-select-iddet") );
    });

    $(".seltdp").on( "click", function(){
		var trg = $(this).attr("data-trg");
		$("#" + trg).html( $(this).attr("data-peso") );

    });
	
    $( ".select_pdetail" ).first().click();

});

/*
 *
 *
 */