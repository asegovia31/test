<?php

session_start();

date_default_timezone_set('UTC');
 $hoy = date("Y-m-d");
 $dia1 = date("Y-m-d",strtotime( '+1 day' , strtotime($hoy)));

function verificar_login($corr,$password,&$result) {
  //  $resultado=mysql_query("select * from usuarios where correo='$corr' and password='$password'");

    $resultado=DB::select("select * from usuarios where correo='$corr' and password='$password'");

    $count = 0;

    //while($row = mysql_fetch_object($resultado))
    foreach($resultado as $row)
    {
        $count++;
        $result = $row;
    }

    if($count == 1)
    {
        return 1;
    }
    else
    {
        return 0;
    }
}

if(!isset($_SESSION['nombre_user']))
{

    if(isset($_POST['btnLogear']))
    {


        if(verificar_login($_POST['correo'],$_POST['password'],$result) == 1)
        {


            $_SESSION['nombre_user'] = $result->nombre_user;
            return redirect()->to('indexadmin')->send();
          //  print_r($result->nombre_user);exit;
        //    header("location:indexAdmin.php");
//return redirect()->to('indexadmin')->send();
//return Redirect::to('hello');
        }
        else
        {

             echo '<script>
                        setTimeout(function() {
                            swal({
                                title: "",
                                text: "Usuario o contraseña invalidos!",
                                type: "error"
                            }, function() {
                                window.location = "Login.php";
                            });
                        }, 0);
                    </script>';
        }
    }

 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Agenda Redex</title>
<script src="{{ asset('js/sweetalert.min.js') }}"></script>
<link rel="stylesheet" type="text/css" href="{{ asset('css/sweetalert.css') }}">
<link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />

</head>

<body>

<div id="contenedor">

<div id="header">



<img src="{{url('/img/logoripley.png')}}" style="float:left; margin-left:40px; margin-top:20px;"  height="50" width="120"/>
<img src="{{url('/img/logoripley2.png')}}" style="float:left; margin-left:40px; margin-top:20px;"  height="50" width="120"/>
<h2>Agenda Proveedores Nacionales</h2>
</div>
<div id="menu">
<a href="{{url('/')}}" ><div id="btn-menu">Agenda proveedor</div></a>
<a href="{{url('/documentos')}}" ><div id="btn-menu">Documentos</div></a>
<a href="{{url('/login')}}"><div id="btn-menu">Login</div></a>
</div>

<div id="main">

<form action="{{url('/login')}}" method="post" class="frmLogin">
@csrf
<div>
<ul>
    <li>
        <label>Correo: </label>
        <input name="correo" class="user" type="text" required />
    </li>
    <li>
        <label>Password: </label>
        <input name="password" class="password" type="password" required/>
    </li>
    <li>
        <button name="btnLogear" class="btnLogear" type="submit">Ingresar</button>
    </li>
</ul>
</div>
</form>
<?php
} else {
//print_r($_SESSION);
//     header("location:indexAdmin.php");
return redirect()->to('indexadmin')->send();

}
?>
</div>


</div>
</body>
</html>
