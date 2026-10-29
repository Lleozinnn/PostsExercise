<?php
require("conn.php");
require("config.php");

// session_start();




$titulo = @$_POST["titulo"];
$descricao = @$_POST["descricao"];

function inserirPostagem($titulo, $descricao, $conn, $idUsuario) {
    $sql = "INSERT INTO `postagem` (`titulo`, `descricao`, `data`, `idUsuario`) VALUES ('$titulo', '$descricao', NOW(), $idUsuario)";
    if (!empty($titulo) || !empty($descricao)) { // Case descrição e titulo
        if (mysqli_query($conn, $sql)) {
            return "Postagem efetuada com sucesso";
        }
        else {
            return "Houve um erro ao efetuar postagem";
        }
    }
    else {
        return "Preencha o campo descrição e titulo";
    }
}


if (isset($titulo) && isset($descricao)) {
    echo inserirPostagem($titulo, $descricao, $conn, $_SESSION["user"]["id"]);
}

mysqli_close($conn);

criarTopo("Cadastrar Postagem");
criaPostagem($_SESSION["user"]["email"]);
echo $rodape;
