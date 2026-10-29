<?php
function buscarLogin ($email, $senha, $conn) {
    $sql = "SELECT id, email FROM `usuarios` WHERE `email` = '$email' AND `senha` = '$senha'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $result = mysqli_fetch_assoc($result);
        return $result;
    }
    return null;
}
function buscarCadastro ($email, $conn) {
    $sql = "SELECT id, email, senha FROM `usuarios` WHERE `email` = '$email'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $result = mysqli_fetch_assoc($result);
        return $result;
    }
    return null;
}