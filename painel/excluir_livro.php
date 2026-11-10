<?php
include 'verifica_login.php';

if (!validar_csrf($_GET['csrf_token'] ?? null)) {
    http_response_code(403);
    exit('Solicitação inválida. Atualize a página e tente novamente.');
}

include 'conexao.php';
mysqli_set_charset($conexao, 'utf8mb4');

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id || $id < 1) {
    die('ID inválido.');
}

mysqli_begin_transaction($conexao);

try {
    // Remove vínculos livro_autor se a tabela existir
    $t = mysqli_query($conexao, "SHOW TABLES LIKE 'livro_autor'");
    if ($t && mysqli_num_rows($t) > 0) {
        if (!mysqli_query($conexao, "DELETE FROM livro_autor WHERE id_livro = $id")) {
            throw new Exception(mysqli_error($conexao));
        }
    }

    if (!mysqli_query($conexao, "DELETE FROM livros WHERE id_livro = $id")) {
        throw new Exception(mysqli_error($conexao));
    }

    mysqli_commit($conexao);
    header('Location: lista_livros.php');
    exit;
} catch (Exception $e) {
    mysqli_rollback($conexao);
    die('Não foi possível excluir o livro: ' . htmlspecialchars($e->getMessage()));
}
