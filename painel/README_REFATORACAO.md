# Refatoração do Painel ADM

Esta versão adiciona uma estrutura centralizada para os módulos de Autores, Livros, Revistas, Concursos e Inscrições.

## Novo fluxo

- `crud/index.php?modulo=autores`
- `crud/index.php?modulo=livros`
- `crud/index.php?modulo=revistas`
- `crud/index.php?modulo=concursos`
- `crud/index.php?modulo=inscricoes`

Cada módulo permite listar, pesquisar, cadastrar, editar e excluir em uma única tela.

## Segurança incluída

- Prepared statements no CRUD e no login.
- Escape de saída com `htmlspecialchars`.
- Token CSRF para operações de escrita.
- IDs validados como inteiros.
- Sessão regenerada no login e periodicamente.
- Senhas novas verificadas com `password_verify`.
- Senhas antigas em texto são migradas automaticamente para `password_hash` no primeiro login bem-sucedido.
- Exclusões do novo CRUD usam POST + CSRF, e não GET.
- Mensagens de erro do banco não são exibidas ao usuário.

## Compatibilidade

Os arquivos antigos permanecem no projeto nesta etapa para não quebrar o sistema. O menu principal do ADM já aponta para o CRUD central nos módulos migrados.

Antes de apagar os arquivos antigos, teste os cinco módulos com uma cópia do banco.
