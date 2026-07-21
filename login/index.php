<?php
session_start();
$erro = isset($_SESSION['nao_autenticado']) && $_SESSION['nao_autenticado'] === true;
if ($erro) {
    unset($_SESSION['nao_autenticado']);
}
?>
<!DOCTYPE html>w
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <title>Login ADM</title>
        <!-- Fonte -->
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
    </head>
    <body>
        <div class="container">
            <!-- LADO ESQUERDO -->
            <div class="left">
                <div class="logo">
                    <i class="fa-solid fa-shield-halved"></i>
                </div>
                <h1>Painel Administrativo</h1>
            </div>
            <!-- LADO DIREITO -->
            <div class="right">
                <div class="form-title"> Entrar</div>
                <div class="subtitle"> Faça login para continuar</div>
                <form class="login100-form validate-form" action="../autentica.php" method="POST">
                    <!-- Usuário -->
                    <div class="input-group">
                        <label for="email_operador"> E-mail</label>
                        <div class="input-wrapper">
                            <i class="fa-solid fa-user"></i>
                            <input
                                name="email_operador"
                                type="text"
                                id="usuario"
                                placeholder="Digite seu usuário"
                                required
                            >
                        </div>
                    </div>
                    <!-- Senha -->
                    <div class="input-group">
                        <label for="senha"> Senha</label>
                        <div class="input-wrapper">
                            <i class="fa-solid fa-lock"></i>
                            <input
                                name="senha_operador"
                                type="password"
                                id="senha"
                                placeholder="Digite sua senha"
                                required
                            >
                        </div>
                        <?php if ($erro): ?>
                        <div class="alert alert-danger text-center" role="alert" style="width:100%; margin-bottom:1rem;">
                            Usuário ou senha inválidos. Verifique e tente novamente.
                        </div>
                    <?php endif; ?>
                    </div>
                    <button type="submit" class="btn">ENTRAR</button>
                    <div id="message" class="message"></div>
                </form>
                <div class="footer">
                    <a href="../"> ← Voltar</a>
                </div>
            </div>
        </div>
        <!-- SCRIPT FUNCIONAL -->
        <script>

            const form = document.getElementById('loginForm');
            const message = document.getElementById('message');

            form.addEventListener('submit', function(e){

                e.preventDefault();

                const usuario = document.getElementById('usuario').value.trim();
                const senha = document.getElementById('senha').value.trim();

                // Validação simples
                if(usuario === '' || senha === ''){

                    message.style.display = 'block';
                    message.className = 'message error';
                    message.innerHTML = 'Preencha todos os campos.';

                    return;
                }

                // Simulação login
                if(usuario === 'admin' && senha === '123456'){

                    message.style.display = 'block';
                    message.className = 'message success';
                    message.innerHTML = 'Login realizado com sucesso!';

                    // Redirecionamento
                    setTimeout(() => {
                        window.location.href = 'dashboard.html';
                    }, 1500);

                }else{

                    message.style.display = 'block';
                    message.className = 'message error';
                    message.innerHTML = 'Usuário ou senha inválidos.';
                }
            });
        </script>
        <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Poppins', sans-serif;
        }

        body{
            min-height:100vh;
            display:flex;
            align-items:center;
            justify-content:center;
            background: linear-gradient(90deg, #c1274d 0%, #b11f67 35%, #9a1f88 70%, #7b1fa2 100%);
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
            box-shadow:0 15px 40px rgba(0,0,0,0.3);
        }

        /* ================= LEFT ================= */

        .left{
            flex:1;
            background:linear-gradient(90deg,#c1274d 0%,#b11f67 35%,#9a1f88 70%,#7b1fa2 100%);
            color:#fff;
            padding:60px;
            display:flex;
            flex-direction:column;
            justify-content:center;
            position:relative;
        }

        .left::before{
            content:'';
            position:absolute;
            width:250px;
            height:250px;
            background:rgba(255,255,255,0.05);
            border-radius:50%;
            top:-60px;
            right:-60px;
        }

        .left::after{
            content:'';
            position:absolute;
            width:180px;
            height:180px;
            background:rgba(255,255,255,0.05);
            border-radius:50%;
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

        .left p{
            line-height:1.7;
            opacity:0.9;
            z-index:1;
        }

        /* ================= RIGHT ================= */

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

        form{
            width:100%;
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
            left:15px;
            top:50%;
            transform:translateY(-50%);
            color:#777;
        }

        .input-group input{
            width:100%;
            height:50px;
            border:1px solid #dcdcdc;
            border-radius:12px;
            padding:0 15px 0 45px;
            font-size:15px;
            transition:0.3s;
            outline:none;
        }

        .input-group input:focus{
            border-color:#b11f67;
            box-shadow:0 0 0 4px rgba(177,31,103,.18);
        }

        .actions{
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom:25px;
            flex-wrap:wrap;
            gap:10px;
        }

        .remember{
            display:flex;
            align-items:center;
            gap:8px;
            font-size:14px;
            color:#555;
        }

        .actions a{
            font-size:14px;
            text-decoration:none;
            color:#b11f67;
            transition:0.3s;
        }

        .actions a:hover{
            opacity:0.8;
        }

        .btn{
            width:100%;
            height:52px;
            border:none;
            border-radius:12px;
            background:linear-gradient(90deg,#c1274d 0%,#b11f67 35%,#9a1f88 70%,#7b1fa2 100%);
            color:#fff;
            font-size:15px;
            font-weight:600;
            cursor:pointer;
            transition:0.3s;
        }

        .btn:hover{
            background:linear-gradient(90deg,#d93a61,#c42b74,#ab2493,#8b2bb3);
            transform:translateY(-2px);
        }

        .footer{
            text-align:center;
            margin-top:25px;
        }

        .footer a{
            text-decoration:none;
            color:#b11f67;
            font-size:14px;
            font-weight:500;
        }

        .message{
            margin-top:20px;
            padding:12px;
            border-radius:10px;
            display:none;
            text-align:center;
            font-size:14px;
        }

        .success{
            background:#d4edda;
            color:#155724;
            border:1px solid #c3e6cb;
        }

        .error{
            background:#f8d7da;
            color:#721c24;
            border:1px solid #f5c6cb;
        }

        /* ================= RESPONSIVO ================= */

        @media(max-width:900px){

            .container{
                flex-direction:column;
                max-width:500px;
            }

            .left{
                display:none;
            }

            .right{
                padding:40px 30px;
            }
        }

        @media(max-width:480px){

            .right{
                padding:35px 20px;
            }

            .form-title{
                font-size:28px;
            }
        }
        </style>
    </body>
</html>