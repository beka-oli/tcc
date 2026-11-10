<nav class="medeia-header">
    <div class="medeia-container">
        <!-- LOGO -->
        <a href="dashboard.php" class="logo" aria-label="Medeia - Início">
            <img src="midias/logo.png" alt="Logo Medeia">
        </a>

        <!-- MENU PRINCIPAL -->
        <div class="menu">
            <!-- INÍCIO -->
            <a href="dashboard.php" class="item active"><i class="fas fa-house"></i><span>Início</span></a>

            <!-- ====================================== CADASTRO======================================= -->
            <div class="dropdown medeia-dropdown">
                <button class="item dropdown-btn" type="button" aria-expanded="false" aria-controls="menu-cadastro">
                    <i class="fas fa-folder-plus"></i><span>Cadastro</span>
                    <i class="fas fa-chevron-down seta"></i>
                </button>
                <div class="dropdown-box" id="menu-cadastro">

                    <!-- REVISTA -->
                    <section class="categoria-menu">
                        <button class="categoria-titulo"type="button"aria-expanded="false">
                            <span><i class="fas fa-newspaper"></i> REVISTA</span>
                            <i class="fas fa-chevron-right categoria-seta"></i>
                        </button>
                        <div class="categoria-links" hidden>
                            <a href="form_edicoes.php"><i class="fas fa-book-open"></i>Edições</a>
                        </div>
                    </section>


                    <!-- EDITORA -->
                    <section class="categoria-menu">
                        <button class="categoria-titulo"type="button" aria-expanded="false">
                            <span><i class="fas fa-book"></i> EDITORA</span>
                            <i class="fas fa-chevron-right categoria-seta"></i>
                        </button>
                        <div class="categoria-links" hidden>
                            <a href="form_livros.php"><i class="fas fa-book"></i>Livros</a>
                            <a href="form_artigo.php"><i class="fas fa-file-lines"></i>Artigos</a>
                            <a href="form_TA.php"><i class="fas fa-user-graduate"></i>Trabalhos Acadêmicos</a>
                            <a href="form_autores.php"><i class="fas fa-users"></i> Autores</a>
                        </div>
                    </section>

                    <!-- ASSESSORIA PEDAGÓGICA -->
                    <section class="categoria-menu">
                        <button class="categoria-titulo" type="button"aria-expanded="false">
                            <span><i class="fas fa-graduation-cap"></i> ASSESSORIA PEDAGÓGICA</span>
                            <i class="fas fa-chevron-right categoria-seta"></i>
                        </button>
                        <div class="categoria-links" hidden>
                            <a href="form_cursos.php"><i class="fas fa-user-graduate"></i>Cursos</a>
                            <a href="form_palestras.php"><i class="fas fa-chalkboard-teacher"></i>Palestras</a>
                            <a href="form_eventos.php"><i class="fas fa-file-alt"></i>Eventos</a>
                        </div>
                    </section>

                    <!-- CONCURSOS -->
                    <section class="categoria-menu">
                        <button class="categoria-titulo"type="button" aria-expanded="false">
                            <span> <i class="fas fa-briefcase"></i>CONCURSOS</span>
                            <i class="fas fa-chevron-right categoria-seta"></i>
                        </button>
                        <div class="categoria-links" hidden>
                            <a href="form_concurso.php"><i class="fas fa-file-signature"></i>Concursos</a>
                            <a href="form_inscricoes.php"><i class="fas fa-clipboard-check"></i>Inscrições</a>
                        </div>
                    </section>
                </div>
            </div>

            <!-- ======================================LISTAR ======================================= -->
            <div class="dropdown medeia-dropdown">
                <button class="item dropdown-btn"type="button" aria-expanded="false" aria-controls="menu-listar">
                    <i class="fas fa-list-check"></i><span>Listar</span>
                    <i class="fas fa-chevron-down seta"></i>
                </button>
                <div class="dropdown-box" id="menu-listar">
                    
                    <!-- REVISTA -->
                    <section class="categoria-menu">
                        <button class="categoria-titulo" type="button" aria-expanded="false">
                            <span><i class="fas fa-newspaper"></i> REVISTA</span>
                            <i class="fas fa-chevron-right categoria-seta"></i>
                        </button>
                        <div class="categoria-links" hidden>
                            <a href="lista_edicoes.php"><i class="fas fa-book-open"></i> Edições</a>
                        </div>
                    </section>

                    <!-- EDITORA -->
                    <section class="categoria-menu">
                        <button class="categoria-titulo" type="button" aria-expanded="false">
                            <span><i class="fas fa-book"></i> EDITORA</span>
                            <i class="fas fa-chevron-right categoria-seta"></i>
                        </button>
                        <div class="categoria-links" hidden>
                            <a href="lista_livros.php"><i class="fas fa-book"></i> Livros</a>
                            <a href="lista_artigos.php"><i class="fas fa-file-lines"></i> Artigos</a>
                            <a href="lista_TA.php"><i class="fas fa-user-graduate"></i> Trabalhos Acadêmicos</a>
                            <a href="lista_autores.php"><i class="fas fa-users"></i> Autores</a>
                        </div>
                    </section>

                    <!-- ASSESSORIA PEDAGÓGICA -->
                    <section class="categoria-menu">
                        <button class="categoria-titulo" type="button" aria-expanded="false">
                            <span><i class="fas fa-graduation-cap"></i> ASSESSORIA PEDAGÓGICA</span>
                            <i class="fas fa-chevron-right categoria-seta"></i>
                        </button>
                        <div class="categoria-links" hidden>
                            <a href="lista_cursos.php"><i class="fas fa-user-graduate"></i> Cursos</a>
                            <a href="lista_palestras.php"><i class="fas fa-chalkboard-teacher"></i> Palestras</a>
                            <a href="lista_eventos.php"><i class="fas fa-file-alt"></i> Eventos</a>
                        </div>
                    </section>

                    <!-- CONCURSOS -->
                    <section class="categoria-menu">
                        <button class="categoria-titulo" type="button" aria-expanded="false">
                            <span><i class="fas fa-briefcase"></i> CONCURSOS</span>
                            <i class="fas fa-chevron-right categoria-seta"></i>
                        </button>
                        <div class="categoria-links" hidden>
                            <a href="lista_concursos.php"><i class="fas fa-file-signature"></i> Concursos</a>
                            <a href="lista_inscricoes.php"><i class="fas fa-clipboard-check"></i> Inscrições</a>
                            <a href="lista_resultados.php"><i class="fas fa-square-poll-vertical"></i> Resultados</a>
                        </div>
                    </section>
                </div>
            </div>
        </div>

        <!-- ======================================USUÁRIO======================================= -->
        <?php
            $rotulos_perfil = [
                'ultra_master' => 'Ultra Master',
                'master'       => 'Master',
                'operador'     => 'Operador',
            ];
            $perfil_atual = perfil_usuario();
            $rotulo_perfil = $rotulos_perfil[$perfil_atual] ?? ucfirst(str_replace('_', ' ', $perfil_atual));
        ?>
        <div class="dropdown usuario-menu">
            <button class="item usuario-botao dropdown-btn" type="button" aria-expanded="false" aria-controls="menu-usuario">
                <span class="usuario-icone"><i class="fas fa-user-shield"></i></span>
                <span class="usuario-info">
                    <strong><?= h(nome_usuario()) ?></strong>
                    <small><?= h($rotulo_perfil) ?></small>
                </span>
                <i class="fas fa-chevron-down seta"></i>
            </button>
            <div class="dropdown-box usuario-box" id="menu-usuario">
                <?php if (eh_admin()): ?>
                    <div class="dropdown-title"><i class="fas fa-shield-halved"></i> Administração</div>
                    <a href="lista_operadores.php"><i class="fas fa-users-gear"></i> Usuários</a>
                    <a href="form_operador.php"><i class="fas fa-user-plus"></i> Novo usuário</a>
                <?php else: ?>
                    <div class="dropdown-title"><i class="fas fa-user"></i> Minha conta</div>
                    <span class="dropdown-info" style="display:block;padding:8px 12px;color:#786978;font-size:13px;">
                        Perfil: <?= h($rotulo_perfil) ?>
                    </span>
                <?php endif; ?>
                <a href="logout.php"><i class="fas fa-right-from-bracket"></i> Sair</a>
            </div>
        </div>

        <!-- SAIR (sempre à direita, mesmo lugar para todos os perfis) -->
        <a href="logout.php" class="sair"><i class="fas fa-right-from-bracket"></i>
            <span>Sair</span>
        </a>
    </div>
</nav>

<!-- =========================================JAVASCRIPT DOS DROPDOWNS========================================= -->
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
