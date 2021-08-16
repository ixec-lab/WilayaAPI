<?php
namespace WILAYAPI\LIBS\DATABASES;

class Mysql{
    private const USERNAME = "ixec";
    private const PASSWORD = "";
    private const HOST = "127.0.0.1";
    private const DRIVER = "mysql";
    private const DBNAME = "";
    
    public static function init(){
        try{
             $db = new \PDO(self::DRIVER.":host=".self::HOST.";dbname=".self::DBNAME,self::USERNAME,self::PASSWORD);
            /* ONLY on DEV mod*/
            $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            return $db;
        }catch(\PDOException $e){
            $e->getMessage();
        }
    }
}
?>