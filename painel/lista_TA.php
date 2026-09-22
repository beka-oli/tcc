
<?php
include 'verifica_login.php';
include 'conexao.php';

$busca = trim($_GET['busca'] ?? '');
$where = '';

if ($busca !== '') {
    $b = mysqli_real_escape_string($conexao, $busca);
    $where = "WHERE titulo LIKE '%$b%'
        OR tipo LIKE '%$b%'
        OR autor LIKE '%$b%'
        OR curso LIKE '%$b%'
        OR instituicao LIKE '%$b%'
        OR orientador LIKE '%$b%'
        OR palavras_chave LIKE '%$b%'";
}

$resultado = mysqli_query($conexao, "
    SELECT * FROM trabalhos_academicos
    $where
    ORDER BY id_trabalho DESC
");

if (!$resultado) {
    die('Erro: ' . htmlspecialchars(mysqli_error($conexao)));
}

$total = mysqli_num_rows($resultado);

$stats = mysqli_fetch_assoc(mysqli_query($conexao, "
    SELECT
        COUNT(*) AS total,
        COUNT(DISTINCT autor) AS autores,
        COUNT(DISTINCT curso) AS cursos,
        MAX(data_publicacao) AS ultima_publicacao
    FROM trabalhos_academicos
"));

$ultima = !empty($stats['ultima_publicacao'])
    ? date('d/m/Y', strtotime($stats['ultima_publicacao']))
    : '-';

$cards = [
    ['book-open', 'roxo', 'Total de Trabalhos', $stats['total'] ?? 0, 'Cadastrados'],
    ['user-graduate', 'verde', 'Autores', $stats['autores'] ?? 0, 'Autores cadastrados'],
    ['graduation-cap', 'amarelo', 'Cursos', $stats['cursos'] ?? 0, 'Cursos registrados'],
    ['calendar', 'vermelho', 'Última Publicação', $ultima, 'Data']
];
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Trabalhos Acadêmicos</title>
    <?php include 'includes_painel/head.php'; ?>

    <style>
        .container{max-width:1400px;margin:auto;padding:35px 30px 60px}
        .card{background:#fff;border-radius:20px;box-shadow:0 8px 30px rgba(30,40,60,.06)}

        .topo{display:flex;justify-content:space-between;align-items:center;margin-bottom:40px}
        .titulo{display:flex;align-items:center;gap:22px}
        .icone{
            width:72px;height:72px;border-radius:50%;
            background:linear-gradient(135deg,#b71852,#8b28ed);
            color:#fff;display:flex;align-items:center;justify-content:center;font-size:27px
        }
        .titulo h1{margin:0;font-size:34px;color:#172033}
        .titulo p{margin:5px 0;color:#718096;font-size:16px}

        .btn{
            height:48px;padding:0 22px;border-radius:10px;
            display:inline-flex;align-items:center;justify-content:center;
            gap:8px;text-decoration:none;font-weight:600;white-space:nowrap;
            cursor:pointer;box-sizing:border-box
        }
        .buscar{
            color:#fff;border:0;
            background:linear-gradient(90deg,#b71852,#8b28ed)
        }
        .limpar{color:#344054;background:#fff;border:1px solid #dce2eb}

        .filtros{padding:28px;margin-bottom:40px}
        .filtros form{display:flex;align-items:end;gap:18px}
        .campo{flex:1}
        .campo label{display:block;margin-bottom:9px;font-weight:600;color:#172033}
        .campo input{
            width:100%;height:48px;border:1px solid #dce2eb;border-radius:10px;
            padding:0 15px;font-size:15px;box-sizing:border-box
        }
        .campo input:focus{outline:none;border-color:#8b28ed;box-shadow:0 0 0 3px rgba(139,40,237,.08)}

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
        .estatistica span,.estatistica small{display:block;color:#63748a}
        .estatistica strong{display:block;margin:3px 0;color:#7527d9;font-size:25px}

        .roxo{background:#f0e8ff;color:#812bea}
        .verde{background:#eaf9ed;color:#2dbb51}
        .amarelo{background:#fff5dc;color:#efa900}
        .vermelho{background:#ffebf1;color:#ed2862}

        .tabela{overflow:hidden}
        .table-responsive{overflow-x:auto}
        table{width:100%;border-collapse:collapse;min-width:1200px}
        thead{background:#4d2475}
        th{padding:19px 20px;color:#fff;font-size:15px;font-weight:600;text-align:left;white-space:nowrap}
        td{padding:18px 20px;border-bottom:1px solid #e8ecf1;color:#172033;vertical-align:middle}
        tbody tr:hover td{background:#faf9ff}
        .nome{font-weight:600}

        .tipo{
            display:inline-flex;padding:7px 12px;border-radius:20px;
            background:#f1e9ff;color:#7527d9;font-size:13px;font-weight:600;white-space:nowrap
        }

        .arquivo{
            display:inline-flex;align-items:center;justify-content:center;gap:7px;
            padding:8px 12px;border-radius:9px;background:#fff0f3;color:#df2851;
            text-decoration:none;font-size:13px;font-weight:600;white-space:nowrap
        }
        .arquivo:hover{background:#ffe2e8}
        .sem-arquivo{color:#8995a7;font-size:13px}

        .acoes{white-space:nowrap}
        .acoes a{
            width:40px;height:40px;display:inline-flex;align-items:center;
            justify-content:center;border-radius:10px;text-decoration:none;
            margin-right:5px;transition:.2s
        }
        .editar{color:#8227ed;border:1px solid #a56aff;background:#fff}
        .editar:hover{background:#f4edff;transform:translateY(-1px)}
        .excluir{color:#df2851;border:1px solid #ef829b;background:#fff}
        .excluir:hover{background:#fff0f3;transform:translateY(-1px)}

        .vazio{text-align:center;padding:60px 20px;color:#8995a7}
        .vazio i{display:block;font-size:38px;margin-bottom:12px;color:#b6a6c5}
        .vazio strong{display:block;color:#63748a;font-size:16px;margin-bottom:5px}

        .rodape{
            padding:20px 28px;color:#68778c;font-size:14px;
            border-top:1px solid #f0f1f4
        }
        .rodape strong{color:#4d2475}

        @media(max-width:1000px){
            .filtros form{flex-wrap:wrap}
            .campo{min-width:250px}
            .estatisticas{grid-template-columns:1fr 1fr;gap:25px}
            .estatistica{border:0}
        }

        @media(max-width:700px){
            .container{padding:25px 15px}
            .topo{flex-wrap:wrap;gap:20px}
            .titulo{gap:14px}
            .icone{width:58px;height:58px;font-size:22px}
            .titulo h1{font-size:27px}
            .filtros form{flex-direction:column;align-items:stretch}
            .filtros .btn{width:100%}
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
            <div class="icone"><i class="fas fa-graduation-cap"></i></div>
            <div>
                <h1>Trabalhos Acadêmicos</h1>
                <p>Gerencie os trabalhos acadêmicos cadastrados</p>
            </div>
        </div>
    </div>

    <div class="card filtros">
        <form method="GET">
            <div class="campo">
                <label>Buscar</label>
                <input type="text" name="busca"
                    value="<?= htmlspecialchars($busca) ?>"
                    placeholder="Título, autor, curso, instituição ou tipo...">
            </div>

            <button type="submit" class="btn buscar">
                <i class="fas fa-search"></i> Buscar
            </button>

            <a href="lista_trabalhos.php" class="btn limpar">
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
                    <strong><?= htmlspecialchars($c[3]) ?></strong>
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
                        <th>Título</th>
                        <th>Tipo</th>
                        <th>Autor</th>
                        <th>Curso</th>
                        <th>Instituição</th>
                        <th>Orientador</th>
                        <th>Publicação</th>
                        <th>Arquivo</th>
                        <th>Ações</th>
                    </tr>
                </thead>

                <tbody>

                <?php if($total > 0): ?>

                    <?php while($r = mysqli_fetch_assoc($resultado)): ?>

                        <tr>

                            <td><?= htmlspecialchars($r['id_trabalho']) ?></td>

                            <td class="nome">
                                <?= htmlspecialchars($r['titulo']) ?>
                            </td>

                            <td>
                                <span class="tipo">
                                    <?= htmlspecialchars($r['tipo']) ?>
                                </span>
                            </td>

                            <td><?= htmlspecialchars($r['autor']) ?></td>

                            <td><?= htmlspecialchars($r['curso']) ?></td>

                            <td><?= htmlspecialchars($r['instituicao']) ?></td>

                            <td>
                                <?= !empty($r['orientador'])
                                    ? htmlspecialchars($r['orientador'])
                                    : '-' ?>
                            </td>

                            <td>
                                <?= !empty($r['data_publicacao'])
                                    ? date('d/m/Y', strtotime($r['data_publicacao']))
                                    : '-' ?>
                            </td>

                            <td>

                                <?php if(!empty($r['arquivo'])): ?>

                                    <a
                                        href="uploads/trabalhos/<?= rawurlencode($r['arquivo']) ?>"
                                        target="_blank"
                                        class="arquivo"
                                        title="Abrir arquivo"
                                    >
                                        <i class="fas fa-file-pdf"></i> Abrir
                                    </a>

                                <?php else: ?>

                                    <span class="sem-arquivo">
                                        Sem arquivo
                                    </span>

                                <?php endif; ?>

                            </td>

                            <td class="acoes">

                                <a
                                    href="editar_trabalho.php?id=<?= $r['id_trabalho'] ?>"
                                    class="editar"
                                    title="Editar"
                                >
                                    <i class="fas fa-pen-to-square"></i>
                                </a>

                                <a
                                    href="excluir_trabalho.php?id=<?= $r['id_trabalho'] ?>"
                                    class="excluir"
                                    title="Excluir"
                                    onclick="return confirm('Deseja excluir este trabalho acadêmico?')"
                                >
                                    <i class="fas fa-trash"></i>
                                </a>

                            </td>

                        </tr>

                    <?php endwhile; ?>

                <?php else: ?>

                    <tr>
                        <td colspan="10" class="vazio">
                            <i class="fas fa-folder-open"></i>
                            <strong>Nenhum trabalho acadêmico encontrado.</strong>
                            <span>Tente realizar uma nova busca.</span>
                        </td>
                    </tr>

                <?php endif; ?>

                </tbody>

            </table>

        </div>

        <div class="rodape">
            Mostrando <strong><?= $total ?></strong> trabalho(s) acadêmico(s)
        </div>

    </div>

</div>

<?php include 'includes_painel/footer.php'; ?>

</body>
</html>

