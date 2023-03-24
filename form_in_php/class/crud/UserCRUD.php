<?php 
namespace crud;

use models\User;
use PDO;

class UserCRUD {


    public function create(User $user)
    {
        $query = "INSERT INTO user ( first_name, last_name, birthday, birth_city, regione_id, provincia_id, gender, username, password) 
                  VALUES (:first_name, :last_name, :birthday, :birth_city, :regione_id, :provincia_id, :gender, :username, :password)
                 ";
        $conn = new \PDO(DB_DSN,DB_USER,DB_PASSWORD);
        $stm = $conn->prepare($query);
        $stm->bindValue(':first_name',$user->first_name,\PDO::PARAM_STR);
        $stm->bindValue(':last_name',$user->last_name,\PDO::PARAM_STR);
        $stm->bindValue(':birthday',$user->birthday,\PDO::PARAM_STR);
        $stm->bindValue(':birth_city',$user->birth_city,\PDO::PARAM_STR);
        $stm->bindValue(':regione_id',$user->regione_id,\PDO::PARAM_INT);
        $stm->bindValue(':provincia_id',$user->provincia_id,\PDO::PARAM_INT);
        $stm->bindValue(':username',$user->username,\PDO::PARAM_STR);
        $stm->bindValue(':password',md5($user->password),\PDO::PARAM_STR);
        $stm->bindValue(':gender',$user->gender,\PDO::PARAM_STR);
        
        $stm->execute();
        echo "sono al fondo di create";
    }

    public function update()
    {
        $query = "UPDATE";
    }

    public function read(int $user_id=null)
    {
        // null --> false
        // "" == false --> true
        // "" === false --> false
        // null == false --> true
        // null === false --> false 
        // false === false --> true
        $conn = new \PDO(DB_DSN,DB_USER,DB_PASSWORD);
        if(!is_null($user_id)){
            $query = "SELECT * FROM user where user_id = :user_id";
            $stm = $conn->prepare($query);
            $stm->bindValue(':user_id',$user_id,PDO::PARAM_INT);
            
            $stm->execute();
            $result = $stm->fetchAll(PDO::FETCH_CLASS,User::class);

            if(count($result)== 1){
                return $result[0];
            }
            if(count($result)>1){
                throw new \Exception("Chiave primaria duplicata", 1);
            }
            if(count($result) === 0){
                return false;
            }
        }else{
            $query = "SELECT * FROM user";
            $stm = $conn->prepare($query);

            $stm->execute();
            $result = $stm->fetchAll(PDO::FETCH_CLASS,User::class);

            if(count($result) === 0){
                return false;
            }
            return $result;
        }

   
        // echo "ciao sono ".User::class."\n";
        // return $result;
    }



    public function delete($user_id)
    {
        $conn = new \PDO(DB_DSN,DB_USER,DB_PASSWORD);
        $query = "DELETE from user where user_id = :user_id";
        $stm = $conn->prepare($query);
        $stm->bindValue(':user_id',$user_id,PDO::PARAM_INT);
        $stm->execute();
        return $stm->rowCount();
    }
}