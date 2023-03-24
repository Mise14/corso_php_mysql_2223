<?php

// $nome = "Mario";
// echo "\tciao $nome \n";
// echo '\tciao $nome \n';


// # Index Array
// // $colori = array();
// $colori = ['red',"green","blue"];
// echo "\n\n".$colori[2]."\n";

// # associative Array (HashMap)
// $persona = [
//     'email' => "a@b.it",
//     "cognome" => 'Rossi',
//     'nome' => "Mario"
//     ];

// // console.log(persona)
// print_r($persona);

// echo $persona['email'];

// /** Da errore Array to string conversion  */
// // echo $persona;

$classe = array(
    [
        'email' => "a@b.it",
        "cognome" => 'Rossi',
        'nome' => "Mario"
    ],
    [
        'email' => "c@d.it",
        "cognome" => 'Verdi',
        'nome' => "Giovanni"
    ]
);

// print_r($classe[0]['nome']);

# Imperativo 
echo "\nFor Loop\n";
echo "-------------------------\n";

for ($i=0; $i < count($classe); $i++) {
   $allievo = $classe[$i];
   echo $allievo['nome']."\n"; 
}

echo "\nforeach Loop \n";
echo "-------------------------\n";

foreach ($classe as $i => $allievo) {
    echo ($i+1) . ") " . $allievo['nome'];
    echo "\n";
}

# dichiarativo / funzionale
echo "\nmap di un array\n";
echo "-------------------------\n";

function stampaNome($allievo){
    echo $allievo['nome']."\n";
};
array_map('stampaNome',$classe);

// var_dump($persona);

