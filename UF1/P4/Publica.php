<?php
session_start();
$errorpass="";
$erroremail="";
//Funcion para evitar errores con espacios, scripts y comillas.
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if (isset($_COOKIE["recuerdarcorreo"],$_COOKIE["recordarcontraseña"])){
    include ("libreria.php");

}elseif($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_REQUEST["cookiepolitica"])){
        if ($_REQUEST["cookiepolitica"] == 2){
            Header("Location: https://es.wikipedia.org/wiki/Citrullus_lanatus");
        } else {
            setcookie("politica", "aceptada", time() + 365 * 24 * 60 *60);
            Header("Location: Publica.php");
        }
    }
    if (isset($_REQUEST["recordar"])){
        setcookie("recuerdarcorreo", $_REQUEST["E-mail"],  time() + 365 * 24 * 60 *60);
        setcookie("recordarcontraseña", sha1(md5($_REQUEST["contraseña"])), time() + 365 *24 *60 * 60);

    }
    if (isset($_REQUEST["E-mail"],$_REQUEST["contraseña"])){
        if (empty($_REQUEST["contraseña"])){
            $errorpass = "Introdue una contraseña.";
        }elseif (!preg_match("/^[a-zA-Z-0-9-' ]*$/",$_REQUEST["contraseña"])){
            $errorpass = "La contraseña solo puede contener letras y numeros.";
        } elseif (empty($_REQUEST["E-mail"])){
            $erroremail= "Introdue un correo.";
        }else{
            $_SESSION["correo"] = $_REQUEST["E-mail"];
            $_SESSION["pass"] = $_REQUEST["contraseña"];
            include ("libreria.php");
        }
    }

}
?>
    <?php
    if (isset($_COOKIE["politica"])){
    ?>
    <html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </head>
    <body>
        <h1 align="center">FORMULARIO</h1>
        <form action="Publica.php" method="post" id="myform" name="myform" align="center">
            <label>E-mail: </label><input type="email" name="E-mail"><span class="error"><?php echo $erroremail;?></span><br><br>
            <label>contraseña: </label><input type="password" name="contraseña"><span class="error"><?php echo $errorpass;?></span><br><br>
            <label>Recordar contraseña: </label><input type="checkbox" name="recordar"/><br>
            <button type="submit">Validar</button><br>
        </form>
    </body>
    </html>
    <?php
    } else {
    ?>

    <html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </head>
    <body>
    <form action="Publica.php" method="post" id="myform" name="myform" align="center">
        <p>Quiere aceptar la politica de cookies?</p>
        <label>SI:</label><input type="radio" name="cookiepolitica" value=1 checked="checked"/>
        <label>NO:</label><input type="radio" name="cookiepolitica" value=2/>
        <button type="submit">Enviar</button><br>
    </form>
    </body>
    </html>

    <?php
    }
    ?>
