
<?php
include 'verifica_login.php';
include 'conexao.php';

// Garante a comunicação com o MySQL em UTF-8 completo.
mysqli_set_charset($conexao, 'utf8mb4');

$busca = trim($_GET['busca'] ?? '');
$where = '';

if ($busca !== '') {
    $b = mysqli_real_escape_string($conexao, $busca);
    $where = "WHERE CONVERT(titulo USING utf8mb4) COLLATE utf8mb4_unicode_ci LIKE '%$b%'
        OR CONVERT(tipo USING utf8mb4) COLLATE utf8mb4_unicode_ci LIKE '%$b%'
        OR CONVERT(autor USING utf8mb4) COLLATE utf8mb4_unicode_ci LIKE '%$b%'
        OR CONVERT(curso USING utf8mb4) COLLATE utf8mb4_unicode_ci LIKE '%$b%'
        OR CONVERT(instituicao USING utf8mb4) COLLATE utf8mb4_unicode_ci LIKE '%$b%'
        OR CONVERT(orientador USING utf8mb4) COLLATE utf8mb4_unicode_ci LIKE '%$b%'
        OR CONVERT(palavras_chave USING utf8mb4) COLLATE utf8mb4_unicode_ci LIKE '%$b%'";
}

$resultado = mysqli_query($conexao, "
    SELECT * FROM trabalhos_academicos
    $where
    ORDER BY id_trabalho DESC
");

if (!$resultado) {
    die('Erro: ' . h(mysqli_error($conexao)));
}

$total = mysqli_num_rows($resultado);

$stats = mysqli_fetch_assoc(mysqli_query($conexao, "
    SELECT
        COUNT(*) AS total,
        COUNT(DISTINCT autor) AS autores,
        COUNT(DISTINCT curso) AS cursos,
        MAX(data_publicacao) AS ultima_publicacao
    FROM trabalhos_academicos
"));

$ultima = !empty($stats['ultima_publicacao'])
    ? date('d/m/Y', strtotime($stats['ultima_publicacao']))
    : '-';

$cards = [
    ['book-open', 'roxo', 'Total de Trabalhos', $stats['total'] ?? 0, 'Cadastrados'],
    ['user-graduate', 'verde', 'Autores', $stats['autores'] ?? 0, 'Autores cadastrados'],
    ['graduation-cap', 'amarelo', 'Cursos', $stats['cursos'] ?? 0, 'Cursos registrados'],
    ['calendar', 'vermelho', 'Última Publicação', $ultima, 'Data']
];
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Trabalhos Acadêmicos</title>
    <?php include 'includes_painel/head.php'; ?>

    

    
    
</head>

<body>

<?php include 'includes_painel/header.php'; ?>

<div class="container">

    <div class="topo">
        <div class="titulo">
            <div class="icone"><i class="fas fa-graduation-cap"></i></div>
            <div>
                <h1>Trabalhos Acadêmicos</h1>
                <p>Gerencie os trabalhos acadêmicos cadastrados</p>
            </div>
        </div>
    </div>

    <div class="card filtros">
        <form method="GET">
            <div class="campo">
                <label>Buscar</label>
                <input type="text" name="busca"
                    value="<?= h($busca) ?>"
                    placeholder="Título, autor, curso, instituição ou tipo...">
            </div>

            <button type="submit" class="btn buscar">
                <i class="fas fa-search"></i> Buscar
            </button>

            <a href="lista_TA.php" class="btn limpar">
                <i class="fas fa-sync-alt"></i> Limpar
            </a>
        </form>
    </div>

    <div class="card estatisticas">

        <?php foreach($cards as $c): ?>

            <div class="estatistica">

                <div class="stat-icon <?= $c[1] ?>">
                    <i class="fas fa-<?= $c[0] ?>"></i>
                </div>

                <div>
                    <span><?= $c[2] ?></span>
                    <strong><?= h($c[3]) ?></strong>
                    <small><?= $c[4] ?></small>
                </div>

            </div>

        <?php endforeach; ?>

    </div>

    <div class="card tabela">

        <div class="table-responsive">

            <table>

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Título</th>
                        <th>Tipo</th>
                        <th>Autor</th>
                        <th>Curso</th>
                        <th>Instituição</th>
                        <th>Orientador</th>
                        <th>Publicação</th>
                        <th>Arquivo</th>
                        <th>Ações</th>
                    </tr>
                </thead>

                <tbody>

                <?php if($total > 0): ?>

                    <?php while($r = mysqli_fetch_assoc($resultado)): ?>

                        <tr>

                            <td><?= h($r['id_trabalho']) ?></td>

                            <td class="nome">
                                <?= h($r['titulo']) ?>
                            </td>

                            <td>
                                <span class="tipo">
                                    <?= h($r['tipo']) ?>
                                </span>
                            </td>

                            <td><?= h($r['autor']) ?></td>

                            <td><?= h($r['curso']) ?></td>

                            <td><?= h($r['instituicao']) ?></td>

                            <td>
                                <?= !empty($r['orientador'])
                                    ? h($r['orientador'])
                                    : '-' ?>
                            </td>

                            <td>
                                <?= !empty($r['data_publicacao'])
                                    ? date('d/m/Y', strtotime($r['data_publicacao']))
                                    : '-' ?>
                            </td>

                            <td>

                                <?php if(!empty($r['arquivo'])): ?>

                                    <a
                                        href="uploads/trabalhos/<?= rawurlencode($r['arquivo']) ?>"
                                        target="_blank"
                                        class="arquivo"
                                        title="Abrir arquivo"
                                    >
                                        <i class="fas fa-file-pdf"></i> Abrir
                                    </a>

                                <?php else: ?>

                                    <span class="sem-arquivo">
                                        Sem arquivo
                                    </span>

                                <?php endif; ?>

                            </td>

                            <td class="acoes">

                                <a
                                    href="editar_trabalho.php?id=<?= $r['id_trabalho'] ?>"
                                    class="editar"
                                    title="Editar"
                                >
                                    <i class="fas fa-pen-to-square"></i>
                                </a>

                                <a
                                    href="excluir_trabalho.php?id=<?= $r['id_trabalho'] ?>&csrf_token=<?=h(csrf_token())?>"
                                    class="excluir"
                                    title="Excluir"
                                    onclick="return confirm('Deseja excluir este trabalho acadêmico?')"
                                >
                                    <i class="fas fa-trash"></i>
                                </a>

                            </td>

                        </tr>

                    <?php endwhile; ?>

                <?php else: ?>

                    <tr>
                        <td colspan="10" class="vazio">
                            <i class="fas fa-folder-open"></i>
                            <strong>Nenhum trabalho acadêmico encontrado.</strong>
                            <span>Tente realizar uma nova busca.</span>
                        </td>
                    </tr>

                <?php endif; ?>

                </tbody>

            </table>

        </div>

        <div class="rodape">
            Mostrando <strong><?= $total ?></strong> trabalho(s) acadêmico(s)
        </div>

    </div>

</div>

<?php include 'includes_painel/footer.php'; ?>

</body>
</html>

