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
        OR CONVERT(instrutor USING utf8mb4) COLLATE utf8mb4_unicode_ci LIKE '%$b%'
        OR CONVERT(instituicao USING utf8mb4) COLLATE utf8mb4_unicode_ci LIKE '%$b%'
        OR CONVERT(categoria USING utf8mb4) COLLATE utf8mb4_unicode_ci LIKE '%$b%'
        OR CONVERT(modalidade USING utf8mb4) COLLATE utf8mb4_unicode_ci LIKE '%$b%'
    )";
}

if ($status !== '') {
    $s = mysqli_real_escape_string($conexao, $status);
    $where .= " AND CONVERT(TRIM(status) USING utf8mb4) COLLATE utf8mb4_unicode_ci = CONVERT('$s' USING utf8mb4) COLLATE utf8mb4_unicode_ci";
}

$resultado = mysqli_query($conexao, "SELECT * FROM cursos $where ORDER BY id_curso DESC");

if (!$resultado) {
    die('Erro: ' . h(mysqli_error($conexao)));
}

$total = mysqli_num_rows($resultado);

$stats = mysqli_fetch_assoc(mysqli_query($conexao, "
    SELECT
        COUNT(*) AS total,
        SUM(status = 'Aberto') AS abertos,
        SUM(status = 'Em andamento') AS andamento,
        SUM(status = 'Concluído') AS concluidos
    FROM cursos
"));
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cursos</title>
    <?php include 'includes_painel/head.php'; ?>
</head>
<body>

<?php include 'includes_painel/header.php'; ?>

<div class="container">

    <div class="topo">
        <div class="titulo">
            <div class="icone"><i class="fas fa-graduation-cap"></i></div>
            <div>
                <h1>Cursos</h1>
                <p>Gerencie os cursos da Assessoria Pedagógica</p>
            </div>
        </div>
        <a href="form_cursos.php" class="btn btn-primary">
            <i class="fas fa-plus"></i> Novo Curso
        </a>
    </div>

    <div class="card filtros">
        <form method="GET">
            <div class="campo">
                <label>Buscar</label>
                <input type="text" name="busca" value="<?= h($busca) ?>"
                    placeholder="Título, instrutor, instituição, categoria...">
            </div>
            <div class="campo">
                <label>Status</label>
                <select name="status">
                    <option value="">Todos</option>
                    <option value="Aberto" <?= $status === 'Aberto' ? 'selected' : '' ?>>Inscrições Abertas</option>
                    <option value="Em andamento" <?= $status === 'Em andamento' ? 'selected' : '' ?>>Em Andamento</option>
                    <option value="Concluído" <?= $status === 'Concluído' ? 'selected' : '' ?>>Concluído</option>
                    <option value="Cancelado" <?= $status === 'Cancelado' ? 'selected' : '' ?>>Cancelado</option>
                </select>
            </div>
            <button type="submit" class="btn buscar"><i class="fas fa-search"></i> Buscar</button>
            <a href="lista_cursos.php" class="btn limpar"><i class="fas fa-sync-alt"></i> Limpar</a>
        </form>
    </div>

    <div class="card">
        <div class="tabela-wrap">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Título</th>
                        <th>Instrutor</th>
                        <th>Modalidade</th>
                        <th>Início</th>
                        <th>Término</th>
                        <th>Carga</th>
                        <th>Vagas</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                <?php if ($total > 0): ?>
                    <?php while ($r = mysqli_fetch_assoc($resultado)): ?>
                        <tr>
                            <td><?= (int)$r['id_curso'] ?></td>
                            <td class="nome"><?= h($r['titulo']) ?></td>
                            <td><?= h($r['instrutor']) ?></td>
                            <td><?= h($r['modalidade']) ?></td>
                            <td><?= !empty($r['data_inicio']) ? date('d/m/Y', strtotime($r['data_inicio'])) : '-' ?></td>
                            <td><?= !empty($r['data_fim']) ? date('d/m/Y', strtotime($r['data_fim'])) : '-' ?></td>
                            <td><?= $r['carga_horaria'] !== null ? (int)$r['carga_horaria'] . 'h' : '-' ?></td>
                            <td><?= $r['vagas'] !== null ? (int)$r['vagas'] : '-' ?></td>
                            <td><span class="status"><?= h($r['status']) ?></span></td>
                            <td class="acoes">
                                <a href="editar_curso.php?id=<?= (int)$r['id_curso'] ?>"
                                   class="editar" title="Editar">
                                    <i class="fas fa-pen-to-square"></i> Alterar
                                </a>
                                <a href="excluir_curso.php?id=<?= (int)$r['id_curso'] ?>&csrf_token=<?= h(csrf_token()) ?>"
                                   class="excluir" title="Excluir"
                                   onclick="return confirm('Deseja excluir este curso?')">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="10" class="vazio">
                            <i class="fas fa-folder-open"></i>
                            <strong>Nenhum curso encontrado.</strong>
                            <span>Cadastre o primeiro curso ou ajuste a busca.</span>
                        </td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="rodape">
            Mostrando <strong><?= $total ?></strong> curso(s)
            <?php if ($stats): ?>
                · Abertos: <?= (int)($stats['abertos'] ?? 0) ?>
                · Em andamento: <?= (int)($stats['andamento'] ?? 0) ?>
                · Concluídos: <?= (int)($stats['concluidos'] ?? 0) ?>
            <?php endif; ?>
        </div>
    </div>

</div>

<?php include 'includes_painel/footer.php'; ?>
</body>
</html>
