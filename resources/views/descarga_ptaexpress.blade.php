<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>s</title>
</head>

<body>
<h1>Reporte Puerta Express</h1>

<table border="1">
<tr style="color:#FFFFFF; background-color:#000000;">
<td>FECHA CITA</td>
<td>NUMERO DE CITA</td>
<td>RUT PROVEEDOR</td>
<td>TIPO DE RECEPCION</td>
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
<td>COBRO</td>
</tr>

<!-- CONSULTA PUERTA EXPRESS -->

<?php

//print_r($_GET);exit(0);

$calendar = $_GET['calendar'];
$calendar2 = $_GET['calendar2'];
//extract($_REQUEST);
//require_once("scripts/conexion.php");
$id;
$sql=DB::select("Select * from puertaexpress WHERE fech_cta >='$calendar' AND fech_cta <='$calendar2' ");
//$c=mysql_query($sql);
?>

<?php

foreach($sql as $reg){
                                    ?>
<tr>
<td><?php echo $reg->fech_cta;?></td>
<td><?php echo $reg->nro_cta;?></td>
<td><?php echo $reg->rut_proveedor;?></td>
<td><?php echo $reg->tip_rec;?></td>
<td><?php echo $unids = $reg->cant_unid_agen;?></td>
<td><?php echo $reg->nro_oc;?></td>
<td><?php echo $reg->desc_met_dist_oc;?></td>
<td><?php echo $reg->desc_tipo_oc;?></td>
<td><?php echo $reg->fech_canc;?></td>
<td><?php //echo $reg->proveedor;?></td>
<td><?php echo $reg->tipo_manejo;?></td>
<td><?php echo $depto = $reg->dpto;?></td>
<td><?php echo $reg->bultos;?></td>
<td><?php echo $reg->cc;?></td>
<td><?php echo $reg->division;?></td>
<td><?php echo $reg->divisional;?></td>
<td><?php echo $reg->horario;?></td>
<td><?php echo $reg->observacion;?></td>
<td><?php echo $reg->despacho_express;?></td>
<td><?php echo $reg->lugar_recibo;?></td>
<td><?php


if(($depto=='D359')||($depto=='D136')){
echo $unids*3000;
}else if($depto=='D171'){
echo $unids*2000;
}else{
echo 0;
}?></td>


</tr>
<?php } ?>
</table>


</body>
</html>
