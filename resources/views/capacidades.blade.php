<?php
session_start();
if (isset($_SESSION['nombre_user'])) {
    # code...

//require_once("scripts/conexion.php");
date_default_timezone_set('UTC');
 $hoy = date("Y-m-d");
 $dia1 = date("Y-m-d",strtotime( '+1 day' , strtotime($hoy)));

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



<div id="main">




      <?php
        if (isset($_POST['btnCargar'])) {
          # code...
            $arreglocapacidad =DB::select("SELECT * FROM capacidad WHERE tipo_manejo ='$comboCapacidad'");
            //$resultado = mysql_query($consutacapacidad);
            //$arreglocapacidad = mysql_fetch_array($resultado);
          }
    ?>


    <form name="frmCargar" class="frmCargar" action="{{url('capacidades')}}" method="post">
      <div id="box-tit">Seleccionar tipo de manejo a modificar</div>
      <ul>
        <li>
            <label for="name">Tipo Manejo:</label>
            <select id="slcCapacidad" name="comboCapacidad" class="comboCapacidad">
              		<?php
                      $renglon_r = DB::select("SELECT * FROM capacidad ORDER BY tipo_manejo DESC");
                      //$resultado = mysql_query($query);
                      //while($renglon = mysql_fetch_array($resultado))
                      foreach($renglon_r as $renglon)
                      {
                    	$valor=$renglon->tipo_manejo;
                    	    echo "<option id='' value=".$valor.">".$valor."</option>\n";
                      }
                  ?>
            </select>
            <button type="submit" name="btnCargar" class="btnCargar">Cargar capacidad</button>
       </li>
       </ul>


	   </form>


	   <form name="frmCargar" class="frmLogin" action="{{url('guarda_capacidad')}}" method="post">
       <div id="box-tit">Capacidades a cambiar</div>

       <ul>
	    <li>
         <label >Tipo de Manejo</label>
    <input type="text" name="txtSem" class="txtSem"  value="<?php //echo $arreglocapacidad[0]->tipo_manejo;?>">
       </li>
       <li>
         <label >Semana</label>
    <input type="text" name="txtSem" class="txtSem"  value="<?php //echo $arreglocapacidad[0]->semana;?>">
       </li>
       <li>
         <label>Sábado</label>
    <input type="text" name="txtSab" class="txtSab"  value="<?php //echo $arreglocapacidad[0]->finde;?>">
       </li>
       <li>
         <label>Tipo de manejo a modificar</label>
         <input type="text" name="txtTipo" class="txtTipo" readonly="readonly" value="<?php //echo $arreglocapacidad[0]->tipo_manejo; ?> "/>
       </li>
       <li>
         <button type="submit" name="btnGuardar" class="btnGuardar">Guarda Capacidades</button>
       </li>
       </ul>
    </form>




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
