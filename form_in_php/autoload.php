<?php



// AUTOLOAD HTML FRONTEND
spl_autoload_register(function($className){
    // C:\xampp\htdocs\corso_php_mysql_2223\form_in_php\class
    
    $className = str_replace("\\","/",__DIR__."/class/".$className.'.php');
    require $className;
;
});