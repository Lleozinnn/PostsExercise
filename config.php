<?php
session_start();
function paginaRestrita($logado, $pagina = "login.php", $mensagem = "Você está logado.", $tipoMensagem = "sucesso") {
if ($logado) {
    $_SESSION["messageLogin"] = $mensagem;  
    $_SESSION["messageType"] = $tipoMensagem;
}
else {
    header("Location: $pagina");
}
}
function criarTopo ($titulo) {
    $isLogged = @$_SESSION["isLogged"];
    $topo = criaMenu($isLogged, $titulo);
    echo $topo;
}
function linkAtivo ($link) {
    $resposta = "";

    if ($link == basename($_SERVER['PHP_SELF'])) $resposta = "ativo";
    else $resposta = "";

    return $resposta;
}
function criarLinkMenu ($pagina, $conteudoTag, $icone) {
    $link = '<a class="btn '.linkAtivo($pagina).'" href="'.$pagina.'"><ion-icon name="'.$icone.'"></ion-icon>'.$conteudoTag.'</a>';
    return $link;
}
function criaMenu ($status = false, $titulo) {
    $topo = "";
    if ($status) {
        $topo = '<!DOCTYPE html>
        <html lang="pt-BR">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Site de Postagens - '.$titulo.'</title>
            <link rel="stylesheet" href="styles.css">
        </head>
        <body>
            <header>
                <div class="dflex-center">
                    <img src="img/logo.png">
                    <h1>'.$titulo.'</h1>
                </div>
                <nav>
                    '.criarLinkMenu("perfil.php","Perfil", 'person-outline' ).'            
                    '.criarLinkMenu("posts.php", "Cadastrar Postagem", 'add-outline').'    
                    '.criarLinkMenu("sair.php", "Sair", 'exit-outline').'
                    '.criarLinkMenu("deletar_usuario.php", "Excluir dados", 'person-remove-outline').'    
                    '.criarLinkMenu("editar_usuario.php", "Editar dados", 'brush-outline').'    
                </nav>
            </header>';
    }
    else {
        $additionalCss = "";
        if (basename($_SERVER['PHP_SELF']) == "login.php" || basename($_SERVER['PHP_SELF']) == "form.php") $additionalCss = '<link rel="stylesheet" href="login.css">';
        if (basename($_SERVER['PHP_SELF']) == "lista_usuarios.php") $additionalCss = '<link rel="stylesheet" href="lista_usuarios.css">';
        $topo = '<!DOCTYPE html>
        <html lang="pt-BR">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Site de Postagens - '.$titulo.'</title>
            <link rel="stylesheet" href="styles.css">
            '. $additionalCss .'
        </head>
        <body>
            <header>
                <div class="dflex-center">
                    <img src="img/logo.png">
                    <h1>'.$titulo.'</h1>
                </div>
                <nav>
                    '.criarLinkMenu("posts.php", "Postagens", "document-outline").'
                    '.criarLinkMenu("login.php", "Acessar", "lock-closed-outline").'
                    '.criarLinkMenu("contato.php", "Contatos", "paper-plane-outline").'
                    '.criarLinkMenu("index.php", "Principal", "home-outline").'
                </nav>
                <div>
                '.criarPesquisa("https://www.google.com/search", "q", "Google", "google").'
                '.criarPesquisa("https://br.pinterest.com/search/pins/", "q", "Pinterest", "pinterest").'
                '.criarPesquisa("https://www.youtube.com/results", "search_query", "YouTube", "youtube").'
                </div>
                
            </header>';
    }
    return $topo;
}
$rodape = ' <footer class="dflex-center">
    <p>&copy; 2024 Postagens. Todos os direitos reservados.</p>
</footer>

<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>    
</body>
</html>';


function criarPesquisa ($action, $name, $nome, $logo) {
    $pesq = '
        <form action="'.$action.'" method="get" class="formPesq">
            <ion-icon name="logo-'.$logo.'"></ion-icon>
            <input type="text" placeholder="Pesquise no '.$nome.'!" name="'.$name.'">
            <button><ion-icon name="search-outline"></ion-icon></button>
        </form>
    ';
    return $pesq;
}
function criaMensagem ($tipo = "sucesso", $mensagem) {
    $elMensagem = "";
    if ($tipo == "sucesso") {
        $elMensagem = '<p class="msg sucesso" id="mensagem">'.$mensagem.'</p>';
    }
    else {
        $elMensagem = '<p class="msg erro" id="mensagem">'.$mensagem.'</p>';
    }
    return $elMensagem;
}
function criaCadastro () {
    return '<main>
  <form class="login-form" action="inserirUsuario.php" method="POST">
    <div class="login-form__header">
        <span class="login-form__tag">CADASTRO</span>
        <h2>Cadastrar</h2>
        <p>Informe seus dados para acessar o sistema.</p>
    </div>
    <div class="login-form__group">
        <label for="login">E-mail</label>
        <input type="text" id="login" name="email" placeholder="Digite seu login" autocomplete="username" required>
    </div>
    <div class="login-form__group">
        <label for="senha">Senha</label>
        <input type="password" id="senha" name="senha" placeholder="Digite sua senha" autocomplete="current-password" required>
    </div>
    <button type="submit" class="login-form__submit">Cadastrar</button>
</form>
</main>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        let mensagem = document.querySelector("#mensagem");
        setTimeout(() => {
            mensagem.remove();
        }, 7000);
    })
</script>';
}
function criaLogin () {
    return '<main>
  <form class="login-form" action="processarLogin.php" method="POST">
    <div class="login-form__header">
        <span class="login-form__tag">ÁREA RESTRITA</span>
        <h2>Acessar</h2>
        <p>Informe seus dados para acessar o sistema.</p>
    </div>
    <div class="login-form__group">
        <label for="login">Login</label>
        <input type="text" id="login" name="login" placeholder="Digite seu login" autocomplete="username" required>
    </div>
    <div class="login-form__group">
        <label for="senha">Senha</label>
        <input type="password" id="senha" name="senha" placeholder="Digite sua senha" autocomplete="current-password" required>
    </div>
    <button type="submit" class="login-form__submit">Entrar</button>
</form>
</main>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        let mensagem = document.querySelector("#mensagem");
        setTimeout(() => {
            mensagem.remove();
        }, 7000);
    })
</script>';
}
function criaFormularioEdicao () {
    echo '<style>
  main {
    height: 100%;
    // max-width: 400px;
    margin: 40px auto;
    padding: 24px;
    background-color: #ffffff;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
  }

  main form .form-group {
    margin-bottom: 16px;
  }

  main form label {
    display: block;
    margin-bottom: 6px;
    color: #555555;
    font-size: 14px;
    font-weight: 500;
  }

  main form input {
    width: 100%;
    padding: 10px 12px;
    border: 1px solid #cccccc;
    border-radius: 4px;
    font-size: 14px;
    outline: none;
    transition: border-color 0.2s;
    box-sizing: border-box;
  }

  main form input:focus {
    border-color: #007bff;
  }

  main form button {
    width: 100%;
    padding: 12px;
    background-color: #007bff;
    color: #ffffff;
    border: none;
    border-radius: 4px;
    font-size: 16px;
    font-weight: bold;
    cursor: pointer;
    transition: background-color 0.2s;
  }

  main form button:hover {
    background-color: #0056b3;
  }
</style>

<main>
  <form action="editar_usuario.php" method="POST">
    <div class="form-group">
      <label for="email">E-mail</label>
      <input type="text" id="email" name="email">
    </div>
    <div class="form-group">
      <label for="senha">Senha</label>
      <input type="text" id="senha" name="senha">
    </div>
    <button type="submit">Salvar</button>
  </form>
</main>';
}
?>