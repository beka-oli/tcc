<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Publicações | Associação Científica Medeia
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

            text-align: left;

            padding: 90px 0;

            position: relative;

            overflow: hidden;

            background:

                radial-gradient(
                    circle at 85% 20%,
                    rgba(192,74,145,.13),
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

            width: 150px;

            height: 150px;

            border-radius: 50%;

            background:
                rgba(123,31,162,.06);

            left: 7%;

            bottom: -70px;

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

            margin: 0;

            line-height: 1.8;

        }


        /* =========================
           PUBLICAÇÕES
        ========================= */

        .publications {

            padding: 90px 0;

        }


        .publication-card {

            height: 100%;

            background: #ffffff;

            border-radius: 20px;

            overflow: hidden;

            border: 1px solid #e5d6eb;

            box-shadow:
                0 12px 30px rgba(70,25,80,.07);

            transition: .35s;

        }


        .publication-card:hover {

            transform: translateY(-8px);

            box-shadow:
                0 22px 45px rgba(70,25,80,.14);

        }


        .publication-image {

            height: 230px;

            overflow: hidden;

        }


        .publication-image img {

            width: 100%;

            height: 100%;

            object-fit: cover;

            transition: .4s;

        }


        .publication-card:hover img {

            transform: scale(1.06);

        }


        .publication-content {

            padding: 28px;

        }


        .tag {

            display: inline-block;

            padding: 6px 12px;

            border-radius: 20px;

            background: #eadcf0;

            color: #743285;

            font-size: 10px;

            font-weight: 800;

            letter-spacing: 1px;

            text-transform: uppercase;

            margin-bottom: 14px;

        }


        .publication-content h3 {

            color: #42162f;

            font-size: 19px;

            font-weight: 700;

            margin-bottom: 12px;

        }


        .publication-content p {

            color: #706575;

            font-size: 13px;

            line-height: 1.8;

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


        /* =========================
           RESPONSIVO
        ========================= */

        @media(max-width:768px) {

            .page-header {

                padding: 65px 0;

            }


            .page-header h1 {

                font-size: 45px;

            }


            .publications {

                padding: 60px 0;

            }

        }


    </style>

</head>


<body>
<?php include 'includes_site/header.php'; ?>
    <!-- =========================
         HEADER
    ========================= -->

    <section class="page-header">

        <div class="container">


            <small>

                Produção intelectual

            </small>


            <h1>

                Publicações

            </h1>


            <p>

                Conteúdos e produções relacionados
                à ciência, educação e cultura.

            </p>


        </div>

    </section>



    <!-- =========================
         PUBLICAÇÕES
    ========================= -->

    <section class="publications">

        <div class="container">

            <div class="row g-4">


                <!-- PUBLICAÇÃO - EDITORA -->

                <div class="col-lg-4">

                    <div class="publication-card">


                        <div class="publication-image">

                            <img
                                src="https://images.unsplash.com/photo-1495446815901-a7297e633e8d?auto=format&fit=crop&w=900&q=85"
                                alt="Livros"
                            >

                        </div>


                        <div class="publication-content">


                            <span class="tag">

                                Editora

                            </span>


                            <h3>

                                Livros e materiais acadêmicos

                            </h3>


                            <p>

                                Publicações destinadas à divulgação
                                e compartilhamento do conhecimento
                                científico e acadêmico.

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