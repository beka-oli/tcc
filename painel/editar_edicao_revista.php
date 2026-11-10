<?php
include 'verifica_login.php';
include 'conexao.php';
include '_layout.php';

mysqli_set_charset($conexao, 'utf8mb4');

// Garante estrutura mínima da tabela
@mysqli_query($conexao, "ALTER TABLE edicoes MODIFY id_edicao INT(11) NOT NULL AUTO_INCREMENT");
@mysqli_query($conexao, "ALTER TABLE edicoes MODIFY id_revista INT(11) NULL DEFAULT NULL");

$id = id_get('id');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo_edicao = esc($conexao, $_POST['titulo_edicao'] ?? '');
    $subtitulo = esc($conexao, $_POST['subtitulo'] ?? '');
    $tema = esc($conexao, $_POST['tema'] ?? '');
    $tipo_edicao = esc($conexao, $_POST['tipo_edicao'] ?? '');
    $volume = trim($_POST['volume'] ?? '');
    $numero = trim($_POST['numero'] ?? '');
    $ano = trim($_POST['ano'] ?? '');
    $doi = esc($conexao, $_POST['doi'] ?? '');
    $data_publicacao = trim($_POST['data_publicacao'] ?? '');
    $editor_responsavel = esc($conexao, $_POST['editor_responsavel'] ?? '');
    $idioma = esc($conexao, $_POST['idioma'] ?? '');
    $status = esc($conexao, $_POST['status'] ?? 'Rascunho');
    $destaque = isset($_POST['destaque']) ? (int)$_POST['destaque'] : 0;

    if ($titulo_edicao === '' || $ano === '') {
        erro('Preencha o título da edição e o ano.');
    }

    $volumeSql = $volume === '' ? 'NULL' : (int)$volume;
    $numeroSql = $numero === '' ? 'NULL' : (int)$numero;
    $anoSql = (int)$ano;
    $dataSql = $data_publicacao === '' ? 'NULL' : "'" . esc($conexao, $data_publicacao) . "'";
    $destaque = in_array($destaque, [0, 1], true) ? $destaque : 0;

    $sql = "
        UPDATE edicoes SET
            titulo_edicao = '$titulo_edicao',
            subtitulo = '$subtitulo',
            tema = '$tema',
            tipo_edicao = '$tipo_edicao',
            volume = $volumeSql,
            numero = $numeroSql,
            ano = $anoSql,
            doi = '$doi',
            data_publicacao = $dataSql,
            editor_responsavel = '$editor_responsavel',
            idioma = '$idioma',
            status = '$status',
            destaque = $destaque
        WHERE id_edicao = $id
    ";

    $ok = mysqli_query($conexao, $sql);
    if (!$ok) {
        erro('Não foi possível salvar: ' . mysqli_error($conexao));
    }

    redirect('lista_edicoes.php');
}

$r = mysqli_query($conexao, "SELECT * FROM edicoes WHERE id_edicao = $id LIMIT 1");
if (!$r || mysqli_num_rows($r) !== 1) {
    erro('Edição não encontrada.');
}
$row = mysqli_fetch_assoc($r);

$statusOpts = ['Rascunho', 'Em revisão', 'Publicado', 'Arquivado'];
?>
<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <title>Editar Edição</title>
    <?php include 'includes_painel/head.php'; ?>
</head>
<body>
<?php include 'includes_painel/header.php'; ?>
<div class="crud">
    <div class="card">
        <h1>Editar Edição</h1>
        <form method="post">
            <input type="hidden" name="csrf_token" value="<?= h(csrf_token()) ?>">
            <div class="grid">
                <div class="campo full">
                    <label>Título da edição</label>
                    <input name="titulo_edicao" required value="<?= h($row['titulo_edicao'] ?? '') ?>">
                </div>
                <div class="campo">
                    <label>Subtítulo</label>
                    <input name="subtitulo" value="<?= h($row['subtitulo'] ?? '') ?>">
                </div>
                <div class="campo">
                    <label>Tema</label>
                    <input name="tema" value="<?= h($row['tema'] ?? '') ?>">
                </div>
                <div class="campo">
                    <label>Tipo</label>
                    <input name="tipo_edicao" value="<?= h($row['tipo_edicao'] ?? '') ?>">
                </div>
                <div class="campo">
                    <label>Volume</label>
                    <input type="number" name="volume" value="<?= h($row['volume'] ?? '') ?>">
                </div>
                <div class="campo">
                    <label>Número</label>
                    <input type="number" name="numero" value="<?= h($row['numero'] ?? '') ?>">
                </div>
                <div class="campo">
                    <label>Ano</label>
                    <input type="number" name="ano" required value="<?= h($row['ano'] ?? '') ?>">
                </div>
                <div class="campo">
                    <label>DOI</label>
                    <input name="doi" value="<?= h($row['doi'] ?? '') ?>">
                </div>
                <div class="campo">
                    <label>Data de publicação</label>
                    <input type="date" name="data_publicacao" value="<?= h($row['data_publicacao'] ?? '') ?>">
                </div>
                <div class="campo">
                    <label>Editor responsável</label>
                    <input name="editor_responsavel" value="<?= h($row['editor_responsavel'] ?? '') ?>">
                </div>
                <div class="campo">
                    <label>Idioma</label>
                    <input name="idioma" value="<?= h($row['idioma'] ?? '') ?>">
                </div>
                <div class="campo">
                    <label>Status</label>
                    <select name="status">
                        <?php foreach ($statusOpts as $op): ?>
                            <option value="<?= h($op) ?>" <?= ($row['status'] ?? '') === $op ? 'selected' : '' ?>><?= h($op) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="campo">
                    <label>Destaque</label>
                    <select name="destaque">
                        <option value="0" <?= empty($row['destaque']) ? 'selected' : '' ?>>Não</option>
                        <option value="1" <?= !empty($row['destaque']) ? 'selected' : '' ?>>Sim</option>
                    </select>
                </div>
            </div>
            <div class="acoes">
                <button class="btn salvar" type="submit">Salvar alterações</button>
                <a class="btn voltar" href="lista_edicoes.php">Cancelar</a>
            </div>
        </form>
    </div>
</div>
</body>
</html>
