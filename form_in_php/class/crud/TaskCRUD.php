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

//update -> PUT✅
public function update($task, $task_id){
    $query = "UPDATE `tasks` SET  `user_id`= :user_id, `name`= 
    :name, `due_date` = :due_date, `done` = :done WHERE task_id= :task_id;";
    
    $conn = new \PDO(DB_DSN,DB_USER,DB_PASSWORD);
    $stm = $conn -> prepare($query);
    $stm -> bindValue(':user_id', $task -> user_id, \PDO::PARAM_INT);
    $stm -> bindValue(':name', $task -> name, \PDO::PARAM_STR);
    $stm -> bindValue(':due_date', $task -> due_date, \PDO::PARAM_STR);
    $stm -> bindValue(':done', $task -> done, \PDO::PARAM_BOOL);
    $stm->bindValue(':task_id', $task_id, \PDO::PARAM_INT);
    $stm -> execute();

    return $stm->rowCount();
}

    //read_by_task_id -> GET✅
    public function read_by_task_id(int $task_id = null):Task|array|bool
    {
        $conn = new \PDO(DB_DSN, DB_USER, DB_PASSWORD);
        $query = "SELECT * FROM tasks WHERE task_id = :task_id";
        $stm = $conn -> prepare($query);
        $stm -> bindValue(':task_id', $task_id, PDO::PARAM_INT);
        
        $stm -> execute();//va sempre prima del $result
        $result = $stm -> fetchAll(PDO::FETCH_CLASS, Task::class);
        
        return $result;//ritorna un solo elemento, task_id univoco

    }
    
    //read_by_user_id -> GET✅
    public function read_by_user_id(int $user_id = null):Task|array|bool
    {
        $conn = new \PDO(DB_DSN, DB_USER, DB_PASSWORD);
        $query = "SELECT * FROM tasks WHERE user_id = :user_id";
        $stm = $conn -> prepare($query);
        $stm -> bindValue(':user_id', $user_id, PDO::PARAM_INT);
        
        $stm -> execute();//va sempre prima del $result
        $result = $stm -> fetchAll(PDO::FETCH_CLASS, Task::class);
    
        return $result;
    }

    //read_all -> GET✅
    public function read_all():Task|array|bool
    {
        $conn = new \PDO(DB_DSN, DB_USER, DB_PASSWORD);
        $query = "SELECT * FROM tasks";
        $stm = $conn -> prepare($query);
        
        $stm -> execute();//va sempre prima del $result
        $result = $stm -> fetchAll(PDO::FETCH_CLASS, Task::class);
            
        if(count($result) === 0){
            return false;
        }
        return $result;
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

    public function read1(int $id_user = null): Task|array|bool
    {
        $conn = new \PDO(DB_DSN, DB_USER, DB_PASSWORD);
        if (!is_null($id_user)) {
            //variante del read passando user_id
            $query = "SELECT * FROM task WHERE id_user = :id_user;";
            $stm =  $conn->prepare($query);
            $stm->bindValue(':id_user', $id_user, PDO::PARAM_INT);
            //ATTENZIONE devo specificare fetch_class perchè altrimenti mi ripete
            //due volte le informazioni (di default è fetch both)
            //devo specificare il nome della classe: 'models\User'
            //oppure con User::class chiedo alla classe il nome per esteso 
            $stm->execute();
            $result = $stm->fetchAll(PDO::FETCH_CLASS, Task::class);

            if (count($result) == 1) {
                return $result[0];
            }
            // if (count($result) > 1) {
            //     throw new \Exception("Chiave primaria duplicata", 1);
            // }
            if (count($result) === 0) {
                return false;
            }
        } else {
            $query = "SELECT * FROM task;";
            $stm =  $conn->prepare($query);
            $stm->execute();
            $result = $stm->fetchAll(PDO::FETCH_CLASS, Task::class);
            if (count($result) === 0) {
                return false;
            }
            
        }return $result;
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
