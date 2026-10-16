```php
<?php
include 'verifica_login.php';
include 'conexao.php';

$busca  = $_GET['busca'] ?? '';
$status = $_GET['status'] ?? '';

$where = 'WHERE 1=1';

if ($busca !== '') {
    $b = mysqli_real_escape_string($conexao, $busca);
    $where .= " AND (
        nome LIKE '%$b%' OR
        orgao LIKE '%$b%' OR
        cargo LIKE '%$b%' OR
        edital LIKE '%$b%'
    )";
}

if ($status !== '') {
    $s = mysqli_real_escape_string($conexao, $status);
    $where .= " AND status='$s'";
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
                    value="<?= htmlspecialchars($busca) ?>"
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
                                <?= htmlspecialchars($r['nome']) ?>
                            </td>

                            <td><?= htmlspecialchars($r['orgao']) ?></td>

                            <td><?= htmlspecialchars($r['cargo']) ?></td>

                            <td><?= htmlspecialchars($r['escolaridade']) ?></td>

                            <td><?= htmlspecialchars($r['ano']) ?></td>

                            <td>
                                <span class="status <?= $classe ?>">
                                    <span class="bolinha">●</span>
                                    <?= htmlspecialchars($r['status']) ?>
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

<style>
.container{max-width:1400px;margin:auto;padding:35px 25px 60px}
.card{background:#fff;border-radius:20px;box-shadow:0 8px 30px rgba(30,40,60,.07)}

.topo{display:flex;justify-content:space-between;align-items:center;margin-bottom:40px}
.titulo{display:flex;align-items:center;gap:20px}
.icone{width:70px;height:70px;border-radius:50%;background:linear-gradient(135deg,#c2185b,#7928e8);color:#fff;display:flex;align-items:center;justify-content:center;font-size:27px;box-shadow:0 8px 20px rgba(122,40,232,.18)}
.titulo h1{margin:0;color:#172033;font-size:32px;font-weight:700}
.titulo p{margin:6px 0 0;color:#718096;font-size:15px}

.btn{height:48px;display:inline-flex;align-items:center;justify-content:center;gap:8px;padding:0 20px;border-radius:10px;text-decoration:none;font-weight:600;cursor:pointer;box-sizing:border-box}
.btn-primary{border:0;color:#fff;background:linear-gradient(90deg,#bd1850,#8428ed);box-shadow:0 5px 12px rgba(132,40,237,.15)}
.btn-primary:hover{opacity:.92;color:#fff}
.limpar{border:1px solid #dce2eb;background:#fff;color:#344054}
.limpar:hover{background:#f8f9fc;color:#344054}

.filtros{padding:28px;margin-bottom:45px}
.filtros form{display:flex;align-items:flex-end;gap:12px}
.campo{flex:1}
.campo-status{max-width:300px}
.campo label{display:block;font-weight:600;margin-bottom:8px;color:#172033}
.campo input,.campo select{width:100%;height:48px;box-sizing:border-box;border:1px solid #dce2eb;border-radius:10px;padding:0 15px;font-size:15px;color:#172033;background:#fff}
.campo input::placeholder{color:#98a2b3}
.campo input:focus,.campo select:focus{outline:none;border-color:#8428ed;box-shadow:0 0 0 3px rgba(132,40,237,.08)}

.estatisticas{display:grid;grid-template-columns:repeat(4,1fr);padding:28px;margin-bottom:45px}
.estatisticas>div{display:flex;align-items:center;gap:18px;padding:0 25px;border-right:1px solid #e5e9ef}
.estatisticas>div:last-child{border:0}
.estatisticas i{width:64px;height:64px;border-radius:18px;display:flex;align-items:center;justify-content:center;font-size:24px;flex-shrink:0}
.estatisticas section{display:flex;flex-direction:column;gap:3px}
.estatisticas span,.estatisticas small{color:#63748a;font-size:15px}
.estatisticas strong{font-size:28px;color:#7527d9;line-height:1.2}

.roxo{background:#f1e9ff;color:#8732e9}
.verde{background:#eaf9ed;color:#32bd50}
.amarelo{background:#fff7df;color:#efa900}
.vermelho{background:#ffedf2;color:#ef2864}

.tabela{overflow:hidden}
.table-responsive{width:100%;overflow-x:auto}
table{width:100%;border-collapse:collapse;min-width:950px}
thead{background:#4f2675}
th{color:#fff;padding:18px;text-align:left;font-weight:600;font-size:15px;white-space:nowrap}
td{padding:20px 18px;border-bottom:1px solid #e8ecf1;color:#172033;font-size:15px;vertical-align:middle}
tbody tr:hover td{background:#faf9ff}
.nome{font-weight:600}

.status{display:inline-flex;align-items:center;gap:5px;padding:8px 13px;border-radius:20px;font-size:13px;font-weight:600;white-space:nowrap}
.bolinha{font-size:10px}
.status.verde{background:#e9f9ed;color:#2da847}
.status.amarelo{background:#fff5dc;color:#d99a00}
.status.vermelho{background:#ffeaee;color:#d9274f}
.status.cinza{background:#edf0f4;color:#697586}

.acoes{white-space:nowrap;display:flex;gap:8px;align-items:center}
.acoes a{display:inline-flex;width:40px;height:40px;align-items:center;justify-content:center;border-radius:9px;text-decoration:none;margin-right:5px;transition:.2s}
.editar{color:#8227ed;border:1px solid #a56aff;background:#fff}
.editar:hover{background:#f5efff}
.excluir{color:#df2851;border:1px solid #ef829b;background:#fff}
.excluir:hover{background:#fff1f4}

.vazio{text-align:center;padding:50px;color:#8995a7}
.vazio i{display:block;font-size:35px;margin-bottom:10px}

.rodape{padding:20px 28px;color:#68778c;font-size:14px}
.rodape b{color:#4f2675}

@media(max-width:1100px){
    .estatisticas{grid-template-columns:1fr 1fr;gap:25px}
    .estatisticas>div{border:0}
}

@media(max-width:800px){
    .topo{flex-direction:column;align-items:flex-start;gap:20px}
    .filtros form{flex-direction:column;align-items:stretch}
    .campo-status{max-width:none}
    .filtros .btn{width:100%}
}

@media(max-width:600px){
    .container{padding:25px 15px 40px}
    .titulo{gap:14px}
    .icone{width:58px;height:58px;font-size:22px}
    .titulo h1{font-size:26px}
    .estatisticas{grid-template-columns:1fr;padding:20px}
    .estatisticas>div{padding:12px}
}
</style>

<?php include 'includes_painel/footer.php'; ?>

</body>
</html>

