<footer class="footer-custom">

    <div class="container">

        <div class="row gy-4">

            <div class="col-lg-5">

                <h4>Associação Científica</h4>

                <p>
                    Painel administrativo destinado ao gerenciamento
                    de revistas científicas, livros, autores,
                    concursos, inscrições e demais conteúdos
                    da Associação Científica.
                </p>

            </div>


            <div class="col-lg-3">

                <h5>PAINEL ADMINISTRATIVO</h5>

                <ul class="footer-links">

                    <li>
                        <a href="index.php">
                            <i class="fas fa-house"></i>
                            Início
                        </a>
                    </li>

                    <li>
                        <a href="#">
                            <i class="fas fa-plus-circle"></i>
                            Cadastros
                        </a>
                    </li>

                    <li>
                        <a href="#">
                            <i class="fas fa-list"></i>
                            Listar registros
                        </a>
                    </li>

                    <li>
                        <a href="#">
                            <i class="fas fa-gear"></i>
                            Configurações
                        </a>
                    </li>

                </ul>

            </div>


            <div class="col-lg-4">

                <h5>SISTEMA</h5>

                <p>
                    <i class="fas fa-user-shield"></i>
                    Área restrita do administrador
                </p>

                <p>
                    <i class="fas fa-database"></i>
                    Gerenciamento de informações
                </p>

                <p>
                    <i class="fas fa-circle-check"></i>
                    Sistema operacional
                </p>

            </div>

        </div>


        <div class="footer-bottom">

            <span>
                © 2026 Associação Científica
            </span>

            <span>
                Painel Administrativo • Versão 1.0
            </span>

        </div>

    </div>

</footer>
<style>
    .footer-custom {
    margin-top: 60px;
    background: linear-gradient(
        135deg,
        #b51f4f 0%,
        #a21f72 50%,
        #7620a0 100%
    );

    color: #fff;
    padding: 45px 0 20px;
    position: relative;
    overflow: hidden;
}


/* EFEITOS DECORATIVOS */

.footer-custom::before {
    content: "";
    position: absolute;

    width: 300px;
    height: 300px;

    background: rgba(255,255,255,.08);

    border-radius: 50%;

    top: -160px;
    right: -80px;
}

.footer-custom::after {
    content: "";
    position: absolute;

    width: 220px;
    height: 220px;

    background: rgba(255,255,255,.06);

    border-radius: 50%;

    bottom: -140px;
    left: -80px;
}


/* CONTEÚDO */

.footer-custom .container {
    position: relative;
    z-index: 2;
}


/* TÍTULOS */

.footer-custom h4 {
    color: #fff;

    font-size: 1.6rem;
    font-weight: 700;

    margin-bottom: 15px;
}

.footer-custom h5 {
    color: #fff;

    font-size: .95rem;

    text-transform: uppercase;

    letter-spacing: 2px;

    margin-bottom: 20px;

    font-weight: 700;
}


/* TEXTOS */

.footer-custom p {
    color: rgba(255,255,255,.90);

    font-size: 14px;

    line-height: 1.8;
}


/* LINKS */

.footer-custom ul {
    list-style: none;

    padding: 0;
    margin: 0;
}

.footer-custom li {
    margin-bottom: 13px;
}

.footer-custom a {
    color: #fff !important;

    text-decoration: none;

    font-size: 14px;

    font-weight: 500;

    transition: .3s;
}

.footer-custom a:hover {
    color: #fff;

    opacity: .75;

    padding-left: 6px;
}

.footer-custom a i {
    width: 22px;
}


/* INFORMAÇÕES */

.footer-custom .info {
    display: flex;

    align-items: center;

    gap: 10px;

    margin-bottom: 12px;

    color: rgba(255,255,255,.90);
}

.footer-custom .info i {
    width: 32px;
    height: 32px;

    display: flex;

    align-items: center;
    justify-content: center;

    background: rgba(255,255,255,.14);

    border-radius: 8px;

    color: #fff;
}


/* LINHA INFERIOR */

.footer-bottom {
    margin-top: 30px;

    padding-top: 18px;

    border-top: 1px solid rgba(255,255,255,.22);

    display: flex;

    justify-content: space-between;

    align-items: center;

    color: rgba(255,255,255,.80);

    font-size: 13px;
}


/* RESPONSIVO */

@media (max-width: 768px) {

    .footer-custom {
        padding: 35px 0 20px;
    }

    .footer-bottom {
        flex-direction: column;

        gap: 8px;

        text-align: center;
    }
}
</style>