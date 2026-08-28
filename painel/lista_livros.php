```php
<?php
include 'verifica_login.php';
include 'conexao.php';

$busca = $_GET['busca'] ?? '';
$categoria = $_GET['categoria'] ?? '';
$ano = $_GET['ano'] ?? '';
$status = $_GET['status'] ?? '';

$where = "WHERE 1=1";

if ($busca) {
    $b = mysqli_real_escape_string($conexao, $busca);
    $where .= " AND (titulo LIKE '%$b%' OR isbn LIKE '%$b%' OR autor LIKE '%$b%')";
}

if ($categoria) {
    $c = mysqli_real_escape_string($conexao, $categoria);
    $where .= " AND categoria = '$c'";
}

if ($ano) {
    $a = mysqli_real_escape_string($conexao, $ano);
    $where .= " AND ano_publicacao = '$a'";
}

if ($status) {
    $s = mysqli_real_escape_string($conexao, $status);
    $where .= " AND status = '$s'";
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
    <title>Livros</title>
    <?php include 'includes_painel/head.php'; ?>

    <style>
        body{background:#faf9fc}
        .pagina{max-width:1450px;margin:auto;padding:45px 30px}

        .cabecalho{display:flex;justify-content:space-between;align-items:center;margin-bottom:40px}
        .titulo-area{display:flex;align-items:center;gap:20px}
        .icone-titulo{
            width:82px;height:82px;border-radius:50%;
            background:linear-gradient(135deg,#c2185b,#7c2be8);
            color:#fff;display:flex;align-items:center;justify-content:center;
            font-size:35px;box-shadow:0 10px 25px rgba(124,43,232,.18)
        }
        .titulo-area h1{margin:0;font-size:38px;color:#172033}
        .titulo-area p{margin:5px 0;color:#718096;font-size:17px}

        .filtros,.estatisticas,.tabela{
            background:#fff;border-radius:22px;
            box-shadow:0 8px 30px rgba(31,41,55,.06)
        }

        .filtros{padding:30px;margin-bottom:35px}
        .filtros form{
            display:grid;
            grid-template-columns:1.5fr 1fr 1fr 1fr auto auto;
            gap:14px;align-items:end
        }

        .campo label{display:block;font-weight:600;color:#172033;margin-bottom:8px}
        .campo input,.campo select{
            width:100%;height:48px;border:1px solid #dce2ea;
            border-radius:10px;padding:0 15px;font-size:15px;
            box-sizing:border-box;background:#fff
        }

        .campo input:focus,.campo select:focus{
            outline:none;border-color:#7c2be8;
            box-shadow:0 0 0 3px rgba(124,43,232,.08)
        }

        .btn-buscar,.btn-limpar{
            height:48px;border-radius:10px;font-weight:600;
            display:flex;align-items:center;justify-content:center
        }

        .btn-buscar{
            border:0;padding:0 24px;background:#7c2be8;color:#fff
        }

        .btn-limpar{
            padding:0 20px;border:1px solid #dce2ea;
            background:#fff;color:#4a5568;text-decoration:none
        }

        .estatisticas{
            padding:28px;display:grid;
            grid-template-columns:repeat(4,1fr);margin-bottom:35px
        }

        .estatistica{
            display:flex;align-items:center;gap:18px;
            padding:10px 28px;border-right:1px solid #e6e9ef
        }

        .estatistica:last-child{border:0}

        .estatistica-icone{
            width:72px;height:72px;border-radius:20px;
            display:flex;align-items:center;justify-content:center;font-size:27px
        }

        .roxo{background:#f0e8ff;color:#7c2be8}
        .verde{background:#eaf9ee;color:#25b85a}
        .amarelo{background:#fff6df;color:#f0a500}
        .rosa{background:#fdebf1;color:#e72c61}

        .estatistica span,.estatistica small{display:block;color:#718096}
        .estatistica strong{display:block;color:#7c2be8;font-size:30px;margin:3px 0}

        .tabela{overflow:hidden}
        table{width:100%;border-collapse:collapse}
        thead{background:#4b2670}
        th{color:#fff;padding:20px;text-align:left;font-size:15px}
        td{padding:20px;border-bottom:1px solid #edf0f4;color:#172033}
        tbody tr:hover{background:#faf8ff}

        .titulo-livro{font-weight:600}

        .status{
            display:inline-block;padding:7px 14px;
            border-radius:20px;font-size:13px;font-weight:600
        }

        .status-disponivel{background:#eaf9ee;color:#20a650}
        .status-revisao{background:#fff6df;color:#e59a00}
        .status-arquivado{background:#fdebf1;color:#df2759}
        .status-padrao{background:#eee;color:#666}

        .acoes{display:flex;gap:8px}
        .acao{
            width:40px;height:40px;border-radius:10px;
            display:flex;align-items:center;justify-content:center;
            text-decoration:none;background:#fff
        }

        .editar{color:#7c2be8;border:1px solid #974cff}
        .excluir{color:#e72c61;border:1px solid #f05b7d}

        .rodape-tabela{padding:22px 28px;color:#718096;font-size:14px}

        @media(max-width:1000px){
            .filtros form{grid-template-columns:1fr 1fr}
            .estatisticas{grid-template-columns:1fr 1fr}
            .estatistica{border:0;border-bottom:1px solid #e6e9ef}
        }

        @media(max-width:700px){
            .pagina{padding:25px 15px}
            .cabecalho{align-items:flex-start}
            .filtros form,.estatisticas{grid-template-columns:1fr}
            .tabela{overflow-x:auto}
            table{min-width:900px}
        }
    </style>
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
                    value="<?= htmlspecialchars($busca) ?>">
            </div>

            <div class="campo">
                <label>Categoria</label>
                <input name="categoria" placeholder="Todas as categorias"
                    value="<?= htmlspecialchars($categoria) ?>">
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

        <div style="overflow-x:auto">
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
                            <td class="titulo-livro"><?= htmlspecialchars($r['titulo']) ?></td>
                            <td><?= htmlspecialchars($r['isbn']) ?></td>
                            <td><?= htmlspecialchars($r['autor']) ?></td>
                            <td><?= htmlspecialchars($r['categoria']) ?></td>
                            <td><?= htmlspecialchars($r['ano_publicacao']) ?></td>

                            <td>
                                <span class="status <?= $classe ?>">
                                    ● <?= htmlspecialchars($r['status']) ?>
                                </span>
                            </td>

                            <td>
                                <div class="acoes">
                                    <a href="editar_livro.php?id=<?= $r['id_livro'] ?>"
                                       class="acao editar" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <a href="excluir_livro.php?id=<?= $r['id_livro'] ?>"
                                       class="acao excluir" title="Excluir"
                                       onclick="return confirm('Deseja realmente excluir este livro?')">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>

                    <?php endwhile; ?>

                <?php else: ?>

                    <tr>
                        <td colspan="8" style="text-align:center;padding:40px;color:#718096">
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
```
