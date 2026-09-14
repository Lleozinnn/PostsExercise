<?php
include 'config.php';

$main = '    <main>
<article>
    <h2>Título da Postagem 1</h2>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus lacinia odio vitae vestibulum.</p>
</article>        
</main>';

criarTopo("Posts");
echo $main;
echo $rodape;
?>