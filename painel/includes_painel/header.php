<nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
    <div class="container-fluid">

        <button class="navbar-toggler" type="button"
            data-bs-toggle="collapse" data-bs-target="#menu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="menu">

            <ul class="navbar-nav me-auto">

                <!-- INÍCIO -->
                <li class="nav-item">
                    <a class="nav-link active" href="dashboard.php">
                        <i class="fas fa-house"></i> Início
                    </a>
                </li>

                <!-- CADASTRO -->
                <li class="nav-item dropdown">

                    <a class="nav-link dropdown-toggle" href="#"
                        data-bs-toggle="dropdown">

                        <i class="fas fa-laptop"></i> Cadastro
                    </a>

                    <ul class="dropdown-menu">

                        <!-- CADASTROS -->
                        <li>
                            <h6 class="dropdown-header">
                                <i class="fas fa-plus-circle"></i>
                                Cadastros
                            </h6>
                        </li>

                        <li>
                            <a class="dropdown-item" href="form_revista.php">
                                <i class="fas fa-newspaper"></i>
                                Revistas
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item" href="form_livros.php">
                                <i class="fas fa-book-open"></i>
                                Livros
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item" href="form_concurso.php">
                                <i class="fas fa-trophy"></i>
                                Concursos
                            </a>
                        </li>

                        <li><hr class="dropdown-divider"></li>

                        <!-- REVISTAS -->
                        <li>
                            <h6 class="dropdown-header">
                                <i class="fas fa-newspaper"></i>
                                Revistas Científicas
                            </h6>
                        </li>

                        <li>
                            <a class="dropdown-item" href="form_revista.php">
                                <i class="fas fa-newspaper"></i>
                                Revistas
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item" href="form_edicao.php">
                                <i class="fas fa-layer-group"></i>
                                Edições
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item" href="form_artigo.php">
                                <i class="fas fa-file-lines"></i>
                                Artigos
                            </a>
                        </li>

                        <li><hr class="dropdown-divider"></li>

                        <!-- CONCURSOS -->
                        <li>
                            <h6 class="dropdown-header">
                                <i class="fas fa-trophy"></i>
                                Concursos
                            </h6>
                        </li>

                        <li>
                            <a class="dropdown-item" href="form_concurso.php">
                                <i class="fas fa-trophy"></i>
                                Concursos
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item" href="inscricoes.php">
                                <i class="fas fa-user-plus"></i>
                                Inscrições
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item" href="resultados.php">
                                <i class="fas fa-medal"></i>
                                Resultados
                            </a>
                        </li>

                        <li><hr class="dropdown-divider"></li>

                        <!-- ASSOCIAÇÃO -->
                        <li>
                            <h6 class="dropdown-header">
                                <i class="fas fa-building"></i>
                                Associação
                            </h6>
                        </li>

                        <li>
                            <a class="dropdown-item" href="sobre_associacao.php">
                                <i class="fas fa-circle-info"></i>
                                Sobre a Associação
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item" href="equipe.php">
                                <i class="fas fa-users"></i>
                                Equipe
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item" href="contato.php">
                                <i class="fas fa-envelope"></i>
                                Contato
                            </a>
                        </li>

                        <li><hr class="dropdown-divider"></li>

                        <!-- CONFIGURAÇÕES -->
                        <li>
                            <a class="dropdown-item" href="configuracoes.php">
                                <i class="fas fa-gear"></i>
                                Configurações
                            </a>
                        </li>

                    </ul>
                </li>

            </ul>

            <!-- SAIR -->
            <a href="logout.php" class="btn btn-logout">
                <i class="fas fa-right-from-bracket"></i>
                Sair
            </a>

        </div>
    </div>
</nav>

<style>

:root {
    --gradient: linear-gradient(
        90deg,
        #b91c3c,
        #a21caf,
        #7c3aed
    );
}

.navbar-custom {
    background: var(--gradient);
    height: 72px;
    padding: 0 30px;
    box-shadow: 0 5px 18px rgba(0,0,0,.15);
}

.navbar-nav {
    margin-left: 40px;
}

.nav-item {
    margin: 0 4px;
}

.nav-link {
    color: rgba(255,255,255,.9)!important;
    font-size: 15px;
    font-weight: 500;
    padding: 10px 18px!important;
    border-radius: 999px;
    transition: .3s;
}

.nav-link:hover {
    background: rgba(255,255,255,.15);
}

.nav-link.active {
    background: #fff;
    color: #9f1239!important;
    font-weight: 600;
}

.dropdown-menu {
    border: none;
    border-radius: 16px;
    padding: 10px;
    margin-top: 12px;
    min-width: 260px;
    max-height: 500px;
    overflow-y: auto;
    box-shadow: 0 18px 40px rgba(0,0,0,.18);
}

.dropdown-header {
    color: #9f1239;
    font-size: 13px;
    font-weight: 700;
    padding: 8px 13px;
}

.dropdown-item {
    border-radius: 10px;
    font-size: 14px;
    padding: 9px 13px;
}

.dropdown-item i {
    width: 22px;
    margin-right: 4px;
}

.dropdown-item:hover {
    background: var(--gradient);
    color: #fff;
}

.dropdown-divider {
    margin: 8px 0;
}

.btn-logout {
    background: #fff;
    color: #9f1239;
    border: none;
    border-radius: 999px;
    padding: 10px 24px;
    font-size: 14px;
    font-weight: 600;
    transition: .3s;
}

.btn-logout:hover {
    color: #b91c3c;
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(0,0,0,.15);
}

@media(max-width:991px) {

    .navbar-custom {
        height: auto;
        padding: 10px 20px;
    }

    .navbar-nav {
        margin-left: 0;
    }

    .nav-link {
        border-radius: 10px;
    }

    .dropdown-menu {
        margin-top: 5px;
        box-shadow: none;
        max-height: none;
    }

    .btn-logout {
        margin-top: 10px;
    }
}

</style>