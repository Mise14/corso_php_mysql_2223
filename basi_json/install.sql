-- Active: 1678176946563@@127.0.0.1@3306
use form_in_php;

CREATE TABLE regione (
    regione_id int NOT NULL AUTO_INCREMENT,
    nome varchar(255) NOT NULL,
    PRIMARY KEY (regione_id)
);

drop table regione;
insert INTO regione (nome) VALUES('Abruzzo');
SELECT * from regione;
INSERT INTO regione (nome) VALUES('Valle d\'Aosta/Vallée d\'Aoste');
TRUNCATE TABLE regione;


--- Province

CREATE TABLE provincia (
    provincia_id int NOT NULL AUTO_INCREMENT,
    nome varchar(255) NOT NULL,
    sigla CHAR(2) NOT NULL,
    regione_id  int NULL,
    PRIMARY KEY (provincia_id)
);

