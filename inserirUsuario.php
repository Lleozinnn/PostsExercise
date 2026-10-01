<?php
require("conn.php");
session_start();

$email = $_POST["email"];
$senha = $_POST["senha"];
$sql = "INSERT usuarios (email, senha) VALUES ('$email','$senha')";

if (mysqli_query($conn, $sql)) {
    $_SESSION["messageType"] = "sucesso";
    $_SESSION["messageLogin"] = "Usuário cadastrado com sucesso";
    header("Location: form.php");
}
else {
    echo "<b>-> Houve falha no cadastro<b>";
    $_SESSION["messageType"] = "Houve falha no cadastro";
    $_SESSION["messageLogin"] = "erro";
    header("Location: form.php");
}

mysqli_close($conn);
?>
