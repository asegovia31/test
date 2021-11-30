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
//require_once("scripts/conexion2.php");

    //print_r($_POST['men']);exit(0);
//print_r($_POST);exit(0);
    //$id=($_POST['id']);
if(isset($_POST['men'])){
    $today = date("Y-m-d");
    $filename=($_POST['men']);

  $ids= DB::select("SELECT max(id)+1 as id FROM mensaje");
  $ids2=$ids[0]->id;

//print_r($ids[0]->id);exit(0);

   $sql= DB::insert("INSERT INTO mensaje (id,mensaje,fecha) VALUES ($ids2,'$filename','$today')") ;
//$res=mysql_query($sql);
//print_r($sql);exit(0);
//print_r($sql);exit(0);

   $sql2= DB::select("SELECT * FROM mensaje WHERE mensaje='$filename'");
   //$res2=mysql_query($sql2);
   if($sql2[0]->mensaje<>''){
       echo "<script language = javascript>
               swal({  title: 'Exito!',
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

     }else{
     echo "<script language = javascript>
               swal({  title: 'Exito!',
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
