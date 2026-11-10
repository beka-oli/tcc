<?php
include 'verifica_login.php';
include 'conexao.php';
include '_layout.php';
mysqli_set_charset($conexao, 'utf8mb4');

$id = id_get('id');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = esc($conexao, $_POST['titulo'] ?? '');
    $instrutor = esc($conexao, $_POST['instrutor'] ?? '');
    $instituicao = esc($conexao, $_POST['instituicao'] ?? '');
    $modalidade = esc($conexao, $_POST['modalidade'] ?? '');
    $data_inicio = esc($conexao, $_POST['data_inicio'] ?? '');
    $data_fim = esc($conexao, $_POST['data_fim'] ?? '');
    $carga_horaria = esc($conexao, $_POST['carga_horaria'] ?? '');
    $vagas = esc($conexao, $_POST['vagas'] ?? '');
    $categoria = esc($conexao, $_POST['categoria'] ?? '');
    $nivel = esc($conexao, $_POST['nivel'] ?? '');
    $descricao = esc($conexao, $_POST['descricao'] ?? '');
    $status = esc($conexao, $_POST['status'] ?? '');

    $sql = "UPDATE cursos SET titulo = '$titulo', instrutor = '$instrutor', instituicao = '$instituicao', modalidade = '$modalidade', data_inicio = " . ($data_inicio === '' ? 'NULL' : "'$data_inicio'") . ", data_fim = " . ($data_fim === '' ? 'NULL' : "'$data_fim'") . ", carga_horaria = " . ($carga_horaria === '' ? 'NULL' : "'$carga_horaria'") . ", vagas = " . ($vagas === '' ? 'NULL' : "'$vagas'") . ", categoria = '$categoria', nivel = '$nivel', descricao = '$descricao', status = '$status' WHERE id_curso = $id";
    $ok = mysqli_query($conexao, $sql);
    if (!$ok) {
        erro(mysqli_error($conexao));
    }
    redirect('lista_cursos.php');
}

$r = mysqli_query($conexao, "SELECT * FROM cursos WHERE id_curso = $id LIMIT 1");
if (!$r || mysqli_num_rows($r) !== 1) {
    erro('Registro não encontrado.');
}
$row = mysqli_fetch_assoc($r);
?>
<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <title>Editar Curso</title>
    <?php include 'includes_painel/head.php'; ?>
</head>
<body>
<?php include 'includes_painel/header.php'; ?>
<div class="crud">
    <div class="card">
        <h1>Editar Curso</h1>
        <form method="post">
            <input type="hidden" name="csrf_token" value="<?= h(csrf_token()) ?>">
            <div class="grid">
                <div class="campo">
                    <label>Título</label>
                    <input type="text" name="titulo" value="<?= h($row['titulo'] ?? '') ?>">
                </div>
                <div class="campo">
                    <label>Instrutor</label>
                    <input type="text" name="instrutor" value="<?= h($row['instrutor'] ?? '') ?>">
                </div>
                <div class="campo">
                    <label>Instituição</label>
                    <input type="text" name="instituicao" value="<?= h($row['instituicao'] ?? '') ?>">
                </div>
                <div class="campo">
                    <label>Modalidade</label>
                    <select name="modalidade">
                        <option value="Presencial" <?= ($row['modalidade'] ?? '') === 'Presencial' ? 'selected' : '' ?>>Presencial</option>
                        <option value="Online" <?= ($row['modalidade'] ?? '') === 'Online' ? 'selected' : '' ?>>Online</option>
                        <option value="Híbrido" <?= ($row['modalidade'] ?? '') === 'Híbrido' ? 'selected' : '' ?>>Híbrido</option>
                    </select>
                </div>
                <div class="campo">
                    <label>Data início</label>
                    <input type="date" name="data_inicio" value="<?= h($row['data_inicio'] ?? '') ?>">
                </div>
                <div class="campo">
                    <label>Data fim</label>
                    <input type="date" name="data_fim" value="<?= h($row['data_fim'] ?? '') ?>">
                </div>
                <div class="campo">
                    <label>Carga horária</label>
                    <input type="number" name="carga_horaria" value="<?= h($row['carga_horaria'] ?? '') ?>">
                </div>
                <div class="campo">
                    <label>Vagas</label>
                    <input type="number" name="vagas" value="<?= h($row['vagas'] ?? '') ?>">
                </div>
                <div class="campo">
                    <label>Categoria</label>
                    <input type="text" name="categoria" value="<?= h($row['categoria'] ?? '') ?>">
                </div>
                <div class="campo">
                    <label>Nível</label>
                    <select name="nivel">
                        <option value="Iniciante" <?= ($row['nivel'] ?? '') === 'Iniciante' ? 'selected' : '' ?>>Iniciante</option>
                        <option value="Intermediário" <?= ($row['nivel'] ?? '') === 'Intermediário' ? 'selected' : '' ?>>Intermediário</option>
                        <option value="Avançado" <?= ($row['nivel'] ?? '') === 'Avançado' ? 'selected' : '' ?>>Avançado</option>
                        <option value="Todos os níveis" <?= ($row['nivel'] ?? '') === 'Todos os níveis' ? 'selected' : '' ?>>Todos os níveis</option>
                    </select>
                </div>
                <div class="campo full">
                    <label>Descrição</label>
                    <textarea name="descricao" rows="4"><?= h($row['descricao'] ?? '') ?></textarea>
                </div>
                <div class="campo">
                    <label>Status</label>
                    <select name="status">
                        <option value="Aberto" <?= ($row['status'] ?? '') === 'Aberto' ? 'selected' : '' ?>>Aberto</option>
                        <option value="Em andamento" <?= ($row['status'] ?? '') === 'Em andamento' ? 'selected' : '' ?>>Em andamento</option>
                        <option value="Concluído" <?= ($row['status'] ?? '') === 'Concluído' ? 'selected' : '' ?>>Concluído</option>
                        <option value="Cancelado" <?= ($row['status'] ?? '') === 'Cancelado' ? 'selected' : '' ?>>Cancelado</option>
                    </select>
                </div>
            </div>
            <div class="acoes">
                <button class="btn salvar" type="submit">Salvar alterações</button>
                <a class="btn voltar" href="lista_cursos.php">Cancelar</a>
            </div>
        </form>
    </div>
</div>
</body>
</html>
