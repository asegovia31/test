<?php
session_start();
if (isset($_SESSION['nombre_user'])) {
    # code...

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

    <form name="frmCrea" class="frmCrea" action="{{url('Parametros_cod')}}" method="post">
      @csrf
      <div id="box-tit">Creación de Usuarios</div>
      <ul>
        <li>
      		<label for="name">Correo: </label>
      		<input type="text" name="txtCorreo" class="txtCorreo" />
      	</li>
        <li>
      		<label for="name">Nombre de Usuario: </label>
      		<input type="text" name="txtNomUser" class="txtNomUser" />
      	</li>
        <li>
      		<label for="name">Contraseña: </label>
      		<input type="password" name="txtPass" class="txtPass" />
      	</li>
        <li>
          <button name="btnCrear" class="btnCrear" type="submit">Crear Usuario</button>
        </li>
      </ul>
    </form>

<?php
$resultadodoc = DB::select("SELECT * FROM usuarios");
//$resultadodoc = mysql_query($consultadoc);

//foreach($consultadoc as $resultadodoc){
 ?>
<div id="box-agenda">
    <div class="nav">
        <div id="box-tit">Usuarios</div>
            <table id="myTable" class="tablesorter">
            <thead>
                <tr>
                    <th>Nombre del Archivo</th>
                    <th>Fecha Subida</th>
                    <th>Eliminar</th>
                           </tr>
            </thead>
            <tbody>
                <?php
                  //while ($result=(mysql_fetch_array($resultadodoc))) {
                  foreach($resultadodoc as $result){
                    ?>
                        <tr>
                            <td class="nombre"><?php echo $result->nombre_user; ?></td>
                            <input type="hidden" name="id" value="<?php //echo $result->id; ?>" />
                            <td><?php echo $result->correo; ?></td>
                            <td align="center">
                            <a href="Delete_user.php?id=<?php echo $result->correo;?> ">
                            <img src="{{url('/img/delete.png')}}"/></a></td>
                          </tr>
                        <?php
                      }
  //                  }
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
