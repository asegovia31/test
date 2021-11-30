<?php
session_start();
if (isset($_SESSION['nombre_user'])) {
    # code...

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
<script type="text/javascript" src="{{url('/js/jquery-3.1.1.min.js')}}"></script>
<script type="text/javascript" src="{{url('/js/jquery-latest.js')}}"></script>
<script type="text/javascript" src="{{url('/js/jquery.tablesorter.min.js')}}"></script>
<link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />
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

<?php
$resp=DB::select("SELECT top 1 * FROM mensaje ORDER BY id DESC ");
//$res=mysql_query($sql);
//$resp=mysql_fetch_array($res);
//print_r($resp[0]->fecha);exit(0);
?>


<div id="main">
  <form name="frmCrea" action="{{url('mensaje_ins')}}" method="post">
   @csrf
      <div id="box-tit">Último Mensaje Ingresado <?php echo $resp[0]->fecha;?></div>
      <ul>
        <li style="color:#FFFFFF;">
      		<textarea  name="men" rows="12" cols="80" style="margin-left:300px; font-family:Arial, Helvetica, sans-serif; font-size:12px; padding:5px;"><?php echo $resp[0]->mensaje;?></textarea>
      	</li>
          <input type="hidden" name="id" class="id" value="1" />
        <li style="color:#FFFFFF;">
          <button type="submit" name="btnMensaje" class="btnMensaje" style="margin-left:300px;">Grabar Mensaje</button>
        </li>
	</ul>
    </form>
<div id="box-tit"></div>
</div>
<?php
} else {

    echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Acceso Denegado')
    window.location.href='public';
    </SCRIPT>");



}
?>
</div>


</body>
</html>
