
<?php
include 'verifica_login.php';
include 'conexao.php';

mysqli_set_charset($conexao, 'utf8mb4');

/**
 * Helpers para consultar tabelas e colunas sem gerar avisos
 * quando algum módulo ainda não foi criado no banco.
 */
function tabelaExiste(string $tabela): bool {
    global $conexao;

    $tabela = mysqli_real_escape_string($conexao, $tabela);
    $resultado = mysqli_query($conexao, "SHOW TABLES LIKE '{$tabela}'");

    return $resultado && mysqli_num_rows($resultado) > 0;
}

function colunaExiste(string $tabela, string $coluna): bool {
    global $conexao;

    if (!tabelaExiste($tabela)) {
        return false;
    }

    $tabela = str_replace('`', '', $tabela);
    $coluna = mysqli_real_escape_string($conexao, $coluna);

    $resultado = mysqli_query(
        $conexao,
        "SHOW COLUMNS FROM `{$tabela}` LIKE '{$coluna}'"
    );

    return $resultado && mysqli_num_rows($resultado) > 0;
}

function contar(string $tabela, ?string $condicao = null): int {
    global $conexao;

    if (!tabelaExiste($tabela)) {
        return 0;
    }

    $tabela = str_replace('`', '', $tabela);
    $sql = "SELECT COUNT(*) AS total FROM `{$tabela}`";

    if ($condicao !== null) {
        $sql .= " WHERE {$condicao}";
    }

    $resultado = mysqli_query($conexao, $sql);

    if (!$resultado) {
        return 0;
    }

    $dados = mysqli_fetch_assoc($resultado);

    return (int) ($dados['total'] ?? 0);
}

function numero(int $valor): string {
    return number_format($valor, 0, ',', '.');
}

/* =====================================================
   INDICADORES PRINCIPAIS
===================================================== */

$total_livros = contar('livros');
$total_edicoes = contar('edicoes_revistas');
$total_concursos = contar('concursos');

$destaque_livros = colunaExiste('livros', 'destaque')
    ? contar('livros', 'destaque = 1') : 0;

$destaque_edicoes = colunaExiste('edicoes_revistas', 'destaque')
    ? contar('edicoes_revistas', 'destaque = 1') : 0;

$concursos_abertos = colunaExiste('concursos', 'status')
    ? contar('concursos', "status = 'Aberto'") : 0;

$total_destaques = $destaque_livros + $destaque_edicoes;


/* =====================================================
   MÓDULOS DA CENTRAL DE CADASTROS
===================================================== */

$modulos = [

    [
        'titulo' => 'Livros',
        'icone' => 'fa-book-open',
        'tabelas' => ['livros'],
        'paginas' => ['lista_livros.php']
    ],

    [
        'titulo' => 'Edições de Revistas',
        'icone' => 'fa-newspaper',
        'tabelas' => ['edicoes_revistas'],
        'paginas' => ['lista_edicoes_revistas.php']
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
        'paginas' => [
            'lista_TA.php',
            'lista_ta.php',
            'lista_trabalhos.php'
        ]
    ],

    [
        'titulo' => 'Operadores',
        'icone' => 'fa-user-cog',
        'tabelas' => ['operadores'],
        'paginas' => ['lista_operadores.php']
    ]

];


/* =====================================================
   IDENTIFICAÇÃO DAS TABELAS E PÁGINAS
===================================================== */

$total_geral = 0;
$total_modulos = 0;

foreach ($modulos as &$modulo) {

    $modulo['tabela'] = null;
    $modulo['pagina'] = null;
    $modulo['total'] = 0;

    foreach ($modulo['tabelas'] as $tabela) {

        if (tabelaExiste($tabela)) {
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

    if ($modulo['tabela'] !== null) {

        $modulo['total'] = contar($modulo['tabela']);

        $total_geral += $modulo['total'];
        $total_modulos++;

    }

}

unset($modulo);


/* =====================================================
   CARDS PRINCIPAIS
===================================================== */

$cards_principais = [

    [
        'fa-book',
        'Total de Livros',
        $total_livros,
        'Livros cadastrados'
    ],

    [
        'fa-newspaper',
        'Total de Edições',
        $total_edicoes,
        'Edições cadastradas'
    ],

    [
        'fa-file-alt',
        'Total de Concursos',
        $total_concursos,
        'Concursos cadastrados'
    ],

    [
        'fa-calendar-check',
        'Concursos Abertos',
        $concursos_abertos,
        'Com inscrições abertas'
    ]

];


/* =====================================================
   CARDS DE DESTAQUES
===================================================== */

$cards_destaques = [

    [
        'fa-star',
        'Itens em Destaque',
        $total_destaques,
        'Livros e edições'
    ],

    [
        'fa-book-open',
        'Livros em Destaque',
        $destaque_livros,
        'Livros destacados'
    ],

    [
        'fa-newspaper',
        'Edições em Destaque',
        $destaque_edicoes,
        'Edições destacadas'
    ]

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

            <header class="dashboard-title">

                <span class="dashboard-tag">
                    Painel administrativo
                </span>

                <h1>
                    Dashboard <span>Medeia</span>
                </h1>

                <p>
                    Visão geral da plataforma Medeia. Acompanhe os principais
                    indicadores e acesse rapidamente todos os módulos de cadastro.
                </p>

            </header>


            <!-- INDICADORES PRINCIPAIS -->

            <section aria-label="Indicadores principais">

                <div class="dashboard-grid">

                    <?php foreach ($cards_principais as $card): ?>

                        <article class="dashboard-card">

                            <div class="dashboard-icon">

                                <i class="fas <?= htmlspecialchars(
                                    $card[0],
                                    ENT_QUOTES,
                                    'UTF-8'
                                ) ?>"></i>

                            </div>

                            <div class="dashboard-card-info">

                                <h2 class="dashboard-label">
                                    <?= htmlspecialchars(
                                        $card[1],
                                        ENT_QUOTES,
                                        'UTF-8'
                                    ) ?>
                                </h2>

                                <strong class="dashboard-number">
                                    <?= numero((int) $card[2]) ?>
                                </strong>

                                <small>
                                    <?= htmlspecialchars(
                                        $card[3],
                                        ENT_QUOTES,
                                        'UTF-8'
                                    ) ?>
                                </small>

                            </div>

                        </article>

                    <?php endforeach; ?>

                </div>

            </section>


            <!-- CONTEÚDOS EM DESTAQUE -->

            <section
                class="dashboard-section"
                aria-labelledby="titulo-destaques"
            >

                <div class="section-title">

                    <h2 id="titulo-destaques">
                        Conteúdos em destaque
                    </h2>

                </div>

                <div class="dashboard-grid-secondary">

                    <?php foreach ($cards_destaques as $card): ?>

                        <article class="dashboard-card dashboard-card-compact">

                            <div class="dashboard-icon">

                                <i class="fas <?= htmlspecialchars(
                                    $card[0],
                                    ENT_QUOTES,
                                    'UTF-8'
                                ) ?>"></i>

                            </div>

                            <div class="dashboard-card-info">

                                <h2 class="dashboard-label">
                                    <?= htmlspecialchars(
                                        $card[1],
                                        ENT_QUOTES,
                                        'UTF-8'
                                    ) ?>
                                </h2>

                                <strong class="dashboard-number">
                                    <?= numero((int) $card[2]) ?>
                                </strong>

                                <small>
                                    <?= htmlspecialchars(
                                        $card[3],
                                        ENT_QUOTES,
                                        'UTF-8'
                                    ) ?>
                                </small>

                            </div>

                        </article>

                    <?php endforeach; ?>

                </div>

            </section>


            <!-- CENTRAL DE CADASTROS -->

            <section
                class="dashboard-section"
                aria-labelledby="titulo-cadastros"
            >

                <div class="dashboard-section-heading">

                    <div class="section-title">

                        <h2 id="titulo-cadastros">
                            Central de cadastros
                        </h2>

                    </div>

                    <p>
                        Todos os módulos da plataforma em um só lugar.
                    </p>

                </div>


                <!-- RESUMO GERAL -->

                <div class="dashboard-summary">

                    <article class="dashboard-summary-card">

                        <span class="dashboard-summary-icon">
                            <i class="fas fa-database"></i>
                        </span>

                        <div>

                            <small>Total de registros</small>

                            <strong>
                                <?= numero($total_geral) ?>
                            </strong>

                            <span>
                                Registros nas tabelas identificadas
                            </span>

                        </div>

                    </article>


                    <article class="dashboard-summary-card">

                        <span class="dashboard-summary-icon">
                            <i class="fas fa-layer-group"></i>
                        </span>

                        <div>

                            <small>Módulos cadastrados</small>

                            <strong>
                                <?= numero($total_modulos) ?>
                            </strong>

                            <span>
                                Tipos de cadastro encontrados
                            </span>

                        </div>

                    </article>


                    <article class="dashboard-summary-card">

                        <span class="dashboard-summary-icon">
                            <i class="fas fa-list-check"></i>
                        </span>

                        <div>

                            <small>Módulos disponíveis</small>

                            <strong>
                                <?= numero(count(array_filter(
                                    $modulos,
                                    function ($m) {
                                        return $m['pagina'] !== null;
                                    }
                                ))) ?>
                            </strong>

                            <span>
                                Com página de listagem localizada
                            </span>

                        </div>

                    </article>

                </div>


                <!-- CARDS DOS MÓDULOS -->

                <div class="dashboard-modules">

                    <?php foreach ($modulos as $modulo): ?>

                        <?php

                            $disponivel = $modulo['pagina'] !== null
                                && $modulo['tabela'] !== null;

                            $url = $disponivel
                                ? $modulo['pagina']
                                : '#';

                        ?>

                        <a
                            href="<?= htmlspecialchars(
                                $url,
                                ENT_QUOTES,
                                'UTF-8'
                            ) ?>"
                            class="dashboard-module-card <?= !$disponivel ? 'is-unavailable' : '' ?>"
                            <?= !$disponivel
                                ? 'aria-disabled="true" tabindex="-1" onclick="return false;"'
                                : '' ?>
                        >

                            <span class="dashboard-module-icon">

                                <i class="fas <?= htmlspecialchars(
                                    $modulo['icone'],
                                    ENT_QUOTES,
                                    'UTF-8'
                                ) ?>"></i>

                            </span>


                            <span class="dashboard-module-content">

                                <span class="dashboard-module-name">

                                    <?= htmlspecialchars(
                                        $modulo['titulo'],
                                        ENT_QUOTES,
                                        'UTF-8'
                                    ) ?>

                                </span>

                                <strong>
                                    <?= numero((int) $modulo['total']) ?>
                                </strong>

                                <small>

                                    <?php if (!$modulo['tabela']): ?>

                                        Tabela não encontrada

                                    <?php elseif (!$modulo['pagina']): ?>

                                        Listagem não localizada

                                    <?php else: ?>

                                        <?= $modulo['total'] === 1
                                            ? '1 registro cadastrado'
                                            : 'Registros cadastrados' ?>

                                    <?php endif; ?>

                                </small>

                            </span>


                            <?php if ($disponivel): ?>

                                <i class="fas fa-arrow-up-right-from-square dashboard-module-arrow"></i>

                            <?php endif; ?>

                        </a>

                    <?php endforeach; ?>

                </div>

            </section>


            <!-- AVISO DO PAINEL -->

            <div class="dashboard-note">

                <i class="fas fa-circle-info"></i>

                Os totais são atualizados automaticamente com base nos registros
                existentes no banco de dados. Módulos sem tabela ou página de
                listagem aparecem desabilitados.

            </div>

        </div>

    </main>

    <?php include 'includes_painel/footer.php'; ?>

</body>

</html>
