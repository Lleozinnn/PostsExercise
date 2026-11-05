<?php
require "conn.php";
require "config.php";
require "config.postagem.php";

criarTopo("Montar Postagem");

if (@$_GET["act"] == "postar") {
    $titulo = @$_POST["titulo"];
    $descricao = @$_POST["descricao"];
    $result = inserirPostagem($titulo, $descricao, $conn, $_SESSION["user"]["id"]);
    if ($result) {
        echo criaMensagem("sucesso", "Postagem criada com sucesso");
    }
    else {
        echo criaMensagem("erro", "Houve erro ao criar a postagem");
    }
}
else {

}






echo '<main>
    <style>
    .form-postagem {
        max-width: 450px;
        padding: 24px;
        background-color: #f8f9fa;
        border-radius: 8px;
        font-family: system-ui, -apple-system, sans-serif;
        box-sizing: border-box;
    }
    
    .form-postagem label {
        display: block;
        margin-bottom: 6px;
        color: #1e293b;
        font-size: 14px;
        font-weight: 600;
    }
    
    .form-postagem input,
    .form-postagem textarea {
        width: 100%;
        padding: 10px;
        margin-bottom: 18px;
        border: 1px solid #cbd5e1;
        border-radius: 6px;
        background-color: #ffffff;
        box-sizing: border-box;
        font-family: inherit;
        font-size: 14px;
    }
    
    .form-postagem input:focus,
    .form-postagem textarea:focus {
        outline: none;
        border-color: #0f172a;
    }
    
    .form-postagem button {
        width: 100%;
        padding: 12px;
        background-color: #0f172a;
        color: #ffffff;
        border: none;
        border-radius: 6px;
        font-size: 15px;
        font-weight: 500;
        cursor: pointer;
        transition: background-color 0.2s ease;
    }
    
    .form-postagem button:hover {
        background-color: #1e293b;
    }
</style>

<form action="inserirPostagem.php?act=postar" method="POST" class="form-postagem">
    <label for="titulo">Título:</label>
    <input type="text" id="titulo" name="titulo" placeholder="Digite o título da postagem" required>

    <label for="descricao">Descrição:</label>
    <textarea id="descricao" name="descricao" rows="4" placeholder="Digite a descrição da postagem" required></textarea>

    <button type="submit">Cadastrar Postagem</button>
</form>
</main>';








echo $rodape;