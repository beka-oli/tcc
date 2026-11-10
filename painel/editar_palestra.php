<?php
include 'verifica_login.php';
include 'conexao.php';
include '_layout.php';
mysqli_set_charset($conexao, 'utf8mb4');

$id = id_get('id');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = esc($conexao, $_POST['titulo'] ?? '');
    $palestrante = esc($conexao, $_POST['palestrante'] ?? '');
    $instituicao = esc($conexao, $_POST['instituicao'] ?? '');
    $data_palestra = esc($conexao, $_POST['data_palestra'] ?? '');
    $hora_inicio = esc($conexao, $_POST['hora_inicio'] ?? '');
    $hora_fim = esc($conexao, $_POST['hora_fim'] ?? '');
    $local = esc($conexao, $_POST['local'] ?? '');
    $carga_horaria = esc($conexao, $_POST['carga_horaria'] ?? '');
    $vagas = esc($conexao, $_POST['vagas'] ?? '');
    $categoria = esc($conexao, $_POST['categoria'] ?? '');
    $descricao = esc($conexao, $_POST['descricao'] ?? '');
    $status = esc($conexao, $_POST['status'] ?? '');

    $sql = "UPDATE palestras SET titulo = '$titulo', palestrante = '$palestrante', instituicao = '$instituicao', data_palestra = " . ($data_palestra === '' ? 'NULL' : "'$data_palestra'") . ", hora_inicio = " . ($hora_inicio === '' ? 'NULL' : "'$hora_inicio'") . ", hora_fim = " . ($hora_fim === '' ? 'NULL' : "'$hora_fim'") . ", local = '$local', carga_horaria = " . ($carga_horaria === '' ? 'NULL' : "'$carga_horaria'") . ", vagas = " . ($vagas === '' ? 'NULL' : "'$vagas'") . ", categoria = '$categoria', descricao = '$descricao', status = '$status' WHERE id_palestra = $id";
    $ok = mysqli_query($conexao, $sql);
    if (!$ok) {
        erro(mysqli_error($conexao));
    }
    redirect('lista_palestras.php');
}

$r = mysqli_query($conexao, "SELECT * FROM palestras WHERE id_palestra = $id LIMIT 1");
if (!$r || mysqli_num_rows($r) !== 1) {
    erro('Registro não encontrado.');
}
$row = mysqli_fetch_assoc($r);
?>
<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <title>Editar Palestra</title>
    <?php include 'includes_painel/head.php'; ?>
</head>
<body>
<?php include 'includes_painel/header.php'; ?>
<div class="crud">
    <div class="card">
        <h1>Editar Palestra</h1>
        <form method="post">
            <input type="hidden" name="csrf_token" value="<?= h(csrf_token()) ?>">
            <div class="grid">
                <div class="campo">
                    <label>Título</label>
                    <input type="text" name="titulo" value="<?= h($row['titulo'] ?? '') ?>">
                </div>
                <div class="campo">
                    <label>Palestrante</label>
                    <input type="text" name="palestrante" value="<?= h($row['palestrante'] ?? '') ?>">
                </div>
                <div class="campo">
                    <label>Instituição</label>
                    <input type="text" name="instituicao" value="<?= h($row['instituicao'] ?? '') ?>">
                </div>
                <div class="campo">
                    <label>Data</label>
                    <input type="date" name="data_palestra" value="<?= h($row['data_palestra'] ?? '') ?>">
                </div>
                <div class="campo">
                    <label>Hora início</label>
                    <input type="time" name="hora_inicio" value="<?= h($row['hora_inicio'] ?? '') ?>">
                </div>
                <div class="campo">
                    <label>Hora fim</label>
                    <input type="time" name="hora_fim" value="<?= h($row['hora_fim'] ?? '') ?>">
                </div>
                <div class="campo">
                    <label>Local</label>
                    <input type="text" name="local" value="<?= h($row['local'] ?? '') ?>">
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
                <div class="campo full">
                    <label>Descrição</label>
                    <textarea name="descricao" rows="4"><?= h($row['descricao'] ?? '') ?></textarea>
                </div>
                <div class="campo">
                    <label>Status</label>
                    <select name="status">
                        <option value="Ativa" <?= ($row['status'] ?? '') === 'Ativa' ? 'selected' : '' ?>>Ativa</option>
                        <option value="Cancelada" <?= ($row['status'] ?? '') === 'Cancelada' ? 'selected' : '' ?>>Cancelada</option>
                        <option value="Concluída" <?= ($row['status'] ?? '') === 'Concluída' ? 'selected' : '' ?>>Concluída</option>
                    </select>
                </div>
            </div>
            <div class="acoes">
                <button class="btn salvar" type="submit">Salvar alterações</button>
                <a class="btn voltar" href="lista_palestras.php">Cancelar</a>
            </div>
        </form>
    </div>
</div>
</body>
</html>
