<?php
session_start();
$_SESSION=null;
session_destroy();
//Destrucion de las cookies que guardan la contraseña, mientras no se pulse la opcion logout, estas existiran y podras entrar tantas veces quieras, una vez pulsado el boton logout, estas se destreuyen.
setcookie("recuerdarcorreo", null, null);
setcookie("recordarcontraseña", null, null);
Header ("location: Publica.php");
//redirecion al login.
?>
