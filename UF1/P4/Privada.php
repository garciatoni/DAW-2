<?php
session_start();
include("control.php");//Comprobacion del inicio de sesion.
?>
<a href="LOGOUT.php">LOGOUT</a><br>
<h1>GUELCOME: <?php if (isset($_COOKIE["recuerdarcorreo"])){ echo $_COOKIE["recuerdarcorreo"];}elseif (isset($_SESSION["correo"])){echo  $_SESSION["correo"];}?></h1>
<p>"HOLA MUNDO!"</p>
<p>Si estas logeado.</p>


