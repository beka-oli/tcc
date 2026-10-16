<?php
declare(strict_types=1);

require_once __DIR__ . '/config/seguranca.php';

function usuario_logado(): bool { return !empty($_SESSION['usuario_id']) && !empty($_SESSION['usuario_perfil']); }
function perfil_usuario(): string { return (string)($_SESSION['usuario_perfil'] ?? ''); }
function nome_usuario(): string { return (string)($_SESSION['usuario_nome'] ?? $_SESSION['usuario'] ?? 'Usuário'); }
function eh_ultra_master(): bool { return perfil_usuario() === 'ultra_master'; }
function eh_master(): bool { return perfil_usuario() === 'master'; }
function eh_admin(): bool { return in_array(perfil_usuario(), ['master','ultra_master'], true); }
function exigir_perfil(array $perfis): void {
    exigir_login();
    if (!in_array(perfil_usuario(), $perfis, true)) { header('Location: sem_permissao.php'); exit; }
}
function exigir_modulo(string $modulo): void {
    exigir_login();
    // Operador e acima podem trabalhar com conteúdo. Gestão de usuários é exclusiva dos Masters.
    if ($modulo === 'usuarios' && !eh_admin()) { header('Location: sem_permissao.php'); exit; }
}
function pode_gerenciar_usuario(array $usuario): bool {
    $alvo = (string)($usuario['perfil'] ?? '');
    $atual = perfil_usuario();
    if ($atual === 'ultra_master') return true;
    if ((int)($usuario['id'] ?? 0) === (int)($_SESSION['usuario_id'] ?? 0)) return true;
    return $atual === 'master' && $alvo === 'operador';
}
