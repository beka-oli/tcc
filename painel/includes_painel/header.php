<nav class="medeia-header">
    <div class="medeia-container">

        <!-- LOGO -->
        <a href="dashboard.php" class="logo">
            <img src="midias/logo.png" alt="Medeia">
        </a>

        <!-- MENU -->
        <div class="menu">

            <a href="dashboard.php" class="item active">
                <i class="fas fa-house"></i> Início
            </a>

            <div class="dropdown">
                <button class="item">
                    <i class="fas fa-folder-plus"></i> Cadastro
                    <i class="fas fa-chevron-down seta"></i>
                </button>

                <div class="dropdown-box">
                    <strong>Revistas Científicas</strong>
                    <a href="form_revista.php">Revistas</a>
                    <a href="form_livros.php">Livros</a>
                    <a href="form_TA.php">Trabalhos Acadêmicos</a>
                    <a href="form_artigo.php">Artigos</a>
                    <a href="form_autores.php">Autores</a>
                    <hr>
                    <strong>Concursos</strong>
                    <a href="form_concurso.php">Concursos</a>
                    <a href="form_inscricoes.php">Inscrições</a>
                </div>
            </div>

            <div class="dropdown">
                <button class="item">
                    <i class="fas fa-list-check"></i> Listar
                    <i class="fas fa-chevron-down seta"></i>
                </button>

                <div class="dropdown-box">
                    <strong>Listagens</strong>
                    <a href="lista_revistas.php">Revistas</a>
                    <a href="lista_livros.php">Livros</a>
                    <a href="lista_TA.php">Trabalhos Acadêmicos</a>
                    <a href="lista_artigos.php">Artigos</a>
                    <a href="lista_autores.php">Autores</a>
                    <hr>
                    <a href="lista_concursos.php">Concursos</a>
                    <a href="lista_inscricoes.php">Inscrições</a>
                    <a href="lista_resultados.php">Resultados</a>
                </div>
            </div>

        </div>

        <!-- SAIR -->
        <a href="logout.php" class="sair">
            <i class="fas fa-right-from-bracket"></i> Sair
        </a>

    </div>
</nav>

<style>

:root{
    --grad:linear-gradient(90deg,#b91c3c,#a21caf,#7c3aed);
}

/* HEADER */

.medeia-header{
    height:78px;
    background:#fff;
    border-bottom:1px solid #f0e5f1;
    box-shadow:0 4px 18px #521b4712;
    position:relative;
    z-index:1000;
}

.medeia-header:before{
    content:"";
    position:absolute;
    top:0;
    left:0;
    width:100%;
    height:4px;
    background:var(--grad);
}

/* CONTAINER */

.medeia-container{
    width:88%;
    height:100%;
    margin:auto;
    display:flex;
    align-items:center;
}

/* LOGO */

.logo{
    display:flex;
    align-items:center;
    justify-content:center;
    margin-right:35px;
}

.logo img{
    width:95px;
    height:auto;
    max-height:55px;
    object-fit:contain;
    display:block;
}

/* MENU */

.menu{
    display:flex;
    align-items:center;
    gap:6px;
}

.item{
    border:0;
    background:none;
    color:#633653;
    padding:11px 16px;
    border-radius:12px;
    text-decoration:none;
    font-size:14px;
    font-weight:600;
    cursor:pointer;
}

.item:hover{
    background:#fff3f9;
    color:#a21caf;
}

.item.active{
    color:#fff;
    background:var(--grad);
    box-shadow:0 6px 16px #a21caf30;
}

.item i:first-child{
    margin-right:6px;
}

.seta{
    font-size:9px;
    margin-left:5px;
}

/* DROPDOWN */

.dropdown{
    position:relative;
}

.dropdown-box{
    position:absolute;
    top:52px;
    left:0;
    width:230px;
    padding:10px;
    background:#fff;
    border:1px solid #f0e5f1;
    border-radius:15px;
    box-shadow:0 15px 35px #521b4720;
    display:none;
}

.dropdown:hover .dropdown-box{
    display:block;
}

.dropdown-box strong{
    display:block;
    padding:7px 10px;
    color:#a21caf;
    font-size:11px;
}

.dropdown-box a{
    display:block;
    padding:9px 10px;
    border-radius:9px;
    color:#633653;
    text-decoration:none;
    font-size:13px;
}

.dropdown-box a:hover{
    color:#fff;
    background:var(--grad);
}

.dropdown-box hr{
    border:0;
    border-top:1px solid #f0e5f1;
}

/* SAIR */

.sair{
    margin-left:auto;
    padding:10px 20px;
    border:1px solid #f0dce9;
    border-radius:12px;
    color:#b91c3c;
    text-decoration:none;
    font-size:13px;
    font-weight:bold;
}

.sair:hover{
    color:#fff;
    background:var(--grad);
}

/* RESPONSIVO */

@media(max-width:991px){

    .medeia-container{
        width:94%;
    }

    .logo{
        margin-right:15px;
    }

    .logo img{
        width:80px;
    }

    .menu{
        gap:2px;
    }

    .item{
        padding:10px;
    }
}

</style>