<?php
    include('verifica_login.php');
    include('conexao.php');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $nome         = mysqli_real_escape_string($conexao, trim($_POST['nome'] ?? ''));
        $email        = mysqli_real_escape_string($conexao, trim($_POST['email'] ?? ''));
        $instituicao  = mysqli_real_escape_string($conexao, trim($_POST['instituicao'] ?? ''));
        $especialidade = mysqli_real_escape_string($conexao, trim($_POST['area_atuacao'] ?? ''));
        $biografia    = mysqli_real_escape_string($conexao, trim($_POST['curriculo'] ?? ''));

        if ($nome === '') {
            echo "<script>alert('Informe o nome do autor!');history.back();</script>";
            exit;
        }

        $check = mysqli_query(
            $conexao,
            "SELECT id_autor FROM autores WHERE nome='$nome' LIMIT 1"
        );

        if ($check && mysqli_num_rows($check)) {
            echo "<script>alert('Este autor já está cadastrado!');history.back();</script>";
            exit;
        }

        // Colunas reais da tabela autores:
        // id_autor, nome, biografia, foto, email, instituicao, especialidade, criado_em
        $sql = "INSERT INTO autores
        (nome, biografia, email, instituicao, especialidade)
        VALUES
        ('$nome', '$biografia', '$email', '$instituicao', '$especialidade')";

        if (mysqli_query($conexao, $sql)) {
            echo "<script>
                alert('Autor cadastrado com sucesso!');
                location='lista_autores.php';
            </script>";
            exit;
        }

        $erro = mysqli_error($conexao);
        echo "<script>
            alert('Erro ao cadastrar o autor: " . addslashes($erro) . "');
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
        <form action="form_autores.php" method="POST">
            <input type="hidden" name="csrf_token" value="<?=h(csrf_token())?>">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-user-pen"></i> Dados do Autor
                </div>
                <div class="card-body row">
                    <div class="col-md-8">
                        <label>Nome Completo</label>
                        <input type="text" class="form-control" name="nome" placeholder="Digite o nome completo" maxlength="150" required>
                    </div>
                    <div class="col-md-4">
                        <label>E-mail</label>
                        <input type="email" class="form-control" name="email" placeholder="autor@email.com">
                    </div>
                    <div class="col-md-6">
                        <label>Instituição</label>
                        <input type="text" class="form-control" name="instituicao" placeholder="Nome da instituição" maxlength="255">
                    </div>
                    <div class="col-md-6">
                        <label>Área de Atuação / Especialidade</label>
                        <input type="text" class="form-control" name="area_atuacao" placeholder="Ex.: Ciência da Computação" maxlength="255">
                    </div>
                    <div class="col-md-12">
                        <label>Currículo / Biografia</label>
                        <textarea class="form-control" name="curriculo" placeholder="Digite informações sobre o autor"></textarea>
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
        <?php include 'includes_painel/footer.php'; ?>
    </body>
</html>
