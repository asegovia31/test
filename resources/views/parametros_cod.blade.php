<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Agenda Redex</title>
<script type="text/javascript" src="{{ url('/js/jquery-3.1.1.min.js') }}"></script>
<script type="text/javascript" src="{{ url('/js/Validaciones.js') }}"></script>
<script src="{{url('/js/sweetalert.min.js')}}"></script>
<link rel="stylesheet" type="text/css" href="{{ asset('css/sweetalert.css') }}">
</head>
<?php
session_start();
if (isset($_SESSION['nombre_user'])) {
	# code...

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
            window.location = "cuentas_users";
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
            window.location = "cuentas_users";
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


?>


<body>

<div id="contenedor">



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
