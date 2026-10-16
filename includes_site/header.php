
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Início | Associação Científica Medeia</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <!-- Fonte Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
          rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
        }

        /* =========================
           HEADER MEDEIA
        ========================= */

        .navbar-custom {
            width: 100%;
            position: relative;
            z-index: 1000;
            isolation: isolate;

            background: linear-gradient(
                110deg,
                #590021 0%,
                #70003e 32%,
                #781064 65%,
                #7020a5 100%
            );

            border-bottom: 1px solid rgba(255, 255, 255, 0.16);

            box-shadow:
                0 8px 30px rgba(64, 0, 43, 0.22),
                0 2px 8px rgba(80, 0, 70, 0.12);
        }

        /* Reflexo decorativo */

        .navbar-custom::before {
            content: "";
            position: absolute;
            inset: 0;
            z-index: -1;
            pointer-events: none;

            background:
                radial-gradient(
                    ellipse at 12% 0%,
                    rgba(255, 75, 145, 0.18),
                    transparent 45%
                ),
                radial-gradient(
                    ellipse at 90% 100%,
                    rgba(164, 70, 255, 0.18),
                    transparent 42%
                );
        }

        /* Linha inferior com as cores da marca */

        .navbar-custom::after {
            content: "";
            position: absolute;
            left: 0;
            right: 0;
            bottom: 0;
            height: 3px;

            background: linear-gradient(
                90deg,
                #ff1744,
                #ec168d,
                #a000ff
            );
        }

        .header-container {
            width: 100%;
            max-width: 1500px;
            min-height: 125px;

            margin: 0 auto;
            padding: 20px 35px;

            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 30px;
        }

        /* =========================
           LOGO E IDENTIDADE
        ========================= */

        .logo-link {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 7px;

            flex-shrink: 0;
            text-decoration: none;
        }

        .logo-medeia {
            width: 68px;
            height: 68px;

            display: block;
            object-fit: contain;
            padding: 5px;

            border-radius: 21px;

            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.26);

            box-shadow:
                0 5px 18px rgba(35, 0, 30, 0.18),
                inset 0 1px 0 rgba(255, 255, 255, 0.18);

            transition:
                transform 0.3s ease,
                background 0.3s ease,
                box-shadow 0.3s ease;
        }

        .logo-link:hover .logo-medeia {
            transform: translateY(-3px);

            background: rgba(255, 255, 255, 0.24);

            box-shadow:
                0 9px 25px rgba(35, 0, 30, 0.22),
                0 0 18px rgba(255, 100, 210, 0.16);
        }

        .logo-nome {
            color: #ffffff;

            font-size: 16px;
            font-weight: 800;
            letter-spacing: 0.5px;
            line-height: 1;

            text-shadow: 0 2px 8px rgba(40, 0, 30, 0.18);
        }

        /* =========================
           MENU DE NAVEGAÇÃO
        ========================= */

        .desktop-menu {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 8px;
        }

        .navbar-custom .nav-link {
            position: relative;

            display: inline-flex;
            align-items: center;
            justify-content: center;

            padding: 13px 16px;

            color: rgba(255, 255, 255, 0.92);
            font-size: 13px;
            font-weight: 600;
            letter-spacing: 0.1px;

            text-decoration: none;
            white-space: nowrap;

            border: 1px solid transparent;
            border-radius: 12px;

            transition:
                color 0.25s ease,
                background 0.25s ease,
                border-color 0.25s ease,
                transform 0.25s ease;
        }

        .navbar-custom .nav-link:hover {
            color: #ffffff;

            background: rgba(255, 255, 255, 0.13);
            border-color: rgba(255, 255, 255, 0.14);

            transform: translateY(-2px);
        }

        /* Indicador decorativo no hover */

        .navbar-custom .nav-link:not(.nav-admin)::after {
            content: "";
            position: absolute;

            left: 20%;
            right: 20%;
            bottom: 5px;

            height: 2px;
            border-radius: 5px;

            background: linear-gradient(
                90deg,
                #ff526f,
                #d946ef
            );

            transform: scaleX(0);
            transform-origin: center;

            transition: transform 0.25s ease;
        }

        .navbar-custom .nav-link:not(.nav-admin):hover::after {
            transform: scaleX(1);
        }

        /* =========================
           BOTÃO ADMIN
        ========================= */

        .navbar-custom .nav-admin {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;

            margin-left: 8px;
            padding: 13px 21px;

            color: #ffffff;

            background: rgba(255, 255, 255, 0.16);
            border: 1px solid rgba(255, 255, 255, 0.32);

            border-radius: 13px;

            box-shadow:
                0 4px 14px rgba(40, 0, 35, 0.12),
                inset 0 1px 0 rgba(255, 255, 255, 0.12);

            transition:
                background 0.25s ease,
                box-shadow 0.25s ease,
                transform 0.25s ease;
        }

        .navbar-custom .nav-admin i {
            color: #ffe0f2;
            font-size: 13px;
        }

        .navbar-custom .nav-admin:hover {
            color: #ffffff;

            background: rgba(255, 255, 255, 0.25);

            box-shadow:
                0 7px 20px rgba(40, 0, 35, 0.18),
                0 0 15px rgba(255, 100, 210, 0.12);

            transform: translateY(-2px);
        }

        /* Acessibilidade */

        .navbar-custom a:focus-visible {
            outline: 2px solid #ffffff;
            outline-offset: 4px;
        }

        /* =========================
           TABLETS E NOTEBOOKS
        ========================= */

        @media (max-width: 1100px) {
            .header-container {
                padding: 18px 22px;
                gap: 18px;
            }

            .desktop-menu {
                gap: 3px;
            }

            .navbar-custom .nav-link {
                padding: 11px 9px;
                font-size: 12px;
            }

            .navbar-custom .nav-admin {
                margin-left: 3px;
                padding: 11px 12px;
            }

            .logo-medeia {
                width: 58px;
                height: 58px;
            }
        }

        /* =========================
           CELULARES
        ========================= */

        @media (max-width: 700px) {
            .header-container {
                min-height: auto;

                flex-direction: column;
                justify-content: center;
                gap: 20px;

                padding: 20px 12px 23px;
            }

            .logo-link {
                gap: 7px;
            }

            .logo-medeia {
                width: 58px;
                height: 58px;
                border-radius: 18px;
            }

            .logo-nome {
                font-size: 15px;
            }

            .desktop-menu {
                width: 100%;

                display: flex;
                justify-content: center;
                flex-wrap: wrap;
                gap: 5px;
            }

            .navbar-custom .nav-link {
                padding: 10px 11px;
                font-size: 12px;
                border-radius: 10px;
            }

            .navbar-custom .nav-admin {
                margin-left: 0;
                padding: 10px 13px;
            }
        }

        @media (max-width: 380px) {
            .header-container {
                padding-left: 8px;
                padding-right: 8px;
            }

            .desktop-menu {
                gap: 3px;
            }

            .navbar-custom .nav-link {
                padding: 9px 7px;
                font-size: 11px;
            }
        }

        /* Reduz animações conforme preferência do usuário */

        @media (prefers-reduced-motion: reduce) {
            *,
            *::before,
            *::after {
                scroll-behavior: auto !important;
                transition-duration: 0.01ms !important;
                animation-duration: 0.01ms !important;
            }
        }
    </style>
</head>

<body>

    <!-- HEADER MEDEIA -->

    <nav class="navbar-custom" aria-label="Navegação principal">

        <div class="header-container">

            <!-- LOGO -->
            <a href="/tcc/" class="logo-link"
               aria-label="Medeia - Página inicial">

                <img
                    src="/tcc/midias/img/logo.png"
                    alt="Logo Medeia"
                    class="logo-medeia"
                >

                <span class="logo-nome">Medeia</span>

            </a>

            <!-- MENU -->
            <div class="desktop-menu">

                <a href="/tcc/" class="nav-link">
                    Início
                </a>

                <a href="/tcc/sobre.php" class="nav-link">
                    Sobre
                </a>

                <a href="/tcc/servicos.php" class="nav-link">
                    Serviços
                </a>

                <a href="/tcc/publicacoes.php" class="nav-link">
                    Publicações
                </a>

                <a href="/tcc/contato.php" class="nav-link">
                    Contato
                </a>

                <a href="/tcc/login/" class="nav-link nav-admin">
                    <i class="fa-solid fa-lock" aria-hidden="true"></i>
                    <span>Admin</span>
                </a>

            </div>

        </div>

    </nav>

</body>
</html>