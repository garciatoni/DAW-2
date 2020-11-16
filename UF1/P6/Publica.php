<?php
session_start();
$errorpass="";
$erroremail="";
include ("LibreriaLogin.php");
//Funcion para evitar errores con espacios, scripts y comillas.
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
// Si existen las cookies de recordar la sesion, iniciara sesion automaticamente. Solo entrara aqui si previamente se han creado las cookies.
if (isset($_COOKIE["recuerdarcorreo"],$_COOKIE["recordarcontraseña"])){
    Logging();

//Entrara aqui cuando el formulario envie algo.
}elseif($_SERVER['REQUEST_METHOD'] == 'POST') {
    $comprovacionemail= test_input($_REQUEST["E-mail"]);
    //Si la politica de cookies es rechazada enviara al usuario a una web externa, de lo contrario le redireciona al formulario de login y crea la cookie de politica aceptada.
    if (isset($_REQUEST["cookiepolitica"])){
        if ($_REQUEST["cookiepolitica"] == 2){
            Header("Location: https://es.wikipedia.org/wiki/Citrullus_lanatus");
        } else {
            setcookie("politica", "aceptada", time() + 365 * 24 * 60 *60);
            Header("Location: Publica.php");
        }
    }
    //Creo las cookies si el checkbox "recordar" ha sido marcado.
    if (isset($_REQUEST["recordar"])){
        setcookie("recuerdarcorreo", $_REQUEST["E-mail"],  time() + 365 * 24 * 60 *60);
        setcookie("recordarcontraseña", sha1(md5($_REQUEST["contraseña"])), time() + 365 *24 *60 * 60);

    }
    //Aqui hago la validacion de los campos: contraseña y email. Ademas envio las respuestas a la libreria para comprobar si son correctas.
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
    <?php
    if (isset($_COOKIE["politica"])){
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
    <body><!--El formulario del login, solo entrara aqui si la politica de cookies esta aceptada.-->
        <h1 class="offset-sm-1 mt-4">FORMULARIO</h1>
        <form action="Publica.php" method="post" id="myform" name="myform">
            <div class="form-inline mt-3">
                <label for="Email" class="col-sm-1 text-alight-right">Correo</label>
                <input type="Email" name="E-mail" class="form-control col-sm-3" placeholder="Correo"><span class="error"><?php echo $erroremail;?></span>
            </div>
            <div class="form-inline mt-3">
                <label for="Password" class="col-sm-1 text-lg-right">Contraseña</label>
                <input type="password" name="contraseña" class="form-control col-sm-3" placeholder="Contraseña"><span class="error"><?php echo $errorpass;?></span>
            </div>
            <div class="">
                <input type="checkbox" name="recordar" class="offset-sm-1 mt-3 mb-3">
                <label class="ml-1">Recuerdame</label>
                <a href="RecuperarContraseña.php" class="ml-5">He olvidado la contraseña</a>
            </div>
            <button type="submit" class="offset-sm-1 btn-info">Entrar</button>
            <a class="" href="PaginaPrincipal.php">Atras...</a>
        </form>
    </body>
    </html>
    <?php
    } else {
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
    <body><!--La politica de cookies, esta entrara siempre aqui mientras que la cookie "politica" no este aceptada-->
    <form action="Publica.php" method="post" id="myform" name="myform">
        <h3 class="offset-sm-4">Quiere aceptar la politica de cookies?</h3>
        <div class="offset-sm-5 col-sm-3">
            <label>SI:</label><input type="radio" name="cookiepolitica" value=1 checked="checked"/>
            <label>NO:</label><input type="radio" name="cookiepolitica" value=2/>
            <button type="submit">Enviar</button>
        </div>
    </form>
    </body>
    </html>

    <?php
    }
    ?>
