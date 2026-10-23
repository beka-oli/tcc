
<?php
include 'verifica_login.php';
include 'conexao.php';

// Garante a comunicação com o MySQL em UTF-8 completo.
mysqli_set_charset($conexao, 'utf8mb4');

$busca = $_GET['busca'] ?? '';
$b = mysqli_real_escape_string($conexao, $busca);

$where = $busca
    ? "WHERE a.titulo LIKE '%$b%' OR r.nome LIKE '%$b%' OR au.nome LIKE '%$b%'"
    : '';

$resultado = mysqli_query($conexao, "
    SELECT a.*, r.nome AS revista,
           GROUP_CONCAT(au.nome SEPARATOR ', ') AS autores
    FROM artigos a
    INNER JOIN edicoes e ON e.id_edicao = a.id_edicao
    INNER JOIN revistas r ON r.id_revista = e.id_revista
    LEFT JOIN artigo_autor aa ON aa.id_artigo = a.id_artigo
    LEFT JOIN autores au ON au.id_autor = aa.id_autor
    $where
    GROUP BY a.id_artigo
    ORDER BY a.id_artigo DESC
");

$total = mysqli_num_rows($resultado);

$stats = mysqli_fetch_assoc(mysqli_query($conexao, "
    SELECT
        COUNT(*) total,
        SUM(status='Publicado') publicados,
        SUM(status='Em Revisão') revisao,
        SUM(status='Arquivado') arquivados
    FROM artigos
"));

$cards = [
    ['file-lines','roxo','Total de Artigos','total','Cadastrados'],
    ['book-open','verde','Artigos Publicados','publicados','Publicados'],
    ['clock','amarelo','Em Revisão','revisao','Artigos'],
    ['box-archive','vermelho','Arquivados','arquivados','Artigos']
];
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artigos</title>
    <?php include 'includes_painel/head.php'; ?>

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
            <div class="icone">
                <i class="fas fa-file-lines"></i>
            </div>

            <div>
                <h1>Artigos</h1>
                <p>Gerencie os artigos científicos cadastrados no sistema</p>
            </div>
        </div>

    </div>


    <div class="card filtros">

        <form method="GET">

            <div class="campo">
                <label>Buscar</label>

                <input
                    name="busca"
                    value="<?= htmlspecialchars($busca) ?>"
                    placeholder="Artigo, revista ou autor..."
                >
            </div>

            <button class="btn btn-primary">
                <i class="fas fa-search"></i> Buscar
            </button>

            <a href="lista_artigos.php" class="btn limpar">
                <i class="fas fa-sync-alt"></i> Limpar
            </a>

        </form>

    </div>


    <div class="card estatisticas">

        <?php foreach ($cards as $c): ?>

            <div>

                <i class="fas fa-<?= $c[0] ?> <?= $c[1] ?>"></i>

                <section>
                    <span><?= $c[2] ?></span>
                    <strong><?= $stats[$c[3]] ?? 0 ?></strong>
                    <small><?= $c[4] ?></small>
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
                        <th>Artigo</th>
                        <th>Revista</th>
                        <th>Autores</th>
                        <th>Páginas</th>
                        <th>DOI</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>

                <tbody>

                <?php if ($total): ?>

                    <?php while ($r = mysqli_fetch_assoc($resultado)): ?>

                        <?php
                        $status = $r['status'];

                        $classe = [
                            'Publicado' => 'verde',
                            'Em Revisão' => 'amarelo',
                            'Arquivado' => 'vermelho'
                        ][$status] ?? 'cinza';
                        ?>

                        <tr>

                            <td><?= $r['id_artigo'] ?></td>

                            <td class="nome">
                                <?= htmlspecialchars($r['titulo']) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($r['revista']) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($r['autores'] ?? '—') ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($r['paginas']) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($r['doi'] ?: '—') ?>
                            </td>

                            <td>
                                <span class="status <?= $classe ?>">
                                    ● <?= htmlspecialchars($status) ?>
                                </span>
                            </td>

                            <td class="acoes">

                                <a
                                    href="editar_artigo.php?id=<?= $r['id_artigo'] ?>"
                                    class="editar"
                                    title="Editar">
                                    <i class="fas fa-pen-to-square"></i> Alterar
                                </a>

                                <a
                                    href="excluir_artigo.php?id=<?= $r['id_artigo'] ?>&csrf_token=<?=h(csrf_token())?>"
                                    class="excluir"
                                    title="Excluir"
                                    onclick="return confirm('Deseja excluir este artigo?')">
                                    <i class="fas fa-trash"></i> Excluir
                                </a>

                            </td>

                        </tr>

                    <?php endwhile; ?>

                <?php else: ?>

                    <tr>
                        <td colspan="8" class="vazio">
                            <i class="fas fa-folder-open"></i>
                            Nenhum artigo encontrado.
                        </td>
                    </tr>

                <?php endif; ?>

                </tbody>

            </table>

        </div>

        <div class="rodape">
            Mostrando <b><?= $total ?></b> artigo(s)
        </div>

    </div>

</div>


<style>

.container{max-width:1400px;margin:auto;padding:35px 25px 60px}
.card{background:#fff;border-radius:20px;box-shadow:0 8px 30px rgba(30,40,60,.07)}

.topo{
    display:flex;justify-content:space-between;
    align-items:center;margin-bottom:40px
}

.titulo{display:flex;align-items:center;gap:20px}

.icone{
    width:70px;height:70px;border-radius:50%;
    background:linear-gradient(135deg,#c2185b,#7928e8);
    color:#fff;display:flex;align-items:center;
    justify-content:center;font-size:27px
}

.titulo h1{margin:0;color:#172033;font-size:32px}
.titulo p{margin:5px 0;color:#718096}

.btn{
    height:48px;display:inline-flex;
    align-items:center;justify-content:center;
    gap:8px;padding:0 20px;border-radius:10px;
    text-decoration:none;font-weight:600
}

.btn-primary{
    border:0;color:#fff;
    background:linear-gradient(90deg,#bd1850,#8428ed)
}

.limpar{
    border:1px solid #dce2eb;
    background:#fff;color:#344054
}

.filtros{padding:28px;margin-bottom:45px}

.filtros form{
    display:flex;align-items:end;gap:12px
}

.campo{flex:1}

.campo label{
    display:block;font-weight:600;
    margin-bottom:8px;color:#172033
}

.campo input{
    width:100%;height:48px;
    box-sizing:border-box;border:1px solid #dce2eb;
    border-radius:10px;padding:0 15px;font-size:15px
}

.campo input:focus{
    outline:none;border-color:#8428ed
}

.estatisticas{
    display:grid;grid-template-columns:repeat(4,1fr);
    padding:28px;margin-bottom:45px
}

.estatisticas>div{
    display:flex;align-items:center;gap:18px;
    padding:0 25px;border-right:1px solid #e5e9ef
}

.estatisticas>div:last-child{border:0}

.estatisticas i{
    width:64px;height:64px;border-radius:18px;
    display:flex;align-items:center;justify-content:center;
    font-size:24px;flex-shrink:0
}

.estatisticas section{
    display:flex;flex-direction:column;gap:3px
}

.estatisticas span,.estatisticas small{color:#63748a}
.estatisticas strong{font-size:28px;color:#7527d9}

.roxo{background:#f1e9ff;color:#8732e9}
.verde{background:#eaf9ed;color:#32bd50}
.amarelo{background:#fff7df;color:#efa900}
.vermelho{background:#ffedf2;color:#ef2864}

.tabela{overflow:hidden}
.table-responsive{overflow-x:auto}

table{width:100%;border-collapse:collapse}
thead{background:#4f2675}

th{
    color:#fff;padding:18px;
    text-align:left;font-weight:600
}

td{
    padding:20px 18px;
    border-bottom:1px solid #e8ecf1;
    color:#172033
}

tr:hover td{background:#faf9ff}
.nome{font-weight:600}

.status{
    display:inline-block;padding:8px 13px;
    border-radius:20px;font-size:13px;font-weight:600
}

.status.verde{background:#e9f9ed;color:#2da847}
.status.amarelo{background:#fff5dc;color:#d99a00}
.status.vermelho{background:#ffeaee;color:#d9274f}
.status.cinza{background:#edf0f4;color:#697586}

.acoes{white-space:nowrap;display:flex;gap:8px;align-items:center}

.acoes a{
    display:inline-flex;width:40px;height:40px;
    align-items:center;justify-content:center;
    border-radius:9px;text-decoration:none;margin-right:5px
}

.editar{color:#8227ed;border:1px solid #a56aff}
.excluir{color:#df2851;border:1px solid #ef829b}

.vazio{
    text-align:center;padding:50px;color:#8995a7
}

.vazio i{
    display:block;font-size:35px;margin-bottom:10px
}

.rodape{
    padding:20px 28px;color:#68778c
}

@media(max-width:1000px){

    .estatisticas{
        grid-template-columns:1fr 1fr;
        gap:25px
    }

    .estatisticas>div{border:0}

}

@media(max-width:700px){

    .topo{
        flex-direction:column;
        align-items:flex-start;
        gap:20px
    }

    .filtros form{
        flex-direction:column;
        align-items:stretch
    }

    .estatisticas{
        grid-template-columns:1fr
    }

    .estatisticas>div{
        padding:15px
    }

}


        /* Padronização final das ações e responsividade das listagens Medeia. */
        .acoes {
            display: flex !important;
            align-items: center;
            justify-content: center;
            flex-wrap: nowrap;
            gap: 8px;
            white-space: nowrap;
            min-width: 150px;
        }
        .acoes form { display: inline-flex; margin: 0; padding: 0; }
        .acoes a, .acoes button, a.acao, button.acao {
            box-sizing: border-box;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            min-height: 38px;
            padding: 8px 11px;
            border-radius: 10px;
            font: inherit;
            font-size: 13px;
            font-weight: 650;
            line-height: 1.2;
            text-decoration: none;
            white-space: nowrap;
            cursor: pointer;
            background: #fff;
            transition: background-color .18s ease, box-shadow .18s ease, transform .18s ease;
        }
        .acoes a.editar, .acoes a.alterar, .acoes .editar, .acoes .alterar {
            color: #8427ed;
            border: 1px solid #a56aff;
        }
        .acoes a.editar:hover, .acoes a.alterar:hover, .acoes .editar:hover, .acoes .alterar:hover {
            background: #f7f0ff;
            box-shadow: 0 3px 9px rgba(132,39,237,.12);
        }
        .acoes a.excluir, .acoes button.excluir, .acoes .excluir {
            color: #df2851;
            border: 1px solid #ef829b;
        }
        .acoes a.excluir:hover, .acoes button.excluir:hover, .acoes .excluir:hover {
            background: #fff1f4;
            box-shadow: 0 3px 9px rgba(223,40,81,.10);
        }
        .acoes i, .acoes svg { flex: 0 0 auto; }
        .table-responsive { width: 100%; max-width: 100%; overflow-x: auto; -webkit-overflow-scrolling: touch; }
        .card.tabela, .usuarios-box { min-width: 0; }
        table th, table td { vertical-align: middle; }
        @media (max-width: 700px) {
            .topo, .cabecalho { align-items: flex-start; flex-direction: column; }
            .filtros, .card.filtros { padding: 16px; }
            table { min-width: 680px; }
        }
</style>

<?php include 'includes_painel/footer.php'; ?>

</body>
</html>
