<?php
require("conn.php");
require("buscarLogin.php");
session_start();

$email = $_POST["email"];
$senha = md5($_POST["senha"]);
$sql = "INSERT usuarios (email, senha) VALUES ('$email','$senha')";
if (buscarCadastro($email, $conn) == null) {
    if (mysqli_query($conn, $sql)) {
        $_SESSION["messageType"] = "sucesso";
        $_SESSION["messageLogin"] = "Usuário cadastrado com sucesso";
        header("Location: form.php");
    } else {
        echo "<b>-> Houve falha no cadastro<b>";
        $_SESSION["messageType"] = "Houve falha no cadastro";
        $_SESSION["messageLogin"] = "erro";
        header("Location: form.php");
    }
}
else {
    $_SESSION["messageType"] = "erro";
    $_SESSION["messageLogin"] = "$email email já foi cadastrado. Realize o cadastro com outro e-mail.";
    header("Location: form.php");
}
mysqli_close($conn);
?>