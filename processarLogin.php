<?php
require("conn.php");
require("buscarLogin.php");
session_start();

$login = $_POST["login"];
$senha = md5($_POST["senha"]);

function processarLogin ($login, $senha, $conn) {
    $login = buscarLogin($login, $senha, $conn);
    if (isset($login)) {
        var_dump($login);
        $_SESSION["isLogged"] = true;
        $_SESSION["user"] = $login;
        header("Location: perfil.php");
    }
    else {
        $_SESSION["isLogged"] = false;
        $_SESSION["messageLogin"] = "A senha ou usuário estão incorretos.";
        $_SESSION["messageType"] = "erro";
        header("Location: login.php");
    }

}
processarlogin($login, $senha, $conn);
 

?>