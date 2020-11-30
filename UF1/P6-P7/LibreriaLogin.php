<?php

function ControlDeLogin(){
    if (!(isset($_SESSION["login"]))){
        Header("Location: Publica.php");
    }
}


//La funcion conecta con la base de datos, comprueba si existe yu devuelve un true en caso afirmativo, de lo contrario un false. La funcion recibe como parametros el correo y la contrasñea encripatada
function FuncionComprovacionBD($comprovacioncorreo, $comprovacioncontraseña) {
    $conn = FuncionConexionBD();
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
 

function FuncionCorreo($token) {
    $conn = FuncionConexionBD();
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
    $conn = FuncionConexionBD();
    $sql = "SELECT * FROM usuarios where correo='$correo'";
    if (!$resultado = $conn->query($sql)){
        die("Error ejuctuando la consulta:".$conn->error);
    }
    if ($resultado->num_rows > 0){
        $usuarios = $resultado->fetch_assoc();
        return $usuarios["rol_id"];
    }
    $resultado->free();
    $conn->close();   
}




function ModificarUsuarioBD($nombre, $correo, $password, $id){
    $conn = FuncionConexionBD();
    $sql = "SELECT `correo` FROM usuarios where id='$id'";
    if (!$resultado = $conn->query($sql)){
        die("Error ejuctuando la consulta:".$conn->error);
    } 
    if ($resultado->num_rows > 0){
        while ($usuarios = $resultado->fetch_assoc()){
            $correo_id = $usuarios["correo"];
        }
    }
    if ($correo == $correo_id){
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


function ModificarPasswordBD($token, $password){
    $conn = FuncionConexionBD();
    $sqlcomprobacion = "SELECT * FROM usuarios where token='$token'";
    if (!$resultado = $conn->query($sqlcomprobacion)){
        die("Error ejuctuando la consulta:".$conn->error);
    } 
    if ($resultado->num_rows > 0){
        $sql = "UPDATE `usuarios` SET `password` = '$password',`token` = null WHERE `token` ='$token'";
        if (mysqli_query($conn, $sql)) {
            echo "Los datos se han modificado correctamente!";
            
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }else{
        echo "Error modificando la contraseña";
    }
    $resultado->free();
    $conn->close(); 
}

function InsertarUsuarioBD($nombre, $correo, $password){
    $conn = FuncionConexionBD();
    //$sql = "INSERT INTO `usuarios` (`id`, `nombre`, `correo`, `password`) VALUES (NULL, '$nombre', '$correo', '$password')";
    $sqlcomprobacion = "SELECT * FROM usuarios where correo='$correo'";
    if (!$resultado = $conn->query($sqlcomprobacion)){
        die("Error ejuctuando la consulta:".$conn->error);
    } 
    if ($resultado->num_rows > 0){
        echo "Ya existe una cuenta con este usuario...";
    } else{
        $sql = "INSERT INTO `usuarios` (`id`, `nombre`, `correo`, `password`, `rol_id`, `token`) VALUES (NULL, '$nombre', '$correo', '$password', 2, 0)";
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


function idUsuario($correo){
    $conn = FuncionConexionBD();
    $sql = "SELECT id FROM usuarios where correo='$correo'";
    if (!$resultado = $conn->query($sql)){
            die("Error ejuctuando la consulta:".$conn->error);
        }
    if ($resultado->num_rows > 0){
        while ($usuarios = $resultado->fetch_assoc()){
            $id = $usuarios["id"];
            return $id;
        }
    }

}





/*

function InsertarRutaFotoProducto($foto_ruta, $id){
    $conn = new mysqli('localhost', 'agarcia', 'agarcia', 'agarcia_P5');
    if ($conn->connect_error) {
        die("CONEXION CON LA BASE DE DATOS FALLIDA: " . $conn->connect_error);
    }
//"SELECT productos.id FROM productos INNER JOIN usuarios ON productos.id_user = usuarios.id";
    $sqlp = "INSERT INTO `imagenes` (`id`, `id_producto`, `ruta`) VALUES (NULL, '$id_producto', '$foto_ruta') ";
    if (mysqli_query($conn, $sqlp)) {
        echo "Se ha registrado correctamente!";
    } else {
        echo "Error: " . $sqlp . "<br>" . mysqli_error($conn);
    }

    $conn->close(); 
}
*/




function InsertarProductoBD($nombre, $descripcion, $precio, $correo/*$fichero*/){
    $conn = FuncionConexionBD();
    $sql = "SELECT id FROM usuarios where correo='$correo'";
    if (!$resultado = $conn->query($sql)){
            die("Error ejuctuando la consulta:".$conn->error);
    }
    if ($resultado->num_rows > 0){
        while ($usuarios = $resultado->fetch_assoc()){
            $id_user = $usuarios["id"];
        }
    }
    $sqlp = "INSERT INTO `productos` (`id`, `id_user`, `nombre`, `descripcion`, `precio`) VALUES (NULL, '$id_user', '$nombre', '$descripcion', '$precio' ) ";
    if (mysqli_query($conn, $sqlp)) {
        $id_producto = $conn->insert_id;
        /*$sqli = "INSERT INTO `imagenes` (`id`, `id_producto`, `ruta`) VALUES (NULL, '$id_producto', '$fichero')";
        if (mysqli_query($conn, $sqli)) {
            echo " Producto subido!";
        }else{
            echo "Error: " . $sqlp . "<br>" . mysqli_error($conn);
        }*/
    } else {
        echo "Error: " . $sqlp . "<br>" . mysqli_error($conn);
    }
    return $id_producto;

    $conn->close(); 
}

function InsertarImagenEnProducto($id_producto, $fichero){
    $conn = FuncionConexionBD();
    $sql = "INSERT INTO `imagenes` (`id`, `id_producto`, `ruta`) VALUES (NULL, '$id_producto', '$fichero')";
    if (mysqli_query($conn, $sql)) {

    }else{
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

//He añadido un carousel a las imagenes para que se vayan viendo.
function MostrarImagenProducto($id_producto){
    $conn = FuncionConexionBD();
    $sqli = "SELECT ruta FROM `imagenes` WHERE imagenes.id_producto = '$id_producto'";
    if (!$resultad = $conn->query($sqli)){
        die("Error ejuctuando la consulta:".$conn->error);
    }
    if ($resultad->num_rows > 1){
        echo "<div id=\"demo\" class=\"carousel slide\" data-ride=\"carousel\">";
        echo "  <div class=\"carousel-inner\">";
        $contador=1;
        while ($imagenes = ($resultad->fetch_assoc())){
            if ($contador == 1){
                echo "      <div class=\"carousel-item active\">";
                echo "          <img width=\"300px\" height=\"300px\" src=\"".$imagenes["ruta"]."\">";
                echo "      </div>";
                $contador++;
            }else{
                echo "      <div class=\"carousel-item\">";
                echo "          <img width=\"300px\" height=\"300px\" src=\"".$imagenes["ruta"]."\">";
                echo "      </div>";
            }
        }
        echo "  </div>";
        echo "</div>";
    }else if ($resultad->num_rows == 1){
        while ($imagenes = ($resultad->fetch_assoc())){
            echo "  <img width=\"300px\" height=\"300px\" src=\"".$imagenes["ruta"]."\">";
        }


    }
    $resultad->free();
}


function FuncionMostrarTodosLosProductos(){
    $conn = FuncionConexionBD();
    $sql = "SELECT * FROM productos";
    if (!$resultado = $conn->query($sql)){
        die("Error ejuctuando la consulta:".$conn->error);
    }
    if ($resultado->num_rows > 0){
        while ($productos = $resultado->fetch_assoc()){
            if ($productos["id_comanda"] == null){
                echo "<div class=\"col-md-4\">";
                echo "  <div class=\"service border mb-3\">";
                $id_producto = $productos["id"]; 
                MostrarImagenProducto($id_producto);//
                echo "    <a href=\"#\"><h1><strong>".$productos["nombre"]."</strong></h1></a>";
                echo "    <p>".$productos["descripcion"]."</p>";
                echo "    <p>".$productos["precio"]."€</p>";
                if (isset($_SESSION["login"])){
                BotonCarritoCompra(idUsuario($_SESSION["login"]), $id_producto);
                }
                echo "  </div>";
                echo "</div>"; 
            }
        } 
    }
    $resultado->free();
    $conn->close();   
}

function FuncionConexionBD() {
    $conn = new mysqli('localhost', 'agarcia', 'agarcia', 'agarcia_P5');
    if ($conn->connect_error) {
        die("CONEXION CON LA BASE DE DATOS FALLIDA: " . $conn->connect_error);
    }
    return $conn;
}

function BuscarProducto($nombreProducto){
    $conn = FuncionConexionBD();
    $sql = "SELECT * FROM productos where UPPER(nombre) LIKE UPPER('%$nombreProducto%')";
    if (!$resultado = $conn->query($sql)){
        die("Error ejuctuando la consulta:".$conn->error);
    }
    if ($resultado->num_rows > 0){
        while ($productos = $resultado->fetch_assoc()){
            if ($productos["id_comanda"] == null){
                echo "<div class=\"col-md-4\">";
                echo "  <div class=\"service border mb-3\">";
                $id_producto = $productos["id"];      
                MostrarImagenProducto($id_producto);
                echo "    <a href=\"#\"><h1><strong>".$productos["nombre"]."</strong></h1></a>";
                echo "    <p>".$productos["descripcion"]."</p>";
                echo "    <p>".$productos["precio"]."€</p>";
                echo "  </div>";
                echo "</div>";
            }
        }      
    }else{
        echo $nombreProducto;
        echo ": NO HAY PRODUCTOS CON ESE NOMBRE";
        $buscar = false;
        return $buscar;
    }
}

function FuncionMostrarTodosLosUsuarios(){
    $conn = FuncionConexionBD();
    $sql = "SELECT * FROM usuarios";
    if (!$resultado = $conn->query($sql)){
        die("Error ejuctuando la consulta:".$conn->error);
    }
    if ($resultado->num_rows > 0){
        echo " <a href=\"Privada.php\"><button class=\"mt-2 ml-2 mb-2 bg-dark text-white\" >Volver</button></a>";
        echo "<table border=\"1\" class=\"container\">";
        echo "<tr class=\"border\">";
        echo "  <td>Rol</td>"; 
        echo "  <td>Nombre</td>";   
        echo "  <td>Correo</td>";     
        echo "</tr>";
        while ($usuarios = $resultado->fetch_assoc()){
            echo "<tr class=\"border\">";
            echo "  <td>".$usuarios["rol_id"]."</td>";            
            echo "  <td>".$usuarios["nombre"]."</td>";
            echo "  <td>".$usuarios["correo"]."</td>";
            echo "  <td><a href=\"ModificacionDatos.php?modificaruser=".$usuarios["id"]."\">Modificar</a></td>";
            echo "  <td><a class=\"text-danger\" href=\"EliminarProducto.php?eliminaruser=".$usuarios["id"]."\">Eliminar</a></td>";
            echo "</tr>";
        }
        echo "</table>";  
    }
    $resultado->free();
    $conn->close();   
}

function FuncionModificarYEliminarProductos($correo){
    $conn = FuncionConexionBD();
    $id = idUsuario($correo);
    $sql = "SELECT * FROM productos WHERE id_user= '$id'";
    if (!$resultado = $conn->query($sql)){
        die("Error ejuctuando la consulta:".$conn->error);
    }
    if ($resultado->num_rows > 0){
        echo " <a href=\"Privada.php\"><button class=\"mt-2 ml-2 mb-2 bg-dark text-white\" >Volver</button></a>";
        echo "<table border=\"1\" class=\"container\">";
        echo "<tr class=\"border\">";
        echo "  <td>Nombre</td>";   
        echo "  <td>Descripcion</td>";   
        echo "  <td>Precio</td>";   
        echo "</tr>";
        while ($productos = $resultado->fetch_assoc()){
            echo "<tr class=\"border\">";
            echo "  <td>".$productos["nombre"]."</td>";            
            echo "  <td>".$productos["descripcion"]."</td>";
            echo "  <td>".$productos["precio"]."€</td>";
            echo "  <td><a href=\"ModificarProducto.php?modificar=".$productos["id"]."\">Modificar</a></td>";
            echo "  <td><a class=\"text-danger\" href=\"EliminarProducto.php?eliminar=".$productos["id"]."\">Eliminar</a></td>";
            echo "</tr>";
        }
        echo "</table>";  
    }else{
        echo " <a href=\"Privada.php\"><button class=\"mt-2 ml-2 mb-2 bg-dark text-white\" >Volver</button></a>";
        echo "No tienes productos a colgados.";
    }
    $resultado->free();
    $conn->close();   
}

function BorrarProducto($id){
    $conn = FuncionConexionBD();
    $sql= "DELETE FROM `productos` WHERE `productos`.`id` = $id";
    if (mysqli_query($conn, $sql)) {
        echo ("correcto");
        Header("Location: Privada.php?tusproductos=si");
    }else{
        echo "Problemas al eliminar el producto.";
    }
}

function BorrarUsuario($id){
    $conn = FuncionConexionBD();
    $sql= "DELETE FROM `usuarios` WHERE `usuarios`.`id` = $id";
    if (mysqli_query($conn, $sql)) {
        echo ("correcto");
        Header("Location: Privada.php?listauser=si");
    }else{
        echo "Problemas al eliminar el usuario.";
    }
}



function ModificarProductoBD($nombre, $descripcion, $precio, $id_producto){
    $conn = FuncionConexionBD();
    $sqlp = "UPDATE `productos` SET `nombre` = '$nombre', `descripcion` = '$descripcion', `precio` = '$precio' WHERE `productos`.`id` = '$id_producto';";
    if (mysqli_query($conn, $sqlp)) {
        echo "Correcto modificado del producto.";
    } else {
        echo "Error: " . $sqlp . "<br>" . mysqli_error($conn);
    }

    $conn->close(); 
}


function MostrarTodasLasImagenProducto($id_producto){
    $conn = FuncionConexionBD();
    $sqli = "SELECT ruta,id FROM `imagenes` WHERE imagenes.id_producto = $id_producto";
    if (!$resultad = $conn->query($sqli)){
        die("Error ejuctuando la consulta:".$conn->error);
    }
    if ($resultad->num_rows > 0){
        while ($imagenes = ($resultad->fetch_assoc())){
            echo "<a onclick=\"return confirm('Estas seguro de eliminar la imagen')\" href=EliminarProducto.php?EliminarImagen=".$imagenes["id"].">";
            echo "  <img width=\"100px\" height=\"60px\" src=\"".$imagenes["ruta"]."\"> ";
            echo "</a>";
        }
    }
    $resultad->free();
}

function BorrarImagen($id, $id_producto){
    $conn = FuncionConexionBD();
    $sql= "DELETE FROM `imagenes` WHERE `imagenes`.`id` = $id";
    if (mysqli_query($conn, $sql)) {
        echo ("correcto");
        Header("Location: ModificarProducto.php?modificar=$id_producto");
    }else{
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    $conn->close(); 
}

function InsertarCategoria($id_prod, $id_cate){
    $conn = FuncionConexionBD();
    $crear = true;
    $sqlcomprobacion = "SELECT id_categoria FROM `productos_categoria` where id_producto=$id_prod";
    if (!$resultado = $conn->query($sqlcomprobacion)){
        die("Error ejuctuando la consulta:".$conn->error);
    } 
    if ($resultado->num_rows > 0){
        while ($procat = ($resultado->fetch_assoc())){
            if ($id_cate == $procat["id_categoria"]){
                $crear = false;
                echo "YA EXISTE";
            }
        }
    }
    if ($crear == true){
        $sql = "INSERT INTO `productos_categoria` (`id_producto`, `id_categoria`) VALUES ('$id_prod', '$id_cate')";
        if (mysqli_query($conn, $sql)) {
        }else{
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
    $resultado->free();
    $conn->close(); 
}

function BuscarProductoPorCategoria($categoria){
    $conn = FuncionConexionBD();
    $sql = "SELECT productos.id FROM productos_categoria INNER JOIN productos ON productos.id=productos_categoria.id_producto WHERE productos_categoria.id_categoria = $categoria";
    if (!$resultado = $conn->query($sql)){
        die("Error ejuctuando la consulta:".$conn->error);
    }
    //SELECT categoria.id, categoria.nombre FROM productos_categoria INNER JOIN categoria ON categoria.id=productos_categoria.id_categoria WHERE productos_categoria.id_producto = $id_producto
    if ($resultado->num_rows > 0){
        while ($productos = $resultado->fetch_assoc()){
            $id_producto = $productos["id"];
            $sqlp = "SELECT * FROM `productos` WHERE id=$id_producto";
            if (!$resultad = $conn->query($sqlp)){
                die("Error ejuctuando la consulta:".$conn->error);
            }
            if ($resultad->num_rows > 0){
                while ($pro = $resultad->fetch_assoc()){
                    if ($pro["id_comanda"] == null){
                        echo "<div class=\"col-md-4\">";
                        echo "  <div class=\"service border mb-3\">";
                        $id_producto = $productos["id"];      
                        MostrarImagenProducto($id_producto);
                        echo "    <a href=\"#\"><h1><strong>".$pro["nombre"]."</strong></h1></a>";
                        echo "    <p>".$pro["descripcion"]."</p>";
                        echo "    <p>".$pro["precio"]."€</p>";
                        echo "  </div>";
                        echo "</div>";
                    }
                }  
            }
        }    
    }else{
        echo ": NO HAY PRODUCTOS CON ESA CATEGORIA";
        $buscar = false;
        return $buscar;
    }
}

function BotonCarritoCompra($id_user, $id_producto){
    $conn = FuncionConexionBD();

    $sql = "SELECT * FROM `productos` WHERE id=$id_producto";   //"SELECT * FROM `productos` WHERE productos.id_user = $id_user";
    if (!$resultado = $conn->query($sql)){
        die("Error ejuctuando la consulta:".$conn->error);
    }
    if ($resultado->num_rows > 0){
        while ($productos = $resultado->fetch_assoc()){
            if ($id_user == $productos["id_user"]){
                echo "Tu producto.";
            }else{
                echo "    <a href=\"CarritoCompra.php?idproducto=$id_producto\"><i class=\"fas fa-shopping-cart\"></i></a>";
            }
        }
    }
    $resultado->free();
    $conn->close(); 
}


function MostrarProductosCarrito($id_producto){
    $conn = FuncionConexionBD();
    $sql = "SELECT * FROM productos WHERE id= $id_producto";
    if (!$resultado = $conn->query($sql)){
        die("Error ejuctuando la consulta:".$conn->error);
    }
    if ($resultado->num_rows > 0){
        while ($productos = $resultado->fetch_assoc()){
            echo "<tr class=\"border\">";
            echo "  <td>".$productos["nombre"]."</td>";            
            echo "  <td>".$productos["descripcion"]."</td>";
            echo "  <td>".$productos["precio"]."€</td>";
            echo "  <td><a href=\"EliminarProducto.php?D_carrito=$id_producto\">Borrar del carrito</a></td>";
            echo "</tr>";
        }
        
    }
    $resultado->free();
    $conn->close();   
}

function PrecioProducto($id_producto){
    $conn = FuncionConexionBD();
    $sql = "SELECT * FROM productos WHERE id= $id_producto";
    if (!$resultado = $conn->query($sql)){
        die("Error ejuctuando la consulta:".$conn->error);
    }    
    if ($resultado->num_rows > 0){
        while ($productos = $resultado->fetch_assoc()){
            $precio = $productos["precio"];
        }
    }
    $resultado->free();
    $conn->close();     
    return $precio;
}



function expiracionToken($token){
    $conn = FuncionConexionBD();
    $sql ="SELECT * FROM tokens WHERE token='$token'";
    if (!$resultado = $conn->query($sql)){
        die("Error ejuctuando la consulta:".$conn->error);
    }
    if ($resultado->num_rows > 0){
        while ($tokens = $resultado->fetch_assoc()){
            $fechaInicial = $tokens["fecha_creacion"];
            $fechaActual = time();
            $TiempoTrasCreacion = $fechaActual - $fechaInicial;
            return $TiempoTrasCreacion;
        }
    }
}



?>

