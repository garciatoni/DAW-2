<?php
session_start();
$erroremail="";
include ("control.php");//Comprobacion del inicio de sesion.
include ("LibreriaLogin.php");
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
$ComprovacionAdmin = FuncionComprovacionAdmin($_SESSION["login"]);
if ($ComprovacionAdmin != 1){
    Header ("Location: Publica.php");
}
if($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_REQUEST["E-mail"])){
        $comprovacionemail= test_input($_REQUEST["E-mail"]);
        if (isset($_REQUEST["E-mail"]) && empty($_REQUEST["E-mail"])){
            $erroremail= "Introdue un correo.";

        }elseif (!filter_var($comprovacionemail, FILTER_VALIDATE_EMAIL)){
            $erroremail="Formato de email erroneo.";

        }else{
            $conn = new mysqli('localhost', 'agarcia', 'agarcia', 'agarcia_P5');
            if ($conn->connect_error) {
                die("CONEXION CON LA BASE DE DATOS FALLIDA: " . $conn->connect_error);
            }
            $sql = "SELECT id FROM usuarios where correo='".$_REQUEST["E-mail"]."'";
            if (!$resultado = $conn->query($sql)){
                    die("Error ejuctuando la consulta:".$conn->error);
                }
            if ($resultado->num_rows > 0){
                $usuarios = $resultado->fetch_assoc();
                $id = $usuarios["id"];
                $sqlid= "DELETE FROM `usuarios` WHERE `usuarios`.`id` = $id";
                if (mysqli_query($conn, $sqlid)) {
                    echo "El usuario se elimino correctamente";
                }else{
                    echo "MAL";
                }

            }else{
                echo "Ese correo no existe.";
            }
        }
    }


}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Eliminar</title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    </head>
    <body>
        <form action="EliminarUsuario.php" method="post" id="myform" name="myform">       
            <div class="form-inline mt-5">
                <label for="Email" class="offset-sm-3 col-sm-2 text-alight-right">Correo del usuario a elimiar</label>
                <input type="text" name="E-mail" class="form-control col-sm-2" placeholder="E-mail">
                <button class="bg-danger text-white" type="submit">Eliminar</button><span class="alert m-0 p-0"><?php echo $erroremail;?></span>
            </div>
            <a class = "offset-5"href="Privada.php">Atras</a>
        <form>
    </body>
</html>









