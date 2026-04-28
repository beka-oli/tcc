<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Associação Científica Medeia</title>

    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet"/>

    <style>
      body {
        font-family: "Poppins", sans-serif;
        background: #f5f1fa;
      }

      /* NAVBAR */
      .logo {
        height: 30px;
        width: auto;
      }

      .navbar {
        background: #fff;
        padding: 15px 0;
      }

      .navbar .nav-link {
        color: #5c2c83;
        font-weight: 500;
        transition: 0.3s;
        border-radius: 8px;
      }

      .navbar .nav-link:hover {
        background: #ede7f6;
        transform: translateY(-2px);
      }

      /* HERO */
      .hero {
        background: linear-gradient(120deg, #f3edf9, #ffffff);
        padding: 100px 0;
        position: relative;
        overflow: hidden;
      }

      .hero::after {
        content: "";
        position: absolute;
        width: 300px;
        height: 300px;
        background: #e1bee7;
        border-radius: 50%;
        top: -80px;
        right: -80px;
        opacity: 0.3;
      }

      .hero h1 {
        color: #5c2c83;
        font-weight: 700;
      }

      .hero h5 {
        color: #6d5c7d;
        margin: 15px 0;
      }

      .hero p {
        color: #6f6f6f;
        max-width: 500px;
      }

      .btn-main {
        background: linear-gradient(45deg, #c62839, #7b1fa2);
        color: #fff;
        border-radius: 12px;
        padding: 12px 28px;
        font-weight: 600;
        transition: 0.3s;
      }

      .btn-main:hover {
        transform: scale(1.05);
        opacity: 0.9;
      }

      /* SERVIÇOS */
      .section-title {
        text-align: center;
        margin: 70px 0 40px;
        color: #5c2c83;
        font-weight: 700;
      }

      .card {
        border: none;
        border-radius: 20px;
        padding: 25px;
        text-align: center;
        background: #fff;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
        transition: 0.3s;
        cursor: pointer;
      }

      .card:hover {
        transform: translateY(-10px) scale(1.03);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
      }

      .card i {
        font-size: 40px;
        color: #5c2c83;
        margin-bottom: 15px;
        transition: 0.3s;
      }

      .card:hover i {
        transform: rotate(10deg) scale(1.2);
        color: #7b1fa2;
      }

      .card h5 {
        color: #5c2c83;
        font-weight: 600;
      }

      .card p {
        color: #777;
      }

      /* SOBRE */
      .about {
        padding: 80px 0;
      }

      .about h3 {
        color: #5c2c83;
        font-weight: 700;
      }

      .about p {
        color: #666;
      }

      /* CONTATO */
      .contact {
        padding: 80px 0;
      }

      .contact h4 {
        color: #5c2c83;
        font-weight: 700;
      }

      .form-control {
        border-radius: 12px;
        padding: 12px;
        transition: 0.3s;
      }

      .form-control:focus {
        box-shadow: 0 0 0 2px #d1c4e9;
        border-color: #7b1fa2;
      }

      .btn-send {
        background: linear-gradient(to right, #c62839, #7b1fa2);
        color: #fff;
        border-radius: 12px;
        padding: 12px;
        font-weight: 600;
        transition: 0.3s;
      }

      .btn-send:hover {
        transform: scale(1.03);
        opacity: 0.95;
      }

      /* IMAGENS */
      img {
        transition: 0.4s;
      }

      img:hover {
        transform: scale(1.03);
      }

      /* FOOTER */
      .footer {
        background: linear-gradient(45deg, #4b1f73, #7b1fa2);
        color: #fff;
        text-align: center;
        padding: 25px;
        margin-top: 40px;
        font-size: 14px;
      }
    </style>
  </head>

  <body>
    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg shadow-sm">
      <div class="container">

        <a class="navbar-brand d-flex align-items-center fw-bold" style="color: #c62839;">
          <img src="midias/img/logo.png" alt="Medeia" class="me-2 logo">
          AC Medeia
        </a>

        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#menu">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="menu">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item"><a class="nav-link btn btn-custom mx-1" href="#inicio">Início</a></li>
            <li class="nav-item"><a class="nav-link btn btn-custom mx-1" href="#sobre">Sobre</a></li>
            <li class="nav-item"><a class="nav-link btn btn-custom mx-1" href="#servicos">Serviços</a></li>
            <li class="nav-item"><a class="nav-link btn btn-custom mx-1" href="#publicacoes">Publicações</a></li>
            <li class="nav-item"><a class="nav-link btn btn-custom mx-1" href="#contato">Contato</a></li>
            <li class="nav-item"><a class="nav-link btn btn-custom mx-1" href="adm/login.php">Adm</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- HERO -->
    <section class="hero"> 
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-6">
            <h1>Associação Científica Medeia</h1>
            <h5>Caráter cultural, pedagógico e midiático</h5>
            <p>
              Objetivamos promover a ciência, atividades de formação,
              publicações e ações de concursos públicos e privados.
            </p>
            <button class="btn btn-main mt-3">Saiba Mais</button>
          </div>

          <div class="col-md-6 text-center">
            <img src="https://images.unsplash.com/photo-1581090700227-1e8a9f3c9c3a" class="img-fluid" style="max-height: 400px; opacity: 0.9"/>
          </div>
        </div>
      </div>
    </section>

    <!-- SERVIÇOS -->
    <h2 class="section-title">Nossos Serviços</h2>

    <div class="container">
      <div class="row g-4">

        <div class="col-md-3">
          <a href="editora.html" class="text-decoration-none">
            <div class="card">
              <i class="fa-solid fa-book-open"></i>
              <h5>Editora</h5>
              <p>Publicação de livros e materiais acadêmicos.</p>
            </div>
          </a>
        </div>

        <div class="col-md-3">
          <a href="revista.html" class="text-decoration-none">
            <div class="card">
              <i class="fa-solid fa-laptop"></i>
              <h5>Revista Eletrônica</h5>
              <p>Revista científica online com artigos inéditos.</p>
            </div>
          </a>
        </div>

        <div class="col-md-3">
          <a href="concursos.html" class="text-decoration-none">
            <div class="card">
              <i class="fa-solid fa-clipboard-list"></i>
              <h5>Agência de Concursos</h5>
              <p>Organização e realização de concursos públicos e privados.</p>
            </div>
          </a>
        </div>

        <div class="col-md-3">
          <a href="assessoria.html" class="text-decoration-none">
            <div class="card">
              <i class="fa-solid fa-graduation-cap"></i>
              <h5>Assessoria Pedagógica</h5>
              <p>Consultoria em projetos educacionais e científicos.</p>
            </div>
          </a>
        </div>

      </div>
    </div>

    <!-- SOBRE -->
    <section class="about">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-6">
            <h3>Quem Somos</h3>
            <p>
              A Associação Científica Medeia é uma organização de caráter
              cultural, pedagógico e midiático, dedicada à promoção da ciência,
              atividades de formação, publicações e ações de concursos públicos
              e privados.
            </p>
          </div>

          <div class="col-md-6">
            <img src="https://images.unsplash.com/photo-1519389950473-47ba0277781c" class="img-fluid rounded"/>
          </div>
        </div>
      </div>
    </section>

    <!-- CONTATO -->
    <section class="contact">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <h4>Contato</h4>
            <p>
              Av. 20 de Dezembro, 539 – Centro<br />
              Cerro Grande - RS - 93340-000
            </p>
            <p>(55) 99101-2088</p>
            <p>associacaocientificamedeia@gmail.com</p>
          </div>

          <div class="col-md-6">
            <form>
              <input type="text" class="form-control mb-3" placeholder="Nome"/>
              <input type="email" class="form-control mb-3" placeholder="E-mail"/>
              <input type="text" class="form-control mb-3" placeholder="Assunto"/>
              <textarea class="form-control mb-3" rows="4" placeholder="Mensagem"></textarea>
              <button class="btn btn-send w-100">Enviar Mensagem</button>
            </form>
          </div>
        </div>
      </div>
    </section>

    <!-- FOOTER -->
    <div class="footer">
      <p>© 2024 Associação Científica Medeia. Todos os direitos reservados.</p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>