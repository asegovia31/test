<html>
<head><title></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <script type="text/javascript" src="{{url('/js/jquery-3.1.1.min.js')}}"></script>
   <script type="text/javascript" src="{{url('/js/Validaciones.js')}}"></script>
   <script src="{{url('/js/sweetalert.min.js')}}"></script>
   <link rel="stylesheet" type="text/css" href="{{url('/css/sweetalert.css')}}">
</head>



<body>
<?php
//require_once("scripts/conexion.php");
date_default_timezone_set('UTC');
$hoy = date("Y-m-d");
$dia1 = date("Y-m-d",strtotime( '+1 day' , strtotime($hoy)));

//$id = $_GET['id'];
//Creamos la sentencia SQL y la ejecutamos
$sSQL = DB::delete(" DELETE FROM usuarios WHERE correo='$id' ");
//$resultado = mysql_query($sSQL);
//print_r($sSQL);exit(0);


if ($sSQL==1) {
 echo "<script language = javascript>
               swal({  title: 'Exito!',
                text: 'Usuario Eliminado Correctamente',
               type: 'success',
               showCancelButton: false,
               closeOnConfirm: false,
               confirmButtonText: 'Aceptar',
               showLoaderOnConfirm: true, },
               function(){
                   setTimeout(function(){
                       location = '../cuentas_users';
                   });
                    });
           </script>";
}
else
{
 echo "<script language = javascript>
                       swal({  title: 'Lo sentimos',
                        text: 'Usuario No Pudo Ser Eliminado',
                       type: 'error',
                       showCancelButton: false,
                       closeOnConfirm: false,
                       confirmButtonText: 'Aceptar',
                       showLoaderOnConfirm: true, },
                       function(){
                           setTimeout(function(){
                               location = '../cuentas_users';
                           });
                            });
                     </script>";
}

?>
