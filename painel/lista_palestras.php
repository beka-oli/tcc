<?php
include 'verifica_login.php';
include 'conexao.php';

mysqli_set_charset($conexao, 'utf8mb4');

$busca = trim($_GET['busca'] ?? '');
$status = trim($_GET['status'] ?? '');
$where = "WHERE 1=1";

if ($busca !== '') {
    $b = mysqli_real_escape_string($conexao, $busca);
    $where .= " AND (
        CONVERT(titulo USING utf8mb4) COLLATE utf8mb4_unicode_ci LIKE '%$b%'
        OR CONVERT(palestrante USING utf8mb4) COLLATE utf8mb4_unicode_ci LIKE '%$b%'
        OR CONVERT(instituicao USING utf8mb4) COLLATE utf8mb4_unicode_ci LIKE '%$b%'
        OR CONVERT(local USING utf8mb4) COLLATE utf8mb4_unicode_ci LIKE '%$b%'
        OR CONVERT(categoria USING utf8mb4) COLLATE utf8mb4_unicode_ci LIKE '%$b%'
    )";
}

if ($status !== '') {
    $s = mysqli_real_escape_string($conexao, $status);
    $where .= " AND CONVERT(TRIM(status) USING utf8mb4) COLLATE utf8mb4_unicode_ci = CONVERT('$s' USING utf8mb4) COLLATE utf8mb4_unicode_ci";
}

$resultado = mysqli_query($conexao, "SELECT * FROM palestras $where ORDER BY id_palestra DESC");

if (!$resultado) {
    die('Erro: ' . h(mysqli_error($conexao)));
}

$total = mysqli_num_rows($resultado);

$stats = mysqli_fetch_assoc(mysqli_query($conexao, "
    SELECT
        COUNT(*) AS total,
        SUM(status = 'Ativa') AS ativas,
        SUM(status = 'Concluída') AS concluidas,
        SUM(status = 'Cancelada') AS canceladas
    FROM palestras
"));
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Palestras</title>
    <?php include 'includes_painel/head.php'; ?>
</head>
<body>

<?php include 'includes_painel/header.php'; ?>

<div class="container">

    <div class="topo">
        <div class="titulo">
            <div class="icone"><i class="fas fa-chalkboard-teacher"></i></div>
            <div>
                <h1>Palestras</h1>
                <p>Gerencie as palestras da Assessoria Pedagógica</p>
            </div>
        </div>
        <a href="form_palestras.php" class="btn btn-primary">
            <i class="fas fa-plus"></i> Nova Palestra
        </a>
    </div>

    <div class="card filtros">
        <form method="GET">
            <div class="campo">
                <label>Buscar</label>
                <input type="text" name="busca" value="<?= h($busca) ?>"
                    placeholder="Título, palestrante, local, categoria...">
            </div>
            <div class="campo">
                <label>Status</label>
                <select name="status">
                    <option value="">Todos</option>
                    <option value="Ativa" <?= $status === 'Ativa' ? 'selected' : '' ?>>Ativa</option>
                    <option value="Concluída" <?= $status === 'Concluída' ? 'selected' : '' ?>>Concluída</option>
                    <option value="Cancelada" <?= $status === 'Cancelada' ? 'selected' : '' ?>>Cancelada</option>
                </select>
            </div>
            <button type="submit" class="btn buscar"><i class="fas fa-search"></i> Buscar</button>
            <a href="lista_palestras.php" class="btn limpar"><i class="fas fa-sync-alt"></i> Limpar</a>
        </form>
    </div>

    <div class="card">
        <div class="tabela-wrap">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Título</th>
                        <th>Palestrante</th>
                        <th>Data</th>
                        <th>Horário</th>
                        <th>Local</th>
                        <th>Vagas</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                <?php if ($total > 0): ?>
                    <?php while ($r = mysqli_fetch_assoc($resultado)): ?>
                        <tr>
                            <td><?= (int)$r['id_palestra'] ?></td>
                            <td class="nome"><?= h($r['titulo']) ?></td>
                            <td><?= h($r['palestrante']) ?></td>
                            <td><?= !empty($r['data_palestra']) ? date('d/m/Y', strtotime($r['data_palestra'])) : '-' ?></td>
                            <td>
                                <?= !empty($r['hora_inicio']) ? substr($r['hora_inicio'], 0, 5) : '-' ?>
                                <?= !empty($r['hora_fim']) ? ' – ' . substr($r['hora_fim'], 0, 5) : '' ?>
                            </td>
                            <td><?= h($r['local']) ?></td>
                            <td><?= $r['vagas'] !== null ? (int)$r['vagas'] : '-' ?></td>
                            <td><span class="status"><?= h($r['status']) ?></span></td>
                            <td class="acoes">
                                <a href="editar_palestra.php?id=<?= (int)$r['id_palestra'] ?>"
                                   class="editar" title="Editar">
                                    <i class="fas fa-pen-to-square"></i> Alterar
                                </a>
                                <a href="excluir_palestra.php?id=<?= (int)$r['id_palestra'] ?>&csrf_token=<?= h(csrf_token()) ?>"
                                   class="excluir" title="Excluir"
                                   onclick="return confirm('Deseja excluir esta palestra?')">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="9" class="vazio">
                            <i class="fas fa-folder-open"></i>
                            <strong>Nenhuma palestra encontrada.</strong>
                            <span>Cadastre a primeira palestra ou ajuste a busca.</span>
                        </td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="rodape">
            Mostrando <strong><?= $total ?></strong> palestra(s)
            <?php if ($stats): ?>
                · Ativas: <?= (int)($stats['ativas'] ?? 0) ?>
                · Concluídas: <?= (int)($stats['concluidas'] ?? 0) ?>
                · Canceladas: <?= (int)($stats['canceladas'] ?? 0) ?>
            <?php endif; ?>
        </div>
    </div>

</div>

<?php include 'includes_painel/footer.php'; ?>
</body>
</html>
