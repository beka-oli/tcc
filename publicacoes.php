
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Publicações | Associação Científica Medeia</title>

    <!-- Bootstrap -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <!-- Fontes -->
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/tcc/assets/css/site.css">
</head>

<body data-page="publicacoes">

    <!-- HEADER COMPARTILHADO -->
    <?php include 'includes_site/header.php'; ?>

    <!-- APRESENTAÇÃO -->
    <section class="page-header">
        <div class="container">

            <small>Produção intelectual</small>

            <h1>Publicações</h1>

            <p>
                Conheça os conteúdos e as produções relacionados
                à ciência, à educação e à cultura, promovendo
                a disseminação do conhecimento.
            </p>

        </div>
    </section>

    <!-- PUBLICAÇÕES -->
    <section class="publications">
        <div class="container">

            <div class="section-heading">
                <span>Conhecimento e pesquisa</span>

                <h2>Nossas Publicações</h2>

                <p>
                    Explore as iniciativas editoriais e os materiais
                    acadêmicos vinculados à Associação Científica Medeia.
                </p>
            </div>

            <div class="row g-4">

                <!-- EDITORA -->
                <div class="col-lg-4 col-md-6">

                    <article class="publication-card">

                        <div class="publication-image">
                            <img
                                src="https://images.unsplash.com/photo-1495446815901-a7297e633e8d?auto=format&fit=crop&w=900&q=85"
                                alt="Livros organizados em uma estante"
                                loading="lazy"
                            >
                        </div>

                        <div class="publication-content">

                            <span class="tag">Editora</span>

                            <h3>
                                Livros e materiais acadêmicos
                            </h3>

                            <p>
                                Publicações destinadas à divulgação
                                e ao compartilhamento do conhecimento
                                científico, acadêmico e educacional.
                            </p>

                            <a
                                href="servicos.php"
                                class="publication-link"
                            >
                                Conheça nossos serviços
                                <i class="fa-solid fa-arrow-right"
                                   aria-hidden="true"></i>
                            </a>

                        </div>

                    </article>

                </div>

                <!-- REVISTAS CIENTÍFICAS -->
                <div class="col-lg-4 col-md-6">

                    <article class="publication-card">

                        <div class="publication-image">
                            <img
                                src="https://images.unsplash.com/photo-1507842217343-583bb7270b66?auto=format&fit=crop&w=900&q=85"
                                alt="Biblioteca com livros e materiais de pesquisa"
                                loading="lazy"
                            >
                        </div>

                        <div class="publication-content">

                            <span class="tag">Revistas científicas</span>

                            <h3>
                                Pesquisa e produção científica
                            </h3>

                            <p>
                                Espaço dedicado à divulgação de artigos,
                                pesquisas e trabalhos que contribuem
                                para a produção do conhecimento.
                            </p>

                            <a
                                href="servicos.php"
                                class="publication-link"
                            >
                                Conheça nossas iniciativas
                                <i class="fa-solid fa-arrow-right"
                                   aria-hidden="true"></i>
                            </a>

                        </div>

                    </article>

                </div>

                <!-- CONCURSOS -->
                <div class="col-lg-4 col-md-6">

                    <article class="publication-card">

                        <div class="publication-image">
                            <img
                                src="https://images.unsplash.com/photo-1434030216411-0b793f4b4173?auto=format&fit=crop&w=900&q=85"
                                alt="Materiais de estudo sobre uma mesa"
                                loading="lazy"
                            >
                        </div>

                        <div class="publication-content">

                            <span class="tag">Concursos</span>

                            <h3>
                                Informações e oportunidades
                            </h3>

                            <p>
                                Conheça as iniciativas relacionadas
                                à organização de concursos e às
                                oportunidades disponibilizadas.
                            </p>

                            <a
                                href="agencia_concursos.php"
                                class="publication-link"
                            >
                                Acessar agência de concursos
                                <i class="fa-solid fa-arrow-right"
                                   aria-hidden="true"></i>
                            </a>

                        </div>

                    </article>

                </div>

            </div>

        </div>
    </section>

    <!-- FOOTER COMPARTILHADO -->
    <?php include 'includes_site/footer.php'; ?>

</body>
</html>
