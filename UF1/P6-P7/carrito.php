<?php
session_start();
include ("LibreriaLogin.php");
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Carrito</title>
    <script src="https://kit.fontawesome.com/982045aa7f.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="PaginaPrincipal.css"></link:rel>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" href="style.css">
    <script src="https://polyfill.io/v3/polyfill.min.js?version=3.52.1&features=fetch"></script>
    <script src="https://js.stripe.com/v3/"></script>
  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-light bg-dark ">
        <div class="collapse navbar-collapse container-fluid d-flex" id="navbarSupportedContent">
          <a href="Privada.php" class="navbar-brand m-0 p-8 text-white disabled" ><?php echo $_SESSION["login"];?></a>
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
    <section>
      <div class="container">
        <h3 class="mt-4">Productos en tu carrito de compra</h3>
        <a href="Privada.php"><button class="bg-dark mt-2 mb-2 text-white" >Volver</button></a>
        <button id="checkout-button" class="bg-dark text-white ">Comprar</button>
        <table class="border container-fluid">
          <tr class="border">
            <td>Nombre</td>
            <td>Descripcion</td>  
            <td>Precio</td>
          </tr>
            <?php
            if (isset($_SESSION["carrito"])){
              $_SESSION["suma"]=0;
              $longitud = count($_SESSION["carrito"]);
              for ($i=0;$i<$longitud;$i++){
                $id_producto = $_SESSION["carrito"][$i];
                MostrarProductosCarrito($id_producto);
                $_SESSION["suma"] = $_SESSION["suma"] + PrecioProducto($id_producto);
              }
            }else{
              $_SESSION["suma"]=0;
            }
            ?>
        </table>  
        <h5>Total: <?php echo $_SESSION["suma"];?>€</h5>

 

      </div>



    </section>
  </body>
  <footer>
  <script type="text/javascript">
    // Create an instance of the Stripe object with your publishable API key
    var stripe = Stripe("pk_test_51HotDnGdC9XrMgbEdcwkpvQsd3wD30t5nmfA5j4BQQXrH0Ab64hH64nGaKzrM3rggalLFQ8Wc3tLMalFBhWT2P4o00DdXerIoj");
    var checkoutButton = document.getElementById("checkout-button");
    checkoutButton.addEventListener("click", function () {
      fetch("create-session.php", {
        method: "POST",
      })
        .then(function (response) {
          return response.json();
        })
        .then(function (session) {
          return stripe.redirectToCheckout({ sessionId: session.id });
        })
        .then(function (result) {
          // If redirectToCheckout fails due to a browser or network
          // error, you should display the localized error message to your
          // customer using error.message.
          if (result.error) {
            alert(result.error.message);
          }
        })
        .catch(function (error) {
          console.error("Error:", error);
        });
    });
  </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</footer>
</html>

