<?php
session_start();
$errorpass="";
$erroremail="";
include ("Llibreria.php");
//Funcion para evitar errores con espacios, scripts y comillas.
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $comprovacionemail= test_input($_REQUEST["E-mail"]);
    //Validacion
    if (isset($_REQUEST["E-mail"],$_REQUEST["contraseña"])){
        if (empty($_REQUEST["contraseña"])){
            $errorpass = "Introdue una contraseña.";
        }elseif (!preg_match("/^[a-zA-Z-0-9-' ]*$/",$_REQUEST["contraseña"])){
            $errorpass = "La contraseña solo puede contener letras y numeros.";
        } elseif (empty($_REQUEST["E-mail"])){
            $erroremail= "Introdue un correo.";
        }elseif (!filter_var($comprovacionemail, FILTER_VALIDATE_EMAIL)){//Validacion del email.
            $erroremail="Formato de email erroneo.";
        }else{
            $_SESSION["correo"] = $_REQUEST["E-mail"];
            $_SESSION["pass"] = $_REQUEST["contraseña"];
            Logging();
        }
    }

}
?>
    <html>
    <head>
        <title>Logging</title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    </head>
    <body>
    <div class="container d-flex justify-content-center">
        <form action="index.php" method="post" id="myform" name="myform" class="p-1">
            <h1 class="mt-4 text-center">Identifiquese</h1>
            <div class="form-group mt-3">
                <label for="Email" class="text-alight-right">Correo</label>
                <input type="Email" name="E-mail" class="form-control" placeholder="Correo"><span class="error"><?php echo $erroremail;?></span>
            </div>
            <div class="form-group mt-3">
                <label for="Password" class="text-lg-right">Contraseña</label>
                <input type="password" name="contraseña" class="form-control" placeholder="Contraseña"><span class="error"><?php echo $errorpass;?></span>
            </div>
            <div class="form-group">
                <a href="RecuperarContraseña.php" class="">He olvidado la contraseña</a>
            </div>
            <button type="submit" class="btn-info">Entrar</button>
        </form>
    </div>
    </body>
    </html>
    