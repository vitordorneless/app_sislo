-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.4.20-MariaDB - Source distribution
-- OS do Servidor:               Linux
-- HeidiSQL Versão:              12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para sislo
CREATE DATABASE IF NOT EXISTS `sislo` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `sislo`;

-- Copiando estrutura para tabela sislo.sislo_candidato
CREATE TABLE IF NOT EXISTS `sislo_candidato` (
  `id_sislo_candidato` int(11) NOT NULL AUTO_INCREMENT,
  `cpf` varchar(11) DEFAULT NULL,
  `nome` varchar(199) DEFAULT NULL,
  `nascimento` date DEFAULT NULL,
  `telefone` varchar(12) DEFAULT NULL,
  `email` varchar(199) DEFAULT NULL,
  `cep` varchar(9) DEFAULT NULL,
  `endereco` varchar(299) DEFAULT NULL,
  `numero` varchar(299) DEFAULT NULL,
  `complemento` varchar(299) DEFAULT NULL,
  `bairro` varchar(299) DEFAULT NULL,
  `cidade` varchar(299) DEFAULT NULL,
  `sexo` int(11) DEFAULT NULL,
  `escolaridade` int(11) DEFAULT NULL,
  `uf` varchar(299) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `data_ultima_alteracao` datetime DEFAULT NULL,
  PRIMARY KEY (`id_sislo_candidato`),
  UNIQUE KEY `cpf` (`cpf`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela sislo.sislo_candidato: ~0 rows (aproximadamente)
INSERT INTO `sislo_candidato` (`id_sislo_candidato`, `cpf`, `nome`, `nascimento`, `telefone`, `email`, `cep`, `endereco`, `numero`, `complemento`, `bairro`, `cidade`, `sexo`, `escolaridade`, `uf`, `status`, `data_ultima_alteracao`) VALUES
	(1, '00729530043', 'vitor dorneles pimentel', '1985-02-26', '51994336363', 'vitordorneles@hotmail.com', '92030490', 'Rua Ernesto da Silva Rocha', '394', 'casa', 'Estância Velha', 'Canoas', 1, 3, 'RS', 1, '2023-09-11 15:35:52');

-- Copiando estrutura para tabela sislo.sislo_candidato_experiencia
CREATE TABLE IF NOT EXISTS `sislo_candidato_experiencia` (
  `id_sislo_candidato_experiencia` int(11) NOT NULL AUTO_INCREMENT,
  `cpf_sislo_candidato` varchar(11) DEFAULT NULL,
  `nome_empresa` varchar(199) DEFAULT NULL,
  `data_inicial` date DEFAULT NULL,
  `data_final` date DEFAULT NULL,
  `emprego_atual` int(11) DEFAULT NULL,
  `cargo` varchar(50) DEFAULT NULL,
  `funcoes` text DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `data_ultima_alteracao` datetime DEFAULT NULL,
  PRIMARY KEY (`id_sislo_candidato_experiencia`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela sislo.sislo_candidato_experiencia: ~2 rows (aproximadamente)
INSERT INTO `sislo_candidato_experiencia` (`id_sislo_candidato_experiencia`, `cpf_sislo_candidato`, `nome_empresa`, `data_inicial`, `data_final`, `emprego_atual`, `cargo`, `funcoes`, `status`, `data_ultima_alteracao`) VALUES
	(1, '00729530043', 'Teste 1', '2007-09-01', '2023-09-08', 0, 'Caixa', 'fazia de tudo, escravo', 1, '2023-09-13 13:52:00'),
	(2, '00729530043', 'loteria mel', '2018-08-01', NULL, 1, 'Gerente', 'fazia isso e aquilo e outro e mais esse', 1, '2023-09-13 14:12:26'),
	(3, '00729530043', 'CETT', '2023-05-02', '2023-07-27', 0, 'Operador Caixa Lotérico', 'fazia algumas coisas', 1, '2023-09-28 09:13:57');

-- Copiando estrutura para tabela sislo.sislo_candidato_login
CREATE TABLE IF NOT EXISTS `sislo_candidato_login` (
  `id_sislo_candidato_login` int(11) NOT NULL AUTO_INCREMENT,
  `cpf_sislo_candidato` varchar(11) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `data_ultima_alteracao` datetime NOT NULL,
  PRIMARY KEY (`id_sislo_candidato_login`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela sislo.sislo_candidato_login: ~0 rows (aproximadamente)
INSERT INTO `sislo_candidato_login` (`id_sislo_candidato_login`, `cpf_sislo_candidato`, `pass`, `status`, `data_ultima_alteracao`) VALUES
	(1, '00729530043', 'ec7117851c0e5dbaad4effdb7cd17c050cea88cb', 1, '2023-09-20 11:00:23');

-- Copiando estrutura para tabela sislo.sislo_cargo
CREATE TABLE IF NOT EXISTS `sislo_cargo` (
  `id_sislo_cargo` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cargo` varchar(50) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `data_ultima_alteracao` datetime DEFAULT NULL,
  PRIMARY KEY (`id_sislo_cargo`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela sislo.sislo_cargo: ~4 rows (aproximadamente)
INSERT INTO `sislo_cargo` (`id_sislo_cargo`, `cargo`, `status`, `data_ultima_alteracao`) VALUES
	(1, 'Caixa Operador Lotérico', 1, '2021-10-30 20:38:10'),
	(2, 'Supervisor de Caixa', 1, '2021-10-30 20:38:21'),
	(3, 'Gerente de Operações', 1, '2021-10-30 20:38:38'),
	(4, 'CEO', 1, '2021-10-30 20:38:46');

-- Copiando estrutura para tabela sislo.sislo_caucao
CREATE TABLE IF NOT EXISTS `sislo_caucao` (
  `idsislo_caucao` int(11) NOT NULL AUTO_INCREMENT,
  `cod_loterico` varchar(10) DEFAULT NULL,
  `referencia` varchar(8) DEFAULT NULL,
  `valor_caucao` decimal(10,2) DEFAULT NULL,
  `tributos_federais` decimal(10,2) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `data_ultima_alteracao` datetime DEFAULT NULL,
  PRIMARY KEY (`idsislo_caucao`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela sislo.sislo_caucao: ~0 rows (aproximadamente)
INSERT INTO `sislo_caucao` (`idsislo_caucao`, `cod_loterico`, `referencia`, `valor_caucao`, `tributos_federais`, `status`, `data_ultima_alteracao`) VALUES
	(1, '180178580', '10/2022', 233.46, 0.00, 1, '2023-02-14 09:11:27');

-- Copiando estrutura para tabela sislo.sislo_chamados
CREATE TABLE IF NOT EXISTS `sislo_chamados` (
  `idsislo_chamados` int(11) NOT NULL AUTO_INCREMENT,
  `numero_chamado` varchar(50) DEFAULT NULL,
  `titulo_chamado` varchar(199) DEFAULT NULL,
  `texto_chamado` varchar(199) DEFAULT NULL,
  `conclusao_chamado` varchar(199) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`idsislo_chamados`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela sislo.sislo_chamados: ~0 rows (aproximadamente)
INSERT INTO `sislo_chamados` (`idsislo_chamados`, `numero_chamado`, `titulo_chamado`, `texto_chamado`, `conclusao_chamado`, `status`) VALUES
	(1, '202202262028572626', 'indicadores', 'fazer indicadores por caixa', '', 1);

-- Copiando estrutura para tabela sislo.sislo_cob_diaria_conta_servico
CREATE TABLE IF NOT EXISTS `sislo_cob_diaria_conta_servico` (
  `idsislo_cob_diaria_conta_servico` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cod_loterico` varchar(10) NOT NULL,
  `referencia` varchar(8) NOT NULL,
  `data_inicial` datetime NOT NULL,
  `data_final` datetime NOT NULL,
  `id_sislo_tipo_servico` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `data_ultima_alteracao` datetime NOT NULL,
  PRIMARY KEY (`idsislo_cob_diaria_conta_servico`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela sislo.sislo_cob_diaria_conta_servico: ~9 rows (aproximadamente)
INSERT INTO `sislo_cob_diaria_conta_servico` (`idsislo_cob_diaria_conta_servico`, `cod_loterico`, `referencia`, `data_inicial`, `data_final`, `id_sislo_tipo_servico`, `quantidade`, `valor`, `data_ultima_alteracao`) VALUES
	(1, '180178580', '12/2021', '2021-12-10 00:00:00', '2021-12-10 00:00:00', 1, 155, 331588.01, '2021-12-12 19:37:35'),
	(2, '180178580', '12/2021', '2021-12-10 00:00:00', '2021-12-10 00:00:00', 2, 199, 558002.15, '2021-12-12 19:37:35'),
	(3, '180178580', '09/2023', '2021-12-10 00:00:00', '2021-12-12 00:00:00', 1, 159, 6549.87, '2021-12-12 19:54:51'),
	(4, '180178580', '12/2021', '2021-12-10 00:00:00', '2021-12-12 00:00:00', 2, 667, 321321.33, '2021-12-12 19:54:51'),
	(5, '180178580', '12/2021', '2021-12-10 00:00:00', '2021-12-12 00:00:00', 3, 1999, 0.00, '2021-12-12 19:54:51'),
	(6, '180178580', '08/2022', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 81, 402.00, '2022-08-10 20:19:24'),
	(7, '180178580', '08/2022', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 32, 150.00, '2022-08-10 20:19:24'),
	(8, '180178580', '08/2022', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 40, 190.00, '2022-08-10 20:19:24'),
	(9, '180178580', '08/2022', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 24, 81.00, '2022-08-10 20:19:24');

-- Copiando estrutura para tabela sislo.sislo_comissao_bolao
CREATE TABLE IF NOT EXISTS `sislo_comissao_bolao` (
  `idsislo_comissao_bolao` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cod_loterico` varchar(11) NOT NULL,
  `dia_inicial` datetime NOT NULL,
  `id_sislo_jogos_cef` int(11) NOT NULL,
  `cotas` int(11) NOT NULL,
  `valor_bolao` decimal(10,2) NOT NULL,
  `tarifa` decimal(10,2) NOT NULL,
  `valor_tarifa` decimal(10,2) NOT NULL,
  `status` int(11) NOT NULL,
  `data_ultima_alteracao` datetime NOT NULL,
  PRIMARY KEY (`idsislo_comissao_bolao`)
) ENGINE=InnoDB AUTO_INCREMENT=504 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela sislo.sislo_comissao_bolao: ~9 rows (aproximadamente)
INSERT INTO `sislo_comissao_bolao` (`idsislo_comissao_bolao`, `cod_loterico`, `dia_inicial`, `id_sislo_jogos_cef`, `cotas`, `valor_bolao`, `tarifa`, `valor_tarifa`, `status`, `data_ultima_alteracao`) VALUES
	(495, '180178580', '2022-07-02 00:00:00', 18, 9, 48.00, 31.40, 15.07, 1, '2022-07-03 19:01:20'),
	(496, '180178580', '2022-07-02 00:00:00', 17, 12, 80.00, 35.00, 28.00, 1, '2022-07-03 19:01:20'),
	(497, '180178580', '2021-09-02 00:00:00', 18, 0, 0.00, 0.00, 0.00, 1, '2022-08-07 20:38:13'),
	(498, '180178580', '2021-09-02 00:00:00', 25, 0, 0.00, 0.00, 0.00, 1, '2022-08-07 20:38:13'),
	(499, '180178580', '2021-09-02 00:00:00', 21, 0, 0.00, 0.00, 0.00, 1, '2022-08-07 20:38:13'),
	(500, '180178580', '2022-08-10 00:00:00', 18, 9, 48.00, 31.40, 15.07, 1, '2022-08-10 19:32:33'),
	(501, '180178580', '2022-08-10 00:00:00', 17, 7, 25.00, 35.00, 8.75, 1, '2022-08-10 19:32:33'),
	(502, '180178580', '2022-08-10 00:00:00', 17, 7, 25.00, 35.00, 8.75, 1, '2022-08-10 19:32:33'),
	(503, '180178580', '2022-08-10 00:00:00', 17, 7, 25.00, 35.00, 8.75, 1, '2022-08-10 19:32:33');

-- Copiando estrutura para tabela sislo.sislo_comissao_ibc
CREATE TABLE IF NOT EXISTS `sislo_comissao_ibc` (
  `idsislo_comissao_ibc` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `cod_loterico` varchar(10) DEFAULT NULL,
  `referencia` varchar(7) DEFAULT NULL,
  `dia_inicial` datetime DEFAULT NULL,
  `dia_final` datetime DEFAULT NULL,
  `id_sislo_jogos_cef` int(11) DEFAULT NULL,
  `concurso` varchar(45) DEFAULT NULL,
  `comissao_total` decimal(10,2) DEFAULT NULL,
  `participacao` decimal(10,8) DEFAULT NULL,
  `comissao` decimal(10,2) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `data_ultima_alteracao` datetime DEFAULT NULL,
  PRIMARY KEY (`idsislo_comissao_ibc`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela sislo.sislo_comissao_ibc: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela sislo.sislo_comissao_jogos
CREATE TABLE IF NOT EXISTS `sislo_comissao_jogos` (
  `idsislo_comissao_jogos` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cod_loterico` varchar(10) DEFAULT NULL,
  `referencia` varchar(7) DEFAULT NULL,
  `dia_inicial` datetime NOT NULL,
  `dia_final` datetime NOT NULL,
  `id_sislo_jogos_cef` int(11) NOT NULL,
  `concurso` varchar(14) NOT NULL,
  `quantidade` varchar(7) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `comissao` decimal(10,2) NOT NULL,
  `percent_comissao` decimal(10,2) NOT NULL,
  `status` int(11) NOT NULL,
  `data_ultima_alteracao` datetime NOT NULL,
  PRIMARY KEY (`idsislo_comissao_jogos`)
) ENGINE=InnoDB AUTO_INCREMENT=415 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela sislo.sislo_comissao_jogos: ~2 rows (aproximadamente)
INSERT INTO `sislo_comissao_jogos` (`idsislo_comissao_jogos`, `cod_loterico`, `referencia`, `dia_inicial`, `dia_final`, `id_sislo_jogos_cef`, `concurso`, `quantidade`, `valor`, `comissao`, `percent_comissao`, `status`, `data_ultima_alteracao`) VALUES
	(413, '180178580', '08/2022', '2022-08-10 00:00:00', '2022-08-10 00:00:00', 18, '5648', '81', 402.00, 34.60, 8.61, 1, '2022-08-10 20:23:40'),
	(414, '180178580', '08/2022', '2022-08-10 00:00:00', '2022-08-10 00:00:00', 17, '502', '32', 150.00, 12.88, 8.59, 1, '2022-08-10 20:23:40');

-- Copiando estrutura para tabela sislo.sislo_comissao_silce
CREATE TABLE IF NOT EXISTS `sislo_comissao_silce` (
  `idsislo_comissao_silce` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `cod_loterico` varchar(10) DEFAULT NULL,
  `referencia` varchar(7) DEFAULT NULL,
  `dia_inicial` datetime DEFAULT NULL,
  `dia_final` datetime DEFAULT NULL,
  `id_sislo_jogos_cef` int(11) DEFAULT NULL,
  `concurso` varchar(45) DEFAULT NULL,
  `comissao_total` decimal(10,2) DEFAULT NULL,
  `participacao` varchar(50) DEFAULT NULL,
  `comissao` decimal(10,2) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `data_ultima_alteracao` datetime DEFAULT NULL,
  PRIMARY KEY (`idsislo_comissao_silce`)
) ENGINE=InnoDB AUTO_INCREMENT=390 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela sislo.sislo_comissao_silce: ~2 rows (aproximadamente)
INSERT INTO `sislo_comissao_silce` (`idsislo_comissao_silce`, `cod_loterico`, `referencia`, `dia_inicial`, `dia_final`, `id_sislo_jogos_cef`, `concurso`, `comissao_total`, `participacao`, `comissao`, `status`, `data_ultima_alteracao`) VALUES
	(388, '180178580', '08/2022', '2022-08-02 00:00:00', '2022-08-02 00:00:00', 18, '5648', 17320.32, '0.00000000', 0.86, 1, '2022-08-11 20:26:50'),
	(389, '180178580', '08/2022', '2022-08-02 00:00:00', '2022-08-02 00:00:00', 21, '2269', 7040.72, '0.00000000', 1.10, 1, '2022-08-11 20:26:50');

-- Copiando estrutura para tabela sislo.sislo_contas_pagar
CREATE TABLE IF NOT EXISTS `sislo_contas_pagar` (
  `idsislo_contas_pagar` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cod_loterico` varchar(10) NOT NULL,
  `id_sislo_fornecedores` int(11) NOT NULL,
  `vencimento` datetime NOT NULL,
  `valor_pagar` decimal(10,2) NOT NULL,
  `descontos` decimal(10,2) NOT NULL,
  `juros` decimal(10,2) NOT NULL,
  `valor_pago` decimal(10,2) NOT NULL,
  `data_pagamento` datetime NOT NULL,
  `status_pagamento` int(11) NOT NULL,
  `tipo_pagamento` int(11) NOT NULL,
  `referencia` varchar(8) NOT NULL DEFAULT '',
  `forma_pagamento` int(11) NOT NULL,
  `data_ultima_alteracao` datetime NOT NULL,
  PRIMARY KEY (`idsislo_contas_pagar`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela sislo.sislo_contas_pagar: ~0 rows (aproximadamente)
INSERT INTO `sislo_contas_pagar` (`idsislo_contas_pagar`, `cod_loterico`, `id_sislo_fornecedores`, `vencimento`, `valor_pagar`, `descontos`, `juros`, `valor_pago`, `data_pagamento`, `status_pagamento`, `tipo_pagamento`, `referencia`, `forma_pagamento`, `data_ultima_alteracao`) VALUES
	(43, '180178580', 12, '2021-10-29 00:00:00', 1552.86, 0.00, 355.10, 1907.96, '2021-10-30 00:00:00', 1, 1, '10/2021', 3, '2021-10-25 21:13:45'),
	(44, '180178580', 12, '2022-02-26 00:00:00', 6546.54, 0.00, 0.00, 6546.54, '2022-02-26 00:00:00', 2, 1, '02/2022', 3, '2022-02-26 18:24:52');

-- Copiando estrutura para tabela sislo.sislo_conta_corrente
CREATE TABLE IF NOT EXISTS `sislo_conta_corrente` (
  `idsislo_conta_corrente` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cod_loterico` varchar(10) NOT NULL,
  `referencia` varchar(8) NOT NULL,
  `data_transacao` datetime NOT NULL,
  `origem` varchar(99) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `entrada_saida` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `data_ultima_alteracao` datetime NOT NULL,
  PRIMARY KEY (`idsislo_conta_corrente`)
) ENGINE=InnoDB AUTO_INCREMENT=251 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela sislo.sislo_conta_corrente: ~0 rows (aproximadamente)
INSERT INTO `sislo_conta_corrente` (`idsislo_conta_corrente`, `cod_loterico`, `referencia`, `data_transacao`, `origem`, `valor`, `entrada_saida`, `status`, `data_ultima_alteracao`) VALUES
	(250, '180178580', '10/2021', '2021-10-25 21:13:45', 'Contas para Pagar', 1907.96, 2, 1, '2021-10-25 21:13:45');

-- Copiando estrutura para tabela sislo.sislo_cor
CREATE TABLE IF NOT EXISTS `sislo_cor` (
  `id_sislo_cor` int(11) NOT NULL AUTO_INCREMENT,
  `cor` varchar(50) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `data_ultima_alteracao` datetime DEFAULT NULL,
  PRIMARY KEY (`id_sislo_cor`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela sislo.sislo_cor: ~6 rows (aproximadamente)
INSERT INTO `sislo_cor` (`id_sislo_cor`, `cor`, `status`, `data_ultima_alteracao`) VALUES
	(1, 'Branca', 1, '2021-10-29 21:03:58'),
	(2, 'Pardo', 1, '2021-10-29 21:04:06'),
	(3, 'Negro', 1, '2021-10-29 21:04:13'),
	(4, 'Mameluco', 1, '2021-10-29 21:04:23'),
	(5, 'Amarelo', 1, '2021-10-29 21:04:57'),
	(6, 'Indígena', 1, '2021-10-29 21:06:38');

-- Copiando estrutura para tabela sislo.sislo_decendio
CREATE TABLE IF NOT EXISTS `sislo_decendio` (
  `idsislo_decendio` int(11) NOT NULL AUTO_INCREMENT,
  `referencia` varchar(8) DEFAULT NULL,
  `cod_loterico` varchar(10) DEFAULT NULL,
  `id_sislo_servicos_decendio` int(11) DEFAULT NULL,
  `quantidade` int(11) DEFAULT NULL,
  `valor_total` decimal(10,2) DEFAULT NULL,
  `valor_unitario` decimal(10,2) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `data_ultima_alteracao` datetime DEFAULT NULL,
  PRIMARY KEY (`idsislo_decendio`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela sislo.sislo_decendio: ~3 rows (aproximadamente)
INSERT INTO `sislo_decendio` (`idsislo_decendio`, `referencia`, `cod_loterico`, `id_sislo_servicos_decendio`, `quantidade`, `valor_total`, `valor_unitario`, `status`, `data_ultima_alteracao`) VALUES
	(1, '10/2022', '180178580', 1, 69, 0.00, 0.00, 1, '2023-02-14 09:11:27'),
	(2, '10/2022', '180178580', 2, 30, 0.00, 0.00, 1, '2023-02-14 09:11:27'),
	(3, '10/2022', '180178580', 3, 20, 14.20, 0.00, 1, '2023-02-14 09:11:27');

-- Copiando estrutura para tabela sislo.sislo_diadesorte
CREATE TABLE IF NOT EXISTS `sislo_diadesorte` (
  `idsislo_diadesorte` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_sislo_jogos_cef` int(11) NOT NULL,
  `concurso` int(11) NOT NULL,
  `data_concurso` datetime NOT NULL,
  `dez_01` int(11) NOT NULL,
  `dez_02` int(11) NOT NULL,
  `dez_03` int(11) NOT NULL,
  `dez_04` int(11) NOT NULL,
  `dez_05` int(11) NOT NULL,
  `dez_06` int(11) NOT NULL,
  `dez_07` int(11) NOT NULL,
  `mes` int(11) NOT NULL,
  `saiu_ganhador` int(11) NOT NULL,
  `premio_atual` decimal(15,2) NOT NULL,
  `premio_acumulado` decimal(15,2) NOT NULL,
  `arrecadacao_total` decimal(15,2) NOT NULL,
  PRIMARY KEY (`idsislo_diadesorte`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela sislo.sislo_diadesorte: ~0 rows (aproximadamente)
INSERT INTO `sislo_diadesorte` (`idsislo_diadesorte`, `id_sislo_jogos_cef`, `concurso`, `data_concurso`, `dez_01`, `dez_02`, `dez_03`, `dez_04`, `dez_05`, `dez_06`, `dez_07`, `mes`, `saiu_ganhador`, `premio_atual`, `premio_acumulado`, `arrecadacao_total`) VALUES
	(1, 28, 695, '2022-12-17 00:00:00', 2, 6, 10, 17, 21, 22, 26, 1, 0, 1000000.00, 1100000.00, 1807240.00);

-- Copiando estrutura para tabela sislo.sislo_duplasena
CREATE TABLE IF NOT EXISTS `sislo_duplasena` (
  `idsislo_duplasena` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_sislo_jogos_cef` int(11) NOT NULL,
  `concurso` int(11) NOT NULL,
  `data_concurso` datetime NOT NULL,
  `dez_01` int(11) NOT NULL,
  `dez_02` int(11) NOT NULL,
  `dez_03` int(11) NOT NULL,
  `dez_04` int(11) NOT NULL,
  `dez_05` int(11) NOT NULL,
  `dez_06` int(11) NOT NULL,
  `dez_07` int(11) NOT NULL,
  `dez_08` int(11) NOT NULL,
  `dez_09` int(11) NOT NULL,
  `dez_10` int(11) NOT NULL,
  `dez_11` int(11) NOT NULL,
  `dez_12` int(11) NOT NULL,
  `saiu_ganhador` int(11) NOT NULL,
  `premio_atual` decimal(15,2) NOT NULL,
  `premio_acumulado` decimal(15,2) NOT NULL,
  `arrecadacao_total` decimal(15,2) NOT NULL,
  PRIMARY KEY (`idsislo_duplasena`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela sislo.sislo_duplasena: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela sislo.sislo_empresa_login
CREATE TABLE IF NOT EXISTS `sislo_empresa_login` (
  `id_sislo_empresa_login` int(11) NOT NULL AUTO_INCREMENT,
  `cod_loterico` varchar(11) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `data_ultima_alteracao` datetime NOT NULL,
  PRIMARY KEY (`id_sislo_empresa_login`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- Copiando dados para a tabela sislo.sislo_empresa_login: ~0 rows (aproximadamente)
INSERT INTO `sislo_empresa_login` (`id_sislo_empresa_login`, `cod_loterico`, `pass`, `status`, `data_ultima_alteracao`) VALUES
	(1, '180178581', 'ec7117851c0e5dbaad4effdb7cd17c050cea88cb', 1, '2023-09-15 09:22:21');

-- Copiando estrutura para tabela sislo.sislo_escolaridade
CREATE TABLE IF NOT EXISTS `sislo_escolaridade` (
  `id_sislo_escolaridade` int(11) NOT NULL AUTO_INCREMENT,
  `escolaridade` varchar(88) DEFAULT NULL,
  `status` int(11) DEFAULT 0,
  `data_ultima_alteracao` datetime DEFAULT NULL,
  PRIMARY KEY (`id_sislo_escolaridade`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela sislo.sislo_escolaridade: ~6 rows (aproximadamente)
INSERT INTO `sislo_escolaridade` (`id_sislo_escolaridade`, `escolaridade`, `status`, `data_ultima_alteracao`) VALUES
	(1, 'Ensino Fundamental Completo', 1, '2021-10-29 18:47:13'),
	(2, 'Ensino Fundamental Incompleto', 1, '2021-10-29 18:49:00'),
	(3, 'Analfabeto', 1, '2021-10-29 18:49:29'),
	(4, 'Ensino Médio Completo', 1, '2021-10-29 18:49:50'),
	(5, 'Ensino Médio Incompleto', 1, '2021-10-29 18:50:03'),
	(6, 'Superior Completo', 1, '2021-10-29 18:50:28'),
	(7, 'Superior Incompleto', 1, '2021-10-29 18:50:41');

-- Copiando estrutura para tabela sislo.sislo_estadocivil
CREATE TABLE IF NOT EXISTS `sislo_estadocivil` (
  `id_sislo_estadocivil` int(11) NOT NULL AUTO_INCREMENT,
  `estadocivil` varchar(50) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `data_ultima_alteracao` datetime DEFAULT NULL,
  PRIMARY KEY (`id_sislo_estadocivil`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela sislo.sislo_estadocivil: ~6 rows (aproximadamente)
INSERT INTO `sislo_estadocivil` (`id_sislo_estadocivil`, `estadocivil`, `status`, `data_ultima_alteracao`) VALUES
	(1, 'Solteiro(a)', 1, '2021-10-29 21:50:46'),
	(2, 'Casado(a)', 1, '2021-10-29 21:50:57'),
	(3, 'Viúvo(a)', 1, '2021-10-29 21:51:09'),
	(4, 'Divorciado(a)', 1, '2021-10-29 21:51:21'),
	(5, 'Desquitado(a)', 1, '2021-10-29 21:51:35'),
	(6, 'União Estável', 1, '2021-10-29 21:51:44');

-- Copiando estrutura para tabela sislo.sislo_estoque
CREATE TABLE IF NOT EXISTS `sislo_estoque` (
  `id_sislo_estoque` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cod_loterico` varchar(10) DEFAULT NULL,
  `id_sislo_item_estoque` int(11) DEFAULT NULL,
  `quantidade` int(11) DEFAULT NULL,
  `data_entrada` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `data_ultima_alteracao` datetime DEFAULT NULL,
  PRIMARY KEY (`id_sislo_estoque`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela sislo.sislo_estoque: ~2 rows (aproximadamente)
INSERT INTO `sislo_estoque` (`id_sislo_estoque`, `cod_loterico`, `id_sislo_item_estoque`, `quantidade`, `data_entrada`, `status`, `data_ultima_alteracao`) VALUES
	(1, '180178580', 1, 50, '2023-07-19 00:00:00', 1, '2023-07-19 20:12:34'),
	(2, '180178580', 2, 8000, '2023-07-19 00:00:00', 1, '2023-07-20 20:37:55'),
	(3, '180178580', 3, 5000, '2023-07-20 00:00:00', 1, '2023-07-20 20:34:14');

-- Copiando estrutura para tabela sislo.sislo_estoque_movimentacao
CREATE TABLE IF NOT EXISTS `sislo_estoque_movimentacao` (
  `id_sislo_estoque_movimentacao` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cod_loterico` varchar(10) DEFAULT NULL,
  `id_sislo_item_estoque` int(11) DEFAULT NULL,
  `quantidade_saida` int(11) DEFAULT NULL,
  `id_sislo_tfl` int(11) DEFAULT NULL,
  `externo` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `data_ultima_alteracao` datetime DEFAULT NULL,
  PRIMARY KEY (`id_sislo_estoque_movimentacao`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela sislo.sislo_estoque_movimentacao: ~2 rows (aproximadamente)
INSERT INTO `sislo_estoque_movimentacao` (`id_sislo_estoque_movimentacao`, `cod_loterico`, `id_sislo_item_estoque`, `quantidade_saida`, `id_sislo_tfl`, `externo`, `status`, `data_ultima_alteracao`) VALUES
	(1, '180178580', 2, 1000, 0, 1, 1, '2023-07-21 12:10:27'),
	(2, '180178580', 1, 1, 1, 0, 1, '2023-07-21 12:19:39'),
	(3, '180178580', 1, 1, 1, 0, 1, '2023-07-21 12:59:40');

-- Copiando estrutura para tabela sislo.sislo_fechamento_caixa
CREATE TABLE IF NOT EXISTS `sislo_fechamento_caixa` (
  `idsislo_fechamento_caixa` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cod_loterico` varchar(10) NOT NULL,
  `referencia` varchar(7) NOT NULL,
  `data_fechamento` datetime NOT NULL,
  `caixa_operador` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `total_credito` decimal(10,2) NOT NULL,
  `total_debito` decimal(10,2) NOT NULL,
  `total_suprimento` decimal(10,2) NOT NULL,
  `total_moedas` decimal(10,2) NOT NULL,
  `total_dinheiro` decimal(10,2) NOT NULL,
  `total_bolao` decimal(10,2) NOT NULL,
  `total_telesena` decimal(10,2) NOT NULL,
  `total_bilhete_federal` decimal(10,2) NOT NULL,
  `total_sangrias` decimal(10,2) NOT NULL,
  `total_sobra_cx` decimal(10,2) NOT NULL,
  `total_brinde` decimal(10,2) NOT NULL,
  `total_outros` decimal(10,2) NOT NULL,
  `total_pix` decimal(10,2) NOT NULL,
  `obs_brinde` varchar(145) NOT NULL,
  `obs_outros` varchar(145) NOT NULL,
  `caixa_inicial` decimal(10,2) NOT NULL,
  `soma_geral` decimal(10,2) NOT NULL,
  `resumo_tfl` decimal(10,2) NOT NULL,
  `diferenca` decimal(10,2) NOT NULL,
  `data_ultima_alteracao` datetime NOT NULL,
  PRIMARY KEY (`idsislo_fechamento_caixa`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela sislo.sislo_fechamento_caixa: ~3 rows (aproximadamente)
INSERT INTO `sislo_fechamento_caixa` (`idsislo_fechamento_caixa`, `cod_loterico`, `referencia`, `data_fechamento`, `caixa_operador`, `id_usuario`, `total_credito`, `total_debito`, `total_suprimento`, `total_moedas`, `total_dinheiro`, `total_bolao`, `total_telesena`, `total_bilhete_federal`, `total_sangrias`, `total_sobra_cx`, `total_brinde`, `total_outros`, `total_pix`, `obs_brinde`, `obs_outros`, `caixa_inicial`, `soma_geral`, `resumo_tfl`, `diferenca`, `data_ultima_alteracao`) VALUES
	(1, '180178580', '07/2021', '2021-07-10 00:00:00', 1, 43, 15167.18, 4461.45, 0.00, 59.85, 0.00, 68.00, 0.00, 0.00, 10690.00, 0.00, 0.00, 0.00, 0.00, 'sem dados', 'sem dados', 112.40, 10705.45, 10705.73, -0.28, '2022-01-05 18:57:37'),
	(2, '180178580', '04/2023', '2023-04-09 00:00:00', 1, 43, 11000.00, 10000.00, 0.00, 100.00, 0.00, 400.00, 0.00, 0.00, 0.00, 500.00, 0.00, 0.00, 0.00, 'sem dados', 'sem dados', 0.00, 1000.00, 1000.00, 0.00, '2023-04-10 11:59:17'),
	(3, '180178580', '04/2023', '2023-04-10 00:00:00', 1, 43, 6000.00, 5000.00, 0.00, 50.00, 0.00, 0.00, 0.00, 0.00, 1450.00, 500.00, 0.00, 0.00, 0.00, 'sem dados', 'sem dados', 1000.00, 1000.00, 1000.00, 0.00, '2023-04-11 13:23:32');

-- Copiando estrutura para tabela sislo.sislo_fechamento_cofre
CREATE TABLE IF NOT EXISTS `sislo_fechamento_cofre` (
  `idsislo_fechamento_cofre` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `data_fechamento` datetime NOT NULL,
  `cod_loterico` varchar(10) NOT NULL DEFAULT '',
  `senha_protege` varchar(9) NOT NULL,
  `os_gtv` varchar(12) NOT NULL,
  `guia_gtv` varchar(12) NOT NULL,
  `remessa` decimal(10,2) NOT NULL,
  `sobra_cx` decimal(10,2) NOT NULL,
  `acumulado_comissao` decimal(10,2) NOT NULL,
  `comissao` decimal(10,2) NOT NULL,
  `pix` decimal(10,2) NOT NULL,
  `pag_lot_fed` decimal(10,2) NOT NULL,
  `pag_telesena` decimal(10,2) NOT NULL,
  `pag_outros` decimal(10,2) NOT NULL,
  `obs_outros` varchar(199) NOT NULL,
  `status` int(11) NOT NULL,
  `data_ultima_alteracao` datetime NOT NULL,
  PRIMARY KEY (`idsislo_fechamento_cofre`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela sislo.sislo_fechamento_cofre: ~31 rows (aproximadamente)
INSERT INTO `sislo_fechamento_cofre` (`idsislo_fechamento_cofre`, `data_fechamento`, `cod_loterico`, `senha_protege`, `os_gtv`, `guia_gtv`, `remessa`, `sobra_cx`, `acumulado_comissao`, `comissao`, `pix`, `pag_lot_fed`, `pag_telesena`, `pag_outros`, `obs_outros`, `status`, `data_ultima_alteracao`) VALUES
	(1, '2022-09-25 00:00:00', '180178580', '11008', '321321', '321321', 0.00, 0.00, 5.22, 5.00, 0.00, 0.00, 0.00, 0.00, '', 1, '2022-09-25 20:20:13'),
	(2, '2023-04-10 00:00:00', '180178580', '11133', '32156', '5555528', 40369.00, 500.00, 25.00, 25.00, 0.00, 0.00, 0.00, 0.00, '', 1, '2023-04-10 12:00:11'),
	(3, '2023-04-10 00:00:00', '180178580', '11133', '32156', '5555528', 40369.00, 500.00, 25.00, 25.00, 0.00, 0.00, 0.00, 0.00, '', 1, '2023-04-10 12:16:15'),
	(4, '2023-04-10 00:00:00', '180178580', '11133', '32156', '5555528', 40369.00, 500.00, 25.00, 25.00, 0.00, 0.00, 0.00, 0.00, '', 1, '2023-04-10 12:16:50'),
	(5, '2023-04-10 00:00:00', '180178580', '11133', '32156', '5555528', 40369.00, 500.00, 25.00, 25.00, 0.00, 1.00, 1.00, 3.00, 'dada', 1, '2023-04-10 12:20:35'),
	(6, '2023-04-10 00:00:00', '180178580', '11133', '32156', '5555528', 40369.00, 500.00, 25.00, 25.00, 0.00, 1.00, 5.00, 6.00, 'dadad', 1, '2023-04-10 12:23:16'),
	(7, '2023-04-10 00:00:00', '180178580', '11133', '32156', '5555528', 40369.00, 500.00, 25.00, 25.00, 0.00, 1.00, 3.00, 1.00, 'dada', 1, '2023-04-10 12:24:35'),
	(8, '2023-04-10 00:00:00', '180178580', '11133', '32156', '5555528', 40369.00, 500.00, 25.00, 25.00, 0.00, 2.00, 1.00, 2.00, 'dada', 1, '2023-04-10 12:32:18'),
	(9, '2023-04-10 00:00:00', '180178580', '11133', '32156', '5555528', 40369.00, 500.00, 25.00, 25.00, 0.00, 2.00, 3.00, 5.00, 'dada', 1, '2023-04-10 12:33:53'),
	(10, '2023-04-10 00:00:00', '180178580', '11133', '32156', '5555528', 40369.00, 500.00, 25.00, 25.00, 0.00, 3.00, 2.00, 3.00, 'dada', 1, '2023-04-10 12:35:16'),
	(11, '2023-04-10 00:00:00', '180178580', '11133', '32156', '5555528', 40369.00, 500.00, 25.00, 25.00, 0.00, 6.00, 6.00, 8.00, 'dada', 1, '2023-04-10 12:36:49'),
	(12, '2023-04-10 00:00:00', '180178580', '11133', '32156', '5555528', 40369.00, 500.00, 25.00, 25.00, 0.00, 8.00, 8.00, 4.00, 'dada', 1, '2023-04-10 12:39:25'),
	(13, '2023-04-10 00:00:00', '180178580', '11133', '32156', '5555528', 40369.00, 500.00, 25.00, 25.00, 0.00, 25.00, 25.00, 25.00, 'dada', 1, '2023-04-10 12:40:21'),
	(14, '2023-04-10 00:00:00', '180178580', '11133', '32156', '5555528', 40369.00, 500.00, 25.00, 25.00, 0.00, 12.00, 12.00, 12.12, 'dada', 1, '2023-04-10 12:42:02'),
	(15, '2023-04-10 00:00:00', '180178580', '11133', '32156', '5555528', 40369.00, 500.00, 25.00, 25.00, 0.00, 4.00, 4.00, 45.45, 'dada', 1, '2023-04-10 12:43:28'),
	(16, '2023-04-10 00:00:00', '180178580', '11133', '32156', '5555528', 40369.00, 500.00, 25.00, 25.00, 0.00, 12.12, 12.12, 12.12, 'dada', 1, '2023-04-10 12:45:10'),
	(17, '2023-04-10 00:00:00', '180178580', '11133', '32156', '5555528', 40369.00, 500.00, 25.00, 25.00, 0.00, 12.12, 12.12, 12.12, 'dada', 1, '2023-04-10 12:48:13'),
	(18, '2023-04-10 00:00:00', '180178580', '11133', '32156', '5555528', 40369.00, 500.00, 25.00, 25.00, 0.00, 12.12, 12.12, 12.12, 'dada', 1, '2023-04-10 12:49:37'),
	(19, '2023-04-10 00:00:00', '180178580', '11133', '32156', '5555528', 40369.00, 500.00, 25.00, 25.00, 0.00, 0.00, 12.12, 12.12, 'dada', 1, '2023-04-10 12:50:49'),
	(20, '2023-04-10 00:00:00', '180178580', '11133', '32156', '5555528', 40369.00, 500.00, 25.00, 25.00, 0.00, 12.12, 12.12, 12.12, 'dada', 1, '2023-04-10 12:57:06'),
	(21, '2023-04-10 00:00:00', '180178580', '11133', '32156', '5555528', 40369.00, 500.00, 25.00, 25.00, 0.00, 12.12, 12.12, 12.12, 'dada', 1, '2023-04-10 12:59:31'),
	(22, '2023-04-10 00:00:00', '180178580', '11133', '32156', '5555528', 40369.00, 500.00, 25.00, 25.00, 0.00, 12.12, 12.12, 12.12, 'dada', 1, '2023-04-10 13:00:10'),
	(23, '2023-04-10 00:00:00', '180178580', '11133', '32156', '5555528', 40369.00, 500.00, 25.00, 25.00, 0.00, 12.12, 12.12, 12.12, 'dada', 1, '2023-04-10 13:06:56'),
	(24, '2023-04-10 00:00:00', '180178580', '11133', '32156', '5555528', 40369.00, 500.00, 25.00, 25.00, 0.00, 12.12, 12.12, 12.12, 'dada', 1, '2023-04-10 13:09:10'),
	(25, '2023-04-10 00:00:00', '180178580', '11133', '32156', '5555528', 40369.00, 500.00, 25.00, 25.00, 0.00, 12.12, 12.12, 12.12, 'dada', 1, '2023-04-10 13:10:52'),
	(26, '2023-04-10 00:00:00', '180178580', '11133', '32156', '5555528', 40369.00, 500.00, 25.00, 25.00, 0.00, 12.12, 12.12, 12.12, 'dada', 1, '2023-04-10 13:14:36'),
	(27, '2023-04-10 00:00:00', '180178580', '11133', '32156', '5555528', 40369.00, 500.00, 25.00, 25.00, 0.00, 12.12, 12.12, 12.12, 'dada', 1, '2023-04-10 13:16:47'),
	(28, '2023-04-10 00:00:00', '180178580', '11133', '32156', '5555528', 40369.00, 500.00, 25.00, 25.00, 0.00, 12.12, 12.12, 12.12, 'dada', 1, '2023-04-10 13:17:43'),
	(29, '2023-04-10 00:00:00', '180178580', '11133', '32156', '5555528', 40369.00, 500.00, 25.00, 25.00, 0.00, 12.12, 12.12, 12.12, 'dada', 1, '2023-04-10 13:18:45'),
	(30, '2023-04-10 00:00:00', '180178580', '11133', '32156', '5555528', 40369.00, 500.00, 300.00, 295.00, 0.00, 12.12, 12.18, 55.28, 'dada', 1, '2023-04-10 13:43:21'),
	(31, '2023-04-11 00:00:00', '180178580', '11337', '32156', '5555528', 66057.00, 500.00, 25.00, 25.00, 0.00, 1800.00, 0.00, 0.00, '', 1, '2023-04-11 13:25:59');

-- Copiando estrutura para tabela sislo.sislo_fornecedores
CREATE TABLE IF NOT EXISTS `sislo_fornecedores` (
  `idsislo_fornecedores` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cod_loterico` varchar(10) NOT NULL,
  `nome` varchar(145) NOT NULL,
  `cnpj` varchar(16) NOT NULL,
  `contato` varchar(99) NOT NULL,
  `tel` varchar(45) NOT NULL,
  `whats` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `status` int(11) NOT NULL,
  `data_ultima_alteracao` varchar(45) NOT NULL,
  PRIMARY KEY (`idsislo_fornecedores`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela sislo.sislo_fornecedores: ~0 rows (aproximadamente)
INSERT INTO `sislo_fornecedores` (`idsislo_fornecedores`, `cod_loterico`, `nome`, `cnpj`, `contato`, `tel`, `whats`, `email`, `status`, `data_ultima_alteracao`) VALUES
	(12, '180178580', 'Protege', '89.579.361.0001/', 'wawa', '51-34770-047', '51-99162-5868', 'vitordorneles@hotmail.com', 1, '2021-10-22 21:02:35');

-- Copiando estrutura para tabela sislo.sislo_funcionarios
CREATE TABLE IF NOT EXISTS `sislo_funcionarios` (
  `idsislo_funcionarios` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cod_loterico` varchar(10) DEFAULT NULL,
  `genero` int(11) DEFAULT NULL,
  `nome` text DEFAULT NULL,
  `nascimento` datetime DEFAULT NULL,
  `local_nascimento` varchar(99) DEFAULT NULL,
  `id_escolaridade` int(11) DEFAULT NULL,
  `id_estado_civil` int(11) DEFAULT NULL,
  `id_cor` int(11) DEFAULT NULL,
  `nome_mae` text DEFAULT NULL,
  `nome_pai` text DEFAULT NULL,
  `endereco` varchar(255) DEFAULT NULL,
  `numero` varchar(50) DEFAULT NULL,
  `complemento` varchar(50) DEFAULT NULL,
  `cep` varchar(9) DEFAULT NULL,
  `bairro` varchar(150) DEFAULT NULL,
  `cidade` varchar(255) DEFAULT NULL,
  `uf` varchar(9) DEFAULT NULL,
  `tel1` varchar(50) DEFAULT NULL,
  `tel2` varchar(50) DEFAULT NULL,
  `tel3` varchar(50) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `identidade` varchar(50) DEFAULT NULL,
  `orgao_emissor` varchar(50) DEFAULT NULL,
  `identidade_emissao` datetime DEFAULT NULL,
  `pis` varchar(50) DEFAULT NULL,
  `ctps` varchar(50) DEFAULT NULL,
  `serie` varchar(50) DEFAULT NULL,
  `ctps_emissao` datetime DEFAULT NULL,
  `cpf` varchar(11) DEFAULT NULL,
  `titulo_eleitor` varchar(50) DEFAULT NULL,
  `zona` varchar(50) DEFAULT NULL,
  `secao` varchar(50) DEFAULT NULL,
  `cnh` varchar(50) DEFAULT NULL,
  `cnh_emissao` datetime DEFAULT NULL,
  `nome_conjuge` varchar(255) DEFAULT NULL,
  `nascimento_conjuge` datetime DEFAULT NULL,
  `cpf_conjuge` varchar(11) DEFAULT NULL,
  `nome_filho1` varchar(255) DEFAULT NULL,
  `cpf_filho1` varchar(11) DEFAULT NULL,
  `nascimento_filho1` datetime DEFAULT NULL,
  `nome_filho2` varchar(255) DEFAULT NULL,
  `cpf_filho2` varchar(11) DEFAULT NULL,
  `nascimento_filho2` datetime DEFAULT NULL,
  `nome_filho3` varchar(255) DEFAULT NULL,
  `cpf_filho3` varchar(11) DEFAULT NULL,
  `nascimento_filho3` datetime DEFAULT NULL,
  `nome_filho4` varchar(255) DEFAULT NULL,
  `cpf_filho4` varchar(11) DEFAULT NULL,
  `nascimento_filho4` datetime DEFAULT NULL,
  `optante_VT` int(11) DEFAULT NULL,
  `linha1` varchar(55) DEFAULT NULL,
  `valor_linha1` decimal(10,2) DEFAULT NULL,
  `linha2` varchar(55) DEFAULT NULL,
  `valor_linha2` decimal(10,2) DEFAULT NULL,
  `linha3` varchar(55) DEFAULT NULL,
  `valor_linha3` decimal(10,2) DEFAULT NULL,
  `reemprego` int(11) DEFAULT NULL,
  `id_cargo` int(11) DEFAULT NULL,
  `admissao` datetime DEFAULT NULL,
  `data_demissao` datetime DEFAULT NULL,
  `id_motivo_demissao` int(11) DEFAULT NULL,
  `salario` decimal(10,2) DEFAULT NULL,
  `adicional` int(11) DEFAULT NULL,
  `insalubridade` int(11) DEFAULT NULL,
  `insalubridade_percent` decimal(10,2) DEFAULT NULL,
  `entrada` varchar(5) DEFAULT NULL,
  `almoco` varchar(5) DEFAULT NULL,
  `volta_almoco` varchar(5) DEFAULT NULL,
  `saida` varchar(5) DEFAULT NULL,
  `id_contrato_experiencia` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `data_ultima_alteracao` datetime DEFAULT NULL,
  PRIMARY KEY (`idsislo_funcionarios`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela sislo.sislo_funcionarios: ~0 rows (aproximadamente)
INSERT INTO `sislo_funcionarios` (`idsislo_funcionarios`, `cod_loterico`, `genero`, `nome`, `nascimento`, `local_nascimento`, `id_escolaridade`, `id_estado_civil`, `id_cor`, `nome_mae`, `nome_pai`, `endereco`, `numero`, `complemento`, `cep`, `bairro`, `cidade`, `uf`, `tel1`, `tel2`, `tel3`, `email`, `identidade`, `orgao_emissor`, `identidade_emissao`, `pis`, `ctps`, `serie`, `ctps_emissao`, `cpf`, `titulo_eleitor`, `zona`, `secao`, `cnh`, `cnh_emissao`, `nome_conjuge`, `nascimento_conjuge`, `cpf_conjuge`, `nome_filho1`, `cpf_filho1`, `nascimento_filho1`, `nome_filho2`, `cpf_filho2`, `nascimento_filho2`, `nome_filho3`, `cpf_filho3`, `nascimento_filho3`, `nome_filho4`, `cpf_filho4`, `nascimento_filho4`, `optante_VT`, `linha1`, `valor_linha1`, `linha2`, `valor_linha2`, `linha3`, `valor_linha3`, `reemprego`, `id_cargo`, `admissao`, `data_demissao`, `id_motivo_demissao`, `salario`, `adicional`, `insalubridade`, `insalubridade_percent`, `entrada`, `almoco`, `volta_almoco`, `saida`, `id_contrato_experiencia`, `status`, `data_ultima_alteracao`) VALUES
	(43, '180178580', 1, 'Viviane Hatzemberger silva', '1985-03-01 00:00:00', 'Porto Alegre', 4, 1, 5, 'mae dela', 'pai dela', 'Rua Recanto dos Pássaros', '92', NULL, '91778130', 'Ponta Grossa', 'Porto Alegre', 'RS', '51 9915-0630', '51 9 9150-6302', '51 9 9150-6302', 'vhatz@gmail.com', '7066215851', 'sjs/rs', '2002-02-26 00:00:00', '12832629670', '3106237', '0010', '2002-02-26 00:00:00', '00517325055', '00000', '000', '0000', '03321691496', '2016-12-15 00:00:00', '', '2021-11-19 00:00:00', '', 'GUSTAVO HATZEMBERGER FERREIRA KONCIkOVSKI', '05964455042', '2014-04-12 00:00:00', '', '', '2021-11-19 00:00:00', '', '', '2021-11-19 00:00:00', '', '', '2021-11-19 00:00:00', 1, 'Belém Novo 268', 4.00, 'Belém Novo 268', 4.50, '', 0.00, 1, 1, '2017-08-28 00:00:00', '2021-11-19 00:00:00', 0, 1200.00, 1, 0, 0.00, '09:00', '11:30', '12:30', '18:00', 1, 1, '2022-09-27 19:26:20');

-- Copiando estrutura para tabela sislo.sislo_funcionarios_salario
CREATE TABLE IF NOT EXISTS `sislo_funcionarios_salario` (
  `id_sislo_funcionarios_salario` int(11) NOT NULL AUTO_INCREMENT,
  `cpf_sislo_funcionario` int(11) DEFAULT 0,
  `salario` decimal(10,2) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `data_ultima_alteracao` datetime DEFAULT NULL,
  PRIMARY KEY (`id_sislo_funcionarios_salario`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela sislo.sislo_funcionarios_salario: ~3 rows (aproximadamente)
INSERT INTO `sislo_funcionarios_salario` (`id_sislo_funcionarios_salario`, `cpf_sislo_funcionario`, `salario`, `status`, `data_ultima_alteracao`) VALUES
	(1, 517325055, 1200.00, 1, '2021-11-19 20:19:45'),
	(2, 517325055, 1200.00, 1, '2022-09-27 18:39:38'),
	(3, 517325055, 1200.00, 1, '2022-09-27 19:26:20');

-- Copiando estrutura para tabela sislo.sislo_horas
CREATE TABLE IF NOT EXISTS `sislo_horas` (
  `idsislo_horas` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cod_loterico` varchar(10) NOT NULL DEFAULT '0',
  `id_sislo_funcionarios` int(11) NOT NULL DEFAULT 0,
  `data_ponto` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `entrada` time NOT NULL DEFAULT '00:00:00',
  `ida_almoco` time NOT NULL DEFAULT '00:00:00',
  `volta_almoco` time NOT NULL DEFAULT '00:00:00',
  `saida` time NOT NULL DEFAULT '00:00:00',
  `saldo` time NOT NULL DEFAULT '00:00:00',
  `status` int(11) NOT NULL DEFAULT 0,
  `id_usuario_bater_ponto` int(11) NOT NULL DEFAULT 0,
  `data_ultima_alteracao` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`idsislo_horas`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela sislo.sislo_horas: ~2 rows (aproximadamente)
INSERT INTO `sislo_horas` (`idsislo_horas`, `cod_loterico`, `id_sislo_funcionarios`, `data_ponto`, `entrada`, `ida_almoco`, `volta_almoco`, `saida`, `saldo`, `status`, `id_usuario_bater_ponto`, `data_ultima_alteracao`) VALUES
	(2, '180178580', 43, '2022-02-01 00:00:00', '18:02:00', '18:31:00', '18:56:00', '18:58:00', '16:03:00', 1, 3, '2022-03-02 18:58:59'),
	(3, '180178580', 43, '2022-03-02 00:00:00', '18:28:00', '18:31:00', '18:56:00', '18:58:00', '16:03:00', 1, 3, '2022-03-02 18:58:59'),
	(4, '180178580', 43, '2022-03-04 00:00:00', '19:42:00', '19:44:00', '19:47:00', '00:00:00', '00:00:00', 1, 3, '2022-03-04 19:47:02'),
	(5, '180178580', 3, '2022-03-22 00:00:00', '19:28:00', '21:47:00', '00:00:00', '00:00:00', '00:00:00', 1, 3, '2022-03-22 19:47:47');

-- Copiando estrutura para tabela sislo.sislo_item_estoque
CREATE TABLE IF NOT EXISTS `sislo_item_estoque` (
  `id_sislo_item_estoque` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cod_loterico` varchar(10) DEFAULT NULL,
  `item` varchar(99) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `data_ultima_alteracao` datetime DEFAULT NULL,
  PRIMARY KEY (`id_sislo_item_estoque`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela sislo.sislo_item_estoque: ~2 rows (aproximadamente)
INSERT INTO `sislo_item_estoque` (`id_sislo_item_estoque`, `cod_loterico`, `item`, `status`, `data_ultima_alteracao`) VALUES
	(1, '180178580', 'Bobina Térmica', 1, '2023-07-12 13:59:40'),
	(2, '180178580', 'Volante Mega-sena', 1, '2023-07-12 14:00:13'),
	(3, '180178580', 'Volante Milionária', 1, '2023-07-20 20:33:20');

-- Copiando estrutura para tabela sislo.sislo_jogos_cef
CREATE TABLE IF NOT EXISTS `sislo_jogos_cef` (
  `idsislo_jogos_cef` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `seg` int(11) NOT NULL,
  `ter` int(11) NOT NULL,
  `qua` int(11) NOT NULL,
  `qui` int(11) NOT NULL,
  `sex` int(11) NOT NULL,
  `sab` int(11) NOT NULL,
  `dom` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `data_ultima_alteracao` datetime NOT NULL,
  PRIMARY KEY (`idsislo_jogos_cef`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela sislo.sislo_jogos_cef: ~11 rows (aproximadamente)
INSERT INTO `sislo_jogos_cef` (`idsislo_jogos_cef`, `nome`, `seg`, `ter`, `qua`, `qui`, `sex`, `sab`, `dom`, `status`, `data_ultima_alteracao`) VALUES
	(16, 'MEGA-SENA', 0, 0, 1, 0, 0, 1, 0, 1, '2021-12-19 18:48:30'),
	(17, ' LOTOFÁCIL', 1, 1, 1, 1, 1, 1, 0, 1, '2021-12-19 18:53:09'),
	(18, ' QUINA', 1, 1, 1, 1, 1, 1, 0, 1, '2021-12-19 18:53:30'),
	(19, ' LOTOMANIA', 1, 0, 1, 0, 1, 0, 0, 1, '2021-12-19 18:53:58'),
	(20, ' TIMEMANIA', 0, 1, 0, 1, 0, 1, 0, 1, '2021-12-19 18:54:15'),
	(21, 'Dupla Sena', 0, 1, 0, 1, 0, 1, 0, 1, '2021-12-19 18:54:37'),
	(22, 'LOTERIA  FEDERAL', 0, 0, 1, 0, 0, 1, 0, 1, '2021-12-19 18:54:56'),
	(23, ' LOTECA', 1, 0, 0, 0, 0, 0, 0, 1, '2021-12-19 18:55:07'),
	(24, ' LOTOGOL', 1, 0, 0, 0, 0, 0, 0, 0, '2021-12-19 18:55:22'),
	(25, 'Dia de Sorte', 0, 1, 0, 1, 0, 1, 0, 1, '2021-12-19 18:55:40'),
	(26, 'Super Sete', 1, 0, 1, 0, 1, 0, 0, 1, '2021-12-19 18:56:05'),
	(27, 'TELE-SENA', 0, 0, 0, 0, 0, 0, 1, 1, '2021-12-19 19:33:05');

-- Copiando estrutura para tabela sislo.sislo_loteria_federal
CREATE TABLE IF NOT EXISTS `sislo_loteria_federal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cod_lot` varchar(10) DEFAULT NULL,
  `modalidade` int(11) DEFAULT NULL,
  `total_bilhetes_recibo` int(11) DEFAULT NULL,
  `total_bilhetes_liquido` int(11) DEFAULT NULL,
  `extracao` varchar(8) DEFAULT NULL,
  `data_extracao` datetime DEFAULT NULL,
  `preco_plano` decimal(10,2) DEFAULT NULL,
  `valor_bruto_recibo` decimal(10,2) DEFAULT NULL,
  `valor_bruto_liquido` decimal(10,2) DEFAULT NULL,
  `comissao_recibo` decimal(10,2) DEFAULT NULL,
  `valor_liquido_recibo` decimal(10,2) DEFAULT NULL,
  `valor_liquido_real` decimal(10,2) DEFAULT NULL,
  `lote` varchar(12) DEFAULT NULL,
  `caixa` varchar(12) DEFAULT NULL,
  `quantidade_encalhe` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `data_ultima_alteracao` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela sislo.sislo_loteria_federal: ~0 rows (aproximadamente)
INSERT INTO `sislo_loteria_federal` (`id`, `cod_lot`, `modalidade`, `total_bilhetes_recibo`, `total_bilhetes_liquido`, `extracao`, `data_extracao`, `preco_plano`, `valor_bruto_recibo`, `valor_bruto_liquido`, `comissao_recibo`, `valor_liquido_recibo`, `valor_liquido_real`, `lote`, `caixa`, `quantidade_encalhe`, `status`, `data_ultima_alteracao`) VALUES
	(1, '180178580', 1, 8, 80, '5.465-8', '2023-05-13 00:00:00', 20.40, 683.43, NULL, 0.00, 615.28, 99999999.99, '112105', '12470', 0, 1, '2023-04-19 14:06:11'),
	(2, NULL, 1, 9, 90, '5.787-8', '2023-08-02 00:00:00', 32.10, 288.90, NULL, 0.00, 276.39, 99999999.99, '111612', '12414', 0, 1, '2023-07-25 14:27:46');

-- Copiando estrutura para tabela sislo.sislo_loterica
CREATE TABLE IF NOT EXISTS `sislo_loterica` (
  `idsislo_loterica` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cod_loterico` varchar(10) NOT NULL,
  `nome_fantasia` varchar(145) NOT NULL,
  `razao_social` varchar(145) NOT NULL,
  `cnpj` varchar(15) NOT NULL,
  `logradouro` varchar(145) NOT NULL,
  `numero` varchar(15) NOT NULL,
  `complemento` varchar(145) NOT NULL,
  `cep` varchar(8) NOT NULL,
  `bairro` varchar(145) NOT NULL,
  `cidade` varchar(145) NOT NULL,
  `uf` varchar(2) NOT NULL,
  `tel1` varchar(13) NOT NULL,
  `tel2` varchar(13) NOT NULL,
  `tel3` varchar(13) NOT NULL,
  `whatsapp` varchar(13) NOT NULL,
  `email` varchar(255) NOT NULL DEFAULT '',
  `agencia_cc` varchar(4) NOT NULL,
  `conta_corrente` varchar(45) NOT NULL,
  `cc_prestacao` varchar(45) NOT NULL,
  `tel_agencia` varchar(13) NOT NULL,
  `proprietario_user` varchar(95) NOT NULL,
  `proprietario_pass` varchar(45) NOT NULL,
  `expresso_login` varchar(75) NOT NULL,
  `expresso_pass` varchar(45) NOT NULL,
  `caixaaqui_cod` varchar(45) NOT NULL,
  `caixaaqui_codlot` varchar(45) NOT NULL,
  `caixaaqui_pass` varchar(45) NOT NULL,
  `sislo_status` int(10) NOT NULL,
  `plano` int(10) NOT NULL DEFAULT 1,
  `data_ultima_alteracao` datetime NOT NULL,
  PRIMARY KEY (`idsislo_loterica`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela sislo.sislo_loterica: ~1 rows (aproximadamente)
INSERT INTO `sislo_loterica` (`idsislo_loterica`, `cod_loterico`, `nome_fantasia`, `razao_social`, `cnpj`, `logradouro`, `numero`, `complemento`, `cep`, `bairro`, `cidade`, `uf`, `tel1`, `tel2`, `tel3`, `whatsapp`, `email`, `agencia_cc`, `conta_corrente`, `cc_prestacao`, `tel_agencia`, `proprietario_user`, `proprietario_pass`, `expresso_login`, `expresso_pass`, `caixaaqui_cod`, `caixaaqui_codlot`, `caixaaqui_pass`, `sislo_status`, `plano`, `data_ultima_alteracao`) VALUES
	(2, '180178580', 'Lotérica Mel', 'JMMD Loterias', '06144980000148', 'Rua Professor Clemente Pinto', '382', 'casa', '90870220', 'Medianeira', 'Porto Alegre', 'RS', '51991625868', '51991625868', '51991625868', '51991625868', 'vitordorneles@hotmail.com', '3481', '6103', '403', '5134770047', '', '', '', '', '', '', '', 1, 3, '2023-04-17 13:28:04'),
	(5, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 1, '2023-09-19 14:29:12');

-- Copiando estrutura para tabela sislo.sislo_loterica_empresa
CREATE TABLE IF NOT EXISTS `sislo_loterica_empresa` (
  `idsislo_loterica_empresa` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cod_loterico` varchar(10) NOT NULL,
  `nome_fantasia` varchar(145) NOT NULL,
  `razao_social` varchar(145) NOT NULL,
  `cnpj` varchar(15) NOT NULL,
  `cep` varchar(8) NOT NULL,
  `logradouro` varchar(145) NOT NULL,
  `numero` varchar(145) NOT NULL,
  `complemento` varchar(145) NOT NULL,
  `bairro` varchar(145) NOT NULL,
  `cidade` varchar(145) NOT NULL,
  `uf` varchar(2) NOT NULL,
  `tel1` varchar(13) NOT NULL,
  `tel2` varchar(13) NOT NULL,
  `tel3` varchar(13) NOT NULL,
  `whatsapp` varchar(13) NOT NULL,
  `email` varchar(255) NOT NULL DEFAULT '',
  `sislo_status` int(10) NOT NULL,
  `data_ultima_alteracao` datetime NOT NULL,
  PRIMARY KEY (`idsislo_loterica_empresa`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Copiando dados para a tabela sislo.sislo_loterica_empresa: ~0 rows (aproximadamente)
INSERT INTO `sislo_loterica_empresa` (`idsislo_loterica_empresa`, `cod_loterico`, `nome_fantasia`, `razao_social`, `cnpj`, `cep`, `logradouro`, `numero`, `complemento`, `bairro`, `cidade`, `uf`, `tel1`, `tel2`, `tel3`, `whatsapp`, `email`, `sislo_status`, `data_ultima_alteracao`) VALUES
	(5, '180178581', 'loterica do azarinho', 'nicolas ltda', '89579361000148', '92030490', 'Rua Ernesto da Silva Rocha', '394', 'casa', 'Estância Velha', 'Canoas', 'RS', '5134770047', '51999010819', '5198148058', '51994336363', 'vitordorneles@hotmail.com', 1, '2023-09-15 09:22:21');

-- Copiando estrutura para tabela sislo.sislo_lotofacil
CREATE TABLE IF NOT EXISTS `sislo_lotofacil` (
  `idsislo_lotofacil` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_sislo_jogos_cef` int(11) NOT NULL,
  `concurso` int(11) NOT NULL,
  `data_concurso` datetime NOT NULL,
  `dez_01` int(11) NOT NULL,
  `dez_02` int(11) NOT NULL,
  `dez_03` int(11) NOT NULL,
  `dez_04` int(11) NOT NULL,
  `dez_05` int(11) NOT NULL,
  `dez_06` int(11) NOT NULL,
  `dez_07` int(11) NOT NULL,
  `dez_08` int(11) NOT NULL,
  `dez_09` int(11) NOT NULL,
  `dez_10` int(11) NOT NULL,
  `dez_11` int(11) NOT NULL,
  `dez_12` int(11) NOT NULL,
  `dez_13` int(11) NOT NULL,
  `dez_14` int(11) NOT NULL,
  `dez_15` int(11) NOT NULL,
  `saiu_ganhador` int(11) NOT NULL,
  `premio_atual` decimal(15,2) NOT NULL,
  `premio_acumulado` decimal(15,2) NOT NULL,
  `arrecadacao_total` decimal(15,2) NOT NULL,
  PRIMARY KEY (`idsislo_lotofacil`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela sislo.sislo_lotofacil: ~0 rows (aproximadamente)
INSERT INTO `sislo_lotofacil` (`idsislo_lotofacil`, `id_sislo_jogos_cef`, `concurso`, `data_concurso`, `dez_01`, `dez_02`, `dez_03`, `dez_04`, `dez_05`, `dez_06`, `dez_07`, `dez_08`, `dez_09`, `dez_10`, `dez_11`, `dez_12`, `dez_13`, `dez_14`, `dez_15`, `saiu_ganhador`, `premio_atual`, `premio_acumulado`, `arrecadacao_total`) VALUES
	(1, 28, 2691, '2022-12-17 00:00:00', 1, 2, 6, 9, 10, 11, 12, 13, 15, 17, 18, 19, 21, 24, 25, 1, 1500000.00, 1500000.00, 16761767.50);

-- Copiando estrutura para tabela sislo.sislo_lotomania
CREATE TABLE IF NOT EXISTS `sislo_lotomania` (
  `idsislo_lotomania` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_sislo_jogos_cef` int(11) NOT NULL,
  `concurso` int(11) NOT NULL,
  `data_concurso` datetime NOT NULL,
  `dez_01` int(11) NOT NULL,
  `dez_02` int(11) NOT NULL,
  `dez_03` int(11) NOT NULL,
  `dez_04` int(11) NOT NULL,
  `dez_05` int(11) NOT NULL,
  `dez_06` int(11) NOT NULL,
  `dez_07` int(11) NOT NULL,
  `dez_08` int(11) NOT NULL,
  `dez_09` int(11) NOT NULL,
  `dez_10` int(11) NOT NULL,
  `dez_11` int(11) NOT NULL,
  `dez_12` int(11) NOT NULL,
  `dez_13` int(11) NOT NULL,
  `dez_14` int(11) NOT NULL,
  `dez_15` int(11) NOT NULL,
  `dez_16` int(11) NOT NULL,
  `dez_17` int(11) NOT NULL,
  `dez_18` int(11) NOT NULL,
  `dez_19` int(11) NOT NULL,
  `dez_20` int(11) NOT NULL,
  `saiu_ganhador` int(11) NOT NULL,
  `premio_atual` decimal(15,2) NOT NULL,
  `premio_acumulado` decimal(15,2) NOT NULL,
  `arrecadacao_total` decimal(15,2) NOT NULL,
  PRIMARY KEY (`idsislo_lotomania`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela sislo.sislo_lotomania: ~0 rows (aproximadamente)
INSERT INTO `sislo_lotomania` (`idsislo_lotomania`, `id_sislo_jogos_cef`, `concurso`, `data_concurso`, `dez_01`, `dez_02`, `dez_03`, `dez_04`, `dez_05`, `dez_06`, `dez_07`, `dez_08`, `dez_09`, `dez_10`, `dez_11`, `dez_12`, `dez_13`, `dez_14`, `dez_15`, `dez_16`, `dez_17`, `dez_18`, `dez_19`, `dez_20`, `saiu_ganhador`, `premio_atual`, `premio_acumulado`, `arrecadacao_total`) VALUES
	(1, 28, 2406, '2022-12-19 00:00:00', 5, 7, 11, 15, 19, 26, 28, 32, 53, 54, 62, 69, 72, 75, 76, 80, 81, 82, 93, 95, 0, 4000000.00, 4300000.00, 4344422.50);

-- Copiando estrutura para tabela sislo.sislo_megasena
CREATE TABLE IF NOT EXISTS `sislo_megasena` (
  `idsislo_megasena` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_sislo_jogos_cef` int(11) NOT NULL,
  `concurso` int(11) NOT NULL,
  `data_concurso` datetime NOT NULL,
  `dez_01` int(11) NOT NULL,
  `dez_02` int(11) NOT NULL,
  `dez_03` int(11) NOT NULL,
  `dez_04` int(11) NOT NULL,
  `dez_05` int(11) NOT NULL,
  `dez_06` int(11) NOT NULL,
  `saiu_ganhador` int(11) NOT NULL,
  `premio_atual` decimal(15,2) NOT NULL,
  `premio_acumulado` decimal(15,2) NOT NULL,
  `arrecadacao_total` decimal(15,2) NOT NULL,
  PRIMARY KEY (`idsislo_megasena`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela sislo.sislo_megasena: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela sislo.sislo_mega_semana
CREATE TABLE IF NOT EXISTS `sislo_mega_semana` (
  `idsislo_mega_semana` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_sislo_jogos_cef` int(11) NOT NULL,
  `campanha` varchar(45) NOT NULL,
  `dia_01` datetime NOT NULL,
  `dia_02` datetime NOT NULL,
  `dia_03` datetime NOT NULL,
  `ano_referencia` varchar(4) NOT NULL,
  `status` int(11) NOT NULL,
  `data_ultima_alteracao` datetime NOT NULL,
  PRIMARY KEY (`idsislo_mega_semana`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela sislo.sislo_mega_semana: ~8 rows (aproximadamente)
INSERT INTO `sislo_mega_semana` (`idsislo_mega_semana`, `id_sislo_jogos_cef`, `campanha`, `dia_01`, `dia_02`, `dia_03`, `ano_referencia`, `status`, `data_ultima_alteracao`) VALUES
	(1, 16, 'Verão', '2021-01-26 00:00:00', '2021-01-28 00:00:00', '2021-01-29 00:00:00', '2022', 1, '2021-12-20 07:46:19'),
	(2, 16, 'Páscoa', '2021-04-06 00:00:00', '2021-04-08 00:00:00', '2021-04-10 00:00:00', '2022', 1, '2021-12-20 07:49:50'),
	(3, 1, 'Mães', '2021-05-04 00:00:00', '2021-05-06 00:00:00', '2021-05-08 00:00:00', '2022', 1, '2021-01-15 19:31:13'),
	(4, 1, 'Férias', '2021-06-29 00:00:00', '2021-07-01 00:00:00', '2021-07-03 00:00:00', '2021', 1, '2021-01-15 19:31:13'),
	(5, 1, 'Pais', '2021-08-10 00:00:00', '2021-08-12 00:00:00', '2021-08-14 00:00:00', '2021', 1, '2021-01-15 19:31:13'),
	(6, 1, 'Primavera', '2021-09-28 00:00:00', '2021-09-30 00:00:00', '2021-10-02 00:00:00', '2021', 1, '2021-01-15 19:31:13'),
	(7, 1, 'Sorte', '2021-10-19 00:00:00', '2021-10-21 00:00:00', '2021-10-23 00:00:00', '2021', 1, '2021-01-15 19:31:13'),
	(8, 1, 'Natal', '2021-12-07 00:00:00', '2021-12-09 00:00:00', '2021-12-11 00:00:00', '2021', 1, '2021-01-15 19:31:13');

-- Copiando estrutura para tabela sislo.sislo_meta_jogos
CREATE TABLE IF NOT EXISTS `sislo_meta_jogos` (
  `id_sislo_meta_jogos` int(11) NOT NULL AUTO_INCREMENT,
  `id_sislo_jogos_cef` int(11) NOT NULL,
  `cod_loterico` varchar(10) DEFAULT NULL,
  `ano` varchar(4) DEFAULT NULL,
  `janeiro` decimal(10,2) DEFAULT NULL,
  `fevereiro` decimal(10,2) DEFAULT NULL,
  `marco` decimal(10,2) DEFAULT NULL,
  `abril` decimal(10,2) DEFAULT NULL,
  `maio` decimal(10,2) DEFAULT NULL,
  `junho` decimal(10,2) DEFAULT NULL,
  `julho` decimal(10,2) DEFAULT NULL,
  `agosto` decimal(10,2) DEFAULT NULL,
  `setembro` decimal(10,2) DEFAULT NULL,
  `outubro` decimal(10,2) DEFAULT NULL,
  `novembro` decimal(10,2) DEFAULT NULL,
  `dezembro` decimal(10,2) DEFAULT NULL,
  `janeiro_bolao` decimal(10,2) DEFAULT NULL,
  `fevereiro_bolao` decimal(10,2) DEFAULT NULL,
  `marco_bolao` decimal(10,2) DEFAULT NULL,
  `abril_bolao` decimal(10,2) DEFAULT NULL,
  `maio_bolao` decimal(10,2) DEFAULT NULL,
  `junho_bolao` decimal(10,2) DEFAULT NULL,
  `julho_bolao` decimal(10,2) DEFAULT NULL,
  `agosto_bolao` decimal(10,2) DEFAULT NULL,
  `setembro_bolao` decimal(10,2) DEFAULT NULL,
  `outubro_bolao` decimal(10,2) DEFAULT NULL,
  `novembro_bolao` decimal(10,2) DEFAULT NULL,
  `dezembro_bolao` decimal(10,2) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `data_ultima_alteracao` datetime DEFAULT NULL,
  PRIMARY KEY (`id_sislo_meta_jogos`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela sislo.sislo_meta_jogos: ~0 rows (aproximadamente)
INSERT INTO `sislo_meta_jogos` (`id_sislo_meta_jogos`, `id_sislo_jogos_cef`, `cod_loterico`, `ano`, `janeiro`, `fevereiro`, `marco`, `abril`, `maio`, `junho`, `julho`, `agosto`, `setembro`, `outubro`, `novembro`, `dezembro`, `janeiro_bolao`, `fevereiro_bolao`, `marco_bolao`, `abril_bolao`, `maio_bolao`, `junho_bolao`, `julho_bolao`, `agosto_bolao`, `setembro_bolao`, `outubro_bolao`, `novembro_bolao`, `dezembro_bolao`, `status`, `data_ultima_alteracao`) VALUES
	(1, 23, '180178580', '2023', 3999.99, 3500.00, 4500.00, 4500.00, 4500.00, 4500.00, 4500.00, 3800.00, 2000.00, 1580.00, 4500.00, 9000.00, 1200.00, 1200.00, 1000.00, 1000.00, 1500.00, 1000.00, 4500.00, 1110.00, 2100.00, 1000.00, 900.00, 5900.00, 1, '2023-04-25 13:24:27'),
	(2, 20, '180178580', '2023', 555.55, 555.55, 555.55, 555.55, 555.55, 555.55, 555.55, 555.55, 555.55, 555.55, 555.55, 555.55, 555.55, 555.55, 555.55, 555.55, 555.55, 555.55, 555.55, 555.55, 555.55, 555.55, 555.55, 666.66, 1, '2023-07-11 15:21:17');

-- Copiando estrutura para tabela sislo.sislo_meta_nao_jogos
CREATE TABLE IF NOT EXISTS `sislo_meta_nao_jogos` (
  `id_sislo_meta_nao_jogos` int(11) NOT NULL AUTO_INCREMENT,
  `cod_loterico` varchar(10) DEFAULT NULL,
  `ano` varchar(4) DEFAULT NULL,
  `janeiro` decimal(10,2) DEFAULT NULL,
  `fevereiro` decimal(10,2) DEFAULT NULL,
  `marco` decimal(10,2) DEFAULT NULL,
  `abril` decimal(10,2) DEFAULT NULL,
  `maio` decimal(10,2) DEFAULT NULL,
  `junho` decimal(10,2) DEFAULT NULL,
  `julho` decimal(10,2) DEFAULT NULL,
  `agosto` decimal(10,2) DEFAULT NULL,
  `setembro` decimal(10,2) DEFAULT NULL,
  `outubro` decimal(10,2) DEFAULT NULL,
  `novembro` decimal(10,2) DEFAULT NULL,
  `dezembro` decimal(10,2) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `data_ultima_alteracao` datetime DEFAULT NULL,
  PRIMARY KEY (`id_sislo_meta_nao_jogos`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela sislo.sislo_meta_nao_jogos: ~0 rows (aproximadamente)
INSERT INTO `sislo_meta_nao_jogos` (`id_sislo_meta_nao_jogos`, `cod_loterico`, `ano`, `janeiro`, `fevereiro`, `marco`, `abril`, `maio`, `junho`, `julho`, `agosto`, `setembro`, `outubro`, `novembro`, `dezembro`, `status`, `data_ultima_alteracao`) VALUES
	(1, '180178580', '2023', 13500.00, 14500.00, 13500.00, 16000.00, 18000.00, 14555.00, 16555.54, 16555.48, 16854.28, 21666.58, 17425.00, 19000.00, 1, '2023-07-11 15:06:38');

-- Copiando estrutura para tabela sislo.sislo_milionaria
CREATE TABLE IF NOT EXISTS `sislo_milionaria` (
  `idsislo_milionaria` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_sislo_jogos_cef` int(11) NOT NULL,
  `concurso` int(11) NOT NULL,
  `data_concurso` datetime NOT NULL,
  `dez_01` int(11) NOT NULL,
  `dez_02` int(11) NOT NULL,
  `dez_03` int(11) NOT NULL,
  `dez_04` int(11) NOT NULL,
  `dez_05` int(11) NOT NULL,
  `dez_06` int(11) NOT NULL,
  `trevo_01` int(11) NOT NULL,
  `trevo_02` int(11) NOT NULL,
  `saiu_ganhador` int(11) NOT NULL,
  `premio_atual` decimal(15,2) NOT NULL,
  `premio_acumulado` decimal(15,2) NOT NULL,
  `arrecadacao_total` decimal(15,2) NOT NULL,
  PRIMARY KEY (`idsislo_milionaria`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela sislo.sislo_milionaria: ~0 rows (aproximadamente)
INSERT INTO `sislo_milionaria` (`idsislo_milionaria`, `id_sislo_jogos_cef`, `concurso`, `data_concurso`, `dez_01`, `dez_02`, `dez_03`, `dez_04`, `dez_05`, `dez_06`, `trevo_01`, `trevo_02`, `saiu_ganhador`, `premio_atual`, `premio_acumulado`, `arrecadacao_total`) VALUES
	(1, 28, 30, '2022-12-17 00:00:00', 2, 24, 31, 39, 46, 47, 1, 2, 0, 21000000.00, 21500000.00, 4886100.00);

-- Copiando estrutura para tabela sislo.sislo_motivo_demissao
CREATE TABLE IF NOT EXISTS `sislo_motivo_demissao` (
  `id_motivo_demissao` int(11) NOT NULL AUTO_INCREMENT,
  `motivo_demissao` varchar(150) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `data_ultima_alteracao` datetime DEFAULT NULL,
  KEY `id_motivo_demissao` (`id_motivo_demissao`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela sislo.sislo_motivo_demissao: ~14 rows (aproximadamente)
INSERT INTO `sislo_motivo_demissao` (`id_motivo_demissao`, `motivo_demissao`, `status`, `data_ultima_alteracao`) VALUES
	(1, 'Ato de improbidade', 1, '2021-10-31 19:40:10'),
	(2, 'Incontinência de conduta ou mau procedimento', 1, '2021-10-31 19:45:53'),
	(3, 'Negociação habitual', 1, '2021-10-31 19:46:06'),
	(4, 'Condenação criminal', 1, '2021-10-31 19:46:16'),
	(5, 'Desídia', 1, '2021-10-31 19:46:28'),
	(6, 'Embriaguez habitual ou em serviço', 1, '2021-10-31 19:46:37'),
	(7, 'Violação de segredo da empresa', 1, '2021-10-31 19:46:46'),
	(8, 'Ato de indisciplina ou de insubordinação', 1, '2021-10-31 19:46:56'),
	(9, 'Abandono de emprego', 1, '2021-10-31 19:47:04'),
	(10, 'Ofensas físicas', 1, '2021-10-31 19:47:11'),
	(11, 'Lesões à honra e à boa fama', 1, '2021-10-31 19:47:21'),
	(12, 'Jogos de azar', 1, '2021-10-31 19:47:38'),
	(13, 'Atos atentatórios à segurança nacional', 1, '2021-10-31 19:47:48'),
	(14, 'Dispensa sem Justa Causa', 1, '2021-10-31 19:48:07');

-- Copiando estrutura para tabela sislo.sislo_op_entrada
CREATE TABLE IF NOT EXISTS `sislo_op_entrada` (
  `idsislo_op_entrada` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(50) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `data_ultima_alteracao` datetime DEFAULT NULL,
  PRIMARY KEY (`idsislo_op_entrada`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela sislo.sislo_op_entrada: ~2 rows (aproximadamente)
INSERT INTO `sislo_op_entrada` (`idsislo_op_entrada`, `tipo`, `status`, `data_ultima_alteracao`) VALUES
	(1, 'Água e Esgoto', 1, '2022-06-07 20:35:29'),
	(2, 'Energia e Gás', 1, '2022-06-07 20:37:49'),
	(3, 'Outros pagamentos', 1, '2022-06-07 20:42:53');

-- Copiando estrutura para tabela sislo.sislo_pec
CREATE TABLE IF NOT EXISTS `sislo_pec` (
  `idsislo_pec` int(11) NOT NULL AUTO_INCREMENT,
  `id_sislo_tipo_pec` int(11) DEFAULT 0,
  `id_sislo_op_entrada` int(11) DEFAULT 0,
  `nome_convenio` varchar(148) DEFAULT NULL,
  `convenio` varchar(30) DEFAULT NULL,
  `id_sislo_pec_destinacao` int(11) DEFAULT 0,
  `id_sislo_pec_identificador` int(11) DEFAULT 0,
  `status` int(11) DEFAULT 0,
  `vigencia` varchar(4) DEFAULT NULL,
  `data_ultima_alteracao` datetime DEFAULT NULL,
  KEY `idsislo_pec` (`idsislo_pec`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela sislo.sislo_pec: ~2 rows (aproximadamente)
INSERT INTO `sislo_pec` (`idsislo_pec`, `id_sislo_tipo_pec`, `id_sislo_op_entrada`, `nome_convenio`, `convenio`, `id_sislo_pec_destinacao`, `id_sislo_pec_identificador`, `status`, `vigencia`, `data_ultima_alteracao`) VALUES
	(1, 1, 1, 'dmais', '30910857', 1, 1, 1, '2022', '2022-06-23 09:20:14'),
	(2, 1, 1, 'aguinha', '12312312', 1, 1, 1, '2022', '2022-06-23 09:24:03'),
	(3, 1, 1, 'luizinha', '30918547', 1, 1, 1, '2022', '2022-06-23 09:26:57');

-- Copiando estrutura para tabela sislo.sislo_pec_destinacao
CREATE TABLE IF NOT EXISTS `sislo_pec_destinacao` (
  `idsislo_pec_destinacao` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(50) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `data_ultima_alteracao` datetime DEFAULT NULL,
  PRIMARY KEY (`idsislo_pec_destinacao`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela sislo.sislo_pec_destinacao: ~0 rows (aproximadamente)
INSERT INTO `sislo_pec_destinacao` (`idsislo_pec_destinacao`, `tipo`, `status`, `data_ultima_alteracao`) VALUES
	(1, 'Pagamento de faturas de água', 1, '2022-06-23 09:02:39');

-- Copiando estrutura para tabela sislo.sislo_pec_identificador
CREATE TABLE IF NOT EXISTS `sislo_pec_identificador` (
  `idsislo_pec_identificador` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(50) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `data_ultima_alteracao` datetime DEFAULT NULL,
  PRIMARY KEY (`idsislo_pec_identificador`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela sislo.sislo_pec_identificador: ~0 rows (aproximadamente)
INSERT INTO `sislo_pec_identificador` (`idsislo_pec_identificador`, `tipo`, `status`, `data_ultima_alteracao`) VALUES
	(1, 'Identificador informado pela empresa', 1, '2022-06-23 09:02:57');

-- Copiando estrutura para tabela sislo.sislo_premios_pagos
CREATE TABLE IF NOT EXISTS `sislo_premios_pagos` (
  `idsislo_premios_pagos` int(11) NOT NULL AUTO_INCREMENT,
  `cod_loterico` varchar(10) NOT NULL DEFAULT '0',
  `referencia` varchar(8) NOT NULL DEFAULT '0',
  `dia_inicial` datetime NOT NULL,
  `dia_final` datetime NOT NULL,
  `id_sislo_jogos_cef` int(11) NOT NULL DEFAULT 0,
  `quantidade` int(11) NOT NULL DEFAULT 0,
  `valor` decimal(10,2) NOT NULL DEFAULT 0.00,
  `status` int(11) NOT NULL DEFAULT 0,
  `data_ultima_alteracao` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`idsislo_premios_pagos`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela sislo.sislo_premios_pagos: ~4 rows (aproximadamente)
INSERT INTO `sislo_premios_pagos` (`idsislo_premios_pagos`, `cod_loterico`, `referencia`, `dia_inicial`, `dia_final`, `id_sislo_jogos_cef`, `quantidade`, `valor`, `status`, `data_ultima_alteracao`) VALUES
	(1, '180178580', '09/2021', '2021-09-02 00:00:00', '2021-09-02 00:00:00', 22, 0, 0.06, 1, '2022-08-07 21:06:36'),
	(2, '180178580', '09/2021', '2021-09-02 00:00:00', '2021-09-02 00:00:00', 18, 6, 87.58, 1, '2022-08-07 21:06:36'),
	(3, '180178580', '09/2021', '2021-09-02 00:00:00', '2021-09-02 00:00:00', 17, 4, 5.00, 1, '2022-08-07 21:06:36'),
	(4, '180178580', '09/2021', '2021-09-02 00:00:00', '2021-09-02 00:00:00', 22, 2, 8.00, 1, '2022-08-07 21:06:36');

-- Copiando estrutura para tabela sislo.sislo_prestacao_contas
CREATE TABLE IF NOT EXISTS `sislo_prestacao_contas` (
  `idsislo_prestacao_contas` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cod_loterico` varchar(10) NOT NULL,
  `referencia` varchar(8) NOT NULL,
  `data_transacao` datetime NOT NULL,
  `origem` varchar(99) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `entrada_saida` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `data_ultima_alteracao` datetime NOT NULL,
  PRIMARY KEY (`idsislo_prestacao_contas`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=258 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Copiando dados para a tabela sislo.sislo_prestacao_contas: ~7 rows (aproximadamente)
INSERT INTO `sislo_prestacao_contas` (`idsislo_prestacao_contas`, `cod_loterico`, `referencia`, `data_transacao`, `origem`, `valor`, `entrada_saida`, `status`, `data_ultima_alteracao`) VALUES
	(251, '180178580', '12/2021', '2021-12-12 19:54:51', 'Cobrança Diária Serviços', 6549.87, 1, 1, '2021-12-12 19:54:51'),
	(252, '180178580', '12/2021', '2021-12-12 19:54:51', 'Cobrança Diária Serviços', 321321.33, 2, 1, '2021-12-12 19:54:51'),
	(253, '180178580', '12/2021', '2021-12-12 19:54:51', 'Cobrança Diária Serviços', 0.00, 2, 1, '2021-12-12 19:54:51'),
	(254, '180178580', '07/2021', '2021-07-10 00:00:00', 'Fechamento de Caixa nº 1', -1059867.55, 2, 1, '2022-01-05 18:53:02'),
	(255, '180178580', '07/2021', '2021-07-10 00:00:00', 'Fechamento de Caixa nº 1', -0.28, 2, 1, '2022-01-05 18:57:37'),
	(256, '180178580', '04/2023', '2023-04-09 00:00:00', 'Fechamento de Caixa nº 1', 0.00, 1, 1, '2023-04-10 11:59:18'),
	(257, '180178580', '04/2023', '2023-04-10 00:00:00', 'Fechamento de Caixa nº 1', 0.00, 1, 1, '2023-04-11 13:23:32');

-- Copiando estrutura para tabela sislo.sislo_protege
CREATE TABLE IF NOT EXISTS `sislo_protege` (
  `idsislo_protege` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cod_loterico` varchar(10) NOT NULL,
  `fixo` decimal(5,0) NOT NULL,
  `dependencia` decimal(3,0) NOT NULL,
  `jan` decimal(2,0) NOT NULL,
  `fev` decimal(2,0) NOT NULL,
  `mar` decimal(2,0) NOT NULL,
  `abr` decimal(2,0) NOT NULL,
  `mai` decimal(2,0) NOT NULL,
  `jun` decimal(2,0) NOT NULL,
  `jul` decimal(2,0) NOT NULL,
  `ago` decimal(2,0) NOT NULL,
  `set` decimal(2,0) NOT NULL,
  `out` decimal(2,0) NOT NULL,
  `nov` decimal(2,0) NOT NULL,
  `dez` decimal(2,0) NOT NULL,
  `seg` decimal(2,0) NOT NULL,
  `ter` decimal(2,0) NOT NULL,
  `qua` decimal(2,0) NOT NULL,
  `qui` decimal(2,0) NOT NULL,
  `sex` decimal(2,0) NOT NULL,
  `sab` decimal(2,0) NOT NULL,
  `dom` decimal(2,0) NOT NULL,
  `d01` decimal(3,0) NOT NULL,
  `d02` decimal(3,0) NOT NULL,
  `d03` decimal(3,0) NOT NULL,
  `d04` decimal(3,0) NOT NULL,
  `d05` decimal(3,0) NOT NULL,
  `d06` decimal(3,0) NOT NULL,
  `d07` decimal(3,0) NOT NULL,
  `d08` decimal(3,0) NOT NULL,
  `d09` decimal(3,0) NOT NULL,
  `d10` decimal(3,0) NOT NULL,
  `d11` decimal(3,0) NOT NULL,
  `d12` decimal(3,0) NOT NULL,
  `d13` decimal(3,0) NOT NULL,
  `d14` decimal(3,0) NOT NULL,
  `d15` decimal(3,0) NOT NULL,
  `d16` decimal(3,0) NOT NULL,
  `d17` decimal(3,0) NOT NULL,
  `d18` decimal(3,0) NOT NULL,
  `d19` decimal(3,0) NOT NULL,
  `d20` decimal(3,0) NOT NULL,
  `d21` decimal(3,0) NOT NULL,
  `d22` decimal(3,0) NOT NULL,
  `d23` decimal(3,0) NOT NULL,
  `d24` decimal(3,0) NOT NULL,
  `d25` decimal(3,0) NOT NULL,
  `d26` decimal(3,0) NOT NULL,
  `d27` decimal(3,0) NOT NULL,
  `d28` decimal(3,0) NOT NULL,
  `d29` decimal(3,0) NOT NULL,
  `d30` decimal(3,0) NOT NULL,
  `d31` decimal(3,0) NOT NULL,
  `validade` varchar(4) NOT NULL,
  `status` int(11) NOT NULL,
  `data_ultima_alteracao` datetime NOT NULL,
  PRIMARY KEY (`idsislo_protege`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela sislo.sislo_protege: ~0 rows (aproximadamente)
INSERT INTO `sislo_protege` (`idsislo_protege`, `cod_loterico`, `fixo`, `dependencia`, `jan`, `fev`, `mar`, `abr`, `mai`, `jun`, `jul`, `ago`, `set`, `out`, `nov`, `dez`, `seg`, `ter`, `qua`, `qui`, `sex`, `sab`, `dom`, `d01`, `d02`, `d03`, `d04`, `d05`, `d06`, `d07`, `d08`, `d09`, `d10`, `d11`, `d12`, `d13`, `d14`, `d15`, `d16`, `d17`, `d18`, `d19`, `d20`, `d21`, `d22`, `d23`, `d24`, `d25`, `d26`, `d27`, `d28`, `d29`, `d30`, `d31`, `validade`, `status`, `data_ultima_alteracao`) VALUES
	(1, '180178580', 10340, 139, 97, 17, 11, 85, 25, 50, 73, 92, 79, 53, 37, 62, 91, 30, 68, 82, 35, 44, 75, 350, 828, 657, 175, 437, 913, 289, 549, 719, 478, 743, 135, 691, 869, 561, 127, 419, 239, 967, 149, 687, 853, 444, 939, 375, 619, 271, 564, 771, 153, 582, '2023', 1, '2022-01-01 19:45:55');

-- Copiando estrutura para tabela sislo.sislo_quina
CREATE TABLE IF NOT EXISTS `sislo_quina` (
  `idsislo_quina` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_sislo_jogos_cef` int(11) NOT NULL,
  `concurso` int(11) NOT NULL,
  `data_concurso` datetime NOT NULL,
  `dez_01` int(11) NOT NULL,
  `dez_02` int(11) NOT NULL,
  `dez_03` int(11) NOT NULL,
  `dez_04` int(11) NOT NULL,
  `dez_05` int(11) NOT NULL,
  `saiu_ganhador` int(11) NOT NULL,
  `premio_atual` decimal(15,2) NOT NULL,
  `premio_acumulado` decimal(15,2) NOT NULL,
  `arrecadacao_total` decimal(15,2) NOT NULL,
  PRIMARY KEY (`idsislo_quina`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela sislo.sislo_quina: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela sislo.sislo_sangria
CREATE TABLE IF NOT EXISTS `sislo_sangria` (
  `idsislo_sangria` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cod_loterico` varchar(10) NOT NULL,
  `data_registro` datetime NOT NULL,
  `data_coleta` datetime NOT NULL,
  `caixa_operador` int(11) NOT NULL,
  `idsislo_tfl` int(11) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `num_controle` varchar(45) NOT NULL,
  `numerario_02` decimal(10,2) DEFAULT NULL,
  `numerario_05` decimal(10,2) DEFAULT NULL,
  `numerario_10` decimal(10,2) DEFAULT NULL,
  `numerario_20` decimal(10,2) DEFAULT NULL,
  `numerario_50` decimal(10,2) DEFAULT NULL,
  `numerario_100` decimal(10,2) DEFAULT NULL,
  `numerario_200` decimal(10,2) DEFAULT NULL,
  `data_ultima_alteracao` datetime NOT NULL,
  PRIMARY KEY (`idsislo_sangria`)
) ENGINE=InnoDB AUTO_INCREMENT=184 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela sislo.sislo_sangria: ~5 rows (aproximadamente)
INSERT INTO `sislo_sangria` (`idsislo_sangria`, `cod_loterico`, `data_registro`, `data_coleta`, `caixa_operador`, `idsislo_tfl`, `valor`, `num_controle`, `numerario_02`, `numerario_05`, `numerario_10`, `numerario_20`, `numerario_50`, `numerario_100`, `numerario_200`, `data_ultima_alteracao`) VALUES
	(179, '180178580', '2021-12-30 00:00:00', '2021-12-31 00:00:00', 43, 1, 10000.00, '1', 100.00, 50.00, 350.00, 100.00, 1.00, 30.00, 5.00, '2021-12-30 19:57:41'),
	(180, '180178580', '2023-04-10 00:00:00', '2023-04-10 00:00:00', 43, 1, 22728.00, '1', 54.00, 60.00, 100.00, 21.00, 350.00, 20.00, 7.00, '2023-04-10 09:38:06'),
	(181, '180178580', '2023-04-10 00:00:00', '2023-04-10 00:00:00', 43, 1, 17641.00, '2', 33.00, 33.00, 11.00, 50.00, 88.00, 99.00, 10.00, '2023-04-10 09:38:26'),
	(182, '180178580', '2023-04-11 00:00:00', '2023-04-11 00:00:00', 43, 1, 61057.00, '1', 456.00, 85.00, 37.00, 1050.00, 67.00, 300.00, 25.00, '2023-04-11 13:20:17'),
	(183, '180178580', '2023-04-11 00:00:00', '2023-04-11 00:00:00', 43, 1, 5000.00, '4', 0.00, 0.00, 0.00, 0.00, 100.00, 0.00, 0.00, '2023-04-11 13:20:45');

-- Copiando estrutura para tabela sislo.sislo_servicos_decendio
CREATE TABLE IF NOT EXISTS `sislo_servicos_decendio` (
  `idsislo_servicos_decendio` int(11) NOT NULL AUTO_INCREMENT,
  `id_sislo_tipo_servico` int(11) DEFAULT NULL,
  `id_sislo_tipos_convenio` int(11) DEFAULT NULL,
  `servico` varchar(50) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `data_ultima_alteracao` datetime DEFAULT NULL,
  PRIMARY KEY (`idsislo_servicos_decendio`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela sislo.sislo_servicos_decendio: ~3 rows (aproximadamente)
INSERT INTO `sislo_servicos_decendio` (`idsislo_servicos_decendio`, `id_sislo_tipo_servico`, `id_sislo_tipos_convenio`, `servico`, `status`, `data_ultima_alteracao`) VALUES
	(1, 5, 3, 'GERAÇÃO QR CODE', 1, '2022-08-24 09:09:34'),
	(2, 5, 3, 'PIX PAGAMENTO', 1, '2022-08-24 09:09:34'),
	(3, 5, 3, 'PIX SAQUE', 1, '2022-08-24 09:09:34');

-- Copiando estrutura para tabela sislo.sislo_status_vaga
CREATE TABLE IF NOT EXISTS `sislo_status_vaga` (
  `id_sislo_status_vaga` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome_status` varchar(50) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `data_ultima_alteracao` datetime DEFAULT NULL,
  PRIMARY KEY (`id_sislo_status_vaga`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- Copiando dados para a tabela sislo.sislo_status_vaga: ~6 rows (aproximadamente)
INSERT INTO `sislo_status_vaga` (`id_sislo_status_vaga`, `nome_status`, `status`, `data_ultima_alteracao`) VALUES
	(5, 'Em Aberto', 1, '2023-09-18 09:30:41'),
	(6, 'Em Seleção', 1, '2023-09-18 09:30:48'),
	(7, 'Cancelada', 1, '2023-09-18 09:31:44'),
	(8, 'Congelada', 1, '2023-09-18 09:31:52'),
	(9, 'Processo de Contratação', 1, '2023-09-18 09:32:44'),
	(10, 'Fechada', 1, '2023-09-18 09:32:53');

-- Copiando estrutura para tabela sislo.sislo_status_vaga_candidato
CREATE TABLE IF NOT EXISTS `sislo_status_vaga_candidato` (
  `id_sislo_status_vaga_candidato` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome_status` varchar(50) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `data_ultima_alteracao` datetime DEFAULT NULL,
  PRIMARY KEY (`id_sislo_status_vaga_candidato`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- Copiando dados para a tabela sislo.sislo_status_vaga_candidato: ~2 rows (aproximadamente)
INSERT INTO `sislo_status_vaga_candidato` (`id_sislo_status_vaga_candidato`, `nome_status`, `status`, `data_ultima_alteracao`) VALUES
	(11, 'Aplicada', 1, '2023-09-21 10:01:37'),
	(12, 'Não Eletivo', 1, '2023-09-21 10:04:34'),
	(13, 'Selecionado para Entrevista', 1, '2023-09-21 10:03:35');

-- Copiando estrutura para tabela sislo.sislo_supersete
CREATE TABLE IF NOT EXISTS `sislo_supersete` (
  `idsislo_supersete` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_sislo_jogos_cef` int(11) NOT NULL,
  `concurso` int(11) NOT NULL,
  `data_concurso` datetime NOT NULL,
  `dez_01` int(11) NOT NULL,
  `dez_02` int(11) NOT NULL,
  `dez_03` int(11) NOT NULL,
  `dez_04` int(11) NOT NULL,
  `dez_05` int(11) NOT NULL,
  `dez_06` int(11) NOT NULL,
  `dez_07` int(11) NOT NULL,
  `saiu_ganhador` int(11) NOT NULL,
  `premio_atual` decimal(15,2) NOT NULL,
  `premio_acumulado` decimal(15,2) NOT NULL,
  `arrecadacao_total` decimal(15,2) NOT NULL,
  PRIMARY KEY (`idsislo_supersete`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela sislo.sislo_supersete: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela sislo.sislo_tfl
CREATE TABLE IF NOT EXISTS `sislo_tfl` (
  `idsislo_tfl` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cod_loterico` varchar(10) NOT NULL,
  `terminal` varchar(45) NOT NULL,
  `serie` varchar(45) NOT NULL,
  `caixa_numero` varchar(45) NOT NULL,
  `status` int(11) NOT NULL,
  `data_ultima_alteracao` datetime NOT NULL,
  PRIMARY KEY (`idsislo_tfl`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela sislo.sislo_tfl: ~0 rows (aproximadamente)
INSERT INTO `sislo_tfl` (`idsislo_tfl`, `cod_loterico`, `terminal`, `serie`, `caixa_numero`, `status`, `data_ultima_alteracao`) VALUES
	(1, '180178580', '15523', '250250', '1', 1, '2021-10-21 20:54:51');

-- Copiando estrutura para tabela sislo.sislo_timemania
CREATE TABLE IF NOT EXISTS `sislo_timemania` (
  `idsislo_timemania` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_sislo_jogos_cef` int(11) NOT NULL,
  `concurso` int(11) NOT NULL,
  `data_concurso` datetime NOT NULL,
  `dez_01` int(11) NOT NULL,
  `dez_02` int(11) NOT NULL,
  `dez_03` int(11) NOT NULL,
  `dez_04` int(11) NOT NULL,
  `dez_05` int(11) NOT NULL,
  `dez_06` int(11) NOT NULL,
  `dez_07` int(11) NOT NULL,
  `id_sislo_timemania_time_coracao` int(11) NOT NULL,
  `saiu_ganhador` int(11) NOT NULL,
  `premio_atual` decimal(15,2) NOT NULL,
  `premio_acumulado` decimal(15,2) NOT NULL,
  `arrecadacao_total` decimal(15,2) NOT NULL,
  PRIMARY KEY (`idsislo_timemania`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela sislo.sislo_timemania: ~0 rows (aproximadamente)
INSERT INTO `sislo_timemania` (`idsislo_timemania`, `id_sislo_jogos_cef`, `concurso`, `data_concurso`, `dez_01`, `dez_02`, `dez_03`, `dez_04`, `dez_05`, `dez_06`, `dez_07`, `id_sislo_timemania_time_coracao`, `saiu_ganhador`, `premio_atual`, `premio_acumulado`, `arrecadacao_total`) VALUES
	(1, 28, 1874, '2022-12-17 00:00:00', 9, 11, 17, 47, 55, 67, 72, 1, 0, 14000000.00, 14500000.00, 3537801.00);

-- Copiando estrutura para tabela sislo.sislo_timemania_time_coracao
CREATE TABLE IF NOT EXISTS `sislo_timemania_time_coracao` (
  `idsislo_timemania_time_coracao` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `time_coracao` varchar(50) NOT NULL,
  PRIMARY KEY (`idsislo_timemania_time_coracao`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela sislo.sislo_timemania_time_coracao: ~0 rows (aproximadamente)
INSERT INTO `sislo_timemania_time_coracao` (`idsislo_timemania_time_coracao`, `time_coracao`) VALUES
	(1, 'ABC/RN');

-- Copiando estrutura para tabela sislo.sislo_tipos_convenio
CREATE TABLE IF NOT EXISTS `sislo_tipos_convenio` (
  `idsislo_tipos_convenio` int(11) NOT NULL AUTO_INCREMENT,
  `convenio` varchar(50) DEFAULT NULL,
  `valor_global` decimal(10,2) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `data_ultima_alteracao` datetime DEFAULT NULL,
  PRIMARY KEY (`idsislo_tipos_convenio`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela sislo.sislo_tipos_convenio: ~3 rows (aproximadamente)
INSERT INTO `sislo_tipos_convenio` (`idsislo_tipos_convenio`, `convenio`, `valor_global`, `status`, `data_ultima_alteracao`) VALUES
	(2, 'CONVÊNIOS ESTADUAIS (LUZ, ÁGUA, TEL)', 0.86, 1, '2022-08-19 20:28:16'),
	(3, 'PIX', 1.00, 1, '2022-08-24 09:08:45'),
	(4, 'PIX SAQUE', 0.71, 1, '2022-08-24 09:07:45');

-- Copiando estrutura para tabela sislo.sislo_tipo_pec
CREATE TABLE IF NOT EXISTS `sislo_tipo_pec` (
  `idsislo_tipo_pec` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(50) DEFAULT NULL,
  `status` int(11) DEFAULT 0,
  `data_ultima_alteracao` datetime DEFAULT NULL,
  PRIMARY KEY (`idsislo_tipo_pec`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela sislo.sislo_tipo_pec: ~2 rows (aproximadamente)
INSERT INTO `sislo_tipo_pec` (`idsislo_tipo_pec`, `tipo`, `status`, `data_ultima_alteracao`) VALUES
	(1, 'PEC', 1, '2022-06-05 20:38:56'),
	(2, 'REC', 1, '2022-06-05 20:39:02');

-- Copiando estrutura para tabela sislo.sislo_tipo_servico
CREATE TABLE IF NOT EXISTS `sislo_tipo_servico` (
  `idsislo_tipo_servico` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `servico` varchar(75) NOT NULL,
  `status` int(11) NOT NULL,
  `data_ultima_alteracao` datetime NOT NULL,
  PRIMARY KEY (`idsislo_tipo_servico`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela sislo.sislo_tipo_servico: ~4 rows (aproximadamente)
INSERT INTO `sislo_tipo_servico` (`idsislo_tipo_servico`, `servico`, `status`, `data_ultima_alteracao`) VALUES
	(1, 'PAGAMENTOS', 1, '2021-11-21 19:07:47'),
	(2, 'RECEBIMENTOS', 1, '2021-11-21 19:07:55'),
	(3, 'SERVIÇOS', 1, '2021-11-21 19:08:04'),
	(4, 'ESTORNOS', 1, '2021-11-21 19:08:12'),
	(5, 'NEGOCIAL', 1, '2021-11-21 19:08:20');

-- Copiando estrutura para tabela sislo.sislo_usuarios
CREATE TABLE IF NOT EXISTS `sislo_usuarios` (
  `sislo_usuarios_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sislo_login` varchar(99) NOT NULL,
  `sislo_id_loterica` varchar(10) NOT NULL,
  `sislo_nome` varchar(145) NOT NULL,
  `sislo_pass` varchar(255) NOT NULL,
  `sislo_email` varchar(104) NOT NULL,
  `sislo_status` int(11) NOT NULL,
  `sislo_data_ultima_alteracao` datetime NOT NULL,
  PRIMARY KEY (`sislo_usuarios_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela sislo.sislo_usuarios: ~0 rows (aproximadamente)
INSERT INTO `sislo_usuarios` (`sislo_usuarios_id`, `sislo_login`, `sislo_id_loterica`, `sislo_nome`, `sislo_pass`, `sislo_email`, `sislo_status`, `sislo_data_ultima_alteracao`) VALUES
	(3, 'vitor', '180178580', 'vitor dorneles', 'e8ae21fa26d51a53e1e3bfc9a37bd4da10a63692', 'vitordorneles@hotmail.com', 1, '2021-10-22 02:59:36'),
	(4, 'marja', '180178580', 'Marja Gonçalves', 'e8ae21fa26d51a53e1e3bfc9a37bd4da10a63692', 'marja.consultoria@gmail.com', 1, '2021-10-21 20:54:24'),
	(5, 'VivianeHatzemberger', '180178580', 'Viviane Hatzemberger', 'e8ae21fa26d51a53e1e3bfc9a37bd4da10a63692', 'vhatz@gmail.com', 1, '2021-11-19 20:19:45');

-- Copiando estrutura para tabela sislo.sislo_vagas
CREATE TABLE IF NOT EXISTS `sislo_vagas` (
  `id_sislo_vagas` int(11) NOT NULL AUTO_INCREMENT,
  `cod_loterico` varchar(12) DEFAULT NULL,
  `data_publicacao` date DEFAULT NULL,
  `data_limite` date DEFAULT NULL,
  `cargo` varchar(150) DEFAULT NULL,
  `responsabilidades` text DEFAULT NULL,
  `requisitos` text DEFAULT NULL,
  `beneficios` text DEFAULT NULL,
  `salario` decimal(10,2) DEFAULT NULL,
  `diferenciais` text DEFAULT NULL,
  `vaga_promovida` int(11) DEFAULT NULL,
  `carga_horaria` varchar(33) DEFAULT NULL,
  `forma_contratacao` varchar(33) DEFAULT NULL,
  `id_sislo_status_vaga` int(11) DEFAULT NULL,
  `data_ultima_alteracao` datetime DEFAULT NULL,
  PRIMARY KEY (`id_sislo_vagas`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela sislo.sislo_vagas: ~0 rows (aproximadamente)
INSERT INTO `sislo_vagas` (`id_sislo_vagas`, `cod_loterico`, `data_publicacao`, `data_limite`, `cargo`, `responsabilidades`, `requisitos`, `beneficios`, `salario`, `diferenciais`, `vaga_promovida`, `carga_horaria`, `forma_contratacao`, `id_sislo_status_vaga`, `data_ultima_alteracao`) VALUES
	(1, '180178581', '2023-09-20', '2023-10-05', 'Operador Caixa Lotérico', NULL, 'Ensino Médio Completo', 'VA+VT+Plano', 1.57, 'Experiência em vendas', 1, '8h', 'CLT', 5, '2023-09-20 08:01:28'),
	(2, '180178581', '2023-09-28', '2023-10-31', 'Operador Caixa Lotérico', 'Atendimento ao Cliente\r\nVendas de Jogos\r\nNegócios', 'Ensino Médio Completo\r\nComunicativo(a)', 'VA\r\nVT\r\nComissão por Metas\r\nPlano de Saúde', 1950.00, 'Experiência com Lotéricas\r\nVenda de jogos e bolões\r\nAtendimento ao Público', 0, '8h', 'CLT', 6, '2023-09-28 09:18:24');

-- Copiando estrutura para tabela sislo.sislo_vagas_aplicadas
CREATE TABLE IF NOT EXISTS `sislo_vagas_aplicadas` (
  `id_sislo_vagas_aplicadas` int(11) NOT NULL AUTO_INCREMENT,
  `id_sislo_vagas` int(11) DEFAULT 0,
  `id_sislo_candidato` int(11) DEFAULT 0,
  `id_sislo_status_vaga_candidato` int(11) DEFAULT 0,
  `data_ultima_alteracao` datetime DEFAULT NULL,
  PRIMARY KEY (`id_sislo_vagas_aplicadas`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela sislo.sislo_vagas_aplicadas: ~0 rows (aproximadamente)
INSERT INTO `sislo_vagas_aplicadas` (`id_sislo_vagas_aplicadas`, `id_sislo_vagas`, `id_sislo_candidato`, `id_sislo_status_vaga_candidato`, `data_ultima_alteracao`) VALUES
	(1, 1, 1, 11, '2023-09-22 09:13:07'),
	(2, 2, 1, 11, '2023-09-28 09:19:22');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
