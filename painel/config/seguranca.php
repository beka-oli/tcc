<?php
declare(strict_types=1);

require_once __DIR__ . '/config.php';

/* Sessão exclusiva do Medeia para não misturar dados de versões antigas. */
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_name('MEDEIA_SESS');

    $secure = !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off';

    /* Forma compatível com versões antigas e novas do PHP/XAMPP. */
    session_set_cookie_params(
        0,
        '/',
        '',
        $secure,
        true
    );

    session_start();
}

/* Corrige sessões antigas/corrompidas onde o CSRF foi salvo como array. */
if (!isset($_SESSION['csrf_token']) || !is_string($_SESSION['csrf_token']) || strlen($_SESSION['csrf_token']) !== 64) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

function csrf_token(): string
{
    if (!isset($_SESSION['csrf_token']) || !is_string($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }

    return $_SESSION['csrf_token'];
}

function validar_csrf(?string $token): bool
{
    $csrf = $_SESSION['csrf_token'] ?? '';

    return is_string($csrf)
        && is_string($token)
        && $token !== ''
        && hash_equals($csrf, $token);
}

function verify_csrf(): void
{
    if (!validar_csrf($_POST['csrf_token'] ?? null)) {
        http_response_code(403);
        exit('Solicitação inválida ou sessão expirada.');
    }
}

function exigir_login(): void
{
    if (empty($_SESSION['usuario_id']) || empty($_SESSION['usuario_perfil'])) {
        header('Location: ../login/index.php');
        exit;
    }

    if (
        !empty($_SESSION['ultima_atividade']) &&
        time() - (int)$_SESSION['ultima_atividade'] > SESSION_TIMEOUT
    ) {
        $_SESSION = [];

        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params['path'] ?? '/',
                $params['domain'] ?? '',
                (bool)($params['secure'] ?? false),
                (bool)($params['httponly'] ?? true)
            );
        }

        session_destroy();
        header('Location: ../login/index.php?expirada=1');
        exit;
    }

    $_SESSION['ultima_atividade'] = time();
}

if (!function_exists('h')) {
    function h($v): string
    {
        return htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8');
    }
}
