<?php

//La funcion conecta con la base de datos, comprueba si existe yu devuelve un true en caso afirmativo, de lo contrario un false. La funcion recibe como parametros el correo y la contrasñea encripatada
function FuncionComprovacionBD($comprovacioncorreo, $comprovacioncontraseña) {
    $conn = new mysqli('localhost', 'agarcia', 'agarcia', 'agarcia_P5');
    if ($conn->connect_error) {
        die("CONEXION CON LA BASE DE DATOS FALLIDA: " . $conn->connect_error);
    }
    $sql = "SELECT * FROM usuarios where correo='$comprovacioncorreo' and password='$comprovacioncontraseña'";
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
 

function FuncionConexionBD() {
    $conn = new mysqli('localhost', 'agarcia', 'agarcia', 'agarcia_P5');
    if ($conn->connect_error) {
        die("CONEXION CON LA BASE DE DATOS FALLIDA: " . $conn->connect_error);
    }
}



function FuncionCorreo($token) {
    $conn = new mysqli('localhost', 'agarcia', 'agarcia', 'agarcia_P5');
    if ($conn->connect_error) {
        die("CONEXION CON LA BASE DE DATOS FALLIDA: " . $conn->connect_error);
    }
    $sql = "SELECT * FROM usuarios where token='$token'";
    if (!$resultado = $conn->query($sql)){
        die("Error ejuctuando la consulta:".$conn->error);
    }
    if ($resultado->num_rows > 0){
        $usuarios = $resultado->fetch_assoc();
        return $usuarios["correo"];
    }
    $resultado->free();
    $conn->close();   
}





function FuncionComprovacionAdmin($correo) {
    $conn = new mysqli('localhost', 'agarcia', 'agarcia', 'agarcia_P5');
    if ($conn->connect_error) {
        die("CONEXION CON LA BASE DE DATOS FALLIDA: " . $conn->connect_error);
    }
    $sql = "SELECT * FROM usuarios where correo='$correo'";
    if (!$resultado = $conn->query($sql)){
        die("Error ejuctuando la consulta:".$conn->error);
    }
    if ($resultado->num_rows > 0){
        $usuarios = $resultado->fetch_assoc();
        return $usuarios["Administrador"];
    }
    $resultado->free();
    $conn->close();   
}

function FuncionMostrarTodosLosUsuarios(){
    $conn = new mysqli('localhost', 'agarcia', 'agarcia', 'agarcia_P5');
    if ($conn->connect_error) {
        die("CONEXION CON LA BASE DE DATOS FALLIDA: " . $conn->connect_error);
    }
    $sql = "SELECT * FROM usuarios";
    if (!$resultado = $conn->query($sql)){
        die("Error ejuctuando la consulta:".$conn->error);
    }
    if ($resultado->num_rows > 0){
        echo "<ul>";
        echo "Administrador=1, Usuario=0";
        while ($usuarios = $resultado->fetch_assoc()){
            echo "<li>";            
            echo "Rol: ".$usuarios["Administrador"].", Nombre: ".$usuarios["nombre"].", Correo: ".$usuarios["correo"]; //<a href=\"\"><button>Modificar</button></a>  <a href=\"\"><button class=\"bg-danger\">Eliminar</button></a>";
            echo "</li>";
        }
        echo "</ul>";
        
    }
    $resultado->free();
    $conn->close();   
}



function ModificarUsuarioBD($nombre, $correo, $password, $id){
    $conn = new mysqli('localhost', 'agarcia', 'agarcia', 'agarcia_P5');
    if ($conn->connect_error) {
        die("CONEXION CON LA BASE DE DATOS FALLIDA: " . $conn->connect_error);
    }
    if ($correo == $_SESSION["login"]){
        $sql = "UPDATE `usuarios` SET `nombre` = '$nombre', `correo` = '$correo', `password` = '$password' WHERE `usuarios`.`id` = $id";
        if (mysqli_query($conn, $sql)) {
            echo "Los datos se han modificado correctamente!";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }else{
        $sqlcomprobacion = "SELECT * FROM usuarios where correo='$correo'";
        if (!$resultado = $conn->query($sqlcomprobacion)){
            die("Error ejuctuando la consulta:".$conn->error);
        } 
        if ($resultado->num_rows > 0){
            echo "Ya existe una cuenta con este correo...";
        }else{
            $sql = "UPDATE `usuarios` SET `nombre` = '$nombre', `correo` = '$correo', `password` = '$password' WHERE `usuarios`.`id` = $id";
            if (mysqli_query($conn, $sql)) {
                echo "Los datos se han modificado correctamente!";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }
    }
    $conn->close(); 
}

/*
function ModificarPasswordBD($token, $password){
    $conn = new mysqli('localhost', 'agarcia', 'agarcia', 'agarcia_P5');
    if ($conn->connect_error) {
        die("CONEXION CON LA BASE DE DATOS FALLIDA: " . $conn->connect_error);
    }
    $sqlcomprobacion = "SELECT * FROM usuarios where token='$token'";
    if (!$resultado = $conn->query($sqlcomprobacion)){
        die("Error ejuctuando la consulta:".$conn->error);
    } 
    if ($resultado->num_rows > 0){
        $sql = "UPDATE `usuarios` SET `password` = '$password',`token` = 0 WHERE `token` ='$token'";
        if (mysqli_query($conn, $sql)) {
            echo "Los datos se han modificado correctamente!";
            
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
    $resultado->free();
    $conn->close(); 
}
*/



function InsertarUsuarioBD($nombre, $correo, $password){
    $conn = new mysqli('localhost', 'agarcia', 'agarcia', 'agarcia_P5');
    if ($conn->connect_error) {
        die("CONEXION CON LA BASE DE DATOS FALLIDA: " . $conn->connect_error);
    }
    //$sql = "INSERT INTO `usuarios` (`id`, `nombre`, `correo`, `password`) VALUES (NULL, '$nombre', '$correo', '$password')";
    $sqlcomprobacion = "SELECT * FROM usuarios where correo='$correo'";
    if (!$resultado = $conn->query($sqlcomprobacion)){
        die("Error ejuctuando la consulta:".$conn->error);
    } 
    if ($resultado->num_rows > 0){
        echo "Ya existe una cuenta con este usuario...";
    } else{
        $sql = "INSERT INTO `usuarios` (`id`, `nombre`, `correo`, `password`, `Administrador`, `token`) VALUES (NULL, '$nombre', '$correo', '$password', 0, 0)";
        if (mysqli_query($conn, $sql)) {
            echo "Se ha registrado correctamente!";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
    $resultado->free();
    $conn->close(); 
}

//Si existe la cookie "recuerda" llama a la funcion "FuncionComprovacionBD"
function Logging(){
    if (isset($_COOKIE["recuerdarcorreo"],$_COOKIE["recordarcontraseña"])){
        $verificacion=FuncionComprovacionBD($_COOKIE["recuerdarcorreo"],$_COOKIE["recordarcontraseña"]);
        if ($verificacion==true){
            $_SESSION["login"] = $_COOKIE["recuerdarcorreo"];
            Header("Location: Privada.php");
        }else{        
            echo "Error de autenticacion.";
            setcookie("recuerdarcorreo", null, null);
            setcookie("recordarcontraseña", null, null);
        }
    //Si no existen las cookies comparo las request.
    }elseif (isset($_REQUEST["E-mail"],$_REQUEST["contraseña"])){
        $verificacion=FuncionComprovacionBD($_REQUEST["E-mail"],sha1(md5($_REQUEST["contraseña"])));
        if ($verificacion==true){
            $_SESSION["login"] = $_REQUEST["E-mail"];
            Header("Location: Privada.php");
        }else{        
            echo "Error de autenticacion.";
            setcookie("recuerdarcorreo", null, null);
            setcookie("recordarcontraseña", null, null);

        }
    }
}


?>