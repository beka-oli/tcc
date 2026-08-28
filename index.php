<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Inicio | Associação Científica Medeia
    </title>


    <!-- BOOTSTRAP -->

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >


    <!-- GOOGLE FONTS -->

    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Playfair+Display:wght@600;700&display=swap"
        rel="stylesheet"
    >


    <!-- FONT AWESOME -->

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
    >


    <style>

        /* =========================
           CONFIGURAÇÕES GERAIS
        ========================= */

        * {

            margin: 0;

            padding: 0;

            box-sizing: border-box;

        }


        body {

            font-family: "Inter", sans-serif;

            background: #f8f2f9;

            color: #35152f;

        }


        a {

            text-decoration: none;

        }


        /* =========================
           NAVBAR
        ========================= */

        .navbar-custom {

            background:

                linear-gradient(
                    90deg,
                    #67012a,
                    #70145c,
                    #7b1fa2
                );

            padding: 16px 0;

            box-shadow:
                0 5px 25px rgba(60, 10, 55, 0.18);

            position: relative;

            z-index: 10;

        }


        .navbar-brand {

            display: flex;

            align-items: center;

            gap: 12px;

            color: #ffffff !important;

            font-size: 20px;

            font-weight: 800;

        }


        .logo {

            width: 44px;

            height: 44px;

            border-radius: 13px;

            display: flex;

            align-items: center;

            justify-content: center;

            color: #ffffff;

            background:

                linear-gradient(
                    135deg,
                    #8e2a8f,
                    #c04a91
                );

        }


        .nav-link {

            color: #f8edf8 !important;

            font-size: 14px;

            font-weight: 600;

            padding: 10px 14px !important;

            border-radius: 9px;

            transition: 0.3s;

        }


        .nav-link:hover {

            background: rgba(255, 255, 255, 0.10);

            color: #ffffff !important;

        }


        .nav-admin {

            background: rgba(255, 255, 255, 0.12);

        }


        /* =========================
           HERO
        ========================= */

        .hero {

            min-height: calc(100vh - 76px);

            display: flex;

            align-items: center;

            position: relative;

            overflow: hidden;

            background:

                radial-gradient(
                    circle at 85% 20%,
                    rgba(192, 74, 145, 0.16),
                    transparent 24%
                ),

                linear-gradient(
                    120deg,
                    #faf6fb,
                    #eee0f3 50%,
                    #f7e8f0
                );

        }


        /* BOLHA 1 */

        .hero::before {

            content: "";

            position: absolute;

            width: 230px;

            height: 230px;

            border-radius: 50%;

            background:
                rgba(123, 31, 162, 0.07);

            top: -100px;

            right: 13%;

        }


        /* BOLHA 2 */

        .hero::after {

            content: "";

            position: absolute;

            width: 130px;

            height: 130px;

            border-radius: 50%;

            background:
                rgba(103, 1, 42, 0.06);

            bottom: 30px;

            left: 5%;

        }


        .hero-content {

            position: relative;

            z-index: 2;

        }


        .hero-label {

            display: inline-block;

            padding: 8px 15px;

            border-radius: 30px;

            background: #ead7ed;

            color: #70205f;

            font-size: 11px;

            font-weight: 800;

            letter-spacing: 1.5px;

            text-transform: uppercase;

            margin-bottom: 20px;

        }


        .hero h1 {

            font-family: "Playfair Display", serif;

            color: #42162f;

            font-size: clamp(45px, 6vw, 70px);

            line-height: 1.08;

            margin-bottom: 20px;

        }


        .hero h1 span {

            background:

                linear-gradient(
                    90deg,
                    #67012a,
                    #7b1fa2,
                    #c04a91
                );

            -webkit-background-clip: text;

            -webkit-text-fill-color: transparent;

        }


        .hero h4 {

            color: #6b3266;

            font-size: 18px;

            font-weight: 600;

            margin-bottom: 18px;

        }


        .hero p {

            max-width: 560px;

            color: #6f626e;

            font-size: 15px;

            line-height: 1.9;

            margin-bottom: 30px;

        }


        /* =========================
           BOTÃO
        ========================= */

        .btn-main {

            display: inline-flex;

            align-items: center;

            gap: 10px;

            padding: 14px 25px;

            border-radius: 11px;

            color: #ffffff;

            font-weight: 700;

            background:

                linear-gradient(
                    90deg,
                    #67012a,
                    #7b1fa2
                );

            box-shadow:
                0 12px 28px rgba(103, 1, 42, 0.20);

            transition: 0.3s;

        }


        .btn-main:hover {

            color: #ffffff;

            transform: translateY(-3px);

            box-shadow:
                0 17px 32px rgba(103, 1, 42, 0.28);

        }


        /* =========================
           IMAGEM
        ========================= */

        .hero-image-area {

            position: relative;

            z-index: 2;

        }


        .hero-image {

            width: 100%;

            height: 470px;

            object-fit: cover;

            border-radius: 25px;

            box-shadow:
                0 25px 55px rgba(60, 15, 60, 0.18);

        }


        /* =========================
           FOOTER
        ========================= */

        .footer-custom {

            background:

                linear-gradient(
                    90deg,
                    #67012a,
                    #7b1f70,
                    #7b1fa2
                );

            color: #ffffff;

            padding: 55px 0 22px;

            position: relative;

            overflow: hidden;

        }


        .footer-custom::before {

            content: "";

            position: absolute;

            width: 250px;

            height: 250px;

            border-radius: 50%;

            background:
                rgba(255, 255, 255, 0.06);

            top: -120px;

            right: -60px;

        }


        .footer-custom::after {

            content: "";

            position: absolute;

            width: 160px;

            height: 160px;

            border-radius: 50%;

            background:
                rgba(255, 255, 255, 0.04);

            bottom: -90px;

            left: -50px;

        }


        .footer-custom .container {

            position: relative;

            z-index: 2;

        }


        .footer-custom h4 {

            font-size: 19px;

            font-weight: 700;

            margin-bottom: 15px;

        }


        .footer-custom p {

            color: #f5eaf5;

            font-size: 13px;

            line-height: 1.8;

        }


        .footer-bottom {

            border-top:
                1px solid rgba(255, 255, 255, 0.15);

            margin-top: 35px;

            padding-top: 18px;

            text-align: center;

            font-size: 12px;

            opacity: 0.8;

        }


        /* =========================
           RESPONSIVO
        ========================= */

        @media (max-width: 991px) {

            .desktop-menu {

                display: none;

            }

        }


        @media (max-width: 768px) {

            .hero {

                padding: 70px 0;

            }


            .hero-image {

                height: 350px;

                margin-top: 40px;

            }

        }

    </style>

</head>


<body>


    <!-- =========================
         NAVBAR
    ========================= -->

    <nav class="navbar-custom">

        <div class="container">

            <div class="d-flex justify-content-between align-items-center">


                <a
                    href="/tcc/"
                    class="navbar-brand"
                >

                    <div class="logo">

                        <i class="fa-solid fa-atom"></i>

                    </div>

                    AC Medeia

                </a>


                <div class="desktop-menu d-flex">


                    <a
                        href="/tcc/"
                        class="nav-link"
                    >
                        Início
                    </a>


                    <a
                        href="/tcc/sobre.php/"
                        class="nav-link"
                    >
                        Sobre
                    </a>


                    <a
                        href="/tcc/servicos.php/"
                        class="nav-link"
                    >
                        Serviços
                    </a>


                    <a
                        href="/tcc/publicacoes.php/"
                        class="nav-link"
                    >
                        Publicações
                    </a>


                    <a
                        href="/tcc/contato.php/"
                        class="nav-link"
                    >
                        Contato
                    </a>


                    <a
                        href="/tcc/login/"
                        class="nav-link nav-admin"
                    >

                        <i class="fa-solid fa-lock me-1"></i>

                        Admin

                    </a>


                </div>

            </div>

        </div>

    </nav>



    <!-- =========================
         HERO
    ========================= -->

    <section class="hero">

        <div class="container">

            <div class="row align-items-center">


                <div class="col-lg-6 hero-content">


                    <span class="hero-label">

                        Conhecimento que transforma

                    </span>


                    <h1>

                        Ciência,

                        <span>cultura</span>

                        e educação.

                    </h1>


                    <h4>

                        Associação Científica Medeia

                    </h4>


                    <p>

                        Uma organização dedicada à promoção
                        da ciência, educação, formação,
                        produção de conhecimento, publicações
                        e desenvolvimento de projetos
                        culturais e pedagógicos.

                    </p>


                </div>



                <div class="col-lg-6">


                    <div class="hero-image-area">


                        <img
                            src="https://images.unsplash.com/photo-1532094349884-543bc11b234d?auto=format&fit=crop&w=1000&q=85"
                            class="hero-image"
                            alt="Pesquisa científica"
                        >


                    </div>


                </div>


            </div>

        </div>

    </section>



   


</body>

</html>

 <!--------------- FOOTER ---------------->
    <?php include 'includes_site/footer.php'?>
 <!--------------------------------------->
