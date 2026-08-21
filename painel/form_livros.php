<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <title>Cadastro de Livro</title>

    <!--------------- HEAD ---------------->
    <?php include 'includes_painel/head.php'?>
    <!------------------------------------->

</head>

<body>

    <!--------------- HEADER ---------------->
    <?php include 'includes_painel/header.php'?>
    <!--------------------------------------->

    <br><br>

    <form id="formID" name="formID" action="cad_livro.php" method="POST">

        <!-- ==========================================
             DADOS DO LIVRO
        =========================================== -->

        <div class="card shadow-sm mb-4">

            <div class="card-header">

                <h5 class="mb-0">
                    <i class="fas fa-book me-2"></i>
                    Dados do Livro
                </h5>

            </div>

            <div class="card-body">

                <div class="row">

                    <!-- Título -->
                    <div class="col-md-8 mb-3">

                        <label for="titulo" class="form-label">
                            Título do Livro
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            id="titulo"
                            name="titulo"
                            placeholder="Digite o título do livro"
                            maxlength="255"
                            required
                        >

                    </div>


                    <!-- ISBN -->
                    <div class="col-md-4 mb-3">

                        <label for="isbn" class="form-label">
                            ISBN
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            id="isbn"
                            name="isbn"
                            placeholder="Ex.: 978-85-12345-67-8"
                            maxlength="20"
                        >

                    </div>


                    <!-- Autor -->
                    <div class="col-md-6 mb-3">

                        <label for="autor" class="form-label">
                            Autor
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            id="autor"
                            name="autor"
                            placeholder="Nome do autor"
                            maxlength="255"
                            required
                        >

                    </div>


                    <!-- Editora -->
                    <div class="col-md-6 mb-3">

                        <label for="editora" class="form-label">
                            Editora
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            id="editora"
                            name="editora"
                            placeholder="Nome da editora"
                            maxlength="255"
                        >

                    </div>


                    <!-- Ano de publicação -->
                    <div class="col-md-4 mb-3">

                        <label for="ano_publicacao" class="form-label">
                            Ano de Publicação
                        </label>

                        <input
                            type="number"
                            class="form-control"
                            id="ano_publicacao"
                            name="ano_publicacao"
                            placeholder="Ex.: 2026"
                            min="1000"
                            max="2100"
                            required
                        >

                    </div>


                    <!-- Número de páginas -->
                    <div class="col-md-4 mb-3">

                        <label for="paginas" class="form-label">
                            Número de Páginas
                        </label>

                        <input
                            type="number"
                            class="form-control"
                            id="paginas"
                            name="paginas"
                            placeholder="Ex.: 320"
                            min="1"
                        >

                    </div>


                    <!-- Edição -->
                    <div class="col-md-4 mb-3">

                        <label for="edicao" class="form-label">
                            Edição
                        </label>

                        <input
                            type="number"
                            class="form-control"
                            id="edicao"
                            name="edicao"
                            placeholder="Ex.: 1"
                            min="1"
                        >

                    </div>

                </div>

            </div>

        </div>


        <!-- ==========================================
             CLASSIFICAÇÃO
        =========================================== -->

        <div class="card shadow-sm mb-4">

            <div class="card-header">

                <h5 class="mb-0">
                    <i class="fas fa-tags me-2"></i>
                    Classificação
                </h5>

            </div>

            <div class="card-body">

                <div class="row">

                    <!-- Categoria -->
                    <div class="col-md-6 mb-3">

                        <label for="categoria" class="form-label">
                            Categoria
                        </label>

                        <select
                            class="form-select"
                            id="categoria"
                            name="categoria"
                            required
                        >

                            <option value="">
                                Selecione a categoria
                            </option>

                            <option value="Romance">
                                Romance
                            </option>

                            <option value="Ficção">
                                Ficção
                            </option>

                            <option value="Fantasia">
                                Fantasia
                            </option>

                            <option value="Aventura">
                                Aventura
                            </option>

                            <option value="Terror">
                                Terror
                            </option>

                            <option value="Biografia">
                                Biografia
                            </option>

                            <option value="História">
                                História
                            </option>

                            <option value="Didático">
                                Didático
                            </option>

                            <option value="Outros">
                                Outros
                            </option>

                        </select>

                    </div>


                    <!-- Idioma -->
                    <div class="col-md-6 mb-3">

                        <label for="idioma" class="form-label">
                            Idioma
                        </label>

                        <select
                            class="form-select"
                            id="idioma"
                            name="idioma"
                            required
                        >

                            <option value="">
                                Selecione o idioma
                            </option>

                            <option value="Português">
                                Português
                            </option>

                            <option value="Inglês">
                                Inglês
                            </option>

                            <option value="Espanhol">
                                Espanhol
                            </option>

                            <option value="Francês">
                                Francês
                            </option>

                            <option value="Outro">
                                Outro
                            </option>

                        </select>

                    </div>


                    <!-- Sinopse -->
                    <div class="col-md-12 mb-3">

                        <label for="sinopse" class="form-label">
                            Sinopse
                        </label>

                        <textarea
                            class="form-control"
                            id="sinopse"
                            name="sinopse"
                            rows="5"
                            placeholder="Digite uma breve descrição do livro"
                        ></textarea>

                    </div>

                </div>

            </div>

        </div>


        <!-- ==========================================
             PUBLICAÇÃO
        =========================================== -->

        <div class="card shadow-sm mb-4">

            <div class="card-header">

                <h5 class="mb-0">
                    <i class="fas fa-calendar-alt me-2"></i>
                    Publicação
                </h5>

            </div>

            <div class="card-body">

                <div class="row">

                    <!-- Data de cadastro -->
                    <div class="col-md-4 mb-3">

                        <label for="data_cadastro" class="form-label">
                            Data de Cadastro
                        </label>

                        <input
                            type="date"
                            class="form-control"
                            id="data_cadastro"
                            name="data_cadastro"
                        >

                    </div>


                    <!-- Status -->
                    <div class="col-md-4 mb-3">

                        <label for="status" class="form-label">
                            Status
                        </label>

                        <select
                            class="form-select"
                            id="status"
                            name="status"
                            required
                        >

                            <option value="Disponível">
                                Disponível
                            </option>

                            <option value="Indisponível">
                                Indisponível
                            </option>

                            <option value="Em manutenção">
                                Em manutenção
                            </option>

                        </select>

                    </div>


                    <!-- Destaque -->
                    <div class="col-md-4 mb-3">

                        <label for="destaque" class="form-label">
                            Destaque
                        </label>

                        <select
                            class="form-select"
                            id="destaque"
                            name="destaque"
                            required
                        >

                            <option value="0">
                                Não
                            </option>

                            <option value="1">
                                Sim
                            </option>

                        </select>

                    </div>

                </div>

            </div>

        </div>


        <!-- ==========================================
             BOTÕES
        =========================================== -->

        <div class="text-end mb-5">

            <button
                type="reset"
                class="btn btn-secondary"
            >

                <i class="fas fa-eraser"></i>
                Limpar

            </button>


            <button
                type="submit"
                class="btn btn-primary"
            >

                <i class="fas fa-save"></i>
                Salvar Livro

            </button>

        </div>

    </form>


    <style>

        /* ===========================
           CONTAINER
        =========================== */

        form {
            max-width: 1450px;
            margin: 25px auto;
        }


        /* ===========================
           CARDS
        =========================== */

        .card {
            border: 0;
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 5px 18px rgba(0,0,0,.08);
            margin-bottom: 18px;
        }


        .card-header {
            background: linear-gradient(90deg,#b61d45,#8b2cf5);
            padding: 12px 18px;
            border: 0;
        }


        .card-header h5 {
            margin: 0;
            color: #fff;
            font-size: 17px;
            font-weight: 600;
        }


        .card-body {
            padding: 18px;
        }


        /* ===========================
           LABELS
        =========================== */

        .form-label {
            font-size: 13px;
            font-weight: 600;
            color: #555;
            margin-bottom: 4px;
        }


        /* ===========================
           INPUTS
        =========================== */

        .form-control,
        .form-select {

            height: 36px;

            font-size: 13px;

            border-radius: 8px;

            padding: 6px 12px;

            border: 1px solid #d8dce5;

            transition: .2s;

        }


        .form-control::placeholder {
            font-size: 12px;
        }


        .form-control:focus,
        .form-select:focus {

            border-color: #8b2cf5;

            box-shadow: 0 0 0 .15rem rgba(139,44,245,.12);

        }


        /* ===========================
           TEXTAREA
        =========================== */

        textarea.form-control {

            min-height: 85px;

            resize: vertical;

            padding-top: 8px;

        }


        /* ===========================
           ESPAÇAMENTO
        =========================== */

        .mb-3 {
            margin-bottom: 12px !important;
        }


        .row {
            --bs-gutter-x: 1rem;
        }


        /* ===========================
           BOTÕES
        =========================== */

        .btn {

            height: 38px;

            font-size: 13px;

            border-radius: 8px;

            padding: 0 18px;

            font-weight: 600;

        }


        .btn-primary {

            border: none;

            background: linear-gradient(90deg,#b61d45,#8b2cf5);

        }


        .btn-primary:hover {

            background: linear-gradient(90deg,#a1173e,#7124ca);

        }


        .text-end {

            margin-top: 20px;

        }

    </style>


    <!---------------FOOTER---------------------->
    <?php include 'includes_painel/footer.php'?>
    <!------------------------------------------->

</body>

</html>