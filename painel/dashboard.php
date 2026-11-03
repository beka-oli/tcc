<?php
    include('verifica_login.php');
    include('conexao.php');

    function total($sql) {
        global $conexao;
        $r = mysqli_query($conexao, $sql);
        return $r ? (mysqli_fetch_assoc($r)['total'] ?? 0) : 0;
    }

    $total_livros      = total("SELECT COUNT(*) total FROM livros");
    $total_revistas    = total("SELECT COUNT(*) total FROM revistas");
    $total_concursos   = total("SELECT COUNT(*) total FROM concursos");
    $destaque_livros   = total("SELECT COUNT(*) total FROM livros WHERE destaque = 1");
    $destaque_revistas = total("SELECT COUNT(*) total FROM revistas WHERE destaque = 1");
    $concursos_abertos = total("SELECT COUNT(*) total FROM concursos WHERE status = 'Aberto'");
    $total_destaques   = $destaque_livros + $destaque_revistas;

    $cards = [
        ['fa-book', 'Total de Livros', $total_livros, 'Livros cadastrados'],
        ['fa-newspaper', 'Total de Revistas', $total_revistas, 'Revistas cadastradas'],
        ['fa-file-alt', 'Total de Concursos', $total_concursos, 'Concursos cadastrados'],
        ['fa-calendar-check', 'Concursos Abertos', $concursos_abertos, 'Inscrições abertas']
    ];

    $destaques = [
        ['fa-star', 'Itens em Destaque', $total_destaques, 'Livros e revistas'],
        ['fa-book-open', 'Livros em Destaque', $destaque_livros, 'Livros destacados'],
        ['fa-newspaper', 'Revistas em Destaque', $destaque_revistas, 'Revistas destacadas']
    ];
?>
<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Dashboard | Medeia</title>
        <?php include 'includes_painel/head.php'; ?>
    </head>
    <body>
        <?php include 'includes_painel/header.php'; ?>
        <main class="dashboard">
            <div class="dashboard-container">
                <div class="dashboard-title">
                    <div class="dashboard-tag">Painel administrativo</div>
                    <h1>Dashboard <span>Medeia</span></h1>
                    <p> Visão geral da plataforma Medeia, com informações sobre livros, revistas, concursos e conteúdos em destaque.</p>
                </div>
                <div class="dashboard-grid">
                    <?php foreach ($cards as $card): ?>
                        <div class="dashboard-card">
                            <div class="dashboard-icon">
                                <i class="fas <?= $card[0] ?>"></i>
                            </div>
                            <div>
                                <h6><?= $card[1] ?></h6>
                                <h2><?= $card[2] ?></h2>
                                <small><?= $card[3] ?></small>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="section-title">
                    <h3>Conteúdos em destaque</h3>
                </div>
                <div class="dashboard-grid-secondary">
                    <?php foreach ($destaques as $card): ?>
                        <div class="dashboard-card">
                            <div class="dashboard-icon">
                                <i class="fas <?= $card[0] ?>"></i>
                            </div>
                            <div>
                                <h6><?= $card[1] ?></h6>
                                <h2><?= $card[2] ?></h2>
                                <small><?= $card[3] ?></small>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </main>
        <?php include 'includes_painel/footer.php'; ?>
    </body>
 </html>