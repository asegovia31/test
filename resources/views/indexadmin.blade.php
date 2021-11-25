<?php
session_start();
if (isset($_SESSION['nombre_user'])) {
	# code...

//require_once("scripts/conexion.php");
date_default_timezone_set('UTC');
 $hoy = date("Y-m-d");
 $dia1 = date("Y-m-d",strtotime( '+1 day' , strtotime($hoy)));
 //EJECUTO LA CONSULTA EN LA ITERACION
 //
 $today = date("Y-m-d");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<meta http-equiv="refresh" content="30" >
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Agenda Redex</title>
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
<style>
	.sidenav, .sidenavi {
    height:99%;
    width: 0;
    position: fixed;
    z-index: 1;
    top: 0;
    left: 0;
    background-color: #fff;
    overflow-x: scroll;
    transition: 0.5s;
    padding-top: 10px;
    text-align:center;
}
	.sidenavi {
    height:50%;
    width: 0;
    position: fixed;
    z-index: 1;
    top: 0;
    left: 0;
    background-color: #115990;
    overflow-x: scroll;
    transition: 0.5s;
    padding-top: 10px;
    text-align:center;
}

.sidenav a, .sidenavi a{

    text-decoration: none;
    font-size: 16px;
    display: block;
    transition: 0.3s;
	color:#cf152d;
	font-weight:bold;
	margin-bottom:-20px;
	text-decoration:underline;

}
.sidenav label, .sidenavi label{
    padding: 8px 8px 8px 8px;
    text-decoration: none;
    font-size: 10px;
    color: #666666;
    display: block;
    transition: 0.3s;

}
.sidenav td, .sidenavi td
{
	color: #666666;
	font-size: 10px;
	border: 1px solid #ccc;


}
.sidenavi textarea
{
	color: black;
	font-size: 12px;
	resize: none;
}
.sidenav th , .sidenavi th
{
	background-color: #f0c101;
	color: #fff;
	font-size:12px;
}


.sidenav a:hover , .sidenavi a:hover {
    color: #f1f1f1;
}

.sidenav .closebtn, .sidenavi .closebtn {
    position: absolute;
    top: 0;
    right: 25px;
    font-size: 20px;
    margin-left: 50px;
	color:#000000;
}
table {
	height: auto;
    border: 1px solid #ccc;
    overflow: scroll;
    width: 1200px;
    margin: 2% auto 0;
    margin-bottom: 3%;
    color:#666666;

}
#btn-despleg
{
   float: left;
  font-size: 14px;
  font-weight: bold;
  color: #666666;
  background-color: red;

}
#btn-desplega
{
  padding: 15px;
  float: left;
  font-size: 14px;
  font-weight: bold;
  color: #666666;
  background-color: green;

}
#btn-despleg:hover {
  background-color: #F55050;
  transition: all .3s linear;
}
#btn-desplega:hover {
  background-color: #AEE188;
  transition: all .3s linear;
}

@media screen and (max-height:100%) {
  .sidenav {padding-top: 10px;}
  .sidenav a {font-size: 14px;}
  .sidenav label {font-size: 10px;}
}
</style>
<link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="contenedor">
<div id="header">
<img src="{{url('/img/logoripley.png')}}" style="float:left; margin-left:40px; margin-top:20px;"  height="50" width="120"/>
<img src="{{url('/img/logoripley2.png')}}" style="float:left; margin-left:40px; margin-top:20px;"  height="50" width="120"/>
<h2>Agenda Proveedores Nacionales V2</h2>
<h3 align="right" style="color:#FFFFFF; font-size:12px;;">Bienvenido:  <?php echo $_SESSION['nombre_user'];?></h3>
</div>
<div id="menu">
<a href="{{url('indexadmin')}}" ><div id="btn-menu">Agenda proveedor</div></a>
<a href="{{url('puertaexpress')}}" ><div id="btn-menu">Puerta Express</div></a>
<a href="{{url('parametros')}}" ><div id="btn-menu">Parámetros</div></a>
<a href="{{url('logout')}}"><div id="btn-menu">Cerrar Sesión</div></a>
</div>
<?php
//ERROR DE CONSTENCIA EN LA PROGRAMACION
//$cons=DB::select("SELECT * FROM capacidad WHERE tipo_manejo='PtaExpress'");
$consutadis =DB::select("SELECT DISTINCT (cita),
                           digita_inicio,
                           fech_cita,
                           decrip_depto,
                           rs FROM
                                      citas
                                        WHERE fech_cita = getdate()
                                        AND  cita NOT IN (SELECT DISTINCT (nro_cita) FROM programacion)");

//$consutadis=DB::select("SELECT * FROM capacidad WHERE tipo_manejo='PtaExpress'");
//$consutadis = mysql_query($sql);


$resultadoasrawr = DB::select("SELECT * FROM citas WHERE tipo_orden IN('ASR', 'AWR')  AND sin_pred > 0 ");
//$resultadoasrawr = mysql_query($sqlasr);
//FECHA DE CITA TIENE QUE SER LA MISMA QUE LA CANCELACION, EN CASO CONTRARIO MUESTRA EL ERROR
$resultnoagen =DB::select("SELECT * FROM citas WHERE tipo_orden in('ASR','AWR') AND fech_cita != cancela_oc ");
//$resultnoagen = mysql_query($sqlnoagen);
$resultpre =DB::select("SELECT * FROM citas WHERE distribucion='OC Predistribuida' and con_pred > 0 ");
//$resultpre = mysql_query($sqlpre);

$resulsimple =DB::select("SELECT * FROM citas WHERE distribucion ='OC Simple' and con_pred > 0 and tipo_orden ='Almacenaje Proveedor'");
//$resulsimple = mysql_query($sqlsimple);
 ?>
 <!-- CUADROS DE ANALISIS -->
<?php

$consultamensj	= DB::select("SELECT * FROM mensaje WHERE fecha='$hoy'");

if(!empty($consultamensj)){
foreach($consultamensj as $arreglomsj)
{
$msj=$arreglomsj->mensaje;
echo $msj;
}
}else{
$msj="sin mensaje";

}
//$arreglomsj= (object) $consultamensj;
//$resultadolmsj = mysql_query($consultamensj);
//$arreglomsj = mysql_fetch_array($resultadolmsj);
?>
 <a href="#"><div id="box-msg" style="background-color:#731472;" onclick="openNav()">
  <img src="img/error.png" height="65" width="65" style="float:left;"/> Ver Errores de Agenda </div></a>

 <div id="box-msg2" style="background-color:#f0c101; font-size:10px;">
 <div id="box-msg-tit">Nota del Día</div>
 <?php if($msj==""){?>
 <div style="font-size:26px"><?php echo "Sin Notas para Hoy";?> </div>
<?php }else{ echo $msj; } ?>
</div>

 <?PHP
$act=DB::select("SELECT * FROM citas WHERE distribucion='METODO'");
//$y=mysql_query($act);
//$resp=sqlsrv_fetch_array($act);
if(!empty($oc))
{
foreach($act as $resp)
{
$oc=$resp->oc;
}
}else{

$oc= "No encuentra registros";

}

?>
<div id="box-msg" style="background-color:#cf152d;">
<img src="img/update.png" height="75" width="75" style="float:left;"/> Actualizado : <?php echo $oc;?> </div>

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
	<a href="#top">Inconsistencias en la programación para el día <?php echo $hoy ?></a>
	<table>
		<th>Tipo de error</th>
  	  	<th>Numero de cita</th>
  	  	<th>Hora de inicio</th>
  	  	<th>Fecha de cita</th>
  	  	<th>Descripción de departamento</th>
  	  	<th>Razón social</th>
  <?php

//  while ($arr=(mysql_fetch_array($consutadis)))

 foreach($consutadis as $arr)
  { ?>
  	  	<tr>
  	  		<td>Cita agendada no se encuentra en programación</td>
  	  		<td><?php echo $arr->cita; ?></td>
  	  		<td><?php echo $arr->digita_inicio; ?></td>
  	  		<td><?php echo $arr->fech_cita; ?></td>
  	  		<td><?php echo utf8_encode($arr->decrip_depto); ?></td>
  	  		<td><?php echo utf8_encode($arr->rs);  ?></td>
  	  	</tr>
  		<?php }?>
	</table>
	<a href="#top">Errores de agenda</a>
	<table>
		<th>Tipo de error</th>
		<th>OC</th>
  	  	<th>Numero de cita</th>
  	  	<th>Hora de inicio</th>
  	  	<th>Fecha de cancelación</th>
  	  	<th>Descripción de departamento</th>
  	  	<th>Razón social</th>
  <?php
  //while ($arr2=(mysql_fetch_array($resultnoagen))) {

    foreach($resultnoagen as $arr2)
     {
    ?>
  	  	<tr>
  	  		<td>ASR/AWR no agendada en fecha de cancelación </td>
  	  		<td><?php echo $arr2->oc; ?></td>
  	  		<td><?php echo $arr2->cita; ?></td>
  	  		<td><?php echo $arr2->digita_inicio; ?></td>
  	  		<td><?php echo $arr2->cancela_oc; ?></td>
  	  		<td><?php echo utf8_encode($arr2->decrip_depto); ?></td>
  	  		<td><?php echo utf8_encode($arr2->rs);  ?></td>
  	  	</tr>
  		<?php
  			}
   		?>
   		 <?php
//  while ($arr3=(mysql_fetch_array($resultpre))) {

    foreach($resultpre as $arr3)
     {

    ?>
  	  	<tr>
  	  		<td>Almacenaje agendada como predistribuida </td>
  	  		<td><?php echo $arr3->oc; ?></td>
  	  		<td><?php echo $arr3->cita; ?></td>
  	  		<td><?php echo $arr3->digita_inicio; ?></td>
  	  		<td><?php echo $arr3->cancela_oc; ?></td>
  	  		<td><?php echo utf8_encode($arr3->decrip_depto); ?></td>
  	  		<td><?php echo utf8_encode($arr3->rs);  ?></td>
  	  	</tr>
  		<?php
  			}
   		?>

   		<?php
//  while ($arr4=(mysql_fetch_array($resulsimple))) {

    foreach($resulsimple as $arr4)
     {

    ?>
  	  	<tr>
  	  		<td>Pre distribuida almacenada como almacenaje</td>
  	  		<td><?php echo $arr4->oc; ?></td>
  	  		<td><?php echo $arr4->cita; ?></td>
  	  		<td><?php echo $arr4->digita_inicio; ?></td>
  	  		<td><?php echo $arr4->cancela_oc; ?></td>
  	  		<td><?php echo utf8_encode($arr4->decrip_depto); ?></td>
  	  		<td><?php echo utf8_encode($arr4->rs);  ?></td>
  	  	</tr>
  		<?php
  			}
   		?>

   		<?php
//  while ($arr4=(mysql_fetch_array($resultadoasrawr))) {
        foreach($resultadoasrawr as $arr4)
         {

    ?>
  	  	<tr>
  	  		<td>ASR Y AWR unidades en sin pre distribución </td>
  	  		<td><?php echo $arr4->oc; ?></td>
  	  		<td><?php echo $arr4->cita; ?></td>
  	  		<td><?php echo $arr4->digita_inicio; ?></td>
  	  		<td><?php echo $arr4->cancela_oc; ?></td>
  	  		<td><?php echo utf8_encode($arr4->decrip_depto); ?></td>
  	  		<td><?php echo utf8_encode($arr4->rs);  ?></td>
  	  	</tr>
  		<?php
  			}
   		?>
	</table>
	<a href="#top"><img src="img/flecha.png" height="50" width="50" /></a>
</div>


<!-- ***************************************************************************************************************************************-->
<!-- DESDE AQUI GRILLA DE AGENDA -->


<div id="main">
<div id="box-agenda">
<div id="box-tit"><a href="DescargarAgenda.php"><button id="btn-descarga" class="btn-descarga">Descargar Agenda</button></a>Estatus Agenda Próximos 14 días</div>

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
<?php
//BUSCO LAS CAPACIDAD DE BD
$cons=DB::select("SELECT * FROM capacidad WHERE tipo_manejo='CAJ'");
//$y=mysql_query($cons);$con2=mysql_fetch_array($y);
foreach($cons as $con2){
$scaj=$con2->semana;
$fcaj=$con2->finde;
}

?>

<div id="grilla_fila" style="border-top:#FF0000 solid 2px; border-bottom:#FF0000 solid 2px;">
<div id="grilla_type0">CAJAS</div>
<div id="grilla_type1"><?php echo number_format($scaj, 0, ",", ".");?> | <?php echo number_format($fcaj, 0, ",", ".");?>
</div>

<?php
//VERDE
//RECORRO LAS FECHAS FUTURAS HASTA 14 DIAS, SE GENERA LA VARIABLE DINAMICA
for($i=0 ; $i<=13 ; $i++){
$d='+ '.$i." ".'day';
$day=date("Y-m-d",strtotime($d ,strtotime($hoy)));
$position_day=date("w",strtotime($day));
$v1=round($scaj-($scaj*20/100));
$v2=round($fcaj-($fcaj*20/100));
//EJECUTO LA CONSULTA EN LA ITERACION
$sql2=DB::select("select (sum(cast(sin_pred as int))+sum(cast(con_pred as int))) as tot_unid from (select distinct(cita),sin_pred,con_pred from citas where fech_cita ='$day' and manejo='CAJ' and tipo_orden <> 'Almacenaje Proveedor' AND cita NOT IN (SELECT (nro_cta)  FROM puertaexpress)) as tabla");
//$x2=mysql_query($sql2);
//while($arr2=mysql_fetch_array($x2)){
foreach($sql2 as $arr2)
{
$n1=$arr2->tot_unid;
if($n1>=$con2->semana){
?>
<div id="grilla_type2" style="background-color:#ff5555; color:#FFF; font-weight:bold;"><?php echo number_format($n1, 0, ",", ".");?></div>
<?php }elseif(($n1>=$con2->finde)&&($position_day=='6')){?>
<div id="grilla_type2" style="background-color:#ff5555; color:#FFF; font-weight:bold;"><?php echo number_format($n1, 0, ",", ".");?></div>
<?php }elseif(($n1<=$con2->semana)&&($n1>=$v1)|| ($n1<=$con2->finde)&&($n1>=$v2)&&($position_day=='6')){?>
<div id="grilla_type2" style="background-color:#fabb3d; color:#363023; font-weight:bold;"><?php echo number_format($n1, 0, ",", ".");?></div>
<?php }elseif($n1<='0'){?>
<div id="grilla_type2" style="background-color:#42910e; color:#FFF; font-weight:bold; text-align:center"><?php echo ('-');?></div>
<?php }else{?>
<div id="grilla_type2" style="background-color:#42910e; color:#FFF; font-weight:bold;"><?php echo number_format($n1, 0, ",", ".");?></div>
<?php }}}?>


<!-- BUSCAMOS CANTIDAD DE CITAS POR MANEJO-->
<?php
//BUSCO LAS CAPACIDAD DE BD
$cons=DB::select("SELECT * FROM capacidad WHERE tipo_manejo='Citas'");
//$y=mysql_query($cons);$con2=mysql_fetch_array($y);
foreach($cons as $con2)
{
$scaj=$con2->semana;
$fcaj=$con2->finde;
}
?>

<div id="grilla_type1">Citas (<?php echo number_format($scaj, 0, ",", ".");?> | <?php echo number_format($fcaj, 0, ",", ".");?>)</div>
<?php
//RECORRO LAS FECHAS FUTURAS HASTA 14 DIAS, SE GENERA LA VARIABLE DINAMICA
for($i=0 ; $i<=13 ; $i++){
$d='+ '.$i." ".'day';
$day=date("Y-m-d",strtotime($d ,strtotime($hoy)));
$position_day=date("w",strtotime($day));
//EJECUTO LA CONSULTA EN LA ITERACION
$sql2=DB::select("SELECT COUNT(distinct(cita)) AS tot_cita FROM citas WHERE fech_cita='$day' AND manejo='CAJ'
 AND tipo_orden <> 'Almacenaje Proveedor' AND  cita NOT IN (SELECT (nro_cta)  FROM puertaexpress)");

//$x3=mysql_query($sql2);
//while($arr3=mysql_fetch_array($x3)){
foreach($sql2 as $arr3){
$c1=$arr3->tot_cita;
if($c1>=$scaj){
?>
<div id="grilla_type2" style="background-color:#ff5555; color:#FFF;"><?php echo number_format($c1, 0, ",", ".");?></div>
<?php }elseif(($c1>=$fcaj)&&($position_day=='6')){?>
<div id="grilla_type2" style="background-color:#ff5555; color:#FFF;"><?php echo number_format($c1, 0, ",", ".");?></div>
<?php }elseif(($c1<=$scaj)&&($c1>=$v1)|| ($c1<=$fcaj)&&($c1>=$v2)){?>
<div id="grilla_type2" style="background-color:#fabb3d; color:#363023; font-weight:bold;"><?php echo number_format($c1, 0, ",", ".");?></div>
<?php }elseif($c1<='0'){?>
<div id="grilla_type2" style="background-color:#42910e; color:#FFF; font-weight:bold; text-align:center"><?php echo ('-');?></div>
<?php }else{?>
<div id="grilla_type2" style="background-color:#42910e; color:#FFF; font-weight:bold;"><?php echo number_format($c1, 0, ",", ".");?></div>

<?php }}}?>
</div>

<!-- **************************************************************************************************************************-->
<!-- FIN PRIMER MANEJO(CAJAS) -->
<!-- **************************************************************************************************************************-->
<div id="grilla_fila_grupos2" style="border-top:#FF0000 solid 2px; border-bottom:#FF0000 solid 2px;">

<!-- BUSCAMOS INFORMACION RELACIONADA CON UNIDAD G1(X 100)-->
<?php
//BUSCO LAS CAPACIDAD DE BD
$cons=DB::select("SELECT * FROM capacidad WHERE tipo_manejo='UNDG1'");
//$y=mysql_query($cons);$con2=mysql_fetch_array($y);

foreach($cons as $con2)
{
$scaj=$con2->semana;
$fcaj=$con2->finde;
}
?>
<div id="grilla_fila_grupos"  >
<div id="grilla_type00">Unidad G1(x 100)</div>
<div id="grilla_type1" style="font-size:11px;"><?php echo number_format($scaj, 0, ",", ".");?> | <?php echo number_format($fcaj, 0, ",", ".");?></div>
<?php

//RECORRO LAS FECHAS FUTURAS HASTA 14 DIAS, SE GENERA LA VARIABLE DINAMICA
for($i=0 ; $i<=13 ; $i++){
$d='+ '.$i." ".'day';
$day=date("Y-m-d",strtotime($d ,strtotime($hoy)));
$position_day=date("w",strtotime($day));
$v1=round($scaj-($scaj*20/100));
$v2=round($fcaj-($fcaj*20/100));
//EJECUTO LA CONSULTA EN LA ITERACION

$sql2=DB::select("select (sum(cast(sin_pred as int))+sum(cast(con_pred as int))) as tot_unid from
(select distinct(citas.cita),citas.sin_pred,citas.con_pred,citas.cod_depto,equival.grupo from citas INNER JOIN equival ON citas.cod_depto=equival.depto
where fech_cita ='$day' and manejo='CAJ' and tipo_orden <> 'Almacenaje Proveedor' AND equival.grupo='1' GROUP BY citas.cita,citas.sin_pred,citas.con_pred,citas.cod_depto,equival.grupo)
as tabla ");
//$x2=mysql_query($sql2);
//while($arr2=mysql_fetch_array($x2)){
foreach($sql2 as $arr2){
$n1=$arr2->tot_unid;
$n2=$n1*100 ;
if($n1>=$scaj){
?>
<a href="" title="<?php echo number_format($n2, 0, ",", ".");?>">
<div id="grilla_type2" style="background-color:#ff5555; color:#fff; font-weight:bold "><?php  echo number_format($n1, 0, ",", ".");?></div></a>

<?php }elseif(($n1>=$fcaj)&&($position_day=='6')){?>
<a href="" title="<?php echo number_format($n2, 0, ",", ".");?>">
<div id="grilla_type2" style="background-color:#ff5555; color:#fff; "><?php  echo number_format($n1, 0, ",", ".");?></div></a>

<?php }elseif(($n1<=$scaj)&&($n1>=$v1)|| ($n1<=$fcaj)&&($n1>=$v2)&&($position_day=='6')){?>
<a href="" title="<?php echo number_format($n2, 0, ",", ".");?>">
<div id="grilla_type2" style="background-color:#fabb3d; color:#363023; "><?php  echo number_format($n1, 0, ",", ".");?></div></a>
<?php }elseif($n1<='0'){?>

<a href="" title="<?php echo number_format($n2, 0, ",", ".");?>">
<div id="grilla_type2" style="background-color:#42910e; color:#fff;  text-align:center;"><?php echo ('-');?></div></a>
<?php }else{?>

<a href="" title="<?php echo number_format($n2, 0, ",", ".");?>">
<div id="grilla_type2" style="background-color:#42910e; color:#fff; "><?php  echo number_format($n1, 0, ",", ".");?></div></a>
<?php }}} $n1; ?>
</div>


<!-- BUSCAMOS INFORMACION RELACIONADA CON UNIDAD G2(X 50)-->
<?php
//BUSCO LAS CAPACIDAD DE BD
$cons=DB::select("SELECT * FROM capacidad WHERE tipo_manejo='UNDG2'");
//$y=mysql_query($cons);$con2=mysql_fetch_array($y);
foreach($cons as $con2){
$scaj=$con2->semana;
$fcaj=$con2->finde;
}
?>
<div id="grilla_fila_grupos" >
<div id="grilla_type00">Unidad G2(x 50)</div>
<div id="grilla_type1" style="font-size:11px;"><?php echo number_format($scaj, 0, ",", ".");?> | <?php echo number_format($fcaj, 0, ",", ".");?></div>
<?php
//RECORRO LAS FECHAS FUTURAS HASTA 14 DIAS, SE GENERA LA VARIABLE DINAMICA
for($i=0 ; $i<=13 ; $i++){
$d='+ '.$i." ".'day';
$day=date("Y-m-d",strtotime($d ,strtotime($hoy)));
$position_day=date("w",strtotime($day));
$v1=round($scaj-($scaj*20/100));
$v2=round($fcaj-($fcaj*20/100));
//EJECUTO LA CONSULTA EN LA ITERACION
$sql2=DB::select("select (sum(cast(sin_pred as int))+sum(cast(con_pred as int))) as tot_unid from
(select distinct(citas.cita),citas.sin_pred,citas.con_pred,citas.cod_depto,equival.grupo from citas INNER JOIN equival ON citas.cod_depto=equival.depto
where fech_cita ='$day' and manejo='CAJ' and tipo_orden <> 'Almacenaje Proveedor' AND equival.grupo='2' GROUP BY citas.cita,citas.sin_pred,citas.con_pred,citas.cod_depto,equival.grupo)
as tabla");
//$x2=mysql_query($sql2);
//while($arr2=mysql_fetch_array($x2)){

foreach($sql2 as $arr2)
{
$n1=$arr2->tot_unid;
$n2=$n1*50 ;
if($n1>=$scaj){
?>
<a href="" title="<?php echo number_format($n2, 0, ",", ".");?>">
<div id="grilla_type2" style="background-color:#ff5555; color:#fff; font-weight:bold "><?php  echo number_format($n1, 0, ",", ".");?></div></a>

<?php }elseif(($n1>=$fcaj)&&($position_day=='6')){?>
<a href="" title="<?php echo number_format($n2, 0, ",", ".");?>">
<div id="grilla_type2" style="background-color:#ff5555; color:#fff; "><?php  echo number_format($n1, 0, ",", ".");?></div></a>

<?php }elseif(($n1<=$scaj)&&($n1>=$v1)|| ($n1<=$fcaj)&&($n1>=$v2)&&($position_day=='6')){?>
<a href="" title="<?php echo number_format($n2, 0, ",", ".");?>">
<div id="grilla_type2" style="background-color:#fabb3d; color:#363023; "><?php  echo number_format($n1, 0, ",", ".");?></div></a>
<?php }elseif($n1<='0'){?>

<a href="" title="<?php echo number_format($n2, 0, ",", ".");?>">
<div id="grilla_type2" style="background-color:#42910e; color:#fff;  text-align:center;"><?php echo ('-');?></div></a>
<?php }else{?>

<a href="" title="<?php echo number_format($n2, 0, ",", ".");?>">
<div id="grilla_type2" style="background-color:#42910e; color:#fff; "><?php  echo number_format($n1, 0, ",", ".");?></div></a>
<?php }}} $n1; ?>
</div>


<!-- BUSCAMOS INFORMACION RELACIONADA CON UNIDAD G3(X 1)-->
<?php
//BUSCO LAS CAPACIDAD DE BD
$cons=DB::select("SELECT * FROM capacidad WHERE tipo_manejo='UNDG3'");
//$y=mysql_query($cons);$con2=mysql_fetch_array($y);
foreach($cons as $con2){
$scaj=$con2->semana;
$fcaj=$con2->finde;
}
?>
<div id="grilla_fila_grupos" >
<div id="grilla_type00">Unidad G3(x 1)</div>
<div id="grilla_type1" style="font-size:11px;"><?php echo number_format($scaj, 0, ",", ".");?> | <?php echo number_format($fcaj, 0, ",", ".");?></div>
<?php
//RECORRO LAS FECHAS FUTURAS HASTA 14 DIAS, SE GENERA LA VARIABLE DINAMICA
for($i=0 ; $i<=13 ; $i++){
$d='+ '.$i." ".'day';
$day=date("Y-m-d",strtotime($d ,strtotime($hoy)));
$position_day=date("w",strtotime($day));
$v1=round($scaj-($scaj*20/100));
$v2=round($fcaj-($fcaj*20/100));
//EJECUTO LA CONSULTA EN LA ITERACION
$sql2=DB::select("select (sum(cast(sin_pred as int))+sum(cast(con_pred as int))) as tot_unid from
(select distinct(citas.cita),citas.sin_pred,citas.con_pred,citas.cod_depto,equival.grupo from citas INNER JOIN equival
ON citas.cod_depto=equival.depto
where fech_cita ='$day' and manejo='CAJ' and tipo_orden<>'Almacenaje Proveedor' AND equival.grupo='3' GROUP BY citas.cita,citas.sin_pred,citas.con_pred,citas.cod_depto,equival.grupo)
as tabla");
//$x2=mysql_query($sql2);
//while($arr2=mysql_fetch_array($x2)){
foreach($sql2 as $arr2){
$g3=$arr2->tot_unid;
if($g3>=$scaj){
?>
<div id="grilla_type2" style="background-color:#ff5555; color:#FFF; font-weight:bold;"><?php echo number_format($g3, 0, ",", ".");?></div>
<?php }elseif(($g3>=$fcaj)&&($position_day=='6')){?>
<div id="grilla_type2" style="background-color:#ff5555; color:#FFF; font-weight:bold;"><?php echo number_format($g3, 0, ",", ".");?></div>
<?php }elseif(($g3<=$scaj)&&($g3>=$v1)|| ($g3<=$fcaj)&&($g3>=$v2)&&($position_day=='6')){?>
<div id="grilla_type2" style="background-color:#fabb3d; color:#363023; font-weight:bold;"><?php echo number_format($g3, 0, ",", ".");?></div>
<?php }elseif($g3<='0'){?>
<div id="grilla_type2" style="background-color:#42910e; color:#FFF; font-weight:bold; text-align:center;"><?php echo ('-');?></div>
<?php }else{?>
<div id="grilla_type2" style="background-color:#42910e; color:#FFF; font-weight:bold;"><?php echo number_format($g3, 0, ",", ".");?></div>
<?php }}}?>
</div>



<!-- BUSCAMOS INFORMACION RELACIONADA CON UNIDAD G1(X 100)-->
<?php
//BUSCO LAS CAPACIDAD DE BD
$cons=DB::select("SELECT * FROM capacidad WHERE tipo_manejo='MAXFG3'");
//$y=mysql_query($cons);$con2=mysql_fetch_array($y);

foreach($cons as $con2)
{
$scaj=$con2->semana;
$fcaj=$con2->finde;
}
?>
<div id="grilla_fila_grupos" >
<div id="grilla_type00">Maximo F[G3]</div>
<div id="grilla_type1" style="font-size:11px;"><?php echo number_format($scaj, 0, ",", ".");?> | <?php echo number_format($fcaj, 0, ",", ".");?></div>
<?php
//RECORRO LAS FECHAS FUTURAS HASTA 14 DIAS, SE GENERA LA VARIABLE DINAMICA
for($i=0 ; $i<=13 ; $i++){
$d='+ '.$i." ".'day';
$day=date("Y-m-d",strtotime($d ,strtotime($hoy)));
$position_day=date("w",strtotime($day));
$v1=round($scaj-($scaj*20/100));
$v2=round($fcaj-($fcaj*20/100));


$sql2=DB::select("select (sum(cast(sin_pred as int))+sum(cast(con_pred as int)))*100 as tot_unid from
(select distinct(citas.cita),citas.sin_pred,citas.con_pred,citas.cod_depto,equival.grupo from citas INNER JOIN equival
ON citas.cod_depto=equival.depto
where fech_cita ='$day' and manejo='CAJ' and tipo_orden<>'Almacenaje Proveedor' AND equival.grupo='1' GROUP BY citas.cita,citas.sin_pred,citas.con_pred,citas.cod_depto,equival.grupo)
as tabla");
//$x2=mysql_query($sql2);
//while($arr2=mysql_fetch_array($x2)){
foreach($sql2 as $arr2){
 $var1=$arr2->tot_unid;
}

$sql2=DB::select("select (sum(cast(sin_pred as int))+sum(cast(con_pred as int)))*50 as tot_unid from
(select distinct(citas.cita),citas.sin_pred,citas.con_pred,citas.cod_depto,equival.grupo from citas INNER JOIN equival
ON citas.cod_depto=equival.depto
where fech_cita ='$day' and manejo='CAJ' and tipo_orden<>'Almacenaje Proveedor' AND equival.grupo='2' GROUP BY citas.cita,citas.sin_pred,citas.con_pred,citas.cod_depto,equival.grupo)
as tabla");
//$x2=mysql_query($sql2);
foreach($sql2 as $arr2){
//while($arr2=mysql_fetch_array($x2)){
 $var2=$arr2->tot_unid;
}

$sql2=DB::select("select (sum(cast(sin_pred as int))+sum(cast(con_pred as int)))as tot_unid from
(select distinct(citas.cita),citas.sin_pred,citas.con_pred,citas.cod_depto,equival.grupo from citas INNER JOIN equival
ON citas.cod_depto=equival.depto
where fech_cita ='$day' and manejo='CAJ' and tipo_orden<>'Almacenaje Proveedor' AND equival.grupo='3' GROUP BY citas.cita,citas.sin_pred,citas.con_pred,citas.cod_depto,equival.grupo)
as tabla");
//$x2=mysql_query($sql2);
foreach($sql2 as $arr2){
//while($arr2=mysql_fetch_array($x2)){
$var3=$arr2->tot_unid;
}

$f3=$var1+$var2+$var3 ;
if($f3>=$scaj){
?>
<div id="grilla_type2" style="background-color:#ff5555; color:#FFF; font-weight:bold;"><?php echo number_format($f3, 0, ",", ".");?></div>
<?php }elseif(($f3>=$fcaj)&&($position_day=='6')){?>
<div id="grilla_type2" style="background-color:#ff5555; color:#FFF; font-weight:bold;"><?php echo number_format($f3, 0, ",", ".");?></div>
<?php }elseif(($f3<=$scaj)&&($f3>=$v1)|| ($f3<=$fcaj)&&($f3>=$v2)&&($position_day=='6')){?>
<div id="grilla_type2" style="background-color:#fabb3d; color:#363023; font-weight:bold;"><?php echo number_format($f3, 0, ",", ".");?></div>
<?php }elseif($f3<='0'){?>
<div id="grilla_type2" style="background-color:#42910e; color:#FFF; font-weight:bold; text-align:center;"><?php echo ('-');?></div>
<?php }else{?>
<div id="grilla_type2" style="background-color:#42910e; color:#FFF; font-weight:bold;"><?php echo number_format($f3, 0, ",", ".");?></div>

<?php }} ?>


</div>
</div>


<!-- BUSCAMOS INFORMACION RELACIONADA CON SENSIBLES-->
<?php
//BUSCO LAS CAPACIDAD DE BD
$cons=DB::select("SELECT * FROM capacidad WHERE tipo_manejo='SEN'");
//$y=mysql_query($cons);$con2=mysql_fetch_array($y);
foreach($cons as $con2){
$scaj=$con2->semana;
$fcaj=$con2->finde;
}
?>

<div id="grilla_fila" style="border-top:#810081 solid 2px; border-bottom:#810081 solid 2px;">
<div id="grilla_type0">SENSIBLE</div>
<div id="grilla_type1"><?php echo number_format($scaj, 0, ",", ".");?> | <?php echo number_format($fcaj, 0, ",", ".");?>
</div>

<?php
//RECORRO LAS FECHAS FUTURAS HASTA 14 DIAS, SE GENERA LA VARIABLE DINAMICA
for($i=0 ; $i<=13 ; $i++){
$d='+ '.$i." ".'day';
$day=date("Y-m-d",strtotime($d ,strtotime($hoy)));
$position_day=date("w",strtotime($day));
$v1=round($scaj-($scaj*20/100));
$v2=round($fcaj-($fcaj*20/100));
//EJECUTO LA CONSULTA EN LA ITERACION
$sql2=DB::select("select (sum(cast(sin_pred as int))+sum(cast(con_pred as int))) as tot_unid from (select distinct(cita),sin_pred,con_pred from citas where fech_cita ='$day' and manejo='SEN' AND  cita NOT IN (SELECT (nro_cta) FROM puertaexpress)) as tabla");
//$x2=mysql_query($sql2);
//while($arr2=mysql_fetch_array($x2)){
foreach($sql2 as $arr2){
$n1=$arr2->tot_unid;
if($n1>=$scaj){
?>
<div id="grilla_type2" style="background-color:#ff5555; color:#FFF; font-weight:bold;"><?php echo number_format($n1, 0, ",", ".");?></div>
<?php }elseif(($n1>=$fcaj)&&($position_day=='6')){?>
<div id="grilla_type2" style="background-color:#ff5555; color:#FFF; font-weight:bold;"><?php echo number_format($n1, 0, ",", ".");?></div>
<?php }elseif(($n1<=$scaj)&&($n1>=$v1)|| ($n1<=$fcaj)&&($n1>=$v2)&&($position_day=='6')){?>
<div id="grilla_type2" style="background-color:#fabb3d; color:#363023; font-weight:bold;"><?php echo number_format($n1, 0, ",", ".");?></div>
<?php }elseif($n1<='0'){?>
<div id="grilla_type2" style="background-color:#42910e; color:#FFF; font-weight:bold; text-align:center"><?php echo ('-');?></div>
<?php }else{?>
<div id="grilla_type2" style="background-color:#42910e; color:#FFF; font-weight:bold;"><?php echo number_format($n1, 0, ",", ".");?></div>

<?php }}}?>


<?php
//BUSCO LAS CAPACIDAD DE BD
$cons=DB::select("SELECT * FROM capacidad WHERE tipo_manejo='Citas'");
//$y=mysql_query($cons);$con2=mysql_fetch_array($y);
foreach($cons as $con2){
$scaj=$con2->semana;
$fcaj=$con2->finde;
}
?>

<div id="grilla_type1">Citas (<?php echo number_format($scaj, 0, ",", ".");?> | <?php echo number_format($fcaj, 0, ",", ".");?>)</div>
<?php
//RECORRO LAS FECHAS FUTURAS HASTA 14 DIAS, SE GENERA LA VARIABLE DINAMICA
for($i=0 ; $i<=13 ; $i++){
$d='+ '.$i." ".'day';
$day=date("Y-m-d",strtotime($d ,strtotime($hoy)));
$position_day=date("w",strtotime($day));
//EJECUTO LA CONSULTA EN LA ITERACION
$sql2=DB::select("SELECT COUNT(cita) AS tot_cita FROM citas WHERE fech_cita='$day' AND manejo='SEN' AND cita NOT IN (SELECT (nro_cta)  FROM puertaexpress)");
//$x3=mysql_query($sql2);
foreach ($sql2 as $arr3) {
//while($arr3=mysql_fetch_array($x3)){
$c1=$arr3->tot_cita;
if($c1>=$scaj){
?>
<div id="grilla_type2" style="background-color:#ff5555; color:#FFF;"><?php echo number_format($c1, 0, ",", ".");?></div>
<?php }elseif(($c1>=$fcaj)&&($position_day=='6')){?>
<div id="grilla_type2" style="background-color:#ff5555; color:#FFF;"><?php echo number_format($c1, 0, ",", ".");?></div>
<?php }elseif(($c1<=$scaj)&&($c1>=$v1)|| ($c1<=$fcaj)&&($c1>=$v2)){?>
<div id="grilla_type2" style="background-color:#fabb3d; color:#363023; font-weight:bold;"><?php echo number_format($c1, 0, ",", ".");?></div>
<?php }elseif($c1<='0'){?>
<div id="grilla_type2" style="background-color:#42910e; color:#FFF; font-weight:bold; text-align:center"><?php echo ('-');?></div>
<?php }else{?>
<div id="grilla_type2" style="background-color:#42910e; color:#FFF; font-weight:bold;"><?php echo number_format($c1, 0, ",", ".");?></div>

<?php }}}?>
</div>



<!-- BUSCAMOS INFORMACION RELACIONADA CON COLGADO-->
<?php
//BUSCO LAS CAPACIDAD DE BD
$cons=DB::select("SELECT * FROM capacidad WHERE tipo_manejo='COL'");
//$y=mysql_query($cons);$con2=mysql_fetch_array($y);
foreach($cons as $con2){
$scaj=$con2->semana;
$fcaj=$con2->finde;
}
$v1=round($scaj-($scaj*20/100));
$v2=round($fcaj-($fcaj*20/100));
?>


<div id="grilla_fila" style="border-top:#fec409 solid 2px; border-bottom:#fec409 solid 2px;">
<div id="grilla_type0">COLGADO</div>
<div id="grilla_type1"><?php echo number_format($scaj, 0, ",", ".");?> | <?php echo number_format($fcaj, 0, ",", ".");?></div>
<?php
//RECORRO LAS FECHAS FUTURAS HASTA 14 DIAS, SE GENERA LA VARIABLE DINAMICA
for($i=0 ; $i<=13 ; $i++){
$d='+ '.$i." ".'day';
$day=date("Y-m-d",strtotime($d ,strtotime($hoy)));
$position_day=date("w",strtotime($day));

//EJECUTO LA CONSULTA EN LA ITERACION
$sql2=DB::select("select (sum(cast(sin_pred as int))+sum(cast(con_pred as int))) as tot_unid from (select distinct(cita),sin_pred,con_pred from citas where fech_cita ='$day' and manejo='COL' AND  cita NOT IN (SELECT (nro_cta) FROM puertaexpress)) as tabla");
//$x2=mysql_query($sql2);
//while($arr2=mysql_fetch_array($x2)){
foreach($sql2 as $arr2){
$n1=$arr2->tot_unid;
if($n1>=$scaj){
?>
<div id="grilla_type2" style="background-color:#ff5555; color:#FFF; font-weight:bold;"><?php echo number_format($n1, 0, ",", ".");?></div>
<?php }elseif(($n1>=$fcaj)&&($position_day=='6')){?>
<div id="grilla_type2" style="background-color:#ff5555; color:#FFF; font-weight:bold;"><?php echo number_format($n1, 0, ",", ".");?></div>
<?php }elseif(($n1<=$scaj)&&($n1>=$v1)|| ($n1<=$fcaj)&&($n1>=$v2)&&($position_day=='6')){?>
<div id="grilla_type2" style="background-color:#fabb3d; color:#363023; font-weight:bold;"><?php echo number_format($n1, 0, ",", ".");?></div>
<?php }elseif($n1<='0'){?>
<div id="grilla_type2" style="background-color:#42910e; color:#FFF; font-weight:bold; text-align:center"><?php echo ('-');?></div>
<?php }else{?>
<div id="grilla_type2" style="background-color:#42910e; color:#FFF; font-weight:bold;"><?php echo number_format($n1, 0, ",", ".");?></div>

<?php }}}?>

<?php
//BUSCO LAS CAPACIDAD DE BD
$cons=DB::select("SELECT * FROM capacidad WHERE tipo_manejo='Citas'");
//$y=mysql_query($cons);$con2=mysql_fetch_array($y);
foreach($cons as $con2){
$scaj=$con2->semana;
$fcaj=$con2->finde;
}
?>
<div id="grilla_type1">Citas (<?php echo number_format($scaj, 0, ",", ".");?> | <?php echo number_format($fcaj, 0, ",", ".");?>)</div>
<?php
//RECORRO LAS FECHAS FUTURAS HASTA 14 DIAS, SE GENERA LA VARIABLE DINAMICA
for($i=0 ; $i<=13 ; $i++){
$d='+ '.$i." ".'day';
$day=date("Y-m-d",strtotime($d ,strtotime($hoy)));
$position_day=date("w",strtotime($day));
//EJECUTO LA CONSULTA EN LA ITERACION
$sql2=DB::select("SELECT COUNT(cita) AS tot_cita FROM citas WHERE fech_cita='$day' AND manejo='COL' AND cita NOT IN (SELECT (nro_cta)  FROM puertaexpress)");
//$x3=mysql_query($sql2);
foreach($sql2 as $arr3){
//while($arr3=mysql_fetch_array($x3)){
$c1=$arr3->tot_cita;
if($c1>=$scaj){
?>
<div id="grilla_type2" style="background-color:#ff5555; color:#FFF;"><?php echo number_format($c1, 0, ",", ".");?></div>
<?php }elseif(($c1>=$fcaj)&&($position_day=='6')){?>
<div id="grilla_type2" style="background-color:#ff5555; color:#FFF;"><?php echo number_format($c1, 0, ",", ".");?></div>
<?php }elseif(($c1<=$scaj)&&($c1>=$v1)|| ($c1<=$fcaj)&&($c1>=$v2)){?>
<div id="grilla_type2" style="background-color:#fabb3d; color:#363023; font-weight:bold;"><?php echo number_format($c1, 0, ",", ".");?></div>
<?php }elseif($c1<='0'){?>
<div id="grilla_type2" style="background-color:#42910e; color:#FFF; font-weight:bold; text-align:center"><?php echo ('-');?></div>
<?php }else{?>
<div id="grilla_type2" style="background-color:#42910e; color:#FFF; font-weight:bold;"><?php echo number_format($c1, 0, ",", ".");?></div>

<?php }}}?>
</div>


<!-- BUSCAMOS INFORMACION RELACIONADA CON GVO-->
<?php
//BUSCO LAS CAPACIDAD DE BD
$cons=DB::select("SELECT * FROM capacidad WHERE tipo_manejo='GVO'");
//$y=mysql_query($cons);$con2=mysql_fetch_array($y);
foreach($cons as $con2){
$scaj=$con2->semana;
$fcaj=$con2->finde;
}
?>
<div id="grilla_fila" style="border-top:#895455 solid 2px; border-bottom:#895455 solid 2px;">
<div id="grilla_type0">GVO</div>
<div id="grilla_type1"><?php echo number_format($scaj, 0, ",", ".");?> | <?php echo number_format($fcaj, 0, ",", ".");?></div>
<?php
//RECORRO LAS FECHAS FUTURAS HASTA 14 DIAS, SE GENERA LA VARIABLE DINAMICA
for($i=0 ; $i<=13 ; $i++){
$d='+ '.$i." ".'day';
$day=date("Y-m-d",strtotime($d ,strtotime($hoy)));
$position_day=date("w",strtotime($day));
$v1=round($scaj-($scaj*20/100));
$v2=round($fcaj-($fcaj*20/100));
//EJECUTO LA CONSULTA EN LA ITERACION
$sql2=DB::select("select (sum(cast(sin_pred as int))+sum(cast(con_pred as int))) as tot_unid from (select distinct(cita),sin_pred,con_pred from citas where fech_cita ='$day' and manejo='GVO' AND  cita NOT IN (SELECT (nro_cta) FROM puertaexpress)) as tabla");
//$x2=mysql_query($sql2);
//while($arr2=mysql_fetch_array($x2)){
foreach($sql2 as $arr2){
$sql3=DB::select("select (sum(cast(sin_pred as int))+sum(cast(con_pred as int))) as tot_unid2 from (select distinct(cita),sin_pred,con_pred from citas where fech_cita ='$day' and manejo='CAJ' AND tipo_orden in('Almacenaje Proveedor','OC Almacenaje Proveedor') AND  cita NOT IN (SELECT (nro_cta) FROM puertaexpress)) as tabla");
//	$x3=mysql_query($sql3);
//	$arr3=mysql_fetch_array($x3);
//$totunidad=$arr2['tot_unid'];
foreach($sql3 as $arr3){
$n1=$arr2->tot_unid + $arr3->tot_unid2;
}
if($n1>=$scaj){
?>
<div id="grilla_type2" style="background-color:#ff5555; color:#FFF; font-weight:bold;"><?php echo number_format($n1, 0, ",", ".");?></div>
<?php }elseif(($n1>=$fcaj)&&($position_day=='6')){?>
<div id="grilla_type2" style="background-color:#ff5555; color:#FFF; font-weight:bold;"><?php echo number_format($n1, 0, ",", ".");?></div>
<?php }elseif(($n1<=$scaj)&&($n1>=$v1)|| ($n1<=$fcaj)&&($n1>=$v2)&&($position_day=='6')){?>
<div id="grilla_type2" style="background-color:#fabb3d; color:#363023; font-weight:bold;"><?php echo number_format($n1, 0, ",", ".");?></div>
<?php }elseif($n1<='0'){?>
<div id="grilla_type2" style="background-color:#42910e; color:#FFF; font-weight:bold; text-align:center"><?php echo ('-');?></div>
<?php }else{?>
<div id="grilla_type2" style="background-color:#42910e; color:#FFF; font-weight:bold;"><?php echo number_format($n1, 0, ",", ".");?></div>

<?php }}}?>

<?php
//BUSCO LAS CAPACIDAD DE BD
$cons=DB::select("SELECT * FROM capacidad WHERE tipo_manejo='Citas'");
//$y=mysql_query($cons);$con2=mysql_fetch_array($y);
foreach($cons as $con2){
$scaj=$con2->semana;
$fcaj=$con2->finde;
}
?>
<div id="grilla_type1">Citas (<?php echo number_format($scaj, 0, ",", ".");?> | <?php echo number_format($fcaj, 0, ",", ".");?>)</div>
<?php
//RECORRO LAS FECHAS FUTURAS HASTA 14 DIAS, SE GENERA LA VARIABLE DINAMICA
for($i=0 ; $i<=13 ; $i++){
$d='+ '.$i." ".'day';
$day=date("Y-m-d",strtotime($d ,strtotime($hoy)));
$position_day=date("w",strtotime($day));
//EJECUTO LA CONSULTA EN LA ITERACION
$sql2=DB::select("SELECT COUNT(cita) AS tot_cita FROM citas WHERE fech_cita='$day' AND manejo='GVO' AND cita NOT IN (SELECT (nro_cta)  FROM puertaexpress)");
//$x3=mysql_query($sql2);
//while($arr3=mysql_fetch_array($x3)){
  foreach($sql2 as $arr30){
	$sql3=DB::select("SELECT COUNT(cita) AS tot_cita2 FROM citas WHERE fech_cita='$day' AND manejo='CAJ' AND tipo_orden in('Almacenaje Proveedor','OC Almacenaje Proveedor') AND cita NOT IN (SELECT (nro_cta)  FROM puertaexpress)");
//	$x3=mysql_query($sql3);
//	$arr3=mysql_fetch_array($x3);
  foreach($sql3 as $arr31){
$c1=$arr30->tot_cita + $arr31->tot_cita2;
   }
if($c1>=$scaj){
?>
<div id="grilla_type2" style="background-color:#ff5555; color:#FFF;"><?php echo number_format($c1, 0, ",", ".");?></div>
<?php }elseif(($c1>=$fcaj)&&($position_day=='6')){?>
<div id="grilla_type2" style="background-color:#ff5555; color:#FFF;"><?php echo number_format($c1, 0, ",", ".");?></div>
<?php }elseif(($c1<=$scaj)&&($c1>=$v1)|| ($c1<=$fcaj)&&($c1>=$v2)){?>
<div id="grilla_type2" style="background-color:#fabb3d; color:#363023; font-weight:bold;"><?php echo number_format($c1, 0, ",", ".");?></div>
<?php }elseif($c1<='0'){?>
<div id="grilla_type2" style="background-color:#42910e; color:#FFF; font-weight:bold; text-align:center"><?php echo ('-');?></div>
<?php }else{?>
<div id="grilla_type2" style="background-color:#42910e; color:#FFF; font-weight:bold;"><?php echo number_format($c1, 0, ",", ".");?></div>
<?php }}}?>
</div>

<div id="grilla_fila_grupos2" style="border-top:#895455 solid 2px; border-bottom:#895455 solid 2px;">

<!-- BUSCAMOS INFORMACION RELACIONADA CON COLCHONERÍA-->
<?php
//BUSCO LAS CAPACIDAD DE BD
$cons=DB::select("SELECT * FROM capacidad WHERE tipo_manejo='COLC'");
//$y=mysql_query($cons);$con2=mysql_fetch_array($y);
foreach($cons as $con2){
$scaj=$con2->semana;
$fcaj=$con2->finde;
}
?>

<div id="grilla_fila_grupos">
<div id="grilla_type00">COLCHONERÍA</div>
<div id="grilla_type1" style="font-size:11px;"><?php echo number_format($scaj, 0, ",", ".");?> | <?php echo number_format($fcaj, 0, ",", ".");?></div>
<?php
//RECORRO LAS FECHAS FUTURAS HASTA 14 DIAS, SE GENERA LA VARIABLE DINAMICA
for($i=0 ; $i<=13 ; $i++){
$d='+ '.$i." ".'day';
$day=date("Y-m-d",strtotime($d ,strtotime($hoy)));
$position_day=date("w",strtotime($day));
$v1=round($scaj-($scaj*20/100));
$v2=round($fcaj-($fcaj*20/100));
//EJECUTO LA CONSULTA EN LA ITERACION
$sql2=DB::select("select (sum(cast(sin_pred as int))+sum(cast(con_pred as int))) as tot_unid from (select distinct(cita),sin_pred,con_pred from citas where fech_cita ='$day' and manejo='GVO' AND cod_depto='D360' AND  cita NOT IN (SELECT (nro_cta) FROM puertaexpress)) as tabla");
//$x2=mysql_query($sql2);
foreach($sql2 as $arr2){
//while($arr2=mysql_fetch_array($x2)){
$n1=$arr2->tot_unid;
if($n1>=$scaj){
?>
<div id="grilla_type2" style="background-color:#ff5555; color:#FFF; font-weight:bold;"><?php echo number_format($n1, 0, ",", ".");?></div>
<?php }elseif(($n1>=$fcaj)&&($position_day=='6')){?>
<div id="grilla_type2" style="background-color:#ff5555; color:#FFF; font-weight:bold;"><?php echo number_format($n1, 0, ",", ".");?></div>
<?php }elseif(($n1<=$scaj)&&($n1>=$v1)|| ($n1<=$fcaj)&&($n1>$v2)&&($position_day=='6')){?>
<div id="grilla_type2" style="background-color:#fabb3d; color:#363023; font-weight:bold;"><?php echo number_format($n1, 0, ",", ".");?></div>
<?php }elseif($n1<='0'){?>
<div id="grilla_type2" style="background-color:#42910e; color:#FFF; font-weight:bold; text-align:center"><?php echo ('-');?></div>
<?php }else{?>
<div id="grilla_type2" style="background-color:#42910e; color:#FFF; font-weight:bold;"><?php echo number_format($n1, 0, ",", ".");?></div>

<?php }}}?>

</div>

<!-- BUSCAMOS INFORMACION RELACIONADA CON MUEBLERÍA-->
<?php
//BUSCO LAS CAPACIDAD DE BD
$cons=DB::select("SELECT * FROM capacidad WHERE tipo_manejo='MUE'");
//$y=mysql_query($cons);$con2=mysql_fetch_array($y);
foreach($cons as $con2){
$scaj=$con2->semana;
$fcaj=$con2->finde;
}
?>
<div id="grilla_fila_grupos">
<div id="grilla_type00">MUEBLERÍA</div>
<div id="grilla_type1" style="font-size:11px;"><?php echo number_format($scaj, 0, ",", ".");?> | <?php echo number_format($fcaj, 0, ",", ".");?></div>
<?php
//RECORRO LAS FECHAS FUTURAS HASTA 14 DIAS, SE GENERA LA VARIABLE DINAMICA
for($i=0 ; $i<=13 ; $i++){
$d='+ '.$i." ".'day';
$day=date("Y-m-d",strtotime($d ,strtotime($hoy)));
$position_day=date("w",strtotime($day));
$v1=round($scaj-($scaj*20/100));
$v2=round($fcaj-($fcaj*20/100));
//EJECUTO LA CONSULTA EN LA ITERACION
$sql2=DB::select("select (sum(cast(sin_pred as int))+sum(cast(con_pred as int))) as tot_unid from (select distinct(cita),sin_pred,con_pred from citas where fech_cita ='$day' and manejo='GVO' AND cod_depto='D359' AND  cita NOT IN (SELECT (nro_cta) FROM puertaexpress)) as tabla");
//$x2=mysql_query($sql2);
//while($arr2=mysql_fetch_array($x2)){
foreach($sql2 as $arr2){
$n1=$arr2->tot_unid;
if($n1>=$scaj){
?>
<div id="grilla_type2" style="background-color:#ff5555; color:#FFF; font-weight:bold;"><?php echo number_format($n1, 0, ",", ".");?></div>
<?php }elseif(($n1>=$fcaj)&&($position_day=='6')){?>
<div id="grilla_type2" style="background-color:#ff5555; color:#FFF; font-weight:bold;"><?php echo number_format($n1, 0, ",", ".");?></div>
<?php }elseif(($n1<=$scaj)&&($n1>=$v1)|| ($n1<=$fcaj)&&($n1>$v2)&&($position_day=='6')){?>
<div id="grilla_type2" style="background-color:#fabb3d; color:#363023; font-weight:bold;"><?php echo number_format($n1, 0, ",", ".");?></div>
<?php }elseif($n1<='0'){?>
<div id="grilla_type2" style="background-color:#42910e; color:#FFF; font-weight:bold; text-align:center"><?php echo ('-');?></div>
<?php }else{?>
<div id="grilla_type2" style="background-color:#42910e; color:#FFF; font-weight:bold;"><?php echo number_format($n1, 0, ",", ".");?></div>
<?php }}}?>

</div>

<!-- BUSCAMOS INFORMACION RELACIONADA CON LINEA BLANCA-->
<?php
//BUSCO LAS CAPACIDAD DE BD
$cons=DB::select("SELECT * FROM capacidad WHERE tipo_manejo='LINB'");
//$y=mysql_query($cons);$con2=mysql_fetch_array($y);
foreach($cons as $con2){
$scaj=$con2->semana;
$fcaj=$con2->finde;
}
?>
<div id="grilla_fila_grupos">
<div id="grilla_type00">LINEA BLANCA</div>
<div id="grilla_type1" style="font-size:11px;"><?php echo number_format($scaj, 0, ",", ".");?> | <?php echo number_format($fcaj, 0, ",", ".");?></div>
<?php
//RECORRO LAS FECHAS FUTURAS HASTA 14 DIAS, SE GENERA LA VARIABLE DINAMICA
for($i=0 ; $i<=13 ; $i++){
$d='+ '.$i." ".'day';
$day=date("Y-m-d",strtotime($d ,strtotime($hoy)));
$position_day=date("w",strtotime($day));
$v1=round($scaj-($scaj*20/100));
$v2=round($fcaj-($fcaj*20/100));
//EJECUTO LA CONSULTA EN LA ITERACION
$sql2=DB::select("select (sum(cast(sin_pred as int))+sum(cast(con_pred as int))) as tot_unid from (select distinct(cita),sin_pred,con_pred from citas where fech_cita ='$day' and manejo='GVO' AND cod_depto='D136' AND  cita NOT IN (SELECT (nro_cta) FROM puertaexpress)) as tabla");
//$x2=mysql_query($sql2);
//while($arr2=mysql_fetch_array($x2)){
foreach($sql2 as $arr2){
$n1=$arr2->tot_unid;
if($n1>=$scaj){
?>
<div id="grilla_type2" style="background-color:#ff5555; color:#FFF; font-weight:bold;"><?php echo number_format($n1, 0, ",", ".");?></div>
<?php }elseif(($n1>=$fcaj)&&($position_day=='6')){?>
<div id="grilla_type2" style="background-color:#ff5555; color:#FFF; font-weight:bold;"><?php echo number_format($n1, 0, ",", ".");?></div>
<?php }elseif(($n1<=$scaj)&&($n1>=$v1)|| ($n1<=$fcaj)&&($n1>$v2)&&($position_day=='6')){?>
<div id="grilla_type2" style="background-color:#fabb3d; color:#363023; font-weight:bold;"><?php echo number_format($n1, 0, ",", ".");?></div>
<?php }elseif($n1<='0'){?>
<div id="grilla_type2" style="background-color:#42910e; color:#FFF; font-weight:bold; text-align:center"><?php echo ('-');?></div>
<?php }else{?>
<div id="grilla_type2" style="background-color:#42910e; color:#FFF; font-weight:bold;"><?php echo number_format($n1, 0, ",", ".");?></div>

<?php }}}?>

</div>


<!-- BUSCAMOS INFORMACION RELACIONADA CON TV-VIDEO-->
<?php
//BUSCO LAS CAPACIDAD DE BD
$cons=DB::select("SELECT * FROM capacidad WHERE tipo_manejo='TVV'");
//$y=mysql_query($cons);$con2=mysql_fetch_array($y);
foreach($cons as $con2){
$scaj=$con2->semana;
$fcaj=$con2->finde;
}
?>
<div id="grilla_fila_grupos">
<div id="grilla_type00" >TV-VIDEO</div>
<div id="grilla_type1" style="font-size:11px;"><?php echo number_format($scaj, 0, ",", ".");?> | <?php echo number_format($fcaj, 0, ",", ".");?></div>
<?php
//RECORRO LAS FECHAS FUTURAS HASTA 14 DIAS, SE GENERA LA VARIABLE DINAMICA
for($i=0 ; $i<=13 ; $i++){
$d='+ '.$i." ".'day';
$day=date("Y-m-d",strtotime($d ,strtotime($hoy)));
$position_day=date("w",strtotime($day));
$v1=round($scaj-($scaj*20/100));
$v2=round($fcaj-($fcaj*20/100));
//EJECUTO LA CONSULTA EN LA ITERACION
$sql2=DB::select("select (sum(cast(sin_pred as int))+sum(cast(con_pred as int))) as tot_unid from (select distinct(cita),sin_pred,con_pred from citas where fech_cita ='$day' and manejo='GVO' AND cod_depto='D171' AND  cita NOT IN (SELECT (nro_cta) FROM puertaexpress)) as tabla");
//$x2=mysql_query($sql2);
//while($arr2=mysql_fetch_array($x2)){
foreach($sql2 as $arr2){
$n1=$arr2->tot_unid;
if($n1>=$scaj){
?>
<div id="grilla_type2" style="background-color:#ff5555; color:#FFF; font-weight:bold;"><?php echo number_format($n1, 0, ",", ".");?></div>
<?php }elseif(($n1>=$fcaj)&&($position_day=='6')){?>
<div id="grilla_type2" style="background-color:#ff5555; color:#FFF; font-weight:bold;"><?php echo number_format($n1, 0, ",", ".");?></div>
<?php }elseif(($n1<=$scaj)&&($n1>=$v1)|| ($n1<=$fcaj)&&($n1>$v2)&&($position_day=='6')){?>
<div id="grilla_type2" style="background-color:#fabb3d; color:#363023; font-weight:bold;"><?php echo number_format($n1, 0, ",", ".");?></div>
<?php }elseif($n1<='0'){?>
<div id="grilla_type2" style="background-color:#42910e; color:#FFF; font-weight:bold; text-align:center"><?php echo ('-');?></div>
<?php }else{?>
<div id="grilla_type2" style="background-color:#42910e; color:#FFF; font-weight:bold;"><?php echo number_format($n1, 0, ",", ".");?></div>

<?php }}}?>


</div>


<!-- BUSCAMOS INFORMACION RELACIONADA CON ALFOMBRAS-->
<?php
//BUSCO LAS CAPACIDAD DE BD
$cons=DB::select("SELECT * FROM capacidad WHERE tipo_manejo='ALF'");
//$y=mysql_query($cons);$con2=mysql_fetch_array($y);
foreach($cons as $con2)
{
$scaj=$con2->semana;
$fcaj=$con2->finde;
}
?>
<div id="grilla_fila_grupos">
<div id="grilla_type00">ALFOMBRAS</div>
<div id="grilla_type1" style="font-size:11px;"><?php echo number_format($scaj, 0, ",", ".");?> | <?php echo number_format($fcaj, 0, ",", ".");?></div>
<?php
//RECORRO LAS FECHAS FUTURAS HASTA 14 DIAS, SE GENERA LA VARIABLE DINAMICA
for($i=0 ; $i<=13 ; $i++){
$d='+ '.$i." ".'day';
$day=date("Y-m-d",strtotime($d ,strtotime($hoy)));
$position_day=date("w",strtotime($day));
$v1=round($scaj-($scaj*20/100));
$v2=round($fcaj-($fcaj*20/100));
//EJECUTO LA CONSULTA EN LA ITERACION
$sql2=DB::select("select (sum(cast(sin_pred as int))+sum(cast(con_pred as int))) as tot_unid from (select distinct(cita),sin_pred,con_pred from citas where fech_cita ='$day' and manejo='GVO' AND cod_depto='D102' AND  cita NOT IN (SELECT (nro_cta) FROM puertaexpress)) as tabla");
//$x2=mysql_query($sql2);
//while($arr2=mysql_fetch_array($x2)){
foreach($sql2 as $arr2){
$n1=$arr2->tot_unid;
if($n1>=$scaj){
?>

<div id="grilla_type2" style="background-color:#ff5555; color:#FFF; font-weight:bold;"><?php echo number_format($n1, 0, ",", ".");?></div>
<?php }elseif(($n1>=$fcaj)&&($position_day=='6')){?>
<div id="grilla_type2" style="background-color:#ff5555; color:#FFF; font-weight:bold;"><?php echo number_format($n1, 0, ",", ".");?></div>
<?php }elseif(($n1<=$scaj)&&($n1>=$v1)|| ($n1<=$fcaj)&&($n1>$v2)&&($position_day=='6')){?>
<div id="grilla_type2" style="background-color:#fabb3d; color:#363023; font-weight:bold;"><?php echo number_format($n1, 0, ",", ".");?></div>
<?php }elseif($n1<='0'){?>
<div id="grilla_type2" style="background-color:#42910e; color:#FFF; font-weight:bold; text-align:center"><?php echo ('-');?></div>
<?php }else{?>
<div id="grilla_type2" style="background-color:#42910e; color:#FFF; font-weight:bold;"><?php echo number_format($n1, 0, ",", ".");?></div>

<?php }}}?>

</div>


<!-- BUSCAMOS INFORMACION RELACIONADA CON bt caja-->
<?php
//BUSCO LAS CAPACIDAD DE BD
$cons=DB::select("SELECT * FROM capacidad WHERE tipo_manejo='BTCAJA'");
//$y=mysql_query($cons);$con2=mysql_fetch_array($y);
foreach($cons as $con2){
$scaj=$con2->semana;
$fcaj=$con2->finde;
}
?>
<div id="grilla_fila_grupos">
<div id="grilla_type00">BT CAJAS(GVO)</div>
<div id="grilla_type1" style="font-size:11px;"><?php echo number_format($scaj, 0, ",", ".");?> | <?php echo number_format($fcaj, 0, ",", ".");?></div>
<?php
//RECORRO LAS FECHAS FUTURAS HASTA 14 DIAS, SE GENERA LA VARIABLE DINAMICA
for($i=0 ; $i<=13 ; $i++){
$d='+ '.$i." ".'day';
$day=date("Y-m-d",strtotime($d ,strtotime($hoy)));
$position_day=date("w",strtotime($day));
$v1=round($scaj-($scaj*20/100));
$v2=round($fcaj-($fcaj*20/100));
//EJECUTO LA CONSULTA EN LA ITERACION
$sql2=DB::select("SELECT (sum(cast(sin_pred as int))+sum(cast(con_pred as int))) AS tot_unid  FROM citas WHERE fech_cita='$day' AND manejo='GVO' AND cita NOT IN (SELECT (nro_cta)  FROM puertaexpress)");
//$x2=mysql_query($sql2);
foreach($sql2 as $arr2){
//while($arr2=mysql_fetch_array($x2)){
$n1=$arr2->tot_unid;
if($n1>=$scaj){
?>
<div id="grilla_type2" style="background-color:#ff5555; color:#FFF; font-weight:bold;"><?php echo number_format($n1, 0, ",", ".");?></div>
<?php }elseif(($n1>=$fcaj)&&($position_day=='6')){?>
<div id="grilla_type2" style="background-color:#ff5555; color:#FFF; font-weight:bold;"><?php echo number_format($n1, 0, ",", ".");?></div>
<?php }elseif(($n1<=$scaj)&&($n1>=$v1)|| ($n1<=$fcaj)&&($n1>=$v2)&&($position_day=='6')){?>
<div id="grilla_type2" style="background-color:#fabb3d; color:#363023; font-weight:bold;"><?php echo number_format($n1, 0, ",", ".");?></div>
<?php }elseif($n1<='0'){?>
<div id="grilla_type2" style="background-color:#42910e; color:#FFF; font-weight:bold; text-align:center"><?php echo ('-');?></div>
<?php }else{?>
<div id="grilla_type2" style="background-color:#42910e; color:#FFF; font-weight:bold;"><?php echo number_format($n1, 0, ",", ".");?></div>



<?php }}}?>
</div>
</div>
</div>







<!-- **************************************************************************************************************************-->
<!-- INICIO DE PUERTA EXPRESS-->
<!-- **************************************************************************************************************************-->

<div id="box-agenda">
<div id="box-tit"><a href="DescargarPta.php"><button id="btn-descarga" class="btn-descarga">Descargar</button></a>Estatus Puerta Express Próximos 14 días</div>

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
<div id="grilla_type22" style="color:#fff; font-weight:bold;"> <?php echo date("d-M",strtotime($dia));?></div>
<?php }else{?>
<div id="grilla_type22"> <?php echo date("d-M",strtotime($dia));?></div>
<?php }}?>
</div>


<!-- BUSCAMOS INFORMACION RELACIONADA CON UNIDAD G1(X 100)-->

<div id="grilla_fila_pta">
<div id="grilla_type00"></div>
<div id="grilla_type1"></div>
<?php
//RECORRO LAS FECHAS FUTURAS HASTA 14 DIAS, SE GENERA LA VARIABLE DINAMICA
for($i=0 ; $i<=13 ; $i++){
$d='+ '.$i." ".'day';
$day=date("Y-m-d",strtotime($d ,strtotime($hoy)));
//EJECUTO LA CONSULTA EN LA ITERACION
//$sql2="SELECT (SUM(con_pred)+SUM(sin_pred)) AS tot_unid  FROM citas WHERE fech_cita='$day' AND manejo='GVO'";
//$x2=mysql_query($sql2);
//while($arr2=mysql_fetch_array($x2)){
//$n1=$arr2['tot_unid'];
//if($n1>=$con2['semana']){
$Und="Und.";
$Bulto="Bult.";
?>
<div id="grilla_pta" style="font-weight:bold; color:#333333"><?php echo ($Und);?></div>
<div id="grilla_pta" style="font-weight:bold; color:#333333"><?php echo ($Bulto);?></div>


<?php }?>
</div>

<!-- BUSCAMOS INFORMACION RELACIONADA CON CAJA PUERTA EXPRESS-->

<div id="grilla_fila_pta">
<div id="grilla_type00">CAJA</div>
<div id="grilla_type1"></div>
<?php
//RECORRO LAS FECHAS FUTURAS HASTA 14 DIAS, SE GENERA LA VARIABLE DINAMICA
for($i=0 ; $i<=13 ; $i++){
$d='+ '.$i." ".'day';
$day=date("Y-m-d",strtotime($d ,strtotime($hoy)));
//EJECUTO LA CONSULTA EN LA ITERACION
$sql2=DB::select("SELECT (SUM(cant_unid_agen)) AS tot_unid, (SUM(bultos)) AS tot_bult  FROM puertaexpress WHERE fech_cta='$day' AND tipo_manejo='CAJ'");
//$x2=mysql_query($sql2);
foreach($sql2 as $arr2){
//while($arr2=mysql_fetch_array($x2)){
$n1=$arr2->tot_unid;
$n2=$arr2->tot_bult;
?>
<?php
if(empty($n1)){?>
<div id="grilla_pta_num" style="color:#333;" class="tooltip">
<span class="tooltiptext"> - </span>  </div>
<?php }else{?>
<div id="grilla_pta_num" style="color:#333;" class="tooltip">
<span class="tooltiptext">
	<?php echo number_format($n1, 0, ",", ".");?>
</span>
	<?php echo number_format($n1, 0, ",", ".");?>
</div>


<?php
}

if(empty($n2)){?>
<div id="grilla_pta_num" style="color:#333;" class="tooltip">
<span class="tooltiptext"> - </span>  </div>
<?php }else{?>
<div id="grilla_pta_num" style="color:#333;" class="tooltip">
<span class="tooltiptext">
	<?php echo number_format($n2, 0, ",", ".");?>
</span>
	<?php echo number_format($n2, 0, ",", ".");?>
</div>


<?php }}} ?>
</div>



<!-- BUSCAMOS INFORMACION RELACIONADA CON UNIDAD G1(X 100)-->

<div id="grilla_fila_pta">
<div id="grilla_type00">SENSIBLE</div>
<div id="grilla_type1"></div>
<?php
//RECORRO LAS FECHAS FUTURAS HASTA 14 DIAS, SE GENERA LA VARIABLE DINAMICA
for($i=0 ; $i<=13 ; $i++){
$d='+ '.$i." ".'day';
$day=date("Y-m-d",strtotime($d ,strtotime($hoy)));
//EJECUTO LA CONSULTA EN LA ITERACION
$sql2=DB::select("SELECT (SUM(cant_unid_agen)) AS tot_unid, (SUM(bultos)) AS tot_bult  FROM puertaexpress WHERE fech_cta='$day' AND tipo_manejo='SEN'");
//$x2=mysql_query($sql2);
foreach ($sql2 as $arr2) {
//while($arr2=mysql_fetch_array($x2)){
$n1=$arr2->tot_unid;
$n2=$arr2->tot_bult;
?>
<?php
if(empty($n1)){?>
<div id="grilla_pta_num" style="color:#333;" class="tooltip">
<span class="tooltiptext"> - </span>  </div>
<?php }else{?>
<div id="grilla_pta_num" style="color:#333;" class="tooltip">
<span class="tooltiptext">
	<?php echo number_format($n1, 0, ",", ".");?>
</span>
	<?php echo number_format($n1, 0, ",", ".");?>
</div>
<?php
}

if(empty($n2)){?>
<div id="grilla_pta_num" style="color:#333;" class="tooltip">
<span class="tooltiptext"> - </span>  </div>
<?php }else{?>
<div id="grilla_pta_num" style="color:#333;" class="tooltip">
<span class="tooltiptext">
	<?php echo number_format($n2, 0, ",", ".");?>
</span>
	<?php echo number_format($n2, 0, ",", ".");?>
</div>
<?php }}} ?>
</div>

<!-- BUSCAMOS INFORMACION RELACIONADA CON UNIDAD G2(X 50)-->

<div id="grilla_fila_pta">
<div id="grilla_type00">COLGADO</div>
<div id="grilla_type1"></div>
<?php
//RECORRO LAS FECHAS FUTURAS HASTA 14 DIAS, SE GENERA LA VARIABLE DINAMICA
for($i=0 ; $i<=13 ; $i++){
$d='+ '.$i." ".'day';
$day=date("Y-m-d",strtotime($d ,strtotime($hoy)));
//EJECUTO LA CONSULTA EN LA ITERACION
$sql2=DB::select("SELECT (SUM(cant_unid_agen)) AS tot_unid, (SUM(bultos)) AS tot_bult  FROM puertaexpress WHERE fech_cta='$day' AND tipo_manejo='COL'");
//$x2=mysql_query($sql2);
//while($arr2=mysql_fetch_array($x2)){
foreach($sql2 as $arr2){
$n1=$arr2->tot_unid;
$n2=$arr2->tot_bult;
?>
<?php
if(empty($n1)){?>
<div id="grilla_pta_num" style="color:#333;" class="tooltip">
<span class="tooltiptext"> - </span>  </div>
<?php }else{?>
<div id="grilla_pta_num" style="color:#333;" class="tooltip">
<span class="tooltiptext">
	<?php echo number_format($n1, 0, ",", ".");?>
</span>
	<?php echo number_format($n1, 0, ",", ".");?>
</div>


<?php
}

if(empty($n2)){?>
<div id="grilla_pta_num" style="color:#333;" class="tooltip">
<span class="tooltiptext"> - </span>  </div>
<?php }else{?>
<div id="grilla_pta_num" style="color:#333;" class="tooltip">
<span class="tooltiptext">
	<?php echo number_format($n2, 0, ",", ".");?>
</span>
	<?php echo number_format($n2, 0, ",", ".");?>
</div>


<?php }}} ?>
</div>





<!-- BUSCAMOS INFORMACION RELACIONADA CON UNIDAD G3(X 1)-->

<div id="grilla_fila_pta">
<div id="grilla_type00">GVO</div>
<div id="grilla_type1"></div>
<?php
//RECORRO LAS FECHAS FUTURAS HASTA 14 DIAS, SE GENERA LA VARIABLE DINAMICA
for($i=0 ; $i<=13 ; $i++){
$d='+ '.$i." ".'day';
$day=date("Y-m-d",strtotime($d ,strtotime($hoy)));
//EJECUTO LA CONSULTA EN LA ITERACION
$sql2=DB::select("SELECT (SUM(cant_unid_agen)) AS tot_unid, (SUM(bultos)) AS tot_bult  FROM puertaexpress WHERE fech_cta='$day' AND tipo_manejo='GVO'");
//$x2=mysql_query($sql2);
//while($arr2=mysql_fetch_array($x2)){
foreach($sql2 as $arr2){
$n1=$arr2->tot_unid;
$n2=$arr2->tot_bult;
?>
<?php
if(empty($n1)){?>
<div id="grilla_pta_num" style="color:#333;" class="tooltip">
<span class="tooltiptext"> - </span>  </div>
<?php }else{?>
<div id="grilla_pta_num" style="color:#333;" class="tooltip">
<span class="tooltiptext">
	<?php echo number_format($n1, 0, ",", ".");?>
</span>
	<?php echo number_format($n1, 0, ",", ".");?>
</div>


<?php
}

if(empty($n2)){?>
<div id="grilla_pta_num" style="color:#333;" class="tooltip">
<span class="tooltiptext"> - </span>  </div>
<?php }else{?>
<div id="grilla_pta_num" style="color:#333;" class="tooltip">
<span class="tooltiptext">
	<?php echo number_format($n2, 0, ",", ".");?>
</span>
	<?php echo number_format($n2, 0, ",", ".");?>
</div>


<?php }}} ?>
</div>





<!-- BUSCAMOS INFORMACION RELACIONADA CON UNIDAD G1(X 100)-->
<?php
//BUSCO LAS CAPACIDAD DE BD
$cons=DB::select("SELECT * FROM capacidad WHERE tipo_manejo='PtaExpress'");
//$y=mysql_query($cons);$con2=mysql_fetch_array($y);
foreach($cons as $con2){
$scaj=$con2->semana;
$fcaj=$con2->finde;
}
?>
<div id="grilla_fila_pta">
<div id="grilla_type00">TOTAL</div>
<div id="grilla_type1"><?php echo number_format($scaj, 0, ",", ".");?><?php echo number_format($fcaj, 0, ",", ".");?></div>
<?php
//RECORRO LAS FECHAS FUTURAS HASTA 14 DIAS, SE GENERA LA VARIABLE DINAMICA
for($i=0 ; $i<=13 ; $i++){
$d='+ '.$i." ".'day';
$day=date("Y-m-d",strtotime($d ,strtotime($hoy)));
//EJECUTO LA CONSULTA EN LA ITERACION
$sql2=DB::select("SELECT (SUM(cant_unid_agen)) AS tot_unid, (SUM(bultos)) AS tot_bult  FROM puertaexpress WHERE fech_cta='$day'");
//$x2=mysql_query($sql2);

//while($arr2=mysql_fetch_array($x2)){
foreach($sql2 as $arr2){
$n1=$arr2->tot_unid;
$n2=$arr2->tot_bult;
}
?>
<?php
if(empty($n1)){?>
<div id="grilla_pta_num" style="color:#333;" class="tooltip">
<span class="tooltiptext"> - </span>  </div>
<?php }else{?>
<div id="grilla_pta_num" style="color:#333;" class="tooltip">
<span class="tooltiptext">
	<?php echo number_format($n1, 0, ",", ".");?>
</span>
	<?php echo number_format($n1, 0, ",", ".");?>
</div>


<?php
}

if(empty($n2)){?>
<div id="grilla_pta_num" style="color:#333;" class="tooltip">
<span class="tooltiptext"> - </span>  </div>
<?php }else{?>
<div id="grilla_pta_num" style="color:#333;" class="tooltip">
<span class="tooltiptext">
	<?php echo number_format($n2, 0, ",", ".");?>
</span>
	<?php echo number_format($n2, 0, ",", ".");?>
</div>


<?php }} ?>
</div>



<!-- **************************************************************************************************************************-->
<!-- FIN DE PUERTA EXPRESS-->
<!-- **************************************************************************************************************************-->
</div>

<!-- **************************************************************************************************************************-->
<!-- INICIO DE AWR Y ASR PENDIENTES -->
<!-- **************************************************************************************************************************-->

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
