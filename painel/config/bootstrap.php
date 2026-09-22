<?php
require_once __DIR__ . '/seguranca.php';
require_once __DIR__ . '/conexao.php';
exigir_login();
header('X-Frame-Options: SAMEORIGIN');
header('X-Content-Type-Options: nosniff');
header('Referrer-Policy: same-origin');
header('Permissions-Policy: geolocation=(), microphone=(), camera=()');
