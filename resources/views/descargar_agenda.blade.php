<?php
//header("Content-Type: application/vnd.ms-excel");

date_default_timezone_set('UTC');
 $hoy = date("Y-m-d");
 $dia1 = date("Y-m-d",strtotime( '+1 day' , strtotime($hoy)));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
</head>

<body>
<h1>Reporte Agenda 2021</h1>


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
</tr>

<?php

foreach($regr as $reg)
{
$cita = $reg->cita;
?>
<tr>
<td><?php
$regrr= DB::select("Select * FROM citas WHERE cita='$cita' ");
foreach($regrr as $reg2){
echo $reg2->oc." - "; }?>
</td>

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
</tr>
<?php
}
 ?>
</table>


</body>
</html>