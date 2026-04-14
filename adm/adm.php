<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Painel Administrativo</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

  <!-- SIDEBAR -->
  <aside class="sidebar">
    <h2 class="logo">Editora</h2>
    <nav>
      <ul>
        <li class="active"><a href="adm.php">Dashboard</a></li>
        <li><a href="editora_adm.php">Editora</a></li>
        <li><a href="re_adm.php">Revista Eletrônica</a></li>
        <li><a href="a_concurso_adm.php">Agência de Concursos</a></li>
        <li>Publicações</li>
        <li>Mensagens</li>
        <li>Usuários</li>
        <li>Configurações</li>
        <li>Sair</li>
      </ul>
    </nav>
  </aside>

  <!-- MAIN -->
  <main class="main">

    <!-- TOPBAR -->
    <header class="topbar">
      <h1>Dashboard</h1>
      <button class="btn">+ Adicionar Livro</button>
    </header>

    <!-- CARDS -->
    <section class="cards">
      <div class="card">
        <h3>Livros Publicados</h3>
        <span>12</span>
      </div>

      <div class="card">
        <h3>Artigos na Revista</h3>
        <span>38</span>
      </div>

      <div class="card">
        <h3>Concursos Ativos</h3>
        <span>3</span>
      </div>

      <div class="card">
        <h3>Mensagens</h3>
        <span>14</span>
      </div>
    </section>

    <!-- TABELA -->
    <section class="table-section">
      <div class="table-header">
        <h2>Gerenciar Livros</h2>
        <input type="text" placeholder="Buscar livro...">
      </div>

      <table>
        <thead>
          <tr>
            <th>Título</th>
            <th>Autor</th>
            <th>ISBN</th>
            <th>Ano</th>
            <th>Opções</th>
          </tr>
        </thead>

        <tbody>
          <tr>
            <td>Educação Básica</td>
            <td>Marcelo Santos</td>
            <td>978-3-16-148410-0</td>
            <td>2023</td>
            <td><button class="btn-sm">Editar</button></td>
          </tr>

          <tr>
            <td>Psicologia Educacional</td>
            <td>Ana Oliveira</td>
            <td>978-1-343-45662-6</td>
            <td>2022</td>
            <td><button class="btn-sm">Editar</button></td>
          </tr>

          <tr>
            <td>Metodologia Científica</td>
            <td>Carlos Lima</td>
            <td>978-85-123-4678-1</td>
            <td>2021</td>
            <td><button class="btn-sm">Editar</button></td>
          </tr>
        </tbody>
      </table>
    </section>

  </main>

</div>

</body>
</html>