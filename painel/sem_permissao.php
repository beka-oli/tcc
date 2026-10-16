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
    <style>
        .sem-permissao{min-height:calc(100vh - 78px);display:flex;align-items:center;justify-content:center;padding:30px;background:#f8f0fa}
        .sem-card{max-width:560px;width:100%;background:#fff;padding:45px;border-radius:22px;text-align:center;box-shadow:0 15px 40px #521b4718}
        .sem-icon{width:72px;height:72px;margin:0 auto 20px;border-radius:50%;display:flex;align-items:center;justify-content:center;background:#fff0f3;color:#b91c3c;font-size:30px}
        .sem-card h1{font-size:28px;color:#511538;margin-bottom:10px}.sem-card p{color:#765f78;line-height:1.6}
        .sem-card a{display:inline-block;margin-top:20px;padding:11px 20px;border-radius:12px;color:#fff;text-decoration:none;background:linear-gradient(90deg,#b91c3c,#a21caf,#7c3aed);font-weight:600}
    </style>
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
