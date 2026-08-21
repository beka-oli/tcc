```php
<?php

include('verifica_login.php');
include('conexao.php');



// =====================================================
// RECEBE OS DADOS DO FORMULÁRIO
// =====================================================

$issn = mysqli_real_escape_string(
    $conexao,
    $_POST['issn'] ?? ''
);

$nome = mysqli_real_escape_string(
    $conexao,
    $_POST['nome'] ?? ''
);

$volume = mysqli_real_escape_string(
    $conexao,
    $_POST['volume'] ?? ''
);

$numero = mysqli_real_escape_string(
    $conexao,
    $_POST['numero'] ?? ''
);

$ano = mysqli_real_escape_string(
    $conexao,
    $_POST['ano'] ?? ''
);

$doi = mysqli_real_escape_string(
    $conexao,
    $_POST['doi'] ?? ''
);

$periodicidade = mysqli_real_escape_string(
    $conexao,
    $_POST['periodicidade'] ?? ''
);

$editor_chefe = mysqli_real_escape_string(
    $conexao,
    $_POST['editor_chefe'] ?? ''
);

$conselho = mysqli_real_escape_string(
    $conexao,
    $_POST['conselho'] ?? ''
);

$revisores = mysqli_real_escape_string(
    $conexao,
    $_POST['revisores'] ?? ''
);

$data_publicacao = mysqli_real_escape_string(
    $conexao,
    $_POST['data_publicacao'] ?? ''
);

$status = mysqli_real_escape_string(
    $conexao,
    $_POST['status'] ?? 'Rascunho'
);

$destaque = mysqli_real_escape_string(
    $conexao,
    $_POST['destaque'] ?? '0'
);


// =====================================================
// VALIDAÇÃO DOS CAMPOS OBRIGATÓRIOS
// =====================================================

if (
    empty($issn) ||
    empty($nome) ||
    empty($ano) ||
    empty($periodicidade) ||
    empty($editor_chefe)
) {

    echo "<script>
            alert('Preencha todos os campos obrigatórios!');
            history.go(-1);
          </script>";

    exit;
}


// =====================================================
// VERIFICA SE A REVISTA JÁ ESTÁ CADASTRADA
// =====================================================

$sql_verifica = "
    SELECT id_revista
    FROM revistas
    WHERE issn = '$issn'
    LIMIT 1
";

$resultado = mysqli_query($conexao, $sql_verifica);


if (mysqli_num_rows($resultado) > 0) {

    echo "<script>
            alert('Já existe uma revista cadastrada com este ISSN!');
            history.go(-1);
          </script>";

    exit;
}


// =====================================================
// CADASTRA A REVISTA
// =====================================================

$sql_insert = "
    INSERT INTO revistas
    (
        issn,
        nome,
        volume,
        numero,
        ano,
        doi,
        periodicidade,
        editor_chefe,
        conselho,
        revisores,
        data_publicacao,
        status,
        destaque,
        dt_cad_revista
    )
    VALUES
    (
        '$issn',
        '$nome',
        '$volume',
        '$numero',
        '$ano',
        '$doi',
        '$periodicidade',
        '$editor_chefe',
        '$conselho',
        '$revisores',
        '$data_publicacao',
        '$status',
        '$destaque',
        NOW()
    )
";


// =====================================================
// EXECUTA O CADASTRO
// =====================================================

if (mysqli_query($conexao, $sql_insert)) {

    echo "<script>

            alert('Revista cadastrada com sucesso!');

            window.location.href = 'cad_revista.php';

          </script>";

} else {

    echo "<script>

            alert('Erro ao cadastrar a revista!');

            history.go(-1);

          </script>";

}

?>
```
