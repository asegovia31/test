<html>
<head><title></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="{{ url('/js/jquery-3.1.1.min.js') }}"></script>
<script type="text/javascript" src="{{url('/js/Validaciones.js')}}"></script>
<script src="{{url('/js/sweetalert.min.js')}}"></script>
<link rel="stylesheet" type="text/css" href="{{url('/css/sweetalert.css')}}">
</head>
<body>
<?php
//require_once("scripts/conexion2.php");

//echo $_POST['txtSab'];
  //  print_r($_POST['txtSem']);print_r($_POST['txtSab']);print_r($_POST['txtTipo']);exit(0);



                $txtFechCita = $_POST['txtFechCita'];
     				    $txtNroCita  = $_POST['txtNroCita'];
     				    $txtRutProv  = $_POST['txtRutProv'];
                $txtTipoRec  =  $_POST['txtTipoRec'];
                $txtCantUndAgendada =  $_POST['txtCantUndAgendada'];
                $txtNroOC  =  $_POST['txtNroOC'];
                $txtDescMetDiscOC =  $_POST['txtDescMetDiscOC'];
                $txtDescTipOC = $_POST['txtDescTipOC'];
                $txtFechCanc  = $_POST['txtFechCanc'];
                $txtProveedor = $_POST['txtProveedor'];
                $txtTipoManej = $_POST['txtTipoManej'];
                $txtDepart    =  $_POST['txtDepart'];
                $txtBultos    =  $_POST['txtBultos'];
                $txtCC    =  $_POST['txtCC'];
                $txtDivision =   $_POST['txtDivision'];
                $txtDivisional =   $_POST['txtDivisional'];
                $txtHorario =  $_POST['txtHorario'];
                $txtObserv  =  $_POST['txtObserv'];
                $txtDespExpress = $_POST['txtDespExpress'];
                $txtLugarRec  =    $_POST['txtLugarRec'];
                $id  =    $_POST['id'];





           if (isset($_POST['btnUpdate'])) {
      //       $link = mysqli_connect("localhost","root","root","agenda");
             $cambiar = DB::update("UPDATE puertaexpress SET  fech_cta='$txtFechCita',
                                                              nro_cta='$txtNroCita',
                                                              rut_proveedor='$txtRutProv',
                                                              tip_rec='$txtTipoRec',
                                                              cant_unid_agen='$txtCantUndAgendada',
                                                              nro_oc='$txtNroOC',
                                                              desc_met_dist_oc='$txtDescMetDiscOC',
                                                              desc_tipo_oc='$txtDescTipOC',
                                                              fech_canc='$txtFechCanc',
                                                              proveedor='$txtProveedor',
                                                              tipo_manejo='$txtTipoManej',
                                                              dpto='$txtDepart',
                                                              bultos='$txtBultos',
                                                              cc='$txtCC',
                                                              division='$txtDivision',
                                                              divisional='$txtDivisional',
                                                              horario='$txtHorario',
                                                              observacion='$txtObserv',
                                                              despacho_express='$txtDespExpress',
                                                              lugar_recibo='$txtLugarRec'

                                                              WHERE nro_cta ='$id' ");
  //             if (mysqli_query($link, $cambiar)) {

                 if(isset($cambiar)){
                 echo "<script language = javascript>
               swal({  title: 'Exito!',
                text: 'Cita Actualizada correctamente',
               type: 'success',
               showCancelButton: false,
               closeOnConfirm: false,
               confirmButtonText: 'Aceptar',
               showLoaderOnConfirm: true, },
               function(){
                   setTimeout(function(){
                       location = 'upd/$id';
                   });
                    });
           </script>";


     }else{
     echo "<script language = javascript>
               swal({  title: 'error!',
                text: 'Mensaje cargado correctamente',
               type: 'success',
               showCancelButton: false,
               closeOnConfirm: false,
               confirmButtonText: 'Aceptar',
               showLoaderOnConfirm: true, },
               function(){
                   setTimeout(function(){
                       location = 'upd';
                   });
                    });
           </script>";
     }
}
        ?>
