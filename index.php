
<?php include 'includes_site/header.php'; ?>


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
       RESPONSIVO
    ========================= */

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


<!-- =========================
     HERO
========================= -->

<section class="hero">

    <div class="container">

        <div class="row align-items-center">


            <!-- TEXTO -->

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


            <!-- IMAGEM -->

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


<!-- FOOTER -->

<?php include 'includes_site/footer.php'; ?>


</body>

</html>
