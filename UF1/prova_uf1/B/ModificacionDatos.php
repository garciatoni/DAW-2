<?php
session_start();
include ("Llibreria.php");
ControlDeLogin();
$errorpass="";
$errorpassdos="";


if($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_REQUEST["contraseña"])){
        if (isset($_REQUEST["contraseña"]) && empty($_REQUEST["contraseña"])){
            $errorpass = "Introdue una contraseña.";
            echo "hola";

        }elseif (!preg_match("/^[a-zA-Z-0-9-' ]*$/",$_REQUEST["contraseña"])){
            $errorpass = "La contraseña solo puede contener letras y numeros.";

        }elseif (isset($_REQUEST["contraseñados"]) && empty($_REQUEST["contraseñados"])){
            $errorpassdos = "Introdue una contraseña.";

        }elseif (!preg_match("/^[a-zA-Z-0-9-' ]*$/",$_REQUEST["contraseñados"])){
            $errorpassdos = "La contraseña solo puede contener letras y numeros.";

        }elseif ($_REQUEST["contraseña"] != $_REQUEST["contraseñados"]){
            $errorpassdos="Las contraseñas deben coincidir";
            $errorpass="Las contraseñas deben coincidir";
        }else{
            $id_user = idUsuario($_SESSION["login"]);
            ModificarUsuarioBD(md5($_REQUEST["contraseña"]), $id_user);
        }
    }
}
?>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <title>ModificacionDatos</title>
    </head>
    <body><!--El formulario del login, solo entrara aqui si la politica de cookies esta aceptada.-->
        <h1 class=" col-sm-1 offset-sm-4 col-sm-4 mt-5">Modificacion de datos</h1>
        <form action="ModificacionDatos.php" method="post" id="myform" name="myform" class="p-2">
            <div class="form-inline mt-3">
                <label for="Password" class="offset-sm-4 col-sm-1 text-lg-right">Contraseña</label>
                <input type="password" name="contraseña" class="form-control col-sm-2" placeholder="Contraseña"><span class="alert m-0 p-0"><?php echo $errorpass;?></span>
            </div>
            <div class="form-inline mt-3">
                <label for="Password" class="offset-sm-4 col-sm-1 text-lg-right">Repita la contraseña</label>
                <input type="password" name="contraseñados" class="form-control col-sm-2" placeholder="Contraseña"><span class="alert m-0 p-0"><?php echo $errorpassdos;?></span>
            </div>
            <div class="">
                <button type="submit" class="offset-sm-5 btn-info mt-3">Cambiar</button>  
                <a href="home.php">Atras</a>               
            </div>

        </form>
    </body>
</html>
