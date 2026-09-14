<?php
require 'config.php';
paginaRestrita(@$_SESSION['isLogged']);
criarTopo("Perfil");
?>
<main>
    <p><?php
        echo "Bem vindo ".@$_SESSION['user'];
    ?></p>
</main>

<?php
echo $rodape;
?>