
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Agenda Redex</title>
<script type="text/javascript" src="scripts/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="scripts/jquery-latest.js"></script>
<script type="text/javascript" src="scripts/jquery.tablesorter.min.js"></script>
<link href="css/estilo.css" rel="stylesheet" type="text/css" />
<script>
        $(function(){
          $("#myTable").tablesorter({widgets: ['zebra']});
        });
</script>
<style>
.nav th
{
    background-color: #e20821;
    color: white;
}
th.header {
    background-image: url(img/bg.gif);
    cursor: pointer;
    font-weight: bold;
    background-repeat: no-repeat;
    background-position: center left;
    padding-left: 20px;
    border-right: 1px solid #dad9c7;
    margin-left: -1px;
}
th.headerSortUp {
    background-image: url(img/asc.gif);
    background-color: #7a5490;
}
th.headerSortDown {
    background-image: url(img/desc.gif);
    background-color: #7a5490;
}
.nav td
{
    color: black;
    font-size: 13px;
    border: 1px solid #c2daea;
}
table {
    height: auto;
    border: 1px solid #c2daea;
    overflow: scroll;
    width: 100%;
    margin: 2% auto 0;
    border-radius:5px;
    box-shadow: 0 0 4px rgba(0, 0, 0, 0.2);
}
</style>
</head>

<body>

<div id="contenedor">

<div id="header">


<img src="{{url('/img/logoripley.png')}}" style="float:left; margin-left:40px; margin-top:20px;"  height="50" width="120"/>
<img src="{{url('/img/logoripley2.png')}}" style="float:left; margin-left:40px; margin-top:20px;"  height="50" width="120"/>
<h2>Agenda Proveedores Nacionales</h2>
</div>
<div id="menu">
<a href="index.php" ><div id="btn-menu">Agenda proveedor</div></a>
<a href="Documentos.php" ><div id="btn-menu">Documentos</div></a>
<a href="Login.php"><div id="btn-menu">Login</div></a>
</div>

<div id="main">
<?php
//equire_once("scripts/conexion.php");
date_default_timezone_set('UTC');
 $hoy = date("Y-m-d");
 $dia1 = date("Y-m-d",strtotime( '+1 day' , strtotime($hoy)));

?>
<?php


$cons=DB::select("SELECT * FROM documentos ORDER BY fecha desc");
 ?>



<div id="box-agenda">
    <div class="nav">
        <div id="box-tit">Archivos descargables</div>
        <table id="myTable" class="tablesorter">
        <thead>
        	<tr>
                <th>Nombre del Archivo</th>
                <th>Fecha Subida</th>
                <th>Descargar</th>
            </tr>
        </thead>
        <tbody>
                <?php
                  foreach($cons as $result){ ?>
                        <tr>
                            <td><?php echo $result->nombre; ?></td>
                            <td>
                            <?php echo $result->fecha; ?>
                            </td>
                            <td align="center">
                            	<a href="Download.php?nombre=<?php echo $result->nombre; ?>">
                            	<img src="{{url('/img/download.png')}}" /></a>
                            </td>
                        </tr>

                        <?php
                            }
                		?>
               </tbody>
            </table>
    </div>
</div>


</div>
</body>
</html>
