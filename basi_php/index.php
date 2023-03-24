<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <?php
        $nome = "Marioo";
        $eta = 50;
        $passatempi = array("Tennis","Cinema","no sport");

        /** dichiarazione della funzione */
        function saluta($nome){
            return "Ciao io sono $nome, come va ?"; // double quote
            // return "Ciao io sono" + nome + ", come va ?"
            // `Ciao io sono  ${nome}, come va ?` // template literal
        }

        echo "<h1>scrivo un contenuto sullo schermo</h1>";
        // Chiamo la funzione
        echo saluta("Gianni");
        echo "<p>".saluta($nome) .  "</p>";
        echo "<div>".saluta($nome) . "</div>";

        /*
        genera un errore / warning prche echo può "visualizzare" solo string e number 
        echo $passatempi; 
        */


        // passatempi.length
        echo "<ul>";
        for ($i=0; $i < count($passatempi); $i++) { 
            echo "<li>$passatempi[$i]</li>"; // $passatempi[0],$passatempi[1]
        }
        echo "</ul>"
    
    
        $frase = "Ciao sono una frase";
        $frase .= "sono una altro pezzo della frase";
        $frase = $frase . "sono una altro pezzo della frase";

        echo $frase;
        /**
         contatore = 0
         contatore++;
         contatore = contatore + 4
         contatore +=  4

         */

    ?>
</body>
</html>