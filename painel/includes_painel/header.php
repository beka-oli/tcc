<nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
    <div class="container-fluid">

        <button class="navbar-toggler" type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                <li class="nav-item">
                    <a class="nav-link active" href="dashboard.php">
                        <i class="fas fa-house"></i> Início
                    </a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle"
                        href="#"
                        role="button"
                        data-bs-toggle="dropdown">

                        <i class="fas fa-laptop"></i> Cadastro
                    </a>

                    <ul class="dropdown-menu">

                        <li>
                            <a class="dropdown-item" href="form_categorias.php">
                                <i class="fas fa-folder-open"></i>
                                Categorias
                            </a>
                        </li>
                    </ul>

                </li>

            </ul>

            <a href="logout.php" class="text-decoration-none">
                <button class="btn btn-logout">
                    <i class="fas fa-right-from-bracket"></i>
                    Sair
                </button>
            </a>

        </div>

    </div>
</nav>
<style>
    :root{
    --gradient: linear-gradient(90deg,#b91c3c 0%,#a21caf 55%,#7c3aed 100%);
}

.navbar-custom{
    background: var(--gradient);
    height: 72px;
    padding: 0 30px;
    box-shadow: 0 5px 18px rgba(0,0,0,.15);
}

/* LOGO */

.navbar-brand{
    font-size:1.9rem;
    font-weight:700;
    color:#fff!important;
    letter-spacing:-.5px;
}

.navbar-brand span{
    font-weight:300;
}

/* MENU */

.navbar-nav{
    margin-left:40px;
}

.nav-item{
    margin:0 4px;
}

.nav-link{

    color:rgba(255,255,255,.88)!important;

    font-size:15px;

    font-weight:500;

    padding:10px 18px!important;

    border-radius:999px;

    transition:.3s;
}

.nav-link:hover{

    background:rgba(255,255,255,.12);

    color:#fff!important;
}

.nav-link.active{

    background:#fff;

    color:#9f1239!important;

    font-weight:600;
}

/* DROPDOWN */

.dropdown-menu{

    border:none;

    border-radius:16px;

    padding:10px;

    margin-top:18px;

    box-shadow:0 18px 40px rgba(0,0,0,.18);
}

.dropdown-item{

    border-radius:10px;

    font-size:14px;

    padding:10px 15px;
}

.dropdown-item:hover{

    background:var(--gradient);

    color:#fff;
}

/* BOTÃO */

.btn-logout{

    background:#fff;

    color:#9f1239;

    border:none;

    border-radius:999px;

    padding:10px 24px;

    font-size:14px;

    font-weight:600;

    transition:.3s;
}

.btn-logout:hover{

    transform:translateY(-2px);

    color:#7c3aed;

    box-shadow:0 10px 25px rgba(0,0,0,.15);
}
</style>