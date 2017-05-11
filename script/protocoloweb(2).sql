-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 11-Maio-2017 às 22:18
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
  `usuario` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='tabela assunto';

--
-- Extraindo dados da tabela `assunto`
--

INSERT INTO `assunto` (`idAssunto`, `descricao_assunto`, `usuario`) VALUES
(3, 'DIREITOS TRABALHISTAS', 'sa'),
(4, 'JUSTIFICACAO JUDICIAL', 'sa'),
(5, 'APOSENTADORIA', 'sa'),
(6, 'ALUGUEL DAS SALAS 201, 201A E 203', 'sa'),
(7, 'PRESTACAO DE CONTAS', 'sa'),
(8, 'FATURA DE ENERGIA', 'sa'),
(9, 'PAGAMENTO DE FATURA', 'sa'),
(10, 'MINUTA DE CONVENIO', 'sa'),
(11, 'RESTITUICAO DO PREVINIL', 'sa'),
(12, 'MEMORANDO', 'sa'),
(13, 'DECLARACAO', 'sa'),
(14, 'PEDIDO DE PENSAO POR MORTE', 'sa'),
(15, 'REVERSAO DE PENSAO', 'sa'),
(16, 'SOLICITACAO', 'sa');

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
('recursos/imagens/estrutura/logo.jpg', 'PARVAIM SOFTWARE DE GESTAO', 'SECRETRIA DE TI', '123456789', 265, 'PARVAIM', 'SAO JOAO DE MERITI', 'RJ', '39485396000140', 'RUA FRANCISCO SOARES DE OLIVEIRA', 'VILA ROSALI', '25525180');

-- --------------------------------------------------------

--
-- Estrutura da tabela `documento`
--

CREATE TABLE `documento` (
  `idDocumento` int(11) NOT NULL,
  `descricao_documento` varchar(50) NOT NULL,
  `usuario` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `documento`
--

INSERT INTO `documento` (`idDocumento`, `descricao_documento`, `usuario`) VALUES
(2, 'OFICIO DE PAGAMENTO', 'sa'),
(3, 'OFICIO DE PROCESSO CONTRA PREVINIL', 'sa'),
(4, 'DOCUMENTO PARA GABINETE DA PRESIDENCIA', 'sa');

--
-- Acionadores `documento`
--
DELIMITER $$
CREATE TRIGGER `alterar_documento` BEFORE UPDATE ON `documento` FOR EACH ROW INSERT INTO log_documento
SET acao = 'alteracao',
id_documento = new.idDocumento,
descricao_documento = new.descricao_documento,
usuario = new.usuario,
modificadoem = now()
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `excluir_documento` BEFORE DELETE ON `documento` FOR EACH ROW INSERT INTO log_documento
set acao = 'exclusao',
id_documento = old.idDocumento,
descricao_documento = old.descricao_documento,
usuario = old.usuario,
modificadoem = now()
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `inserindo_documento` AFTER INSERT ON `documento` FOR EACH ROW INSERT INTO log_documento
SET acao = 'insercao',
id_documento = new.idDocumento,
usuario = new.usuario,
descricao_documento = new.descricao_documento,
modificadoem = NOW()
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
(1, 1, 'DIREITOS TRABALHISTAS', 'root@localhost', '2017-05-11', 'insercao'),
(2, 1, 'DIREITOS TRABALHISTAS_AL', 'root@localhost', '2017-05-11', 'alteracao'),
(3, 1, 'DIREITOS TRABALHISTAS', 'root@localhost', '2017-05-11', 'alteracao'),
(4, 1, 'DIREITOS TRABALHISTAS', 'root@localhost', '2017-05-11', 'alteracao'),
(5, 1, 'DIREITOS TRABALHISTAS', 'root@localhost', '2017-05-11', 'exclusao'),
(6, 3, 'DIREITOS TRABALHISTAS', 'root@localhost', '2017-05-11', 'insercao'),
(7, 4, 'PAGAMENTO DE CONTA TELEFONICA', 'root@localhost', '2017-05-11', 'insercao'),
(8, 5, 'APOSENTADORIA', 'root@localhost', '2017-05-11', 'insercao'),
(9, 6, 'ALUGUEL DAS SALAS 201, 201A E 203', 'root@localhost', '2017-05-11', 'insercao'),
(10, 7, 'PRESTACAO DE CONTAS', 'root@localhost', '2017-05-11', 'insercao'),
(11, 8, 'FATURA DE ENERGIA', 'root@localhost', '2017-05-11', 'insercao'),
(12, 9, 'PAGAMENTO DE FATURA', 'root@localhost', '2017-05-11', 'insercao'),
(13, 10, 'MINUTA DE CONVENIO', 'root@localhost', '2017-05-11', 'insercao'),
(14, 11, 'RESTITUICAO DO PREVINIL', 'root@localhost', '2017-05-11', 'insercao'),
(15, 12, 'MEMORANDO', 'root@localhost', '2017-05-11', 'insercao'),
(16, 13, 'DECLARACAO', 'root@localhost', '2017-05-11', 'insercao'),
(17, 14, 'PEDIDO DE PENSAO POR MORTE', 'root@localhost', '2017-05-11', 'insercao'),
(18, 15, 'REVERSAO DE PENSAO', 'root@localhost', '2017-05-11', 'insercao'),
(19, 16, 'SOLICITACAO', 'root@localhost', '2017-05-11', 'insercao'),
(20, 4, 'JUSTIFICACAO JUDICIAL', 'root@localhost', '2017-05-11', 'alteracao'),
(21, 17, 'ALO MUNDO', 'root@localhost', '2017-05-11', 'insercao'),
(22, 17, 'HELLO WORLD', 'root@localhost', '2017-05-11', 'alteracao'),
(23, 17, 'HELLO WORLD', 'root@localhost', '2017-05-11', 'alteracao'),
(24, 17, 'HELLO WORLD', 'root@localhost', '2017-05-11', 'exclusao');

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
(1, 1, 'OFICIO DO SUPREMO', 'root@localhost', '2017-05-11', 'insercao'),
(2, 2, 'OFICIO DE PAGAMENTO', 'root@localhost', '2017-05-11', 'insercao'),
(3, 3, 'OFICIO DE PROCESSO CONTRA PREVINIL', 'root@localhost', '2017-05-11', 'insercao'),
(4, 4, 'DOCUMENTO PARA GABINETE DA PRESIDENCIA', 'sa', '2017-05-11', 'insercao'),
(5, 1, 'OFICIO DO SUPREMO_ALT', 'sa', '2017-05-11', 'alteracao'),
(6, 1, 'OFICIO DO SUPREMO_ASAD', 'sa', '2017-05-11', 'alteracao'),
(7, 1, 'OFICIO DO SUPREMO', 'sa', '2017-05-11', 'alteracao'),
(8, 1, 'OFICIO DO SUPREMO', 'sa', '2017-05-11', 'alteracao'),
(9, 1, 'OFICIO DO SUPREMO', 'sa', '2017-05-11', 'exclusao');

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
(2, 'insercao', 2, 'TESOURARIA', 'sa', '2017-05-11'),
(3, 'insercao', 3, 'PROTOCOLO/ RECEPCAO', 'sa', '2017-05-11'),
(4, 'insercao', 4, 'PROC 193/05', 'sa', '2017-05-11'),
(5, 'insercao', 5, 'SECRETARIA MUNICIPAL DE SAUDE', 'sa', '2017-05-11'),
(6, 'insercao', 6, 'SECRETARIA MUNIC. DE EDUCACAO', 'sa', '2017-05-11'),
(7, 'alteracao', 2, 'TESOURARIA_AL', 'sa', '2017-05-11'),
(9, 'alteracao', 2, 'TESOURARIA_AL_S', 'sa', '2017-05-11'),
(10, 'alteracao', 2, 'TESOURARIA_AL_S', 'sa', '2017-05-11'),
(11, 'exclusao', 2, 'TESOURARIA_AL_S', 'sa', '2017-05-11');

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
(1, 'insercao', 1, 'GAB.PRES  ', 'GAB.PRES  ', 'GABINETE DA PRESIDENCIA', 'GAB.PRES  ', 'GABINETE DA PRESIDENCIA', 'GAB.PRES  ', 'GABINETE DA PRESIDENCIA', '2017-05-11', 'sa'),
(2, 'insercao', 2, 'DBA', 'DBA', 'DIRETORIA DE BENEF. E ADMINISTRACAO', 'DBA', 'DIRETORIA DE BENEF. E ADMINISTRACAO', 'DBA', 'DIRETORIA DE BENEF. E ADMINISTRACAO', '2017-05-11', 'sa'),
(3, 'alteracao', 1, 'GAB.PRES  ', 'GAB.PRES  ', 'GABINETE DA PRESIDENCIA', 'GAB.PRES  ', 'GABINETE DA PRESIDENCIA', 'GAB.PRES  ', 'GABINETE DA PRESIDENCIA', '2017-05-11', 'sa'),
(4, 'alteracao', 1, 'GAB.PRES_ALT', 'GAB.PRES_ALT', 'GABINETE DA PRESIDENCIA_ALT', 'GAB.PRES  _ALT', 'GABINETE DA PRESIDENCIA_ALT', 'GAB.PRES  _ALT', 'GABINETE DA PRESIDENCIA_ALT', '2017-05-11', 'sa'),
(5, 'exclusao', 1, 'GAB.PRES_ALT', 'GAB.PRES_ALT', 'GABINETE DA PRESIDENCIA_ALT', 'GAB.PRES  _ALT', 'GABINETE DA PRESIDENCIA_ALT', 'GAB.PRES  _ALT', 'GABINETE DA PRESIDENCIA_ALT', '2017-05-11', 'sa');

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
(1, 'insercao', 1, 'APOSENTADORIA', 1, 'sa', '2017-05-11'),
(2, 'insercao', 2, 'PREFEITURA', 1, 'sa', '2017-05-11'),
(3, 'alteracao', 1, 'APOSENTADORIA_AL', 1, 'sa', '2017-05-11'),
(4, 'alteracao', 2, 'PREFEITURA', 1, 'sa', '2017-05-11'),
(5, 'exclusao', 2, 'PREFEITURA', 1, 'sa', '2017-05-11');

-- --------------------------------------------------------

--
-- Estrutura da tabela `obs`
--

CREATE TABLE `obs` (
  `idObs` int(11) NOT NULL,
  `idProcesso` int(11) NOT NULL,
  `obs` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `origem`
--

CREATE TABLE `origem` (
  `idOrigem` int(11) NOT NULL,
  `descricao_origem` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `usuario` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `origem`
--

INSERT INTO `origem` (`idOrigem`, `descricao_origem`, `usuario`) VALUES
(3, 'PROTOCOLO/ RECEPCAO', 'sa'),
(4, 'PROC 193/05', 'sa'),
(5, 'SECRETARIA MUNICIPAL DE SAUDE', 'sa'),
(6, 'SECRETARIA MUNIC. DE EDUCACAO', 'sa');

--
-- Acionadores `origem`
--
DELIMITER $$
CREATE TRIGGER `alterando_origem` BEFORE UPDATE ON `origem` FOR EACH ROW INSERT INTO log_origem
SET acao = 'alteracao',
id_origem = new.idOrigem,
descricao_origem = new.descricao_origem,
usuario = new.usuario,
modificadoem = now()
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `excluindo_origem` BEFORE DELETE ON `origem` FOR EACH ROW insert into log_origem
set acao = 'exclusao',
id_origem = old.idOrigem,
descricao_origem = old.descricao_origem,
usuario = old.usuario,
modificadoem = now()
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `inserindo_origem` AFTER INSERT ON `origem` FOR EACH ROW insert into log_origem
    set acao = 'insercao',
    id_origem = new.idOrigem,
    descricao_origem = new.descricao_origem,
    usuario = new.usuario,
    modificadoem = now()
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
  `descDepartamento` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `usuario` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `setor`
--

INSERT INTO `setor` (`idSetor`, `setor`, `secretaria`, `descSecretaria`, `coordenadoria`, `descCoordenadoria`, `departamento`, `descDepartamento`, `usuario`) VALUES
(2, 'DBA', 'DBA', 'DIRETORIA DE BENEF. E ADMINISTRACAO', 'DBA', 'DIRETORIA DE BENEF. E ADMINISTRACAO', 'DBA', 'DIRETORIA DE BENEF. E ADMINISTRACAO', 'sa');

--
-- Acionadores `setor`
--
DELIMITER $$
CREATE TRIGGER `alterando_setor` BEFORE UPDATE ON `setor` FOR EACH ROW INSERT INTO log_setor
SET acao = 'alteracao',
id_setor = old.idSetor,
setor = old.setor,
secretaria = old.secretaria,
desc_secretaria = old.descSecretaria,
coordenadoria = old.coordenadoria,
desc_coordenadoria = old.descCoordenadoria,
departamento = old.departamento,
desc_departamento = old.descDepartamento,
usuario = new.usuario,
modificadoem = NOW()
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `excluindo_setor` BEFORE DELETE ON `setor` FOR EACH ROW INSERT INTO log_setor
SET acao = 'exclusao',
id_setor = old.idSetor,
setor = old.setor,
secretaria = old.secretaria,
desc_secretaria = old.descSecretaria,
coordenadoria = old.coordenadoria,
desc_coordenadoria = old.descCoordenadoria,
departamento = old.departamento,
desc_departamento = old.descDepartamento,
usuario = old.usuario,
modificadoem = NOW()
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `inserindo_setor` AFTER INSERT ON `setor` FOR EACH ROW INSERT INTO log_setor
SET acao = 'insercao',
id_setor = new.idSetor,
setor = new.setor,
secretaria = new.secretaria,
desc_secretaria = new.descSecretaria,
coordenadoria = new.coordenadoria,
desc_coordenadoria = new.descCoordenadoria,
departamento = new.departamento,
desc_departamento = new.descDepartamento,
usuario = new.usuario,
modificadoem = NOW()
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_processo`
--

CREATE TABLE `tipo_processo` (
  `id_tipo_processo` int(11) NOT NULL,
  `descricao_tipo_processo` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `numero_proximo_processo` int(11) NOT NULL,
  `usuario` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `tipo_processo`
--

INSERT INTO `tipo_processo` (`id_tipo_processo`, `descricao_tipo_processo`, `numero_proximo_processo`, `usuario`) VALUES
(1, 'APOSENTADORIA_AL', 1, 'sa');

--
-- Acionadores `tipo_processo`
--
DELIMITER $$
CREATE TRIGGER `alterando_tipo_processo` BEFORE UPDATE ON `tipo_processo` FOR EACH ROW INSERT INTO log_tipo_processo
SET acao = 'alteracao',
id_tipo_processo = new.id_tipo_processo,
descricao_tipo_processo = new.descricao_tipo_processo,
numero_proximo_processo = new.numero_proximo_processo,
usuario = new.usuario,
modificadoem = NOW()
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `excluindo_tipo_processo` BEFORE DELETE ON `tipo_processo` FOR EACH ROW INSERT INTO log_tipo_processo
SET acao = 'exclusao',
id_tipo_processo = old.id_tipo_processo,
descricao_tipo_processo = old.descricao_tipo_processo,
numero_proximo_processo = old.numero_proximo_processo,
usuario = old.usuario,
modificadoem = NOW()
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `inserindo_tipo_processo` AFTER INSERT ON `tipo_processo` FOR EACH ROW INSERT INTO log_tipo_processo
SET acao = 'insercao',
id_tipo_processo = new.id_tipo_processo,
descricao_tipo_processo = new.descricao_tipo_processo,
numero_proximo_processo = new.numero_proximo_processo,
usuario = new.usuario,
modificadoem = NOW()
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
  `perfil` int(1) NOT NULL COMMENT '1 = adm, 0 = usu',
  `criado_por` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `login`, `nome`, `email`, `idSetor`, `senha`, `sobrenome`, `status`, `perfil`, `criado_por`) VALUES
(1, 'SA', 'SA', 'SA@PARVAIM.COM.BR', 1, 'e10adc3949ba59abbe56e057f20f883e', 'SA', 0, 1, 'sa'),
(2, 'THAYNA', 'IGOR', 'IGOR@PARVAIM.COM.BR', 2, '202cb962ac59075b964b07152d234b70', 'BARROZO', 0, 0, ''),
(3, 'HEBERT', 'HEBERT', 'HEBERT@PARVAIM.COM.BR', 3, '202cb962ac59075b964b07152d234b70', 'MAIA', 0, 0, ''),
(4, 'THAYNA1', 'THAYNA1', 'THAYNA1@LOCALHOST', 1, '202cb962ac59075b964b07152d234b70', 'PEREIRA', 0, 0, ''),
(6, 'THAYNA12', 'THAYNA12', 'THAYNA12@LOCALHOST', 1, '202cb962ac59075b964b07152d234b70', 'PEREIRA', 0, 0, ''),
(13, 'THAYNA122', 'THAYNA122', 'THAYNA122@LOCALHOST', 1, '202cb962ac59075b964b07152d234b70', 'PEREIRA', 0, 0, ''),
(14, 'ADMIN', 'ADMIN', 'ADMIN@PARVAIM.COM.BR', 2, '202cb962ac59075b964b07152d234b70', 'ADMIN', 0, 1, 'sa');

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
  MODIFY `idAssunto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `cadastro_processo`
--
ALTER TABLE `cadastro_processo`
  MODIFY `idProcesso` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `carga_processo`
--
ALTER TABLE `carga_processo`
  MODIFY `idCarga` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `documento`
--
ALTER TABLE `documento`
  MODIFY `idDocumento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `documento_processo`
--
ALTER TABLE `documento_processo`
  MODIFY `idDocumentoProcesso` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `log_assunto`
--
ALTER TABLE `log_assunto`
  MODIFY `id_log_assunto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `log_documento`
--
ALTER TABLE `log_documento`
  MODIFY `id_log_documento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `log_origem`
--
ALTER TABLE `log_origem`
  MODIFY `id_log_origem` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `log_requerente`
--
ALTER TABLE `log_requerente`
  MODIFY `id_log_requerente` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `log_setor`
--
ALTER TABLE `log_setor`
  MODIFY `id_log_setor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `log_tipo_processo`
--
ALTER TABLE `log_tipo_processo`
  MODIFY `id_log_tipo_processo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `obs`
--
ALTER TABLE `obs`
  MODIFY `idObs` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `origem`
--
ALTER TABLE `origem`
  MODIFY `idOrigem` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `permissao`
--
ALTER TABLE `permissao`
  MODIFY `idPermissao` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `processo_em_anexo`
--
ALTER TABLE `processo_em_anexo`
  MODIFY `idAnexo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `requerente`
--
ALTER TABLE `requerente`
  MODIFY `idRequerente` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `setor`
--
ALTER TABLE `setor`
  MODIFY `idSetor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tipo_processo`
--
ALTER TABLE `tipo_processo`
  MODIFY `id_tipo_processo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
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
