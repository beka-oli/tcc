<?php
include('conexao.php');

$tabelas = [
    'revistas'    => ['id_revista', 'Revistas'],
    'livros'      => ['id_livro', 'Livros'],
    'edicoes'     => ['id_edicao', 'Edições'],
    'artigos'     => ['id_artigo', 'Artigos'],
    'autores'     => ['id_autor', 'Autores'],
    'concursos'   => ['id_concurso', 'Concursos'],
    'inscricoes'  => ['id_inscricao', 'Inscrições'],
    'resultados'  => ['id_resultado', 'Resultados']
];

if (!isset($tabela) || !isset($tabelas[$tabela])) exit('Tabela inválida');

$id = $tabelas[$tabela][0];
$titulo = $tabelas[$tabela][1];

$colunas = [];
$r = mysqli_query($conexao, "SHOW COLUMNS FROM `$tabela`");

while ($c = mysqli_fetch_assoc($r)) {
    $colunas[] = $c;
}

$busca = mysqli_real_escape_string($conexao, $_GET['busca'] ?? '');
$status = mysqli_real_escape_string($conexao, $_GET['status'] ?? '');

$where = "1=1";

if ($busca) {
    $condicoes = [];

    foreach ($colunas as $c) {
        if (
            stripos($c['Type'], 'char') !== false ||
            stripos($c['Type'], 'text') !== false
        ) {
            $campo = $c['Field'];
            $condicoes[] = "`$campo` LIKE '%$busca%'";
        }
    }

    if ($condicoes)
        $where .= " AND (" . implode(' OR ', $condicoes) . ")";
}

if ($status && in_array('status', array_column($colunas, 'Field'))) {
    $where .= " AND status = '$status'";
}

$sql = "SELECT * FROM `$tabela` WHERE $where ORDER BY `$id` DESC";
$resultado = mysqli_query($conexao, $sql);

$mostrar = array_slice($colunas, 0, 6);
?>

<div class="container-fluid py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="titulo-lista">
            <i class="fas fa-list"></i> <?= $titulo ?>
        </h3>

        <a href="cad_<?= rtrim($tabela, 's') ?>.php" class="btn btn-primary">
            <i class="fas fa-plus"></i> Novo
        </a>
    </div>

    <div class="card filtro mb-4">
        <div class="card-body">

            <form method="GET" class="row g-2">

                <div class="col-md-8">
                    <input
                        type="text"
                        name="busca"
                        class="form-control"
                        placeholder="Pesquisar..."
                        value="<?= htmlspecialchars($busca) ?>"
                    >
                </div>

                <?php if (in_array('status', array_column($colunas, 'Field'))): ?>

                <div class="col-md-2">
                    <select name="status" class="form-select">
                        <option value="">Todos os status</option>

                        <option value="Aberto" <?= $status == 'Aberto' ? 'selected' : '' ?>>
                            Aberto
                        </option>

                        <option value="Em andamento" <?= $status == 'Em andamento' ? 'selected' : '' ?>>
                            Em andamento
                        </option>

                        <option value="Publicado" <?= $status == 'Publicado' ? 'selected' : '' ?>>
                            Publicado
                        </option>

                        <option value="pendente" <?= $status == 'pendente' ? 'selected' : '' ?>>
                            Pendente
                        </option>

                        <option value="aprovada" <?= $status == 'aprovada' ? 'selected' : '' ?>>
                            Aprovada
                        </option>

                        <option value="rejeitada" <?= $status == 'rejeitada' ? 'selected' : '' ?>>
                            Rejeitada
                        </option>
                    </select>
                </div>

                <?php endif; ?>

                <div class="col-md-2">
                    <button class="btn btn-primary w-100">
                        <i class="fas fa-search"></i> Buscar
                    </button>
                </div>

            </form>

        </div>
    </div>

    <div class="card tabela-card">
        <div class="table-responsive">

            <table class="table table-hover align-middle mb-0">

                <thead>
                    <tr>

                        <?php foreach ($mostrar as $c): ?>
                            <th><?= ucfirst(str_replace('_', ' ', $c['Field'])) ?></th>
                        <?php endforeach; ?>

                        <th class="text-center">Ações</th>

                    </tr>
                </thead>

                <tbody>

                <?php if (mysqli_num_rows($resultado) > 0): ?>

                    <?php while ($linha = mysqli_fetch_assoc($resultado)): ?>

                        <tr>

                            <?php foreach ($mostrar as $c): ?>

                                <?php
                                $campo = $c['Field'];
                                $valor = $linha[$campo];

                                if (strlen($valor) > 80)
                                    $valor = substr($valor, 0, 80) . '...';
                                ?>

                                <td><?= htmlspecialchars($valor ?? '') ?></td>

                            <?php endforeach; ?>

                            <td class="text-center">

                                <a
                                    href="editar.php?tabela=<?= $tabela ?>&id=<?= $linha[$id] ?>"
                                    class="btn btn-sm btn-editar"
                                    title="Editar"
                                >
                                    <i class="fas fa-edit"></i>
                                </a>

                                <a
                                    href="excluir.php?tabela=<?= $tabela ?>&id=<?= $linha[$id] ?>"
                                    class="btn btn-sm btn-excluir"
                                    onclick="return confirm('Deseja realmente excluir este registro?')"
                                    title="Excluir"
                                >
                                    <i class="fas fa-trash"></i>
                                </a>

                            </td>

                        </tr>

                    <?php endwhile; ?>

                <?php else: ?>

                    <tr>
                        <td colspan="<?= count($mostrar) + 1 ?>" class="text-center py-5">
                            Nenhum registro encontrado.
                        </td>
                    </tr>

                <?php endif; ?>

                </tbody>

            </table>

        </div>
    </div>

</div>

<style>
.container-fluid{
    max-width:1450px;
}

.titulo-lista{
    color:#4d1235;
    font-size:25px;
    font-weight:600;
}

.titulo-lista i{
    color:#b61d45;
    margin-right:8px;
}

.card{
    border:0;
    border-radius:14px;
    box-shadow:0 5px 18px rgba(0,0,0,.07);
}

.filtro{
    border-top:4px solid #b61d45;
}

.form-control,
.form-select{
    height:40px;
    border-radius:8px;
    font-size:13px;
}

.btn-primary{
    border:0;
    border-radius:8px;
    background:linear-gradient(90deg,#b61d45,#8b2cf5);
}

.table thead th{
    background:linear-gradient(90deg,#b61d45,#8b2cf5);
    color:#fff;
    font-size:13px;
    white-space:nowrap;
}

.table td{
    font-size:13px;
    color:#555;
}

.btn-editar{
    color:#8b2cf5;
    border:1px solid #8b2cf5;
}

.btn-excluir{
    color:#b61d45;
    border:1px solid #b61d45;
}

.btn-editar:hover,
.btn-excluir:hover{
    color:#fff;
    background:linear-gradient(90deg,#b61d45,#8b2cf5);
}
</style>