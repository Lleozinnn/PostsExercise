<?php
require("conn.php");
session_start();

$id = @$_SESSION["user"]["id"];
if (isset($id)) {


    $sql = "DELETE FROM `usuarios` WHERE `usuarios`.`id` = $id";

    if (mysqli_query($conn, $sql)) {
        $_SESSION["messageType"] = "sucesso";
        $_SESSION["messageLogin"] = "Usuário deletado com sucesso";
        session_destroy();
        session_start();
        header("Location: form.php");
    } else {
        echo "<b>-> Houve falha na deleção<b>";
        $_SESSION["messageType"] = "Houve uma falha. Usuário não deletado.";
        $_SESSION["messageLogin"] = "erro";
        header("Location: form.php");
    }
    var_dump($_SESSION);
    mysqli_close($conn);
} else {
    echo "<b>-> Id não fornecido.<b>";
}
?>