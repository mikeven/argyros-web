/*
 * Argyros - Función de usuarios
 *
 */
/* ----------------------------------------------------------------------------------- */
function registrarUsuario(){
	//Envía al servidor la petición de inicio de sesión
	var form = $("#frm_registro");
	var form_usr = form.serialize();
	
	$.ajax({
        type:"POST",
        url:"database/data-user.php",
        data:{ form_nu: form_usr },
        success: function( response ){
        	console.log(response);
            res = jQuery.parseJSON( response );
            scroll_To();
            mensajeAlerta( "#alert-msgs", res.mje );
            if( res.exito != 1 ){
                activarBoton( "#btn_register" );  
            }
        }
    });
}
/* ----------------------------------------------------------------------------------- */
function iniciarSesion( form, mode ){
    //Envía al servidor la petición de inicio de sesión
    
    var form_log = form.serialize();
    
    $.ajax({
        type:"POST",
        url:"database/data-user.php",
        data:{ usr_login: form_log },
        success: function( response ){
            console.log(response);
            res = jQuery.parseJSON( response );
            if( res.exito == 1 ){
                window.location.href = "index.php";
            }else{
                if( mode == "full" ){
                    mensajeAlerta( "#alert-msgs", res.mje );
                    activarBoton( "#btn_login" );
                }else{
                    window.location.href = "login.php?err";   
                }

            }
        }
    });
}

// ================================================================================== //

$( document ).ready(function() {	
    
	$( ".select_pdetail" ).first().click();

    $("#btn_login_dd").on( "click", function(){
        iniciarSesion( $("#frm_login_bar"), "min" );
    });
    /* ......................................................................*/
    $('#frm_registro').bootstrapValidator({
        
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            name: {
                validators: {
                    notEmpty: {
                        message: 'Debe indicar su nombre'
                    }
                }
            },
            email: {
                validators: {
                    notEmpty: {
                        message: 'Debe indicar un email'
                    },
                    emailAddress: {
                        message: 'Debe indicar un email válido'
                    }
                }
            },
            passw1: {
                validators: {
                    notEmpty: {
                        message: 'Debe indicar contraseña'
                    }
                }
            },
            passw2: {
                validators: {
                    notEmpty: {
                        message: 'Debe indicar contraseña'
                    },
                    identical: {
                        field: 'passw1',
                        message: 'Las contraseñas deben coincidir'
                    },
                }
            },
        }
    });

    $('#frm_registro').bootstrapValidator().on('submit', function (e) {
	  if (e.isDefaultPrevented()) {
	   
	  } else {
	  	registrarUsuario();
	  	return false;
	  }
	});

    /* ......................................................................*/

    $('#frm_login').bootstrapValidator({
        
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            email: {
                validators: {
                    notEmpty: {
                        message: 'Debe indicar un email'
                    },
                    emailAddress: {
                        message: 'Debe indicar un email válido'
                    }
                }
            },
            password: {
                validators: {
                    notEmpty: {
                        message: 'Debe indicar contraseña'
                    }
                }
            }
        }
    });

    $('#frm_login').bootstrapValidator().on('submit', function (e) {
      if (e.isDefaultPrevented()) {
        
      } else {
        iniciarSesion( $("#frm_login"), "full" );
        return false;
      }
    });

    /* ......................................................................*/
    /*
    $('#frm_login_bar').bootstrapValidator({
        
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            email: {
                validators: {
                    notEmpty: {
                        message: 'Debe indicar un email'
                    },
                    emailAddress: {
                        message: 'Debe indicar un email válido'
                    }
                }
            },
            password: {
                validators: {
                    notEmpty: {
                        message: 'Debe indicar contraseña'
                    }
                }
            }
        }
    });

    $('#frm_login_bar').bootstrapValidator().on('submit', function (e) {
      if (e.isDefaultPrevented()) {
        alert("prevent");  
      } else {
        iniciarSesion( $("#frm_login_bar") );
        return false;
      }
    });
    */

});