<?php
include 'verifica_login.php';
include 'conexao.php';

// Garante a comunicação com o MySQL em UTF-8 completo.
mysqli_set_charset($conexao, 'utf8mb4');

$busca  = trim((string)($_GET['busca'] ?? ''));
$status = trim((string)($_GET['status'] ?? ''));

$where = 'WHERE 1=1';

if ($busca !== '') {
    $b = mysqli_real_escape_string($conexao, $busca);
    $where .= " AND (
        i.nome LIKE '%$b%' OR
        i.email LIKE '%$b%' OR
        i.cpf LIKE '%$b%' OR
        c.nome LIKE '%$b%'
    )";
}

if ($status !== '') {
    $s = mysqli_real_escape_string($conexao, $status);
    $where .= " AND LOWER(TRIM(i.status)) = LOWER('$s')";
}

$resultado = mysqli_query($conexao, "
    SELECT i.*, c.nome AS concurso
    FROM inscricoes i
    INNER JOIN concursos c ON c.id_concurso = i.id_concurso
    $where
    ORDER BY i.id_inscricao DESC
");

if (!$resultado) {
    die('Erro na consulta: ' . mysqli_error($conexao));
}

$total = mysqli_num_rows($resultado);

$stats = mysqli_fetch_assoc(mysqli_query($conexao, "
    SELECT
        COUNT(*) AS total,
        SUM(status = 'pendente') AS pendentes,
        SUM(status = 'aprovada') AS aprovadas,
        SUM(status = 'rejeitada') AS rejeitadas
    FROM inscricoes
"));

$cards = [
    ['clipboard-list', 'roxo', 'Total de Inscrições', 'total', 'Cadastradas'],
    ['clock', 'amarelo', 'Pendentes', 'pendentes', 'Inscrições'],
    ['circle-check', 'verde', 'Aprovadas', 'aprovadas', 'Inscrições'],
    ['circle-xmark', 'vermelho', 'Rejeitadas', 'rejeitadas', 'Inscrições']
];

$classes = [
    'pendente'  => 'amarelo',
    'aprovada'  => 'verde',
    'rejeitada' => 'vermelho'
];

$nomesStatus = [
    'pendente'  => 'Pendente',
    'aprovada'  => 'Aprovada',
    'rejeitada' => 'Rejeitada'
];
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscrições</title>
    <?php include 'includes_painel/head.php'; ?>

    
    
</head>

<body>

<?php include 'includes_painel/header.php'; ?>

<div class="container">

    <div class="topo">
        <div class="titulo">
            <div class="icone">
                <i class="fas fa-clipboard-list"></i>
            </div>

            <div>
                <h1>Inscrições</h1>
                <p>Gerencie as inscrições dos concursos</p>
            </div>
        </div>
    </div>

    <div class="card filtros">
        <form method="GET">

            <div class="campo">
                <label>Buscar</label>

                <input
                    type="text"
                    name="busca"
                    value="<?= h($busca) ?>"
                    placeholder="Candidato, CPF, e-mail ou concurso..."
                >
            </div>

            <div class="campo campo-status">
                <label>Status</label>

                <select name="status">
                    <option value="">Todos os status</option>

                    <option value="pendente" <?= $status === 'pendente' ? 'selected' : '' ?>>
                        Pendente
                    </option>

                    <option value="aprovada" <?= $status === 'aprovada' ? 'selected' : '' ?>>
                        Aprovada
                    </option>

                    <option value="rejeitada" <?= $status === 'rejeitada' ? 'selected' : '' ?>>
                        Rejeitada
                    </option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">
                <i class="fas fa-search"></i>
                Buscar
            </button>

            <a href="lista_inscricoes.php" class="btn limpar">
                <i class="fas fa-sync-alt"></i>
                Limpar
            </a>

        </form>
    </div>

    <div class="card estatisticas">

        <?php foreach ($cards as $card): ?>

            <div>
                <i class="fas fa-<?= $card[0] ?> <?= $card[1] ?>"></i>

                <section>
                    <span><?= $card[2] ?></span>
                    <strong><?= $stats[$card[3]] ?? 0 ?></strong>
                    <small><?= $card[4] ?></small>
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
                        <th>Candidato</th>
                        <th>Concurso</th>
                        <th>CPF</th>
                        <th>E-mail</th>
                        <th>Categoria</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>

                <tbody>

                <?php if ($total > 0): ?>

                    <?php while ($r = mysqli_fetch_assoc($resultado)): ?>

                        <?php
                        $statusAtual = $r['status'];
                        $classe = $classes[$statusAtual] ?? 'cinza';
                        $nomeStatus = $nomesStatus[$statusAtual] ?? $statusAtual;
                        ?>

                        <tr>

                            <td><?= $r['id_inscricao'] ?></td>

                            <td class="nome">
                                <?= h($r['nome']) ?>
                            </td>

                            <td>
                                <?= h($r['concurso']) ?>
                            </td>

                            <td>
                                <?= h($r['cpf']) ?>
                            </td>

                            <td>
                                <?= h($r['email']) ?>
                            </td>

                            <td>
                                <?= h($r['categoria']) ?>
                            </td>

                            <td>
                                <span class="status <?= $classe ?>">
                                    ● <?= h($nomeStatus) ?>
                                </span>
                            </td>

                            <td class="acoes">

                                <a
                                    href="editar_inscricao.php?id=<?= $r['id_inscricao'] ?>"
                                    class="editar"
                                    title="Editar"
                                >
                                    <i class="fas fa-pen-to-square"></i> Alterar
                                </a>

                                <a
                                    href="excluir_inscricao.php?id=<?= $r['id_inscricao'] ?>&csrf_token=<?=h(csrf_token())?>"
                                    class="excluir"
                                    title="Excluir"
                                    onclick="return confirm('Deseja excluir esta inscrição?')"
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
                            Nenhuma inscrição encontrada.
                        </td>
                    </tr>

                <?php endif; ?>

                </tbody>

            </table>

        </div>

        <div class="rodape">
            Mostrando <b><?= $total ?></b> inscrição(ões)
        </div>

    </div>

</div>



<?php include 'includes_painel/footer.php'; ?>

</body>
</html>

