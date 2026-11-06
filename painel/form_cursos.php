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
        'titulo', 'instrutor', 'instituicao',
        'modalidade', 'data_inicio', 'data_fim',
        'carga_horaria', 'vagas', 'categoria',
        'nivel', 'descricao', 'status'
    ];

    foreach ($campos as $c) {
        $$c = trim($_POST[$c] ?? '');
    }

    $status = $status ?: 'Aberto';

    if (!$titulo || !$instrutor || !$modalidade ||
        !$data_inicio || !$data_fim || !$categoria) {
        echo "<script>alert('Preencha os campos obrigatórios!');history.back();</script>";
        exit;
    }

    $sql = "INSERT INTO cursos
    (titulo, instrutor, instituicao, modalidade,
    data_inicio, data_fim, carga_horaria, vagas,
    categoria, nivel, descricao, status)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conexao, $sql);

    if (!$stmt) {
        die('Erro ao preparar cadastro!');
    }

    mysqli_stmt_bind_param(
        $stmt, "ssssssiissss",
        $titulo, $instrutor, $instituicao,
        $modalidade, $data_inicio, $data_fim,
        $carga_horaria, $vagas, $categoria,
        $nivel, $descricao, $status
    );

    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Curso cadastrado com sucesso!');location='form_cursos.php';</script>";
        exit;
    }

    echo "<script>alert('Erro ao cadastrar curso!');history.back();</script>";
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Cadastro de Curso</title>
    <?php include 'includes_painel/head.php'; ?>
</head>
<body>

<?php include 'includes_painel/header.php'; ?>

<form method="POST">
<input type="hidden" name="csrf_token"
value="<?= htmlspecialchars(csrf_token(), ENT_QUOTES, 'UTF-8') ?>">

<div class="card">
    <div class="card-header">
        <i class="fas fa-graduation-cap"></i> Dados do Curso
    </div>

    <div class="card-body row">

        <div class="col-md-8">
            <label>Nome do Curso</label>
            <input class="form-control" name="titulo"
            maxlength="255" required>
        </div>

        <div class="col-md-4">
            <label>Categoria</label>
            <select class="form-select" name="categoria" required>
                <option value="">Selecione</option>
                <option>Educação</option>
                <option>Tecnologia</option>
                <option>Administração</option>
                <option>Saúde</option>
                <option>Profissionalizante</option>
                <option>Outros</option>
            </select>
        </div>

        <div class="col-md-6">
            <label>Instrutor / Professor</label>
            <input class="form-control" name="instrutor"
            maxlength="255" required>
        </div>

        <div class="col-md-6">
            <label>Instituição</label>
            <input class="form-control" name="instituicao"
            maxlength="255">
        </div>

        <div class="col-md-4">
            <label>Modalidade</label>
            <select class="form-select" name="modalidade" required>
                <option value="">Selecione</option>
                <option>Presencial</option>
                <option>Online</option>
                <option>Híbrido</option>
            </select>
        </div>

        <div class="col-md-4">
            <label>Data de Início</label>
            <input type="date" class="form-control"
            name="data_inicio" required>
        </div>

        <div class="col-md-4">
            <label>Data de Término</label>
            <input type="date" class="form-control"
            name="data_fim" required>
        </div>

        <div class="col-md-3">
            <label>Carga Horária (horas)</label>
            <input type="number" class="form-control"
            name="carga_horaria" min="1">
        </div>

        <div class="col-md-3">
            <label>Quantidade de Vagas</label>
            <input type="number" class="form-control"
            name="vagas" min="0">
        </div>

        <div class="col-md-3">
            <label>Nível</label>
            <select class="form-select" name="nivel">
                <option value="">Selecione</option>
                <option>Iniciante</option>
                <option>Intermediário</option>
                <option>Avançado</option>
                <option>Todos os níveis</option>
            </select>
        </div>

        <div class="col-md-3">
            <label>Status</label>
            <select class="form-select" name="status">
                <option value="Aberto">Inscrições Abertas</option>
                <option value="Em andamento">Em Andamento</option>
                <option value="Concluído">Concluído</option>
                <option value="Cancelado">Cancelado</option>
            </select>
        </div>

        <div class="col-md-12">
            <label>Descrição do Curso</label>
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
        <i class="fas fa-save"></i> Salvar Curso
    </button>
</div>

</form>

<?php include 'includes_painel/footer.php'; ?>

</body>
</html>
