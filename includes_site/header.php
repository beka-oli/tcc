
<?php
$paginaAtual = basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?? '');

$paginaInicial = in_array($paginaAtual, ['', 'tcc', 'index.php'], true);

$menu = [
    ['texto' => 'Início', 'icone' => 'fa-house', 'url' => '/tcc/', 'inicio' => true],
    ['texto' => 'Sobre', 'icone' => 'fa-circle-info', 'url' => '/tcc/sobre.php'],
    ['texto' => 'Serviços', 'icone' => 'fa-layer-group', 'url' => '/tcc/servicos.php'],
    ['texto' => 'Publicações', 'icone' => 'fa-book-open', 'url' => '/tcc/publicacoes.php'],
    ['texto' => 'Contato', 'icone' => 'fa-envelope', 'url' => '/tcc/contato.php']
];
?>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">



<header class="medeia-header">
    <div class="mh-inner">

        <a href="/tcc/" class="mh-brand" aria-label="Medeia - Página inicial">
            <img
                src="/tcc/midias/img/logo.png"
                alt="Logo Medeia"
                class="mh-logo"
            >
            <span class="mh-divider" aria-hidden="true"></span>
            <span class="mh-identity">
                <span class="mh-name">Medeia</span>
                <span class="mh-caption">Associação Científica</span>
            </span>
        </a>

        <nav class="mh-nav" aria-label="Navegação principal">
            <?php foreach ($menu as $item):
                $ativo = !empty($item['inicio'])
                    ? $paginaInicial
                    : $paginaAtual === basename($item['url']);
            ?>
                <a
                    href="<?= htmlspecialchars($item['url'], ENT_QUOTES, 'UTF-8') ?>"
                    class="mh-link<?= $ativo ? ' mh-active' : '' ?>"
                    <?= $ativo ? 'aria-current="page"' : '' ?>
                >
                    <i class="fa-solid <?= htmlspecialchars($item['icone'], ENT_QUOTES, 'UTF-8') ?>" aria-hidden="true"></i>
                    <span><?= htmlspecialchars($item['texto'], ENT_QUOTES, 'UTF-8') ?></span>
                </a>
            <?php endforeach; ?>

            <a href="/tcc/login/" class="mh-link mh-admin">
                <i class="fa-solid fa-right-to-bracket" aria-hidden="true"></i>
                <span>Admin</span>
            </a>
        </nav>

    </div>
</header>
