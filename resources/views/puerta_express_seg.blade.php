<?php
session_start();
if(isset($_SESSION['nombre_user'])) {
	# code...

//include("scripts/conexion.php");
date_default_timezone_set('UTC');
 $hoy = date("Y-m-d");
 $dia1 = date("Y-m-d",strtotime( '+1 day' , strtotime($hoy)));

if(isset($_POST['btnEnviar']))
{ registroPuerta($_POST['txtFechCita'],
				 $_POST['txtNroCita'],
				 $_POST['txtRutProv'],
                 $_POST['txtTipoRec'],
                 $_POST['txtCantUndAgendada'],
                 $_POST['txtNroOC'],
                 $_POST['txtDescMetDiscOC'],
                 $_POST['txtDescTipOC'],
                 $_POST['txtFechCanc'],
                 $_POST['txtProveedor'],
                 $_POST['txtTipoManej'],
                 $_POST['txtDepart'],
                 $_POST['txtBultos'],
                 $_POST['txtCC'],
                 $_POST['txtDivision'],
                 $_POST['txtDivisional'],
                 $_POST['txtHorario'],
                 $_POST['txtObserv'],
                 $_POST['txtDespExpress'],
                 $_POST['txtLugarRec']);
}



?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Agenda Redex</title>
<script type="text/javascript" src="{{ url('/js/jquery-3.1.1.min.js') }}"></script>
<script type="text/javascript" src="{{url('/js/Validaciones.js')}}"></script>
<script src="{{url('/js/sweetalert.min.js')}}"></script>
<link rel="stylesheet" type="text/css" href="{{url('/css/sweetalert.css')}}">
<link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />


</head>

<body>

<div id="contenedor">
<div id="header">
<img src="img/logoripley.png" style="float:left; margin-left:40px; margin-top:20px;"  height="50" width="120"/>
<img src="img/logoripley2.png" style="float:left; margin-left:40px; margin-top:20px;"  height="50" width="120"/>
<h2>Agenda Proveedores Nacionales V2</h2>
<h3 align="right" style="color:#FFFFFF; font-size:12px;;">Usuario:  <?php echo $_SESSION['nombre_user'];?></h3>
</div>
<div id="menu">
<a href="indexAdmin.php" ><div id="btn-menu">Agenda proveedor</div></a>
<a href="Puerta Express.php" ><div id="btn-menu">Puerta Express</div></a>
<a href="Parametros.php" ><div id="btn-menu">Parámetros</div></a>
<a href="Logout.php"><div id="btn-menu">Cerrar Sesión</div></a>
</div>

<div id="main">


<?php


$arreglopta =DB::select("SELECT * FROM citas LEFT JOIN equival ON citas.cod_depto = equival.depto WHERE citas.cita ='$txtBuscar'");
//$resultado = mysql_query($consultapta);
//$arreglopta = mysql_fetch_array($resultado);
$total = $arreglopta[0]->con_pred + $arreglopta[0]->sin_pred;
?>

<?php
$arreglopta2 =DB::select("SELECT * FROM puertaexpress WHERE nro_cta ='$txtBuscar'");
//$resultado2 = mysql_query($consultapta2);
//$arreglopta2 = mysql_fetch_array($resultado2);
?>



<form name="frmAgregaPta" class="frmAgregaPta" action="Puerta Express2.php" method="post">
<div id="box-agenda">
  <div id="box-tit">Buscar Cita </div>
  <ul>
  <li>
    <label for="name">Numero de cita</label>
    <input type="text" name="txtBuscar" class="txtBuscar" placeholder="Ingrese numero de cita" />
    <button name="btnBuscar" class="btnBuscar" type="submit">Cargar datos</button>
	<?php
	if((isset($_POST['btnBuscar']))&&(empty($arreglopta2[0]->despacho_express))){?>

	<h2>CITA NO AGENDADA COMO PUERTA EXPRESS</h2>
<?php }else if((isset($_POST['btnBuscar']))&&($arreglopta2[0]->despacho_express<>"")){?>
	<h2 style="color:#FF0000;">CITA AGENDADA COMO PUERTA EXPRESS PARA EL DÍA <strong style="background-color:#FFFF00;"><?php echo $arreglopta2[0]->fech_cta;?></strong></h2>
	<?php }else{ };?>
  </li>
  </ul>
<div id="box-tit">Formulario de Ingreso Puerta Express</div>


<div style="width: 50%; float:left;">

<ul>
	<li>
		<label for="name">Fecha Cita Agenda: </label>
		<input type="text" name="txtFechCita" class="txtFechCita" value="<?php echo $arreglopta[0]->fech_cita;?>" />
	</li>
	<li>
		<label for="name">Número de cita: </label>
		<input type="text" name="txtNroCita" class="txtNroCita"  value="<?php echo $arreglopta[0]->cita;?>" />
	</li>
	<li>
		<label for="name">Rut Proveedor: </label>
		<input type="text" name="txtRutProv" class="txtRutProv" value="<?php echo $arreglopta[0]->rut_prov;?>" />
	</li>
		<li>
		<label for="name">Unidades Agendadas: </label>
		<input type="text" name="txtCantUndAgendada" class="txtCantUndAgendada" value="<?php echo $total;?>" />
	</li>
	<li>
		<label for="name">Número OC: </label>
		<input type="text" name="txtNroOC" class="txtNroOC" value="<?php echo $arreglopta[0]->oc;?>" />
	</li>
	<li>
		<label for="name">Método de distribución: </label>
		<input type="text" name="txtDescMetDiscOC" class="txtDescMetDiscOC" value="<?php echo $arreglopta[0]->distribucion;?>" />
	</li>
	<li>
		<label for="name">Descripción tipo OC: </label>
		<input type="text" name="txtDescTipOC" class="txtDescTipOC" value="<?php echo $arreglopta[0]->tipo_orden;?>"/>
	</li>
	<li>
		<label for="name">Fecha Cancelación: </label>
		<input type="text" name="txtFechCanc" class="txtFechCanc" value="<?php echo $arreglopta[0]->cancela_oc;?>" />
	</li>
	<li>
		<label for="name">Proveedor: </label>
		<input type="text" name="txtProveedor" class="txtProveedor" value="<?php echo $arreglopta[0]->rs; ?>" />
	</li>
		<li>
		<label for="name">Tipo Manejo:</label>
		<input type="text" name="txtTipoManej" class="txtTipoManej" value="<?php echo $arreglopta[0]->manejo;?>" />
	</li>
	<li>
        <button name="btnEnviar" class="btnEnviar" type="submit">Guardar Puerta Express</button>
    </li>

</ul>
</div>

<div style="width: 50%; float: right;">
<ul>

	<li>
		<label for="name">Departamento:</label>
		<input type="text" name="txtDepart" class="txtDepart"  value="<?php echo $arreglopta[0]->cod_depto;?>"/>
	</li>
	<li>
		<label for="name">Tipo Recepción: </label>
		<select name="txtTipoRec" class="txtTipoRec" style="height:30px; width:270px; border:1px solid #FF0000;">
				<option value="Especial">Recepción Especial</option>
				<option value="Normal">Recepción Normal</option>
		</select>
	</li>
	<li>
		<label for="name">División:</label>
		<input type="text" name="txtDivision" class="txtDivision"  value="<?php echo $arreglopta[0]->division;?>"/>
	</li>
	<li>
		<label for="name">Divisional:</label>
		<input type="text" name="txtDivisional" class="txtDivisional"  value="<?php echo $arreglopta[0]->divisional;?>"/>
	</li>
	<li>
		<label for="name">CECO:</label>
		<input type="text" name="txtCC" class="txtCC"  value="<?php echo $arreglopta[0]->ceco;?>"/>
	</li>




	<li>
		<label for="name">Bultos:</label>
		<input type="text" name="txtBultos" class="txtBultos" value="<?php echo $arreglopta2[0]->bultos;?>" style="border:1px solid #FF0000;" />
	</li>
	<li>
		<label for="name">Horario:</label>
		<input type="time" name="txtHorario" class="txtHorario" value="<?php echo $arreglopta2[0]->horario;?>" style="border:1px solid #FF0000;"  />
	</li>
	<?php if(empty($arreglopta2[0]->despacho_express)){
	$consultapta_3 = DB::select("SELECT * FROM aux_tiendas ORDER BY desc_tienda ASC");
          //	$resultado3 = mysql_query($consultapta3);
	?>

	<li>
	<label for="name">Despacho Express:</label>
		<select name="txtDespExpress" class="txtDespExpress" style="height:30px; width:270px; border:1px solid #FF0000;">
				<option value="Sin Despacho Exp">Sin Despacho Exp.</option>
				<option value="Despacho Exp. NO Portal">Despacho Exp. NO Portal</option>
				<option value="R.M.">R.M.</option>
				<option value="R.M. + PRYME">R.M. + PRYME</option>
				<?php
            foreach($consultapta_3 as $consultapta3){
        //while($arreglopta3=mysql_fetch_array($resultado3)){?>
				<option value="<?php echo $arreglopta3->desc_tienda;?>"><?php echo $arreglopta3->desc_tienda;?></option>
				<?php }?>
		</select>
	</li>
	<?php }else{?>

		<li>
	<label for="name">Despacho Express:</label>
<input type="text" name="txtDespExpress" class="txtDespExpress" value="<?php echo $arreglopta2[0]->despacho_express;?>" style="border:1px solid #FF0000;" />
	</li>
	<?php }?>


	<?php if(empty($arreglopta2->lugar_recibo)){ ?>
		<li>
		<label for="name">Lugar De Recibo:</label>
		<select name="txtLugarRec" class="txtLugarRec" style="height:30px; width:270px; border:1px solid #FF0000;">
				<option value="CAJA">CAJA</option>
				<option value="COLGADO">COLGADO</option>
				<option value="SENSIBLE">SENSIBLE</option>
				<option value="GVO">GVO</option>
		</select>
	</li>
	<?php }else{?>
	<li>
		<label for="name">Lugar De Recibo:</label>
		<input type="text" name="txtLugarRec" class="txtLugarRec" value="<?php echo $arreglopta2[0]->lugar_recibo;?>" style="border:1px solid #FF0000;" />
	</li>
	<?php }?>
	<li>
		<label for="name">Observación:</label>
		<input type="text" name="txtObserv" class="txtObserv" value="<?php echo $arreglopta2[0]->observacion;?>" style="border:1px solid #FF0000;" />
	</li>

</ul>
</div>


</div>


</form>
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
