<?php
session_start();
include ("LibreriaLogin.php");
ControlDeLogin();


$buscar = false;
$listauser = "no";
$tusproductos = "no";
if (isset($_GET["tusproductos"])){
  $tusproductos = $_GET["tusproductos"];
}
if (isset($_GET["listauser"])){
  $listauser = $_GET["listauser"];
  $tusproductos = "no";
}

$errorbuscador = "";
$ComprovacionAdmin = FuncionComprovacionAdmin($_SESSION["login"]);



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
    <script src="https://kit.fontawesome.com/982045aa7f.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="PaginaPrincipal.css"></link:rel>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>PRIVADA</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-dark ">
        <div class="collapse navbar-collapse container-fluid d-flex" id="navbarSupportedContent">
          <a href="Privada.php" class="navbar-brand m-0 p-8 text-white disabled" ><?php if ($ComprovacionAdmin == 1){ echo " Admin: ";}elseif ($ComprovacionAdmin == 2){ echo " Usuario: ";}echo $_SESSION["login"];  ?></a>
          <div class="justify-content-start d-flex flex-row">
            <ul class="navbar-nav">
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Gestionar tus productos</a>
                  <div class="dropdown-menu">
                    <a class="dropdown-item " href="IntroducirProducto.php">Introducir un nuevo producto</a>
                    <a class="dropdown-item " href="Privada.php?tusproductos=<?php echo "si"; ?>">Ver todos tus productos</a>
                  </div>
              </li>
            </ul>
            <ul class="navbar-nav ">
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Gestion de cuenta</a>
                <div class="dropdown-menu ">
                  <a class="dropdown-item " href="ModificacionDatos.php">Modificar datos</a>
                          <?php
                          if ($ComprovacionAdmin == 1){
                            echo "<a class=\"dropdown-item\" href=\"Privada.php?listauser=si\">Gestionar usuarios de la pagina</a>";
                          }
                          ?>
                </div>
              </li>
            </ul>
          </div>
          <div class="justify-content-end d-flex">
            <div class="align-self-center mr-3">
              <a href="carrito.php" data-toggle="tooltip" title="Productos en tu carrito" class="text-white text-decoration-none">Carrito<i class="fas fa-shopping-cart text-white mr-2"></i><?php if (isset($_SESSION["carrito"])){$longitud = count(($_SESSION["carrito"])); echo $longitud;}else{ echo 0;}?></a>
            </div>
            <div class="align-self-center">
              <a clas="mt-5" href="LOGOUT.php"><button class="btn-info">Desconectar</button></a>                  
            </div>
          </div>
        </div>
    </nav>
    <?php
    if ($tusproductos == "no" && $listauser == "no"){
    ?>
    <div class="container mt-3 mb-4">
    <form action="Privada.php" enctype="multipart/form-data" method="post" id="myform" name="myform">
      <div class="input-group">
        <input type="text" name="buscar" class=" form-control" aria-label="Text input with segmented dropdown button">
        <div class="input-group-append">
          <button type="submit" class="btn btn-outline-secondary">Buscar</button>
          <button type="button" class="btn btn-outline-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <span class="sr-only">Toggle Dropdown</span>
          </button>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="Privada.php?categoria=1">Arte</a>
            <a class="dropdown-item" href="Privada.php?categoria=2">Tecnologia</a>
            <a class="dropdown-item" href="Privada.php?categoria=3">Ocio</a>
            <a class="dropdown-item" href="Privada.php?categoria=6">Cultura</a>
            <a class="dropdown-item" href="Privada.php?categoria=7">Deportes</a>
          </div>
        </div>
      </div>
    </form>

    <?php
    }
    if ($ComprovacionAdmin == 1 && $listauser == "si"){
        FuncionMostrarTodosLosUsuarios();
    }
    ?>
    <div class="mt-3 container">
        <div class="row">
        <?php

        if(isset($_GET["categoria"])){
          $categoria = $_GET["categoria"];
          BuscarProductoPorCategoria($categoria);
        }else if ($tusproductos == "si"){
          FuncionModificarYEliminarProductos($_SESSION["login"]);
        }else if ($buscar == false && $listauser == "no"){
          FuncionMostrarTodosLosProductos();        
        }else if (isset($_REQUEST["buscar"])){
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

