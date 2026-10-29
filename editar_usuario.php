<?php
require("config.php");
require("buscarLogin.php");
require("conn.php");

$idUser = $_SESSION["user"]["id"];
$email = @$_POST["email"];
$senha = @$_POST["senha"];
var_dump($email, $senha);
if (!empty($email) || !empty($senha)) {
    if($email != "" && $senha != "") { // Altera os dois
        $senha = md5($senha);
        $sql = "UPDATE `usuarios` SET `email` = '$email', `senha` = '$senha' WHERE `usuarios`.`id` = $idUser";
    }
    elseif ($senha != "") { // Altera somente a senha
        $senha = md5($senha);
        $sql = "UPDATE `usuarios` SET `senha` = '$senha' WHERE `usuarios`.`id` = $idUser";
    }
    else { // Altera somente o e-mail
        $sql = "UPDATE `usuarios` SET `email` = '$email' WHERE `usuarios`.`id` = $idUser";
    }
    if (mysqli_query($conn, $sql)) {
        echo "Dados alterados com sucesso!";
        $_SESSION["user"] = buscarCadastro(empty($email) ? $_SESSION["user"]["email"] : $email, $conn);
    }
    else {
        echo "Erro ao atualizar dados.";
    }
}
else {
    echo "Preencha ao menos 1 dos campos para efetuar edição.";
}

criarTopo("Editar Usuario");

criaFormularioEdicao();

echo $rodape;





