<?php

namespace WILAYAPI\MODELS;

use WILAYAPI\LIBS\DATABASE\Database;

class FrenchModel{

    public function getWilayaNameByCode($code){

        $db = Database::init();
        $sql = "SELECT DISTINCT wilaya_name_ascii as wilaya from algeria_cities where wilaya_code = :code";
        $qry = $db->prepare($sql);
        $qry->bindParam(":code",$code,\PDO::PARAM_INT);
        $qry->execute();
        $row = $qry->fetch(\PDO::FETCH_OBJ);

        if ($qry->rowCount($row) === 1)
            return $row->wilaya;
    }

    public function getCommuneNameByCode($code){

        $db = Database::init();
        $sql = "SELECT DISTINCT commune_name_ascii as commune from algeria_cities where wilaya_code = :code";
        $qry = $db->prepare($sql);
        $qry->bindParam(":code",$code,\PDO::PARAM_INT);
        $qry->execute();
        $row = $qry->fetchAll(\PDO::FETCH_OBJ);

        if ($qry->rowCount($row) > 0)
            return $row;
    }
}

?>