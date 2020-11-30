<?php
session_start();
$_SESSION=null;
session_destroy();
Header ("location: index.php");

?>
