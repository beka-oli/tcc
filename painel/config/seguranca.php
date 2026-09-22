<?php
require_once __DIR__ . '/config.php';

$secure = !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off';
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_set_cookie_params([
        'lifetime' => 0, 'path' => '/', 'secure' => $secure,
        'httponly' => true, 'samesite' => 'Strict'
    ]);
    session_start();
}

if (!isset($_SESSION['csrf'])) { $_SESSION['csrf'] = bin2hex(random_bytes(32)); }

function csrf_token(): string { return $_SESSION['csrf']; }
function csrf_check(?string $token): void {
    if (!$token || !hash_equals($_SESSION['csrf'] ?? '', $token)) {
        http_response_code(403); exit('Solicitação inválida.');
    }
}
function exigir_login(): void {
    if (empty($_SESSION['usuario_id']) || empty($_SESSION['usuario'])) {
        header('Location: ../login/index.php'); exit;
    }
    if (!empty($_SESSION['ultima_atividade']) && time() - $_SESSION['ultima_atividade'] > SESSION_TIMEOUT) {
        session_unset(); session_destroy(); header('Location: ../login/index.php?expirada=1'); exit;
    }
    $_SESSION['ultima_atividade'] = time();
}
function h($v): string { return htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8'); }
function post_string(string $key, int $max=5000): string {
    $v = trim((string)($_POST[$key] ?? ''));
    return mb_substr($v, 0, $max);
}
function post_int(string $key): int { return filter_input(INPUT_POST, $key, FILTER_VALIDATE_INT) ?: 0; }
