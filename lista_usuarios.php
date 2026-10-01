<?php
require("config.php");
require("conn.php");



// Buscando usuários e montando o corpo da tabela
$sql = 'SELECT * FROM usuarios';
$result = mysqli_query($conn, $sql);
$main = '<main>
<table class="users-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>E-mail</th>
            <th>Senha (Criptografada)</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>';
if (mysqli_num_rows($result) > 0) {
    $tbody = '';
    while ($row = mysqli_fetch_assoc($result)) {
        $email = $row["email"];
        $senha = md5($row["senha"]);
        $id = $row["id"];
        $tr = "<tr>
            <td>#$id</td>
            <td>$email</td>
            <td>$senha</td>
            <td>
                <div class='actions'>
                    <a class='btn-edit' type='button' href='editar_usuario.php'>Editar</a>
                    <a class='btn-delete' type='button' href='deletar_usuario.php'>Excluir</a>
                </div>
            </td>
        </tr>";
        $tbody .= $tr;
        // echo "Usuário $email com senha $senha está cadastrado no id $id <br><br>";
    }
    $main .= $tbody;
}
else {
    echo "<b>-> Não há registros<b>";
}
$main .= '</tbody>
</table>
</main>';

mysqli_close($conn);







echo criarTopo("Listagem de usuários");
echo $main;
echo $rodape;
?>
