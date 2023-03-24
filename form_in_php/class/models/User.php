<?php
namespace models;
class User {

    public $first_name;
    public $last_name;
    public $birthday;
    public $birth_city;
    public $regione_id;
    public $provincia_id;
    public $gender;
    public $username;
    public $password;

    public function label()
    {
        return $this->first_name." ".$this->last_name;
    }
    
    public static function arrayToUser(array $class_array):User
    {
       $user = new User;
       foreach ($class_array as $class_attribute => $value_of_class_attribute) {
           $user->$class_attribute = $value_of_class_attribute;
       }
       return $user;
    }
}