<?php
session_start();
$errorprecio="";
$errordescripcion="";
$errornombre="";
$errorfoto= "";
include ("LibreriaLogin.php");
ControlDeLogin();
//Funcion para evitar errores con espacios, scripts y comillas.
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


//He añadido la validacion en el cliente tambien, para que la pagina sea mas agradable(Estan ambas validaciones

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

    }elseif (!preg_match("/^[0-9.]*$/",$_REQUEST["precio"])){
        $errorprecio = "El precio solo puede contener numeros y el punto para los decimales.";
    
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
        <!-- Bootstrap CSS -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <title>Nuevo Producto</title>
    </head>

    <body>
        <div class="container d-flex justify-content-center">
            <form action="IntroducirProducto.php" enctype="multipart/form-data" method="post" id="myform" name="myform" class="p-4">
                <h1 class="text-center mt-2">Nuevo Producto</h1>
                <div class="form-group mt-3">
                    <!--<label for="nombre" class="text-alight-right">Nombre</label>-->
                    <input required type="text" name="nombre" class="form-control"  placeholder="Nombre del producto"><span class="text-danger"><?php echo $errornombre;?></span>
                </div>    
                <div class="form-group mt-1">
                    <textarea required name="mytextarea"  placeholder="Descripcion" class="form-control"></textarea><span class="text-danger"><?php echo $errordescripcion;?></span>  
                </div>
                <div class="form-group mt-1">
                    <input required type="text" name="precio" class="form-control" placeholder="precio"><span class="text-danger"><?php echo $errorprecio;?></span>
                </div>
                <div class="form-inline mt-3">
                    <input required type="file" class="form-control-file border" name="Archivo[]" id="inputGroupFile02" multiple><span class="text-danger"><?php echo $errorfoto ;?></span>
                </div>

                <div class="form mt-3">
                    <input type="checkbox" name="Arte" value="1" /> Arte <br />
                    <input type="checkbox" name="Tecnologia" value="2" /> Tecnologia <br />
                    <input type="checkbox" name="Ocio" value="3" /> Ocio <br />
                    <input type="checkbox" name="Cultura" value="6" /> Cultura <br />
                    <input type="checkbox" name="Deportes" value="7" /> Deportes <br />
                </div>
                <div class="d-flex justify-content-center mt-3">
                    <button type="submit" class=" btn-info">Subir</button>    
                    <a class="ml-3 text-center" href="Privada.php">Atras...</a>            
                </div>
            </form>

        </div>
    </body>
    
</html>
