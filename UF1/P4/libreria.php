<?php
//En esta libreria hago todas las comprobaciones pertinentes para iniciar la sesion.
$email = 'toni@gmail.com';
$password = 'toni123';
$password_cifrado = sha1(md5("toni123"));
//A falta de una base de datos, guardo aqui los datos correctos de ingreso.

//Si existen las cookies de inicio de sesion, estas se compararan con los datos correctos, si son iguales entrara en la sesion.
//De lo contrario dara error de atutenticacion, borrara las cookies y printara un error.
if (isset($_COOKIE["recuerdarcorreo"],$_COOKIE["recordarcontraseña"])){
    if ($_COOKIE["recuerdarcorreo"] == $email && $_COOKIE["recordarcontraseña"] == $password_cifrado){
        $_SESSION["login"] = 1;
        Header("Location: Privada.php");
    } else{
        setcookie("recuerdarcorreo", null, null);
        setcookie("recordarcontraseña", null, null);
        echo "Error de autenticacion.";
    }
//Si no existen las cookies comparo las varibles de sesion con los datos correctos.
}elseif (isset($_SESSION["correo"],$_SESSION["pass"])){
    if ($_SESSION["correo"] != $email || $_SESSION["pass"] != $password){
        setcookie("recuerdarcorreo", null, null);
        setcookie("recordarcontraseña", null, null);
        echo "Error de autenticacion.";
    } else{   
        $_SESSION["login"] = 1;
        Header("Location: Privada.php");
    }
}else {
    Header("Location: Publica.php");


}


?>