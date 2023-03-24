<?php 
// ValidateRequired campo obbligatorio, quindi non deve essere vuoto

require "./form_in_php/class/validator/ValidateRequired.php";


$testCases = [
    [
        'input' => '       ',
        'expected' =>false 
    ],
    [
        'input' => 'ciao ',
        'expected' => 'ciao'
    ],
    [
        'input' => '  ciao ',
        'expected' => 'ciao' 
    ],
    [
        'input' => ' ciao',
        'expected' => 'ciao' 
    ],
    [
        'input' => '',
        'expected' => false 
    ],
    [
        'input' => '<h1>ciao</h1>',
        'expected' => 'ciao'
    ],
    [
        'input' => '<b>ciao</b>',
        'expected' => 'ciao'
    ],
    [
        'input' => 'ciao</b>',
        'expected' => 'ciao'
    ],
    [
        'input' => '<b>ciao',
        'expected' => 'ciao'
    ],
    [
        'input' => '<b>   </b>',
        'expected' => false
    ],
    [
        'input' => '<b></b>  ',
        'expected' => false
    ],
    [
        'input' => '<b>  ',
        'expected' => false
    ],
    [
        'input' => 20,
        'expected' => 20
    ],
    [
        'input' => 0,
        'expected' => 0
    ]
];


foreach ($testCases as $key => $test){
    $input = $test['input'];
    $expected = $test['expected'];

    $v = new ValidateRequired();
    
    if($v->isValid($input) != $expected){
        echo "\nTest mumero $key non superato mi aspettavo";
        var_dump($expected);
        echo "\nma ho trovato";
        var_dump($v->isValid($input));
    };

    //print_r($test['input']);
}

