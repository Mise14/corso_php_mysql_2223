<?php 
use models\User;
require "form_in_php/test/test_autoload.php";
// caso 1
// $colore = "blue";
// caso 2
// $colore = "verde";

// Variabili di variabili
// echo $$colore;
// echo $colore();
// new $colore();


# php form_in_php/test/crud/test_array_to_user.php

// $_POST
$class_array = [
    "first_name"=>"Paolo",
    "last_name"=>"Rossi",
    "birthday"=>"2020-12-20",
    "birth_city"=>"Givoletto",
    "regione_id"=>10,
    "provincia_id"=>3,
    "gender"=>"M",
    "username"=>"a@b.it",
    "password"=>"ciccio"
];

// $class_name = User::class;
// $user = new $class_name;

$user = User::arrayToUser($class_array);
if(get_class($user) == User::class) {
    echo "\ntest passato è un oggetto di tipo User::class \n";
    print_r($user);
}