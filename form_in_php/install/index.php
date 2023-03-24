<?php 
include "../../config.php";
$query = file_get_contents("install.sql");
try {
    $conn = new PDO(DB_DSN,DB_USER,DB_PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $conn->query($query); 
    echo "database sincronizzato";
} catch (\Throwable $th) {
    echo $th->getMessage();
}