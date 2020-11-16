<?php
$erroremail="";
include ("LibreriaLogin.php");
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


function generarCodigo($longitud) {
    $key = '';
    $pattern = '1234567890abcdefghijklmnopqrstuvwxyz';
    $max = strlen($pattern)-1;
    for($i=0;$i < $longitud;$i++) $key .= $pattern{mt_rand(0,$max)};
    return $key;
}


if($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_REQUEST["E-mail"])){
        $comprovacionemail= test_input($_REQUEST["E-mail"]);
        if (isset($_REQUEST["E-mail"]) && empty($_REQUEST["E-mail"])){
            $erroremail= "Introdue un correo.";

        }elseif (!filter_var($comprovacionemail, FILTER_VALIDATE_EMAIL)){
            $erroremail="Formato de email erroneo.";

        }else{
            $conn = new mysqli('localhost', 'agarcia', 'agarcia', 'agarcia_P5');
            if ($conn->connect_error) {
                die("CONEXION CON LA BASE DE DATOS FALLIDA: " . $conn->connect_error);
            }
            $sql = "SELECT correo FROM usuarios where correo='".$_REQUEST["E-mail"]."'";
            if (!$resultado = $conn->query($sql)){
                    die("Error ejuctuando la consulta:".$conn->error);
                }
            if ($resultado->num_rows > 0){
                $token = generarCodigo(50);
                $sql = "UPDATE `usuarios` SET `token` = '$token' WHERE `usuarios`.`correo` ='".$_REQUEST["E-mail"]."'";
                if (!$resultado = $conn->query($sql)){
                    die("Error ejuctuando la consulta:".$conn->error);
                }
                include ("Email.php"); 


            }else{
                echo "Ya te llegara.";
            }
        }
    }


}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Recuperar Contraseña</title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    </head>
    <body>
        <form action="RecuperarContraseña.php" method="post" id="myform" name="myform">       
            <div class="form-inline mt-5">
                <label for="Email" class="offset-sm-3 col-sm-2 text-alight-right">Correo</label>
                <input type="text" name="E-mail" class="form-control col-sm-2" placeholder="E-mail">
                <button class="bg-info text-white" type="submit">Enviar</button><span class="alert m-0 p-0"><?php echo $erroremail;?></span>
            </div>
            <a class = "offset-5"href="Privada.php">Atras</a>
        <form>
    </body>
</html>









