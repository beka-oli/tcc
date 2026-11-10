<?php
include 'verifica_login.php';
include 'conexao.php';
include '_layout.php';
mysqli_set_charset($conexao, 'utf8mb4');

$id = id_get('id');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = esc($conexao, $_POST['titulo'] ?? '');
    $organizador = esc($conexao, $_POST['organizador'] ?? '');
    $tipo = esc($conexao, $_POST['tipo'] ?? '');
    $data_inicio = esc($conexao, $_POST['data_inicio'] ?? '');
    $data_fim = esc($conexao, $_POST['data_fim'] ?? '');
    $hora_inicio = esc($conexao, $_POST['hora_inicio'] ?? '');
    $hora_fim = esc($conexao, $_POST['hora_fim'] ?? '');
    $local = esc($conexao, $_POST['local'] ?? '');
    $endereco = esc($conexao, $_POST['endereco'] ?? '');
    $vagas = esc($conexao, $_POST['vagas'] ?? '');
    $descricao = esc($conexao, $_POST['descricao'] ?? '');
    $status = esc($conexao, $_POST['status'] ?? '');
    $destaque = esc($conexao, $_POST['destaque'] ?? '');

    $sql = "UPDATE eventos SET titulo = '$titulo', organizador = '$organizador', tipo = '$tipo', data_inicio = " . ($data_inicio === '' ? 'NULL' : "'$data_inicio'") . ", data_fim = " . ($data_fim === '' ? 'NULL' : "'$data_fim'") . ", hora_inicio = " . ($hora_inicio === '' ? 'NULL' : "'$hora_inicio'") . ", hora_fim = " . ($hora_fim === '' ? 'NULL' : "'$hora_fim'") . ", local = '$local', endereco = '$endereco', vagas = " . ($vagas === '' ? 'NULL' : "'$vagas'") . ", descricao = '$descricao', status = '$status', destaque = '$destaque' WHERE id_evento = $id";
    $ok = mysqli_query($conexao, $sql);
    if (!$ok) {
        erro(mysqli_error($conexao));
    }
    redirect('lista_eventos.php');
}

$r = mysqli_query($conexao, "SELECT * FROM eventos WHERE id_evento = $id LIMIT 1");
if (!$r || mysqli_num_rows($r) !== 1) {
    erro('Registro não encontrado.');
}
$row = mysqli_fetch_assoc($r);
?>
<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <title>Editar Evento</title>
    <?php include 'includes_painel/head.php'; ?>
</head>
<body>
<?php include 'includes_painel/header.php'; ?>
<div class="crud">
    <div class="card">
        <h1>Editar Evento</h1>
        <form method="post">
            <input type="hidden" name="csrf_token" value="<?= h(csrf_token()) ?>">
            <div class="grid">
                <div class="campo">
                    <label>Título</label>
                    <input type="text" name="titulo" value="<?= h($row['titulo'] ?? '') ?>">
                </div>
                <div class="campo">
                    <label>Organizador</label>
                    <input type="text" name="organizador" value="<?= h($row['organizador'] ?? '') ?>">
                </div>
                <div class="campo">
                    <label>Tipo</label>
                    <input type="text" name="tipo" value="<?= h($row['tipo'] ?? '') ?>">
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
                    <label>Endereço</label>
                    <input type="text" name="endereco" value="<?= h($row['endereco'] ?? '') ?>">
                </div>
                <div class="campo">
                    <label>Vagas</label>
                    <input type="number" name="vagas" value="<?= h($row['vagas'] ?? '') ?>">
                </div>
                <div class="campo full">
                    <label>Descrição</label>
                    <textarea name="descricao" rows="4"><?= h($row['descricao'] ?? '') ?></textarea>
                </div>
                <div class="campo">
                    <label>Status</label>
                    <select name="status">
                        <option value="Programado" <?= ($row['status'] ?? '') === 'Programado' ? 'selected' : '' ?>>Programado</option>
                        <option value="Em andamento" <?= ($row['status'] ?? '') === 'Em andamento' ? 'selected' : '' ?>>Em andamento</option>
                        <option value="Concluído" <?= ($row['status'] ?? '') === 'Concluído' ? 'selected' : '' ?>>Concluído</option>
                        <option value="Cancelado" <?= ($row['status'] ?? '') === 'Cancelado' ? 'selected' : '' ?>>Cancelado</option>
                    </select>
                </div>
                <div class="campo">
                    <label>Destaque</label>
                    <select name="destaque">
                        <option value="0" <?= ($row['destaque'] ?? '') === '0' ? 'selected' : '' ?>>0</option>
                        <option value="1" <?= ($row['destaque'] ?? '') === '1' ? 'selected' : '' ?>>1</option>
                    </select>
                </div>
            </div>
            <div class="acoes">
                <button class="btn salvar" type="submit">Salvar alterações</button>
                <a class="btn voltar" href="lista_eventos.php">Cancelar</a>
            </div>
        </form>
    </div>
</div>
</body>
</html>
