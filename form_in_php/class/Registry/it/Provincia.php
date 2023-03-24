<?php 
namespace Registry\it;
class Provincia {

    public static function all()
    {
        try {
            $conn = new \PDO(DB_DSN,DB_USER,DB_PASSWORD);
            $stm = $conn->prepare('SELECT * FROM provincia;');
            $stm->execute();
            $result = $stm->fetchAll(\PDO::FETCH_OBJ);
            return $result;
        } catch (\PDOException $th) {
            throw $th;
        }
        
    }

}