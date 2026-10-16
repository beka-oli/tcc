<?php
declare(strict_types=1);

require_once __DIR__ . '/config/config.php';

mysqli_report(MYSQLI_REPORT_OFF);
$conexao = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if (!$conexao) {
    http_response_code(500);
    exit('Não foi possível conectar ao banco de dados.');
}
mysqli_set_charset($conexao, 'utf8mb4');
