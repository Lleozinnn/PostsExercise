<?php
session_start();
session_destroy();
session_start();
$_SESSION["messageLogin"] = "Faça login para acessar sua conta.";
$_SESSION["messageType"] = "erro";
header("Location: login.php");
?>