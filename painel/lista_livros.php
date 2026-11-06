<?php
include 'verifica_login.php';
include 'conexao.php';

// Garante a comunicação com o MySQL em UTF-8 completo.
mysqli_set_charset($conexao, 'utf8mb4');

$busca = trim((string)($_GET['busca'] ?? ''));
$categoria = trim((string)($_GET['categoria'] ?? ''));
$ano = trim((string)($_GET['ano'] ?? ''));
$status = trim((string)($_GET['status'] ?? ''));

$where = "WHERE 1=1";

if ($busca) {
    $b = mysqli_real_escape_string($conexao, $busca);
    $where .= " AND (CONVERT(titulo USING utf8mb4) COLLATE utf8mb4_unicode_ci LIKE '%$b%' OR CONVERT(isbn USING utf8mb4) COLLATE utf8mb4_unicode_ci LIKE '%$b%' OR CONVERT(autor USING utf8mb4) COLLATE utf8mb4_unicode_ci LIKE '%$b%')";
}

if ($categoria) {
    $c = mysqli_real_escape_string($conexao, $categoria);
    // Categoria é um campo de texto livre: busca parcial em vez de igualdade exata.
    $where .= " AND CONVERT(categoria USING utf8mb4) COLLATE utf8mb4_unicode_ci LIKE '%$c%'";
}

if ($ano) {
    $a = mysqli_real_escape_string($conexao, $ano);
    $where .= " AND TRIM(CAST(ano_publicacao AS CHAR)) = '$a'";
}

if ($status) {
    $s = mysqli_real_escape_string($conexao, $status);
    $where .= " AND CONVERT(TRIM(status) USING utf8mb4) COLLATE utf8mb4_unicode_ci = CONVERT('$s' USING utf8mb4) COLLATE utf8mb4_unicode_ci";
}

$resultado = mysqli_query(
    $conexao,
    "SELECT * FROM livros $where ORDER BY id_livro DESC"
);

$stats = mysqli_fetch_assoc(mysqli_query($conexao, "
    SELECT
        COUNT(*) AS total,
        SUM(status = 'Disponível') AS disponiveis,
        SUM(status = 'Em Revisão') AS revisao,
        SUM(status = 'Arquivado') AS arquivados
    FROM livros
"));

$anos = mysqli_query($conexao, "
    SELECT DISTINCT ano_publicacao
    FROM livros
    WHERE ano_publicacao IS NOT NULL
    ORDER BY ano_publicacao DESC
");
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
    </div>

    <div class="filtros">
        <form method="GET">

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
                    <?php while ($a = mysqli_fetch_assoc($anos)): ?>
                        <option value="<?= $a['ano_publicacao'] ?>"
                            <?= $ano == $a['ano_publicacao'] ? 'selected' : '' ?>>
                            <?= $a['ano_publicacao'] ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="campo">
                <label>Status</label>
                <select name="status">
                    <option value="">Todos os status</option>
                    <?php foreach (['Disponível','Em Revisão','Arquivado'] as $op): ?>
                        <option value="<?= $op ?>" <?= $status == $op ? 'selected' : '' ?>>
                            <?= $op ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button class="btn-buscar">
                <i class="fas fa-search"></i>&nbsp; Buscar
            </button>

            <a href="lista_livros.php" class="btn-limpar">
                <i class="fas fa-sync-alt"></i>&nbsp; Limpar
            </a>

        </form>
    </div>

    <div class="estatisticas">

        <?php
        $cards = [
            ['layer-group','roxo','Total de Livros','total','Cadastrados'],
            ['check-circle','verde','Disponíveis','disponiveis','Ativos'],
            ['clock','amarelo','Em Revisão','revisao','Livros'],
            ['archive','rosa','Arquivados','arquivados','Livros']
        ];
        ?>

        <?php foreach ($cards as $card): ?>
            <div class="estatistica">
                <div class="estatistica-icone <?= $card[1] ?>">
                    <i class="fas fa-<?= $card[0] ?>"></i>
                </div>
                <div>
                    <span><?= $card[2] ?></span>
                    <strong><?= $stats[$card[3]] ?? 0 ?></strong>
                    <small><?= $card[4] ?></small>
                </div>
            </div>
        <?php endforeach; ?>

    </div>

    <div class="tabela">

        <div class="livros-tabela-scroll">
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

                <?php if (mysqli_num_rows($resultado)): ?>

                    <?php while ($r = mysqli_fetch_assoc($resultado)): ?>

                        <?php
                        $classes = [
                            'Disponível' => 'status-disponivel',
                            'Em Revisão' => 'status-revisao',
                            'Arquivado' => 'status-arquivado'
                        ];
                        $classe = $classes[$r['status']] ?? 'status-padrao';
                        ?>

                        <tr>
                            <td><?= $r['id_livro'] ?></td>
                            <td class="titulo-livro"><?= h($r['titulo']) ?></td>
                            <td><?= h($r['isbn']) ?></td>
                            <td><?= h($r['autor']) ?></td>
                            <td><?= h($r['categoria']) ?></td>
                            <td><?= h($r['ano_publicacao']) ?></td>

                            <td>
                                <span class="status <?= $classe ?>">
                                    ● <?= h($r['status']) ?>
                                </span>
                            </td>

                            <td>
                                <div class="acoes">
                                    <a href="editar_livro.php?id=<?= $r['id_livro'] ?>"
                                       class="acao editar" title="Editar">
                                        <i class="fas fa-edit"></i> Alterar
                                    </a>

                                    <a href="excluir_livro.php?id=<?= $r['id_livro'] ?>&csrf_token=<?=h(csrf_token())?>"
                                       class="acao excluir" title="Excluir"
                                       onclick="return confirm('Deseja realmente excluir este livro?')">
                                        <i class="fas fa-trash"></i> Excluir
                                    </a>
                                </div>
                            </td>
                        </tr>

                    <?php endwhile; ?>

                <?php else: ?>

                    <tr>
                        <td colspan="8" class="livros-sem-registros">
                            <i class="fas fa-book fa-2x"></i><br><br>
                            Nenhum livro encontrado.
                        </td>
                    </tr>

                <?php endif; ?>

                </tbody>
            </table>
        </div>

        <div class="rodape-tabela">
            Mostrando <?= mysqli_num_rows($resultado) ?> registro(s)
        </div>

    </div>

</div>

<?php include 'includes_painel/footer.php'; ?>

</body>
</html>

