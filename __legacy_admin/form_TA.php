<?php
include('verifica_login.php');
include('conexao.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $campos = [
        'titulo',
        'tipo',
        'autor',
        'curso',
        'instituicao',
        'orientador',
        'resumo',
        'palavras_chave',
        'data_publicacao'
    ];

    foreach ($campos as $c)
        $$c = mysqli_real_escape_string($conexao, $_POST[$c] ?? '');

    if (!$titulo || !$tipo || !$autor || !$curso || !$instituicao) {
        echo "<script>
            alert('Preencha todos os campos obrigatórios!');
            history.back();
        </script>";
        exit;
    }

    $arquivo = '';

    if (isset($_FILES['arquivo']) && $_FILES['arquivo']['error'] === 0) {

        $pasta = 'uploads/trabalhos/';

        if (!is_dir($pasta))
            mkdir($pasta, 0777, true);

        $extensao = strtolower(
            pathinfo($_FILES['arquivo']['name'], PATHINFO_EXTENSION)
        );

        $permitidos = ['pdf', 'doc', 'docx'];

        if (!in_array($extensao, $permitidos)) {
            echo "<script>
                alert('Formato de arquivo inválido!');
                history.back();
            </script>";
            exit;
        }

        $arquivo = uniqid('trabalho_') . '.' . $extensao;

        move_uploaded_file(
            $_FILES['arquivo']['tmp_name'],
            $pasta . $arquivo
        );
    }

    $sql = "INSERT INTO trabalhos_academicos
    (
        titulo,
        tipo,
        autor,
        curso,
        instituicao,
        orientador,
        resumo,
        palavras_chave,
        data_publicacao,
        arquivo,
        criado_em
    )
    VALUES
    (
        '$titulo',
        '$tipo',
        '$autor',
        '$curso',
        '$instituicao',
        '$orientador',
        '$resumo',
        '$palavras_chave',
        '$data_publicacao',
        '$arquivo',
        NOW()
    )";

    if (mysqli_query($conexao, $sql)) {

        echo "<script>
            alert('Trabalho acadêmico cadastrado com sucesso!');
            location='cad_trabalho.php';
        </script>";

        exit;
    }

    echo "<script>
        alert('Erro ao cadastrar o trabalho acadêmico!');
        history.back();
    </script>";
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width,initial-scale=1">

    <title>Cadastro de Trabalho Acadêmico</title>

    <?php include 'includes_painel/head.php'; ?>

</head>

<body>

<?php include 'includes_painel/header.php'; ?>


<form action="cad_trabalho.php"
      method="POST"
      enctype="multipart/form-data">


<!-- DADOS DO TRABALHO -->

<div class="card">

    <div class="card-header">
        <i class="fas fa-graduation-cap"></i>
        Dados do Trabalho Acadêmico
    </div>

    <div class="card-body row">

        <div class="col-md-8">

            <label>Título</label>

            <input
                type="text"
                class="form-control"
                name="titulo"
                placeholder="Digite o título do trabalho"
                maxlength="255"
                required>

        </div>


        <div class="col-md-4">

            <label>Tipo</label>

            <select
                class="form-select"
                name="tipo"
                required>

                <option value="">Selecione</option>
                <option>TCC</option>
                <option>Artigo Científico</option>
                <option>Monografia</option>
                <option>Dissertação</option>
                <option>Tese</option>
                <option>Projeto de Pesquisa</option>
                <option>Outro</option>

            </select>

        </div>


        <div class="col-md-6">

            <label>Autor</label>

            <input
                type="text"
                class="form-control"
                name="autor"
                placeholder="Nome completo do autor"
                maxlength="255"
                required>

        </div>


        <div class="col-md-6">

            <label>Orientador</label>

            <input
                type="text"
                class="form-control"
                name="orientador"
                placeholder="Nome do orientador"
                maxlength="255">

        </div>


        <div class="col-md-6">

            <label>Curso</label>

            <input
                type="text"
                class="form-control"
                name="curso"
                placeholder="Nome do curso"
                maxlength="150"
                required>

        </div>


        <div class="col-md-6">

            <label>Instituição</label>

            <input
                type="text"
                class="form-control"
                name="instituicao"
                placeholder="Nome da instituição"
                maxlength="150"
                required>

        </div>

    </div>

</div>


<!-- PUBLICAÇÃO -->

<div class="card">

    <div class="card-header">
        <i class="fas fa-calendar-days"></i>
        Publicação
    </div>

    <div class="card-body row">

        <div class="col-md-4">

            <label>Data de Publicação</label>

            <input
                type="date"
                class="form-control"
                name="data_publicacao">

        </div>


        <div class="col-md-8">

            <label>Palavras-chave</label>

            <input
                type="text"
                class="form-control"
                name="palavras_chave"
                placeholder="Ex.: tecnologia, educação, pesquisa"
                maxlength="255">

        </div>

    </div>

</div>


<!-- RESUMO -->

<div class="card">

    <div class="card-header">
        <i class="fas fa-align-left"></i>
        Resumo
    </div>

    <div class="card-body">

        <div class="col-md-12">

            <label>Resumo do Trabalho</label>

            <textarea
                class="form-control"
                name="resumo"
                placeholder="Digite o resumo do trabalho acadêmico"></textarea>

        </div>

    </div>

</div>


<!-- ARQUIVO -->

<div class="card">

    <div class="card-header">
        <i class="fas fa-file-pdf"></i>
        Arquivo
    </div>

    <div class="card-body row">

        <div class="col-md-12">

            <label>Arquivo do Trabalho</label>

            <input
                type="file"
                class="form-control"
                name="arquivo"
                accept=".pdf,.doc,.docx">

            <small>
                Formatos permitidos: PDF, DOC e DOCX.
            </small>

        </div>

    </div>

</div>


<!-- BOTÕES -->

<div class="botoes">

    <button
        type="reset"
        class="btn btn-secondary">

        <i class="fas fa-eraser"></i>
        Limpar

    </button>


    <button
        type="submit"
        class="btn btn-primary">

        <i class="fas fa-save"></i>
        Salvar Trabalho

    </button>

</div>

</form>


<style>

form{
    max-width:1450px;
    margin:25px auto;
}

.card{
    border:0;
    border-radius:14px;
    overflow:hidden;
    box-shadow:0 5px 18px #00000014;
    margin-bottom:18px;
}

.card-header{
    background:linear-gradient(
        90deg,
        #b61d45,
        #8b2cf5
    );

    color:#fff;

    padding:12px 18px;

    font-weight:600;
}

.card-body{
    padding:18px;
}

.card-body>div{
    margin-bottom:12px;
}

label{
    display:block;
    margin-bottom:4px;

    font-size:13px;
    font-weight:600;

    color:#555;
}

.form-control,
.form-select{
    height:36px;
    font-size:13px;
    border-radius:8px;
}

textarea.form-control{
    height:100px;
    resize:vertical;
}

input[type="file"]{
    padding:6px 10px;
}

small{
    display:block;
    margin-top:5px;
    color:#888;
    font-size:11px;
}

.botoes{
    text-align:right;
    margin-bottom:35px;
}

.btn{
    height:38px;
    border-radius:8px;
    padding:0 18px;

    font-size:13px;
    font-weight:600;
}

.btn-primary{
    border:0;

    background:linear-gradient(
        90deg,
        #b61d45,
        #8b2cf5
    );
}

.btn-primary:hover{
    background:linear-gradient(
        90deg,
        #9f173c,
        #7622d8
    );
}

</style>


<?php include 'includes_painel/footer.php'; ?>

</body>
</html>