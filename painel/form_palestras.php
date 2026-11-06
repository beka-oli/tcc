<?php
include('verifica_login.php');
include('conexao.php');

mysqli_set_charset($conexao, 'utf8mb4');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!isset($_POST['csrf_token']) ||
        !hash_equals(csrf_token(), $_POST['csrf_token'])) {
        die('Token de segurança inválido!');
    }

    $campos = [
        'titulo', 'palestrante', 'instituicao',
        'data_palestra', 'hora_inicio', 'hora_fim',
        'local', 'carga_horaria', 'vagas',
        'categoria', 'descricao', 'status'
    ];

    foreach ($campos as $c) {
        $$c = trim($_POST[$c] ?? '');
    }

    $status = $status ?: 'Ativa';

    if (!$titulo || !$palestrante || !$data_palestra ||
        !$hora_inicio || !$local || !$categoria) {
        echo "<script>alert('Preencha os campos obrigatórios!');history.back();</script>";
        exit;
    }

    $sql = "INSERT INTO palestras
    (titulo, palestrante, instituicao, data_palestra,
    hora_inicio, hora_fim, local, carga_horaria,
    vagas, categoria, descricao, status)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conexao, $sql);

    if (!$stmt) {
        die('Erro ao preparar cadastro!');
    }

    mysqli_stmt_bind_param(
        $stmt, "sssssssiiiss",
        $titulo, $palestrante, $instituicao,
        $data_palestra, $hora_inicio, $hora_fim,
        $local, $carga_horaria, $vagas,
        $categoria, $descricao, $status
    );

    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Palestra cadastrada com sucesso!');location='form_palestras.php';</script>";
        exit;
    }

    echo "<script>alert('Erro ao cadastrar palestra!');history.back();</script>";
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Cadastro de Palestra</title>
    <?php include 'includes_painel/head.php'; ?>
</head>
<body>

<?php include 'includes_painel/header.php'; ?>

<form method="POST">
<input type="hidden" name="csrf_token"
value="<?= htmlspecialchars(csrf_token(), ENT_QUOTES, 'UTF-8') ?>">

<div class="card">
    <div class="card-header">
        <i class="fas fa-microphone"></i> Dados da Palestra
    </div>

    <div class="card-body row">

        <div class="col-md-8">
            <label>Título da Palestra</label>
            <input class="form-control" name="titulo"
            maxlength="255" required>
        </div>

        <div class="col-md-4">
            <label>Categoria</label>
            <select class="form-select" name="categoria" required>
                <option value="">Selecione</option>
                <option>Educação</option>
                <option>Tecnologia</option>
                <option>Saúde</option>
                <option>Motivacional</option>
                <option>Profissional</option>
                <option>Outros</option>
            </select>
        </div>

        <div class="col-md-6">
            <label>Palestrante</label>
            <input class="form-control" name="palestrante"
            maxlength="255" required>
        </div>

        <div class="col-md-6">
            <label>Instituição</label>
            <input class="form-control" name="instituicao"
            maxlength="255">
        </div>

        <div class="col-md-4">
            <label>Data</label>
            <input type="date" class="form-control"
            name="data_palestra" required>
        </div>

        <div class="col-md-4">
            <label>Horário de Início</label>
            <input type="time" class="form-control"
            name="hora_inicio" required>
        </div>

        <div class="col-md-4">
            <label>Horário de Término</label>
            <input type="time" class="form-control"
            name="hora_fim">
        </div>

        <div class="col-md-6">
            <label>Local</label>
            <input class="form-control" name="local"
            maxlength="255" required>
        </div>

        <div class="col-md-3">
            <label>Carga Horária (horas)</label>
            <input type="number" class="form-control"
            name="carga_horaria" min="0">
        </div>

        <div class="col-md-3">
            <label>Quantidade de Vagas</label>
            <input type="number" class="form-control"
            name="vagas" min="0">
        </div>

        <div class="col-md-12">
            <label>Descrição</label>
            <textarea class="form-control" name="descricao"
            rows="4"></textarea>
        </div>

        <div class="col-md-12">
            <label>Status</label>
            <select class="form-select" name="status">
                <option value="Ativa">Ativa</option>
                <option value="Cancelada">Cancelada</option>
                <option value="Concluída">Concluída</option>
            </select>
        </div>

    </div>
</div>

<div class="botoes">
    <button type="reset" class="btn btn-secondary">
        <i class="fas fa-eraser"></i> Limpar
    </button>

    <button type="submit" class="btn btn-primary">
        <i class="fas fa-save"></i> Salvar Palestra
    </button>
</div>

</form>

<?php include 'includes_painel/footer.php'; ?>

</body>
</html>
