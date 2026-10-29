<?php
require 'config.php';
if (@$_SESSION['isLogged']) {
    $_SESSION["messageLogin"] = null;
    $_SESSION["messageType"] = null;
    header("Location: perfil.php");
}
criarTopo("Login");
if (@$_SESSION["messageLogin"]) {
        echo criaMensagem($_SESSION["messageType"], $_SESSION["messageLogin"]);
        $_SESSION["messageType"] = null;
        $_SESSION["messageLogin"] = null;
}
echo criaLogin();
echo $rodape;
?>