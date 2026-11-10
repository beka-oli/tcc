# Painel Medeia – pacote ajustado

## Correções incluídas

### Menu Listar = Cadastro
- REVISTA → Edições
- EDITORA → Livros, Artigos, Trabalhos Acadêmicos, Autores
- ASSESSORIA PEDAGÓGICA → Cursos, Palestras, Eventos
- CONCURSOS → Concursos, Inscrições, Resultados

### Botões Alterar / Excluir padronizados
Todas as listagens usam o mesmo estilo da tela de Edições
(class="editar" / class="excluir" com texto + ícone).

### Filtro de status em Livros
- Corrigido problema de encoding (Disponível não filtrava)
- Status alinhados ao formulário: Disponível, Indisponível, Em Empréstimo, Arquivado

### Master / Ultra Master
- Label limpa: Master / Ultra Master
- Master e Ultra Master veem o link Novo usuário

### Novos módulos (Assessoria Pedagógica)
- lista_cursos.php / excluir_curso.php
- lista_palestras.php / excluir_palestra.php
- lista_eventos.php / excluir_evento.php
- sql/criar_tabelas_assessoria.sql

## Instalação

1. Substitua a pasta painel do seu projeto pela pasta tcc/painel deste ZIP.
2. No phpMyAdmin (banco medeia), execute o SQL em:
   painel/sql/criar_tabelas_assessoria.sql
3. Atualize o navegador com Ctrl+F5.
