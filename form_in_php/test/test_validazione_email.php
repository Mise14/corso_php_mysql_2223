<?php 

// $files = scandir("./form_in_php/class/validator");
// print_r($files);
// require "./form_in_php/class/validator/ValidateMail.php";
require "./form_in_php/class/validator/ValidateMail.php";

$emails = [
    'a','  ','a@','mario','<h1>ciccio</h1>','a<@.it'
];

$v = new ValidateMail();

// v.isValid('a')

foreach ($emails as $index => $email){
    
    if($v->isValid($email) == false) {
        echo "test superato per $email\n";
    }else{
        echo "test numero $index non superato per [$email]\n";
    };
    // $v->getMessage();
}


