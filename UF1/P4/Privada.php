<?php
session_start();



if (isset($_SESSION["login"]) && $_SESSION["login"] == 1){
   
    echo "<a href=\"LOGOUT.php\">LOGOUT</a><br>";

    echo "<br>";
    echo "HOLA MUNDO!"

    ?><p>Si estas logeado.</p> <?php
 
} else{
    Header("Location: Publica.php");
    /*?><p>Texto para usuarios que NO estan logeados</p> <?php*/
}


    

?>