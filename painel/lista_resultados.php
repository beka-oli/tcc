
<?php
include 'verifica_login.php';
include 'conexao.php';

// Garante a comunicação com o MySQL em UTF-8 completo.
mysqli_set_charset($conexao, 'utf8mb4');

$busca = trim($_GET['busca'] ?? '');
$where = '';

if ($busca !== '') {
    $b = mysqli_real_escape_string($conexao, $busca);
    $where = "WHERE (
                 CONVERT(i.nome USING utf8mb4) COLLATE utf8mb4_unicode_ci LIKE '%$b%'
              OR CONVERT(i.cpf USING utf8mb4) COLLATE utf8mb4_unicode_ci LIKE '%$b%'
              OR CONVERT(c.nome USING utf8mb4) COLLATE utf8mb4_unicode_ci LIKE '%$b%'
              )";
}

$sql = "SELECT r.*, i.nome AS candidato, i.cpf, c.nome AS concurso
        FROM resultados r
        INNER JOIN inscricoes i ON i.id_inscricao = r.id_inscricao
        INNER JOIN concursos c ON c.id_concurso = i.id_concurso
        $where
        ORDER BY r.id_resultado DESC";

$resultado = mysqli_query($conexao, $sql);

if (!$resultado) {
    die("
        <div class='erro-resultados'>
            <h3 class='erro-resultados-titulo'>Erro ao carregar os resultados</h3>
            <p>O banco de dados retornou o seguinte erro:</p>
            <strong>" . h(mysqli_error($conexao)) . "</strong>
        </div>
    ");
}

$total = mysqli_num_rows($resultado);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados</title>
    <?php include 'includes_painel/head.php'; ?>

    
    
</head>

<body>

<?php include 'includes_painel/header.php'; ?>

<div class="container">

    <div class="topo">
        <div class="titulo">
            <div class="icone">
                <i class="fas fa-square-poll-vertical"></i>
            </div>

            <div>
                <h1>Resultados</h1>
                <p>Consulte os resultados dos candidatos</p>
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
                    placeholder="Candidato, CPF ou concurso..."
                >
            </div>

            <button type="submit" class="btn btn-primary">
                <i class="fas fa-search"></i>
                Buscar
            </button>

            <a href="lista_resultados.php" class="btn limpar">
                <i class="fas fa-sync-alt"></i>
                Limpar
            </a>

        </form>
    </div>

    <div class="card estatisticas">
        <div class="estatistica-item">

            <div class="estatistica-icone roxo">
                <i class="fas fa-square-poll-vertical"></i>
            </div>

            <div class="estatistica-info">
                <span>Total de Resultados</span>
                <strong><?= $total ?></strong>
                <small>Resultados cadastrados</small>
            </div>

        </div>
    </div>

    <div class="card tabela">

        <div class="table-responsive">
            <table>

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Candidato</th>
                        <th>CPF</th>
                        <th>Concurso</th>
                        <th>Nota</th>
                        <th>Classificação</th>
                        <th>Ações</th>
                    </tr>
                </thead>

                <tbody>

                <?php if ($total > 0): ?>

                    <?php while ($r = mysqli_fetch_assoc($resultado)): ?>

                        <tr>
                            <td><?= h($r['id_resultado']) ?></td>

                            <td class="nome">
                                <?= h($r['candidato']) ?>
                            </td>

                            <td>
                                <?= h($r['cpf']) ?>
                            </td>

                            <td>
                                <?= h($r['concurso']) ?>
                            </td>

                            <td>
                                <span class="nota">
                                    <?= h($r['nota']) ?>
                                </span>
                            </td>

                            <td>
                                <span class="classificacao">
                                    <?= h($r['classificacao']) ?>
                                </span>
                            </td>

                            <td class="acoes">

                                <a
                                    class="editar"
                                    href="editar_resultado.php?id=<?= $r['id_resultado'] ?>"
                                    title="Editar"
                                >
                                    <i class="fas fa-pen-to-square"></i> Alterar
                                </a>

                                <a
                                    class="excluir"
                                    href="excluir_resultado.php?id=<?= $r['id_resultado'] ?>&csrf_token=<?=h(csrf_token())?>"
                                    title="Excluir"
                                    onclick="return confirm('Deseja excluir este resultado?')"
                                >
                                    <i class="fas fa-trash"></i> Excluir
                                </a>

                            </td>
                        </tr>

                    <?php endwhile; ?>

                <?php else: ?>

                    <tr>
                        <td colspan="7" class="vazio">
                            <i class="fas fa-folder-open"></i>
                            <strong>Nenhum resultado encontrado.</strong>
                            <span>Tente realizar uma nova busca.</span>
                        </td>
                    </tr>

                <?php endif; ?>

                </tbody>
            </table>
        </div>

        <div class="rodape">
            Mostrando <b><?= $total ?></b> resultado(s)
        </div>

    </div>

</div>



<?php include 'includes_painel/footer.php'; ?>

</body>
</html>

