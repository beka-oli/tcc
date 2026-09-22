<?php
$mods = require __DIR__.'/../config_crud/modulos.php';
$grupos = [
 'Publicações'=>['revistas','livros','autores','artigos','trabalhos_academicos'],
 'Concursos'=>['concursos','inscricoes','resultados']
];
?>
<nav class="medeia-header"><div class="medeia-container">
<a href="dashboard.php" class="logo"><img src="midias/logo.png" alt="Medeia"></a>
<div class="menu"><a href="dashboard.php" class="item"><i class="fa-solid fa-house"></i> Início</a>
<?php foreach($grupos as $grupo=>$itens): ?><div class="dropdown"><button class="item" type="button"><i class="fa-solid fa-folder-open"></i> <?=h($grupo)?> <i class="fa-solid fa-chevron-down seta"></i></button><div class="dropdown-box"><strong>Gerenciar</strong><?php foreach($itens as $slug): if(isset($mods[$slug])): ?><a href="crud/index.php?modulo=<?=h($slug)?>"><?=h($mods[$slug]['titulo'])?></a><?php endif; endforeach; ?></div></div><?php endforeach; ?></div>
<a href="logout.php" class="sair"><i class="fa-solid fa-right-from-bracket"></i> Sair</a></div></nav>
