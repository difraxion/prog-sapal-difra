var DIR = $('#hdn_baseurl').val();
$(window).load(function(){
    NProgress.done();
});
$(document).ready(function(){
    NProgress.start();
    $('#lnk_pagaturecibo').click(function(){
        var h = $('#pagoturecibo').height();
        if(h==0) {
            realizar_pago();
        } else {
            close_pago();
        }
        return false;
    });
    $('#close').click(function(){
        close_pago();
        return false;
    });
    $('.help').fancybox();
    $('#btn_pagocon').click(function(){
        var usuario = $('#usuario').val();
        var password = $('#psw').val();
        $.ajax({
            type: "POST",
            dataType: "html",
            url: DIR + "sac/validar_usuario",
            data: 'usuario='+usuario+'&password='+password+'&goto=pagaturecibo',
            beforeSend:function(){
                $('#msj_conreg').html('<span class="loading">Cargando...</span>');
            },
            success: function(msg){
                $('#msj_conreg').html(msg);
            }
        });
    });
    $('#lnk-pago').click(function(){
        var lnk = $('#lnk_pagaturecibo');
        $.ajax({
            type: "POST",
            dataType: "html",
            url: DIR + "sac/chk_session",
            beforeSend:function(){
                NProgress.start();
            },
            success: function(msg){
                NProgress.done();
                if(msg=='false') {
                    $('html, body').animate({
                        scrollTop: 0
                    }, 600, function(){
                        $('nav a').removeClass('activate');
                        lnk.addClass('activate');
                        $('#pagoturecibo').animate({
                            height:294
                        }, 300, function(){
                            $('.wrapper, hr').fadeIn('fast');
                        });
                    });
                }
                else {
                    window.location.href = DIR + 'sac/pagaturecibo';
                }
            }
        });
        return false;
    });
    $('.oheader').click(function(){
        var lnk = $(this);
        var form = lnk.next('div');
        form.slideToggle();
        return false;
    });
    $('#btn_pagosin').click(function(){
        var cuenta = $('#cuenta').val();
        var clave = $('#clave').val();
        $.ajax({
            type: "POST",
            dataType: "html",
            url: DIR + "sac/validar_cuenta",
            data: 'cuenta='+cuenta+'&clave='+clave,
            beforeSend:function(){
                $('#msj_sinreg').html('<span class="loading">Cargando...</span>');
            },
            success: function(msg){
                $('#msj_sinreg').html(msg);
            }
        });
    });
    $('#btn_login').click(function(){
        var usuario = $('#sac_usuario').val();
        var password = $('#sac_psw').val();
        $.ajax({
            type: "POST",
            dataType: "html",
            url: DIR + "sac/validar_usuario",
            data: 'usuario='+usuario+'&password='+password+'&goto=inicio',
            beforeSend:function(){
                $('#msjlogin').html('<span class="loading">Cargando...</span>');
            },
            success: function(msg){
                $('#msjlogin').html(msg);
            }
        });
    });
    $('#lnk-loading').click(function(){
        var offset = $('#option-login').offset();
        $("html, body").animate({
            scrollTop: offset.top - 10
        }, 600, function(){
            $('#option-login .form').slideDown();
        });
        return false;
    });
    $('#lnk-pagosin').click(function(){
        $("html, body").animate({
            scrollTop: 0
        }, 600, function(){
            $("#pagoturecibo").animate({
                height:294
            }, 300, function(){
                $(".wrapper, hr").fadeIn("fast");
            });
        });
        return false;
    })
    $('#t_impuesto').bind('paste', function () {
        var self = this;
        setTimeout(function () {
            if (!/^\d*(\.\d{1,2})+$/.test($(self).val())) $(self).val('');
        }, 0);
    });
    $('.decimal').keypress(function (e) {
        var character = String.fromCharCode(e.keyCode)
        var newValue = this.value + character;
        if (isNaN(newValue) || parseFloat(newValue) * 100 % 1 > 0) {
            e.preventDefault();
            return false;
        }
    });
    $('#frm_pago').submit(function(){
        var impuesto = $('#t_impuesto').val();
        if(impuesto!='') {
            var num = parseFloat(impuesto);
            if(num>=1) {
                $('#t_impuesto').val(num.toFixed(2));
                $.ajax({
                    type: "POST",
                    dataType: "html",
                    url: DIR + "sac/chk_pago",
                    data: 'impuesto='+impuesto,
                    beforeSend:function(){
                        $('#ul_msj').html('<li><img src="'+DIR+'img/271.GIF" alt="Cargando..."/></li><li>Enviando información</li>');
                    },
                    success: function(msg){
                        if(msg=='true') {
                            $('#ul_msj').html('<li>Los movimientos registrados se reflejan despues de 24 horas hábiles, sapal agradece su pago.</li>');
                            return true;
                        }
                        else {
                            $('#ul_msj').html('<li>Por favor introduzca un importe a pagar</li>');
                            return false;
                        }
                    }
                });
            } 
            else {
                $('#ul_msj').html('<li>El importe mínimo a pagar debe ser superior a un peso</li>');
                return false; 
            } 
        }
        else {
            $('#ul_msj').html('<li>Por favor introduzca un importe a pagar</li>');
            return false;            
        }
    });
    $('#btn_registrarse').click(function(){
        var nusuario = $('#nusuario').val();
        var correo = $('#correo').val();
        var contrasena = $('#contrasena').val();
        var cocontrasena = $('#cocontrasena').val();
        var nombre = $('#nombre').val();
        var apellidos = $('#apellidos').val();
        var direccion = $('#direccion').val();
        var domicilio = $('#domicilio').val();
        var ncuenta = $('#ncuenta').val();
        var nclave = $('#nclave').val();
        var pregunta = $('#pregunta').val();
        var respuesta = $('#respuesta').val();
        if(contrasena==cocontrasena) {
            $.ajax({
                type: "POST",
                dataType: "html",
                url: DIR + "sac/chk_registro",
                data: 'nusuario='+nusuario+'&correo='+correo+'&contrasena='+contrasena+'&cocontrasena='+cocontrasena+'&nombre='+nombre+'&apellidos='+apellidos+'&direccion='+direccion+'&domicilio='+domicilio+'&ncuenta='+ncuenta+'&nclave='+nclave+'&pregunta='+pregunta+'&respuesta='+respuesta,
                beforeSend:function(){
                    $('#msj_registrarse').html('Enviando información');
                },
                success: function(msg){
                    $('#msj_registrarse').html(msg); 
                },
                error: function(req, status, error) {
                   $('#msj_registrarse').html(req.responseText);      
                  }
            });
        }
        else {
           $('#msj_registrarse').html('LA CONFIRMACIÓN DE LA CONTRASEÑA NO COINCIDE'); 
           $('#contrasena').focus();
           $('#contrasena').addClass('txt-error');
           $('#cocontrasena').addClass('txt-error');
        }
    });
    $('#btn_paso1').click(function(){
        var txt_usuario = $('#txt_usuario').val();
        var txt_nocuenta = $('#txt_nocuenta').val();
        if(txt_usuario==''&&txt_nocuenta=='') {
            $('#msj1').html('Por favor introduzca al menos el usuario o el número de cuenta');
        } else {
            $.ajax({
                type: "POST",
                dataType: "html",
                url: DIR + "sac/chk_recuperacion",
                data: 'usuario='+txt_usuario+'&nocuenta='+txt_nocuenta,
                beforeSend:function(){
                    $('#msj1').html('Validando información');
                },
                success: function(msg){
                    $('#msj1').html(msg);
                }
            });
        }
    });
    $('#btn_paso2').click(function(){
        var txt_usuario = $('#txt_usuario').val();
        var txt_nocuenta = $('#txt_nocuenta').val();
        var slt_pregunta = $('#slt_pregunta').val();
        var txt_respuesta = $('#txt_respuesta').val();
        if(slt_pregunta==''&&txt_respuesta=='') {
            $('#msj2').html('Por favor seleccione una pregunta y escriba la respuesta');
        } else {
            $.ajax({
                type: "POST",
                dataType: "html",
                url: DIR + "sac/chk_respuesta",
                data: 'usuario='+txt_usuario+'&nocuenta='+txt_nocuenta+'&pregunta='+slt_pregunta+'&respuesta='+txt_respuesta,
                beforeSend:function(){
                    $('#msj2').html('Validando información');
                },
                success: function(msg){
                    $('#msj2').html(msg);
                }
            });
        }
    });
});
function realizar_pago() {
    var lnk = $(this);
    $.ajax({
        type: "POST",
        dataType: "html",
        url: DIR + "sac/chk_session",
        beforeSend:function(){
            NProgress.start();
        },
        success: function(msg){
            NProgress.done();
            if(msg=='false') {
                $('nav a').removeClass('activate');
                lnk.addClass('activate');
                $('#pagoturecibo').animate({
                    height:294
                }, 300, function(){
                    $('.wrapper, hr').fadeIn('fast');
                });
            }
            else {
                window.location.href = DIR + 'sac/pagaturecibo';
            }
        }
    });
}
function close_pago() {
    $('#pagoturecibo').animate({
        height:0
    }, 200, function(){});
}
function paso2() {
    $('#paso2').fadeIn();
}
function paso3() {
    $('#btn_paso2').hide();
}
function aMays(e, elemento) {
tecla=(document.all) ? e.keyCode : e.which; 
 elemento.value = elemento.value.toUpperCase();
}