<?php
date_default_timezone_set('UTC');
 $hoy = date("Y-m-d");
 $dia1 = date("Y-m-d",strtotime( '+1 day' , strtotime($hoy)));
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
</head>
<body>
<h1>Reporte Puerta Express</h1>
<table border="1">
<tr style="color:#FFFFFF; background-color:#000000;">
<td>FECHA CITA</td>
<td>NUMERO DE CITA</td>
<td>RUT PROVEEDOR</td>
<td>TIPO DE RECEPCIÓN</td>
<td>CANTIDAD DE UNIDADES AGENDADAS</td>
<td>NUMERO DE OC</td>
<td>DESCRIPCION METODO DISTRIBUCION</td>
<td>DESCRIPCION TIPO DE OC</td>
<td>FECHA CANCELACION</td>
<td>PROVEEDOR</td>
<td>TIPO DE MANEJO</td>
<td>DEPARTAMENTO</td>
<td>BULTOS</td>
<td>CC</td>
<td>DIVISION</td>
<td>DIVISIONAL</td>
<td>HORARIO</td>
<td>OBSERVACION</td>
<td>DESPACHO EXPRESS</td>
<td>LUGAR RECIBO</td>
</tr>
<?php
$sql=DB::select("select *  from puertaexpress  WHERE fech_cta >='$hoy' ");
?>
<table border="1" cellpadding="5" cellspacing="5">
<?php foreach($sql as $reg){ ?>
  <tr>
  <td><?php echo $reg->fech_cta;?></td>
  <td><?php echo $reg->nro_cta;?></td>
  <td><?php echo $reg->rut_proveedor;?></td>
  <td><?php echo $reg->tip_rec;?></td>
  <td><?php echo $reg->cant_unid_agen;?></td>
  <td><?php echo $reg->nro_oc;?></td>
  <td><?php echo $reg->desc_met_dist_oc;?></td>
  <td><?php echo $reg->desc_tipo_oc;?></td>
  <td><?php echo $reg->fech_canc;?></td>
  <td><?php echo $reg->proveedor;?></td>
  <td><?php echo $reg->tipo_manejo;?></td>
  <td><?php echo $reg->dpto;?></td>
  <td><?php echo $reg->bultos;?></td>
  <td><?php echo $reg->cc;?></td>
  <td><?php echo $reg->division;?></td>
  <td><?php echo $reg->divisional;?></td>
  <td><?php echo $reg->horario;?></td>
  <td><?php echo $reg->observacion;?></td>
  <td><?php echo $reg->despacho_express;?></td>
  <td><?php echo $reg->lugar_recibo;?></td>
  </tr>
<?php } ?>
</table>
</body>
</html>
