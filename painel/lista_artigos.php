
<?php
include 'verifica_login.php';
include 'conexao.php';

// Garante a comunicação com o MySQL em UTF-8 completo.
mysqli_set_charset($conexao, 'utf8mb4');

$busca = trim((string)($_GET['busca'] ?? ''));
$b = mysqli_real_escape_string($conexao, $busca);

$where = $busca
    ? "WHERE CONVERT(a.titulo USING utf8mb4) COLLATE utf8mb4_unicode_ci LIKE '%$b%' OR CONVERT(r.nome USING utf8mb4) COLLATE utf8mb4_unicode_ci LIKE '%$b%' OR CONVERT(au.nome USING utf8mb4) COLLATE utf8mb4_unicode_ci LIKE '%$b%'"
    : '';

$resultado = mysqli_query($conexao, "
    SELECT a.*, r.nome AS revista,
           GROUP_CONCAT(au.nome SEPARATOR ', ') AS autores
    FROM artigos a
    INNER JOIN edicoes e ON e.id_edicao = a.id_edicao
    INNER JOIN revistas r ON r.id_revista = e.id_revista
    LEFT JOIN artigo_autor aa ON aa.id_artigo = a.id_artigo
    LEFT JOIN autores au ON au.id_autor = aa.id_autor
    $where
    GROUP BY a.id_artigo
    ORDER BY a.id_artigo DESC
");

$total = mysqli_num_rows($resultado);

$stats = mysqli_fetch_assoc(mysqli_query($conexao, "
    SELECT
        COUNT(*) total,
        SUM(status='Publicado') publicados,
        SUM(status='Em Revisão') revisao,
        SUM(status='Arquivado') arquivados
    FROM artigos
"));

$cards = [
    ['file-lines','roxo','Total de Artigos','total','Cadastrados'],
    ['book-open','verde','Artigos Publicados','publicados','Publicados'],
    ['clock','amarelo','Em Revisão','revisao','Artigos'],
    ['box-archive','vermelho','Arquivados','arquivados','Artigos']
];
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artigos</title>
    <?php include 'includes_painel/head.php'; ?>

    
    
</head>

<body>

<?php include 'includes_painel/header.php'; ?>

<div class="container">

    <div class="topo">

        <div class="titulo">
            <div class="icone">
                <i class="fas fa-file-lines"></i>
            </div>

            <div>
                <h1>Artigos</h1>
                <p>Gerencie os artigos científicos cadastrados no sistema</p>
            </div>
        </div>

    </div>


    <div class="card filtros">

        <form method="GET">

            <div class="campo">
                <label>Buscar</label>

                <input
                    name="busca"
                    value="<?= h($busca) ?>"
                    placeholder="Artigo, revista ou autor..."
                >
            </div>

            <button class="btn btn-primary">
                <i class="fas fa-search"></i> Buscar
            </button>

            <a href="lista_artigos.php" class="btn limpar">
                <i class="fas fa-sync-alt"></i> Limpar
            </a>

        </form>

    </div>


    <div class="card estatisticas">

        <?php foreach ($cards as $c): ?>

            <div>

                <i class="fas fa-<?= $c[0] ?> <?= $c[1] ?>"></i>

                <section>
                    <span><?= $c[2] ?></span>
                    <strong><?= $stats[$c[3]] ?? 0 ?></strong>
                    <small><?= $c[4] ?></small>
                </section>

            </div>

        <?php endforeach; ?>

    </div>


    <div class="card tabela">

        <div class="table-responsive">

            <table>

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Artigo</th>
                        <th>Revista</th>
                        <th>Autores</th>
                        <th>Páginas</th>
                        <th>DOI</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>

                <tbody>

                <?php if ($total): ?>

                    <?php while ($r = mysqli_fetch_assoc($resultado)): ?>

                        <?php
                        $status = $r['status'];

                        $classe = [
                            'Publicado' => 'verde',
                            'Em Revisão' => 'amarelo',
                            'Arquivado' => 'vermelho'
                        ][$status] ?? 'cinza';
                        ?>

                        <tr>

                            <td><?= $r['id_artigo'] ?></td>

                            <td class="nome">
                                <?= h($r['titulo']) ?>
                            </td>

                            <td>
                                <?= h($r['revista']) ?>
                            </td>

                            <td>
                                <?= h($r['autores'] ?? '—') ?>
                            </td>

                            <td>
                                <?= h($r['paginas']) ?>
                            </td>

                            <td>
                                <?= h($r['doi'] ?: '—') ?>
                            </td>

                            <td>
                                <span class="status <?= $classe ?>">
                                    ● <?= h($status) ?>
                                </span>
                            </td>

                            <td class="acoes">

                                <a
                                    href="editar_artigo.php?id=<?= $r['id_artigo'] ?>"
                                    class="editar"
                                    title="Editar">
                                    <i class="fas fa-pen-to-square"></i> Alterar
                                </a>

                                <a
                                    href="excluir_artigo.php?id=<?= $r['id_artigo'] ?>&csrf_token=<?=h(csrf_token())?>"
                                    class="excluir"
                                    title="Excluir"
                                    onclick="return confirm('Deseja excluir este artigo?')">
                                    <i class="fas fa-trash"></i> Excluir
                                </a>

                            </td>

                        </tr>

                    <?php endwhile; ?>

                <?php else: ?>

                    <tr>
                        <td colspan="8" class="vazio">
                            <i class="fas fa-folder-open"></i>
                            Nenhum artigo encontrado.
                        </td>
                    </tr>

                <?php endif; ?>

                </tbody>

            </table>

        </div>

        <div class="rodape">
            Mostrando <b><?= $total ?></b> artigo(s)
        </div>

    </div>

</div>




<?php include 'includes_painel/footer.php'; ?>

</body>
</html>
