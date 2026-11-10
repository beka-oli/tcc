<?php
require_once __DIR__ . '/verifica_login.php';
require_once __DIR__ . '/conexao.php';

mysqli_set_charset($conexao, 'utf8mb4');
require_once __DIR__ . '/controle_acesso.php';

// Quem pode abrir a tela de usuários:
// - Ultra Master e Master: gestão completa (com restrições visuais)
// - Operador: apenas consulta limitada (nome de Master/Ultra Master)
exigir_login();
$meuPerfil = perfil_usuario();
if (!in_array($meuPerfil, ['operador', 'master', 'ultra_master'], true)) {
    header('Location: sem_permissao.php');
    exit;
}

$busca  = trim($_GET['busca'] ?? '');
$perfil = $_GET['perfil'] ?? '';
$status = $_GET['status'] ?? '';

/**
 * Nível de visibilidade de um registro conforme quem está logado.
 * - full: vê todos os campos e pode gerenciar (se permitido)
 * - nome: vê apenas o nome (hierarquia superior)
 * - oculto: não lista o usuário
 */
function visibilidade_usuario(array $alvo): string
{
    $meu = perfil_usuario();
    $perfilAlvo = (string)($alvo['perfil'] ?? '');
    $meuId = (int)($_SESSION['usuario_id'] ?? 0);
    $alvoId = (int)($alvo['id'] ?? 0);

    // Próprio usuário: sempre vê os próprios dados
    if ($meuId > 0 && $meuId === $alvoId) {
        return 'full';
    }

    // Ultra Master vê tudo
    if ($meu === 'ultra_master') {
        return 'full';
    }

    // Master:
    // - operadores e outros masters: full
    // - ultra_master: somente o nome
    if ($meu === 'master') {
        if ($perfilAlvo === 'ultra_master') {
            return 'nome';
        }
        return 'full';
    }

    // Operador:
    // - master e ultra_master: somente o nome
    // - outros operadores: não lista
    if ($meu === 'operador') {
        if (in_array($perfilAlvo, ['master', 'ultra_master'], true)) {
            return 'nome';
        }
        return 'oculto';
    }

    return 'oculto';
}

$where = [];
$params = [];
$types = '';

if ($busca !== '') {
    // Operador só busca por nome (não por e-mail de superiores)
    if ($meuPerfil === 'operador') {
        $where[] = 'nome_operador LIKE ?';
        $params[] = '%' . $busca . '%';
        $types .= 's';
    } else {
        $where[] = '(nome_operador LIKE ? OR email_operador LIKE ?)';
        $like = '%' . $busca . '%';
        $params[] = $like;
        $params[] = $like;
        $types .= 'ss';
    }
}

if (in_array($perfil, ['operador', 'master', 'ultra_master'], true)) {
    // Operador só pode filtrar Master / Ultra Master
    if ($meuPerfil === 'operador' && $perfil === 'operador') {
        $perfil = '';
    } else {
        $where[] = 'perfil = ?';
        $params[] = $perfil;
        $types .= 's';
    }
}

// Operador: força listar só hierarquia superior
if ($meuPerfil === 'operador') {
    $where[] = "perfil IN ('master', 'ultra_master')";
}

if (in_array($status, ['Ativo', 'Inativo'], true) && $meuPerfil !== 'operador') {
    $where[] = 'status = ?';
    $params[] = $status;
    $types .= 's';
}

$sql = 'SELECT id, nome_operador, email_operador, perfil, status, data_cadastro FROM operadores';
if ($where) {
    $sql .= ' WHERE ' . implode(' AND ', $where);
}
$sql .= ' ORDER BY CASE perfil WHEN "ultra_master" THEN 1 WHEN "master" THEN 2 ELSE 3 END, nome_operador';

$stmt = mysqli_prepare($conexao, $sql);
if ($params) {
    mysqli_stmt_bind_param($stmt, $types, ...$params);
}
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$mensagem = $_SESSION['usuario_msg'] ?? '';
unset($_SESSION['usuario_msg']);
$erro = $_SESSION['usuario_erro'] ?? '';
unset($_SESSION['usuario_erro']);

$podeCriar = eh_admin(); // Master e Ultra Master
$rotulosPerfil = [
    'ultra_master' => 'Ultra Master',
    'master'       => 'Master',
    'operador'     => 'Operador',
];
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
<main class="usuarios-page">
<div class="usuarios-box">
    <div class="usuarios-top">
        <div>
            <h1><i class="fas fa-users-gear"></i> Usuários</h1>
            <p>
                <?php if ($meuPerfil === 'operador'): ?>
                    Consulte os responsáveis (Master e Ultra Master).
                <?php else: ?>
                    Gerencie operadores, Masters e Ultra Masters.
                <?php endif; ?>
            </p>
        </div>
        <?php if ($podeCriar): ?>
            <a class="btn-grad" href="form_operador.php"><i class="fas fa-user-plus"></i> Novo usuário</a>
        <?php endif; ?>
    </div>

    <?php if ($mensagem): ?><div class="alerta"><?= h($mensagem) ?></div><?php endif; ?>
    <?php if ($erro): ?><div class="alerta erro"><?= h($erro) ?></div><?php endif; ?>

    <form class="filtros" method="get">
        <input name="busca" value="<?= h($busca) ?>"
               placeholder="<?= $meuPerfil === 'operador' ? 'Nome' : 'Nome ou e-mail' ?>">

        <select name="perfil">
            <option value="">Todos os perfis</option>
            <?php
            $opcoesPerfil = $meuPerfil === 'operador'
                ? ['master' => 'Master', 'ultra_master' => 'Ultra Master']
                : ['operador' => 'Operador', 'master' => 'Master', 'ultra_master' => 'Ultra Master'];
            foreach ($opcoesPerfil as $v => $label):
            ?>
                <option value="<?= h($v) ?>" <?= $perfil === $v ? 'selected' : '' ?>><?= h($label) ?></option>
            <?php endforeach; ?>
        </select>

        <?php if ($meuPerfil !== 'operador'): ?>
            <select name="status">
                <option value="">Todos os status</option>
                <option value="Ativo" <?= $status === 'Ativo' ? 'selected' : '' ?>>Ativo</option>
                <option value="Inativo" <?= $status === 'Inativo' ? 'selected' : '' ?>>Inativo</option>
            </select>
        <?php endif; ?>

        <button type="submit"><i class="fas fa-search"></i> Filtrar</button>
    </form>

    <table class="tabela">
        <thead>
            <tr>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Perfil</th>
                <th>Status</th>
                <th>Cadastro</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $listouAlgum = false;
        while ($u = mysqli_fetch_assoc($result)):
            $vis = visibilidade_usuario($u);
            if ($vis === 'oculto') {
                continue;
            }
            $listouAlgum = true;
            $rotulo = $rotulosPerfil[$u['perfil']] ?? ucfirst((string)$u['perfil']);
        ?>
            <tr>
                <?php if ($vis === 'nome'): ?>
                    <!-- Hierarquia superior: só o nome -->
                    <td><strong><?= h($u['nome_operador']) ?></strong></td>
                    <td><span class="dado-restrito">—</span></td>
                    <td><span class="dado-restrito">—</span></td>
                    <td><span class="dado-restrito">—</span></td>
                    <td><span class="dado-restrito">—</span></td>
                    <td><span class="sem-permissao-inline">Sem permissão</span></td>
                <?php else: ?>
                    <td><?= h($u['nome_operador']) ?></td>
                    <td><?= h($u['email_operador']) ?></td>
                    <td>
                        <span class="badge <?= h($u['perfil']) ?>"><?= h($rotulo) ?></span>
                    </td>
                    <td>
                        <span class="badge <?= strtolower(h($u['status'])) ?>"><?= h($u['status']) ?></span>
                    </td>
                    <td><?= !empty($u['data_cadastro']) ? date('d/m/Y H:i', strtotime($u['data_cadastro'])) : '—' ?></td>
                    <td class="acoes">
                        <?php if (pode_gerenciar_usuario($u)): ?>
                            <a class="editar" href="editar_operador.php?id=<?= (int)$u['id'] ?>">
                                <i class="fas fa-pen"></i> Alterar
                            </a>
                            <?php if ((int)$u['id'] !== (int)($_SESSION['usuario_id'] ?? 0)): ?>
                                <form method="post" action="excluir_operador.php" class="form-inline"
                                      onsubmit="return confirm('Deseja realmente excluir este usuário?')">
                                    <input type="hidden" name="csrf_token" value="<?= h(csrf_token()) ?>">
                                    <input type="hidden" name="id" value="<?= (int)$u['id'] ?>">
                                    <button class="excluir" type="submit">
                                        <i class="fas fa-trash"></i> Excluir
                                    </button>
                                </form>
                            <?php endif; ?>
                        <?php else: ?>
                            <span class="sem-permissao-inline">Sem permissão</span>
                        <?php endif; ?>
                    </td>
                <?php endif; ?>
            </tr>
        <?php endwhile; ?>

        <?php if (!$listouAlgum): ?>
            <tr>
                <td colspan="6" class="vazio" style="text-align:center;padding:28px;color:#888;">
                    Nenhum usuário encontrado com os filtros atuais.
                </td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>
</main>
<style>
.dado-restrito { color: #b0a8b8; }
.sem-permissao-inline { color: #b0a8b8; font-size: .9rem; }
</style>
</body>
</html>
<?php
if (isset($stmt) && $stmt) {
    mysqli_stmt_close($stmt);
}
