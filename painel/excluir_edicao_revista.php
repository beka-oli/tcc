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
    // Artigos vinculados à edição (se a coluna existir)
    $cols = mysqli_query($conexao, "SHOW COLUMNS FROM artigos LIKE 'id_edicao'");
    if ($cols && mysqli_num_rows($cols) > 0) {
        $arts = mysqli_query($conexao, "SELECT id_artigo FROM artigos WHERE id_edicao = $id");
        if ($arts) {
            while ($a = mysqli_fetch_assoc($arts)) {
                $aid = (int)$a['id_artigo'];
                // vínculos artigo_autor
                $t = mysqli_query($conexao, "SHOW TABLES LIKE 'artigo_autor'");
                if ($t && mysqli_num_rows($t) > 0) {
                    if (!mysqli_query($conexao, "DELETE FROM artigo_autor WHERE id_artigo = $aid")) {
                        throw new Exception(mysqli_error($conexao));
                    }
                }
            }
        }
        if (!mysqli_query($conexao, "DELETE FROM artigos WHERE id_edicao = $id")) {
            throw new Exception(mysqli_error($conexao));
        }
    }

    if (!mysqli_query($conexao, "DELETE FROM edicoes WHERE id_edicao = $id")) {
        throw new Exception(mysqli_error($conexao));
    }

    mysqli_commit($conexao);
    header('Location: lista_edicoes.php');
    exit;
} catch (Exception $e) {
    mysqli_rollback($conexao);
    die('Não foi possível excluir a edição: ' . htmlspecialchars($e->getMessage()));
}
