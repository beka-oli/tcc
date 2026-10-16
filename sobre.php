<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Sobre | Associação Científica Medeia
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

            background:
                rgba(255, 255, 255, 0.10);

        }


        .nav-admin {

            background:
                rgba(255, 255, 255, 0.12);

        }


        /* =========================
           CABEÇALHO
        ========================= */

        .page-header {

            padding: 90px 0;

            position: relative;

            overflow: hidden;

            background:

                radial-gradient(
                    circle at 85% 20%,
                    rgba(192, 74, 145, 0.14),
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

            width: 180px;

            height: 180px;

            border-radius: 50%;

            background:
                rgba(123, 31, 162, 0.06);

            top: -70px;

            left: 8%;

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

            max-width: 650px;

            line-height: 1.8;

        }


        /* =========================
           SOBRE
        ========================= */

        .about {

            padding: 100px 0;

        }


        .about-image {

            width: 100%;

            height: 500px;

            object-fit: cover;

            border-radius: 24px;

            box-shadow:
                0 25px 55px rgba(70, 25, 80, 0.14);

        }


        .about-content {

            padding-left: 55px;

        }


        .about-content h2 {

            font-family: "Playfair Display", serif;

            color: #42162f;

            font-size: 40px;

            line-height: 1.2;

            margin-bottom: 22px;

        }


        .about-content p {

            color: #6d6272;

            font-size: 14px;

            line-height: 1.9;

        }


        .about-item {

            display: flex;

            align-items: center;

            gap: 12px;

            padding: 13px 15px;

            margin-top: 12px;

            background: #f0e3f4;

            border-radius: 10px;

            color: #60306e;

            font-size: 13px;

            font-weight: 600;

        }


        .about-item i {

            color: #a7357d;

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


        /* =========================
           RESPONSIVO
        ========================= */

        @media(max-width:768px) {

            .about-content {

                padding-left: 0;

                margin-top: 40px;

            }


            .about-image {

                height: 350px;

            }

        }


    </style>

</head>


<body>
<?php include 'includes_site/header.php'; ?>

    <!-- =========================
         CABEÇALHO
    ========================= -->

    <section class="page-header">

        <div class="container">


            <small>

                Sobre a organização

            </small>


            <h1>

                Quem Somos

            </h1>


            <p>

                Conheça a Associação Científica Medeia,
                sua atuação, seus objetivos e seu compromisso
                com a ciência, a educação e a cultura.

            </p>


        </div>

    </section>



    <!-- =========================
         SOBRE
    ========================= -->

    <section class="about">

        <div class="container">

            <div class="row align-items-center">


                <div class="col-lg-6">


                    <img
                        src="https://images.unsplash.com/photo-1524178232363-1fb2b075b655?auto=format&fit=crop&w=1000&q=85"
                        class="about-image"
                        alt="Educação"
                    >


                </div>



                <div class="col-lg-6">


                    <div class="about-content">


                        <h2>

                            Conhecimento que gera transformação.

                        </h2>


                        <p>

                            A Associação Científica Medeia é uma
                            organização de caráter cultural,
                            pedagógico e midiático, dedicada à
                            promoção da ciência, educação,
                            formação e produção de conhecimento.

                        </p>


                        <p>

                            Por meio de projetos, publicações,
                            atividades formativas e ações
                            institucionais, busca contribuir
                            para o desenvolvimento científico,
                            educacional e cultural da sociedade.

                        </p>


                        <div class="about-item">

                            <i class="fa-solid fa-check"></i>

                            Promoção da ciência e pesquisa

                        </div>


                        <div class="about-item">

                            <i class="fa-solid fa-check"></i>

                            Desenvolvimento educacional

                        </div>


                        <div class="about-item">

                            <i class="fa-solid fa-check"></i>

                            Produção e disseminação de conhecimento

                        </div>


                        <div class="about-item">

                            <i class="fa-solid fa-check"></i>

                            Projetos culturais e pedagógicos

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
