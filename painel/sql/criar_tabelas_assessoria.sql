-- ============================================================
-- Tabelas da Assessoria Pedagógica
-- Banco: medeia
-- Execute no phpMyAdmin (aba SQL) ou no MySQL do XAMPP
-- ============================================================

USE medeia;

-- --------------------------------------------------------
-- Tabela: cursos
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `cursos` (
  `id_curso` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) NOT NULL,
  `instrutor` varchar(255) NOT NULL,
  `instituicao` varchar(255) DEFAULT NULL,
  `modalidade` varchar(50) NOT NULL,
  `data_inicio` date NOT NULL,
  `data_fim` date NOT NULL,
  `carga_horaria` int(11) DEFAULT NULL,
  `vagas` int(11) DEFAULT NULL,
  `categoria` varchar(100) NOT NULL,
  `nivel` varchar(50) DEFAULT NULL,
  `descricao` text DEFAULT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Aberto',
  `data_cadastro` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_curso`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Tabela: palestras
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `palestras` (
  `id_palestra` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) NOT NULL,
  `palestrante` varchar(255) NOT NULL,
  `instituicao` varchar(255) DEFAULT NULL,
  `data_palestra` date NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_fim` time DEFAULT NULL,
  `local` varchar(255) NOT NULL,
  `carga_horaria` int(11) DEFAULT NULL,
  `vagas` int(11) DEFAULT NULL,
  `categoria` varchar(100) NOT NULL,
  `descricao` text DEFAULT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Ativa',
  `data_cadastro` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_palestra`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Tabela: eventos
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `eventos` (
  `id_evento` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) NOT NULL,
  `organizador` varchar(255) NOT NULL,
  `tipo` varchar(100) NOT NULL,
  `data_inicio` date NOT NULL,
  `data_fim` date DEFAULT NULL,
  `hora_inicio` time DEFAULT NULL,
  `hora_fim` time DEFAULT NULL,
  `local` varchar(255) NOT NULL,
  `endereco` varchar(255) DEFAULT NULL,
  `vagas` int(11) DEFAULT NULL,
  `descricao` text DEFAULT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Programado',
  `destaque` tinyint(1) NOT NULL DEFAULT 0,
  `data_cadastro` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_evento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
