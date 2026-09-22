<?php
require_once __DIR__ . '/config.php';
mysqli_report(MYSQLI_REPORT_OFF);
$conexao = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ($conexao->connect_errno) {
    http_response_code(500);
    exit('Não foi possível conectar ao banco de dados.');
}
$conexao->set_charset('utf8mb4');
