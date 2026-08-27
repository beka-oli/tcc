<nav class="navbar navbar-expand-lg navbar-dark navbar-custom">

    <div class="container-fluid">

        <!-- BOTÃO MOBILE -->
        <button class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#menu"
                aria-controls="menu"
                aria-expanded="false"
                aria-label="Abrir menu">

            <span class="navbar-toggler-icon"></span>

        </button>


        <div class="collapse navbar-collapse" id="menu">

            <ul class="navbar-nav">

                <!-- ================= INÍCIO ================= -->

                <li class="nav-item">

                    <a class="nav-link active" href="dashboard.php">

                        <i class="fas fa-house"></i>
                        Início

                    </a>

                </li>


                <!-- ================= CADASTRO ================= -->

                <li class="nav-item dropdown">

                    <a class="nav-link dropdown-toggle"
                       href="#"
                       role="button"
                       data-bs-toggle="dropdown"
                       aria-expanded="false">

                        <i class="fas fa-folder-plus"></i>
                        Cadastro

                    </a>


                    <ul class="dropdown-menu">

                        <li>
                            <h6 class="dropdown-header">
                                <i class="fas fa-folder-plus"></i>
                                Cadastros
                            </h6>
                        </li>


                        <!-- REVISTAS -->

                        <li>
                            <a class="dropdown-item" href="form_revista.php">
                                <i class="fas fa-book-open"></i>
                                Revistas
                            </a>
                        </li>


                        <!-- LIVROS -->

                        <li>
                            <a class="dropdown-item" href="form_livros.php">
                                <i class="fas fa-book"></i>
                                Livros
                            </a>
                        </li>


                        <!-- CONCURSOS -->

                        <li>
                            <a class="dropdown-item" href="form_concurso.php">
                                <i class="fas fa-award"></i>
                                Concursos
                            </a>
                        </li>


                        <li>
                            <hr class="dropdown-divider">
                        </li>


                        <!-- REVISTAS CIENTÍFICAS -->

                        <li>
                            <h6 class="dropdown-header">
                                <i class="fas fa-flask"></i>
                                Revistas Científicas
                            </h6>
                        </li>


                        <!-- EDIÇÕES -->

                        <li>
                            <a class="dropdown-item" href="form_edicao.php">
                                <i class="fas fa-copy"></i>
                                Edições
                            </a>
                        </li>


                        <!-- ARTIGOS -->

                        <li>
                            <a class="dropdown-item" href="form_artigo.php">
                                <i class="fas fa-file-lines"></i>
                                Artigos
                            </a>
                        </li>


                        <!-- AUTORES -->

                        <li>
                            <a class="dropdown-item" href="form_autor.php">
                                <i class="fas fa-pen-nib"></i>
                                Autores
                            </a>
                        </li>


                        <li>
                            <hr class="dropdown-divider">
                        </li>


                        <!-- CONCURSOS -->

                        <li>
                            <h6 class="dropdown-header">
                                <i class="fas fa-award"></i>
                                Concursos
                            </h6>
                        </li>


                        <!-- INSCRIÇÕES -->

                        <li>
                            <a class="dropdown-item" href="inscricoes.php">
                                <i class="fas fa-clipboard-list"></i>
                                Inscrições
                            </a>
                        </li>


                        <!-- RESULTADOS -->

                        <li>
                            <a class="dropdown-item" href="resultados.php">
                                <i class="fas fa-chart-column"></i>
                                Resultados
                            </a>
                        </li>

                    </ul>

                </li>


                <!-- ================= LISTAR ================= -->

                <li class="nav-item dropdown">

                    <a class="nav-link dropdown-toggle"
                       href="#"
                       role="button"
                       data-bs-toggle="dropdown"
                       aria-expanded="false">

                        <i class="fas fa-list-check"></i>
                        Listar

                    </a>


                    <ul class="dropdown-menu">

                        <li>
                            <h6 class="dropdown-header">
                                <i class="fas fa-list"></i>
                                Listagens
                            </h6>
                        </li>


                        <!-- REVISTAS -->

                        <li>
                            <a class="dropdown-item"
                               href="lista_revistas.php">

                                <i class="fas fa-book-open"></i>
                                Revistas

                            </a>
                        </li>


                        <!-- LIVROS -->

                        <li>
                            <a class="dropdown-item"
                               href="lista_livros.php">

                                <i class="fas fa-book"></i>
                                Livros

                            </a>
                        </li>


                        <!-- EDIÇÕES -->

                        <li>
                            <a class="dropdown-item"
                               href="lista_edicoes.php">

                                <i class="fas fa-copy"></i>
                                Edições

                            </a>
                        </li>


                        <!-- ARTIGOS -->

                        <li>
                            <a class="dropdown-item"
                               href="lista_artigos.php">

                                <i class="fas fa-file-lines"></i>
                                Artigos

                            </a>
                        </li>


                        <!-- AUTORES -->

                        <li>
                            <a class="dropdown-item"
                               href="lista_autores.php">

                                <i class="fas fa-pen-nib"></i>
                                Autores

                            </a>
                        </li>


                        <li>
                            <hr class="dropdown-divider">
                        </li>


                        <!-- CONCURSOS -->

                        <li>
                            <a class="dropdown-item"
                               href="lista_concursos.php">

                                <i class="fas fa-award"></i>
                                Concursos

                            </a>
                        </li>


                        <!-- INSCRIÇÕES -->

                        <li>
                            <a class="dropdown-item"
                               href="lista_inscricoes.php">

                                <i class="fas fa-clipboard-list"></i>
                                Inscrições

                            </a>
                        </li>


                        <!-- RESULTADOS -->

                        <li>
                            <a class="dropdown-item"
                               href="lista_resultados.php">

                                <i class="fas fa-chart-column"></i>
                                Resultados

                            </a>
                        </li>

                    </ul>

                </li>

            </ul>


            <!-- ================= SAIR ================= -->

            <a href="logout.php" class="btn btn-logout">

                <i class="fas fa-right-from-bracket"></i>
                Sair

            </a>

        </div>

    </div>

</nav>


<style>

/* =====================================================
   CORES
===================================================== */

:root {

    --gradient: linear-gradient(
        90deg,
        #b91c3c,
        #a21caf,
        #7c3aed
    );

}


/* =====================================================
   NAVBAR
===================================================== */

.navbar-custom {

    background: var(--gradient);

    min-height: 72px;

    padding: 0 30px;

    box-shadow:
        0 5px 18px rgba(0,0,0,.15);

}


/* =====================================================
   CONTAINER DA NAVBAR
===================================================== */

.navbar-custom .container-fluid {

    display: flex;

    align-items: center;

}


/* =====================================================
   MENU PRINCIPAL
===================================================== */

.navbar-collapse {

    display: flex !important;

    flex-direction: row;

    align-items: center;

    width: 100%;

    flex-wrap: nowrap;

}


/* =====================================================
   LISTA DO MENU
===================================================== */

.navbar-nav {

    margin-left: 40px;

    display: flex !important;

    flex-direction: row !important;

    align-items: center;

    flex-wrap: nowrap !important;

    gap: 10px;

}


/* =====================================================
   ITENS
===================================================== */

.nav-item {

    margin: 0 4px;

}


/* =====================================================
   LINKS
===================================================== */

.nav-link {

    color: rgba(255,255,255,.9) !important;

    font-size: 15px;

    font-weight: 500;

    padding: 10px 18px !important;

    border-radius: 999px;

    transition: .3s;

    white-space: nowrap;

}


/* HOVER */

.nav-link:hover {

    background: rgba(255,255,255,.15);

}


/* ITEM ATIVO */

.nav-link.active {

    background: #fff;

    color: #9f1239 !important;

    font-weight: 600;

}


/* =====================================================
   DROPDOWN
===================================================== */

.dropdown-menu {

    border: none;

    border-radius: 16px;

    padding: 10px;

    margin-top: 12px;

    min-width: 260px;

    max-height: 500px;

    overflow-y: auto;

    box-shadow:
        0 18px 40px rgba(0,0,0,.18);

}


/* CABEÇALHO DO DROPDOWN */

.dropdown-header {

    color: #9f1239;

    font-size: 13px;

    font-weight: 700;

    padding: 8px 13px;

}


/* ITENS DO DROPDOWN */

.dropdown-item {

    border-radius: 10px;

    font-size: 14px;

    padding: 9px 13px;

}


/* ÍCONES */

.dropdown-item i {

    width: 22px;

    margin-right: 4px;

}


/* HOVER */

.dropdown-item:hover {

    background: var(--gradient);

    color: #fff;

}


/* DIVISOR */

.dropdown-divider {

    margin: 8px 0;

}


/* =====================================================
   BOTÃO SAIR
===================================================== */

.btn-logout {

    background: #fff;

    color: #9f1239;

    border: none;

    border-radius: 999px;

    padding: 10px 24px;

    font-size: 14px;

    font-weight: 600;

    transition: .3s;

    margin-left: auto !important;

    white-space: nowrap;

    flex-shrink: 0;

    text-decoration: none;

}


/* HOVER BOTÃO SAIR */

.btn-logout:hover {

    background: #fff;

    color: #b91c3c;

    transform: translateY(-2px);

    box-shadow:
        0 10px 25px rgba(0,0,0,.15);

}


/* =====================================================
   BOTÃO MOBILE
===================================================== */

.navbar-toggler {

    border: none;

    padding: 8px 10px;

}


.navbar-toggler:focus {

    box-shadow: none;

}


/* =====================================================
   MOBILE
===================================================== */

@media (max-width: 991px) {

    .navbar-custom {

        min-height: auto;

        height: auto;

        padding: 10px 20px;

    }


    /* MENU MOBILE */

    .navbar-collapse {

        flex-direction: column !important;

        align-items: stretch;

        width: 100%;

    }


    /* LISTA MOBILE */

    .navbar-nav {

        margin-left: 0;

        width: 100%;

        flex-direction: column !important;

        align-items: stretch;

        gap: 5px;

    }


    /* LINKS MOBILE */

    .nav-link {

        border-radius: 10px;

        width: 100%;

    }


    /* DROPDOWN MOBILE */

    .dropdown-menu {

        margin-top: 5px;

        box-shadow: none;

        max-height: none;

        width: 100%;

    }


    /* SAIR MOBILE */

    .btn-logout {

        margin-left: 0 !important;

        margin-top: 10px;

        align-self: flex-start;

    }

}


/* =====================================================
   TELAS MUITO PEQUENAS
===================================================== */

@media (max-width: 400px) {

    .navbar-custom {

        padding: 10px 15px;

    }

    .nav-link {

        font-size: 14px;

    }

    .btn-logout {

        padding: 9px 20px;

    }

}

</style>