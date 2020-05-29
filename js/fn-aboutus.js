/*
 * Argyros - Función de usuarios
 *
 */
/* ----------------------------------------------------------------------------------- */

$( document ).ready(function() {	
    
    $(".lnkaboutus").on( "click", function(){

        var trg = $(this).attr("data-bloque");
        $( "#" + trg ).fadeToggle();
        if( trg == "nuestros_clientes" ) 
            $("#nuestros_productos").fadeOut();
        else
            $("#nuestros_clientes").fadeOut();
    });

});