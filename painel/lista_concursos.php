<?php
include 'verifica_login.php';
include 'conexao.php';

// Garante a comunicação com o MySQL em UTF-8 completo.
mysqli_set_charset($conexao, 'utf8mb4');

// Corrige sequências de texto que já chegaram gravadas com codificação incorreta.
function textoLista($valor) {
    $valor = (string)($valor ?? '');
    return strtr($valor, [
        'Ã¡'=>'á','Ã£'=>'ã','Ã¢'=>'â','Ã©'=>'é','Ãª'=>'ê','Ã­'=>'í',
        'Ã³'=>'ó','Ã´'=>'ô','Ãµ'=>'õ','Ãº'=>'ú','Ã§'=>'ç',
        'Ã‰'=>'É','ÃŠ'=>'Ê','Ã“'=>'Ó','Ã”'=>'Ô','Ã•'=>'Õ','Ãš'=>'Ú','Ã‡'=>'Ç'
    ]);
}
function hLista($valor) { return h(textoLista($valor)); }


$busca  = trim((string)($_GET['busca'] ?? ''));
$status = trim((string)($_GET['status'] ?? ''));

$where = 'WHERE 1=1';

if ($busca !== '') {
    $b = mysqli_real_escape_string($conexao, $busca);
    $where .= " AND (
        CONVERT(nome USING utf8mb4) COLLATE utf8mb4_unicode_ci LIKE '%$b%' OR
        CONVERT(orgao USING utf8mb4) COLLATE utf8mb4_unicode_ci LIKE '%$b%' OR
        CONVERT(cargo USING utf8mb4) COLLATE utf8mb4_unicode_ci LIKE '%$b%' OR
        CONVERT(edital USING utf8mb4) COLLATE utf8mb4_unicode_ci LIKE '%$b%'
    )";
}

if ($status !== '') {
    $s = mysqli_real_escape_string($conexao, $status);
    $where .= " AND CONVERT(TRIM(status) USING utf8mb4) COLLATE utf8mb4_unicode_ci = CONVERT('$s' USING utf8mb4) COLLATE utf8mb4_unicode_ci";
}

$resultado = mysqli_query($conexao, "
    SELECT *
    FROM concursos
    $where
    ORDER BY id_concurso DESC
");

if (!$resultado) {
    die('Erro na consulta: ' . mysqli_error($conexao));
}

$stats = mysqli_fetch_assoc(mysqli_query($conexao, "
    SELECT
        COUNT(*) AS total,
        SUM(status = 'Aberto') AS abertos,
        SUM(status = 'Em andamento') AS andamento,
        SUM(status = 'Encerrado') AS encerrados
    FROM concursos
"));

$totalResultados = mysqli_num_rows($resultado);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Concursos</title>
    <?php include 'includes_painel/head.php'; ?>

    
    
</head>

<body>

<?php include 'includes_painel/header.php'; ?>

<div class="container">

    <div class="topo">
        <div class="titulo">
            <div class="icone">
                <i class="fas fa-graduation-cap"></i>
            </div>

            <div>
                <h1>Concursos</h1>
                <p>Gerencie os concursos cadastrados no sistema</p>
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
                    value="<?= hLista($busca) ?>"
                    placeholder="Concurso, órgão, cargo ou edital..."
                >
            </div>

            <div class="campo campo-status">
                <label>Status</label>

                <select name="status">
                    <option value="">Todos os status</option>
                    <option value="Aberto" <?= $status == 'Aberto' ? 'selected' : '' ?>>
                        Aberto
                    </option>
                    <option value="Em andamento" <?= $status == 'Em andamento' ? 'selected' : '' ?>>
                        Em andamento
                    </option>
                    <option value="Encerrado" <?= $status == 'Encerrado' ? 'selected' : '' ?>>
                        Encerrado
                    </option>
                    <option value="Suspenso" <?= $status == 'Suspenso' ? 'selected' : '' ?>>
                        Suspenso
                    </option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">
                <i class="fas fa-search"></i>
                Buscar
            </button>

            <a href="lista_concursos.php" class="btn limpar">
                <i class="fas fa-sync-alt"></i>
                Limpar
            </a>

        </form>
    </div>

    <div class="card estatisticas">

        <div>
            <i class="fas fa-layer-group roxo"></i>
            <section>
                <span>Total de Concursos</span>
                <strong><?= $stats['total'] ?? 0 ?></strong>
                <small>Cadastrados</small>
            </section>
        </div>

        <div>
            <i class="fas fa-calendar-check verde"></i>
            <section>
                <span>Concursos Abertos</span>
                <strong><?= $stats['abertos'] ?? 0 ?></strong>
                <small>Inscrições abertas</small>
            </section>
        </div>

        <div>
            <i class="fas fa-clock amarelo"></i>
            <section>
                <span>Em Andamento</span>
                <strong><?= $stats['andamento'] ?? 0 ?></strong>
                <small>Concursos</small>
            </section>
        </div>

        <div>
            <i class="fas fa-box-archive vermelho"></i>
            <section>
                <span>Encerrados</span>
                <strong><?= $stats['encerrados'] ?? 0 ?></strong>
                <small>Concursos</small>
            </section>
        </div>

    </div>

    <div class="card tabela">

        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Concurso</th>
                        <th>Órgão</th>
                        <th>Cargo</th>
                        <th>Escolaridade</th>
                        <th>Ano</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>

                <tbody>

                <?php if ($totalResultados > 0): ?>

                    <?php while ($r = mysqli_fetch_assoc($resultado)): ?>

                        <?php
                        $classes = [
                            'Aberto' => 'verde',
                            'Em andamento' => 'amarelo',
                            'Encerrado' => 'vermelho',
                            'Suspenso' => 'cinza'
                        ];

                        $classe = $classes[$r['status']] ?? 'cinza';
                        ?>

                        <tr>
                            <td><?= $r['id_concurso'] ?></td>

                            <td class="nome">
                                <?= hLista($r['nome']) ?>
                            </td>

                            <td><?= hLista($r['orgao']) ?></td>

                            <td><?= hLista($r['cargo']) ?></td>

                            <td><?= hLista($r['escolaridade']) ?></td>

                            <td><?= hLista($r['ano']) ?></td>

                            <td>
                                <span class="status <?= $classe ?>">
                                    <span class="bolinha">●</span>
                                    <?= hLista($r['status']) ?>
                                </span>
                            </td>

                            <td class="acoes">
                                <a
                                    href="editar_concurso.php?id=<?= $r['id_concurso'] ?>"
                                    class="editar"
                                    title="Editar"
                                >
                                    <i class="fas fa-pen-to-square"></i> Alterar
                                </a>

                                <a
                                    href="excluir_concurso.php?id=<?= $r['id_concurso'] ?>&csrf_token=<?=h(csrf_token())?>"
                                    class="excluir"
                                    title="Excluir"
                                    onclick="return confirm('Deseja excluir este concurso?')"
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
                            Nenhum concurso encontrado.
                        </td>
                    </tr>

                <?php endif; ?>

                </tbody>
            </table>
        </div>

        <div class="rodape">
            Mostrando <b><?= $totalResultados ?></b> concurso(s)
        </div>

    </div>

</div>



<?php include 'includes_painel/footer.php'; ?>




</body>
</html>

