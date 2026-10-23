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
    <style>
        .usuarios-page{padding:35px 5%;background:#f8f0fa;min-height:calc(100vh - 78px)}
        .usuarios-box{max-width:1250px;margin:auto;background:#fff;border-radius:20px;padding:28px;box-shadow:0 12px 35px #521b4714}
        .usuarios-top{display:flex;justify-content:space-between;align-items:center;gap:20px;margin-bottom:22px;flex-wrap:wrap}
        .usuarios-top h1{margin:0;color:#511538;font-size:28px}.usuarios-top p{margin:5px 0 0;color:#806d80}
        .btn-grad{display:inline-flex;align-items:center;gap:8px;background:linear-gradient(90deg,#b91c3c,#a21caf,#7c3aed);color:#fff;text-decoration:none;border:0;border-radius:12px;padding:11px 17px;font-weight:600}
        .filtros{display:grid;grid-template-columns:1fr 180px 160px auto;gap:10px;margin-bottom:20px}.filtros input,.filtros select{width:100%;padding:11px 13px;border:1px solid #eadfea;border-radius:10px;outline:none}.filtros button{border:0;border-radius:10px;padding:0 18px;background:#511538;color:#fff;font-weight:600}
        .tabela{width:100%;border-collapse:collapse}.tabela th{background:#faf3fa;color:#6b4162;font-size:12px;text-transform:uppercase;text-align:left;padding:13px}.tabela td{padding:14px 13px;border-top:1px solid #f1eaf1;color:#4c3949;font-size:14px}.acoes{display:flex;gap:7px;flex-wrap:wrap}.acao{padding:7px 10px;border-radius:8px;text-decoration:none;font-size:12px;font-weight:600}.editar{background:#f1eaff;color:#6d28d9}.excluir{background:#fff0f3;color:#b91c3c}.badge{display:inline-block;padding:6px 9px;border-radius:20px;font-size:11px;font-weight:700}.ultra{background:#eee7ff;color:#6d28d9}.master{background:#fff0d9;color:#9a5b00}.operador{background:#e9f8ef;color:#14743b}.ativo{background:#e9f8ef;color:#14743b}.inativo{background:#fff0f3;color:#b91c3c}.alerta{padding:12px 15px;border-radius:10px;margin-bottom:18px;background:#e9f8ef;color:#176b39}.erro{background:#fff0f3;color:#9b1735}
        @media(max-width:800px){.filtros{grid-template-columns:1fr}.tabela{display:block;overflow:auto;white-space:nowrap}}
    </style>

    <style>
        /* Identidade visual consistente das listagens Medeia (sem interferir no header). */
        body { background: #f5f6fa; color: #252238; font-family: Inter, "Segoe UI", Arial, sans-serif; }
        body > .container, .pagina, .usuarios-page { box-sizing: border-box; }
        body > .container, .container {
            width: min(100% - 40px, 1420px);
            max-width: 1420px;
            margin: 0 auto;
            padding: 34px 0 56px;
        }
        .pagina { width: min(100% - 40px, 1420px); margin: 0 auto; padding: 34px 0 56px; }
        .topo, .cabecalho { display: flex; align-items: center; justify-content: space-between; gap: 22px; margin-bottom: 28px; }
        .titulo, .titulo-area { display: flex; align-items: center; gap: 17px; }
        .titulo h1, .titulo-area h1 { color: #30213e; font-size: clamp(1.55rem, 2.5vw, 2rem); font-weight: 750; letter-spacing: -.035em; margin: 0 0 5px; }
        .titulo p, .titulo-area p { color: #777386; margin: 0; line-height: 1.5; }
        .icone, .icone-titulo { flex: 0 0 auto; box-shadow: 0 8px 20px rgba(139, 44, 245, .16); }
        .card, .usuarios-box { background: #fff; border: 1px solid #ece9f2; border-radius: 16px; box-shadow: 0 8px 28px rgba(38, 25, 58, .055); }
        .filtros, .card.filtros { padding: 22px; margin-bottom: 24px; }
        .campo label { display: block; margin-bottom: 7px; color: #4d465b; font-size: .86rem; font-weight: 650; }
        .campo input, .campo select, .campo textarea, input[type="text"], input[type="search"], input[type="email"], select {
            max-width: 100%; box-sizing: border-box; border: 1px solid #ded9e8; border-radius: 9px;
            background: #fff; color: #302b3b; padding: 11px 13px; min-height: 42px; outline: none;
            transition: border-color .18s ease, box-shadow .18s ease;
        }
        .campo input:focus, .campo select:focus, .campo textarea:focus, input:focus, select:focus {
            border-color: #9b45dc; box-shadow: 0 0 0 3px rgba(155, 69, 220, .12);
        }
        .estatisticas, .card.estatisticas { margin-bottom: 24px; }
        .card.tabela { overflow: hidden; padding: 0; }
        .table-responsive { width: 100%; overflow-x: auto; }
        table, .tabela { width: 100%; border-collapse: collapse; background: #fff; }
        table thead th, .tabela thead th {
            background: #faf8fc; color: #61576f; font-size: .76rem; font-weight: 750;
            letter-spacing: .045em; text-transform: uppercase; white-space: nowrap;
            padding: 15px 17px; border-bottom: 1px solid #ebe7f1;
        }
        table tbody td, .tabela tbody td { color: #514b5e; padding: 15px 17px; border-bottom: 1px solid #f0edf4; vertical-align: middle; }
        table tbody tr:hover, .tabela tbody tr:hover { background: #fcfaff; }
        table tbody tr:last-child td, .tabela tbody tr:last-child td { border-bottom: 0; }
        .btn, .btn-grad, .btn-buscar, .btn.buscar { border-radius: 9px; font-weight: 650; transition: transform .16s ease, box-shadow .16s ease; }
        .btn:hover, .btn-grad:hover, .btn-buscar:hover, .btn.buscar:hover { transform: translateY(-1px); }
        .acoes { display: flex; align-items: center; justify-content: center; gap: 8px; }
        .status, .badge { display: inline-flex; align-items: center; justify-content: center; border-radius: 999px; padding: 5px 10px; font-size: .78rem; font-weight: 700; white-space: nowrap; }
        .vazio { padding: 35px 18px; text-align: center; color: #81798d; }
        .rodape, .rodape-tabela { color: #81798d; font-size: .85rem; padding-top: 16px; }
        @media (max-width: 700px) {
            body > .container, .container, .pagina { width: min(100% - 24px, 1420px); padding-top: 22px; }
            .topo, .cabecalho { align-items: flex-start; flex-direction: column; }
            .filtros, .card.filtros { padding: 16px; }
            table thead th, table tbody td, .tabela thead th, .tabela tbody td { padding: 12px 13px; }
        }
    
        /* Padronização final das ações e responsividade das listagens Medeia. */
        .acoes {
            display: flex !important;
            align-items: center;
            justify-content: center;
            flex-wrap: nowrap;
            gap: 8px;
            white-space: nowrap;
            min-width: 150px;
        }
        .acoes form { display: inline-flex; margin: 0; padding: 0; }
        .acoes a, .acoes button, a.acao, button.acao {
            box-sizing: border-box;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            min-height: 38px;
            padding: 8px 11px;
            border-radius: 10px;
            font: inherit;
            font-size: 13px;
            font-weight: 650;
            line-height: 1.2;
            text-decoration: none;
            white-space: nowrap;
            cursor: pointer;
            background: #fff;
            transition: background-color .18s ease, box-shadow .18s ease, transform .18s ease;
        }
        .acoes a.editar, .acoes a.alterar, .acoes .editar, .acoes .alterar {
            color: #8427ed;
            border: 1px solid #a56aff;
        }
        .acoes a.editar:hover, .acoes a.alterar:hover, .acoes .editar:hover, .acoes .alterar:hover {
            background: #f7f0ff;
            box-shadow: 0 3px 9px rgba(132,39,237,.12);
        }
        .acoes a.excluir, .acoes button.excluir, .acoes .excluir {
            color: #df2851;
            border: 1px solid #ef829b;
        }
        .acoes a.excluir:hover, .acoes button.excluir:hover, .acoes .excluir:hover {
            background: #fff1f4;
            box-shadow: 0 3px 9px rgba(223,40,81,.10);
        }
        .acoes i, .acoes svg { flex: 0 0 auto; }
        .table-responsive { width: 100%; max-width: 100%; overflow-x: auto; -webkit-overflow-scrolling: touch; }
        .card.tabela, .usuarios-box { min-width: 0; }
        table th, table td { vertical-align: middle; }
        @media (max-width: 700px) {
            .topo, .cabecalho { align-items: flex-start; flex-direction: column; }
            .filtros, .card.filtros { padding: 16px; }
            table { min-width: 680px; }
        }
</style>
    
</head>
<body>
<?php include 'includes_painel/header.php'; ?>
<main class="usuarios-page"><div class="usuarios-box">
    <div class="usuarios-top">
        <div><h1><i class="fas fa-users-gear"></i> Usuários</h1><p>Gerencie operadores, Masters e Ultra Masters.</p></div>
        <a class="btn-grad" href="form_operador.php"><i class="fas fa-user-plus"></i> Novo usuário</a>
    </div>
    <?php if ($mensagem): ?><div class="alerta"><?= htmlspecialchars($mensagem, ENT_QUOTES, 'UTF-8') ?></div><?php endif; ?>
    <?php if ($erro): ?><div class="alerta erro"><?= htmlspecialchars($erro, ENT_QUOTES, 'UTF-8') ?></div><?php endif; ?>
    <form class="filtros" method="get">
        <input name="busca" value="<?= htmlspecialchars($busca, ENT_QUOTES, 'UTF-8') ?>" placeholder="Nome ou e-mail">
        <select name="perfil"><option value="">Todos os perfis</option><?php foreach(['operador'=>'Operador','master'=>'Master','ultra_master'=>'Ultra Master'] as $v=>$label): ?><option value="<?= $v ?>" <?= $perfil===$v?'selected':'' ?>><?= $label ?></option><?php endforeach; ?></select>
        <select name="status"><option value="">Todos os status</option><option value="Ativo" <?= $status==='Ativo'?'selected':'' ?>>Ativo</option><option value="Inativo" <?= $status==='Inativo'?'selected':'' ?>>Inativo</option></select>
        <button><i class="fas fa-search"></i> Filtrar</button>
    </form>
    <table class="tabela"><thead><tr><th>Nome</th><th>E-mail</th><th>Perfil</th><th>Status</th><th>Cadastro</th><th>Ações</th></tr></thead><tbody>
    <?php while ($u = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?= htmlspecialchars($u['nome_operador'], ENT_QUOTES, 'UTF-8') ?></td>
            <td><?= htmlspecialchars($u['email_operador'], ENT_QUOTES, 'UTF-8') ?></td>
            <td><span class="badge <?= $u['perfil'] ?>"><?= $u['perfil']==='ultra_master'?'Ultra Master':ucfirst($u['perfil']) ?></span></td>
            <td><span class="badge <?= strtolower($u['status']) ?>"><?= htmlspecialchars($u['status'], ENT_QUOTES, 'UTF-8') ?></span></td>
            <td><?= date('d/m/Y H:i', strtotime($u['data_cadastro'])) ?></td>
            <td class="acoes">
                <?php if (pode_gerenciar_usuario($u)): ?>
                    <a class="acao editar" href="editar_operador.php?id=<?= (int)$u['id'] ?>"><i class="fas fa-pen"></i> Alterar</a>
                    <?php if ((int)$u['id'] !== (int)($_SESSION['usuario_id'] ?? 0)): ?><form method="post" action="excluir_operador.php" style="display:inline" onsubmit="return confirm('Deseja realmente excluir este usuário?')"><input type="hidden" name="csrf_token" value="<?=h(csrf_token())?>"><input type="hidden" name="id" value="<?= (int)$u['id'] ?>"><button class="acao excluir" type="submit"><i class="fas fa-trash"></i> Excluir</button></form><?php endif; ?>
                <?php else: ?><span style="color:#9b8998;font-size:12px">Sem permissão</span><?php endif; ?>
            </td>
        </tr>
    <?php endwhile; ?>
    </tbody></table>
</div></main>
</body>
</html>
<?php mysqli_stmt_close($stmt); ?>
