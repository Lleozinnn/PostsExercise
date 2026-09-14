<?php
require 'config.php';
if (@$_SESSION['isLogged']) {
    $_SESSION["messageLogin"] = null;
    $_SESSION["messageType"] = null;
    header("Location: perfil.php");
}
criarTopo("Login");
if (@$_SESSION["messageLogin"]) {
        echo criaMensagem($_SESSION["messageType"], $_SESSION["messageLogin"]);
        $_SESSION["messageType"] = null;
        $_SESSION["messageLogin"] = null;
}
?>
<main>
    <?php
    
    
    ?>
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
</script>
<?php
echo $rodape;
?>