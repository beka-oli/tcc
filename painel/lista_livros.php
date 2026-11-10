<?php
include 'verifica_login.php';
include 'conexao.php';

mysqli_set_charset($conexao, 'utf8mb4');

$busca     = trim((string)($_GET['busca'] ?? ''));
$categoria = trim((string)($_GET['categoria'] ?? ''));
$ano       = trim((string)($_GET['ano'] ?? ''));
$status    = trim((string)($_GET['status'] ?? ''));

// Status oficiais (iguais ao formulário de cadastro)
$statusOptions = [
    'Disponível',
    'Indisponível',
    'Em Empréstimo',
    'Arquivado',
];

$where = [];

if ($busca !== '') {
    $b = mysqli_real_escape_string($conexao, $busca);
    $where[] = "(
        titulo LIKE '%$b%'
        OR isbn LIKE '%$b%'
        OR autor LIKE '%$b%'
    )";
}

if ($categoria !== '') {
    $c = mysqli_real_escape_string($conexao, $categoria);
    $where[] = "categoria LIKE '%$c%'";
}

if ($ano !== '') {
    $a = mysqli_real_escape_string($conexao, $ano);
    $where[] = "TRIM(CAST(ano_publicacao AS CHAR)) = '$a'";
}

if ($status !== '') {
    // Filtro por trecho estável (evita falha por acento/encoding no banco)
    $mapaLike = [
        'Disponível'     => "status LIKE '%Dispon%'",
        'Indisponível'   => "status LIKE '%Indispon%'",
        'Em Empréstimo'  => "(status LIKE '%Emprest%' OR status LIKE '%Emprést%')",
        'Arquivado'      => "status LIKE '%Arquiv%'",
    ];
    if (isset($mapaLike[$status])) {
        $where[] = $mapaLike[$status];
    } else {
        $s = mysqli_real_escape_string($conexao, $status);
        $where[] = "TRIM(status) LIKE '%$s%'";
    }
}

$whereSql = $where ? 'WHERE ' . implode(' AND ', $where) : '';

$resultado = mysqli_query(
    $conexao,
    "SELECT * FROM livros $whereSql ORDER BY id_livro DESC"
);

if (!$resultado) {
    die('Erro ao consultar livros: ' . htmlspecialchars(mysqli_error($conexao)));
}

// Estatísticas em PHP (evita problema de encoding no SUM do MySQL)
$todos = mysqli_query($conexao, "SELECT status FROM livros");
$stats = [
    'total'         => 0,
    'disponiveis'   => 0,
    'indisponiveis' => 0,
    'emprestimo'    => 0,
    'arquivados'    => 0,
];

if ($todos) {
    while ($row = mysqli_fetch_assoc($todos)) {
        $stats['total']++;
        $st = mb_strtolower(trim((string)($row['status'] ?? '')), 'UTF-8');
        $stNorm = @iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $st);
        $stNorm = strtolower((string)$stNorm);

        if (strpos($stNorm, 'dispon') !== false && strpos($stNorm, 'indispon') === false) {
            $stats['disponiveis']++;
        } elseif (strpos($stNorm, 'indispon') !== false) {
            $stats['indisponiveis']++;
        } elseif (strpos($stNorm, 'emprest') !== false) {
            $stats['emprestimo']++;
        } elseif (strpos($stNorm, 'arquiv') !== false) {
            $stats['arquivados']++;
        }
    }
}

$anos = mysqli_query($conexao, "
    SELECT DISTINCT ano_publicacao
    FROM livros
    WHERE ano_publicacao IS NOT NULL AND ano_publicacao != ''
    ORDER BY ano_publicacao DESC
");

$totalFiltrado = mysqli_num_rows($resultado);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livros</title>
    <?php include 'includes_painel/head.php'; ?>
</head>
<body>

<?php include 'includes_painel/header.php'; ?>

<div class="pagina">

    <div class="cabecalho">
        <div class="titulo-area">
            <div class="icone-titulo">
                <i class="fas fa-book-open"></i>
            </div>
            <div>
                <h1>Livros</h1>
                <p>Gerencie todos os livros cadastrados no sistema</p>
            </div>
        </div>
        <a href="form_livros.php" class="btn btn-primary">
            <i class="fas fa-plus"></i> Novo Livro
        </a>
    </div>

    <!-- FILTROS -->
    <div class="card filtros">
        <form method="GET" action="lista_livros.php">

            <div class="campo">
                <label>Buscar</label>
                <input name="busca" placeholder="Título, ISBN, autor..."
                    value="<?= h($busca) ?>">
            </div>

            <div class="campo">
                <label>Categoria</label>
                <input name="categoria" placeholder="Todas as categorias"
                    value="<?= h($categoria) ?>">
            </div>

            <div class="campo">
                <label>Ano</label>
                <select name="ano">
                    <option value="">Todos os anos</option>
                    <?php if ($anos): while ($a = mysqli_fetch_assoc($anos)): ?>
                        <option value="<?= h($a['ano_publicacao']) ?>"
                            <?= $ano == $a['ano_publicacao'] ? 'selected' : '' ?>>
                            <?= h($a['ano_publicacao']) ?>
                        </option>
                    <?php endwhile; endif; ?>
                </select>
            </div>

            <div class="campo">
                <label>Status</label>
                <select name="status">
                    <option value="">Todos os status</option>
                    <?php foreach ($statusOptions as $op): ?>
                        <option value="<?= h($op) ?>" <?= $status === $op ? 'selected' : '' ?>>
                            <?= h($op) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit" class="btn buscar">
                <i class="fas fa-search"></i> Buscar
            </button>

            <a href="lista_livros.php" class="btn limpar">
                <i class="fas fa-sync-alt"></i> Limpar
            </a>

        </form>
    </div>

    <!-- ESTATÍSTICAS -->
    <div class="estatisticas">
        <?php
        $cards = [
            ['layer-group',  'roxo',    'Total de Livros', $stats['total'],         'Cadastrados'],
            ['check-circle', 'verde',   'Disponíveis',     $stats['disponiveis'],   'Ativos'],
            ['ban',          'amarelo', 'Indisponíveis',   $stats['indisponiveis'], 'Bloqueados'],
            ['archive',      'rosa',    'Arquivados',      $stats['arquivados'],    'Livros'],
        ];
        foreach ($cards as $card):
        ?>
            <div class="estatistica">
                <div class="estatistica-icone <?= $card[1] ?>">
                    <i class="fas fa-<?= $card[0] ?>"></i>
                </div>
                <div>
                    <span><?= $card[2] ?></span>
                    <strong><?= (int)$card[3] ?></strong>
                    <small><?= $card[4] ?></small>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- TABELA -->
    <div class="tabela card">
        <div class="livros-tabela-scroll table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Título</th>
                        <th>ISBN</th>
                        <th>Autor</th>
                        <th>Categoria</th>
                        <th>Ano</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                <?php if ($totalFiltrado > 0): ?>
                    <?php while ($r = mysqli_fetch_assoc($resultado)): ?>
                        <?php
                        $st = trim((string)($r['status'] ?? ''));
                        $stNorm = strtolower((string)@iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $st));
                        if (strpos($stNorm, 'dispon') !== false && strpos($stNorm, 'indispon') === false) {
                            $classe = 'status-disponivel';
                        } elseif (strpos($stNorm, 'arquiv') !== false) {
                            $classe = 'status-arquivado';
                        } elseif (strpos($stNorm, 'emprest') !== false || strpos($stNorm, 'indispon') !== false) {
                            $classe = 'status-revisao';
                        } else {
                            $classe = 'status-padrao';
                        }
                        ?>
                        <tr>
                            <td><?= (int)$r['id_livro'] ?></td>
                            <td class="titulo-livro"><?= h($r['titulo']) ?></td>
                            <td><?= h($r['isbn']) ?></td>
                            <td><?= h($r['autor']) ?></td>
                            <td><?= h($r['categoria']) ?></td>
                            <td><?= h($r['ano_publicacao']) ?></td>
                            <td>
                                <span class="status <?= $classe ?>">
                                    ● <?= h($st !== '' ? $st : '—') ?>
                                </span>
                            </td>
                            <td class="acoes">
                                <a href="editar_livro.php?id=<?= (int)$r['id_livro'] ?>"
                                   class="editar" title="Editar">
                                    <i class="fas fa-pen-to-square"></i> Alterar
                                </a>
                                <a href="excluir_livro.php?id=<?= (int)$r['id_livro'] ?>&csrf_token=<?= h(csrf_token()) ?>"
                                   class="excluir" title="Excluir"
                                   onclick="return confirm('Deseja realmente excluir este livro?')">
                                    <i class="fas fa-trash"></i> Excluir
                                </a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" class="livros-sem-registros vazio">
                            <i class="fas fa-book fa-2x"></i><br><br>
                            Nenhum livro encontrado.
                        </td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="rodape-tabela">
            Mostrando <strong><?= (int)$totalFiltrado ?></strong> registro(s)
        </div>
    </div>

</div>

<?php include 'includes_painel/footer.php'; ?>
</body>
</html>
