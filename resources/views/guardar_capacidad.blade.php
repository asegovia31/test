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
     $txtSem = $_POST['txtSem'];
     $txtSab = $_POST['txtSab'];
     $txtTipo = $_POST['txtTipo'];

           if (isset($_POST['btnGuardar'])) {
      //       $link = mysqli_connect("localhost","root","root","agenda");
             $cambiar = DB::update("UPDATE capacidad SET semana='$txtSem' , finde='$txtSab' WHERE tipo_manejo='$txtTipo'");
  //             if (mysqli_query($link, $cambiar)) {

                 if(isset($cambiar)){
                 echo "<script language = javascript>
               swal({  title: 'Exito!',
                text: 'Capacidad Actualizada correctamente',
               type: 'success',
               showCancelButton: false,
               closeOnConfirm: false,
               confirmButtonText: 'Aceptar',
               showLoaderOnConfirm: true, },
               function(){
                   setTimeout(function(){
                       location = 'parametros';
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
                       location = 'parametros';
                   });
                    });
           </script>";
     }
}
        ?>
