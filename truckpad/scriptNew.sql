-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           5.7.26 - MySQL Community Server (GPL)
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Copiando estrutura para tabela truckpad.caminhoneiros
CREATE TABLE IF NOT EXISTS `caminhoneiros` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(250) DEFAULT NULL,
  `numero_cnh` char(20) DEFAULT NULL,
  `data_nascimento` date DEFAULT NULL,
  `sexo` enum('M','F') DEFAULT NULL,
  `possui_veiculo` enum('Y','N') DEFAULT NULL,
  `tipo_cnh` enum('A','B','C','D','E') DEFAULT NULL,
  `lat_origem` float DEFAULT NULL,
  `long_origem` float DEFAULT NULL,
  `fk_tipo_caminhoes` int(11) DEFAULT NULL,
  `adiciona` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `adiciona_last_update` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `numero_cnh` (`numero_cnh`),
  KEY `fk_tipo_cami_idx` (`fk_tipo_caminhoes`),
  CONSTRAINT `FK_caminhoneiros_tipo_caminhoes` FOREIGN KEY (`fk_tipo_caminhoes`) REFERENCES `tipo_caminhoes` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela truckpad.caminhoneiros: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `caminhoneiros` DISABLE KEYS */;
/*!40000 ALTER TABLE `caminhoneiros` ENABLE KEYS */;

-- Copiando estrutura para tabela truckpad.destinos
CREATE TABLE IF NOT EXISTS `destinos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lat_destino` float NOT NULL DEFAULT '0',
  `long_destino` float NOT NULL DEFAULT '0',
  `carregado` enum('Y','N') NOT NULL,
  `fk_caminhoneiros` int(11) NOT NULL DEFAULT '0',
  `adicionado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `FK_destinos_caminhoneiros` (`fk_caminhoneiros`),
  CONSTRAINT `FK_destinos_caminhoneiros` FOREIGN KEY (`fk_caminhoneiros`) REFERENCES `caminhoneiros` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela truckpad.destinos: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `destinos` DISABLE KEYS */;
/*!40000 ALTER TABLE `destinos` ENABLE KEYS */;

-- Copiando estrutura para tabela truckpad.tipo_caminhoes
CREATE TABLE IF NOT EXISTS `tipo_caminhoes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(250) DEFAULT NULL,
  `adicionado` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela truckpad.tipo_caminhoes: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `tipo_caminhoes` DISABLE KEYS */;
/*!40000 ALTER TABLE `tipo_caminhoes` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
