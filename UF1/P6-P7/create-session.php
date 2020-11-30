<?php
session_start();
include ("LibreriaLogin.php");
require 'stripe-php/init.php';
$_SESSION["suma"] = $_SESSION["suma"]*100;
function generarCodigo($longitud) {
  $key = '';
  $pattern = '1234567890abcdefghijklmnopqrstuvwxyz';
  $max = strlen($pattern)-1;
  for($i=0;$i < $longitud;$i++) $key .= $pattern{mt_rand(0,$max)};
  return $key;
}
$token = generarCodigo(50);
$conn = FuncionConexionBD();
$sql = "UPDATE `usuarios` SET `token` = '$token' WHERE `usuarios`.`correo` ='".$_SESSION["login"]."'";
if (!$resultado = $conn->query($sql)){
  die("Error ejuctuando la consulta:".$conn->error);
}


\Stripe\Stripe::setApiKey('sk_test_51HotDnGdC9XrMgbE2EK4iDcw0rzfloLodsOG592kmQvEw50OOPOmmGrYgrxupTpV7hckjqWbzkjYJ8nuxJDlo2YR00NRxqRblM');
header('Content-Type: application/json');
$YOUR_DOMAIN = 'http://dawjavi.insjoaquimmir.cat';
$checkout_session = \Stripe\Checkout\Session::create([
  'payment_method_types' => ['card'],
  'line_items' => [[
    'price_data' => [
      'currency' => 'usd',
      'unit_amount' => $_SESSION["suma"],
      'product_data' => [
        'name' => 'Precio total del pedido.',
        'images' => ["https://i.imgur.com/EHyR2nP.png"],
      ],
    ],
    'quantity' => 1,
  ]],
  'mode' => 'payment',
  'success_url' => $YOUR_DOMAIN . '/agarcia/M07/UF1/P6/success.php?token='.$token,
  'cancel_url' => $YOUR_DOMAIN . '/agarcia/M07/UF1/P6/cancel.php',
]);
echo json_encode(['id' => $checkout_session->id]);

?>