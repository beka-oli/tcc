<?php
include('verifica_login.php');
include('conexao.php');

function total($sql) {
    global $conexao;
    $r = mysqli_query($conexao, $sql);
    return $r ? (mysqli_fetch_assoc($r)['total'] ?? 0) : 0;
}

$total_livros      = total("SELECT COUNT(*) total FROM livros");
$total_revistas    = total("SELECT COUNT(*) total FROM revistas");
$total_concursos   = total("SELECT COUNT(*) total FROM concursos");
$destaque_livros   = total("SELECT COUNT(*) total FROM livros WHERE destaque = 1");
$destaque_revistas = total("SELECT COUNT(*) total FROM revistas WHERE destaque = 1");
$concursos_abertos = total("SELECT COUNT(*) total FROM concursos WHERE status = 'Aberto'");
$total_destaques   = $destaque_livros + $destaque_revistas;

$cards = [
    ['fa-book', 'Total de Livros', $total_livros, 'Livros cadastrados'],
    ['fa-newspaper', 'Total de Revistas', $total_revistas, 'Revistas cadastradas'],
    ['fa-file-alt', 'Total de Concursos', $total_concursos, 'Concursos cadastrados'],
    ['fa-calendar-check', 'Concursos Abertos', $concursos_abertos, 'Inscrições abertas']
];

$destaques = [
    ['fa-star', 'Itens em Destaque', $total_destaques, 'Livros e revistas'],
    ['fa-book-open', 'Livros em Destaque', $destaque_livros, 'Livros destacados'],
    ['fa-newspaper', 'Revistas em Destaque', $destaque_revistas, 'Revistas destacadas']
];
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard | Medeia</title>
    <?php include 'includes_painel/head.php'; ?>

    <style>
        *{box-sizing:border-box}

        body{
            margin:0;
            background:#f8f0fa;
            color:#3c2038
        }

        .dashboard{
            min-height:calc(100vh - 90px);
            padding:55px 6%;
            background:
                radial-gradient(circle at 90% 10%,#b61d4518,transparent 28%),
                radial-gradient(circle at 10% 90%,#8b2cf514,transparent 25%),
                linear-gradient(135deg,#fffaff,#f8effa,#f6eaf7);
            overflow:hidden;
            position:relative
        }

        .dashboard:before,
        .dashboard:after{
            content:"";
            position:absolute;
            border-radius:50%;
            pointer-events:none
        }

        .dashboard:before{
            width:270px;
            height:270px;
            top:-110px;
            right:13%;
            background:#8b2cf514
        }

        .dashboard:after{
            width:150px;
            height:150px;
            bottom:30px;
            left:5%;
            background:#b61d4514
        }

        .dashboard-container{
            max-width:1500px;
            margin:auto;
            position:relative;
            z-index:1
        }

        .dashboard-title{
            margin-bottom:40px
        }

        .dashboard-tag{
            display:inline-block;
            padding:9px 20px;
            margin-bottom:18px;
            border-radius:30px;
            background:#8b2cf51a;
            color:#75145b;
            font-size:12px;
            font-weight:bold;
            letter-spacing:2px;
            text-transform:uppercase
        }

        .dashboard-title h1{
            margin:0;
            font:700 clamp(38px,4vw,58px)/1.05 Georgia,serif;
            color:#511538
        }

        .dashboard-title h1 span{
            background:linear-gradient(90deg,#7b164e,#8b2cf5);
            -webkit-background-clip:text;
            -webkit-text-fill-color:transparent
        }

        .dashboard-title p{
            max-width:650px;
            margin:14px 0 0;
            color:#765f78;
            font-size:16px;
            line-height:1.7
        }

        .dashboard-grid{
            display:grid;
            grid-template-columns:repeat(4,1fr);
            gap:22px;
            margin-bottom:35px
        }

        .dashboard-grid-secondary{
            display:grid;
            grid-template-columns:repeat(3,1fr);
            gap:22px
        }

        .dashboard-card{
            display:flex;
            align-items:center;
            gap:20px;
            min-height:145px;
            padding:25px;
            background:#ffffffdf;
            border:1px solid #7d195c0f;
            border-radius:22px;
            box-shadow:0 12px 35px #521b4714;
            transition:.25s
        }

        .dashboard-card:hover{
            transform:translateY(-5px);
            box-shadow:0 18px 42px #521b4724
        }

        .dashboard-icon{
            width:65px;
            height:65px;
            min-width:65px;
            display:flex;
            align-items:center;
            justify-content:center;
            border-radius:17px;
            background:linear-gradient(135deg,#b61d45,#a21d89,#8b2cf5);
            color:white;
            font-size:25px;
            box-shadow:0 10px 22px #8b2cf533
        }

        .dashboard-card h6{
            margin:0 0 6px;
            color:#654a63;
            font-size:14px
        }

        .dashboard-card h2{
            margin:0;
            font-size:34px;
            font-weight:800;
            background:linear-gradient(90deg,#b61d45,#8b2cf5);
            -webkit-background-clip:text;
            -webkit-text-fill-color:transparent
        }

        .dashboard-card small{
            color:#917e91;
            font-size:12px
        }

        .section-title{
            margin:0 0 18px;
            display:flex;
            align-items:center;
            gap:12px
        }

        .section-title:before{
            content:"";
            width:5px;
            height:28px;
            border-radius:10px;
            background:linear-gradient(#b61d45,#8b2cf5)
        }

        .section-title h3{
            margin:0;
            color:#511538;
            font:24px Georgia,serif
        }

        @media(max-width:1100px){
            .dashboard-grid{grid-template-columns:repeat(2,1fr)}
            .dashboard-grid-secondary{grid-template-columns:repeat(2,1fr)}
        }

        @media(max-width:700px){
            .dashboard{padding:35px 20px}
            .dashboard-grid,
            .dashboard-grid-secondary{grid-template-columns:1fr}
            .dashboard-title h1{font-size:38px}
        }
    </style>
</head>

<body>

<?php include 'includes_painel/header.php'; ?>

<main class="dashboard">
    <div class="dashboard-container">

        <div class="dashboard-title">
            <div class="dashboard-tag">Painel administrativo</div>

            <h1>Dashboard <span>Medeia</span></h1>

            <p>
                Visão geral da plataforma Medeia,
                com informações sobre livros, revistas,
                concursos e conteúdos em destaque.
            </p>
        </div>

        <div class="dashboard-grid">

            <?php foreach ($cards as $card): ?>
                <div class="dashboard-card">
                    <div class="dashboard-icon">
                        <i class="fas <?= $card[0] ?>"></i>
                    </div>

                    <div>
                        <h6><?= $card[1] ?></h6>
                        <h2><?= $card[2] ?></h2>
                        <small><?= $card[3] ?></small>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>

        <div class="section-title">
            <h3>Conteúdos em destaque</h3>
        </div>

        <div class="dashboard-grid-secondary">

            <?php foreach ($destaques as $card): ?>
                <div class="dashboard-card">
                    <div class="dashboard-icon">
                        <i class="fas <?= $card[0] ?>"></i>
                    </div>

                    <div>
                        <h6><?= $card[1] ?></h6>
                        <h2><?= $card[2] ?></h2>
                        <small><?= $card[3] ?></small>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>

    </div>
</main>

<?php include 'includes_painel/footer.php'; ?>

</body>
</html>