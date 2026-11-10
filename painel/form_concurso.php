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

        // Datas vazias viram NULL (evita erro no MySQL)
        foreach (['data_inscricao_inicio','data_inscricao_fim','data_prova'] as $d) {
            if ($$d === '') $$d = null;
        }

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

        $di = $data_inscricao_inicio === null ? 'NULL' : "'$data_inscricao_inicio'";
        $df = $data_inscricao_fim === null ? 'NULL' : "'$data_inscricao_fim'";
        $dp = $data_prova === null ? 'NULL' : "'$data_prova'";

        $sql = "INSERT INTO concursos
        (nome,orgao,cargo,escolaridade,edital,ano,
        data_inscricao_inicio,data_inscricao_fim,data_prova,
        descricao,status,destaque,dt_cad_concurso)
        VALUES
        ('$nome','$orgao','$cargo','$escolaridade','$edital','$ano',
        $di,$df,$dp,
        '$descricao','$status','$destaque',NOW())";

        if (mysqli_query($conexao, $sql)) {
            echo "<script>
                alert('Concurso cadastrado com sucesso!');
                location='lista_concursos.php';
            </script>";
            exit;
        }

        $erro = addslashes(mysqli_error($conexao));
        echo "<script>alert('Erro ao cadastrar o concurso: $erro');history.back();</script>";
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
        <form action="form_concurso.php" method="POST"><input type="hidden" name="csrf_token" value="<?=h(csrf_token())?>">
            <!-- DADOS DO CONCURSO -->
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-file-alt"></i> Dados do Concurso
                </div>
                <div class="card-body row">
                    <div class="col-md-8">
                        <label>Nome do Concurso</label>
                        <input class="form-control" name="nome" placeholder="Digite o nome do concurso" maxlength="255" required>
                    </div>
                    <div class="col-md-4">
                        <label>Ano</label>
                        <input type="number" class="form-control"name="ano" placeholder="Ex.: 2026" min="1900" max="2100" required>
                    </div>
                    <div class="col-md-6">
                        <label>Órgão / Instituição</label>
                        <input class="form-control" name="orgao" placeholder="Ex.: Prefeitura Municipal" maxlength="255" required>
                    </div>
                    <div class="col-md-6">
                        <label>Cargo</label>
                        <input class="form-control" name="cargo" placeholder="Ex.: Técnico em Informática" maxlength="255" required>
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
                        <input class="form-control" name="edital" placeholder="Ex.: Edital nº 01/2026" maxlength="100">
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
                        <input type="date" class="form-control" name="data_inscricao_inicio">
                    </div>
                    <div class="col-md-4">
                        <label>Fim das Inscrições</label>
                        <input type="date" class="form-control" name="data_inscricao_fim">
                    </div>
                    <div class="col-md-4">
                        <label>Data da Prova</label>
                        <input type="date" class="form-control" name="data_prova">
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
                        <textarea class="form-control" name="descricao" placeholder="Digite informações sobre o concurso"></textarea>
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
        <?php include 'includes_painel/footer.php'; ?>
    </body>
</html>