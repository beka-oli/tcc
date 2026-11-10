
<?php
include 'verifica_login.php';
include 'conexao.php';

mysqli_set_charset($conexao, 'utf8mb4');

// Módulos e possíveis nomes das tabelas e páginas de listagem.
$modulos = [
    [
        'titulo' => 'Livros',
        'icone' => 'fa-book-open',
        'tabelas' => ['livros'],
        'paginas' => ['lista_livros.php']
    ],
    [
        'titulo' => 'Revistas',
        'icone' => 'fa-newspaper',
        'tabelas' => ['revistas'],
        'paginas' => ['lista_revistas.php']
    ],
    [
        'titulo' => 'Concursos',
        'icone' => 'fa-trophy',
        'tabelas' => ['concursos'],
        'paginas' => ['lista_concursos.php']
    ],
    [
        'titulo' => 'Inscrições',
        'icone' => 'fa-clipboard-list',
        'tabelas' => ['inscricoes'],
        'paginas' => ['lista_inscricoes.php']
    ],
    [
        'titulo' => 'Resultados',
        'icone' => 'fa-chart-bar',
        'tabelas' => ['resultados'],
        'paginas' => ['lista_resultados.php']
    ],
    [
        'titulo' => 'Autores',
        'icone' => 'fa-users',
        'tabelas' => ['autores'],
        'paginas' => ['lista_autores.php']
    ],
    [
        'titulo' => 'Artigos',
        'icone' => 'fa-file-alt',
        'tabelas' => ['artigos'],
        'paginas' => ['lista_artigos.php']
    ],
    [
        'titulo' => 'Trabalhos Acadêmicos',
        'icone' => 'fa-graduation-cap',
        'tabelas' => ['trabalhos_academicos'],
        'paginas' => ['lista_TA.php', 'lista_ta.php', 'lista_trabalhos.php']
    ],
    [
        'titulo' => 'Editoras',
        'icone' => 'fa-building',
        'tabelas' => ['editoras', 'editora'],
        'paginas' => ['lista_editoras.php', 'lista_editora.php']
    ],
    [
        'titulo' => 'Operadores',
        'icone' => 'fa-user-cog',
        'tabelas' => ['operadores'],
        'paginas' => ['lista_operadores.php']
    ]
];

// Identifica as tabelas existentes no banco.
$tabelasExistentes = [];

$consultaTabelas = mysqli_query($conexao, "
    SELECT TABLE_NAME
    FROM information_schema.TABLES
    WHERE TABLE_SCHEMA = DATABASE()
");

if ($consultaTabelas) {
    while ($linha = mysqli_fetch_assoc($consultaTabelas)) {
        $tabelasExistentes[] = $linha['TABLE_NAME'];
    }
}

// Busca a quantidade de registros de cada módulo.
$totalGeral = 0;
$totalModulos = 0;

foreach ($modulos as &$modulo) {
    $modulo['total'] = 0;
    $modulo['tabela'] = null;
    $modulo['pagina'] = null;

    foreach ($modulo['tabelas'] as $tabela) {
        if (in_array($tabela, $tabelasExistentes, true)) {
            $modulo['tabela'] = $tabela;
            break;
        }
    }

    foreach ($modulo['paginas'] as $pagina) {
        if (is_file(__DIR__ . '/' . $pagina)) {
            $modulo['pagina'] = $pagina;
            break;
        }
    }

    if ($modulo['tabela']) {
        $tabela = $modulo['tabela'];

        $consulta = mysqli_query(
            $conexao,
            "SELECT COUNT(*) AS total FROM `$tabela`"
        );

        if ($consulta) {
            $dados = mysqli_fetch_assoc($consulta);
            $modulo['total'] = (int) $dados['total'];
        }
    }

    if ($modulo['tabela']) {
        $totalGeral += $modulo['total'];
        $totalModulos++;
    }
}
unset($modulo);
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastros | Medeia</title>

    <?php include 'includes_painel/head.php'; ?>

    <style>
        .cadastros-dashboard,
        .cadastros-dashboard * {
            box-sizing: border-box;
        }

        .cadastros-dashboard {
            --vinho: #b91c4b;
            --roxo: #8428ed;
            --texto: #481832;
            --cinza: #806d80;

            min-height: calc(100vh - 88px);
            padding: 55px max(35px, calc((100% - 1450px) / 2)) 65px;
            font-family: 'Inter', sans-serif;
            color: var(--texto);

            background:
                radial-gradient(circle at 82% 5%,
                    rgba(177, 43, 193, .10) 0,
                    transparent 250px),
                linear-gradient(125deg, #fffaff, #f5eafa 65%, #f9e8f2);
        }

        .cadastros-dashboard .intro {
            margin-bottom: 35px;
        }

        .cadastros-dashboard .etiqueta {
            display: inline-flex;
            padding: 12px 23px;
            border-radius: 30px;
            background: #f0ddfc;
            color: #851b85;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 2px;
        }

        .cadastros-dashboard .intro h1 {
            margin: 18px 0 10px;
            font-family: Georgia, serif;
            font-size: clamp(35px, 5vw, 62px);
            font-weight: 700;
            color: #511535;
        }

        .cadastros-dashboard .intro h1 span {
            background: linear-gradient(90deg, #ae174f, #8428ed);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .cadastros-dashboard .intro p {
            max-width: 750px;
            margin: 0;
            color: #80647e;
            font-size: 16px;
            line-height: 1.8;
        }

        .cadastros-dashboard .resumo {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 22px;
            margin-bottom: 45px;
        }

        .cadastros-dashboard .resumo-card {
            display: flex;
            align-items: center;
            gap: 23px;
            min-height: 150px;
            padding: 25px 30px;
            border: 1px solid rgba(255,255,255,.8);
            border-radius: 25px;
            background: rgba(255,255,255,.88);
            box-shadow: 0 14px 40px rgba(83, 28, 75, .07);
        }

        .cadastros-dashboard .icone {
            display: flex;
            flex-shrink: 0;
            align-items: center;
            justify-content: center;
            width: 76px;
            height: 76px;
            border-radius: 21px;
            color: white;
            background: linear-gradient(135deg, #bb174c, #8726e9);
            box-shadow: 0 10px 25px rgba(151, 31, 165, .18);
            font-size: 27px;
        }

        .cadastros-dashboard .resumo-card span {
            display: block;
            color: #765c73;
            font-size: 14px;
        }

        .cadastros-dashboard .resumo-card strong {
            display: block;
            margin: 4px 0;
            color: #bd2055;
            font-size: 37px;
            font-weight: 800;
        }

        .cadastros-dashboard .resumo-card small {
            color: #958095;
            font-size: 12px;
        }

        .cadastros-dashboard .secao-titulo {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 23px;
            font-family: Georgia, serif;
            font-size: 27px;
            font-weight: 500;
            color: #591737;
        }

        .cadastros-dashboard .secao-titulo::before {
            content: "";
            width: 6px;
            height: 34px;
            border-radius: 5px;
            background: linear-gradient(#bd174b, #8428ed);
        }

        .cadastros-dashboard .grade-cadastros {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 22px;
        }

        .cadastros-dashboard .cadastro-card {
            display: flex;
            align-items: center;
            gap: 20px;
            min-width: 0;
            min-height: 155px;
            padding: 25px 23px;
            border: 1px solid rgba(255,255,255,.9);
            border-radius: 24px;
            background: rgba(255,255,255,.91);
            box-shadow: 0 12px 35px rgba(77, 28, 72, .07);
            text-decoration: none;
            transition: transform .25s, box-shadow .25s;
        }

        .cadastros-dashboard a.cadastro-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 18px 38px rgba(117, 35, 113, .14);
        }

        .cadastros-dashboard .cadastro-card .icone {
            width: 68px;
            height: 68px;
            border-radius: 19px;
            font-size: 24px;
        }

        .cadastros-dashboard .cadastro-info {
            min-width: 0;
        }

        .cadastros-dashboard .cadastro-info span {
            display: block;
            margin-bottom: 7px;
            color: #72576f;
            font-size: 14px;
            line-height: 1.4;
        }

        .cadastros-dashboard .cadastro-info strong {
            display: block;
            color: #bd2055;
            font-size: 32px;
            line-height: 1.1;
        }

        .cadastros-dashboard .cadastro-info small {
            display: block;
            margin-top: 8px;
            color: #9b879a;
            font-size: 11px;
        }

        .cadastros-dashboard .cadastro-card.indisponivel {
            opacity: .55;
            cursor: not-allowed;
        }

        .cadastros-dashboard .rodape-info {
            margin-top: 30px;
            padding: 18px 22px;
            border: 1px solid #ead9ed;
            border-radius: 15px;
            background: rgba(255,255,255,.55);
            color: #806d80;
            font-size: 12px;
        }

        @media (max-width: 1150px) {
            .cadastros-dashboard .grade-cadastros {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 750px) {
            .cadastros-dashboard {
                padding: 35px 20px;
            }

            .cadastros-dashboard .resumo {
                grid-template-columns: 1fr;
            }

            .cadastros-dashboard .grade-cadastros {
                grid-template-columns: 1fr;
            }

            .cadastros-dashboard .intro h1 {
                font-size: 39px;
            }

            .cadastros-dashboard .cadastro-card {
                min-height: 125px;
            }
        }
    </style>
</head>

<body>

<?php include 'includes_painel/header.php'; ?>

<main class="cadastros-dashboard">

    <section class="intro">
        <span class="etiqueta">PAINEL ADMINISTRATIVO</span>

        <h1>Central de <span>Cadastros</span></h1>

        <p>
            Gerencie e acompanhe todos os registros da plataforma
            Medeia em um único lugar.
        </p>
    </section>

    <section class="resumo">

        <div class="resumo-card">
            <div class="icone">
                <i class="fas fa-database"></i>
            </div>

            <div>
                <span>Total de Registros</span>
                <strong><?= number_format($totalGeral, 0, ',', '.') ?></strong>
                <small>Cadastros realizados</small>
            </div>
        </div>

        <div class="resumo-card">
            <div class="icone">
                <i class="fas fa-layer-group"></i>
            </div>

            <div>
                <span>Módulos Cadastrados</span>
                <strong><?= $totalModulos ?></strong>
                <small>Tipos de cadastros disponíveis</small>
            </div>
        </div>

        <div class="resumo-card">
            <div class="icone">
                <i class="fas fa-chart-pie"></i>
            </div>

            <div>
                <span>Cadastros Ativos no Painel</span>
                <strong><?= count(array_filter($modulos, fn($m) => $m['tabela'] !== null)) ?></strong>
                <small>Módulos com tabelas identificadas</small>
            </div>
        </div>

    </section>

    <section>
        <h2 class="secao-titulo">Todos os Cadastros</h2>

        <div class="grade-cadastros">

            <?php foreach ($modulos as $modulo): ?>

                <?php
                    $disponivel = $modulo['pagina'] !== null;
                    $url = $disponivel ? $modulo['pagina'] : '#';
                ?>

                <a
                    href="<?= htmlspecialchars($url, ENT_QUOTES, 'UTF-8') ?>"
                    class="cadastro-card <?= !$disponivel ? 'indisponivel' : '' ?>"
                    <?= !$disponivel ? 'aria-disabled="true" onclick="return false;"' : '' ?>
                >

                    <div class="icone">
                        <i class="fas <?= $modulo['icone'] ?>"></i>
                    </div>

                    <div class="cadastro-info">

                        <span><?= htmlspecialchars($modulo['titulo'], ENT_QUOTES, 'UTF-8') ?></span>

                        <strong>
                            <?= number_format($modulo['total'], 0, ',', '.') ?>
                        </strong>

                        <small>
                            <?php if (!$modulo['tabela']): ?>
                                Tabela não encontrada
                            <?php elseif (!$disponivel): ?>
                                Listagem não localizada
                            <?php else: ?>
                                <?= $modulo['total'] === 1 ? '1 registro cadastrado' : 'Registros cadastrados' ?>
                            <?php endif; ?>
                        </small>

                    </div>

                </a>

            <?php endforeach; ?>

        </div>
    </section>

    <div class="rodape-info">
        <i class="fas fa-info-circle"></i>
        Os totais são atualizados automaticamente conforme os registros
        existentes no banco de dados.
    </div>

</main>

<?php include 'includes_painel/footer.php'; ?>

</body>
</html>
