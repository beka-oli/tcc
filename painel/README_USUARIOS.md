# Usuários Medeia
## Perfis
| Perfil        | Conteúdo | Usuários       | Pode criar Master/Ultra |
|---------------|----------|----------------|-------------------------|
| Operador      | Sim      | Não            | Não                     |
| Master        | Sim      | Apenas Operador| Não                     |
| Ultra Master  | Sim      | Todos          | Sim                     |

### Segurança
- Senhas novas usam `password_hash()`/`password_verify()`.
- Senhas antigas em texto puro são migradas automaticamente no primeiro login.
- Sessão regenerada após autenticação.
- Sessão expira após o tempo definido em `painel/config/config.php`.
- CSRF é usado no login e nos formulários de usuários.
- Usuário inativo não entra no painel.