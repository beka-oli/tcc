<?php

include('verifica_login.php');
include('conexao.php');


// =====================================================
// RECEBE OS DADOS DO FORMULÁRIO
// =====================================================

$titulo = mysqli_real_escape_string(
    $conexao,
    $_POST['titulo'] ?? ''
);

$isbn = mysqli_real_escape_string(
    $conexao,
    $_POST['isbn'] ?? ''
);

$autor = mysqli_real_escape_string(
    $conexao,
    $_POST['autor'] ?? ''
);

$editora = mysqli_real_escape_string(
    $conexao,
    $_POST['editora'] ?? ''
);

$ano_publicacao = mysqli_real_escape_string(
    $conexao,
    $_POST['ano_publicacao'] ?? ''
);

$paginas = mysqli_real_escape_string(
    $conexao,
    $_POST['paginas'] ?? ''
);

$edicao = mysqli_real_escape_string(
    $conexao,
    $_POST['edicao'] ?? ''
);

$categoria = mysqli_real_escape_string(
    $conexao,
    $_POST['categoria'] ?? ''
);

$idioma = mysqli_real_escape_string(
    $conexao,
    $_POST['idioma'] ?? ''
);

$sinopse = mysqli_real_escape_string(
    $conexao,
    $_POST['sinopse'] ?? ''
);

$data_cadastro = mysqli_real_escape_string(
    $conexao,
    $_POST['data_cadastro'] ?? ''
);

$status = mysqli_real_escape_string(
    $conexao,
    $_POST['status'] ?? 'Disponível'
);

$destaque = mysqli_real_escape_string(
    $conexao,
    $_POST['destaque'] ?? '0'
);


// =====================================================
// VALIDAÇÃO DOS CAMPOS OBRIGATÓRIOS
// =====================================================

if (
    empty($titulo) ||
    empty($autor) ||
    empty($ano_publicacao) ||
    empty($categoria) ||
    empty($idioma)
) {

    echo "<script>
            alert('Preencha todos os campos obrigatórios!');
            history.go(-1);
          </script>";

    exit;
}


// =====================================================
// VERIFICA SE O LIVRO JÁ ESTÁ CADASTRADO
// =====================================================

if (!empty($isbn)) {

    $sql_verifica = "
        SELECT id_livro
        FROM livros
        WHERE isbn = '$isbn'
        LIMIT 1
    ";

    $resultado = mysqli_query($conexao, $sql_verifica);

    if (!$resultado) {

        echo "<script>
                alert('Erro ao verificar o livro no banco de dados!');
                history.go(-1);
              </script>";

        exit;
    }


    if (mysqli_num_rows($resultado) > 0) {

        echo "<script>
                alert('Já existe um livro cadastrado com este ISBN!');
                history.go(-1);
              </script>";

        exit;
    }
}


// =====================================================
// CADASTRA O LIVRO
// =====================================================

$sql_insert = "
    INSERT INTO livros
    (
        titulo,
        isbn,
        autor,
        editora,
        ano_publicacao,
        paginas,
        edicao,
        categoria,
        idioma,
        sinopse,
        data_cadastro,
        status,
        destaque,
        dt_cad_livro
    )
    VALUES
    (
        '$titulo',
        '$isbn',
        '$autor',
        '$editora',
        '$ano_publicacao',
        '$paginas',
        '$edicao',
        '$categoria',
        '$idioma',
        '$sinopse',
        '$data_cadastro',
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

            alert('Livro cadastrado com sucesso!');

            window.location.href = 'cad_livro.php';

          </script>";

} else {

    echo "<script>

            alert('Erro ao cadastrar o livro!');

            history.go(-1);

          </script>";

}

?>