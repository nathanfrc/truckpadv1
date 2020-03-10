<?php

namespace App\Libs\DataBase;

class Conection
{
    public static $connection;

    public static function getConnection()
    {
        $pdoConfig  = DB_DRIVER . ":". "host=" . DB_HOST . ";";
        $pdoConfig .= "dbname=".DB_NAME.";charset=utf8";

        try { 
                if(!isset($connection))
                {
                    $connection =  new \PDO($pdoConfig, DB_USER, DB_PASSWORD,array(\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
                    $connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
                }
                return $connection;
            
        } catch (PDOException $e) {
           throw new Exception("Erro de conexao com o banco de dados",500);
        }
    }

}