<?php
session_start();
if (isset($_SESSION['nombre_user'])) {
	# code...
  ?>
  <html xmlns="http://www.w3.org/1999/xhtml">
  <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Agenda Redex</title>
  <script type="text/javascript" src="{{ url('/js/jquery-3.1.1.min.js') }}"></script>
  <script type="text/javascript" src="{{ url('/js/Validaciones.js') }}"></script>
  <script src="{{url('/js/sweetalert.min.js')}}"></script>
  <link rel="stylesheet" type="text/css" href="{{ asset('css/sweetalert.css') }}">
  <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />
  </head>
  <?
//include("scripts/conexion.php");
date_default_timezone_set('UTC');
 $hoy = date("Y-m-d");
 $dia1 = date("Y-m-d",strtotime( '+1 day' , strtotime($hoy)));


if (isset($_POST['btnCrear'])) {
  # code...
 $correo = $_POST["txtCorreo"];
 $nombreuser = $_POST["txtNomUser"];
 $contra = $_POST["txtPass"];
 $usuario="";
 $nuevo_usuario=DB::select("SELECT nombre_user from usuarios where nombre_user='$nombreuser'");

 if(!empty($nuevo_usuario[0]->nombre_user))
 {
          echo '<script>
    setTimeout(function() {
        swal({
            title: "",
            text: "Este usuario ya existe!",
            type: "error"
        }, function() {
            window.location ="Parametros_cod"
        });
    }, 0);
</script>';
 }
 // ------------ Si no esta registrado el usuario continua el script
 else
 {
 // ==============================================
 // Comprobamos si el correo esta registrado

 $nuevo_email=DB::select("SELECT correo from usuarios where correo='$correo'");


 if(!empty($nuevo_email[0]->correo))
 {
   echo '<script>
    setTimeout(function() {
        swal({
            title: "",
            text: "Este correo ya esta registrado!",
            type: "error"
        }, function() {
            window.location = "Parametros_cod";
        });
    }, 0);
</script>';
}else{

 if(empty($nombreuser) || empty($correo))
 {
   echo '<script>
    setTimeout(function() {
        swal({
            title: "",
            text: "Falto el ingreso de correo y nombre!",
            type: "error"
        }, function() {
            window.location = "Parametros_cod";
        });
    }, 0);
</script>';
 }
 // ------------ Si no esta registrado el correo continua el script
 // ------------ Si no esta registrado el correo continua el script
 else
 {
 $result = DB::insert("insert into usuarios (correo,nombre_user,password) values ('$correo','$nombreuser','$contra')");

 // Confirmamos que el registro ha sido insertado con exito

      echo '<script>
          setTimeout(function() {
              swal({
                  title: "",
                  text: "Usuario Creado Correctamente!",
                  type: "success"
              }, function() {
                  window.location = "cuentas_users";
              });
          }, 0);
      </script>';
 }
 // ==============================================
 }
 }
}

if(isset($estado)){


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Agenda Redex</title>
<script type="text/javascript" src="{{ url('/js/jquery-3.1.1.min.js') }}"></script>
<script type="text/javascript" src="{{ url('/js/Validaciones.js') }}"></script>
<script src="{{url('/js/sweetalert.min.js')}}"></script>
<link rel="stylesheet" type="text/css" href="{{ asset('css/sweetalert.css') }}">
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

  <div id="box-agenda">

     <!-- FORMULARIO PARA ENVIAR LOS ACHIVOS AL SERVIDOR -->


    <form name="frmUpload" class="frmUpload" action="{{url('upload')}}" method="post" enctype="multipart/form-data">
      <ul>
        <div id="box-tit">Subir archivos</div>
      	<li>
          <label for="">Archivo a subir: </label>
          <input type="file" name="fileToUpload" id="fileToUpload">
          <input type="submit" value="Subir Archivo" name="submit">
      	</li>
      </ul>
    </form>


    <!-- FORMULARIO PARA ENVIAR LOS DATOS DEL USUARIO A REGISTRAR -->

    <form name="frmCrea" class="frmCrea" action="{{url('Parametros_cod')}}" method="post">
      @csrf
      <div id="box-tit">Creación de usuarios con privilegios</div>
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


    <!-- FORMULARIO PARA ENVIAR LOS DATOS DEL TEXT AREA -->

    <form name="frmCrea" class="frmCrea2" action="Mensaje2.php" method="post">
      <div id="box-tit">Mensaje visible para todos</div>
      <ul>
        <li>
      		<label for="name">Mensaje: </label>
      		<textarea autofocus name="men" class="" rows="8" cols="37" style="resize: none;"></textarea>
      	</li>
          <input type="hidden" name="id" class="id" value="1" />
        <li>
          <button type="submit" name="btnMensaje" class="btnMensaje">Mensaje</button>
        </li>

    </form>

    <?php
        if (isset($_POST['btnCargar'])) {
          # code...
            $arreglocapacida =DB::select("SELECT * FROM capacidad WHERE tipo_manejo ='$comboCapacidad'");

            foreach($arreglocapacida as $arreglocapacidad){

            $semana_ = $arreglocapacidad->semana;
            $finde_ =  $arreglocapacidad->finde;
            $tipo_manejo_ =  $arreglocapacidad->tipo_manejo;

          }
            //$resultado = mysql_query($consutacapacidad);
            //$arreglocapacidad = mysql_fetch_array($resultado);
          }else{
          $semana_ = "";
          $finde_ =  "";
          $tipo_manejo_ = "";
          }
    ?>


    <form name="frmCargar" class="frmCargar" action="{{url('Parametros')}}" method="post">
      <div id="box-tit">Seleccionar tipo de manejo a modificar</div>
      <ul>
        <li>
            <label for="name">Tipo Manejo:</label>
            <select id="slcCapacidad" name="comboCapacidad" class="comboCapacidad">
              		<?php
                      $query=DB::select("SELECT * FROM capacidad ORDER BY tipo_manejo DESC");
                      //$resultado = mysql_query($query);
                      //while($renglon = mysql_fetch_array($resultado))
                      foreach($query as $renglon)
                      {
                    	$valor=$renglon->tipo_manejo;
                    	    echo "<option id='' value=".$valor.">".$valor."</option>\n";
                      }
                  ?>
            </select>
            <button type="submit" name="btnCargar" class="btnCargar">Cargar capacidad</button>
       </li>
       </ul>


       <?php

            if (isset($_POST['btnGuardar'])) {
    //          $link = mysqli_connect("localhost","root","1234","agenda");
              $cambiar = DB::update("UPDATE capacidad SET semana=$txtSem , finde=$txtSab WHERE tipo_manejo=$txtTipo");
                if ($cambiar) {
                  echo '<script type="text/javascript">';
                  echo 'setTimeout(function () { swal("Cambio de capacidades exitoso","","success");';
                  echo '}, 0);</script>';
                }
                else
                {
                  echo '<script type="text/javascript">';
                  echo 'setTimeout(function () { swal("No se pudo modificar","","error");';
                  echo '}, 0);</script>';
                }
              }
        ?>

       <div id="box-tit">Capacidades a cambiar</div>
       <ul>
       <li>
         <label for="">Semana</label>
         <input type="text" name="txtSem" class="txtSem" value="<?php echo $semana_;?>">
       </li>
       <li>
         <label for="">Sábado</label>
         <input type="text" name="txtSab" class="txtSab" value="<?php echo $finde_;?>">
       </li>
       <li>
         <label for="">Tipo de manejo a modificar</label>
         <input type="text" name="txtTipo" class="txtTipo" readonly="readonly" value="<?php echo $tipo_manejo_; ?> "/>
       </li>
       <li>
         <button type="submit" name="btnGuardar" class="btnGuardar">Guarda Capacidades</button>
       </li>
       </ul>
    </form>
    </div>

</div>
<?php

} else {

	echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Acceso Denegado')
    window.location.href='{{url(indexadmin)}}';
    </SCRIPT>");

}


?>

</div>
</body>
</html>
