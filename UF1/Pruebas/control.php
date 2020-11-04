<?php

//La libreria control, comprueba si la sesion ha sido iniciada, de lo contrario redirecionara al loging(publica).

if (!(isset($_SESSION["login"]))){
    Header("Location: Publica.php");
}

?>