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
                </nav>
            </header>';
    }
    else {
        $additionalCss = "";
        if (basename($_SERVER['PHP_SELF']) == "login.php") $additionalCss = '<link rel="stylesheet" href="login.css">';
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
?>