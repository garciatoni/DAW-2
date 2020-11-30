<?php

function ControlDeLogin(){
    if (!(isset($_SESSION["login"]))){
        Header("Location: index.php");
    }
}

//La funcion conecta con la base de datos, comprueba si existe yu devuelve un true en caso afirmativo, de lo contrario un false. La funcion recibe como parametros el correo y la contrasñea encripatada
function FuncionComprovacionBD($comprovacioncorreo, $comprovacioncontraseña) {
    $conn = FuncionConexionBD();
    $sql = "SELECT * FROM usuaris_examen where correo='$comprovacioncorreo' and password='$comprovacioncontraseña'";
    if (!$resultado = $conn->query($sql)){
        die("Error ejuctuando la consulta:".$conn->error);
    }
    if ($resultado->num_rows > 0){
        return true;
    }else{
        return false;
    }
    $resultado->free();
    $conn->close();   
}
 




function ModificarUsuarioBD($password, $id){
    $conn = FuncionConexionBD();
    $sql = "UPDATE `usuaris_examen` SET `password` = '$password' WHERE `usuaris_examen`.`id` = $id";
    if (mysqli_query($conn, $sql)) {
        echo "Los datos se han modificado correctamente!";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    $conn->close(); 
}


function ModificarPasswordBD($token, $password, $pass){
    $conn = FuncionConexionBD();
    $sqlcomprobacion = "SELECT * FROM usuaris_examen where token='$token'";
    if (!$resultado = $conn->query($sqlcomprobacion)){
        die("Error ejuctuando la consulta:".$conn->error);
    }
    if ($resultado->num_rows > 0){
        $sql = "UPDATE `usuaris_examen` SET `password` = '$password',`token` = null WHERE `token` ='$token'";
        if (mysqli_query($conn, $sql)) {
            echo "Los datos se han modificado correctamente, su nueva constraseña es: ".$pass.", Recuerde cambiarla, pues esta solo sirve 1 vez";

        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }else{
        echo "Error modificando la contraseña";
    }

    $resultado->free();
    $conn->close(); 
}

//no funciona...
function caducidad($token, $password){
    $conn = FuncionConexionBD($token, $password);
    $sqlcomprobacion = "SELECT * FROM usuaris_examen where token='$token'";
    if (!$resultado = $conn->query($sqlcomprobacion)){
        die("Error ejuctuando la consulta:".$conn->error);
    }
    if ($resultado->num_rows > 0){
        while ($usuarios = $resultado->fetch_assoc()){
            $id = $usuarios["id"];
            $sql= "INSERT INTO `passgenerada` (`password`, `id_user`, `caducidad`) VALUES ('$password', '$id', '0')";
            if (mysqli_query($conn, $sql)) {
                echo "bien";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }
    }
}

function Logging(){
    if (isset($_REQUEST["E-mail"],$_REQUEST["contraseña"])){
        $verificacion=FuncionComprovacionBD($_REQUEST["E-mail"],md5($_REQUEST["contraseña"]));
        if ($verificacion==true){
            $_SESSION["login"] = $_REQUEST["E-mail"];
            Header("Location: home.php");
        }else{        
            echo "Error de autenticacion.";
        }
    }
}


function idUsuario($correo){
    $conn = FuncionConexionBD();
    $sql = "SELECT id FROM usuaris_examen where correo='$correo'";
    if (!$resultado = $conn->query($sql)){
            die("Error ejuctuando la consulta:".$conn->error);
        }
    if ($resultado->num_rows > 0){
        while ($usuarios = $resultado->fetch_assoc()){
            $id = $usuarios["id"];
            return $id;
        }
    }
    $resultado->free();
    $conn->close(); 
}

function FuncionConexionBD() {
    $conn = new mysqli('localhost', 'agarcia', 'agarcia', 'agarcia_db_prova');
    if ($conn->connect_error) {
        die("CONEXION CON LA BASE DE DATOS FALLIDA: " . $conn->connect_error);
    }
    return $conn;
}

?>

