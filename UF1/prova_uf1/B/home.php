<?php
session_start();
include ("Llibreria.php");
ControlDeLogin();




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
          <a href="Privada.php" class="navbar-brand m-0 p-8 text-white disabled" ><?php echo " Usuario: ".$_SESSION["login"];  ?></a>
          <div class="justify-content-start d-flex flex-row">
            <ul class="navbar-nav ">
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Gestion de cuenta</a>
                <div class="dropdown-menu ">
                  <a class="dropdown-item " href="ModificacionDatos.php">Modificar datos</a>
                </div>
              </li>
            </ul>
            <div class="align-self-center">
              <a clas="mt-5" href="logout.php"><button class="btn-info">Desconectar</button></a>                  
            </div>
          </div>
        </div>
    </nav>
    </form>
</body>
<footer>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</footer>
    
</html>

