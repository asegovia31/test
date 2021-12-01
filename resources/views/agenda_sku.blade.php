<?php

//require_once("conexion2.php");
//require_once("conexionwms.php");
date_default_timezone_set('UTC');
 $hoy = date("Y-m-d");
 $dia1 = date("Y-m-d",strtotime( '+1 day' , strtotime($hoy)));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
</head>

<body>
<h1>Reporte Agenda</h1>


<table border="1">
<tr style="color:#FFFFFF; background-color:#000000;">
<td>OC</td>
<td>DISTRIBUCION</td>
<td>TIPO DE ORDEN</td>
<td>MANEJO</td>
<td>FECHA CITA</td>
<td>CITA</td>
<td>HORA DE INICIO</td>
<td>HORA DE TERMINO</td>
<td>RUT PROVEEDOR</td>
<td>RAZON SOCIAL</td>
<td>UNIDADES CON PRE DISTRIBUCION</td>
<td>UNIDADES SIN PRE DISTRIBUCION</td>
<td>EVENTO</td>
<td>FECHA CANCELACION</td>
<td>CODIGO DEPARTAMENTO</td>
<td>DESCRIPCION DEPARTAMENTO</td>
<td>SKU</td>
<td>UNID_ORDENADAS</td>
<td>FECHA_MODIFICACION</td>

</tr>


<!-- CONSULTA PUERTA EXPRESS -->

<?php
/*
$sql="Select cita,
             oc,
             distribucion,
             tipo_orden,
             manejo,
             fech_cita,
             digita_inicio,
             digita_final,
             rut_prov,
             rs,
             con_pred,
             sin_pred,
             evento,
             cancela_oc,
             cod_depto,
             decrip_depto from citas ";
                                     */
//$c=mysql_query($sql);
//while($reg=mysql_fetch_array($c)){

foreach($cons_sku as $reg)
{
$cita = $reg->cita;
	$oc =	$reg->oc; ?>
	  	  <?php
//	    $query_search1 = "SELECT SKU_ID,UNITS_ORDERED,MOD_DATE_TIME FROM PO_DTL where PO_NBR='$oc' ";
//$stid1 = oci_parse($conexion1, $query_search1);
//oci_execute($stid1);
//while($reg2=oci_fetch_array($stid1)){
//$datemod = date("Y-m-d ", strtotime($reg2['MOD_DATE_TIME']));
?>
<tr>
<td><?php echo $reg->oc;?></td>
<td><?php echo $reg->distribucion;?></td>
<td><?php echo $reg->tipo_orden;?></td>
<td><?php echo $reg->manejo;?></td>
<td><?php echo $reg->fech_cita;?></td>
<td><?php echo $reg->cita;?></td>
<td><?php echo $reg->digita_inicio;?></td>
<td><?php echo $reg->digita_final;?></td>
<td><?php echo $reg->rut_prov;?></td>
<td><?php echo substr($reg->rs,0,30);?></td>
<td><?php echo $reg->con_pred;?></td>
<td><?php echo $reg->sin_pred;?></td>
<td><?php echo $reg->evento;?></td>
<td><?php echo $reg->cancela_oc;?></td>
<td><?php echo $reg->cod_depto;?></td>
<td><?php echo $reg->decrip_depto;?></td>


<td><?php //echo $reg2['SKU_ID'];?></td>
<td><?php //echo $reg2['UNITS_ORDERED'];?></td>
<td><?php //echo $datemod;?></td>

</tr>
<?php }//} ?>
</table>


</body>
</html>
