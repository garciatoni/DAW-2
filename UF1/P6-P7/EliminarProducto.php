<?php 
session_start();
//SE LLAMA ELIMINAR PORDUCTO PERO REALMENTE AQUI HAGO TODAS LAS GESTIONES QUE REQUIEREN LOS PRODUCTOS Y LOS USUARIOS
include ("LibreriaLogin.php");



if (isset($_GET["eliminaruser"])){
    $idUser = $_GET["eliminaruser"];
    BorrarUsuario($idUser);
}



if (isset($_GET["eliminar"])){
  $idProducto = $_GET["eliminar"];
  BorrarProducto($idProducto);
}


if (isset($_GET["modificar"])){
  $idProducto = $_GET["modificar"];

}

if (isset($_GET["EliminarImagen"])){
  $idImagen = $_GET["EliminarImagen"];
  BorrarImagen($idImagen, $_SESSION["id_producto"]);
}

if (isset($_GET["D_carrito"])){ 
  $idProducto = $_GET["D_carrito"];
  $carrito = $_SESSION["carrito"];
  print_r($carrito);
  if (($clave = array_search($idProducto, $carrito)) !== false) {
      array_splice($carrito, $clave, 1);
      print_r($carrito);
  }
  $_SESSION["carrito"] = $carrito;
  Header("Location:carrito.php");
}


?>