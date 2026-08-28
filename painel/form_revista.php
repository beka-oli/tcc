<?php
include('verifica_login.php');
include('conexao.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $campos = [
        'issn','nome','volume','numero','ano','doi',
        'periodicidade','editor_chefe','conselho','revisores',
        'data_publicacao','status','destaque'
    ];

    foreach ($campos as $c)
        $$c = mysqli_real_escape_string($conexao, $_POST[$c] ?? '');

    $status = $status ?: 'Rascunho';
    $destaque = $destaque ?: '0';

    if (!$issn || !$nome || !$ano || !$periodicidade || !$editor_chefe) {
        echo "<script>alert('Preencha todos os campos obrigatórios!');history.back();</script>";
        exit;
    }

    $check = mysqli_query($conexao,
        "SELECT id_revista FROM revistas WHERE issn='$issn' LIMIT 1"
    );

    if (mysqli_num_rows($check)) {
        echo "<script>alert('Já existe uma revista cadastrada com este ISSN!');history.back();</script>";
        exit;
    }

    $sql = "INSERT INTO revistas
    (issn,nome,volume,numero,ano,doi,periodicidade,editor_chefe,
    conselho,revisores,data_publicacao,status,destaque,dt_cad_revista)
    VALUES
    ('$issn','$nome','$volume','$numero','$ano','$doi','$periodicidade',
    '$editor_chefe','$conselho','$revisores','$data_publicacao',
    '$status','$destaque',NOW())";

    if (mysqli_query($conexao, $sql)) {
        echo "<script>alert('Revista cadastrada com sucesso!');location='cad_revista.php';</script>";
        exit;
    }

    echo "<script>alert('Erro ao cadastrar a revista!');history.back();</script>";
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Cadastro de Revista</title>
    <?php include 'includes_painel/head.php'; ?>
</head>

<body>

<?php include 'includes_painel/header.php'; ?>

<form action="cad_revista.php" method="POST">

<!-- DADOS DA REVISTA -->
<div class="card">
    <div class="card-header">
        <i class="fas fa-book-open"></i> Dados da Revista
    </div>

    <div class="card-body row">

        <div class="col-md-4">
            <label>ISSN</label>
            <input class="form-control" name="issn"
                   placeholder="Ex.: 2764-1234" maxlength="20" required>
        </div>

        <div class="col-md-8">
            <label>Nome da Revista</label>
            <input class="form-control" name="nome"
                   placeholder="Digite o nome da revista" maxlength="255" required>
        </div>

        <div class="col-md-4">
            <label>Volume</label>
            <input type="number" class="form-control" name="volume"
                   placeholder="Ex.: 5" min="1">
        </div>

        <div class="col-md-4">
            <label>Número</label>
            <input type="number" class="form-control" name="numero"
                   placeholder="Ex.: 2" min="1">
        </div>

        <div class="col-md-4">
            <label>Ano</label>
            <input type="number" class="form-control" name="ano"
                   placeholder="Ex.: 2026" min="1900" max="2100" required>
        </div>

        <div class="col-md-6">
            <label>DOI</label>
            <input class="form-control" name="doi"
                   placeholder="Ex.: 10.1234/abc.2026">
        </div>

        <div class="col-md-6">
            <label>Periodicidade</label>
            <select class="form-select" name="periodicidade" required>
                <option value="">Selecione</option>
                <option>Anual</option>
                <option>Semestral</option>
                <option>Quadrimestral</option>
                <option>Trimestral</option>
                <option>Bimestral</option>
                <option>Mensal</option>
            </select>
        </div>

    </div>
</div>


<!-- EQUIPE -->
<div class="card">
    <div class="card-header">
        <i class="fas fa-users"></i> Equipe Editorial
    </div>

    <div class="card-body row">

        <div class="col-md-12">
            <label>Editor-chefe</label>
            <input class="form-control" name="editor_chefe"
                   placeholder="Nome do editor-chefe" maxlength="255" required>
        </div>

        <div class="col-md-6">
            <label>Conselho Editorial</label>
            <textarea class="form-control" name="conselho"
                      placeholder="Digite os membros"></textarea>
        </div>

        <div class="col-md-6">
            <label>Revisores</label>
            <textarea class="form-control" name="revisores"
                      placeholder="Digite os nomes"></textarea>
        </div>

    </div>
</div>


<!-- PUBLICAÇÃO -->
<div class="card">
    <div class="card-header">
        <i class="fas fa-globe"></i> Publicação
    </div>

    <div class="card-body row">

        <div class="col-md-4">
            <label>Data da Publicação</label>
            <input type="date" class="form-control" name="data_publicacao">
        </div>

        <div class="col-md-4">
            <label>Status</label>
            <select class="form-select" name="status">
                <option>Rascunho</option>
                <option>Em Revisão</option>
                <option>Publicado</option>
                <option>Arquivado</option>
            </select>
        </div>

        <div class="col-md-4">
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
        <i class="fas fa-save"></i> Salvar Revista
    </button>
</div>

</form>


<style>
form{max-width:1450px;margin:25px auto}

.card{
    border:0;
    border-radius:14px;
    overflow:hidden;
    box-shadow:0 5px 18px #00000014;
    margin-bottom:18px
}

.card-header{
    background:linear-gradient(90deg,#b61d45,#8b2cf5);
    color:#fff;
    padding:12px 18px;
    font-weight:600
}

.card-body{padding:18px}

.card-body>div{margin-bottom:12px}

label{
    display:block;
    margin-bottom:4px;
    font-size:13px;
    font-weight:600;
    color:#555
}

.form-control,
.form-select{
    height:36px;
    font-size:13px;
    border-radius:8px
}

textarea.form-control{
    height:70px;
    resize:vertical
}

.botoes{
    text-align:right;
    margin-bottom:35px
}

.btn{
    height:38px;
    border-radius:8px;
    padding:0 18px;
    font-size:13px;
    font-weight:600
}

.btn-primary{
    border:0;
    background:linear-gradient(90deg,#b61d45,#8b2cf5)
}
</style>

<?php include 'includes_painel/footer.php'; ?>

</body>
</html>