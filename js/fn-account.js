/*
 * Argyros - Función de cuenta de usuarios
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
                activarBoton( "#btn_register", true );  
            }
        }
    });
}

/* ----------------------------------------------------------------------------------- */

// ================================================================================== //
jQuery.fn.exists = function(){ return ($(this).length > 0); }
// ================================================================================== //

$( document ).ready(function() {	
    
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
                },
                phone: {
                    validators: {
                        notEmpty: {
                            message: 'Debe indicar teléfono'
                        }
                    }
                }
            }
    });

    $('#frm_musuario').bootstrapValidator().on('submit', function (e) {
      if ( e.isDefaultPrevented() ) {
       
      } else {
        alert("ERROR");
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
        alert("ERROR");
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
        alert("ERROR");
        return false;
      }
    });
});