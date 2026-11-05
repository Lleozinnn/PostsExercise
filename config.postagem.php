<?php
// CRUD da postagem

function inserirPostagem($titulo, $descricao, $idUsuario, $conn) {
    $sql = "INSERT INTO `postagem` (`titulo`, `descricao`, `data`, `idUsuario`) VALUES ('$titulo', '$descricao', 'NOW()', $idUsuario)";
    //
    echo $sql;

    if (mysqli_query($conn, $sql)) {
        return 1;
    }
    else {
        return 0;
    }
};
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
    $sql = "SELECT 
    postagem.titulo, 
    postagem.descricao, 
    postagem.data, 
    postagem.idUsuario, 
    usuarios.email AS email_usuario
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