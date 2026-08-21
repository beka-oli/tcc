<?php
include('verifica_login.php');
include('conexao.php');

function total($conexao, $sql) {
    $resultado = mysqli_query($conexao, $sql);
    return mysqli_fetch_assoc($resultado)['total'];
}

$total_livros = total($conexao, "SELECT COUNT(*) AS total FROM livros");
$total_revistas = total($conexao, "SELECT COUNT(*) AS total FROM revistas");
$total_concursos = total($conexao, "SELECT COUNT(*) AS total FROM concursos");
$destaque_livros = total($conexao, "SELECT COUNT(*) AS total FROM livros WHERE destaque = 1");
$destaque_revistas = total($conexao, "SELECT COUNT(*) AS total FROM revistas WHERE destaque = 1");
$concursos_abertos = total($conexao, "SELECT COUNT(*) AS total FROM concursos WHERE status = 'Aberto'");
$total_destaques = $destaque_livros + $destaque_revistas;
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>DASHBOARD MEDEIA</title>
    <?php include 'includes_painel/head.php'; ?>
</head>
<body>
<?php include 'includes_painel/header.php'; ?>

<main class="dashboard">
<div class="container-fluid">

<div class="dashboard-title">
    <h1>DASHBOARD MEDEIA</h1>
    <p>Visão geral da plataforma Medeia</p>
</div>

<div class="row g-4">

<?php
$cards = [
    ['fa-book', 'Total de Livros', $total_livros, 'Livros cadastrados'],
    ['fa-newspaper', 'Total de Revistas', $total_revistas, 'Revistas cadastradas'],
    ['fa-file-alt', 'Total de Concursos', $total_concursos, 'Concursos cadastrados'],
    ['fa-calendar-check', 'Concursos Abertos', $concursos_abertos, 'Inscrições abertas']
];

foreach ($cards as $card) {
    echo "
    <div class='col-xl-3 col-md-6'>
        <div class='dashboard-card'>
            <div class='dashboard-icon'><i class='fas {$card[0]}'></i></div>
            <div>
                <h6>{$card[1]}</h6>
                <h2>{$card[2]}</h2>
                <small>{$card[3]}</small>
            </div>
        </div>
    </div>";
}
?>

</div>

<div class="row g-4 mt-2">

<?php
$destaques = [
    ['fa-star', 'Itens em Destaque', $total_destaques, 'Livros e revistas'],
    ['fa-book-open', 'Livros em Destaque', $destaque_livros, 'Livros destacados'],
    ['fa-newspaper', 'Revistas em Destaque', $destaque_revistas, 'Revistas destacadas']
];

foreach ($destaques as $card) {
    echo "
    <div class='col-xl-4 col-md-6'>
        <div class='dashboard-card'>
            <div class='dashboard-icon'><i class='fas {$card[0]}'></i></div>
            <div>
                <h6>{$card[1]}</h6>
                <h2>{$card[2]}</h2>
                <small>{$card[3]}</small>
            </div>
        </div>
    </div>";
}
?>

</div>
</div>
</main>

<style>
.dashboard{padding:35px 25px;min-height:70vh}
.dashboard-title{margin-bottom:30px}
.dashboard-title h1{font-size:28px;font-weight:700;margin:0;color:#333}
.dashboard-title p{margin-top:5px;color:#777;font-size:14px}
.dashboard-card{background:#fff;border-radius:14px;padding:20px;display:flex;align-items:center;gap:18px;min-height:125px;box-shadow:0 5px 18px rgba(0,0,0,.08);transition:.2s}
.dashboard-card:hover{transform:translateY(-3px);box-shadow:0 8px 22px rgba(0,0,0,.12)}
.dashboard-icon{width:55px;height:55px;min-width:55px;border-radius:12px;display:flex;align-items:center;justify-content:center;background:linear-gradient(135deg,#b61d45,#8b2cf5);color:#fff;font-size:22px}
.dashboard-card h6{margin:0 0 5px;font-size:14px;color:#555}
.dashboard-card h2{margin:0;font-size:30px;font-weight:700;color:#8b2cf5}
.dashboard-card small{color:#888;font-size:12px}
</style>

<?php include 'includes_painel/footer.php'; ?>
</body>
</html>