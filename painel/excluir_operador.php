<?php
require_once __DIR__ . '/verifica_login.php';
require_once __DIR__ . '/conexao.php';
require_once __DIR__ . '/controle_acesso.php';

exigir_perfil(['master', 'ultra_master']);

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
if (!validar_csrf($_POST['csrf_token'] ?? null)) {
    $_SESSION['usuario_erro'] = 'Requisição de segurança inválida.';
    header('Location: lista_operadores.php');
    exit;
}
if (!$id || $id < 1) die('ID inválido.');
if ($id === (int)($_SESSION['usuario_id'] ?? 0)) {
    $_SESSION['usuario_erro'] = 'Você não pode excluir o próprio usuário.';
    header('Location: lista_operadores.php');
    exit;
}

$stmt = mysqli_prepare($conexao, 'SELECT id, nome_operador, perfil FROM operadores WHERE id = ? LIMIT 1');
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
$usuario = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
mysqli_stmt_close($stmt);

if (!$usuario || !pode_gerenciar_usuario($usuario)) {
    header('Location: sem_permissao.php');
    exit;
}

$stmt = mysqli_prepare($conexao, 'DELETE FROM operadores WHERE id = ?');
mysqli_stmt_bind_param($stmt, 'i', $id);
if (mysqli_stmt_execute($stmt)) {
    $_SESSION['usuario_msg'] = 'Usuário excluído com sucesso.';
} else {
    $_SESSION['usuario_erro'] = 'Não foi possível excluir o usuário.';
}
mysqli_stmt_close($stmt);
header('Location: lista_operadores.php');
exit;
