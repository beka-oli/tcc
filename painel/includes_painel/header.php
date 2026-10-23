
<?php
// HEADER - ASSOCIAÇÃO CIENTÍFICA MEDEIA
?>

<nav class="medeia-header">
    <div class="medeia-container">

        <!-- LOGO -->
        <a href="dashboard.php" class="logo" aria-label="Medeia - Início">
            <img src="midias/logo.png" alt="Logo Medeia">
        </a>

        <!-- MENU PRINCIPAL -->
        <div class="menu">

            <!-- INÍCIO -->
            <a href="dashboard.php" class="item active">
                <i class="fas fa-house"></i>
                <span>Início</span>
            </a>

            <!-- ======================================
                 CADASTRO
            ======================================= -->
            <div class="dropdown medeia-dropdown">

                <button class="item dropdown-btn"
                        type="button"
                        aria-expanded="false"
                        aria-controls="menu-cadastro">

                    <i class="fas fa-folder-plus"></i>
                    <span>Cadastro</span>
                    <i class="fas fa-chevron-down seta"></i>
                </button>

                <div class="dropdown-box" id="menu-cadastro">

                    <!-- REVISTA -->
                    <section class="categoria-menu">
                        <button class="categoria-titulo"
                                type="button"
                                aria-expanded="false">

                            <span>
                                <i class="fas fa-newspaper"></i>
                                REVISTA
                            </span>

                            <i class="fas fa-chevron-right categoria-seta"></i>
                        </button>

                        <div class="categoria-links" hidden>
                            <a href="form_revista.php">
                                <i class="fas fa-book-open"></i>
                                Revistas
                            </a>

                            <a href="form_edicao.php">
                                <i class="fas fa-layer-group"></i>
                                Edições
                            </a>
                        </div>
                    </section>

                    <!-- EDITORA -->
                    <section class="categoria-menu">
                        <button class="categoria-titulo"
                                type="button"
                                aria-expanded="false">

                            <span>
                                <i class="fas fa-book"></i>
                                EDITORA
                            </span>

                            <i class="fas fa-chevron-right categoria-seta"></i>
                        </button>

                        <div class="categoria-links" hidden>
                            <a href="form_livros.php">
                                <i class="fas fa-book"></i>
                                Livros
                            </a>

                            <a href="form_artigo.php">
                                <i class="fas fa-file-lines"></i>
                                Artigos
                            </a>

                            <a href="form_autores.php">
                                <i class="fas fa-users"></i>
                                Autores
                            </a>
                        </div>
                    </section>

                    <!-- ASSESSORIA PEDAGÓGICA -->
                    <section class="categoria-menu">
                        <button class="categoria-titulo"
                                type="button"
                                aria-expanded="false">

                            <span>
                                <i class="fas fa-graduation-cap"></i>
                                ASSESSORIA PEDAGÓGICA
                            </span>

                            <i class="fas fa-chevron-right categoria-seta"></i>
                        </button>

                        <div class="categoria-links" hidden>
                            <a href="form_TA.php">
                                <i class="fas fa-user-graduate"></i>
                                Trabalhos Acadêmicos
                            </a>
                        </div>
                    </section>

                    <!-- CONCURSOS -->
                    <section class="categoria-menu">
                        <button class="categoria-titulo"
                                type="button"
                                aria-expanded="false">

                            <span>
                                <i class="fas fa-briefcase"></i>
                                CONCURSOS
                            </span>

                            <i class="fas fa-chevron-right categoria-seta"></i>
                        </button>

                        <div class="categoria-links" hidden>
                            <a href="form_concurso.php">
                                <i class="fas fa-file-signature"></i>
                                Concursos
                            </a>

                            <a href="form_inscricoes.php">
                                <i class="fas fa-clipboard-check"></i>
                                Inscrições
                            </a>
                        </div>
                    </section>

                </div>
            </div>

            <!-- ======================================
                 LISTAR
            ======================================= -->
            <div class="dropdown medeia-dropdown">

                <button class="item dropdown-btn"
                        type="button"
                        aria-expanded="false"
                        aria-controls="menu-listar">

                    <i class="fas fa-list-check"></i>
                    <span>Listar</span>
                    <i class="fas fa-chevron-down seta"></i>
                </button>

                <div class="dropdown-box" id="menu-listar">

                    <!-- REVISTA -->
                    <section class="categoria-menu">
                        <button class="categoria-titulo"
                                type="button"
                                aria-expanded="false">

                            <span>
                                <i class="fas fa-newspaper"></i>
                                REVISTA
                            </span>

                            <i class="fas fa-chevron-right categoria-seta"></i>
                        </button>

                        <div class="categoria-links" hidden>
                            <a href="lista_revistas.php">
                                <i class="fas fa-book-open"></i>
                                Revistas
                            </a>

                            <a href="lista_edicoes.php">
                                <i class="fas fa-layer-group"></i>
                                Edições
                            </a>
                        </div>
                    </section>

                    <!-- EDITORA -->
                    <section class="categoria-menu">
                        <button class="categoria-titulo"
                                type="button"
                                aria-expanded="false">

                            <span>
                                <i class="fas fa-book"></i>
                                EDITORA
                            </span>

                            <i class="fas fa-chevron-right categoria-seta"></i>
                        </button>

                        <div class="categoria-links" hidden>
                            <a href="lista_livros.php">
                                <i class="fas fa-book"></i>
                                Livros
                            </a>

                            <a href="lista_artigos.php">
                                <i class="fas fa-file-lines"></i>
                                Artigos
                            </a>

                            <a href="lista_autores.php">
                                <i class="fas fa-users"></i>
                                Autores
                            </a>
                        </div>
                    </section>

                    <!-- ASSESSORIA PEDAGÓGICA -->
                    <section class="categoria-menu">
                        <button class="categoria-titulo"
                                type="button"
                                aria-expanded="false">

                            <span>
                                <i class="fas fa-graduation-cap"></i>
                                ASSESSORIA PEDAGÓGICA
                            </span>

                            <i class="fas fa-chevron-right categoria-seta"></i>
                        </button>

                        <div class="categoria-links" hidden>
                            <a href="lista_TA.php">
                                <i class="fas fa-user-graduate"></i>
                                Trabalhos Acadêmicos
                            </a>
                        </div>
                    </section>

                    <!-- CONCURSOS -->
                    <section class="categoria-menu">
                        <button class="categoria-titulo"
                                type="button"
                                aria-expanded="false">

                            <span>
                                <i class="fas fa-briefcase"></i>
                                CONCURSOS
                            </span>

                            <i class="fas fa-chevron-right categoria-seta"></i>
                        </button>

                        <div class="categoria-links" hidden>
                            <a href="lista_concursos.php">
                                <i class="fas fa-file-signature"></i>
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
                    </section>

                </div>
            </div>

        </div>

        <!-- ======================================
             USUÁRIO
        ======================================= -->
        <?php if (eh_admin()): ?>

            <div class="dropdown usuario-menu">

                <button class="item usuario-botao dropdown-btn"
                        type="button"
                        aria-expanded="false"
                        aria-controls="menu-usuario">

                    <span class="usuario-icone">
                        <i class="fas fa-user-shield"></i>
                    </span>

                    <span class="usuario-info">
                        <strong><?= h(nome_usuario()) ?></strong>

                        <small>
                            <?= h(strtoupper(str_replace('_', ' ', perfil_usuario()))) ?>
                        </small>
                    </span>

                    <i class="fas fa-chevron-down seta"></i>
                </button>

                <div class="dropdown-box usuario-box" id="menu-usuario">

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

        <!-- SAIR -->
        <a href="logout.php" class="sair">
            <i class="fas fa-right-from-bracket"></i>
            <span>Sair</span>
        </a>

    </div>
</nav>

<!-- ==========================================
     CSS DO HEADER
========================================== -->
<style>
:root {
    --grad: linear-gradient(90deg, #b91c3c, #a21caf, #7c3aed);
    --rosa: #a21caf;
    --vinho: #b91c3c;
    --texto: #633653;
    --borda: #f0e5f1;
    --fundo-hover: #fff3f9;
}

.medeia-header,
.medeia-header * {
    box-sizing: border-box;
}

.medeia-header {
    position: relative;
    z-index: 1000;
    min-height: 78px;
    background: #fff;
    border-bottom: 1px solid var(--borda);
    box-shadow: 0 4px 18px rgba(82, 27, 71, .07);
    font-family: inherit;
}

.medeia-header::before {
    content: "";
    position: absolute;
    inset: 0 0 auto;
    height: 4px;
    background: var(--grad);
}

.medeia-container {
    width: 88%;
    max-width: 1500px;
    min-height: 78px;
    margin: auto;
    display: flex;
    align-items: center;
    gap: 10px;
}

/* LOGO */
.medeia-header .logo {
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    margin-right: 25px;
    text-decoration: none;
}

.medeia-header .logo img {
    display: block;
    width: 95px;
    max-height: 55px;
    object-fit: contain;
}

/* MENU PRINCIPAL */
.medeia-header .menu {
    display: flex;
    align-items: center;
    gap: 6px;
}

/* BOTÕES */
.medeia-header .item {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 7px;
    padding: 11px 15px;
    border: none;
    border-radius: 12px;
    background: transparent;
    color: var(--texto);
    font: inherit;
    font-size: 14px;
    font-weight: 600;
    text-decoration: none;
    white-space: nowrap;
    cursor: pointer;
    transition: background .2s, color .2s;
}

.medeia-header .item:hover {
    background: var(--fundo-hover);
    color: var(--rosa);
}

.medeia-header .item.active {
    color: #fff;
    background: var(--grad);
    box-shadow: 0 6px 16px rgba(162, 28, 175, .2);
}

/* SETAS */
.medeia-header .seta {
    margin-left: 4px;
    font-size: 10px;
    transition: transform .2s;
}

.medeia-header .dropdown.open > .dropdown-btn .seta {
    transform: rotate(180deg);
}

/* DROPDOWNS */
.medeia-header .dropdown {
    position: relative;
}

.medeia-header .dropdown-box {
    position: absolute;
    top: calc(100% + 12px);
    left: 0;
    z-index: 1000;
    display: none;
    flex-direction: column;
    gap: 4px;
    width: 225px;
    max-width: calc(100vw - 24px);
    max-height: 75vh;
    overflow: visible;
    padding: 10px;
    background: #fff;
    border: 1px solid var(--borda);
    border-radius: 16px;
    box-shadow: 0 14px 40px rgba(75, 20, 65, .15);
    animation: medeiaDropdown .16s ease;
}

.medeia-header .dropdown.open > .dropdown-box {
    display: flex;
}

/* Abre pelo clique, não pelo mouse */
.medeia-header .medeia-dropdown:hover > .dropdown-box,
.medeia-header .usuario-menu:hover > .dropdown-box {
    display: none;
}

.medeia-header .medeia-dropdown.open:hover > .dropdown-box,
.medeia-header .usuario-menu.open:hover > .dropdown-box {
    display: flex;
}

@keyframes medeiaDropdown {
    from {
        opacity: 0;
        transform: translateY(-5px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* CATEGORIAS */
.medeia-header .categoria-menu {
    position: static;
    width: 100%;
    min-width: 0;
    margin: 0;
    padding: 0;
    border: none;
}

.medeia-header .categoria-titulo {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 8px;
    width: 100%;
    min-height: 46px;
    padding: 11px 10px;
    border: none;
    border-radius: 10px;
    background: transparent;
    color: #8f247f;
    font-family: inherit;
    font-size: 12px;
    font-weight: 800;
    letter-spacing: .3px;
    text-align: left;
    cursor: pointer;
    transition: background .2s, color .2s;
}

.medeia-header .categoria-titulo > span {
    display: flex;
    align-items: center;
    gap: 9px;
    min-width: 0;
}

.medeia-header .categoria-titulo > span > i {
    width: 17px;
    flex-shrink: 0;
    text-align: center;
}

.medeia-header .categoria-titulo:hover,
.medeia-header .categoria-titulo[aria-expanded="true"] {
    background: #f8edf8;
    color: #a51b82;
}

/* SETAS LATERAIS */
.medeia-header .categoria-seta {
    flex-shrink: 0;
    font-size: 10px;
    transition: transform .2s;
}

.medeia-header .categoria-titulo[aria-expanded="true"] .categoria-seta {
    transform: rotate(90deg);
}

/* SUBMENUS LATERAIS */
.medeia-header .categoria-links {
    position: absolute;
    top: -1px;
    left: calc(100% + 10px);
    z-index: 1001;
    width: 245px;
    max-width: calc(100vw - 270px);
    max-height: 75vh;
    overflow-y: auto;
    padding: 12px;
    background: #fff;
    border: 1px solid #eee1ef;
    border-radius: 14px;
    box-shadow: 0 14px 35px rgba(75, 20, 65, .12);
}

.medeia-header .categoria-links[hidden] {
    display: none !important;
}

/* LINKS DOS SUBMENUS */
.medeia-header .categoria-links a,
.medeia-header .dropdown-box > a {
    display: flex;
    align-items: center;
    gap: 11px;
    min-height: 43px;
    padding: 11px 12px;
    margin-bottom: 3px;
    border-radius: 9px;
    color: #63304e;
    font-size: 13px;
    font-weight: 500;
    text-decoration: none;
    overflow-wrap: anywhere;
    transition: background .2s, color .2s;
}

.medeia-header .categoria-links a > i,
.medeia-header .dropdown-box > a > i {
    width: 17px;
    flex-shrink: 0;
    text-align: center;
    color: #a66c9d;
}

.medeia-header .categoria-links a:hover,
.medeia-header .dropdown-box > a:hover {
    background: var(--fundo-hover);
    color: var(--rosa);
}

/* USUÁRIO */
.medeia-header .usuario-menu {
    margin-left: auto;
}

.medeia-header .usuario-botao {
    gap: 8px;
    min-width: 170px;
}

.medeia-header .usuario-icone {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 34px;
    height: 34px;
    flex-shrink: 0;
    border-radius: 10px;
    color: #fff;
    background: var(--grad);
}

.medeia-header .usuario-info {
    display: flex;
    flex: 1;
    flex-direction: column;
    align-items: flex-start;
    line-height: 1.1;
}

.medeia-header .usuario-info strong {
    max-width: 125px;
    overflow: hidden;
    color: var(--texto);
    font-size: 12px;
    font-weight: 700;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.medeia-header .usuario-info small {
    margin-top: 4px;
    color: #9b6a91;
    font-size: 9px;
    font-weight: 700;
    letter-spacing: .3px;
}

.medeia-header .usuario-box {
    right: 0;
    left: auto;
    width: 220px;
}

/* TÍTULO DO MENU DO USUÁRIO */
.medeia-header .dropdown-title {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 9px 10px 7px;
    color: var(--rosa);
    font-size: 11px;
    font-weight: 800;
    letter-spacing: .5px;
    text-transform: uppercase;
}

/* SAIR */
.medeia-header .sair {
    display: flex;
    align-items: center;
    gap: 7px;
    margin-left: 2px;
    padding: 10px 15px;
    border: 1px solid #f0dce9;
    border-radius: 12px;
    color: var(--vinho);
    background: #fff;
    font-size: 13px;
    font-weight: 700;
    text-decoration: none;
    white-space: nowrap;
    transition: background .2s, color .2s;
}

.medeia-header .sair:hover {
    color: #fff;
    background: var(--grad);
    border-color: transparent;
}

/* RESPONSIVIDADE */
@media (max-width: 1100px) {
    .medeia-container {
        width: 94%;
        gap: 6px;
    }

    .medeia-header .logo {
        margin-right: 10px;
    }

    .medeia-header .logo img {
        width: 80px;
    }

    .medeia-header .item {
        gap: 5px;
        padding: 10px;
        font-size: 13px;
    }

    .medeia-header .usuario-botao {
        min-width: 135px;
    }
}

@media (max-width: 850px) {
    .medeia-container {
        flex-wrap: wrap;
        padding: 12px 0;
    }

    .medeia-header .logo {
        margin-right: auto;
    }

    .medeia-header .menu {
        order: 3;
        width: 100%;
        justify-content: flex-start;
    }

    .medeia-header .usuario-menu {
        margin-left: 0;
    }
}

@media (max-width: 600px) {
    .medeia-container {
        width: 94%;
        gap: 5px;
    }

    .medeia-header .menu {
        overflow: visible;
        flex-wrap: wrap;
        gap: 4px;
    }

    .medeia-header .item {
        padding: 10px 8px;
        font-size: 12px;
    }

    .medeia-header .usuario-info {
        display: none;
    }

    .medeia-header .usuario-botao {
        min-width: auto;
    }

    .medeia-header .sair {
        padding: 10px 12px;
    }

    .medeia-header .medeia-dropdown > .dropdown-box {
        width: 205px;
        max-width: calc(100vw - 24px);
        max-height: 65vh;
    }

    .medeia-header .categoria-titulo {
        min-height: 44px;
        padding: 10px 7px;
        font-size: 11px;
    }

    .medeia-header .categoria-titulo > span {
        gap: 6px;
    }

    .medeia-header .categoria-links {
        left: calc(100% + 6px);
        width: min(220px, calc(100vw - 235px));
        max-width: none;
        max-height: 65vh;
        padding: 8px;
    }

    .medeia-header .categoria-links a {
        gap: 7px;
        padding: 10px 7px;
        font-size: 12px;
    }
}
</style>

<!-- ==========================================
     JAVASCRIPT DOS DROPDOWNS
========================================== -->
<script>
document.addEventListener('DOMContentLoaded', function () {

    const header = document.querySelector('.medeia-header');

    if (!header) return;

    const dropdowns = header.querySelectorAll('.dropdown');

    // Fecha um dropdown e suas categorias
    function fecharDropdown(dropdown) {

        dropdown.classList.remove('open');

        const botao = dropdown.querySelector(':scope > .dropdown-btn');

        if (botao) {
            botao.setAttribute('aria-expanded', 'false');
        }

        dropdown.querySelectorAll('.categoria-menu').forEach(function (categoria) {

            const titulo = categoria.querySelector('.categoria-titulo');
            const links = categoria.querySelector('.categoria-links');

            if (titulo && links) {
                links.hidden = true;
                titulo.setAttribute('aria-expanded', 'false');
            }
        });
    }

    // Cadastro, Listar e Usuário
    dropdowns.forEach(function (dropdown) {

        const botao = dropdown.querySelector(':scope > .dropdown-btn');

        if (!botao) return;

        botao.addEventListener('click', function (event) {

            event.stopPropagation();

            const abrir = !dropdown.classList.contains('open');

            // Fecha os outros menus principais
            dropdowns.forEach(function (outro) {
                if (outro !== dropdown) {
                    fecharDropdown(outro);
                }
            });

            if (abrir) {
                dropdown.classList.add('open');
                botao.setAttribute('aria-expanded', 'true');
            } else {
                fecharDropdown(dropdown);
            }
        });

        // Categorias expansíveis de Cadastro e Listar
        dropdown.querySelectorAll('.categoria-menu').forEach(function (categoria) {

            const titulo = categoria.querySelector('.categoria-titulo');
            const links = categoria.querySelector('.categoria-links');

            if (!titulo || !links) return;

            titulo.addEventListener('click', function (event) {

                event.stopPropagation();

                const abrir = links.hidden;

                // Mantém somente uma categoria aberta por menu
                dropdown.querySelectorAll('.categoria-menu').forEach(function (outra) {

                    const outroTitulo = outra.querySelector('.categoria-titulo');
                    const outrosLinks = outra.querySelector('.categoria-links');

                    outrosLinks.hidden = true;
                    outroTitulo.setAttribute('aria-expanded', 'false');
                });

                if (abrir) {
                    links.hidden = false;
                    titulo.setAttribute('aria-expanded', 'true');
                }
            });
        });
    });

    // Fecha os menus ao clicar fora
    document.addEventListener('click', function (event) {

        if (!header.contains(event.target)) {
            dropdowns.forEach(fecharDropdown);
            return;
        }

        dropdowns.forEach(function (dropdown) {
            if (!dropdown.contains(event.target)) {
                fecharDropdown(dropdown);
            }
        });
    });

    // Fecha com Escape
    document.addEventListener('keydown', function (event) {

        if (event.key === 'Escape') {
            dropdowns.forEach(fecharDropdown);
        }
    });

});
</script>
