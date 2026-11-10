<?php
include 'verifica_login.php';

if (!validar_csrf($_GET['csrf_token'] ?? null)) {
    http_response_code(403);
    exit('Solicitação inválida. Atualize a página (F5) e tente excluir novamente.');
}

include 'conexao.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id || $id < 1) {
    die('ID inválido.');
}

mysqli_begin_transaction($conexao);

try {
    // Busca as edições vinculadas à revista
    $e = mysqli_query(
        $conexao,
        "SELECT id_edicao FROM edicoes WHERE id_revista = $id"
    );

    if (!$e) {
        throw new Exception(mysqli_error($conexao));
    }

    while ($ed = mysqli_fetch_assoc($e)) {
        $eid = (int) $ed['id_edicao'];

        // Busca os artigos de cada edição
        $arts = mysqli_query(
            $conexao,
            "SELECT id_artigo FROM artigos WHERE id_edicao = $eid"
        );

        if (!$arts) {
            throw new Exception(mysqli_error($conexao));
        }

        // Exclui os vínculos entre artigos e autores
        while ($a = mysqli_fetch_assoc($arts)) {
            $aid = (int) $a['id_artigo'];

            if (!mysqli_query(
                $conexao,
                "DELETE FROM artigo_autor WHERE id_artigo = $aid"
            )) {
                throw new Exception(mysqli_error($conexao));
            }
        }

        // Exclui os artigos da edição
        if (!mysqli_query(
            $conexao,
            "DELETE FROM artigos WHERE id_edicao = $eid"
        )) {
            throw new Exception(mysqli_error($conexao));
        }
    }

    // Exclui as edições da revista
    if (!mysqli_query(
        $conexao,
        "DELETE FROM edicoes WHERE id_revista = $id"
    )) {
        throw new Exception(mysqli_error($conexao));
    }

    // Exclui a revista
    if (!mysqli_query(
        $conexao,
        "DELETE FROM revistas WHERE id_revista = $id"
    )) {
        throw new Exception(mysqli_error($conexao));
    }

    mysqli_commit($conexao);

    header('Location: lista_revistas.php');
    exit;

} catch (Exception $e) {
    mysqli_rollback($conexao);

    die(
        'Não foi possível excluir a revista: ' .
        htmlspecialchars($e->getMessage())
    );
}