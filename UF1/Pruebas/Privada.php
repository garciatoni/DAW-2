<?php
session_start();
include ("control.php");//Comprobacion del inicio de sesion.
include ("LibreriaLogin.php");
$ComprovacionAdmin = FuncionComprovacionAdmin($_SESSION["login"]);

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>PRIVADA</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-dark ">
        <div class="collapse navbar-collapse container-fluid" id="navbarSupportedContent">
            <p class="col-2 navbar-brand m-0 p-8 text-white disabled" ><?php if ($ComprovacionAdmin == 1){ echo " Administrador: ";}elseif ($ComprovacionAdmin == 0){ echo " Usuario: ";}echo $_SESSION["login"];  ?></p>
            <ul class="navbar-nav mr-auto offset-7">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Gestion de cuenta</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item " href="ModificacionDatos.php">Modificar datos</a>
                    </div>
                </li>
            </ul>
            <a clas="offset-11" href="LOGOUT.php"><button class="btn-info">Desconectar</button></a>
        </div>
    </nav>
    <div>
    <?php
    if ($ComprovacionAdmin == 1){
        echo " <a href=\"Registro.php\"><button class=\"mt-2 ml-2 bg-dark text-white\" >Crear usuario</button></a>";
        echo " <a href=\"ModificarUsuarioAdmin.php\"><button class=\"mt-2 ml-2 bg-dark text-white\" >Modificar usuario</button></a>";
        echo " <a href=\"EliminarUsuario.php\"><button class=\"mt-2 ml-2 mb-2 bg-dark text-white\" >Eliminar usuario</button></a>";
        FuncionMostrarTodosLosUsuarios();
    }
    ?>
    </div>


        <p>"HOLA MUNDO!"</p>
        <p>Si estas logeado.</p>
</body>
<footer>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</footer>
    
</html>


