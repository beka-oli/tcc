
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
function hLista($valor) {
    return htmlspecialchars(textoLista($valor), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}


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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

    <style>
        /* Identidade visual consistente das listagens Medeia (sem interferir no header). */
        body { background: #f5f6fa; color: #252238; font-family: Inter, "Segoe UI", Arial, sans-serif; }
        body > .container, .pagina, .usuarios-page { box-sizing: border-box; }
        body > .container, .container {
            width: min(100% - 40px, 1420px);
            max-width: 1420px;
            margin: 0 auto;
            padding: 34px 0 56px;
        }
        .pagina { width: min(100% - 40px, 1420px); margin: 0 auto; padding: 34px 0 56px; }
        .topo, .cabecalho { display: flex; align-items: center; justify-content: space-between; gap: 22px; margin-bottom: 28px; }
        .titulo, .titulo-area { display: flex; align-items: center; gap: 17px; }
        .titulo h1, .titulo-area h1 { color: #30213e; font-size: clamp(1.55rem, 2.5vw, 2rem); font-weight: 750; letter-spacing: -.035em; margin: 0 0 5px; }
        .titulo p, .titulo-area p { color: #777386; margin: 0; line-height: 1.5; }
        .icone, .icone-titulo { flex: 0 0 auto; box-shadow: 0 8px 20px rgba(139, 44, 245, .16); }
        .card, .usuarios-box { background: #fff; border: 1px solid #ece9f2; border-radius: 16px; box-shadow: 0 8px 28px rgba(38, 25, 58, .055); }
        .filtros, .card.filtros { padding: 22px; margin-bottom: 24px; }
        .campo label { display: block; margin-bottom: 7px; color: #4d465b; font-size: .86rem; font-weight: 650; }
        .campo input, .campo select, .campo textarea, input[type="text"], input[type="search"], input[type="email"], select {
            max-width: 100%; box-sizing: border-box; border: 1px solid #ded9e8; border-radius: 9px;
            background: #fff; color: #302b3b; padding: 11px 13px; min-height: 42px; outline: none;
            transition: border-color .18s ease, box-shadow .18s ease;
        }
        .campo input:focus, .campo select:focus, .campo textarea:focus, input:focus, select:focus {
            border-color: #9b45dc; box-shadow: 0 0 0 3px rgba(155, 69, 220, .12);
        }
        .estatisticas, .card.estatisticas { margin-bottom: 24px; }
        .card.tabela { overflow: hidden; padding: 0; }
        .table-responsive { width: 100%; overflow-x: auto; }
        table, .tabela { width: 100%; border-collapse: collapse; background: #fff; }
        table thead th, .tabela thead th {
            background: #faf8fc; color: #61576f; font-size: .76rem; font-weight: 750;
            letter-spacing: .045em; text-transform: uppercase; white-space: nowrap;
            padding: 15px 17px; border-bottom: 1px solid #ebe7f1;
        }
        table tbody td, .tabela tbody td { color: #514b5e; padding: 15px 17px; border-bottom: 1px solid #f0edf4; vertical-align: middle; }
        table tbody tr:hover, .tabela tbody tr:hover { background: #fcfaff; }
        table tbody tr:last-child td, .tabela tbody tr:last-child td { border-bottom: 0; }
        .btn, .btn-grad, .btn-buscar, .btn.buscar { border-radius: 9px; font-weight: 650; transition: transform .16s ease, box-shadow .16s ease; }
        .btn:hover, .btn-grad:hover, .btn-buscar:hover, .btn.buscar:hover { transform: translateY(-1px); }
        .acoes { display: flex; align-items: center; justify-content: center; gap: 8px; }
        .status, .badge { display: inline-flex; align-items: center; justify-content: center; border-radius: 999px; padding: 5px 10px; font-size: .78rem; font-weight: 700; white-space: nowrap; }
        .vazio { padding: 35px 18px; text-align: center; color: #81798d; }
        .rodape, .rodape-tabela { color: #81798d; font-size: .85rem; padding-top: 16px; }
        @media (max-width: 700px) {
            body > .container, .container, .pagina { width: min(100% - 24px, 1420px); padding-top: 22px; }
            .topo, .cabecalho { align-items: flex-start; flex-direction: column; }
            .filtros, .card.filtros { padding: 16px; }
            table thead th, table tbody td, .tabela thead th, .tabela tbody td { padding: 12px 13px; }
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


<style>
/* Correções específicas para impedir sobreposição dos botões de ação. */
.card.tabela { overflow: hidden; }
.table-responsive { width: 100%; overflow-x: auto; }
table { min-width: 1050px; }
td.acoes {
    display: table-cell;
    white-space: nowrap;
    min-width: 205px;
    vertical-align: middle;
}
td.acoes a {
    display: inline-flex;
    box-sizing: border-box;
    width: auto;
    min-width: 82px;
    height: 40px;
    padding: 0 11px;
    margin: 0 5px 0 0;
    gap: 6px;
    justify-content: center;
    align-items: center;
    white-space: nowrap;
    line-height: 1;
    font-size: 14px;
    font-weight: 600;
    vertical-align: middle;
}
td.acoes a i { flex: 0 0 auto; }
@media (max-width: 700px) {
    td.acoes { min-width: 205px; }
    td.acoes a { min-width: 82px; }
}
</style>

</body>
</html>

