CRUD - Associação Científica

Arquivos adicionados:
- editar_revista.php / excluir_revista.php
- editar_artigo.php / excluir_artigo.php
- editar_livro.php / excluir_livro.php
- editar_autor.php / excluir_autor.php
- editar_concurso.php / excluir_concurso.php
- editar_inscricao.php / excluir_inscricao.php
- editar_resultado.php / excluir_resultado.php
- editar_trabalho.php / excluir_trabalho.php

Os arquivos lista_*.php já possuíam os links para esses scripts. Basta copiar os novos arquivos para a mesma pasta das listas, mantendo conexao.php, verifica_login.php e includes_painel/ no projeto.

Os scripts de exclusão usam transações quando existem registros relacionados. Artigos removem a relação artigo_autor; inscrições removem resultados relacionados; concursos removem inscrições/resultados; revistas removem artigos/relações/edições.

Importante: faça backup do banco antes de testar exclusões em produção.
