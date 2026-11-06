-- MariaDB dump 10.17  Distrib 10.4.6-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: medeia
-- ------------------------------------------------------
-- Server version	10.4.6-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `artigo_autor`
--

DROP TABLE IF EXISTS `artigo_autor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `artigo_autor` (
  `id_artigo` int(11) NOT NULL,
  `id_autor` int(11) NOT NULL,
  `ordem_autor` int(11) DEFAULT 1,
  PRIMARY KEY (`id_artigo`,`id_autor`),
  KEY `fk_artigo_autor_autor` (`id_autor`),
  CONSTRAINT `fk_artigo_autor_artigo` FOREIGN KEY (`id_artigo`) REFERENCES `artigos` (`id_artigo`) ON DELETE CASCADE,
  CONSTRAINT `fk_artigo_autor_autor` FOREIGN KEY (`id_autor`) REFERENCES `autores` (`id_autor`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `artigo_autor`
--

LOCK TABLES `artigo_autor` WRITE;
/*!40000 ALTER TABLE `artigo_autor` DISABLE KEYS */;
INSERT INTO `artigo_autor` VALUES (1,1,1),(1,2,2),(2,3,1),(3,5,1);
/*!40000 ALTER TABLE `artigo_autor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `artigos`
--

DROP TABLE IF EXISTS `artigos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `artigos` (
  `id_artigo` int(11) NOT NULL AUTO_INCREMENT,
  `id_edicao` int(11) NOT NULL,
  `titulo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `autores` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `palavras_chave` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `resumo` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `paginas` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `doi` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(50) COLLATE utf8_unicode_ci DEFAULT 'Rascunho',
  `dt_cad_artigo` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_artigo`),
  KEY `fk_artigo_edicao` (`id_edicao`),
  CONSTRAINT `fk_artigo_edicao` FOREIGN KEY (`id_edicao`) REFERENCES `edicoes` (`id_edicao`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `artigos`
--

LOCK TABLES `artigos` WRITE;
/*!40000 ALTER TABLE `artigos` DISABLE KEYS */;
INSERT INTO `artigos` VALUES (1,1,'A Importância da Pesquisa Científica','Ana Souza; Carlos Lima','Ciência, Pesquisa, Educação','Artigo sobre a importância da pesquisa científica para o desenvolvimento da sociedade.','10-25','10.1234/artigo.2026.001','Publicado','2026-08-28 02:35:43'),(2,1,'Tecnologia na Educação','Maria Santos; João Silva','Tecnologia, Educação, Inovação','Análise da utilização de tecnologias no processo educacional.','26-40','10.1234/artigo.2026.002','Publicado','2026-08-28 02:35:43'),(3,2,'Novas Perspectivas Científicas','Pedro Costa','Ciência, Inovação','Discussão sobre novas perspectivas para a produção científica.','5-18','10.1234/artigo.2026.003','Em Revisão','2026-08-28 02:35:43');
/*!40000 ALTER TABLE `artigos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `autores`
--

DROP TABLE IF EXISTS `autores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `autores` (
  `id_autor` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `biografia` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `foto` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `instituicao` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `especialidade` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_autor`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `autores`
--

LOCK TABLES `autores` WRITE;
/*!40000 ALTER TABLE `autores` DISABLE KEYS */;
INSERT INTO `autores` VALUES (1,'Ana Souza',NULL,NULL,NULL,NULL,NULL,'2026-08-28 02:33:17'),(2,'Carlos Lima',NULL,NULL,NULL,NULL,NULL,'2026-08-28 02:33:17'),(3,'Maria Santos',NULL,NULL,NULL,NULL,NULL,'2026-08-28 02:33:17'),(5,'Pedro Costa',NULL,NULL,'ronaldoaraujooliveira18@gmail.com','CEEDO','','2026-08-28 02:33:17');
/*!40000 ALTER TABLE `autores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `concursos`
--

DROP TABLE IF EXISTS `concursos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `concursos` (
  `id_concurso` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `orgao` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cargo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `escolaridade` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `edital` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ano` int(11) NOT NULL,
  `data_inscricao_inicio` date DEFAULT NULL,
  `data_inscricao_fim` date DEFAULT NULL,
  `data_prova` date DEFAULT NULL,
  `descricao` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(50) COLLATE utf8_unicode_ci DEFAULT 'Aberto',
  `destaque` tinyint(1) DEFAULT 0,
  `dt_cad_concurso` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id_concurso`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `concursos`
--

LOCK TABLES `concursos` WRITE;
/*!40000 ALTER TABLE `concursos` DISABLE KEYS */;
INSERT INTO `concursos` VALUES (1,'Concurso Público Municipal','Prefeitura Municipal','Técnico em Informática','Ensino Técnico','Edital nº 01/2026',2026,'2026-08-01','2026-09-15','2026-10-10','Concurso público para contratação de profissionais.','Aberto',1,'2026-08-27 23:36:20'),(2,'Concurso Administrativo','Universidade Medeia','Assistente Administrativo','Ensino Médio','Edital nº 02/2026',2026,'2026-07-01','2026-08-30','2026-09-20','Seleção para área administrativa.','Em andamento',0,'2026-08-27 23:36:20');
/*!40000 ALTER TABLE `concursos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `edicoes`
--

DROP TABLE IF EXISTS `edicoes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `edicoes` (
  `id_edicao` int(11) NOT NULL AUTO_INCREMENT,
  `id_revista` int(11) NOT NULL,
  `numero` int(11) NOT NULL,
  `volume` int(11) DEFAULT NULL,
  `ano` int(11) NOT NULL,
  `data_publicacao` date DEFAULT NULL,
  `descricao` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `destaque` tinyint(1) DEFAULT 0,
  `dt_cad_edicao` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_edicao`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `edicoes`
--

LOCK TABLES `edicoes` WRITE;
/*!40000 ALTER TABLE `edicoes` DISABLE KEYS */;
INSERT INTO `edicoes` VALUES (1,1,1,5,2026,'2026-06-15','Primeira edição da Revista Medeia de Ciência.',1,'2026-08-28 02:33:59'),(2,1,2,5,2026,'2026-08-15','Segunda edição da Revista Medeia de Ciência.',0,'2026-08-28 02:33:59'),(4,1,1,5,2026,'2026-06-15','Primeira edição da Revista Medeia de Ciência.',1,'2026-08-28 02:35:17'),(5,1,2,5,2026,'2026-08-15','Segunda edição da Revista Medeia de Ciência.',0,'2026-08-28 02:35:17');
/*!40000 ALTER TABLE `edicoes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inscricoes`
--

DROP TABLE IF EXISTS `inscricoes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inscricoes` (
  `id_inscricao` int(11) NOT NULL AUTO_INCREMENT,
  `id_concurso` int(11) NOT NULL,
  `nome` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `telefone` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cpf` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `instituicao` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `categoria` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `arquivo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` enum('pendente','aprovada','rejeitada') COLLATE utf8_unicode_ci DEFAULT 'pendente',
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_inscricao`),
  KEY `id_concurso` (`id_concurso`),
  CONSTRAINT `inscricoes_ibfk_1` FOREIGN KEY (`id_concurso`) REFERENCES `concursos` (`id_concurso`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inscricoes`
--

LOCK TABLES `inscricoes` WRITE;
/*!40000 ALTER TABLE `inscricoes` DISABLE KEYS */;
INSERT INTO `inscricoes` VALUES (1,1,'João da Silva','joao.silva@email.com','(11) 99999-1111','123.456.789-00','Universidade Medeia','Ampla Concorrência',NULL,'pendente','2026-08-28 02:37:56'),(2,1,'Maria Oliveira','maria.oliveira@email.com','(11) 98888-2222','234.567.890-11','Faculdade Medeia','Ampla Concorrência',NULL,'aprovada','2026-08-28 02:37:56'),(3,2,'Carlos Santos','carlos.santos@email.com','(11) 97777-3333','345.678.901-22','Universidade Federal','Cotas',NULL,'pendente','2026-08-28 02:37:56'),(4,2,'Ana Costa','ana.costa@email.com','(11) 96666-4444','456.789.012-33','Instituto Medeia','Ampla Concorrência',NULL,'rejeitada','2026-08-28 02:37:56');
/*!40000 ALTER TABLE `inscricoes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `livro_autor`
--

DROP TABLE IF EXISTS `livro_autor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `livro_autor` (
  `id_livro` int(11) NOT NULL,
  `id_autor` int(11) NOT NULL,
  PRIMARY KEY (`id_livro`,`id_autor`),
  KEY `id_autor` (`id_autor`),
  CONSTRAINT `livro_autor_ibfk_1` FOREIGN KEY (`id_livro`) REFERENCES `livros` (`id_livro`) ON DELETE CASCADE,
  CONSTRAINT `livro_autor_ibfk_2` FOREIGN KEY (`id_autor`) REFERENCES `autores` (`id_autor`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `livro_autor`
--

LOCK TABLES `livro_autor` WRITE;
/*!40000 ALTER TABLE `livro_autor` DISABLE KEYS */;
INSERT INTO `livro_autor` VALUES (1,1);
/*!40000 ALTER TABLE `livro_autor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `livros`
--

DROP TABLE IF EXISTS `livros`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `livros` (
  `id_livro` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `isbn` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `autor` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `editora` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ano_publicacao` int(11) NOT NULL,
  `paginas` int(11) DEFAULT NULL,
  `edicao` int(11) DEFAULT NULL,
  `categoria` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `idioma` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `sinopse` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `data_cadastro` date DEFAULT NULL,
  `status` varchar(50) COLLATE utf8_unicode_ci DEFAULT 'Disponível',
  `destaque` tinyint(1) DEFAULT 0,
  `dt_cad_livro` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id_livro`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `livros`
--

LOCK TABLES `livros` WRITE;
/*!40000 ALTER TABLE `livros` DISABLE KEYS */;
INSERT INTO `livros` VALUES (1,'Ação entre amigos','9786500000001','Ana Souza','Editora Medeia',2026,250,1,'','Português','Livro introdutório sobre ciência e pesquisa.','2026-08-01','Disponível',1,'2026-08-27 23:33:37');
/*!40000 ALTER TABLE `livros` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `operadores`
--

DROP TABLE IF EXISTS `operadores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `operadores` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome_operador` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_operador` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `senha_operador` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `perfil` enum('operador','master','ultra_master') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'operador',
  `status` enum('Ativo','Inativo') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Ativo',
  `data_cadastro` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_operadores_email` (`email_operador`),
  KEY `idx_operadores_perfil` (`perfil`),
  KEY `idx_operadores_status` (`status`),
  KEY `idx_operadores_cadastro` (`data_cadastro`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `operadores`
--

LOCK TABLES `operadores` WRITE;
/*!40000 ALTER TABLE `operadores` DISABLE KEYS */;
INSERT INTO `operadores` VALUES (1,'Administrador Medeia','admin@medeia.com','$2y$12$ZJQpcd9eJFW7/DAAAq1mz.OkhqAZgDjKja.A3fyu62U1iY.WKp2VC','ultra_master','Ativo','2026-10-06 22:00:13'),(2,'rebeka de oliveira','rebeka@gmail.com','$2y$10$bGda6UGlmPm3Aq3EAmZWvuQ0TjfoHFYgV9VHk9.bzTHOI7aKLxUwu','ultra_master','Ativo','2026-10-07 09:53:11'),(6,'teste','teste@gmail.com','$2y$10$V0AcPd.UCOK7wSZVsqvdGe/Dy2KqITl8zrslQPB/Gr6iJJlHmkppa','ultra_master','Ativo','2026-10-15 23:03:31');
/*!40000 ALTER TABLE `operadores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `resultados`
--

DROP TABLE IF EXISTS `resultados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `resultados` (
  `id_resultado` int(11) NOT NULL AUTO_INCREMENT,
  `id_inscricao` int(11) NOT NULL,
  `nota` decimal(5,2) NOT NULL,
  `classificacao` int(11) NOT NULL,
  PRIMARY KEY (`id_resultado`),
  KEY `fk_resultado_inscricao` (`id_inscricao`),
  CONSTRAINT `fk_resultado_inscricao` FOREIGN KEY (`id_inscricao`) REFERENCES `inscricoes` (`id_inscricao`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `resultados`
--

LOCK TABLES `resultados` WRITE;
/*!40000 ALTER TABLE `resultados` DISABLE KEYS */;
INSERT INTO `resultados` VALUES (1,1,85.50,1),(2,2,78.25,2),(3,3,72.00,3);
/*!40000 ALTER TABLE `resultados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `revistas`
--

DROP TABLE IF EXISTS `revistas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `revistas` (
  `id_revista` int(11) NOT NULL AUTO_INCREMENT,
  `issn` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `volume` int(11) DEFAULT NULL,
  `numero` int(11) DEFAULT NULL,
  `ano` int(11) NOT NULL,
  `doi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `periodicidade` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `editor_chefe` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `conselho` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revisores` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `data_publicacao` date DEFAULT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Rascunho',
  `destaque` tinyint(1) NOT NULL DEFAULT 0,
  `dt_cad_revista` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_revista`),
  UNIQUE KEY `uk_issn` (`issn`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `revistas`
--

LOCK TABLES `revistas` WRITE;
/*!40000 ALTER TABLE `revistas` DISABLE KEYS */;
INSERT INTO `revistas` VALUES (1,'2764-5758','Revista Tecnologia & Conhecimento',5,2,1988,'10.1234/ABC26','Anual','Ernesto','cfvgbhnjmkl,ç~.çlkjh','qawsedrftgyhujikolç','2026-08-13','Em Revisão',0,'2026-08-18 13:24:23');
/*!40000 ALTER TABLE `revistas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trabalhos_academicos`
--

DROP TABLE IF EXISTS `trabalhos_academicos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trabalhos_academicos` (
  `id_trabalho` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `autor` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `curso` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `instituicao` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `orientador` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resumo` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `palavras_chave` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `data_publicacao` date DEFAULT NULL,
  `arquivo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `criado_em` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_trabalho`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trabalhos_academicos`
--

LOCK TABLES `trabalhos_academicos` WRITE;
/*!40000 ALTER TABLE `trabalhos_academicos` DISABLE KEYS */;
/*!40000 ALTER TABLE `trabalhos_academicos` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed
