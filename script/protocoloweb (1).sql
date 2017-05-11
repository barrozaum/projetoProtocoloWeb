-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 08-Maio-2017 às 22:45
-- Versão do servidor: 10.1.13-MariaDB
-- PHP Version: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `protocoloweb`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `assunto`
--

CREATE TABLE `assunto` (
  `idAssunto` int(11) NOT NULL,
  `descricao_assunto` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='tabela assunto';

--
-- Extraindo dados da tabela `assunto`
--

INSERT INTO `assunto` (`idAssunto`, `descricao_assunto`) VALUES
(10, 'ASSUNTO NOVO'),
(11, 'BDA'),
(3, 'CADASDFFDF'),
(9, 'IGOR');

--
-- Acionadores `assunto`
--
DELIMITER $$
CREATE TRIGGER `alterando_assunto` BEFORE UPDATE ON `assunto` FOR EACH ROW BEGIN



INSERT INTO log_assunto
SET acao = 'alteracao',
idAssunto = new.idAssunto,
usuario = USER(),
descricao_assunto = new.descricao_assunto,
modificadoem = NOW(); 


END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `excluir_assunto` BEFORE DELETE ON `assunto` FOR EACH ROW INSERT INTO log_assunto
SET acao = 'exclusao',
idAssunto = old.idAssunto,
descricao_assunto = old.descricao_assunto,
usuario = USER(),
modificadoem = NOW()
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `inserindo_assunto` AFTER INSERT ON `assunto` FOR EACH ROW BEGIN
INSERT INTO log_assunto
SET acao = 'insercao',
idAssunto = new.idAssunto,
usuario = USER(),
descricao_assunto = new.descricao_assunto,
modificadoem = NOW(); 
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cadastro_processo`
--

CREATE TABLE `cadastro_processo` (
  `idProcesso` int(11) NOT NULL,
  `numeroProcesso` int(11) NOT NULL,
  `tipoProcesso` int(11) NOT NULL,
  `anoProcesso` int(11) NOT NULL,
  `dataProcesso` date NOT NULL,
  `idAssunto` int(11) NOT NULL DEFAULT '0',
  `idOrigem` int(11) NOT NULL DEFAULT '0',
  `idRequerente` int(11) NOT NULL DEFAULT '0',
  `idUsuario` int(11) NOT NULL,
  `idAnexo` int(11) NOT NULL,
  `complemento_assunto` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `cadastro_processo`
--

INSERT INTO `cadastro_processo` (`idProcesso`, `numeroProcesso`, `tipoProcesso`, `anoProcesso`, `dataProcesso`, `idAssunto`, `idOrigem`, `idRequerente`, `idUsuario`, `idAnexo`, `complemento_assunto`) VALUES
(7, 1, 7, 2017, '2017-05-08', 3, 1, 3, 1, 0, 'CASA'),
(10, 2, 7, 2017, '2017-05-08', 3, 1, 3, 1, 0, ''),
(14, 3, 7, 2017, '2017-05-08', 3, 1, 3, 1, 0, 'CASA'),
(15, 3, 7, 2017, '2017-05-08', 3, 1, 3, 1, 0, 'CASA'),
(16, 3, 7, 2017, '2017-05-08', 3, 1, 3, 1, 0, 'CASA'),
(17, 3, 7, 2017, '2017-05-08', 3, 1, 3, 1, 0, 'CASA'),
(18, 3, 7, 2017, '2017-05-08', 3, 1, 3, 1, 0, 'CASA'),
(19, 3, 7, 2017, '2017-05-08', 3, 1, 3, 1, 0, 'CASA'),
(20, 4, 7, 2017, '2017-05-08', 9, 1, 4, 1, 0, 'CASSDASD'),
(21, 2, 1, 2017, '2017-05-08', 9, 1, 3, 1, 0, 'ASDAD'),
(22, 3, 1, 2017, '2017-05-08', 9, 1, 4, 1, 0, 'DASDA'),
(23, 5, 7, 2017, '2017-05-08', 3, 1, 4, 1, 0, 'ASDASD');

-- --------------------------------------------------------

--
-- Estrutura da tabela `carga_processo`
--

CREATE TABLE `carga_processo` (
  `idCarga` int(11) NOT NULL,
  `idProcesso` int(11) NOT NULL,
  `idSetorOrigem` int(11) NOT NULL,
  `idSetorEntrada` int(11) NOT NULL,
  `tramite` int(11) NOT NULL COMMENT 'se valor 1 pardo, 0 em movimento',
  `idSetorPresente` int(11) NOT NULL,
  `parecer` text COLLATE utf8_unicode_ci NOT NULL,
  `idUsuarioCarga` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `dataCarga` date NOT NULL,
  `idUsuarioRecebimento` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `dataRecebimento` date NOT NULL,
  `seq_carga` int(11) NOT NULL,
  `data_carga_sistema` date NOT NULL,
  `data_recebimento_sistema` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `carga_processo`
--

INSERT INTO `carga_processo` (`idCarga`, `idProcesso`, `idSetorOrigem`, `idSetorEntrada`, `tramite`, `idSetorPresente`, `parecer`, `idUsuarioCarga`, `dataCarga`, `idUsuarioRecebimento`, `dataRecebimento`, `seq_carga`, `data_carga_sistema`, `data_recebimento_sistema`) VALUES
(1, 16, 1, 1, 1, 1, '', '1', '2017-05-08', '1', '2017-05-08', 0, '2017-05-08', '2017-05-08'),
(2, 17, 1, 1, 1, 1, '', '1', '2017-05-08', '1', '2017-05-08', 0, '2017-05-08', '2017-05-08'),
(3, 18, 1, 1, 1, 1, '', '1', '2017-05-08', '1', '2017-05-08', 0, '2017-05-08', '2017-05-08'),
(4, 19, 1, 1, 1, 1, '', '1', '2017-05-08', '1', '2017-05-08', 0, '2017-05-08', '2017-05-08'),
(5, 20, 1, 1, 1, 1, '', '1', '2017-05-08', '1', '2017-05-08', 0, '2017-05-08', '2017-05-08'),
(6, 21, 1, 1, 1, 1, '', '1', '2017-05-08', '1', '2017-05-08', 0, '2017-05-08', '2017-05-08'),
(7, 22, 1, 1, 1, 1, '', '1', '2017-05-08', '1', '2017-05-08', 0, '2017-05-08', '2017-05-08'),
(8, 23, 1, 1, 1, 1, '', '1', '2017-05-08', '1', '2017-05-08', 0, '2017-05-08', '2017-05-08');

-- --------------------------------------------------------

--
-- Estrutura da tabela `configuracao_sistema`
--

CREATE TABLE `configuracao_sistema` (
  `caminho_logo` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nome_cliente` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secretaria` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `senha_expiracao` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numero_endereco` int(11) NOT NULL,
  `complemento` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cidade` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uf` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cnpj` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `endereco` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bairro` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cep` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `configuracao_sistema`
--

INSERT INTO `configuracao_sistema` (`caminho_logo`, `nome_cliente`, `secretaria`, `senha_expiracao`, `numero_endereco`, `complemento`, `cidade`, `uf`, `cnpj`, `endereco`, `bairro`, `cep`) VALUES
('recursos/imagens/estrutura/logo.jpg', 'PARVAIM SOFTWARE DE GESTAO', 'SECRETÁRIA DE TI', '123456789', 265, 'PARVAIM', 'SÃO JÕAO DE MERITI\r\n', 'RJ', '14307864777', 'RUA JORNALISTA GERALDO ROCHA', 'JARDIM MERITI', '2555221');

-- --------------------------------------------------------

--
-- Estrutura da tabela `documento`
--

CREATE TABLE `documento` (
  `idDocumento` int(11) NOT NULL,
  `descricao_documento` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Acionadores `documento`
--
DELIMITER $$
CREATE TRIGGER `alterar_documento` BEFORE UPDATE ON `documento` FOR EACH ROW BEGIN

INSERT INTO log_documento
SET acao = 'alteracao',
id_documento = new.idDocumento,
descricao_documento = new.descricao_documento,
usuario = user(),
modificadoem = now();

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `excluir_documento` BEFORE DELETE ON `documento` FOR EACH ROW BEGIN

INSERT INTO log_documento
set acao = 'exclusao',
id_documento = old.idDocumento,
descricao_documento = old.descricao_documento,
usuario = user(),
modificadoem = now();
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `inserindo_documento` AFTER INSERT ON `documento` FOR EACH ROW BEGIN
INSERT INTO log_documento
SET acao = 'insercao',
id_documento = new.idDocumento,
usuario = User(),
descricao_documento = new.descricao_documento,
modificadoem = NOW();

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `documento_processo`
--

CREATE TABLE `documento_processo` (
  `idDocumentoProcesso` int(11) NOT NULL,
  `idProcesso` int(11) NOT NULL,
  `idDocumento` int(11) NOT NULL,
  `anoDocumento` year(4) NOT NULL,
  `numeroDocumento` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `log_assunto`
--

CREATE TABLE `log_assunto` (
  `id_log_assunto` int(11) NOT NULL,
  `idAssunto` int(11) NOT NULL,
  `descricao_assunto` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `usuario` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `modificadoem` date NOT NULL,
  `acao` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `log_assunto`
--

INSERT INTO `log_assunto` (`id_log_assunto`, `idAssunto`, `descricao_assunto`, `usuario`, `modificadoem`, `acao`) VALUES
(1, 1, 'TESTE', '1', '2017-05-05', 'insercao'),
(2, 0, 'root@localhost', '', '2017-05-05', 'exclusao'),
(3, 2, '12313', '1', '2017-05-05', 'insercao'),
(4, 0, 'root@localhost', '', '2017-05-05', 'exclusao'),
(5, 3, 'CADAS', '1', '2017-05-05', 'insercao'),
(6, 4, 'DSADSD', '1', '2017-05-05', 'insercao'),
(7, 3, 'CADAS', 'igor@localhost', '2017-05-05', 'alteracao_antigo'),
(8, 3, 'CADASDFFDF', '1', '2017-05-05', 'alteracao_novo'),
(9, 0, 'igor@localhost', '', '2017-05-05', 'exclusao'),
(10, 5, 'TESE', '2', '2017-05-05', 'insercao'),
(11, 6, 'SISTEMA', 'IGOR@localhost', '2017-05-05', 'insercao'),
(12, 6, 'SISTEMA', 'IGOR@localhost', '2017-05-05', 'alteracao_antigo'),
(13, 6, 'SISTEMA TEMA', '2', '2017-05-05', 'alteracao_novo'),
(14, 0, 'IGOR@localhost', '', '2017-05-05', 'exclusao'),
(15, 5, 'TESE', 'SA@localhost', '2017-05-05', 'exclusao'),
(16, 7, 'VAMOS FLAMENGO', 'root@localhost', '2017-05-05', 'insercao'),
(17, 8, 'NOVO', 'SA@localhost', '2017-05-05', 'insercao'),
(18, 7, 'SEREMOS CAMPEON', 'SA@localhost', '2017-05-05', 'alteracao'),
(19, 7, 'SEREMOS CAMPEON', 'IGOR@localhost', '2017-05-05', 'exclusao'),
(20, 9, 'IGOR', 'SA@localhost', '2017-05-05', 'insercao'),
(21, 11, 'SAD', 'SA@localhost', '2017-05-08', 'insercao'),
(22, 11, 'SAD', 'SA@localhost', '2017-05-08', 'exclusao'),
(23, 8, 'NOVO', 'SA@localhost', '2017-05-08', 'exclusao'),
(24, 10, 'ASSUNTO NOVO', 'THAYNA@localhost', '2017-05-08', 'insercao'),
(25, 11, 'BDA', 'THAYNA@localhost', '2017-05-08', 'insercao');

-- --------------------------------------------------------

--
-- Estrutura da tabela `log_documento`
--

CREATE TABLE `log_documento` (
  `id_log_documento` int(11) NOT NULL,
  `id_documento` int(11) NOT NULL,
  `descricao_documento` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `usuario` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `modificadoem` date NOT NULL,
  `acao` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `log_documento`
--

INSERT INTO `log_documento` (`id_log_documento`, `id_documento`, `descricao_documento`, `usuario`, `modificadoem`, `acao`) VALUES
(1, 3, 'TESTE', 'SA@localhost', '2017-05-05', 'insercao'),
(2, 3, 'budega', 'root@localhost', '2017-05-05', 'alteracao'),
(3, 3, 'I DONT WANNA', 'SA@localhost', '2017-05-05', 'alteracao'),
(4, 3, 'I DONT WANNA', 'SA@localhost', '2017-05-05', 'exclusao'),
(5, 1, 'OFICIO DO SUPREMO', 'SA@localhost', '2017-05-08', 'insercao'),
(6, 1, 'OFICIO DO SUPREMO', 'SA@localhost', '2017-05-08', 'exclusao');

-- --------------------------------------------------------

--
-- Estrutura da tabela `log_origem`
--

CREATE TABLE `log_origem` (
  `id_log_origem` int(11) NOT NULL,
  `acao` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `id_origem` int(11) NOT NULL,
  `descricao_origem` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `usuario` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `modificadoem` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `log_origem`
--

INSERT INTO `log_origem` (`id_log_origem`, `acao`, `id_origem`, `descricao_origem`, `usuario`, `modificadoem`) VALUES
(1, 'insercao', 1, 'PARVAIM', 'SA@localhost', '2017-05-05'),
(2, 'alteracao', 1, 'PARVAIM SOFTWARE', 'SA@localhost', '2017-05-05'),
(3, 'exclusao', 1, 'PARVAIM SOFTWARE', 'SA@localhost', '2017-05-05'),
(4, 'insercao', 1, 'PARVAIM', 'SA@localhost', '2017-05-08'),
(5, 'insercao', 2, 'TESTE DE LOG', 'SA@localhost', '2017-05-08'),
(6, 'exclusao', 2, 'TESTE DE LOG', 'SA@localhost', '2017-05-08');

-- --------------------------------------------------------

--
-- Estrutura da tabela `log_requerente`
--

CREATE TABLE `log_requerente` (
  `id_log_requerente` int(11) NOT NULL,
  `acao` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `id_requerente` int(11) NOT NULL,
  `requerente` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `logradouro` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `numeroEnd` int(11) NOT NULL,
  `complemento` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `bairro` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `cidade` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `uf` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `cep` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `tel` varchar(21) COLLATE utf8_unicode_ci NOT NULL,
  `cel` varchar(21) COLLATE utf8_unicode_ci NOT NULL,
  `usuario` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `modificadoem` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `log_requerente`
--

INSERT INTO `log_requerente` (`id_log_requerente`, `acao`, `id_requerente`, `requerente`, `logradouro`, `numeroEnd`, `complemento`, `bairro`, `cidade`, `uf`, `cep`, `tel`, `cel`, `usuario`, `modificadoem`) VALUES
(2, 'insercao', 2, 'IGOR', 'RUA FRANCISCO SOARES DE OLIVEIRA', 25, 'CASA', 'VILA ROSALI', 'SAO JOAO DE MERITI', 'RJ', '25525180', '2127567241', '21981295812', 'SA@localhost', '2017-05-08'),
(3, 'alteracao', 2, 'IGOR', 'RUA FRANCISCO SOARES DE OLIVEIRA', 25, 'CASA', 'VILA ROSALI', 'SAO JOAO DE MERITI', 'RJ', '25525180', '2127567241', '21981295812', 'SA@localhost', '2017-05-08'),
(4, 'alteracao', 2, 'IGOR', 'RUA FRANCISCO SOARES DE OLIVEIRA', 25, 'CASA', 'VILA ROSALI', 'SAO JOAO DE MERITI', 'RJ', '25525180', '212127567241', '2121981295812', 'SA@localhost', '2017-05-08'),
(5, 'exclusao', 2, 'IGOR', 'RUA JORNALISTA GERALDO ROCHA', 265, 'PARVAIM', 'JARDIM MERITI', 'SAO JOAO DE MERITI', 'RJ', '25555221', '2127567241', '21981295812', 'SA@localhost', '2017-05-08'),
(6, 'insercao', 3, 'IGOR BARROZO BRASIL', '...', 265, 'CASA', '...', '...', '..', '25525180', '2127567241', '21981295812', 'SA@localhost', '2017-05-08'),
(7, 'alteracao', 3, 'IGOR BARROZO BRASIL', '...', 265, 'CASA', '...', '...', '..', '25525180', '2127567241', '21981295812', 'SA@localhost', '2017-05-08'),
(8, 'insercao', 4, 'THALITA ', 'RUA JORNALISTA GERALDO ROCHA', 125, '20CA', 'JARDIM MERITI', 'SAO JOAO DE MERITI', 'RJ', '25555221', '2127567241', '21981295812', 'SA@localhost', '2017-05-08'),
(9, 'alteracao', 3, 'IGOR BARROZO BRASIL', '...', 265, 'CASA', '...', '...', '..', '25525180', '2127567241', '21981295812', 'SA@localhost', '2017-05-08');

-- --------------------------------------------------------

--
-- Estrutura da tabela `log_setor`
--

CREATE TABLE `log_setor` (
  `id_log_setor` int(11) NOT NULL,
  `acao` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `id_setor` int(11) NOT NULL,
  `setor` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `secretaria` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `desc_secretaria` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `coordenadoria` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `desc_coordenadoria` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `departamento` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `desc_departamento` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `modificadoem` date NOT NULL,
  `usuario` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `log_setor`
--

INSERT INTO `log_setor` (`id_log_setor`, `acao`, `id_setor`, `setor`, `secretaria`, `desc_secretaria`, `coordenadoria`, `desc_coordenadoria`, `departamento`, `desc_departamento`, `modificadoem`, `usuario`) VALUES
(2, 'insercao', 2, 'PROTOCOLO', 'PROTOCOLO', 'PROTOCOLO', 'PROTOCOLO', 'PROTOCOLO', 'PROTOCOLO', 'PROTOCOLO', '2017-05-08', 'SA@localhost'),
(3, 'alteracao', 2, 'PROTOCOLO', 'PROTOCOLO', 'PROTOCOLO', 'PROTOCOLO', 'PROTOCOLO', 'PROTOCOLO', 'PROTOCOLO', '2017-05-08', 'SA@localhost'),
(4, 'exclusao', 2, 'SETOR', 'SETOR', 'SETOR', 'SETOR', 'SETOR', 'SETOR', 'SETOR', '2017-05-08', 'SA@localhost'),
(5, 'insercao', 3, 'PROTOCOLO', 'PROTOCOLO', 'PROTOCOLO', 'PROTOCOLO', 'PROTOCOLO', 'PROTOCOLO', 'PROTOCOLO', '2017-05-08', 'SA@localhost');

-- --------------------------------------------------------

--
-- Estrutura da tabela `log_tipo_processo`
--

CREATE TABLE `log_tipo_processo` (
  `id_log_tipo_processo` int(11) NOT NULL,
  `acao` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `id_tipo_processo` int(11) NOT NULL,
  `descricao_tipo_processo` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `numero_proximo_processo` int(11) NOT NULL,
  `usuario` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `modificadoem` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `log_tipo_processo`
--

INSERT INTO `log_tipo_processo` (`id_log_tipo_processo`, `acao`, `id_tipo_processo`, `descricao_tipo_processo`, `numero_proximo_processo`, `usuario`, `modificadoem`) VALUES
(1, 'insercao', 7, 'APONSTADORIA', 1, 'SA@localhost', '2017-05-08'),
(2, 'alteracao', 7, 'APONSTADORIA', 1, 'SA@localhost', '2017-05-08'),
(3, 'alteracao', 7, 'PENSIONISTA', 1, 'SA@localhost', '2017-05-08'),
(4, 'alteracao', 7, 'PENSIONISTA', 4, 'SA@localhost', '2017-05-08'),
(5, 'alteracao', 7, 'PENSIONISTA', 4, 'SA@localhost', '2017-05-08'),
(6, 'alteracao', 7, 'PENSIONISTA', 4, 'SA@localhost', '2017-05-08'),
(7, 'alteracao', 1, 'COMUNICACAO INTERNA', 2, 'SA@localhost', '2017-05-08'),
(8, 'alteracao', 1, 'COMUNICACAO INTERNA', 3, 'SA@localhost', '2017-05-08'),
(9, 'alteracao', 7, 'PENSIONISTA', 5, 'SA@localhost', '2017-05-08'),
(10, 'exclusao', 6, 'COMUNICACAO EXTERNA', 4, 'SA@localhost', '2017-05-08');

-- --------------------------------------------------------

--
-- Estrutura da tabela `obs`
--

CREATE TABLE `obs` (
  `idObs` int(11) NOT NULL,
  `idProcesso` int(11) NOT NULL,
  `obs` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `obs`
--

INSERT INTO `obs` (`idObs`, `idProcesso`, `obs`) VALUES
(1, 15, 'SADASD'),
(2, 16, 'SADASD'),
(3, 17, 'SADASD'),
(4, 18, 'SADASD'),
(5, 19, 'SADASD'),
(6, 20, 'XCVC'),
(7, 21, 'SADFSADF'),
(8, 22, 'ADSDSDS'),
(9, 23, 'ASDFASDF');

-- --------------------------------------------------------

--
-- Estrutura da tabela `origem`
--

CREATE TABLE `origem` (
  `idOrigem` int(11) NOT NULL,
  `descricao_origem` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `origem`
--

INSERT INTO `origem` (`idOrigem`, `descricao_origem`) VALUES
(1, 'PARVAIM');

--
-- Acionadores `origem`
--
DELIMITER $$
CREATE TRIGGER `alterando_origem` BEFORE UPDATE ON `origem` FOR EACH ROW BEGIN

INSERT INTO log_origem
SET acao = 'alteracao',
id_origem = new.idOrigem,
descricao_origem = new.descricao_origem,
usuario = user(),
modificadoem = now();

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `excluindo_origem` BEFORE DELETE ON `origem` FOR EACH ROW BEGIN

insert into log_origem
set acao = 'exclusao',
id_origem = old.idOrigem,
descricao_origem = old.descricao_origem,
usuario = user(),
modificadoem = now();

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `inserindo_origem` AFTER INSERT ON `origem` FOR EACH ROW BEGIN 
	insert into log_origem
    set acao = 'insercao',
    id_origem = new.idOrigem,
    descricao_origem = new.descricao_origem,
    usuario = user(),
    modificadoem = now();
    

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `permissao`
--

CREATE TABLE `permissao` (
  `idPermissao` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `processoNovo` int(1) NOT NULL,
  `processoCarga` int(1) NOT NULL,
  `processoRecebimento` int(1) NOT NULL,
  `processoAnexo` int(1) NOT NULL,
  `cadastroAssunto` int(1) NOT NULL,
  `cadastroDocumento` int(1) NOT NULL,
  `cadastroOrigem` int(1) NOT NULL,
  `cadastroSetor` int(1) NOT NULL,
  `cadastroRequerente` int(1) NOT NULL,
  `consultaAnexo` int(1) NOT NULL,
  `consultaAssunto` int(1) NOT NULL,
  `consultaCarga` int(1) NOT NULL,
  `consultaProcesso` int(1) NOT NULL,
  `consultaDocumento` int(1) NOT NULL,
  `consultaNumero` int(1) NOT NULL,
  `consultaRequerente` int(1) NOT NULL,
  `consultaSecretaria` int(1) NOT NULL,
  `consultaOrigem` int(1) NOT NULL,
  `relatorioSetor` int(1) NOT NULL,
  `relatorioTramite` int(1) NOT NULL,
  `relatorioRemessa` int(1) NOT NULL,
  `relatorioCarga` int(1) NOT NULL,
  `manutencaoUsuario` int(1) NOT NULL,
  `manutencaoSenha` int(1) NOT NULL,
  `manutencaoEtiquetas` int(1) NOT NULL,
  `manutencaoPermissao` int(1) NOT NULL,
  `outrasOp` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `permissao`
--

INSERT INTO `permissao` (`idPermissao`, `idUsuario`, `processoNovo`, `processoCarga`, `processoRecebimento`, `processoAnexo`, `cadastroAssunto`, `cadastroDocumento`, `cadastroOrigem`, `cadastroSetor`, `cadastroRequerente`, `consultaAnexo`, `consultaAssunto`, `consultaCarga`, `consultaProcesso`, `consultaDocumento`, `consultaNumero`, `consultaRequerente`, `consultaSecretaria`, `consultaOrigem`, `relatorioSetor`, `relatorioTramite`, `relatorioRemessa`, `relatorioCarga`, `manutencaoUsuario`, `manutencaoSenha`, `manutencaoEtiquetas`, `manutencaoPermissao`, `outrasOp`) VALUES
(1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(2, 2, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0),
(3, 3, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `processo_em_anexo`
--

CREATE TABLE `processo_em_anexo` (
  `idAnexo` int(11) NOT NULL,
  `tipo_processo` int(11) NOT NULL,
  `numero_processo` int(11) NOT NULL,
  `ano_processo` int(4) NOT NULL,
  `tipo_proceso_anexo` int(11) NOT NULL,
  `numero_proceso_anexo` int(11) NOT NULL,
  `ano_proceso_anexo` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `requerente`
--

CREATE TABLE `requerente` (
  `idRequerente` int(11) NOT NULL,
  `requerente` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '-----------------',
  `logradouro` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '-----------------',
  `numeroEnd` int(10) NOT NULL DEFAULT '0',
  `complemento` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '-----------------',
  `bairro` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '-----------------',
  `cidade` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '-----------------',
  `uf` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '-----------------',
  `cep` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '__.___-___',
  `tel` varchar(14) COLLATE utf8_unicode_ci NOT NULL DEFAULT '(00)0000-0000',
  `cel` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT '(00)0000-00000'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `requerente`
--

INSERT INTO `requerente` (`idRequerente`, `requerente`, `logradouro`, `numeroEnd`, `complemento`, `bairro`, `cidade`, `uf`, `cep`, `tel`, `cel`) VALUES
(3, 'IGOR BARROZO BRASIL', 'RUA FRANCISCO SOARES DE OLIVEIRA', 265, 'CASA', 'VILA ROSALI', 'SAO JOAO DE MERITI', 'RJ', '25525180', '2127567241', '21981295812'),
(4, 'THALITA ', 'RUA JORNALISTA GERALDO ROCHA', 125, '20CA', 'JARDIM MERITI', 'SAO JOAO DE MERITI', 'RJ', '25555221', '2127567241', '21981295812');

--
-- Acionadores `requerente`
--
DELIMITER $$
CREATE TRIGGER `adicionando_requerente` AFTER INSERT ON `requerente` FOR EACH ROW BEGIN
INSERT INTO log_requerente
SET acao = 'insercao',
id_requerente = new.idRequerente,
requerente = new.requerente,
logradouro = new.logradouro,
numeroEnd = new.numeroEnd,
complemento = new.complemento,
bairro = new.bairro,
cidade = new.cidade,
uf = new.uf,
cep = new.cep,
tel = new.tel,
cel = new.cel,
usuario = USER(),
modificadoem = NOW(); 
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `alterando_requerente` BEFORE UPDATE ON `requerente` FOR EACH ROW BEGIN
INSERT INTO log_requerente
SET acao = 'alteracao',
id_requerente = old.idRequerente,
requerente = old.requerente,
logradouro = old.logradouro,
numeroEnd = old.numeroEnd,
complemento = old.complemento,
bairro = old.bairro,
cidade = old.cidade,
uf = old.uf,
cep = old.cep,
tel = old.tel,
cel = old.cel,
usuario = USER(),
modificadoem = NOW(); 
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `excluindo_requerente` BEFORE DELETE ON `requerente` FOR EACH ROW BEGIN
INSERT INTO log_requerente
SET acao = 'exclusao',
id_requerente = old.idRequerente,
requerente = old.requerente,
logradouro = old.logradouro,
numeroEnd = old.numeroEnd,
complemento = old.complemento,
bairro = old.bairro,
cidade = old.cidade,
uf = old.uf,
cep = old.cep,
tel = old.tel,
cel = old.cel,
usuario = USER(),
modificadoem = NOW();
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `setor`
--

CREATE TABLE `setor` (
  `idSetor` int(11) NOT NULL,
  `setor` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `secretaria` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `descSecretaria` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `coordenadoria` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `descCoordenadoria` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `departamento` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `descDepartamento` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `setor`
--

INSERT INTO `setor` (`idSetor`, `setor`, `secretaria`, `descSecretaria`, `coordenadoria`, `descCoordenadoria`, `departamento`, `descDepartamento`) VALUES
(3, 'PROTOCOLO', 'PROTOCOLO', 'PROTOCOLO', 'PROTOCOLO', 'PROTOCOLO', 'PROTOCOLO', 'PROTOCOLO');

--
-- Acionadores `setor`
--
DELIMITER $$
CREATE TRIGGER `adicionando_setor` AFTER INSERT ON `setor` FOR EACH ROW BEGIN
INSERT INTO log_setor
SET acao = 'insercao',
id_setor = new.idSetor,
setor = new.setor,
secretaria = new.secretaria,
desc_secretaria = new.descSecretaria,
coordenadoria = new.coordenadoria,
desc_coordenadoria = new.descCoordenadoria,
departamento = new.departamento,
desc_departamento = new.descDepartamento,
usuario = USER(),
modificadoem = NOW(); 
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `alterando_setor` BEFORE UPDATE ON `setor` FOR EACH ROW BEGIN
INSERT INTO log_setor
SET acao = 'alteracao',
id_setor = old.idSetor,
setor = old.setor,
secretaria = old.secretaria,
desc_secretaria = old.descSecretaria,
coordenadoria = old.coordenadoria,
desc_coordenadoria = old.descCoordenadoria,
departamento = old.departamento,
desc_departamento = old.descDepartamento,
usuario = USER(),
modificadoem = NOW(); 
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `excluindo_setor` BEFORE DELETE ON `setor` FOR EACH ROW BEGIN
INSERT INTO log_setor
SET acao = 'exclusao',
id_setor = old.idSetor,
setor = old.setor,
secretaria = old.secretaria,
desc_secretaria = old.descSecretaria,
coordenadoria = old.coordenadoria,
desc_coordenadoria = old.descCoordenadoria,
departamento = old.departamento,
desc_departamento = old.descDepartamento,
usuario = USER(),
modificadoem = NOW(); 
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_processo`
--

CREATE TABLE `tipo_processo` (
  `id_tipo_processo` int(11) NOT NULL,
  `descricao_tipo_processo` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `numero_proximo_processo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `tipo_processo`
--

INSERT INTO `tipo_processo` (`id_tipo_processo`, `descricao_tipo_processo`, `numero_proximo_processo`) VALUES
(1, 'COMUNICACAO INTERNA', 4),
(7, 'PENSIONISTA', 6);

--
-- Acionadores `tipo_processo`
--
DELIMITER $$
CREATE TRIGGER `alterando_tipo_processo` BEFORE UPDATE ON `tipo_processo` FOR EACH ROW BEGIN
INSERT INTO log_tipo_processo
SET acao = 'alteracao',
id_tipo_processo = old.id_tipo_processo,
descricao_tipo_processo = old.descricao_tipo_processo,
numero_proximo_processo = old.numero_proximo_processo,
usuario = USER(),
modificadoem = NOW(); 
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `excluindo_tipo_processo` BEFORE DELETE ON `tipo_processo` FOR EACH ROW BEGIN
INSERT INTO log_tipo_processo
SET acao = 'exclusao',
id_tipo_processo = old.id_tipo_processo,
descricao_tipo_processo = old.descricao_tipo_processo,
numero_proximo_processo = old.numero_proximo_processo,
usuario = USER(),
modificadoem = NOW();
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `inserindo_tipo_processo` AFTER INSERT ON `tipo_processo` FOR EACH ROW BEGIN
INSERT INTO log_tipo_processo
SET acao = 'insercao',
id_tipo_processo = new.id_tipo_processo,
descricao_tipo_processo = new.descricao_tipo_processo,
numero_proximo_processo = new.numero_proximo_processo,
usuario = USER(),
modificadoem = NOW(); 
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL,
  `login` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `nome` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `idSetor` int(11) NOT NULL,
  `senha` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `sobrenome` varchar(240) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `perfil` int(1) NOT NULL COMMENT '1 = adm, 0 = usu'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `login`, `nome`, `email`, `idSetor`, `senha`, `sobrenome`, `status`, `perfil`) VALUES
(1, 'SA', 'SA', 'SA@PARVAIM.COM.BR', 1, '202cb962ac59075b964b07152d234b70', 'SA', 0, 1),
(2, 'THAYNA', 'IGOR', 'IGOR@PARVAIM.COM.BR', 2, '202cb962ac59075b964b07152d234b70', 'BARROZO', 0, 0),
(3, 'HEBERT', 'HEBERT', 'HEBERT@PARVAIM.COM.BR', 3, '202cb962ac59075b964b07152d234b70', 'MAIA', 0, 0),
(4, 'THAYNA1', 'THAYNA1', 'THAYNA1@LOCALHOST', 1, '202cb962ac59075b964b07152d234b70', 'PEREIRA', 0, 0),
(6, 'THAYNA12', 'THAYNA12', 'THAYNA12@LOCALHOST', 1, '202cb962ac59075b964b07152d234b70', 'PEREIRA', 0, 0),
(13, 'THAYNA122', 'THAYNA122', 'THAYNA122@LOCALHOST', 1, '202cb962ac59075b964b07152d234b70', 'PEREIRA', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assunto`
--
ALTER TABLE `assunto`
  ADD PRIMARY KEY (`idAssunto`),
  ADD UNIQUE KEY `nomeAssunto` (`descricao_assunto`);

--
-- Indexes for table `cadastro_processo`
--
ALTER TABLE `cadastro_processo`
  ADD PRIMARY KEY (`idProcesso`,`numeroProcesso`,`tipoProcesso`,`anoProcesso`,`idAssunto`,`idOrigem`,`idRequerente`),
  ADD UNIQUE KEY `idProcesso` (`idProcesso`),
  ADD KEY `idAssunto` (`idAssunto`),
  ADD KEY `idOrigem` (`idOrigem`),
  ADD KEY `idRequerente` (`idRequerente`);

--
-- Indexes for table `carga_processo`
--
ALTER TABLE `carga_processo`
  ADD PRIMARY KEY (`idCarga`,`idProcesso`),
  ADD KEY `idProcesso` (`idProcesso`);

--
-- Indexes for table `documento`
--
ALTER TABLE `documento`
  ADD PRIMARY KEY (`idDocumento`),
  ADD UNIQUE KEY `nomeDocumento` (`descricao_documento`);

--
-- Indexes for table `documento_processo`
--
ALTER TABLE `documento_processo`
  ADD PRIMARY KEY (`idDocumentoProcesso`,`idProcesso`,`idDocumento`,`anoDocumento`,`numeroDocumento`),
  ADD KEY `idProcesso` (`idProcesso`),
  ADD KEY `documentoProcesso_ibfk_2` (`idDocumento`);

--
-- Indexes for table `log_assunto`
--
ALTER TABLE `log_assunto`
  ADD PRIMARY KEY (`id_log_assunto`);

--
-- Indexes for table `log_documento`
--
ALTER TABLE `log_documento`
  ADD PRIMARY KEY (`id_log_documento`);

--
-- Indexes for table `log_origem`
--
ALTER TABLE `log_origem`
  ADD PRIMARY KEY (`id_log_origem`);

--
-- Indexes for table `log_requerente`
--
ALTER TABLE `log_requerente`
  ADD PRIMARY KEY (`id_log_requerente`);

--
-- Indexes for table `log_setor`
--
ALTER TABLE `log_setor`
  ADD PRIMARY KEY (`id_log_setor`);

--
-- Indexes for table `log_tipo_processo`
--
ALTER TABLE `log_tipo_processo`
  ADD PRIMARY KEY (`id_log_tipo_processo`);

--
-- Indexes for table `obs`
--
ALTER TABLE `obs`
  ADD PRIMARY KEY (`idObs`,`idProcesso`),
  ADD KEY `idProcesso` (`idProcesso`);

--
-- Indexes for table `origem`
--
ALTER TABLE `origem`
  ADD PRIMARY KEY (`idOrigem`),
  ADD UNIQUE KEY `nomeOrigem` (`descricao_origem`);

--
-- Indexes for table `permissao`
--
ALTER TABLE `permissao`
  ADD PRIMARY KEY (`idPermissao`,`idUsuario`),
  ADD UNIQUE KEY `idUsuario` (`idUsuario`);

--
-- Indexes for table `processo_em_anexo`
--
ALTER TABLE `processo_em_anexo`
  ADD PRIMARY KEY (`idAnexo`) USING BTREE;

--
-- Indexes for table `requerente`
--
ALTER TABLE `requerente`
  ADD PRIMARY KEY (`idRequerente`),
  ADD UNIQUE KEY `requerente` (`requerente`),
  ADD UNIQUE KEY `requerente_2` (`requerente`);

--
-- Indexes for table `setor`
--
ALTER TABLE `setor`
  ADD PRIMARY KEY (`idSetor`),
  ADD UNIQUE KEY `setor` (`setor`);

--
-- Indexes for table `tipo_processo`
--
ALTER TABLE `tipo_processo`
  ADD PRIMARY KEY (`id_tipo_processo`),
  ADD UNIQUE KEY `descricao_tipo_processo` (`descricao_tipo_processo`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`),
  ADD UNIQUE KEY `login` (`login`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assunto`
--
ALTER TABLE `assunto`
  MODIFY `idAssunto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `cadastro_processo`
--
ALTER TABLE `cadastro_processo`
  MODIFY `idProcesso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `carga_processo`
--
ALTER TABLE `carga_processo`
  MODIFY `idCarga` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `documento`
--
ALTER TABLE `documento`
  MODIFY `idDocumento` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `documento_processo`
--
ALTER TABLE `documento_processo`
  MODIFY `idDocumentoProcesso` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `log_assunto`
--
ALTER TABLE `log_assunto`
  MODIFY `id_log_assunto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `log_documento`
--
ALTER TABLE `log_documento`
  MODIFY `id_log_documento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `log_origem`
--
ALTER TABLE `log_origem`
  MODIFY `id_log_origem` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `log_requerente`
--
ALTER TABLE `log_requerente`
  MODIFY `id_log_requerente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `log_setor`
--
ALTER TABLE `log_setor`
  MODIFY `id_log_setor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `log_tipo_processo`
--
ALTER TABLE `log_tipo_processo`
  MODIFY `id_log_tipo_processo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `obs`
--
ALTER TABLE `obs`
  MODIFY `idObs` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `origem`
--
ALTER TABLE `origem`
  MODIFY `idOrigem` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `permissao`
--
ALTER TABLE `permissao`
  MODIFY `idPermissao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `processo_em_anexo`
--
ALTER TABLE `processo_em_anexo`
  MODIFY `idAnexo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `requerente`
--
ALTER TABLE `requerente`
  MODIFY `idRequerente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `setor`
--
ALTER TABLE `setor`
  MODIFY `idSetor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tipo_processo`
--
ALTER TABLE `tipo_processo`
  MODIFY `id_tipo_processo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `cadastro_processo`
--
ALTER TABLE `cadastro_processo`
  ADD CONSTRAINT `cadastroProcesso_ibfk_1` FOREIGN KEY (`idAssunto`) REFERENCES `assunto` (`idAssunto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cadastroProcesso_ibfk_2` FOREIGN KEY (`idOrigem`) REFERENCES `origem` (`idOrigem`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cadastroProcesso_ibfk_3` FOREIGN KEY (`idRequerente`) REFERENCES `requerente` (`idRequerente`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `carga_processo`
--
ALTER TABLE `carga_processo`
  ADD CONSTRAINT `cargaProcesso_ibfk_1` FOREIGN KEY (`idProcesso`) REFERENCES `cadastro_processo` (`idProcesso`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `documento_processo`
--
ALTER TABLE `documento_processo`
  ADD CONSTRAINT `documentoProcesso_ibfk_1` FOREIGN KEY (`idProcesso`) REFERENCES `cadastro_processo` (`idProcesso`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `documentoProcesso_ibfk_2` FOREIGN KEY (`idDocumento`) REFERENCES `documento` (`idDocumento`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `obs`
--
ALTER TABLE `obs`
  ADD CONSTRAINT `obs_ibfk_1` FOREIGN KEY (`idProcesso`) REFERENCES `cadastro_processo` (`idProcesso`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `permissao`
--
ALTER TABLE `permissao`
  ADD CONSTRAINT `permissao_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
