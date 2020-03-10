<?php

namespace App\Models\DAO;


use App\Libs\DataBase\BaseDAO;

class BuilderDAO extends BaseDAO
{
   
  
    public function createAllDatabase()
    { 
       try{

        ///cria tabela de tipos de caminhoes
            $this->select('CREATE TABLE IF NOT EXISTS `tipo_caminhoes` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `titulo` varchar(250) DEFAULT NULL,
                `adicionado` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1;');

         //adiciona tipos de caminhões
          $this->select(\utf8_encode("INSERT INTO `tipo_caminhoes` (`id`, `titulo`) VALUES (1, 'Caminhão 3/4');
            INSERT INTO `tipo_caminhoes` (`id`, `titulo`) VALUES (2, 'Caminhão Toco');
            INSERT INTO `tipo_caminhoes` (`id`, `titulo`) VALUES (3, 'Caminhão Truck');
            INSERT INTO `tipo_caminhoes` (`id`, `titulo`) VALUES (4, 'Carreta Simples');
            INSERT INTO `tipo_caminhoes` (`id`, `titulo`) VALUES (5, 'Carreta Eixo Extendido');"));
            
            //cria tabela de motoristas
            $this->select("CREATE TABLE IF NOT EXISTS `caminhoneiros` (
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
              ) ENGINE=InnoDB DEFAULT CHARSET=latin1;");


                $this->select("CREATE TABLE IF NOT EXISTS `destinos` (
                    `id` int(11) NOT NULL AUTO_INCREMENT,
                    `lat_destino` float NOT NULL DEFAULT '0',
                    `long_destino` float NOT NULL DEFAULT '0',
                    `carregado` enum('Y','N') NOT NULL,
                    `fk_caminhoneiros` int(11) NOT NULL DEFAULT '0',
                    `adicionado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                    PRIMARY KEY (`id`),
                    KEY `FK_destinos_caminhoneiros` (`fk_caminhoneiros`),
                    CONSTRAINT `FK_destinos_caminhoneiros` FOREIGN KEY (`fk_caminhoneiros`) REFERENCES `caminhoneiros` (`id`)
                ) ENGINE=InnoDB DEFAULT CHARSET=latin1;");


           $this->select("INSERT INTO `caminhoneiros` (`id`, `nome`, `numero_cnh`, `data_nascimento`, `sexo`, `possui_veiculo`, `tipo_cnh`, `lat_origem`, `long_origem`, `fk_tipo_caminhoes`, `adiciona`, `adiciona_last_update`) VALUES (1, 'Nathan Costa', '123456789', '1993-09-04', 'M', 'Y', 'E', -23.5714, -46.5505, 1, '2020-03-09 22:32:37', NULL);
            INSERT INTO `caminhoneiros` (`id`, `nome`, `numero_cnh`, `data_nascimento`, `sexo`, `possui_veiculo`, `tipo_cnh`, `lat_origem`, `long_origem`, `fk_tipo_caminhoes`, `adiciona`, `adiciona_last_update`) VALUES (2, 'Nathan Costa ferreira', '1234567894', '1993-09-04', 'M', 'N', 'A', -23.5714, -46.5505, 1, '2020-03-09 22:32:57', NULL);
            INSERT INTO `caminhoneiros` (`id`, `nome`, `numero_cnh`, `data_nascimento`, `sexo`, `possui_veiculo`, `tipo_cnh`, `lat_origem`, `long_origem`, `fk_tipo_caminhoes`, `adiciona`, `adiciona_last_update`) VALUES (3, 'Nathan ferreira', '12345694', '1993-09-04', 'M', 'N', 'A', -23.5714, -46.5505, 1, '2020-03-09 22:33:09', NULL);
            INSERT INTO `caminhoneiros` (`id`, `nome`, `numero_cnh`, `data_nascimento`, `sexo`, `possui_veiculo`, `tipo_cnh`, `lat_origem`, `long_origem`, `fk_tipo_caminhoes`, `adiciona`, `adiciona_last_update`) VALUES (4, 'Nathan ferreira rtgg', '123456956544', '1993-09-04', 'M', 'Y', 'A', -23.5714, -46.5505, 4, '2020-03-09 22:33:56', NULL);
            INSERT INTO `caminhoneiros` (`id`, `nome`, `numero_cnh`, `data_nascimento`, `sexo`, `possui_veiculo`, `tipo_cnh`, `lat_origem`, `long_origem`, `fk_tipo_caminhoes`, `adiciona`, `adiciona_last_update`) VALUES (5, 'Nathan ferreira rtgg', '1234568956544', '1993-09-04', 'M', 'Y', 'A', -23.5714, -46.5505, 3, '2020-03-09 22:34:09', NULL);
            INSERT INTO `caminhoneiros` (`id`, `nome`, `numero_cnh`, `data_nascimento`, `sexo`, `possui_veiculo`, `tipo_cnh`, `lat_origem`, `long_origem`, `fk_tipo_caminhoes`, `adiciona`, `adiciona_last_update`) VALUES (6, 'Nathan ferreira rtgg', '12345684956544', '1993-09-04', 'M', 'Y', 'A', -23.5714, -46.5505, 4, '2020-03-09 22:34:18', NULL);
            INSERT INTO `caminhoneiros` (`id`, `nome`, `numero_cnh`, `data_nascimento`, `sexo`, `possui_veiculo`, `tipo_cnh`, `lat_origem`, `long_origem`, `fk_tipo_caminhoes`, `adiciona`, `adiciona_last_update`) VALUES (7, 'Nathang', '123456849556544', '1993-09-04', 'M', 'Y', 'A', -23.5714, -46.5505, 4, '2020-03-09 22:37:28', NULL);");


           $this->select("INSERT INTO `destinos` (`id`, `lat_destino`, `long_destino`, `carregado`, `fk_caminhoneiros`, `adicionado`) VALUES (1, -23.534, -46.5805, 'N', 1, '2020-03-09 22:34:51');
                INSERT INTO `destinos` (`id`, `lat_destino`, `long_destino`, `carregado`, `fk_caminhoneiros`, `adicionado`) VALUES (2, -23.534, -46.5805, 'Y', 2, '2020-03-09 22:34:57');
                INSERT INTO `destinos` (`id`, `lat_destino`, `long_destino`, `carregado`, `fk_caminhoneiros`, `adicionado`) VALUES (3, -23.534, -46.5805, 'Y', 3, '2020-03-09 22:35:02');
                INSERT INTO `destinos` (`id`, `lat_destino`, `long_destino`, `carregado`, `fk_caminhoneiros`, `adicionado`) VALUES (4, -23.534, -46.5805, 'N', 4, '2020-03-09 22:35:16');
                INSERT INTO `destinos` (`id`, `lat_destino`, `long_destino`, `carregado`, `fk_caminhoneiros`, `adicionado`) VALUES (5, -23.534, -46.5805, 'Y', 5, '2020-03-09 22:35:36');
                INSERT INTO `destinos` (`id`, `lat_destino`, `long_destino`, `carregado`, `fk_caminhoneiros`, `adicionado`) VALUES (6, -23.534, -46.5805, 'Y', 6, '2020-03-09 22:35:44');
                INSERT INTO `destinos` (`id`, `lat_destino`, `long_destino`, `carregado`, `fk_caminhoneiros`, `adicionado`) VALUES (7, -23.534, -46.5805, 'Y', 7, '2020-03-09 22:37:35');
           ");


         
        }catch (\Exception $e)
         {
             throw new \Exception("Erro na gravacao de dados.".$e->getMessage());
         }
        
       
          

    }


}