<?php
require "./form_in_php/class/validator/Validable.php";
require "./form_in_php/class/validator/ValidateDate.php";

$testCases = [
    [
        'input'=>'18/09/1975',
        'expected' => '18/09/1975'
    ],
    [
        'input'=>'    18/09/1975    ',
        'expected' => '18/09/1975'
    ],
    [
        'input'=>'33/09/1975',
        'expected' => false
    ],
    [
        'input'=>'18/09/1975',
        'expected' => '18/09/1975'
    ],
    [
        'input'=>'18/33/1975',
        'expected' => false
    ],
    [
        'input'=>'18/09/1975',
        'expected' => '18/09/1975'
    ],
    [
        'input'=>'18/09/19755',
        'expected' => false
    ],
    [
        'input'=>'18-09-1975',
        'expected' => false
    ],

];

foreach ($testCases as $key => $test){
    $input = $test['input'];
    $expected = $test['expected'];

    $v = new ValidateDate();
    
    if($v->isValid($input) != $expected){
        echo "\nTest mumero $key non superato mi aspettavo\n";
        var_dump($expected);
        echo "\nma ho trovato\n";
        var_dump($v->isValid($input));
    };

    //print_r($test['input']);
}