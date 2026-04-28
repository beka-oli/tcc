<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Revista Eletrônica</title>
  <link rel="stylesheet" href="css_adm/re_adm.css">
</head>
<body>

<div class="container">

  <!-- SIDEBAR -->
  <aside class="sidebar">
    <h2 class="logo">Editora</h2>

    <ul>
        <li><a href="dashboard.php">Dashboard</a></li>
        <li><a href="editora_adm.php">Editora</a></li>
        <li class="active"><a href="re_adm.php">Revista Eletrônica</a></li>
        <li><a href="a_concurso_adm.php">Agência de Concursos</a></li>
      <li>Publicações</li>
      <li>Mensagens</li>
      <li>Usuários</li>
      <li>Configurações</li>
      <li>Sair</li>
    </ul>
  </aside>

  <!-- MAIN -->
  <main class="main">

    <!-- TOPBAR -->
    <header class="topbar">
      <h1>Revista Eletrônica</h1>
      <button class="btn">+ Novo Artigo</button>
    </header>

    <!-- CARDS RESUMO -->
    <section class="cards">
      <div class="card">
        <h3>Artigos Publicados</h3>
        <span>38</span>
      </div>

      <div class="card">
        <h3>Em Avaliação</h3>
        <span>12</span>
      </div>

      <div class="card">
        <h3>Rejeitados</h3>
        <span>5</span>
      </div>

      <div class="card">
        <h3>Aprovados</h3>
        <span>21</span>
      </div>
    </section>

    <!-- TABELA -->
    <section class="table-section">

      <div class="table-header">
        <h2>Gerenciar Artigos</h2>
        <input type="text" placeholder="Buscar artigo...">
      </div>

      <table>
        <thead>
          <tr>
            <th>Título</th>
            <th>Autor</th>
            <th>Área</th>
            <th>Data</th>
            <th>Status</th>
            <th>Opções</th>
          </tr>
        </thead>

        <tbody>
          <tr>
            <td>Educação no Brasil</td>
            <td>João Silva</td>
            <td>Educação</td>
            <td>10/03/2024</td>
            <td><span class="status aprovado">Aprovado</span></td>
            <td>
              <button class="btn-sm">Ver</button>
              <button class="btn-sm">Editar</button>
            </td>
          </tr>

          <tr>
            <td>Tecnologia na Escola</td>
            <td>Ana Souza</td>
            <td>Tecnologia</td>
            <td>02/02/2024</td>
            <td><span class="status avaliacao">Em Avaliação</span></td>
            <td>
              <button class="btn-sm">Ver</button>
              <button class="btn-sm">Editar</button>
            </td>
          </tr>

          <tr>
            <td>Metodologias Ativas</td>
            <td>Carlos Lima</td>
            <td>Pedagogia</td>
            <td>15/01/2024</td>
            <td><span class="status rejeitado">Rejeitado</span></td>
            <td>
              <button class="btn-sm">Ver</button>
              <button class="btn-sm">Editar</button>
            </td>
          </tr>
        </tbody>
      </table>

    </section>

  </main>

</div>

</body>
</html>