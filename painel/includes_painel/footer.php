<footer class="footer-custom">

    <div class="container">

        <div class="row gy-4">

            <div class="col-lg-5">

                <h4>Associação Científica</h4>

                <p>
                    Promovendo o desenvolvimento científico, a inovação,
                    a pesquisa e a disseminação do conhecimento por meio
                    de projetos, eventos e ações voltadas à comunidade.
                </p>

            </div>

            <div class="col-lg-3">

                <h5>Institucional</h5>

                <ul class="footer-links">
                    <li><a href="index.php">Início</a></li>
                    <li><a href="#">Quem Somos</a></li>
                    <li><a href="#">Projetos</a></li>
                    <li><a href="#">Publicações</a></li>
                </ul>

            </div>

            <div class="col-lg-4">

                <h5>Contato</h5>

                <p>
                    <i class="fas fa-envelope"></i>
                    contato@associacao.org.br
                </p>

                <p>
                    <i class="fas fa-phone"></i>
                    (00) 0000-0000
                </p>

                <p>
                    <i class="fas fa-location-dot"></i>
                    Cidade - Estado
                </p>

            </div>

        </div>

        <div class="footer-bottom">

            <span>
                © 2026 Associação Científica. Todos os direitos reservados.
            </span>

            <span>
                Desenvolvido por Rebeka de Oliveira
            </span>

        </div>

    </div>

</footer>
<style>
    .footer-custom{

    margin-top:90px;

    background:linear-gradient(90deg,
        #c1274d,
        #b11f67,
        #9a1f88,
        #7b1fa2);

    color:#fff;

    padding:70px 0 25px;

    position:relative;

    overflow:hidden;
}

/* efeito de brilho */

.footer-custom::before{

    content:"";

    position:absolute;

    width:350px;
    height:350px;

    background:rgba(255,255,255,.08);

    border-radius:50%;

    top:-140px;
    right:-120px;
}

.footer-custom::after{

    content:"";

    position:absolute;

    width:250px;
    height:250px;

    background:rgba(255,255,255,.05);

    border-radius:50%;

    bottom:-120px;
    left:-90px;
}

.footer-custom .container{

    position:relative;

    z-index:2;
}

.footer-custom h2{

    font-size:2.2rem;

    font-weight:700;

    margin-bottom:18px;
}

.footer-custom h5{

    font-size:1rem;

    text-transform:uppercase;

    letter-spacing:2px;

    margin-bottom:22px;

    opacity:.9;
}

.footer-custom p{

    font-size:15px;

    line-height:1.9;

    opacity:.9;
}

.footer-custom ul{

    list-style:none;

    padding:0;
}

.footer-custom li{

    margin-bottom:14px;
}

.footer-custom a{

    color:#fff;

    text-decoration:none;

    transition:.3s;
}

.footer-custom a:hover{

    opacity:.75;

    padding-left:6px;
}

.info{

    margin-bottom:16px;

    display:flex;

    align-items:center;

    gap:12px;

    opacity:.95;
}

.info i{

    width:38px;
    height:38px;

    background:rgba(255,255,255,.15);

    border-radius:50%;

    display:flex;

    align-items:center;

    justify-content:center;
}

.footer-bottom{

    margin-top:50px;

    border-top:1px solid rgba(255,255,255,.15);

    padding-top:20px;

    text-align:center;

    font-size:14px;

    opacity:.8;
}
</style>