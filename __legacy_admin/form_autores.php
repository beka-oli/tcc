<?php
include('verifica_login.php');
include('conexao.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $campos = [
        'nome','email','instituicao','orcid',
        'curriculo','area_atuacao','status'
    ];

    foreach ($campos as $c)
        $$c = mysqli_real_escape_string($conexao, $_POST[$c] ?? '');

    $status = $status ?: 'Ativo';

    if (!$nome) {
        echo "<script>alert('Informe o nome do autor!');history.back();</script>";
        exit;
    }

    $check = mysqli_query(
        $conexao,
        "SELECT id_autor FROM autores WHERE nome='$nome' LIMIT 1"
    );

    if (mysqli_num_rows($check)) {
        echo "<script>alert('Este autor já está cadastrado!');history.back();</script>";
        exit;
    }

    $sql = "INSERT INTO autores
    (nome,email,instituicao,orcid,curriculo,area_atuacao,status,dt_cad_autor)
    VALUES
    ('$nome','$email','$instituicao','$orcid','$curriculo',
     '$area_atuacao','$status',NOW())";

    if (mysqli_query($conexao, $sql)) {
        echo "<script>
            alert('Autor cadastrado com sucesso!');
            location='cad_autor.php';
        </script>";
        exit;
    }

    echo "<script>
        alert('Erro ao cadastrar o autor!');
        history.back();
    </script>";
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Cadastro de Autor</title>
    <?php include 'includes_painel/head.php'; ?>
</head>

<body>

<?php include 'includes_painel/header.php'; ?>

<form action="cad_autor.php" method="POST">

<div class="card">

    <div class="card-header">
        <i class="fas fa-user-pen"></i> Dados do Autor
    </div>

    <div class="card-body row">

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
            <label>E-mail</label>
            <input type="email"
                   class="form-control"
                   name="email"
                   placeholder="autor@email.com">
        </div>

        <div class="col-md-6">
            <label>Instituição</label>
            <input type="text"
                   class="form-control"
                   name="instituicao"
                   placeholder="Nome da instituição"
                   maxlength="255">
        </div>

        <div class="col-md-6">
            <label>ORCID</label>
            <input type="text"
                   class="form-control"
                   name="orcid"
                   placeholder="Ex.: 0000-0000-0000-0000"
                   maxlength="50">
        </div>

        <div class="col-md-6">
            <label>Área de Atuação</label>
            <input type="text"
                   class="form-control"
                   name="area_atuacao"
                   placeholder="Ex.: Ciência da Computação"
                   maxlength="255">
        </div>

        <div class="col-md-6">
            <label>Status</label>
            <select class="form-select" name="status">
                <option>Ativo</option>
                <option>Inativo</option>
            </select>
        </div>

        <div class="col-md-12">
            <label>Currículo / Biografia</label>
            <textarea class="form-control"
                      name="curriculo"
                      placeholder="Digite informações sobre o autor"></textarea>
        </div>

    </div>
</div>

<div class="botoes">

    <button type="reset" class="btn btn-secondary">
        <i class="fas fa-eraser"></i> Limpar
    </button>

    <button type="submit" class="btn btn-primary">
        <i class="fas fa-save"></i> Salvar Autor
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
.form-control,.form-select{height:36px;font-size:13px;border-radius:8px}
textarea.form-control{height:90px;resize:vertical}
.botoes{text-align:right;margin-bottom:35px}
.btn{height:38px;border-radius:8px;padding:0 18px;font-size:13px;font-weight:600}
.btn-primary{border:0;background:linear-gradient(90deg,#b61d45,#8b2cf5)}
</style>

<?php include 'includes_painel/footer.php'; ?>

</body>
</html>