<?php
/*
 select regione_id from regione WHERE nome = 'Sicilia';

-- regione_id 15

insert into provincia (nome,sigla,regione_id)
VALUES ('Agrigento','AG',15);
*/
$pdo_stm = $conn->query("select regione_id from regione WHERE nome = '$regione';");
$regione_id = $pdo_stm->fetchColumn();
print_r($regione_id);