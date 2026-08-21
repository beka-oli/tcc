<?php

include('verifica_login.php');
include('conexao.php');


// =====================================================
// RECEBE OS DADOS DO FORMULÁRIO
// =====================================================

$nome = mysqli_real_escape_string(
    $conexao,
    $_POST['nome'] ?? ''
);

$orgao = mysqli_real_escape_string(
    $conexao,
    $_POST['orgao'] ?? ''
);

$cargo = mysqli_real_escape_string(
    $conexao,
    $_POST['cargo'] ?? ''
);

$escolaridade = mysqli_real_escape_string(
    $conexao,
    $_POST['escolaridade'] ?? ''
);

$edital = mysqli_real_escape_string(
    $conexao,
    $_POST['edital'] ?? ''
);

$ano = mysqli_real_escape_string(
    $conexao,
    $_POST['ano'] ?? ''
);

$data_inscricao_inicio = mysqli_real_escape_string(
    $conexao,
    $_POST['data_inscricao_inicio'] ?? ''
);

$data_inscricao_fim = mysqli_real_escape_string(
    $conexao,
    $_POST['data_inscricao_fim'] ?? ''
);

$data_prova = mysqli_real_escape_string(
    $conexao,
    $_POST['data_prova'] ?? ''
);

$descricao = mysqli_real_escape_string(
    $conexao,
    $_POST['descricao'] ?? ''
);

$status = mysqli_real_escape_string(
    $conexao,
    $_POST['status'] ?? 'Aberto'
);

$destaque = mysqli_real_escape_string(
    $conexao,
    $_POST['destaque'] ?? '0'
);


// =====================================================
// VALIDAÇÃO DOS CAMPOS OBRIGATÓRIOS
// =====================================================

if (
    empty($nome) ||
    empty($orgao) ||
    empty($cargo) ||
    empty($escolaridade) ||
    empty($ano)
) {

    echo "<script>
            alert('Preencha todos os campos obrigatórios!');
            history.go(-1);
          </script>";

    exit;
}


// =====================================================
// VERIFICA SE O CONCURSO JÁ ESTÁ CADASTRADO
// =====================================================

$sql_verifica = "
    SELECT id_concurso
    FROM concursos
    WHERE nome = '$nome'
    AND orgao = '$orgao'
    AND cargo = '$cargo'
    AND ano = '$ano'
    LIMIT 1
";

$resultado = mysqli_query($conexao, $sql_verifica);


if (!$resultado) {

    echo "<script>
            alert('Erro ao verificar o concurso no banco de dados!');
            history.go(-1);
          </script>";

    exit;
}


if (mysqli_num_rows($resultado) > 0) {

    echo "<script>
            alert('Este concurso já está cadastrado!');
            history.go(-1);
          </script>";

    exit;
}


// =====================================================
// CADASTRA O CONCURSO
// =====================================================

$sql_insert = "
    INSERT INTO concursos
    (
        nome,
        orgao,
        cargo,
        escolaridade,
        edital,
        ano,
        data_inscricao_inicio,
        data_inscricao_fim,
        data_prova,
        descricao,
        status,
        destaque,
        dt_cad_concurso
    )
    VALUES
    (
        '$nome',
        '$orgao',
        '$cargo',
        '$escolaridade',
        '$edital',
        '$ano',
        '$data_inscricao_inicio',
        '$data_inscricao_fim',
        '$data_prova',
        '$descricao',
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

            alert('Concurso cadastrado com sucesso!');

            window.location.href = 'cad_concurso.php';

          </script>";

} else {

    echo "<script>

            alert('Erro ao cadastrar o concurso!');

            history.go(-1);

          </script>";

}

?>