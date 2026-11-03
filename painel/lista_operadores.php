<?php
require_once __DIR__ . '/verifica_login.php';
require_once __DIR__ . '/conexao.php';

// Garante a comunicação com o MySQL em UTF-8 completo.
mysqli_set_charset($conexao, 'utf8mb4');
require_once __DIR__ . '/controle_acesso.php';

exigir_perfil(['master', 'ultra_master']);

$busca = trim($_GET['busca'] ?? '');
$perfil = $_GET['perfil'] ?? '';
$status = $_GET['status'] ?? '';

$where = [];
$params = [];
$types = ''; 

if ($busca !== '') {
    $where[] = '(nome_operador LIKE ? OR email_operador LIKE ?)';
    $like = '%' . $busca . '%';
    $params[] = $like; $params[] = $like; $types .= 'ss';
}

if (in_array($perfil, ['operador','master','ultra_master'], true)) {
    $where[] = 'perfil = ?'; $params[] = $perfil; $types .= 's';
}

if (in_array($status, ['Ativo','Inativo'], true)) {
    $where[] = 'status = ?'; $params[] = $status; $types .= 's';
}

$sql = 'SELECT id,nome_operador,email_operador,perfil,status,data_cadastro FROM operadores';
if ($where) $sql .= ' WHERE ' . implode(' AND ', $where);
$sql .= ' ORDER BY CASE perfil WHEN "ultra_master" THEN 1 WHEN "master" THEN 2 ELSE 3 END, nome_operador';

$stmt = mysqli_prepare($conexao, $sql);
if ($params) mysqli_stmt_bind_param($stmt, $types, ...$params);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$mensagem = $_SESSION['usuario_msg'] ?? '';
unset($_SESSION['usuario_msg']);
$erro = $_SESSION['usuario_erro'] ?? '';
unset($_SESSION['usuario_erro']);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuários | Medeia</title>
    <?php include 'includes_painel/head.php'; ?>
    

    
    
</head>
<body>
<?php include 'includes_painel/header.php'; ?>
<main class="usuarios-page"><div class="usuarios-box">
    <div class="usuarios-top">
        <div><h1><i class="fas fa-users-gear"></i> Usuários</h1><p>Gerencie operadores, Masters e Ultra Masters.</p></div>
        <a class="btn-grad" href="form_operador.php"><i class="fas fa-user-plus"></i> Novo usuário</a>
    </div>
    <?php if ($mensagem): ?><div class="alerta"><?= h($mensagem) ?></div><?php endif; ?>
    <?php if ($erro): ?><div class="alerta erro"><?= h($erro) ?></div><?php endif; ?>
    <form class="filtros" method="get">
        <input name="busca" value="<?= h($busca) ?>" placeholder="Nome ou e-mail">
        <select name="perfil"><option value="">Todos os perfis</option><?php foreach(['operador'=>'Operador','master'=>'Master','ultra_master'=>'Ultra Master'] as $v=>$label): ?><option value="<?= $v ?>" <?= $perfil===$v?'selected':'' ?>><?= $label ?></option><?php endforeach; ?></select>
        <select name="status"><option value="">Todos os status</option><option value="Ativo" <?= $status==='Ativo'?'selected':'' ?>>Ativo</option><option value="Inativo" <?= $status==='Inativo'?'selected':'' ?>>Inativo</option></select>
        <button><i class="fas fa-search"></i> Filtrar</button>
    </form>
    <table class="tabela"><thead><tr><th>Nome</th><th>E-mail</th><th>Perfil</th><th>Status</th><th>Cadastro</th><th>Ações</th></tr></thead><tbody>
    <?php while ($u = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?= h($u['nome_operador']) ?></td>
            <td><?= h($u['email_operador']) ?></td>
            <td><span class="badge <?= $u['perfil'] ?>"><?= $u['perfil']==='ultra_master'?'Ultra Master':ucfirst($u['perfil']) ?></span></td>
            <td><span class="badge <?= strtolower($u['status']) ?>"><?= h($u['status']) ?></span></td>
            <td><?= date('d/m/Y H:i', strtotime($u['data_cadastro'])) ?></td>
            <td class="acoes">
                <?php if (pode_gerenciar_usuario($u)): ?>
                    <a class="acao editar" href="editar_operador.php?id=<?= (int)$u['id'] ?>"><i class="fas fa-pen"></i> Alterar</a>
                    <?php if ((int)$u['id'] !== (int)($_SESSION['usuario_id'] ?? 0)): ?><form method="post" action="excluir_operador.php" class="form-inline" onsubmit="return confirm('Deseja realmente excluir este usuário?')"><input type="hidden" name="csrf_token" value="<?=h(csrf_token())?>"><input type="hidden" name="id" value="<?= (int)$u['id'] ?>"><button class="acao excluir" type="submit"><i class="fas fa-trash"></i> Excluir</button></form><?php endif; ?>
                <?php else: ?><span class="sem-permissao-inline">Sem permissão</span><?php endif; ?>
            </td>
        </tr>
    <?php endwhile; ?>
    </tbody></table>
</div></main>
</body>
</html>
<?php mysqli_stmt_close($stmt); ?>
