/*
 * Argyros - Función de cuenta de usuarios
 *
 */
/* ----------------------------------------------------------------------------------- */
function registrarUsuario(){
	//Envía al servidor la invocación a registrar nuevo usuario
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
                activarBoton( "#btn_register", false );  
            }
        }
    });
}

/* ----------------------------------------------------------------------------------- */

function actualizarDatosPersonales( form ){
    //Envía al servidor la petición para actualizar datos personales de cuenta de usuario
    var form = $(form);
    var form_usr = form.serialize();
    
    $.ajax({
        type:"POST",
        url:"database/data-user.php",
        data:{ form_act_dp: form_usr },
        success: function( response ){
            console.log(response);
            res = jQuery.parseJSON( response );
            //scroll_To();
            mensajeAlerta( "#alert-msgs", res.mje );
            if( res.exito != 1 ){
                activarBoton( "#btn_musuario", true );  
            }
        }
    });
}

/* ----------------------------------------------------------------------------------- */

function actualizarDatosCuenta( form, dato ){
    //Envía al servidor la petición para actualizar datos personales de cuenta de usuario
    var form = $(form);
    var form_usr = form.serialize();
    
    $.ajax({
        type:"POST",
        url:"database/data-user.php",
        data:{ form_act_cta: form_usr, data:dato },
        success: function( response ){
            console.log(response);
            res = jQuery.parseJSON( response );
            mensajeAlerta( "#alert-msgs", res.mje );
            if( res.exito != 1 ){
                activarBoton( ".btn-actdu", true );  
            }
        }
    });
}

/* ----------------------------------------------------------------------------------- */

function recuperarPasswordUsuario( form ){
    //Envía al servidor la petición para recuperar contraseña de usuario
    var form_usr = $(form).serialize();
    
    $.ajax({
        type:"POST",
        url:"database/data-user.php",
        data:{ passw_recovery: form_usr },
        success: function( response ){
            console.log(response);
            res = jQuery.parseJSON( response );
            mensajeAlerta( "#alert-msgs", res.mje );
            if( res.exito != 1 ){
                activarBoton( "#btn_envrecov", false );  
            }
        }
    });
}

/* ----------------------------------------------------------------------------------- */

function restablecerPasswordUsuario( form ){
    //Envía al servidor la petición para reasignar contraseña de usuario
    var form_usr = $(form).serialize();
    
    $.ajax({
        type:"POST",
        url:"database/data-user.php",
        data:{ new_passw: form_usr },
        success: function( response ){
            console.log(response);
            res = jQuery.parseJSON( response );
            mensajeAlerta( "#alert-msgs", res.mje );
            $(form).reset();
            if( res.exito != 1 ){
                activarBoton( "#btn_envnpass", false );  
            }
        }
    });
}

/* ----------------------------------------------------------------------------------- */

// ================================================================================== //
jQuery.fn.exists = function(){ return ($(this).length > 0); }
// ================================================================================== //

$( document ).ready(function() {	
    
    $("#recpassword").on( "click", function(){
        $("#recover-password").toggle();
    });

    $(".lnk_tabaccount").on( "click", function(){
        $(".data_panel_tab").hide();
        var trg = $(this).attr("data-target");
        $( "#" + trg ).show(100);
    });

    $("#cta_es_empresa").on( "click", function(){
        $("#frm_nombre_empresa").fadeToggle("slow");
    });

    /* ......................................................................*/

    $('#frm_musuario').bootstrapValidator({
            
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
                lastname: {
                    validators: {
                        notEmpty: {
                            message: 'Debe indicar apellido'
                        }
                    }
                },
                ciudad: {
                    validators: {
                        notEmpty: {
                            message: 'Debe indicar ciudad'
                        }
                    }
                }
            }
    });

    $('#frm_musuario').bootstrapValidator().on('submit', function (e){
      if ( e.isDefaultPrevented() ) {
       
      } else {
        actualizarDatosPersonales( $("#frm_musuario") );
        return false;
      }
    });
    
    /* ......................................................................*/

    $('#frm_mcontrasena').bootstrapValidator({
            
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                apassword: {
                    validators: {
                        notEmpty: {
                            message: 'Debe indicar contraseña actual'
                        }
                    }
                },
                password1: {
                    validators: {
                        notEmpty: {
                            message: 'Debe indicar contraseña'
                        }
                    }
                },
                password2: {
                    validators: {
                        notEmpty: {
                            message: 'Debe indicar contraseña'
                        },
                        identical: {
                            field: 'password1',
                            message: 'Las contraseñas deben coincidir'
                        },
                    }
                }
            }
    });

    $('#frm_mcontrasena').bootstrapValidator().on('submit', function (e) {
      if ( e.isDefaultPrevented() ) {
       
      } else {
        actualizarDatosCuenta( $("#frm_mcontrasena"), "password" );
        return false;
      }
    });

    /* ......................................................................*/

    $('#frm_email_cuenta').bootstrapValidator({
            
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
                }
            }
    });

    $('#frm_email_cuenta').bootstrapValidator().on('submit', function (e) {
      if ( e.isDefaultPrevented() ) {
       
      } else {
        actualizarDatosCuenta( $("#frm_email_cuenta"), "email" );
        return false;
      }
    });

    /* ......................................................................*/

    if ( $('#frm_passwrecovery').exists() ) {
        $('#frm_passwrecovery').bootstrapValidator({
            
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
                }
            }
        });

        $('#frm_passwrecovery').bootstrapValidator().on('submit', function (e) {
          if (e.isDefaultPrevented()) {
            
          } else {
            recuperarPasswordUsuario( $("#frm_passwrecovery") );
            return false;
          }
        });
    }

    /* ......................................................................*/

    $('#frm_newpassword').bootstrapValidator({
            
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            password1: {
                validators: {
                    notEmpty: {
                        message: 'Debe indicar contraseña'
                    }
                }
            },
            password2: {
                validators: {
                    notEmpty: {
                        message: 'Debe indicar contraseña'
                    },
                    identical: {
                        field: 'password1',
                        message: 'Las contraseñas deben coincidir'
                    },
                }
            }
        }
    });

    $('#frm_newpassword').bootstrapValidator().on('submit', function (e) {
      if (e.isDefaultPrevented()){
        
      } else {
        restablecerPasswordUsuario( $("#frm_newpassword") );
        return false;
      }
    });

});