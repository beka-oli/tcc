-- ============================================================
-- CORREÇÃO OBRIGATÓRIA: tabela edicoes
-- Erro: Field 'id_edicao' doesn't have a default value
-- Banco: medeia | Execute no phpMyAdmin → SQL
-- ============================================================

USE medeia;

-- 1) AUTO_INCREMENT (resolve o erro principal)
ALTER TABLE `edicoes`
  MODIFY `id_edicao` int(11) NOT NULL AUTO_INCREMENT;

-- 2) id_revista e numero opcionais
ALTER TABLE `edicoes`
  MODIFY `id_revista` int(11) NULL DEFAULT NULL;

ALTER TABLE `edicoes`
  MODIFY `numero` int(11) NULL DEFAULT NULL;

-- 3) Colunas do formulário (se der erro "Duplicate column", ignore e siga)
ALTER TABLE `edicoes` ADD COLUMN `titulo_edicao` varchar(255) NULL DEFAULT NULL;
ALTER TABLE `edicoes` ADD COLUMN `subtitulo` varchar(255) NULL DEFAULT NULL;
ALTER TABLE `edicoes` ADD COLUMN `tema` varchar(255) NULL DEFAULT NULL;
ALTER TABLE `edicoes` ADD COLUMN `tipo_edicao` varchar(100) NULL DEFAULT NULL;
ALTER TABLE `edicoes` ADD COLUMN `doi` varchar(255) NULL DEFAULT NULL;
ALTER TABLE `edicoes` ADD COLUMN `editor_responsavel` varchar(255) NULL DEFAULT NULL;
ALTER TABLE `edicoes` ADD COLUMN `editores_convidados` text NULL;
ALTER TABLE `edicoes` ADD COLUMN `apresentacao` text NULL;
ALTER TABLE `edicoes` ADD COLUMN `idioma` varchar(50) NULL DEFAULT NULL;
ALTER TABLE `edicoes` ADD COLUMN `total_artigos` int(11) NULL DEFAULT NULL;
ALTER TABLE `edicoes` ADD COLUMN `pagina_inicial` int(11) NULL DEFAULT NULL;
ALTER TABLE `edicoes` ADD COLUMN `pagina_final` int(11) NULL DEFAULT NULL;
ALTER TABLE `edicoes` ADD COLUMN `url_edicao` varchar(255) NULL DEFAULT NULL;
ALTER TABLE `edicoes` ADD COLUMN `capa_edicao` varchar(255) NULL DEFAULT NULL;
ALTER TABLE `edicoes` ADD COLUMN `arquivo_pdf` varchar(255) NULL DEFAULT NULL;
ALTER TABLE `edicoes` ADD COLUMN `licenca` varchar(100) NULL DEFAULT NULL;
ALTER TABLE `edicoes` ADD COLUMN `status` varchar(50) NOT NULL DEFAULT 'Rascunho';

-- 4) Preenche título em registros antigos sem título
UPDATE `edicoes`
SET `titulo_edicao` = CONCAT('Edição ', COALESCE(`numero`, `id_edicao`))
WHERE `titulo_edicao` IS NULL OR `titulo_edicao` = '';
