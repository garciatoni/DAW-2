<?php 
session_start();
include ("LibreriaLogin.php");

if (isset($_GET["token"])){
    $token = $_GET["token"];
    $conn = FuncionConexionBD();
    $sql = "SELECT `token` FROM usuarios where correo='".$_SESSION["login"]."'";
    if (!$resultado = $conn->query($sql)){
        die("Error ejuctuando la consulta:".$conn->error);
    }
    if ($resultado->num_rows > 0){
        while ($usuario = $resultado->fetch_assoc()){
            $token_user = $usuario["token"];
        }
    } 
    $resultado->free();
    $id_user = idUsuario($_SESSION["login"]);
    $precio = $_SESSION["suma"]/100;
    $fecha = date("Y-m-d");
    if ($token == $token_user){
        $sql = "INSERT INTO `comanda` (`id`, `id_user`, `fecha`, `importe`) VALUES (NULL, $id_user, '$fecha', $precio)";
        if (!$resultado = $conn->query($sql)){
            die("Error ejuctuando la consulta:".$conn->error);
        }else{
            $id_comanda = $conn->insert_id;
            echo $id_comanda;
        }
        for ($i=0;$i<count($_SESSION["carrito"]);$i++){
            $id_producto = $_SESSION["carrito"][$i];
            $sql = "UPDATE `productos` SET `id_comanda` = '$id_comanda' WHERE `productos`.`id`=$id_producto";
            if (!$resultado = $conn->query($sql)){
                die("Error ejuctuando la consulta:".$conn->error);
            }

        }
        $_SESSION["carrito"]=null;
    }
    $conn->close(); 
}





?>
<!DOCTYPE html>
<html lang="en">
<head>  
    <meta charset="utf-8">
    <script src="https://kit.fontawesome.com/982045aa7f.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="PaginaPrincipal.css"></link:rel>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Compra</title>
</head>
<body>

    <h1>BIEN</h1>
    <a href="Privada.php">Atras</a>
</body>
</html>
