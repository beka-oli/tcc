# Usuários Medeia

## Perfis

| Perfil | Conteúdo | Usuários | Pode criar Master/Ultra |
|---|---|---|---|
| Operador | Sim | Não | Não |
| Master | Sim | Apenas Operador | Não |
| Ultra Master | Sim | Todos | Sim |

### Segurança
- Senhas novas usam `password_hash()`/`password_verify()`.
- Senhas antigas em texto puro são migradas automaticamente no primeiro login.
- Sessão regenerada após autenticação.
- Sessão expira após o tempo definido em `painel/config/config.php`.
- CSRF é usado no login e nos formulários de usuários.
- Usuário inativo não entra no painel.

## Instalação
1. Crie o banco `medeia` e mantenha as tabelas atuais.
2. Execute `painel/sql/usuarios_perfis.sql` uma vez.
3. Configure banco em `painel/config/config.php` (ou substitua as constantes por variáveis de ambiente em produção).
4. Promova seu administrador principal para `ultra_master` usando o UPDATE comentado no SQL.
5. Acesse `login/`.

> O diretório `__legacy_admin` foi removido da versão final para evitar duas cópias do painel.
