<?php
namespace App\Lib;
use PDO;
use PDOException;
use Exception;

class ConPDO{
    
    private static $connection;
    
    private function __construct(){}
    
    public static function getConnection(){
        $dsn = DB_DRIVER . ":" ."host=". DB_HOST ;
        $dsn.=";" ."dbname=" . DB_NAME .";charset=utf8";
        try {
            if(!isset($connection)){
                $connection = new PDO($dsn,DB_USER,DB_PASSWORD);
                $connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            }
            return $connection;
        } catch (PDOException $e) {
            throw new Exception("Erro de conexão com o banco de dados",500);
        }
    }
}
?>