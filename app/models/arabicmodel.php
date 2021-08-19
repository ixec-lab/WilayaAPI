<?php

namespace WILAYAPI\MODELS;

use WILAYAPI\LIBS\DATABASE\Database;

class ArabicModel{

    public function getWilayaNameByCode($code){

        $db = Database::init();
        $sql = "SELECT DISTINCT wilaya_name as wilaya from algeria_cities where wilaya_code = :code";
        $qry = $db->prepare($sql);
        $qry->bindParam(":code",$code,\PDO::PARAM_INT);
        $qry->execute();
        $row = $qry->fetch(\PDO::FETCH_OBJ);

        if ($qry->rowCount($row) === 1)
            return $row->wilaya;
    }

    public function getCommuneNameByCode($code){

        $db = Database::init();
        $sql = "SELECT DISTINCT commune_name as commune from algeria_cities where wilaya_code = :code";
        $qry = $db->prepare($sql);
        $qry->bindParam(":code",$code,\PDO::PARAM_INT);
        $qry->execute();
        $row = $qry->fetchAll(\PDO::FETCH_OBJ);

        if ($qry->rowCount($row) > 0)
            return $row;
    }

    public function getDairaNameByCode($code){

        $db = Database::init();
        $sql = "SELECT DISTINCT daira_name as daira from algeria_cities where wilaya_code = :code";
        $qry = $db->prepare($sql);
        $qry->bindParam(":code",$code,\PDO::PARAM_INT);
        $qry->execute();
        $row = $qry->fetchAll(\PDO::FETCH_OBJ);

        if ($qry->rowCount($row) > 0)
            return $row;
    }

    public function getCommunWilaya($name){
        $name = $name."%";
        $db = Database::init();
        $sql = "SELECT DISTINCT wilaya_name as wilaya from algeria_cities where wilaya_name_ascii like :name";
        $qry = $db->prepare($sql);
        $qry->bindParam(":name",$name,\PDO::PARAM_STR);
        $qry->execute();

        $row = $qry->fetchAll(\PDO::FETCH_OBJ);
        if ($qry->rowCount($row) > 0)
            return $row;
    }

    public function getWilayaCodeByName($name){
        $db = Database::init();
        $sql = "SELECT DISTINCT wilaya_code from algeria_cities where wilaya_name = :name";
        $qry = $db->prepare($sql);
        $qry->bindParam(":name",$name,\PDO::PARAM_STR);
        $qry->execute();

        $row = $qry->fetch(\PDO::FETCH_OBJ);
        if ($qry->rowCount($row) === 1)
            return $row->wilaya_code;
    }

    public function getCommuneNameByWilayaName($name){
        $db = Database::init();
        $sql = "SELECT DISTINCT commune_name as commune from algeria_cities where wilaya_name = :name";
        $qry = $db->prepare($sql);
        $qry->bindParam(":name",$name,\PDO::PARAM_STR);
        $qry->execute();
        $row = $qry->fetchAll(\PDO::FETCH_OBJ);

        if ($qry->rowCount($row) > 0)
            return $row;

    }

    public function getDairaNameByWilayaName($name){
        $db = Database::init();
        $sql = "SELECT DISTINCT daira_name as daira from algeria_cities where wilaya_name = :name";
        $qry = $db->prepare($sql);
        $qry->bindParam(":name",$name,\PDO::PARAM_STR);
        $qry->execute();
        $row = $qry->fetchAll(\PDO::FETCH_OBJ);

        if ($qry->rowCount($row) > 0)
            return $row;
    }
}

?>