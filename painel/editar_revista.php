<?php

include 'verifica_login.php';
include 'conexao.php';
include '_layout.php';

$id = id_get('id');


// =====================================================
// SALVAR ALTERAÇÕES
// =====================================================

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $issn          = esc($conexao, $_POST['issn'] ?? '');
    $nome          = esc($conexao, $_POST['nome'] ?? '');
    $volume        = esc($conexao, $_POST['volume'] ?? '');
    $numero        = esc($conexao, $_POST['numero'] ?? '');
    $ano           = esc($conexao, $_POST['ano'] ?? '');
    $status        = esc($conexao, $_POST['status'] ?? '');
    $doi           = esc($conexao, $_POST['doi'] ?? '');
    $periodicidade = esc($conexao, $_POST['periodicidade'] ?? '');
    $editor        = esc($conexao, $_POST['editor_chefe'] ?? '');
    $conselho      = esc($conexao, $_POST['conselho'] ?? '');
    $revisores     = esc($conexao, $_POST['revisores'] ?? '');


    if ($nome === '') {
        erro('Informe o nome da revista.');
    }


    $sql = "
        UPDATE revistas SET
            issn = '$issn',
            nome = '$nome',
            volume = '$volume',
            numero = '$numero',
            ano = '$ano',
            status = '$status',
            doi = '$doi',
            periodicidade = '$periodicidade',
            editor_chefe = '$editor',
            conselho = '$conselho',
            revisores = '$revisores'
        WHERE id_revista = $id
    ";


    $ok = mysqli_query($conexao, $sql);


    if (!$ok) {
        erro(mysqli_error($conexao));
    }


    redirect('lista_revistas.php');
}


// =====================================================
// BUSCAR REVISTA
// =====================================================

$r = mysqli_query(
    $conexao,
    "SELECT * FROM revistas WHERE id_revista = $id"
);


if (!$r || mysqli_num_rows($r) !== 1) {
    erro('Revista não encontrada.');
}


$row = mysqli_fetch_assoc($r);

?>

<!doctype html>

<html lang="pt-BR">

<head>

    <meta charset="utf-8">

    <title>Editar Revista</title>

    <?php include 'includes_painel/head.php'; ?>

    <?php include '_form_style.php'; ?>

</head>


<body>

<?php include 'includes_painel/header.php'; ?>


<div class="crud">

    <div class="card">

        <h1>Editar Revista</h1>


        <form method="post"><input type="hidden" name="csrf_token" value="<?=h(csrf_token())?>">

            <div class="grid">


                <!-- ISSN -->

                <div class="campo">

                    <label>ISSN</label>

                    <input
                        type="text"
                        name="issn"
                        value="<?= h($row['issn'] ?? '') ?>"
                    >

                </div>


                <!-- NOME -->

                <div class="campo">

                    <label>Nome da Revista</label>

                    <input
                        type="text"
                        name="nome"
                        required
                        value="<?= h($row['nome'] ?? '') ?>"
                    >

                </div>


                <!-- VOLUME -->

                <div class="campo">

                    <label>Volume</label>

                    <input
                        type="text"
                        name="volume"
                        value="<?= h($row['volume'] ?? '') ?>"
                    >

                </div>


                <!-- NÚMERO -->

                <div class="campo">

                    <label>Número</label>

                    <input
                        type="text"
                        name="numero"
                        value="<?= h($row['numero'] ?? '') ?>"
                    >

                </div>


                <!-- ANO -->

                <div class="campo">

                    <label>Ano</label>

                    <input
                        type="number"
                        name="ano"
                        value="<?= h($row['ano'] ?? '') ?>"
                    >

                </div>


                <!-- DOI -->

                <div class="campo">

                    <label>DOI</label>

                    <input
                        type="text"
                        name="doi"
                        value="<?= h($row['doi'] ?? '') ?>"
                    >

                </div>


                <!-- PERIODICIDADE -->

                <div class="campo">

                    <label>Periodicidade</label>

                    <input
                        type="text"
                        name="periodicidade"
                        value="<?= h($row['periodicidade'] ?? '') ?>"
                    >

                </div>


                <!-- EDITOR-CHEFE -->

                <div class="campo">

                    <label>Editor-chefe</label>

                    <input
                        type="text"
                        name="editor_chefe"
                        value="<?= h($row['editor_chefe'] ?? '') ?>"
                    >

                </div>


                <!-- STATUS -->

                <div class="campo">

                    <label>Status</label>

                    <select name="status">

                        <?php

                        $statusOptions = [
                            'Publicado',
                            'Em Revisão',
                            'Rascunho',
                            'Arquivado'
                        ];

                        foreach ($statusOptions as $op):

                        ?>

                            <option
                                value="<?= h($op) ?>"
                                <?= ($row['status'] ?? '') === $op ? 'selected' : '' ?>
                            >
                                <?= h($op) ?>
                            </option>

                        <?php endforeach; ?>

                    </select>

                </div>


                <!-- CONSELHO EDITORIAL -->

                <div class="campo full">

                    <label>Conselho Editorial</label>

                    <textarea
                        name="conselho"
                    ><?= h($row['conselho'] ?? '') ?></textarea>

                </div>


                <!-- REVISORES -->

                <div class="campo full">

                    <label>Revisores</label>

                    <textarea
                        name="revisores"
                    ><?= h($row['revisores'] ?? '') ?></textarea>

                </div>


            </div>


            <!-- BOTÕES -->

            <div class="acoes">

                <button
                    type="submit"
                    class="btn salvar"
                >
                    Salvar alterações
                </button>


                <a
                    class="btn voltar"
                    href="lista_revistas.php"
                >
                    Cancelar
                </a>

            </div>


        </form>

    </div>

</div>


</body>

</html>