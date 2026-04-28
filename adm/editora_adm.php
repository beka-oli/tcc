<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Editora</title>
  <link rel="stylesheet" href="css_adm/editora_adm.css">
</head>
<body>

<div class="container">

  <!-- SIDEBAR -->
  <aside class="sidebar">
    <h2 class="logo">ADM</h2>

    <ul>
      <li><a href="dashboard.php" style="text-decoration: none; color: white;">Dashboard</a></li>
      <li class="active"<a href="editora_adm.php"> style="text-decoration: none; color: white;">Editora</a></li>
      <li><a href="re_adm.php" style="text-decoration: none; color: white;">Revista Eletrônica</a></li>
      <li><a href="a_concurso_adm.php" style="text-decoration: none; color: white;">Agência de Concursos</a></li>
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
      <h1>Editora</h1>
      <button class="btn">+ Adicionar Material</button>
    </header>

    <!-- TABELA -->
    <section class="table-section">

      <div class="table-header">
        <h2>Materiais Publicados</h2>
        <input type="text" placeholder="Buscar material...">
      </div>

      <table>
        <thead>
          <tr>
            <th>Título</th>
            <th>Autor</th>
            <th>ISBN</th>
            <th>Ano</th>
            <th>Status</th>
            <th>Opções</th>
          </tr>
        </thead>

        <tbody>
          <tr>
            <td>Publicação Educacional</td>
            <td>Marcelo Costa</td>
            <td>978-85-16-2589-7</td>
            <td>2023</td>
            <td><span class="status ativo">Ativo</span></td>
            <td>
              <button class="btn-sm">Editar</button>
              <button class="btn-sm delete">Excluir</button>
            </td>
          </tr>

          <tr>
            <td>Educação Moderna</td>
            <td>Erica Oliveira</td>
            <td>978-33-8756-345</td>
            <td>2022</td>
            <td><span class="status inativo">Inativo</span></td>
            <td>
              <button class="btn-sm">Editar</button>
              <button class="btn-sm delete">Excluir</button>
            </td>
          </tr>

          <tr>
            <td>Didática Aplicada</td>
            <td>Pedro Lima</td>
            <td>978-99-2345-889</td>
            <td>2021</td>
            <td><span class="status ativo">Ativo</span></td>
            <td>
              <button class="btn-sm">Editar</button>
              <button class="btn-sm delete">Excluir</button>
            </td>
          </tr>
        </tbody>
      </table>

    </section>

  </main>

</div>

</body>
</html>