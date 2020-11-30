<?php
session_start();
include ("Llibreria.php");

function generarCodigo($longitud) {
    $key = '';
    $pattern = '1234567890abcdefghijklmnopqrstuvwxyz';
    $max = strlen($pattern)-1;
    for($i=0;$i < $longitud;$i++) $key .= $pattern{mt_rand(0,$max)};
    return $key;
}
function generarnum($longitud) {
    $key = '';
    $pattern = '1234567890';
    $max = strlen($pattern)-1;
    for($i=0;$i < $longitud;$i++) $key .= $pattern{mt_rand(0,$max)};
    return $key;
}

if (isset($_GET["token"])){
    $_SESSION["token"] = $_GET["token"];
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_REQUEST["control"] == $_SESSION["num3"]){
        $nuevapass = generarCodigo(8);
        ModificarPasswordBD($_SESSION["token"], md5($nuevapass), $nuevapass);
        caducidad($_SESSION["token"], md5($nuevapass));
        $_SESSION["token"]=null;
    }else{
        echo "Error...Vuelva a solicitar el cambio de contraseña.";
    }
}else{
    $_SESSION["num1"] = generarnum(1);
    $_SESSION["num2"] = generarnum(1);
    $_SESSION["num3"] = $_SESSION["num1"] + $_SESSION["num2"];
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
        <title>Cambio password</title>
    </head>
    <body>
        <form action="GeneracionPassword.php" method="post" id="myform" name="myform" class="p-1">
            <p>Sume los siguientes numeros: <?php echo $_SESSION["num1"]." + ".$_SESSION["num2"]?></p>
            <input type="text" name="control" class="form-control col-2">
            <button type="submit" class="btn-info">Entrar</button>
            <a href="index.php">Login</a>
        </form>
    </body>
</html>





