<?php

include 'config.php';
require 'conn.php';
require "config.postagem.php";

// Caso o formulário seja enviado, tenta editar antes mesmo
// de construir a tela.

if (@$_GET["act"] == "editar" && isset($_GET["idPostagem"])) {
    $titulo = @$_POST["titulo"];
    $descricao = @$_POST["descricao"];
    $idPostagem = @$_GET["idPostagem"];
    $result = editarPostagem($titulo, $descricao, $idPostagem, $conn);
    
    if ($result) {
        header("Location: posts.php#post$idPostagem");
    }
    else {
        echo mysqli_error($conn);
        echo criaMensagem("erro", "Houve erro ao editar a postagem");
    }
}


// Busca rápida para trazer os dados da postagem
$postagem = mysqli_fetch_assoc(buscarPostagem($_GET["idPostagem"], $conn));

criarTopo("Editar Postagem");
echo '
    <style>
    /* Reset básico de caixa e fontes */
main > * {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
  font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
}

/* Container Principal */
.container {
  background-color: #ffffff;
  height: 100%;
  padding: 28px;
  border-radius: 12px;
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
  margin: 10px;
}

/* Avatar e Perfil */
.user-profile {
  display: flex;
  align-items: center;
  gap: 16px;
  margin-bottom: 24px;
  padding-bottom: 16px;
  border-bottom: 1px solid #eaeaea;
}

.avatar {
  width: 64px;
  height: 64px;
  border-radius: 50%;
  object-fit: cover;
  border: 2px solid #0066cc;
}

.user-name {
  font-size: 1.2rem;
  font-weight: 600;
  color: #222;
}

/* Formulário */
.post-form {
  display: flex;
  flex-direction: column;
  gap: 18px;
}

.form-group {
  display: flex;
  flex-direction: column;
  gap: 6px;
}

.form-group label {
  font-size: 0.9rem;
  font-weight: 600;
  color: #555;
}

.form-group input,
.form-group textarea {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 8px;
  font-size: 0.95rem;
  transition: border-color 0.2s, box-shadow 0.2s;
  outline: none;
}

.form-group textarea {
  resize: vertical;
  min-height: 100px;
}

/* Efeito ao focar no campo */
.form-group input:focus,
.form-group textarea:focus {
  border-color: #0066cc;
  box-shadow: 0 0 0 3px rgba(0, 102, 204, 0.15);
}

/* Botão de Envio */
.btn-submit {
  background-color: #0066cc;
  color: #ffffff;
  padding: 12px;
  border: none;
  border-radius: 8px;
  font-size: 1rem;
  font-weight: 600;
  cursor: pointer;
  transition: background-color 0.2s;
}

.btn-submit:hover {
  background-color: #004e9a;
}

.btn-submit:disabled {
  background-color: #a0a0a0;
  cursor: not-allowed;
}
    </style>
    <main class="container">
  <!-- Cabeçalho do Perfil / Avatar -->
  <section class="user-profile">
    <img 
      src="https://via.placeholder.com/100" 
      alt="Foto de perfil do usuário" 
      class="avatar"
    >
    <h1 class="user-name">' . $_SESSION["user"]["email"] . '</h1>
  </section>

  <!-- Formulário de Envio -->
  <form action="editarPostagem.php?act=editar&idPostagem='. $postagem["id"] .'" method="POST" class="post-form" id="postForm">
    <div class="form-group">
      <label for="titulo">Título</label>
      <input 
        type="text"
        value="'. $postagem["titulo"] .'" 
        id="titulo" 
        name="titulo" 
        placeholder="Digite o título aqui..." 
        required
        maxlength="100"
      >
    </div>

    <div class="form-group">
      <label for="descricao">Descrição</label>
      <textarea 
        id="descricao" 
        name="descricao" 
        rows="5" 
        placeholder="Escreva a descrição detalhada..." 
        required
      >'. $postagem["descricao"] .'</textarea>
    </div>

    <button type="submit" class="btn-submit">Editar</button>
  </form>
</main>';
