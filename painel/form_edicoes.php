
<?php
    include('verifica_login.php');
    include('conexao.php');

    mysqli_set_charset($conexao, 'utf8mb4');

    // Função para apresentar mensagens e retornar à página
    function mensagem($texto) {
        echo "<script>alert(" . json_encode($texto) . ");history.back();</script>";
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // Recebe os dados do formulário
        $campos = [
            'titulo_edicao', 'subtitulo', 'tema', 'tipo_edicao',
            'volume', 'numero', 'ano', 'doi', 'data_publicacao',
            'editor_responsavel', 'editores_convidados', 'apresentacao',
            'idioma', 'total_artigos', 'pagina_inicial', 'pagina_final',
            'url_edicao', 'capa_edicao', 'arquivo_pdf', 'licenca',
            'status'
        ];

        foreach ($campos as $campo) {
            $$campo = trim($_POST[$campo] ?? '');
        }

        $destaque = isset($_POST['destaque']) ? (int)$_POST['destaque'] : 0;

        // Validações
        if ($titulo_edicao === '' || $ano === '') {
            mensagem('Preencha o título da edição e o ano!');
        }

        if (!ctype_digit($ano) || (int)$ano < 1900 || (int)$ano > 2100) {
            mensagem('Informe um ano válido!');
        }

        if (!in_array($status, ['Rascunho', 'Em revisão', 'Publicado', 'Arquivado'], true)) {
            mensagem('Selecione um status válido!');
        }

        if (!in_array($destaque, [0, 1], true)) {
            mensagem('Valor de destaque inválido!');
        }

        // Validação dos campos numéricos opcionais
        $numericos = [
            'volume' => 1,
            'numero' => 1,
            'total_artigos' => 0,
            'pagina_inicial' => 1,
            'pagina_final' => 1
        ];

        foreach ($numericos as $campo => $minimo) {
            if ($$campo !== '') {
                if (!ctype_digit($$campo) || (int)$$campo < $minimo) {
                    mensagem("O campo " . str_replace('_', ' ', $campo) . " possui um valor inválido!");
                }
            }
        }

        if (
            $pagina_inicial !== '' &&
            $pagina_final !== '' &&
            (int)$pagina_final < (int)$pagina_inicial
        ) {
            mensagem('A página final não pode ser menor que a página inicial!');
        }

        // Trata campos opcionais vazios como NULL
        $volume = $volume === '' ? null : $volume;
        $numero = $numero === '' ? null : $numero;
        $data_publicacao = $data_publicacao === '' ? null : $data_publicacao;
        $total_artigos = $total_artigos === '' ? null : $total_artigos;
        $pagina_inicial = $pagina_inicial === '' ? null : $pagina_inicial;
        $pagina_final = $pagina_final === '' ? null : $pagina_final;

        // Verifica formato da data
        if ($data_publicacao !== null) {
            $data = DateTime::createFromFormat('Y-m-d', $data_publicacao);

            if (!$data || $data->format('Y-m-d') !== $data_publicacao) {
                mensagem('Informe uma data de publicação válida!');
            }
        }

        // A tabela edicoes possui id_revista obrigatório originalmente.
        // Como o painel Medeia não utiliza relacionamento com outra revista,
        // o campo deve permitir NULL no banco.

        // Garante AUTO_INCREMENT em id_edicao (corrige erro comum no XAMPP)
        @mysqli_query($conexao, "ALTER TABLE edicoes MODIFY id_edicao INT(11) NOT NULL AUTO_INCREMENT");
        @mysqli_query($conexao, "ALTER TABLE edicoes MODIFY id_revista INT(11) NULL DEFAULT NULL");
        @mysqli_query($conexao, "ALTER TABLE edicoes MODIFY numero INT(11) NULL DEFAULT NULL");

        // id_revista opcional no painel Medeia
        $id_revista = null;

        // Normaliza numéricos vazios para NULL
        $volume = ($volume === '' || $volume === null) ? null : (int)$volume;
        $numero = ($numero === '' || $numero === null) ? null : (int)$numero;
        $ano = (int)$ano;
        $total_artigos = ($total_artigos === '' || $total_artigos === null) ? null : (int)$total_artigos;
        $pagina_inicial = ($pagina_inicial === '' || $pagina_inicial === null) ? null : (int)$pagina_inicial;
        $pagina_final = ($pagina_final === '' || $pagina_final === null) ? null : (int)$pagina_final;
        $destaque = (int)$destaque;
        $data_publicacao = ($data_publicacao === '' || $data_publicacao === null) ? null : $data_publicacao;

        // Cadastro da edição na tabela edicoes
        $sql = "INSERT INTO edicoes (
            id_revista,
            titulo_edicao,
            subtitulo,
            tema,
            tipo_edicao,
            volume,
            numero,
            ano,
            doi,
            data_publicacao,
            editor_responsavel,
            editores_convidados,
            apresentacao,
            idioma,
            total_artigos,
            pagina_inicial,
            pagina_final,
            url_edicao,
            capa_edicao,
            arquivo_pdf,
            licenca,
            status,
            destaque,
            dt_cad_edicao
        ) VALUES (
            ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW()
        )";

        $stmt = mysqli_prepare($conexao, $sql);

        if (!$stmt) {
            // Se colunas novas ainda não existem, orienta a rodar o SQL de correção
            $errPrep = mysqli_error($conexao);
            mensagem(
                'Erro ao preparar o cadastro: ' . $errPrep .
                '\n\nExecute no phpMyAdmin o arquivo sql/corrige_tabela_edicoes.sql'
            );
        }

        // i = id_revista | sssss = textos | iiii = volume,numero,ano + doi is s
        // Layout: i + 4s + 3i + s + s + 4s + 3i + 4s + s + i
        // id_revista(i), titulo(s), subtitulo(s), tema(s), tipo(s),
        // volume(i), numero(i), ano(i), doi(s), data(s),
        // editor(s), editores(s), apresentacao(s), idioma(s),
        // total(i), pag_ini(i), pag_fim(i), url(s), capa(s), pdf(s), licenca(s),
        // status(s), destaque(i)
        $tipos = 'issssiiissssssiiisssssi';

        mysqli_stmt_bind_param(
            $stmt,
            $tipos,
            $id_revista,
            $titulo_edicao,
            $subtitulo,
            $tema,
            $tipo_edicao,
            $volume,
            $numero,
            $ano,
            $doi,
            $data_publicacao,
            $editor_responsavel,
            $editores_convidados,
            $apresentacao,
            $idioma,
            $total_artigos,
            $pagina_inicial,
            $pagina_final,
            $url_edicao,
            $capa_edicao,
            $arquivo_pdf,
            $licenca,
            $status,
            $destaque
        );

        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt);
            header('Location: lista_edicoes.php?sucesso=1');
            exit;
        }

        $erro = mysqli_stmt_error($stmt);
        mysqli_stmt_close($stmt);

        if (stripos($erro, 'id_edicao') !== false || stripos($erro, 'default value') !== false) {
            mensagem(
                'A tabela edicoes precisa de correção no banco.\n' .
                'No phpMyAdmin execute:\n' .
                'ALTER TABLE edicoes MODIFY id_edicao INT NOT NULL AUTO_INCREMENT;\n\n' .
                'Detalhe: ' . $erro
            );
        }

        mensagem('Erro ao cadastrar a edição: ' . $erro);
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Cadastro de Edição</title>
    <?php include 'includes_painel/head.php'; ?>
</head>

<body>

<?php include 'includes_painel/header.php'; ?>

<form action="form_edicoes.php" method="POST">

    <input type="hidden" name="csrf_token"
           value="<?= htmlspecialchars(csrf_token(), ENT_QUOTES, 'UTF-8') ?>">

    <div class="card">

        <div class="card-header">
            <i class="fas fa-book-open"></i> Dados da Edição
        </div>

        <div class="card-body row">

            <div class="col-md-8">
                <label>Título da Edição</label>
                <input class="form-control" name="titulo_edicao"
                       placeholder="Digite o título da edição"
                       maxlength="255" required>
            </div>

            <div class="col-md-4">
                <label>Tipo de Edição</label>
                <select class="form-select" name="tipo_edicao">
                    <option value="">Selecione</option>
                    <option>Regular</option>
                    <option>Especial</option>
                    <option>Suplemento</option>
                    <option>Temática</option>
                </select>
            </div>

            <div class="col-md-6">
                <label>Subtítulo</label>
                <input class="form-control" name="subtitulo"
                       placeholder="Subtítulo da edição" maxlength="255">
            </div>

            <div class="col-md-6">
                <label>Tema da Edição</label>
                <input class="form-control" name="tema"
                       placeholder="Tema principal da edição" maxlength="255">
            </div>

            <div class="col-md-4">
                <label>Volume</label>
                <input type="number" class="form-control" name="volume"
                       placeholder="Ex.: 1" min="1">
            </div>

            <div class="col-md-4">
                <label>Número</label>
                <input type="number" class="form-control" name="numero"
                       placeholder="Ex.: 1" min="1">
            </div>

            <div class="col-md-4">
                <label>Ano</label>
                <input type="number" class="form-control" name="ano"
                       placeholder="Ex.: 2026" min="1900" max="2100" required>
            </div>

            <div class="col-md-6">
                <label>DOI da Edição</label>
                <input class="form-control" name="doi"
                       placeholder="Ex.: 10.0000/medeia.2026.01" maxlength="255">
            </div>

            <div class="col-md-6">
                <label>Data de Publicação</label>
                <input type="date" class="form-control" name="data_publicacao">
            </div>

            <div class="col-md-6">
                <label>Idioma</label>
                <select class="form-select" name="idioma">
                    <option value="">Selecione</option>
                    <option>Português</option>
                    <option>Inglês</option>
                    <option>Espanhol</option>
                    <option>Francês</option>
                    <option>Outro</option>
                </select>
            </div>

            <div class="col-md-6">
                <label>Editor Responsável</label>
                <input class="form-control" name="editor_responsavel"
                       placeholder="Nome do editor responsável" maxlength="255">
            </div>

            <div class="col-md-12">
                <label>Editores Convidados</label>
                <textarea class="form-control" name="editores_convidados"
                          placeholder="Informe os nomes dos editores convidados"></textarea>
            </div>

            <div class="col-md-12">
                <label>Apresentação da Edição</label>
                <textarea class="form-control" name="apresentacao"
                          placeholder="Digite a apresentação ou editorial da edição"></textarea>
            </div>

            <div class="col-md-4">
                <label>Total de Artigos</label>
                <input type="number" class="form-control" name="total_artigos"
                       placeholder="Ex.: 10" min="0">
            </div>

            <div class="col-md-4">
                <label>Página Inicial</label>
                <input type="number" class="form-control" name="pagina_inicial"
                       placeholder="Ex.: 1" min="1">
            </div>

            <div class="col-md-4">
                <label>Página Final</label>
                <input type="number" class="form-control" name="pagina_final"
                       placeholder="Ex.: 150" min="1">
            </div>

            <div class="col-md-12">
                <label>URL da Edição</label>
                <input type="url" class="form-control" name="url_edicao"
                       placeholder="https://www.exemplo.com/edicao" maxlength="500">
            </div>

            <div class="col-md-6">
                <label>Caminho da Capa</label>
                <input class="form-control" name="capa_edicao"
                       placeholder="Ex.: uploads/capas/capa.jpg" maxlength="500">
            </div>

            <div class="col-md-6">
                <label>Caminho do Arquivo PDF</label>
                <input class="form-control" name="arquivo_pdf"
                       placeholder="Ex.: uploads/edicoes/edicao.pdf" maxlength="500">
            </div>

            <div class="col-md-6">
                <label>Licença de Publicação</label>
                <select class="form-select" name="licenca">
                    <option value="">Selecione</option>
                    <option>Todos os direitos reservados</option>
                    <option>CC BY</option>
                    <option>CC BY-SA</option>
                    <option>CC BY-NC</option>
                    <option>CC BY-NC-SA</option>
                    <option>CC BY-ND</option>
                    <option>CC BY-NC-ND</option>
                    <option>Outra</option>
                </select>
            </div>

            <div class="col-md-6">
                <label>Status</label>
                <select class="form-select" name="status">
                    <option>Rascunho</option>
                    <option>Em revisão</option>
                    <option>Publicado</option>
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
            <i class="fas fa-save"></i> Salvar Edição
        </button>

    </div>

</form>

<?php include 'includes_painel/footer.php'; ?>

</body>
</html>
