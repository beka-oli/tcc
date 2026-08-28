
<?php
include 'verifica_login.php';
include 'conexao.php';

$busca = $_GET['busca'] ?? '';
$b = mysqli_real_escape_string($conexao, $busca);

$where = $busca
    ? "WHERE nome LIKE '%$b%' OR email LIKE '%$b%' OR instituicao LIKE '%$b%' OR especialidade LIKE '%$b%'"
    : '';

$resultado = mysqli_query($conexao, "
    SELECT * FROM autores
    $where
    ORDER BY id_autor DESC
");

$total = mysqli_num_rows($resultado);

$stats = mysqli_fetch_assoc(mysqli_query($conexao, "
    SELECT
        COUNT(*) AS total,
        COUNT(DISTINCT NULLIF(instituicao, '')) AS instituicoes,
        COUNT(DISTINCT NULLIF(especialidade, '')) AS especialidades,
        SUM(email IS NOT NULL AND email <> '') AS emails
    FROM autores
"));

$cards = [
    ['users', 'roxo', 'Total de Autores', 'total', 'Cadastrados'],
    ['building', 'verde', 'Instituições', 'instituicoes', 'Registradas'],
    ['graduation-cap', 'amarelo', 'Especialidades', 'especialidades', 'Registradas'],
    ['envelope', 'vermelho', 'E-mails', 'emails', 'Cadastrados']
];
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Autores</title>
    <?php include 'includes_painel/head.php'; ?>
</head>

<body>

<?php include 'includes_painel/header.php'; ?>

<div class="container">

    <div class="topo">
        <div class="titulo">
            <div class="icone">
                <i class="fas fa-user-edit"></i>
            </div>

            <div>
                <h1>Autores</h1>
                <p>Gerencie os autores cadastrados no sistema</p>
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
                    value="<?= htmlspecialchars($busca) ?>"
                    placeholder="Nome, e-mail, instituição ou especialidade..."
                >
            </div>

            <button type="submit" class="btn btn-primary">
                <i class="fas fa-search"></i> Buscar
            </button>

            <a href="lista_autores.php" class="btn limpar">
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
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Instituição</th>
                        <th>Especialidade</th>
                        <th>Ações</th>
                    </tr>
                </thead>

                <tbody>

                <?php if ($total): ?>

                    <?php while ($r = mysqli_fetch_assoc($resultado)): ?>

                        <tr>
                            <td><?= $r['id_autor'] ?></td>

                            <td class="nome">
                                <?= htmlspecialchars($r['nome']) ?>
                            </td>

                            <td><?= htmlspecialchars($r['email'] ?: '—') ?></td>

                            <td><?= htmlspecialchars($r['instituicao'] ?: '—') ?></td>

                            <td><?= htmlspecialchars($r['especialidade'] ?: '—') ?></td>

                            <td class="acoes">

                                <a
                                    href="editar_autor.php?id=<?= $r['id_autor'] ?>"
                                    class="editar"
                                    title="Editar"
                                >
                                    <i class="fas fa-pen-to-square"></i>
                                </a>

                                <a
                                    href="excluir_autor.php?id=<?= $r['id_autor'] ?>"
                                    class="excluir"
                                    title="Excluir"
                                    onclick="return confirm('Deseja excluir este autor?')"
                                >
                                    <i class="fas fa-trash"></i>
                                </a>

                            </td>
                        </tr>

                    <?php endwhile; ?>

                <?php else: ?>

                    <tr>
                        <td colspan="6" class="vazio">
                            <i class="fas fa-user-slash"></i>
                            Nenhum autor encontrado.
                        </td>
                    </tr>

                <?php endif; ?>

                </tbody>
            </table>
        </div>

        <div class="rodape">
            Mostrando <b><?= $total ?></b> autor(es)
        </div>

    </div>

</div>

<style>

.container{
    max-width:1400px;
    margin:auto;
    padding:35px 25px 60px;
}

.card{
    background:#fff;
    border-radius:20px;
    box-shadow:0 8px 30px rgba(30,40,60,.07);
}

.topo{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:40px;
}

.titulo{
    display:flex;
    align-items:center;
    gap:20px;
}

.icone{
    width:70px;
    height:70px;
    border-radius:50%;
    display:flex;
    align-items:center;
    justify-content:center;
    background:linear-gradient(135deg,#c2185b,#7928e8);
    color:#fff;
    font-size:27px;
}

.titulo h1{
    margin:0;
    color:#172033;
    font-size:32px;
}

.titulo p{
    margin:5px 0;
    color:#718096;
}

.btn{
    height:48px;
    padding:0 20px;
    border-radius:10px;
    display:inline-flex;
    align-items:center;
    justify-content:center;
    gap:8px;
    text-decoration:none;
    font-weight:600;
    box-sizing:border-box;
}

.btn-primary{
    border:0;
    color:#fff;
    background:linear-gradient(90deg,#bd1850,#8428ed);
}

.limpar{
    border:1px solid #dce2eb;
    background:#fff;
    color:#344054;
}

.filtros{
    padding:28px;
    margin-bottom:45px;
}

.filtros form{
    display:flex;
    align-items:flex-end;
    gap:12px;
}

.campo{
    flex:1;
}

.campo label{
    display:block;
    margin-bottom:8px;
    font-weight:600;
    color:#172033;
}

.campo input{
    width:100%;
    height:48px;
    padding:0 15px;
    box-sizing:border-box;
    border:1px solid #dce2eb;
    border-radius:10px;
    font-size:15px;
    color:#172033;
}

.campo input:focus{
    outline:none;
    border-color:#8428ed;
}

.estatisticas{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    padding:28px;
    margin-bottom:45px;
}

.estatisticas>div{
    display:flex;
    align-items:center;
    gap:18px;
    padding:0 25px;
    border-right:1px solid #e5e9ef;
}

.estatisticas>div:last-child{
    border:0;
}

.estatisticas i{
    width:64px;
    height:64px;
    border-radius:18px;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:24px;
    flex-shrink:0;
}

.estatisticas section{
    display:flex;
    flex-direction:column;
    gap:3px;
}

.estatisticas span,
.estatisticas small{
    color:#63748a;
}

.estatisticas strong{
    font-size:28px;
    color:#7527d9;
}

.roxo{
    background:#f1e9ff;
    color:#8732e9;
}

.verde{
    background:#eaf9ed;
    color:#32bd50;
}

.amarelo{
    background:#fff7df;
    color:#efa900;
}

.vermelho{
    background:#ffedf2;
    color:#ef2864;
}

.tabela{
    overflow:hidden;
}

.table-responsive{
    overflow-x:auto;
}

table{
    width:100%;
    min-width:850px;
    border-collapse:collapse;
}

thead{
    background:#4f2675;
}

th{
    padding:18px;
    color:#fff;
    text-align:left;
    font-weight:600;
    white-space:nowrap;
}

td{
    padding:20px 18px;
    border-bottom:1px solid #e8ecf1;
    color:#172033;
}

tbody tr:last-child td{
    border-bottom:0;
}

tbody tr:hover td{
    background:#faf9ff;
}

.nome{
    font-weight:600;
}

.acoes{
    white-space:nowrap;
}

.acoes a{
    width:40px;
    height:40px;
    display:inline-flex;
    align-items:center;
    justify-content:center;
    margin-right:5px;
    border-radius:9px;
    text-decoration:none;
    transition:.2s;
}

.editar{
    color:#8227ed;
    border:1px solid #a56aff;
}

.editar:hover{
    background:#f4edff;
}

.excluir{
    color:#df2851;
    border:1px solid #ef829b;
}

.excluir:hover{
    background:#fff0f3;
}

.vazio{
    padding:55px;
    text-align:center;
    color:#8995a7;
}

.vazio i{
    display:block;
    margin-bottom:12px;
    font-size:35px;
}

.rodape{
    padding:20px 28px;
    color:#68778c;
    border-top:1px solid #f0f2f5;
}

@media(max-width:1000px){
    .estatisticas{
        grid-template-columns:1fr 1fr;
        gap:25px;
    }

    .estatisticas>div{
        border:0;
    }
}

@media(max-width:700px){
    .topo{
        flex-direction:column;
        align-items:flex-start;
        gap:20px;
    }

    .filtros form{
        flex-direction:column;
        align-items:stretch;
    }

    .estatisticas{
        grid-template-columns:1fr;
    }

    .estatisticas>div{
        padding:15px;
    }

    .titulo h1{
        font-size:28px;
    }
}

</style>

<?php include 'includes_painel/footer.php'; ?>

</body>
</html>

