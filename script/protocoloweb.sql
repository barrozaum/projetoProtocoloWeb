-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 05-Maio-2017 às 20:08
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
  `descricao_assunto` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='tabela assunto';

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
(43, 1, 6, 2017, '2017-04-25', 16, 1, 2, 1, 0, 'CARGA'),
(44, 1, 1, 2017, '2017-04-26', 17, 2, 3, 1, 0, 'CARGA'),
(45, 2, 6, 2017, '2017-04-27', 16, 1, 3, 3, 0, 'CASDAASD'),
(46, 3, 6, 2017, '2017-05-05', 17, 2, 3, 1, 0, 'CASAMENTO');

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
(1, 43, 1, 1, 1, 1, '', '1', '2017-04-25', '1', '2017-04-25', 0, '0000-00-00', '0000-00-00'),
(2, 44, 1, 1, 1, 1, '', '1', '2017-04-26', '1', '2017-04-26', 0, '2017-04-26', '2017-04-26'),
(6, 44, 1, 2, 1, 0, 'TESTE', '1', '2017-04-26', '2', '2017-05-03', 1, '2017-04-26', '2017-05-03'),
(7, 43, 1, 2, 1, 0, 'TESTE DE CARGA', '1', '2017-04-27', '2', '2017-04-27', 1, '2017-04-27', '2017-04-27'),
(8, 43, 2, 1, 1, 0, 'PROTOCOLO', '2', '2017-04-27', '3', '2017-04-27', 2, '2017-04-27', '2017-04-27'),
(9, 43, 1, 2, 1, 0, 'CONTABILIDADE AP', '3', '2017-04-27', '2', '2017-04-27', 3, '2017-04-27', '2017-04-27'),
(10, 45, 1, 1, 1, 1, '', '3', '2017-04-27', '3', '2017-04-27', 0, '2017-04-27', '2017-04-27'),
(12, 45, 1, 2, 1, 0, 'TESTE', '3', '2017-04-27', '2', '2017-05-03', 1, '2017-04-27', '2017-05-03'),
(13, 43, 2, 1, 1, 0, 'CARGA PARA PROTOCOLO', '2', '2017-04-28', '1', '2017-04-28', 4, '2017-04-28', '2017-04-28'),
(14, 43, 1, 2, 1, 0, 'CASASD', '1', '2017-04-28', '2', '2017-05-03', 5, '2017-04-28', '2017-05-03'),
(16, 44, 2, 1, 1, 0, 'PROTOCOO', '2', '2017-05-03', '1', '2017-05-03', 2, '2017-05-03', '2017-05-03'),
(19, 44, 1, 3, 0, 0, 'CARGA PRA LA', '1', '2017-05-05', '', '0000-00-00', 3, '2017-05-05', '0000-00-00'),
(20, 46, 1, 1, 1, 1, '', '1', '2017-05-05', '1', '2017-05-05', 0, '2017-05-05', '2017-05-05'),
(21, 46, 1, 2, 0, 0, 'CONTABILIDADE', '1', '2017-05-05', '', '0000-00-00', 1, '2017-05-05', '0000-00-00');

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
  `descricao_documento` varchar(50) NOT NULL,
  `idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `documento`
--

INSERT INTO `documento` (`idDocumento`, `descricao_documento`, `idUsuario`) VALUES
(1, 'OFICIO PARA REALIZAR COTAÃ‡ÃƒO', 1),
(2, 'OFICIO DO SUPREMO', 1);

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

--
-- Extraindo dados da tabela `documento_processo`
--

INSERT INTO `documento_processo` (`idDocumentoProcesso`, `idProcesso`, `idDocumento`, `anoDocumento`, `numeroDocumento`, `idUsuario`) VALUES
(38, 43, 1, 2014, 123, 1),
(39, 44, 2, 2014, 252, 1),
(40, 44, 1, 2018, 3253, 1),
(41, 45, 2, 2017, 1213, 3),
(44, 46, 1, 2014, 12352, 1),
(45, 46, 2, 2018, 2532, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `log_assunto`
--

CREATE TABLE `log_assunto` (
  `id_log_assunto` int(11) NOT NULL,
  `idAssunto` int(11) NOT NULL,
  `descricao_assunto` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `modificadaoem` date NOT NULL,
  `acao` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Acionadores `log_assunto`
--
DELIMITER $$
CREATE TRIGGER `inserindo_assunto` AFTER INSERT ON `log_assunto` FOR EACH ROW BEGIN
INSERT INTO empregados_auditoria
SET acao = 'insert',
descricao_assunto = NEW.descricao_assunto,
id_assunto = NEW.idAssunto,
id_usuario = NEW.idUsuario,
modificadoem = NOW(); 
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `log_documento`
--

CREATE TABLE `log_documento` (
  `id_log_documento` int(11) NOT NULL,
  `tipo_comando` varchar(1) COLLATE utf8_unicode_ci NOT NULL COMMENT 'I - inserir, A - alterar, E - excluir',
  `comando_sql` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'comando sql executado',
  `data_comando` date NOT NULL,
  `usuario_comando` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `log_documento`
--

INSERT INTO `log_documento` (`id_log_documento`, `tipo_comando`, `comando_sql`, `data_comando`, `usuario_comando`) VALUES
(14, 'I', 'INSERT INTO assunto (idAssunto, descricao_assunto, idUsuario) VALUES (null, TESTE DE DOCUMENTO, 1)', '2017-04-11', 1),
(15, 'I', 'INSERT INTO documento (idDocumento, descricao_documento, idUsuario) VALUES (null, TESTE DE DOCUMENTO, 1)', '2017-04-11', 1),
(16, 'A', 'UPDATE documento SET descricao_documento = ALTERADO DOCUEMNTO, idUsuario = 1 WHERE idDocumento = 2', '2017-04-11', 1),
(17, 'A', 'UPDATE documento SET descricao_documento = ALTERADO DOCUMENTO, idUsuario = 1 WHERE idDocumento = 2', '2017-04-11', 1),
(18, 'E', 'DELETE FROM  documento WHERE idDocumento = 2-ALTERADO DOCUMENTO', '2017-04-11', 1),
(19, 'I', 'INSERT INTO documento (idDocumento, descricao_documento, idUsuario) VALUES (null, OFICIO DO SUPREMO, 1)', '2017-04-26', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `log_origem`
--

CREATE TABLE `log_origem` (
  `id_log_origem` int(11) NOT NULL,
  `tipo_comando` varchar(1) COLLATE utf8_unicode_ci NOT NULL COMMENT 'I - inserir, A - alterar, E - excluir',
  `comando_sql` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'comando sql executado',
  `data_comando` date NOT NULL,
  `usuario_comando` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `log_origem`
--

INSERT INTO `log_origem` (`id_log_origem`, `tipo_comando`, `comando_sql`, `data_comando`, `usuario_comando`) VALUES
(14, 'I', 'INSERT INTO origem (idOrigem, descricao_origem, idUsuario) VALUES (null, TESTE ORIGEM, 1)', '2017-04-11', 1),
(15, 'A', 'UPDATE origem SET descricao_origem = ALTEREI A ORIGIEM, idUsuario = 1 WHERE idOrigem = 2', '2017-04-11', 1),
(16, 'E', 'DELETE FROM  origem WHERE idOrigem = 2-ALTEREI A ORIGIEM', '2017-04-11', 1),
(17, 'I', 'INSERT INTO origem (idOrigem, descricao_origem, idUsuario) VALUES (null, PREFEITURA, 1)', '2017-04-26', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `log_requerente`
--

CREATE TABLE `log_requerente` (
  `id_log_requerente` int(11) NOT NULL,
  `tipo_comando` varchar(1) COLLATE utf8_unicode_ci NOT NULL COMMENT 'I - inserir, A - alterar, E - excluir',
  `comando_sql` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'comando sql executado',
  `data_comando` date NOT NULL,
  `usuario_comando` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `log_requerente`
--

INSERT INTO `log_requerente` (`id_log_requerente`, `tipo_comando`, `comando_sql`, `data_comando`, `usuario_comando`) VALUES
(19, 'I', 'INSERT INTO requerente (idRequerente, requerente, logradouro, numeroEnd, complemento, bairro, cidade, uf, cep, tel, cel) VALUES  (null, ROBERTA ,RUA FRANCISCO SOARES DE OLIVEIRA,26, CASA, VILA ROSALI, SAO JOAO DE MERITI, RJ, 25525180, 2126511048, 21981295812)', '2017-04-17', 1),
(20, 'E', 'DELETE FROM  requerente WHERE idRequerente = 5', '2017-04-17', 1),
(21, 'E', 'DELETE FROM  requerente WHERE idRequerente = 1', '2017-04-17', 1),
(22, 'A', 'UPDATE requerente SET requerente = BIANCA,  logradouro = RUA FRANCISCO SOARES DE OLIVEIRA,  numeroEnd = 18,  complemento = CASA,  bairro = VILA ROSALI,  cidade = SAO JOAO DE MERITI,  uf= RJ,  cep = 25525180,  tel= 2127567241,  cel = 21981295812  WHERE idRequerente = 3 ', '2017-04-18', 1),
(23, 'A', 'UPDATE requerente SET requerente = BIANCA,  logradouro = RUA FRANCISCO SOARES DE OLIVEIRA,  numeroEnd = 18,  complemento = CASA,  bairro = VILA ROSALI,  cidade = SAO JOAO DE MERITI,  uf= RJ,  cep = 25525180,  tel= 2127567241,  cel = 21981295812  WHERE idRequerente = 3 ', '2017-04-18', 1),
(24, 'A', 'UPDATE requerente SET requerente = TROCADO,  logradouro = RUA JORNALISTA GERALDO ROCHA,  numeroEnd = 265,  complemento = PARVAIM,  bairro = JARDIM MERITI,  cidade = SAO JOAO DE MERITI,  uf= RJ,  cep = 25555221,  tel= 2127567241,  cel = 21685215222  WHERE idRequerente = 3 ', '2017-04-18', 1),
(25, 'E', 'DELETE FROM  requerente WHERE idRequerente = 3', '2017-04-18', 1),
(26, 'I', 'INSERT INTO requerente (idRequerente, requerente, logradouro, numeroEnd, complemento, bairro, cidade, uf, cep, tel, cel) VALUES  (null, IGOR BARROZO BRASIL,RUA FRANCISCO SOARES DE OLIVEIRA,265, CASA, VILA ROSALI, SAO JOAO DE MERITI, RJ, 25525180, 2127567241, 21981295812)', '2017-04-26', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `log_setor`
--

CREATE TABLE `log_setor` (
  `id_log_setor` int(11) NOT NULL,
  `tipo_comando` varchar(1) COLLATE utf8_unicode_ci NOT NULL COMMENT 'I - inserir, A - alterar, E - excluir',
  `comando_sql` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'comando sql executado',
  `data_comando` date NOT NULL,
  `usuario_comando` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `log_setor`
--

INSERT INTO `log_setor` (`id_log_setor`, `tipo_comando`, `comando_sql`, `data_comando`, `usuario_comando`) VALUES
(15, 'I', 'INSERT INTO setor (idSetor, setor, secretaria, descSecretaria, coordenadoria, descCoordenadoria, departamento, descDepartamento) VALUES  (null, TESOURARIA,TESOURARIA,TESOURARIA, TESOURARIA, TESOURARIA, TESOURARIA, TESOURARIA)', '2017-04-17', 1),
(16, 'I', 'INSERT INTO setor (idSetor, setor, secretaria, descSecretaria, coordenadoria, descCoordenadoria, departamento, descDepartamento) VALUES  (null, SECRETARIA,SECRETARIA,DESCRICAO SECRETARIA, COORDENADORIA, DESCRICAO COORDENADORIA, DEPARTAMENTO, DESCRICAO DEPARTAMENTO)', '2017-04-17', 1),
(17, 'I', 'INSERT INTO setor (idSetor, setor, secretaria, descSecretaria, coordenadoria, descCoordenadoria, departamento, descDepartamento) VALUES  (null, DSA,DSA,DSASD, ASDASD, DSADASD, ASDAS, ADASD)', '2017-04-17', 1),
(18, 'A', 'UPDATE setor  SET setor = ALT_SEC,  setor = ALT_SEC,  secretaria = ALT_SEC,  descSecretaria = ALT_DESC_SEC,  coordenadoria = ALT_COOR,  descCoordenadoria = ALT_DESC_COR,  departamento = ALT_DEP,  descDepartamento = ALT_DESC_DEP  WHERE idSetor = 10', '2017-04-17', 1),
(19, 'E', 'DELETE FROM  setor WHERE idSetor = 6', '2017-04-17', 1),
(20, 'I', 'INSERT INTO requerente (idRequerente, requerente, logradouro, numeroEnd, complemento, bairro, cidade, uf, cep, tel, cel) VALUES  (null, BIANCA,RUA FRANCISCO SOARES DE OLIVEIRA,18, CASA, VILA ROSALI, SAO JOAO DE MERITI, RJ, 25525180, 2127567241, 21981295812)', '2017-04-17', 1),
(21, 'E', 'DELETE FROM  setor WHERE idSetor = 5', '2017-04-17', 1),
(22, 'I', 'INSERT INTO setor (idSetor, setor, secretaria, descSecretaria, coordenadoria, descCoordenadoria, departamento, descDepartamento) VALUES  (null, ADMINISTRACAO,ADMINISTRACAO,ADMINISTRACAO, ADMINISTRACAO, ADMINISTRACAO, ADMINISTRACAO, ADMINISTRACAO)', '2017-05-03', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `log_tipo_processo`
--

CREATE TABLE `log_tipo_processo` (
  `id_log_tipo_processo` int(11) NOT NULL,
  `tipo_comando` varchar(1) COLLATE utf8_unicode_ci NOT NULL COMMENT 'I - inserir, A - alterar, E - excluir',
  `comando_sql` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'comando sql executado',
  `data_comando` date NOT NULL,
  `usuario_comando` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `log_tipo_processo`
--

INSERT INTO `log_tipo_processo` (`id_log_tipo_processo`, `tipo_comando`, `comando_sql`, `data_comando`, `usuario_comando`) VALUES
(20, 'I', 'INSERT INTO tipo_processo (id_tipo_processo, descricao_tipo_processo) VALUES (null, URGENCIA)', '2017-04-18', 1),
(21, 'E', 'DELETE FROM  tipo_processo WHERE id_tipo_processo = 4-URGENCIA', '2017-04-18', 1),
(22, 'E', 'DELETE FROM  tipo_processo WHERE id_tipo_processo = 3-PROCESSO DE PAGAMENTO', '2017-04-18', 1),
(23, 'I', 'INSERT INTO tipo_processo (id_tipo_processo, descricao_tipo_processo) VALUES (null, TESTE)', '2017-04-18', 1),
(24, 'E', 'DELETE FROM  tipo_processo WHERE id_tipo_processo = 5-ALTERADO', '2017-04-18', 1),
(25, 'E', 'DELETE FROM  tipo_processo WHERE id_tipo_processo = 2- COMUNICACAO EXTERNA', '2017-04-18', 1),
(26, 'I', 'INSERT INTO tipo_processo (id_tipo_processo, descricao_tipo_processo, numero_proximo_processo) VALUES (null, COMUNICACAO EXTERNA, 1)', '2017-04-18', 1);

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
(9, 43, 'CAEGA'),
(10, 44, 'TESTE DE CADASTRO DE CARDA'),
(11, 45, 'SADASDSAD'),
(12, 46, 'TESTE DE CADASTRO DE SISTEMA');

-- --------------------------------------------------------

--
-- Estrutura da tabela `origem`
--

CREATE TABLE `origem` (
  `idOrigem` int(11) NOT NULL,
  `descricao_origem` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `origem`
--

INSERT INTO `origem` (`idOrigem`, `descricao_origem`, `idUsuario`) VALUES
(1, 'PARVAIM SOFTWARE E GESTAO', 1),
(2, 'PREFEITURA', 1);

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
(2, 'ANDRE CAETANO', 'FRANCISCO SOARES DE OLIVEIRA', 44, 'SOBRADO', 'VILA ROSALI', 'RIO DE JANEIRO', 'RJ', '25525180', '2126511048', '21981295812'),
(3, 'IGOR BARROZO BRASIL', 'RUA FRANCISCO SOARES DE OLIVEIRA', 265, 'CASA', 'VILA ROSALI', 'SAO JOAO DE MERITI', 'RJ', '25525180', '2127567241', '21981295812');

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
(1, 'PROTOCOLO', 'PROTOCOLO', 'PROTOCOLO', 'PROTOCOLO', 'PROTOCOLO', 'PROTOCOLO', 'PROTOCOLO'),
(2, 'CONTABILIDADE', 'CONTÃBILIDADE', 'CONTÃBILIDADE', 'CONTÃBILIDADE', 'CONTÃBILIDADE', 'CONTÃBILIDADE', 'CONTÃBILIDADE'),
(3, 'ADMINISTRACAO', 'ADMINISTRACAO', 'ADMINISTRACAO', 'ADMINISTRACAO', 'ADMINISTRACAO', 'ADMINISTRACAO', 'ADMINISTRACAO');

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
(1, 'COMUNICACAO INTERNA', 2),
(6, 'COMUNICACAO EXTERNA', 4);

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
(1, 'SA', 'SA', 'SA@PARVAIM.COM.BR', 1, '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'SA', 0, 1),
(2, 'IGOR', 'IGOR', 'IGOR@PARVAIM.COM.BR', 2, '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'BARROZO', 0, 0),
(3, 'HEBERT', 'HEBERT', 'HEBERT@PARVAIM.COM.BR', 3, '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'MAIA', 0, 0);

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
  MODIFY `idAssunto` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cadastro_processo`
--
ALTER TABLE `cadastro_processo`
  MODIFY `idProcesso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT for table `carga_processo`
--
ALTER TABLE `carga_processo`
  MODIFY `idCarga` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `documento`
--
ALTER TABLE `documento`
  MODIFY `idDocumento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `documento_processo`
--
ALTER TABLE `documento_processo`
  MODIFY `idDocumentoProcesso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT for table `log_assunto`
--
ALTER TABLE `log_assunto`
  MODIFY `id_log_assunto` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `log_documento`
--
ALTER TABLE `log_documento`
  MODIFY `id_log_documento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `log_origem`
--
ALTER TABLE `log_origem`
  MODIFY `id_log_origem` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `log_requerente`
--
ALTER TABLE `log_requerente`
  MODIFY `id_log_requerente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `log_setor`
--
ALTER TABLE `log_setor`
  MODIFY `id_log_setor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `log_tipo_processo`
--
ALTER TABLE `log_tipo_processo`
  MODIFY `id_log_tipo_processo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `obs`
--
ALTER TABLE `obs`
  MODIFY `idObs` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `origem`
--
ALTER TABLE `origem`
  MODIFY `idOrigem` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
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
  MODIFY `idRequerente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `setor`
--
ALTER TABLE `setor`
  MODIFY `idSetor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tipo_processo`
--
ALTER TABLE `tipo_processo`
  MODIFY `id_tipo_processo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
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
