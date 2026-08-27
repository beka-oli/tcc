<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Contato | Associação Científica Medeia
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


        /* =========================
           GERAL
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


        /* =========================
           HEADER
        ========================= */

        .page-header {

            padding: 90px 0;

            text-align: center;

            position: relative;

            overflow: hidden;

            background:

                radial-gradient(
                    circle at 85% 25%,
                    rgba(192,74,145,.14),
                    transparent 25%
                ),

                linear-gradient(
                    120deg,
                    #faf6fb,
                    #eadcf1,
                    #f7e8f0
                );

        }


        .page-header::before {

            content: "";

            position: absolute;

            width: 140px;

            height: 140px;

            border-radius: 50%;

            background:
                rgba(123,31,162,.06);

            left: 7%;

            top: -60px;

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

            max-width: 620px;

            margin: auto;

            color: #706375;

            line-height: 1.8;

        }


        /* =========================
           CONTATO
        ========================= */

        .contact {

            padding: 90px 0;

        }


        .contact-box {

            background: #ffffff;

            border: 1px solid #e5d7ea;

            border-radius: 24px;

            padding: 45px;

            box-shadow:
                0 20px 50px rgba(70,25,80,.09);

        }


        .contact-info h2 {

            font-family: "Playfair Display", serif;

            color: #42162f;

            font-size: 40px;

            margin-bottom: 18px;

        }


        .contact-info > p {

            color: #706575;

            font-size: 14px;

            line-height: 1.8;

            margin-bottom: 35px;

        }


        .contact-item {

            display: flex;

            gap: 14px;

            margin-bottom: 23px;

        }


        .contact-icon {

            width: 48px;

            height: 48px;

            min-width: 48px;

            border-radius: 13px;

            display: flex;

            align-items: center;

            justify-content: center;

            color: #762476;

            background:

                linear-gradient(
                    135deg,
                    #eadcf0,
                    #f5dfe9
                );

        }


        .contact-item strong {

            display: block;

            color: #42162f;

            font-size: 13px;

            margin-bottom: 4px;

        }


        .contact-item span {

            color: #706575;

            font-size: 13px;

            line-height: 1.6;

        }


        /* =========================
           FORMULÁRIO
        ========================= */

        .form-box {

            padding: 30px;

            border-radius: 20px;

            background:

                linear-gradient(
                    145deg,
                    #f5edf8,
                    #f9eaf2
                );

            border: 1px solid #e5d6ea;

        }


        .form-label {

            color: #52345b;

            font-size: 12px;

            font-weight: 700;

            margin-bottom: 7px;

        }


        .form-control {

            border: 1px solid #dac9df;

            border-radius: 10px;

            padding: 13px;

            font-size: 13px;

            background: white;

        }


        .form-control:focus {

            border-color: #873c91;

            box-shadow:
                0 0 0 4px rgba(135,60,145,.10);

        }


        textarea {

            resize: vertical;

            min-height: 140px;

        }


        .btn-send {

            width: 100%;

            border: none;

            padding: 14px;

            border-radius: 10px;

            color: white;

            font-weight: 700;

            background:

                linear-gradient(
                    90deg,
                    #67012a,
                    #7b1fa2
                );

            transition: .3s;

        }


        .btn-send:hover {

            transform: translateY(-2px);

            box-shadow:
                0 12px 25px rgba(80,25,90,.18);

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

            color: white;

            padding: 45px 0 20px;

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


        @media(max-width:768px) {

            .contact-box {

                padding: 25px;

            }


            .form-box {

                margin-top: 35px;

            }

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
                        href="/tcc/login.php/"
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

                Fale conosco

            </small>


            <h1>

                Contato

            </h1>


            <p>

                Entre em contato com a Associação
                Científica Medeia. Estamos disponíveis
                para receber sua mensagem.

            </p>


        </div>

    </section>



    <!-- CONTATO -->

    <section class="contact">

        <div class="container">

            <div class="contact-box">


                <div class="row align-items-center">


                    <!-- INFORMAÇÕES -->

                    <div class="col-lg-5">


                        <div class="contact-info">


                            <h2>

                                Vamos conversar?

                            </h2>


                            <p>

                                Entre em contato conosco através
                                dos nossos canais de comunicação
                                ou envie uma mensagem.

                            </p>



                            <!-- ENDEREÇO -->

                            <div class="contact-item">


                                <div class="contact-icon">

                                    <i class="fa-solid fa-location-dot"></i>

                                </div>


                                <div>

                                    <strong>

                                        Endereço

                                    </strong>


                                    <span>

                                        Av. 20 de Dezembro, 539 – Centro

                                        <br>

                                        Cerro Grande - RS

                                    </span>

                                </div>


                            </div>



                            <!-- TELEFONE -->

                            <div class="contact-item">


                                <div class="contact-icon">

                                    <i class="fa-solid fa-phone"></i>

                                </div>


                                <div>

                                    <strong>

                                        Telefone

                                    </strong>


                                    <span>

                                        (55) 99101-2088

                                    </span>

                                </div>


                            </div>



                            <!-- E-MAIL -->

                            <div class="contact-item">


                                <div class="contact-icon">

                                    <i class="fa-solid fa-envelope"></i>

                                </div>


                                <div>

                                    <strong>

                                        E-mail

                                    </strong>


                                    <span>

                                        associacaocientificamedeia@gmail.com

                                    </span>

                                </div>


                            </div>


                        </div>

                    </div>



                    <!-- FORMULÁRIO -->

                    <div class="col-lg-7">


                        <div class="form-box">


                            <form>


                                <!-- NOME -->

                                <div class="mb-3">


                                    <label class="form-label">

                                        Nome

                                    </label>


                                    <input
                                        type="text"
                                        class="form-control"
                                        placeholder="Digite seu nome"
                                        required
                                    >


                                </div>



                                <!-- E-MAIL -->

                                <div class="mb-3">


                                    <label class="form-label">

                                        E-mail

                                    </label>


                                    <input
                                        type="email"
                                        class="form-control"
                                        placeholder="seuemail@email.com"
                                        required
                                    >


                                </div>



                                <!-- ASSUNTO -->

                                <div class="mb-3">


                                    <label class="form-label">

                                        Assunto

                                    </label>


                                    <input
                                        type="text"
                                        class="form-control"
                                        placeholder="Assunto da mensagem"
                                        required
                                    >


                                </div>



                                <!-- MENSAGEM -->

                                <div class="mb-4">


                                    <label class="form-label">

                                        Mensagem

                                    </label>


                                    <textarea
                                        class="form-control"
                                        placeholder="Digite sua mensagem..."
                                        required
                                    ></textarea>


                                </div>



                                <!-- BOTÃO -->

                                <button
                                    type="submit"
                                    class="btn-send"
                                >

                                    <i
                                        class="fa-solid fa-paper-plane me-2"
                                    ></i>

                                    Enviar mensagem

                                </button>


                            </form>


                        </div>

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