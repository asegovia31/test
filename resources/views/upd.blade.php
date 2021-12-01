<?php
session_start();
if(isset($_SESSION['nombre_user'])) {
	# code...

//include("scripts/conexion.php");
date_default_timezone_set('UTC');
 $hoy = date("Y-m-d");
 $dia1 = date("Y-m-d",strtotime( '+1 day' , strtotime($hoy)));

if(isset($_POST['btnUpdate']))
{ updateexp($_POST['txtFechCita'],
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
<link href="{{url('/css/estilo.css')}}" rel="stylesheet" type="text/css" />
</head>


<body>

<div id="contenedor">
<div id="header">
<img src="{{url('img/logoripley.png')}}" style="float:left; margin-left:40px; margin-top:20px;"  height="50" width="120"/>
<img src="{{url('img/logoripley2.png')}}" style="float:left; margin-left:40px; margin-top:20px;"  height="50" width="120"/>
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


<?php
$arreglopta =DB::select("SELECT * FROM puertaexpress WHERE nro_cta ='$id'");
//$resultado = mysql_query($consultapta);
//$arreglopta = mysql_fetch_array($resultado);
?>

<form name="frmAgregaPta" class="frmAgregaPta" action="{{url('upd_r')}}" method="post">
@csrf
<div id="box-agenda">
 <div id="box-tit">Actualización Puerta Express</div>


<div style="width: 50%; float:left;">
<input type="hidden" name="id" value="<?php echo $id;?>" />
<ul>
	<li>
		<label for="name">Fecha Cita: </label>
		<input type="text" name="txtFechCita" class="txtFechCita" value="<?php echo $arreglopta[0]->fech_cta;?>" style="border:1px solid #FF0000;"/>
	</li>
	<li>
		<label for="name">Número de cita: </label>
		<input type="text" name="txtNroCita" class="txtNroCita"  value="<?php echo $arreglopta[0]->nro_cta;?>" />
	</li>
	<li>
		<label for="name">Rut Proveedor: </label>
		<input type="text" name="txtRutProv" class="txtRutProv" value="<?php echo $arreglopta[0]->rut_proveedor;?>" />
	</li>
		<li>
		<label for="name">Unidades Agendadas: </label>
		<input type="text" name="txtCantUndAgendada" class="txtCantUndAgendada" value="<?php echo $arreglopta[0]->cant_unid_agen;?>" />
	</li>
	<li>
		<label for="name">Número OC: </label>
		<input type="text" name="txtNroOC" class="txtNroOC" value="<?php echo $arreglopta[0]->nro_oc;?>" />
	</li>
	<li>
		<label for="name">Método de distribución: </label>
		<input type="text" name="txtDescMetDiscOC" class="txtDescMetDiscOC" value="<?php echo $arreglopta[0]->desc_met_dist_oc;?>" />
	</li>
	<li>
		<label for="name">Descripción tipo OC: </label>
		<input type="text" name="txtDescTipOC" class="txtDescTipOC" value="<?php echo $arreglopta[0]->desc_tipo_oc;?>"/>
	</li>
	<li>
		<label for="name">Fecha Cancelación: </label>
		<input type="text" name="txtFechCanc" class="txtFechCanc" value="<?php echo $arreglopta[0]->fech_canc;?>" />
	</li>
	<li>
		<label for="name">Proveedor: </label>
		<input type="text" name="txtProveedor" class="txtProveedor" value="<?php echo $arreglopta[0]->proveedor;?>" />
	</li>
		<li>
		<label for="name">Tipo Manejo:</label>
		<input type="text" name="txtTipoManej" class="txtTipoManej" value="<?php echo $arreglopta[0]->tipo_manejo;?>" />
	</li>
	<li>
        <button name="btnUpdate" class="btnUpdate" type="submit">Actualizar Puerta Express</button>
    </li>

</ul>
</div>

<div style="width: 50%; float: right;">
<ul>

	<li>
		<label for="name">Departamento:</label>
		<input type="text" name="txtDepart" class="txtDepart"  value="<?php echo $arreglopta[0]->dpto;?>"/>
	</li>
	<li>
		<label for="name">Tipo Recepción: </label>
		<input type="text" name="txtTipoRec" class="txtTipoRec"  value="<?php echo $arreglopta[0]->tip_rec;?>"/>
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
		<input type="text" name="txtCC" class="txtCC"  value="<?php echo $arreglopta[0]->cc;?>"/>
	</li>
	<li>
		<label for="name">Bultos:</label>
		<input type="text" name="txtBultos" class="txtBultos" value="<?php echo $arreglopta[0]->bultos;?>" style="border:1px solid #FF0000;" />
	</li>
	<li>
		<label for="name">Horario:</label>
		<input type="time" name="txtHorario" class="txtHorario" value="<?php echo $arreglopta[0]->horario;?>" style="border:1px solid #FF0000;"  />
	</li>
	<li>
	<label for="name">Despacho Express:</label>
<input type="text" name="txtDespExpress" class="txtDespExpress" value="<?php echo $arreglopta[0]->despacho_express;?>" style="border:1px solid #FF0000;" />
	</li>
	<li>
		<label for="name">Lugar De Recibo:</label>
	<input type="text" name="txtLugarRec" class="txtLugarRec" value="<?php echo $arreglopta[0]->lugar_recibo;?>" style="border:1px solid #FF0000;" />
	</li>
	<li>
		<label for="name">Observación:</label>
		<input type="text" name="txtObserv" class="txtObserv" value="<?php echo $arreglopta[0]->observacion;?>" style="border:1px solid #FF0000;" />
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
