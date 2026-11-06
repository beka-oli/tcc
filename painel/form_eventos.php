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
        'titulo', 'organizador', 'tipo',
        'data_inicio', 'data_fim',
        'hora_inicio', 'hora_fim',
        'local', 'endereco', 'vagas',
        'descricao', 'status', 'destaque'
    ];

    foreach ($campos as $c) {
        $$c = trim($_POST[$c] ?? '');
    }

    $status = $status ?: 'Programado';
    $destaque = $destaque ?: '0';

    if (!$titulo || !$organizador || !$tipo ||
        !$data_inicio || !$local) {
        echo "<script>alert('Preencha os campos obrigatórios!');history.back();</script>";
        exit;
    }

    $sql = "INSERT INTO eventos
    (titulo, organizador, tipo, data_inicio, data_fim,
    hora_inicio, hora_fim, local, endereco, vagas,
    descricao, status, destaque)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conexao, $sql);

    if (!$stmt) {
        die('Erro ao preparar cadastro!');
    }

    mysqli_stmt_bind_param(
        $stmt, "sssssssssissi",
        $titulo, $organizador, $tipo,
        $data_inicio, $data_fim,
        $hora_inicio, $hora_fim, $local,
        $endereco, $vagas, $descricao,
        $status, $destaque
    );

    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Evento cadastrado com sucesso!');location='form_eventos.php';</script>";
        exit;
    }

    echo "<script>alert('Erro ao cadastrar evento!');history.back();</script>";
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Cadastro de Evento</title>
    <?php include 'includes_painel/head.php'; ?>
</head>
<body>

<?php include 'includes_painel/header.php'; ?>

<form method="POST">
<input type="hidden" name="csrf_token"
value="<?= htmlspecialchars(csrf_token(), ENT_QUOTES, 'UTF-8') ?>">

<div class="card">
    <div class="card-header">
        <i class="fas fa-calendar-alt"></i> Dados do Evento
    </div>

    <div class="card-body row">

        <div class="col-md-8">
            <label>Nome do Evento</label>
            <input class="form-control" name="titulo"
            maxlength="255" required>
        </div>

        <div class="col-md-4">
            <label>Tipo de Evento</label>
            <select class="form-select" name="tipo" required>
                <option value="">Selecione</option>
                <option>Acadêmico</option>
                <option>Cultural</option>
                <option>Esportivo</option>
                <option>Social</option>
                <option>Institucional</option>
                <option>Outros</option>
            </select>
        </div>

        <div class="col-md-6">
            <label>Organizador</label>
            <input class="form-control" name="organizador"
            maxlength="255" required>
        </div>

        <div class="col-md-6">
            <label>Local</label>
            <input class="form-control" name="local"
            maxlength="255" required>
        </div>

        <div class="col-md-6">
            <label>Endereço</label>
            <input class="form-control" name="endereco"
            maxlength="255">
        </div>

        <div class="col-md-3">
            <label>Data de Início</label>
            <input type="date" class="form-control"
            name="data_inicio" required>
        </div>

        <div class="col-md-3">
            <label>Data de Término</label>
            <input type="date" class="form-control"
            name="data_fim">
        </div>

        <div class="col-md-3">
            <label>Horário de Início</label>
            <input type="time" class="form-control"
            name="hora_inicio">
        </div>

        <div class="col-md-3">
            <label>Horário de Término</label>
            <input type="time" class="form-control"
            name="hora_fim">
        </div>

        <div class="col-md-3">
            <label>Quantidade de Vagas</label>
            <input type="number" class="form-control"
            name="vagas" min="0">
        </div>

        <div class="col-md-5">
            <label>Status</label>
            <select class="form-select" name="status">
                <option value="Programado">Programado</option>
                <option value="Em andamento">Em Andamento</option>
                <option value="Concluído">Concluído</option>
                <option value="Cancelado">Cancelado</option>
            </select>
        </div>

        <div class="col-md-4">
            <label>Destaque</label>
            <select class="form-select" name="destaque">
                <option value="0">Não</option>
                <option value="1">Sim</option>
            </select>
        </div>

        <div class="col-md-12">
            <label>Descrição do Evento</label>
            <textarea class="form-control" name="descricao"
            rows="4"></textarea>
        </div>

    </div>
</div>

<div class="botoes">
    <button type="reset" class="btn btn-secondary">
        <i class="fas fa-eraser"></i> Limpar
    </button>

    <button type="submit" class="btn btn-primary">
        <i class="fas fa-save"></i> Salvar Evento
    </button>
</div>

</form>

<?php include 'includes_painel/footer.php'; ?>

</body>
</html>
