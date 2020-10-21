<?php


if (!(isset($_SESSION["login"]) && $_SESSION["login"] == 1)){
    Header("Location: Publica.php");
}

?>