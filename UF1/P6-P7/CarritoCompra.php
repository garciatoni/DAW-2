<?php
session_start();

if (isset($_GET["idproducto"])){

    //$_SESSION["id_producto"]=$_GET["idproducto"];
    $_SESSION["carrito"][]=$_GET["idproducto"];
}

//$longitud = count(($_SESSION["carrito"]));
//echo $longitud;

//print_r($_SESSION["carrito"]);

Header("Location: Privada.php");


?>