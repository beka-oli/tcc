<?php
include('verifica_login.php');
include('conexao.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $campos = [
        'titulo','isbn','autor','editora','ano_publicacao','paginas',
        'edicao','categoria','idioma','sinopse','data_cadastro',
        'status','destaque'
    ];

    foreach ($campos as $c)
        $$c = mysqli_real_escape_string($conexao, $_POST[$c] ?? '');

    $status = $status ?: 'Disponível';
    $destaque = $destaque ?: '0';

    if (!$titulo || !$autor || !$ano_publicacao || !$categoria || !$idioma) {
        echo "<script>alert('Preencha todos os campos obrigatórios!');history.back();</script>";
        exit;
    }

    if ($isbn) {
        $check = mysqli_query($conexao,
            "SELECT id_livro FROM livros WHERE isbn='$isbn' LIMIT 1"
        );

        if (!$check) {
            echo "<script>alert('Erro ao verificar o livro no banco de dados!');history.back();</script>";
            exit;
        }

        if (mysqli_num_rows($check)) {
            echo "<script>alert('Já existe um livro cadastrado com este ISBN!');history.back();</script>";
            exit;
        }
    }

    $sql = "INSERT INTO livros
    (titulo,isbn,autor,editora,ano_publicacao,paginas,edicao,categoria,
    idioma,sinopse,data_cadastro,status,destaque,dt_cad_livro)
    VALUES
    ('$titulo','$isbn','$autor','$editora','$ano_publicacao','$paginas',
    '$edicao','$categoria','$idioma','$sinopse','$data_cadastro',
    '$status','$destaque',NOW())";

    if (mysqli_query($conexao, $sql)) {
        echo "<script>alert('Livro cadastrado com sucesso!');location='cad_livro.php';</script>";
        exit;
    }

    echo "<script>alert('Erro ao cadastrar o livro!');history.back();</script>";
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Cadastro de Livro</title>
    <?php include 'includes_painel/head.php'; ?>
</head>

<body>

<?php include 'includes_painel/header.php'; ?>

<form action="cad_livro.php" method="POST">

<div class="card">
    <div class="card-header">
        <i class="fas fa-book"></i> Dados do Livro
    </div>

    <div class="card-body row">

        <div class="col-md-8">
            <label>Título</label>
            <input class="form-control" name="titulo"
                   placeholder="Digite o título do livro"
                   maxlength="255" required>
        </div>

        <div class="col-md-4">
            <label>ISBN</label>
            <input class="form-control" name="isbn"
                   placeholder="Ex.: 978-85-00000-00-0"
                   maxlength="20">
        </div>

        <div class="col-md-6">
            <label>Autor</label>
            <input class="form-control" name="autor"
                   placeholder="Nome do autor"
                   maxlength="255" required>
        </div>

        <div class="col-md-6">
            <label>Editora</label>
            <input class="form-control" name="editora"
                   placeholder="Nome da editora"
                   maxlength="255">
        </div>

        <div class="col-md-4">
            <label>Ano de Publicação</label>
            <input type="number" class="form-control"
                   name="ano_publicacao"
                   placeholder="Ex.: 2026"
                   min="1900" max="2100" required>
        </div>

        <div class="col-md-4">
            <label>Páginas</label>
            <input type="number" class="form-control"
                   name="paginas"
                   placeholder="Ex.: 250"
                   min="1">
        </div>

        <div class="col-md-4">
            <label>Edição</label>
            <input type="number" class="form-control"
                   name="edicao"
                   placeholder="Ex.: 1"
                   min="1">
        </div>

        <div class="col-md-4">
            <label>Categoria</label>
            <select class="form-select" name="categoria" required>
                <option value="">Selecione</option>
                <option>Literatura</option>
                <option>Romance</option>
                <option>Ficção</option>
                <option>Fantasia</option>
                <option>História</option>
                <option>Ciência</option>
                <option>Tecnologia</option>
                <option>Educação</option>
                <option>Outros</option>
            </select>
        </div>

        <div class="col-md-4">
            <label>Idioma</label>
            <select class="form-select" name="idioma" required>
                <option value="">Selecione</option>
                <option>Português</option>
                <option>Inglês</option>
                <option>Espanhol</option>
                <option>Francês</option>
                <option>Outro</option>
            </select>
        </div>

        <div class="col-md-4">
            <label>Data de Cadastro</label>
            <input type="date" class="form-control" name="data_cadastro">
        </div>

        <div class="col-md-12">
            <label>Sinopse</label>
            <textarea class="form-control" name="sinopse"
                      placeholder="Digite a sinopse do livro"></textarea>
        </div>

        <div class="col-md-6">
            <label>Status</label>
            <select class="form-select" name="status">
                <option>Disponível</option>
                <option>Indisponível</option>
                <option>Em Empréstimo</option>
                <option>Arquivado</option>
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
        <i class="fas fa-save"></i> Salvar Livro
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
textarea.form-control{height:80px;resize:vertical}
.botoes{text-align:right;margin-bottom:35px}
.btn{height:38px;border-radius:8px;padding:0 18px;font-size:13px;font-weight:600}
.btn-primary{border:0;background:linear-gradient(90deg,#b61d45,#8b2cf5)}
</style>

<?php include 'includes_painel/footer.php'; ?>

</body>
</html>