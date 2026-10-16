<nav class="medeia-header">
    <div class="medeia-container">

        <!-- LOGO -->
        <a href="dashboard.php" class="logo">
            <img src="midias/logo.png" alt="Medeia">
        </a>

        <!-- MENU PRINCIPAL -->
        <div class="menu">

            <!-- INÍCIO -->
            <a href="dashboard.php" class="item active">
                <i class="fas fa-house"></i>
                <span>Início</span>
            </a>


            <!-- =========================
                 CADASTRO
            ========================== -->
            <div class="dropdown">

                <button class="item dropdown-btn" type="button">
                    <i class="fas fa-folder-plus"></i>
                    <span>Cadastro</span>
                    <i class="fas fa-chevron-down seta"></i>
                </button>

                <div class="dropdown-box">

                    <!-- REVISTAS -->
                    <div class="dropdown-title">
                        <i class="fas fa-book-open"></i>
                        Editora
                    </div>

                    <a href="form_revista.php">
                        <i class="fas fa-newspaper"></i>
                        Revistas
                    </a>

                    <a href="form_livros.php">
                        <i class="fas fa-book"></i>
                        Livros
                    </a>

                    <a href="form_TA.php">
                        <i class="fas fa-graduation-cap"></i>
                        Trabalhos Acadêmicos
                    </a>

                    <a href="form_artigo.php">
                        <i class="fas fa-file-lines"></i>
                        Artigos
                    </a>

                    <a href="form_autores.php">
                        <i class="fas fa-users"></i>
                        Autores
                    </a>


                    <!-- DIVISOR -->
                    <div class="dropdown-divider"></div>


                    <!-- CONCURSOS -->
                    <div class="dropdown-title">
                        <i class="fas fa-briefcase"></i>
                        Concursos
                    </div>

                    <a href="form_concurso.php">
                        <i class="fas fa-file-signature"></i>
                        Concursos
                    </a>

                    <a href="form_inscricoes.php">
                        <i class="fas fa-clipboard-check"></i>
                        Inscrições
                    </a>

                </div>
            </div>


            <!-- =========================
                 LISTAR
            ========================== -->
            <div class="dropdown">

                <button class="item dropdown-btn" type="button">
                    <i class="fas fa-list-check"></i>
                    <span>Listar</span>
                    <i class="fas fa-chevron-down seta"></i>
                </button>

                <div class="dropdown-box">

                    <!-- LISTAGENS -->
                    <div class="dropdown-title">
                        <i class="fas fa-table-list"></i>
                        Listagens
                    </div>

                    <a href="lista_revistas.php">
                        <i class="fas fa-newspaper"></i>
                        Revistas
                    </a>

                    <a href="lista_livros.php">
                        <i class="fas fa-book"></i>
                        Livros
                    </a>

                    <a href="lista_TA.php">
                        <i class="fas fa-graduation-cap"></i>
                        Trabalhos Acadêmicos
                    </a>

                    <a href="lista_artigos.php">
                        <i class="fas fa-file-lines"></i>
                        Artigos
                    </a>

                    <a href="lista_autores.php">
                        <i class="fas fa-users"></i>
                        Autores
                    </a>

                    <a href="lista_concursos.php">
                        <i class="fas fa-briefcase"></i>
                        Concursos
                    </a>

                    <a href="lista_inscricoes.php">
                        <i class="fas fa-clipboard-check"></i>
                        Inscrições
                    </a>

                    <a href="lista_resultados.php">
                        <i class="fas fa-square-poll-vertical"></i>
                        Resultados
                    </a>

                </div>
            </div>

        </div>


        <!-- =========================
             USUÁRIO
        ========================== -->
        <?php if (eh_admin()): ?>

        <div class="dropdown usuario-menu">

            <button class="item usuario-botao" type="button">

                <span class="usuario-icone">
                    <i class="fas fa-user-shield"></i>
                </span>

                <span class="usuario-info">

                    <strong>
                        <?= h(nome_usuario()) ?>
                    </strong>

                    <small>
                        <?= h(strtoupper(str_replace('_', ' ', perfil_usuario()))) ?>
                    </small>

                </span>

                <i class="fas fa-chevron-down seta"></i>

            </button>


            <div class="dropdown-box usuario-box">

                <div class="dropdown-title">
                    <i class="fas fa-shield-halved"></i>
                    Administração
                </div>

                <a href="lista_operadores.php">
                    <i class="fas fa-users-gear"></i>
                    Usuários
                </a>

                <?php if (eh_ultra_master()): ?>

                <a href="form_operador.php">
                    <i class="fas fa-user-plus"></i>
                    Novo usuário
                </a>

                <?php endif; ?>

            </div>

        </div>

        <?php endif; ?>


        <!-- =========================
             SAIR
        ========================== -->
        <a href="logout.php" class="sair">

            <i class="fas fa-right-from-bracket"></i>

            <span>Sair</span>

        </a>

    </div>
</nav>


<style>

/* =====================================================
   VARIÁVEIS
===================================================== */

:root{

    --grad:
        linear-gradient(
            90deg,
            #b91c3c,
            #a21caf,
            #7c3aed
        );

    --rosa:#a21caf;

    --vinho:#b91c3c;

    --texto:#633653;

    --borda:#f0e5f1;

    --fundo-hover:#fff3f9;

}


/* =====================================================
   HEADER
===================================================== */

.medeia-header{

    height:78px;

    background:#fff;

    border-bottom:1px solid var(--borda);

    box-shadow:0 4px 18px rgba(82,27,71,.07);

    position:relative;

    z-index:1000;

}


.medeia-header::before{

    content:"";

    position:absolute;

    top:0;
    left:0;

    width:100%;
    height:4px;

    background:var(--grad);

}


/* =====================================================
   CONTAINER
===================================================== */

.medeia-container{

    width:88%;

    max-width:1500px;

    height:100%;

    margin:auto;

    display:flex;

    align-items:center;

}


/* =====================================================
   LOGO
===================================================== */

.logo{

    display:flex;

    align-items:center;

    justify-content:center;

    margin-right:35px;

    text-decoration:none;

}


.logo img{

    width:95px;

    height:auto;

    max-height:55px;

    object-fit:contain;

    display:block;

}


/* =====================================================
   MENU
===================================================== */

.menu{

    display:flex;

    align-items:center;

    gap:6px;

}


/* =====================================================
   BOTÕES
===================================================== */

.item{

    border:0;

    background:none;

    color:var(--texto);

    padding:11px 16px;

    border-radius:12px;

    text-decoration:none;

    font-size:14px;

    font-weight:600;

    cursor:pointer;

    display:flex;

    align-items:center;

    gap:6px;

    transition:.2s ease;

}


.item:hover{

    background:var(--fundo-hover);

    color:var(--rosa);

}


.item.active{

    color:#fff;

    background:var(--grad);

    box-shadow:
        0 6px 16px rgba(162,28,175,.20);

}


.item i:first-child{

    margin-right:2px;

}


/* =====================================================
   SETA
===================================================== */

.seta{

    font-size:9px;

    margin-left:4px;

    transition:.2s;

}


.dropdown:hover .seta{

    transform:rotate(180deg);

}


/* =====================================================
   DROPDOWN
===================================================== */

.dropdown{

    position:relative;

}


.dropdown-box{

    position:absolute;

    top:calc(100% + 9px);

    left:0;

    width:255px;

    padding:10px;

    background:#fff;

    border:1px solid var(--borda);

    border-radius:16px;

    box-shadow:
        0 18px 40px rgba(82,27,71,.14);

    display:none;

    animation:dropdownAnim .16s ease;

}


/* pequeno espaço invisível para evitar
   que o menu feche ao mover o mouse */

.dropdown-box::before{

    content:"";

    position:absolute;

    top:-10px;

    left:0;

    width:100%;

    height:10px;

}


.dropdown:hover .dropdown-box{

    display:block;

}


/* =====================================================
   ANIMAÇÃO
===================================================== */

@keyframes dropdownAnim{

    from{

        opacity:0;

        transform:translateY(-5px);

    }

    to{

        opacity:1;

        transform:translateY(0);

    }

}


/* =====================================================
   TÍTULOS DOS DROPDOWNS
===================================================== */

.dropdown-title{

    display:flex;

    align-items:center;

    gap:8px;

    padding:9px 10px 7px;

    color:var(--rosa);

    font-size:11px;

    font-weight:800;

    text-transform:uppercase;

    letter-spacing:.5px;

}


.dropdown-title i{

    font-size:11px;

}


/* =====================================================
   ITENS DOS DROPDOWNS
===================================================== */

.dropdown-box a{

    display:flex;

    align-items:center;

    gap:10px;

    padding:9px 10px 9px 18px;

    margin:2px 0;

    border-radius:9px;

    color:var(--texto);

    text-decoration:none;

    font-size:13px;

    font-weight:500;

    transition:.18s ease;

}


.dropdown-box a i{

    width:16px;

    text-align:center;

    color:#9b6a91;

    font-size:12px;

    transition:.18s;

}


.dropdown-box a:hover{

    color:#fff;

    background:var(--grad);

    padding-left:22px;

}


.dropdown-box a:hover i{

    color:#fff;

}


/* =====================================================
   DIVISOR
===================================================== */

.dropdown-divider{

    height:1px;

    background:#f0e5f1;

    margin:9px 5px;

}


/* =====================================================
   MENU DO USUÁRIO
===================================================== */

.usuario-menu{

    margin-left:auto;

}


.usuario-botao{

    display:flex;

    align-items:center;

    gap:8px;

    min-width:185px;

}


.usuario-icone{

    width:34px;

    height:34px;

    display:flex;

    align-items:center;

    justify-content:center;

    border-radius:10px;

    color:#fff;

    background:var(--grad);

    flex-shrink:0;

}


.usuario-info{

    display:flex;

    flex-direction:column;

    align-items:flex-start;

    line-height:1.1;

    flex:1;

}


.usuario-info strong{

    color:var(--texto);

    font-size:12px;

    font-weight:700;

    max-width:125px;

    overflow:hidden;

    text-overflow:ellipsis;

    white-space:nowrap;

}


.usuario-info small{

    margin-top:4px;

    color:#9b6a91;

    font-size:8px;

    font-weight:700;

    letter-spacing:.4px;

}


/* =====================================================
   DROPDOWN DO USUÁRIO
===================================================== */

.usuario-box{

    left:auto;

    right:0;

    width:220px;

}


/* =====================================================
   BOTÃO SAIR
===================================================== */

.sair{

    margin-left:10px;

    padding:10px 18px;

    display:flex;

    align-items:center;

    gap:7px;

    border:1px solid #f0dce9;

    border-radius:12px;

    color:var(--vinho);

    background:#fff;

    text-decoration:none;

    font-size:13px;

    font-weight:700;

    transition:.2s ease;

}


.sair:hover{

    color:#fff;

    background:var(--grad);

    border-color:transparent;

    box-shadow:
        0 6px 16px rgba(162,28,175,.18);

}


/* =====================================================
   RESPONSIVO
===================================================== */

@media(max-width:1100px){

    .medeia-container{

        width:94%;

    }

    .logo{

        margin-right:15px;

    }

    .logo img{

        width:80px;

    }

    .item{

        padding:10px 11px;

    }

    .usuario-botao{

        min-width:150px;

    }

}


@media(max-width:850px){

    .medeia-header{

        height:auto;

        min-height:78px;

    }

    .medeia-container{

        flex-wrap:wrap;

        padding:12px 0;

        gap:6px;

    }

    .logo{

        margin-right:auto;

    }

    .menu{

        order:3;

        width:100%;

        justify-content:center;

    }

    .usuario-menu{

        margin-left:0;

    }

}


@media(max-width:600px){

    .medeia-container{

        width:94%;

    }

    .menu{

        overflow-x:auto;

        justify-content:flex-start;

        padding-bottom:4px;

    }

    .item{

        white-space:nowrap;

        font-size:12px;

    }

    .usuario-info{

        display:none;

    }

    .usuario-botao{

        min-width:auto;

    }

    .sair span{

        display:none;

    }

    .sair{

        padding:10px 12px;

    }

    .dropdown-box{

        position:fixed;

        top:78px;

        left:10px;

        right:10px;

        width:auto;

    }

}

</style>