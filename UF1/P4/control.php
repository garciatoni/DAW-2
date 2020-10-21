<?php

//La libreria control, comprueba si la sesion ha sido iniciada, de lo contrario redirecionara al loging.

if (!(isset($_SESSION["login"]) && $_SESSION["login"] == 1)){
    Header("Location: Publica.php");
}

?>