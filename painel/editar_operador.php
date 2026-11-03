<?php
    require_once __DIR__ . '/verifica_login.php';
    require_once __DIR__ . '/conexao.php';
    require_once __DIR__ . '/controle_acesso.php';

    exigir_perfil(['master', 'ultra_master']);

    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    if (!$id || $id < 1) die('ID inválido.');

    $stmt = mysqli_prepare($conexao, 'SELECT id,nome_operador,email_operador,senha_operador,perfil,status FROM operadores WHERE id = ? LIMIT 1');
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $usuario = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
    mysqli_stmt_close($stmt);

    if (!$usuario) die('Usuário não encontrado.');
    if (!pode_gerenciar_usuario($usuario)) { header('Location: sem_permissao.php'); exit; }

    $erro = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!validar_csrf($_POST['csrf_token'] ?? null)) {
            $erro = 'Sessão de segurança expirada. Atualize a página e tente novamente.';
        } else {
            $nome = trim($_POST['nome_operador'] ?? '');
            $email = trim($_POST['email_operador'] ?? '');
            $perfilNovo = $_POST['perfil'] ?? $usuario['perfil'];
            $statusNovo = $_POST['status'] ?? $usuario['status'];
            $senhaNova = (string)($_POST['senha_operador'] ?? '');

            if (eh_master() && $usuario['perfil'] !== 'operador') $erro = 'O Master não pode alterar este usuário.';
            elseif (eh_master() && $perfilNovo !== 'operador') $erro = 'O Master só pode manter usuários como Operador.';
            elseif ($id === (int)($_SESSION['usuario_id'] ?? 0) && $statusNovo !== 'Ativo') $erro = 'Você não pode desativar o próprio usuário.';
            elseif (!in_array($perfilNovo, ['operador','master','ultra_master'], true)) $erro = 'Perfil inválido.';
            elseif (!in_array($statusNovo, ['Ativo','Inativo'], true)) $erro = 'Status inválido.';
            elseif ($nome === '' || mb_strlen($nome) < 3) $erro = 'Informe o nome completo.';
            elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) $erro = 'Informe um e-mail válido.';
            else {
                $stmt = mysqli_prepare($conexao, 'SELECT id FROM operadores WHERE email_operador = ? AND id <> ? LIMIT 1');
                mysqli_stmt_bind_param($stmt, 'si', $email, $id);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
                $existe = mysqli_stmt_num_rows($stmt) > 0;
                mysqli_stmt_close($stmt);

                if ($existe) $erro = 'Já existe outro usuário com este e-mail.';
                else {
                    if ($senhaNova !== '' && strlen($senhaNova) < 6) {
                        $erro = 'A nova senha deve ter pelo menos 6 caracteres.';
                    } elseif ($senhaNova !== '') {
                        $hash = password_hash($senhaNova, PASSWORD_DEFAULT);
                        $stmt = mysqli_prepare($conexao, 'UPDATE operadores SET nome_operador=?, email_operador=?, senha_operador=?, perfil=?, status=? WHERE id=?');
                        mysqli_stmt_bind_param($stmt, 'sssssi', $nome, $email, $hash, $perfilNovo, $statusNovo, $id);
                    } else {
                        $stmt = mysqli_prepare($conexao, 'UPDATE operadores SET nome_operador=?, email_operador=?, perfil=?, status=? WHERE id=?');
                        mysqli_stmt_bind_param($stmt, 'ssssi', $nome, $email, $perfilNovo, $statusNovo, $id);
                    }

                    if (!$erro && mysqli_stmt_execute($stmt)) {
                        mysqli_stmt_close($stmt);
                        if ($id === (int)($_SESSION['usuario_id'] ?? 0)) {
                            $_SESSION['usuario_nome'] = $nome;
                            $_SESSION['usuario_email'] = $email;
                            $_SESSION['usuario'] = $email;
                            $_SESSION['usuario_perfil'] = $perfilNovo;
                            $_SESSION['usuario_status'] = $statusNovo;
                        }
                        $_SESSION['usuario_msg'] = 'Usuário alterado com sucesso.';
                        header('Location: lista_operadores.php');
                        exit;
                    }
                    if (!$erro) $erro = 'Não foi possível alterar o usuário.';
                    mysqli_stmt_close($stmt);
                }
            }

            $usuario['nome_operador'] = $nome ?? $usuario['nome_operador'];
            $usuario['email_operador'] = $email ?? $usuario['email_operador'];
            $usuario['perfil'] = $perfilNovo ?? $usuario['perfil'];
            $usuario['status'] = $statusNovo ?? $usuario['status'];
        }
    }
?>
<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>Alterar usuário | Medeia</title>
        <?php include 'includes_painel/head.php'; ?>
    </head>
    <body>
        <?php include 'includes_painel/header.php'; ?>
        <main class="usuario-form-page">
            <section class="usuario-card"><h1>
                <i class="fas fa-user-pen"></i> Alterar usuário</h1>
                <p>Atualize os dados e, se quiser, informe uma nova senha.</p>
                <?php if ($erro): ?>
                <div class="erro">
                    <?= h($erro) ?>
                </div>
                <?php endif; ?>
                <form method="post">
                    <input type="hidden" name="csrf_token" value="<?=h(csrf_token())?>">
                    <input type="hidden" name="csrf_token" value="<?= h(csrf_token()) ?>"><div class="grid">
                    <div class="campo full">
                        <label>Nome completo</label>
                        <input name="nome_operador" value="<?= h($usuario['nome_operador']) ?>" required>
                    </div>
                    <div class="campo">
                        <label>E-mail</label>
                        <input type="email" name="email_operador" value="<?= h($usuario['email_operador']) ?>" required>
                    </div>
                    <div class="campo">
                        <label>Nova senha</label>
                        <input type="password" name="senha_operador" minlength="6">
                        <div class="info">Deixe em branco para manter a senha atual.</div>
                    </div>
                    <div class="campo">
                        <label>Perfil</label>
                        <select name="perfil" <?= eh_master()?'disabled':'' ?>>
                            <option value="operador" <?= $usuario['perfil']==='operador'?'selected':'' ?>>Operador</option>
                            <?php if (eh_ultra_master()): ?>
                                <option value="master" <?= $usuario['perfil']==='master'?'selected':'' ?>>Master</option>
                                <option value="ultra_master" <?= $usuario['perfil']==='ultra_master'?'selected':'' ?>>Ultra Master</option>
                            <?php endif; ?>
                        </select>
                        <?php if (eh_master()): ?>
                            <input type="hidden" name="perfil" value="operador">
                        <?php endif; ?>
                    </div>
                    <div class="campo">
                        <label>Status</label>
                        <select name="status">
                            <option value="Ativo" <?= $usuario['status']==='Ativo'?'selected':'' ?>>Ativo</option>
                            <option value="Inativo" <?= $usuario['status']==='Inativo'?'selected':'' ?>>Inativo</option>
                        </select>
                    </div>
                    </div>
                    <div class="acoes">
                        <a class="btn cancelar" href="lista_operadores.php">Cancelar</a>
                        <button class="btn salvar" type="submit">
                            <i class="fas fa-save"></i> 
                            Salvar alterações
                        </button>
                    </div>
                </form>
            </section>
        </main>
    </body>
</html>
