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
        OR CONVERT(organizador USING utf8mb4) COLLATE utf8mb4_unicode_ci LIKE '%$b%'
        OR CONVERT(tipo USING utf8mb4) COLLATE utf8mb4_unicode_ci LIKE '%$b%'
        OR CONVERT(local USING utf8mb4) COLLATE utf8mb4_unicode_ci LIKE '%$b%'
    )";
}

if ($status !== '') {
    $s = mysqli_real_escape_string($conexao, $status);
    $where .= " AND CONVERT(TRIM(status) USING utf8mb4) COLLATE utf8mb4_unicode_ci = CONVERT('$s' USING utf8mb4) COLLATE utf8mb4_unicode_ci";
}

$resultado = mysqli_query($conexao, "SELECT * FROM eventos $where ORDER BY id_evento DESC");

if (!$resultado) {
    die('Erro: ' . h(mysqli_error($conexao)));
}

$total = mysqli_num_rows($resultado);

$stats = mysqli_fetch_assoc(mysqli_query($conexao, "
    SELECT
        COUNT(*) AS total,
        SUM(status = 'Programado') AS programados,
        SUM(status = 'Em andamento') AS andamento,
        SUM(status = 'Concluído') AS concluidos,
        SUM(destaque = 1) AS destaques
    FROM eventos
"));
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Eventos</title>
    <?php include 'includes_painel/head.php'; ?>
</head>
<body>

<?php include 'includes_painel/header.php'; ?>

<div class="container">

    <div class="topo">
        <div class="titulo">
            <div class="icone"><i class="fas fa-calendar-alt"></i></div>
            <div>
                <h1>Eventos</h1>
                <p>Gerencie os eventos da Assessoria Pedagógica</p>
            </div>
        </div>
        <a href="form_eventos.php" class="btn btn-primary">
            <i class="fas fa-plus"></i> Novo Evento
        </a>
    </div>

    <div class="card filtros">
        <form method="GET">
            <div class="campo">
                <label>Buscar</label>
                <input type="text" name="busca" value="<?= h($busca) ?>"
                    placeholder="Título, organizador, tipo, local...">
            </div>
            <div class="campo">
                <label>Status</label>
                <select name="status">
                    <option value="">Todos</option>
                    <option value="Programado" <?= $status === 'Programado' ? 'selected' : '' ?>>Programado</option>
                    <option value="Em andamento" <?= $status === 'Em andamento' ? 'selected' : '' ?>>Em Andamento</option>
                    <option value="Concluído" <?= $status === 'Concluído' ? 'selected' : '' ?>>Concluído</option>
                    <option value="Cancelado" <?= $status === 'Cancelado' ? 'selected' : '' ?>>Cancelado</option>
                </select>
            </div>
            <button type="submit" class="btn buscar"><i class="fas fa-search"></i> Buscar</button>
            <a href="lista_eventos.php" class="btn limpar"><i class="fas fa-sync-alt"></i> Limpar</a>
        </form>
    </div>

    <div class="card">
        <div class="tabela-wrap">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Título</th>
                        <th>Organizador</th>
                        <th>Tipo</th>
                        <th>Início</th>
                        <th>Local</th>
                        <th>Vagas</th>
                        <th>Destaque</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                <?php if ($total > 0): ?>
                    <?php while ($r = mysqli_fetch_assoc($resultado)): ?>
                        <tr>
                            <td><?= (int)$r['id_evento'] ?></td>
                            <td class="nome"><?= h($r['titulo']) ?></td>
                            <td><?= h($r['organizador']) ?></td>
                            <td><?= h($r['tipo']) ?></td>
                            <td><?= !empty($r['data_inicio']) ? date('d/m/Y', strtotime($r['data_inicio'])) : '-' ?></td>
                            <td><?= h($r['local']) ?></td>
                            <td><?= $r['vagas'] !== null ? (int)$r['vagas'] : '-' ?></td>
                            <td><?= !empty($r['destaque']) ? 'Sim' : 'Não' ?></td>
                            <td><span class="status"><?= h($r['status']) ?></span></td>
                            <td class="acoes">
                                <a href="editar_evento.php?id=<?= (int)$r['id_evento'] ?>"
                                   class="editar" title="Editar">
                                    <i class="fas fa-pen-to-square"></i> Alterar
                                </a>
                                <a href="excluir_evento.php?id=<?= (int)$r['id_evento'] ?>&csrf_token=<?= h(csrf_token()) ?>"
                                   class="excluir" title="Excluir"
                                   onclick="return confirm('Deseja excluir este evento?')">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="10" class="vazio">
                            <i class="fas fa-folder-open"></i>
                            <strong>Nenhum evento encontrado.</strong>
                            <span>Cadastre o primeiro evento ou ajuste a busca.</span>
                        </td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="rodape">
            Mostrando <strong><?= $total ?></strong> evento(s)
            <?php if ($stats): ?>
                · Programados: <?= (int)($stats['programados'] ?? 0) ?>
                · Em andamento: <?= (int)($stats['andamento'] ?? 0) ?>
                · Concluídos: <?= (int)($stats['concluidos'] ?? 0) ?>
                · Destaques: <?= (int)($stats['destaques'] ?? 0) ?>
            <?php endif; ?>
        </div>
    </div>

</div>

<?php include 'includes_painel/footer.php'; ?>
</body>
</html>
