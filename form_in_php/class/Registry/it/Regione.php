<?php 
namespace Registry\it;
class Regione {


    public static function all()
    {
        
        try {
            $conn = new \PDO(DB_DSN,DB_USER,DB_PASSWORD);
            $stm = $conn->prepare('SELECT * FROM regione;');
            $stm->execute();
            $result = $stm->fetchAll(\PDO::FETCH_OBJ);
            return $result;
        } catch (\PDOException $th) {
            throw $th;
        }
        
    }

}