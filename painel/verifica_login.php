<?php
declare(strict_types=1);
require_once __DIR__ . '/controle_acesso.php';
exigir_login();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !validar_csrf($_POST['csrf_token'] ?? null)) { http_response_code(403); exit('Solicitação inválida ou sessão expirada.'); }
