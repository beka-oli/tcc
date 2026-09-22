# Refatoração V2 — Painel ADM

Esta versão remove as páginas administrativas repetitivas do diretório público do painel e concentra cadastro, edição, listagem, pesquisa e exclusão em um CRUD central.

## Acesso

- Login: `/login/`
- Painel: `/painel/dashboard.php`
- CRUD: `/painel/crud/index.php?modulo=autores`

Módulos configurados:

- autores
- livros
- revistas
- concursos
- inscricoes
- artigos
- trabalhos_academicos
- resultados

## Segurança implementada

- Prepared statements nas operações do novo CRUD e no login.
- Lista de módulos permitidos; a URL não pode escolher uma tabela arbitrária.
- CSRF em login, gravação e exclusão.
- Exclusão somente por POST.
- IDs validados como inteiros.
- Sessão com `HttpOnly` e `SameSite=Strict`.
- Regeneração do ID da sessão após autenticação.
- Expiração por inatividade.
- Cabeçalhos básicos de proteção.
- Pastas internas bloqueadas pelo Apache.
- Uploads bloqueiam execução de PHP/PHTML/PHAR/CGI/PL/PY/SH.
- Saída HTML escapada com `htmlspecialchars`.
- Senhas novas usam `password_hash`/`password_verify`.
- Se o banco ainda tiver senha antiga em texto, um login válido converte essa senha para hash automaticamente.
- O JavaScript antigo com `admin/123456` foi removido.

## Arquivos antigos

Os antigos `form_*.php`, `lista_*.php`, `editar_*.php` e `excluir_*.php` foram retirados da pasta pública `painel/` e guardados em `__legacy_admin/`. Essa pasta possui `.htaccess` com `Require all denied`.

Eles não fazem mais parte do fluxo do painel.

## Banco

A conexão continua apontando para o banco local `medeia`, com usuário `root` e senha vazia para manter compatibilidade com o XAMPP. Para produção, altere essas credenciais para variáveis de ambiente/segredos.

A coluna de senha de `operadores` deve suportar pelo menos 255 caracteres. Exemplo:

```sql
ALTER TABLE operadores MODIFY senha_operador VARCHAR(255) NOT NULL;
```

## Importante

Teste primeiro no XAMPP com uma cópia do banco. A estrutura das tabelas existentes deve ser compatível com os campos configurados em `painel/config_crud/modulos.php`.
