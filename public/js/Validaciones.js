$(function ()
{

    var numeros = '1234567890';
    var letras  = 'qwertyuiopñlkjhgfdsazxcvbnm' +
                    'QWERTYUIOPASDFGHJKLÑZXCVBNM' +
                    'ÁÉÍÚÓáéúíó';

    //Validacion de caracteres



    $('.txtNroCita').keypress(function(e)
    {
       var letra = String.fromCharCode(e.which);
       if(numeros.indexOf(letra) < 0)
           return false;
    });
    $('.txtBultos').keypress(function(e)
    {
       var letra = String.fromCharCode(e.which);
       if(numeros.indexOf(letra) < 0)
           return false;
    });
    $('.txtNroOC').keypress(function(e)
    {
       var letra = String.fromCharCode(e.which);
       if(numeros.indexOf(letra) < 0)
           return false;
    });
    $('.txtFechCita').keypress(function(e)
    {
       var letra = String.fromCharCode(e.which);
       var digitos = numeros + '-';
       if(digitos.indexOf(letra) < 0)
           return false;
    });
    $('.txtRutProv').keypress(function(e)
    {
       var letra = String.fromCharCode(e.which);
       if(numeros.indexOf(letra) < 0)
           return false;
    });
    $('.txtCantUndAgendada').keypress(function(e)
    {
       var letra = String.fromCharCode(e.which);
       if(numeros.indexOf(letra) < 0)
           return false;
    });
    $('.txtSemana').keypress(function(e)
    {
       var letra = String.fromCharCode(e.which);
       if(numeros.indexOf(letra) < 0)
           return false;
    });
    $('.txtPass').keypress(function(e)
    {
       var letra = String.fromCharCode(e.which);
       var todo = numeros + letras;
       if(todo.indexOf(letra) < 0)
           return false;
    });

    $('.txtTipoRec , .txtDescMetDiscOC , .txtDescTipOC , .txtFlagB2B, .txtFlagEven , .txtProveedor, .txtTipoManej , .txtNomUser').keypress(function(e)
    {
       var letra = String.fromCharCode(e.which);
       if(letras.indexOf(letra) < 0)
           return false;
    });

    $('.txtSem').keypress(function(e)
    {
       var letra = String.fromCharCode(e.which);
       if(numeros.indexOf(letra) < 0)
           return false;
    });
    $('.txtSab').keypress(function(e)
    {
       var letra = String.fromCharCode(e.which);
       if(numeros.indexOf(letra) < 0)
           return false;
    });

    $('.btnEnviar').click(function()
    {
        if (!$('.txtFechCita').val())
         {
            $('.txtFechCita').focus();
            sweetAlert('Falta fecha de cita','','error');
            return false;
         }
         if (!$('.txtNroCita').val())
         {
            $('.txtNroCita').focus();
            sweetAlert('Falta numero de cita','','error');
            return false;
         }
         if (!$('.txtRutProv').val())
         {
            $('.txtRutProv').focus();
            sweetAlert('Falta Rut Proveedor','','error');
            return false;
         }
         if (!$('.txtTipoRec').val())
         {
            $('.txtTipoRec').focus();
            sweetAlert('Falta Tipo de recepcion','','error');
            return false;
         }
         if (!$('.txtCantUndAgendada').val())
         {
            $('.txtCantUndAgendada').focus();
            sweetAlert('Falta la  cantidad de unidades agendadas','','error');
            return false;
         }
         if (!$('.txtNroOC').val())
         {
            $('.txtNroOC').focus();
            sweetAlert('Falta numero OC','','error');
            return false;
         }
         if (!$('.txtDescTipOC').val())
         {
            $('.txtDescTipOC').focus();
            sweetAlert('Falta descripcion tipo oc','','error');
            return false;
         }
         if (!$('.txtFechCanc').val())
         {
            $('.txtFechCanc').focus();
            sweetAlert('Falta fecha de cancelacion','','error');
            return false;
         }
         if (!$('.txtProveedor').val())
         {
            $('.txtProveedor').focus();
            sweetAlert('Falta Proveedor','','error');
            return false;
         }
         if (!$('.txtTipoManej').val())
         {
            $('.txtTipoManej').focus();
            sweetAlert('Falta Tipo de manejo','','error');
            return false;
         }
         if (!$('.txtDepart').val())
         {
            $('.txtDepart').focus();
            sweetAlert('Falta departamento','','error');
            return false;
         }
         if (!$('.txtBultos').val())
         {
            $('.txtBultos').focus();
            sweetAlert('Falta bultos','','error');
            return false;
         }
         if (!$('.txtCC').val())
         {
            $('.txtCC').focus();
            sweetAlert('Falta CC','','error');
            return false;
         }
         if (!$('.txtDivisional').val(e))
         {
            $('.txtDivisional').focus();
            sweetAlert('Falta Divisional','','error');
            return false;
         }
         if (!$('.txtHorario').val())
         {
            $('.txtHorario').focus();
            sweetAlert('Falta Horario','','error');
            return false;
         }
         if (!$('.txtDespExpress').val())
         {
            $('.txtDespExpress').focus();
            sweetAlert('Falta Despacho express','','error');
            return false;
         }
         if (!$('.txtLugarRec').val())
         {
            $('.txtLugarRec').focus();
            sweetAlert('Falta Lugar de recibo','','error');
            return false;
         }


     });

     $('.btnCrear').click(function () {

       if (!$('.txtCorreo').val())
        {
           $('.txtCorreo').focus();
           sweetAlert('Falta Ingresar Correo','','error');
           return false;
        }
        if (!$('.txtNomUser').val())
         {
            $('.txtNomUser').focus();
            sweetAlert('Falta nombre de usuario','','error');
            return false;
         }
         if (!$('.txtPass').val())
          {
             $('.txtPass').focus();
             sweetAlert('Falta ingresar contraseña','','error');
             return false;
          }
     });

     $('.btnGuardar').click(function () {

       if (!$('.txtSem').val())
        {
           $('.txtSem').focus();
           sweetAlert('No ingreso capacidad para semana','','error');
           return false;
        }
        if (!$('.txtSab').val())
        {
            $('.txtSab').focus();
            sweetAlert('No ingreso capacidad para sabado','','error');
            return false;
        }
     });

   });
