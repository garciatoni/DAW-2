<?php
$errorpass="";
$errorpassdos="";
$erroremail="";
$errornombre="";
$creacion = false;
include ("LibreriaLogin.php");
//Funcion para evitar errores con espacios, scripts y comillas.
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}



if($_SERVER['REQUEST_METHOD'] == 'POST') {
    //Aqui hago la validacion de los campos: nombre, email y las dos contraseñas
    //echo sha1(md5("toni"));
    if (isset($_REQUEST["E-mail"],$_REQUEST["contraseña"])){
        $comprovacionemail= test_input($_REQUEST["E-mail"]);
        if (isset($_REQUEST["nombre"]) && empty($_REQUEST["nombre"])){
            $errornombre="Introduce un nombre.";

        }elseif (!preg_match("/^[a-zA-Z-0-9-' ]*$/",$_REQUEST["nombre"])){ 
            $errornombre = "El nombre solo puede contener letras y numeros.";

        } elseif (isset($_REQUEST["E-mail"]) && empty($_REQUEST["E-mail"])){
            $erroremail= "Introdue un correo.";

        }elseif (!filter_var($comprovacionemail, FILTER_VALIDATE_EMAIL)){
            $erroremail="Formato de email erroneo.";

        }elseif (isset($_REQUEST["contraseña"]) && empty($_REQUEST["contraseña"])){
            $errorpass = "Introdue una contraseña.";

        }elseif (!preg_match("/^[a-zA-Z-0-9-' ]*$/",$_REQUEST["contraseña"])){
            $errorpass = "La contraseña solo puede contener letras y numeros.";

        }elseif (isset($_REQUEST["contraseñados"]) && empty($_REQUEST["contraseñados"])){
            $errorpassdos = "Introdue una contraseña.";

        }elseif (!preg_match("/^[a-zA-Z-0-9-' ]*$/",$_REQUEST["contraseñados"])){
            $errorpassdos = "La contraseña solo puede contener letras y numeros.";

        }elseif ($_REQUEST["contraseña"] != $_REQUEST["contraseñados"]){
            $errorpassdos="Las contraseñas deben coincidir";
            $errorpass="Las contraseñas deben coincidir";
        }else {
            InsertarUsuarioBD($_REQUEST["nombre"], $_REQUEST["E-mail"], sha1(md5($_REQUEST["contraseña"])));
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
        <title>Registro</title>
    </head>
    <body><!--El formulario del login, solo entrara aqui si la politica de cookies esta aceptada.-->
        <h1 class=" col-sm-1 offset-sm-5 mt-5">REGISTRO</h1>
        <form action="Registro.php" method="post" id="myform" name="myform">
            <div class="form-inline mt-5">
                <label for="nombre" class="offset-sm-4 col-sm-1 text-alight-right">Nombre</label>
                <input type="text" name="nombre" class="form-control col-sm-2" placeholder="Su nombre"><span class="alert m-0 p-0" ><?php echo $errornombre;?></span>
            </div>            
            <div class="form-inline mt-3">
                <label for="Email" class="offset-sm-4 col-sm-1 text-alight-right">Email</label>
                <input type="text" name="E-mail" class="form-control col-sm-2" placeholder="E-mail"><span class="alert m-0 p-0"><?php echo $erroremail;?></span>
            </div>
            <div class="form-inline mt-3">
                <label for="Password" class="offset-sm-4 col-sm-1 text-lg-right">Contraseña</label>
                <input type="password" name="contraseña" class="form-control col-sm-2" placeholder="Contraseña"><span class="alert m-0 p-0"><?php echo $errorpass;?></span>
            </div>
            <div class="form-inline mt-3">
                <label for="Password" class="offset-sm-4 col-sm-1 text-lg-right">Repita la contraseña</label>
                <input type="password" name="contraseñados" class="form-control col-sm-2" placeholder="Contraseña"><span class="alert m-0 p-0"><?php echo $errorpassdos;?></span>
            </div>
            <div>
                <button type="submit" class="offset-sm-5 btn-info mt-3">Registrarse</button>    
                <a class="ml-1" href="Publica.php">Atras...</a>            
            </div>

        </form>
    </body>
</html>

<?php
//}
?>