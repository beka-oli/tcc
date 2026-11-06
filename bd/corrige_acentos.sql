-- Corrige textos gravados com acentuação dupla-codificada (ex.: "DisponÃ­vel" -> "Disponível").
-- Só altera linhas que contêm o padrão corrompido "Ã" (bytes C3 83); textos corretos não são tocados.
-- FAÇA BACKUP (Exportar no phpMyAdmin) antes de rodar.

USE medeia;
SET NAMES utf8mb4;

-- Macro usada em cada linha:
--   CONVERT(CAST(CONVERT(col USING latin1) AS BINARY) USING utf8mb4)
-- desfaz uma conversão UTF-8 -> latin1 -> UTF-8 aplicada por engano.

-- LIVROS
UPDATE livros SET titulo   = CONVERT(CAST(CONVERT(titulo   USING latin1) AS BINARY) USING utf8mb4) WHERE CAST(titulo   AS BINARY) LIKE CONCAT('%', UNHEX('C383'), '%');
UPDATE livros SET autor    = CONVERT(CAST(CONVERT(autor    USING latin1) AS BINARY) USING utf8mb4) WHERE CAST(autor    AS BINARY) LIKE CONCAT('%', UNHEX('C383'), '%');
UPDATE livros SET editora  = CONVERT(CAST(CONVERT(editora  USING latin1) AS BINARY) USING utf8mb4) WHERE CAST(editora  AS BINARY) LIKE CONCAT('%', UNHEX('C383'), '%');
UPDATE livros SET categoria= CONVERT(CAST(CONVERT(categoria USING latin1) AS BINARY) USING utf8mb4) WHERE CAST(categoria AS BINARY) LIKE CONCAT('%', UNHEX('C383'), '%');
UPDATE livros SET idioma   = CONVERT(CAST(CONVERT(idioma   USING latin1) AS BINARY) USING utf8mb4) WHERE CAST(idioma   AS BINARY) LIKE CONCAT('%', UNHEX('C383'), '%');
UPDATE livros SET sinopse  = CONVERT(CAST(CONVERT(sinopse  USING latin1) AS BINARY) USING utf8mb4) WHERE CAST(sinopse  AS BINARY) LIKE CONCAT('%', UNHEX('C383'), '%');
UPDATE livros SET status   = CONVERT(CAST(CONVERT(status   USING latin1) AS BINARY) USING utf8mb4) WHERE CAST(status   AS BINARY) LIKE CONCAT('%', UNHEX('C383'), '%');

-- REVISTAS
UPDATE revistas SET nome          = CONVERT(CAST(CONVERT(nome          USING latin1) AS BINARY) USING utf8mb4) WHERE CAST(nome          AS BINARY) LIKE CONCAT('%', UNHEX('C383'), '%');
UPDATE revistas SET periodicidade = CONVERT(CAST(CONVERT(periodicidade USING latin1) AS BINARY) USING utf8mb4) WHERE CAST(periodicidade AS BINARY) LIKE CONCAT('%', UNHEX('C383'), '%');
UPDATE revistas SET editor_chefe  = CONVERT(CAST(CONVERT(editor_chefe  USING latin1) AS BINARY) USING utf8mb4) WHERE CAST(editor_chefe  AS BINARY) LIKE CONCAT('%', UNHEX('C383'), '%');
UPDATE revistas SET conselho      = CONVERT(CAST(CONVERT(conselho      USING latin1) AS BINARY) USING utf8mb4) WHERE CAST(conselho      AS BINARY) LIKE CONCAT('%', UNHEX('C383'), '%');
UPDATE revistas SET revisores     = CONVERT(CAST(CONVERT(revisores     USING latin1) AS BINARY) USING utf8mb4) WHERE CAST(revisores     AS BINARY) LIKE CONCAT('%', UNHEX('C383'), '%');
UPDATE revistas SET status        = CONVERT(CAST(CONVERT(status        USING latin1) AS BINARY) USING utf8mb4) WHERE CAST(status        AS BINARY) LIKE CONCAT('%', UNHEX('C383'), '%');

-- Conferência: deve mostrar "Disponível" e "Em Revisão" corretos.
SELECT id_livro, titulo, status FROM livros;
SELECT id_revista, nome, status FROM revistas;
