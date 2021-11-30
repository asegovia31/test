<?php
session_start();
if (isset($_SESSION['nombre_user'])) {
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


 <a href="{{url('puerta_express_seg')}}"><div id="box-msg" style="background-color:#2a80b9;" onclick="openNav()">
<img src="{{url('/img/Formulario.png')}}" height="65" width="65" style="float:left;"/> Ingresar/Consultar Puerta Express </div></a>
<?php $fech_cons=date('Y-m-d');
      $calendar=date('Y-m-d');
      $calendar2=date('Y-m-d');    ?>
<div id="box-msg2" style="background-color:#cf152d; font-size:10px;">
<form action="Puerta Express.php" method="get">
<table style="border:none;">
<tr style="border:none;">
<td style="border:none;">
<input size="20" id="f_date" readonly="readonly"  class="input-text" name="calendar" value="<?php echo $fech_cons;?>" placeholder="Desde" required  />
<button style="width:48px; height:38px; margin-top:0px; margin-left:5px; background-image:url({{url('img/calendar.png')}}); float:left;" id="f_btn"></button>
<input type="submit" value="Consultar" style="width:120px; height:50px; margin-top:0px; margin-left:5px; float:left;"/>

<br />
<script type="text/javascript">//<![CDATA[
      Calendar.setup({
        inputField : "f_date",
        trigger    : "f_btn",
        onSelect   : function() { this.hide() },
        showTime   : 12,
        dateFormat : "%Y-%m-%d"
      });
    //]]></script>

</td>

</tr>

<tr>
<td style="border:none;">
<input size="20" id="f_date2" readonly="readonly" style="margin-top:-12px;"  class="input-text" name="calendar2" value="<?php echo $fech_cons;?>" placeholder="Hasta" required  />
<button style="width:48px; height:38px; margin-top:-12px; margin-left:5px; background-image:url({{url('img/calendar.png')}}); float:left;" id="f_btn2"></button>
<br />
<script type="text/javascript">//<![CDATA[
      Calendar.setup({
        inputField : "f_date2",
        trigger    : "f_btn2",
        onSelect   : function() { this.hide() },
        showTime   : 12,
        dateFormat : "%Y-%m-%d"
      });
    //]]></script>
</td>
</tr>
</table>
</form>

</div>

<a href="DescargarPtaExp.php?id=<?php echo $calendar;?>&id2=<?php echo $calendar2;?>">
<div id="box-msg" style="background-color:#1d6f44;" onclick="openNav()">
<img src="{{url('img/excel2.png')}}" height="65" width="65" style="float:left;"/> Descargar Excel </div></a>

<div id="main">


<?php
$consultadoc = DB::select("SELECT * FROM puertaexpress WHERE fech_cta>='$calendar' AND fech_cta<='$calendar2'");//$resultadodoc = mysql_query($consultadoc);
 ?>
<div id="box-agenda">
    <div class="nav2">
        <div id="box-tit" style="font-size:14px;">Puerta Express de <?PHP echo $calendar;?></div>
            <table border="0" style="width:100%; font-size:12px; ">
            <thead>
          <tr>
          <th>Cita</th>
					<th>Proveedor</th>
          <th>Unids Agendadas</th>
					<th>Tipo de Manejo</th>
					<th>Fecha Cita</th>
          <th>Editar</th>
					<th>Eliminar</th>
          </tr>
            </thead>
            <tbody>
                <?php
                  //while ($result=(mysql_fetch_array($resultadodoc))) {
                    foreach($consultadoc as $result){
                    ?>
                        <tr>
                            <td class="nombre"><?php echo $result->nro_cta; ?></td>
                            <td><?php echo $result->proveedor; ?></td>
							<td align="center"><?php echo number_format($result->cant_unid_agen, 0, ",", "."); ?></td>
							<td align="center"><?php echo $result->tipo_manejo; ?></td>
							<td align="center"><?php echo $result->fech_cta; ?></td>
<td align="center"><a href="update.php?id=<?php echo $result->nro_cta;?> " title="EDITAR REGISTRO"><img src="img/editar.png" height="20" width="20"/></a></td>
<td align="center"><a href="Delete_exp.php?id=<?php echo $result->nro_cta;?> " title="ELIMINAR REGISTRO"><img src="img/delete.png"/></a></td>
                            </tr>
                        <?php
                            }
                ?>
                </tbody>
            </table>
    </div>
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
