<?php

$email = 'toni@gmail.com';

$password = 'toni123';
$password_cifrado = sha1(md5("toni123"));


if (isset($_COOKIE["recuerdarcorreo"],$_COOKIE["recordarcontraseña"])){
    if ($_COOKIE["recuerdarcorreo"] == $email && $_COOKIE["recordarcontraseña"] == $password_cifrado){
        $_SESSION["login"] = 1;
        Header("Location: Privada.php");
    } else{
        setcookie("recuerdarcorreo", null, null);
        setcookie("recordarcontraseña", null, null);
        echo "Error de autenticacion.";
    }
}elseif ($_SESSION["correo"] != $email || $_SESSION["pass"] != $password){
    setcookie("recuerdarcorreo", null, null);
    setcookie("recordarcontraseña", null, null);
    echo "Error de autenticacion.";

} else{   
    $_SESSION["login"] = 1;
    Header("Location: Privada.php");

}


?>