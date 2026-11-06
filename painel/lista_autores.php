<?php
    include 'verifica_login.php';
    include 'conexao.php';

    // Garante a comunicação com o MySQL em UTF-8 completo.
    mysqli_set_charset($conexao, 'utf8mb4');

    $busca = trim((string)($_GET['busca'] ?? ''));
    $b = mysqli_real_escape_string($conexao, $busca);

    $where = $busca
        ? "WHERE (
            CONVERT(nome USING utf8mb4) COLLATE utf8mb4_unicode_ci LIKE '%$b%'
            OR CONVERT(email USING utf8mb4) COLLATE utf8mb4_unicode_ci LIKE '%$b%'
            OR CONVERT(instituicao USING utf8mb4) COLLATE utf8mb4_unicode_ci LIKE '%$b%'
            OR CONVERT(especialidade USING utf8mb4) COLLATE utf8mb4_unicode_ci LIKE '%$b%'
          )"
        : '';

    $resultado = mysqli_query(
        $conexao,"SELECT *FROM autores $where ORDER BY id_autor DESC  ");
    $total = mysqli_num_rows($resultado);

    $stats = mysqli_fetch_assoc(
        mysqli_query(
            $conexao,
            "
                SELECT
                    COUNT(*) AS total,
                    COUNT(DISTINCT NULLIF(instituicao, '')) AS instituicoes,
                    COUNT(DISTINCT NULLIF(especialidade, '')) AS especialidades,
                    SUM(email IS NOT NULL AND email <> '') AS emails
                FROM autores
            "
        )
    );

    $cards = [
        ['users', 'roxo', 'Total de Autores', 'total', 'Cadastrados'],
        ['building', 'verde', 'Instituições', 'instituicoes', 'Registradas'],
        ['graduation-cap', 'amarelo', 'Especialidades', 'especialidades', 'Registradas'],
        ['envelope', 'vermelho', 'E-mails', 'emails', 'Cadastrados']
    ];
?>

<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Autores</title>
        <?php include 'includes_painel/head.php'; ?>
    </head>
    <body>
        <?php include 'includes_painel/header.php'; ?>
        <div class="container">
            <!-- CABEÇALHO -->
            <div class="topo">
                <div class="titulo">
                    <div class="icone">
                        <i class="fas fa-user-edit"></i>
                    </div>
                    <div>
                        <h1>Autores</h1>
                        <p> Gerencie os autores cadastrados no sistema</p>
                    </div>
                </div>
            </div>
            <!-- BUSCA -->
            <div class="card filtros">
                <form method="GET">
                    <div class="campo">
                        <label>Buscar</label>
                        <input type="text"name="busca"value="<?= h($busca) ?>" placeholder="Nome, e-mail, instituição ou especialidade..." >
                    </div>
                    <button type="submit"class="btn btn-primary">
                        <i class="fas fa-search"></i>
                        Buscar
                    </button>
                    <a href="lista_autores.php"class="btn limpar">
                        <i class="fas fa-sync-alt"></i> Limpar
                    </a>
                </form>
            </div>
            <!-- ESTATÍSTICAS -->
            <div class="card estatisticas">
                <?php foreach ($cards as $c): ?>
                    <div>
                        <i class="fas fa-<?= $c[0] ?> <?= $c[1] ?>"></i>
                        <section>
                            <span>
                                <?= $c[2] ?>
                            </span>
                            <strong>
                                <?= $stats[$c[3]] ?? 0 ?>
                            </strong>
                            <small>
                                <?= $c[4] ?>
                            </small>
                        </section>
                    </div>
                <?php endforeach; ?>
            </div>
            <!-- TABELA -->
            <div class="card tabela">
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>E-mail</th>
                                <th>Instituição</th>
                                <th>Especialidade</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($total): ?>
                                <?php while ($r = mysqli_fetch_assoc($resultado)): ?>
                                    <tr>
                                        <td>
                                            <?= $r['id_autor'] ?>
                                        </td>
                                        <td class="nome">
                                            <?= h($r['nome'] ?? '') ?>
                                        </td>
                                        <td>
                                            <?= h($r['email'] ?: '—') ?>
                                        </td>
                                        <td>
                                            <?= h($r['instituicao'] ?: '—') ?>
                                        </td>
                                        <td>
                                            <?= h($r['especialidade'] ?: '—') ?>
                                        </td>
                                        <!-- AÇÕES -->
                                        <td class="acoes">
                                            <a href="editar_autor.php?id=<?= $r['id_autor'] ?>" class="editar"title="Editar autor">
                                                <i class="fas fa-pen-to-square"></i>
                                                Alterar
                                            </a>
                                            <a href="excluir_autor.php?id=<?= $r['id_autor'] ?>&csrf_token=<?= h(csrf_token()) ?>" class="excluir" title="Excluir autor" onclick="return confirm('Deseja realmente excluir este autor?')">
                                                <i class="fas fa-trash"></i>
                                                Excluir
                                            </a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6"class="vazio">
                                        <i class="fas fa-user-slash"></i>
                                        Nenhum autor encontrado.
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <!-- RODAPÉ DA TABELA -->
                <div class="rodape">
                    Mostrando
                    <b>
                        <?= $total ?>
                    </b>
                    autor(es)
                </div>
            </div>
        </div>
        <?php include 'includes_painel/footer.php'; ?>
    </body>
</html>