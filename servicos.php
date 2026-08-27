<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Serviços | Associação Científica Medeia
    </title>


    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >


    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Playfair+Display:wght@600;700&display=swap"
        rel="stylesheet"
    >


    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
    >


    <style>


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


        /* NAVBAR */

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

        }


        .navbar-brand {

            display: flex;

            align-items: center;

            gap: 12px;

            color: white !important;

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

            color: white;

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

            transition: .3s;

        }


        .nav-link:hover {

            background:
                rgba(255,255,255,.10);

        }


        .nav-admin {

            background:
                rgba(255,255,255,.12);

        }


        /* HEADER */

        .page-header {

            text-align: center;

            padding: 90px 0;

            position: relative;

            overflow: hidden;

            background:

                radial-gradient(
                    circle at 15% 30%,
                    rgba(123,31,162,.08),
                    transparent 25%
                ),

                linear-gradient(
                    120deg,
                    #faf6fb,
                    #eadcf1,
                    #f7e8f0
                );

        }


        .page-header::after {

            content: "";

            position: absolute;

            width: 140px;

            height: 140px;

            border-radius: 50%;

            background:
                rgba(192,74,145,.07);

            right: 8%;

            bottom: -65px;

        }


        .page-header small {

            color: #7b2468;

            font-size: 11px;

            font-weight: 800;

            letter-spacing: 2px;

            text-transform: uppercase;

        }


        .page-header h1 {

            font-family: "Playfair Display", serif;

            color: #42162f;

            font-size: 58px;

            margin: 10px 0;

        }


        .page-header p {

            color: #706375;

            max-width: 600px;

            margin: auto;

            line-height: 1.8;

        }


        /* SERVIÇOS */

        .services {

            padding: 90px 0;

        }


        .service-card {

            height: 100%;

            padding: 35px 30px;

            border-radius: 20px;

            background: rgba(255,255,255,.92);

            border: 1px solid #e5d5ea;

            box-shadow:
                0 12px 30px rgba(70,25,80,.07);

            position: relative;

            overflow: hidden;

            transition: .35s;

        }


        .service-card:hover {

            transform: translateY(-8px);

            box-shadow:
                0 20px 45px rgba(70,25,80,.14);

        }


        .service-card::before {

            content: "";

            position: absolute;

            width: 80px;

            height: 80px;

            border-radius: 50%;

            background:
                rgba(192,74,145,.07);

            right: -30px;

            top: -30px;

        }


        .icon {

            width: 62px;

            height: 62px;

            border-radius: 16px;

            display: flex;

            align-items: center;

            justify-content: center;

            color: #762476;

            font-size: 23px;

            background:

                linear-gradient(
                    135deg,
                    #eadcf0,
                    #f5dfe9
                );

            margin-bottom: 23px;

        }


        .service-card h3 {

            color: #42162f;

            font-size: 19px;

            font-weight: 700;

            margin-bottom: 12px;

        }


        .service-card p {

            color: #706575;

            font-size: 13px;

            line-height: 1.8;

        }


        /* FOOTER */

        .footer-custom {

            background:

                linear-gradient(
                    90deg,
                    #67012a,
                    #7b1f70,
                    #7b1fa2
                );

            color: white;

            padding: 45px 0 20px;

            position: relative;

        }


        .footer-custom h4 {

            font-size: 19px;

            font-weight: 700;

        }


        .footer-custom p {

            color: #f5eaf5;

            font-size: 13px;

            line-height: 1.8;

        }


        .footer-bottom {

            margin-top: 30px;

            padding-top: 18px;

            border-top:
                1px solid rgba(255,255,255,.15);

            text-align: center;

            font-size: 12px;

            opacity: .8;

        }


    </style>

</head>


<body>


    <!-- NAVBAR -->

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


                <div class="d-flex">


                    <a
                        href="/tcc/index.php/"
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
                        Admin
                    </a>


                </div>

            </div>

        </div>

    </nav>



    <!-- HEADER -->

    <section class="page-header">

        <div class="container">


            <small>

                Áreas de atuação

            </small>


            <h1>

                Nossos Serviços

            </h1>


            <p>

                Conheça as principais áreas de atuação
                da Associação Científica Medeia.

            </p>


        </div>

    </section>



    <!-- SERVIÇOS -->

    <section class="services">

        <div class="container">

            <div class="row g-4">


                <!-- SERVIÇO 1 -->

                <div class="col-lg-3 col-md-6">

                    <div class="service-card">


                        <div class="icon">

                            <i class="fa-solid fa-book-open"></i>

                        </div>


                        <h3>

                            Editora

                        </h3>


                        <p>

                            Publicação de livros,
                            materiais acadêmicos
                            e conteúdos voltados
                            à disseminação do conhecimento.

                        </p>


                    </div>

                </div>



                <!-- SERVIÇO 2 -->

                <div class="col-lg-3 col-md-6">

                    <div class="service-card">


                        <div class="icon">

                            <i class="fa-solid fa-laptop"></i>

                        </div>


                        <h3>

                            Revista Eletrônica

                        </h3>


                        <p>

                            Revista científica online
                            destinada à divulgação de
                            artigos, pesquisas e
                            produções acadêmicas.

                        </p>


                    </div>

                </div>



                <!-- SERVIÇO 3 -->

                <div class="col-lg-3 col-md-6">

                    <div class="service-card">


                        <div class="icon">

                            <i class="fa-solid fa-clipboard-list"></i>

                        </div>


                        <h3>

                            Agência de Concursos

                        </h3>


                        <p>

                            Organização e realização
                            de concursos públicos
                            e privados.

                        </p>


                    </div>

                </div>



                <!-- SERVIÇO 4 -->

                <div class="col-lg-3 col-md-6">

                    <div class="service-card">


                        <div class="icon">

                            <i class="fa-solid fa-graduation-cap"></i>

                        </div>


                        <h3>

                            Assessoria Pedagógica

                        </h3>


                        <p>

                            Consultoria e apoio
                            em projetos educacionais,
                            científicos e institucionais.

                        </p>


                    </div>

                </div>


            </div>

        </div>

    </section>



    <!-- FOOTER -->

    <footer class="footer-custom">

        <div class="container">


            <div class="row">


                <div class="col-lg-7">

                    <h4>

                        Associação Científica Medeia

                    </h4>


                    <p>

                        Ciência, educação,
                        cultura e conhecimento.

                    </p>

                </div>


                <div class="col-lg-5">

                    <h4>

                        Contato

                    </h4>


                    <p>

                        <i class="fas fa-envelope me-2"></i>

                        associacaocientificamedeia@gmail.com

                    </p>

                </div>


            </div>


            <div class="footer-bottom">

                © 2026 Associação Científica Medeia.
                Todos os direitos reservados.

            </div>


        </div>

    </footer>


</body>

</html>