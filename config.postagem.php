<?php
// CRUD da postagem

// inserirPostagem($titulo, $descricao, $idUsuario, $conn) {

// };
function deletarPostagem($idPostagem, $conn) {
    $sql = "DELETE FROM postagem WHERE `postagem`.`id` = $idPostagem";
    if (mysqli_query($conn, $sql)) {
        return "Postagem deletada com sucesso.";
    }
    else {
        return "Houve um erro ao deletar a postagem.";
    }
};
// editarPostagem(,$conn) {
    
// }
function listarPostagem($conn) {
    $sql = "SELECT titulo, descricao, data, idUsuario, `postagem`.`nome` AS nome FROM `postagem` INNER JOIN usuarios ON `postagem`.`idUsuario` = `usuarios`.`id`";
    if ($result = mysqli_query($conn, $sql)) {
        return $result;
    }
    else {
        return null;
    }
};