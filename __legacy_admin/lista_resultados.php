
<?php
include 'verifica_login.php';
include 'conexao.php';

$busca = trim($_GET['busca'] ?? '');
$where = '';

if ($busca !== '') {
    $b = mysqli_real_escape_string($conexao, $busca);
    $where = "WHERE i.nome LIKE '%$b%'
              OR i.cpf LIKE '%$b%'
              OR c.nome LIKE '%$b%'";
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
        <div style='font-family:Arial,sans-serif;padding:30px;margin:30px;background:#fff0f3;border:1px solid #f5b5c2;border-radius:12px;color:#9b1735'>
            <h3 style='margin-top:0'>Erro ao carregar os resultados</h3>
            <p>O banco de dados retornou o seguinte erro:</p>
            <strong>" . htmlspecialchars(mysqli_error($conexao)) . "</strong>
        </div>
    ");
}

$total = mysqli_num_rows($resultado);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
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
                    value="<?= htmlspecialchars($busca) ?>"
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
                            <td><?= htmlspecialchars($r['id_resultado']) ?></td>

                            <td class="nome">
                                <?= htmlspecialchars($r['candidato']) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($r['cpf']) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($r['concurso']) ?>
                            </td>

                            <td>
                                <span class="nota">
                                    <?= htmlspecialchars($r['nota']) ?>
                                </span>
                            </td>

                            <td>
                                <span class="classificacao">
                                    <?= htmlspecialchars($r['classificacao']) ?>
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
                                    href="excluir_resultado.php?id=<?= $r['id_resultado'] ?>"
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

<style>
.container{max-width:1400px;margin:auto;padding:35px 25px 60px}
.card{background:#fff;border-radius:20px;border:1px solid #f0edf4;box-shadow:0 8px 30px rgba(30,40,60,.07)}

.topo{display:flex;justify-content:space-between;align-items:center;margin-bottom:40px}
.titulo{display:flex;align-items:center;gap:20px}
.icone{width:70px;height:70px;border-radius:50%;background:linear-gradient(135deg,#c2185b,#7928e8);color:#fff;display:flex;align-items:center;justify-content:center;font-size:27px;box-shadow:0 8px 20px rgba(121,40,232,.15)}
.titulo h1{margin:0;color:#4f2675;font-size:32px;font-weight:700}
.titulo p{margin:6px 0 0;color:#718096;font-size:15px}

.btn{height:48px;display:inline-flex;align-items:center;justify-content:center;gap:8px;padding:0 20px;border-radius:10px;text-decoration:none;font-weight:600;cursor:pointer;box-sizing:border-box}
.btn-primary{color:#fff;border:0;background:linear-gradient(90deg,#bd1850,#8428ed)}
.limpar{color:#344054;background:#fff;border:1px solid #dce2eb}

.filtros{padding:28px;margin-bottom:30px}
.filtros form{display:flex;align-items:flex-end;gap:12px}
.campo{flex:1}
.campo label{display:block;margin-bottom:8px;color:#172033;font-weight:600}
.campo input{width:100%;height:48px;box-sizing:border-box;padding:0 15px;border:1px solid #dce2eb;border-radius:10px;font-size:15px;color:#172033}
.campo input:focus{outline:none;border-color:#8428ed;box-shadow:0 0 0 3px rgba(132,40,237,.08)}

.estatisticas{display:flex;padding:25px;margin-bottom:30px}
.estatistica-item{display:flex;align-items:center;gap:18px}
.estatistica-icone{width:64px;height:64px;border-radius:18px;display:flex;align-items:center;justify-content:center;font-size:24px}
.estatistica-info{display:flex;flex-direction:column;gap:3px}
.estatistica-info span{color:#63748a;font-size:15px}
.estatistica-info strong{color:#7527d9;font-size:28px;line-height:1.1}
.estatistica-info small{color:#8995a7}
.roxo{background:#f1e9ff;color:#8732e9}

.tabela{overflow:hidden}
.table-responsive{width:100%;overflow-x:auto}
table{width:100%;border-collapse:collapse;min-width:950px}
thead{background:#4f2675}
th{color:#fff;padding:19px 18px;text-align:left;font-size:15px;font-weight:600;white-space:nowrap}
td{padding:20px 18px;border-bottom:1px solid #e8ecf1;color:#172033;font-size:15px;vertical-align:middle}
tbody tr{background:#fff}
tbody tr:hover td{background:#faf9ff}
.nome{font-weight:600;color:#172033}

.nota{display:inline-flex;align-items:center;justify-content:center;min-width:45px;padding:7px 12px;border-radius:20px;background:#f1e9ff;color:#7527d9;font-weight:600}
.classificacao{display:inline-flex;align-items:center;justify-content:center;min-width:45px;padding:7px 12px;border-radius:20px;background:#eaf9ed;color:#2da847;font-weight:600}

.acoes{white-space:nowrap;display:flex;gap:8px;align-items:center}
.acoes a{min-width:40px;height:40px;padding:0 12px;display:inline-flex;align-items:center;justify-content:center;border-radius:9px;text-decoration:none;margin-right:5px;transition:.2s}
.editar{color:#8227ed;border:1px solid #a56aff;background:#fff}
.editar:hover{background:#f5efff}
.excluir{color:#df2851;border:1px solid #ef829b;background:#fff}
.excluir:hover{background:#fff0f3}

.vazio{text-align:center;padding:60px 20px;color:#8995a7}
.vazio i{display:block;font-size:38px;margin-bottom:12px;color:#b6a6c5}
.vazio strong{display:block;color:#63748a;font-size:16px;margin-bottom:5px}
.vazio span{display:block;color:#9aa5b5}

.rodape{padding:20px 28px;color:#68778c;border-top:1px solid #f0f1f4}
.rodape b{color:#4f2675}

@media(max-width:700px){
    .container{padding:25px 15px 50px}
    .titulo{gap:14px}
    .icone{width:58px;height:58px;font-size:22px}
    .titulo h1{font-size:26px}
    .filtros form{flex-direction:column;align-items:stretch}
    .filtros .btn{width:100%}
    .estatisticas{padding:20px}
}
</style>

<?php include 'includes_painel/footer.php'; ?>

</body>
</html>
```
