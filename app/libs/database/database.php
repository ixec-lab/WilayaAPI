<?php
namespace WILAYAPI\LIBS\DATABASE;

class Database{
    private const USERNAME = "ixec";
    private const PASSWORD = "islem123";
    private const HOST = "127.0.0.1";
    private const DRIVER = "mysql";
    private const DBNAME = "WilayaAPI";
    
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