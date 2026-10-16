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

            position: relative;

            z-index: 10;
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

            color: white !important;
        }


        .nav-admin {

            background:
                rgba(255,255,255,.12);
        }


        /* =========================
           HEADER
        ========================= */

        .page-header {

            text-align: left;

            padding: 90px 0;

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


        .page-header .container {

            text-align: left;
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

            margin: 0;

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

            margin-bottom: 25px;
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
           CARDS
        ========================= */

        .contact-card {

            height: 100%;

            padding: 30px;

            border-radius: 20px;

            background:

                linear-gradient(
                    145deg,
                    #f5edf8,
                    #f9eaf2
                );

            border: 1px solid #e5d6ea;

            transition: .3s;
        }


        .contact-card:hover {

            transform: translateY(-4px);

            box-shadow:
                0 12px 30px rgba(70,25,80,.10);
        }


        .contact-card-icon {

            width: 52px;

            height: 52px;

            border-radius: 14px;

            display: flex;

            align-items: center;

            justify-content: center;

            color: #762476;

            background: white;

            margin-bottom: 18px;

            font-size: 20px;
        }


        .contact-card h3 {

            color: #42162f;

            font-size: 17px;

            font-weight: 700;

            margin-bottom: 10px;
        }


        .contact-card p {

            color: #706575;

            font-size: 13px;

            line-height: 1.8;

            margin-bottom: 18px;
        }


        .contact-card p strong {

            color: #42162f;

            font-size: 15px;
        }


        /* =========================
           BOTÕES
        ========================= */

        .contact-btn {

            display: inline-flex;

            align-items: center;

            gap: 8px;

            padding: 10px 16px;

            border-radius: 9px;

            color: white;

            font-size: 12px;

            font-weight: 700;

            background:

                linear-gradient(
                    90deg,
                    #67012a,
                    #7b1fa2
                );

            transition: .3s;
        }


        .contact-btn:hover {

            color: white;

            transform: translateY(-2px);

            box-shadow:
                0 8px 18px rgba(80,25,90,.18);
        }


        /* =========================
           ATENDIMENTO
        ========================= */

        .service-info {

            margin-top: 35px;

            padding: 30px;

            border-radius: 20px;

            background: #ffffff;

            border: 1px solid #e5d7ea;
        }


        .service-info h3 {

            font-family: "Playfair Display", serif;

            color: #42162f;

            font-size: 27px;

            margin-bottom: 12px;
        }


        .service-info p {

            color: #706575;

            font-size: 13px;

            line-height: 1.8;

            margin-bottom: 0;
        }


        /* =========================
           RESPONSIVO
        ========================= */

        @media(max-width:768px) {

            .contact-box {

                padding: 25px;
            }


            .page-header {

                padding: 65px 0;
            }


            .page-header h1 {

                font-size: 45px;
            }


            .contact {

                padding: 60px 0;
            }

        }

    </style>

</head>


<body>
  <?php include 'includes_site/header.php'; ?>
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
                Científica Medeia através dos nossos
                canais oficiais de comunicação.
            </p>

        </div>

    </section>



    <!-- =========================
         CONTATO
    ========================= -->

    <section class="contact">

        <div class="container">

            <div class="contact-box">

                <div class="row align-items-center">


                    <!-- =========================
                         INFORMAÇÕES PRINCIPAIS
                    ========================= -->

                    <div class="col-lg-5">

                        <div class="contact-info">

                            <h2>
                                Fale conosco
                            </h2>

                            <p>
                                A Associação Científica Medeia
                                disponibiliza canais oficiais para
                                informações, esclarecimentos e
                                assuntos relacionados às suas
                                atividades.
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


                            <!-- HORÁRIO -->

                            <div class="contact-item">

                                <div class="contact-icon">

                                    <i class="fa-solid fa-clock"></i>

                                </div>

                                <div>

                                    <strong>
                                        Horário de atendimento
                                    </strong>

                                    <span>

                                        Segunda a sexta-feira

                                        <br>

                                        08h às 18h

                                    </span>

                                </div>

                            </div>

                        </div>

                    </div>



                    <!-- =========================
                         CARDS
                    ========================= -->

                    <div class="col-lg-7">

                        <div class="row g-3">


                            <!-- TELEFONE -->

                            <div class="col-md-6">

                                <div class="contact-card">

                                    <div class="contact-card-icon">

                                        <i class="fa-solid fa-phone"></i>

                                    </div>

                                    <h3>
                                        Telefone oficial
                                    </h3>

                                    <p>

                                        Entre em contato com a
                                        Associação Científica Medeia
                                        pelo telefone:

                                        <br><br>

                                        <strong>
                                            (55) 99101-2088
                                        </strong>

                                    </p>

                                    <a
                                        href="tel:+5555991012088"
                                        class="contact-btn"
                                    >

                                        <i class="fa-solid fa-phone"></i>

                                        Ligar para a Associação

                                    </a>

                                </div>

                            </div>



                            <!-- E-MAIL -->

                            <div class="col-md-6">

                                <div class="contact-card">

                                    <div class="contact-card-icon">

                                        <i class="fa-solid fa-envelope"></i>

                                    </div>

                                    <h3>
                                        E-mail
                                    </h3>

                                    <p>

                                        Para informações e
                                        assuntos institucionais,
                                        utilize nosso e-mail oficial.

                                    </p>

                                    <a
                                        href="https://mail.google.com/mail/?view=cm&fs=1&to=associacaocientificamedeia@gmail.com"
                                        target="_blank"
                                        class="contact-btn"
                                    >

                                        <i class="fa-solid fa-envelope"></i>

                                        Enviar e-mail

                                    </a>

                                </div>

                            </div>



                            <!-- LOCALIZAÇÃO -->

                            <div class="col-md-6">

                                <div class="contact-card">

                                    <div class="contact-card-icon">

                                        <i class="fa-solid fa-map-location-dot"></i>

                                    </div>

                                    <h3>
                                        Localização
                                    </h3>

                                    <p>

                                        Av. 20 de Dezembro,
                                        539 – Centro,
                                        Cerro Grande - RS.

                                    </p>

                                    <a
                                        href="https://www.google.com/maps/search/?api=1&query=Av.%2020%20de%20Dezembro%2C%20539%2C%20Cerro%20Grande%20-%20RS"
                                        target="_blank"
                                        class="contact-btn"
                                    >

                                        <i class="fa-solid fa-location-arrow"></i>

                                        Ver localização

                                    </a>

                                </div>

                            </div>


                        </div>



                        <!-- =========================
                             ASSUNTOS
                        ========================= -->

                        <div class="service-info">

                            <h3>
                                Como podemos ajudar?
                            </h3>

                            <p>

                                Para informações sobre a Associação
                                Científica Medeia, projetos, atividades,
                                publicações, serviços e assuntos
                                institucionais, utilize os canais de
                                contato apresentados nesta página.

                                <br><br>

                                Para conhecer melhor nosso trabalho,
                                consulte também as páginas
                                <strong>Sobre</strong>,
                                <strong>Serviços</strong> e
                                <strong>Publicações</strong>
                                disponíveis no site.

                            </p>

                        </div>


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
