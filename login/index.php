<?php
require_once __DIR__ . '/../painel/config/seguranca.php';

$erro = $_SESSION['nao_autenticado'] ?? '';

if ($erro !== '') {
    unset($_SESSION['nao_autenticado']);
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login ADM</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Poppins',sans-serif;
        }

        body{
            min-height:100vh;
            display:flex;
            align-items:center;
            justify-content:center;
            background:linear-gradient(
                90deg,
                #c1274d 0%,
                #b11f67 35%,
                #9a1f88 70%,
                #7b1fa2 100%
            );
            padding:20px;
        }

        .container{
            width:100%;
            max-width:1000px;
            min-height:600px;
            display:flex;
            background:#fff;
            border-radius:20px;
            overflow:hidden;
            box-shadow:0 15px 40px rgba(0,0,0,.3);
        }

        .left{
            flex:1;
            background:linear-gradient(
                90deg,
                #c1274d,
                #b11f67,
                #9a1f88,
                #7b1fa2
            );
            color:#fff;
            padding:60px;
            display:flex;
            flex-direction:column;
            justify-content:center;
            position:relative;
        }

        .left:before,
        .left:after{
            content:'';
            position:absolute;
            background:rgba(255,255,255,.05);
            border-radius:50%;
        }

        .left:before{
            width:250px;
            height:250px;
            top:-60px;
            right:-60px;
        }

        .left:after{
            width:180px;
            height:180px;
            bottom:-50px;
            left:-50px;
        }

        .logo{
            font-size:60px;
            margin-bottom:20px;
            z-index:1;
        }

        .left h1{
            font-size:36px;
            margin-bottom:15px;
            z-index:1;
        }

        .right{
            flex:1;
            padding:60px 50px;
            display:flex;
            flex-direction:column;
            justify-content:center;
        }

        .form-title{
            font-size:32px;
            color:#b11f67;
            font-weight:700;
            margin-bottom:10px;
        }

        .subtitle{
            color:#666;
            margin-bottom:35px;
        }

        .input-group{
            margin-bottom:22px;
        }

        .input-group label{
            display:block;
            margin-bottom:8px;
            color:#333;
            font-size:14px;
            font-weight:500;
        }

        .input-wrapper{
            position:relative;
        }

        .input-wrapper i{
            position:absolute;
            left:16px;
            top:50%;
            transform:translateY(-50%);
            color:#aaa;
        }

        .input-wrapper input{
            width:100%;
            padding:14px 15px 14px 45px;
            border:1px solid #ddd;
            border-radius:10px;
            outline:none;
            font-size:14px;
        }

        .input-wrapper input:focus{
            border-color:#a21caf;
        }

        .btn{
            width:100%;
            border:0;
            padding:14px;
            border-radius:10px;
            color:#fff;
            font-weight:700;
            cursor:pointer;
            background:linear-gradient(90deg,#c1274d,#7b1fa2);
            transition:.2s;
        }

        .btn:hover{
            transform:translateY(-1px);
            box-shadow:0 8px 20px rgba(123,31,162,.25);
        }

        .alert{
            margin-top:10px;
            padding:10px;
            border-radius:8px;
            background:#ffe5e5;
            color:#b42318;
            font-size:13px;
        }

        .footer{
            margin-top:25px;
            text-align:center;
        }

        .footer a{
            color:#8b2cf5;
            text-decoration:none;
            font-size:13px;
        }

        @media(max-width:700px){

            .container{
                min-height:auto;
                flex-direction:column;
            }

            .left{
                padding:40px;
                min-height:220px;
            }

            .left h1{
                font-size:28px;
            }

            .right{
                padding:40px 30px;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <div class="left">

        <div class="logo">
            <i class="fa-solid fa-shield-halved"></i>
        </div>

        <h1>Painel Administrativo</h1>

    </div>

    <div class="right">

        <div class="form-title">
            Entrar
        </div>

        <div class="subtitle">
            Faça login para continuar
        </div>

        <?php if ($erro !== ''): ?>

            <div class="alert">
                <?= h($erro) ?>
            </div>

        <?php endif; ?>

        <form action="../autentica.php" method="POST">

            <input
                type="hidden"
                name="csrf_token"
                value="<?= h(csrf_token()) ?>"
            >

            <div class="input-group">

                <label for="email_operador">
                    E-mail
                </label>

                <div class="input-wrapper">

                    <i class="fa-solid fa-user"></i>

                    <input
                        name="email_operador"
                        type="email"
                        id="email_operador"
                        placeholder="Digite seu e-mail"
                        autocomplete="username"
                        required
                    >

                </div>

            </div>

            <div class="input-group">

                <label for="senha_operador">
                    Senha
                </label>

                <div class="input-wrapper">

                    <i class="fa-solid fa-lock"></i>

                    <input
                        name="senha_operador"
                        type="password"
                        id="senha_operador"
                        placeholder="Digite sua senha"
                        autocomplete="current-password"
                        required
                    >

                </div>

            </div>

            <button type="submit" class="btn">
                ENTRAR
            </button>

        </form>

        <div class="footer">
            <a href="../">
                ← Voltar
            </a>
        </div>

    </div>

</div>

</body>
</html>