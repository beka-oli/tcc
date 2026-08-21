<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <title>Cadastro de Concurso</title>

    <!--------------- HEAD ---------------->
    <?php include 'includes_painel/head.php'?>
    <!------------------------------------->

</head>

<body>

    <!--------------- HEADER ---------------->
    <?php include 'includes_painel/header.php'?>
    <!--------------------------------------->

    <br><br>

    <form id="formID" name="formID" action="cad_concurso.php" method="POST">

        <!-- ==========================================
             DADOS DO CONCURSO
        =========================================== -->

        <div class="card shadow-sm mb-4">

            <div class="card-header">

                <h5 class="mb-0">
                    <i class="fas fa-file-alt me-2"></i>
                    Dados do Concurso
                </h5>

            </div>

            <div class="card-body">

                <div class="row">

                    <!-- Nome do concurso -->
                    <div class="col-md-8 mb-3">

                        <label for="nome" class="form-label">
                            Nome do Concurso
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            id="nome"
                            name="nome"
                            placeholder="Digite o nome do concurso"
                            maxlength="255"
                            required
                        >

                    </div>


                    <!-- Ano -->
                    <div class="col-md-4 mb-3">

                        <label for="ano" class="form-label">
                            Ano
                        </label>

                        <input
                            type="number"
                            class="form-control"
                            id="ano"
                            name="ano"
                            placeholder="Ex.: 2026"
                            min="1900"
                            max="2100"
                            required
                        >

                    </div>


                    <!-- Órgão -->
                    <div class="col-md-6 mb-3">

                        <label for="orgao" class="form-label">
                            Órgão / Instituição
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            id="orgao"
                            name="orgao"
                            placeholder="Ex.: Prefeitura Municipal"
                            maxlength="255"
                            required
                        >

                    </div>


                    <!-- Cargo -->
                    <div class="col-md-6 mb-3">

                        <label for="cargo" class="form-label">
                            Cargo
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            id="cargo"
                            name="cargo"
                            placeholder="Ex.: Técnico em Informática"
                            maxlength="255"
                            required
                        >

                    </div>


                    <!-- Escolaridade -->
                    <div class="col-md-6 mb-3">

                        <label for="escolaridade" class="form-label">
                            Escolaridade
                        </label>

                        <select
                            class="form-select"
                            id="escolaridade"
                            name="escolaridade"
                            required
                        >

                            <option value="">
                                Selecione a escolaridade
                            </option>

                            <option value="Ensino Fundamental">
                                Ensino Fundamental
                            </option>

                            <option value="Ensino Médio">
                                Ensino Médio
                            </option>

                            <option value="Ensino Técnico">
                                Ensino Técnico
                            </option>

                            <option value="Ensino Superior">
                                Ensino Superior
                            </option>

                            <option value="Pós-graduação">
                                Pós-graduação
                            </option>

                        </select>

                    </div>


                    <!-- Número do edital -->
                    <div class="col-md-6 mb-3">

                        <label for="edital" class="form-label">
                            Edital
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            id="edital"
                            name="edital"
                            placeholder="Ex.: Edital nº 01/2026"
                            maxlength="100"
                        >

                    </div>

                </div>

            </div>

        </div>


        <!-- ==========================================
             INSCRIÇÕES E PROVA
        =========================================== -->

        <div class="card shadow-sm mb-4">

            <div class="card-header">

                <h5 class="mb-0">
                    <i class="fas fa-calendar-alt me-2"></i>
                    Inscrições e Prova
                </h5>

            </div>

            <div class="card-body">

                <div class="row">

                    <!-- Início das inscrições -->
                    <div class="col-md-4 mb-3">

                        <label for="data_inscricao_inicio" class="form-label">
                            Início das Inscrições
                        </label>

                        <input
                            type="date"
                            class="form-control"
                            id="data_inscricao_inicio"
                            name="data_inscricao_inicio"
                        >

                    </div>


                    <!-- Fim das inscrições -->
                    <div class="col-md-4 mb-3">

                        <label for="data_inscricao_fim" class="form-label">
                            Fim das Inscrições
                        </label>

                        <input
                            type="date"
                            class="form-control"
                            id="data_inscricao_fim"
                            name="data_inscricao_fim"
                        >

                    </div>


                    <!-- Data da prova -->
                    <div class="col-md-4 mb-3">

                        <label for="data_prova" class="form-label">
                            Data da Prova
                        </label>

                        <input
                            type="date"
                            class="form-control"
                            id="data_prova"
                            name="data_prova"
                        >

                    </div>

                </div>

            </div>

        </div>


        <!-- ==========================================
             INFORMAÇÕES
        =========================================== -->

        <div class="card shadow-sm mb-4">

            <div class="card-header">

                <h5 class="mb-0">
                    <i class="fas fa-info-circle me-2"></i>
                    Informações
                </h5>

            </div>

            <div class="card-body">

                <div class="row">

                    <!-- Descrição -->
                    <div class="col-md-12 mb-3">

                        <label for="descricao" class="form-label">
                            Descrição do Concurso
                        </label>

                        <textarea
                            class="form-control"
                            id="descricao"
                            name="descricao"
                            rows="5"
                            placeholder="Digite informações sobre o concurso"
                        ></textarea>

                    </div>


                    <!-- Status -->
                    <div class="col-md-6 mb-3">

                        <label for="status" class="form-label">
                            Status
                        </label>

                        <select
                            class="form-select"
                            id="status"
                            name="status"
                            required
                        >

                            <option value="Aberto">
                                Aberto
                            </option>

                            <option value="Em andamento">
                                Em andamento
                            </option>

                            <option value="Encerrado">
                                Encerrado
                            </option>

                            <option value="Suspenso">
                                Suspenso
                            </option>

                        </select>

                    </div>


                    <!-- Destaque -->
                    <div class="col-md-6 mb-3">

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
                Salvar Concurso

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