
TRUNCATE TABLE user;

INSERT INTO user ( `first_name`, `last_name`, `birthday`, `birth_city`, `regione_id`, `provincia_id`, `gender`, `username`, `password`) 
        VALUES ( 'Mario', 'Rossi', '2023-03-15', 'Torino', '18', '96', 'M', 'mariorossi@email.com', MD5('password'));