<?php
// CRUD da postagem

function inserirPostagem($titulo, $descricao, $idUsuario, $conn) {
    $sql = 'INSERT INTO `postagem` (`titulo`, `descricao`, `data`, `idUsuario`) VALUES ("'.$titulo.'", "'.$descricao.'", CURRENT_TIMESTAMP(), '.$idUsuario.')';

    if (mysqli_query($conn, $sql)) {
        return 1;
    }
    else {
        return 0;
    }
};
function deletarPostagem($idPostagem, $conn) {
    $sql = "DELETE FROM postagem WHERE `postagem`.`id` = $idPostagem";
    $result = mysqli_query($conn, $sql);
    return $result;
};
function editarPostagem($titulo, $descricao, $idPostagem, $conn) {
    $sql = "UPDATE postagem SET titulo = '', descricao = '', `data` = CURRENT_TIMESTAMP() WHERE `postagem`.`id` = $idPostagem";
    $result = mysqli_query($conn, $sql);
    return $result;
}

function buscarPostagem ($idPostagem, $conn) {
    $sql = "SELECT titulo, descricao, id FROM postagem WHERE `postagem`.`id` = $idPostagem";
    $result = mysqli_query($conn, $sql);
    return $result;
}

function listarPostagem($conn) {
    $sql = "SELECT 
    postagem.titulo, 
    postagem.descricao, 
    postagem.data, 
    postagem.idUsuario, 
    usuarios.email AS email_usuario,
    postagem.id AS id_postagem
FROM postagem 
INNER JOIN usuarios ON postagem.idUsuario = usuarios.id
";
    if ($result = mysqli_query($conn, $sql)) {
        return $result;
    }
    else {
        echo mysqli_error($conn);
        return null;
    }
};