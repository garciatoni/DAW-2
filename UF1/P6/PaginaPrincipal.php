<?php
include ("LibreriaLogin.php");
$buscar = false;
$errorbuscador = "";

if($_SERVER['REQUEST_METHOD'] == 'POST') {

  if (isset($_REQUEST["buscar"]) && empty($_REQUEST["buscar"])){
    $errorbuscador = "Nada introducido";
  }elseif (!preg_match("/^[a-zA-Z-0-9-' ]*$/",$_REQUEST["buscar"])){
    $errorbuscador = "Introduce solo letras o numeros.";
  }else{
    $buscar = true;

  }


}
?>


<!doctype html>
<html lang="en">
  <head>
  <meta charset="utf-8">
    <link rel="stylesheet" href="PaginaPrincipal.css"></link:rel>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>principal</title>

  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-dark mb-3 ">
        <div class="collapse navbar-collapse container-fluid d-flex" id="navbarSupportedContent">
          <a href="PaginaPrincipal.php" class="col-sm-2 navbar-brand m-0 p-8 text-white" >Mercadillo.com</a>
          <div class="justify-content-end">
            <a clas="" href="Publica.php"><button class="btn-info justify-content-end">Conectarse</button></a>
            <a clas="" href="Registro.php"><button class="btn-info justify-content-end">Registrarse</button></a>
          </div>
        </div>
    </nav>
    <div class="container mb-4">
    <form action="PaginaPrincipal.php" enctype="multipart/form-data" method="post" id="myform" name="myform">
      <div class="input-group">
        <input type="text" name="buscar" class="form-control" aria-label="Text input with segmented dropdown button">
        <div class="input-group-append">

        <button type="submit" class="btn btn-outline-secondary">Buscar</button>
          <button type="button" class="btn btn-outline-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <span class="sr-only">Toggle Dropdown</span>
          </button>

          <div class="dropdown-menu">
            <a class="dropdown-item" href="PaginaPrincipal.php?categoria=1">Arte</a>
            <a class="dropdown-item" href="PaginaPrincipal.php?categoria=2">Tecnologia</a>
            <a class="dropdown-item" href="PaginaPrincipal.php?categoria=3">Ocio</a>
            <a class="dropdown-item" href="PaginaPrincipal.php?categoria=6">Cultura</a>
            <a class="dropdown-item" href="PaginaPrincipal.php?categoria=7">Deportes</a>
          </div>

        </div>
      </div>
    </form>
    <div class="mt-3 container">
        <div class="row">
        <?php
        if(isset($_GET["categoria"])){
          $categoria = $_GET["categoria"];
          BuscarProductoPorCategoria($categoria);
        }else if ($buscar == false){
          FuncionMostrarTodosLosProductos();
        
        }else{
          BuscarProducto($_REQUEST["buscar"]);
        }

        ?>
        </div>
    </div>
</body>
<footer>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</footer>
    
</html>
