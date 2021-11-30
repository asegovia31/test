<?php
session_start();
if (isset($_SESSION['nombre_user'])) {
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
<script src="{{ url('/js/calendar/src/js/jscal2.js') }}"></script>
<script src="{{ url('/js/calendar/src/js/lang/en.js') }}"></script>
<link rel="stylesheet" type="text/css" href="{{ url('css/calendar/src/css/jscal2.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ url('css/calendar/src/css/border-radius.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ url('css/calendar/src/css/steel/steel.css') }}" />


<script>
        $(function(){
          $("#myTable").tablesorter({widgets: ['zebra']});
        });
</script>
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


 <a href="{{url('cuentas_users')}}"><div id="box-msg3" style="background-color:#731472;" onclick="openNav()">
  <img src="{{url('/img/users.png')}}" height="90" width="90" style="float:left;"/> Administrar Cuentas de Usuarios </div></a>


<a href="{{url('Documentosadmin')}}"><div id="box-msg3" style="background-color:#1d6f44;" onclick="openNav()">
  <img src="{{url('/img/files.png')}}" height="90" width="90" style="float:left;"/>Administrar  Documentos</div></a>

<a href="{{url('mensaje')}}"><div id="box-msg3" style="background-color:#e20821;" onclick="openNav()">
  <img src="{{url('/img/msje2.png')}}" height="90" width="90" style="float:left;"/> Administrar Mensaje</div></a>


<a href="{{url('capacidades')}}"><div id="box-msg3" style="background-color:#fbc040;" onclick="openNav()">
  <img src="{{url('/img/capacidad.png')}}" height="90" width="90" style="float:left;"/> Administrar Capacidades </div></a>


<div id="main">


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
