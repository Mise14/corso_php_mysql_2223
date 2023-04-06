<?php
namespace crud;

use models\Task;
use PDO;

class TaskCRUD {

    public function create(Task $task)
    {
        $query = "INSERT INTO tasks(user_id, name, due_date, done) 
                  VALUES (:user_id, :name, :due_date, :done)";
        $conn = new \PDO(DB_DSN,DB_USER,DB_PASSWORD);
        $stm = $conn->prepare($query);

        $stm->bindValue(':user_id',$task->user_id,\PDO::PARAM_STR);
        $stm->bindValue(':name',$task->name,\PDO::PARAM_STR);
        $stm->bindValue(':due_date',$task->due_date,\PDO::PARAM_STR);
        $stm->bindValue(':done',$task->done,\PDO::PARAM_STR);
        $stm->execute();
        return $conn->lastInsertId();
    }

    public function update($task_id, $task)
    {
        // print_r($user_id);
        // print_r($user);
        $conn = new \PDO(DB_DSN, DB_USER, DB_PASSWORD);
        $query = "UPDATE `tasks` u SET  `user_id`= :user_id, `name`= :name, `due_date` = :due_date, `done`= :done WHERE task_id= :task_id;";
        $stm = $conn->prepare($query);
        $stm->bindValue(':user_id',$task->user_id,\PDO::PARAM_STR);
        $stm->bindValue(':name',$task->name,\PDO::PARAM_STR);
        $stm->bindValue(':due_date',$task->due_date,\PDO::PARAM_STR);
        $stm->bindValue(':done',$task->done,\PDO::PARAM_STR);
        $stm->bindValue(':task_id', $task_id, PDO::PARAM_INT);
        $stm->execute();
        return $stm->rowCount();
    }

    public function read(int $user_id=null):Task|array|bool|String
    {
        $conn = new \PDO(DB_DSN,DB_USER,DB_PASSWORD);
        if(!is_null($user_id)){
            $query = "SELECT * FROM tasks where user_id = :user_id";
            $stm = $conn->prepare($query);
            $stm->bindValue(':user_id',$user_id,PDO::PARAM_INT);
            
            $stm->execute();
            $result = $stm->fetchAll(PDO::FETCH_CLASS,Task::class);

            if(count($result)== 1){
                return $result[0];
            }
            // if(count($result)>1){
            //     throw new \Exception("Chiave primaria duplicata", 1);
            // }
            if(count($result) === 0){
                return "Utente inesistente";
            }
        }else{
            $query = "SELECT * FROM tasks";
            $stm = $conn->prepare($query);

            $stm->execute();
            $result = $stm->fetchAll(PDO::FETCH_CLASS,Task::class);

            if(count($result) === 0){
                return false;
            }
            return $result;
        }
        return $result;
    }

    public function readTask(int $task_id=null):Task|array|bool|String
    {
        $conn = new \PDO(DB_DSN,DB_USER,DB_PASSWORD);
        if(!is_null($task_id)){
            $query = "SELECT * FROM tasks where task_id = :task_id";
            $stm = $conn->prepare($query);
            $stm->bindValue(':task_id',$task_id,PDO::PARAM_INT);
            
            $stm->execute();
            $result = $stm->fetchAll(PDO::FETCH_CLASS,Task::class);

            if(count($result)== 1){
                return $result[0];
            }
            if(count($result) === 0){
                return false;
            }
        }
        return $result;
        
    }

    public function delete($task_id)
    {
        $conn = new \PDO(DB_DSN,DB_USER,DB_PASSWORD);
        $query = "DELETE from tasks where task_id = :task_id";
        $stm = $conn->prepare($query);
        $stm->bindValue(':task_id',$task_id,PDO::PARAM_INT);
        $stm->execute();
        //Restituisce righe coinvolte nell'operazione (righe eliminate es)
        return $stm->rowCount();
    }















}
