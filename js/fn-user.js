/*
 * Argyros - Función de usuarios
 *
 */
/* ----------------------------------------------------------------------------------- */
function registrarUsuario(){
	//Envía al servidor la petición de registro de un nuevo usuario
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
                activarBoton( "#btn_register", true );  
            }
        }
    });
}
/* ----------------------------------------------------------------------------------- */
function iniciarSesion( form, mode ){
    //Envía al servidor la petición de inicio de sesión
    //mode: full: Página de login. min: ventana emergente del menú navegación
    var form_log = form.serialize();
    
    $.ajax({
        type:"POST",
        url:"database/data-user.php",
        data:{ usr_login: form_log },
        success: function( response ){
            console.log(response);
            res = jQuery.parseJSON( response );
            if( res.exito == 1 ){
                if( mode == "full" ){
                    //Redirigir a pantalla de cuenta de usuario
                    window.location.href = "account.php"; 
                }else{
                    location.reload();
                }
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

/* ----------------------------------------------------------------------------------- */

function enviarDatosContacto( datos ){
    //Envía al servidor los datos del formulario de contacto
    var form_co = $(datos).serialize();
    
    $.ajax({
        type:"POST",
        url:"database/data-user.php",
        data:{ form_ctc: form_co },
        success: function( response ){
            console.log(response);
            res = jQuery.parseJSON( response );
            scroll_To();
            mensajeAlerta( "#alert-msgs", res.mje );
            $("#frm_contacto")[0].reset();
            if( res.exito != 1 ){
                $("#frm_contacto")[0].reset();
                activarBoton( "#btn_contacto", true );  
            }
        }
    });
}

// ================================================================================== //
jQuery.fn.exists = function(){ return ($(this).length > 0); }
// ================================================================================== //

$( document ).ready(function() {	
    
	$( ".select_pdetail" ).first().click();

    $("#btn_login_dd").on( "click", function(){
        iniciarSesion( $("#frm_login_bar"), "min" );
    });
    /* ......................................................................*/
    //Formulario Registro de usuarios: Autocompletar código de área según país seleccionado
    $("#usuario-pais").on( "change", function(){
        var cod_pais = $(this).find(':selected').attr('data-cp');
        var prefijo = "(+" + cod_pais + ") ";
        $("#telefono").val( prefijo );
    });
    /* ......................................................................*/
    if ( $('#frm_registro').exists() ) {
        
        $('#frm_registro').bootstrapValidator({
            
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                nombre: {
                    validators: {
                        notEmpty: {
                            message: 'Debe indicar su nombre'
                        }
                    }
                },
                apellido: {
                    validators: {
                        notEmpty: {
                            message: 'Debe indicar su apellido'
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
    }
    /* ......................................................................*/
    if ( $('#frm_login').exists() ) {
        
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
    }
    /* ......................................................................*/
    if ( $('#frm_contacto').exists() ) {
        
        $('#frm_contacto').bootstrapValidator({
            
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                nombre: {
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
                mensaje: {
                    validators: {
                        notEmpty: {
                            message: 'Debe escribir mensaje'
                        }
                    }
                }
            }
        });

        $('#frm_contacto').bootstrapValidator().on('submit', function (e) {
            if (e.isDefaultPrevented()) {
            
            } else {
                enviarDatosContacto( $(this) );
                return false;
            }
        });
    }
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