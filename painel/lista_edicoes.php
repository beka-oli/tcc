
<?php
include 'verifica_login.php';
include 'conexao.php';

mysqli_set_charset($conexao, 'utf8mb4');

// Tratamento de textos
function textoEdicao($valor) {
    $valor = (string) ($valor ?? '');

    return strtr($valor, [
        'Ã¡'=>'á','Ã£'=>'ã','Ã¢'=>'â','Ã©'=>'é','Ãª'=>'ê',
        'Ã­'=>'í','Ã³'=>'ó','Ã´'=>'ô','Ãµ'=>'õ','Ãº'=>'ú',
        'Ã§'=>'ç','Ã‰'=>'É','ÃŠ'=>'Ê','Ã“'=>'Ó','Ã”'=>'Ô',
        'Ã•'=>'Õ','Ãš'=>'Ú','Ã‡'=>'Ç'
    ]);
}

function hEdicao($valor) {
    return htmlspecialchars(textoEdicao($valor), ENT_QUOTES, 'UTF-8');
}

// Recebe os filtros
$busca = trim((string) ($_GET['busca'] ?? ''));
$status = trim((string) ($_GET['status'] ?? ''));
$ano = trim((string) ($_GET['ano'] ?? ''));

// Monta a pesquisa
$where = [];

if ($busca !== '') {
    $b = mysqli_real_escape_string($conexao, $busca);

    $where[] = "(
        titulo_edicao LIKE '%$b%'
        OR subtitulo LIKE '%$b%'
        OR tema LIKE '%$b%'
        OR volume LIKE '%$b%'
        OR numero LIKE '%$b%'
        OR doi LIKE '%$b%'
    )";
}

if ($status !== '') {
    $s = mysqli_real_escape_string($conexao, $status);
    $where[] = "status = '$s'";
}

if ($ano !== '') {
    $a = mysqli_real_escape_string($conexao, $ano);
    $where[] = "ano = '$a'";
}

$whereSql = $where ? 'WHERE ' . implode(' AND ', $where) : '';

// Consulta principal: tabela edicoes
$resultado = mysqli_query(
    $conexao,
    "SELECT * FROM edicoes $whereSql ORDER BY id_edicao DESC"
);

if (!$resultado) {
    die('Erro ao consultar edições: ' . htmlspecialchars(mysqli_error($conexao)));
}

// Estatísticas
$statsResult = mysqli_query($conexao, "
    SELECT
        COUNT(*) AS total,
        SUM(status = 'Publicado') AS publicadas,
        SUM(status = 'Em revisão') AS revisao,
        SUM(status = 'Arquivado') AS arquivadas
    FROM edicoes
");

if (!$statsResult) {
    die('Erro ao consultar estatísticas: ' . htmlspecialchars(mysqli_error($conexao)));
}

$stats = mysqli_fetch_assoc($statsResult);

// Anos disponíveis
$anos = mysqli_query(
    $conexao,
    "SELECT DISTINCT ano FROM edicoes
     WHERE ano IS NOT NULL
     ORDER BY ano DESC"
);

if (!$anos) {
    die('Erro ao consultar anos: ' . htmlspecialchars(mysqli_error($conexao)));
}

// Opções de status
$statusOptions = [
    'Publicado',
    'Em revisão',
    'Rascunho',
    'Arquivado'
];

// Cards
$cards = [
    ['layer-group', 'roxo', 'Total de Edições', 'total', 'Cadastradas'],
    ['circle-check', 'verde', 'Publicadas', 'publicadas', 'Edições'],
    ['clock', 'amarelo', 'Em Revisão', 'revisao', 'Edições'],
    ['box-archive', 'vermelho', 'Arquivadas', 'arquivadas', 'Edições']
];
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edições</title>
    <?php include 'includes_painel/head.php'; ?>
</head>

<body>

<?php include 'includes_painel/header.php'; ?>

<div class="container">

    <div class="topo">

        <div class="titulo">

            <div class="icone">
                <i class="fas fa-book-open"></i>
            </div>

            <div>
                <h1>Edições</h1>
                <p>Gerencie todas as edições cadastradas no sistema</p>
            </div>

        </div>

        <div>
            <a href="form_edicoes.php" class="btn btn-primary">
                <i class="fas fa-plus"></i> Nova Edição
            </a>
        </div>

    </div>

    <!-- FILTROS -->
    <div class="card filtros">

        <form method="GET" action="lista_edicoes.php">

            <div class="campo busca">
                <label>Buscar</label>

                <input
                    type="text"
                    name="busca"
                    value="<?= hEdicao($busca) ?>"
                    placeholder="Título, tema, volume, número ou DOI..."
                >
            </div>

            <div class="campo">
                <label>Status</label>

                <select name="status">

                    <option value="">Todos os status</option>

                    <?php foreach ($statusOptions as $op): ?>
                        <option
                            value="<?= hEdicao($op) ?>"
                            <?= $status === $op ? 'selected' : '' ?>
                        >
                            <?= hEdicao($op) ?>
                        </option>
                    <?php endforeach; ?>

                </select>
            </div>

            <div class="campo">
                <label>Ano</label>

                <select name="ano">

                    <option value="">Todos os anos</option>

                    <?php while ($a = mysqli_fetch_assoc($anos)): ?>
                        <option
                            value="<?= hEdicao($a['ano']) ?>"
                            <?= $ano == $a['ano'] ? 'selected' : '' ?>
                        >
                            <?= hEdicao($a['ano']) ?>
                        </option>
                    <?php endwhile; ?>

                </select>
            </div>

            <button type="submit" class="btn buscar">
                <i class="fas fa-search"></i> Buscar
            </button>

            <a href="lista_edicoes.php" class="btn limpar">
                <i class="fas fa-sync-alt"></i> Limpar
            </a>

        </form>

    </div>

    <!-- ESTATÍSTICAS -->
    <div class="card estatisticas">

        <?php foreach ($cards as $c): ?>

            <div class="estatistica">

                <div class="stat-icon <?= $c[1] ?>">
                    <i class="fas fa-<?= $c[0] ?>"></i>
                </div>

                <div>
                    <span><?= hEdicao($c[2]) ?></span>

                    <strong>
                        <?= number_format((int) ($stats[$c[3]] ?? 0), 0, ',', '.') ?>
                    </strong>

                    <small><?= hEdicao($c[4]) ?></small>
                </div>

            </div>

        <?php endforeach; ?>

    </div>

    <!-- TABELA -->
    <div class="card tabela">

        <div class="table-responsive">

            <table>

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Título da Edição</th>
                        <th>Volume</th>
                        <th>Número</th>
                        <th>Ano</th>
                        <th>Data de Publicação</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>

                <tbody>

                <?php if (mysqli_num_rows($resultado) > 0): ?>

                    <?php while ($e = mysqli_fetch_assoc($resultado)): ?>

                        <?php
                        $classes = [
                            'Publicado' => 'verde',
                            'Em revisão' => 'amarelo',
                            'Em Revisão' => 'amarelo',
                            'Arquivado' => 'vermelho',
                            'Rascunho' => 'cinza'
                        ];

                        $classe = $classes[$e['status']] ?? 'cinza';
                        ?>

                        <tr>

                            <td><?= (int) $e['id_edicao'] ?></td>

                            <td class="nome">
                                <?= hEdicao($e['titulo_edicao']) ?>
                            </td>

                            <td><?= hEdicao($e['volume']) ?></td>

                            <td><?= hEdicao($e['numero']) ?></td>

                            <td><?= hEdicao($e['ano']) ?></td>

                            <td>
                                <?php
                                if (!empty($e['data_publicacao'])) {
                                    echo date('d/m/Y', strtotime($e['data_publicacao']));
                                } else {
                                    echo '-';
                                }
                                ?>
                            </td>

                            <td>
                                <span class="status <?= $classe ?>">
                                    <span class="ponto">●</span>
                                    <?= hEdicao($e['status']) ?>
                                </span>
                            </td>

                            <td class="acoes">

                                <a
                                    href="editar_edicao_revista.php?id=<?= (int) $e['id_edicao'] ?>"
                                    class="editar"
                                    title="Editar"
                                >
                                    <i class="fas fa-pen-to-square"></i> Alterar
                                </a>

                                <a
                                    href="excluir_edicao_revista.php?id=<?= (int) $e['id_edicao'] ?>&csrf_token=<?= hEdicao(csrf_token()) ?>"
                                    class="excluir"
                                    title="Excluir"
                                    onclick="return confirm('Deseja excluir esta edição?')"
                                >
                                    <i class="fas fa-trash"></i> Excluir
                                </a>

                            </td>

                        </tr>

                    <?php endwhile; ?>

                <?php else: ?>

                    <tr>
                        <td colspan="8" class="vazio">
                            <i class="fas fa-folder-open"></i>
                            Nenhuma edição encontrada.
                        </td>
                    </tr>

                <?php endif; ?>

                </tbody>

            </table>

        </div>

        <div class="rodape">
            Mostrando
            <strong><?= mysqli_num_rows($resultado) ?></strong>
            registro(s)
        </div>

    </div>

</div>

<?php include 'includes_painel/footer.php'; ?>

</body>
</html>
