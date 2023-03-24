<?php

include "config.php";

$province_string = file_get_contents('province.json');

$province_object = json_decode($province_string);

//print_r($regioni_unique);
/*
foreach ($province_object as $key => $province) {
    echo $province->nome;
    echo $province->sigla;
}
*/
$dsn = "mysql:host=".DB_HOST.";dbname=".DB_NAME;

try {
    $conn = new PDO($dsn, DB_USER, DB_PASSWORD);
    $conn->query('TRUNCATE TABLE provincia;');

    foreach ($province_object as $key => $provincia) {
        $nome_provincia = addslashes($provincia->nome);
        $sigla_provincia = addslashes($provincia->sigla);
        //$sql_select = "SELECT id_regione FROM Regione WHERE nome=\"$provincia->regione\"";
        //$id_regione = $conn->query($sql_select)->fetchColumn();

        $id_regione = $conn->query("SELECT regione_id FROM regione WHERE nome=\"$provincia->regione\"")->fetchColumn();

        // $select_id = $conn->prepare("SELECT id_regione FROM Regione WHERE nome=?;");
        // $select_id->execute([$provincia->regione]);
        // $id_regione = $select_id->fetchColumn();
        //var_dump($id_regione);
        //break;
        $sql = "INSERT INTO Provincia (nome, sigla, regione_id) VALUES('".$nome_provincia. "','".$sigla_provincia."',$id_regione);";
        echo $sql."\n";
        $conn->query($sql); 
    }
} catch (\Throwable $th) {
    throw $th;
}   

?>