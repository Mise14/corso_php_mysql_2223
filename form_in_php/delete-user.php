<?php

use crud\UserCRUD;
require "./config.php";
require "./autoload.php";

$user_id = filter_input(INPUT_GET,'user_id',FILTER_VALIDATE_INT);

if($user_id){
    (new UserCRUD)->delete($user_id);
   header("location: index-user.php");
} else{
    echo "problemi con il delete";
}