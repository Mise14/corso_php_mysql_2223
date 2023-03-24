-- Agrigento --> Sicilia 
/**
{
    "nome": "Agrigento",
    "sigla": "AG",
    "regione": "Sicilia" --> 15
    "regione_id" : 15
  },

**/

select regione_id from regione WHERE nome = 'Sicilia';

-- regione_id 15

insert into provincia (nome,sigla,regione_id)
VALUES ('Agrigento','AG',15);