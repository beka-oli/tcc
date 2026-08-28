<?php
include('verifica_login.php');
include('conexao.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $campos = [
        'id_edicao',
        'titulo',
        'autores',
        'palavras_chave',
        'resumo',
        'paginas',
        'doi',
        'status'
    ];

    foreach ($campos as $c)
        $$c = mysqli_real_escape_string($conexao, $_POST[$c] ?? '');

    if (!$id_edicao || !$titulo || !$status) {
        echo "<script>alert('Preencha todos os campos obrigatórios!');history.back();</script>";
        exit;
    }

    /* Verifica se a edição existe */
    $check = mysqli_query(
        $conexao,
        "SELECT id_edicao FROM edicoes WHERE id_edicao='$id_edicao' LIMIT 1"
    );

    if (!mysqli_num_rows($check)) {
        echo "<script>alert('A edição selecionada não existe!');history.back();</script>";
        exit;
    }

    /* Verifica artigo duplicado na mesma edição */
    $check = mysqli_query(
        $conexao,
        "SELECT id_artigo FROM artigos 
         WHERE id_edicao='$id_edicao' AND titulo='$titulo' LIMIT 1"
    );

    if (mysqli_num_rows($check)) {
        echo "<script>alert('Já existe um artigo com este título nesta edição!');history.back();</script>";
        exit;
    }

    $sql = "INSERT INTO artigos
    (id_edicao,titulo,autores,palavras_chave,resumo,paginas,doi,status)
    VALUES
    ('$id_edicao','$titulo','$autores','$palavras_chave','$resumo',
     '$paginas','$doi','$status')";

    if (mysqli_query($conexao, $sql)) {
        echo "<script>
            alert('Artigo cadastrado com sucesso!');
            location='cad_artigo.php';
        </script>";
        exit;
    }

    echo "<script>
        alert('Erro ao cadastrar o artigo!');
        history.back();
    </script>";
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Cadastro de Artigo</title>
    <?php include 'includes_painel/head.php'; ?>
</head>

<body>

<?php include 'includes_painel/header.php'; ?>

<form action="cad_artigo.php" method="POST">

<div class="card">
    <div class="card-header">
        <i class="fas fa-file-lines"></i> Dados do Artigo
    </div>

    <div class="card-body row">

        <div class="col-md-12">
            <label>Edição</label>

            <select class="form-select" name="id_edicao" required>
                <option value="">Selecione a edição</option>

                <?php
                $sql = "SELECT e.id_edicao,e.numero,e.volume,e.ano,r.nome
                        FROM edicoes e
                        INNER JOIN revistas r ON e.id_revista=r.id_revista
                        ORDER BY e.ano DESC";

                $resultado = mysqli_query($conexao,$sql);

                while ($edicao = mysqli_fetch_assoc($resultado)) {
                ?>

                <option value="<?= $edicao['id_edicao'] ?>">
                    <?= htmlspecialchars($edicao['nome']) ?>
                    - Edição <?= $edicao['numero'] ?>
                    - <?= $edicao['ano'] ?>
                </option>

                <?php } ?>

            </select>
        </div>

        <div class="col-md-12">
            <label>Título do Artigo</label>

            <input type="text"
                   class="form-control"
                   name="titulo"
                   placeholder="Digite o título do artigo"
                   maxlength="255"
                   required>
        </div>

        <div class="col-md-6">
            <label>Autores</label>

            <textarea class="form-control"
                      name="autores"
                      placeholder="Digite os autores"></textarea>
        </div>

        <div class="col-md-6">
            <label>Palavras-chave</label>

            <textarea class="form-control"
                      name="palavras_chave"
                      placeholder="Ex.: Ciência, Tecnologia, Pesquisa"></textarea>
        </div>

        <div class="col-md-12">
            <label>Resumo</label>

            <textarea class="form-control"
                      name="resumo"
                      placeholder="Digite o resumo do artigo"></textarea>
        </div>

        <div class="col-md-4">
            <label>Páginas</label>

            <input type="text"
                   class="form-control"
                   name="paginas"
                   placeholder="Ex.: 10-25">
        </div>

        <div class="col-md-4">
            <label>DOI</label>

            <input type="text"
                   class="form-control"
                   name="doi"
                   placeholder="Ex.: 10.1234/abc.2026">
        </div>

        <div class="col-md-4">
            <label>Status</label>

            <select class="form-select" name="status" required>
                <option value="">Selecione</option>
                <option>Rascunho</option>
                <option>Em Revisão</option>
                <option>Publicado</option>
                <option>Arquivado</option>
            </select>
        </div>

    </div>
</div>

<div class="botoes">

    <button type="reset" class="btn btn-secondary">
        <i class="fas fa-eraser"></i> Limpar
    </button>

    <button type="submit" class="btn btn-primary">
        <i class="fas fa-save"></i> Salvar Artigo
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