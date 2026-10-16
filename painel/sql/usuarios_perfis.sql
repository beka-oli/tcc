-- MEDEIA - usuários e níveis de acesso
-- Execute uma vez no banco `medeia`. Faça backup antes da migração.

CREATE TABLE IF NOT EXISTS operadores (
    id INT NOT NULL AUTO_INCREMENT,
    nome_operador VARCHAR(150) NOT NULL,
    email_operador VARCHAR(190) NOT NULL,
    senha_operador VARCHAR(255) NOT NULL,
    perfil ENUM('operador','master','ultra_master') NOT NULL DEFAULT 'operador',
    status ENUM('Ativo','Inativo') NOT NULL DEFAULT 'Ativo',
    data_cadastro DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    UNIQUE KEY uq_operadores_email (email_operador)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Se a tabela `operadores` já existia, confira se possui estas colunas:
-- id, nome_operador, email_operador, senha_operador, perfil, status, data_cadastro.
-- Aumente senha_operador para VARCHAR(255) antes de usar password_hash().
-- Se houver e-mails duplicados, corrija-os antes de criar a UNIQUE KEY.

-- Perfis:
-- operador    = conteúdo do sistema (cadastros, alterações e listagens).
-- master      = tudo do operador + gerenciamento de operadores.
-- ultra_master= acesso total + criação/alteração/exclusão de Master e Ultra Master.

-- Depois da migração, transforme o administrador principal:
-- UPDATE operadores SET perfil='ultra_master', status='Ativo'
-- WHERE email_operador='SEU_EMAIL';

-- As senhas antigas em texto puro são convertidas automaticamente para
-- password_hash() no primeiro login. Depois, recomenda-se redefini-las.
