/*
 * Argyros - Función de carrito de compra
 *
 */
/* ----------------------------------------------------------------------------------- */
 function imprimirCarritoTienda( cart ){
    //Imprime el contenido y elementos del carrito de compra
    
    $("#item_content_cart").html(cart.cart);            //Impresión en la lista desplegable
    $("#list_content_cart").html(cart.lpag);            //Impresión en la página del carrito
    
    $(".nitems_cart_drop").html(cart.nitems);           //Cantidad de ítems en el carrito
    $(".total_price_cart").html( cart.total_price );    //Monto total en carrito
    $(".total_cant_cart").html(cart.total_cant);        //Cantidad de unidades total en carrito
 }
/* ----------------------------------------------------------------------------------- */
function obtenerCarritoCompra(){
    //Solicita los elementos en el carrito de compra
    $.ajax({
        type:"POST",
        url:"fn/fn-cart.php",
        data:{ get_cart: 1 },
        success: function( response ){
            //console.log( response );
            cart = jQuery.parseJSON( response );
            imprimirCarritoTienda( cart );            
        }
    });   
}
/* ----------------------------------------------------------------------------------- */
function notificarCarritoActualizado(){
    //Muestra un mensaje notificando la actulización del carrito de compras
    
    if( typeof( timer ) != "undefined" && timer !== null ) {
        clearTimeout( timer );
    }
    mensajeAlerta( "#label-msgs", "Carrito de compras actualizado" );
    timer = setTimeout(function() {
        ocultarElemento( "#label-msgs", 100 );
    }, 10000 );
}
/* ----------------------------------------------------------------------------------- */
function asignarIdItem(){
    //Asignar id item carrito compra
    var idd = $("#iddetalle").val();
    var vta = $("#stalla").val();
    $("#idi_cart").val( idd + "-" + vta );
}
/* ----------------------------------------------------------------------------------- */
function validarSeleccionCarrito(){
 	//Chequeo de valores y condiciones para permitir agregar un ítem al carrito de compra
 	var valido = true;
 	if( $("#stalla").val() == "" ){
 		valido = false;	
 	}
 	return valido;
}
/* ----------------------------------------------------------------------------------- */
function eliminarItemCarrito( elem, nitem ){
    //Elimina un elemento del carrito de compra
    
    $.ajax({
        type:"POST",
        url:"fn/fn-cart.php",
        data:{ delitem_c: nitem },
        success: function( response ){
            //console.log( response );
            $( "." + elem ).fadeOut( 500, function(){
                obtenerCarritoCompra(); 
            });
        }
    });
}
/* ----------------------------------------------------------------------------------- */
function actualizarItemCarrito( iditem, cant ){
    //Modifica valor de cantidad en un ítem de carrito de compra dado el id
    $.ajax({
        type:"POST",
        url:"fn/fn-cart.php",
        data:{ mitem_c: iditem, q:cant },
        success: function( response ){
            //console.log( response );
            obtenerCarritoCompra();
            notificarCarritoActualizado();
        }
    });
}
/* ----------------------------------------------------------------------------------- */
function agregarItemCarrito(){
 	//Agrega un ítem de compra al carrito
 	asignarIdItem();
    var cart = $('#frm_scart').serialize();
	
    $.ajax({
        type:"POST",
        url:"fn/fn-cart.php",
        data:{ item_cart: cart },
        success: function( response ){
        	console.log(response);
            obtenerCarritoCompra();			
        }
    });
}

/* ----------------------------------------------------------------------------------- */
function delcartitem( item ){
    //Invoca la eliminación de un ítem del carrito de compra ( Menú desplegable ) 
    var html_item = $(item).attr("data-item");
    var nitem = $(item).attr("data-idi");
    eliminarItemCarrito( html_item, nitem );
}
/* ----------------------------------------------------------------------------------- */
function modificarCantidadCarrito( trg, cant ){
    //Actualiza sumando o restando en 1 el campo cantidad carrito de compra
    var valor_actual = parseInt( $( "#q" + trg ).val() );
    var nuevo_valor = valor_actual + cant;
    if( nuevo_valor < 1 ) nuevo_valor = 1;
    $( "#q" + trg ).val( nuevo_valor );

    return nuevo_valor;
}
/* ----------------------------------------------------------------------------------- */

$( document ).ready(function() {	
// =================================================================================== //
    
    obtenerCarritoCompra();
	
    //Clic: agregar elemento de catálogo a carrito de compra
    $("#add-to-cart").on( "click", function(){
    	if ( validarSeleccionCarrito() == true ){
            agregarItemCarrito();
            mensajeAlertaCarrito( "#alert-msgs-notif", "Ítem agregado a compra" );	
            clickElemento( ".close_alert", 4000 );
    	}
    	else{
    		mensajeAlerta( "#alert-msgs", "Debe seleccionar un valor de talla primero" );
    		clickElemento( ".close_alert", 5000 );
    	}
    });

    //Blur: actualización de cantidad de ítem carrito de compra
    $("#list_content_cart").on('blur', '.mq_itemcart', function(){
        var iditem  = $(this).attr("data-idi");
        var cant    = $(this).val();
        
        actualizarItemCarrito( iditem, cant );
    });     

    //Click: Invoca la eliminación de un ítem del carrito de compra ( página carrito )
    $("#list_content_cart").on('click', '.confirm_itemcart', function(){
        var html_e = $(this).attr("data-row");
        var iditem = $(this).attr("data-idi");

        eliminarItemCarrito( html_e, iditem );
    });   
    
    //Click: Vuelve a mostrar el enlace con la opción para eliminar ítem de carrito  
    $("#list_content_cart").on('click', '.lnkcancel_ei', function(){
        var lnkorig = $(this).attr("data-trg");
        var contendor = $(this).attr("data-cnt");
        $( "#" + contendor ).hide();
        $( "#" + lnkorig ).show();
    });

    //Click: Muestra panel de confirmación previa a eliminar ítem de carrito ( página carrito )
    $("#list_content_cart").on('click', '.e_itemcart', function(){
        var iditem = $(this).attr("data-idi");

        $( "#lnk" + iditem ).hide();
        $( "#oq" + iditem ).show();
    });

    //Click: Suma en 1 el número mostrado en el campo cantidad del carrito de compra ( página carrito )
    $("#list_content_cart").on('click', '.sum_qty_cart', function(){
        ncant = modificarCantidadCarrito( $(this).attr("data-idi"), 1 ); 
        actualizarItemCarrito( $(this).attr("data-idi"), ncant );     
    });
    
    //Click: Resta en 1 el número mostrado en el campo cantidad del carrito de compra ( página carrito )
    $("#list_content_cart").on('click', '.subs_qty_cart', function(){
        ncant = modificarCantidadCarrito( $(this).attr("data-idi"), -1 );
        actualizarItemCarrito( $(this).attr("data-idi"), ncant ); 
    });

});

/*
 *
 *
 */