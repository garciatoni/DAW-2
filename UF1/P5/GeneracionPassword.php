<?php
$errorpass="";
$errorpassdos="";
include ("LibreriaLogin.php");
$token = $_GET["token"];
//echo $token;

function generarCodigo($longitud) {
    $key = '';
    $pattern = '1234567890abcdefghijklmnopqrstuvwxyz';
    $max = strlen($pattern)-1;
    for($i=0;$i < $longitud;$i++) $key .= $pattern{mt_rand(0,$max)};
    return $key;
}
$nuevaPassword=generarCodigo(15);
//echo $nuevaPassword;
$correo=FuncionCorreo($token);
ModificarPasswordBD($token, sha1(md5($nuevaPassword)));
setcookie("recuerdarcorreo", $correo,  time() + 365 * 24 * 60 *60);
setcookie("recordarcontraseña", sha1(md5($nuevaPassword)), time() + 365 *24 *60 * 60);


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>Recuperacion De Contraseña</title>
</head>
<body>
    <h1 class=" col-sm-5 mt-5">Recuperacion de contraseña</h1>
    <p>Contraseña cambiada. Haz click <a href="Publica.php">aqui</a> para entrar en tu cuenta, Recuerde que la contraseña generada puede ser cambiada por usted.</p>
</body>
</html>




