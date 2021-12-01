<html>
<head><title></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <script type="text/javascript" src="{{ url('/js/jquery-3.1.1.min.js') }}"></script>
   <script type="text/javascript" src="{{ url('/js/Validaciones.js') }}"></script>
   <script src="{{ url('/js/sweetalert.min.js') }}"></script>
   <link rel="stylesheet" type="text/css" href="{{ url('/css/sweetalert.css') }}">
</head>
<body>
<?php
  // require_once("scripts/conexion.php");
   date_default_timezone_set('UTC');
    $hoy = date("Y-m-d");
    $dia1 = date("Y-m-d",strtotime( '+1 day' , strtotime($hoy)));


    $target = "upload/";
    $target = $target . basename( $_FILES['fileToUpload']['name']) ;
    $ok=1;

    $name=($_FILES['fileToUpload']['name']);
    $filename = mysql_real_escape_string($name);
    $today = date("Y-m-d");

    $consultabase = DB::select("SELECT * FROM documentos WHERE nombre='$filename' ");
    //$resultadobase = mysql_fetch_array($consultabase);

    $nombre = $consultabase[0]->nombre;
    if (empty($nombre)) {
       DB::insert("INSERT INTO documentos (id,nombre,fecha) VALUES ('','$filename','$today')") ;
    }
    else
    {
        DB::update("UPDATE documentos SET nombre='$filename',fecha='$today'  WHERE nombre='$filename'");
    }





   //Revisamos que la valirable $ok no haya sido puesta en 0 por error
   if ($ok==0)
    {
       Echo "Lo sentimos, tu archivo no fue subido";
    }

    //Si todo salio bien tratamos de subir el archivo

    else
    {


      //obtenemos el campo file definido en el formulario
      $file = $request->file('fileToUpload');

      //obtenemos el nombre del archivo
      $nombre = $file->getClientOriginalName();

      //indicamos que queremos guardar un nuevo archivo en el disco local
      $guardado=Storage::disk('local')->put($nombre,  \File::get($file));

       if(!empty($guardado))
           {
                echo "<script language = javascript>
               swal({  title: 'Exito!',
                text: 'Su archivo fue cargado satisfactoriamente',
               type: 'success',
               showCancelButton: false,
               closeOnConfirm: false,
               confirmButtonText: 'Aceptar',
               showLoaderOnConfirm: true, },
               function(){
                   setTimeout(function(){
                       location = 'DocumentosAdmin.php';
                   });
                    });
           </script>";
           }
           else
           {
               echo "<script language = javascript>
                       swal({  title: 'Lo sentimos',
                        text: 'Su archivo no pudo ser cargado',
                       type: 'error',
                       showCancelButton: false,
                       closeOnConfirm: false,
                       confirmButtonText: 'Aceptar',
                       showLoaderOnConfirm: true, },
                       function(){
                           setTimeout(function(){
                               location = 'DocumentosAdmin.php';
                           });
                            });
                     </script>";
           }
    }
?>
