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
$ano    = trim((string)($_GET['ano'] ?? ''));

$where = [];

if ($busca) {
    $b = mysqli_real_escape_string($conexao, $busca);
    $where[] = "(CONVERT(nome USING utf8mb4) COLLATE utf8mb4_unicode_ci LIKE '%$b%' OR CONVERT(issn USING utf8mb4) COLLATE utf8mb4_unicode_ci LIKE '%$b%' OR CONVERT(volume USING utf8mb4) COLLATE utf8mb4_unicode_ci LIKE '%$b%')";
}

if ($status) {
    $s = mysqli_real_escape_string($conexao, $status);
    $where[] = "CONVERT(TRIM(status) USING utf8mb4) COLLATE utf8mb4_unicode_ci = CONVERT('$s' USING utf8mb4) COLLATE utf8mb4_unicode_ci";
}

if ($ano) {
    $a = mysqli_real_escape_string($conexao, $ano);
    $where[] = "TRIM(CAST(ano AS CHAR)) = '$a'";
}

$where = $where ? 'WHERE ' . implode(' AND ', $where) : '';

$resultado = mysqli_query(
    $conexao,
    "SELECT * FROM revistas $where ORDER BY id_revista DESC"
);

$stats = mysqli_fetch_assoc(mysqli_query($conexao, "
    SELECT
        COUNT(*) total,
        SUM(status='Publicado') publicadas,
        SUM(status='Em Revisão') revisao,
        SUM(status='Arquivado') arquivadas
    FROM revistas
"));

$anos = mysqli_query($conexao,
    "SELECT DISTINCT ano FROM revistas ORDER BY ano DESC"
);

$statusOptions = ['Publicado', 'Em Revisão', 'Rascunho', 'Arquivado'];
$cards = [
    ['layer-group','roxo','Total de Revistas','total','Cadastradas'],
    ['circle-check','verde','Publicadas','publicadas','Ativas'],
    ['clock','amarelo','Em Revisão','revisao','Revistas'],
    ['box-archive','vermelho','Arquivadas','arquivadas','Revistas']
];
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Revistas</title>
    <?php include 'includes_painel/head.php'; ?>

    

    
    
</head>

<body>

<?php include 'includes_painel/header.php'; ?>

<div class="container">

    <div class="topo">
        <div class="titulo">
            <div class="icone"><i class="fas fa-book-open"></i></div>
            <div>
                <h1>Revistas</h1>
                <p>Gerencie todas as revistas cadastradas no sistema</p>
            </div>
        </div>
    </div>

    <div class="card filtros">
        <form method="GET">

            <div class="campo busca">
                <label>Buscar</label>
                <input name="busca"
                    value="<?= hLista($busca) ?>"
                    placeholder="Nome, ISSN, volume...">
            </div>

            <div class="campo">
                <label>Status</label>
                <select name="status">
                    <option value="">Todos os status</option>
                    <?php foreach($statusOptions as $op): ?>
                        <option value="<?= hLista($op) ?>" <?= $status==$op?'selected':'' ?>>
                            <?= hLista($op) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="campo">
                <label>Ano</label>
                <select name="ano">
                    <option value="">Todos os anos</option>
                    <?php while($a=mysqli_fetch_assoc($anos)): ?>
                        <option value="<?= hLista($a['ano']) ?>" <?= $ano==$a['ano']?'selected':'' ?>>
                            <?= hLista($a['ano']) ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <button class="btn buscar">
                <i class="fas fa-search"></i> Buscar
            </button>

            <a href="lista_revistas.php" class="btn limpar">
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
                    <strong><?= $stats[$c[3]] ?? 0 ?></strong>
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
                        <th>ISSN</th>
                        <th>Nome da Revista</th>
                        <th>Volume</th>
                        <th>Número</th>
                        <th>Ano</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>

                <tbody>

                <?php if(mysqli_num_rows($resultado)): ?>

                    <?php while($r=mysqli_fetch_assoc($resultado)): ?>

                        <?php
                        $classes = [
                            'Publicado'=>'verde',
                            'Em Revisão'=>'amarelo',
                            'Arquivado'=>'vermelho'
                        ];
                        $classe = $classes[$r['status']] ?? 'cinza';
                        ?>

                        <tr>
                            <td><?= $r['id_revista'] ?></td>
                            <td><?= hLista($r['issn']) ?></td>
                            <td class="nome"><?= hLista($r['nome']) ?></td>
                            <td><?= hLista($r['volume']) ?></td>
                            <td><?= hLista($r['numero']) ?></td>
                            <td><?= hLista($r['ano']) ?></td>

                            <td>
                                <span class="status <?= $classe ?>">
                                    <span class="ponto">●</span>
                                    <?= hLista($r['status']) ?>
                                </span>
                            </td>

                            <td class="acoes">
                                <a href="editar_revista.php?id=<?= $r['id_revista'] ?>"
                                   class="editar" title="Editar">
                                    <i class="fas fa-pen-to-square"></i> Alterar
                                </a>

                                <a href="excluir_revista.php?id=<?= $r['id_revista'] ?>&csrf_token=<?=h(csrf_token())?>"
                                   class="excluir" title="Excluir"
                                   onclick="return confirm('Deseja excluir esta revista?')">
                                    <i class="fas fa-trash"></i> Excluir
                                </a>
                            </td>
                        </tr>

                    <?php endwhile; ?>

                <?php else: ?>

                    <tr>
                        <td colspan="8" class="vazio">
                            <i class="fas fa-folder-open"></i>
                            Nenhuma revista encontrada.
                        </td>
                    </tr>

                <?php endif; ?>

                </tbody>
            </table>

        </div>

        <div class="rodape">
            Mostrando <strong><?= mysqli_num_rows($resultado) ?></strong> registro(s)
        </div>

    </div>

</div>

<?php include 'includes_painel/footer.php'; ?>




</body>
</html>

