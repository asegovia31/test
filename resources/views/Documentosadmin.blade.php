<?php
session_start();
if (isset($_SESSION['nombre_user'])) {
    # code...



if(isset($est))
{
?>
  <html>
  <head><title></title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
     <script type="text/javascript" src="{{url('/js/jquery-3.1.1.min.js')}}"></script>
     <script type="text/javascript" src="{{url('/js/Validaciones.js')}}"></script>
     <script src="{{url('/js/sweetalert.min.js')}}"></script>
     <link rel="stylesheet" type="text/css" href="{{url('/css/sweetalert.css')}}">
  </head>
  <body></body></html>
  <?php

   date_default_timezone_set('UTC');
   $hoy = date("Y-m-d");
   $dia1 = date("Y-m-d",strtotime( '+1 day' , strtotime($hoy)));
   //$target = "upload/";
   //$target = $target . basename( $_FILES['fileToUpload']['name']) ;
   //$name=($_FILES['fileToUpload']['name']);
   //$filename = mysql_real_escape_string($name);
   $today = date("Y-m-d");

   $consultabase = DB::select("SELECT * FROM documentos WHERE nombre='$filename' ");
   //$resultadobase = mysql_fetch_array($consultabase);


   //$nombre = $consultabase[0]->nombre;

   if (empty($consultabase)) {

    $maxid = DB::select(" SELECT max(id)+1 as id FROM documentos");
    $ids = $maxid[0]->id;

    $ins =  DB::insert("INSERT INTO documentos (id,nombre,fecha) VALUES ('$ids','$filename','$today')") ;

   }
   else
   {
       DB::update("UPDATE documentos SET nombre='$filename',fecha='$today'  WHERE nombre='$filename'");
   }

   if (Storage::disk('local')->exists($filename)) {

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
             location = '../Documentosadmin';
         });
          });
    </script>";
  }else{

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
                      location = '../Documentosadmin';
                  });
                   });
            </script>";
  }



}
//exit(0);

//require_once("scripts/conexion.php");
date_default_timezone_set('UTC');
 $hoy = date("Y-m-d");
 $dia1 = date("Y-m-d",strtotime( '+1 day' , strtotime($hoy)));

 if(isset($_POST['btnEliminar']))
{ eliminarFormulario($_POST[$result['nombre']]);
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Agenda Redex</title>
<script type="text/javascript" src="{{ url('/js/jquery-3.1.1.min.js') }}"></script>
<script type="text/javascript" src="{{ url('/js/jquery-latest.js') }}"></script>
<script type="text/javascript" src="{{ url('/js/jquery.tablesorter.min.js') }}"></script>
<link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />

   <script src="{{ url('/js/sweetalert.min.js') }}"></script>
   <link rel="stylesheet" type="text/css" href="{{ url('/css/sweetalert.css') }}">

<script>
        $(function(){
          $("#myTable").tablesorter({widgets: ['zebra']});
        });
</script>
<style>
.nav th
{
    background-color: #e20821;
    color: white;
}
th.header {
    background-image: url(img/bg.gif);
    cursor: pointer;
    font-weight: bold;
    background-repeat: no-repeat;
    background-position: center left;
    padding-left: 20px;
    border-right: 1px solid #dad9c7;
    margin-left: -1px;
}
th.headerSortUp {
    background-image: url(img/asc.gif);
    background-color: #7a5490;
}
th.headerSortDown {
    background-image: url(img/desc.gif);
    background-color: #7a5490;
}
.nav td
{
    color: black;
    font-size: 13px;
    border: 1px solid #c2daea;
}
table {
    height: auto;
    border: 1px solid #c2daea;
    overflow: scroll;
    width: 100%;
    margin: 2% auto 0;
    border-radius:5px;
    box-shadow: 0 0 4px rgba(0, 0, 0, 0.2);
}
</style>
</head>

<body>

<div id="contenedor">

<div id="header">
<img src="{{url('/img/logoripley.png')}}" style="float:left; margin-left:40px; margin-top:20px;"  height="50" width="120"/>
<img src="{{url('/img/logoripley2.png')}}" style="float:left; margin-left:40px; margin-top:20px;"  height="50" width="120"/>
<h2>Agenda Proveedores Nacionales V2</h2>
<h3 align="right" style="color:#FFFFFF; font-size:12px;;">Usuario:  <?php echo $_SESSION['nombre_user'];?></h3>
</div>
<div id="menu">
<a href="{{url('indexadmin')}}" ><div id="btn-menu">Agenda proveedor</div></a>
<a href="{{url('puertaexpress')}}" ><div id="btn-menu">Puerta Express</div></a>
<a href="{{url('parametros')}}" ><div id="btn-menu">Parámetros</div></a>
<a href="{{url('logout')}}"><div id="btn-menu">Cerrar Sesión</div></a>
</div>

<div id="main">
  <form name="frmUpload" class="frmUpload" action="{{url('storage/create')}}" method="post" enctype="multipart/form-data">
   <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <ul>
        <div id="box-tit">Subir archivos</div>
      	<li>
          <label for="">Seleccionar Archivo: </label>
          <input type="file" name="fileToUpload" id="fileToUpload">
          <input type="submit" value="Subir Archivo" name="submit">
      	</li>
      </ul>
    </form>


<?php
$consultadoc = DB::select("SELECT * FROM documentos");
//$resultadodoc = mysql_query($consultadoc);


 ?>
<div id="box-agenda">
    <div class="nav">
        <div id="box-tit">Archivos descargables</div>
            <table id="myTable" class="tablesorter">
            <thead>
                <tr>
                    <th>Nombre del Archivo</th>
                    <th>Fecha Subida</th>
                    <th>Eliminar</th>
                    <th>Descargar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                  //while ($result=(mysql_fetch_array($resultadodoc))) {

                  foreach($consultadoc as $result){

                    ?>
                        <tr>
                            <td class="nombre"><?php echo $result->nombre; ?></td>
                            <input type="hidden" name="id" value="<?php echo $result->id; ?>" />
                            <td><?php echo $result->fecha; ?></td>
                            <td align="center">
                            <a href="{{url('Delete_doc',[$result->id])}}">
                            <img src="{{url('/img/delete.png')}}"/></a></td>
                            <td align="center">
                            <a href="{{url('Descarga_doc',[$result->nombre])}}"><img src="{{url('/img/download.png')}}" /></a></td>
                        </tr>
                        <?php

                            }
//print_r(Storage::disk('local')->exists($filename));exit(0);



                          //}else{





                          //}




                ?>
                </tbody>
            </table>
    </div>
</div>


</div>
<?php
} else {

    echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Acceso Denegado')
    window.location.href='index.php';
    </SCRIPT>");



}
?>
</div>


</body>
</html>