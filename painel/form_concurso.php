<?php
include('verifica_login.php');
include('conexao.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $campos = [
        'nome','orgao','cargo','escolaridade','edital','ano',
        'data_inscricao_inicio','data_inscricao_fim','data_prova',
        'descricao','status','destaque'
    ];

    foreach ($campos as $c)
        $$c = mysqli_real_escape_string($conexao, $_POST[$c] ?? '');

    $status = $status ?: 'Aberto';
    $destaque = $destaque ?: '0';

    if (!$nome || !$orgao || !$cargo || !$escolaridade || !$ano) {
        echo "<script>alert('Preencha todos os campos obrigatórios!');history.back();</script>";
        exit;
    }

    $check = mysqli_query($conexao,
        "SELECT id_concurso FROM concursos
         WHERE nome='$nome' AND orgao='$orgao'
         AND cargo='$cargo' AND ano='$ano' LIMIT 1"
    );

    if (!$check) {
        echo "<script>alert('Erro ao verificar o concurso!');history.back();</script>";
        exit;
    }

    if (mysqli_num_rows($check)) {
        echo "<script>alert('Este concurso já está cadastrado!');history.back();</script>";
        exit;
    }

    $sql = "INSERT INTO concursos
    (nome,orgao,cargo,escolaridade,edital,ano,
     data_inscricao_inicio,data_inscricao_fim,data_prova,
     descricao,status,destaque,dt_cad_concurso)
    VALUES
    ('$nome','$orgao','$cargo','$escolaridade','$edital','$ano',
     '$data_inscricao_inicio','$data_inscricao_fim','$data_prova',
     '$descricao','$status','$destaque',NOW())";

    if (mysqli_query($conexao, $sql)) {
        echo "<script>
            alert('Concurso cadastrado com sucesso!');
            location='cad_concurso.php';
        </script>";
        exit;
    }

    echo "<script>alert('Erro ao cadastrar o concurso!');history.back();</script>";
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Cadastro de Concurso</title>
    <?php include 'includes_painel/head.php'; ?>
</head>

<body>

<?php include 'includes_painel/header.php'; ?>

<form action="cad_concurso.php" method="POST">

<!-- DADOS DO CONCURSO -->
<div class="card">

    <div class="card-header">
        <i class="fas fa-file-alt"></i> Dados do Concurso
    </div>

    <div class="card-body row">

        <div class="col-md-8">
            <label>Nome do Concurso</label>
            <input class="form-control" name="nome"
                   placeholder="Digite o nome do concurso"
                   maxlength="255" required>
        </div>

        <div class="col-md-4">
            <label>Ano</label>
            <input type="number" class="form-control"
                   name="ano" placeholder="Ex.: 2026"
                   min="1900" max="2100" required>
        </div>

        <div class="col-md-6">
            <label>Órgão / Instituição</label>
            <input class="form-control" name="orgao"
                   placeholder="Ex.: Prefeitura Municipal"
                   maxlength="255" required>
        </div>

        <div class="col-md-6">
            <label>Cargo</label>
            <input class="form-control" name="cargo"
                   placeholder="Ex.: Técnico em Informática"
                   maxlength="255" required>
        </div>

        <div class="col-md-6">
            <label>Escolaridade</label>
            <select class="form-select" name="escolaridade" required>
                <option value="">Selecione</option>
                <option>Ensino Fundamental</option>
                <option>Ensino Médio</option>
                <option>Ensino Técnico</option>
                <option>Ensino Superior</option>
                <option>Pós-graduação</option>
            </select>
        </div>

        <div class="col-md-6">
            <label>Edital</label>
            <input class="form-control" name="edital"
                   placeholder="Ex.: Edital nº 01/2026"
                   maxlength="100">
        </div>

    </div>
</div>

<!-- INSCRIÇÕES -->
<div class="card">

    <div class="card-header">
        <i class="fas fa-calendar-alt"></i> Inscrições e Prova
    </div>

    <div class="card-body row">

        <div class="col-md-4">
            <label>Início das Inscrições</label>
            <input type="date" class="form-control"
                   name="data_inscricao_inicio">
        </div>

        <div class="col-md-4">
            <label>Fim das Inscrições</label>
            <input type="date" class="form-control"
                   name="data_inscricao_fim">
        </div>

        <div class="col-md-4">
            <label>Data da Prova</label>
            <input type="date" class="form-control"
                   name="data_prova">
        </div>

    </div>
</div>

<!-- INFORMAÇÕES -->
<div class="card">

    <div class="card-header">
        <i class="fas fa-info-circle"></i> Informações
    </div>

    <div class="card-body row">

        <div class="col-md-12">
            <label>Descrição</label>
            <textarea class="form-control"
                      name="descricao"
                      placeholder="Digite informações sobre o concurso"></textarea>
        </div>

        <div class="col-md-6">
            <label>Status</label>
            <select class="form-select" name="status">
                <option>Aberto</option>
                <option>Em andamento</option>
                <option>Encerrado</option>
                <option>Suspenso</option>
            </select>
        </div>

        <div class="col-md-6">
            <label>Destaque</label>
            <select class="form-select" name="destaque">
                <option value="0">Não</option>
                <option value="1">Sim</option>
            </select>
        </div>

    </div>
</div>

<div class="botoes">
    <button type="reset" class="btn btn-secondary">
        <i class="fas fa-eraser"></i> Limpar
    </button>

    <button type="submit" class="btn btn-primary">
        <i class="fas fa-save"></i> Salvar Concurso
    </button>
</div>

</form>

<style>
form{max-width:1450px;margin:25px auto}
.card{border:0;border-radius:14px;overflow:hidden;box-shadow:0 5px 18px #00000014;margin-bottom:18px}
.card-header{background:linear-gradient(90deg,#b61d45,#8b2cf5);color:#fff;padding:12px 18px;font-weight:600}
.card-body{padding:18px}
.card-body>div{margin-bottom:12px}
label{display:block;margin-bottom:4px;font-size:13px;font-weight:600;color:#555}
.form-control,.form-select{height:36px;font-size:13px;border-radius:8px;padding:6px 12px;border:1px solid #d8dce5}
textarea.form-control{height:85px;resize:vertical}
.form-control:focus,.form-select:focus{border-color:#8b2cf5;box-shadow:0 0 0 .15rem #8b2cf51f}
.botoes{text-align:right;margin:20px 0 35px}
.btn{height:38px;border-radius:8px;padding:0 18px;font-size:13px;font-weight:600}
.btn-primary{border:0;background:linear-gradient(90deg,#b61d45,#8b2cf5)}
</style>

<?php include 'includes_painel/footer.php'; ?>

</body>
</html>