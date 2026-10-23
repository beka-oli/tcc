
<!-- FOOTER -->
<footer class="footer-custom">
    <div class="container">

        <div class="row gy-4 footer-content">

            <!-- Identidade -->
            <div class="col-lg-6 col-md-12 footer-brand">
                <h4>
                    Associação Científica
                    <span>Medeia</span>
                </h4>

                <p>
                    Promovendo o desenvolvimento científico,
                    a inovação, a pesquisa e a disseminação
                    do conhecimento.
                </p>
            </div>

            <!-- Institucional -->
            <div class="col-lg-3 col-md-6">
                <h5 class="footer-title">Institucional</h5>

                <ul class="footer-links">
                    <li><a href="index.php">Início</a></li>
                    <li><a href="sobre.php">Sobre</a></li>
                    <li><a href="servicos.php">Serviços</a></li>
                    <li><a href="publicacoes.php">Publicações</a></li>
                </ul>
            </div>

            <!-- Contato -->
            <div class="col-lg-3 col-md-6">
                <h5 class="footer-title">Contato</h5>

                <p class="footer-contact">
                    <i class="fas fa-envelope"></i>
                    <a href="mailto:associacaocientificamedeia@gmail.com">
                        associacaocientificamedeia@gmail.com
                    </a>
                </p>

                <p class="footer-contact">
                    <i class="fas fa-phone"></i>
                    <a href="tel:+5555991012088">
                        (55) 99135-3429
                    </a>
                </p>
            </div>

        </div>

        <!-- Rodapé inferior -->
        <div class="footer-bottom">
            <p>
                © 2026 Associação Científica Medeia.
                Todos os direitos reservados.
            </p>
        </div>

    </div>
</footer>
<style>

/* =========================
   FOOTER - MEDEIA
========================= */

.footer-custom {
    position: relative;
    overflow: hidden;
    margin-top: 60px;
    padding: 55px 0 0;
    background: linear-gradient(
        135deg,
        #4b0028 0%,
        #700037 55%,
        #480052 100%
    );
    color: #f8f4f7;
    border-top: 3px solid transparent;
    border-image: linear-gradient(
        90deg,
        #ff1744,
        #e00091,
        #7200ff
    ) 1;
}

/* Brilho decorativo superior */
.footer-custom::before {
    content: "";
    position: absolute;
    top: 0;
    left: 10%;
    width: 80%;
    height: 1px;
    background: linear-gradient(
        90deg,
        transparent,
        rgba(255, 255, 255, 0.35),
        transparent
    );
}

.footer-content {
    padding-bottom: 35px;
}

/* Nome da associação */
.footer-brand h4 {
    font-size: 1.45rem;
    font-weight: 700;
    color: #ffffff;
    margin-bottom: 18px;
    letter-spacing: 0.3px;
}

.footer-brand h4 span {
    background: linear-gradient(
        90deg,
        #ff526f,
        #ff36b5,
        #b58aff
    );
    -webkit-background-clip: text;
    background-clip: text;
    -webkit-text-fill-color: transparent;
}

.footer-brand p {
    max-width: 440px;
    color: #e4d5df;
    line-height: 1.8;
    font-size: 0.95rem;
    margin-bottom: 0;
}

/* Títulos das colunas */
.footer-title {
    position: relative;
    display: inline-block;
    color: #ffffff;
    font-size: 1.05rem;
    font-weight: 700;
    margin-bottom: 22px;
    padding-bottom: 10px;
}

.footer-title::after {
    content: "";
    position: absolute;
    left: 0;
    bottom: 0;
    width: 38px;
    height: 3px;
    border-radius: 10px;
    background: linear-gradient(
        90deg,
        #ff1744,
        #a000ff
    );
}

/* Links institucionais */
.footer-links {
    list-style: none;
    padding: 0;
    margin: 0;
}

.footer-links li {
    margin-bottom: 12px;
}

.footer-links a {
    color: #e4d5df;
    text-decoration: none;
    font-size: 0.94rem;
    transition: color 0.25s ease,
                padding-left 0.25s ease;
}

.footer-links a:hover {
    color: #ff70c8;
    padding-left: 6px;
}

/* Informações de contato */
.footer-contact {
    display: flex;
    align-items: flex-start;
    gap: 11px;
    color: #e4d5df;
    font-size: 0.9rem;
    line-height: 1.7;
    overflow-wrap: anywhere;
    margin-bottom: 14px;
}

.footer-contact i {
    color: #ff65bd;
    font-size: 1rem;
    margin-top: 4px;
    min-width: 16px;
}

.footer-contact a {
    color: #e4d5df;
    text-decoration: none;
    transition: color 0.25s ease;
}

.footer-contact a:hover {
    color: #ffffff;
}

/* Faixa inferior */
.footer-bottom {
    padding: 22px 0;
    text-align: center;
    border-top: 1px solid rgba(255, 255, 255, 0.14);
}

.footer-bottom p {
    margin: 0;
    color: #cdb8c8;
    font-size: 0.85rem;
    line-height: 1.7;
}

/* Responsividade */
@media (max-width: 767px) {
    .footer-custom {
        margin-top: 40px;
        padding-top: 40px;
    }

    .footer-content {
        padding-bottom: 25px;
    }

    .footer-brand h4 {
        font-size: 1.25rem;
    }

    .footer-title {
        margin-bottom: 16px;
    }

    .footer-contact a {
        word-break: break-word;
    }
}

</style>