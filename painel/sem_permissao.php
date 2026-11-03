<?php
require_once __DIR__ . '/verifica_login.php';
require_once __DIR__ . '/controle_acesso.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sem permissão | Medeia</title>
    <?php include 'includes_painel/head.php'; ?>
    
</head>
<body>
<?php include 'includes_painel/header.php'; ?>
<main class="sem-permissao"><div class="sem-card">
    <div class="sem-icon"><i class="fas fa-lock"></i></div>
    <h1>Acesso não permitido</h1>
    <p>Seu perfil <strong><?= htmlspecialchars(perfil_usuario(), ENT_QUOTES, 'UTF-8') ?></strong> não possui permissão para acessar esta área.</p>
    <a href="dashboard.php"><i class="fas fa-house"></i> Voltar ao dashboard</a>
</div></main>
</body>
</html>
