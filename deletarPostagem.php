<?php

require "conn.php";
require "config.postagem.php";

if (@$_GET["act"] == "deletar") {
    $idPostagem = @$_GET["idPostagem"];
    $result = deletarPostagem($idPostagem, $conn);
    if ($result) {
        $mensagem = "Postagem deletada com sucesso";
        $tipo = "sucesso";
    }
    else {
        $mensagem = "Erro ao deletar postagem";
        $tipo = "erro";
    }
    header("Location: posts.php?mensagem=$mensagem&tipo=$tipo");
}