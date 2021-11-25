<?php
 $hoy = date("Y-m-d");
 $dia1 = date("Y-m-d",strtotime( '+1 day' , strtotime($hoy)));
 //EJECUTO LA CONSULTA EN LA ITERACION
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<meta http-equiv="refresh" content="30" >
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<script>
var elem = $('#mySidenav');
//Abre el menu de navegacion con ancho del 100%
function openNav() {
    document.getElementById("mySidenav").style.width = "100%";
}
//Cierra el menu de navegacion
function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}
function openNavi() {
    document.getElementById("myMensaje").style.width = "40%";
}
//Cierra el menu de navegacion
function closeNavi() {
    document.getElementById("myMensaje").style.width = "0";
}
</script>
</head>
<body>
<div id="contenedor">
<div id="header">
<img src="{{url('/img/logoripley.png')}}" style="float:left; margin-left:40px; margin-top:20px;"  height="50" width="120"/>
<!--<img src="img/logoripley2.png" style="float:left; margin-left:40px; margin-top:20px;"  height="50" width="120"/>-->
<h2>Agenda Proveedores Nacionales V2 </h2>
</div>
<div id="menu">
<a href="{{url('/')}}" ><div id="btn-menu">Agenda Proveedor</div></a>
<a href="{{url('/documentos')}}" ><div id="btn-menu">Documentos</div></a>
<a href="{{url('/login')}}" ><div id="btn-menu">Login</div></a>
</div>


<a href="#"><div id="box-msg" style="background-color:#731472;" onclick="openNav()">
 <img src="{{url('/img/error.png')}}" height="65" width="65" style="float:left;"/> Ver Errores de Agenda </div></a>

<div id="box-msg2" style="background-color:#f0c101; font-size:10px;">
   <div id="box-msg-tit">Nota del Día</div>
     @yield('mensajenotas')
</div>


<div id="box-msg" style="background-color:#cf152d;">
   <img src="{{url('/img/update.png')}}" height="75" width="75" style="float:left;"/>
    @yield('actualizados')
</div>


<!-- ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: -->

<div id="mySidenav" class="sidenav">
 <a href="javascript:void(0)" class="closebtn"  onclick="closeNav()">&times;</a>
 <a href="#" id="top">Agendas Pre-Distribuido Cajas/Sensible Sábado</a>
 <table>
       <th>Numero de cita</th>
       <th>Tipo Manejo</th>
       <th>Fecha de cita</th>
       <th>Tipo de OC</th>
       <th>Unidades</th>
       <th>Razón social</th>

 </table>

 @yield('inconsistencia_en_programacion')

 @yield('errores_de_agenda')

	<a href="#top"><img src="{{url('/img/flecha.png')}}" height="50" width="50" /></a>

</div>

<!-- ***************************************************************************************************************************************-->
<!-- DESDE AQUI GRILLA DE AGENDA -->

<!-- ***************************************************************************************************************************************-->

<div id="main">
<div id="box-agenda">


<div id="box-tit" style="height: 100px"><a href="{{url('/export/agenda_agrupada/')}}">
  <button id="btn-descarga" class="btn-descarga">Descargar Agenda agrupada</button>
	<br><br><a href="{{url('/export/agenda_linea/')}}">
    <button id="btn-descarga" class="btn-descarga">Descargar Agenda Lineas</button>
	<br><br><a href="{{url('/export/agenda_sku/')}}">
    <button id="btn-descarga" class="btn-descarga">Descargar Agenda SKU</button>
  </a>
  Estatus Agenda Próximos 14 días
 </div>

<!-- MOSTRAMOS LAS FECHAS-->
<div id="grilla_fila1">
<div id="grilla_type11">Tipo Manejo</div>
<div id="grilla_type12">Unidades MAX </br>(Lun. a Vier. | Sáb.)</div>
<?php for($i=0 ; $i<=13 ; $i++){
$d='+ '.$i." ".'day';
$dia=date("Y-m-d",strtotime($d ,strtotime($hoy)));
$position_day=date("w",strtotime($dia));
if($position_day=='0'){
?>
<div id="grilla_type22" style="color:#fff; background-color:#FF0000; font-weight:bold;"> <?php echo date("d-M",strtotime($dia));?></div>
<?php }else if($position_day=='6'){?>
<div id="grilla_type22" style="color:#FFF; font-weight:bold;"> <?php echo date("d-M",strtotime($dia));?></div>
<?php }else{?>
<div id="grilla_type22"> <?php echo date("d-M",strtotime($dia));?></div>
<?php }}?>
</div>



<!-- **************************************************************************************************************************-->
<!-- BUSCAMOS INFORMACION RELACIONADA CON CAJAS-->
<!-- **************************************************************************************************************************-->

@yield('contenedor_general')

<!-- **************************************************************************************************************************-->
<!-- BUSCAMOS INFORMACION RELACIONADA CON SENSIBLE-->
<!-- **************************************************************************************************************************-->

@yield('info_rel_sensible')


<!-- **************************************************************************************************************************-->
<!-- BUSCAMOS INFORMACION RELACIONADA CON COLGADO-->
<!-- **************************************************************************************************************************-->

@yield('info_rel_colgado')

<!-- **************************************************************************************************************************-->
<!-- BUSCAMOS INFORMACION RELACIONADA CON GVO-->
<!-- **************************************************************************************************************************-->

@yield('info_rel_gvo')

<!-- **************************************************************************************************************************-->
<!-- BUSCAMOS INFORMACION RELACIONADA CON COLCHONERIA MUEBLES LINEA BLANCA -->
<!-- **************************************************************************************************************************-->

@yield('info_rel_col_mueb_lin_blanca')

<!-- **************************************************************************************************************************-->
<!-- BUSCAMOS INFORMACION RELACIONADA CON TV VIDEO -  ALFOMBRAS - BT CAJAS -->
<!-- **************************************************************************************************************************-->

@yield('info_rel_tv_video_alfombras_btcajas')

<!-- **************************************************************************************************************************-->
<!-- COMIENZO DE PUERTA EXPRESS -->
<!-- **************************************************************************************************************************-->
<div id="box-agenda">
<div id="box-tit"><a href="{{url('/export/puertaexpress/')}}"><button id="btn-descarga" class="btn-descarga">Descargar Puerta</button></a>Estatus Puerta Express Próximos 14 días</div>
@yield('puertaexpress')




</body>
</html>
