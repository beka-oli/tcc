
<?php
include 'verifica_login.php';
include 'conexao.php';

$busca  = $_GET['busca'] ?? '';
$status = $_GET['status'] ?? '';
$ano    = $_GET['ano'] ?? '';

$where = [];

if ($busca) {
    $b = mysqli_real_escape_string($conexao, $busca);
    $where[] = "(nome LIKE '%$b%' OR issn LIKE '%$b%' OR volume LIKE '%$b%')";
}

if ($status) {
    $s = mysqli_real_escape_string($conexao, $status);
    $where[] = "status='$s'";
}

if ($ano) {
    $a = mysqli_real_escape_string($conexao, $ano);
    $where[] = "ano='$a'";
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
    <title>Revistas</title>
    <?php include 'includes_painel/head.php'; ?>

    <style>
        .container{max-width:1400px;margin:auto;padding:35px 30px 60px}
        .card{background:#fff;border-radius:20px;box-shadow:0 8px 30px rgba(30,40,60,.06)}

        .topo{margin-bottom:40px}
        .titulo{display:flex;align-items:center;gap:22px}
        .icone{
            width:72px;height:72px;border-radius:50%;
            background:linear-gradient(135deg,#b71852,#8b28ed);
            color:#fff;display:flex;align-items:center;justify-content:center;
            font-size:28px
        }
        .titulo h1{margin:0;font-size:34px;color:#172033}
        .titulo p{margin:5px 0;color:#718096;font-size:16px}

        .filtros{padding:28px;margin-bottom:40px}
        .filtros form{display:flex;align-items:end;gap:18px}
        .campo{flex:1}
        .campo.busca{flex:1.5}
        .campo label{display:block;margin-bottom:9px;font-weight:600;color:#172033}
        .campo input,.campo select{
            width:100%;height:48px;border:1px solid #dce2eb;
            border-radius:10px;padding:0 15px;font-size:15px;
            box-sizing:border-box
        }

        .btn{
            height:48px;border-radius:10px;padding:0 22px;
            display:inline-flex;align-items:center;justify-content:center;
            gap:8px;text-decoration:none;font-weight:600;white-space:nowrap
        }
        .buscar{border:0;color:#fff;background:linear-gradient(90deg,#b71852,#8b28ed)}
        .limpar{border:1px solid #dce2eb;color:#344054;background:#fff}

        .estatisticas{
            display:grid;grid-template-columns:repeat(4,1fr);
            padding:28px;margin-bottom:40px
        }
        .estatistica{
            display:flex;align-items:center;gap:20px;
            padding:5px 28px;border-right:1px solid #e3e8ef
        }
        .estatistica:last-child{border:0}

        .stat-icon{
            width:64px;height:64px;min-width:64px;border-radius:18px;
            display:flex;align-items:center;justify-content:center;font-size:24px
        }
        .roxo{background:#f0e8ff;color:#812bea}
        .verde{background:#eaf9ed;color:#2dbb51}
        .amarelo{background:#fff5dc;color:#efa900}
        .vermelho{background:#ffebf1;color:#ed2862}

        .estatistica span,.estatistica small{display:block;color:#63748a}
        .estatistica strong{display:block;margin:3px 0;color:#7527d9;font-size:28px}

        .tabela{overflow:hidden}
        .table-responsive{overflow-x:auto}
        table{width:100%;border-collapse:collapse}
        thead{background:#4d2475}
        th{padding:19px 20px;color:#fff;font-size:15px;text-align:left}
        td{padding:20px;border-bottom:1px solid #e8ecf1;color:#172033}
        tr:hover td{background:#faf9ff}
        .nome{font-weight:600}

        .status{
            display:inline-flex;align-items:center;gap:6px;
            padding:8px 13px;border-radius:20px;font-size:13px;font-weight:600
        }
        .status.verde{background:#e9f9ed;color:#2da847}
        .status.amarelo{background:#fff5dc;color:#d99a00}
        .status.vermelho{background:#ffeaee;color:#d9274f}
        .status.cinza{background:#edf0f4;color:#697586}
        .ponto{font-size:11px}

        .acoes{white-space:nowrap;display:flex;gap:8px;align-items:center}
        .acoes a{
            min-width:40px;height:40px;padding:0 12px;display:inline-flex;
            align-items:center;justify-content:center;
            border-radius:10px;text-decoration:none;margin-right:5px
        }
        .editar{color:#8227ed;border:1px solid #a56aff}
        .excluir{color:#df2851;border:1px solid #ef829b}

        .rodape{padding:20px 28px;color:#68778c;font-size:14px}
        .rodape strong{color:#4d2475}
        .vazio{text-align:center;padding:50px;color:#8995a7}
        .vazio i{display:block;font-size:35px;margin-bottom:10px}

        @media(max-width:1000px){
            .filtros form{flex-wrap:wrap}
            .campo,.campo.busca{min-width:200px}
            .estatisticas{grid-template-columns:1fr 1fr;gap:25px}
            .estatistica{border:0}
        }

        @media(max-width:700px){
            .container{padding:25px 15px}
            .titulo h1{font-size:28px}
            .estatisticas{grid-template-columns:1fr}
            .estatistica{padding:10px}
        }
    </style>
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
                    value="<?= htmlspecialchars($busca) ?>"
                    placeholder="Nome, ISSN, volume...">
            </div>

            <div class="campo">
                <label>Status</label>
                <select name="status">
                    <option value="">Todos os status</option>
                    <?php foreach($statusOptions as $op): ?>
                        <option value="<?= $op ?>" <?= $status==$op?'selected':'' ?>>
                            <?= $op ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="campo">
                <label>Ano</label>
                <select name="ano">
                    <option value="">Todos os anos</option>
                    <?php while($a=mysqli_fetch_assoc($anos)): ?>
                        <option value="<?= $a['ano'] ?>" <?= $ano==$a['ano']?'selected':'' ?>>
                            <?= $a['ano'] ?>
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
                            <td><?= htmlspecialchars($r['issn']) ?></td>
                            <td class="nome"><?= htmlspecialchars($r['nome']) ?></td>
                            <td><?= htmlspecialchars($r['volume']) ?></td>
                            <td><?= htmlspecialchars($r['numero']) ?></td>
                            <td><?= htmlspecialchars($r['ano']) ?></td>

                            <td>
                                <span class="status <?= $classe ?>">
                                    <span class="ponto">●</span>
                                    <?= htmlspecialchars($r['status']) ?>
                                </span>
                            </td>

                            <td class="acoes">
                                <a href="editar_revista.php?id=<?= $r['id_revista'] ?>"
                                   class="editar" title="Editar">
                                    <i class="fas fa-pen-to-square"></i> Alterar
                                </a>

                                <a href="excluir_revista.php?id=<?= $r['id_revista'] ?>"
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
```
