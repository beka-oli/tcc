<?php
include('verifica_login.php');
include('conexao.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $campos = [
        'id_concurso','nome','cpf','email',
        'telefone','escolaridade','data_inscricao','status'
    ];

    foreach ($campos as $c)
        $$c = mysqli_real_escape_string($conexao, $_POST[$c] ?? '');

    $status = $status ?: 'Pendente';

    if (!$id_concurso || !$nome || !$cpf || !$email) {
        echo "<script>alert('Preencha todos os campos obrigatórios!');history.back();</script>";
        exit;
    }

    /* Verifica concurso */
    $check = mysqli_query($conexao,
        "SELECT id_concurso FROM concursos
         WHERE id_concurso='$id_concurso' LIMIT 1"
    );

    if (!mysqli_num_rows($check)) {
        echo "<script>alert('Concurso não encontrado!');history.back();</script>";
        exit;
    }

    /* Verifica inscrição duplicada */
    $check = mysqli_query($conexao,
        "SELECT id_inscricao FROM inscricoes
         WHERE id_concurso='$id_concurso'
         AND cpf='$cpf' LIMIT 1"
    );

    if (mysqli_num_rows($check)) {
        echo "<script>alert('Este CPF já está inscrito neste concurso!');history.back();</script>";
        exit;
    }

    $sql = "INSERT INTO inscricoes
    (id_concurso,nome,cpf,email,telefone,escolaridade,data_inscricao,status)
    VALUES
    ('$id_concurso','$nome','$cpf','$email','$telefone',
     '$escolaridade','$data_inscricao','$status')";

    if (mysqli_query($conexao, $sql)) {
        echo "<script>
            alert('Inscrição cadastrada com sucesso!');
            location='lista_inscricoes.php';
        </script>";
        exit;
    }

    echo "<script>
        alert('Erro ao cadastrar a inscrição!');
        history.back();
    </script>";
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Cadastro de Inscrição</title>
    <?php include 'includes_painel/head.php'; ?>
</head>

<body>

<?php include 'includes_painel/header.php'; ?>

<form action="lista_inscricoes.php" method="POST"><input type="hidden" name="csrf_token" value="<?=h(csrf_token())?>">

<div class="card">

    <div class="card-header">
        <i class="fas fa-clipboard-list"></i> Dados da Inscrição
    </div>

    <div class="card-body row">

        <div class="col-md-12">
            <label>Concurso</label>

            <select class="form-select" name="id_concurso" required>
                <option value="">Selecione o concurso</option>

                <?php
                $result = mysqli_query($conexao,
                    "SELECT id_concurso,nome,orgao,cargo,ano
                     FROM concursos
                     ORDER BY ano DESC,nome"
                );

                while ($concurso = mysqli_fetch_assoc($result)) {
                ?>

                <option value="<?= $concurso['id_concurso'] ?>">
                    <?= htmlspecialchars($concurso['nome']) ?>
                    - <?= htmlspecialchars($concurso['orgao']) ?>
                    - <?= htmlspecialchars($concurso['cargo']) ?>
                    - <?= $concurso['ano'] ?>
                </option>

                <?php } ?>

            </select>
        </div>

        <div class="col-md-8">
            <label>Nome Completo</label>

            <input type="text"
                   class="form-control"
                   name="nome"
                   placeholder="Digite o nome completo"
                   maxlength="255"
                   required>
        </div>

        <div class="col-md-4">
            <label>CPF</label>

            <input type="text"
                   class="form-control"
                   name="cpf"
                   placeholder="000.000.000-00"
                   maxlength="14"
                   required>
        </div>

        <div class="col-md-6">
            <label>E-mail</label>

            <input type="email"
                   class="form-control"
                   name="email"
                   placeholder="email@exemplo.com"
                   maxlength="255"
                   required>
        </div>

        <div class="col-md-6">
            <label>Telefone</label>

            <input type="text"
                   class="form-control"
                   name="telefone"
                   placeholder="(00) 00000-0000"
                   maxlength="20">
        </div>

        <div class="col-md-6">
            <label>Escolaridade</label>

            <select class="form-select" name="escolaridade">
                <option value="">Selecione</option>
                <option>Ensino Fundamental</option>
                <option>Ensino Médio</option>
                <option>Ensino Técnico</option>
                <option>Ensino Superior</option>
                <option>Pós-graduação</option>
            </select>
        </div>

        <div class="col-md-3">
            <label>Data da Inscrição</label>

            <input type="date"
                   class="form-control"
                   name="data_inscricao">
        </div>

        <div class="col-md-3">
            <label>Status</label>

            <select class="form-select" name="status">
                <option>Pendente</option>
                <option>Confirmada</option>
                <option>Cancelada</option>
            </select>
        </div>

    </div>
</div>

<div class="botoes">

    <button type="reset" class="btn btn-secondary">
        <i class="fas fa-eraser"></i> Limpar
    </button>

    <button type="submit" class="btn btn-primary">
        <i class="fas fa-save"></i> Salvar Inscrição
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
.form-control:focus,.form-select:focus{border-color:#8b2cf5;box-shadow:0 0 0 .15rem #8b2cf51f}
.botoes{text-align:right;margin:20px 0 35px}
.btn{height:38px;border-radius:8px;padding:0 18px;font-size:13px;font-weight:600}
.btn-primary{border:0;background:linear-gradient(90deg,#b61d45,#8b2cf5)}
</style>

<?php include 'includes_painel/footer.php'; ?>

</body>
</html>