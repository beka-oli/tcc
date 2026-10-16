<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Agência de Concursos | AC Medeia</title>

    <!-- Fontes -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

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

        /* =========================
           NAVBAR
        ========================= */

        .navbar {
            height: 85px;
            background: linear-gradient(
                90deg,
                #67012a,
                #70145c,
                #7b1fa2
            );

            display: flex;
            align-items: center;
        }

        .nav-container {
            width: 100%;
            max-width: 1500px;
            margin: auto;
            padding: 0 60px;

            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .logo-area {
            display: flex;
            align-items: center;
            gap: 14px;

            color: white;
            font-size: 23px;
            font-weight: 800;
        }

        .logo {
            width: 52px;
            height: 52px;

            border-radius: 15px;

            display: flex;
            align-items: center;
            justify-content: center;

            background: linear-gradient(
                135deg,
                #8e2a8f,
                #c04a91
            );

            color: white;
            font-size: 23px;
        }

        .menu {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .menu a {
            color: #fff;
            font-size: 15px;
            font-weight: 600;

            padding: 12px 15px;
            border-radius: 10px;

            transition: .3s;
        }

        .menu a:hover {
            background: rgba(255,255,255,.12);
        }

        .admin {
            background: rgba(255,255,255,.14);
        }

        /* =========================
           HERO
        ========================= */

        .hero {
            min-height: 650px;

            position: relative;
            overflow: hidden;

            display: flex;
            align-items: center;

            background:
                radial-gradient(
                    circle at 10% 35%,
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

        .hero::before {
            content: "";

            position: absolute;

            width: 220px;
            height: 220px;

            border-radius: 50%;

            background: rgba(192,74,145,.07);

            top: -100px;
            right: 15%;
        }

        .hero::after {
            content: "";

            position: absolute;

            width: 150px;
            height: 150px;

            border-radius: 50%;

            background: rgba(123,31,162,.07);

            bottom: -70px;
            left: 5%;
        }

        .hero-container {
            width: 100%;
            max-width: 1500px;

            margin: auto;
            padding: 70px 60px;

            display: grid;
            grid-template-columns: 1fr 1fr;

            gap: 70px;

            align-items: center;

            position: relative;
            z-index: 2;
        }

        /* =========================
           TEXTO
        ========================= */

        .tag {
            display: inline-block;

            padding: 11px 20px;

            border-radius: 30px;

            background: #ead8ef;

            color: #7b2468;

            font-size: 12px;
            font-weight: 800;

            letter-spacing: 2px;
            text-transform: uppercase;

            margin-bottom: 25px;
        }

        .hero h1 {
            font-family: "Playfair Display", serif;

            font-size: clamp(48px, 5vw, 72px);

            line-height: 1.05;

            color: #42162f;

            margin-bottom: 25px;
        }

        .hero h1 span {
            background: linear-gradient(
                90deg,
                #7b1fa2,
                #c04a91
            );

            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .subtitle {
            color: #7b2468;

            font-size: 20px;
            font-weight: 700;

            margin-bottom: 18px;
        }

        .description {
            color: #706375;

            font-size: 16px;

            line-height: 1.8;

            max-width: 600px;

            margin-bottom: 30px;
        }

        /* =========================
           BOTÃO
        ========================= */

        .btn {
            display: inline-flex;

            align-items: center;
            gap: 10px;

            padding: 14px 22px;

            border-radius: 12px;

            background: linear-gradient(
                135deg,
                #7b1fa2,
                #c04a91
            );

            color: white;

            font-weight: 700;

            box-shadow:
                0 10px 25px rgba(123,31,162,.22);

            transition: .3s;
        }

        .btn:hover {
            transform: translateY(-3px);

            box-shadow:
                0 15px 30px rgba(123,31,162,.30);

            color: white;
        }

        /* =========================
           CARD DIREITO
        ========================= */

        .hero-card {
            min-height: 430px;

            padding: 45px;

            border-radius: 30px;

            background: rgba(255,255,255,.75);

            border: 1px solid rgba(255,255,255,.8);

            box-shadow:
                0 25px 60px rgba(70,25,80,.12);

            backdrop-filter: blur(8px);

            display: flex;

            align-items: center;
            justify-content: center;

            position: relative;

            overflow: hidden;
        }

        .hero-card::before {
            content: "";

            position: absolute;

            width: 180px;
            height: 180px;

            border-radius: 50%;

            background: #eadcf0;

            top: -80px;
            right: -50px;
        }

        .card-content {
            position: relative;
            z-index: 2;

            text-align: center;
        }

        .big-icon {
            width: 110px;
            height: 110px;

            margin: auto auto 25px;

            border-radius: 30px;

            display: flex;
            align-items: center;
            justify-content: center;

            background: linear-gradient(
                135deg,
                #eadcf0,
                #f5dfe9
            );

            color: #762476;

            font-size: 48px;

            box-shadow:
                0 15px 30px rgba(123,31,162,.10);
        }

        .hero-card h2 {
            font-family: "Playfair Display", serif;

            font-size: 34px;

            color: #42162f;

            margin-bottom: 15px;
        }

        .hero-card p {
            color: #706575;

            line-height: 1.7;

            max-width: 420px;
        }

        /* =========================
           SERVIÇOS
        ========================= */

        .services {
            padding: 90px 60px;

            background: #fbf7fc;
        }

        .section-title {
            text-align: center;

            margin-bottom: 50px;
        }

        .section-title small {
            color: #7b2468;

            font-size: 11px;
            font-weight: 800;

            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .section-title h2 {
            font-family: "Playfair Display", serif;

            font-size: 45px;

            color: #42162f;

            margin-top: 10px;
        }

        .cards {
            max-width: 1200px;

            margin: auto;

            display: grid;

            grid-template-columns:
                repeat(3, 1fr);

            gap: 25px;
        }

        .card {
            padding: 30px;

            background: white;

            border-radius: 20px;

            border: 1px solid #e5d5ea;

            box-shadow:
                0 12px 30px rgba(70,25,80,.07);

            transition: .3s;
        }

        .card:hover {
            transform: translateY(-7px);

            box-shadow:
                0 20px 40px rgba(70,25,80,.13);
        }

        .card-icon {
            width: 55px;
            height: 55px;

            border-radius: 14px;

            display: flex;
            align-items: center;
            justify-content: center;

            background: #eadcf0;

            color: #762476;

            font-size: 21px;

            margin-bottom: 20px;
        }

        .card h3 {
            color: #42162f;

            font-size: 18px;

            margin-bottom: 10px;
        }

        .card p {
            color: #706575;

            font-size: 14px;

            line-height: 1.7;
        }

        /* =========================
           FOOTER
        ========================= */

        footer {
            padding: 35px 20px;

            text-align: center;

            background: linear-gradient(
                90deg,
                #67012a,
                #7b1f70,
                #7b1fa2
            );

            color: white;

            font-size: 13px;
        }

        /* =========================
           RESPONSIVO
        ========================= */

        @media(max-width: 900px) {

            .nav-container {
                padding: 0 25px;
            }

            .menu a:not(.admin) {
                display: none;
            }

            .hero-container {
                grid-template-columns: 1fr;

                padding: 70px 30px;
            }

            .hero-card {
                min-height: 350px;
            }

            .cards {
                grid-template-columns: 1fr;
            }

            .services {
                padding: 70px 30px;
            }
        }

    </style>

</head>

<body>
 <?php include 'includes_site/header.php'; ?>