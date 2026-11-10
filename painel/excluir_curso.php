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

$ok = mysqli_query($conexao, "DELETE FROM cursos WHERE id_curso = $id");

if (!$ok) {
    die('Não foi possível excluir o curso: ' . htmlspecialchars(mysqli_error($conexao)));
}

header('Location: lista_cursos.php');
exit;
