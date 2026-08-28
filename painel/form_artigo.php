<form id="formID" name="formID" action="cad_artigo.php" method="POST">

<div class="card shadow-sm mb-4">
    <div class="card-header">
        <h5><i class="fas fa-file-lines me-2"></i>Dados do Artigo</h5>
    </div>

    <div class="card-body">
        <div class="row">

            <div class="col-md-12 mb-3">
                <label class="form-label">Edição</label>

                <select class="form-select" name="id_edicao" required>
                    <option value="">Selecione a edição</option>

                    <?php
                    $sql = "SELECT e.id_edicao, e.numero, e.volume, e.ano,
                                   r.nome
                            FROM edicoes e
                            INNER JOIN revistas r
                                ON e.id_revista = r.id_revista
                            ORDER BY e.ano DESC";

                    $resultado = mysqli_query($conexao, $sql);

                    while ($edicao = mysqli_fetch_assoc($resultado)) {
                    ?>

                        <option value="<?= $edicao['id_edicao'] ?>">
                            <?= htmlspecialchars($edicao['nome']) ?>
                            - Edição <?= $edicao['numero'] ?>
                            - <?= $edicao['ano'] ?>
                        </option>

                    <?php } ?>

                </select>
            </div>

            <div class="col-md-12 mb-3">
                <label class="form-label">Título do Artigo</label>

                <input type="text"
                       class="form-control"
                       name="titulo"
                       placeholder="Digite o título do artigo"
                       maxlength="255"
                       required>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Autores</label>

                <textarea class="form-control"
                          name="autores"
                          rows="3"
                          placeholder="Digite os autores"></textarea>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Palavras-chave</label>

                <textarea class="form-control"
                          name="palavras_chave"
                          rows="3"
                          placeholder="Ex.: Ciência, Tecnologia, Pesquisa"></textarea>
            </div>

            <div class="col-md-12 mb-3">
                <label class="form-label">Resumo</label>

                <textarea class="form-control"
                          name="resumo"
                          rows="5"
                          placeholder="Digite o resumo do artigo"></textarea>
            </div>

            <div class="col-md-4 mb-3">
                <label class="form-label">Páginas</label>

                <input type="text"
                       class="form-control"
                       name="paginas"
                       placeholder="Ex.: 10-25">
            </div>

            <div class="col-md-4 mb-3">
                <label class="form-label">DOI</label>

                <input type="text"
                       class="form-control"
                       name="doi"
                       placeholder="Ex.: 10.1234/abc.2026">
            </div>

            <div class="col-md-4 mb-3">
                <label class="form-label">Status</label>

                <select class="form-select" name="status" required>
                    <option value="">Selecione</option>
                    <option>Rascunho</option>
                    <option>Em Revisão</option>
                    <option>Publicado</option>
                    <option>Arquivado</option>
                </select>
            </div>

        </div>
    </div>
</div>

<div class="text-end mb-5">

    <button type="reset" class="btn btn-secondary">
        <i class="fas fa-eraser"></i> Limpar
    </button>

    <button type="submit" class="btn btn-primary">
        <i class="fas fa-save"></i> Salvar Artigo
    </button>

</div>

</form>