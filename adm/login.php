<?php
session_start();

// Usuário fixo (exemplo simples)
$usuario_correto = "admin";
$senha_correta = "1234";

$erro = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $usuario = $_POST["usuario"];
  $senha = $_POST["senha"];

  if ($usuario === $usuario_correto && $senha === $senha_correta) {
    $_SESSION["usuario"] = $usuario;
    header("Location: dashboard.php");
    exit();
  } else {
    $erro = "Usuário ou senha inválidos";
  }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Login - Editora</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css_adm/login.css">
</head>

<body>

<div class="login-container">
  <div class="card shadow p-4">
    <h3 class="text-center mb-3"> Login Editora</h3>

    <?php if ($erro): ?>
      <div class="alert alert-danger"><?php echo $erro; ?></div>
    <?php endif; ?>

    <form method="POST">
      <div class="mb-3">
        <label class="form-label">Usuário</label>
        <input type="text" name="usuario" class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Senha</label>
        <input type="password" name="senha" class="form-control" required>
      </div>

      <button style="background-color: purple; color: white;">Entrar</button>
    </form>
  </div>
</div>

</body>
</html>


