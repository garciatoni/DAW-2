<?php
session_start();
$errorprecio="";
$errordescripcion="";
$errornombre="";
$errorfoto= "";
include ("control.php");//Comprobacion del inicio de sesion.
include ("LibreriaLogin.php");
//Funcion para evitar errores con espacios, scripts y comillas.
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}



if($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_REQUEST["nombre"]) && empty($_REQUEST["nombre"])){
            $errornombre="Introduce un nombre.";

    }elseif (!preg_match("/^[a-zA-Z-0-9-' ]*$/",$_REQUEST["nombre"])){ 
        $errornombre = "El nombre solo puede contener letras y numeros.";

    } elseif (isset($_REQUEST["mytextarea"]) && empty($_REQUEST["mytextarea"])){
        $errordescripcion= "Introdue una descripcion.";

    }elseif (!preg_match("/^[a-zA-Z-0-9-' ]*$/",$_REQUEST["mytextarea"])){ 
        $errordescripcion = "Introduce solo numeros y letras.";

    }elseif (isset($_REQUEST["precio"]) && empty($_REQUEST["precio"])){
        $errorprecio = "Introdue un precio.";

    }elseif (!preg_match("/^[0-9]*$/",$_REQUEST["precio"])){
        $errorprecio = "El precio solo puede contener numeros.";
    
    }elseif (isset($_FILES) && $_FILES["Archivo"]["name"][0] == null){
        $errorfoto = "Es necesario subir una fotografia del producto";

    }else {
        $directorioUsuario = "img_productos/".idUsuario($_SESSION["login"]);
        if (!file_exists($directorioUsuario)){
            mkdir("img_productos/".idUsuario($_SESSION["login"]), 0777);
        }
        $id_producto = InsertarProductoBD($_REQUEST["nombre"], $_REQUEST["mytextarea"], $_REQUEST["precio"], $_SESSION["login"]);
        $numeroArchivos = count($_FILES["Archivo"]["name"]);
        for ($i=0;$i<$numeroArchivos;$i++){
            $dir_subida = 'img_productos/'.idUsuario($_SESSION["login"]).'/';
            $fichero = $dir_subida . basename($_FILES["Archivo"]["name"][$i]);
            if (move_uploaded_file($_FILES['Archivo']['tmp_name'][$i],$fichero)){
                echo "correcto";
                InsertarImagenEnProducto($id_producto, $fichero);
            } else{
                echo "ERROR";
            }
        }

        if (isset($_REQUEST["Arte"])){
            InsertarCategoria($id_producto, $_REQUEST["Arte"]);
        }
        if (isset($_REQUEST["Ocio"])){
            InsertarCategoria($id_producto, $_REQUEST["Ocio"]);
        }
        if (isset($_REQUEST["Tecnologia"])){
            InsertarCategoria($id_producto, $_REQUEST["Tecnologia"]);
        }
        if (isset($_REQUEST["Cultura"])){
            InsertarCategoria($id_producto, $_REQUEST["Cultura"]);
        }
        if (isset($_REQUEST["Deportes"])){
            InsertarCategoria($id_producto, $_REQUEST["Deportes"]);
        }






    }
    
}
?>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <title>Nuevo Producto</title>
    </head>

    <body>
        <h1 class=" col-sm-3 offset-sm-4 mt-5">Nuevo Producto</h1>
        <form action="IntroducirProducto.php" enctype="multipart/form-data" method="post" id="myform" name="myform">
            <div class="form-inline mt-5">
                <label for="nombre" class="offset-sm-4 col-sm-1 text-alight-right">Nombre</label>
                <input type="text" name="nombre" class="form-control col-sm-2" placeholder="Su nombre"><span class="alert m-0 p-0" ><?php echo $errornombre;?></span>
            </div>    

            <div class="form-inline mt-3">
                <label for="mytextarea" class="offset-sm-3 col-sm-2 text-alight-right">Descripcion del producto</label>
                <textarea name="mytextarea"  placeholder="Descripcion" class="form-control col-sm-2" id="" rows="3" cols="30"></textarea><?php echo $errordescripcion;?></span>
            </div>

            <div class="form-inline mt-3">
                <label for="Password" class="offset-sm-4 col-sm-1 text-lg-right">Precio</label>
                <input type="text" name="precio" class="form-control col-sm-2" placeholder="precio"><span class="alert m-0 p-0"><?php echo $errorprecio;?></span>
            </div>
            <div class="form-inline mt-3">
                    <input type="file" class="offset-sm-5 form-control" name="Archivo[]" id="inputGroupFile02" multiple><span class="alert m-0 p-0"><?php echo $errorfoto ;?></span>
            </div>
            <div class="form mt-3 offset-sm-5">
                <input type="checkbox" name="Arte" value="1" /> Arte <br />
                <input type="checkbox" name="Tecnologia" value="2" /> Tecnologia <br />
                <input type="checkbox" name="Ocio" value="3" /> Ocio <br />
                <input type="checkbox" name="Cultura" value="6" /> Cultura <br />
                <input type="checkbox" name="Deportes" value="7" /> Deportes <br />
            </div>
            <div>
                <button type="submit" class="offset-sm-5 btn-info mt-3">Subir</button>    
                <a class="ml-1" href="Privada.php">Atras...</a>            
            </div>

        </form>
    </body>
</html>
