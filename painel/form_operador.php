<?php
require_once __DIR__ . '/verifica_login.php';
require_once __DIR__ . '/conexao.php';
require_once __DIR__ . '/controle_acesso.php';

exigir_perfil(['master', 'ultra_master']);

$erro = '';
$nome = '';
$email = '';
$perfil = 'operador';
$status = 'Ativo';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!validar_csrf($_POST['csrf_token'] ?? null)) {
        $erro = 'Sessão de segurança expirada. Atualize a página e tente novamente.';
    } else {
        $nome = trim($_POST['nome_operador'] ?? '');
        $email = trim($_POST['email_operador'] ?? '');
        $senha = (string)($_POST['senha_operador'] ?? '');
        $perfil = $_POST['perfil'] ?? 'operador';
        $status = $_POST['status'] ?? 'Ativo';

        // Master pode criar apenas operadores. Ultra Master pode criar qualquer perfil.
        if (eh_master() && $perfil !== 'operador') {
            $erro = 'O perfil Master só pode cadastrar usuários Operadores.';
        } elseif (!in_array($perfil, ['operador','master','ultra_master'], true)) {
            $erro = 'Perfil inválido.';
        } elseif (!in_array($status, ['Ativo','Inativo'], true)) {
            $erro = 'Status inválido.';
        } elseif ($nome === '' || mb_strlen($nome) < 3) {
            $erro = 'Informe o nome completo.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $erro = 'Informe um e-mail válido.';
        } elseif (strlen($senha) < 6) {
            $erro = 'A senha deve ter pelo menos 6 caracteres.';
        } else {
            $stmt = mysqli_prepare($conexao, 'SELECT id FROM operadores WHERE email_operador = ? LIMIT 1');
            mysqli_stmt_bind_param($stmt, 's', $email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $existe = mysqli_stmt_num_rows($stmt) > 0;
            mysqli_stmt_close($stmt);

            if ($existe) {
                $erro = 'Já existe um usuário com este e-mail.';
            } else {
                $hash = password_hash($senha, PASSWORD_DEFAULT);
                $stmt = mysqli_prepare($conexao, 'INSERT INTO operadores (nome_operador,email_operador,senha_operador,perfil,status) VALUES (?,?,?,?,?)');
                mysqli_stmt_bind_param($stmt, 'sssss', $nome, $email, $hash, $perfil, $status);

                if (mysqli_stmt_execute($stmt)) {
                    mysqli_stmt_close($stmt);
                    $_SESSION['usuario_msg'] = 'Usuário cadastrado com sucesso.';
                    header('Location: lista_operadores.php');
                    exit;
                }
                $erro = 'Não foi possível cadastrar o usuário.';
                mysqli_stmt_close($stmt);
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Novo usuário | Medeia</title>
<?php include 'includes_painel/head.php'; ?>
<style>
.usuario-form-page{min-height:calc(100vh - 78px);background:#f8f0fa;padding:40px 20px}.usuario-card{max-width:760px;margin:auto;background:#fff;padding:32px;border-radius:22px;box-shadow:0 15px 40px #521b4714}.usuario-card h1{margin:0;color:#511538}.usuario-card p{color:#806d80}.grid{display:grid;grid-template-columns:1fr 1fr;gap:18px}.campo label{display:block;font-size:13px;font-weight:600;color:#533d50;margin-bottom:7px}.campo input,.campo select{width:100%;padding:12px;border:1px solid #e8dfea;border-radius:10px}.full{grid-column:1/-1}.acoes{display:flex;justify-content:flex-end;gap:10px;margin-top:25px}.btn{border:0;border-radius:11px;padding:12px 18px;text-decoration:none;font-weight:600}.salvar{background:linear-gradient(90deg,#b91c3c,#a21caf,#7c3aed);color:#fff}.cancelar{background:#f4edf4;color:#633653}.erro{padding:12px;border-radius:10px;background:#fff0f3;color:#9b1735;margin-bottom:18px}@media(max-width:650px){.grid{grid-template-columns:1fr}.full{grid-column:auto}}
</style></head>
<body>
<?php include 'includes_painel/header.php'; ?>
<main class="usuario-form-page"><section class="usuario-card">
<h1><i class="fas fa-user-plus"></i> Novo usuário</h1><p>Cadastre um acesso ao painel Medeia.</p>
<?php if ($erro): ?><div class="erro"><?= htmlspecialchars($erro, ENT_QUOTES, 'UTF-8') ?></div><?php endif; ?>
<form method="post"><input type="hidden" name="csrf_token" value="<?=h(csrf_token())?>">
<input type="hidden" name="csrf_token" value="<?= htmlspecialchars(csrf_token(), ENT_QUOTES, 'UTF-8') ?>">
<div class="grid">
<div class="campo full"><label>Nome completo</label><input name="nome_operador" value="<?= htmlspecialchars($nome, ENT_QUOTES, 'UTF-8') ?>" required></div>
<div class="campo"><label>E-mail</label><input type="email" name="email_operador" value="<?= htmlspecialchars($email, ENT_QUOTES, 'UTF-8') ?>" required></div>
<div class="campo"><label>Senha</label><input type="password" name="senha_operador" minlength="6" required></div>
<div class="campo"><label>Perfil</label><select name="perfil" <?= eh_master()?'disabled':'' ?>>
<option value="operador" <?= $perfil==='operador'?'selected':'' ?>>Operador</option>
<?php if (eh_ultra_master()): ?><option value="master" <?= $perfil==='master'?'selected':'' ?>>Master</option><option value="ultra_master" <?= $perfil==='ultra_master'?'selected':'' ?>>Ultra Master</option><?php endif; ?>
</select><?php if (eh_master()): ?><input type="hidden" name="perfil" value="operador"><?php endif; ?></div>
<div class="campo"><label>Status</label><select name="status"><option value="Ativo" <?= $status==='Ativo'?'selected':'' ?>>Ativo</option><option value="Inativo" <?= $status==='Inativo'?'selected':'' ?>>Inativo</option></select></div>
</div>
<div class="acoes"><a class="btn cancelar" href="lista_operadores.php">Cancelar</a><button class="btn salvar" type="submit"><i class="fas fa-save"></i> Salvar usuário</button></div>
</form></section></main>
</body></html>
