<?php include 'includes_site/header.php'; ?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Serviços | Associação Científica Medeia</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: "Inter", sans-serif;
            background: #f8f2f9;
            color: #35152f;
        }

        a { text-decoration: none; }

        .page-header {
            padding: 80px 0;
            background: linear-gradient(120deg, #faf6fb, #eadcf1, #f7e8f0);
        }

        .page-header small {
            color: #7b2468;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .page-header h1 {
            margin: 12px 0;
            color: #42162f;
            font: 700 52px "Playfair Display", serif;
        }

        .page-header p {
            max-width: 600px;
            color: #706375;
            line-height: 1.8;
        }

        .services { padding: 75px 0; }

        .service-card {
            height: 100%;
            padding: 30px;
            background: #fff;
            border: 1px solid #e5d5ea;
            border-radius: 18px;
            box-shadow: 0 10px 28px #4619500d;
            transition: .3s;
        }

        .service-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 18px 35px #4619501c;
        }

        .service-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 58px;
            height: 58px;
            margin-bottom: 22px;
            border-radius: 15px;
            background: linear-gradient(135deg, #eadcf0, #f5dfe9);
            color: #762476;
            font-size: 23px;
        }

        .service-card h3 {
            margin-bottom: 12px;
            color: #42162f;
            font-size: 18px;
            font-weight: 700;
        }

        .service-card p {
            margin: 0;
            color: #706575;
            font-size: 13px;
            line-height: 1.8;
        }

        .service-link { display: block; height: 100%; }
        .service-link .service-card { height: 100%; }

        @media (max-width: 768px) {
            .page-header { padding: 60px 0; }
            .page-header h1 { font-size: 40px; }
            .services { padding: 50px 0; }
        }

        a,
a:hover,
a:focus,
a:active {
    text-decoration: none !important;
}
    </style>
</head>

<body>

    <section class="page-header">
        <div class="container">
            <small>Áreas de atuação</small>
            <h1>Nossos Serviços</h1>
            <p>Conheça as principais áreas de atuação da Associação Científica Medeia.</p>
        </div>
    </section>

    <section class="services">
        <div class="container">
            <div class="row g-4">

                <div class="col-lg-3 col-md-6">
                    <div class="service-card">
                        <div class="service-icon"><i class="fa-solid fa-book-open"></i></div>
                        <h3>Editora</h3>
                        <p>Publicação de livros, materiais acadêmicos e conteúdos para disseminar o conhecimento.</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="service-card">
                        <div class="service-icon"><i class="fa-solid fa-laptop"></i></div>
                        <h3>Revista Eletrônica</h3>
                        <p>Divulgação online de artigos científicos, pesquisas e produções acadêmicas.</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <a href="agencia_concursos.php" class="service-link">
                        <div class="service-card">
                            <div class="service-icon"><i class="fa-solid fa-clipboard-list"></i></div>
                            <h3>Agência de Concursos</h3>
                            <p>Organização e realização de concursos públicos e privados.</p>
                        </div>
                    </a>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="service-card">
                        <div class="service-icon"><i class="fa-solid fa-graduation-cap"></i></div>
                        <h3>Assessoria Pedagógica</h3>
                        <p>Consultoria e apoio em projetos educacionais, científicos e institucionais.</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <?php include 'includes_site/footer.php'; ?>

</body>
</html>