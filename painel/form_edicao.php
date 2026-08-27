<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <title>Cadastro de Revista</title>
    <?php include 'includes_painel/head.php'; ?>
</head>
<body>
<?php include 'includes_painel/header.php'; ?>

<form id="formID" name="formID" action="cad_revista.php" method="POST">

<div class="card shadow-sm mb-4">
    <div class="card-header"><h5><i class="fas fa-book-open me-2"></i>Dados da Revista</h5></div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label">ISSN</label>
                <input type="text" class="form-control" name="issn" placeholder="Ex.: 2764-1234" maxlength="20" required>
            </div>

            <div class="col-md-8 mb-3">
                <label class="form-label">Nome da Revista</label>
                <input type="text" class="form-control" name="nome" placeholder="Digite o nome da revista" maxlength="255" required>
            </div>

            <div class="col-md-4 mb-3">
                <label class="form-label">Volume</label>
                <input type="number" class="form-control" name="volume" placeholder="Ex.: 5" min="1">
            </div>

            <div class="col-md-4 mb-3">
                <label class="form-label">Número</label>
                <input type="number" class="form-control" name="numero" placeholder="Ex.: 2" min="1">
            </div>

            <div class="col-md-4 mb-3">
                <label class="form-label">Ano</label>
                <input type="number" class="form-control" name="ano" placeholder="Ex.: 2026" min="1900" max="2100" required>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">DOI</label>
                <input type="text" class="form-control" name="doi" placeholder="Ex.: 10.1234/abc.2026">
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Periodicidade</label>
                <select class="form-select" name="periodicidade" required>
                    <option value="">Selecione</option>
                    <option>Anual</option>
                    <option>Semestral</option>
                    <option>Quadrimestral</option>
                    <option>Trimestral</option>
                    <option>Bimestral</option>
                    <option>Mensal</option>
                </select>
            </div>
        </div>
    </div>
</div>

<div class="card shadow-sm mb-4">
    <div class="card-header"><h5><i class="fas fa-users me-2"></i>Equipe Editorial</h5></div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12 mb-3">
                <label class="form-label">Editor-chefe</label>
                <input type="text" class="form-control" name="editor_chefe" placeholder="Nome do editor-chefe" maxlength="255" required>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Conselho Editorial</label>
                <textarea class="form-control" name="conselho" rows="3" placeholder="Digite os membros"></textarea>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Revisores</label>
                <textarea class="form-control" name="revisores" rows="3" placeholder="Digite os nomes"></textarea>
            </div>
        </div>
    </div>
</div>

<div class="card shadow-sm mb-4">
    <div class="card-header"><h5><i class="fas fa-globe me-2"></i>Publicação</h5></div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label">Data da Publicação</label>
                <input type="date" class="form-control" name="data_publicacao">
            </div>

            <div class="col-md-4 mb-3">
                <label class="form-label">Status</label>
                <select class="form-select" name="status" required>
                    <option>Rascunho</option>
                    <option>Em Revisão</option>
                    <option>Publicado</option>
                    <option>Arquivado</option>
                </select>
            </div>

            <div class="col-md-4 mb-3">
                <label class="form-label">Destaque</label>
                <select class="form-select" name="destaque" required>
                    <option value="0">Não</option>
                    <option value="1">Sim</option>
                </select>
            </div>
        </div>
    </div>
</div>

<div class="text-end mb-5">
    <button type="reset" class="btn btn-secondary"><i class="fas fa-eraser"></i> Limpar</button>
    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Salvar Revista</button>
</div>

</form>

<style>
form{max-width:1450px;margin:25px auto}
.card{border:0;border-radius:14px;overflow:hidden;box-shadow:0 5px 18px rgba(0,0,0,.08);margin-bottom:18px}
.card-header{background:linear-gradient(90deg,#b61d45,#8b2cf5);padding:12px 18px}
.card-header h5{margin:0;color:#fff;font-size:17px;font-weight:600}
.card-body{padding:18px}
.form-label{font-size:13px;font-weight:600;color:#555;margin-bottom:4px}
.form-control,.form-select{height:36px;font-size:13px;border-radius:8px;padding:6px 12px;border:1px solid #d8dce5}
textarea.form-control{min-height:70px;resize:vertical}
.mb-3{margin-bottom:12px!important}
.row{--bs-gutter-x:1rem}
.btn{height:38px;font-size:13px;border-radius:8px;padding:0 18px;font-weight:600}
.btn-primary{border:0;background:linear-gradient(90deg,#b61d45,#8b2cf5)}
</style>

<?php include 'includes_painel/footer.php'; ?>
</body>
</html>