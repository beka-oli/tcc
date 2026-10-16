<?php

require_once __DIR__ . '/painel/conexao.php';
require_once __DIR__ . '/painel/controle_acesso.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: login/index.php');
    exit;
}

/* =========================
   VERIFICA CSRF
========================= */

$csrf = isset($_POST['csrf_token'])
    ? $_POST['csrf_token']
    : null;

if (!validar_csrf($csrf)) {

    $_SESSION['nao_autenticado'] =
        'Sessão de segurança expirada. Tente novamente.';

    header('Location: login/index.php');
    exit;
}


/* =========================
   RECEBE DADOS
========================= */

$email = isset($_POST['email_operador'])
    ? trim($_POST['email_operador'])
    : '';

$senha = isset($_POST['senha_operador'])
    ? $_POST['senha_operador']
    : '';


if (!filter_var($email, FILTER_VALIDATE_EMAIL) || $senha === '') {

    $_SESSION['nao_autenticado'] =
        'Informe e-mail e senha.';

    header('Location: login/index.php');
    exit;
}


/* =========================
   BUSCA USUÁRIO
========================= */

$sql = "
    SELECT
        id,
        nome_operador,
        email_operador,
        senha_operador,
        perfil,
        status
    FROM operadores
    WHERE email_operador = ?
    LIMIT 1
";

$stmt = mysqli_prepare($conexao, $sql);

if (!$stmt) {

    $_SESSION['nao_autenticado'] =
        'Erro ao preparar o login.';

    header('Location: login/index.php');
    exit;
}

mysqli_stmt_bind_param($stmt, 's', $email);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

$usuario = mysqli_fetch_assoc($result);

mysqli_stmt_close($stmt);


/* =========================
   VERIFICA LOGIN
========================= */

$valido = false;

if ($usuario && ($usuario['status'] === 'Ativo')) {

    $armazenada = (string)$usuario['senha_operador'];


    /*
     * PRIMEIRO:
     * tenta senha criptografada
     */
    if (password_verify($senha, $armazenada)) {

        $valido = true;

    } else {

        /*
         * COMPATIBILIDADE COM SENHAS ANTIGAS
         *
         * PHP 7.2 não possui str_starts_with().
         * Por isso usamos strpos().
         */

        $ehHashBcrypt =
            (strpos($armazenada, '$2y$') === 0);

        $ehHashArgon =
            (strpos($armazenada, '$argon2') === 0);


        /*
         * Se não for uma senha criptografada,
         * verifica a senha antiga em texto.
         */

        if (!$ehHashBcrypt && !$ehHashArgon) {

            if (hash_equals($armazenada, $senha)) {

                $valido = true;


                /*
                 * Converte automaticamente a senha
                 * antiga para hash seguro.
                 */

                $novoHash = password_hash(
                    $senha,
                    PASSWORD_DEFAULT
                );

                $up = mysqli_prepare(
                    $conexao,
                    'UPDATE operadores
                     SET senha_operador = ?
                     WHERE id = ?'
                );

                if ($up) {

                    mysqli_stmt_bind_param(
                        $up,
                        'si',
                        $novoHash,
                        $usuario['id']
                    );

                    mysqli_stmt_execute($up);

                    mysqli_stmt_close($up);
                }
            }
        }
    }
}


/* =========================
   LOGIN INVÁLIDO
========================= */

if (!$valido) {

    $_SESSION['nao_autenticado'] =
        'E-mail ou senha inválidos, ou usuário inativo.';

    header('Location: login/index.php');
    exit;
}


/* =========================
   CRIA SESSÃO
========================= */

session_regenerate_id(true);

$_SESSION['usuario_id'] =
    (int)$usuario['id'];

$_SESSION['usuario'] =
    $usuario['email_operador'];

$_SESSION['usuario_nome'] =
    $usuario['nome_operador'];

$_SESSION['usuario_email'] =
    $usuario['email_operador'];

$_SESSION['usuario_perfil'] =
    !empty($usuario['perfil'])
        ? $usuario['perfil']
        : 'operador';

$_SESSION['usuario_status'] =
    $usuario['status'];

$_SESSION['ultima_atividade'] =
    time();


/* =========================
   NOVO TOKEN CSRF
========================= */

$_SESSION['csrf_token'] =
    bin2hex(random_bytes(32));


/* =========================
   ENTRA NO PAINEL
========================= */

header('Location: painel/dashboard.php');
exit;